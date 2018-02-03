<?php
defined('BASEPATH') OR die('You cannot Access this page Directly'); 

class EC_Common{
	//protected $error;
	//protected $helper;
	public function __construct(){
		/*$this->error = new EC_Error();
		$this->helper = new EC_Helper();*/
		$this->load = new EC_Loader();
	}
}
?>