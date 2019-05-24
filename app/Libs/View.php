<?php
class View{
	//$name=Err/index, $full=true
	public function render($name, $full =  true){
		if($full == true) {//=1
			include_once (VIEW_PATH . 'Header.php');
			require_once VIEW_PATH .$name.'.php';
			include_once (VIEW_PATH . 'Footer.php');
		}else{
			require_once VIEW_PATH .$name.'.php';
		}
	}
}