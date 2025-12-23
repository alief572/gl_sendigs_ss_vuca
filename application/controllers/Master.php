<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller
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

		$this->load->model('Jurnal_model');
	}

	function master_coa()	// edit by rin 171219
	{
		$data['judul']	= 'MASTER COA';
		//$data['data_coa']=$this->Model_latihan->get_coa_master();
		$cek_coamaster	= $this->master_model->get_coa_master2();
		if ($cek_coamaster > 0) {
			$data['data_coa'] = $this->master_model->get_coa_master2();
		} else {
			$data_periode_aktif = $this->master_model->cek_periode_aktif();

			if ($data_periode_aktif > 0) {
				foreach ($data_periode_aktif as $row_pa_coa) {
					$tgl_periode = $row_pa_coa->periode;
					$bln_periode = substr($tgl_periode, 0, 2);
					$thn_periode = substr($tgl_periode, 3, 4);
				}
			}
			$cek_coa	= $this->master_model->get_coa($bln_periode, $thn_periode);
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
			$data['data_coa'] = $this->master_model->get_coa_master2();
		}
		$this->load->view('master/v_list_master_coa', $data);
	}

	function add_coa_master()
	{
		$data['data_cabang'] = $this->master_model->cek_kode_cabang();
		$data['data_nokir1'] = $this->master_model->cek_nokir3();
		$this->load->view('master/add_master_coa', $data);
	}

	function proses_add_master_coa()
	{
		$no_perkiraan	= $this->input->post('no_perkiraan_depan') . $this->input->post('no_perkiraan');
		$kdcab		    = $this->input->post('kdcab');
		$bln	        = $this->input->post('bln');
		$thn		    = $this->input->post('thn');

		$cek_coa = $this->master_model->cek_ketersediaan_coa($no_perkiraan, $kdcab, $bln, $thn);
		$cek_coa2 = $this->master_model->cek_ketersediaan_coa2($no_perkiraan, $kdcab, $bln, $thn);

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
				$this->master_model->simpan_master();
				redirect('master/master_coa');
			}
			echo "<script>alert('No. Coa sudah ada!');history.go(-1);</script>";
		} else {
			$this->master_model->simpan_master();
			redirect('master/master_coa');
		}

		// $this->Model_latihan->simpan_master();
		// redirect('Gl_laporan/master_coa');
	}

	public function proses_edit_coa()
	{
		$no_perkiraan	= $this->input->post('no_perkiraan');
		$kdcab		    = $this->input->post('kdcab');

		$cek_duplikat_nokir = $this->db->query("SELECT * FROM coa_master WHERE no_perkiraan='$no_perkiraan' and kdcab='$kdcab'")->result();

		if ($cek_duplikat_nokir) {
			redirect('master/master_coa');
		} else {
			$this->master_model->proses_edit_coa();
			redirect('master/master_coa');
		}
	}

	public function cetak_nokir()
	{
		$id = $this->input->get('option'); // 1101-01-00
		$id_ = substr($id, 0, 8); // 1101-01-

		$data_nokirbr	= $this->master_model->get_nokirbr($id_);
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

	public function edit_coa()
	{ //view edit
		$id 			= $this->input->get('option');
		$data['data_master_coa']		= $this->master_model->get_edit_coa_master($id);
		$this->load->view('master/v_edit_coa', $data);
	}

	function master_cabang()
	{ //menampilkan list cabang
		$data['judul'] 				= "Master Cabang";
		// $data['data_cabang']		= $this->Model_latihan->get_list_cabang();
		// $this->load->view('latihan/v_list_cabang', $data);
		$data['data_cabang']		= $this->master_model->get_list_cabang();
		$this->load->view('master/v_list_cabang', $data);
	}

	function add_cabang()
	{ //menampilkan form add cabang
		$data['judul'] 			= "Master Cabang";
		$this->load->view('master/v_add_cabang', $data);
	}

	function proses_add_cabang()
	{ //simpan cabang dari add..
		$this->master_model->simpan_cabang();
		redirect('master/master_cabang');
	}

	public function edit_cabang()
	{ //view edit
		$id 			= $this->input->get('option');
		$data['data_cabang']		= $this->master_model->get_edit_cabang($id);
		$this->load->view('master/v_edit_cabang', $data);
	}

	function proses_edit_cabang()
	{ // proses edit
		$this->master_model->simpan_cab();
		redirect('master/master_cabang');
	}

	public function hapus_cabang($id)
	{ //proses delete
		$id = $this->uri->segment(3);
		$this->db->query("DELETE from pastibisa_tb_cabang where id='$id'");

		redirect('master/master_cabang');
	}

	function jurnal_header()
	{
		$data['judul'] = "Master Jurnal";
		$data['list_data'] = $this->master_model->get_jurnal_header();
		$this->load->view('master/v_list_jurnal_header', $data);
	}

	public function view_master_jurnal()
	{
		$kode_master_jurnal 			= $this->input->get('option');
		// $data['kode_master_jurnal']		= $kode_master_jurnal;


		$data_header = $this->master_model->get_header($kode_master_jurnal);

		if ($data_header) {
			foreach ($data_header as $row_header) {
				$data['tipe']				= $row_header->tipe;
				$data['nama_jurnal']		= $row_header->nama_jurnal;
				$data['keterangan_header']	= $row_header->keterangan_header;
			}
		}

		$data_detail = $this->master_model->get_detail($kode_master_jurnal);
		$data['data_detail'] = $this->master_model->get_detail($kode_master_jurnal);

		if ($data_detail) {
			foreach ($data_detail as $row_detail) {
				$data['no_perkiraan']	= $row_detail->no_perkiraan;
				// $data['keterangan']		= $row_detail->keterangan;
				// $data['parameter_no']	= $row_detail->parameter_no;
			}
		}

		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		$data['data_header']		= $this->master_model->get_header($kode_master_jurnal);
		$data['data_menu']		    = $this->master_model->get_menu();
		$data['data_field']		    = $this->master_model->get_field_menu();


		$this->load->view('master/v_detail_master_jurnal', $data);
	}

	function add_jurnal_header()
	{
		$data['judul']				= "Add Jurnal";

		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		$data['data_perkiraan']	= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		$data['data_menu']		= $this->master_model->get_menu();
		$data['data_field']		= $this->master_model->get_field_menu();

		$this->load->view('master/v_add_jurnal_header', $data);
	}

	function proses_add_jurnal()
	{
		$this->master_model->simpan_jurnal();
		redirect('Master/jurnal_header');
	}

	function edit_master_jurnal()
	{
		$data['judul']				= "Edit Jurnal";

		$kode_master_jurnal			= $this->uri->segment(3);
		$data['kode_master_jurnal']	= $this->uri->segment(3);

		$data_header = $this->master_model->get_header($kode_master_jurnal);

		if ($data_header) {
			foreach ($data_header as $row_header) {
				$data['tipe']				= $row_header->tipe;
				$data['nama_jurnal']		= $row_header->nama_jurnal;
				$data['keterangan_header']	= $row_header->keterangan_header;
			}
		}

		$data_detail = $this->master_model->get_detail($kode_master_jurnal);
		$data['data_detail'] = $this->master_model->get_detail($kode_master_jurnal);

		if ($data_detail) {
			foreach ($data_detail as $row_detail) {
				$data['no_perkiraan']	= $row_detail->no_perkiraan;
				// $data['keterangan']		= $row_detail->keterangan;
				// $data['parameter_no']	= $row_detail->parameter_no;
			}
		}

		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();
		$cek_periode_aktif			= $this->Jurnal_model->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$data['bln_aktif']	= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
				$data['thn_aktif']	= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif, $thn_aktif);
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif, $thn_aktif);
		$data['data_menu']		    = $this->master_model->get_menu();
		$data['data_field']		    = $this->master_model->get_field_menu();
		//$data['data_project']		= $this->Jurnal_model->get_project();

		$this->load->view('master/v_edit_master_jurnal2', $data);
	}

	function proses_edit_jurnal()
	{
		$this->master_model->update_jurnal();
		redirect('Master/jurnal_header');
	}

	public function index()
	{
		$this->barang();
	}

	public function barang()
	{
		$data['judul'] 			= "Daftar Barang";
		$data['data_stock']		= $this->master_model->stock();
		$data['data_nonstock']	= $this->master_model->non_stock();
		$this->load->view('master/barang/stock/v_master_barang', $data);
	}

	//====================================================== stock ================================================

	public function add_stock()
	{
		$data['list_supplier']	= $this->master_model->get_supplier();
		$data['kategori_brg']	= $this->master_model->get_kategori_brg();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('master/barang/stock/v_add_barang', $data);
	}

	public function proses_add_stock()
	{
		$this->master_model->proses_add_stock();
		redirect('master');
	}

	public function edit_stock()
	{
		$id 					= $this->input->get('option');
		$data["judul"]			= "Edit Stock";
		$data['list_supplier']	= $this->master_model->get_supplier();
		$data['kategori_brg']	= $this->master_model->get_kategori_brg();
		$data['list_cabang']	= $this->menu_model->cabang();
		$data['list_stock']		= $this->master_model->list_stock($id);
		$this->load->view('master/barang/stock/v_edit_barang', $data);
	}

	public function proses_edit_stock()
	{
		$this->master_model->proses_edit_stock();
		redirect('master');
	}



	public function delete_stock_barang()
	{
		$this->db->query("delete from dk_master_barang where id='" . $this->uri->segment(3) . "'");
		redirect('master/barang');
	}

	//========================================== nonstock ============================================

	public function add_nonstock()
	{
		$data['list_supplier']	= $this->master_model->get_supplier();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('master/barang/nonstock/v_add_barang_non_stock', $data);
	}

	public function edit_nonstock()
	{
		$id 					= $this->input->get('option');
		$data["judul"]			= "Edit Stock";
		$data['list_supplier']	= $this->master_model->get_supplier();
		$data['list_cabang']	= $this->menu_model->cabang();
		$data['list_stock']		= $this->master_model->list_nonstock($id);
		$this->load->view('master/barang/nonstock/v_edit_barang_nonstock', $data);
	}

	public function proses_add_nonstock()
	{
		$this->master_model->proses_add_nonstock();
		redirect('master');
	}

	public function proses_edit_nonstock()
	{
		$this->master_model->proses_edit_nonstock();
		redirect('master');
	}

	//========================================================== kategori ======================================
	public function add_kategori_paket()
	{
		$data['list_supplier']	= $this->master_model->get_supplier();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('master/paket/v_add_kategori', $data);
	}

	public function edit_kategori_paket()
	{
		$id 					= $this->input->get('option');
		$data["judul"]			= "Edit Stock";
		$data['list_data']		= $this->master_model->get_kategori_paket2($id);
		$this->load->view('master/paket/v_edit_kategori', $data);
	}

	public function proses_add_kategori_paket()
	{
		$this->master_model->proses_add_kategori_paket();
		redirect('master/kategori_paket');
	}

	public function proses_edit_kategori_paket()
	{
		$this->master_model->proses_edit_kategori_paket();
		redirect('master/kategori_paket');
	}

	function owner()
	{
		$data["judul"]			= "Master Owner";
		$data["list_data"]		= $this->master_model->get_owner();
		$this->load->view('v_owner', $data);
	}

	function edit_owner()
	{
		$data["judul"]			= "Edit Master Owner";
		$id 						= $this->input->get('option');
		$data['detail_owner']	= $this->master_model->get_owner1($id);
		$this->load->view('v_edit_owner', $data);
	}

	function proses_edit_owner()
	{
		$data = array(
			'nama'			=>  $this->input->post('nama'),
			'alamat'		=>  $this->input->post('alamat'),
			'no_telfon'		=>  $this->input->post('telfon'),
			'email1'		=>  $this->input->post('email'),
			'kota'			=>  $this->input->post('kota'),
			'provinsi'		=>  $this->input->post('provinsi'),
			'kecamatan'		=>  $this->input->post('kecamatan'),
			'nm_bank'		=>  $this->input->post('bank'),
			'cab_bank'		=>  $this->input->post('cabang'),
			'no_bank'		=>  $this->input->post('norek'),
			'an_bank'		=>  $this->input->post('an')
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('dk_master_owner', $data);
		redirect('master/owner');
	}
	//========================================================== supplier ======================================

	public function supplier()
	{
		$data['judul'] 			= "Daftar Supplier";
		$data['data_supplier']		= $this->master_model->supplier();
		$this->load->view('master/supplier/v_list_supplier', $data);
	}

	public function detail_supplier()
	{
		$id 						= $this->input->get('option');
		$data['detail_supplier']	= $this->master_model->detail_supplier($id);
		$this->load->view('master/supplier/v_detail_supplier', $data);
	}

	public function add_supplier()
	{
		$this->load->view('master/supplier/v_add_supplier');
	}

	public function add_sup()
	{
		$this->master_model->proses_add_stock();
		redirect('master');
	}

	public function edit_supplier()
	{
		$id 						= $this->input->get('option');
		$data['detail_supplier']	= $this->master_model->detail_supplier($id);
		$this->load->view('master/supplier/v_edit_supplier', $data);
	}

	public function proses_edit_supplier()
	{
		$this->master_model->proses_edit_supplier();
		redirect('master/supplier');
	}

	public function proses_add_supplier()
	{
		$this->master_model->proses_add_supplier();
		redirect('master/supplier');
	}

	//================================================ customer =======================================

	public function customer()
	{
		$data["judul"]	= "List Customer";
		$wilayah_user	= $this->session->userdata('pn_wilayah');
		// $select = "*";
		// $table 	= "dk_master_customer";
		// $where 	= "";
		// $data['list_customer']	= $this->custom_model->get($select,$table,$where);
		$data['list_customer']	= $this->master_model->customer_per_wilayah($wilayah_user);

		$this->load->view('master/customer/v_list_customer', $data);
	}

	public function add_customer()
	{
		$data["judul"]		= "Add Customer";
		$data['no_cust']	= $this->master_model->get_id_cust();
		$data['data_salesman']	= $this->master_model->get_salesman();
		$this->load->view('master/customer/v_add_customer', $data);
	}

	public function edit_customer()
	{
		$data["judul"]		= "Add Customer";
		$nocust				= $this->uri->segment(3);
		$data['data_salesman']	= $this->master_model->get_salesman();
		$data['data_customer']	= $this->master_model->get_customer($nocust);
		$this->load->view('master/customer/v_edit_customer', $data);
	}

	public function proses_add_customer()
	{
		$this->master_model->proses_add_customer();
		redirect("master/customer");
	}

	public function proses_edit_customer()
	{
		$this->master_model->proses_edit_customer();
		redirect("master/customer");
	}

	//================================================ master paket dan kategori paket ===================================

	public function master_paket()
	{
		$data["judul"]			= "List Paket";
		$select = "*";
		$table 	= "dk_master_paket";
		$where 	= "";
		$data['list_paket']		= $this->custom_model->get($select, $table, $where);
		$this->load->view('master/paket/v_list_paket', $data);
	}

	public function add_paket()
	{
		$data['data_gedung']	= $this->master_model->list_gedung();
		$this->load->view('master/paket/v_add_paket', $data);
	}

	public function edit_paket()
	{
		$data['judul']			= "Edit Paket";
		$id						= $this->uri->segment(3);
		$id						= str_replace("_", "|", $id);
		$data['id_paket']		= str_replace("_", "|", $id);
		$data['data_paket']		= $this->master_model->get_paket($id);
		$data['data_gedung']	= $this->master_model->list_gedung();
		$this->load->view('master/paket/v_edit_paket', $data);
	}

	public function add_kategori()
	{
		$data["judul"]			= "Tambah Kategori";
		$select = "id,nm_barang";
		$table 	= "dk_master_barang";
		$where 	= "where sts = '1' order by nm_barang";
		$select1 	= "id_paket,nm_paket";
		$table1 	= "dk_master_paket";
		$where1 	= "where sts = '1'";
		$data['list_kategori']	= $this->custom_model->get($select, $table, $where);
		$data['list_paket']	= $this->custom_model->get($select1, $table1, $where1);
		$this->load->view('master/paket/v_add_kategori', $data);
	}

	function proses_add_paket()
	{
		$this->master_model->proses_add_paket();
		redirect("master/master_paket");
	}

	function proses_edit_paket()
	{
		$this->master_model->proses_edit_paket();
		redirect("master/master_paket");
	}

	function proses_add_kategori()
	{
		$this->master_model->proses_add_kategori();
		redirect("master/master_paket");
	}

	public function edit_kategori()
	{ //edit 
		$id2 		= $this->input->get('option');
		$id2a 		= $this->input->get('option2');
		$data["judul"]			= "Add Kategori";
		$select	 	= "id,nm_barang";
		$table 		= "dk_master_barang";
		$where 		= "where sts = '1' order by nm_barang";
		$select1 	= "id_paket,nm_paket";
		$table1 	= "dk_master_paket";
		$where1 	= "where sts = '1'";
		//$id1 = "1610";
		//$id2 = 1;
		if (strlen($id2) == 1) {
			$kdadd		= "0000";
		} else if (strlen($id2) == 2) {
			$kdadd		= "000";
		} else if (strlen($id2) == 3) {
			$kdadd		= "00";
		} else if (strlen($id2) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= '0';
		}
		$iaaad			= "K" . $id2a . "|" . $kdadd . $id2;
		$data['list_kategori']	= $this->custom_model->get($select, $table, $where);
		$data['list_paket']	= $this->custom_model->get($select1, $table1, $where1);
		$data['kategori_detail']	= $this->master_model->kategori_detail($iaaad);
		echo $this->db->last_query();
		echo "<br>";
		$data['data_kategori']	= $this->master_model->data_kategori($iaaad);
		echo $this->db->last_query();
		$this->load->view('master/paket/v_edit_kategori', $data);
	}

	public function detail_kategori()
	{ //info kategori
		$id2 		= $this->input->get('option');
		$id2a 		= $this->input->get('option2');
		$data["judul"]			= "Add Kategori";
		$select	 	= "id,nm_barang";
		$table 		= "dk_master_barang";
		$where 		= "where sts = '1' order by nm_barang";
		$select1 	= "id_paket,nm_paket";
		$table1 	= "dk_master_paket";
		$where1 	= "where sts = '1'";
		//$id1 = "1610";
		//$id2 = 1;
		if (strlen($id2) == 1) {
			$kdadd		= "0000";
		} else if (strlen($id2) == 2) {
			$kdadd		= "000";
		} else if (strlen($id2) == 3) {
			$kdadd		= "00";
		} else if (strlen($id2) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= '0';
		}
		$iaaad			= "K" . $id2a . "|" . $kdadd . $id2;
		$data['kategori_detail']	= $this->master_model->kategori_detail($iaaad);
		$data['data_kategori']	= $this->master_model->data_kategori($iaaad);
		$data['list_kategori']	= $this->custom_model->get($select, $table, $where);
		$data['list_paket']	= $this->custom_model->get($select1, $table1, $where1);
		$this->load->view('master/paket/v_info_kategori', $data);
	}

	public function delete_barang()
	{
		$id2 		= $this->input->get('option');
		$this->master_model->delete_barang($id2);
	}

	function proses_edit_kategori()
	{
		$this->master_model->proses_edit_kategori();
		redirect("master/master_paket");
	}

	function detail_paket()
	{
		$id1 		= $this->input->get('option');
		$id2 		= $this->input->get('option2');
		if (strlen($id2) == 1) {
			$kdadd		= "0000";
		} else if (strlen($id2) == 2) {
			$kdadd		= "000";
		} else if (strlen($id2) == 3) {
			$kdadd		= "00";
		} else if (strlen($id2) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= '0';
		}
		$iaaad			= "P" . $id1 . "|" . $kdadd . $id2;
		$data['data_paket']			= $this->master_model->get_paket($iaaad);
		$data['data_kategori']		= $this->master_model->get_kategori($iaaad);
		$id_gedung					= $this->master_model->get_id_ged($iaaad);
		$data['id_paketnya']		= $iaaad;
		$data['data_gedung']		= $this->master_model->get_data_ged($id_gedung);
		$this->load->view("master/paket/v_info_paket", $data);
	}

	//============================================== SALESMAN =================================================
	function salesman()
	{
		$data["judul"]	= "Daftar Karyawan";
		$data['data_salesman']	= $this->master_model->get_salesman();
		$this->load->view('master/salesman/v_daftar_salesman', $data);
	}

	function add_salesman()
	{
		$data["judul"]	= "Tambah Salesman";
		$data['id_salesman']	= $this->master_model->id_salesman();
		$this->load->view('master/salesman/v_add_salesman', $data);
	}

	function proses_add_sales()
	{
		$data["judul"]	= "Add Salesman";
		$data['id_salesman']	= $this->master_model->proses_add_sales();
		redirect("master/salesman");
	}

	function edit_sales()
	{
		$data["judul"]			= "Edit Salesman";
		$id						= $this->uri->segment(3);
		$data['data_salesman']	= $this->master_model->get_sales_id($id);
		$this->load->view('master/salesman/v_edit_salesman', $data);
	}

	function proses_edit_sales()
	{
		$data['id_salesman']	= $this->master_model->proses_edit_sales();
		redirect("master/salesman");
	}
	//============================================== GEDUNG ==================================================
	function master_gedung()
	{
		$data['judul']			= "Daftar Gedung";
		$data['list_gedung']	= $this->master_model->list_gedung();
		$this->load->view("master/komisi_gedung/v_list_gedung", $data);
	}

	function add_gedung()
	{
		$data['judul']		= "Tambah Gedung";
		$data['id_gedung']	= $this->master_model->kd_gedung();
		$this->load->view("master/komisi_gedung/v_add_gedung", $data);
	}

	public function proses_add_gedung()
	{
		$this->master_model->proses_add_gedung();
		redirect("master/master_gedung");
	}

	public function edit_gedung()
	{
		$data['judul']		= "Edit Gedung";
		$id					= $this->uri->segment(3);
		$id					= str_replace("_", "|", $id);
		$data['id_gedung']	= $id;
		$data['data_gedung'] = $this->master_model->get_gedung($id);
		$this->load->view("master/komisi_gedung/v_edit_gedung", $data);
	}

	public function proses_edit_gedung()
	{
		$this->master_model->proses_edit_gedung();
		redirect("master/master_gedung");
	}

	//================================================= Master Vendor ========================================
	function vendor()
	{
		$data['judul']			= "Master Vendor";
		$data['data_vendor']	= $this->master_model->get_vendor();
		$this->load->view("master/kontraktor/v_list_vendor", $data);
	}

	function tambah_vendor()
	{
		$data['judul']			= "Tambah Vendor";
		$data['jenis_vendor']	= $this->master_model->get_jenis();
		$this->load->view("master/kontraktor/v_add_vendor", $data);
	}

	function proses_add_vendor()
	{
		$this->master_model->proses_add_vendor();
		redirect("master/vendor");
	}

	function edit_vendor()
	{
		$data['judul']			= "Tambah Vendor";
		$id1 					= $this->input->get('option1');
		$id2 					= $this->input->get('option2');
		if (strlen($id2) == 1) {
			$kdadd		= "0000";
		} else if (strlen($id2) == 2) {
			$kdadd		= "000";
		} else if (strlen($id2) == 3) {
			$kdadd		= "00";
		} else if (strlen($id2) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$idaa					= $id1 . "|" . $kdadd . $id2;
		$data['idaa']				= $idaa;
		$data['jenis_vendor']	= $this->master_model->get_jenis();
		$data['data_vendor']	= $this->master_model->get_data_vendor($idaa);
		$this->load->view("master/kontraktor/v_edit_vendor2", $data);
	}

	function proses_edit_vendor()
	{
		$this->master_model->proses_edit_vendor();
		redirect("master/vendor");
	}

	function create_paket()
	{
		$data['judul']		= "Tambah Paket";
		$data['data_gedung']	= $this->master_model->list_gedung();
		$this->load->view("master/paket/v_add_paket", $data);
	}

	function search()
	{
		/* $dbHost = 'localhost';
		$dbUsername = 'root';
		$dbPassword = '';
		$dbName = 'db_master';
		$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
		//get search term */
		$searchTerm = $_GET['term'];
		//get matched data from skills table
		$query = $this->db->query("SELECT * FROM dk_master_kategori WHERE nm_keterangan LIKE '%" . $searchTerm . "%' ORDER BY id ASC");
		$query = $query->result();
		/* if($query->num_rows() > 0){ */
		foreach ($query as $row) {
			$data[] = $row->nm_keterangan;
		}
		/* } */
		echo json_encode($data);
	}

	function cari_harga()
	{
		$nama = $this->input->get('option');
		$id = $this->input->get('option2');
		$id2 = $this->input->get('option3');
		$harga = $this->master_model->get_harga_barang($nama);
		echo "<input type='text' class='form-control' readonly  value='" . number_format($harga) . "' onkeypress='return isNumber(event)'>";
		echo "<input type='hidden' class='form-control' id='harganya_$id2' value='$harga' onkeypress='return isNumber(event)' name='area_" . $id . "_harga[]'>";
		//echo $this->db->last_query();
	}

	function kategori_paket()
	{
		$data['judul']			= "Master Kategori";
		$data['list_Kategori']	= $this->master_model->get_kategori_paket();
		$this->load->view("master/paket/v_list_kategori", $data);
	}

	function tambah_master_kategori()
	{
		$data['judul']			= "Tambah Master Kategori";
		$this->load->view("master/paket/v_add_kategori", $data);
	}

	function save_paket()
	{
		$id				= $this->input->post('id_paket');
		$nm_paket		= $this->input->post('nm_paket');
		$sts			= $this->input->post('sts');
		$gedung			= $this->input->post('gedung');
		$harga			= str_replace(",", "", str_replace(".", "", $this->input->post('harga')));
		$note			= $this->input->post('note');
		$gedung2		= explode("+^", $gedung);
		if ($gedung == "") {
			$gedung2_nm	= "";
			$gedung2_id = "";
		} else {
			$gedung2_nm	= $gedung2[1];
			$gedung2_id = $gedung2[0];
		}
		$data		= array(
			'id_paket'		=> $id,
			'nm_paket'		=> $nm_paket,
			'note'			=> $note,
			'sts'			=> $sts,
			'harga'			=> $harga,
			'id_gedung'		=> $gedung2_id,
			'nm_gedung'		=> $gedung2_nm
		);
		$this->db->insert('dk_master_paket', $data);
		$id_ex = explode("|", $id);
		$id_ex = $id_ex[1] + 0;
		$this->db->query("update dk_counter set c_paket ='$id_ex'");

		$jum 			= $this->input->post('jum_area');
		for ($i = 1; $i <= $jum; $i++) {
			$nm_ket		= $this->input->post('area_' . $i . '_ket');
			$sfc		= $this->input->post('area_' . $i . '_sfc');
			$harga		= $this->input->post('area_' . $i . '_harga');
			$nama		= $this->input->post('area_' . $i . '_nama');
			for ($j = 0; $j < 7; $j++) {
				if (empty($nm_ket[$j])) {
					$nm_ket[$j] = "";
				}
				if (empty($sfc[$j])) {
					$sfc[$j] = "";
				}
				if (empty($harga[$j])) {
					$harga[$j] = "";
				}
				$data_d	= array(
					'id_area'			=> $i,
					'nm_area'			=> $nama[0],
					'nm_keterangan'		=> $nm_ket[$j],
					'nm_sfesifikasi'	=> $sfc[$j],
					'jumlah'			=> $harga[$j],
					'no'				=> $j + 1,
					'id_paket'			=> $this->input->post('id_paket')
				);
				$this->db->insert("dk_kategori_detail", $data_d);
			}
		}
		redirect('master/master_paket');
	}

	function save_paket_edit()
	{
		$id				= $this->input->post('id_paket');
		$nm_paket		= $this->input->post('nm_paket');
		$sts			= $this->input->post('sts');
		$gedung			= $this->input->post('gedung');
		$harga			= str_replace(",", "", str_replace(".", "", $this->input->post('harga')));
		$note			= $this->input->post('note');
		$gedung2		= explode("+^", $gedung);
		if ($gedung == "") {
			$gedung2_nm	= "";
			$gedung2_id = "";
		} else {
			$gedung2_nm	= $gedung2[1];
			$gedung2_id = $gedung2[0];
		}
		$data		= array(
			'id_paket'		=> $id,
			'nm_paket'		=> $nm_paket,
			'note'			=> $note,
			'sts'			=> $sts,
			'harga'			=> $harga,
			'id_gedung'		=> $gedung2_id,
			'nm_gedung'		=> $gedung2_nm
		);
		$this->db->where('id_paket', $id);
		$this->db->update('dk_master_paket', $data);

		$this->db->query("delete from dk_kategori_detail where id_paket='$id'");
		$jum 			= $this->input->post('jum_area');
		for ($i = 1; $i <= $jum; $i++) {
			$nm_ket		= $this->input->post('area_' . $i . '_ket');
			$sfc		= $this->input->post('area_' . $i . '_sfc');
			$harga		= $this->input->post('area_' . $i . '_harga');
			$nama		= $this->input->post('area_' . $i . '_nama');
			for ($j = 0; $j < 7; $j++) {
				if (empty($nm_ket[$j])) {
					$nm_ket[$j] = "";
				}
				if (empty($sfc[$j])) {
					$sfc[$j] = "";
				}
				if (empty($harga[$j])) {
					$harga[$j] = "";
				}
				$data_d	= array(
					'id_area'			=> $i,
					'nm_area'			=> $nama[0],
					'nm_keterangan'		=> $nm_ket[$j],
					'nm_sfesifikasi'	=> $sfc[$j],
					'jumlah'			=> $harga[$j],
					'no'				=> $j + 1,
					'id_paket'			=> $this->input->post('id_paket')
				);
				$this->db->insert("dk_kategori_detail", $data_d);
			}
		}
		redirect('master/master_paket');
	}

	function discount()
	{
		$data['judul']		= "Master Discount";
		$data['list_jabatan']	= $this->master_model->get_jabatan();
		$this->load->view("master/discount/v_list_discount", $data);
	}

	function edit_discount()
	{
		$data['judul']			= "Edit Discount";
		$id					= $this->uri->segment(3);
		$data['list_jabatan']	= $this->master_model->get_jabatan_id($id);
		$this->load->view("master/discount/v_edit_discount", $data);
	}

	function save_discount()
	{
		$id 		= $this->input->post('id');
		$discount 	= $this->input->post('discount');
		$this->db->query("update dk_jabatan set discount='$discount' where id='$id'");
		redirect('master/discount');
	}

	function area()
	{
		$data['judul']			= "Master Area";
		$data['list_Kategori']	= $this->master_model->get_kategori_area();
		$this->load->view("master/paket/v_list_area", $data);
	}

	public function add_area()
	{
		$this->load->view('master/paket/v_add_area', $data);
	}

	public function edit_area()
	{
		$data['id'] = $this->input->get('option');
		$id = $this->input->get('option');
		$data['area_data'] = $this->master_model->get_date_area($id);
		$this->load->view('master/paket/v_edit_area', $data);
	}

	public function proses_add_area()
	{
		$this->master_model->proses_add_area();
		redirect('master/area');
	}

	public function hapus_area()
	{
		$id = $this->uri->segment(3);
		$this->db->query("update dk_area set `use`='1' where id='$id'");
		$this->db->query("update dk_kategori_detail set `nm_keterangan`='', `jumlah`='',`nm_sfesifikasi`='' where id_area='$id'");
		redirect('master/area');
	}

	public function proses_edit_area()
	{
		$nama = $this->input->post('nm_area');
		$id = $this->input->post('id');
		$this->db->query("update dk_area set nm_area='$nama' where id='$id'");
		redirect('master/area');
	}

	//================================================= Master Event ========================================

	public function list_event()
	{
		$data['judul']		= "Master Event";
		$data['list_event']	= $this->master_model->get_list_event();

		$this->load->view('master/event/v_list_event', $data);
	}

	public function add_event()
	{
		$this->load->view('master/event/v_add_event');
	}

	public function edit_event()
	{
		$id_event	= $this->input->get("id_event");
		$query		= $this->db->query("SELECT * FROM dk_event WHERE id_event='$id_event'");
		if ($query->num_rows() > 0) {
			$data	= $query->row();
		} else {
			$data	= 0;
		}

		$this->load->view('master/event/v_edit_event', $data);
	}

	public function proses_add_event()
	{
		$data	= array(
			'nm_event'	=> $this->input->post('nm_event'),
			'lokasi'	=> $this->input->post('lokasi'),
			'date_event' => $this->input->post('date_event')
		);

		$this->db->insert('dk_event', $data);
		redirect('master/list_event');
	}

	public function proses_edit_event()
	{
		$id_event	= $this->input->post('id_event');
		$nm_event	= $this->input->post('nm_event');
		$lokasi		= $this->input->post('lokasi');
		$date_event	= $this->input->post('date_event');
		$this->db->query("UPDATE dk_event SET nm_event='$nm_event', lokasi='$lokasi', date_event='$date_event' WHERE id_event='$id_event'");
		redirect('master/list_event');
	}

	//================================================= Master Alasan Cancel ========================================

	public function reason_cancel()
	{
		$data["judul"]	= "Alasan Cancel";
		$query	= $this->db->query("SELECT * FROM dk_reason_cancel");
		if ($query->num_rows() > 0) {
			$data["list_reason"]	= $query->result();
		} else {
			$data["list_reason"]	= 0;
		}

		$this->load->view("master/reason_cancel/v_list_reason", $data);
	}

	public function add_reason_cancel()
	{
		if (empty($this->input->post())) {
			$this->load->view('master/reason_cancel/v_add_reason');
		} else {
			$data	= array(
				'alasan'	=> $this->input->post('alasan'),
				'sts'		=> 1
			);
			$this->db->insert('dk_reason_cancel', $data);
			redirect('master/reason_cancel');
		}
	}

	public function edit_reason_cancel()
	{
		if (empty($this->input->post())) {
			$id			= $this->input->get("id");
			$query		= $this->db->query("SELECT * FROM dk_reason_cancel WHERE id='$id'");
			if ($query->num_rows() > 0) {
				$data	= $query->row();
			} else {
				$data	= 0;
			}
			$this->load->view('master/reason_cancel/v_edit_reason', $data);
		} else {
			$id		= $this->input->post('id');
			$alasan	= $this->input->post('alasan');
			$sts	= $this->input->post('sts');
			$this->db->query("UPDATE dk_reason_cancel SET alasan='$alasan', sts='$sts' WHERE id='$id'");
			redirect('master/reason_cancel');
		}
	}

	//================================================= Master Alasan Lost Order ========================================

	public function reason_lost_order()
	{
		$data["judul"]	= "Alasan Lost Order";
		$query	= $this->db->query("SELECT * FROM dk_reason_lost_order");
		if ($query->num_rows() > 0) {
			$data["list_datas"]	= $query->result();
		} else {
			$data["list_datas"]	= 0;
		}

		$this->load->view("master/reason_lost_order/v_list_reason", $data);
	}

	public function add_reason_lost_order()
	{
		if (empty($this->input->post())) {
			$this->load->view('master/reason_lost_order/v_add_edit_reason');
		} else {
			$data	= array(
				'alasan'	=> $this->input->post('alasan'),
				'sts'		=> 1
			);
			$this->db->insert('dk_reason_lost_order', $data);
			redirect('master/reason_lost_order');
		}
	}

	public function edit_reason_lost_order()
	{
		if (empty($this->input->post())) {
			$id			= $this->input->get("id");
			$query		= $this->db->query("SELECT * FROM dk_reason_lost_order WHERE id='$id'");
			if ($query->num_rows() > 0) {
				$data	= $query->row();
			} else {
				$data	= 0;
			}
			$this->load->view('master/reason_lost_order/v_add_edit_reason', $data);
		} else {
			$id		= $this->input->post('id');
			$alasan	= $this->input->post('alasan');
			$sts	= $this->input->post('sts');
			$this->db->query("UPDATE dk_reason_lost_order SET alasan='$alasan', sts='$sts' WHERE id='$id'");
			redirect('master/reason_lost_order');
		}
	}

	//================================================= Master Competitor ========================================

	public function competitor()
	{
		$data["judul"]	= "Competitor";
		$query	= $this->db->query("SELECT * FROM dk_competitor");
		if ($query->num_rows() > 0) {
			$data["list_datas"]	= $query->result();
		} else {
			$data["list_datas"]	= 0;
		}

		$this->load->view("master/competitor/v_list_competitor", $data);
	}

	public function add_competitor()
	{
		if (empty($this->input->post())) {
			$this->load->view('master/competitor/v_add_edit_competitor');
		} else {
			$data	= array(
				'nm_competitor'	=> $this->input->post('nm_competitor'),
				'alamat'		=> $this->input->post('alamat'),
				'keunggulan'	=> $this->input->post('keunggulan'),
				'sts'			=> '1'
			);
			$this->db->insert('dk_competitor', $data);
			redirect('master/competitor');
		}
	}

	public function edit_competitor()
	{
		if (empty($this->input->post())) {
			$id			= $this->input->get("id");
			$query		= $this->db->query("SELECT * FROM dk_competitor WHERE id='$id'");
			if ($query->num_rows() > 0) {
				$data	= $query->row();
			} else {
				$data	= 0;
			}
			$this->load->view('master/competitor/v_add_edit_competitor', $data);
		} else {
			$id				= $this->input->post('id');
			$nm_competitor	= $this->input->post('nm_competitor');
			$keunggulan		= $this->input->post('keunggulan');
			$alamat			= $this->input->post('alamat');
			$sts			= $this->input->post('sts');
			$this->db->query("UPDATE dk_competitor SET nm_competitor='$nm_competitor', keunggulan='$keunggulan', alamat='$alamat', sts='$sts' WHERE id='$id'");
			redirect('master/competitor');
		}
	}

	public function kategori_barang()
	{
		$data["judul"]	= "Kategori Barang";
		$query	= $this->db->query("SELECT * FROM dk_master_kategori_barang");
		if ($query->num_rows() > 0) {
			$data["list_kat_brg"]	= $query->result();
		} else {
			$data["list_kat_brg"]	= 0;
		}

		$this->load->view("master/barang/v_list_kategori_barang", $data);
	}

	public function add_kategori_barang()
	{

		if (empty($this->input->post())) {
			$data["judul"]	= "Tambah Kategori Barang";
			$this->load->view('master/barang/v_add_edit_kategori_barang', $data);
		} else {
			$data	= array(
				'kategori'	=> $this->input->post('nm_kategori_barang')

			);
			$this->db->insert('dk_master_kategori_barang', $data);
			redirect('master/kategori_barang');
		}
	}

	public function edit_kategori_barang()
	{

		if (empty($this->input->post())) {
			$id			= $this->input->get("id");

			$query		= $this->db->query("SELECT * FROM dk_master_kategori_barang WHERE id='$id'");
			if ($query->num_rows() > 0) {
				$data["list_kat_brg"]	= $query->result();
				//$data	= $query->row();
			} else {
				$data["list_kat_brg"]	= 0;
				//$data	= 0;
			}

			$this->load->view('master/barang/v_add_edit_kategori_barang', $data);
		} else {
			$id				= $this->input->post('id');

			$nm_kategori_barang	= $this->input->post('nm_kategori_barang');

			$this->db->query("UPDATE dk_master_kategori_barang SET kategori='$nm_kategori_barang' WHERE id='$id'");
			redirect('master/kategori_barang');
		}
	}

	public function kategori_biaya()
	{
		$data["judul"]	= "Kategori Biaya";
		$query	= $this->db->query("SELECT * FROM dk_master_kategori_biaya");
		if ($query->num_rows() > 0) {
			$data["list_kat_biaya"]	= $query->result();
		} else {
			$data["list_kat_biaya"]	= 0;
		}

		$this->load->view("master/biaya/v_list_kategori_biaya", $data);
	}

	public function add_kategori_biaya()
	{
		if (empty($this->input->post())) {
			$data["judul"]	= "Tambah Kategori Biaya";
			$this->load->view('master/biaya/v_add_edit_kategori_biaya', $data);
		} else {
			$data	= array(
				'kategori_biaya'		=> $this->input->post('nm_kategori_biaya'),
				'kode_kategori_biaya'	=> strtoupper($this->input->post('kode_kategori_biaya'))

			);
			$this->db->insert('dk_master_kategori_biaya', $data);
			redirect('master/kategori_biaya');
		}
	}

	public function edit_kategori_biaya()
	{

		if (empty($this->input->post())) {
			$id			= $this->input->get("id");
			$query		= $this->db->query("SELECT * FROM dk_master_kategori_biaya WHERE id_kategori_biaya='$id'");
			if ($query->num_rows() > 0) {
				$data["list_kat_biaya"]	= $query->result();
				//$data	= $query->row();
			} else {
				$data["list_kat_biaya"]	= 0;
				//$data	= 0;
			}

			$this->load->view('master/biaya/v_add_edit_kategori_biaya', $data);
		} else {
			$data["judul"]	= "Edit Kategori Biaya";
			$no_id						= $this->input->post('id');
			$nm_kategori_biaya		= $this->input->post('nm_kategori_biaya');
			$kode_kategori_biaya	= strtoupper($this->input->post('kode_kategori_biaya'));

			$this->db->query("UPDATE dk_master_kategori_biaya SET kategori_biaya='$nm_kategori_biaya', kode_kategori_biaya='$kode_kategori_biaya' WHERE id_kategori_biaya='$no_id'");
			redirect('master/kategori_biaya');
		}
	}

	public function biaya()
	{
		$data["judul"]	= "Biaya";
		$query	= $this->db->query("SELECT a.id_biaya, a.nama_biaya, a.kategori_biaya, b.kategori_biaya FROM dk_master_biaya AS a JOIN dk_master_kategori_biaya AS b ON a.kategori_biaya = b.id_kategori_biaya ORDER BY a.id_biaya");
		if ($query->num_rows() > 0) {
			$data["list_biaya"]	= $query->result();
		} else {
			$data["list_biaya"]	= 0;
		}

		$this->load->view("master/biaya/v_list_biaya", $data);
	}

	public function add_biaya()
	{
		if (empty($this->input->post())) {
			$data["judul"]	= "Tambah Biaya";
			$this->load->view('master/biaya/v_add_edit_biaya', $data);
		} else {
			$data	= array(
				'nama_biaya'		=> $this->input->post('nm_biaya'),
				'kategori_biaya'	=> $this->input->post('kategori_biaya')

			);
			$this->db->insert('dk_master_biaya', $data);
			redirect('master/biaya');
		}
	}

	public function edit_biaya()
	{

		if (empty($this->input->post())) {
			$id			= $this->input->get("id");
			$query		= $this->db->query("SELECT a.*, b.kategori_biaya FROM dk_master_biaya AS a JOIN dk_master_kategori_biaya AS b ON a.kategori_biaya = b.id_kategori_biaya WHERE a.id_biaya='$id'");
			if ($query->num_rows() > 0) {
				$data["list_biaya"]	= $query->result();
				//$data	= $query->row();
			} else {
				$data["list_biaya"]	= 0;
				//$data	= 0;
			}

			$this->load->view('master/biaya/v_add_edit_biaya', $data);
		} else {
			$id				= $this->input->post('id');
			$nm_biaya		= $this->input->post('nm_biaya');
			$kategori_biaya	= $this->input->post('kategori_biaya');

			$this->db->query("UPDATE dk_master_biaya SET nama_biaya='$nm_biaya', kategori_biaya='$kategori_biaya' WHERE id_biaya='$id'");
			redirect('master/biaya');
		}
	}

	public function get_kolom()
	{
		$id = $this->uri->segment(3);
		$query	 	= "SELECT * FROM master_menu_field_erp WHERE nama_table='" . $id . "'";
		// echo $query;
		$Q_result	= $this->db->query($query)->result();
		$option 	= "<option value='0'>- Nama Kolom -</option>";
		// $option 	= "";
		foreach ($Q_result as $row) {
			$option .= "<option value='" . $row->nama_field . "'>" . $row->nama_field . "</option>";
		}
		echo json_encode(array(
			'option' => $option
		));
	}
}
