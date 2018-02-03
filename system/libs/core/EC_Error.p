<?php
defined('BASEPATH') OR die('You cannot Access this page Directly'); 

class EC_Error{
	
	public function load($filename){
		if(is_file(BASEPATH.ERROR.$filename.".php")){
			require_once BASEPATH.ERROR.$filename.".php";
			return true;
		}
		else{
		    return false;
		}
	}
}

?>