<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kartu_hutang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->model('master_model');
		$this->load->model('menu_model');
		$this->load->model('custom_model');
		$this->load->model('order_model');
		$this->load->helper('menu');
		$this->load->helper('form');
		$this->load->helper('url');
        $this->load->model('Report_model');
		$this->load->model('Kartuhutang_model');
	}
    
	
	function index()
	{
		$data['judul']			= "Laporan Hutang";
		$data['datklien']     = $this->Report_model->pilih_vendor();
		$this->load->view("report/v_kartu_h", $data);
	}
	
	function tampilkan_kartu_hutang(){
		
		$awal					= date_format(new DateTime($this->input->post('tgl_awal')), "Y-m-d");
		$akhir					= date_format(new DateTime($this->input->post('tgl_akhir')), "Y-m-d");
		$supplier    			= $this->input->post('id_klien');
		
		
		
			
		$data['judul']			= "Kartu Hutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_hutang/excel_kartuhutang/' . $awal . '/' . $akhir . '/' . $supplier);
		

		} else {	
		
            $data['datklien']           = $this->Report_model->pilih_vendor();
			//$data['coa_sa']				= $this->Kartuhutang_model->GetData($awal,$supplier);
			$data['datawal']               = $awal;
			$data['datakhir']              = $akhir;
			$data['datvendor']             = $supplier;
			
			$this->load->view("report/v_kartu_hutang", $data);
		}
	}
	
	function excel_kartuhutang()
	{
		$data['judul']			= "Kartu Hutang";

		$awal               = $this->uri->segment(3);
		$akhir              = $this->uri->segment(4);
		$supplier			= $this->uri->segment(5);
		
		
		
		$data['datawal']               = $awal;
		$data['datakhir']              = $akhir;
		$data['datvendor']             = $supplier;

	    $data['coa_sa']				= $this->Kartuhutang_model->GetData($awal,$supplier);
		$data['detail_jurnal']		= $this->Kartuhutang_model->get_detail_kartu_hutang($awal,$akhir,$supplier);

		$this->load->view("report/v_kartu_hutang_excel", $data);
				
	}
	
	
	function rekap_kartu_hutang(){
		
		$awal					= date_format(new DateTime($this->input->post('tgl_awal')), "Y-m-d");
		$akhir					= date_format(new DateTime($this->input->post('tgl_akhir')), "Y-m-d");
			
		$data['judul']			= "Kartu Hutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_hutang/excel_rekapkartuhutang/' . $awal . '/' . $akhir);
		

		} else {	
		
		    $Vendor  = $this->Kartuhutang_model->GetVendor();
			
			// print_r($Vendor);
			// exit;
		
          	$data['vendor']				   = $this->Kartuhutang_model->GetVendor();
			$data['datawal']               = $awal;
			$data['datakhir']              = $akhir;
					
			$this->load->view("report/v_rekap_kartu_hutang", $data);
		}
	}
	
	function excel_rekapkartuhutang()
	{
		$data['judul']			= "Kartu Hutang";

		$awal               = $this->uri->segment(3);
		$akhir              = $this->uri->segment(4);
		
		$data['datawal']               = $awal;
		$data['datakhir']              = $akhir;
		
	    $data['vendor']				   = $this->Kartuhutang_model->GetVendor();

		$this->load->view("report/v_rekap_kartu_hutang_excel", $data);
				
	}
	
	
	function tampilkan_umur_kartuhutang(){
		
		$awal					= $this->input->post('tgl_awal');
		$akhir					= $this->input->post('tgl_akhir');
		$supplier    			= $this->input->post('id_klien');
		
		// print_r($this->input->post());
		// exit;
			
		$data['judul']			= "Umur Kartu Hutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_hutang/excel_umurkartuhutang/'. $supplier.'/'.$akhir);
		

		} else {	
		
            $data['datklien']           = $this->Report_model->pilih_vendor();
			$data['coa_sa']				= $this->Kartuhutang_model->GetDataUmur($awal,$akhir,$supplier);
			$data['datawal']               = $awal;
			$data['datakhir']              = $akhir;
			$data['datvendor']             = $supplier;
			
			$this->load->view("report/v_umur_kartu_hutang", $data);
		}
	}
	
	function excel_umurkartuhutang()
	{
		$data['judul']			= "Umur Kartu Hutang";

		$supplier               = $this->uri->segment(3);
		$akhir              = $this->uri->segment(4);
		$awal    			= $this->uri->segment(5);
		
		
		// print_r($awal);
		// print_r($akhir);
		// print_r($supplier);
		// exit;
	
		$data['datvendor']             = $supplier;

	    $data['coa_sa']				= $this->Kartuhutang_model->GetDataUmur($awal,$akhir,$supplier);
		

		$this->load->view("report/v_umur_kartu_hutang_excel", $data);
				
	}
	
	function rekap_umur_kartu_hutang(){
		
		$akhir					= $this->input->post('tgl_akhir');
		$data['judul']			= "Umur Kartu Hutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_hutang/excel_rekapumurkartuhutang/'.$akhir);
		

		} else {	
		
		    $Vendor  = $this->Kartuhutang_model->GetVendor();
		    $data['coa_sa']				   = $this->Kartuhutang_model->GetDataBukti();
          	$data['vendor']				   = $this->Kartuhutang_model->GetVendor();
			$data['datakhir']              = $akhir;
			
			$this->load->view("report/v_rekap_umur_kartu_hutang", $data);
		}
	}
	
	function excel_rekapumurkartuhutang()
	{
		$akhir              = $this->uri->segment(3);
		
		$data['judul']			= "Rekap Umur Kartu Hutang";
		$data['datakhir']       = $akhir;
		$this->load->view("report/v_rekap_umur_kartu_hutang_excel", $data);
				
	}
	
	
}