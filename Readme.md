 SmallMVC Framework

 This content is released under the MIT License (MIT)

 Copyright (c) 2018 , Sanheen Sethi

 Permission is hereby granted, free of charge, to any person obtaining a copy
 of this software and associated documentation files (the "Software"), to deal
 in the Software without restriction, including without limitation the rights
 to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 copies of the Software, and to permit persons to whom the Software is
 furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be included in
 all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 THE SOFTWARE.

 * @package SmallMVC Framework
 * @author	Sanheen Sethi
 * @copyright	Copyright (c) 2018, Sanheen Sethi
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://github.com/sanheensethi
 * @since	version 1.0.0
 * @version	version 1.0.1
 * @filesource
 * @Date : 03-02-2018
 * @Time : 2:15 PM

Description : 

	In Index Page , Firsly defined some paths of folder
	● Base Path ( A folder in which all other folders and index file placed )
	● App Path ( A folder in which our model , view , controller areplaced )
	● System Path ( A folder in which all the library files are placed ) ( Most Important ! Not Recommend to Delete )
	● Model Path ( app/model )
	● View Path ( app/view )
	● Controller Path ( app/controller)
	● Error Path ( system/Error ) <- In this you can make your own error files we will discuss how to load them later
	● LIB Path ( system/libs ) <- system files are there
	● CORE Path ( system/libs/core ) <- folder in which all routing, accessing files , database files included 
	● LIBRARY Path ( system/libs/library) <- folder in which library files will be placed
	● HELPER Path ( system/libs/helper ) <- folder in which all helpers will be placed including 3rd party
	● Default Path ( system/default ) <- folder in which we define about default controllers , methods , and something about databases
	
In Extra : 
	
	● DS -> It is directory Seperator { "/" or "\" }
	
In System folder there is a loaded who loads views , models , libraries , helpers as :

	● $this->load->view('viewname');
	● $this->load->model('modelname');
	● $this->load->library('libraryname');
	● $this->load->helper('helpername');
	● $this->load->error('errorname');
	
Database Functions : 

first we have to open the file system/default/database.php 
write driver which you wanna use 
NOTE : mysqli , mysql supported

Methiod 1 : Using Your own statements as 
	
	> $this->db->secure($data); { if you are using mysqli needed this }
		It makes the data secure then use mysqli object as 
			
			$this->database->query(); { in mysqli }
	
	> $c = $this->db->prepare(); { if you wanna use pdo mysql }
		.
		.
		.
		.
	  $c->execute();
	 
Method 2 : Using Inbuilt Functions { Works in both PDO and MYSQLI object }

   > Insert :
    
      $this->database->irun('tablename',['col1name','col2name'....],['val1','val2'....]);
      			- irun = insert run
      e.g. => $this->database->irun('user',['firstname','lastname','id'],['Sanheen','Sethi','']);
      					- id is null because its auto_increment in database
      
   		[ Return Type : true , false ]
   
   > Update :
     
      whatever you put data is always secured : 
     	
      $this->database->where(condition)->update('tablename',['col1','col2',....],['val1','val2',....]);
      
      e.g. => $this->database->where("id=2 AND name='Sanheen'")->update('user',['firstname'],['Shubham']);
	
   	  [ Return Type : true , false ]
   
   > Select : 
   		
			$this->database->select()
						   ->from('tablename')
						   ->where("condition")
						   ->orderby('colname',ASC|DSC)
						   ->srun();

				- srun = select run

				srun have default array type as ->srun('array');
				have also other selectable parameters like { array , assoc , object }

								● ->srun('array') <- default as ->srun()
								● ->srun('assoc')
								● ->srun('object')

				[ Have Return type Array using { foreach loop } we display them ]
   					
   > Delete : 
   	
				$this->database->where("condition")->delete('tablename');

				[ Return type : true , false ]
   	        
   > Number Of Rows :
   	
				  ● $this->database->num_rows('tablename');
				  ● $this->database->where('condition')->num_rows('tablename');

				  [ Return Type : Integer value]
   	          
   	
   > Loading Error : 
		
		Error files will be placed in system/ERROR folder 
		All the error files should be in .php extension
		error file have should this 
		 {  <?= $error; ?>  } <- display error , variable name is same as you define on time of data passing

		creating and loading error : 
		
		$error = "Error Message";
		
		● $this->load->error('error_file_name',compact('error')); => compact() is PHP function google it if you dont know
		● $this->load->error('error_file_name',['error'=>$error]); 
		
		on passing data the array have keys and values , keys become variables in error files or view files
	
	
	error file will be like this :- 
				
				<html>
					<head>
						---styles---
						---scripts---
					</head>
					<body>
						<h1>Error :</h1>
						<?= $error; ?>
					</body>
				<html>
				
View : 
			
	view files are placed in app/view

	same thing as we did with error file 
	extension should be .php

	we pass data in views as -> $this->load->view('viewname',['data'=>$data]);
	or use compact function as explained in error loading

Controllers : 

	make it in app/controllers

	name the file as you want
	type in url as { index.php?url=controllername/methodname/parameters }

	controller extends with { EC_Controller }
	e.g. => 

	app/controller/user.php
	
			class User extends EC_Controller{
				public function index(){
					
				}
				
				public function login(){
					
				}
			}
			
Models : 

		These are in app/models
		name model file as "Yourfilename"model.php -> e.g => Loginmodel.php

		in Loginmodel.php

		class Loginmodel extends EC_Model{
			// do work 
			// database is autoloaded $this->database // to use inbuilt funtions 
									  $this->db // id you dont want to use inbuilt function use by own as explained above		
			// use functionality here of databases
		}

		load model as in controllers as 
		
		$this->load->model('yourfilename'); -> e.g. => $this->load->model('login'); do not use "model" in writing name as time of loading that

URL Helper : 

		you can use url helper to use css, js , images or extra files in your "view" .. dont need to load , it autoloads in every view

		<?= uri(assests/css/bootstrap.min.css); ?> <- It will print the full path as https://hostname.whatever/assests/css/bootstrap.min.css where assests is the folder placed where index.php file is placed
	> Used as : 
		
		* <link rel="stylesheet" href="<?= uri('assests/css/boitstrap.min.css'); ?>">
		
		* <script type="text/javascript" src="<?= uri('assests/js/jquery.min.js'); ?>"></script>
		
		* <img src="<?= uri('assests/images/image.png'); ?>">