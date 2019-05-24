<?php
    //$cssURL=\mvc_v1\public\css\
	$cssURL	= PUBLIC_URL.'css'. DS;
	//$jsURL=\mvc_v1\public\js\
	$jsURL	= PUBLIC_URL . 'js' . DS;
	Session::init();//Nhảy đến hàm_autoload để require rồi nhảy đến phương thức tĩnh
	//Nhấn Home->url=Index.php?controller=index&action=index
	$menu = '<a class="index" href="index.php?controller=index&action=index">Home</a>';
	if(Session::get('loggedIn') == true){//==0
		$menu .= '<a class="group" href="index.php?controller=group&action=index">Group</a>';
		$menu .= '<a class="user" href="index.php?controller=user&action=logout">Logout</a>';
	}
	//$menu=<a class="index" href="Index.php?controller=index&action=index">Home</a><a class="user" href="Index.php?controller=user&action=login">Login</a>
	else{
		$menu .= '<a class="user" href="index.php?controller=user&action=login">Login</a>';
	}
	// JS
    $fileJs = '';
	if(!empty($this->js)){
        foreach($this->js as $js) {
            $fileJs .= '<script type="text/javascript" src="'.VIEW_URL.$js.'"></script>';
        }
}
    // CSS
    $fileCss = '';
    if(!empty($this->css)){
        foreach($this->css as $css) {
            $fileCss .= '<link rel="stylesheet" type="text/css" href="'.VIEW_URL.$css.'">';
        }
    }
	// TITLE
    //MVC
	$title = isset($this->title) ? $this->title : 'MVC';
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssURL?>style.css">
    <!--Nhúng tập tin jquery-->
    <script type="text/javascript" src="<?php echo $jsURL?>jquery.js"></script>
    <!--Nhúng tập tin custom:Do dev viết-->
    <script type="text/javascript" src="<?php echo $jsURL?>custom.js"></script>
    <?php echo $fileJs . $fileCss;?>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h3>Header</h3>
        <?php echo $menu;?>
    </div>
