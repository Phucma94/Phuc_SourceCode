<?php
class Bootstrap{
	private $_url;
	private $_controller;
	public function init(){
		$this->setURL();
		//Chưa điền controller trên url
		if(!isset($this->_url['controller'])){//=0
			$this->loadDefaultController();
            exit();//Dừng chương trình
		}
		
		$this->loadExistController();
		$this->callControllerMethod();
	}
	// SET URL
	private function setURL()//Lấy $_GET trên đường dẫn url
    {
        /*_url={
        controller=user
        action=index
        }
        */
		$this->_url = isset($_GET) ? $_GET : null;
	}
	// LOAD DEFAULT CONTROLLER
	private function loadDefaultController(){
	    //require Controllers/Index.php
        //require Controllers.php
		require_once (CONTROLLER_PATH . 'Index.php');
		$this->_controller = new Index();
		$this->_controller->index();
	}
	// LOAD EXISTING CONTROLLER
	private function loadExistController(){
	    //$file=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\Controllers\User.php
        //$file=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\Controllers\Index.php
        $FileController=ucfirst($this->_url['controller']);//User
		$file = CONTROLLER_PATH . $FileController . '.php';
		if(file_exists($file)){//=1
			require_once $file;
			//$_controller=new User
            //Tên Class không phân biệt chữ hoa và thường
			$this->_controller = new $FileController;
			//Chạy đến loadModel(user)
            $this->_controller->loadModel($FileController);
		}else{
		    //Chạy đến phương thức Err()
			$this->error();
		}
	}
	// CALL METHODE
	private function callControllerMethod(){
	    //Kiểm tra phương thức action=index có tồn tại trong dối tượng controller hay không
		if(method_exists($this->_controller, $this->_url['action'] )==true){//==0
		    //
			$this->_controller->{$this->_url['action']}();
		}else{
			$this->error();
		}
	}
	public function error(){
		require_once CONTROLLER_PATH . 'error.php';
		$error = new Err();
		$error->index();
	}
}