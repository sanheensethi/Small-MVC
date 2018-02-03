<?php

class Request{
	
	public function post($name=''){
		if(isset($name) && $name!=''){
			return $_POST[$name];
			}
		else{	
			return $_POST;
		}
	}
	
	public function get($name=''){
		if(isset($name) && $name!=''){
			return$_GET[$name];
		}
		else{	
			return $_GET;
		}
	}
	
	public function request($name=''){
		if(isset($name) && $name!=''){
				return$_REQUEST[$name];
		}
		else{	
				return $_REQUEST;
		}
	}
}
?>