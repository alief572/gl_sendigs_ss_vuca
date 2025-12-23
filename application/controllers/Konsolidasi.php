<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Konsolidasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
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

		$this->load->library('session');
		$this->load->library('datatables');
		$this->session->userdata('pn_name');
		$this->load->model('Konsolidasi_model');
		
	}

	function view_excel()
	{

		$data['judul']			= "Laporan Performance Konsolidasi";

		$bln = $this->uri->segment(3);
		$thn = $this->uri->segment(4);

		$data['data_bulan_post']			= $bln;
		$data['data_tahun_post']			= $thn;

		$awal = 1;
		$akhir = 31;
		$enol = 0;
		if ($bln > 9) {
			$var_tgl_awal = $thn . "-" . $bln . "-0" . $awal;
			$var_tgl_akhir = $thn . "-" . $bln . "-" . $akhir;
		} else {
			$var_tgl_awal = $thn . "-" . $enol . $bln . "-0" . $awal;
			$var_tgl_akhir = $thn . "-" . $enol . $bln . "-" . $akhir;
		}

		$data['data_coa']	= $this->Konsolidasi_model->get_coa($bln, $thn);

		$this->load->view("konsolidasi/v_konsolidasi_performance_excel", $data);
	}
	
	function ctrl_labarugi()
	{
		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bulan					= $this->input->post('bulan_ctrlabarugi');
			$var_tahun					= $this->input->post('tahun_ctrlabarugi');
			redirect('konsolidasi/view_excel/' . $var_bulan . '/' . $var_tahun);
		} else {
			$data['judul']			= "Laporan Kontrol Laba Rugi";

			if ($this->input->post()) {
				$bln	= $this->input->post('bulan_ctrlabarugi');
				$thn	= $this->input->post('tahun_ctrlabarugi');
			} else {
				$cek_periode_aktif			= $this->Konsolidasi_model->cek_periode_aktif();
				if ($cek_periode_aktif > 0) {
					foreach ($cek_periode_aktif as $row_periode_aktif) {
						$tgl_periode_aktif	= $row_periode_aktif->periode;
						$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
						$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
						$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
						$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
					}
				}
				$bln	= $bln_aktif;
				$thn	= $thn_aktif;
			}

			$data['data_bulan_post']			= $bln;
			$data['data_tahun_post']			= $thn;

			$data['data_coa']		= $this->Konsolidasi_model->get_coa($bln, $thn);

			$this->load->view('konsolidasi/v_ctrl_labarugi', $data);
		}
	}

	function performance()
	{
		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bulan					= $this->input->post('bulan_performance');
			$var_tahun					= $this->input->post('tahun_performance');
			redirect('konsolidasi/view_excel/' . $var_bulan . '/' . $var_tahun);
		} else {
			$data['judul']			= "Laporan Performance Konsolidasi";
			if ($this->input->post()) {
				$bln	= $this->input->post('bulan_performance');
				$thn	= $this->input->post('tahun_performance');
			} else {
				$cek_periode_aktif			= $this->Konsolidasi_model->cek_periode_aktif();
				if ($cek_periode_aktif > 0) {
					foreach ($cek_periode_aktif as $row_periode_aktif) {
						$tgl_periode_aktif	= $row_periode_aktif->periode;
						$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
						$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
						$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
						$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
					}
				}
				$bln	= $bln_aktif;
				$thn	= $thn_aktif;
			}
			$data['data_bulan_post']			= $bln;
			$data['data_tahun_post']			= $thn;

			$data['data_coa']	= $this->Konsolidasi_model->get_coa($bln, $thn);

			$this->load->view('konsolidasi/v_konsolidasi_performance', $data);
		}
	}


	function tampilkan_neraca_konsolidasi()
	{
		$data['judul']			= "Laporan Neraca Konsolidasi";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_neraca');
			$var_thn					= $this->input->post('tahun_neraca');
			$level						= $this->input->post('level');
			redirect('konsolidasi/excel_neraca_konsolidasi/' . $var_bln . '/' . $var_thn . '/' . $level);
		} elseif ($this->input->post('tampilkan') == "View Pdf") {
			$var_bln					= $this->input->post('bulan_neraca');
			$var_thn					= $this->input->post('tahun_neraca');
			$level						= $this->input->post('level');
			redirect('konsolidasi/print_neraca_konsolidasi/' . $var_bln . '/' . $var_thn . '/' . $level);
		} else {
			$data['judul']			= "Laporan Neraca Konsolidasi";

			$var_bulan					= $this->input->post('bulan_neraca');
			$var_tahun					= $this->input->post('tahun_neraca');
			$level						= $this->input->post('level');
			$data['level']						= $this->input->post('level');
			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;

			$data['data_HartaLancar']	= $this->Report_model->get_HartaLancar($var_bulan, $var_tahun, $level);
			$data['data_tdkHartaLancar'] = $this->Report_model->get_tdkHartaLancar($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap']	= $this->Report_model->get_AktivaTetap($var_bulan, $var_tahun, $level);
			$data['data_AktivaLain']	= $this->Report_model->get_AktivaLain($var_bulan, $var_tahun, $level);
			$data['data_Hutang']		= $this->Report_model->get_Hutang($var_bulan, $var_tahun, $level);
			$data['data_Modal']			= $this->Report_model->get_Modal($var_bulan, $var_tahun, $level);
			$data['data_Laba']			= $this->Report_model->get_Laba($var_bulan, $var_tahun, $level);

			$this->load->view("konsolidasi/v_list_neraca", $data);
		}
	}
	
	function print_neraca_konsolidasi()
	{
		$var_bulan 	= $this->uri->segment(3);
		$var_tahun 	= $this->uri->segment(4);
		$level		= $this->uri->segment(5);

		$data['level']				= $level;

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$data['data_HartaLancar']	= $this->Report_model->get_HartaLancar($var_bulan, $var_tahun, $level);
		$data['data_tdkHartaLancar'] = $this->Report_model->get_tdkHartaLancar($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap']	= $this->Report_model->get_AktivaTetap($var_bulan, $var_tahun, $level);
		$data['data_AktivaLain']	= $this->Report_model->get_AktivaLain($var_bulan, $var_tahun, $level);
		$data['data_Hutang']		= $this->Report_model->get_Hutang($var_bulan, $var_tahun, $level);
		$data['data_Modal']			= $this->Report_model->get_Modal($var_bulan, $var_tahun, $level);
		$data['data_Laba']			= $this->Report_model->get_Laba($var_bulan, $var_tahun, $level);

		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$html			= $this->load->view('konsolidasi/v_print_neraca', $data, true);
		$pdfFilePath	= "Laporan_Neraca_" . $var_bulan . "_" . $var_tahun . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P', // L = Landscape, P = Potrait
			'',
			'',
			'',
			30, // margin_left
			30, // margin right
			20, // margin top
			10, // margin bottom
			10, // margin header
			10
		); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		//redirect('report/tampilkan_labarugi');
	}

	function excel_neraca_konsolidasi()
	{
		$var_bulan 	= $this->uri->segment(3);
		$var_tahun 	= $this->uri->segment(4);
		$level		= $this->uri->segment(5);

		$data['level']				= $level;

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$data['data_HartaLancar']	= $this->Report_model->get_HartaLancar($var_bulan, $var_tahun, $level);
		$data['data_tdkHartaLancar'] = $this->Report_model->get_tdkHartaLancar($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap']	= $this->Report_model->get_AktivaTetap($var_bulan, $var_tahun, $level);
		$data['data_AktivaLain']	= $this->Report_model->get_AktivaLain($var_bulan, $var_tahun, $level);
		$data['data_Hutang']		= $this->Report_model->get_Hutang($var_bulan, $var_tahun, $level);
		$data['data_Modal']			= $this->Report_model->get_Modal($var_bulan, $var_tahun, $level);
		$data['data_Laba']			= $this->Report_model->get_Laba($var_bulan, $var_tahun, $level);

		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("konsolidasi/v_neraca_excel", $data);
	}
	
	
	function tampilkan_labarugi_konsolidasi()
	{
		$data['judul']			= "Income Statement Konsolidasi";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_labarugi');
			$var_thn					= $this->input->post('tahun_labarugi');
			$level						= $this->input->post('level');
			redirect('konsolidasi/excel_labarugi_konsolidasi/' . $var_bln . '/' . $var_thn . '/' . $level);
		} elseif ($this->input->post('tampilkan') == "View Pdf") {
			$var_bln					= $this->input->post('bulan_labarugi');
			$var_thn					= $this->input->post('tahun_labarugi');
			$level						= $this->input->post('level');
			redirect('konsolidasi/print_labarugi_konsolidasi/' . $var_bln . '/' . $var_thn . '/' . $level);
		} else {

			$var_bulan					= $this->input->post('bulan_labarugi');
			$var_tahun					= $this->input->post('tahun_labarugi');
			$level						= $this->input->post('level');
			$data['level']				= $this->input->post('level');

			$data['data_bulan']		= $this->Report_model->get_bulan_coa();
			$data['data_tahun']		= $this->Report_model->get_tahun_coa();

			$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn($var_bulan, $var_tahun, $level);
			$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2($var_bulan, $var_tahun, $level);
			$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp($var_bulan, $var_tahun, $level);
			$data['data_nokir_biaya52'] = $this->Report_model->get_nokir_biaya52($var_bulan, $var_tahun, $level);
			$data['data_nokir_biaya61']	= $this->Report_model->get_nokir_biaya61($var_bulan, $var_tahun, $level);
			$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya($var_bulan, $var_tahun, $level);
			$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2($var_bulan, $var_tahun, $level);
			$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3($var_bulan, $var_tahun, $level);
			$data['data_nokir_fee']		= $this->Report_model->get_nokir_fee($var_bulan, $var_tahun, $level);

			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;

			$this->load->view("konsolidasi/v_list_labarugi", $data);
			//redirect('report/print_labarugi');
		}
	}

	function excel_labarugi_konsolidasi()
	{
		$data['judul']			= "Income Statement";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$var_bulan = $this->uri->segment(3);
		$var_tahun = $this->uri->segment(4);
		$level = $this->uri->segment(5);
		$data['level']				= $this->input->post('level');

		$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn($var_bulan, $var_tahun, $level);
		$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2($var_bulan, $var_tahun, $level);
		$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya52'] = $this->Report_model->get_nokir_biaya52($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya61']	= $this->Report_model->get_nokir_biaya61($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3($var_bulan, $var_tahun, $level);
		$data['data_nokir_fee']		= $this->Report_model->get_nokir_fee($var_bulan, $var_tahun, $level);

		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("konsolidasi/v_labarugi_excel", $data);
		//redirect('report/print_labarugi');		
	}

	function print_labarugi_konsolidasi()
	{
		$var_bulan 	= $this->uri->segment(3);
		$var_tahun 	= $this->uri->segment(4);
		$level		= $this->uri->segment(5);

		$data['level']				= $level;

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn($var_bulan, $var_tahun, $level);
		$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2($var_bulan, $var_tahun, $level);
		$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya52'] = $this->Report_model->get_nokir_biaya52($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya61']	= $this->Report_model->get_nokir_biaya61($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2($var_bulan, $var_tahun, $level);
		$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3($var_bulan, $var_tahun, $level);
		$data['data_nokir_fee']		= $this->Report_model->get_nokir_fee($var_bulan, $var_tahun, $level);

		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$html			= $this->load->view('konsolidasi/v_print_labarugi', $data, true);
		$pdfFilePath	= "Laporan_Laba_Rugi_" . $var_bulan . "_" . $var_tahun . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P', // L = Landscape, P = Potrait
			'',
			'',
			'',
			30, // margin_left
			30, // margin right
			20, // margin top
			10, // margin bottom
			10, // margin header
			10
		); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		//redirect('report/tampilkan_labarugi');
	}
	
	function tampilkan_trial_balance_konsolidasi()
	{

		$data['judul']	= "Trial Balance Report Konsolidasi";
		$data['judul2'] = "Trial Balance Konsolidasi" . $this->session->userdata('kode_cabang');

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_trial_balance');
			$var_thn					= $this->input->post('tahun_trial_balance');
			redirect('konsolidasi/excel_trial_balance_konsolidasi/' . $var_bln . '/' . $var_thn);
		} elseif ($this->input->post('tampilkan') == "View Pdf") {
			$var_bln					= $this->input->post('bulan_trial_balance');
			$var_thn					= $this->input->post('tahun_trial_balance');
			redirect('konsolidasi/print_trial_balance_konsolidasi/' . $var_bln . '/' . $var_thn);
		} else {

			$var_bulan					= $this->input->post('bulan_trial_balance');
			$var_tahun					= $this->input->post('tahun_trial_balance');

			$data['data_bulan']		= $this->Report_model->get_bulan_coa();
			$data['data_tahun']		= $this->Report_model->get_tahun_coa();

			$data['data_nokir_hartalancar11']	= $this->Report_model->get_nokir_hartalancar11($var_bulan, $var_tahun);
			$data['data_nokir_aktivatetap13']	= $this->Report_model->get_nokir_aktivatetap13($var_bulan, $var_tahun);
			$data['data_nokir_aktivalain19']	= $this->Report_model->get_nokir_aktivalain19($var_bulan, $var_tahun);
			$data['data_nokir_totalaktiva']		= $this->Report_model->get_nokir_totalaktiva($var_bulan, $var_tahun);
			$data['data_nokir_totalpassiva']	= $this->Report_model->get_nokir_totalpassiva($var_bulan, $var_tahun);
			$data['data_nokir_hutang21']		= $this->Report_model->get_nokir_hutang21($var_bulan, $var_tahun);
			$data['data_nokir_modal31']			= $this->Report_model->get_nokir_modal31($var_bulan, $var_tahun);
			$data['data_nokir_laba39']			= $this->Report_model->get_nokir_laba39($var_bulan, $var_tahun);
			$data['data_nokir_pendapatan41']	= $this->Report_model->get_nokir_pendapatan41($var_bulan, $var_tahun);
			$data['data_nokir_hpp51']			= $this->Report_model->get_nokir_hpp51($var_bulan, $var_tahun);
			$data['data_nokir_biayapenjualan61'] = $this->Report_model->get_nokir_biayapenjualan61($var_bulan, $var_tahun);
			$data['data_nokir_biayakantor68']	= $this->Report_model->get_nokir_biayakantor68($var_bulan, $var_tahun);
			$data['data_nokir_taksiranpajak91']	= $this->Report_model->get_nokir_taksiranpajak91($var_bulan, $var_tahun);
			$data['data_nokir_4']				= $this->Report_model->get_nokir_4($var_bulan, $var_tahun);
			$data['data_nokir_5']				= $this->Report_model->get_nokir_5($var_bulan, $var_tahun);
			$data['data_nokir_6']				= $this->Report_model->get_nokir_6($var_bulan, $var_tahun);
			$data['data_nokir_71']				= $this->Report_model->get_nokir_71($var_bulan, $var_tahun);
			$data['data_nokir_72']				= $this->Report_model->get_nokir_72($var_bulan, $var_tahun);
			$data['data_nokir_9']				= $this->Report_model->get_nokir_9($var_bulan, $var_tahun);

			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;


			$this->load->view("konsolidasi/v_list_trial_balance", $data);
			//redirect('report/print_labarugi');
		}
	}

	function excel_trial_balance_konsolidasi()
	{
		$data['judul']			= "Trial Balance Konsolidasi";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$var_bulan = $this->uri->segment(3);
		$var_tahun = $this->uri->segment(4);

		$data['data_nokir_hartalancar11']	= $this->Report_model->get_nokir_hartalancar11($var_bulan, $var_tahun);
		$data['data_nokir_aktivatetap13']	= $this->Report_model->get_nokir_aktivatetap13($var_bulan, $var_tahun);
		$data['data_nokir_aktivalain19']	= $this->Report_model->get_nokir_aktivalain19($var_bulan, $var_tahun);
		$data['data_nokir_totalaktiva']		= $this->Report_model->get_nokir_totalaktiva($var_bulan, $var_tahun);
		$data['data_nokir_totalpassiva']	= $this->Report_model->get_nokir_totalpassiva($var_bulan, $var_tahun);
		$data['data_nokir_hutang21']		= $this->Report_model->get_nokir_hutang21($var_bulan, $var_tahun);
		// $data['data_nokir_modal32']			= $this->Report_model->get_nokir_modal32($var_bulan, $var_tahun);
		$data['data_nokir_modal31']			= $this->Report_model->get_nokir_modal31($var_bulan, $var_tahun);
		$data['data_nokir_laba39']			= $this->Report_model->get_nokir_laba39($var_bulan, $var_tahun);
		$data['data_nokir_pendapatan41']	= $this->Report_model->get_nokir_pendapatan41($var_bulan, $var_tahun);
		$data['data_nokir_hpp51']			= $this->Report_model->get_nokir_hpp51($var_bulan, $var_tahun);
		$data['data_nokir_biayapenjualan61'] = $this->Report_model->get_nokir_biayapenjualan61($var_bulan, $var_tahun);
		$data['data_nokir_biayakantor68']	= $this->Report_model->get_nokir_biayakantor68($var_bulan, $var_tahun);
		$data['data_nokir_taksiranpajak91']	= $this->Report_model->get_nokir_taksiranpajak91($var_bulan, $var_tahun);
		$data['data_nokir_4']				= $this->Report_model->get_nokir_4($var_bulan, $var_tahun);
		$data['data_nokir_5']				= $this->Report_model->get_nokir_5($var_bulan, $var_tahun);
		$data['data_nokir_6']				= $this->Report_model->get_nokir_6($var_bulan, $var_tahun);
		$data['data_nokir_71']				= $this->Report_model->get_nokir_71($var_bulan, $var_tahun);
		$data['data_nokir_72']				= $this->Report_model->get_nokir_72($var_bulan, $var_tahun);
		$data['data_nokir_9']				= $this->Report_model->get_nokir_9($var_bulan, $var_tahun);

		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("konsolidasi/v_trial_balance_excel", $data);
		//redirect('report/print_labarugi');		
	}

	function print_trial_balance_konsolidasi()
	{
		$var_bulan 	= $this->uri->segment(3);
		$var_tahun 	= $this->uri->segment(4);

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$data['data_nokir_hartalancar11']	= $this->Report_model->get_nokir_hartalancar11($var_bulan, $var_tahun);
		$data['data_nokir_aktivatetap13']	= $this->Report_model->get_nokir_aktivatetap13($var_bulan, $var_tahun);
		$data['data_nokir_aktivalain19']	= $this->Report_model->get_nokir_aktivalain19($var_bulan, $var_tahun);
		$data['data_nokir_totalaktiva']		= $this->Report_model->get_nokir_totalaktiva($var_bulan, $var_tahun);
		$data['data_nokir_totalpassiva']	= $this->Report_model->get_nokir_totalpassiva($var_bulan, $var_tahun);
		$data['data_nokir_hutang21']		= $this->Report_model->get_nokir_hutang21($var_bulan, $var_tahun);
		$data['data_nokir_modal31']			= $this->Report_model->get_nokir_modal31($var_bulan, $var_tahun);
		$data['data_nokir_laba39']			= $this->Report_model->get_nokir_laba39($var_bulan, $var_tahun);
		$data['data_nokir_pendapatan41']	= $this->Report_model->get_nokir_pendapatan41($var_bulan, $var_tahun);
		$data['data_nokir_hpp51']			= $this->Report_model->get_nokir_hpp51($var_bulan, $var_tahun);
		$data['data_nokir_biayapenjualan61'] = $this->Report_model->get_nokir_biayapenjualan61($var_bulan, $var_tahun);
		$data['data_nokir_biayakantor68']	= $this->Report_model->get_nokir_biayakantor68($var_bulan, $var_tahun);
		$data['data_nokir_taksiranpajak91']	= $this->Report_model->get_nokir_taksiranpajak91($var_bulan, $var_tahun);
		$data['data_nokir_4']				= $this->Report_model->get_nokir_4($var_bulan, $var_tahun);
		$data['data_nokir_5']				= $this->Report_model->get_nokir_5($var_bulan, $var_tahun);
		$data['data_nokir_6']				= $this->Report_model->get_nokir_6($var_bulan, $var_tahun);
		$data['data_nokir_71']				= $this->Report_model->get_nokir_71($var_bulan, $var_tahun);
		$data['data_nokir_72']				= $this->Report_model->get_nokir_72($var_bulan, $var_tahun);
		$data['data_nokir_9']				= $this->Report_model->get_nokir_9($var_bulan, $var_tahun);

		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$html			= $this->load->view('konsolidasi/v_print_trial_balance', $data, true);
		$pdfFilePath	= "Laporan_Trial_Balance_" . $var_bulan . "_" . $var_tahun . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'L',
			'',
			'',
			'',
			30, // margin_left
			30, // margin right
			20, // margin top
			10, // margin bottom
			10, // margin header
			10
		); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		//redirect('report/tampilkan_trial_balance');
	}

}
