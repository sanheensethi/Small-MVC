<?php

class Login extends EC_Controller{
	
	public function index(){
	
		//$this->load->view('loginview');
		$c = $this->load->library('Request');
		//var_dump($c);
		$u="hello";
		$p="sethi";
		/*$u = $c->post('username');
		$p = $c->post('password');
		//$p = $c->post('password');*/
		$m=$this->load->model('login');
		/*var_dump($m);*/
		$m->login_check($u,$p);
	}
}

?>