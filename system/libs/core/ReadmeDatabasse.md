		//$db=$this->database; // to use database functions accessing database
 		// $this->db or $this->database->db // used to create own query as $this->db->query("query here");
 		/*$username = $this->database // calling database method we have to use $this->database->method();
 						 ->select()
 						 ->from("table1")
 						 ->where("id=32 AND name='Sanheen'")
 						 ->limit(5,1)
 						 ->get();
 					Created Select Statement
 						 */
 		/*	INSERTING DATA
 		 //$c=$this->database->irun('table1',['lname','id'],['Sanheen','Sethi','']);
 		 
 		 	SELECTING DATA
 		 //$c = $this->database->select()->from('table1')->srun('object');
 		 //$this->load->view('fetchview',['results'=>$c]);
 		 
 		 $c=$this->database->where('id='.$id)->delete('table1');
 		 */
 		/* $u = $this->database->secure($username);
 		 $p = $this->database->secure($password);
 		 $query = $this->database->select()
 		 						 ->from("table1")
 		 						 ->sget();
 		 						 */
 		 						 
 	$this->database->num_rows($query);
 	
 	
 	we also use pdo as change in default/database file driver = mysql ( not defined for others
 	used only mysql and mysqli )
 	mysql use pdo method 
 	
 	pdo will return $this->db as object perform queries as 
 	
 	if wanna use own statements
 	$this->database->prepare();
 	///similar all 
 	
 	TO INSERTING
 	$firstname="Sanheen";
 	$lastname="Sethi";
 	$id='';
 	//$this->database->insert("table1",['fname','lname','id'],[$firstname,$lastname,$id]);
 	
 	
 	/*
 		CRETING OWN QUERY
 		$c=$this->db->prepare("INSERT INTO table1 VALUES(?,?,?)");
 	$c->execute(['Sethi','Saab','']);
 	To run own query we use $this->db->...pdo statements...
 	
 	To run Inbuilt we use $this->database->irun(tablename,columns name in array , values in array)
 	
 	TO SELECTING
 	$this->database->select()
 	->from(tablename)
 	->where(cond.)
 	->orderby(colname,asc|dsc)
 	->srun();
 	*/
 	
 	/*
 	To UPDATE
 	
 	$this->database
 	->where('id=3')
 	->update("table1",['fname','lname'],['Sanheen','Sethi']);*/
 	
 	/* To Delete
 	$this->database->where('id=13')->delete('table1');
 	}				*/
 	
 				  $cs = $this->database 
 				  ->select()
 				  ->from('table1')
 				  ->srun('object');
 				  // all data will be showed by forech loop
 				  
 				  
 				  foreach($cs as $c){
 				  echo $c->fname;
 				  }
 				  
 				  pasa data to view as 
 				  
 				  $this->load->view('viewname',['results'=>$cs]);
 					in view access it as 
 					
 					foreach($results aa $result){
 						echo $result->something ( if fech type is object )
 						echo $result['sonething'] ( if fetch type is array )
 					}