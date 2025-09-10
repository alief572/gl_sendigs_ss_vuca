<?php
class Kartupiutang_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function GetData($awal,$vendor){
		$query 	= "SELECT sum(debet-kredit) as saldo
		FROM kartu_piutang WHERE tanggal < '$awal' AND id_supplier='$vendor' ";
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
	
	function GetDataPiutangAll($awal,$akhir){
		$query 	= "SELECT sum(debet-kredit) as saldo
		FROM kartu_piutang WHERE tanggal BETWEEN  '$awal' AND '$akhir' ";
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
	
	public function get_detail_kartu_piutang($awal,$akhir,$klien)
	{
		
		if($klien=='0'){
			$query 	= "SELECT * from kartu_piutang WHERE tanggal BETWEEN '$awal' AND '$akhir' ";
		}else{
			$query 	= "SELECT * from kartu_piutang WHERE id_supplier='$klien' AND tanggal BETWEEN '$awal' AND '$akhir' ";
		}

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	public function GetKlien(){
		//$query = $this->db->get(DBACC.".ms_vendor");
		$query 	= "SELECT * from kartu_piutang GROUP BY id_supplier ";

		$query	= $this->db->query($query);
	    if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}

	}
	public function get_rekap_kartu_piutang($awal,$akhir,$vendor)
	{
		$query 	= "SELECT (SELECT sum(debet)-sum(kredit) as saldo
		FROM kartu_piutang WHERE tanggal < '$awal' AND id_supplier='$vendor') AS saldo_awal,
		sum(debet) as debet, sum(kredit) as kredit, sum(debet)-sum(kredit) as saldo_akhir 
		from kartu_piutang WHERE id_supplier='$vendor' AND tanggal BETWEEN '$awal' AND '$akhir' ";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	function GetDataUmur($awal,$akhir,$vendor){
		$query 	= "SELECT no_reff FROM kartu_piutang WHERE id_supplier='$vendor' GROUP BY no_reff";
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
	
		
	public function get_detail_umur_kartu_piutang($awal,$akhir,$vendor,$bukti )		
	{
		$query 	= "SELECT 
		(SELECT sum(debet)-sum(kredit) as saldo FROM kartu_piutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND datediff('$akhir', tanggal) BETWEEN 0 AND 30 GROUP BY no_reff) AS saldo30,
		(SELECT sum(debet)-sum(kredit) as saldo FROM kartu_piutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) BETWEEN 31  AND 60) GROUP BY no_reff) AS saldo31,
		(SELECT sum(debet)-sum(kredit) as saldo FROM kartu_piutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) BETWEEN 61  AND 90) GROUP BY no_reff) AS saldo60,
		(SELECT sum(debet)-sum(kredit) as saldo FROM kartu_piutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) BETWEEN 91  AND 120) GROUP BY no_reff) AS saldo90,
		(SELECT sum(debet)-sum(kredit) as saldo FROM kartu_piutang WHERE id_supplier='$vendor' AND no_reff = '$bukti' AND id_supplier='$vendor' AND (datediff('$akhir', tanggal) > 120) GROUP BY no_reff) AS saldo120,
		
		tanggal,keterangan from kartu_piutang WHERE no_reff = '$bukti' AND id_supplier='$vendor' GROUP BY no_reff ";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
		function GetDataBukti(){
		$query 	= "SELECT no_reff, id_supplier, nama_supplier FROM kartu_piutang GROUP BY no_reff";
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
	
	public function GetVendor(){
		
		$query 	= "SELECT * from kartu_piutang GROUP BY id_supplier ";

		$query	= $this->db->query($query);
	    if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}

	}
	
	public function get_umur_piutang($vendor)		
	{
		$query 	= "SELECT id_supplier, nama_supplier, sum(saldo30) as saldo30,sum(saldo31) as saldo31,sum(saldo90) as saldo90, sum(saldo120) as saldo120, sum(saldo120plus) as saldo120plus
		FROM umur_piutang GROUP BY id_supplier ";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	public function get_detail_invoice($awal,$akhir,$klien)
	{
		
		if($klien=='0'){
		
		$query 	= "SELECT * from invoice_spk 
		WHERE no_invoice !='null' AND tgl_invoice BETWEEN '$awal' AND '$akhir' 
		ORDER BY no_invoice ASC";
		
		}
		else{
		$query 	= "SELECT * from invoice_spk 
		WHERE  id_klien_inv='$klien' AND no_invoice !='null' AND tgl_invoice BETWEEN '$awal' AND '$akhir' 
		ORDER BY no_invoice ASC";
		}

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	

}