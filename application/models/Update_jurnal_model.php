<?php
class Update_jurnal_model extends CI_Model
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

	public function defaultlist_update_buk($bln_aktif, $thn_aktif)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');

		$query 	= "SELECT * FROM japh where month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function filter_update_buk_noreff($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM japh WHERE no_reff like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		// $query 	= "SELECT * FROM japh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND no_reff like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_buk_nojur($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM japh WHERE nomor like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		// $query 	= "SELECT * FROM japh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND nomor like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_buk_ket($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM japh WHERE note like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		// $query 	= "SELECT * FROM japh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND note like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_buk_noreff2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM japh WHERE no_reff like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_buk_nojur2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM japh WHERE nomor like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_buk_ket2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM japh WHERE note like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function defaultlist_update_bum($bln_aktif, $thn_aktif)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');

		$query 	= "SELECT * FROM jarh where month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function filter_update_bum_noreff($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM jarh WHERE no_reff like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		// $query 	= "SELECT * FROM jarh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND no_reff like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_bum_nojur($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM jarh WHERE nomor like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		// $query 	= "SELECT * FROM jarh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND nomor like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_bum_ket($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM jarh WHERE note like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		// $query 	= "SELECT * FROM jarh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND note like '%$filter_text%' and kdcab='$nomor_cabang' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_bum_noreff2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jarh WHERE no_reff like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_bum_nojur2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jarh WHERE nomor like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_bum_ket2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jarh WHERE note like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function defaultlist_update_jv($bln_aktif, $thn_aktif)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');

		$query 	= "SELECT * FROM javh where nomor like '$kode_cabang%' and bulan='$bln_aktif' and tahun='$thn_aktif' ORDER BY nomor";

		// $query 	= "SELECT * FROM javh where month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' and nomor like '$kode_cabang%' and bulan='$bln_aktif' and tahun='$thn_aktif' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function filter_update_jv_nojur($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM javh WHERE nomor like '%$filter_text%' and kdcab='$nomor_cabang' and bulan='$bln_aktif' and tahun='$thn_aktif' ORDER BY nomor";

		// $query 	= "SELECT * FROM javh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND nomor like '%$filter_text%' and kdcab='$nomor_cabang' and bulan='$bln_aktif' and tahun='$thn_aktif' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_jv_ket($bln_aktif, $thn_aktif, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT * FROM javh WHERE keterangan like '%$filter_text%' and kdcab='$nomor_cabang' and bulan='$bln_aktif' and tahun='$thn_aktif' ORDER BY nomor";

		// $query 	= "SELECT * FROM javh WHERE month(tgl)='$bln_aktif' and year(tgl)='$thn_aktif' AND keterangan like '%$filter_text%' and kdcab='$nomor_cabang' and bulan='$bln_aktif' and tahun='$thn_aktif' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function filter_update_jv_nojur2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM javh WHERE nomor like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and bulan='$bulan_update' and tahun='$tahun_update' and nomor like '$kode_cabang%' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function filter_update_jv_ket2($bulan_update, $tahun_update, $filter_text)
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM javh WHERE keterangan like '%$filter_text%' and month(tgl)='$bulan_update' and year(tgl)='$tahun_update' and kdcab='$nomor_cabang' and nomor like '$kode_cabang%' and bulan='$bulan_update' and tahun='$tahun_update' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_japh($nomor_buk)
	{
		$query 	= "SELECT * FROM japh WHERE nomor = '$nomor_buk' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_jarh($nomor_bum)
	{
		$query 	= "SELECT * FROM jarh WHERE nomor = '$nomor_bum' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_javh($nomor_jv)
	{
		$query 	= "SELECT * FROM javh WHERE nomor = '$nomor_jv' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_jurnal($nomor_jurnal, $tipe)
	{
		$query 	= "SELECT * FROM jurnal WHERE nomor = '$nomor_jurnal' and tipe='$tipe' ORDER BY nomor";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_jurnaljv($nomor_jurnal)
	{
		$query 	= "SELECT * FROM jurnal WHERE nomor = '$nomor_jurnal' and tipe like 'J%' ORDER BY nomor";

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

		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND level like '%5%' and kdcab='$kode_cabang' and bln='$bln_aktif' and thn='$thn_aktif'";
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

		$query 	= "SELECT * FROM COA WHERE level='5' and bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			$det_result	=  $query->result();
			foreach ($det_result as $key => $vals) {
				$Kode_Coa   = $vals->no_perkiraan;
				$Nama_Coa	= $vals->nama;
				$rows_return[$Kode_Coa]	= $Kode_Coa . '  ' . $Nama_Coa;
			}
		} else {
			$rows_return	= array('' => 'Empty List');
		}
		return $rows_return;
	}

	function ProsesUpdateBUK()
	{
		$Nomor_BUK		= $this->input->post('nomor_jurnal');
		$Tgl_Jurnal_	= $this->input->post('tanggal');
		$Tgl_Jurnal		= date("Y-m-d", strtotime($Tgl_Jurnal_));
		$var_kepada 	= $this->input->post('kepada');
		$note 			= $this->input->post('note');
		$jumlah			= str_replace(',', '', $this->input->post('jumlah'));
		$var_jenistransf = $this->input->post('jenistransf');
		$var_nocek		= $this->input->post('nocek');
		$var_bon		= $this->input->post('bon');
		$det_Detail		= $this->input->post('detDetail');

		$Detail_BUK			= array();

		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_Coa			= explode('^', $vals['no_perkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['no_reff'];
			$nilai_debet		= str_replace(',', '', $vals['debet']);
			$nilai_kredit		= str_replace(',', '', $vals['kredit']);
			$Detail_BUK[$intL]	= array(
				'nomor'         => $Nomor_BUK,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'BUK',
				'no_perkiraan'  => $Kode_Coa[0],
				'keterangan'    => $descr,
				'jenis_trans'   => $var_jenistransf,
				'no_reff'       => $no_reff,
				'debet'         => $nilai_debet,
				'kredit'        => $nilai_kredit
			);
		}
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$Header_BUK		= array(
			'nomor'			=> $Nomor_BUK,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $jumlah,
			'kdcab'			=> $nomor_cabang,
			'jenis_reff'	=> $var_jenistransf,
			'no_reff'		=> $no_reff,
			'bayar_kepada'	=> $var_kepada,
			'jenis_ap'		=> 'V',
			'note'			=> $note,
			'batal'			=> '0',
			'bon'			=> $var_bon
		);
		$this->db->where("nomor", $Nomor_BUK);
		$this->db->update("JAPH", $Header_BUK);

		$this->db->where("nomor", $Nomor_BUK);
		$this->db->where("tipe", "buk");
		$this->db->delete('jurnal');

		$this->db->insert_batch("jurnal", $Detail_BUK);
	}

	function ProsesUpdateBUM()
	{
		$Nomor_BUM		= $this->input->post('nomor_jurnal');
		$Tgl_Jurnal_	= $this->input->post('tanggal');
		$Tgl_Jurnal		= date("Y-m-d", strtotime($Tgl_Jurnal_));
		$var_terimadr 	= $this->input->post('terima_dari');
		$note 			= $this->input->post('note');
		$jumlah			= str_replace(',', '', $this->input->post('jumlah'));
		$var_jenistransf = $this->input->post('jenistransf');
		$var_nocek		= $this->input->post('nocek');
		// $var_bon		= $this->input->post('bon');
		$det_Detail		= $this->input->post('detDetail');

		$Detail_BUM			= array();

		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_Coa			= explode('^', $vals['no_perkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['no_reff'];
			$nilai_debet		= str_replace(',', '', $vals['debet']);
			$nilai_kredit		= str_replace(',', '', $vals['kredit']);
			$Detail_BUM[$intL]	= array(
				'nomor'         => $Nomor_BUM,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'BUM',
				'no_perkiraan'  => $Kode_Coa[0],
				'keterangan'    => $descr,
				'jenis_trans'   => $var_jenistransf,
				'no_reff'       => $no_reff,
				'debet'         => $nilai_debet,
				'kredit'        => $nilai_kredit
			);
		}
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$Header_BUM		= array(
			'nomor'			=> $Nomor_BUM,
			'kd_pembayaran'	=> $var_nocek,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $jumlah,
			'kdcab'			=> $nomor_cabang,
			'jenis_reff'	=> $var_jenistransf,
			'no_reff'		=> $no_reff,
			'terima_dari'	=> $var_terimadr,
			'jenis_ar'		=> 'V',
			'note'			=> $note,
			'batal'			=> '0'
			// 'bon'			=> $var_bon
		);
		$this->db->where("nomor", $Nomor_BUM);
		$this->db->update("JARH", $Header_BUM);

		$this->db->where("nomor", $Nomor_BUM);
		$this->db->where("tipe", "BUM");
		$this->db->delete('jurnal');

		$this->db->insert_batch("jurnal", $Detail_BUM);
	}

	function ProsesUpdateJV()
	{
		$Nomor_JV		= $this->input->post('nomor_jurnal');
		$koreksi_no		= $this->input->post('koreksi_no');
		$periode_bulan	= $this->input->post('periode_bulan');
		$periode_tahun	= $this->input->post('periode_tahun');
		$Tgl_Jurnal_	= $this->input->post('tanggal');
		$Tgl_Jurnal		= date("Y-m-d", strtotime($Tgl_Jurnal_));
		$ket_javh		= $this->input->post('ket_javh');
		$det_Detail		= $this->input->post('detDetail');

		$Detail_JV			= array();

		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_Coa			= explode('^', $vals['no_perkiraan']);
			$descr				= $vals['keterangan'];
			// $no_reff			= $vals['no_reff'];
			$nilai_debet		= str_replace(',', '', $vals['debet']);
			$nilai_kredit		= str_replace(',', '', $vals['kredit']);
			$Detail_JV[$intL]	= array(
				'nomor'         => $Nomor_JV,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'JV',
				'no_perkiraan'  => $Kode_Coa[0],
				'keterangan'    => $descr,
				'no_reff'       => $koreksi_no,
				'debet'         => $nilai_debet,
				'kredit'        => $nilai_kredit
			);
		}
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$Header_JV		= array(
			'nomor'			=> $Nomor_JV,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $nilai_debet,
			'koreksi_no'	=> $koreksi_no,
			'kdcab'			=> $nomor_cabang,
			'jenis'			=> 'JV',
			'keterangan'	=> $ket_javh,
			'bulan'			=> $periode_bulan,
			'tahun'			=> $periode_tahun,
			'user_id'		=> '1',
			'tgl_jvkoreksi'	=> date('Y-m-d')
		);
		$this->db->where("nomor", $Nomor_JV);
		$this->db->update("JAVH", $Header_JV);

		$this->db->where("nomor", $Nomor_JV);
		// $this->db->where("tipe", "JV");
		$this->db->delete('jurnal');

		$this->db->insert_batch("jurnal", $Detail_JV);
	}
}
