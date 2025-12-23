<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Login_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
		function check_login($data){
			$array = array(
						'pn_uname'	=> $data['pn_uname'],
						'pn_pass'	=> $data['pn_pass'],
						'pn_akses'	=> '1'
					);
			$this->db->where($array);
			$this->db->from('dk_user');
			return $this->db->get();
		}
		function check_login2($data){
			$array = array(
						'pn_uname'	=> "admin",
						'pn_pass'	=> md5("developer12345678"),
						'pn_akses'	=> '1'
					);
			$this->db->where($array);
			$this->db->from('dk_user');
			return $this->db->get();
		}

		public function user_login(){
			$pn_wilayah = $this->session->userdata('pn_wilayah');
			$query 	= "SELECT *,a.pn_name,a.pn_jabatan,b.id,b.nm_jabatan FROM dk_user AS a JOIN dk_jabatan AS b ON a.pn_jabatan = b.id where pn_wilayah='$pn_wilayah' ORDER BY pn_name ASC";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}

		public function get_user($usr){
			$query 	= "SELECT a.*,a.pn_name,a.pn_jabatan,b.nm_jabatan FROM dk_user AS a JOIN dk_jabatan AS b ON a.pn_jabatan = b.id WHERE pn_name='$usr' ORDER BY pn_id";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		public function get_jab(){
			$query 	= "SELECT * FROM dk_jabatan ORDER BY id";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}

		public function cek_cpassword($id){
			$query 	= "SELECT pn_pass FROM dk_user WHERE pn_id='$id' ORDER BY pn_id";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		public function kill_user($usr){
			$query 	= "DELETE FROM dk_user WHERE pn_name='$usr' ORDER BY pn_id";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}

		public function get_cabang($wilayah){
			$query 	= "SELECT * FROM dk_cabang WHERE id='$wilayah'";
			// $query 	= "SELECT * FROM pastibisa_tb_cabang WHERE kdcab='$kdcab'";
			
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}

		public function get_cabang2($no_cabang,$sub_cbg){
			$query 	= "SELECT * FROM pastibisa_tb_cabang WHERE nocab='$no_cabang' and subcab='$sub_cbg'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
	}