<?php
class Model{
	protected $connect;
	protected $database;
	protected $table;
	protected $resultQuery;
	// CONNECT DATABASE
	public function __construct($params = null){//param=null
		if($params == null){
		    //Gán giá trj của mảng param
			$params['server']	= DB_HOST;
			$params['username']	= DB_USER;
			$params['password']	= DB_PASS;
			$params['database']	= DB_NAME;
			$params['table']	= DB_TABLE;
		}
		$link = mysqli_connect($params['server'], $params['username'], $params['password']);
		if(!$link){
			die('Fail connect: ' . mysqli_errno($link));//Mã lỗi
		}else{//!=0
		    /*connect=mysqli{
		    affected_rows=-1
		    client_info=mysqlnd 5.0.12-dev - 20150407 - $Id: 7cc7cc96e675f6d72e5cf0f267f48e167c2abb23 $
            client_version=50012
		    connect_errno=0
		    connect_error=null
		    errno=0
		    Err=""
		    error_list=[0]
		    field_count=0
		    host_info=localhost via TCP/IP
		    info=null
		    insert_id=0
		    server_info=5.5.5-10.1.38-MariaDB
		    server_version=50505
		    stat=Uptime: 19601  Threads: 1  Questions: 4  Slow queries: 0  Opens: 17  Flush tables: 1  Open tables: 11  Queries per second avg: 0.000
		    sqlstate=00000
		    protocol_version=10
		    thread_id=5
		    warning_count=0
		    }*/
			$this->connect 	= $link;
			//Database=manage_user
			$this->database = $params['database'];
            //table=user
			$this->table 	= $params['table'];
			//connect: mysqli{}
            //Database:manage_user
			$this->setDatabase();
			// Câu lệnh query set name va set character ở meta utf8
			$this->query("SET NAMES 'utf8'");
			$this->query("SET CHARACTER SET 'utf8'");
		}
	}
	// SET CONNECT
	public function setConnect($connect){
		$this->connect = $connect;
	}
	// SET DATABASE
	public function setDatabase($database = null){//Database=null
		if($database != null) {
			$this->database = $database;
		}
		//connect: mysqli{}
        //Database:manage_user
		mysqli_select_db($this->connect,$this->database );
	}
	// SET TABLE
	public function setTable($table){
		$this->table = $table;
	}
	// DISCONNECT DATABASE
	public function __destruct(){
		mysqli_close($this->connect);
	}
	// INSERT
	public function insert($data, $type = 'single'){
		if($type == 'single'){
			$newQuery 	= $this->createInsertSQL($data);
			$query 		= "INSERT INTO `$this->table`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
			$this->query($query);
		}else{
			foreach($data as $value){
				$newQuery = $this->createInsertSQL($value);
				$query = "INSERT INTO `$this->table`(".$newQuery['cols'].") VALUES (".$newQuery['vals'].")";
				$this->query($query);
			}
		}
		return $this->lastID();
	}
	// CREATE INSERT SQL
	public function createInsertSQL($data){
		$newQuery = array();
		if(!empty($data)){
			foreach($data as $key=> $value){
				$cols .= ", `$key`";
				$vals .= ", '$value'";
			}
		}
		$newQuery['cols'] = substr($cols, 2);
		$newQuery['vals'] = substr($vals, 2);
		return $newQuery;
	}
	// LAST ID
	public function lastID(){
		return mysqli_insert_id($this->connect);
	}
	// QUERY
	public function query($query){
		$this->resultQuery = mysqli_query($this->connect,$query);
		return $this->resultQuery;
	}
	// UPDATE
	public function update($data, $where){
		$newSet 	= $this->createUpdateSQL($data);
		$newWhere 	= $this->createWhereUpdateSQL($where);
		$query = "UPDATE `$this->table` SET " . $newSet . " WHERE $newWhere";
		$this->query($query);
		return $this->affectedRows();
	}
	// CREATE UPDATE SQL
	public function createUpdateSQL($data){
		$newQuery = "";
		if(!empty($data)){
			foreach($data as $key => $value){
				$newQuery .= ", `$key` = '$value'";
			}
		}
		$newQuery = substr($newQuery, 2);
		return $newQuery;
	}
	// CREATE WHERE UPDATE SQL
	public function createWhereUpdateSQL($data){
		$newWhere = '';
		if(!empty($data)){
			foreach($data as $value){
				$newWhere[] = "`$value[0]` = '$value[1]'";
				$newWhere[] = $value[2];
			}
			$newWhere = implode(" ", $newWhere);
		}
		return $newWhere;
	}
	// AFFECTED ROWS
	public function affectedRows(){
		return mysqli_affected_rows($this->connect);
	}
	
	// DELETE
	public function delete($where){
		$newWhere 	= $this->createWhereDeleteSQL($where);
		$query 		= "DELETE FROM `$this->table` WHERE `id` IN ($newWhere)";
		$this->query($query);
		return $this->affectedRows();
	}
	// CREATE WHERE DELTE SQL
	public function createWhereDeleteSQL($data){
		$newWhere = '';
		if(!empty($data)){
			foreach($data as $id) {
				$newWhere .= "'" . $id . "', ";
			}
			$newWhere .= "'0'";
		}
		return $newWhere;
	}
	// LIST RECORD
	public function listRecord($query){
		$result = array();
		if(!empty($query)){
			$resultQuery = $this->query($query);
			if(@mysqli_num_rows($resultQuery)>0){//Dấu @ đằng trước để không hiển thị cảnh báo
				while($row = mysqli_fetch_assoc($resultQuery)){
					$result[] = $row;
				}
				mysqli_free_result($resultQuery);
			}
		}
		return $result;
	}
	// LIST RECORD
	public function createSelectbox($query, $name, $keySelected = null, $class = null){
		$result = array();
		if(!empty($query)) {
            $resultQuery = $this->query($query);
            if (mysqli_num_rows($resultQuery) > 0) {
                $xhtml = '<select class="' . $class . '" name="' . $name . '">';
                $xhtml .= '<option value="0">Select a value</option>';
                while ($row = mysqli_fetch_assoc($resultQuery)) {
                    if ($keySelected == $row['id'] && $keySelected != null) {
                        $xhtml .= '<option value="' . $row['id'] . '" selected="true">' . $row['name'] . '</option>';
                    } else {
                        $xhtml .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                    }
                }
                $xhtml .= '</select>';
                mysqli_free_result($resultQuery);
            }
        }
		return $xhtml;
	}
	// SINGLE RECORD
	public function singleRecord($query){
		$result = array();
		if(!empty($query)){
			$resultQuery = $this->query($query);
			if(mysqli_num_rows($resultQuery) > 0){
				$result = mysqli_fetch_assoc($resultQuery);
			}
			mysqli_free_result($resultQuery);
		}
		return $result;
	}
	// EXIST
	public function isExist($query){
		if($query != null) {//==1
		    //this->resultQuery = mysqli_query($this->connect,$query)
			$this->resultQuery = $this->query($query);
		}
		//trả về số nguyên đại diện cho số hàng có trong kết quả.
		if(mysqli_num_rows($this->resultQuery ) > 0) return true;//Return true
		return false;
	}
}