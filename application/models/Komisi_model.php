<?php 
	class Komisi_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
	public function get_komisi_gedung(){
		$query = $this->db->query("select * from dk_po_gedung where sts='1' order by insert_date desc");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	
	
	public function get_komisi_vendor(){
		$query = $this->db->query("select * from dk_po_vendor where sts='1' order by insert_date desc");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	public function get_komisi_sales(){
		$query = $this->db->query("select * from dk_bayar where jenis='KARYAWAN' order by bayar_date desc");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	public function get_data_karyawan(){
		$query = $this->db->query("select nosales,nama from dk_master_salesman");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	public function get_bayar($id){
		$query = $this->db->query("select sum(bayar) as sss from dk_bayar where id_req='$id'");
		if($query->num_rows() > 0){
			$return=$query->result();
			return $return[0]->sss;
		}else{
			return 0;
		}
	}
	
	public function get_id_req(){
		$query = $this->db->query("select c_request_sales from dk_counter");
		if($query->num_rows() > 0){
			$return=$query->result();
			return $return[0]->c_request_sales;
		}else{
			return 0;
		}
	}
	
	public function get_data_vendor($id){
		$query = $this->db->query("select * from dk_po_vendor where id='$id'");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	public function get_data_gedung($id){
		$query = $this->db->query("select * from dk_po_gedung where id='$id'");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
}