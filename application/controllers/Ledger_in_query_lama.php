<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ledger_in_query extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->library('session');
		$this->load->model('Liq_model');
		$this->load->helper('menu');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function list_liq3()
	{
		// $data['nomor_jurnal']	= $nomor_segmen1 . "-" . $nomor_segmen2;
		// $nomor_jurnal			= $nomor_segmen1 . "-" . $nomor_segmen2;
		$data['judul'] 				= "Ledger In Query";
		$cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_liq']		= $this->Liq_model->get_liq3($bln_aktif, $thn_aktif, $kode_cabang);
		$this->load->view('Liq/v_liq3', $data);
		//	$this->load->view('Liq/v_liq3_tes_expandcollapse', $data);
	}

	public function list_liq4($nokir)
	{
		$nokir4 					= substr($nokir, 0, 4); // 1101-00-00
		$data['nokir3']				= $nokir;

		$cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_liq']		= $this->Liq_model->get_liq4($bln_aktif, $thn_aktif, $kode_cabang, $nokir4);
		$this->load->view('Liq/v_liq4', $data);
	}

	public function list_liq5($nokir_segmen1, $nokir_segmen2)
	{
		$cek_nokir_segmen2					= substr($nokir_segmen2, 1, 1); // 01 // 1
		if ($cek_nokir_segmen2 == "") {
			$data['nokir4']	= $nokir_segmen1 . "-0" . $nokir_segmen2; // 1101-01
			$nokir4	= $nokir_segmen1 . "-0" . $nokir_segmen2;
		} else {
			$data['nokir4']	= $nokir_segmen1 . "-" . $nokir_segmen2; // 1101-22
			$nokir4	= $nokir_segmen1 . "-" . $nokir_segmen2;
		}

		$cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_liq']		= $this->Liq_model->get_liq5($bln_aktif, $thn_aktif, $kode_cabang, $nokir4);
		$this->load->view('Liq/v_liq5', $data);
	}

	public function detail_jurnal($nokir_segmen1, $nokir_segmen2, $nokir_segmen3)
	{ 																		// nokir 1101-01-01
		$cek_nokir_segmen2					= substr($nokir_segmen2, 1, 1); // 01 // 1
		$cek_nokir_segmen3					= substr($nokir_segmen3, 1, 1); // 01 // 1
		if ($cek_nokir_segmen2 == "" || $cek_nokir_segmen3 == "") {
			$data['nokir5']	= $nokir_segmen1 . "-0" . $nokir_segmen2 . "-0" . $nokir_segmen3;
			$nokir5	= $nokir_segmen1 . "-0" . $nokir_segmen2 . "-0" . $nokir_segmen3;
		} else {
			$data['nokir5']	= $nokir_segmen1 . "-" . $nokir_segmen2 . "-" . $nokir_segmen3;
			$nokir5	= $nokir_segmen1 . "-" . $nokir_segmen2 . "-" . $nokir_segmen3;
		}

		$cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif			= $row_periode_aktif->periode;
				$data['tgl_periode_aktif']	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_liq']		= $this->Liq_model->get_detailjurnal($bln_aktif, $thn_aktif, $kode_cabang, $nokir5);
		$this->load->view('Liq/v_detail_jurnal', $data);
	}

	public function transaksi_jurnal($nomor_segmen) // $nomor_segmen1, $nomor_segmen2
	{
		// $nomor_segmen1 = 101, // $nomor_segmen2 = A2000010
		// $data['nomor_jurnal']	= $tipe;
		$data['nomor_jurnal']	= $nomor_segmen; //  . "-" . $nomor_segmen2
		$nomor_jurnal			= $nomor_segmen;
		// $nomor_jurnal			= "101-A2000010";
		// var_dump($nomor_jurnal);
		// die;
		// echo $nomor_jurnal;
		// exit;
		// $cek_nomor_segmen2					= substr($nomor_segmen2, 1, 1); // 01 // 1
		// $cek_nomor_segmen3					= substr($nomor_segmen3, 1, 1); // 01 // 1
		// if ($cek_nomor_segmen2 == "" || $cek_nomor_segmen3 == "") {
		// 	$data['nomor5']	= $nomor_segmen1 . "-0" . $nomor_segmen2 . "-0" . $nomor_segmen3;
		// 	$nomor5	= $nomor_segmen1 . "-0" . $nomor_segmen2 . "-0" . $nomor_segmen3;
		// } else {
		// 	$data['nomor5']	= $nomor_segmen1 . "-" . $nomor_segmen2 . "-" . $nomor_segmen3;
		// 	$nomor5	= $nomor_segmen1 . "-" . $nomor_segmen2 . "-" . $nomor_segmen3;
		// }

		// $cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
		// if ($cek_periode_aktif > 0) {
		// 	foreach ($cek_periode_aktif as $row_periode_aktif) {
		// 		$tgl_periode_aktif			= $row_periode_aktif->periode;
		// 		$data['tgl_periode_aktif']	= $row_periode_aktif->periode;
		// 		$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
		// 		$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
		// 		$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
		// 		$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
		// 	}
		// }
		// // $kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_liq']		= $this->Liq_model->get_transjurnal($nomor_jurnal);
		// $data['data_liq']		= $this->Liq_model->get_transjurnal($tipe);
		$this->load->view('Liq/v_transaksi_jurnal', $data);
	}
}
