<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('Jurnal_model');
		$this->load->model('Order_model');
		//$this->load->model('custom_model');
		//$this->load->model('master_model');
		//$this->load->model('komisi_model');
		$this->load->helper('menu');
		$this->load->model('Invoice_model');
		$this->load->model('Report_model');
	}
	
	function jurnal(){	
		$data['judul']		= "List Jurnal";
		$data['list_data'] = $this->Jurnal_model->list_jurnal();
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();
		
		$this->load->view("report/v_list_jurnal",$data);
				
	}	

	function filter_noperkiraan(){		
		
		$data['judul']		= "List Jurnal";	
			
			$data['filter_nok']	= $this->Jurnal_model->get_nokir_filter();
			$data['list_data'] = $this->Jurnal_model->list_jurnal();
			$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();

			$this->load->view("report/v_list_jurnal_filter_nokir",$data);
		}
	

	function filter_tgl_jurnal(){		
		$data['list_data'] = $this->Jurnal_model->list_jurnal();
		
		$data['judul']		= "List Jurnal";
		if($this->input->post('view')=="View List Excel"){
			$date = $this->input->post('tanggal');
			$date = str_replace(" - ","_",$date);
			$date2 = $this->input->post('tanggal2');
			$date2 = str_replace(" - ","_",$date2);
		redirect('report/view_excel/'.$date.'/'.$date2);
		
		}else{
			$tanggal = $this->input->post('tanggal');
		    $tanggal2 = $this->input->post('tanggal2');
		
			if (empty($tanggal)) {
				$tanggal = date('Y-m-d');
			}

	        if (empty($tanggal2)) {
				$tanggal2 = date('Y-m-d');
			}
		
			$data['tanggal']		= $tanggal;
			$data['tanggal2']		= $tanggal2;
			
			$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_jurnal($tanggal,$tanggal2);
			$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();
		
			$this->load->view("report/v_list_jurnal_filter",$data);
		}
	}

	function view_excel(){
		
		$tanggal = $this->uri->segment(3);
			if (empty($tanggal)) {
				$tanggal = date('Y-m-d');
			}
	    
        $tanggal2 = $this->uri->segment(4);
	
	        if (empty($tanggal2)) {
				$tanggal2 = date('Y-m-d');
			}
		
        $data['tanggal']			= $tanggal;
		$data['tanggal2']			= $tanggal2;
		
        $data['filter_tgl']	= $this->Jurnal_model->filter_tgl_jurnal($tanggal,$tanggal2);
		
		$this->load->view("report/view_excel",$data);
		
	}

	public function marketing(){
		$data	= [
			'judul'			=> "Report Marketing",
			'list_marketing'=> $this->db->query("SELECT * FROM dk_user WHERE sts_marketing='Y'")->result()
		];
		$this->load->view('report/marketing', $data);
	}
	
	public function gedung(){
		$tahun	= empty($this->input->post('tahun')) ? date('Y') : $this->input->post('tahun');

		$data	= [
			'judul'			=> "Report Gedung",
			'list_gedung'	=> $this->Order_model->get_list_tempat_lokasi($tahun)
		];
		$this->load->view('report/gedung', $data);
	}

	function refresh_periode(){
		$data['judul'] = "Refresh Periode";
		//$data['list_data'] = $this->Order_model->list_request_stock();
		$this->load->view('report/v_refresh_periode',$data);
	}

	function proses_refresh_periode(){
		$data['judul'] = "Proses Refresh Periode";
		$bln_periode = $this->input->post('bulan_periode');
		$thn_periode = $this->input->post('tahun_periode');
		//$blnthn_periode = $bln_periode."-".$thn_periode;
		
		if($bln_periode > 9){
			$blnthn_periode = $bln_periode."-".$thn_periode;			
		}else{
			$blnthn_periode = "0".$bln_periode."-".$thn_periode;
		}	
		
		$cek_periode = $this->Report_model->get_periode($blnthn_periode);
		//$cek_periode = $this->db->query("SELECT * FROM periode WHERE periode='$blnthn_periode'")->result();
		if($cek_periode > 0){			
				$this->db->query("UPDATE periode set stsaktif='C' ");
				$this->db->query("UPDATE periode set stsaktif='O' WHERE periode='$blnthn_periode'");		
		}else{
			$this->db->query("UPDATE periode set stsaktif='C' ");
			$this->db->query("INSERT INTO periode (periode,stsaktif) VALUES ('$blnthn_periode','O')");
			//periode,noJS,noJP,noJO,noJC,noJM,noJD,open_date,closing_date,user,stsaktif,stspost,stslock,kdcab,post_laba,company
			//'$blnthn_periode',0,0,0,0,0,0,'0000-00-00','0000-00-00','','O',0,0,'SUP',1,'AAMT'
		}
		//$data['list_data'] = $this->Order_model->list_request_stock();
		//echo $blnthn_periode;
		//exit;

		$data['proses'] = 2;
		$this->load->view('report/v_refresh_periode',$data);
	}

	function ledger(){	
		$data['judul']			= "Laporan Ledger";
		
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();

		$this->load->view("report/v_ledger",$data);
				
	}

	function tampilkan_ledger(){	
		$data['judul']			= "Laporan Ledger";

		if($this->input->post('tampilkan')=="View Excel"){
			$var_bln					= $this->input->post('bulan_ledger');
			$var_thn					= $this->input->post('tahun_ledger');
			$var_filter_nokir			= $this->input->post('filter_nokir');
			$var_filter_nokir2			= $this->input->post('filter_nokir2');
			$filter_nokir = substr($var_filter_nokir,0,10);
			$filter_nokir2 = substr($var_filter_nokir2,0,10);
			redirect('report/excel_ledger/'.$var_bln.'/'.$var_thn.'/'.$filter_nokir.'/'.$filter_nokir2);
			//redirect('report/ledger');
		
		}else{
			$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();

			$var_bulan					= $this->input->post('bulan_ledger');
			$var_tahun					= $this->input->post('tahun_ledger');
			$data['bln_ledger']			= $this->input->post('bulan_ledger');
			$data['thn_ledger']			= $this->input->post('tahun_ledger');
			$var_filter_nokir			= $this->input->post('filter_nokir');
			$var_filter_nokir2			= $this->input->post('filter_nokir2');
			$data['filter_nokir']			= $this->input->post('filter_nokir');
			$data['filter_nokir2']			= $this->input->post('filter_nokir2');
			$filter_nokir = substr($var_filter_nokir,0,10);
			$filter_nokir2 = substr($var_filter_nokir2,0,10);
	
			$awal=1;
			$akhir=31;
			$enol=0;
			if($var_bulan > 9){
				$var_tgl_awal = $var_tahun."-".$var_bulan."-0".$awal;
				$var_tgl_akhir = $var_tahun."-".$var_bulan."-".$akhir;
			}else{
				$var_tgl_awal = $var_tahun."-".$enol.$var_bulan."-0".$awal;
				$var_tgl_akhir = $var_tahun."-".$enol.$var_bulan."-".$akhir;
			}	

			$data['coa_sa']				= $this->Report_model->get_coa_sa($filter_nokir,$filter_nokir2,$var_bulan,$var_tahun);
			$data['detail_jurnal']		= $this->Report_model->get_detail_jurnal($filter_nokir,$filter_nokir2,$var_tgl_awal,$var_tgl_akhir);

			$this->load->view("report/v_list_ledger",$data);
		}
	}

	function excel_ledger(){	
		$data['judul']			= "Laporan Laba Rugi";

		$var_bulan = $this->uri->segment(3);
		$var_tahun = $this->uri->segment(4);
			
			$data['bln_ledger']			= $var_bulan;
			$data['thn_ledger']			= $var_tahun;
			$filter_nokir			= $this->uri->segment(5);
			$filter_nokir2			= $this->uri->segment(6);			

			$awal=1;
			$akhir=31;
			$enol=0;
			if($var_bulan > 9){
				$var_tgl_awal = $var_tahun."-".$var_bulan."-0".$awal;
				$var_tgl_akhir = $var_tahun."-".$var_bulan."-".$akhir;
			}else{
				$var_tgl_awal = $var_tahun."-".$enol.$var_bulan."-0".$awal;
				$var_tgl_akhir = $var_tahun."-".$enol.$var_bulan."-".$akhir;
			}	

			$data['coa_sa']				= $this->Report_model->get_coa_sa($filter_nokir,$filter_nokir2,$var_bulan,$var_tahun);
			$data['detail_jurnal']		= $this->Report_model->get_detail_jurnal($filter_nokir,$filter_nokir2,$var_tgl_awal,$var_tgl_akhir);

		$this->load->view("report/v_ledger_excel",$data);
		//redirect('report/print_labarugi');		
	}

	function tutup_bulan(){
		$data['judul'] = "Proses Tutup Bulan";
		//$data['list_data'] = $this->Order_model->list_request_stock();
		$this->load->view('report/v_tutup_bulan',$data);
	}

	function proses_tutup_bulan(){
		$data['judul'] = "Proses Tutup Bulan";
		$data['proses'] = 2;
		//$data['list_data'] = $this->Order_model->list_request_stock();
		$this->load->view('report/v_tutup_bulan',$data);
	}

	function labarugi(){	
		$data['judul']			= "Laporan Laba Rugi";
		$this->load->view("report/v_labarugi",$data);				
	}
 
	function tampilkan_labarugi(){	
		$data['judul']			= "Laporan Laba Rugi";

		if($this->input->post('tampilkan')=="View Excel"){
			$var_bln					= $this->input->post('bulan_labarugi');
			$var_thn					= $this->input->post('tahun_labarugi');
			redirect('report/excel_labarugi/'.$var_bln.'/'.$var_thn);
		
		}else{

			$var_bulan					= $this->input->post('bulan_labarugi');
			$var_tahun					= $this->input->post('tahun_labarugi');

			$data['data_bulan']		= $this->Report_model->get_bulan_coa();
			$data['data_tahun']		= $this->Report_model->get_tahun_coa();

			$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn($var_bulan,$var_tahun);
			$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2($var_bulan,$var_tahun);
			$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp($var_bulan,$var_tahun);
			$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya($var_bulan,$var_tahun);
			$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2($var_bulan,$var_tahun);
			$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3($var_bulan,$var_tahun);		
			
			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;

			$this->load->view("report/v_list_labarugi",$data);
			//redirect('report/print_labarugi');
		}		
	}

	function excel_labarugi(){	
		$data['judul']			= "Laporan Laba Rugi";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$var_bulan = $this->uri->segment(3);
		$var_tahun = $this->uri->segment(4);
		
		$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn($var_bulan,$var_tahun);
		$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2($var_bulan,$var_tahun);
		$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp($var_bulan,$var_tahun);
		$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya($var_bulan,$var_tahun);
		$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2($var_bulan,$var_tahun);
		$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3($var_bulan,$var_tahun);	
		
		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("report/v_labarugi_excel",$data);
		//redirect('report/print_labarugi');		
	}	

	function print_labarugi(){
		$var_bulan					= $this->input->post('bulan_labarugi');
		$var_tahun					= $this->input->post('tahun_labarugi');

		$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn($var_bulan,$var_tahun);
		$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2($var_bulan,$var_tahun);
		$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp($var_bulan,$var_tahun);
		$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya($var_bulan,$var_tahun);
		$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2($var_bulan,$var_tahun);
		$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3($var_bulan,$var_tahun);	
		
		$data['data_bulan']			= $var_bulan;
		$data['data_tahun']			= $var_tahun;
		
		$html			= $this->load->view('report/v_print_labarugi',$data,true);
		$pdfFilePath	= "Laporan_Laba_Rugi_".$var_bulan."_".$var_tahun.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load(); 
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('L', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
		//redirect('report/tampilkan_labarugi');
	}
	
	function neraca(){	
		$data['judul']			= "Laporan Neraca";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$this->load->view("report/v_neraca",$data);
				
	}

	function tampilkan_neraca(){	
		$data['judul']			= "Laporan Neraca";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$var_bulan					= $this->input->post('bulan_neraca');
		$var_tahun					= $this->input->post('tahun_neraca');
		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$data['data_HartaLancar']	= $this->Report_model->get_HartaLancar($var_bulan,$var_tahun);
		$data['data_AktivaTetap']	= $this->Report_model->get_AktivaTetap($var_bulan,$var_tahun);
		$data['data_AktivaLain']	= $this->Report_model->get_AktivaLain($var_bulan,$var_tahun);
		$data['data_Hutang']		= $this->Report_model->get_Hutang($var_bulan,$var_tahun);
		$data['data_Modal']			= $this->Report_model->get_Modal($var_bulan,$var_tahun);
		$data['data_Laba']			= $this->Report_model->get_Laba($var_bulan,$var_tahun);
		
		$this->load->view("report/v_list_neraca",$data);
				
	}

	function excel_neraca(){	
		$data['judul']			= "Laporan Neraca";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$data['data_HartaLancar']	= $this->Report_model->get_HartaLancar();
		$data['data_AktivaTetap']	= $this->Report_model->get_AktivaTetap();
		$data['data_AktivaLain']	= $this->Report_model->get_AktivaLain();
		$data['data_Hutang']		= $this->Report_model->get_Hutang();
		$data['data_Modal']			= $this->Report_model->get_Modal();
		$data['data_Laba']			= $this->Report_model->get_Laba();
		$var_bulan					= $this->input->post('bulan_neraca');
		$var_tahun					= $this->input->post('tahun_neraca');
		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("report/v_neraca_excel",$data);
			
	}	

	function print_neraca(){
		$data['data_HartaLancar']	= $this->Report_model->get_HartaLancar();
		$data['data_AktivaTetap']	= $this->Report_model->get_AktivaTetap();
		$data['data_AktivaLain']	= $this->Report_model->get_AktivaLain();
		$data['data_Hutang']		= $this->Report_model->get_Hutang();
		$data['data_Modal']			= $this->Report_model->get_Modal();
		$data['data_Laba']			= $this->Report_model->get_Laba();
		$var_bulan					= $this->input->post('bulan_neraca');
		$var_tahun					= $this->input->post('tahun_neraca');
		$data['data_bulan_post']	= $var_bulan;
		$data['data_tahun_post']	= $var_tahun;
		
		$html			= $this->load->view('report/v_print_neraca',$data,true);
		$pdfFilePath	= "Laporan_Neraca_".$var_bulan."_".$var_tahun.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load(); 
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('L', '', '', '',
				10, // margin_left
				10, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
		//redirect('report/tampilkan_labarugi');
	}
}