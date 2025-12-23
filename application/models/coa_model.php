<?php 
	class coa_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		
//======================================================= stock =======================================
public function stock(){		
	$query	= "select * from COA";
	$query 	= $this->db->query($query);
	if($query->num_rows() > 0){
		return $query->result();
	}else{
		return 0;
	}
}
public function list_stock($id){		
	$query	= "select * from COA where id='$id'";
	$query 	= $this->db->query($query);
	if($query->num_rows() > 0){
		return $query->result();
	}else{
		return 0;
	}
}


	}
?>

 