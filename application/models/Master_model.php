<?php
class Master_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cek_periode_aktif()
	{
		$singkat_cabang	= $this->session->userdata('singkat_cbg');
		$query	= "SELECT * FROM periode WHERE kdcab='$singkat_cabang' and stsaktif='O'";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa_master2()
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query	= "SELECT * from coa_master where kdcab='$kode_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa($bln_periode, $thn_periode)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');

		$query	= "SELECT * from coa where kdcab='$kode_cabang' and bln='$bln_periode' and thn='$thn_periode'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function simpan_master()
	{
		// $id      	    = $this->input->post('id');
		$no_perkiraan	= $this->input->post('no_perkiraan_depan') . $this->input->post('no_perkiraan');
		$nama	        = $this->input->post('nama');
		$kdcab		    = $this->input->post('kdcab');
		$bln	        = $this->input->post('bln');
		$thn		    = $this->input->post('thn');

		$Lv_2 = substr($no_perkiraan, 0, 2); // 11
		$id_1 = substr($no_perkiraan, 0, 4); // 1101
		$id_2 = substr($no_perkiraan, 5, 2); // 01
		$id_3 = substr($no_perkiraan, 8, 2); // 02
		$id_34 = $id_3 - 1;
		if ($id_34 < 10) {
			$id_5 = $id_1 . "-" . $id_2 . "-" . "0" . $id_34;
		} else {
			$id_5 = $id_1 . "-" . $id_2 . "-" . $id_34;
		}

		$cek_coatipe	= $this->cek_coatipe($Lv_2);
		if ($cek_coatipe > 0) {
			foreach ($cek_coatipe as $brs_coatipe) {
				$COA2	= $brs_coatipe->COA;
				$tipe	= $brs_coatipe->tipe;
				$faktor	= $brs_coatipe->faktor;
			}
		}

		$data	= array(
			'no_perkiraan'	=> $no_perkiraan,
			'nama'			=> $nama,
			'kdcab'			=> $kdcab,
			'bln'			=> $bln,
			'thn'			=> $thn,
			'tmp' 			=> "O",
			'tipe'			=> $tipe,
			'level' 		=> "5",
			'faktor' 		=> $faktor
		);
		$this->db->insert('coa_master', $data);
		$this->db->insert('COA', $data);

		$transaksi = "Tambah COA baru oleh " . $this->session->userdata('pn_name') . " no.coa : " . $no_perkiraan;
		$add_log = array(
			'transaksi' => $transaksi,
			'nama_user' => $this->session->userdata('pn_name'),
			'waktu' => date('Y-m-d H:i:s')
		);
		$this->db->insert('log_transaksi', $add_log);
	}

	public function get_edit_coa_master($id)
	{
		$query	= "SELECT * from coa_master where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_edit_coa()
	{
		// $id      	    = $this->input->post('id');
		$nokir_sebelumnya	= $this->input->post('nokir_sebelumnya');
		$nama_sebelumnya	= $this->input->post('nama_sebelumnya');
		$no_perkiraan	= $this->input->post('no_perkiraan');
		$nama	        = $this->input->post('nama');
		$kdcab		    = $this->input->post('kdcab');

		$bln		    = $this->input->post('bln');
		$thn		= $this->input->post('thn');

		$data	= array(
			// 'id'			=> "$id",
			'no_perkiraan'		=> $no_perkiraan,
			'nama'		=> $nama
			// 'kdcab'		=> $kdcab,
			// 'saldoawal'		=> $saldoawal,
			// 'bln'	=> $bln,
			// 'thn'		=> $thn
		);
		$data2	= array(
			'no_perkiraan'		=> $no_perkiraan,
			'nama'		=> $nama
			// 'kdcab'		=> $kdcab,
			// 'bln'	=> $bln,
			// 'thn'		=> $thn
		);

		// $this->db->query("UPDATE COA SET no_perkiraan='$no_perkiraan', nama='$nama', kdcab='$kdcab")

		$this->db->where('kdcab', $kdcab);
		$this->db->where('no_perkiraan', $nokir_sebelumnya);
		$this->db->update('COA', $data);

		$this->db->where('kdcab', $kdcab);
		$this->db->where('no_perkiraan', $nokir_sebelumnya);
		$this->db->update('coa_master', $data2);


		$transaksi = "Edit No.COA: " . $nokir_sebelumnya . ", Nama COA: " . $nama_sebelumnya . ", menjadi No.COA: " . $no_perkiraan . ", Nama COA: " . $nama . ", Oleh: " . $this->session->userdata('pn_name');
		$add_log = array(
			'transaksi' => $transaksi,
			'nama_user' => $this->session->userdata('pn_name'),
			'waktu' => date('Y-m-d H:i:s')
		);
		$this->db->insert('log_transaksi', $add_log);
	}


	public function get_nokirbr($id)
	{
		$query 	= "SELECT * from COA where no_perkiraan LIKE '$id%' AND level ='5'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_ketersediaan_coa($no_perkiraan, $kdcab, $bln, $thn)
	{

		$query	= "SELECT * from COA where no_perkiraan='$no_perkiraan' and kdcab='$kdcab' and bln='$bln' and thn='$thn'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_ketersediaan_coa2($no_perkiraan, $kdcab, $bln, $thn)
	{

		$query	= "SELECT * from coa_master where no_perkiraan='$no_perkiraan' and kdcab='$kdcab' and bln='$bln' and thn='$thn'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_nokir3()
	{ //	updated by Rindra

		$data_periode_aktif = $this->cek_periode_aktif();

		if ($data_periode_aktif > 0) {
			foreach ($data_periode_aktif as $row_nokir) {
				$tgl_periode = $row_nokir->periode;
				$bln_periode = substr($tgl_periode, 0, 2);
				$thn_periode = substr($tgl_periode, 3, 4);
			}
		}
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query	= "SELECT * FROM COA WHERE level = '4' and bln = '$bln_periode' and thn = '$thn_periode' and kdcab = '$kode_cabang' order by no_perkiraan";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_kode_cabang()
	{ //	updated by Rindra
		$query	= "SELECT * from pastibisa_tb_cabang";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_list_cabang()
	{
		$query	= "SELECT * from pastibisa_tb_cabang";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function simpan_cabang()
	{
		$nocab      	= $this->input->post('nocab');
		$subcab			= $this->input->post('subcab');
		$cabang	        = $this->input->post('cabang');
		$area		    = $this->input->post('area');
		$kode		    = $this->input->post('kode');
		$alamat			= $this->input->post('alamat');
		$nama_cabang	= $this->input->post('nama_cabang');
		$perusahaan		= $this->input->post('perusahaan');
		// 

		$data	= array(
			'nocab'			=> "$nocab",
			'subcab'		=> $subcab,
			'cabang'		=> $cabang,
			'area'			=> $area,
			'kdcab'			=> $kode,
			'alamat'		=> $alamat,
			'namacabang' 	=> $nama_cabang,
			'perusahaan' 	=> $perusahaan
		);
		// echo "<pre>";
		// print_r($data);
		// exit;
		$this->db->insert('pastibisa_tb_cabang', $data);
	}

	public function simpan_cab()
	{
		$id				= $this->input->post('id');
		$nocab      	= $this->input->post('nocab');
		$subcab			= $this->input->post('subcab');
		$cabang	        = $this->input->post('cabang');
		$area		    = $this->input->post('area');
		$kode		    = $this->input->post('kode');
		$alamat			= $this->input->post('alamat');
		$nama_cabang	= $this->input->post('nama_cabang');
		$perusahaan		= $this->input->post('perusahaan');
		// 

		$data	= array(
			'nocab'			=> $nocab,
			'subcab'		=> $subcab,
			'cabang'		=> $cabang,
			'area'			=> $area,
			'kdcab'			=> $kode,
			'alamat'		=> $alamat,
			'namacabang' 	=>  $nama_cabang,
			'perusahaan' 	=>  $perusahaan

		);
		$this->db->where('id', $id);
		$this->db->update('pastibisa_tb_cabang', $data);
	}

	public function get_edit_cabang($id)
	{
		$query	= "SELECT * from pastibisa_tb_cabang where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_jurnal_header()
	{

		$query	= "SELECT * from master_oto_jurnal_header order by kode_master_jurnal asc";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_header($kode_master_jurnal)
	{

		$query	= "SELECT * from master_oto_jurnal_header where kode_master_jurnal = '$kode_master_jurnal'";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_detail($kode_master_jurnal)
	{

		$query	= "SELECT * from master_oto_jurnal_detail where kode_master_jurnal = '$kode_master_jurnal'";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function simpan_jurnal_lama()
	{
		$tipe      	    	= $this->input->post('tipe');
		$nama_jurnal		= $this->input->post('nama_jurnal');
		$keterangan_header	= $this->input->post('keterangan_header');

		$no_konter = $this->get_konter($tipe);
		$kode_master_jurnal = $tipe . $no_konter;

		$det_Detail		= $this->input->post('detail');

		$data_header	= array(
			'kode_master_jurnal'	=> $kode_master_jurnal,
			'nama_jurnal'			=> $nama_jurnal,
			'keterangan_header'		=> $keterangan_header,
			'tipe'					=> $tipe
		);

		$Detail_BUM			= array();

		// insert ke jurnal kredit
		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_Coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_parameter		= $vals['no_parameter'];

			$Detail_BUM[$intL]	= array(
				'kode_master_jurnal'	=> $kode_master_jurnal,
				'no_perkiraan'  		=> $Kode_Coa[0],
				'keterangan'    		=> $descr,
				'parameter_no'  		=> $no_parameter
			);
		}

		$this->db->insert('master_oto_jurnal_header', $data_header);
		$this->db->insert_batch("master_oto_jurnal_detail", $Detail_BUM);

		if ($tipe == "BUM") {
			$no_konter_update = substr($kode_master_jurnal, 3, 3); // BUM001
			$data_konter = array('nobum' => $no_konter_update);
			$this->db->update("konter_master_jurnal", $data_konter);
		} elseif ($tipe == "JV") {
			$no_konter_update = substr($kode_master_jurnal, 2, 3); // JV001
			$data_konter = array('nojv' => $no_konter_update);
			$this->db->update("konter_master_jurnal", $data_konter);
		} elseif ($tipe == "BUK") {
			$no_konter_update = substr($kode_master_jurnal, 3, 3); // BUK001
			$data_konter = array('nobuk' => $no_konter_update);
			$this->db->update("konter_master_jurnal", $data_konter);
		}
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}


	//SYAM 11/07/2020

	function simpan_jurnal()
	{
		$tipe      	    	= $this->input->post('tipe');
		$nama_jurnal		= $this->input->post('nama_jurnal');
		$keterangan_header	= $this->input->post('keterangan_header');
		$jenis_jurnal	= $this->input->post('jenis_jurnal');
		$eksekusi	= $this->input->post('eksekusi');

		$no_konter = $this->get_konter($tipe);
		$kode_master_jurnal = $tipe . $no_konter;

		$det_Detail		= $this->input->post('detail');

		$data_header	= array(
			'kode_master_jurnal'	=> $kode_master_jurnal,
			'nama_jurnal'			=> $nama_jurnal,
			'keterangan_header'		=> $keterangan_header,
			'tipe'					=> $tipe,
			'jenis_jurnal'			=> $jenis_jurnal,
			'eksekusi'				=> $eksekusi
		);

		$Detail_BUM			= array();

		// insert ke jurnal kredit
		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_Coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$posisi     		= $vals['posisi'];
			$nama_menu				= $vals['nama_menu'];
			$nama_field				= $vals['nama_field'];
			$proses				    = $vals['proses'];


			$Detail_BUM[$intL]	= array(
				'kode_master_jurnal'	=> $kode_master_jurnal,
				'menu'                  => $nama_menu,
				'no_perkiraan'  		=> $Kode_Coa[0],
				'keterangan'    		=> $descr,
				'posisi'                => $posisi,
				'field'                 => $nama_field,
				'cara_insert'           => $proses
			);
		}

		$this->db->insert('master_oto_jurnal_header', $data_header);
		$this->db->insert_batch("master_oto_jurnal_detail", $Detail_BUM);

		if ($tipe == "BUM") {
			$no_konter_update = substr($kode_master_jurnal, 3, 3); // BUM001
			$data_konter = array('nobum' => $no_konter_update);
			$this->db->update("konter_master_jurnal", $data_konter);
		} elseif ($tipe == "JV") {
			$no_konter_update = substr($kode_master_jurnal, 2, 3); // JV001
			$data_konter = array('nojv' => $no_konter_update);
			$this->db->update("konter_master_jurnal", $data_konter);
		} elseif ($tipe == "BUK") {
			$no_konter_update = substr($kode_master_jurnal, 3, 3); // BUK001
			$data_konter = array('nobuk' => $no_konter_update);
			$this->db->update("konter_master_jurnal", $data_konter);
		}
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	public function get_konter($tipe)
	{
		if ($tipe == "BUM") {
			$query 	= "SELECT nobum from konter_master_jurnal";
			$q 		= $this->db->query($query);

			if ($q->num_rows() > 0) {
				$ret =  $q->result();

				$kdadd			= "";
				$kd_bum		= $ret[0]->nobum + 1;
				if (strlen($kd_bum) == 1) {
					$kdadd		= "00";
				} else if (strlen($kd_bum) == 2) {
					$kdadd		= "0";
				} else {
					$kdadd		= '';
				}
				$no_konter = $kdadd . $kd_bum; // 001
				return $no_konter;
			} else {
				return Null;
			}
		} elseif ($tipe == "JV") {
			$query 	= "SELECT nojv from konter_master_jurnal";
			$q 		= $this->db->query($query);

			if ($q->num_rows() > 0) {
				$ret =  $q->result();

				$kdadd			= "";
				$kd_jv		= $ret[0]->nojv + 1;
				if (strlen($kd_jv) == 1) {
					$kdadd		= "00";
				} else if (strlen($kd_jv) == 2) {
					$kdadd		= "0";
				} else {
					$kdadd		= '';
				}
				$no_konter = $kdadd . $kd_jv; // 001
				return $no_konter;
			} else {
				return Null;
			}
		} elseif ($tipe == "BUK") {
			$query 	= "SELECT nobuk from konter_master_jurnal";
			$q 		= $this->db->query($query);

			if ($q->num_rows() > 0) {
				$ret =  $q->result();

				$kdadd			= "";
				$kd_buk		= $ret[0]->nobuk + 1;
				if (strlen($kd_buk) == 1) {
					$kdadd		= "00";
				} else if (strlen($kd_buk) == 2) {
					$kdadd		= "0";
				} else {
					$kdadd		= '';
				}
				$no_konter = $kdadd . $kd_buk; // 001
				return $no_konter;
			} else {
				return Null;
			}
		}
	}

	function update_jurnal()
	{
		// ======================================== //

		$kode_master_jurnal	= $this->input->post('kode_master_jurnal');
		$tipe      	    	= $this->input->post('tipe');
		$nama_jurnal		= $this->input->post('nama_jurnal');
		$keterangan_header	= $this->input->post('keterangan_header');

		// $no_konter = $this->get_konter($tipe);
		// $kode_master_jurnal = $tipe . $no_konter;

		$det_Detail		= $this->input->post('detDetail');

		$data_header	= array(
			'kode_master_jurnal'	=> $kode_master_jurnal,
			'nama_jurnal'			=> $nama_jurnal,
			'keterangan_header'		=> $keterangan_header,
			'tipe'					=> $tipe
		);

		$Detail_BUM			= array();

		// insert ke jurnal detail
		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_Coa			= explode('^', $vals['no_perkiraan']);
			$descr				= $vals['keterangan'];
			$no_parameter		= $vals['no_parameter'];

			$Detail_BUM[$intL]	= array(
				'kode_master_jurnal'	=> $kode_master_jurnal,
				'no_perkiraan'  		=> $Kode_Coa[0],
				'keterangan'    		=> $descr,
				'parameter_no'  		=> $no_parameter
			);
		}

		$this->db->where("kode_master_jurnal", $kode_master_jurnal);
		$this->db->delete('master_oto_jurnal_header');

		$this->db->insert('master_oto_jurnal_header', $data_header);

		$this->db->where("kode_master_jurnal", $kode_master_jurnal);
		$this->db->delete('master_oto_jurnal_detail');

		$this->db->insert_batch("master_oto_jurnal_detail", $Detail_BUM);
	}


	//======================================================= stock =======================================
	public function stock()
	{
		$nama_cabang	= $this->session->userdata('nama_cabang');
		$query	= "SELECT * from dk_master_barang where barang_stock='Y' and nm_cabang='$nama_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function non_stock()
	{
		$nama_cabang	= $this->session->userdata('nama_cabang');
		$query	= "SELECT * from dk_master_barang where barang_stock='N' and nm_cabang='$nama_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_stock($id)
	{
		$query	= "select * from dk_master_barang where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_jabatan()
	{
		$query	= "select * from dk_jabatan";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_kategori_biaya()
	{
		$query	= "SELECT * from dk_master_kategori_biaya";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_kategori_brg()
	{
		$query	= "SELECT * from dk_master_kategori_barang";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_kategori_paket()
	{
		$query	= "select * from dk_master_kategori";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_kategori_paket2($id)
	{
		$query	= "select * from dk_master_kategori where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_jabatan_id($id)
	{
		$query	= "select * from dk_jabatan where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_add_stock()
	{
		$nm_barang	= $this->input->post('nm_barang');
		$supplier	= $this->input->post('supplier');
		$supplier	= explode("+^", $supplier);
		$asal		= $this->input->post('asal');
		$kategori	= $this->input->post('kategori');
		$detail		= $this->input->post('detail');
		$harga		= $this->input->post('harga');
		$bagus		= $this->input->post('bagus');
		$sedang		= $this->input->post('sedang');
		$jelek		= $this->input->post('jelek');
		$pn_wilayah	= $this->input->post('pn_wilayah');
		$foto2		= $this->input->post('foto');
		$cabang		= explode("+^", $pn_wilayah);
		$akses		= $this->input->post('pn_akses');
		$q_user		= $this->db->query("select c_barang from dk_counter where id='$pn_wilayah'");
		$ret 		= $q_user->result();
		$kd_barang		= $ret[0]->c_barang + 1;
		$kdadd			= "";
		if (strlen($kd_barang) == 1) {
			$kdadd		= "0000";
		} else if (strlen($kd_barang) == 2) {
			$kdadd		= "000";
		} else if (strlen($kd_barang) == 3) {
			$kdadd		= "00";
		} else if (strlen($kd_barang) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$thnbln			= date("ym");
		$id				= '2' . $thnbln . $kdadd . $kd_barang;
		$stock			= $bagus + $sedang + $jelek;

		$nmfile = "";
		$ekstensi_file	= '.jpg';
		$this->load->library('upload');
		$nmfile = $id . $ekstensi_file; //nama file + fungsi time
		$config['upload_path'] = './gambar_barang/'; //Folder untuk menyimpan hasil upload
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; //maksimum besar file 3M
		$config['max_width']  = '5000'; //lebar maksimum 5000 px
		$config['max_height']  = '5000'; //tinggi maksimu 5000 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya

		$this->upload->initialize($config);

		if ($_FILES['filefoto']['name']) {
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
			}
		}

		$data	= array(
			'id'			=> $id,
			'nm_barang'		=> strtoupper($nm_barang),
			'kategori'		=> $kategori,
			'id_cabang'		=> $cabang[0],
			'nm_cabang'		=> $cabang[1],
			'produk_asal'	=> strtoupper($asal),
			'detail'		=> $detail,
			'id_supplier'	=> $supplier[0],
			'nm_supplier'	=> $supplier[1],
			'barang_stock'	=> "Y",
			'harga'			=> $harga,
			'bagus'			=> $bagus,
			'sedang'		=> $sedang,
			'jelek'			=> $jelek,
			'stock'			=> $stock,
			'insert_by'		=> $this->session->userdata('pn_name'),
			'insert_date'	=> date("Y-m-d"),
			'foto'			=> $nmfile,
			'sts'			=> $akses
		);
		$this->db->insert('dk_master_barang', $data);
		$this->db->query("update dk_counter set c_barang ='$kd_barang' where id='$pn_wilayah'");
	}

	public function proses_edit_stock()
	{
		$nm_barang	= $this->input->post('nm_barang');
		$kategori	= $this->input->post('kategori');
		$supplier	= $this->input->post('supplier');
		$supplier	= explode("+^", $supplier);
		$asal		= $this->input->post('asal');
		$detail		= $this->input->post('detail');
		$harga		= $this->input->post('harga');
		$bagus		= $this->input->post('bagus');
		$sedang		= $this->input->post('sedang');
		$jelek		= $this->input->post('jelek');
		$pn_wilayah	= $this->input->post('pn_wilayah');
		$cabang		= explode("+^", $pn_wilayah);
		$akses		= $this->input->post('sts');
		$id			= $this->input->post('id');
		$stock			= $bagus + $sedang + $jelek;

		$nmfile = "";
		$ekstensi_file	= '.jpg';
		$this->load->library('upload');
		$nmfile = $id . $ekstensi_file; //nama file + fungsi time
		$config['upload_path'] = './gambar_barang/'; //Folder untuk menyimpan hasil upload
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; //maksimum besar file 3M
		$config['max_width']  = '5000'; //lebar maksimum 5000 px
		$config['max_height']  = '5000'; //tinggi maksimu 5000 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya

		$this->upload->initialize($config);

		if ($_FILES['filefoto']['name']) {
			$file = './gambar_barang/' . $nmfile;
			unlink($file);
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
			}
		}

		$data	= array(
			'nm_barang'		=> strtoupper($nm_barang),
			'kategori'		=> strtoupper($kategori),
			'id_cabang'		=> $cabang[0],
			'nm_cabang'		=> $cabang[1],
			'produk_asal'	=> strtoupper($asal),
			'detail'		=> $detail,
			'id_supplier'	=> $supplier[0],
			'nm_supplier'	=> $supplier[1],
			'harga'			=> $harga,
			'barang_stock'	=> "Y",
			'bagus'			=> $bagus,
			'sedang'		=> $sedang,
			'jelek'			=> $jelek,
			'stock'			=> $stock,
			'edit_by'		=> $this->session->userdata('pn_name'),
			'edit_date'	=> date("Y-m-d"),
			'foto'			=> $nmfile,
			'sts'			=> $akses
		);
		$this->db->where('id', $id);
		$this->db->update('dk_master_barang', $data);
	}

	//============================================================= nonstock ============================================

	public function list_nonstock($id)
	{
		$query	= "select * from dk_master_barang where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_cabang()
	{
		$query	= "select id,nm_cabang from dk_cabang";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function nm_supplier()
	{
		$query	= "select id,nm_supplier from dk_master_supplier";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_kategori_area()
	{
		$query	= "select * from dk_area where `use`='0'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_add_nonstock()
	{
		$nm_barang	= $this->input->post('nm_barang');
		$supplier	= $this->input->post('supplier');
		$supplier	= explode("+^", $supplier);
		$asal		= $this->input->post('asal');
		$detail		= $this->input->post('detail');
		$harga		= $this->input->post('harga');
		$pn_wilayah	= $this->input->post('pn_wilayah');
		$cabang		= explode("+^", $pn_wilayah);
		$sts		= $this->input->post('sts');
		$q_user			= $this->db->query("select c_barang from dk_counter where id='$pn_wilayah'");
		$ret 			= $q_user->result();
		$kd_barang		= $ret[0]->c_barang + 1;
		$kdadd			= "";
		if (strlen($kd_barang) == 1) {
			$kdadd		= "0000";
		} else if (strlen($kd_barang) == 2) {
			$kdadd		= "000";
		} else if (strlen($kd_barang) == 3) {
			$kdadd		= "00";
		} else if (strlen($kd_barang) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$thnbln			= date("ym");
		$id				= '1' . $thnbln . $kdadd . $kd_barang;

		$nmfile = "";
		$ekstensi_file	= '.jpg';
		$this->load->library('upload');
		$nmfile = $id . $ekstensi_file; //nama file + fungsi time
		$config['upload_path'] = './gambar_barang/'; //Folder untuk menyimpan hasil upload
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; //maksimum besar file 3M
		$config['max_width']  = '5000'; //lebar maksimum 5000 px
		$config['max_height']  = '5000'; //tinggi maksimum 5000 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya

		$this->upload->initialize($config);

		if ($_FILES['filefoto']['name']) {
			$file = './gambar_barang/' . $nmfile;
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
			}
		}

		$data	= array(
			'id'			=> $id,
			'nm_barang'		=> strtoupper($nm_barang),
			'id_cabang'		=> $cabang[0],
			'nm_cabang'		=> $cabang[1],
			'produk_asal'	=> strtoupper($asal),
			'detail'		=> $detail,
			'id_supplier'	=> $supplier[0],
			'nm_supplier'	=> $supplier[1],
			'harga'			=> $harga,
			'barang_stock'	=> "N",
			'insert_by'		=> $this->session->userdata('pn_name'),
			'insert_date'	=> date("Y-m-d"),
			'sts'			=> $sts
		);
		$this->db->insert('dk_master_barang', $data);
		$this->db->query("update dk_counter set c_barang ='$kd_barang' where id='$pn_wilayah'");
	}

	public function proses_edit_nonstock()
	{
		$nm_barang	= $this->input->post('nm_barang');
		$supplier	= $this->input->post('supplier');
		$supplier	= explode("+^", $supplier);
		$asal		= $this->input->post('asal');
		$detail		= $this->input->post('detail');
		$harga		= $this->input->post('harga');
		$pn_wilayah	= $this->input->post('pn_wilayah');
		$cabang		= explode("+^", $pn_wilayah);
		$akses		= $this->input->post('sts');
		$id			= $this->input->post('id');

		$nmfile = "";
		$ekstensi_file	= '.jpg';
		$this->load->library('upload');
		$nmfile = $id . $ekstensi_file; //nama file + fungsi time
		$config['upload_path'] = './gambar_barang/'; //Folder untuk menyimpan hasil upload
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['max_size'] = '3072'; //maksimum besar file 3M
		$config['max_width']  = '5000'; //lebar maksimum 5000 px
		$config['max_height']  = '5000'; //tinggi maksimu 5000 px
		$config['file_name'] = $nmfile; //nama yang terupload nantinya

		$this->upload->initialize($config);

		if ($_FILES['filefoto']['name']) {
			$file = './gambar_barang/' . $nmfile;
			unlink($file);
			if ($this->upload->do_upload('filefoto')) {
				$gbr = $this->upload->data();
			}
		}

		$data	= array(
			'nm_barang'		=> strtoupper($nm_barang),
			'id_cabang'		=> $cabang[0],
			'nm_cabang'		=> $cabang[1],
			'produk_asal'	=> strtoupper($asal),
			'detail'		=> $detail,
			'nm_supplier'	=> $supplier[1],
			'id_supplier'	=> $supplier[0],
			'barang_stock'	=> "N",
			'harga'			=> $harga,
			'edit_by'		=> $this->session->userdata('pn_name'),
			'edit_date'	=> date("Y-m-d"),
			'sts'			=> $akses
		);
		$this->db->where('id', $id);
		$this->db->update('dk_master_barang', $data);
	}

	//=============================================================== supplier =====================================
	public function supplier()
	{
		$query	= "select * from dk_master_supplier";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_supplier()
	{
		$query	= "select id, nm_supplier from dk_master_supplier where sts='1'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function detail_supplier($id)
	{
		$query	= "select * from dk_master_supplier where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_edit_supplier()
	{
		$nm_sup		= $this->input->post('nm_sup');
		$pic		= $this->input->post('pic');
		$alamat		= $this->input->post('alamat');
		$perusahaan	= $this->input->post('perusahaan');
		$telf1		= $this->input->post('telf1');
		$telf2		= $this->input->post('telf2');
		$telf3		= $this->input->post('telf3');
		$email		= $this->input->post('email');
		$email2		= $this->input->post('email2');
		$lama		= $this->input->post('lama');
		$jenis		= $this->input->post('jenis');
		$catatan	= $this->input->post('catatan');
		$sts_sup	= $this->input->post('sts_sup');
		$pelayanan	= $this->input->post('pelayanan');
		$id			= $this->input->post('id_sup');
		$data		= array(
			'nm_supplier'		=> $nm_sup,
			'pic'				=> $pic,
			'alamat'			=> $alamat,
			'perusahaan'		=> $perusahaan,
			'nomor_telfon'		=> $telf1,
			'nomor_telfon2'		=> $telf2,
			'nomor_telfon3'		=> $telf3,
			'email'				=> $email,
			'email2'			=> $email2,
			'lama_pengiriman'	=> $lama,
			'jenis_pengiriman'	=> $jenis,
			'sts'				=> $sts_sup,
			'catatan'			=> $catatan,
			'pelayanan'			=> $pelayanan,
			'edit_by'			=> $this->session->userdata('pn_name'),
			'edit_date'			=> date("Y-m-d")
		);
		$this->db->where('id', $id);
		$this->db->update('dk_master_supplier', $data);
	}

	public function proses_add_supplier()
	{
		$nm_sup		= $this->input->post('nm_sup');
		$pic		= $this->input->post('pic');
		$alamat		= $this->input->post('alamat');
		$perusahaan	= $this->input->post('perusahaan');
		$telf1		= $this->input->post('telf1');
		$telf2		= $this->input->post('telf2');
		$telf3		= $this->input->post('telf3');
		$email		= $this->input->post('email');
		$email2		= $this->input->post('email2');
		$lama		= $this->input->post('lama');
		$jenis		= $this->input->post('jenis');
		$catatan	= $this->input->post('catatan');
		$sts_sup	= $this->input->post('sts_sup');
		$pelayanan	= $this->input->post('pelayanan');
		$q_user		= $this->db->query("select max(id) as id from dk_master_supplier");
		$ret 		= $q_user->result();
		$id			= $ret[0]->id + 1;
		$data		= array(
			'id'				=> $id,
			'nm_supplier'		=> $nm_sup,
			'pic'				=> $pic,
			'alamat'			=> $alamat,
			'perusahaan'		=> $perusahaan,
			'nomor_telfon'		=> $telf1,
			'nomor_telfon2'		=> $telf2,
			'nomor_telfon3'		=> $telf3,
			'email'				=> $email,
			'email2'			=> $email2,
			'lama_pengiriman'	=> $lama,
			'jenis_pengiriman'	=> $jenis,
			'sts'				=> $sts_sup,
			'catatan'			=> $catatan,
			'pelayanan'			=> $pelayanan,
			'insert_by'			=> $this->session->userdata('pn_name'),
			'insert_date'		=> date("Y-m-d")
		);
		$this->db->insert('dk_master_supplier', $data);
	}

	public function proses_add_kategori()
	{
		$id				= $this->input->post('id');
		$nm_kategori	= $this->input->post('nm_kategori');
		$jenis_kategori	= $this->input->post('jenis_kategory');
		$keterangan 	= $this->input->post('keterangan');
		$status 		= $this->input->post('status');
		$qty	 		= $this->input->post('qty');
		$nm_barang	 	= $this->input->post('nm_barang');
		$jenis_kategori = explode("+^", $jenis_kategori);
		for ($i = 0; $i < count($nm_barang); $i++) {
			$barang		= explode("+^", $nm_barang[$i]);
			$data2		= array(
				'id_kategori'	=> $id,
				'id_paket'		=> $jenis_kategori[0],
				'id_barang'		=> $barang[0],
				'nm_barang'		=> $barang[1],
				'jumlah'		=> $qty[$i],
				'sts'			=> $status,
			);
			if ($nm_barang[$i] != '0') {
				$this->db->insert('dk_kategori_detail', $data2);
			}
		}
		$id_ex = explode("|", $id);
		$id_ex = $id_ex[1] + 0;
		$this->db->query("update dk_counter set c_kategori ='$id_ex'");
		$data		= array(
			'id_kategori'		=> $id,
			'nm_kategori'		=> strtoupper($nm_kategori),
			'nm_paket'			=> $jenis_kategori[1],
			'id_paket'			=> $jenis_kategori[0],
			'keterangan'		=> $keterangan,
			'sts'				=> $status,
			'insert_by'			=> $this->session->userdata('pn_name'),
			'insert_date'		=> date("Y-m-d")
		);
		$this->db->insert('dk_kategori', $data);
	}
	//========================================================== PAKET ==========================================		
	public function proses_add_paket()
	{
		$id				= $this->input->post('id');
		$nm_paket		= $this->input->post('nm_paket');
		$persentase		= $this->input->post('persentase');
		$sts			= $this->input->post('status');
		$gedung			= $this->input->post('gedung');
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
			'persentase'	=> $persentase,
			'sts'			=> $sts,
			'id_gedung'		=> $gedung2_id,
			'nm_gedung'		=> $gedung2_nm
		);
		$this->db->insert('dk_master_paket', $data);
		$id_ex = explode("|", $id);
		$id_ex = $id_ex[1] + 0;
		$this->db->query("update dk_counter set c_paket ='$id_ex'");
	}

	public function proses_add_kategori_paket()
	{
		if ($this->input->post('nm_kategori') != '') {
			$this->db->query("insert into dk_master_kategori (nm_keterangan,jumlah)values('" . strtoupper($this->input->post('nm_kategori')) . "','" . str_replace(".", "", str_replace(",", "", $this->input->post('harga'))) . "')");
		}
	}

	public function proses_edit_kategori_paket()
	{
		$this->db->query("update dk_master_kategori set nm_keterangan='" . $this->input->post('nm_kategori') . "',jumlah='" . str_replace(".", "", str_replace(",", "", $this->input->post('harga'))) . "' where id='" . $this->input->post('id') . "'");
	}

	public function proses_edit_paket()
	{
		$id				= $this->input->post('id');
		$nm_paket		= $this->input->post('nm_paket');
		$persentase		= $this->input->post('persentase');
		$sts			= $this->input->post('status');
		$gedung			= $this->input->post('gedung');
		$gedung2		= explode("+^", $gedung);
		if ($gedung == "") {
			$gedung2_nm	= "";
			$gedung2_id = "";
		} else {
			$gedung2_nm	= $gedung2[1];
			$gedung2_id = $gedung2[0];
		}
		$data		= array(
			'nm_paket'		=> $nm_paket,
			'persentase'	=> $persentase,
			'sts'			=> $sts,
			'id_gedung'		=> $gedung2_id,
			'nm_gedung'		=> $gedung2_nm
		);
		$this->db->where('id_paket', $id);
		$this->db->update('dk_master_paket', $data);
	}

	public function get_harga($id)
	{
		$temp = 0;
		$query	= $this->db->query("select id_barang,jumlah from dk_kategori_detail where id_paket='$id' and sts='1'");
		if ($query->num_rows() > 0) {
			$data 	= $query->result();
			foreach ($data as $row) {
				$id_barang = $row->id_barang;
				$jumlah = $row->jumlah;
				$query2	= $this->db->query("select sum(harga) as tot_harga from dk_master_barang where id ='$id_barang' and sts='1'");
				if ($query2->num_rows() > 0) {
					$ret 	= $query2->result();
					$harga	= $ret[0]->tot_harga;
					$total	= $harga * $jumlah;
					$temp	= $temp + $total;
				} else {
					$temp	= $temp + 0;
				}
			}
			return $temp;
		} else {
			return 0;
		}
	}

	public function get_harga_kategori($id)
	{
		$temp = 0;
		$query	= $this->db->query("select id_barang,jumlah from dk_kategori_detail where id_kategori='$id' and sts='1'");
		if ($query->num_rows() > 0) {
			$data 	= $query->result();
			foreach ($data as $row) {
				$id_barang = $row->id_barang;
				$jumlah = $row->jumlah;
				$query2	= $this->db->query("select sum(harga) as tot_harga from dk_master_barang where id ='$id_barang' and sts='1'");
				if ($query2->num_rows() > 0) {
					$ret 	= $query2->result();
					$harga	= $ret[0]->tot_harga;
					$total	= $harga * $jumlah;
					$temp	= $temp + $total;
				} else {
					$temp	= $temp + 0;
				}
			}
			return $temp;
		} else {
			return 0;
		}
	}

	public function get_list_paket()
	{
		$query	= "select id_paket,nm_paket from dk_master_paket where sts='1'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_data_ged($id_gedung)
	{
		$query	= "select nm_gedung,tinggi,lebar,panjang,tinggi_panggung from dk_master_gedung where id ='$id_gedung'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_owner()
	{
		$query	= "select * from dk_master_owner";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_owner1($id)
	{
		$query	= "select * from dk_master_owner where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kategori_detail($iaaad)
	{
		$query	= "select * from dk_kategori_detail where id_kategori='$iaaad'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function data_kategori($iaaad)
	{
		$query	= "select * from dk_kategori where id_kategori='$iaaad'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nm_paket($id_paket)
	{
		$query	= $this->db->query("select nm_paket from dk_master_paket where id_paket = '$id_paket'");
		if ($query->num_rows() > 0) {
			$ret	= $query->result();
			return $ret[0]->nm_paket;
		} else {
			return 0;
		}
	}

	public function get_harga_barang($nama)
	{
		$query	= $this->db->query("select jumlah from dk_master_kategori where nm_keterangan = '$nama' and jumlah != ''");
		if ($query->num_rows() > 0) {
			$ret	= $query->result();
			return $ret[0]->jumlah;
		} else {
			return 0;
		}
	}

	public function delete_barang($id2)
	{
		$queri	= $this->db->query("delete from dk_kategori_detail where id='$id2'");
	}

	public function proses_edit_kategori()
	{
		$id				= $this->input->post('id');
		$nm_kategori	= $this->input->post('nm_kategori');
		$jenis_kategori	= $this->input->post('jenis_kategory');
		$keterangan 	= $this->input->post('keterangan');
		$status 		= $this->input->post('status');
		$qty	 		= $this->input->post('qty');
		$nm_barang	 	= $this->input->post('nm_barang');
		$nm_barang2	 	= $this->input->post('nm_barang2');
		$jenis_kategori = explode("+^", $jenis_kategori);
		for ($i = 0; $i < count($nm_barang); $i++) {
			$barang		= explode("+^", $nm_barang[$i]);
			$data2		= array(
				'id_kategori'	=> $id,
				'id_paket'		=> $jenis_kategori[0],
				'id_barang'		=> $barang[0],
				'nm_barang'		=> $barang[1],
				'jumlah'		=> $qty[$i],
				'sts'			=> $status,
			);
			if ($nm_barang[$i] != '0') {
				$this->db->insert('dk_kategori_detail', $data2);
			}
		}
		for ($i = 0; $i < count($nm_barang2); $i++) {
			$barang2		= explode("+^", $nm_barang2[$i]);
			$data2		= array(
				'id_kategori'	=> $id,
				'id_paket'		=> $jenis_kategori[0],
				'id_barang'		=> $barang2[0],
				'nm_barang'		=> $barang2[1],
				'jumlah'		=> $qty[$i],
				'sts'			=> $status,
			);
			$this->db->where('id_kategori', $id);
			$this->db->where('id_paket', $jenis_kategori[0]);
			$this->db->where('id_barang', $barang2[0]);
			$this->db->update('dk_kategori_detail', $data2);
		}
		$id_ex = explode("|", $id);
		$id_ex = $id_ex[1] + 0;
		$this->db->query("update dk_counter set c_kategori ='$id_ex'");
		$data		= array(
			'id_kategori'		=> $id,
			'nm_kategori'		=> strtoupper($nm_kategori),
			'nm_paket'			=> $jenis_kategori[1],
			'id_paket'			=> $jenis_kategori[0],
			'keterangan'		=> $keterangan,
			'sts'				=> $status,
			'insert_by'			=> $this->session->userdata('pn_name'),
			'insert_date'		=> date("Y-m-d")
		);
		$this->db->where('id_kategori', $id);
		$this->db->update('dk_kategori', $data);
	}

	function get_harga_detail($idxx)
	{
		$query	= $this->db->query("select harga from dk_master_barang where id = '$idxx'");
		if ($query->num_rows() > 0) {
			$ret	= $query->result();
			return $ret[0]->harga;
		} else {
			return 0;
		}
	}

	function get_id_ged($iaaad)
	{
		$query	= $this->db->query("select id_gedung from dk_master_paket where id_paket = '$iaaad'");
		if ($query->num_rows() > 0) {
			$ret	= $query->result();
			return $ret[0]->id_gedung;
		} else {
			return 0;
		}
	}

	function get_paket($iaaad)
	{
		$query	= $this->db->query("select * from dk_master_paket where id_paket = '$iaaad'");
		if ($query->num_rows() > 0) {
			$ret	= $query->result();
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_date_area($iaaad)
	{
		$query	= $this->db->query("select * from dk_area where id = '$iaaad'");
		if ($query->num_rows() > 0) {
			$ret	= $query->result();
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_kategori($iaaad)
	{
		$query	= $this->db->query("select * from dk_kategori where id_paket = '$iaaad'");
		if ($query->num_rows() > 0) {
			$ret	= $query->result();
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_id_cust()
	{
		$q_user			= $this->db->query("select c_customer from dk_counter");
		$ret 			= $q_user->result();
		$kd_barang		= $ret[0]->c_customer + 1;
		$kdadd			= "";
		if (strlen($kd_barang) == 1) {
			$kdadd		= "0000";
		} else if (strlen($kd_barang) == 2) {
			$kdadd		= "000";
		} else if (strlen($kd_barang) == 3) {
			$kdadd		= "00";
		} else if (strlen($kd_barang) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$thnbln			= date("ym");
		$id				= 'C' . $thnbln . "|" . $kdadd . $kd_barang;
		return $id;
	}
	//===================================================== salesman ========================================
	function get_salesman()
	{
		$query	= $this->db->query("select nosales,kategori,nama,alamat,nohp,tgl_masuk,pengalaman,status from dk_master_salesman");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	//==================================================== customer =========================================
	function customer_per_wilayah($wilayah_user)
	{
		$query	= $this->db->query("SELECT *,a.insertby,b.pn_name,b.pn_wilayah,c.id from dk_master_customer a join dk_user b on a.insertby = b.pn_name join dk_cabang c on b.pn_wilayah = c.id where b.pn_wilayah='$wilayah_user'");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	function get_customer($nocust)
	{
		$nocust	= str_replace("_", "|", $nocust);
		$query	= $this->db->query("select * from dk_master_customer where nocust='$nocust'");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_customer2($id)
	{
		$query	= $this->db->query("select piutang from dk_master_customer where id_prospek='$id'");
		if ($query->num_rows() > 0) {
			$ret = $query->result();
			return $ret[0]->piutang;
		} else {
			return 0;
		}
	}
	function get_customer3($id)
	{
		$query	= $this->db->query("SELECT sum(bayar) as sdh_byr from dk_invoice where id_prospek='$id'");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function proses_add_customer()
	{
		$id_customer	= $this->input->post('id_customer');
		$tgl_input		= $this->input->post('tgl_input');
		$industri		= $this->input->post('industri');
		$perusahaan		= $this->input->post('perusahaan');
		$pria			= $this->input->post('pria');
		$wanita			= $this->input->post('wanita');
		$agama			= $this->input->post('agama');
		$pemesan		= $this->input->post('pemesan');
		$title			= $this->input->post('title');
		$alamat			= $this->input->post('alamat');
		$kota			= $this->input->post('kota');
		$kd_pos			= $this->input->post('kd_pos');
		$telfon1		= $this->input->post('telfon1');
		$telfon2		= $this->input->post('telfon2');
		$email1			= $this->input->post('email1');
		$email2			= $this->input->post('email2');
		$nm_bank		= $this->input->post('nm_bank');
		$no_account		= $this->input->post('no_account');
		$cabang			= $this->input->post('cabang');
		$sts_trv		= $this->input->post('sts_trv');
		$npwp			= $this->input->post('npwp');
		$sales			= $this->input->post('sales');
		$sts_cus		= $this->input->post('sts_cus');
		$no_ktp			= $this->input->post('no_ktp');
		$sales			= explode("+^", $sales);
		$data			= array(
			'nocust' 			=> $id_customer,
			'npwp'				=> $npwp,
			'nama_perusahaan' 	=> $perusahaan,
			'pengantin_perempuan' => $wanita,
			'pengantin_pria' 	=> $pria,
			'nama_pemesan_tunggal' => $pemesan,
			'alamat' 			=> $alamat,
			'title' 			=> $title,
			'noktp' 			=> $no_ktp,
			'tlp' 				=> $telfon1,
			'tlp2' 				=> $telfon2,
			'email1' 			=> $email1,
			'email2' 			=> $email2,
			'kota' 				=> $kota,
			'kode_pos' 			=> $kd_pos,
			'agama' 			=> $agama,
			'industry' 			=> $industri,
			'sts_aktif'	 		=> $sts_cus,
			'sales' 			=> $sales[0],
			'namasales' 		=> $sales[1],
			'tgl_entry' 		=> $tgl_input,
			'bank' 				=> $nm_bank,
			'noaccount' 		=> $no_account,
			'cab_bank' 			=> $cabang,
			'ststransfer' 		=> $sts_trv,
			'insertby' 			=> $this->session->userdata('pn_name')
		);
		$this->db->insert("dk_master_customer", $data);
		$id	= explode("|", $id_customer);
		$id	= $id[1] + 0;
		$this->db->query("update dk_counter set c_customer ='" . $id . "'");
	}



	function proses_edit_customer()
	{
		$id_customer	= $this->input->post('id_customer');
		$tgl_input		= $this->input->post('tgl_input');
		$industri		= $this->input->post('industri');
		$perusahaan		= $this->input->post('perusahaan');
		$pria			= $this->input->post('pria');
		$wanita			= $this->input->post('wanita');
		$agama			= $this->input->post('agama');
		$pemesan		= $this->input->post('pemesan');
		$title			= $this->input->post('title');
		$alamat			= $this->input->post('alamat');
		$kota			= $this->input->post('kota');
		$kd_pos			= $this->input->post('kd_pos');
		$telfon1		= $this->input->post('telfon1');
		$telfon2		= $this->input->post('telfon2');
		$email1			= $this->input->post('email1');
		$email2			= $this->input->post('email2');
		$nm_bank		= $this->input->post('nm_bank');
		$no_account		= $this->input->post('no_account');
		$cabang			= $this->input->post('cabang');
		$sts_trv		= $this->input->post('sts_trv');
		$npwp			= $this->input->post('npwp');
		$sales			= $this->input->post('sales');
		$sts_cus		= $this->input->post('sts_cus');
		$no_ktp			= $this->input->post('no_ktp');
		$sales			= explode("+^", $sales);
		$data			= array(
			'nocust' 			=> $id_customer,
			'npwp'				=> $npwp,
			'nama_perusahaan' 	=> $perusahaan,
			'pengantin_perempuan' => $wanita,
			'pengantin_pria' 	=> $pria,
			'nama_pemesan_tunggal' => $pemesan,
			'alamat' 			=> $alamat,
			'title' 			=> $title,
			'noktp' 			=> $no_ktp,
			'tlp' 				=> $telfon1,
			'tlp2' 				=> $telfon2,
			'email1' 			=> $email1,
			'email2' 			=> $email2,
			'kota' 				=> $kota,
			'kode_pos' 			=> $kd_pos,
			'agama' 			=> $agama,
			'industry' 			=> $industri,
			'sts_aktif' 		=> $sts_cus,
			'sales' 			=> $sales[0],
			'namasales' 		=> $sales[1],
			'tgl_entry' 		=> $tgl_input,
			'bank' 				=> $nm_bank,
			'noaccount' 		=> $no_account,
			'cab_bank' 			=> $cabang,
			'ststransfer' 		=> $sts_trv,
			'insertby' 			=> $this->session->userdata('pn_name')
		);
		$this->db->where("nocust", $id_customer);
		$this->db->update("dk_master_customer", $data);

		$q = $this->db->query("select id_prospek from dk_master_customer where nocust= '$id_customer'");
		if ($q->num_rows() > 0) {
			$sss = $q->result();
			$id_prospek = $sss[0]->id_prospek;
			$data2 = array(
				'calon_pria'	=> $pria,
				'calon_wanita'	=> $wanita,
				'telfon'		=> $telfon1,
				'telfon2'		=> $telfon2,
				'email1'		=> $email1,
				'email2'		=> $email2,
				'tempat1'		=> $alamat,
				'tempat2'		=> $kota,
				'tempat3'		=> $kd_pos
			);
			$this->db->where("id_prospek", $id_prospek);
			$this->db->update("dk_prospek", $data2);
		}

		$qa = $this->db->query("select kd_penawaran from dk_master_customer where nocust= '$id_customer'");
		if ($qa->num_rows() > 0) {
			$sssa = $qa->result();
			$kd_penawaran = $sssa[0]->kd_penawaran;
			$data3 = array(
				'pengantin_pria'	=> $pria,
				'pengantin_wanita'	=> $wanita,
				'tempat_resepsi1'		=> $alamat,
				'tempat_resepsi2'		=> $kota,
				'tempat_resepsi3'		=> $kd_pos
			);
			$this->db->where("id_penawaran", $kd_penawaran);
			$this->db->update("dk_penawaran", $data3);
		}
	}

	//======================================================= GEDUNG ======================================
	function list_gedung()
	{
		$query	= $this->db->query("select * from dk_master_gedung where sts='1' order by nm_gedung");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function kd_gedung()
	{
		$q_user			= $this->db->query("select c_gedung from dk_counter");
		$ret 			= $q_user->result();
		$kd_barang		= $ret[0]->c_gedung + 1;
		$kdadd			= "";
		if (strlen($kd_barang) == 1) {
			$kdadd		= "0000";
		} else if (strlen($kd_barang) == 2) {
			$kdadd		= "000";
		} else if (strlen($kd_barang) == 3) {
			$kdadd		= "00";
		} else if (strlen($kd_barang) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$thnbln			= date("ym");
		$id				= 'G' . $thnbln . "|" . $kdadd . $kd_barang;
		return $id;
	}

	function proses_add_gedung()
	{
		$tgl_input			= $this->input->post('tgl_input');
		$id_gedung			= $this->input->post('id_gedung');
		$nm_gedung			= $this->input->post('nm_gedung');
		$alamat				= $this->input->post('alamat');
		$kota				= $this->input->post('kota');
		$kode_pos			= $this->input->post('kode_pos');
		$cp1				= $this->input->post('cp1');
		$email1				= $this->input->post('email1');
		$telp1				= $this->input->post('telp1');
		$jabatan1			= $this->input->post('jabatan1');
		$ultah1				= $this->input->post('ultah1');
		$cp2				= $this->input->post('cp2');
		$email2				= $this->input->post('email2');
		$telp2				= $this->input->post('telp2');
		$jabatan2			= $this->input->post('jabatan2');
		$ultah2				= $this->input->post('ultah2');
		$cp3				= $this->input->post('cp3');
		$email3				= $this->input->post('email3');
		$telp3				= $this->input->post('telp3');
		$jabatan3			= $this->input->post('jabatan3');
		$ultah3				= $this->input->post('ultah3');
		$lebar				= $this->input->post('lebar');
		$panjang			= $this->input->post('panjang');
		$tinggi				= $this->input->post('tinggi');
		$t_panggung			= $this->input->post('t_panggung');
		$kapasitas_ruangan	= $this->input->post('kapasitas_ruangan');
		$kapasitas_parkir	= $this->input->post('kapasitas_parkir');
		$kapasitas_listrik	= $this->input->post('kapasitas_listrik');
		$awal_siang			= $this->input->post('awal_siang');
		$akhir_siang		= $this->input->post('akhir_siang');
		$awal_malam			= $this->input->post('awal_malam');
		$akhir_malam		= $this->input->post('akhir_malam');
		$harga_siang		= $this->input->post('harga_siang');
		$harga_malam		= $this->input->post('harga_malam');
		$account			= $this->input->post('account');
		$bank				= $this->input->post('bank');
		$sts_trv			= $this->input->post('sts_trv');
		$sts_book			= $this->input->post('sts_book');
		$keterangan			= $this->input->post('keterangan');
		$fasilitas			= $this->input->post('fasilitas');
		$jam_pakai			= $this->input->post('jam_pakai');
		$persentase			= $this->input->post('persentase');
		$data				= array(
			'id'				=> $id_gedung,
			'nm_gedung'			=> $nm_gedung,
			'alamat'			=> $alamat,
			'kota'				=> $kota,
			'kode_pos'			=> $kode_pos,
			'kapasitas'			=> $kapasitas_ruangan,
			'ruangan'			=> '',
			'jenis_lokasi'		=> '',
			'fasilitas'			=> $fasilitas,
			'kapasitas_parkir'	=> $kapasitas_parkir,
			'jam_awal_siang'	=> $awal_siang,
			'jam_akhir_siang'	=> $akhir_siang,
			'jam_awal_malam'	=> $awal_malam,
			'jam_akhir_malam'	=> $akhir_malam,
			'harga_siang'		=> $harga_siang,
			'harga_malam'		=> $harga_malam,
			'listrik'			=> $kapasitas_listrik,
			'jumlah_jam_pakai'	=> $jam_pakai,
			'insert_by'			=> $this->session->userdata('pn_name'),
			'insert_date'		=> date("Y-m-d"),
			'edit_by'			=> '',
			'edit_date'			=> '',
			'cp'				=> $cp1,
			'telp1'				=> $telp1,
			'telp2'				=> $telp2,
			'email1'			=> $email1,
			'email2'			=> $email2,
			'keterangan'		=> $keterangan,
			'persentase'		=> $persentase,
			'nm_bank'			=> $bank,
			'no_account'		=> $account,
			'cab_bank'			=> '',
			'sts_transver'		=> $sts_trv,
			'sts_book'			=> $sts_book,
			'cp2'				=> $cp2,
			'cp3'				=> $cp3,
			'email3'			=> $email3,
			'telp3'				=> $telp3,
			'tinggi'			=> $tinggi,
			'lebar'				=> $lebar,
			'panjang'			=> $panjang,
			'tinggi_panggung'	=> $t_panggung,
			'ultah_cp1'			=> date("Y-m-d", strtotime($ultah1)),
			'ultah_cp2'			=> date("Y-m-d", strtotime($ultah2)),
			'ultah_cp3'			=> date("Y-m-d", strtotime($ultah3)),
			'jabatan1'			=> $jabatan1,
			'jabatan2'			=> $jabatan2,
			'jabatan3'			=> $jabatan3,
			'sts'			=> '1'
		);
		$this->db->insert("dk_master_gedung", $data);
		$id	= explode("|", $id_gedung);
		$id	= $id[1] + 0;
		$this->db->query("update dk_counter set c_gedung ='" . $id . "'");
	}

	function get_gedung($id)
	{
		$query	= $this->db->query("select * from dk_master_gedung where id='$id'");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_id_gedung($id_paket)
	{
		$query	= $this->db->query("select id_gedung from dk_master_paket where id_paket='$id_paket'");
		if ($query->num_rows() > 0) {
			$ret =  $query->result();
			return $ret[0]->id_gedung;
		} else {
			return 0;
		}
	}

	function proses_edit_gedung()
	{
		$tgl_edit			= $this->input->post('tgl_input');
		$id_gedung			= $this->input->post('id_gedung');
		$nm_gedung			= $this->input->post('nm_gedung');
		$alamat				= $this->input->post('alamat');
		$kota				= $this->input->post('kota');
		$kode_pos			= $this->input->post('kode_pos');
		$cp1				= $this->input->post('cp1');
		$email1				= $this->input->post('email1');
		$telp1				= $this->input->post('telp1');
		$jabatan1			= $this->input->post('jabatan1');
		$ultah1				= $this->input->post('ultah1');
		$cp2				= $this->input->post('cp2');
		$email2				= $this->input->post('email2');
		$telp2				= $this->input->post('telp2');
		$jabatan2			= $this->input->post('jabatan2');
		$ultah2				= $this->input->post('ultah2');
		$cp3				= $this->input->post('cp3');
		$email3				= $this->input->post('email3');
		$telp3				= $this->input->post('telp3');
		$jabatan3			= $this->input->post('jabatan3');
		$ultah3				= $this->input->post('ultah3');
		$lebar				= $this->input->post('lebar');
		$panjang			= $this->input->post('panjang');
		$tinggi				= $this->input->post('tinggi');
		$t_panggung			= $this->input->post('t_panggung');
		$kapasitas_ruangan	= $this->input->post('kapasitas_ruangan');
		$kapasitas_parkir	= $this->input->post('kapasitas_parkir');
		$kapasitas_listrik	= $this->input->post('kapasitas_listrik');
		$awal_siang			= $this->input->post('awal_siang');
		$akhir_siang		= $this->input->post('akhir_siang');
		$awal_malam			= $this->input->post('awal_malam');
		$akhir_malam		= $this->input->post('akhir_malam');
		$harga_siang		= $this->input->post('harga_siang');
		$harga_malam		= $this->input->post('harga_malam');
		$account			= $this->input->post('account');
		$bank				= $this->input->post('bank');
		$sts_trv			= $this->input->post('sts_trv');
		$sts_book			= $this->input->post('sts_book');
		$keterangan			= $this->input->post('keterangan');
		$fasilitas			= $this->input->post('fasilitas');
		$jam_pakai			= $this->input->post('jam_pakai');
		$persentase			= $this->input->post('persentase');
		$data				= array(
			'id'				=> $id_gedung,
			'nm_gedung'			=> $nm_gedung,
			'alamat'			=> $alamat,
			'kota'				=> $kota,
			'kode_pos'			=> $kode_pos,
			'kapasitas'			=> $kapasitas_ruangan,
			'ruangan'			=> '',
			'jenis_lokasi'		=> '',
			'fasilitas'			=> $fasilitas,
			'kapasitas_parkir'	=> $kapasitas_parkir,
			'jam_awal_siang'	=> $awal_siang,
			'jam_akhir_siang'	=> $akhir_siang,
			'jam_awal_malam'	=> $awal_malam,
			'jam_akhir_malam'	=> $akhir_malam,
			'harga_siang'		=> $harga_siang,
			'harga_malam'		=> $harga_malam,
			'listrik'			=> $kapasitas_listrik,
			'jumlah_jam_pakai'	=> $jam_pakai,
			'edit_by'			=> $tgl_edit,
			'edit_date'			=> $this->session->userdata('pn_name'),
			'cp'				=> $cp1,
			'telp1'				=> $telp1,
			'telp2'				=> $telp2,
			'email1'			=> $email1,
			'email2'			=> $email2,
			'keterangan'		=> $keterangan,
			'persentase'		=> $persentase,
			'nm_bank'			=> $bank,
			'no_account'		=> $account,
			'cab_bank'			=> '',
			'sts_transver'		=> $sts_trv,
			'sts_book'			=> $sts_book,
			'cp2'				=> $cp2,
			'cp3'				=> $cp3,
			'email3'			=> $email3,
			'telp3'				=> $telp3,
			'tinggi'			=> $tinggi,
			'lebar'				=> $lebar,
			'panjang'			=> $panjang,
			'tinggi_panggung'	=> $t_panggung,
			'ultah_cp1'			=> date("Y-m-d", strtotime($ultah1)),
			'ultah_cp2'			=> date("Y-m-d", strtotime($ultah2)),
			'ultah_cp3'			=> date("Y-m-d", strtotime($ultah3)),
			'jabatan1'			=> $jabatan1,
			'jabatan2'			=> $jabatan2,
			'jabatan3'			=> $jabatan3,
			'sts'			=> '1'
		);
		$this->db->where("id", $id_gedung);
		$this->db->update("dk_master_gedung", $data);
	}

	function id_salesman()
	{
		$q_user			= $this->db->query("select c_sales from dk_counter");
		$ret 			= $q_user->result();
		$kd_barang		= $ret[0]->c_sales + 1;
		$kdadd			= "";
		if (strlen($kd_barang) == 1) {
			$kdadd		= "0000";
		} else if (strlen($kd_barang) == 2) {
			$kdadd		= "000";
		} else if (strlen($kd_barang) == 3) {
			$kdadd		= "00";
		} else if (strlen($kd_barang) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$thnbln			= date("ym");
		$id				= "SA" . $kdadd . $kd_barang;
		return $id;
	}

	function proses_add_sales()
	{
		$tgl_input			= $this->input->post('tgl_input');
		$id_sales			= $this->input->post('id_sales');
		$nm_sales			= $this->input->post('nm_sales');
		$no_telp			= $this->input->post('no_telp');
		$email				= $this->input->post('email');
		$tgl_masuk			= $this->input->post('tgl_masuk');
		$pengalaman			= $this->input->post('pengalaman');
		$kategori			= $this->input->post('kategori');
		$level				= $this->input->post('level');
		$status				= $this->input->post('status');
		$sts_aktiv			= $this->input->post('sts_aktiv');
		$alamat				= $this->input->post('alamat');
		$data				= array(
			'nosales'	=> $id_sales,
			'nama'		=> $nm_sales,
			'alamat'	=> $alamat,
			'nohp'		=> $no_telp,
			'email'		=> $email,
			'tgl_masuk'	=> date("Y-m-d", strtotime($tgl_masuk)),
			'pengalaman' => $pengalaman,
			'kategori'	=> $kategori,
			'level'		=> $level,
			'status'	=> $status,
			'insert_by'	=> $this->session->userdata("pn_name"),
			'insert_date'	=> date("Y-m-d"),
			'sts_aktif'	=> $sts_aktiv
		);
		$this->db->insert("dk_master_salesman", $data);
		$id	= explode("A", $id_sales);
		$id	= $id[1] + 0;
		$this->db->query("update dk_counter set c_sales ='" . $id . "'");
	}

	function get_sales_id($id)
	{
		$query	= $this->db->query("select * from dk_master_salesman where nosales='$id'");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function proses_edit_sales()
	{
		$tgl_input			= $this->input->post('tgl_input');
		$id_sales			= $this->input->post('id_sales');
		$nm_sales			= $this->input->post('nm_sales');
		$no_telp			= $this->input->post('no_telp');
		$email				= $this->input->post('email');
		$tgl_masuk			= $this->input->post('tgl_masuk');
		$pengalaman			= $this->input->post('pengalaman');
		$kategori			= $this->input->post('kategori');
		$level				= $this->input->post('level');
		$status				= $this->input->post('status');
		$sts_aktiv			= $this->input->post('sts_aktiv');
		$alamat				= $this->input->post('alamat');
		$data				= array(
			'nosales'	=> $id_sales,
			'nama'		=> $nm_sales,
			'alamat'	=> $alamat,
			'nohp'		=> $no_telp,
			'email'		=> $email,
			'tgl_masuk'	=> date("Y-m-d", strtotime($tgl_masuk)),
			'pengalaman' => $pengalaman,
			'kategori'	=> $kategori,
			'level'		=> $level,
			'sts_aktif'	=> $sts_aktiv,
			'status'	=> $status,
			'insert_by'	=> $this->session->userdata("pn_name"),
			'insert_date'	=> date("Y-m-d"),
			'sts_aktif'	=> $sts_aktiv
		);
		$this->db->where("nosales", $id_sales);
		$this->db->update("dk_master_salesman", $data);
	}

	//=============================================== Vendor ===========================================
	function get_vendor()
	{
		$query	= $this->db->query("select * from dk_master_vendor");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_data_vendor($idaa)
	{
		$query	= $this->db->query("select * from dk_master_vendor where id='$idaa'");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_jenis()
	{
		$query	= $this->db->query("select * from dk_jenis_vendor where sts='1'");
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function proses_add_vendor()
	{
		$q_user			= $this->db->query("select c_vendor from dk_counter");
		$ret 			= $q_user->result();
		$kd_barang		= $ret[0]->c_vendor + 1;
		$kdadd			= "";
		if (strlen($kd_barang) == 1) {
			$kdadd		= "0000";
		} else if (strlen($kd_barang) == 2) {
			$kdadd		= "000";
		} else if (strlen($kd_barang) == 3) {
			$kdadd		= "00";
		} else if (strlen($kd_barang) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$thnbln			= date("ym");
		$id				= $thnbln . "|" . $kdadd . $kd_barang;
		$nm_vendor		= $this->input->post('nm_vendor');
		$jenis			= $this->input->post('jenis');
		$alamat			= $this->input->post('alamat');
		$telp1			= $this->input->post('telp1');
		$telp2			= $this->input->post('telp2');
		$email1			= $this->input->post('email1');
		$email2			= $this->input->post('email2');
		$pic			= $this->input->post('pic');
		$keterangan		= $this->input->post('keterangan');
		$sts			= $this->input->post('sts');
		$data			= array(
			'id'			=> $id,
			'nm_vendor'		=> $nm_vendor,
			'jenis_vendor'	=> $jenis,
			'alamat'		=> $alamat,
			'telp1'			=> $telp1,
			'telp2'			=> $telp2,
			'email1'		=> $email1,
			'email2'		=> $email2,
			'pic'			=> $pic,
			'keterangan'	=> $keterangan,
			'sts'			=> $sts,
			'insert_by'		=> $this->session->userdata('pn_name'),
			'insert_date'	=> date("Y-m-d")
		);
		$this->db->insert("dk_master_vendor", $data);
		$id	= explode("|", $id);
		$id	= $id[1] + 0;
		$this->db->query("update dk_counter set c_vendor ='" . $id . "'");
	}

	public function get_kategori_det($id_cust, $r)
	{
		$query 	= "select nm_keterangan,jumlah, nm_sfesifikasi from dk_kategori_detail where id_paket='$id_cust' and id_area='$r' and nm_keterangan != '' and no!='1' order by no";
		$q 		= $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return Null;
		}
	}

	public function get_kategori_detx($id_cust, $r)
	{
		$query 	= "select nm_keterangan,jumlah, nm_sfesifikasi from dk_kategori_detail where id_paket='$id_cust' and id_area='$r' and nm_keterangan != '' and no='1' order by no";
		$q 		= $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return Null;
		}
	}

	function proses_edit_vendor()
	{
		$id_ven		= $this->input->post('id_ven');
		$nm_vendor		= $this->input->post('nm_vendor');
		$jenis			= $this->input->post('jenis');
		$alamat			= $this->input->post('alamat');
		$telp1			= $this->input->post('telp1');
		$telp2			= $this->input->post('telp2');
		$email1			= $this->input->post('email1');
		$email2			= $this->input->post('email2');
		$pic			= $this->input->post('pic');
		$keterangan		= $this->input->post('keterangan');
		$sts			= $this->input->post('sts');
		$data			= array(
			'nm_vendor'		=> $nm_vendor,
			'jenis_vendor'	=> $jenis,
			'alamat'		=> $alamat,
			'telp1'			=> $telp1,
			'telp2'			=> $telp2,
			'email1'		=> $email1,
			'email2'		=> $email2,
			'pic'			=> $pic,
			'keterangan'	=> $keterangan,
			'sts'			=> $sts,
			'insert_by'		=> $this->session->userdata('pn_name'),
			'insert_date'	=> date("Y-m-d")
		);
		$this->db->where("id", $id_ven);
		$this->db->update("dk_master_vendor", $data);
	}

	public function proses_add_area()
	{
		if ($this->input->post('nm_area') != '') {
			$this->db->query("insert into dk_area (nm_area,jum)values('" . $this->input->post('nm_area') . "','8')");
		}
	}

	//=============================================== Event ===========================================	

	public function get_list_event()
	{
		$query	= "select * from dk_event";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_menu()
	{

		$query	= "SELECT * from master_menu_erp";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_field_menu()
	{

		$query	= "SELECT * from master_menu_field_erp";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
