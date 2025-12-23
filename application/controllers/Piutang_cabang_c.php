<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Piutang_cabang_c extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->library('session');
		//$this->session->userdata('kode_cabang');
		$this->session->userdata('pn_name');
		$this->load->model('piutang_cabang_m');
		$this->load->model('Jurnal_model');
		$this->load->helper('menu');
		$this->load->helper('form');
		$this->load->helper('url');		
	}

	function piutang_cabang(){
		$data['judul'] ='Laporan Piutang Per-Cabang';
		$data['piutang_cab']=$this->piutang_cabang_m->piutang_cabang();
		
		$this->load->view('report/piutang_cabang_v',$data);
	}
	function detail_cabang(){
		$kdcab	= $this->uri->segment(3);
		$data['judul'] ='Laporan Piutang Cabang ('.$kdcab.')';
		$data['kdcab'] = $kdcab;
		$data['piutang_cab']=$this->piutang_cabang_m->piutang_cabang_detail($kdcab);
		
		$this->load->view('report/piutang_cabang_detail_v',$data);
	}

	function piutang_cabang_bln_thn(){
		$data['judul'] ='Laporan Piutang Per-Cabang';
		$data['piutang_cab']=$this->piutang_cabang_m->piutang_cabang_bln();
		
		$this->load->view('report/piutang_cabang_v',$data);
	}
}
	?>
		
		