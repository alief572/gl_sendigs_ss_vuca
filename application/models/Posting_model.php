<?php
class Posting_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_bulan_coa()
	{
		$query 	= "SELECT DISTINCT bln from COA";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_tahun_coa()
	{
		$query 	= "SELECT DISTINCT thn from COA";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_periode_aktif()
	{
		$singkat_cbg	= $this->session->userdata('singkat_cbg');
		$query 	= "SELECT * FROM periode WHERE stsaktif = 'O' and kdcab='$singkat_cbg' ORDER BY id ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa_blnthn_terpilih($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM COA WHERE bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_4($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_4_saldoawal,SUM(debet) as tot_nokir_4_debet,SUM(kredit) as tot_nokir_4_kredit FROM COA WHERE (no_perkiraan like '4%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_5($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_5_saldoawal,SUM(debet) as tot_nokir_5_debet,SUM(kredit) as tot_nokir_5_kredit FROM COA WHERE (no_perkiraan like '5%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_6($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_6_saldoawal,SUM(debet) as tot_nokir_6_debet,SUM(kredit) as tot_nokir_6_kredit FROM COA WHERE (no_perkiraan like '6%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_71($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_71_saldoawal,SUM(debet) as tot_nokir_71_debet,SUM(kredit) as tot_nokir_71_kredit FROM COA WHERE (no_perkiraan like '71%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_72($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_72_saldoawal,SUM(debet) as tot_nokir_72_debet,SUM(kredit) as tot_nokir_72_kredit FROM COA WHERE (no_perkiraan like '72%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_9($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_9_saldoawal,SUM(debet) as tot_nokir_9_debet,SUM(kredit) as tot_nokir_9_kredit FROM COA WHERE (no_perkiraan like '9%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa_blnthn_terpilih2($var_bulan, $var_tahun)
	{
		$kode_cabang2	= $this->session->userdata('kode_cabang');

		$query 	= "SELECT * FROM COA WHERE bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_bt_ada($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT bln,thn FROM COA WHERE bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_dk_nol($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT debet,kredit FROM COA WHERE bln = '$var_bulan' AND thn = '$var_tahun' AND debet > 0 AND kredit > 0 AND level='5' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_saldoawal_3903($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT saldoawal FROM COA WHERE no_perkiraan = '3903-01-01' AND bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' AND kdcab='$kode_cabang'";
		//$query 	= "SELECT saldoawal FROM COA WHERE no_perkiraan like '3903%' AND bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' AND kdcab='$kode_cabang'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_saldoawal_3902($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT saldoawal FROM COA WHERE no_perkiraan= '3902-01-01' AND bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' AND kdcab='$kode_cabang'";
		// $query 	= "SELECT saldoawal FROM COA WHERE no_perkiraan like '3902%' AND bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' AND kdcab='$kode_cabang'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function cek_saldoawal_3901($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT saldoawal FROM COA WHERE no_perkiraan= '3901-01-01' AND bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' AND kdcab='$kode_cabang'";
		// $query 	= "SELECT saldoawal FROM COA WHERE no_perkiraan like '3902%' AND bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' AND kdcab='$kode_cabang'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_post_jurnal($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_coa($var_bulan, $var_tahun)
	{
		$query 	= "SELECT DISTINCT no_perkiraan from COA where bln = '$var_bulan' AND thn = '$var_tahun' AND level='5' order by id";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_balance($var_tgl_awal, $var_tgl_akhir)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT sum(debet) as total_debet, sum(kredit) as total_kredit FROM jurnal WHERE tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' AND nomor like '$kode_cabang%'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_nokir_coa($var_bulan, $var_tahun, $nokir)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT no_perkiraan FROM COA WHERE bln='$var_bulan' AND thn='$var_tahun' AND no_perkiraan = '$nokir' and kdcab='$kode_cabang'";

		//echo $query;

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function cek_nokir_jurnal($var_tgl_awal, $var_tgl_akhir)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' AND nomor like '$kode_cabang%'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_data_jurnal($var_tgl_awal, $var_tgl_akhir, $nokir)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum(debet) as jml_debet, sum(kredit) as jml_kredit FROM jurnal WHERE no_perkiraan = '$nokir' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' AND nomor like '$kode_cabang%'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa_lv5($var_bulan, $var_tahun, $nokir_lv3)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT sum(debet) as jml_debet5, sum(kredit) as jml_kredit5 FROM COA WHERE no_perkiraan like '$nokir_lv3%' AND level='5' AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting01($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1101-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting01a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1101-99-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting02($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1101-01-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting03($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1102-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting04($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1102-01-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting05($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1102-01-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting05a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1102-01-04' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting06($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1104-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting07($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1104-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting08($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1105-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting09($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1106-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting10($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1106-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting10a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1107-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting11($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1108-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting11a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1110-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting11b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1110-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting12($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1110-03-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting12a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1110-03-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting13($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1110-04-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting14($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1110-05-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting15($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1110-06-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting16($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1111-09-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting17($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1301-01-00' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting18($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1301-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting18a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1302-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting19($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1303-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting20($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1303-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting21($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1304-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting21a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1305-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting21b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1306-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting21c($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1307-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting22($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1309-03-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting23($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1309-04-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting24($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1309-05-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting24a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '1901-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting24b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2101-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting25($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2102-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting26($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2107-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting27($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2107-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting28($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2107-03-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting29($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2107-04-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting30($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2108-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting31($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2108-01-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting32($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2108-09-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting33($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2108-09-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting33a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '2203-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting34($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '3201-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting35($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '3201-01-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting36($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '3901-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting37($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '3901-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting37a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '3902-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting37b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '3903-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting38($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '4101-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting39($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '5101-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting40($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6101-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting40a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6101-01-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting41($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting42($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-01-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting43($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-01-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting44($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-01-04' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting45($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-01-05' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting46($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-01-07' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting47($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-01-08' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting48($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting48a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-02-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting48b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-02-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting49($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-03-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting50($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-03-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting51($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-03-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting51a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-04-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting51b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-04-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting52($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-05-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting52a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-06-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting53($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-06-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting53a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-06-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting53b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-07-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting53c($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-07-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting54($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-07-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting54a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-08-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting54b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-08-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting54c($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-08-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting55($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-08-04' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting56($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-08-05' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting57($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-08-06' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting58($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-08-99' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting59($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-09-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting60($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-10-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting60a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-11-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting61($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting62($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting62a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting63($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-03' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting64($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-04' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting65($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-05' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting66($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-06' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting67($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-07' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting68($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-12-08' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting68a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-13-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting68b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6811-13-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting69($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6821-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting70($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6821-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting71($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6821-03-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting72($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6821-04-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting72a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6821-05-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting72b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6831-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting73($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6831-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting74($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6831-03-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting75($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6831-04-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting75a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '6831-05-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting76($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '7101-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting77($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '7101-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting78($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '7101-02-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting78a($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '7201-02-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting78b($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '7201-02-02' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_posting78c($var_tgl_awal, $var_tgl_akhir)
	{
		$query 	= "SELECT no_perkiraan, debet, kredit FROM jurnal WHERE no_perkiraan LIKE '9101-01-01' AND tanggal BETWEEN '$var_tgl_awal' AND '$var_tgl_akhir' ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
