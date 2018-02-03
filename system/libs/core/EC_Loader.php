<?php
defined('BASEPATH') OR die('You Are not Allowed to Access This Page');
class EC_Loader{
	
	public function view($filename,array $datas=[]){
		if(!empty($datas)){ 
			foreach($datas as $key=>$data){// creating key variables
				$$key=$data;
			}
			// or use extract(arrayname)
		}
		if(is_file(BASEPATH.VIEW.$filename.".php"))
		{
			require_once BASEPATH.VIEW.$filename.".php";
			return true;
		}else{
			$error=" View Error : File Not Found";
			$this->error('404',compact('error'));
		}
	}
	
	public function model($filename){
		$c = new EC_Model();
		return $c->load($filename);
	}
	
	public function error($filename,array $datas=[]){
		if(!empty($datas)){ 
			foreach($datas as $key=>$data){// creating key variables
				$$key=$data;
			}
		// or use extract(arrayname)
		}
		if(is_file(BASEPATH.ERROR.$filename.".php")){
			require_once BASEPATH.ERROR.$filename.".php";
			return true;
		}
		else{
			return false;
		}
	}
	
	public function helper($filename){
		if(is_file(BASEPATH.HELPER.$filename.".php")){
			require_once BASEPATH.HELPER.$filename.".php";
			return true;
		}
		else{
			return false;
		}
	}
	
	public function library($filename){
		if(is_file(BASEPATH.LIBRARY.$filename.".php")){
			require_once BASEPATH.LIBRARY.$filename.".php";
			return new $filename();
		}
		else{
			return false;
		}
	}
}
?>