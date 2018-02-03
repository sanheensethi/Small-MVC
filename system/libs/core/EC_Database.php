<?php
defined('BASEPATH') OR die('You cannot Access this page Directly'); 

class EC_Database extends EC_Common{
	public $selectcol=array();
	public $table;
	public $where;
	public $limit;
	public $offset;
	public $orderBy;
	public $insertvalue;
	public $inserttable;
		
		public function secure($data){
		$data = htmlspecialchars(trim($data," "));
		$data = $this->db->real_escape_string($data);
		return $data = $data;
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
		
		public function srun($fetchtype='array',$fetchparam=MYSQLI_BOTH){
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
		
		 $q = join(" ",$query);

			if($result = $this->_selectrun($q,$fetchtype,$fetchparam)){
					return $result;
			}else{
				return false;
			}
		}
		
		public function irun($table,array $columns=[],array $values=[]){
		
			if(count($columns)!=count($values)){
				$error="Error : No. of columns you type didn't match with number of Values you given";
				$this->load->error('404',compact('error'));
				exit();
			}
			foreach($values as $value){
			$vs[] = "'".$this->secure($value)."'";
			}
			
		
		$query[]="INSERT";
		$query[]="INTO";
		$query[]=$table;
		$query[]="VALUES";
		$query[]="(";
		$query[]=join(',',$vs);
		$query[]=")";
		
		$q = join(' ',$query);
		
			if($this->_insertrun($q)){
				return true;
			}else{
				return false;
			}
		
		}
		
		private function _selectrun($query,$fetchtype='array',$fetchparam=MYSQLI_BOTH){ // select run
			
			if($result = $this->db->query($query)){
				if($fetchtype=='array'){
					while($row = $result->fetch_array($fetchparam)){
					$data[]=$row;
				}
					return $data;
			}
			else if($fetchtype=='assoc'){
					while($row = $result->fetch_assoc()){
						$data[]=$row;
					}
					return $data;
			}
			else if($fetchtype=='object'){
					
					while($row = $result->fetch_object()){
						$data[]=$row;
						}
					return $data;
			}
		else{
			$error="You Have To Choose Bewteen array, assoc and object"." By Default its Array Type with MYSQL_BOTH ";
			$this->load->error('404',compact('error'));
		}
		}else{
			$error = $this->db->error;
			$this->load->error('404',compact('error'));
		}
		
		}
		
		private function _insertrun($query){ // insert run
			 if($this->db->query($query)){
			 	return true;
			 }else{
			 	$error = $this->db->error;
			 	$this->load->error('404',compact('error'));
			 }
		}
		
		public function update($table,array $columns=[],array $values=[]){
			if(count($columns)!=count($values)){
				
				$error="Error : Number of  Values do not match with Number of Columns you type";
				$this->load->error('404',['error'=>$error]);
			}
			$i=0;
			foreach($values as $value){
				$data[] = $columns[$i]."='".$this->secure($value)."'";
					$i++;
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
	
		if($this->db->query($q)){
				return TRUE;
		}else{
				echo $this->db->error;
	}
}
		public function delete($table){
			$query[]='DELETE';
			$query[]="FROM";
			$query[]=$table;
				if(!empty($this->where)){
					$query[]="WHERE";
					$query[]=$this->where;
					}else{
						$error="Error : User Where also";
						$this->load->error('404',compact('error'));
					}
			$query=implode(" ",$query);
				if(!empty($query)){
					if($this->db->query($query)){
							return true;
				}else{
						$error = $this->db->error;
						$this->load->error('404',compact('error'));
			}
	}else{
		$error="Unexpected query Null Goes in num_rows function , no arguments passed";
		//var_dump(compact('error'));
		$this->load->error('404',['error'=>$error]);
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
			$query=implode(" ",$query);
			if(!empty($query)){
			if($result = $this->db->query($query)){
				return $result->num_rows;
			}else{
				$error = $this->db->error;
				$this->load->error('404',compact('error'));
			}
			}else{
				$error="Unexpected query Null Goes in num_rows function , no arguments passed";
					//var_dump(compact('error'));
				$this->load->error('404',['error'=>$error]);
			}
		}
		public function __construct(array $db){
			parent::__construct();
			
				$mysqli = @new mysqli($db['host'],$db['username'],$db['password'],$db['dbname']);
			if($mysqli->connect_errno=='0'){
				 return $this->db = $mysqli;
				 //echo "<pre>";
				// print_r($mysqli);
				// print_r($this->database);
				 
			}else{
					$error="Database Connection Error : ".$mysqli->connect_error;
					$this->load->error('404',['error'=>$error]); // or use compacr($error) it creates ['error']=$error;
				 }
	   }
}