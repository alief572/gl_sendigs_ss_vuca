<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Latihan extends CI_Controller
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
		$this->load->model('Jurnal_model');
		$this->load->helper('menu');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function project1()
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

				$this->db->query("UPDATE coa_master set tipe ='$tipe', faktor='$faktor' where no_perkiraan like '$coa%'");
			}
		}
		redirect('Latihan/project1');
	}

	public function add_stock()
	{
		$data_periode_aktif = $this->Model_latihan->cek_periode_aktif();

		if ($data_periode_aktif > 0) {
			foreach ($data_periode_aktif as $row_pa_coa) {
				$tgl_periode = $row_pa_coa->periode;
				$bln_periode = substr($tgl_periode, 0, 2);
				$data['bln_periode'] = substr($tgl_periode, 0, 2);
				$thn_periode = substr($tgl_periode, 3, 4);
				$data['thn_periode'] = substr($tgl_periode, 3, 4);
			}
		}
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
				$id_1 = substr($nokir_, 0, 4);
				$id_2 = substr($nokir_, 5, 2);
				$id_3 = substr($nokir_, 8, 2);
				$id_34 = $id_3 + 1;
				if ($id_34 < 10) {
					$id_12 = $id_1 . "-" . $id_2 . "-";
					// $id_5 = $id_1 . "-" . $id_2 . "-" . "0" . $id_34;
					$id_3_ = "0" . $id_34;
				} else {
					$id_12 = $id_1 . "-" . $id_2 . "-";
					// $id_5 = $id_1 . "-" . $id_2 . "-" . $id_34;
					$id_3_ = $id_34;
				}
			}
		}
		$nokir_gabung = $id_12 . $id_3_;
		echo "<table border='0'>";
		echo "<tr>";
		echo "<td colspan='2'>";
		echo "<label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> No.Perkiraan Baru (Level 5)</label><br>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td align='right'>";
		echo $id_12;
		echo "</td>";
		echo "<td>";
		echo "<input type='text' style='width:50px;' class='form-control' maxlength='2' id='no_perkiraan' name='no_perkiraan' value='" . $id_3_ . "'>";
		echo "<input type='hidden' style='width:50px;' class='form-control' maxlength='2' id='no_perkiraan_depan' name='no_perkiraan_depan' value='" . $id_12 . "'>";
		echo "<input type='hidden' style='width:50px;' class='form-control' maxlength='2' id='no_perkiraan_gabung' name='no_perkiraan_gabung' value='" . $nokir_gabung . "'>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
	}

	public function proses_add_stock()
	{
		$no_perkiraan	= $this->input->post('no_perkiraan_depan') . $this->input->post('no_perkiraan');
		$kdcab		    = $this->input->post('kdcab');
		$bln	        = $this->input->post('bln');
		$thn		    = $this->input->post('thn');

		$cek_coa = $this->Model_latihan->cek_ketersediaan_coa($no_perkiraan, $kdcab, $bln, $thn);
		$cek_coa2 = $this->Model_latihan->cek_ketersediaan_coa2($no_perkiraan, $kdcab, $bln, $thn);

		if ($cek_coa) {
			if ($cek_coa2) {
				echo "<script>alert('No. Coa sudah ada!');history.go(-1);</script>";
				// echo '<div id="tampil_modal">
				// <div id="modal">
				//   <div id="modal_atas">Informasi</div>
				//   <p>No. Coa sudah ada !</p>
				//   <a href="' . base_url() . 'index.php/Latihan/add_coa_master"><button id="oke">Oke</button></a>
				// </div></div>';
			} else {
				$this->Model_latihan->simpan_master();
				redirect('Gl_laporan/master_ledger');
			}
			echo "<script>alert('No. Coa sudah ada!');history.go(-1);</script>";
		} else {
			$this->Model_latihan->simpan_master();
			// redirect('Gl_laporan/master_coa');
			redirect('Gl_laporan/master_ledger');
		}

		// $this->Model_latihan->proses_add_stock();
		// redirect('Latihan/project1');
	}
	public function delete_stock_barang()
	{
		$this->db->query("delete from COA where id='" . $this->uri->segment(3) . "'");
		redirect('Latihan/project1');
	}

	public function proses_edit_stock()
	{
		$this->Model_latihan->proses_edit_stock();
		redirect('Latihan/project1');
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
		redirect('Latihan/saldoawal');
	}
	public function hapus_saldo()
	{
		$this->db->query("delete from COA where id='" . $this->uri->segment(3) . "'");
		redirect('Latihan/saldoawal');
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
		redirect('Latihan/saldoawal');
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
		redirect('latihan/saldoawal');
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
		redirect('latihan/jv');
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
		redirect('Latihan/cabang');
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
		redirect('Latihan/cabang');
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
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2); // 05
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4); // 2019
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

		$ambil_tanggal			= $this->Model_latihan->list_jv($bln_aktif, $thn_aktif);
		if ($ambil_tanggal > 0) {
			foreach ($ambil_tanggal as $ambil) {
				$tanggal = $ambil->tgl;

				$nomor = $ambil->nomor;
			}
		}
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
		redirect('latihan/list_jv');
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
		$data['judul'] 			= "Trial Balance";
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
		
			
		if ($this->input->post('tampilkan') == "View Excel") { 
			
			$level = $this->input->post('level');
			// exit;
			
		redirect('latihan/excel_ledger_control/' . $level . '');		

		} else {	
		
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
		$data['data_ledgr_cont'] 	= $this->Model_latihan->get_list_ledger_cont($bln_aktif, $thn_aktif, $kode_cabang);
		$this->load->view('latihan/ledger_control', $data);
		
		}
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
		
		$level          = $this->uri->segment(3);
	   //$data['data_ledgr_cont']		= $this->Model_latihan->excel_control($bln_aktif,	$thn_aktif);
	    $data['data_ledgr_cont']		= $this->Model_latihan->excel_control_level($bln_aktif,	$thn_aktif, $level);
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
		redirect('latihan/no_buk_setup');
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
		redirect('latihan/no_bum_setup');
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
		redirect('Latihan/master_cabang');
	}
	public function hapus_cabang($id)
	{ //proses delete
		$id = $this->uri->segment(3);
		$this->db->query("delete from pastibisa_tb_cabang where id='$id'");

		redirect('Latihan/master_cabang');
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
		redirect('Latihan/master_cabang');
	}


	///////////////////////coa master///////////////////
	function master_coa()
	{
		$data['judul'] = 'MASTER COA';
		$data['data_coa'] = $this->Model_latihan->get_coa_master();
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
		$no_perkiraan	= $this->input->post('no_perkiraan_depan') . $this->input->post('no_perkiraan');
		$kdcab		    = $this->input->post('kdcab');
		$bln	        = $this->input->post('bln');
		$thn		    = $this->input->post('thn');

		$cek_coa = $this->Model_latihan->cek_ketersediaan_coa($no_perkiraan, $kdcab, $bln, $thn);
		$cek_coa2 = $this->Model_latihan->cek_ketersediaan_coa2($no_perkiraan, $kdcab, $bln, $thn);

		if ($cek_coa) {
			if ($cek_coa2) {
				echo "<script>alert('No. Coa sudah ada!');history.go(-1);</script>";
				// echo '<div id="tampil_modal">
				// <div id="modal">
				//   <div id="modal_atas">Informasi</div>
				//   <p>No. Coa sudah ada !</p>
				//   <a href="' . base_url() . 'index.php/Latihan/add_coa_master"><button id="oke">Oke</button></a>
				// </div></div>';
			} else {
				$this->Model_latihan->simpan_master();
				redirect('Gl_laporan/master_coa');
			}
			echo "<script>alert('No. Coa sudah ada!');history.go(-1);</script>";
		} else {
			$this->Model_latihan->simpan_master();
			redirect('Gl_laporan/master_coa');
		}

		// $this->Model_latihan->simpan_master();
		// redirect('Gl_laporan/master_coa');
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
		redirect('Latihan/master_coa');
	}

	public function edit_coa()
	{ //view edit
		$id 			= $this->input->get('option');
		$data['data_master_coa']		= $this->Model_latihan->get_edit_coa_master($id);
		$this->load->view('latihan/v_edit_coa', $data);
	}
	function proses_edit_master_coa()
	{
		$this->load->Model_latihan->simpan_edit_coa();
		redirect('Latihan/master_coa');
	}
	public function delete_coa_master()
	{
		$id = $this->uri->segment(3);
		$this->db->query("delete from coa_master where id='$id'");

		redirect('Latihan/master_coa');
	}
}
