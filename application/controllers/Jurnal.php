<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jurnal extends CI_Controller
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

		$this->load->model('Jurnal_model');
		$this->load->model('master_model');
		$this->load->model('komisi_model');
		$this->load->model('invoice_model');
		$this->load->model('Model_latihan2');
		$this->load->model('Model_latihan');
		$this->load->helper('menu');
	}

	public function index()
	{
	}

	public function jvcost()
	{
		$data['judul'] 			= "Input JV";

		$data['data_cabang'] = $this->Model_latihan2->cek_list_kode_cabang();
		//$data['data_nokir1']=$this->Model_latihan2->cek_nokir1();

		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}

		$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();

		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		//$data['data_project']		= $this->Jurnal_model->get_project();
		$data['pesan'] 			= 0;
		$this->load->view('jurnal/v_add_jvcost2', $data);
	}

	public function list_jv()
	{
		$data['judul'] 			= "Jurnal Voucher";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_listjv']		= $this->Jurnal_model->list_jv($bln_aktif, $thn_aktif);

		$this->load->view('jurnal/v_list_jv', $data);
	}
	
	public function list_jv_excel()
	{
		$data['judul'] 			= "Jurnal Voucher";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_listjv']		= $this->Jurnal_model->list_jv_excel($bln_aktif, $thn_aktif);

		$this->load->view('jurnal/v_list_jv_detail', $data);
	}

	public function proses_input_jvcost()
	{
		if ($this->input->post()) {
			$hasil	= $this->Model_latihan2->inputJvCost();
			$data['pesan'] 			= 1;

			// redirect('latihan2/jvcost');
			redirect('jurnal/list_jv');
		}
	}
	function detail_jv()
	{
		$nomor_jurnal		= $this->uri->segment(3);
		$data['nomor_jurnal']		= $this->uri->segment(3);

		$data['judul']		= "Detail JV";
		$data['list_data'] 	= $this->Jurnal_model->get_detail_jv($nomor_jurnal);

		$this->load->view("jurnal/v_detail_jv", $data);
	}


	function print_jv()
	{
		$nomor_jurnal				= $this->uri->segment(3);
		$data['nomor_jurnal']		= $this->uri->segment(3);
		$data['data_bulan_post'] 	= $this->uri->segment(4);
		$data['data_tahun_post']	= $this->uri->segment(5);

		$data['data_javh']			= $this->Jurnal_model->get_javh($nomor_jurnal);

		$data['jurnal_jv'] 			= $this->Jurnal_model->get_detail_jv($nomor_jurnal);

		$html			= $this->load->view('jurnal/v_print_jv', $data, true);
		$pdfFilePath	= "JV" . $nomor_jurnal . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load_a4();
		// $this->load->library('/MPDF57/mpdf');
		// $mpdf = new mPDF('c', 'A4-L');
		$pdf->AddPage("L", "", "", "", "", "15", "15", "15", "15", "", "", "", "", "", "", "", "", "", "", "", "A4");
		// $pdf->AddPage(
		// 	'L',
		// 	'',
		// 	'',
		// 	'',
		// 	10, // margin_left
		// 	10, // margin right
		// 	20, // margin top
		// 	10, // margin bottom
		// 	10, // margin header
		// 	10
		// ); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
	}


	function tampil_total()
	{

		$id_ = $this->input->get('option');
		$id__ = str_replace(",", "", $id_);
		$id = number_format($id__, 0, ".", ",");

		echo "<input class='form-control input-sm' name='total' id='total' value='" . $id . "'readonly/>";
		echo "</td>";
	}

	function detail_jurnal_buk($no_buk)
	{
		$sql = "
		SELECT 
			* 
		FROM 
			jurnal 
		WHERE 
			tipe = 'BUK' 
			AND nomor = '" . $no_buk . "'
			AND SUBSTR(no_perkiraan,1,4) NOT IN ('1102','1101') 
		ORDER BY 
			debet DESC
	";
		$data['detail']         = $this->db->query($sql);
		$data['rows_header']     = $this->db->get_where('japh', array('nomor' => $no_buk))->result();
		// $data['nobum']          = $no_buk;

		$this->load->view("jurnal/vmodal_detail_jurnal_buk", $data);
	}

	function list_dana_keluar()
	{
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode; // 01-2020
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2); // 01
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4); // 2020
			}
		}

		$awal = 1;
		$akhir = 31;

		if ($bln_aktif > 9) {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		} else {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		}

		$data['tanggal_awal'] = date("01-m-Y", strtotime($var_tgl_awal));
		$data['tanggal_akhir'] = date("t-m-Y", strtotime($var_tgl_akhir));

		$data['judul'] = "Bukti Uang Keluar";
		$data['list_data'] = $this->Jurnal_model->list_dana_keluar($var_tgl_awal, $var_tgl_akhir);
		$data['pesan_on'] = 0;
		$this->load->view('jurnal/v_list_dana_keluar', $data);
	}

	public function modal_detailbuk($nomorjurnal)
	{
		$data['nomorjurnal']		= $nomorjurnal;
		$tipe = "BUK";
		$data['data_jurnal']		= $this->Jurnal_model->get_detailjur($nomorjurnal, $tipe);
		// $tanggal					= $this->Jurnal_model->get_detailjur($nomorjurnal, $tipe)->row();
		// $data['tanggal']		= $tanggal->tanggal;
		$this->load->view('jurnal/vmodal_detjur_buk', $data);
	}

	function filter_tgl_buk()
	{
		// $data['list_data'] = $this->Jurnal_model->list_dana_keluar();

		$data['judul']		= "Bukti Uang Keluar";
		if ($this->input->post('view') == "View List Excel") {
			// $date = date("d-m-Y", strtotime($this->input->post('tanggal')));
			$date_ = $this->input->post('tanggal');
			$date = str_replace(" - ", "_", $date_);
			$date2_ = $this->input->post('tanggal2');
			$date2 = str_replace(" - ", "_", $date2_);
			redirect('jurnal/view_excel/' . $date . '/' . $date2);
		} else if ($this->input->post('view') == "View Detail Excel") {
			// $date = date("d-m-Y", strtotime($this->input->post('tanggal')));
			$date_ = $this->input->post('tanggal');
			$date = str_replace(" - ", "_", $date_);
			$date2_ = $this->input->post('tanggal2');
			$date2 = str_replace(" - ", "_", $date2_);
			redirect('jurnal/view_excel_detail/' . $date . '/' . $date2);
		}
		else {
			// $tanggal	= date("Y-m-d", strtotime($this->input->post('tanggal'))); // dd-mm-yyyy --> yyyy-mm-dd
			// $tanggal2	= date("Y-m-d", strtotime($this->input->post('tanggal2'))); // dd-mm-yyyy --> yyyy-mm-dd
			$tanggal_	= $this->input->post('tanggal');
			$tanggal	= date_format(new DateTime($tanggal_), "Y-m-d");
			$tanggal2_	= $this->input->post('tanggal2');
			$tanggal2	= date_format(new DateTime($tanggal2_), "Y-m-d");

			if (empty($tanggal)) {
				$tanggal = date('Y-m-01');
			}

			if (empty($tanggal2)) {
				$tanggal2 = date('Y-m-d');
			}

			$data['tanggal']		= $tanggal;
			$data['tanggal2']		= $tanggal2;

			$data['filter_tgl']			= $this->Jurnal_model->filter_tgl_buk($tanggal, $tanggal2);
			//	$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan_filter();

			$this->load->view("jurnal/v_list_buk_filter", $data);
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
		//$data['filter_tgl_bum']	= $this->Jurnal_model->filter_tgl_bum($tanggal, $tanggal2);
		$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_buk($tanggal, $tanggal2);

		$this->load->view("jurnal/view_excel", $data);
	}
	
	function view_excel_detail()
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
		//$data['filter_tgl_bum']	= $this->Jurnal_model->filter_tgl_bum($tanggal, $tanggal2);
		$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_buk($tanggal, $tanggal2);

		$this->load->view("jurnal/view_excel_detail", $data);
	}

	function list_dana_masuk()
	{
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$awal = 1;
		$akhir = 31;

		if ($bln_aktif > 9) {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		} else {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		}
		// $var_tgl_awal			= "2019-12-01";
		// $var_tgl_akhir			= "2019-12-31";

		$data['tanggal_awal'] = date("01-m-Y", strtotime($var_tgl_awal));
		$data['tanggal_akhir'] = date("t-m-Y", strtotime($var_tgl_akhir));

		$data['judul'] = "Bukti Uang Masuk";
		$data['list_data'] = $this->Jurnal_model->list_dana_masuk($var_tgl_awal, $var_tgl_akhir);
		// $data['id_bum']	= $this->uri->segment(3);
		// $data['tgl_bum']	= $this->uri->segment(4);
		$data['pesan_on'] = 0;
		$this->load->view('jurnal/v_list_dana_masuk', $data);
	}

	public function modal_detailbum($nomorjurnal)
	{
		$data['nomorjurnal']		= $nomorjurnal;
		$tipe = "BUM";
		$data['data_jurnal']		= $this->Jurnal_model->get_detailjur($nomorjurnal, $tipe);
		$this->load->view('jurnal/vmodal_detjur_bum', $data);
	}

	function filter_tgl_bum()
	{
		//$data['list_data'] = $this->Jurnal_model->list_dana_masuk();

		$data['judul']		= "List Jurnal";
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			// $date = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			// $date2 = str_replace(" - ", "_", $date2);
			redirect('jurnal/view_excel_bum/' . $date . '/' . $date2);
		} else if ($this->input->post('view') == "View Detail Excel") {
			$date = $this->input->post('tanggal');
			// $date = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			// $date2 = str_replace(" - ", "_", $date2);
			redirect('jurnal/view_excel_bum_detail/' . $date . '/' . $date2);
		}else{
			$tanggal	= date_format(new DateTime($this->input->post('tanggal')), "Y-m-d"); // dd-mm-yyyy --> yyyy-mm-dd
			$tanggal2	= date_format(new DateTime($this->input->post('tanggal2')), "Y-m-d"); // dd-mm-yyyy --> yyyy-mm-dd

			if (empty($tanggal)) {
				$tanggal = date('Y-m-01');
			}

			if (empty($tanggal2)) {
				$tanggal2 = date('Y-m-d');
			}

			$data['tanggal']		= date("d-m-Y", strtotime($tanggal));
			$data['tanggal2']		= date("d-m-Y", strtotime($tanggal2));

			$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_bum($tanggal, $tanggal2);
			//$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();

			$this->load->view("jurnal/v_list_bum_filter", $data);
		}
	}

	function view_excel_bum()
	{

		$tanggal_ 	= $this->uri->segment(3);
		// $tanggal	= date("Y-m-d", strtotime($tanggal_)); // dd-mm-yyyy --> yyyy-mm-dd
		$tanggal	= date_format(new DateTime($tanggal_), "Y-m-d");
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2_ = $this->uri->segment(4);
		// $tanggal2	= date("Y-m-d", strtotime($tanggal2_)); // dd-mm-yyyy --> yyyy-mm-dd
		$tanggal2	= date_format(new DateTime($tanggal2_), "Y-m-d");
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']		= date("d-m-Y", strtotime($tanggal));
		$data['tanggal2']		= date("d-m-Y", strtotime($tanggal2));

		$data['filter_tgl_bum']	= $this->Jurnal_model->filter_tgl_bum($tanggal, $tanggal2);
		//$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_buk($tanggal, $tanggal2);

		$this->load->view("jurnal/view_excel_bum", $data);
	}
	
	function view_excel_bum_detail()
	{

		$tanggal_ 	= $this->uri->segment(3);
		// $tanggal	= date("Y-m-d", strtotime($tanggal_)); // dd-mm-yyyy --> yyyy-mm-dd
		$tanggal	= date_format(new DateTime($tanggal_), "Y-m-d");
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2_ = $this->uri->segment(4);
		// $tanggal2	= date("Y-m-d", strtotime($tanggal2_)); // dd-mm-yyyy --> yyyy-mm-dd
		$tanggal2	= date_format(new DateTime($tanggal2_), "Y-m-d");
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']		= date("d-m-Y", strtotime($tanggal));
		$data['tanggal2']		= date("d-m-Y", strtotime($tanggal2));

		$data['filter_tgl_bum']	= $this->Jurnal_model->filter_tgl_bum($tanggal, $tanggal2);
		//$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_buk($tanggal, $tanggal2);

		$this->load->view("jurnal/view_excel_bum_detail", $data);
	}

	function input_pembayaran()
	{

		$data['judul']			= "Input Pembayaran";
		$data['data_bank']		= $this->Jurnal_model->get_bank();

		$invoice_no				= $this->uri->segment(3);

		$data['data_invoice']	= $this->invoice_model->get_data($invoice_no);

		$data['data_owner']		= $this->invoice_model->get_owner();

		$data['data_project']	= $this->Jurnal_model->get_project();

		$data['pay_methods']	= array(0, "CASH", "CHECK", "TRANSFER", "BG");

		$data['pay_text']		= array("-Pilih Metode Pembayaran-", "CASH", "CHECK", "TRANSFER", "BG");

		$this->load->view('jurnal/v_input_bayar', $data);
	}


	function list_dana_masuk_lain()
	{
		$data['judul']		= "List Dana Masuk Lain-lain";
		$data['list_data'] = $this->Jurnal_model->list_dana_masuk();
		//$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();
		$data['id_bum']	= $this->uri->segment(3);
		$data['tgl_bum']	= $this->uri->segment(4);

		$this->load->view("jurnal/v_list_dana_masuk_lain", $data);
	}

	function print_request_buk()
	{
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load_c();
		//$mpdf = new mPDF('c', 'A5-P'); 
		//$mpdf=new mPDF('utf-8', array(210,170));
		$no_buk_ = '';
		$sg_tgl = '';

		if ($this->input->post('pilih') == null) { // jika data dikirim lewat url
			$no_buk_ 			= $this->uri->segment(3);
			$sg_tgl 			= $this->uri->segment(4);
			//var_dump($no_buk_);
			//var_dump($sg_tgl);

			$tipe_bu			= "BUK";
			$sg_tglx			= str_replace("_", "-", $sg_tgl);
			$sg_tglxx 			= date("Y-m-d", strtotime($sg_tglx));
			$no_buk				= str_replace("_", "-", $no_buk_);
			$pdfFilePath	= $tipe_bu . "_" . $no_buk . ".pdf";
			$data['list_print']	= $this->Jurnal_model->get_print_req($no_buk);
			$data['list_detail']	= $this->Jurnal_model->get_print_detail($no_buk, $sg_tglxx, $tipe_bu);
			$data['data_keluardr']	= $this->Jurnal_model->get_print_keluardr($no_buk, $sg_tglxx, $tipe_bu);

			$html			= $this->load->view('jurnal/v_print_buk_2', $data, true);
		} elseif ($this->input->post('pilih') != null) { // jika data dikirim lewat form checkbox
			$pilih = $this->input->post('pilih');

			foreach ($pilih as $key => $value) {
				// explode checkbox value
				$value = str_replace('(', '', $value);
				$value = str_replace(')', '', $value);
				$exp = explode('/', $value);
				$no_buk_ = $exp[0];
				$sg_tgl = $exp[1];
				//echo "no_buk : ".$no_buk_.'<br/>';
				//echo "sg_tgl : ".$sg_tgl.'<br/><br/>';
				//echo $value.', ';

				$tipe_bu			= "BUK";
				$sg_tglx			= str_replace("_", "-", $sg_tgl);
				$sg_tglxx 			= date("Y-m-d", strtotime($sg_tglx));
				$no_buk				= str_replace("_", "-", $no_buk_);
				$pdfFilePath	= $tipe_bu . "_" . $no_buk . ".pdf";
				$data['list_print']	= ($this->Jurnal_model->get_print_req($no_buk)) ? $this->Jurnal_model->get_print_req($no_buk) : array();
				$data['list_detail']	= ($this->Jurnal_model->get_print_detail($no_buk, $sg_tglxx, $tipe_bu)) ? $this->Jurnal_model->get_print_detail($no_buk, $sg_tglxx, $tipe_bu) : array();
				$data['data_keluardr']	= ($this->Jurnal_model->get_print_keluardr($no_buk, $sg_tglxx, $tipe_bu)) ? $this->Jurnal_model->get_print_keluardr($no_buk, $sg_tglxx, $tipe_bu) : array();

				$html[$key]			= $this->load->view('jurnal/v_print_buk_2', $data, true);
			}
		}

		//print_r($data['list_print']);
		//var_dump($html);
		if ($html != null) { // jika tidak kosong
			$before = '<!DOCTYPE html>
			<html>
			<head>
			
			</head>
			<body>';
			$after = '</body></html>';
			//echo count($html);
			if (count($html) > 0) {
				foreach ($html as $key => $value) {
					$data_html .= $value;
				}
				$pdf->AddPage(
					'P',
					'',
					'',
					'',
					// margin right
					1, // margin top
					1, // margin bottom
					5, // margin header
					10, // margin top
					10, // margin bottom
					5
				); // margin footer
				$pdf->WriteHTML($before . $data_html . $after);
			} elseif (count($html) == 0) {
				$pdf->AddPage(
					'P',
					'',
					'',
					'',
					// margin right
					1, // margin top
					1, // margin bottom
					5, // margin header
					10, // margin top
					10, // margin bottom
					5
				); // margin footer
				$pdf->WriteHTML($before . $html . $after);
			}

			$pdf->Output($pdfFilePath, 'I');
		}
	}
	function print_request_buk_id()
	{
		$no_buk 			= $this->uri->segment(3);
		$sg_tgl 			= $this->uri->segment(4);
		$tipe_bu			= "BUK";
		$sg_tglx			= str_replace("_", "-", $sg_tgl);
		$sg_tglxx 			= date("Y-m-d", strtotime($sg_tglx));
		$no_buk				= str_replace("_", "-", $no_buk);
		$data['list_print']	= $this->Jurnal_model->get_print_req($no_buk);
		$data['list_detail']	= $this->Jurnal_model->get_print_detail($no_buk, $sg_tglxx, $tipe_bu);
		$data['list_detail2']	= $this->Jurnal_model->get_print_detail2($no_buk, $sg_tglxx, $tipe_bu);
		$data['data_keluardr']	= $this->Jurnal_model->get_print_keluardr($no_buk, $sg_tglxx, $tipe_bu);
		// echo $sg_tglxx;
		// exit;
		$html			= $this->load->view('jurnal/v_print_buk_2', $data, true);
		$pdfFilePath	= $tipe_bu . "_" . $no_buk . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load_c();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
			'',
			'',
			'',
			1, // margin top
			1, // margin bottom
			5, // margin header
			10, // margin top
			10, // margin bottom
			5
		); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
	}
	function print_request_bum()
	{
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load_c();
		//$mpdf = new mPDF('c', 'A5-P'); 
		//$mpdf=new mPDF('utf-8', array(210,170));
		$no_bum_ = '';
		$sg_tgl = '';

		if ($this->input->post('pilih') == null) { // jika data dikirim lewat url
			$no_bum_ 			= $this->uri->segment(3);
			$sg_tgl 			= $this->uri->segment(4);
			//var_dump($no_buk_);
			//var_dump($sg_tgl);

			$tipe_bu			= "BUM";
			$sg_tglx			= str_replace("_", "-", $sg_tgl);
			$sg_tglxx 			= date("Y-m-d", strtotime($sg_tglx));
			$no_bum				= str_replace("_", "-", $no_bum_);
			$pdfFilePath	= $tipe_bu . "_" . $no_bum . ".pdf";
			$data['list_print']	= $this->Jurnal_model->get_print_reqbum($no_bum);
			$data['list_detail']	= $this->Jurnal_model->get_print_detail($no_bum, $sg_tglxx, $tipe_bu);
			$data['data_keluardr']	= $this->Jurnal_model->get_print_keluardr($no_bum, $sg_tglxx, $tipe_bu);

			$html			= $this->load->view('jurnal/v_print_bum_2', $data, true);
		} elseif ($this->input->post('pilih') != null) { // jika data dikirim lewat form checkbox
			$pilih = $this->input->post('pilih');

			foreach ($pilih as $key => $value) {
				// explode checkbox value
				$value = str_replace('(', '', $value);
				$value = str_replace(')', '', $value);
				$exp = explode('/', $value);
				$no_bum_ = $exp[0];
				$sg_tgl = $exp[1];
				//echo "no_buk : ".$no_buk_.'<br/>';
				//echo "sg_tgl : ".$sg_tgl.'<br/><br/>';
				//echo $value.', ';

				$tipe_bu			= "BUM";
				$sg_tglx			= str_replace("_", "-", $sg_tgl);
				$sg_tglxx 			= date("Y-m-d", strtotime($sg_tglx));
				$no_bum				= str_replace("_", "-", $no_bum_);
				$pdfFilePath	= $tipe_bu . "_" . $no_bum . ".pdf";
				$data['list_print']	= ($this->Jurnal_model->get_print_reqbum($no_bum)) ? $this->Jurnal_model->get_print_reqbum($no_bum) : array();
				$data['list_detail']	= ($this->Jurnal_model->get_print_detail($no_bum, $sg_tglxx, $tipe_bu)) ? $this->Jurnal_model->get_print_detail($no_bum, $sg_tglxx, $tipe_bu) : array();
				$data['data_keluardr']	= ($this->Jurnal_model->get_print_keluardr($no_bum, $sg_tglxx, $tipe_bu)) ? $this->Jurnal_model->get_print_keluardr($no_bum, $sg_tglxx, $tipe_bu) : array();

				$html[$key]			= $this->load->view('jurnal/v_print_bum_2', $data, true);
			}
		}

		//print_r($data['list_print']);
		//var_dump($html);
		if ($html != null) { // jika tidak kosong
			$before = '<!DOCTYPE html>
			<html>
			<head>
			
			</head>
			<body>';
			$after = '</body></html>';
			//echo count($html);
			if (count($html) > 0) {
				foreach ($html as $key => $value) {
					$data_html .= $value;
				}
				$pdf->AddPage(
					'P',
					'',
					'',
					'',
					// margin right
					1, // margin top
					1, // margin bottom
					5, // margin header
					10, // margin top
					10, // margin bottom
					5
				); // margin footer
				$pdf->WriteHTML($before . $data_html . $after);
			} elseif (count($html) == 0) {
				$pdf->AddPage(
					'P',
					'',
					'',
					'',
					// margin right
					1, // margin top
					1, // margin bottom
					5, // margin header
					10, // margin top
					10, // margin bottom
					5
				); // margin footer
				$pdf->WriteHTML($before . $html . $after);
			}

			$pdf->Output($pdfFilePath, 'I');
		}
	}

	function print_request_bum_id()
	{
		$no_bum 			= $this->uri->segment(3);
		$sg_tgl 			= $this->uri->segment(4);
		$tipe_bu			= "BUM";
		$sg_tglx			= str_replace("_", "-", $sg_tgl);
		$sg_tglxx 			= date("Y-m-d", strtotime($sg_tglx));
		$no_bum				= str_replace("_", "-", $no_bum);
		$data['list_print']	= $this->Jurnal_model->get_print_reqbum($no_bum);
		$data['list_detail']	= $this->Jurnal_model->get_print_detail($no_bum, $sg_tglxx, $tipe_bu);
		$data['list_detail3']	= $this->Jurnal_model->get_print_detail3($no_bum, $sg_tglxx, $tipe_bu);
		$data['data_keluardr']	= $this->Jurnal_model->get_print_keluardr($no_bum, $sg_tglxx, $tipe_bu);

		$html			= $this->load->view('jurnal/v_print_bum_2', $data, true);
		$pdfFilePath	= $tipe_bu . "_" . $no_bum . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A5-P'); 
		//$mpdf=new mPDF('utf-8', array(210,170));
		$pdf->AddPage(
			'P',
			'',
			'',
			'',
			// margin right
			1, // margin top
			1, // margin bottom
			5, // margin header
			10, // margin top
			10, // margin bottom
			5
		); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
	}

	function list_dana_keluar_backup()
	{
		$data['judul'] = "Bukti Uang Keluar";
		$data['list_data'] = $this->Jurnal_model->list_dana_keluar();
		$data['pesan_on'] = 0;
		$this->load->view('jurnal/v_list_dana_keluar', $data);
	}


	function list_belum_byr()
	{
		$data['judul']		= "List Dana Masuk";

		$data['list_invoice']	= $this->invoice_model->daftar_invoice2();

		$this->load->view("jurnal/v_list_invoice2", $data);
	}

	public function dana_masuk()
	{
		$data['judul']				= "Input Dana Masuk";
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();

		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		//$data['data_project']		= $this->Jurnal_model->get_project();
		$this->load->view('jurnal/v_input_dana_masuk', $data);
	}
	public function dana_masuk_edit()
	{
		$data['judul']				= "Edit Dana Masuk";
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		// $data['data_project']		= $this->Jurnal_model->get_project();
		// $data['data_vendor']		= $this->Jurnal_model->get_vendor();

		$nomor_bum_				= $this->uri->segment(3);
		$nomor_bum				= str_replace('_', '-', $nomor_bum_);

		$data['data_jarh']				= $this->Jurnal_model->get_jarh($nomor_bum);
		$data['data_jurnal_kasbank_bum']	= $this->Jurnal_model->get_jurnal_kasbank_bum($nomor_bum);
		$data['data_jurnal_nokasbank_bum']	= $this->Jurnal_model->get_jurnal_nokasbank_bum($nomor_bum);
		$this->load->view('jurnal/v_input_dana_masuk_edit', $data);
	}
	public function proses_edit_dana_masuk()
	{
		if ($this->input->post()) {
			$hasil	= $this->Jurnal_model->editDanaMasuk();
			echo "<script> alert('Data berhasil di simpan!')";
			echo "</script>";
			redirect('jurnal/list_dana_masuk');
		}
	}

	public function dana_masuk_lain()
	{
		$data['judul']				= "Input Dana Masuk Lain-lain";
		$data['data_bank']		= $this->Jurnal_model->get_bank();
		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();
		$data['data_project']		= $this->Jurnal_model->get_project();
		$this->load->view('jurnal/v_input_dana_masuk_lain', $data);
	}

	public function dana_keluar()
	{

		$data['judul']				= "Input Dana Keluar";
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();

		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		//$data['data_project']		= $this->Jurnal_model->get_project();
		//$data['data_vendor']		= $this->Jurnal_model->get_vendor();
		$this->load->view('jurnal/v_input_dana_keluar', $data);
	}

	public function dana_keluar_edit()
	{
		$data['judul']				= "Edit Dana Keluar";
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_bank']			= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		//$data['data_project']		= $this->Jurnal_model->get_project();
		//$data['data_vendor']		= $this->Jurnal_model->get_vendor();

		$nomor_buk_				= $this->uri->segment(3);
		$nomor_buk				= str_replace('_', '-', $nomor_buk_);

		$data['data_japh']				= $this->Jurnal_model->get_japh($nomor_buk);
		$data['data_jurnal_kasbank']	= $this->Jurnal_model->get_jurnal_kasbank($nomor_buk);
		$data['data_jurnal_nokasbank']	= $this->Jurnal_model->get_jurnal_nokasbank($nomor_buk);
		$this->load->view('jurnal/v_input_dana_keluar_edit', $data);
	}
	public function proses_edit_dana_keluar()
	{
		if ($this->input->post()) {
			$hasil	= $this->Jurnal_model->editDanaKeluar();
			echo "<script> alert('Data berhasil di simpan!')";
			echo "</script>";
			redirect('jurnal/list_dana_keluar');
		}
	}

	public function dana_keluar_batal()
	{
		$id_bukx			= $this->uri->segment(3);
		$note_batal			= "Batal BUK No." . $id_bukx;

		$this->db->query("UPDATE japh set batal='1', note='$note_batal' where nomor='$id_bukx'");
		$this->db->query("UPDATE jurnal set batal='1' where nomor='$id_bukx' and tipe='BUK'");
		$data['pesan_on']				= 1;

		$data['judul'] = "Bukti Uang Keluar";
		$data['list_data'] = $this->Jurnal_model->list_dana_keluar();

		$this->load->view('jurnal/v_list_dana_keluar', $data);
		//redirect('jurnal/list_dana_keluar');
	}

	public function vmodal_batal_buk()
	{
		$data_idbuk['id_buk']			= $this->uri->segment(3);
		// $id			= $this->input->get('option');
		// $data_idbuk['id_buk']	= str_replace("_","-",$id);

		$this->load->view('jurnal/vmodal_batal_buk', $data_idbuk);
	}
	public function proses_vmodal_batal_buk()
	{

		$id_buk			= $this->input->post('id_buk');
		$alasan_batal	= $this->input->post('alasan_batal_buk');

		$this->db->query("UPDATE japh set batal='1' where nomor='$id_buk'");

		$update_jurnal = $this->db->query("SELECT * FROM jurnal WHERE nomor='$id_buk' and tipe='BUK'")->result();

		if ($update_jurnal > 0) {
			foreach ($update_jurnal as $row_jur_BUK) {
				$BUK_tipe			= $row_jur_BUK->tipe;
				$BUK_nomor			= $row_jur_BUK->nomor;
				$BUK_tanggal		= $row_jur_BUK->tanggal;
				$BUK_no_perkiraan	= $row_jur_BUK->no_perkiraan;
				$BUK_keterangan		= $row_jur_BUK->keterangan;
				$BUK_jenis_trans	= $row_jur_BUK->jenis_trans;
				$BUK_no_reff		= $row_jur_BUK->no_reff;
				$BUK_debet			= $row_jur_BUK->debet;
				$BUK_kredit			= $row_jur_BUK->kredit;

				$update_ket	= "BATAL " . $BUK_keterangan;

				$this->db->query("INSERT INTO jurnal (tipe,nomor,tanggal,no_perkiraan,keterangan,jenis_trans,no_reff,debet,kredit,valid,stspos) VALUES ('$BUK_tipe','$BUK_nomor','$BUK_tanggal','$BUK_no_perkiraan','$update_ket','$BUK_jenis_trans','$BUK_no_reff','$BUK_kredit','$BUK_debet','1','0')");
			}
		}

		$insert_jurnal_batal = array(
			'nomor'			=> $id_buk,
			'tipe'			=> "BUK",
			'reason'		=> $alasan_batal,
			'user'			=> $this->session->userdata('pn_name'),
			'kdcab'			=> $this->session->userdata('kode_cabang'),
			'waktu'			=> date('Y-m-d H:i:s')
		);
		$this->db->insert("jurnal_batal", $insert_jurnal_batal);

		$transaksi	= "BATAL " . $BUK_keterangan . " (No.BUK: " . $id_buk . ")";
		$in_log_transaksi		= array(
			'transaksi'		=> $transaksi,
			'nama_user'		=> $this->session->userdata('pn_name'),
			'waktu'			=> date('Y-m-d H:i:s')
		);
		$this->db->insert("log_transaksi", $in_log_transaksi);
		
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		
		$awal = 1;
		$akhir = 31;

		if ($bln_aktif > 9) {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		} else {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		}

		$data['pesan_on']				= 1;

		$data['judul'] = "Bukti Uang Keluar";
		$data['list_data'] = $this->Jurnal_model->list_dana_keluar($var_tgl_awal,$var_tgl_akhir);
		$this->load->view('jurnal/v_list_dana_keluar', $data);

		// $note_batal			= "Batal BUK No. " . $id_buk;

		// $this->db->query("UPDATE japh set batal='1', note='$note_batal', reason_batal='$alasan_batal' where nomor='$id_buk'");

		// $data_jurnal_debet = $this->Jurnal_model->ambil_jurnal_buk_debet($id_buk);

		// if ($data_jurnal_debet > 0) {
		// 	foreach ($data_jurnal_debet as $r_jur) {
		// 		$nokir			= $r_jur->no_perkiraan;
		// 		$tgl			= $r_jur->tanggal;
		// 		$ket			= $r_jur->keterangan;
		// 		$jenis_trans	= $r_jur->jenis_trans;
		// 		$no_reff		= $r_jur->no_reff;
		// 		$debet			= $r_jur->debet;
		// 	}
		// }

		// $in_jurnal_cancel_debet		= array(
		// 	'tipe'			=> "BUK",
		// 	'nomor'			=> $id_buk,
		// 	'tanggal'		=> $tgl,
		// 	'no_perkiraan'	=> $nokir,
		// 	'keterangan'	=> $ket,
		// 	'jenis_trans'	=> $jenis_trans,
		// 	'no_reff'		=> $no_reff,
		// 	'debet'			=> $debet,
		// 	'kredit'		=> '0',
		// 	'waktu'			=> date('Y-m-d H:i:s'),
		// 	'batal'			=> '1'
		// );
		// $this->db->insert("jurnal_cancel", $in_jurnal_cancel_debet);

		// $data_jurnal_kredit = $this->Jurnal_model->ambil_jurnal_buk_kredit($id_buk);

		// if ($data_jurnal_kredit > 0) {
		// 	foreach ($data_jurnal_kredit as $r_jur2) {
		// 		$nokir2			= $r_jur2->no_perkiraan;
		// 		$tgl2			= $r_jur2->tanggal;
		// 		$ket2			= $r_jur2->keterangan;
		// 		$jenis_trans2	= $r_jur2->jenis_trans;
		// 		$no_reff2		= $r_jur2->no_reff;
		// 		$kredit2		= $r_jur2->kredit;
		// 	}
		// }

		// $in_jurnal_cancel_kredit		= array(
		// 	'tipe'			=> "BUK",
		// 	'nomor'			=> $id_buk,
		// 	'tanggal'		=> $tgl2,
		// 	'no_perkiraan'	=> $nokir2,
		// 	'keterangan'	=> $ket2,
		// 	'jenis_trans'	=> $jenis_trans2,
		// 	'no_reff'		=> $no_reff2,
		// 	'debet'			=> '0',
		// 	'kredit'		=> $kredit2,
		// 	'waktu'			=> date('Y-m-d H:i:s'),
		// 	'batal'			=> '1'
		// );
		// $this->db->insert("jurnal_cancel", $in_jurnal_cancel_kredit);

		// $in_log_transaksi		= array(
		// 	'transaksi'		=> $note_batal,
		// 	'nama_user'		=> $this->session->userdata('pn_name'),
		// 	'waktu'			=> date('Y-m-d H:i:s')
		// );
		// $this->db->insert("log_transaksi", $in_log_transaksi);

		// $this->db->query("UPDATE jurnal set batal='1' where nomor='$id_buk' and tipe='BUK'");

		// $data['pesan_on']				= 1;

		// $data['judul'] = "Bukti Uang Keluar";
		// $data['list_data'] = $this->Jurnal_model->list_dana_keluar();
		// $this->load->view('jurnal/v_list_dana_keluar', $data);
	}

	public function vmodal_batal_bum()
	{
		$data_idbum['id_bum']			= $this->uri->segment(3);
		// $id			= $this->input->get('option');
		// $data_idbum['id_bum']	= str_replace("_","-",$id);

		$this->load->view('jurnal/vmodal_batal_bum', $data_idbum);
	}
	public function proses_vmodal_batal_bum()
	{

		$id_bum			= $this->input->post('id_bum');
		$alasan_batal	= $this->input->post('alasan_batal_bum');

		// $note_batal			= "Batal BUM Umum No. " . $id_bum;

		$this->db->query("UPDATE jarh set batal='1' where nomor='$id_bum'");
		// $this->db->query("UPDATE jarh set batal='1', note='$note_batal', reason_batal='$alasan_batal' where nomor='$id_bum'");

		$update_jurnal = $this->db->query("SELECT * FROM jurnal WHERE nomor='$id_bum' and (tipe='BUM' or tipe='JC' or tipe='JV')")->result();

		if ($update_jurnal > 0) {
			foreach ($update_jurnal as $row_jur_bum) {
				$bum_keterangan	= $row_jur_bum->keterangan;

				// $update_ket	= "BATAL " . $bum_keterangan;
				// $this->db->query("UPDATE jurnal set keterangan='$update_ket' where nomor='$id_bum' and (tipe='BUM' or tipe='JC')");

				$BUM_tipe			= $row_jur_bum->tipe;
				$BUM_nomor			= $row_jur_bum->nomor;
				$BUM_tanggal		= $row_jur_bum->tanggal;
				$BUM_no_perkiraan	= $row_jur_bum->no_perkiraan;
				$BUM_keterangan		= $row_jur_bum->keterangan;
				$BUM_jenis_trans	= $row_jur_bum->jenis_trans;
				$BUM_no_reff		= $row_jur_bum->no_reff;
				$BUM_debet			= $row_jur_bum->debet;
				$BUM_kredit			= $row_jur_bum->kredit;

				$update_ket	= "BATAL " . $BUM_keterangan;
				// $this->db->query("UPDATE jurnal set keterangan='$update_ket' where tipe='BUM' and nomor='$id_BUM'");
				$this->db->query("INSERT INTO jurnal (tipe,nomor,tanggal,no_perkiraan,keterangan,jenis_trans,no_reff,debet,kredit,valid,stspos) VALUES ('$BUM_tipe','$BUM_nomor','$BUM_tanggal','$BUM_no_perkiraan','$update_ket','$BUM_jenis_trans','$BUM_no_reff','$BUM_kredit','$BUM_debet','1','0')");
			}
		}

		$insert_jurnal_batal = array(
			'nomor'			=> $id_bum,
			'tipe'			=> "BUM",
			'reason'		=> $alasan_batal,
			'user'			=> $this->session->userdata('pn_name'),
			'kdcab'			=> $this->session->userdata('kode_cabang'),
			'waktu'			=> date('Y-m-d H:i:s')
		);
		$this->db->insert("jurnal_batal", $insert_jurnal_batal);

		$transaksi	= "BATAL " . $bum_keterangan . " (No.BUM/No.JV: " . $id_bum . ")";
		$in_log_transaksi		= array(
			'transaksi'		=> $transaksi,
			'nama_user'		=> $this->session->userdata('pn_name'),
			'waktu'			=> date('Y-m-d H:i:s')
		);
		$this->db->insert("log_transaksi", $in_log_transaksi);

		$ket_btl	= "BATAL " . $bum_keterangan;

		$this->db->query("UPDATE javh set keterangan='$ket_btl' where nomor='$id_bum'");

		$data['pesan_on']				= 1;

		$data['judul'] = "Bukti Uang Masuk";
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$awal = 1;
		$akhir = 31;

		if ($bln_aktif > 9) {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$data['var_tgl_awal']	= $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
			$data['var_tgl_akhir']	= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		} else {
			$var_tgl_awal			= $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$data['var_tgl_awal']	= $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir			= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
			$data['var_tgl_akhir']	= $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		}
		
		$data['tanggal_awal'] = date("01-m-Y", strtotime($var_tgl_awal));
		$data['tanggal_akhir'] = date("t-m-Y", strtotime($var_tgl_akhir));
		
		$data['list_data'] = $this->Jurnal_model->list_dana_masuk($var_tgl_awal, $var_tgl_akhir);
		$this->load->view('jurnal/v_list_dana_masuk', $data);

		// $data_jurnal_debet = $this->Jurnal_model->ambil_jurnal_bum_debet($id_bum);

		// if ($data_jurnal_debet > 0) {
		// 	foreach ($data_jurnal_debet as $r_jur) {
		// 		$nokir			= $r_jur->no_perkiraan;
		// 		$tgl			= $r_jur->tanggal;
		// 		$ket			= $r_jur->keterangan;
		// 		$jenis_trans	= $r_jur->jenis_trans;
		// 		$no_reff		= $r_jur->no_reff;
		// 		$debet			= $r_jur->debet;
		// 	}
		// }

		// $in_jurnal_cancel_debet		= array(
		// 	'tipe'			=> "BUM",
		// 	'nomor'			=> $id_bum,
		// 	'tanggal'		=> $tgl,
		// 	'no_perkiraan'	=> $nokir,
		// 	'keterangan'	=> $ket,
		// 	'jenis_trans'	=> $jenis_trans,
		// 	'no_reff'		=> $no_reff,
		// 	'debet'			=> $debet,
		// 	'kredit'		=> '0',
		// 	'waktu'			=> date('Y-m-d H:i:s'),
		// 	'batal'			=> '1'
		// );
		// $this->db->insert("jurnal_cancel", $in_jurnal_cancel_debet);

		// $data_jurnal_kredit = $this->Jurnal_model->ambil_jurnal_bum_kredit($id_bum);

		// if ($data_jurnal_kredit > 0) {
		// 	foreach ($data_jurnal_kredit as $r_jur2) {
		// 		$nokir2			= $r_jur2->no_perkiraan;
		// 		$tgl2			= $r_jur2->tanggal;
		// 		$ket2			= $r_jur2->keterangan;
		// 		$jenis_trans2	= $r_jur2->jenis_trans;
		// 		$no_reff2		= $r_jur2->no_reff;
		// 		$kredit2		= $r_jur2->kredit;
		// 	}
		// }

		// $in_jurnal_cancel_kredit		= array(
		// 	'tipe'			=> "BUM",
		// 	'nomor'			=> $id_bum,
		// 	'tanggal'		=> $tgl2,
		// 	'no_perkiraan'	=> $nokir2,
		// 	'keterangan'	=> $ket2,
		// 	'jenis_trans'	=> $jenis_trans2,
		// 	'no_reff'		=> $no_reff2,
		// 	'debet'			=> '0',
		// 	'kredit'		=> $kredit2,
		// 	'waktu'			=> date('Y-m-d H:i:s'),
		// 	'batal'			=> '1'
		// );
		// $this->db->insert("jurnal_cancel", $in_jurnal_cancel_kredit);

		// $in_log_transaksi		= array(
		// 	'transaksi'		=> $note_batal,
		// 	'nama_user'		=> $this->session->userdata('pn_name'),
		// 	'waktu'			=> date('Y-m-d H:i:s')
		// );
		// $this->db->insert("log_transaksi", $in_log_transaksi);

		// $this->db->query("UPDATE jurnal set batal='1' where nomor='$id_bum' and tipe='bum'");

		// $data['pesan_on']				= 1;

		// $data['judul'] = "Bukti Uang Masuk";
		// $data['list_data'] = $this->Jurnal_model->list_dana_masuk();
		// $this->load->view('jurnal/v_list_dana_masuk', $data);
	}

	function proses_tambah()
	{
		//$this->Jurnal_model->proses_barang_use();
		//redirect('jurnal/request_use');
	}

	public function proses_input_dana_keluar()
	{
		if ($this->input->post()) {
			$hasil	= $this->Jurnal_model->inputDanaKeluar();
			echo "<script> alert('Data berhasil di simpan!')";
			echo "</script>";
			redirect('jurnal/list_dana_keluar');
		}
	}

	public function proses_input_dana_masuk()
	{
		// print_r($this->input->post());
		// exit;
		
		if ($this->input->post()) {
			$hasil	= $this->Jurnal_model->inputDanaMasuk();
			echo "<script> alert('Data berhasil di simpan!')";
			echo "</script>";
			redirect('jurnal/list_dana_masuk');
		}
	}

	public function proses_input_dana_masuk_lain()
	{
		if ($this->input->post()) {
			$hasil	= $this->Jurnal_model->inputDanaMasukLain();
			echo "<script> alert('Data berhasil di simpan!')";
			echo "</script>";
			redirect('jurnal/list_dana_masuk_lain');
		}
	}

	function filter_tgl_bum_lain()
	{
		$data['list_data'] = $this->Jurnal_model->list_dana_masuk();

		$data['judul']		= "List Jurnal";
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$date = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$date2 = str_replace(" - ", "_", $date2);
			redirect('jurnal/view_excel/' . $date . '/' . $date2);
		} else {
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

			$data['filter_tgl']	= $this->Jurnal_model->filter_tgl_bum($tanggal, $tanggal2);
			$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan();

			$this->load->view("jurnal/v_list_bumlain_filter", $data);
		}
	}

	function payment()
	{

		$data['judul']			= "Input Pembayaran";
		$data['data_bank']		= $this->Jurnal_model->get_bank();

		$invoice_no				= $this->uri->segment(3);

		$data['data_invoice']	= $this->invoice_model->get_data($invoice_no);

		$data['data_owner']		= $this->invoice_model->get_owner();

		$data['pay_methods']	= array(0, "CASH", "CHECK", "TRANSFER", "BG");

		$data['pay_text']		= array("-Pilih Metode Pembayaran-", "CASH", "CHECK", "TRANSFER", "BG");

		$this->load->view('jurnal/v_input_pembayaran', $data);
	}

	function proses_payment()
	{

		$invoice_no 	= $this->input->post('inv');

		$nocust 		= $this->input->post('nocust');

		$metode 		= $this->input->post('metode');

		$namabank 	  	= $this->input->post('nm_bank');
		$bank		 	= substr($namabank, 11, 21);

		$no_bank 		= $this->input->post('no_bank');

		$tgl_kwitansi	= date("Y-m-d", strtotime($this->input->post('tgl_kwitansi')));

		$receipt_by		= $this->input->post('receipt_by');

		$jumlah 		= str_replace(".", "", str_replace(",", "", $this->input->post('jumlah')));

		$materai 		= str_replace(".", "", str_replace(",", "", $this->input->post('materai')));

		$dpp 			= str_replace(".", "", str_replace(",", "", $this->input->post('dpp')));

		$ppn 			= str_replace(".", "", str_replace(",", "", $this->input->post('ppn')));

		$total 			= str_replace(".", "", str_replace(",", "", $this->input->post('total')));

		$jum_bayar 		= str_replace(".", "", str_replace(",", "", $this->input->post('jum_bayar')));

		$tot_bayar		= $jum_bayar - $ppn - $materai;



		$f_kwitansi				= "K/" . date("Y/m", strtotime($tgl_kwitansi)) . "/";

		$get_last_no_kwitansi	= $this->invoice_model->get_last_no_kwitansi($f_kwitansi);

		if ($get_last_no_kwitansi) {

			$last_no_kwitansi	= str_replace($f_kwitansi, "", $get_last_no_kwitansi);

			$no_kwitansi		= $f_kwitansi . sprintf("%04s", $last_no_kwitansi + 1);
		} else {

			$no_kwitansi		= $f_kwitansi . "0001";
		}

		$this->db->query("update dk_invoice set bayar='$tot_bayar',bayar_via='$metode',bank='$bank',updateby='" . $this->session->userdata('pn_name') . "', tanggal_bayar='" . date("Y-m-d H:i:s") . "', no_kwitansi='" . $no_kwitansi . "', tgl_kwitansi='" . $tgl_kwitansi . "', receipt_by='" . $receipt_by . "' where invoice_no ='$invoice_no'");
		/*
		$this->db->query("update dk_invoice set bayar='$tot_bayar',bayar_via='$metode',bank='$bank',norek='$no_bank',updateby='".$this->session->userdata('pn_name')."', tanggal_bayar='".date("Y-m-d H:i:s")."', no_kwitansi='".$no_kwitansi."', tgl_kwitansi='".$tgl_kwitansi."', receipt_by='".$receipt_by."' where invoice_no ='$invoice_no'");
		*/
		$this->db->query("update dk_schedule set bayar='$tot_bayar',bayar_via='$metode',bank='$bank',insert_bayar_by='" . $this->session->userdata('pn_name') . "',bayar_tgl='" . $tgl_kwitansi . "' where nomor_invoice ='$invoice_no'");

		$this->db->query("update dk_master_customer set piutang=piutang-$tot_bayar where nocust ='$nocust'");

		if ($this->input->post()) {
			$hasil	= $this->Jurnal_model->inputPembayaran();
			echo "<script> alert('Data berhasil di simpan!')";
			echo "</script>";
			redirect('jurnal/list_dana_masuk');
		}

		//	redirect('jurnal/list_dana_masuk'); 

	}

	public function multi_print_buk()
	{

		$data['judul'] = "Multi Print Bukti Uang Keluar";
		$data['list_data'] = $this->Jurnal_model->list_dana_keluar();
		$data['pesan_on'] = 0;
		$this->load->view('jurnal/v_print_all_buk', $data);
	}
	public function multi_print_bum()
	{

		$data['judul'] = "Multi Print Bukti Uang Masuk";
		$data['list_data'] = $this->Jurnal_model->list_dana_masuk();
		$data['pesan_on'] = 0;
		$this->load->view('jurnal/v_print_all_bum', $data);
	}
}
