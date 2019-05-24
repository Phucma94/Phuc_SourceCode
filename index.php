<?php
require_once  './configs/general.php';
    function __autoload($clasName){
        require_once LIBRARY_PATH . "{$clasName}.php";
    }
$bootstrap = new Bootstrap();
$bootstrap->init();