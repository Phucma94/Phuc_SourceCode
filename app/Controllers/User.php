<?php
class User extends Controller{
	public function __construct(){
		parent::__construct();
		Session::init();
	}
	public function printLoginScripts(){
    }
	public function login(){
		if(Session::get('loggedIn')==true){
			$this->redirect('group','index');
		}
		if(isset($_POST['submit'])){
		    //$source=array{username='Phuc'}
			$source 	= array('username' => $_POST['username']);
			//username=Phuc
			$username 	= $_POST['username'];
			// Mã hóa dữ liệu theo kiểu MD5
			$password 	= md5($_POST['password']);
			$validate = new Validate($source);
			//Nhảy đến phương thức addRule class Models
			$validate->addRule('username', 'existRecord', array('database' => $this->db, 'query' =>
            "SELECT id FROM user WHERE username = '$username' AND password= '$password'"));
			//Phương thức run() class Validate
			$validate->run();
			if($validate->isValid()==true){//==true
				Session::set('loggedIn', true);
				$this->redirect('group','index');
			}else{
				$this->view->errors = $validate->showErrors();
			}
		}
        $this->view->render('user/login');
	}
	public function logout(){
		$this->view->render('user/logout');
		Session::destroy();
	}
}