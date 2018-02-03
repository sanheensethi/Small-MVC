<?php
defined('BASEPATH') OR die('You cannot Access this page Directly'); 

class EC_Model extends EC_Common{
//	public $db;
	public $database;
	public function __construct(){
		parent::__construct();
		require BASEPATH.DEF."database.php";
	if($db['driver']=='mysqli'){
		 $this->database = new EC_Database($db); // creating new database object
		 return $this->db = $this->database->db; // copy and returning value in db variable of inner db object which is in database object comes from EC_Database Contructor Function
	}
	else if($db['driver']=='mysql'){
			$this->database = new EC_PDO_Database($db);
			return $this->db = $this->database->pdo;
	}
	else{
		$error="Unexpected Database Driver : go to default database file";
		$this->load->error('404',compact('error'));
	}
	}
	
	public function load($filename){
		 if(is_file(BASEPATH.MODEL.$filename.'model.php')){
			require BASEPATH.MODEL.$filename.'model.php';
			$co=$filename."model"; // creating model fullname as if we load('user') creating it usermodel object
			return new $co();
		 }
		 else{
		 	$error="Model Not Found";
		 	$this->load->error('404',compact('error'));
		 }
	}
}

?>