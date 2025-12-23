<?php
class Liq_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cek_periode_aktif()
	{
		$singkat_cabang	= $this->session->userdata('singkat_cbg');
		$query	= "SELECT * FROM periode WHERE kdcab='$singkat_cabang' and stsaktif='O'";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	// Ledger_in_Query
	public function get_liq3($bln_aktif, $thn_aktif, $kode_cabang)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM COA WHERE bln='$bln_aktif' and thn='$thn_aktif' AND level='3' and kdcab='$kode_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_liq4($bln_aktif, $thn_aktif, $kode_cabang, $nokir4)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM COA WHERE bln='$bln_aktif' and thn='$thn_aktif' AND no_perkiraan like '$nokir4%' AND level='4' and kdcab='$kode_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_liq5($bln_aktif, $thn_aktif, $kode_cabang, $nokir5)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM COA WHERE bln='$bln_aktif' and thn='$thn_aktif' AND no_perkiraan like '$nokir5%' AND level='5' and kdcab='$kode_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_detailjurnal($bln_aktif, $thn_aktif, $kode_cabang, $nokir5)
	{
		$query = "SELECT * FROM jurnal WHERE year(tanggal) = '$thn_aktif' and month(tanggal) = '$bln_aktif' AND no_perkiraan like '$nokir5%' and nomor like '$kode_cabang%'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_transjurnal($nomor_jurnal)
	{
		$query = "SELECT * FROM jurnal WHERE nomor like '%$nomor_jurnal%'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
