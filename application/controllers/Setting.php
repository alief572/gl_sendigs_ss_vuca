<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->library('session');
		$this->load->library('datatables');
		$this->session->userdata('pn_name');
		
		$this->load->model('Setting_model');
		
		$this->load->helper('menu');
	}
	
	public function index(){
		
	}
	
	function switch_cabang(){
		$data['judul']		= "Setting";
		$data['list_data']	= $this->Setting_model->get_cabang();
		$data['pesan_on']	= 0;
		$this->load->view('setting/v_setting',$data);
	}

	function proses_switch_cabang(){
		if($this->input->post('cb_cabang') == ""){
			$data['judul']		= "Setting";
			$data['list_data']	= $this->Setting_model->get_cabang();
			$data['pesan_on'] = 2;
			$this->load->view('setting/v_setting',$data);
		}else{
			$data['judul']		= "Setting";
			$cabang_pilihan		= $this->input->post('cb_cabang');
			$data['list_data']	= $this->Setting_model->get_cabang();
			$data_pilihan		= $this->Setting_model->get_cabang2($cabang_pilihan);

			$data_unset = array(				
				'pn_wilayah',
				'kode_cabang',
				'singkat_cbg',
				'nomor_cabang',
				'sub_cabang',
				'nama_cabang'				
			);				

			$this->session->unset_userdata($data_unset);

			if($data_pilihan > 0){
				foreach($data_pilihan as $row_cabang_baru){
					$nocab			= $row_cabang_baru->nocab;
					$subcab			= $row_cabang_baru->subcab;
					$kode_cabang	= $nocab."-".$subcab;
					$nama_cabang	= $row_cabang_baru->cabang;
					$singkat_cbg	= $row_cabang_baru->kdcab;
				}
			}

			$data_set = array(				
				'kode_cabang'	=> $kode_cabang,
				'singkat_cbg'	=> $singkat_cbg,
				'nomor_cabang'	=> $nocab,
				'sub_cabang'	=> $subcab,
				'nama_cabang'	=> $nama_cabang			
			);				

			$this->session->set_userdata($data_set);

			$cek_periode		= $this->Setting_model->cek_periode($cabang_pilihan);

			$data['pesan_on']	= 1;
			$this->load->view('setting/v_setting',$data);
		}
	}
	
	
	
	
	
}