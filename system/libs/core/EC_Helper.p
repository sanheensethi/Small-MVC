<?php
defined('BASEPATH') OR die('You cannot Access this page Directly'); 

class EC_Helper{
	public function load($filename){
		 if(is_file(BASEPATH.HELPER.$filename.".php")){
		 	require_once BASEPATH.HELPER.$filename.".php";
		 	return true;
		 	}
		 else{
		 	return false;
		 }
	}
	
	
}
?>