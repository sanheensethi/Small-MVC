<?php

class Loginmodel extends EC_Model {
 	
 	public function login_check($username,$password){
 		//$c=$this->database->irun('table1',['lname','id'],['Sanheen','Sethi','']);
 		//$c = $this->database->select()->from('table1')->srun('object');
 				//$this->load->view('fetchview',['results'=>$c]);
 	
 		$results=$this->database->select()
 						  ->from('table1')
 						  ->srun('object');
 		
 		$this->load->view('fetchview',compact('results'));
 		
 	}
}

?>