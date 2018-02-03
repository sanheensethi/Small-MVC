<?php
define("DS",DIRECTORY_SEPARATOR);
$base_path = __DIR__;
$app_path = DS."app".DS;
$system_path = DS."system".DS;
$model_path = DS."app".DS."model".DS;
$view_path = DS."app".DS."view".DS;
$controller_path = DS."app".DS."controller".DS;
$error_path = DS."system".DS."ERROR".DS;
$lib_path = DS."system".DS."libs".DS;
$core_path = DS."system".DS."libs".DS."core".DS;
$helper_path = DS."system".DS."libs".DS."helper".DS;
$default_path = DS."system".DS."default".DS;
$library_path = DS."system".DS."libs".DS."library".DS;

define("BASEPATH",$base_path);
define("APP",$app_path);
define("SYSTEM",$system_path);
define("MODEL",$model_path);
define("VIEW",$view_path);
define("CONTROLLER",$controller_path);
define("ERROR",$error_path);
define("LIB",$lib_path);
define("CORE",$core_path);
define("HELPER",$helper_path);
define("DEF",$default_path);
define("LIBRARY",$library_path);
// autoload function to load classes
	function __autoload($name){
		require_once BASEPATH.SYSTEM."libs".DS."core".DS.$name.".php";
	}

//Including Main Controller

// Including Main Model

// AUTOLOAD BY Routes abject it calls controller class
// Includeing Default file placed in system/default/default.php
//$default_file = BASEPATH.DEF."default.php";
//$db_file = BASEPATH.DEF."database.php";
	/*if(file_exists($default_file)){
		require_once($default_file);
	}*/
	

// routes are after main_controllers becaise it has main_controller EC_Controller from which all file extends
// Includeing routes.php in system/libs/core/route.php

new EC_Route();
/*
//making array object method 1
$arrs=['one'=>1,'two'=>2];
$obj = json_decode(json_encode($arrs,false));
var_dump($obj);

//method 2
$obj = ( object ) $arrs;

*/

// Includeing main contoller file from which all files extends
/*$main_controller = BASEPATH.SYSTEM."libs/core/EC_Controller.php";
	if(is_file($main_controller)){
			require_once($main_controller);
		}

$main_model = BASEPATH.SYSTEM."libs/core/EC_Model.php";
	if(is_file($main_model)){
			require_once($main_model);
		}*/



?>