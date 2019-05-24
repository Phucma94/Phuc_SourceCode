<?php
class Session{
	//Phương thức tĩnh
	public static function init(){
	    if(session_status()==PHP_SESSION_NONE) {//= với lệnh if(!isset($_SESSION))
            session_start();
        }
	}
	//Phương thức tĩnh
	public static function set($key, $value){
		$_SESSION[$key] = $value;
	}
	//Phương thức tĩnh
	public static function get($key){
		if(isset($_SESSION[$key])) return $_SESSION[$key];
	}
	//Phương thức tĩnh
	public static function destroy(){
		session_destroy();
	}
}

