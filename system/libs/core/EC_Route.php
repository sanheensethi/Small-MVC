<?php
defined('BASEPATH') OR die("Can't Access to that Page");
	
class EC_Route extends EC_Common{	

public function __construct(){
	parent::__construct();
	if(isset($_GET['url'])):
	
		$default_file = BASEPATH.DEF."default.php";
		if(file_exists($default_file)){
		require_once($default_file);
		}
		
		
		$url = rtrim($_GET['url'],DS); // DS : DIRECTORY SAPARATOR DEFINED IN index.php
		$url = explode("/",$url);
		$controller = (isset($url[0]) && $url[0]!='') ? $url[0] : $default['controller'];
		$controller = ucfirst($controller);
			 if(is_file(BASEPATH.CONTROLLER.$controller.".php")){
			 	require BASEPATH.CONTROLLER.$controller.".php";
	 	
			 	$method = (isset($url[1]) && $url[1] != '') ? $url[1] : $default['method']; // by defalut goes to index method
			 	$param = (isset($url[2]) && $url[2] != '') ? $url[2] : false; // parameters if not define then its false return 0
	 					
	 				
				 	if(class_exists($controller)){ // check class exists or not
				 		$c = new $controller();
			 			if(method_exists($c,$method)){ // check method exixts or not
			 				$c->$method($param);	
	 			}else{
	 				$error="Error : "."Method Not Found";
	 			 	 $this->load->error('404',compact('error'));
	 			}
	 	}else{
					$error="Error : "."Class Not Found";
	 			 	 $this->load->error('404',compact('error'));
	 	}
	 }
	 else
	 {
	 	  $error="Error : "."Controller Not Found";
	 	  $this->load->error('404',compact('error'));
	 }
			endif;
	}
}
?>