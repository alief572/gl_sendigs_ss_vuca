<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->model('all_model');
		$this->load->model('order_model');
		$this->load->model('invoice_model');
		$this->load->model('Model_dashboard');
		$this->load->helper('menu');
	}

	public function index()
	{
		$data['judul'] = "Dashboard";
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$thn = date('Y');
		$data_periode_aktif = $this->Model_dashboard->cek_periode_aktif();
		if ($data_periode_aktif > 0) {
			foreach ($data_periode_aktif as $row_pa) {
				$tgl_periode = $row_pa->periode;
				//$bln_aktif = substr($tgl_periode, 0, 2);
				$thn = substr($tgl_periode, 3, 4);
			}
		}
		$data['omzet']			= $this->Model_dashboard->get_omzet($kode_cabang, $thn);
		$data['hpp']			= $this->Model_dashboard->get_hpp($kode_cabang, $thn);
		$data['data_ar']		= $this->Model_dashboard->get_ar($kode_cabang, $thn);
		$data['data_ap']		= $this->Model_dashboard->get_ap($kode_cabang, $thn);
		$data['data_lb']		= $this->Model_dashboard->get_lb($kode_cabang, $thn);
		$data['data_biaya']		= $this->Model_dashboard->get_biaya($kode_cabang, $thn);
		$data['tahun']			= $thn;
		$this->load->view('dashboard/v_dashboard', $data);
	}
	public function ganti_tahun()
	{
		$data['judul'] = "Dashboard";
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$thn = $this->input->post('thn');
		$data['omzet']			= $this->Model_dashboard->get_omzet($kode_cabang, $thn);
		$data['hpp']			= $this->Model_dashboard->get_hpp($kode_cabang, $thn);
		$data['data_ar']		= $this->Model_dashboard->get_ar($kode_cabang, $thn);
		$data['data_ap']		= $this->Model_dashboard->get_ap($kode_cabang, $thn);
		$data['data_lb']		= $this->Model_dashboard->get_lb($kode_cabang, $thn);
		$data['data_biaya']		= $this->Model_dashboard->get_biaya($kode_cabang, $thn);
		$this->load->view('dashboard/v_dashboard', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	function loop()
	{
		$data = $this->db->query("select nopol_lama from coba where nopol_lama!= ''");
		$data = $data->result();
		$nopol_lama = $data[0]->nopol_lama;
		$nopol_lamax = implode("','", $nopol_lama);
		$data2 = $this->db->query("select nopol_baru from coba where nopol_baru not in('" . $nopol_lamax . "')");
		$data2 = $data2->result();
		foreach ($data2 as $row) {
			echo $row->nopol_baru;
			echo "<br>";
		}
	}
}
