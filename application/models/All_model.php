<?php 
	class All_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		public function log_login($pn_id,$pn_uname,$pn_jabatan,$pn_wilayah){			
			$data 		= array(
				'pn_id'=>$pn_id,
				'pn_name'=>$pn_uname,
				'pn_jabatan'=>$pn_jabatan,
				'pn_wilayah'=>$pn_wilayah,
				'waktu_login'=>date("Y-m-d H:i:s")
			);
			$this->db->insert('dk_log_akses',$data);
		}
	}
?>