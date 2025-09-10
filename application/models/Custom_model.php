<?php 
	class Custom_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function get($select,$table,$where){		
			$query	= "select $select from $table $where";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
	}
?>