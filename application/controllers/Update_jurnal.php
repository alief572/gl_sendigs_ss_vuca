<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Update_jurnal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->library('session');
		$this->load->library('datatables');
		$this->session->userdata('pn_name');

		$this->load->model('Update_jurnal_model');
		$this->load->model('Jurnal_model');
		$this->load->model('master_model');
		$this->load->model('komisi_model');
		$this->load->model('invoice_model');
		$this->load->helper('menu');
	}

	public function update_buk()
	{
		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['judul']		= "Update Jurnal BUK";
		$data['list_data'] = $this->Update_jurnal_model->defaultlist_update_buk($bln_aktif, $thn_aktif);
		$this->load->view('update_jurnal/v_list_update_buk', $data);
	}

	function filter_update_jurnal_buk()
	{
		$data['judul']			= "Update Jurnal BUK";
		$filter_by 				= $this->input->post('filter_by');
		$data['filter_by_']		= $filter_by;
		$filter_text 			= $this->input->post('filter_text');
		$data['filter_text_']	= $filter_text;

		$bulan_update			= $this->input->post('bulan_update');
		$data['bulan_update_']	= $bulan_update;

		$tahun_update			= $this->input->post('tahun_update');
		$data['tahun_update_']	= $tahun_update;

		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		if ($this->input->post('cari') == "Cari") {
			if ($filter_by == "no_reff") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_buk_noreff($bln_aktif, $thn_aktif, $filter_text);
			} elseif ($filter_by == "no_jurnal") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_buk_nojur($bln_aktif, $thn_aktif, $filter_text);
			} elseif ($filter_by == "keterangan") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_buk_ket($bln_aktif, $thn_aktif, $filter_text);
			}
		} else {
			if ($filter_by == "no_reff") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_buk_noreff2($bulan_update, $tahun_update, $filter_text);
			} elseif ($filter_by == "no_jurnal") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_buk_nojur2($bulan_update, $tahun_update, $filter_text);
			} elseif ($filter_by == "keterangan") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_buk_ket2($bulan_update, $tahun_update, $filter_text);
			}
		}

		$this->load->view("update_jurnal/v_list_update_buk_filter", $data);
	}

	public function update_bum()
	{
		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['judul']		= "Update Jurnal BUM";
		$data['list_data'] = $this->Update_jurnal_model->defaultlist_update_bum($bln_aktif, $thn_aktif);
		$this->load->view('update_jurnal/v_list_update_bum', $data);
	}

	function filter_update_jurnal_bum()
	{
		$data['judul']			= "Update Jurnal BUM";
		$filter_by 				= $this->input->post('filter_by');
		$data['filter_by_']		= $filter_by;
		$filter_text 			= $this->input->post('filter_text');
		$data['filter_text_']	= $filter_text;

		$bulan_update			= $this->input->post('bulan_update');
		$data['bulan_update_']	= $bulan_update;

		$tahun_update			= $this->input->post('tahun_update');
		$data['tahun_update_']	= $tahun_update;

		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		if ($this->input->post('cari') == "Cari") {
			if ($filter_by == "no_reff") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_bum_noreff($bln_aktif, $thn_aktif, $filter_text);
			} elseif ($filter_by == "no_jurnal") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_bum_nojur($bln_aktif, $thn_aktif, $filter_text);
			} elseif ($filter_by == "keterangan") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_bum_ket($bln_aktif, $thn_aktif, $filter_text);
			}
		} else {
			if ($filter_by == "no_reff") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_bum_noreff2($bulan_update, $tahun_update, $filter_text);
			} elseif ($filter_by == "no_jurnal") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_bum_nojur2($bulan_update, $tahun_update, $filter_text);
			} elseif ($filter_by == "keterangan") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_bum_ket2($bulan_update, $tahun_update, $filter_text);
			}
		}

		$this->load->view("update_jurnal/v_list_update_bum_filter", $data);
	}

	public function update_jv()
	{
		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['judul']		= "Update Jurnal JV";
		$data['list_data'] = $this->Update_jurnal_model->defaultlist_update_jv($bln_aktif, $thn_aktif);
		$this->load->view('update_jurnal/v_list_update_jv', $data);
	}

	function filter_update_jurnal_jv()
	{
		$data['judul']			= "Update Jurnal JV";
		$filter_by 				= $this->input->post('filter_by');
		$data['filter_by_']		= $filter_by;
		$filter_text 			= $this->input->post('filter_text');
		$data['filter_text_']	= $filter_text;

		$bulan_update			= $this->input->post('bulan_update');
		$data['bulan_update_']	= $bulan_update;

		$tahun_update			= $this->input->post('tahun_update');
		$data['tahun_update_']	= $tahun_update;

		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		if ($this->input->post('cari') == "Cari") {
			if ($filter_by == "no_jurnal") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_jv_nojur($bln_aktif, $thn_aktif, $filter_text);
			} elseif ($filter_by == "keterangan") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_jv_ket($bln_aktif, $thn_aktif, $filter_text);
			}
		} else {
			if ($filter_by == "no_jurnal") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_jv_nojur2($bulan_update, $tahun_update, $filter_text);
			} elseif ($filter_by == "keterangan") {
				$data['filter_update']	= $this->Update_jurnal_model->filter_update_jv_ket2($bulan_update, $tahun_update, $filter_text);
			}
		}

		$this->load->view("update_jurnal/v_list_update_jv_filter", $data);
	}

	public function edit_jurnal_buk()
	{
		$data['judul']				= "Update Jurnal BUK";
		$nomor_jurnal				= $this->uri->segment(3);
		$tipe						= "BUK";

		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		$data['data_japh']		= $this->Update_jurnal_model->get_japh($nomor_jurnal);
		$data['data_jurnal']	= $this->Update_jurnal_model->get_jurnal($nomor_jurnal, $tipe);

		$data['data_bank']			= $this->Update_jurnal_model->get_bank($bln_aktif, $thn_aktif);
		$data['data_perkiraan']		= $this->Update_jurnal_model->get_rows_noperkiraan($bln_aktif, $thn_aktif);
		$this->load->view('update_jurnal/v_update_buk', $data);
	}
	public function proses_update_buk()
	{
		if ($this->input->post()) {
			$hasil	= $this->Update_jurnal_model->ProsesUpdateBUK();
			redirect('update_jurnal/update_buk');
		}
	}

	public function edit_jurnal_bum()
	{
		$data['judul']				= "Update Jurnal BUM";
		$nomor_jurnal				= $this->uri->segment(3);
		$tipe						= "BUM";

		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		$data['data_jarh']		= $this->Update_jurnal_model->get_jarh($nomor_jurnal);
		$data['data_jurnal']	= $this->Update_jurnal_model->get_jurnal($nomor_jurnal, $tipe);

		$data['data_bank']			= $this->Update_jurnal_model->get_bank($bln_aktif, $thn_aktif);
		$data['data_perkiraan']		= $this->Update_jurnal_model->get_rows_noperkiraan($bln_aktif, $thn_aktif);
		$this->load->view('update_jurnal/v_update_bum', $data);
	}
	public function proses_update_bum()
	{
		if ($this->input->post()) {
			$hasil	= $this->Update_jurnal_model->ProsesUpdatebum();
			redirect('update_jurnal/update_bum');
		}
	}

	public function edit_jurnal_jv()
	{
		$data['judul']				= "Update Jurnal Voucher";
		$nomor_jurnal				= $this->uri->segment(3);

		$cek_periode_aktif			= $this->Update_jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		$data['data_javh']		= $this->Update_jurnal_model->get_javh($nomor_jurnal);
		$data['data_jurnal']	= $this->Update_jurnal_model->get_jurnaljv($nomor_jurnal);

		$data['data_bank']			= $this->Update_jurnal_model->get_bank($bln_aktif, $thn_aktif);
		$data['data_perkiraan']		= $this->Update_jurnal_model->get_rows_noperkiraan($bln_aktif, $thn_aktif);
		$this->load->view('update_jurnal/v_update_jv', $data);
	}
	public function proses_update_jv()
	{
		if ($this->input->post()) {
			$hasil	= $this->Update_jurnal_model->ProsesUpdatejv();
			redirect('update_jurnal/update_jv');
		}
	}
}
