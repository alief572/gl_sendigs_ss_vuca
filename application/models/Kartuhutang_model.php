<?php
class Kartuhutang_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function GetData($awal,$vendor){
		$query 	= "SELECT sum(kredit - debet) as saldo
		FROM kartu_hutang WHERE tanggal < '$awal' AND id_supplier='$vendor' ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
		$query = $this->db->get();
		if($query->num_rows() != 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	function GetSaldoRekap($awal,$vendor){
		$query 	= "SELECT sum(kredit - debet) as saldo
		FROM kartu_hutang WHERE tanggal < '$awal' AND id_supplier='$vendor' ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
		$query = $this->db->get();
		if($query->num_rows() != 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function get_detail_kartu_hutang($awal,$akhir,$vendor)
	{
		$query 	= "SELECT * from kartu_hutang WHERE id_supplier='$vendor' AND tanggal BETWEEN '$awal' AND '$akhir' ";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	public function GetVendor(){
		//$query = $this->db->get(DBACC.".ms_vendor");
		$query 	= "SELECT * from kartu_hutang GROUP BY id_supplier ";

		$query	= $this->db->query($query);
	    if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}

	}
	
	public function get_rekap_kartu_hutang($awal,$akhir,$vendor)
	{
		$query 	= "SELECT (SELECT sum(kredit)-sum(debet) as saldo
		FROM kartu_hutang WHERE tanggal < '$awal' AND id_supplier='$vendor') AS saldo_awal,
		sum(debet) as debet, sum(kredit) as kredit, sum(kredit)-sum(debet) as saldo_akhir 
		from kartu_hutang WHERE id_supplier='$vendor' AND tanggal BETWEEN '$awal' AND '$akhir' ";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	function GetDataUmur($awal,$akhir,$vendor){
		$query 	= "SELECT no_reff FROM kartu_hutang WHERE id_supplier='$vendor' GROUP BY no_reff";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
		$query = $this->db->get();
		if($query->num_rows() != 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
		
	public function get_detail_umur_kartu_hutang($awal,$akhir,$vendor,$bukti )		
	{
		$query 	= "SELECT 
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND datediff('$akhir', tanggal)  BETWEEN 0  AND 30 GROUP BY no_reff ORDER BY tanggal DESC) AS saldo30,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) BETWEEN 31  AND 60) GROUP BY no_reff ORDER BY tanggal DESC) AS saldo31,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) BETWEEN 61  AND 90) GROUP BY no_reff ORDER BY tanggal DESC) AS saldo60,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) BETWEEN 91  AND 120) GROUP BY no_reff ORDER BY tanggal DESC) AS saldo90,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) > 120) GROUP BY no_reff ORDER BY tanggal DESC) AS saldo120,
		
		tanggal,keterangan,no_request from kartu_hutang WHERE no_reff = '$bukti' AND id_supplier='$vendor' GROUP BY no_reff  ORDER BY tanggal DESC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	public function get_rekap_umur_kartu_hutang($vendor)		
	{
		$query 	= "SELECT 
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND datediff(current_date(), tanggal) < 31 GROUP BY id_supplier) AS saldo30,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND (datediff(current_date(), tanggal) BETWEEN 31  AND 60) GROUP BY id_supplier) AS saldo31,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND (datediff(current_date(), tanggal) BETWEEN 61  AND 90) GROUP BY id_supplier) AS saldo60,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND (datediff(current_date(), tanggal) BETWEEN 91  AND 120) GROUP BY id_supplier) AS saldo90,
		(SELECT sum(kredit)-sum(debet) as saldo FROM kartu_hutang WHERE id_supplier='$vendor' AND datediff(current_date(), tanggal) > 120 GROUP BY id_supplier) AS saldo120,
		tanggal,keterangan,id_supplier,nama_supplier FROM kartu_hutang WHERE  id_supplier='$vendor' GROUP BY id_supplier ";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	function GetDataBukti(){
		$query 	= "SELECT no_reff, id_supplier, nama_supplier FROM kartu_hutang GROUP BY no_reff";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
		$query = $this->db->get();
		if($query->num_rows() != 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	
	public function get_umur_hutang($vendor)		
	{
		$query 	= "SELECT id_supplier, nama_supplier, sum(saldo30) as saldo30,sum(saldo31) as saldo31,sum(saldo90) as saldo90, sum(saldo120) as saldo120, sum(saldo120plus) as saldo120plus
		FROM umur_hutang GROUP BY id_supplier ";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	

}