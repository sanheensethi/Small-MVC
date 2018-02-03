<?php
defined('BASEPATH') OR die('You cannot Access this page Directly'); 

class EC_PDO_Database extends EC_Common{
	
	public $pdo;
	
	public function irun($table,array $columns=[],array $values=[]){
		if(count($columns)!=count($values)){
			$error="Error : No. of columns do not match with no. of values passed";
			$this->load->error('404',compact('error'));
			exit();
		}
		$matches = count($values);
		for($i=0;$i<$matches;$i++){
			$cols[]="?";
		}
		$query[]="INSERT";
		$query[]="INTO";
		$query[]=$table;
		$query[]="VALUES";
		$query[]="(";
		$query[]=implode("," ,$cols);
		$query[]=")";
		$p_statement = join(" ",$query); // prepared statement
			
			if($this->_insertrun($p_statement,$values)){
				return true;
			}else{
				return false;
			}
		
	
	}
	private function _insertrun($query,array $values){
	
		$stmt = $this->pdo->prepare($query);
		
		try{
			$stmt->execute($values);
			return true;
		}catch(PDOException $e){
			$error="Error : ".$e->getMessage();
			$this->load->error('404',compact('error'));
		}
		
	}
	public function select(array $arr=['*']){
		$this->selectcol=$arr;
		return $this;
	}
	
	public function from($table){	
		$this->table=$table;
		return $this;
	}
	
	public function where($where){
		$this->where=$where;
		return $this;
	}
	
	public function limit($limit,$offset=0){
		$this->limit=$limit;
		$this->offset=$offset;
		return $this;
	}
	
	public function orderby($x,$y='ASC'){
		$this->orderByvar=$x;
		$this->ordedBy=$y;
		return $table;
	}
		
	public function srun($fetchtype='both'){
		$query[]="SELECT";
		if(empty($this->selectcol)){
			$query[]="*";
		}
		else{
			$query[]=join(',',$this->selectcol);
		}
		
		$query[]="FROM";
		$query[]=$this->table;
		
		if(!empty($this->where)){
			$query[]="WHERE";
			$query[] = $this->where;
		}
		
		if(!empty($this->orderByvar)){
			$query[]="ORDER BY";
			$query[] = $this->orderByvar." ".$this->orderBy;
		}
		
		if(!empty($this->limit)){
			$query[]="LIMIT";
			$query[]=$this->limit.",".$this->offset;
		}
		
		$q = join(' ',$query);
		
		 if($this->_selectrun($q,$fetchtype)){
		 		return $this->_selectrun($q,$fetchtype);
		 }else{
		 		return FALSE;
		 }
			
		
	}
	
	private function _selectrun($query,$fetchtype){
		
		$stmt=$this->pdo->prepare($query);
		
		try{
			$stmt->execute();
			if($fetchtype=='bound'){
				$stmt->setFetchMode(PDO::FETCH_BOUND); 
			}
			else if($fetchtype=='assoc'){
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
			}
			else if($fetchtype=='array'){
				$stmt->setFetchMode(PDO::FETCH_NUM);
			}
			else if($fetchtype=='both'){
				$stmt->setFetchMode(PDO::FETCH_BOTH);
			}
			else if($fetchtype=='object'){
				$stmt->setFetchMode(PDO::FETCH_OBJ);
			}
			
				return $result = $stmt->fetchAll();
			
		}catch(PDOException $e){
			$error="Error : "."<br>Your Query : ".$query."<br>".$e->getMessage();
			$this->load->error('404',compact('error'));
		}
	}
	
	public function update($table,array $columns=[],array $values=[]){
		if(count($columns)!=count($values)){
			$error="Error : No. of columns do not match with no. of values passed";
			$this->load->error('404',compact('error'));
			exit();
		}
		count($columns);
		foreach($columns as $column){
			$data[] = $column."=".'?'."";
		}
		
		
		$query[]="UPDATE";
		$query[]=$table;
		$query[]="SET";
		$query[]=implode(",",$data);
			if(!empty($this->where)){
				$query[]="WHERE";
				$query[]=$this->where;
			}else{
				$error="You have to use Where Condition";
				$this->load->error('404',compact('error'));
				exit();
			}
		
		$q = implode(" ",$query);
			
		if($this->_updaterun($q,$values)){
			return TRUE;
		}else{
			return FALSE;
			}
	}
	
	private function _updaterun($query,array $values){
		$stmt = $this->pdo->prepare($query);
		try{
			$stmt->execute($values);
			return true;
			}catch(PDOException $e){
				$error="You Have Error.<br>"."Message : ".$e->getMessage();
				$this->load->error('404',compact($error));
			}
	}
	
	public function delete($table){
		$query[]="DELETE";
		$query[]="FROM";
		$query[]=$table;
			if(!empty($this->where)){
				$query[]="WHERE";
				$query[]=$this->where;
			}
		   else{
		   		$error="You Have An Error. Use Where Clause";
		   		$this->load->error('404',compact('error'));
		   		exit();
		   }
		$q=implode(" ",$query);
		if($this->_deleterun($q)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function _deleterun($query){
			$stmt = $this->pdo->prepare($query);
			try{
				$stmt->execute();
				return true;
			   }catch(PDOException $e){
			   		$error="Error: ".$e->getMessage();
			   		$this->load->error('404',$error);
			   		exit();
			   }
		}
		
	public function num_rows($table){
		$query[]='SELECT';
		$query[]='count(*)';
		$query[]="FROM";
		$query[]=$table;
			if(!empty($this->where)){
				$query[]="WHERE";
				$query[]=$this->where;
			}
			$q=implode(" ",$query);
		$stmt=$this->pdo->prepare($q);
		try{
			$stmt->execute();
			$c = $stmt->fetchAll();
			return $c[0]['count(*)'];
		}catch(PDOException $e){
			$error="Error : ".$e->getMessage();
			$this->load->error('404',compact($error));
		}
	}
	public function __construct(array $db){
	parent::__construct();
	//echo $db['driver'].":"."dbname=".$db['dbname'].";host=".$db['host'];exit();
	try{
		$pdo = @new PDO($db['driver'].":"."dbname=".$db['dbname'].";host=".$db['host'],$db['username'],$db['password']);
			 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->pdo = $pdo;
	}catch(PDOException $e){
		$error="Database Connection Error : ".$e->getMessage();
		$this->load->error('404',['error'=>$error]); // or use compacr($error) it creates ['error']=$error;
	}
  }
}