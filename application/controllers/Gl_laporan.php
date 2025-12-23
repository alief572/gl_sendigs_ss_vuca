<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gl_laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->library('session');
		//$this->session->userdata('kode_cabang');
		$this->session->userdata('pn_name');
		$this->load->model('Model_latihan');
		$this->load->model('piutang_cabang_m');
		$this->load->model('Jurnal_model');
		$this->load->helper('menu');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function master_ledger()
	{
		$data['judul'] 			= "Daftar COA";

		$kode_cabang	= $this->session->userdata('kode_cabang');

		$data_periode_aktif = $this->Model_latihan->cek_periode_aktif();

		if ($data_periode_aktif > 0) {
			foreach ($data_periode_aktif as $row_pa_coa) {
				$tgl_periode = $row_pa_coa->periode;
				$bln_periode = substr($tgl_periode, 0, 2);
				$thn_periode = substr($tgl_periode, 3, 4);
			}
		}
		$data['data_stock']		= $this->Model_latihan->stock($kode_cabang, $bln_periode, $thn_periode);
		$this->load->view('latihan/v_brg1', $data);
	}
	//====================================================== stock ==============================================
	public function update_tipe_coa()
	{
		$data_tipe	= $this->Model_latihan->get_tipe();
		if ($data_tipe > 0) {
			foreach ($data_tipe as $row_tipe) {
				$coa	= $row_tipe->COA;
				$tipe 	= $row_tipe->tipe;
				$faktor = $row_tipe->faktor;

				$this->db->query("UPDATE COA set tipe ='$tipe', faktor='$faktor' where no_perkiraan like '$coa%'");
			}
		}
		redirect('Gl_laporan/master_ledger');
	}

	public function add_stock()
	{

		$data['data_cabang'] = $this->Model_latihan->cek_kode_cabang();
		$data['data_nokir'] = $this->Model_latihan->cek_nokir();
		$this->load->view('latihan/add_view', $data);
	}
	public function cetak_nokir()
	{
		$id = $this->input->get('option'); // 1101-01-00
		$id_ = substr($id, 0, 8); // 1101-01-

		$data_nokirbr	= $this->Model_latihan->get_nokirbr($id_);
		if ($data_nokirbr > 0) {
			foreach ($data_nokirbr as $row_nokirbr) {
				$nokir_		= $row_nokirbr->no_perkiraan; //hasil 1101-01-02
				$id_1 = substr($nokir_, 0, 4); // 1101
				$id_2 = substr($nokir_, 5, 2); // 01
				$id_3 = substr($nokir_, 8, 2); // 02
				$id_34 = $id_3 + 1;
				if ($id_34 < 10) {
					$id_5 = $id_1 . "-" . $id_2 . "-" . "0" . $id_34;
				} else {
					$id_5 = $id_1 . "-" . $id_2 . "-" . $id_34;
				}
			}
		}
		echo "<label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> No.Perkiraan Baru (Level 5)</label>";

		echo "<input type='text' class='form-control' id='no_perkiraan' name='no_perkiraan' readonly value='" . $id_5 . "'>";
	}

	public function proses_add_stock()
	{
		$this->Model_latihan->proses_add_stock();
		redirect('Gl_laporan/master_ledger');
	}
	public function delete_stock_barang()
	{
		$this->db->query("delete from COA where id='" . $this->uri->segment(3) . "'");
		redirect('Gl_laporan/master_ledger');
	}

	public function proses_edit_stock()
	{
		$this->Model_latihan->proses_edit_stock();
		redirect('Gl_laporan/master_ledger');
	}
	public function edit_stock()
	{
		$id 			= $this->input->get('option');
		//$data['data_cabang']=$this->Model_latihan->cek_kode_cabang();
		$data['list_stock']		= $this->Model_latihan->list_stock($id);
		$this->load->view('latihan/v_edit', $data);
	}

	function list_coa()
	{
		$data['judul'] 			= "Daftar COA";
		$data['data_stock'] 	= $this->Model_latihan->get_list_coa();
		$this->load->view('latihan/v_brg1', $data);
	}

	function print_request()
	{

		$id 		= $this->uri->segment(3);
		$data['data_stock']	= $this->Model_latihan->print_data($id);
		$html			= $this->load->view('latihan/v_brg_print', $data, true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}

	function proses_print_bln()
	{

		$id 		= $this->uri->segment(3);
		$data['data_stock']	= $this->Model_latihan->get_list_coa();
		$html			= $this->load->view('latihan/v_brg_print_bln', $data, true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}

	function print_bulanan()
	{

		$this->load->view('latihan/add_view_bln');
	}



	//====================================================== saldo awal ==============================================
	function saldoawal()
	{
		$data['judul'] 			= "Saldo";
		$data['data_stock']		= $this->Model_latihan->saldo();
		$this->load->view('saldo/v_saldoawal', $data);
	}

	public function tambah_saldo()
	{
		$data['data_cabang'] = $this->Model_latihan->cek_kode_cabang();
		$this->load->view('saldo/v_add_saldo');
	}
	public function proses_add_saldo()
	{
		//$data['data_cabang']=$this->Model_latihan->cek_kode_cabang();
		$this->Model_latihan->proses_add_saldo();
		redirect('Gl_laporan/saldoawal');
	}
	public function hapus_saldo()
	{
		$this->db->query("delete from COA where id='" . $this->uri->segment(3) . "'");
		redirect('Gl_laporan/saldoawal');
	}
	public function edit_saldo()
	{
		$id 			= $this->input->get('option');
		$data['list_saldo']		= $this->Model_latihan->list_saldo($id);
		$this->load->view('saldo/v_edit_saldo', $data);
	}
	public function proses_edit_saldo()
	{
		$this->Model_latihan->proses_edit_saldo();
		redirect('Gl_laporan/saldoawal');
	}
	function print_saldo()
	{

		$id 		= $this->uri->segment(3);
		$data['list_saldo']	= $this->Model_latihan->print_saldo($id);
		$html			= $this->load->view('saldo/v_saldo_print', $data, true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}
	function list_saldo()
	{
		$data['judul'] 			= "Daftar Saldo";
		/*$var_bulan			= $this->input->post('bln');
		$var_tahun			= $this->input->post('thn');*/
		$data['data_stock'] 	= $this->Model_latihan->get_list_saldo();

		$this->load->view('saldo/v_saldoawal', $data);
	}
	function posting()
	{
		$data['judul'] 			= "Daftar Saldo";

		$data['data_stock'] 	= $this->Model_latihan->posting();
		$this->load->view('saldo/v_saldoawal', $data);
	}


	function posting_saldoawal()
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$data_periode_aktif = $this->Model_latihan->cek_periode_aktif();
		if ($data_periode_aktif > 0) {
			foreach ($data_periode_aktif as $row_pa) {
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode, 0, 2);
				$thn_periode = substr($tgl_periode, 3, 4);
			}
		}
		$get_coa		= $this->Model_latihan->get_coa_level5($bln_periode, $thn_periode, $kode_cabang);
		if ($get_coa > 0) {

			foreach ($get_coa as $row_sum) {
				$nokir			= $row_sum->no_perkiraan; //$nokir = "1101-01-01";
				$saldo_awal		= $row_sum->saldoawal;

				$ambil_nokir	= substr($nokir, 0, 8); //$ambil_nokir = "1101-01-";

				$sum_saldo		= $this->Model_latihan->sum_saldo_5($ambil_nokir, $bln_periode, $thn_periode, $kode_cabang);
				if ($sum_saldo > 0) {
					foreach ($sum_saldo as $row_sum) {
						$total = $row_sum->total;
					}
				}
				$this->db->query("UPDATE COA set saldoawal = '$total' where no_perkiraan LIKE '$ambil_nokir%' AND level='4' and bln='$bln_periode' and  thn='$thn_periode' and kdcab='$kode_cabang'");

				$ambil_nokir2	= substr($nokir, 0, 5); //$ambil_nokir = "1101-01-";
				$sum_saldo2		= $this->Model_latihan->sum_saldo_4($ambil_nokir2, $bln_periode, $thn_periode, $kode_cabang);
				if ($sum_saldo2 > 0) {
					foreach ($sum_saldo2 as $row_sum2) {
						$total2 = $row_sum2->total2;
					}
				}
				$this->db->query("UPDATE COA set saldoawal = '$total2' where no_perkiraan LIKE '$ambil_nokir2%' AND level='3' and bln='$bln_periode' and thn='$thn_periode' and kdcab='$kode_cabang'");
			}
		}
		redirect('Gl_laporan/saldoawal');
	}

	//====================================================== JV ==============================================
	function jv()
	{
		$data['judul'] 			= "Setup Nomor JV  ";
		$no_cabang2	= $this->session->userdata('nomor_cabang');
		$data['data_jv']		= $this->Model_latihan->jv($no_cabang2);
		$this->load->view('JV/v_jv', $data);
	}

	public function proses()
	{

		$this->Model_latihan->proses_update();
		$this->session->set_flashdata('message', '<b><h2>Data Berhasil di Input</h2></b>');
		redirect('Gl_laporan/jv');
	}


	//====================================================== Trend ACcount ==============================================

	public function grafik2()
	{
		$data['judul'] 			= "Grafik";

		$kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_accound1'] = $this->Model_latihan->trend_accound4($kode_cabang);
		$this->load->view('trendacount/v_grafik', $data);
	}
	public function grafik()
	{
		$data['judul'] 			= "Grafik";
		$nokircoa 		= $this->uri->segment(3);
		$thn 		= $this->uri->segment(4);
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_accound1'] = $this->Model_latihan->trend_accound3($kode_cabang, $nokircoa, $thn);
		$this->load->view('trendacount/v_grafik', $data);
	}

	public function Trend_Account()
	{
		$data['judul'] 			= "Trend Account";
		$kode_cabang			= $this->session->userdata('kode_cabang');
		$data['data_accound1'] = $this->Model_latihan->trend_accound($kode_cabang);
		$this->load->view('trendacount/v_t_account', $data);
	}

	function list_account()
	{
		$data['judul'] 			= "Trend Accunt";
		$kode_cabang		= $this->session->userdata('kode_cabang');
		$data['data_accound1'] 	= $this->Model_latihan->list_account($kode_cabang);

		$this->load->view('trendacount/v_t_account', $data);
	}

	public function sample_database_highcart($id)
	{ //kode g boleh di hapus, iya hapus aja, coba di lihat hasilnya
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$result = $this->Model_latihan->trend_accound2($kode_cabang, $id);
		$data = array();
		$data['judul'] = 'TREND ACCOUNT';
		$data['data_accound1'] = $result;
		foreach ($result as $key => $value) {

			$row = array();

			$row['name'] = $value->nama;
			$row['data'] = array(
				(int) $value->jan,
				(int) $value->feb,
				(int) $value->mart,
				(int) $value->apr,
				(int) $value->mei,
				(int) $value->jun,
				(int) $value->jul,
				(int) $value->agt,
				(int) $value->sept,
				(int) $value->okt,
				(int) $value->nov,
				(int) $value->des
			);

			$data[] = $row;
		}

		echo json_encode($data);
		$this->load->view('trendacount/v_t_account', $data);
	}

	public function ajax_highchart_data()
	{
		$response = array(
			array(
				'name' => 'Pemalang',
				'data' => array(7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5)
			),
			array(
				'name' => 'Tegal',
				'data' => array(3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6)
			),
			array(
				'name' => 'abk',
				'data' => array(3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6)
			),
		);
		echo json_encode($response);
	}



	public function chart()
	{
		$data['judul'] 			= "Trend Accunt";
		$data['data_accound1'] 	= $this->Model_latihan->grafik();

		$this->load->view('trendacount/v_t_account', $data);
	}

	//====================================================== Replace Coa ==============================================



	public function repleace_coa()
	{
		$data['judul'] 			= "Replace COA";
		$this->load->view('latihan/v_replace_coa', $data);
	}

	public function repleace_coa_proses()
	{
		$data['judul'] 			= "Replace COA";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
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
			$var_tgl_awal = $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir = $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		}
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$coa_lama  = $this->input->post('no_perkiraan_L');
		$coa_baru  = $this->input->post('no_perkiraan_B');
		$this->db->query("UPDATE jurnal set no_perkiraan ='$coa_baru' where no_perkiraan='$coa_lama' and tanggal between '$var_tgl_awal' and '$var_tgl_akhir' and nomor like'$kode_cabang%'");
		// and kdcab='$kode_cabang'
		//	$data['pesan']=1;
		if ($this) {
			echo "<script>alert('Data berhasil diupdate @.Terima Kasih')</script>";
			echo "<meta http-equiv='refresh'";
		}

		$this->load->view('latihan/v_replace_coa', $data);
	}
	//====================================================== update cabang ==============================================


	public function cabang()
	{
		$data['judul'] 			= "Data Cabang";
		$data['data_cabang']		= $this->Model_latihan->cabang();
		$this->load->view('latihan/v_cabang', $data);
	}


	public function delete_cabang()
	{
		$id 		= $this->uri->segment(3);
		$this->db->query("UPDATE pastibisa_tb_cabang set nocab='',subcab='',cabang='',area='',spkid='',kdcab='', nofak='',nocust='',nosales='',lastupdate='',kepala='',alamat='',namacabang='',kabagjualan='',kepalacabang='',admcabang='',gudang='' where id='$id'");
		redirect('Gl_laporan/cabang');
	}

	public function edit_cbg()
	{
		$data['judul'] 			= "Data Edit Cabang";
		$data['list_cab']		= $this->Model_latihan->list_cab();
		$this->load->view('latihan/v_edit_cab', $data);
	}
	public function proses_edit_cab()
	{
		$this->Model_latihan->proses_edit_cab();
		redirect('Gl_laporan/cabang');
	}
	//====================================================== create jv by jurnal dan javh==============================================

	public function list_jv()
	{
		$data['judul'] 			= "View JV";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_listjv']		= $this->Model_latihan->list_jv($bln_aktif, $thn_aktif);

		$this->load->view('jurnal/v_list_jv', $data);
	}
	public function add_listjv()
	{
		$this->load->view('jurnal/v_add_listjv');
	}

	public function detail_list_jv()
	{
		$data['judul'] 			= "View Detail JV";
		//$data_replace		= $this->Model_latihan->cek_perode_aktif();
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
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

		$ambil_tanggal			= $this->Model_latihan->list_jv($bln_aktif, $thn_aktif);
		if ($ambil_tanggal > 0) {
			foreach ($ambil_tanggal as $ambil) {
				$tanggal = $ambil->tgl;

				$nomor = $ambil->nomor;
			}
		}
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$data['data_d_listjv']		= $this->Model_latihan->detail_list_jv($var_tgl_awal, $var_tgl_akhir);
		$this->load->view('jurnal/v_detail_listjv', $data);
	}

	function print_all_jv()
	{

		$id 		= $this->uri->segment(3);
		//$data_replace		= $this->Model_latihan->cek_perode_aktif();
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
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

		$ambil_tanggal			= $this->Model_latihan->list_jv($bln_aktif, $thn_aktif);
		if ($ambil_tanggal > 0) {
			foreach ($ambil_tanggal as $ambil) {
				$tanggal = $ambil->tgl;

				$nomor = $ambil->nomor;
			}
		}
		$data['data_d_listjv']		= $this->Model_latihan->detail_list_jv($var_tgl_awal, $var_tgl_akhir);
		$html			= $this->load->view('latihan/v_print_jv', $data, true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}

	public function jvcost()
	{
		$data['judul'] 			= "Input JV";
		$data['data_cabang'] = $this->Model_latihan->cek_kode_cabang();
		$data['data_nokir1'] = $this->Model_latihan->cek_nokir1();
		$this->load->view('jurnal/v_add_jvcost', $data);
	}
	public function cetak_nokir1()
	{

		$id = $this->input->get('option');

		$data_namkir1	= $this->Model_latihan->cek_nokir2($id);
		if ($data_namkir1 > 0) {
			foreach ($data_namkir1 as $row_namkir1) {
				$nama1		= $row_namkir1->nama;
			}
		}
		echo "<input type='text' class='form-control input-sm' id='nama' name='nama' value='" . $nama1 . "'>";
		echo "</td>";
		//echo"$nama1";
		//exit;
	}
	public function proses_input_jvcost()
	{

		$this->Model_latihan->inputjvcost();
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
		redirect('Gl_laporan/list_jv');
	}


	function list_jvcoz()
	{
		$data['judul'] 			= "Daftar COA";
		/*$var_bulan			= $this->input->post('bln');
			$var_tahun			= $this->input->post('thn');*/
		$data['data_listjv'] 	= $this->Model_latihan->get_list_jvcoz();

		$this->load->view('jurnal/v_list_jv', $data);
	}

	//====================================================== view ledger in query n query control==============================================


	public function list_ledq()
	{
		$data['judul'] 			= "ledger in Query";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$data['data_ledq']		= $this->Model_latihan->led_inq($bln_aktif,	$thn_aktif, $kode_cabang);
		$this->load->view('latihan/ledger_inquery', $data);
	}


	public function list_ledger_control()
	{
		$data['judul'] 			= "Ledger Control";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$data['data_ledgr_cont']		= $this->Model_latihan->ledger_control($bln_aktif,	$thn_aktif, $kode_cabang);
		$this->load->view('latihan/ledger_control', $data);
	}
	function list_ledger_control_level()
	{
		$data['judul'] 			= "ledger Control";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$data['data_ledgr_cont'] 	= $this->Model_latihan->get_list_ledger_cont($bln_aktif,	$thn_aktif, $kode_cabang);
		$this->load->view('latihan/ledger_control', $data);
	}

	function detail_list_inquery()
	{
		$data['judul'] 			= "Detail ledger in Query";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$id 		= $this->uri->segment(3);
		$nokir 		= $this->uri->segment(4);
		$nokir1			= substr($nokir, 0, 5);

		$kode_cabang	= $this->session->userdata('kode_cabang');
		$data['list_lev3']	= $this->Model_latihan->ledger_lev3($id, $kode_cabang);
		$data['list_lev4']	= $this->Model_latihan->ledger_lev4($nokir1,	$bln_aktif,	$thn_aktif, $kode_cabang);
		$data['list_lev5']	= $this->Model_latihan->ledger_lev5($nokir1,	$bln_aktif,	$thn_aktif, $kode_cabang);
		$this->load->view('latihan/detail_inquery',	$data);
	}

	function detail_jurnal()
	{
		$data['judul'] 			= "Detail ledger in Query";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
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
			$var_tgl_awal = $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir = $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		}
		$id 		= $this->uri->segment(3);
		$nokir2 		= $this->uri->segment(4);
		$nokir3			= substr($nokir2, 0, 9);

		$kode_cabang	= $this->session->userdata('kode_cabang');
		$data['list_lev6']	= $this->Model_latihan->ledger_jurnal($nokir3, $var_tgl_awal, $var_tgl_akhir, $kode_cabang);
		$this->load->view('latihan/detail_inquery_jurnal',	$data);
	}


	public function excel_ledger_inquery()
	{
		$data['judul'] 			= "ledger in Query";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_ledq']		= $this->Model_latihan->excel_inquery($bln_aktif,	$thn_aktif);
		$this->load->view('latihan/v_excel_inquery', $data);
	}


	public function excel_ledger_control()
	{
		$data['judul'] 			= "ledger Control";
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_ledgr_cont']		= $this->Model_latihan->excel_control($bln_aktif,	$thn_aktif);
		$this->load->view('latihan/v_excel_lcontrol', $data);
	}

	public function no_buk_setup()
	{
		//$id=$this->input->post('id'); //ambil data dari post, kalau pakai post harus ada form submit kayak tadi
		$no_cabang2	= $this->session->userdata('nomor_cabang');
		$data['judul'] 			= "Setup Nomor BUK  ";
		$data['data_buk']			= $this->Model_latihan->jv($no_cabang2);
		$this->load->view('latihan/v_nobuk', $data); //controlernya


	}
	public function setup_buk()
	{
		$this->Model_latihan->update_nobuk();
		$this->session->set_flashdata('message', '<b><h2>Data Berhasil di Input</h2></b>');
		redirect('Gl_laporan/no_buk_setup');
	}

	public function no_bum_setup()
	{
		//$id=$this->input->post('id'); //ambil data dari post, kalau pakai post harus ada form submit kayak tadi
		$no_cabang2	= $this->session->userdata('nomor_cabang');
		$data['judul'] 			= "Setup Nomor BUM  ";
		$data['data_bum']			= $this->Model_latihan->jv($no_cabang2);
		$this->load->view('latihan/v_nobum', $data); //controlernya


	}

	public function setup_bum()
	{
		$this->Model_latihan->update_nobum();
		$this->session->set_flashdata('message', '<b><h2>Data Berhasil di Input</h2></b>');
		redirect('Gl_laporan/no_bum_setup');
	}
	//////////master cabang///////////////////////master cabang///////////////////////master cabang/////////////

	function master_cabang()
	{ //menampilkan list cabang
		$data['judul'] 				= "Master Cabang";
		$data['data_cabang']		= $this->Model_latihan->get_list_cabang();
		$this->load->view('latihan/v_list_cabang', $data);
	}

	function add_cabang()
	{ //menampilkan form add cabang
		$data['judul'] 			= "Master Cabang";
		$this->load->view('latihan/v_add_cabang', $data);
	}
	function proses_add_cabang()
	{ //simpan cabang dari add..
		$this->Model_latihan->simpan_cabang();
		redirect('Gl_laporan/master_cabang');
	}
	public function hapus_cabang($id)
	{ //proses delete
		$id = $this->uri->segment(3);
		$this->db->query("delete from pastibisa_tb_cabang where id='$id'");

		redirect('Gl_laporan/master_cabang');
	}
	public function edit_cabang()
	{ //view edit
		$id 			= $this->input->get('option');
		$data['data_cabang']		= $this->Model_latihan->get_edit_cabang($id);
		$this->load->view('latihan/v_edit_cabang', $data);
	}
	function proses_edit_caba()
	{ // proses edit
		$this->Model_latihan->simpan_cab();
		redirect('Gl_laporan/master_cabang');
	}


	///////////////////////coa master///////////////////
	function master_coa()	// edit by rin 171219
	{
		$data['judul']	= 'MASTER COA';
		//$data['data_coa']=$this->Model_latihan->get_coa_master();
		$cek_coamaster	= $this->Model_latihan->get_coa_master2();
		if ($cek_coamaster > 0) {
			$data['data_coa'] = $this->Model_latihan->get_coa_master2();
		} else {
			$data_periode_aktif = $this->Model_latihan->cek_periode_aktif();

			if ($data_periode_aktif > 0) {
				foreach ($data_periode_aktif as $row_pa_coa) {
					$tgl_periode = $row_pa_coa->periode;
					$bln_periode = substr($tgl_periode, 0, 2);
					$thn_periode = substr($tgl_periode, 3, 4);
				}
			}
			$cek_coa	= $this->Model_latihan->get_coa($bln_periode, $thn_periode);
			if ($cek_coa > 0) {
				foreach ($cek_coa as $row_coa) {
					$nokir2			= $row_coa->no_perkiraan;
					$nm_perkiraan	= $row_coa->nama;
					$tipe			= $row_coa->tipe;
					$lvl			= $row_coa->level;
					$grup			= $row_coa->grup;
					$faktor			= $row_coa->faktor;
					$kode_cabang	= $this->session->userdata('kode_cabang');
					//	copy seluruh nomor perkiraan dalam tabel coa, buat baru dengan bulan dan tahun yg dipilih
					$this->db->query("INSERT INTO coa_master (no_perkiraan,nama,kdcab,tipe,level,grup,faktor) VALUES ('$nokir2','$nm_perkiraan','$kode_cabang','$tipe','$lvl','$grup','$faktor')");
				}
			}
			$data['data_coa'] = $this->Model_latihan->get_coa_master2();
		}
		$this->load->view('latihan/v_list_master_coa', $data);
	}
	function add_coa_master()
	{
		$data['data_cabang'] = $this->Model_latihan->cek_kode_cabang();
		$data['data_nokir1'] = $this->Model_latihan->cek_nokir3();
		$this->load->view('latihan/add_master_coa', $data);
	}
	function proses_add_master_coa()
	{
		$this->Model_latihan->simpan_master();
		redirect('Gl_laporan/master_coa');
	}
	public function cetak_nokir2()
	{
		$id = $this->input->get('option'); // 1101-01-00
		$id_ = substr($id, 0, 8); // 1101-01-

		$data_nokirbr	= $this->Model_latihan->get_nokirbr2($id_);
		if ($data_nokirbr > 0) {
			foreach ($data_nokirbr as $row_nokirbr) {
				$nokir_		= $row_nokirbr->no_perkiraan; //hasil 1101-01-02
				$id_1 = substr($nokir_, 0, 4);
				$id_2 = substr($nokir_, 5, 2);
				$id_3 = substr($nokir_, 8, 2);
				$id_34 = $id_3 + 1;
				if ($id_34 < 10) {
					$id_5 = $id_1 . "-" . $id_2 . "-" . "0" . $id_34;
				} else {
					$id_5 = $id_1 . "-" . $id_2 . "-" . $id_34;
				}
			}
		}
		//echo "<label class='control-label' for='inputSuccess'><i class='fa fa-check'></i>'No.Perkiraan Baru (Level 5)'</label>";

		echo "<input type='text' class='form-control' id='no_perkiraan' name='no_perkiraan' readonly value='" . $id_5 . "'>";
	}

	public function update_tipe_coa2()
	{
		$data_tipe	= $this->Model_latihan->get_tipe2();
		if ($data_tipe > 0) {
			foreach ($data_tipe as $row_tipe) {
				$coa	= $row_tipe->COA;
				$tipe 	= $row_tipe->tipe;
				$faktor = $row_tipe->faktor;

				$this->db->query("UPDATE coa_master set tipe ='$tipe', faktor='$faktor' where no_perkiraan like '$coa%'");
			}
		}
		redirect('Gl_laporan/master_coa');
	}

	public function edit_coa($id)
	{ //view edit
		$id 			= $this->input->get('option');
		$data['data_master_coa']		= $this->Model_latihan->get_edit_coa_master($id);
		$this->load->view('latihan/v_edit_coa', $data);
	}
	function proses_edit_master_coa()
	{
		$this->load->Model_latihan->simpan_edit_coa();
		redirect('Gl_laporan/master_coa');
	}
	public function delete_coa_master($id)
	{
		$id = $this->uri->segment(3);
		$this->db->query("delete from coa_master where id='$id'");

		redirect('Gl_laporan/master_coa');
	}


	//////////////////master supplier//////////////////
	function master_supplier() //list supplier
	{
		$data['judul'] = 'MASTER SUPPLIER';
		$data['data_sup'] = $this->Model_latihan->get_master_supplier();
		$this->load->view('latihan/v_list_master_supplier', $data);
	}

	public function delete_master_supplier($id)
	{ //dellete supplier
		$id = $this->uri->segment(3);
		$this->db->query("delete from supplier where kodesupplier='$id'");

		redirect('Gl_laporan/master_supplier');
	}
	function add_supplier()
	{ //menampilkan form add cabang
		$data['judul'] 			= "Add Master Supplier";
		$this->load->view('latihan/v_add_supplier', $data);
	}
	function proses_add_master_supplier()
	{ //proses add supplier
		$this->Model_latihan->simpan_master_supplier();
		redirect('Gl_laporan/master_supplier');
	}
	function edit_supplier($kodesupplier)
	{
		//$kodesupplier 			= $this->input->get('option');
		$data['judul']		= 'Edit Supplier';
		$data['data_sup']		= $this->Model_latihan->get_edit_supplier($kodesupplier);
		$this->load->view('latihan/v_edit_supplier', $data);
	}
	function proses_edit_master_supplier()
	{
		$this->Model_latihan->simpan_edit_master_supplier();
		redirect('Gl_laporan/master_supplier');
	}

	////////////////////////////Laporan Stok////////////////////
	function stok_unit_mobil()
	{
		$data['judul'] = 'DATA STOCK CUT OFF';
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif2();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif		= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_mobil'] = $this->Model_latihan->get_master__unit_mobil($bln_aktif, $thn_aktif);
		$data['data_mobil1'] 	= $this->Model_latihan->jumlah_harga_mobil();
		$data['data_mobil2'] 	= $this->Model_latihan->jumlah_mobil();
		$this->load->view('latihan/v_stok_unit_mobil', $data);
	}
	function list_stok_unit()
	{
		$data['judul'] 			= "DATA STOCK CUT OFF";
		$data['data_mobil1'] 	= $this->Model_latihan->jumlah_harga_mobil();
		$data['data_mobil2'] 	= $this->Model_latihan->jumlah_mobil();
		$data['data_mobil'] 	= $this->Model_latihan->get_list_stock_mobil();
		// var_dump($data_mobil1);
		// exit;
		$this->load->view('latihan/v_stok_unit_mobil', $data);
	}
	function print_bln_stok()
	{

		$this->load->view('latihan/v_print_bln_stok_mobil.php');
	}


	function proses_print_bln_mobil()
	{
		$data['data_bulan_post'] 	= $this->input->post('bln');
		$data['data_tahun_post'] 	= $this->input->post('thn');

		$id 		= $this->uri->segment(3);
		$data['data_mobil']	= $this->Model_latihan->get_list_stock_mobil();
		$html			= $this->load->view('latihan/v_mobli_print_bln', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}

	function excel_stok_mobil()
	{
		// $cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif2();
		// if($cek_periode_aktif > 0){
		// foreach($cek_periode_aktif as $row_periode_aktif){
		// $tgl_periode_aktif	= $row_periode_aktif->periode;
		// 		$bln_aktif		= substr($tgl_periode_aktif,0,2);
		// 		$thn_aktif			= substr($tgl_periode_aktif,3,4);
		// 	}
		// }
		$data['data_mobil'] = $this->Model_latihan->get_master__unit_mobil_excel();
		$this->load->view('latihan/v_excel_mobil_stok', $data);
	}
	//////////////////////////////////////////////////penjualan////////////////////////
	function penjualan()
	{

		$data['judul'] = 'LAPORAN PENJUALAN UNIT';
		$data['tanggal']		= date('Y-m-01');
		$data['tanggal2']		= date('Y-m-d');
		$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif2();
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
			$var_tgl_awal = $thn_aktif . "-" . $bln_aktif . "-0" . $awal;
			$var_tgl_akhir = $thn_aktif . "-" . $bln_aktif . "-" . $akhir;
		}
		$data['data_jual'] = $this->Model_latihan->get_master_penjualan1($var_tgl_awal, $var_tgl_akhir);
		$this->load->view('latihan/v_penjualan', $data);
	}

	function edit_rangka_nama()
	{
		$id = $this->uri->segment(3);
		$data['judul']		= 'Edit Rangka dan Nama';
		$data['data_jual']		= $this->Model_latihan->get_edit_rangka_nama($id);
		$this->load->view('latihan/v_edit_rangka_nama', $data);
	}

	function proses_edit_rangka_nama()
	{
		$this->Model_latihan->simpan_edit_nama_rangka();
		echo $this->session->set_flashdata('msg', 'info');
		redirect('Gl_laporan/penjualan');
	}

	public function cancel_do($id)
	{
		$this->db->query("UPDATE do set stat_gl ='Cancel' where id='" . $this->uri->segment(3) . "'");
		redirect('Gl_laporan/penjualan');
	}

	public function filter_tgl_penjualan()
	{
		$data['judul'] = 'LAPORAN PENJUALAN UNIT';
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/view_excel_penjualan/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_penjualan/' . $tgl1 . '/' . $tgl2);
		} else {

			$tanggal = $this->input->post('tanggal');
			$tanggal2 = $this->input->post('tanggal2');

			if (empty($tanggal)) {
				$tanggal = date('Y-m-d');
			}

			if (empty($tanggal2)) {
				$tanggal2 = date('Y-m-d');
			}

			$data['tanggal_awl']		= $tanggal;
			$data['tanggal']		= $tanggal;
			$data['tanggal2']		= $tanggal2;
			$data['data_jual'] = $this->Model_latihan->get_master_penjualan($tanggal, $tanggal2);
			$this->load->view('latihan/v_penjualan', $data);
		}
	}

	public function view_excel_penjualan()
	{
		$data['judul'] = 'LAPORAN PENJUALAN UNIT';

		$id 		= $this->uri->segment(3);
		// $data['judul'] ='LAPORAN HUTANG UNIT';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;


		$data['data_jual'] = $this->Model_latihan->get_master_penjualan3($tgl1, $tgl2);
		$this->load->view("latihan/view_excel_penjualan", $data);
	}

	public function print_penjualan()
	{
		$id 		= $this->uri->segment(3);
		// $data['judul'] ='LAPORAN HUTANG UNIT';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;
		$data['data_jual']	= $this->Model_latihan->get_master_penjualan3($tgl1, $tgl2);
		$html			= $this->load->view('latihan/v_print_penjualan', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}
	////////////////////////////////////////////// piutang/////////////////////////////////////


	public function piutang()
	{
		$data['judul'] = 'LAPORAN HUTANG UNIT';
		// $data['data_hutang_u1'] 	= $this->Model_latihan->jumlah_harga_hutang();
		$data['jumlah_hutang'] 	= $this->Model_latihan->jumlah_piutang2();
		$data['data_hutang_u'] = $this->Model_latihan->get_master_hutang_u();
		$this->load->view('latihan/v_list_piutang', $data);
	}

	function edit_piutang_u()
	{
		$id = $this->uri->segment(3);
		$data['judul']		= 'Form Edit Piutang';
		$data['data_hutang_u']		= $this->Model_latihan->get_edit_piutang($id);
		$this->load->view('latihan/v_edit_piutang', $data);
	}

	function proses_edit_piutang_u()
	{
		$this->Model_latihan->proses_edit_piutang_1();
		redirect('Gl_laporan/piutang');
	}




	public function filter_tgl_piutang()
	{
		$data['judul'] = 'LAPORAN HUTANG UNIT';

		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/view_excel_piutang/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_unit/' . $tgl1 . '/' . $tgl2);
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
			$data['jumlah_hutang'] 	= $this->Model_latihan->jumlah_piutang($tanggal, $tanggal2);
			$data['data_hutang_u'] = $this->Model_latihan->get_master_hutang12($tanggal, $tanggal2);
			$this->load->view('latihan/v_list_piutang', $data);
		}
	}

	public function view_excel_piutang()
	{
		$data['judul'] = 'LAPORAN HUTANG UNIT';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['data_hutang_u'] = $this->Model_latihan->get_master_hutang123($tgl1, $tgl2);
		$this->load->view("latihan/view_excel_piutang", $data);
	}

	public function print_piutang_unit()
	{
		$id 		= $this->uri->segment(3);
		$data['judul'] = 'LAPORAN HUTANG UNIT';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;
		$data['data_hutang_u']	= $this->Model_latihan->get_master_hutang123($tgl1, $tgl2);
		$html			= $this->load->view('latihan/v_print_piutang_unit', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}
	function print_piutang_id()
	{

		$id 		= $this->uri->segment(3);
		$data['data_hutang_u']	= $this->Model_latihan->print_piutang_id($id);
		$html			= $this->load->view('latihan/v_piutang_print', $data, true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}
	/////////////////////////////////////////////////////////////////piutang cabang//////////////////////////////////
	function piutang_cabang()
	{
		$data['judul'] = 'Laporan Piutang Per-Cabang';
		$data['piutang_cab'] = $this->Model_latihan->piutang_cabang();

		$this->load->view('latihan/v_piutang_cabang', $data);
	}
	function piutang_cabang_bln_thn()
	{
		$kdcab	= $this->uri->segment(3);
		$data['judul'] = 'Laporan Piutang Per-Cabang';
		$data['piutang_cab'] = $this->Model_latihan->piutang_cabang_bln();

		$this->load->view('latihan/v_piutang_cabang', $data);
	}

	function detail_cabang()
	{
		$kdcab	= $this->uri->segment(3);
		$bulan	= $this->uri->segment(5);
		$tahun	=  $this->uri->segment(6);

		//var_dump($this->uri->segment_array());
		//echo "bulan ".$bulan;
		//echo "tahun ".$tahun;

		$data['judul'] = 'Laporan Piutang Cabang (' . $kdcab . ')';
		$data['kdcab'] = $kdcab;
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['piutang_cab'] = $this->Model_latihan->piutang_cabang_detail($kdcab, $bulan, $tahun);

		$this->load->view('latihan/v_piutang_cabang_detail', $data);
	}
	function excel_cabang()
	{
		$kdcab	= $this->uri->segment(3);
		$bulan	= $this->uri->segment(4);
		$tahun	=  $this->uri->segment(5);

		$data['piutang_cab'] = $this->Model_latihan->piutang_cabang_detail($kdcab, $bulan, $tahun);
		$this->load->view('latihan/v_excel_piutang_cabang_detail', $data);
	}

	function detail_cabang_jurnal()
	{
		$rangka	= $this->uri->segment(3);
		$kdcab	= $this->uri->segment(4);

		$data['piutang_cab2'] = $this->Model_latihan->piutang_cabang_detail_jurnal($rangka, $kdcab);
		$this->load->view('latihan/v_piutang_cabang_detail', $data);
	}

	public function detail_cabang2()
	{
		$no_rangka 			= $this->input->get('option');
		//$data['data_cabang']=$this->Model_latihan->cek_kode_cabang();
		$data['cabang']		= $this->Model_latihan->piutang_cabang_detail_jurnal($no_rangka);
		var_dump($cabang);
		exit;
		$this->load->view('latihan/v_piutang_cabang_detail_modal', $data);
	}
	// ////////////////////////////////////////////////piutang service/////////////////////////////////////////////

	function piutang_service()
	{
		$data['judul'] = 'LAPORAN HUTANG SERVICE';
		$data['piutang_service'] = $this->Model_latihan->piutang_service1();
		$this->load->view('latihan/v_piutang_service', $data);
	}
	public function filter_tgl_piutang_service()
	{
		$data['judul'] = 'LAPORAN HUTANG SERVICE';
		// $data['data_jual'] = $this->Model_latihan->get_master_penjualan();


		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/view_excel_piutang_service/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_service/' . $tgl1 . '/' . $tgl2);
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
			$data['piutang_service'] = $this->Model_latihan->get_master_piutang_service($tanggal, $tanggal2);
			$this->load->view('latihan/v_piutang_service', $data);
		}
	}


	public function view_excel_piutang_service()
	{
		$data['judul'] = 'LAPORAN HUTANG SERVICE';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_service'] = $this->Model_latihan->get_master_piutang_service2($tgl1, $tgl2);
		$this->load->view("latihan/view_excel_piutang_service", $data);
	}
	public function print_piutang_service()
	{
		$id 		= $this->uri->segment(3);
		$data['judul'] = 'LAPORAN HUTANG SERVICE';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;
		$data['piutang_service']	= $this->Model_latihan->get_master_piutang_service2($tgl1, $tgl2);
		$html			= $this->load->view('latihan/v_print_piutang_service', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}


	public function edit_piutang_service()
	{
		$id = $this->uri->segment(3);
		$data['judul']		= 'Form Edit Hutang Service';
		$data['piutang_service']		= $this->Model_latihan->get_edit_piutang_service($id);
		$this->load->view('latihan/v_edit_piutang_service', $data);
	}
	public function proses_edit_piutang_service()
	{
		$this->Model_latihan->proses_edit_piutang_service();
		redirect('Gl_laporan/piutang_service');
	}
	////////////////////////////////piutang bbn///////////////////////////////////////////////////////
	public function piutang_bbn()
	{
		$data['judul'] = 'Laporan Hutang BBN';
		$data['jumlah_piutang_bbn'] 	= $this->Model_latihan->jumlah_piutang_bbn1();
		$data['piutang_bbn'] = $this->Model_latihan->piutang_bbn();
		$this->load->view('latihan/v_piutang_bbn', $data);
	}
	public function filter_tgl_piutang_bbn()
	{
		$data['judul'] = 'LAPORAN Piutang BBN';
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/view_excel_piutang_bbn/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_bbn/' . $tgl1 . '/' . $tgl2);
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
			$data['jumlah_piutang_bbn'] 	= $this->Model_latihan->jumlah_piutang_bbn2($tanggal, $tanggal2);
			$data['piutang_bbn'] = $this->Model_latihan->get_master_piutang_bbn1($tanggal, $tanggal2);
			$this->load->view('latihan/v_piutang_bbn', $data);
		}
	}


	public function view_excel_piutang_bbn()
	{
		$data['judul'] = 'LAPORAN PIUTANG BBN';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_bbn'] = $this->Model_latihan->get_master_piutang_bbn2($tgl1, $tgl2);
		$this->load->view("latihan/v_excel_piutang_bbn", $data);
	}

	public function print_piutang_bbn()
	{
		$id 		= $this->uri->segment(3);
		$data['judul'] = 'LAPORAN PIUTANG BBN';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;
		$data['piutang_bbn']	= $this->Model_latihan->get_master_piutang_bbn2($tgl1, $tgl2);
		$html			= $this->load->view('latihan/v_print_piutang_bbn', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}
	///////////////////////////////////////BBN LUNAS///////////////////////////////
	public function piutang_bbn_lunas()
	{
		$data['judul'] = 'Laporan Hutang BBN LUNAS';
		$data['piutang_bbn_lns'] = $this->Model_latihan->piutang_bbn_lunas();
		$this->load->view('latihan/v_piutang_bbn_lunas', $data);
	}
	public function filter_tgl_piutang_bbn_lunas()
	{
		$data['judul'] = 'Laporan Piutang BBN LUNAS';
		// $data['data_jual'] = $this->Model_latihan->get_master_penjualan();


		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/view_excel_piutang_bbn_lunas/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_bbn_lunas/' . $tgl1 . '/' . $tgl2);
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
			$data['piutang_bbn_lns'] = $this->Model_latihan->get_master_piutang_bbn_lunas($tanggal, $tanggal2);
			$this->load->view('latihan/v_piutang_bbn_lunas', $data);
		}
	}

	public function view_excel_piutang_bbn_lunas()
	{
		$data['judul'] = 'Laporan Piutang BBN LUNAS';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_bbn_lns'] = $this->Model_latihan->get_master_piutang_bbn_lunas_excel($tgl1, $tgl2);
		$this->load->view("latihan/v_excel_piutang_bbn_lunas", $data);
	}

	public function print_piutang_bbn_lunas()
	{
		$id 		= $this->uri->segment(3);
		$data['judul'] = 'LAPORAN PIUTANG BBN';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;
		$data['piutang_bbn_lns']	= $this->Model_latihan->get_master_piutang_bbn_lunas_excel($tgl1, $tgl2);
		$html			= $this->load->view('latihan/v_print_piutang_bbn_lunas', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}

	/////////////////////////////////////Hutang Optional/////////////////////////////////
	public function piutang_optional()
	{
		$data['judul'] = 'LAPORAN HUTANG OPTIONAL';
		$data['jumlah_piutang_optional'] 	= $this->Model_latihan->jumlah_piutang_optional1();
		$data['piutang_optional'] = $this->Model_latihan->piutang_optional();
		$this->load->view('latihan/v_hutang_optional', $data);
	}
	public function filter_tgl_piutang_optional()
	{
		$data['judul'] = 'LAPORAN PIUTANG OPTIONAL';
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/view_excel_piutang_optional/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_optional/' . $tgl1 . '/' . $tgl2);
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
			$data['jumlah_piutang_optional'] 	= $this->Model_latihan->jumlah_piutang_optional2($tanggal, $tanggal2);
			$data['piutang_optional'] = $this->Model_latihan->get_master_piutang_optional1($tanggal, $tanggal2);
			$this->load->view('latihan/v_hutang_optional', $data);
		}
	}
	public function print_piutang_optional()
	{
		$data['judul'] = 'LAPORAN PIUTANG OPTIONAL';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_optional'] = $this->Model_latihan->get_master_piutang_optional2($tgl1, $tgl2);
		// $this->load->view("latihan/v_print_piutang_parts",$data);	

		$html			= $this->load->view('latihan/v_print_piutang_optional', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}


	public function view_excel_piutang_optional()
	{
		$data['judul'] = 'LAPORAN PIUTANG OPTIONAL';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_optional'] = $this->Model_latihan->get_master_piutang_optional2($tgl1, $tgl2);
		$this->load->view("latihan/v_excel_piutang_optional", $data);
	}
	///////////////////////////////////////optional lunas//////////////////////////////
	public function piutang_optional_lunas()
	{
		$data['judul'] = 'LAPORAN PIUTANG OPTIONAL LUNAS';
		// $data['jumlah_piutang_optional'] 	= $this->Model_latihan->jumlah_piutang_optional1();
		$data['piutang_optional_lunas'] = $this->Model_latihan->piutang_optional_lunas();
		$this->load->view('latihan/v_hutang_optional_lunas', $data);
	}
	public function filter_tgl_piutang_optional_lunas()
	{
		$data['judul'] = 'LAPORAN PIUTANG OPTIONAL LUNAS';
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/view_excel_piutang_optional_lunas/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_optional_lunas/' . $tgl1 . '/' . $tgl2);
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
			// $data['jumlah_piutang_bbn'] 	= $this->Model_latihan->jumlah_piutang_bbn2($tanggal,$tanggal2);
			$data['piutang_optional_lunas'] = $this->Model_latihan->get_master_piutang_optional_lunas1($tanggal, $tanggal2);
			$this->load->view('latihan/v_hutang_optional_lunas', $data);
		}
	}
	public function view_excel_piutang_optional_lunas()
	{
		$data['judul'] = 'LAPORAN PIUTANG OPTIONAL LUNAS';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_optional_lunas'] = $this->Model_latihan->get_master_piutang_optional_lunas2($tgl1, $tgl2);
		$this->load->view("latihan/v_excel_piutang_optional_lunas", $data);
	}

	public function print_piutang_optional_lunas()
	{
		$data['judul'] = 'LAPORAN PIUTANG OPTIONAL LUNAS';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_optional_lunas'] = $this->Model_latihan->get_master_piutang_optional_lunas2($tgl1, $tgl2);
		// $this->load->view("latihan/v_print_piutang_parts",$data);	

		$html			= $this->load->view('latihan/v_print_piutang_optional_lunas', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}
	//////////////////////////////////////piutang parts//////////////////////////////////////
	public function piutang_parts()
	{
		$data['judul'] = 'LAPORAN HUTANG PARTS';
		$data['jumlah_piutang_part'] 	= $this->Model_latihan->jumlah_piutang_part1();
		$data['piutang_part'] = $this->Model_latihan->piutang_part();
		$this->load->view('latihan/v_hutang_parts', $data);
	}
	public function filter_tgl_piutang_part()
	{
		$data['judul'] = 'LAPORAN HUTANG PARTS';
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/excel_piutang_parts/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_parts/' . $tgl1 . '/' . $tgl2);
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
			$data['jumlah_piutang_part'] 	= $this->Model_latihan->jumlah_piutang_part2($tanggal, $tanggal2);
			$data['piutang_part'] = $this->Model_latihan->get_master_piutang_parts1($tanggal, $tanggal2);
			$this->load->view('latihan/v_hutang_parts', $data);
		}
	}

	public function excel_piutang_parts()
	{
		$data['judul'] = 'LAPORAN HUTANG PARTS';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_part'] = $this->Model_latihan->get_master_piutang_parts2($tgl1, $tgl2);
		$this->load->view("latihan/v_excel_piutang_parts", $data);
	}

	function print_piutang_parts()
	{
		$data['judul'] = 'LAPORAN HUTANG PARTS';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_part'] = $this->Model_latihan->get_master_piutang_parts3($tgl1, $tgl2);
		// $this->load->view("latihan/v_print_piutang_parts",$data);	

		$html			= $this->load->view('latihan/v_print_piutang_parts', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}

	public function piutang_submat()
	{

		$data['judul'] = 'LAPORAN HUTANG Sub-MATERIAL';
		$data['jumlah_piutang_submat'] 	= $this->Model_latihan->jumlah_piutang_submat1();
		$data['piutang_submat'] = $this->Model_latihan->piutang_submat();
		$this->load->view('latihan/v_hutang_submat', $data);
	}

	public function filter_tgl_piutang_submat()
	{
		$data['judul'] = 'LAPORAN HUTANG Sub-MATERIAL';
		if ($this->input->post('view') == "View List Excel") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/excel_piutang_submat/' . $tgl1 . '/' . $tgl2);
		} elseif ($this->input->post('view') == "Print Data") {
			$date = $this->input->post('tanggal');
			$tgl1 = str_replace(" - ", "_", $date);
			$date2 = $this->input->post('tanggal2');
			$tgl2 = str_replace(" - ", "_", $date2);
			redirect('Gl_laporan/print_piutang_submat/' . $tgl1 . '/' . $tgl2);
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
			$data['jumlah_piutang_submat'] 	= $this->Model_latihan->jumlah_piutang_submat2($tanggal, $tanggal2);
			$data['piutang_submat'] = $this->Model_latihan->get_master_piutang_submat1($tanggal, $tanggal2);
			$this->load->view('latihan/v_hutang_submat', $data);
		}
	}

	public function excel_piutang_submat()
	{
		$data['judul'] = 'LAPORAN HUTANG Sub-MATERIAL';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_submat'] = $this->Model_latihan->get_master_piutang_submat2($tgl1, $tgl2);
		$this->load->view("latihan/v_excel_piutang_submat", $data);
	}
	public function print_piutang_submat()
	{
		$data['judul'] = 'LAPORAN HUTANG Sub-MATERIAL';

		$tanggal = $this->uri->segment(3);
		$tgl1 = str_replace("_", " - ", $tanggal);
		if (empty($tanggal)) {
			$tanggal = date('Y-m-d');
		}

		$tanggal2 = $this->uri->segment(4);
		$tgl2 = str_replace("_", " - ", $tanggal2);
		if (empty($tanggal2)) {
			$tanggal2 = date('Y-m-d');
		}

		$data['tanggal']			= $tgl1;
		$data['tanggal2']			= $tgl2;

		$data['piutang_submat'] = $this->Model_latihan->get_master_piutang_submat2($tgl1, $tgl2);
		// $this->load->view("latihan/v_print_piutang_parts",$data);	

		$html			= $this->load->view('latihan/v_print_piutang_submat', $data, true);
		// $html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id . ".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage(
			'P',
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
	}
}
