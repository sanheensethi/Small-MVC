<?php
defined("BASEPATH") OR die("Not access directly");
	
	
class EC_Controller extends EC_Common{
	 
		
	public function __construct()
	{
		$this->load = new EC_Loader();
	}
}

?>