<?php
/*
Package : SmallMVC Framework
Created By : Sanheen Sethi
Date : 03/02/2018
Time : 14:15 IST
*/

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
	function __autoload($name){
		require_once BASEPATH.SYSTEM."libs".DS."core".DS.$name.".php";
	}
new EC_Route();
?>