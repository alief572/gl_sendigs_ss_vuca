<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
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
	}

	function query_jurnal()
	{
		$data['judul']		= "Query Jurnal";
		$data['list_data'] = $this->Jurnal_model->list_jurnal();

		$this->load->view("report/v_list_query_jurnal", $data);
	}

	function filter_query_jurnal()
	{
		$data['judul']		= "Query Jurnal";
		$filter_by 		= $this->input->post('filter_by');
		$filter_text 	= $this->input->post('filter_text');
		$tanggal_		= $this->input->post('tanggal');
		$tanggal		= date_format(new DateTime($tanggal_), "Y-m-d");
		$tanggal2_		= $this->input->post('tanggal2');
		$tanggal2		= date_format(new DateTime($tanggal2_), "Y-m-d");

		if ($this->input->post('cari') == "EXPORT TO EXCEL") {
			redirect('report/excel_qjurnal/' . $tanggal . '/' . $tanggal2 . '/' . $filter_by . '/' . $filter_text);
		} else {

			if ($filter_by == "no_reff") {
				$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_noreff($tanggal, $tanggal2, $filter_text);
			} elseif ($filter_by == "no_jurnal") {
				$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_nojur($tanggal, $tanggal2, $filter_text);
			} elseif ($filter_by == "no_perkiraan") {
				$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_nokir($tanggal, $tanggal2, $filter_text);
			} elseif ($filter_by == "keterangan") {
				$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_ket($tanggal, $tanggal2, $filter_text);
			} elseif ($filter_by == "tipe") {
				$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_tipe($tanggal, $tanggal2, $filter_text);
			}
		}

		$data['tanggal']		= $tanggal_;
		$data['tanggal2']		= $tanggal2_;
		$data['filter_text']	= $filter_text;
		$data['filter_by']		= $filter_by;

		$this->load->view("report/v_list_qjurnal_filter", $data);
	}

	function detail_qjurnal()
	{
		$tipe_jurnal		= $this->uri->segment(3);
		$nomor_jurnal		= $this->uri->segment(4);
		$data['judul']		= "Detail Jurnal " . $tipe_jurnal . " " . $nomor_jurnal;
		$data['list_data'] 	= $this->Jurnal_model->get_detail_jurnal($tipe_jurnal, $nomor_jurnal);

		$this->load->view("report/v_detail_qjurnal", $data);
	}
	function excel_qjurnal()
	{
		$tanggal = $this->uri->segment(3);

		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);

		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$filter_by = $this->uri->segment(5);
		$filter_text = $this->uri->segment(6);

		if ($filter_by == "no_reff") {
			$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_noreff($tanggal, $tanggal2, $filter_text);
		} elseif ($filter_by == "no_jurnal") {
			$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_nojur($tanggal, $tanggal2, $filter_text);
		} elseif ($filter_by == "no_perkiraan") {
			$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_nokir($tanggal, $tanggal2, $filter_text);
		} elseif ($filter_by == "keterangan") {
			$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_ket($tanggal, $tanggal2, $filter_text);
		} elseif ($filter_by == "tipe") {
			$data['filter_query']	= $this->Jurnal_model->filter_query_jurnal_tipe($tanggal, $tanggal2, $filter_text);
		}

		$data['tanggal']		= $tanggal;
		$data['tanggal2']		= $tanggal2;
		$data['filter_text']	= $filter_text;
		$data['filter_by']		= $filter_by;

		$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_jurnal($tanggal, $tanggal2);

		$this->load->view("report/view_excel_qjurnal", $data);
	}

	function konsolidasi_trial_balance()
	{

		$data['judul'] = "Konsolidasi Trial Balance";
		$data['judul2'] = "Inisialisasi Trial Balance";
		//$data['list_data'] = $this->Order_model->list_request_stock();
		$data['pesan_on'] 	= 0;
		$data['proses'] 	= 0;
		$this->load->view('report/v_konsolidasi_trial_balance', $data);
	}

	function tampilkan_konsolidasi_trial_balance()
	{

		$data['judul'] = "Konsolidasi Trial Balance";
		$data['judul2'] = "Inisialisasi Trial Balance";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_trial_balance');
			$var_thn					= $this->input->post('tahun_trial_balance');
			$level						= $this->input->post('level');
			redirect('report/excel_konsolidasi_trial_balance/' . $var_bln . '/' . $var_thn . '/' . $level);
		} else {

			$var_bulan					= $this->input->post('bulan_trial_balance');
			$var_tahun					= $this->input->post('tahun_trial_balance');

			$data['data_bulan']		= $this->Report_model->get_bulan_coa();
			$data['data_tahun']		= $this->Report_model->get_tahun_coa();
			$level						= $this->input->post('level');

			$data['data_HartaLancar1101']	= $this->Report_model->get_HartaLancar_kons1101($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1102']	= $this->Report_model->get_HartaLancar_kons1102($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1104']	= $this->Report_model->get_HartaLancar_kons1104($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1105']	= $this->Report_model->get_HartaLancar_kons1105($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1106']	= $this->Report_model->get_HartaLancar_kons1106($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1107']	= $this->Report_model->get_HartaLancar_kons1107($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1108']	= $this->Report_model->get_HartaLancar_kons1108($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1110']	= $this->Report_model->get_HartaLancar_kons1110($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1111']	= $this->Report_model->get_HartaLancar_kons1111($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1301']	= $this->Report_model->get_AktivaTetap_kons1301($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1302']	= $this->Report_model->get_AktivaTetap_kons1302($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1303']	= $this->Report_model->get_AktivaTetap_kons1303($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1304']	= $this->Report_model->get_AktivaTetap_kons1304($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1305']	= $this->Report_model->get_AktivaTetap_kons1305($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1306']	= $this->Report_model->get_AktivaTetap_kons1306($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1307']	= $this->Report_model->get_AktivaTetap_kons1307($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1309']	= $this->Report_model->get_AktivaTetap_kons1309($var_bulan, $var_tahun, $level);
			$data['data_AktivaLain']		= $this->Report_model->get_AktivaLain_kons($var_bulan, $var_tahun, $level);
			$data['data_nokir_totalaktiva']		= $this->Report_model->kons_nokir_totalaktiva($var_bulan, $var_tahun, $level);
			$data['data_nokir_totalpassiva']	= $this->Report_model->kons_nokir_totalpassiva($var_bulan, $var_tahun, $level);
			$data['data_Hutang2101']		= $this->Report_model->get_Hutang_kons2101($var_bulan, $var_tahun, $level);
			$data['data_Hutang2102']		= $this->Report_model->get_Hutang_kons2102($var_bulan, $var_tahun, $level);
			$data['data_Hutang2107']		= $this->Report_model->get_Hutang_kons2107($var_bulan, $var_tahun, $level);
			$data['data_Hutang2108']		= $this->Report_model->get_Hutang_kons2108($var_bulan, $var_tahun, $level);
			$data['data_Modal']				= $this->Report_model->get_Modal_kons($var_bulan, $var_tahun, $level);
			$data['data_Laba3901']			= $this->Report_model->get_Laba_kons3901($var_bulan, $var_tahun, $level);
			$data['data_Laba3902']			= $this->Report_model->get_Laba_kons3902($var_bulan, $var_tahun, $level);
			$data['data_Laba3903']			= $this->Report_model->get_Laba_kons3903($var_bulan, $var_tahun, $level);
			$data['nokir_41_konsolidasi']	= $this->Report_model->get_nokir_41tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_51_konsolidasi']	= $this->Report_model->get_nokir_51tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_61_konsolidasi']	= $this->Report_model->get_nokir_61tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_6811_konsolidasi']	= $this->Report_model->get_nokir_6811tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_6821_konsolidasi']	= $this->Report_model->get_nokir_6821tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_6831_konsolidasi']	= $this->Report_model->get_nokir_6831tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_71_konsolidasi']	= $this->Report_model->get_nokir_71tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_72_konsolidasi']	= $this->Report_model->get_nokir_72tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_91_konsolidasi']	= $this->Report_model->get_nokir_91tb_konsolidasi($var_bulan, $var_tahun, $level);
			$data['data_nokir_4']				= $this->Report_model->kons_nokir_4($var_bulan, $var_tahun, $level);
			$data['data_nokir_5']				= $this->Report_model->kons_nokir_5($var_bulan, $var_tahun, $level);
			$data['data_nokir_6']				= $this->Report_model->kons_nokir_6($var_bulan, $var_tahun, $level);
			$data['data_nokir_71']				= $this->Report_model->kons_nokir_71($var_bulan, $var_tahun, $level);
			$data['data_nokir_72']				= $this->Report_model->kons_nokir_72($var_bulan, $var_tahun, $level);
			$data['data_nokir_9']				= $this->Report_model->kons_nokir_9($var_bulan, $var_tahun, $level);

			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;


			$this->load->view("report/v_list_konsolidasi_trial_balance", $data);
			//redirect('report/print_labarugi');
		}
	}

	function excel_konsolidasi_trial_balance()
	{
		$data['judul'] = "Konsolidasi Trial Balance";
		$data['judul2'] = "Inisialisasi Trial Balance";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$var_bulan = $this->uri->segment(3);
		$var_tahun = $this->uri->segment(4);
		$level = $this->uri->segment(5);

		$data['data_HartaLancar1101']	= $this->Report_model->get_HartaLancar_kons1101($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1102']	= $this->Report_model->get_HartaLancar_kons1102($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1104']	= $this->Report_model->get_HartaLancar_kons1104($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1105']	= $this->Report_model->get_HartaLancar_kons1105($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1106']	= $this->Report_model->get_HartaLancar_kons1106($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1107']	= $this->Report_model->get_HartaLancar_kons1107($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1108']	= $this->Report_model->get_HartaLancar_kons1108($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1110']	= $this->Report_model->get_HartaLancar_kons1110($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1111']	= $this->Report_model->get_HartaLancar_kons1111($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1301']	= $this->Report_model->get_AktivaTetap_kons1301($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1302']	= $this->Report_model->get_AktivaTetap_kons1302($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1303']	= $this->Report_model->get_AktivaTetap_kons1303($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1304']	= $this->Report_model->get_AktivaTetap_kons1304($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1305']	= $this->Report_model->get_AktivaTetap_kons1305($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1306']	= $this->Report_model->get_AktivaTetap_kons1306($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1307']	= $this->Report_model->get_AktivaTetap_kons1307($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1309']	= $this->Report_model->get_AktivaTetap_kons1309($var_bulan, $var_tahun, $level);
		$data['data_AktivaLain']		= $this->Report_model->get_AktivaLain_kons($var_bulan, $var_tahun, $level);
		$data['data_nokir_totalaktiva']		= $this->Report_model->kons_nokir_totalaktiva($var_bulan, $var_tahun, $level);
		$data['data_nokir_totalpassiva']	= $this->Report_model->kons_nokir_totalpassiva($var_bulan, $var_tahun, $level);
		$data['data_Hutang2101']		= $this->Report_model->get_Hutang_kons2101($var_bulan, $var_tahun, $level);
		$data['data_Hutang2102']		= $this->Report_model->get_Hutang_kons2102($var_bulan, $var_tahun, $level);
		$data['data_Hutang2107']		= $this->Report_model->get_Hutang_kons2107($var_bulan, $var_tahun, $level);
		$data['data_Hutang2108']		= $this->Report_model->get_Hutang_kons2108($var_bulan, $var_tahun, $level);
		$data['data_Modal']				= $this->Report_model->get_Modal_kons($var_bulan, $var_tahun, $level);
		$data['data_Laba3901']			= $this->Report_model->get_Laba_kons3901($var_bulan, $var_tahun, $level);
		$data['data_Laba3902']			= $this->Report_model->get_Laba_kons3902($var_bulan, $var_tahun, $level);
		$data['data_Laba3903']			= $this->Report_model->get_Laba_kons3903($var_bulan, $var_tahun, $level);
		$data['nokir_41_konsolidasi']	= $this->Report_model->get_nokir_41_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_51_konsolidasi']	= $this->Report_model->get_nokir_51_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_61_konsolidasi']	= $this->Report_model->get_nokir_61_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_6811_konsolidasi']	= $this->Report_model->get_nokir_6811_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_6821_konsolidasi']	= $this->Report_model->get_nokir_6821_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_6831_konsolidasi']	= $this->Report_model->get_nokir_6831_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_71_konsolidasi']	= $this->Report_model->get_nokir_71_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_72_konsolidasi']	= $this->Report_model->get_nokir_72_konsolidasi($var_bulan, $var_tahun, $level);
		$data['nokir_91_konsolidasi']	= $this->Report_model->get_nokir_91_konsolidasi($var_bulan, $var_tahun, $level);
		$data['data_nokir_4']				= $this->Report_model->kons_nokir_4($var_bulan, $var_tahun, $level);
		$data['data_nokir_5']				= $this->Report_model->kons_nokir_5($var_bulan, $var_tahun, $level);
		$data['data_nokir_6']				= $this->Report_model->kons_nokir_6($var_bulan, $var_tahun, $level);
		$data['data_nokir_71']				= $this->Report_model->kons_nokir_71($var_bulan, $var_tahun, $level);
		$data['data_nokir_72']				= $this->Report_model->kons_nokir_72($var_bulan, $var_tahun, $level);
		$data['data_nokir_9']				= $this->Report_model->kons_nokir_9($var_bulan, $var_tahun, $level);

		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("report/v_konsolidasi_trial_balance_excel", $data);
		//redirect('report/print_labarugi');		
	}

	function konsolidasi_neraca()
	{
		$data['judul']			= "Laporan Konsolidasi Neraca";
		$this->load->view("report/v_konsolidasi_neraca", $data);
	}

	function tampilkan_konsolidasi_neraca()
	{
		$data['judul']			= "Laporan Konsolidasi Neraca";

		if ($this->input->post('tampilkan') == "Print Preview") {
			$var_bulan					= $this->input->post('bulan_neraca');
			$var_tahun					= $this->input->post('tahun_neraca');
			$level						= $this->input->post('level');
			redirect('report/print_konsolidasi_neraca/' . $var_bulan . '/' . $var_tahun . '/' . $level);
		} else {
			$data['judul']			= "Laporan Konsolidasi Neraca";

			$var_bulan					= $this->input->post('bulan_neraca');
			$var_tahun					= $this->input->post('tahun_neraca');
			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;
			$level						= $this->input->post('level');

			$data['data_HartaLancar1101']	= $this->Report_model->get_HartaLancar_kons1101($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1102']	= $this->Report_model->get_HartaLancar_kons1102($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1104']	= $this->Report_model->get_HartaLancar_kons1104($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1105']	= $this->Report_model->get_HartaLancar_kons1105($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1106']	= $this->Report_model->get_HartaLancar_kons1106($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1107']	= $this->Report_model->get_HartaLancar_kons1107($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1108']	= $this->Report_model->get_HartaLancar_kons1108($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1110']	= $this->Report_model->get_HartaLancar_kons1110($var_bulan, $var_tahun, $level);
			$data['data_HartaLancar1111']	= $this->Report_model->get_HartaLancar_kons1111($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1301']	= $this->Report_model->get_AktivaTetap_kons1301($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1302']	= $this->Report_model->get_AktivaTetap_kons1302($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1303']	= $this->Report_model->get_AktivaTetap_kons1303($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1304']	= $this->Report_model->get_AktivaTetap_kons1304($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1305']	= $this->Report_model->get_AktivaTetap_kons1305($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1306']	= $this->Report_model->get_AktivaTetap_kons1306($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1307']	= $this->Report_model->get_AktivaTetap_kons1307($var_bulan, $var_tahun, $level);
			$data['data_AktivaTetap1309']	= $this->Report_model->get_AktivaTetap_kons1309($var_bulan, $var_tahun, $level);
			$data['data_AktivaLain']		= $this->Report_model->get_AktivaLain_kons($var_bulan, $var_tahun, $level);
			$data['data_Hutang2101']		= $this->Report_model->get_Hutang_kons2101($var_bulan, $var_tahun, $level);
			$data['data_Hutang2102']		= $this->Report_model->get_Hutang_kons2102($var_bulan, $var_tahun, $level);
			$data['data_Hutang2107']		= $this->Report_model->get_Hutang_kons2107($var_bulan, $var_tahun, $level);
			$data['data_Hutang2108']		= $this->Report_model->get_Hutang_kons2108($var_bulan, $var_tahun, $level);
			$data['data_Modal']				= $this->Report_model->get_Modal_kons($var_bulan, $var_tahun, $level);
			$data['data_Laba3901']			= $this->Report_model->get_Laba_kons3901($var_bulan, $var_tahun, $level);
			$data['data_Laba3902']			= $this->Report_model->get_Laba_kons3902($var_bulan, $var_tahun, $level);
			$data['data_Laba3903']			= $this->Report_model->get_Laba_kons3903($var_bulan, $var_tahun, $level);

			$this->load->view("report/v_list_konsolidasi_neraca", $data);
		}
	}

	function print_konsolidasi_neraca()
	{
		$var_bulan = $this->uri->segment(3);
		$var_tahun = $this->uri->segment(4);
		$level = $this->uri->segment(5);
		$data['data_HartaLancar1101']	= $this->Report_model->get_HartaLancar_kons1101($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1102']	= $this->Report_model->get_HartaLancar_kons1102($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1104']	= $this->Report_model->get_HartaLancar_kons1104($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1105']	= $this->Report_model->get_HartaLancar_kons1105($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1106']	= $this->Report_model->get_HartaLancar_kons1106($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1107']	= $this->Report_model->get_HartaLancar_kons1107($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1108']	= $this->Report_model->get_HartaLancar_kons1108($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1110']	= $this->Report_model->get_HartaLancar_kons1110($var_bulan, $var_tahun, $level);
		$data['data_HartaLancar1111']	= $this->Report_model->get_HartaLancar_kons1111($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1301']	= $this->Report_model->get_AktivaTetap_kons1301($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1302']	= $this->Report_model->get_AktivaTetap_kons1302($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1303']	= $this->Report_model->get_AktivaTetap_kons1303($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1304']	= $this->Report_model->get_AktivaTetap_kons1304($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1305']	= $this->Report_model->get_AktivaTetap_kons1305($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1306']	= $this->Report_model->get_AktivaTetap_kons1306($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1307']	= $this->Report_model->get_AktivaTetap_kons1307($var_bulan, $var_tahun, $level);
		$data['data_AktivaTetap1309']	= $this->Report_model->get_AktivaTetap_kons1309($var_bulan, $var_tahun, $level);
		$data['data_AktivaLain']		= $this->Report_model->get_AktivaLain_kons($var_bulan, $var_tahun, $level);
		$data['data_Hutang2101']		= $this->Report_model->get_Hutang_kons2101($var_bulan, $var_tahun, $level);
		$data['data_Hutang2102']		= $this->Report_model->get_Hutang_kons2102($var_bulan, $var_tahun, $level);
		$data['data_Hutang2107']		= $this->Report_model->get_Hutang_kons2107($var_bulan, $var_tahun, $level);
		$data['data_Hutang2108']		= $this->Report_model->get_Hutang_kons2108($var_bulan, $var_tahun, $level);
		$data['data_Modal']				= $this->Report_model->get_Modal_kons($var_bulan, $var_tahun, $level);
		$data['data_Laba3901']			= $this->Report_model->get_Laba_kons3901($var_bulan, $var_tahun, $level);
		$data['data_Laba3902']			= $this->Report_model->get_Laba_kons3902($var_bulan, $var_tahun, $level);
		$data['data_Laba3903']			= $this->Report_model->get_Laba_kons3903($var_bulan, $var_tahun, $level);
		// $var_bulan					= $this->input->post('bulan_neraca');
		// $var_tahun					= $this->input->post('tahun_neraca');
		$data['data_bulan_post']	= $var_bulan;
		$data['data_tahun_post']	= $var_tahun;

		$html			= $this->load->view('report/v_print_konsolidasi_neraca', $data, true);
		$pdfFilePath	= "Laporan_Konsolidasi_Neraca_" . $var_bulan . "_" . $var_tahun . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'L',
			'',
			'',
			'',
			10, // margin_left
			10, // margin right
			20, // margin top
			10, // margin bottom
			10, // margin header
			10
		); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		//redirect('report/tampilkan_labarugi');
	}

	function konsolidasi_labarugi()
	{
		$data['judul']		= "Konsolidasi Laba/Rugi";
		$this->load->view("report/v_konsolidasi_labarugi", $data);
	}

	function tampilkan_konsolidasi_labarugi()
	{
		$data['judul']			= "Konsolidasi Laba/Rugi";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_konsolidasi_labarugi');
			$var_thn					= $this->input->post('tahun_konsolidasi_labarugi');
			$level						= $this->input->post('level');
			redirect('report/excel_konsolidasi_labarugi/' . $var_bln . '/' . $var_thn . '/' . $level);
		} else {

			$var_bulan					= $this->input->post('bulan_konsolidasi_labarugi');
			$var_tahun					= $this->input->post('tahun_konsolidasi_labarugi');
			$level						= $this->input->post('level');
			if ($level == "3") {
				$data['nokir_41_konsolidasi']	= $this->Report_model->get_nokir_41_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_51_konsolidasi']	= $this->Report_model->get_nokir_51_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_61_konsolidasi']	= $this->Report_model->get_nokir_61_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_6811a_konsolidasi']	= $this->Report_model->get_nokir_6811a_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_6821a_konsolidasi']	= $this->Report_model->get_nokir_6821a_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_6831a_konsolidasi']	= $this->Report_model->get_nokir_6831a_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_71_konsolidasi']	= $this->Report_model->get_nokir_71_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_72_konsolidasi']	= $this->Report_model->get_nokir_72_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_91_konsolidasi']	= $this->Report_model->get_nokir_91_konsolidasi($var_bulan, $var_tahun, $level);

				$data['data_bulan_post']			= $var_bulan;
				$data['data_tahun_post']			= $var_tahun;

				$this->load->view("report/v_list2_konsolidasi_labarugi", $data);
			} else {
				// $data['nokir_68all_konsolidasi']	= $this->Report_model->get_nokir_68all_konsolidasi($var_bulan,$var_tahun,$level);
				$data['nokir_41_konsolidasi']	= $this->Report_model->get_nokir_41_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_51_konsolidasi']	= $this->Report_model->get_nokir_51_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_61_konsolidasi']	= $this->Report_model->get_nokir_61_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_68_konsolidasi']	= $this->Report_model->get_nokir_68a_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_71_konsolidasi']	= $this->Report_model->get_nokir_71a_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_72_konsolidasi']	= $this->Report_model->get_nokir_72a_konsolidasi($var_bulan, $var_tahun, $level);
				$data['nokir_91_konsolidasi']	= $this->Report_model->get_nokir_91_konsolidasi($var_bulan, $var_tahun, $level);
				$data['data_bulan_post']			= $var_bulan;
				$data['data_tahun_post']			= $var_tahun;

				$this->load->view("report/v_list2_konsolidasi_labarugi5", $data);
			}

			//redirect('report/print_labarugi');
		}
	}

	function excel_konsolidasi_labarugi()
	{
		$data['judul']			= "Laporan Konsolidasi Laba/Rugi";

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$var_bulan	= $this->uri->segment(3);
		$var_tahun	= $this->uri->segment(4);
		$level		= $this->uri->segment(5);

		if ($level == "3") {
			$data['nokir_41_konsolidasi']	= $this->Report_model->get_nokir_41_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_51_konsolidasi']	= $this->Report_model->get_nokir_51_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_61_konsolidasi']	= $this->Report_model->get_nokir_61_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_6811a_konsolidasi']	= $this->Report_model->get_nokir_6811a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_6821a_konsolidasi']	= $this->Report_model->get_nokir_6821a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_6831a_konsolidasi']	= $this->Report_model->get_nokir_6831a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_71_konsolidasi']	= $this->Report_model->get_nokir_71_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_72_konsolidasi']	= $this->Report_model->get_nokir_72_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_91_konsolidasi']	= $this->Report_model->get_nokir_91_konsolidasi($var_bulan, $var_tahun, $level);

			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;

			$this->load->view("report/v_konsolidasi_labarugi_excel", $data);
		} else {
			$data['nokir_41_konsolidasi']	= $this->Report_model->get_nokir_41a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_51_konsolidasi']	= $this->Report_model->get_nokir_51a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_61_konsolidasi']	= $this->Report_model->get_nokir_61a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_68_konsolidasi']	= $this->Report_model->get_nokir_68a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_71_konsolidasi']	= $this->Report_model->get_nokir_71a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_72_konsolidasi']	= $this->Report_model->get_nokir_72a_konsolidasi($var_bulan, $var_tahun, $level);
			$data['nokir_91_konsolidasi']	= $this->Report_model->get_nokir_91_konsolidasi($var_bulan, $var_tahun, $level);
			$data['data_bulan_post']			= $var_bulan;
			$data['data_tahun_post']			= $var_tahun;

			$this->load->view("report/v_konsolidasi_labarugi_excel5", $data);
		}

		//redirect('report/print_labarugi');		
	}

	function jurnal()
	{
		$data['judul']		= "List Jurnal";
		$data['list_data'] = $this->Jurnal_model->list_jurnal();
		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);

		$this->load->view("report/v_list_jurnal", $data);
	}

	function filter_tgl_jurnal()
	{
		$data['list_data'] = $this->Jurnal_model->list_jurnal();

		$data['judul']		= "List Jurnal";
		if ($this->input->post('view') == "View List Excel") {
			$date_ = $this->input->post('tanggal');
			$date = str_replace(" - ", "_", $date_);
			$date2_ = $this->input->post('tanggal2');
			$date2 = str_replace(" - ", "_", $date2_);
			redirect('report/view_excel/' . $date . '/' . $date2);
		} else {
			$tanggal_	= $this->input->post('tanggal');
			$tanggal	= date_format(new DateTime($tanggal_), "Y-m-d");
			$tanggal2_	= $this->input->post('tanggal2');
			$tanggal2	= date_format(new DateTime($tanggal2_), "Y-m-d");

			if (empty($tanggal)) {
				$tanggal = date('Y-m-d');
			}

			if (empty($tanggal2)) {
				$tanggal2 = date('Y-m-d');
			}

			$data['tanggal']		= $tanggal;
			$data['tanggal2']		= $tanggal2;

			$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_jurnal($tanggal, $tanggal2);
			$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
			if ($cek_periode_aktif > 0) {
				foreach ($cek_periode_aktif as $row_periode_aktif) {
					$tgl_periode_aktif	= $row_periode_aktif->periode;
					$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
					$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
				}
			}
			$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);

			$this->load->view("report/v_list_jurnal_filter", $data);
		}
	}

	function view_excel()
	{

		$tanggal_ = $this->uri->segment(3);
		$tanggal	= date_format(new DateTime($tanggal_), "Y-m-d");
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2_ = $this->uri->segment(4);
		$tanggal2	= date_format(new DateTime($tanggal2_), "Y-m-d");

		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tanggal;
		$data['tanggal2']			= $tanggal2;

		$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_jurnal($tanggal, $tanggal2);

		$this->load->view("report/view_excel", $data);
	}

	function detail_jurnal()
	{
		$tipe_jurnal		= $this->uri->segment(3);
		$nomor_jurnal		= $this->uri->segment(4);
		$data['judul']		= "Detail Jurnal " . $tipe_jurnal . " " . $nomor_jurnal;
		$data['list_data'] 	= $this->Jurnal_model->get_detail_jurnal($tipe_jurnal, $nomor_jurnal);
		// $cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		// if ($cek_periode_aktif > 0) {
		// 	foreach ($cek_periode_aktif as $row_periode_aktif) {
		// 		$tgl_periode_aktif	= $row_periode_aktif->periode;
		// 		$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
		// 		$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
		// 	}
		// }
		//$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		$this->load->view("report/v_detail_jurnal", $data);
	}

	function filter_noperkiraan()
	{
		$data['judul']		= "List Jurnal";

		$data['filter_nok']	= $this->Jurnal_model->get_nokir_filter();
		$data['list_data'] = $this->Jurnal_model->list_jurnal();
		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);

		$this->load->view("report/v_list_jurnal_filter_nokir", $data);
	}

	function trial_balance()
	{

		$data['judul'] = "Inisialisasi Trial Balance";
		$data['judul2'] = "Trial Balance " . $this->session->userdata('kode_cabang');
		//$data['list_data'] = $this->Order_model->list_request_stock();		
		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['pesan_on'] 	= 0;
		$data['proses'] 	= 0;
		$this->load->view('report/v_trial_balance', $data);
	}

	function tampilkan_trial_balance()
	{

		$data['judul']	= "Trial Balance Report";
		$data['judul2'] = "Trial Balance " . $this->session->userdata('kode_cabang');

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_trial_balance');
			$var_thn					= $this->input->post('tahun_trial_balance');
			redirect('report/excel_trial_balance/' . $var_bln . '/' . $var_thn);
		} elseif ($this->input->post('tampilkan') == "View Pdf") {
			$var_bln					= $this->input->post('bulan_trial_balance');
			$var_thn					= $this->input->post('tahun_trial_balance');
			redirect('report/print_trial_balance/' . $var_bln . '/' . $var_thn);
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


			$this->load->view("report/v_list_trial_balance", $data);
			//redirect('report/print_labarugi');
		}
	}

	function excel_trial_balance()
	{
		$data['judul']			= "Trial Balance";

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

		$this->load->view("report/v_trial_balance_excel", $data);
		//redirect('report/print_labarugi');		
	}

	function print_trial_balance()
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

		$html			= $this->load->view('report/v_print_trial_balance', $data, true);
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

	function marketing()
	{
		$data	= [
			'judul'			=> "Report Marketing",
			'list_marketing' => $this->db->query("SELECT * FROM dk_user WHERE sts_marketing='Y'")->result()
		];
		$this->load->view('report/marketing', $data);
	}

	function gedung()
	{
		$tahun	= empty($this->input->post('tahun')) ? date('Y') : $this->input->post('tahun');

		$data	= [
			'judul'			=> "Report Gedung",
			'list_gedung'	=> $this->Order_model->get_list_tempat_lokasi($tahun)
		];
		$this->load->view('report/gedung', $data);
	}

	function refresh_periode()
	{
		$data['judul'] = "Refresh Periode";
		//$data['list_data'] = $this->Order_model->list_request_stock();
		$data['proses'] = 0;
		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$data['$bln_aktif']			= substr($tgl_periode_aktif, 0, 2);
				$data['$thn_aktif']			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$this->load->view('report/v_refresh_periode', $data);
	}

	function proses_refresh_periode()
	{
		$data['judul'] = "Proses Refresh Periode";
		$bln_periode = $this->input->post('bulan_periode');
		$thn_periode = $this->input->post('tahun_periode');
		//$blnthn_periode = $bln_periode."-".$thn_periode;
        $kode_cabang = $this->session->userdata('singkat_cbg');
		
		if ($bln_periode > 9) {
			$blnthn_periode = $bln_periode . "-" . $thn_periode;
		} else {
			$blnthn_periode = "0" . $bln_periode . "-" . $thn_periode;
		}

		$cek_periode = $this->Report_model->get_periode($blnthn_periode);
		//$cek_periode = $this->db->query("SELECT * FROM periode WHERE periode='$blnthn_periode'")->result();
		if ($cek_periode > 0) {
			$this->db->query("UPDATE periode set stsaktif='C', kdcab='$kode_cabang' ");
			$this->db->query("UPDATE periode set stsaktif='O', kdcab='$kode_cabang' WHERE periode='$blnthn_periode'");
		} else {
			$this->db->query("UPDATE periode set stsaktif='C' ");
			$this->db->query("INSERT INTO periode (periode,stsaktif,kdcab) VALUES ('$blnthn_periode','O','$kode_cabang')");
			//periode,noJS,noJP,noJO,noJC,noJM,noJD,open_date,closing_date,user,stsaktif,stspost,stslock,kdcab,post_laba,company
			//'$blnthn_periode',0,0,0,0,0,0,'0000-00-00','0000-00-00','','O',0,0,'SUP',1,'AAMT'
		}
		//$data['list_data'] = $this->Order_model->list_request_stock();
		//echo $blnthn_periode;
		//exit;

		$data['proses'] = 2;
		$this->load->view('report/v_refresh_periode', $data);
	}

	function ledger()
	{
		$data['judul']			= "Laporan Ledger";
		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		
				
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);

		$this->load->view("report/v_ledger", $data);
	}

	function tampilkan_ledger()
	{
		
		
		$data['judul']			= "Laporan Ledger";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_ledger');
			$var_thn					= $this->input->post('tahun_ledger');
			$var_filter_nokir			= $this->input->post('filter_nokir'); 
			$var_filter_nokir2			= $this->input->post('filter_nokir2');
			$filter_nokir = substr($var_filter_nokir, 0, 10);
			$filter_nokir2 = substr($var_filter_nokir2, 0, 10);
			
			
			
			redirect('report/excel_ledger/' . $var_bln . '/' . $var_thn . '/' . $filter_nokir . '/' . $filter_nokir2);
			//redirect('report/ledger');

		} else {
			$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
			if ($cek_periode_aktif > 0) {
				foreach ($cek_periode_aktif as $row_periode_aktif) {
					$tgl_periode_aktif	= $row_periode_aktif->periode;
					$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
					$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
				}
			}
			$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
			
			
			$var_bulan					= $this->input->post('bulan_ledger');
			$var_tahun					= $this->input->post('tahun_ledger');
			$data['bln_ledger']			= $this->input->post('bulan_ledger');
			$data['thn_ledger']			= $this->input->post('tahun_ledger');
			$var_filter_nokir			= $this->input->post('filter_nokir');
			$var_filter_nokir2			= $this->input->post('filter_nokir2');
			$data['filter_nokir']			= $this->input->post('filter_nokir');
			$data['filter_nokir2']			= $this->input->post('filter_nokir2');
			$filter_nokir = substr($var_filter_nokir, 0, 10);
			$filter_nokir2 = substr($var_filter_nokir2, 0, 10);

			$awal = 1;
			$akhir = 31;
			$enol = 0;
			if ($var_bulan > 9) {
				$var_tgl_awal = $var_tahun . "-" . $var_bulan . "-0" . $awal;
				$data['var_tgl_awal'] = $var_tahun . "-" . $var_bulan . "-0" . $awal;
				$var_tgl_akhir = $var_tahun . "-" . $var_bulan . "-" . $akhir;
				$data['var_tgl_akhir'] = $var_tahun . "-" . $var_bulan . "-" . $akhir;
			} else {
				$var_tgl_awal = $var_tahun . "-" . $enol . $var_bulan . "-0" . $awal;
				$data['var_tgl_awal'] = $var_tahun . "-" . $enol . $var_bulan . "-0" . $awal;
				$var_tgl_akhir = $var_tahun . "-" . $enol . $var_bulan . "-" . $akhir;
				$data['var_tgl_akhir'] = $var_tahun . "-" . $enol . $var_bulan . "-" . $akhir;
			}
			
			

			$data['coa_sa']				= $this->Report_model->get_coa_sa($filter_nokir, $filter_nokir2, $var_bulan, $var_tahun);
			//$data['detail_jurnal']		= $this->Report_model->get_detail_jurnal($filter_nokir,$filter_nokir2,$var_tgl_awal,$var_tgl_akhir);

			// print_r($data['coa_sa']);
			// exit;
			
			$this->load->view("report/v_list_ledger", $data);
		}
	}

	function excel_ledger()
	{
		$data['judul']			= "Laporan Ledger";

		$var_bulan = $this->uri->segment(3);
		$var_tahun = $this->uri->segment(4);

		$data['bln_ledger']			= $var_bulan;
		$data['thn_ledger']			= $var_tahun;
		$filter_nokir			= $this->uri->segment(5);
		$filter_nokir2			= $this->uri->segment(6);

		$awal = 1;
		$akhir = 31;
		$enol = 0;
		
		if ($var_bulan > 9) {
				$var_tgl_awal = $var_tahun . "-" . $var_bulan . "-0" . $awal;
				$data['var_tgl_awal'] = $var_tahun . "-" . $var_bulan . "-0" . $awal;
				$var_tgl_akhir = $var_tahun . "-" . $var_bulan . "-" . $akhir;
				$data['var_tgl_akhir'] = $var_tahun . "-" . $var_bulan . "-" . $akhir;
			} else {
				$var_tgl_awal = $var_tahun . "-" . $enol . $var_bulan . "-0" . $awal;
				$data['var_tgl_awal'] = $var_tahun . "-" . $enol . $var_bulan . "-0" . $awal;
				$var_tgl_akhir = $var_tahun . "-" . $enol . $var_bulan . "-" . $akhir;
				$data['var_tgl_akhir'] = $var_tahun . "-" . $enol . $var_bulan . "-" . $akhir;
			}
			
		
		$data['coa_sa']				= $this->Report_model->get_coa_sa($filter_nokir, $filter_nokir2, $var_bulan, $var_tahun);
		//$data['detail_jurnal']		= $this->Report_model->get_detail_jurnal($filter_nokir, $filter_nokir2, $var_tgl_awal, $var_tgl_akhir);

		$this->load->view("report/v_ledger_excel", $data);
		//redirect('report/print_labarugi');		
	}

	function tutup_tahun()
	{
		$data['judul'] = "Proses Tutup Tahun";
		$data['proses'] = "0";
		$this->load->view('report/v_tutup_tahun', $data);
	}
	function proses_tutup_tahun()
	{
		$data['judul'] = "Proses Tutup Tahun";

		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		if ($bln_aktif == 1) {
			$nolkan_nokir_4_9	= $this->db->query("UPDATE coa SET saldoawal=0 WHERE (no_perkiraan LIKE '4%' OR no_perkiraan LIKE '5%' OR no_perkiraan LIKE '6%' OR no_perkiraan LIKE '7%' OR no_perkiraan LIKE '8%' OR no_perkiraan LIKE '9%') AND bln=1 AND thn='$thn_aktif'");

			$data['proses'] = "1";
			$this->load->view('report/v_tutup_tahun', $data);
		} else {
			$data['proses'] = "2";
			$this->load->view('report/v_tutup_tahun', $data);
		}
	}

	function tutup_bulan()
	{
		$data['judul'] = "Proses Tutup Bulan";
		$data['proses'] = "0";
		$this->load->view('report/v_tutup_bulan', $data);
	}

	function proses_tutup_bulan()
	{
		$data['judul'] = "Proses Tutup Bulan";

		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		$awal = 1;
		$akhir = 31;
		$enol = 0;
		if ($bln_aktif > 9) {
			$var_tgl_awal = $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir = $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		} else {
			$var_tgl_awal = $thn_aktif . "-" . $enol . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir = $thn_aktif . "-" . $enol . $bln_aktif . "-" . $akhir;
		}
		$kode_cabang = $this->session->userdata('kode_cabang');
		if ($bln_aktif <= 11) {
			$nu_bln_aktif = $bln_aktif + 1;
			$nu_thn_aktif = $thn_aktif;
		} else {
			$nu_bln_aktif = 1;
			$nu_thn_aktif = $thn_aktif + 1;
		}

		$this->db->query("delete from coa WHERE bln='$nu_bln_aktif' AND thn='$nu_thn_aktif' and kdcab='$kode_cabang'");


		$data_coa					= $this->Report_model->get_coa($bln_aktif, $thn_aktif);
		if ($data_coa > 0) {
			foreach ($data_coa as $row_coa) {
				$nokir			= $row_coa->no_perkiraan;
				$nm_perkiraan	= $row_coa->nama;
				$lvl			= $row_coa->level;
				$grup			= $row_coa->grup;
				$faktor			= $row_coa->faktor;
				$saldo_awal		= $row_coa->saldoawal;
				$debet			= $row_coa->debet;
				$kredit			= $row_coa->kredit;
				$saldo_akhir	= $saldo_awal + $debet - $kredit;

				//$data_jurnal	= $this->Report_model->get_jurnal($nokir, $var_tgl_awal, $var_tgl_akhir);
				/*
				$data_jurnal	= $this->Report_model->get_coa($bln_aktif, $thn_aktif);
				
				if ($data_jurnal > 0) {
					foreach ($data_jurnal as $row_jurnal) {
						$jumlah_debet	= $row_jurnal->debet;
						$jumlah_kredit	= $row_jurnal->kredit;
						$saldo_akhir = $saldo_awal + $jumlah_debet - $jumlah_kredit;
					}
				}
				*/
				$data_newcoa					= $this->Report_model->get_newcoa($nu_bln_aktif, $nu_thn_aktif, $nokir); // cek coa utk bln & thn yg baru sdh ada apa belum
				if ($data_newcoa > 0) { // jika sudah ada

					$this->db->query("INSERT INTO coa (no_perkiraan,nama,kdcab,saldoawal,bln,thn,debet,kredit,tmp,tipe,level,grup,faktor) VALUES ('$nokir','$nm_perkiraan','$kode_cabang','$saldo_akhir','$nu_bln_aktif','$nu_thn_aktif',0,0,'O','A','$lvl','$grup','$faktor')");
				} else {		// jika belum ada


					$this->db->query("INSERT INTO coa (no_perkiraan,nama,kdcab,saldoawal,bln,thn,debet,kredit,tmp,tipe,level,grup,faktor) VALUES ('$nokir','$nm_perkiraan','$kode_cabang','$saldo_akhir','$nu_bln_aktif','$nu_thn_aktif',0,0,'O','A','$lvl','$grup','$faktor')");
					// echo "INSERT INTO coa (no_perkiraan,nama,kdcab,saldoawal,bln,thn,debet,kredit,tmp,tipe,level,grup,faktor) VALUES ('$nokir','$nm_perkiraan','$kode_cabang','$saldo_akhir','$nu_bln_aktif','$nu_thn_aktif',0,0,'O','A','$lvl','$grup','$faktor')";
				}
			}

			$enol = 0;
			if ($nu_bln_aktif > 9) {
				$nu_tgl_periode_aktif = $nu_bln_aktif . "-" . $nu_thn_aktif;
			} else {
				$nu_tgl_periode_aktif = $enol . $nu_bln_aktif . "-" . $nu_thn_aktif;
			}
			$singkat_cbg = $this->session->userdata('singkat_cbg');

			$this->db->query("UPDATE periode set stsaktif='C' WHERE periode='$tgl_periode_aktif' and kdcab='$singkat_cbg'");

			$nu_periode	= $this->Report_model->get_periode($nu_tgl_periode_aktif); // cek apakah periode yg baru sudah ada apa belum
			if ($nu_periode > 0) { // jika sudah ada

				$this->db->query("UPDATE periode set stsaktif='O',stspost='1',stslock='0' WHERE periode='$nu_tgl_periode_aktif' and kdcab='$singkat_cbg'");
			} else { // jika belum ada

				$this->db->query("INSERT INTO periode (periode,stsaktif,stspost,stslock,kdcab) VALUES ('$nu_tgl_periode_aktif','O','1','0','$singkat_cbg')");
			}
		}
                                if ($this->db->trans_status() !== TRUE) {
									$this->db->trans_rollback();
									$rows_Return	= array(
										'pesan'			=> 'Posting process failed. Please try again later ...',
										'status'		=> 3
									);
								} else {
									$this->db->trans_commit();
									$rows_Return	= array(
										'pesan'		=> 'Posting process success. Thanks ...',
										'status'	=> 1

									);
								}
		$data['proses'] = 1;
		$this->load->view('report/v_tutup_bulan', $data);
	}

	function labarugi()
	{
		$data['judul']			= "Income Statement";
		$cek_periode_aktif		= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$this->load->view("report/v_labarugi", $data);
	}

	function tampilkan_labarugi()
	{
		$data['judul']			= "Income Statement";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_labarugi');
			$var_thn					= $this->input->post('tahun_labarugi');
			$level						= $this->input->post('level');
			redirect('report/excel_labarugi/' . $var_bln . '/' . $var_thn . '/' . $level);
		} elseif ($this->input->post('tampilkan') == "View Pdf") {
			$var_bln					= $this->input->post('bulan_labarugi');
			$var_thn					= $this->input->post('tahun_labarugi');
			$level						= $this->input->post('level');
			redirect('report/print_labarugi/' . $var_bln . '/' . $var_thn . '/' . $level);
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

			$this->load->view("report/v_list_labarugi", $data);
			//redirect('report/print_labarugi');
		}
	}

	function excel_labarugi()
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

		$this->load->view("report/v_labarugi_excel", $data);
		//redirect('report/print_labarugi');		
	}

	function print_labarugi()
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

		$html			= $this->load->view('report/v_print_labarugi', $data, true);
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

	function labarugi_event()
	{
		$data['judul']				= "Laporan Laba Rugi Per Event";
		$data['data_project']		= $this->Report_model->ambil_data_project();
		$this->load->view("report/v_labarugi_event", $data);
	}

	function tampilkan_labarugi_event()
	{
		$data['judul']			= "Laporan Laba Rugi Per Event";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_project					= $this->input->post('project');
			$var_project_ = str_replace("|", "_", $var_project);

			redirect('report/excel_labarugi_event/' . $var_project_);
		} else {

			$var_project					= $this->input->post('project');

			$data['data_project']		= $this->Report_model->ambil_data_project();
			$data['data_project2']		= $this->Report_model->ambil_data_project2($var_project);

			$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn_event($var_project);
			$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2_event($var_project);
			$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp_event($var_project);
			$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya_event($var_project);
			$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2_event($var_project);
			$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3_event($var_project);

			$this->load->view("report/v_list_labarugi_event", $data);
			//redirect('report/print_labarugi');
		}
	}

	function change_lr_event()
	{

		$id = $this->input->get('option');

		$data_nganten	= $this->Report_model->get_nganten($id);
		if ($data_nganten > 0) {
			foreach ($data_nganten as $row_nganten) {
				$pria		= $row_nganten->pengantin_pria;
				$wanita		= $row_nganten->pengantin_wanita;
				$nganten	= $pria . " & " . $wanita;
			}
		}

		echo "<input class='form-control' name='nganten' id='nganten' value='" . $nganten . "'readonly/>";
		echo "</td>";
	}

	function excel_labarugi_event()
	{
		$data['judul']			= "Laporan Laba Rugi Per Event";

		$var_project					= $this->input->post('project');
		$var_project_					= $this->uri->segment(3);
		$data['var_project_']			= $this->uri->segment(3);
		$var_project 					= str_replace("_", "|", $var_project_);

		$data['data_project']		= $this->Report_model->ambil_data_project();
		$data['data_project2']		= $this->Report_model->ambil_data_project2($var_project);

		$data['data_nokir_pdptn']	= $this->Report_model->get_nokir_pdptn_event($var_project);
		$data['data_nokir_pdptn2']	= $this->Report_model->get_nokir_pdptn2_event($var_project);
		$data['data_nokir_hpp']		= $this->Report_model->get_nokir_hpp_event($var_project);
		$data['data_nokir_biaya']	= $this->Report_model->get_nokir_biaya_event($var_project);
		$data['data_nokir_biaya2']	= $this->Report_model->get_nokir_biaya2_event($var_project);
		$data['data_nokir_biaya3']	= $this->Report_model->get_nokir_biaya3_event($var_project);

		$this->load->view("report/v_labarugi_event_excel", $data);
		//redirect('report/print_labarugi');		
	}

	function neraca()
	{
		$data['judul']			= "Laporan Neraca";
		$cek_periode_aktif			= $this->Report_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}

		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();

		$this->load->view("report/v_neraca", $data);
	}

	function tampilkan_neraca()
	{
		$data['judul']			= "Laporan Neraca";

		if ($this->input->post('tampilkan') == "View Excel") {
			$var_bln					= $this->input->post('bulan_neraca');
			$var_thn					= $this->input->post('tahun_neraca');
			$level						= $this->input->post('level');
			redirect('report/excel_neraca/' . $var_bln . '/' . $var_thn . '/' . $level);
		} elseif ($this->input->post('tampilkan') == "View Pdf") {
			$var_bln					= $this->input->post('bulan_neraca');
			$var_thn					= $this->input->post('tahun_neraca');
			$level						= $this->input->post('level');
			redirect('report/print_neraca/' . $var_bln . '/' . $var_thn . '/' . $level);
		} else {
			$data['judul']			= "Laporan Neraca";

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

			$this->load->view("report/v_list_neraca", $data);
		}
	}
	function print_neraca()
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

		$html			= $this->load->view('report/v_print_neraca', $data, true);
		$pdfFilePath	= "Laporan_Neraca_" . $var_bulan . "_" . $var_tahun . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P', // L = Landscape, P = Potrait
			'',
			'',
			'',
			20, // margin_left
			20, // margin right
			20, // margin top
			5, // margin bottom
			5, // margin header
			5
		); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		//redirect('report/tampilkan_labarugi');
	}

	function excel_neraca()
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

		$this->load->view("report/v_neraca_excel", $data);
	}

	// SYAM TERKAIT REPORT KARTU PIUTANG

	function ar()
	{
		$data['judul']			= "Laporan Piutang";
		$data['datklien']     = $this->Report_model->pilih_klien();
		$this->load->view("report/v_ar", $data);
	}

	function tampilkan_ar()
	{
		$data['judul']			= "Laporan Piutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=LaporanPiutang.xls");
		}

		$var_bulan					= $this->input->post('bulan_labarugi');
		$var_tahun					= $this->input->post('tahun_labarugi');
		$cust						= $this->input->post('id_klien');
		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();
		$data['datklien']     = $this->Report_model->pilih_klien();
		$data['data_ar']	= $this->Report_model->get_ar($var_bulan, $var_tahun, $cust);



		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("report/v_list_ar", $data);
	}

	function tampilkan_ar_total()
	{
		$data['judul']			= "Laporan Piutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=LaporanPiutang.xls");
		}

		$var_bulan					= $this->input->post('bulan_labarugi');
		$var_tahun					= $this->input->post('tahun_labarugi');
		$cust						= $this->input->post('id_klien');

		// print_r($cust);
		// exit;




		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();
		$data['datklien']     = $this->Report_model->pilih_klien();
		$data['data_ar']	= $this->Report_model->get_ar_total($var_bulan, $var_tahun, $cust);



		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("report/v_list_ar_total", $data);
	}


	function ap()
	{
		$data['judul']			= "Laporan Hutang";
		$data['datklien']     = $this->Report_model->pilih_vendor();
		$this->load->view("report/v_ap", $data);
	}

	function tampilkan_ap()
	{
		$data['judul']			= "Laporan Hutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=LaporanPiutang.xls");
		}

		$var_bulan					= $this->input->post('bulan_labarugi');
		$var_tahun					= $this->input->post('tahun_labarugi');
		$cust						= $this->input->post('id_klien');
		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();
		$data['datklien']     = $this->Report_model->pilih_vendor();
		$data['data_ar']	= $this->Report_model->get_ap($var_bulan, $var_tahun, $cust);



		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("report/v_list_ap", $data);
	}

	function tampilkan_ap_total()
	{
		$data['judul']			= "Laporan Hutang";

		if ($this->input->post('tampilkan') == "View Excel") {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=LaporanPiutang.xls");
		}

		$var_bulan					= $this->input->post('bulan_labarugi');
		$var_tahun					= $this->input->post('tahun_labarugi');
		$cust						= $this->input->post('id_klien');

		// print_r($cust);
		// exit;




		$data['data_bulan']		= $this->Report_model->get_bulan_coa();
		$data['data_tahun']		= $this->Report_model->get_tahun_coa();
		$data['datklien']     = $this->Report_model->pilih_vendor();
		$data['data_ar']	= $this->Report_model->get_ap_total($var_bulan, $var_tahun, $cust);



		$data['data_bulan_post']			= $var_bulan;
		$data['data_tahun_post']			= $var_tahun;

		$this->load->view("report/v_list_ap_total", $data);
	}

	function umur_piutang()
	{
		if ($this->input->get('tampilkan') == "View Excel") {
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=LaporanUmurPiutang.xls");
		}
		$data['judul']			= "Laporan Umur Piutang";
		$cust = '';
		$var_bulan				= $this->input->get('bulan');
		$var_tahun				= $this->input->get('tahun');
		$rekap					= $this->input->get('rekap');
		$data['datklien']		= $this->Report_model->pilih_klien();
		if ($rekap == 'rekap') {
			$data['data_ar']		= $this->Report_model->get_umur_piutang_rekap($var_bulan, $var_tahun);
		} else {
			$cust					= $this->input->get('id_klien');
			$data['data_ar']		= $this->Report_model->get_umur_piutang($var_bulan, $var_tahun, $cust);
		}
		$data['data_bulan_post'] = $var_bulan;
		$data['data_tahun_post'] = $var_tahun;
		$data['id_klien'] = $cust;
		$data['rekap'] = $rekap;
		$this->load->view("report/v_list_umur_piutang", $data);
	}
	
}
