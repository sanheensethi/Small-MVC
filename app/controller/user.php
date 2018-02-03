<?php 
 class User extends EC_Controller {
  
  public function index(){
  	if($this->load->view('user/login')){
  		$this->load->view('user/login');
  		$c = $this->load->model('user');
  		$c->India();
  		}
  	else{
  		$this->load->view('404');
  	}
  }
  
  
  public function __construct(){
  	parent::__construct();
  }
 }