<?php
class Err extends Controller{//Nhảy đến hàm_autoload
	public function index(){
	    //$msg="This is an Err"
		$this->view->msg = 'This is an Err!';
		//Chạy đến phương thức render
		$this->view->render('Err/index');
	}
}