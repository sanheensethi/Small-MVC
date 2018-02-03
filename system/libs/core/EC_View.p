<?php
defined('BASEPATH') OR die('You cannot Access this page Directly'); 

class EC_View extends EC_Common{
	
	public function load($filename){
	
		if(is_file(BASEPATH.VIEW.$filename.".php"))
		{
			require_once BASEPATH.VIEW.$filename.".php";
			return true;
		}
		else{
			$this->load->error('404');
		}
	}
	
	public function __construct(){
		parent::__construct();
	}
}
?>