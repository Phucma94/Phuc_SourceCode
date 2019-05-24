<?php
// ====================== PATHS ===========================
//Đường dẫn tuyệt đối
//DS="\"
define ('DS'				, DIRECTORY_SEPARATOR);
//ROOT_PATH=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v2
define ('ROOT_PATH'			, dirname(dirname(__FILE__)));
//LIBRARY_PATH=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\libs\
define ('LIBRARY_PATH'		, ROOT_PATH . DS .'app'.DS. 'Libs' . DS);
//CONTROLLER_PATH=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\Controllers\
define ('CONTROLLER_PATH'	, ROOT_PATH . DS .'app'.DS. 'Controllers' . DS);
//MODEL_PATH=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\Models\
define ('MODEL_PATH'		, ROOT_PATH . DS .'app'.DS. 'Models' . DS);
//VIEW_PATH=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\Views\
define ('VIEW_PATH'			, ROOT_PATH . DS .'app'.DS.  'Views' . DS);
//PUBLIC_PATH=C:\xampp\htdocs\KhoaHoc\ZendVn\ch10\mvc_v1\public\
define ('PUBLIC_PATH'		, ROOT_PATH . DS .'app'.DS.  'Public' . DS);

//Đường dẫn tương đối
define ('ROOT_URL'          ,'http://localhost/KhoaHoc/ZendVn/ch10/mvc_v2');
define	('PUBLIC_URL'			,ROOT_URL.DS.'assets'.DS);
define	('VIEW_URL'			, ROOT_URL . DS .'app'.DS. 'Views' . DS);
// ====================== DATABASE ===========================
define ('DB_HOST'			, 'localhost');
define ('DB_USER'			, 'root');
define ('DB_PASS'			, '');
define ('DB_NAME'			, 'manage_user');
define ('DB_TABLE'			, 'user');
