<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kartu_piutang extends CI_Controller
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
		$this->load->model('Kartupiutang_model');
	}

	
	function index()
	{
		$data['judul']			= "Laporan Piutang";
		$data['datklien']     = $this->Report_model->pilih_vendor();
		$this->load->view("report/v_kartu_h", $data);
	}
	
	function tampilkan_kartu_piutang(){
		
		$awal					= date_format(new DateTime($this->input->post('tgl_awal')), "Y-m-d");
		$akhir					= date_format(new DateTime($this->input->post('tgl_akhir')), "Y-m-d");
		$klien       			= $this->input->post('id_klien');
		
		// print_r($klien);
		// exit;
		
		
			
		$data['judul']			= "Kartu Piutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_piutang/excel_kartupiutang/' . $awal . '/' . $akhir . '/' . $klien);
		

		} else {	
		
            $data['datklien']           = $this->Report_model->pilih_klien();
			// if($klien=='0'){
			// $data['coa_sa']				= $this->Kartupiutang_model->GetDataPiutangAll($awal,$akhir);
			// }else{
			// $data['coa_sa']				= $this->Kartupiutang_model->GetData($awal,$klien);	
			// }
			$data['datawal']               = $awal;
			$data['datakhir']              = $akhir;
			$data['datvendor']             = $klien;
			
			$this->load->view("piutang/v_kartu_piutang", $data);
		}
	}
	
	
	function excel_kartupiutang()
	{
		$data['judul']			= "Kartu Piutang";

		$awal               = $this->uri->segment(3);
		$akhir              = $this->uri->segment(4);
		$supplier			= $this->uri->segment(5);
		
		
		
		$data['datawal']               = $awal;
		$data['datakhir']              = $akhir;
		$data['datvendor']             = $supplier;

	    $data['coa_sa']				= $this->Kartupiutang_model->GetData($awal,$supplier);
		$data['detail_jurnal']		= $this->Kartupiutang_model->get_detail_kartu_piutang($awal,$akhir,$supplier);

		$this->load->view("piutang/v_kartu_piutang_excel", $data);
				
	}
	
	function rekap_kartu_piutang(){
		
		$awal					= date_format(new DateTime($this->input->post('tgl_awal')), "Y-m-d");
		$akhir					= date_format(new DateTime($this->input->post('tgl_akhir')), "Y-m-d");
			
			
		$data['judul']			= "Rekap Kartu Piutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_piutang/excel_rekapkartupiutang/' . $awal . '/' . $akhir);
		

		} else {	
		
          	$data['vendor']				   = $this->Kartupiutang_model->GetKlien();
			$data['datawal']               = $awal;
			$data['datakhir']              = $akhir;
					
			$this->load->view("piutang/v_rekap_kartu_piutang", $data);
		}
	}
	
	function excel_rekapkartupiutang()
	{
		$data['judul']			= "Rekap Kartu Piutang";

		$awal               = $this->uri->segment(3);
		$akhir              = $this->uri->segment(4);
		
		$data['datawal']               = $awal;
		$data['datakhir']              = $akhir;
		
	    $data['vendor']				   = $this->Kartupiutang_model->GetKlien();

		$this->load->view("piutang/v_rekap_kartu_piutang_excel", $data);
				
	}
	
	function tampilkan_umur_kartupiutang(){
		
		$awal					= date_format(new DateTime($this->input->post('tgl_awal')), "Y-m-d");
		$akhir					= date_format(new DateTime($this->input->post('tgl_akhir')), "Y-m-d");
		$supplier    			= $this->input->post('id_klien');
		
		// print_r($this->input->post());
		// exit;
			
		$data['judul']			= "Umur Kartu Piutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_piutang/excel_umurkartupiutang/'. $supplier);
		

		} else {	
		
            $data['datklien']           = $this->Report_model->pilih_klien();
			$data['coa_sa']				= $this->Kartupiutang_model->GetDataUmur($awal,$akhir,$supplier);
			$data['datawal']               = $awal;
			$data['datakhir']              = $akhir;
			$data['datvendor']             = $supplier;
			
			$this->load->view("piutang/v_umur_kartu_piutang", $data);
		}
	}
	
	function excel_umurkartupiutang()
	{
		$data['judul']			= "Umur Kartu Piutang";

		$supplier           = $this->uri->segment(3);
		$akhir              = $this->uri->segment(4);
		$awal    			= $this->uri->segment(5);
		
		
		
	
		$data['datvendor']             = $supplier;

	    $data['coa_sa']				= $this->Kartupiutang_model->GetDataUmur($awal,$akhir,$supplier);
		

		$this->load->view("piutang/v_umur_kartu_piutang_excel", $data);
				
	}
	
	function rekap_umur_kartu_piutang(){
		
		
		$akhir					= date_format(new DateTime($this->input->post('tgl_akhir')), "Y-m-d");
		
		$data['judul']			= "Kartu Piutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_piutang/excel_rekapumurkartuhutang/'.$akhir);
		

		} else {	
		
		    $Vendor  = $this->Kartupiutang_model->GetVendor();
			$data['datakhir']              = $akhir;
		    $data['coa_sa']				   = $this->Kartupiutang_model->GetDataBukti();
          	$data['vendor']				   = $this->Kartupiutang_model->GetVendor();
			$this->load->view("piutang/v_rekap_umur_kartu_piutang", $data);
		}
	}
	
	function excel_rekapumurkartupiutang()
	{
		
		$akhir                  = $this->uri->segment(3);
		$data['datakhir']       = $akhir;
		$data['judul']			= "Rekap Umur Kartu Piutang";
		$this->load->view("piutang/v_rekap_umur_kartu_piutang_excel", $data);
				
	}
	
	function tampilkan_detail_invoice(){
		
		$awal					= date_format(new DateTime($this->input->post('tgl_awal')), "Y-m-d");
		$akhir					= date_format(new DateTime($this->input->post('tgl_akhir')), "Y-m-d");
		$klien       			= $this->input->post('id_klien');
		
		// print_r($this->input->post());
		// exit;
		
		
			
		$data['judul']			= "Laporan Detail Invoice";

		if ($this->input->post('tampilkan') == "View Excel") {
			
		redirect('kartu_piutang/excel_detailinvoice/' . $awal . '/' . $akhir . '/' . $klien);
		

		} else {	
		
            $data['datklien']           = $this->Report_model->pilih_klien();
			$data['coa_sa']				= $this->Kartupiutang_model->GetData($awal,$klien);
			$data['datawal']               = $awal;
			$data['datakhir']              = $akhir;
			$data['datvendor']             = $klien;
			
			$this->load->view("piutang/v_detail_invoice", $data);
		}
	}
	
	function excel_detailinvoice()
	{
		$data['judul']			= "Laporan Detail Invoice";

		$awal               = $this->uri->segment(3);
		$akhir              = $this->uri->segment(4);
		$supplier			= $this->uri->segment(5);
		
		
		
		$data['datawal']               = $awal;
		$data['datakhir']              = $akhir;
		$data['datvendor']             = $supplier;

	    $data['coa_sa']				= $this->Kartupiutang_model->GetData($awal,$supplier);
		$data['detail_jurnal']		= $this->Kartupiutang_model->get_detail_kartu_piutang($awal,$akhir,$supplier);

		$this->load->view("piutang/v_detail_invoice_excel", $data);
				
	}
	
}