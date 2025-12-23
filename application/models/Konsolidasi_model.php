<?php

class Konsolidasi_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_cabang()
	{

		$query 	= "SELECT * FROM pastibisa_tb_cabang";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa($bln, $thn)
	{

		$query 	= "SELECT * FROM coa where bln='$bln' and thn='$thn' group by kdcab";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_coa2($bln, $thn)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa where kdcab= '$kode_cabang' and bln='$bln' and thn='$thn' group by kdcab";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_periode_aktif()
	{
		$singkat_cbg = $this->session->userdata('singkat_cbg');
		$query 	= "SELECT * FROM periode WHERE stsaktif='O' and kdcab='$singkat_cbg'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
