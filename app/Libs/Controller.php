<?php
class Controller{
	public function __construct(){
	    //view=new View();
		$this->view = new View();
	}
	public function loadModel($name){//$name=User
        //$modelName=UserModel
        $modelName = $name.'Model';
        //$path=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\Models\UserModel.php
		$path = MODEL_PATH . $modelName.'.php';
		if(file_exists($path)){//=1
			require_once $path;
			$this->db= new $modelName();
		}
	}
	//Điều hướng trang web
	public function redirect($controller = 'index', $action = 'index'){
	    //controller=group,action=index
        //Chuyển hướng trang:
		header("location: Index.php?controller=$controller&action=$action");
		exit();
	}
}