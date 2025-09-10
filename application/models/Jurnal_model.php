<?php
class Jurnal_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function cek_periode_aktif()
	{
		$singkat_cbg = $this->session->userdata('singkat_cbg');
		$query 	= "SELECT * FROM periode WHERE kdcab='$singkat_cbg' and stsaktif='O'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function list_jv($bln_aktif, $thn_aktif)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query = "SELECT * from javh where bulan='$bln_aktif' and tahun='$thn_aktif' and nomor like '$kode_cabang%' order by nomor desc";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	public function list_jv_excel($bln_aktif, $thn_aktif)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query = "SELECT * from javh where bulan='$bln_aktif' and tahun='$thn_aktif' and nomor like '$kode_cabang%' order by nomor asc";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_detail_jv($nomor_jurnal)
	{
		// $query = "SELECT * FROM jurnal where nomor = '$nomor_jurnal'";
		$query 	= "SELECT jurnal.*, jurnal.no_perkiraan, coa_master.nama 
		FROM jurnal 
		INNER JOIN coa_master ON coa_master.no_perkiraan=jurnal.no_perkiraan 
		WHERE jurnal.nomor='$nomor_jurnal'
        ORDER BY jurnal.debet DESC";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_javh($nomor_jurnal)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query = "SELECT * from javh where nomor = '$nomor_jurnal'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_detail_jurnal($tipe_jurnal, $nomor_jurnal)
	{
		//$query 	= "SELECT * FROM jurnal WHERE tipe='$tipe_jurnal' and nomor='$nomor_jurnal' ORDER BY debet DESC";
		$query 	= "SELECT jurnal.*, jurnal.no_perkiraan, coa_master.nama 
		FROM jurnal 
		INNER JOIN coa_master ON coa_master.no_perkiraan=jurnal.no_perkiraan 
		WHERE jurnal.tipe='$tipe_jurnal' and jurnal.nomor='$nomor_jurnal'
        ORDER BY jurnal.debet DESC";
		
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_query_jurnal_noreff($tanggal, $tanggal2, $filter_text)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (tanggal between '$tanggal' and '$tanggal2') AND nomor like '$kode_cabang%' and no_reff like '%$filter_text%' ORDER BY tanggal ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_query_jurnal_nojur($tanggal, $tanggal2, $filter_text)
	{
		$query 	= "SELECT * FROM jurnal WHERE (tanggal between '$tanggal' and '$tanggal2') and nomor like '%$filter_text%' ORDER BY tanggal ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_query_jurnal_nokir($tanggal, $tanggal2, $filter_text)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (tanggal between '$tanggal' and '$tanggal2') AND nomor like '$kode_cabang%' and no_perkiraan like '%$filter_text%' ORDER BY tanggal ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_query_jurnal_ket($tanggal, $tanggal2, $filter_text)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (tanggal between '$tanggal' and '$tanggal2') AND nomor like '$kode_cabang%' and keterangan like '%$filter_text%' ORDER BY tanggal ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_query_jurnal_tipe($tanggal, $tanggal2, $filter_text)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (tanggal between '$tanggal' and '$tanggal2') AND nomor like '$kode_cabang%' and tipe like '%$filter_text%' ORDER BY tanggal ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function ambil_jurnal_bum_debet($id_bum)
	{
		$query 	= "SELECT * from jurnal where tipe = 'BUM' and nomor='$id_bum' and debet > 0 ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function ambil_jurnal_bum_kredit($id_bum)
	{
		$query 	= "SELECT * from jurnal where tipe = 'BUM' and nomor='$id_bum' and kredit > 0 ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function ambil_jurnal_buk_debet($id_buk)
	{
		$query 	= "SELECT * from jurnal where tipe = 'BUK' and nomor='$id_buk' and debet > 0 ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function ambil_jurnal_buk_kredit($id_buk)
	{
		$query 	= "SELECT * from jurnal where tipe = 'BUK' and nomor='$id_buk' and kredit > 0 ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_no_buk() //modelnya
	{
		$no_cab		= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT nocab,subcab,nobuk from pastibisa_tb_cabang where nocab='$no_cab' order by id";
		$q 		= $this->db->query($query);

		if ($q->num_rows() > 0) {
			$ret =  $q->result();
			$kd_cab = $ret[0]->nocab;
			$min = "B";
			$sub_cab = "K";

			$kdadd			= "";
			$kd_buk		= $ret[0]->nobuk + 1;
			if (strlen($kd_buk) == 1) {
				$kdadd		= "0000";
			} else if (strlen($kd_buk) == 2) {
				$kdadd		= "000";
			} else if (strlen($kd_buk) == 3) {
				$kdadd		= "00";
			} else if (strlen($kd_buk) == 4) {
				$kdadd		= "0";
			} else {
				$kdadd		= '0';
			}
			$thn			= date("y");

			$id = $kd_cab . $min . $sub_cab . $thn . $kdadd . $kd_buk;
			//$kodebuk = $qkd_cbg.$id;
			return $id;
		} else {
			return Null;
		}
	}

	public function get_no_bum()
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT nocab,subcab,nobum from pastibisa_tb_cabang where nocab='$nomor_cabang' order by id";
		$q 		= $this->db->query($query);

		if ($q->num_rows() > 0) {
			$ret =  $q->result();
			$kd_cab = $ret[0]->nocab;
			$min = "B";
			$sub_cab = "M";

			$kdadd			= "";
			$kd_bum		= $ret[0]->nobum + 1;
			if (strlen($kd_bum) == 1) {
				$kdadd		= "0000";
			} else if (strlen($kd_bum) == 2) {
				$kdadd		= "000";
			} else if (strlen($kd_bum) == 3) {
				$kdadd		= "00";
			} else if (strlen($kd_bum) == 4) {
				$kdadd		= "0";
			} else {
				$kdadd		= '0';
			}
			$thn			= date("y");

			$id = $kd_cab . $min . $sub_cab . $thn . $kdadd . $kd_bum;
			//$kodebuk = $qkd_cbg.$id;
			return $id;
		} else {
			return Null;
		}
	}

	public function get_project()
	{
		// $query	= $this->db->query("SELECT *,a.insertby,b.pn_name,b.pn_wilayah,c.id from dk_master_customer a join dk_user b on a.insertby = b.pn_name join dk_cabang c on b.pn_wilayah = c.id where b.pn_wilayah='$wilayah_user'");
		$wilayah_user	= $this->session->userdata('pn_wilayah');
		$query 	= "SELECT *,a.input_by,b.pn_name,b.pn_wilayah,c.id from dk_penawaran a join dk_user b on a.input_by = b.pn_name join dk_cabang c on b.pn_wilayah = c.id where a.sts_prospek = '2' and b.pn_wilayah='$wilayah_user'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_vendor()
	{
		$query 	= "select * from dk_master_vendor";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	## SYAM  21/02/2020##

	public function list_jurnal()
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT jurnal.*, jurnal.no_perkiraan, coa_master.nama 
		FROM jurnal 
		INNER JOIN coa_master ON coa_master.no_perkiraan=jurnal.no_perkiraan 
		where jurnal.nomor like '$kode_cabang%' ORDER BY id DESC";
		// $query 	= "SELECT * FROM jurnal where batal='0' and nomor like '$kode_cabang%' ORDER BY id DESC";
		// $query 	= "SELECT * FROM jurnal where batal='0' ORDER BY id DESC LIMIT 0,100";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_jurnal_old()
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal where nomor like '$kode_cabang%' ORDER BY id DESC";
		// $query 	= "SELECT * FROM jurnal where batal='0' and nomor like '$kode_cabang%' ORDER BY id DESC";
		// $query 	= "SELECT * FROM jurnal where batal='0' ORDER BY id DESC LIMIT 0,100";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_noperkiraan($bln_aktif, $thn_aktif)
	{

		$kode_cabang	= $this->session->userdata('kode_cabang');

		$query 	= "SELECT * FROM coa WHERE level='5' and bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_rows_noperkiraan($bln_aktif, $thn_aktif)
	{
		$rows_return	= array('' => 'Select An Option');
		$kode_cabang	= $this->session->userdata('kode_cabang');

		$query 	= "SELECT * FROM coa WHERE level='5' and bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			$det_result	=  $query->result();
			foreach ($det_result as $key => $vals) {
				$Kode_coa   = $vals->no_perkiraan;
				$Nama_coa	= $vals->nama;
				$rows_return[$Kode_coa]	= $Kode_coa . '  ' . $Nama_coa;
			}
		} else {
			$rows_return	= array('' => 'Empty List');
		}
		return $rows_return;
	}


	public function get_nokir_filter()
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$var_nokir	= $this->input->post('filter_nokir');
		$ambilnokir = substr($var_nokir, 0, 10);

		//$query 	= "SELECT * FROM jurnal WHERE no_perkiraan = '$ambilnokir' and nomor like '$kode_cabang%' ORDER BY tanggal DESC";

		$query 	= "SELECT
		jurnal.*, jurnal.no_perkiraan, coa_master.nama
		FROM
		jurnal
		INNER JOIN coa_master ON coa_master.no_perkiraan=jurnal.no_perkiraan
		WHERE
		jurnal.no_perkiraan = '$ambilnokir'					
		AND jurnal.nomor like '$kode_cabang%'
		ORDER BY
		jurnal.tanggal ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir()
	{
		$var_nokir	= $this->input->post('filter_nokir');
		$ambilnokir = substr($var_nokir, 0, 10);

		$query 	= "SELECT * FROM jurnal WHERE no_perkiraan = $ambilnokir ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	##SYAM 21/02/2020##

	public function filter_tgl_jurnal($tanggal, $tanggal2)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT
		jurnal.*, jurnal.no_perkiraan, coa_master.nama
		FROM
		jurnal
		INNER JOIN coa_master ON coa_master.no_perkiraan=jurnal.no_perkiraan
		WHERE						
		(jurnal.tanggal >= '$tanggal'
		AND jurnal.tanggal <= '$tanggal2') AND jurnal.nomor like '$kode_cabang%'
		ORDER BY
		jurnal.tanggal ASC";

		// echo $query;
		// exit; 

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function filter_tgl_jurnal_old($tanggal, $tanggal2)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT
		*
		FROM
		jurnal
		WHERE						
		(tanggal >= '$tanggal'
		AND tanggal <= '$tanggal2') AND nomor like '$kode_cabang%'
		ORDER BY
		tanggal ASC";

		// echo $query;
		// exit; 

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_keluardari()
	{
		$Bulan	= 1;
		$Tahun	= date('Y');
		if (date('n') == 1) {
			$Bulan	= 12;
			$Tahun	= date('Y') - 1;
		}
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND level like '%5%' AND bln='$Bulan' AND thn='$Tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_japh($nomor_buk)
	{
		$query 	= "SELECT * from japh where nomor='$nomor_buk'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_jarh($nomor_bum)
	{
		$query 	= "SELECT * from jarh where nomor='$nomor_bum'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_jurnal_kasbank($nomor_buk)
	{
		$query 	= "SELECT * from jurnal where nomor='$nomor_buk' and (no_perkiraan like '1101%' OR no_perkiraan like '1102%') and tipe='BUK'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_jurnal_kasbank_bum($nomor_bum)
	{
		$query 	= "SELECT * from jurnal where nomor='$nomor_bum' and (no_perkiraan like '1101%' OR no_perkiraan like '1102%') and tipe='BUM'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_jurnal_nokasbank($nomor_buk)
	{
		$query 	= "SELECT * from jurnal where nomor='$nomor_buk' and tipe='BUK' and kredit='0'";
		// $query 	= "SELECT * from jurnal where nomor='$nomor_buk' and (no_perkiraan not like '1101%' and no_perkiraan not like '1102%') and tipe='BUK'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_jurnal_nokasbank_bum($nomor_bum)
	{
		$query 	= "SELECT * from jurnal where nomor='$nomor_bum' and tipe='BUM' and debet='0'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_dana_keluar($tanggal_awal, $tanggal_akhir)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang'); // Contoh hasil : 202-A

		$query 	= "SELECT * from japh where batal='0' and tgl between '$tanggal_awal' and '$tanggal_akhir' ORDER BY nomor DESC";

		// $query 	= "SELECT * from japh where nomor LIKE '$kode_cabang%' AND batal='0' ORDER BY nomor DESC";
		// $query 	= "SELECT * from japh where nomor LIKE '$kode_cabang%' AND batal='0' ORDER BY nomor DESC LIMIT 20";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	public function list_dana_keluar2()
	{
		$kode_cabang	= $this->session->userdata('kode_cabang'); // Contoh hasil : 202-A

		$query 	= "SELECT * from japh where batal='0' and tgl between '$tanggal_awal' and '$tanggal_akhir' ORDER BY nomor DESC";

		// $query 	= "SELECT * from japh where nomor LIKE '$kode_cabang%' AND batal='0' ORDER BY nomor DESC";
		// $query 	= "SELECT * from japh where nomor LIKE '$kode_cabang%' AND batal='0' ORDER BY nomor DESC LIMIT 20";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_detailjur($nomorjurnal, $tipe)
	{
		$query 	= "SELECT * from jurnal where nomor='$nomorjurnal' and tipe='$tipe'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_tgl_buk($tanggal, $tanggal2)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM japh WHERE nomor LIKE '$kode_cabang%' AND tgl BETWEEN '$tanggal' AND '$tanggal2' AND batal LIKE '%0%' ORDER BY tgl ASC";
		// $query 	= "SELECT * FROM japh WHERE	tgl BETWEEN '$tanggal' AND '$tanggal2' and nomor LIKE '$kode_cabang%' AND batal='0' ORDER BY nomor ASC";
		//$query 	= "SELECT * FROM japh WHERE	batal='0' AND (tgl >= '$tanggal' AND tgl <= '$tanggal2') ORDER BY tgl ASC";
		//	echo $query;
		//exit; 
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_dana_keluar_backup()
	{
		$kode_cabang	= "201-ABK0201173";
		// $kode_cabang	= $this->session->userdata('kode_cabang');
		$this->datatables->select('nomor,tgl,jenis_reff');
		$this->datatables->from('japh');
		$array_kodecabang = array('nomor' => '$kode_cabang%');
		$this->datatables->where($array_kodecabang);
		return $this->datatables->generate();
	}

	public function list_dana_masuk($var_tgl_awal, $var_tgl_akhir)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		// $query 	= "SELECT * from jarh where batal='0' AND nomor LIKE '$kode_cabang%' ORDER BY nomor DESC LIMIT 20";

		$query 	= "SELECT * from jarh where batal='0' and (tgl between '$var_tgl_awal' and '$var_tgl_akhir') ORDER BY nomor DESC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_dana_masuk_lain()
	{

		$query 	= "SELECT * FROM jurnal WHERE tipe='BUM' ORDER BY id DESC LIMIT 0,100";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_bank($bln_aktif, $thn_aktif)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');

		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND level like '%5%' and kdcab='$kode_cabang' and bln='$bln_aktif' and thn='$thn_aktif'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function inputDanaMasuk()
	{
		$Nomor_BUM		= $this->get_no_bum();
		$var_setorke	= $this->input->post('setorke');
		$var_total		= str_replace(',', '', $this->input->post('total'));
		$Tgl_Jurnal		= $this->input->post('tanggal_tampil');
		$coa_Bank		= explode('^', $this->input->post('setorke'));
		$var_jenistransf = $this->input->post('jenistransf');
		$var_nocek		= $this->input->post('nocek');
		$var_terimadr 	= $this->input->post('terimadr');
		$note 			= $this->input->post('note');
		$det_Detail		= $this->input->post('detail');

		$var_teks 		= "Pembayaran a/n. ";
		$KurungBuka		= " ( ";
		$KurungTutup	= " )";
		$var_note 		= $var_teks . $var_terimadr;

		$Detail_BUM			= array();

		// insert ke jurnal kredit
		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',', '', $vals['jumlah']);
			$Detail_BUM[$intL]	= array(
				'nomor'         => $Nomor_BUM,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'BUM',
				'no_perkiraan'  => $Kode_coa[0],
				'keterangan'    => $descr,
				'jenis_trans'   => $var_jenistransf,
				'no_reff'       => $no_reff,
				'debet'         => '0',
				'kredit'        => $nilai_debet
			);
		}
		// insert ke jurnal debet
		$intL++;
		$Detail_BUM[$intL]		= array(
			'nomor'         => $Nomor_BUM,
			'tanggal'       => $Tgl_Jurnal,
			'tipe'          => 'BUM',
			'no_perkiraan'  => $coa_Bank[0],
			'keterangan'    => $descr,
			'jenis_trans'   => $var_jenistransf,
			'no_reff'       => $no_reff,
			'debet'         => $var_total,
			'kredit'        => '0'
		);

		// insert ke jarh
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$Header_BUM		= array(
			'nomor'			=> $Nomor_BUM,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $var_total,
			'kdcab'			=> $nomor_cabang,
			'jenis_reff'	=> $var_jenistransf,
			'no_reff'		=> $no_reff,
			'terima_dari'	=> $var_terimadr,
			'jenis_ar'		=> 'V',
			'note'			=> $note,
			'batal'			=> '0'
		);

		$this->db->insert("jarh", $Header_BUM);
		$this->db->insert_batch("jurnal", $Detail_BUM);

		//update last NOMOR BUM ke pastibisa_tb_cabang

		$ambilnobum = substr($Nomor_BUM, 8, 4);
		$data3 = array('nobum' => $ambilnobum);
		$this->db->where("nocab", $nomor_cabang);
		$this->db->update("pastibisa_tb_cabang", $data3);

		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	function inputDanaMasukLain()
	{
		$Nomor_BUM		= $this->get_no_bum();
		$var_setorke	= $this->input->post('setorke');
		$var_total		= str_replace(',', '', $this->input->post('total'));
		$Tgl_Jurnal		= $this->input->post('tanggal_tampil');
		$coa_Bank		= explode('^', $this->input->post('setorke'));
		$var_jenistransf = $this->input->post('jenistransf');
		$var_nocek		= $this->input->post('nocek');
		$var_terimadr 	= $this->input->post('terimadr');
		$note 		= $this->input->post('note');
		$det_Detail		= $this->input->post('detail');

		$var_teks 		= "Pembayaran a/n. ";
		$KurungBuka		= " ( ";
		$KurungTutup	= " )";
		$var_note 		= $var_teks . $var_terimadr;

		$Detail_BUM			= array();

		// insert ke jurnal kredit
		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',', '', $vals['jumlah']);
			$Detail_BUM[$intL]	= array(
				'nomor'         => $Nomor_BUM,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'BUM',
				'no_perkiraan'  => $Kode_coa[0],
				'keterangan'    => $descr,
				'no_reff'       => $no_reff,
				'debet'         => '0',
				'kredit'        => $nilai_debet
			);
		}
		// insert ke jurnal debet
		$intL++;
		$Detail_BUM[$intL]		= array(
			'nomor'         => $Nomor_BUM,
			'tanggal'       => $Tgl_Jurnal,
			'tipe'          => 'BUM',
			'no_perkiraan'  => $coa_Bank[0],
			'keterangan'    => $descr,
			'no_reff'       => $no_reff,
			'debet'         => $var_total,
			'kredit'        => '0'
		);

		// insert ke jarh

		$Header_BUM		= array(
			'nomor'			=> $Nomor_BUM,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $var_total,
			'kdcab'			=> '201',
			'jenis_reff'	=> $var_jenistransf,
			'no_reff'		=> $no_reff,
			'terima_dari'	=> $var_terimadr,
			'jenis_ar'		=> 'V',
			'note'			=> $note,
			'batal'			=> '0'
		);

		$this->db->insert("jarh", $Header_BUM);
		$this->db->insert_batch("jurnal", $Detail_BUM);

		//update last NOMOR BUM ke pastibisa_tb_cabang

		$ambilnobum = substr($Nomor_BUM, 8, 4);
		$data3 = array('nobum' => $ambilnobum);
		$this->db->update("pastibisa_tb_cabang", $data3);

		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	function inputDanaKeluar()
	{
		$Nomor_BUK		= $this->get_no_buk();
		$var_keluardr	= $this->input->post('keluardari');
		$var_total		= str_replace(',', '', $this->input->post('total'));
		$Tgl_Jurnal_	= $this->input->post('tanggal');
		$Tgl_Jurnal		= date("Y-m-d", strtotime($Tgl_Jurnal_));;

		$coa_Bank		= explode('^', $this->input->post('keluardari'));
		$var_jenistransf = $this->input->post('jenistransf');
		$var_nocek		= $this->input->post('nocek');
		// $var_bon		= $this->input->post('bon');
		$var_kepada 	= $this->input->post('kepada');
		$note 		= $this->input->post('note');
		$det_Detail		= $this->input->post('detail');

		$var_teks 		= "Pembayaran a/n. ";
		$KurungBuka		= " ( ";
		$KurungTutup	= " )";
		$var_note 		= $var_teks . $var_kepada;

		$Detail_BUK			= array();

		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',', '', $vals['jumlah']);
			$Detail_BUK[$intL]		= array(
				'nomor'         => $Nomor_BUK,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'BUK',
				'no_perkiraan'  => $Kode_coa[0],
				'keterangan'    => $descr,
				'jenis_trans'   => $var_jenistransf,
				'no_reff'       => $no_reff,
				'debet'         => $nilai_debet,
				'kredit'        => '0'
			);
		}
		$intL++;
		$Detail_BUK[$intL]		= array(
			'nomor'         => $Nomor_BUK,
			'tanggal'       => $Tgl_Jurnal,
			'tipe'          => 'BUK',
			'no_perkiraan'  => $coa_Bank[0],
			'keterangan'    => $note,
			'jenis_trans'   => $var_jenistransf,
			'no_reff'       => $no_reff,
			'debet'         => '0',
			'kredit'        => $var_total
		);
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$Header_BUK		= array(
			'nomor'			=> $Nomor_BUK,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $var_total,
			'kdcab'			=> $nomor_cabang,
			'jenis_reff'	=> $var_jenistransf,
			'no_reff'		=> $no_reff,
			'bayar_kepada'	=> $var_kepada,
			'jenis_ap'		=> 'V',
			'note'			=> $note,
			'batal'			=> '0'
			// 'bon'			=> $var_bon
		);

		$this->db->insert("japh", $Header_BUK);
		$this->db->insert_batch("jurnal", $Detail_BUK);

		//update last NOMOR BUK ke pastibisa_tb_cabang

		$ambilnobuk = substr($Nomor_BUK, 8, 4);
		$data3 = array('nobuk' => $ambilnobuk);
		$this->db->where("nocab", $nomor_cabang);
		$this->db->update("pastibisa_tb_cabang", $data3);

		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	function inputDataMasuk_()
	{
		$Nomor_BUM		= $this->get_no_bum();
		$Tgl_byr		= date("Y-m-d", strtotime($this->input->post('tgl_kwitansi')));
		$var_jum		= str_replace('.', '', $this->input->post('jum_bayar'));
		$metode_byr		= $this->input->post('metode');
		$var_noref		= $this->input->post('inv');
		$var_terimadr 	= $this->input->post('receipt_by');
		$var_teks 		= "Pembayaran a/n. ";
		$KurungBuka		= " ( ";
		$KurungTutup	= " )";
		$var_note 		= $var_teks . $var_terimadr . $KurungBuka . $var_noref . $KurungTutup;
		$nokirbank 		= $this->input->post('nm_bank');
		$ambilnokir 	= substr($nokirbank, 0, 10);

		$input_jarh			= array(
			'nomor'			=> $Nomor_BUM,
			'tgl'			=> $Tgl_byr,
			'jml'			=> $var_jum,
			'kdcab'			=> '201',
			'jenis_reff'	=> $metode_byr,
			'no_reff'		=> $var_noref,
			'terima_dari'	=> $var_terimadr,
			'jenis_ar'		=> 'V',
			'note'			=> $var_note,
			'batal'			=> '0'
		);

		$input_jurnal_debit	= array(
			'tipe'          => 'BUM',
			'nomor'			=> $Nomor_BUM,
			'tanggal'		=> $Tgl_byr,
			'no_perkiraan'	=> $ambilnokir,
			'keterangan'	=> $var_note,
			'jenis_trans'	=> $metode_byr,
			'no_reff'		=> $var_noref,
			'debet'         => $var_jum,
			'kredit'        => '0'

		);

		$input_jurnal_kredit = array(
			'tipe'          => 'BUM',
			'nomor'			=> $Nomor_BUM,
			'tanggal'		=> $Tgl_byr,
			'no_perkiraan'	=> '4101-01-01',
			'keterangan'	=> $var_note,
			'jenis_trans'	=> $metode_byr,
			'no_reff'		=> $var_noref,
			'debet'         => '0',
			'kredit'        => $var_jum

		);


		$this->db->insert("jarh", $input_jarh);
		$this->db->insert("jurnal", $input_jurnal_debit);
		$this->db->insert("jurnal", $input_jurnal_kredit);


		//update last NOMOR BUM ke pastibisa_tb_cabang

		$ambilnobum = substr($Nomor_BUM, 8, 4);
		$data3 = array('nobum' => $ambilnobum);
		$this->db->update("pastibisa_tb_cabang", $data3);

		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	public function get_print_req($id)
	{

		$query = "SELECT * from japh where nomor = '$id' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_print_reqbum($id)
	{
		$query = "SELECT * from jarh where nomor = '$id' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_print_detail($no_bu, $sg_tglxx, $tipe_bu)
	{

		$query = "SELECT * from jurnal where tipe = '$tipe_bu' AND nomor = '$no_bu' AND tanggal = '$sg_tglxx' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_print_detail2($no_bu, $sg_tglxx, $tipe_bu)
	{

		$query = "SELECT * from jurnal where tipe = '$tipe_bu' AND nomor = '$no_bu' AND tanggal = '$sg_tglxx' AND debet > 0 order by id";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_print_detail3($no_bu, $sg_tglxx, $tipe_bu)
	{

		$query = "SELECT * from jurnal where tipe = '$tipe_bu' AND nomor = '$no_bu' AND tanggal = '$sg_tglxx' AND kredit > 0 order by id";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_print_keluardr($no_bum, $sg_tglxx, $tipe_bu)
	{
		//$query = "SELECT * from jurnal where (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND nomor = '$no_buk' AND tanggal = '$sg_tglxx' order by nomor";
		$query = "SELECT * FROM jurnal WHERE tipe = '$tipe_bu' AND nomor = '$no_bum' AND tanggal = '$sg_tglxx' AND (no_perkiraan LIKE '1101%' OR no_perkiraan like '1102%')  ORDER BY id";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa($nokirakira)
	{
		$query = "SELECT * from coa WHERE no_perkiraan='$nokirakira' order by no_perkiraan";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function filter_tgl_bum($tanggal, $tanggal2)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jarh WHERE tgl BETWEEN '$tanggal' AND '$tanggal2' AND batal LIKE '%0%' ORDER BY tgl ASC";
		// $query 	= "SELECT
		// *
		// FROM
		// jarh
		// WHERE						
		// (tgl >= '$tanggal'
		// AND tgl <= '$tanggal2') and kdcab = '$nomor_cabang'
		// ORDER BY
		// tgl ASC";

		//	echo $query;
		//exit; 
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
