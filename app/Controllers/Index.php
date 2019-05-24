<?php
class Index extends Controller{
	public function __construct(){
		parent::__construct();
		$this->view->title = 'Home';
	}
	public function printIndexScript(){
    }
    public function index1(){
        $this->view->render('index/index');
    }
	public function index(){
		$this->view->render('index/index');
	}
}