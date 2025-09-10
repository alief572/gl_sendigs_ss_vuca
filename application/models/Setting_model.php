<?php 

	class Setting_model extends CI_Model{

		public function __construct(){

			parent::__construct();

			$this->load->database(); 

		}

		public function get_cabang(){	
		
			$query 	= "SELECT * FROM pastibisa_tb_cabang";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function get_cabang2($cabang_pilihan){	
		
			$query 	= "SELECT * FROM pastibisa_tb_cabang WHERE kdcab='$cabang_pilihan'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function cek_periode($cabang_pilihan){	
		
			$query 	= "SELECT * FROM periode WHERE kdcab='$cabang_pilihan' AND stsaktif='O'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
	}

?>