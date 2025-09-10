<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}

        $this->load->library('session');
        $this->session->userdata('pn_name');

		$this->load->model('order_model');
		$this->load->model('master_model');
		$this->load->model('invoice_model');
		$this->load->model('komisi_model');
		$this->load->helper('menu');
	}
	
	public function index(){
		$this->prospecting();
	}

	function tes_id_log(){
		$jodohin_tabel 			= $this->order_model->jodohin_tbl_penawaran();
		if($jodohin_tabel > 0){
			foreach($jodohin_tabel as $r_nawar){
				$log_id 		= $r_nawar->id_log;
				$penawaran_id 	= $r_nawar->id_penawaran;

				$this->db->query("UPDATE dk_penawaran_dekor_log_history set id_log='$log_id' where id_penawaran='$penawaran_id'");
			}
		}		

		echo "sukses";
		exit;

	}

	function log_edit_req_use(){
		$data['judul']			= "Log Perubahan SPD";
		$data['id_penawaran']	= str_replace('_','|',$this->uri->segment(3));
		$data['id_prospek']		= $this->uri->segment(4);
		$data['tgl_spd']		= str_replace('_','-',$this->uri->segment(5));
		$penganten				= str_replace('_',' ',$this->uri->segment(6));
		$data['penganten']		= str_replace('%',' & ',$penganten);
		$id_penawaran			= $this->uri->segment(3);
		$id_penawaran			= str_replace('_','|',$id_penawaran);
		$jenis_paket 			= $this->order_model->get_jenis_paket($id_penawaran);
		//$data['list_barang_paket'] = $this->order_model->get_all_use_paket($id_penawaran,$jenis_paket);
		$data['list_barang_non_paket']	= $this->order_model->get_all_use_non_paket($id_penawaran);
		//$data['list_barang_add'] = $this->order_model->get_all_use_tambahan2($id_penawaran);
		$data['list_kategori']			= $this->order_model->get_barang();
		$data['list_area']				= $this->order_model->get_area();

		$data_before			= $this->order_model->get_before($id_penawaran);
		if($data_before > 0){
			$data['data_before']			= $this->order_model->get_before($id_penawaran);	
			$data['data_after']				= $this->order_model->get_after($id_penawaran);
		}else{
			$data['data_before']			= $this->order_model->get_all_use_non_paket($id_penawaran);
			$data['data_after']				= $this->order_model->get_after($id_penawaran);
		}
		$this->load->view("order/v_log_edit_request_use",$data);
	}

	function log_spd(){
		$data['judul']		= "Log Perubahan SPD";
		$data['list_spd']	= $this->order_model->get_spd();
		$data['jenis']		= "barang";
		$this->load->view("order/v_list_log_spd",$data);
	}
	
	public function input(){
		$data['judul']				= "Input Prospecting";
		$data['data_ref']			= $this->order_model->get_ref();
		$data['data_event']			= $this->order_model->get_event();
		$data['data_sosmed']		= $this->order_model->get_sosmed();
		$data['data_competitor']	= $this->order_model->get_competitor();
		$data['data_marketing']		= $this->order_model->get_marketing();
		$data['data_reason_cancel']	= $this->order_model->get_reason_cancel();
		$data['data_reason_lost_order']	= $this->order_model->get_reason_lost_order();
		$this->load->view('order/v_input_prospecting',$data);
	}
	
	public function proses_input_prospek(){
		$this->order_model->proses_input_prospek();
		$kd_prospek	= $this->input->post('kd_prospek');
		redirect("order/prospecting");
	}
	
	public function proses_edit_prospek(){
		$this->order_model->proses_edit_prospek();
		redirect("order/prospecting");
	}
	
	public function buat_penawaran(){
		$id			 		= $this->uri->segment(3);
		$data_prospek		= $this->order_model->get_prospek($id);
		$data['judul'] 		= "Input Penawaran";
		foreach($data_prospek as $row){
			$data['kd_prospek'] = $id;
			$data['pria'] 		= $row->calon_pria;
			$data['wanita'] 	= $row->calon_wanita;
			$data['telfon'] 	= $row->telfon;
			$data['telfon2'] 	= $row->telfon2;
			$data['email'] 		= $row->email1;
			$data['email2'] 	= $row->email2;
			$data['tgl_resepsi'] = $row->resepsi_date;
			$data['jam_resepsi'] = $row->resepsi_jam;
			$data['tempat1'] 	= $row->tempat1;
			$data['tempat2'] 	= $row->tempat2;
			$data['tempat3'] 	= $row->tempat3;
			$data['tempat_resepsi'] 	= $row->tempat_resepsi;
		}
		$data['list_kategori']	= $this->order_model->get_barang();
		$this->load->view('order/v_create_penawaran',$data);
	}
	
	public function edit_penawaran(){
		$data['judul']			= "Edit Penawaran";
		$id			 			= $this->uri->segment(3);
		$data_prospek			= $this->order_model->get_prospek($id);
		$data['data_penawaran']	= $this->order_model->get_penawaran($id);
		foreach($data_prospek as $row){
			$data['kd_prospek'] = $id;
			$data['pria'] 		= $row->calon_pria;
			$data['wanita'] 	= $row->calon_wanita;
			$data['telfon'] 	= $row->telfon;
			$data['telfon2'] 	= $row->telfon2;
			$data['email'] 		= $row->email1;
			$data['email2'] 	= $row->email2;
			$data['tgl_resepsi'] = $row->resepsi_date;
			$data['jam_resepsi'] = $row->resepsi_jam;
			$data['tempat1'] 	= $row->tempat1;
			$data['tempat2'] 	= $row->tempat2;
			$data['tempat3'] 	= $row->tempat3;
			$data['tempat_resepsi'] 	= $row->tempat_resepsi;
		}
		$data['id_prospek'] 	= $id;
		$data['inc_gedung'] 	= $this->order_model->inc_gedung($id);
		$data['list_kategori']	= $this->order_model->get_barang();
		$this->load->view('order/v_edit_penawaran',$data);
	}
	
	function search(){
		/* $dbHost = 'localhost';
		$dbUsername = 'root';
		$dbPassword = '';
		$dbName = 'db_master';
		$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
		//get search term */
		$searchTerm = $_GET['term'];
		//get matched data from skills table
		$query = $this->db->query("SELECT * FROM dk_master_kategori WHERE nm_keterangan LIKE '%".$searchTerm."%' ORDER BY nm_keterangan ASC");
		$query = $query->result();
		/* if($query->num_rows() > 0){ */
			foreach ($query as $row) {
				$data[] = $row->nm_keterangan;
			}
		/* } */
		echo json_encode($data);
	}
	
	function search2(){
		/* $dbHost = 'localhost';
		$dbUsername = 'root';
		$dbPassword = '';
		$dbName = 'db_master';
		$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
		//get search term */
		$searchTerm = $_GET['term'];
		//get matched data from skills table
		$query = $this->db->query("SELECT nm_gedung FROM dk_master_gedung WHERE nm_gedung LIKE '%".$searchTerm."%' ORDER BY nm_gedung ASC");
		$query = $query->result();
		/* if($query->num_rows() > 0){ */
			foreach ($query as $row) {
				$data[] = $row->nm_gedung;
			}
		/* } */
		echo json_encode($data);
	}
	
	function tessss(){
		$datas = "11111";
		$json_format = json_encode($datas);
		echo $json_format;
	}
	
	function cari_harga(){
		$nama = $this->input->get('option');
		$id = $this->input->get('option2');
		$id2 = $this->input->get('option3');
		$harga = $this->master_model->get_harga_barang($nama);
		echo "<input type='text' class='form-control' onchange='return hitung_ulang($id2,$id)' id='harganyax_$id2' value='$harga' onkeypress='return isNumber(event)' name='areax_".$id."_harga[]'>";
		echo "<input type='hidden' class='form-control' readonly id='harganya_$id2' value='$harga' onkeypress='return isNumber(event)' name='area_".$id."_harga[]'>"; 
		//echo $this->db->last_query();
	}
	
	function cari_hargax(){
		$id = $this->input->get('option2');
		$id2 = $this->input->get('option3');
		echo "<input type='text' class='form-control' onchange='return hitung_ulang($id2)' id='harganyax_$id2' value='0' onkeypress='return isNumber(event)' name='areax_".$id."_harga[]'>";
		echo "<input type='hidden' class='form-control' id='harganya_$id2' value='0' onkeypress='return isNumber(event)' name='area_".$id."_harga[]'>"; 
		//echo $this->db->last_query();
	}
	
	function cari_harga_tambah(){
		$nama = $this->input->get('option');
		$id = $this->input->get('option2');
		$id2 = $this->input->get('option3');
		$tambah = $this->input->get('option4');
		$harga = $this->master_model->get_harga_barang($nama);
		$tot_tambah = $tambah + $harga;
		echo "<input readonly placeholder='Rp.' id='harga_tambahanx' type='hidden' value='".number_format($tot_tambah)."'>";
		echo "<input onkeypress='return isNumber(event)' onchange='return hitung()' readonly placeholder='Rp.' type='hidden' name='harga_tambahan' id='harga_tambahan' value='".($tot_tambah)."'>";
	}
	
	function cari_harga_tambah2(){
		$nama 			= $this->input->get('option');
		$id 			= $this->input->get('option2');
		$id2 			= $this->input->get('option3');
		$tambah 		= $this->input->get('option4');
		$discount 		= $this->input->get('option5');
		$harga_paket 	= $this->input->get('option6');
		$harga 			= $this->master_model->get_harga_barang($nama);
		$tot_tambah 	= $tambah + $harga;
		$total 			= $harga_paket + $tot_tambah;
		$total_discount = ($harga_paket + $tot_tambah)*$discount/100;
		$grond_total	= $total - $total_discount;
		echo "<input onkeypress='return isNumber(event)' readonly placeholder='Rp.' type='hidden' name='total' id='total' value='$grond_total'>";
		echo "<input  readonly placeholder='Rp.' type='text' name='totalx2' id='totalx2' value='".number_format($grond_total)."'>";
	}
	
	function cari_harga_disk(){
		$nama 			= $this->input->get('option');
		$id 			= $this->input->get('option2');
		$id2 			= $this->input->get('option3');
		$tambah 		= $this->input->get('option4');
		$discount 		= $this->input->get('option5');
		$harga_paket 	= $this->input->get('option6');
		$harga 			= $this->master_model->get_harga_barang($nama);
		$tot_tambah 	= $tambah + $harga;
		$total 			= $harga_paket + $tot_tambah;
		$total_discount = ($harga_paket + $tot_tambah)*$discount/100;
		$grond_total	= $total - $total_discount;
		echo "<input  readonly placeholder='Rp.' type='text' name='totalapp' id='totalapp' value='".number_format($grond_total)."'>";
	}
	
	public function input_data_customer(){
		$data['kd_prospek'] = $this->input->get('option');
		$kd_prospek 		= $this->input->get('option');
		$id1 				= $this->input->get('option1');
		$id2 				= $this->input->get('option2');
		if(strlen($id2)==1){
			$kdadd		= "0000";
		}else if(strlen($id2)==2){
			$kdadd		= "000";
		}else if(strlen($id2)==3){
			$kdadd		= "00";
		}else if(strlen($id2)==4){
			$kdadd		= "0";
		}else{
			$kdadd		= '0';
		}
		$id_penawaran 			= "P".$id1."|".$kdadd.$id2;
		$data['kd_penawaran']	= $id_penawaran;
		$data['data_penawaran']	= $this->order_model->edit_penawaran($id_penawaran);
		$jenis_paket			= $this->order_model->get_jenis_penawaran($id_penawaran);
		$data['data_kategori'] 	= $this->master_model->get_kategori($jenis_paket);
		$data['no_cust']	= $this->master_model->get_id_cust();
		$opt_data 			= $this->input->get('opt_data');
		$data['pria'] 		= $opt_data['pria'];
		$data['wanita'] 	= $opt_data['wanita'];
		$data['telfon'] 	= $opt_data['telfon'];
		$data['telfon2'] 	= $opt_data['telfon2'];
		$data['email'] 		= $opt_data['email'];
		$data['email2'] 	= $opt_data['email2'];
		$data['tgl_resepsi'] = $opt_data['tgl_resepsi'];
		$data['jam_resepsi'] = $opt_data['jam_resepsi'];
		$data['tempat1'] 	= $opt_data['tempat1'];
		$data['tempat2'] 	= $opt_data['tempat2'];
		$data['tempat3'] 	= $opt_data['tempat3'];
		$this->load->view('order/v_input_customer',$data);
	}
	
	public function get_paket(){
		$kd_prospek = $this->input->get('option');
		$data['data_kategori'] = $this->master_model->get_kategori($kd_prospek);
		$this->load->view('order/v_paket_pros',$data);
	}
	
	public function prospecting(){
		$data['judul']			= "Daftar Prospek"; 
		$data['data_prospek'] 	= $this->order_model->get_data_prospek();
		$this->load->view('order/v_list_prospek',$data);
	}
	
	public function save_penawaran(){
		$q = $this->db->query("select c_penawaran from dk_counter");
		if($q->num_rows() > 0){
			$ret = $q->result();
			$kode			= $ret[0]->c_penawaran+1;
			if(strlen($kode)==1){
				$kdadd		= "0000";
			}else if(strlen($kode)==2){
				$kdadd		= "000";
			}else if(strlen($kode)==3){
				$kdadd		= "00";
			}else if(strlen($kode)==4){
				$kdadd		= "0";
			}else{
				$kdadd		= '0';
			}
			$kd_penawaran	= "P".date("Y")."|".$kdadd.$kode;
		}
		
		$jum 			= $this->input->post('jum_area');
		$id_area_		= $this->input->post('id_area_');
		$id_penawaran 	= $kd_penawaran;
		$totapp 		= str_replace(",","",str_replace(".","",$this->input->post('totalapp')));
		$discountapp 	= str_replace(",","",str_replace(".","",$this->input->post('discountxx')));
		$this->db->query("update dk_prospek set sts_progres='Sudah Diberi Penawaran', edit_date='".date("Y-m-d")."' where id_prospek='".$this->input->post('id_prospek')."'");
		
		$app_diskon = '0';
		
		$harga_paket_tot = str_replace(",","",str_replace(".","",$this->input->post('harga')));
		$harga_deal		 = str_replace(",","",str_replace(".","",$this->input->post('harga_deal')));
		$harga_tot 		= str_replace(",","",str_replace(".","",$this->input->post('total')));
		$harga_totx2 		= str_replace(",","",str_replace(".","",$this->input->post('totalx2')));
		$tambahan_tot 	= str_replace(",","",str_replace(".","",$this->input->post('harga_tambahan')));
		$discount_tot 	= str_replace("%","",$this->input->post('discount'));
		$harga_net 		= str_replace(",","",str_replace(".","",$this->input->post('harga_net')));
		
		$jenis_paket		= $this->input->post('jenis_paket');
		$data	= array(
			'id_penawaran' 			=> $kd_penawaran,
			'id_prospek' 			=> $this->input->post('id_prospek'),
			'input_date' 			=> date("Y-m-d"),
			'pengantin_pria' 		=> $this->input->post('pria'),
			'pengantin_wanita' 		=> $this->input->post('wanita'),
			'tanggal_respsi' 		=> $this->input->post('tgl_resepsi'),
			'jam_resepsi' 			=> $this->input->post('jam_resepsi'),
			'color_tone' 			=> $this->input->post('color_tone'),
			'tema' 					=> $this->input->post('tema'),
			'tempat_resepsi1' 		=> $this->input->post('alamat'),
			'tempat_resepsi2' 		=> $this->input->post('kota'),
			'tempat_resepsi3' 		=> $this->input->post('tempat3'),
			'tempat1' 				=> $this->input->post('aaaaa'),
			'alamat1' 				=> $this->input->post('tempat1'),
			'provinsi1' 			=> $this->input->post('provinsi'),
			'kota1' 				=> $this->input->post('tempat2'),
			'panjang1' 				=> $this->input->post('panjang1'),
			'tinggi1' 				=> $this->input->post('tinggi1'),
			'lebar1' 				=> $this->input->post('lebar1'),
			't_panggung1' 			=> $this->input->post('t_panggung1'),
			'jenis_paket' 			=> $this->input->post('jenis_paket'),
			'inc_gedung' 			=> $this->input->post('inc_gedung'),
			'harga_paket' 			=> $harga_paket_tot,
			'tambahan_paket' 		=> $tambahan_tot,
			'discount' 				=> $discount_tot,
			'harga' 				=> $harga_tot,
			'harga_deal'			=> $harga_deal, 
			'pajak'					=> $this->input->post('pajak'),
			'komisi_gedung'			=> $this->input->post('komisi_gedung'),
			'harga_net'				=> $harga_net,
			'app_diskon' 			=> $app_diskon,
			'diskon_app' 			=> $discountapp,
			'harga_app' 			=> $totapp,
			'input_by' 				=> $this->session->userdata('pn_name')
		);
		
		$this->db->query("update dk_counter set c_penawaran = c_penawaran+1");
		$this->db->insert("dk_penawaran",$data);
		$this->db->insert("dk_penawaran_log_awal",$data);
		$this->db->insert("dk_penawaran_log_history",$data);
		//untuk memasukan kedalam dk_penawaran_dekor
		for($i=1;$i<=$jum;$i++){
			$nm_ket		= $this->input->post('area_'.$i.'_ket');
			$sfc		= $this->input->post('area_'.$i.'_sfc');
			$hargax		= $this->input->post('areax_'.$i.'_harga');
			$harga		= $this->input->post('area_'.$i.'_harga');
			$paket		= $this->input->post('paket_'.$i.'_harga');
			$nama		= $this->input->post('area_'.$i.'_nama');
			$h = $i-1;
			for($j=0;$j<count($nm_ket);$j++){
				if($nm_ket[$j] != ""){
					if($paket[$j] == "p"){
						$tambahan = "N";
					}else{
						$tambahan = "Y";
					}
					$data_d	= array(
						'id_area'		=> $id_area_[$h],
						'nm_area'		=> $nama[0],
						'keterangan'	=> $nm_ket[$j],
						'spesifikasi'	=> $sfc[$j],
						'harga'			=> $harga[$j],
						'no'			=> $j,
						'id_penawaran'	=> $kd_penawaran,
						'id_prospek'	=> $this->input->post('id_prospek'),
						'tambahan'		=> $tambahan
					);

					$this->db->insert("dk_penawaran_dekor",$data_d);
					$this->db->insert("dk_penawaran_dekor_log_awal",$data_d);

					$jodohin_tabel 			= $this->order_model->jodohin_tbl_penawaran();
						if($jodohin_tabel > 0){
							foreach($jodohin_tabel as $r_nawar){
								$log_id 		= $r_nawar->id_log;
								$penawaran_id 	= $r_nawar->id_penawaran;
							}
						}		

					$data_h	= array(
						'id_area'		=> $id_area_[$h],
						'nm_area'		=> $nama[0],
						'keterangan'	=> $nm_ket[$j],
						'spesifikasi'	=> $sfc[$j],
						'harga'			=> $harga[$j],
						'no'			=> $j,
						'id_penawaran'	=> $kd_penawaran,
						'id_prospek'	=> $this->input->post('id_prospek'),
						'tambahan'		=> $tambahan,
						'id_log'		=> $log_id
					);
					$this->db->insert("dk_penawaran_dekor_log_history",$data_h);
				}
			}
		}
		
		$id_gedung	= $this->order_model->get_id_gedung($jenis_paket);
		if($id_gedung > 0){
			foreach($id_gedung as $row){
				$id			= $row->id_gedung;
				$nm_gedung	= $row->nm_gedung;
			}
		}else{
				$id			= "";
				$nm_gedung	= "";
		}
		
		$data2	= array(
					'id_penawaran'		=> $kd_penawaran,
					'id_prospek'		=> $this->input->post('id_prospek'),
					'id_gedung'			=> $id,
					'nm_gedung'			=> $nm_gedung,
					'tanggal_resepsi'	=> $this->input->post('tgl_resepsi'),
					'jam_resepsi'		=> $this->input->post('jam_resepsi'),
					'inc_gedung'		=> $this->input->post('inc_gedung'),
					'insert_date'		=> date("Y-m-d")
					);
		$this->db->insert("dk_komisi_gedung",$data2);
		redirect("order/prospecting");
	}
	
	public function save_penawaran_edit(){
		$id_penawaran 	= $this->input->post('kd_penawaran');
		$totapp 		= str_replace(",","",str_replace(".","",$this->input->post('totalapp')));
		$discountapp 	= str_replace(",","",str_replace(".","",$this->input->post('discountxx')));
		
		$app_diskon = '0';
		
		$harga_paket_tot = str_replace(",","",str_replace(".","",$this->input->post('harga')));
		$harga_tot 		= str_replace(",","",str_replace(".","",$this->input->post('total')));
		$harga_deal		 = str_replace(",","",str_replace(".","",$this->input->post('harga_deal')));
		$tambahan_tot 	= str_replace(",","",str_replace(".","",$this->input->post('harga_tambahan')));
		$discount_tot 	= str_replace("%","",$this->input->post('discount'));
		$harga_net 		= str_replace(",","",str_replace(".","",$this->input->post('harga_net')));
		$harga_akhir 		= str_replace(",","",str_replace(".","",$this->input->post('totalx2')));
		$data	= array(
				'id_penawaran' 			=> $this->input->post('kd_penawaran'),
				'id_prospek' 			=> $this->input->post('id_prospek'),
				'input_date' 			=> date("Y-m-d"),
				'pengantin_pria' 		=> $this->input->post('pria'),
				'pengantin_wanita' 		=> $this->input->post('wanita'),
				'tanggal_respsi' 		=> $this->input->post('tgl_resepsi'),
				'jam_resepsi' 			=> $this->input->post('jam_resepsi'),
				'color_tone' 			=> $this->input->post('color_tone'),
				'tema' 					=> $this->input->post('tema'),
				'tempat_resepsi1' 		=> $this->input->post('alamat'),
				'tempat_resepsi2' 		=> $this->input->post('kota'),
				'tempat_resepsi3' 		=> $this->input->post('tempat3'),
				'tempat1' 				=> $this->input->post('aaaaa'),
				'alamat1' 				=> $this->input->post('tempat1'),
				'provinsi1' 			=> $this->input->post('provinsi'),
				'kota1' 				=> $this->input->post('tempat2'),
				'panjang1' 				=> $this->input->post('panjang1'),
				'tinggi1' 				=> $this->input->post('tinggi1'),
				'lebar1' 				=> $this->input->post('lebar1'),
				't_panggung1' 			=> $this->input->post('t_panggung1'),
				'jenis_paket' 			=> $this->input->post('jenis_paket'),
				'inc_gedung' 			=> $this->input->post('inc_gedung'),
				'harga_paket' 			=> $harga_paket_tot,
				'tambahan_paket' 		=> $tambahan_tot,
				'discount' 				=> $discount_tot,
				'harga' 				=> $harga_akhir,
				'harga_deal'			=> $harga_deal,
				'pajak'					=> $this->input->post('pajak'),
				'komisi_gedung'			=> $this->input->post('komisi_gedung'),
				'harga_net'				=> $harga_net,
				'app_diskon' 			=> $app_diskon,
				'diskon_app' 			=> $discountapp,
				'harga_app' 			=> $totapp,
				'input_by' 				=> $this->session->userdata('pn_name')
		);
		$this->db->where("id_penawaran",$this->input->post('kd_penawaran'));
		$this->db->update("dk_penawaran",$data);

		$data_h1	= array(
			'id_penawaran' 			=> $this->input->post('kd_penawaran'),
				'id_prospek' 			=> $this->input->post('id_prospek'),
				'input_date' 			=> date("Y-m-d"),
				'pengantin_pria' 		=> $this->input->post('pria'),
				'pengantin_wanita' 		=> $this->input->post('wanita'),
				'tanggal_respsi' 		=> $this->input->post('tgl_resepsi'),
				'jam_resepsi' 			=> $this->input->post('jam_resepsi'),
				'color_tone' 			=> $this->input->post('color_tone'),
				'tema' 					=> $this->input->post('tema'),
				'tempat_resepsi1' 		=> $this->input->post('alamat'),
				'tempat_resepsi2' 		=> $this->input->post('kota'),
				'tempat_resepsi3' 		=> $this->input->post('tempat3'),
				'tempat1' 				=> $this->input->post('aaaaa'),
				'alamat1' 				=> $this->input->post('tempat1'),
				'provinsi1' 			=> $this->input->post('provinsi'),
				'kota1' 				=> $this->input->post('tempat2'),
				'panjang1' 				=> $this->input->post('panjang1'),
				'tinggi1' 				=> $this->input->post('tinggi1'),
				'lebar1' 				=> $this->input->post('lebar1'),
				't_panggung1' 			=> $this->input->post('t_panggung1'),
				'jenis_paket' 			=> $this->input->post('jenis_paket'),
				'inc_gedung' 			=> $this->input->post('inc_gedung'),
				'harga_paket' 			=> $harga_paket_tot,
				'tambahan_paket' 		=> $tambahan_tot,
				'discount' 				=> $discount_tot,
				'harga' 				=> $harga_akhir,
				'harga_deal'			=> $harga_deal,
				'pajak'					=> $this->input->post('pajak'),
				'komisi_gedung'			=> $this->input->post('komisi_gedung'),
				'harga_net'				=> $harga_net,
				'app_diskon' 			=> $app_diskon,
				'diskon_app' 			=> $discountapp,
				'harga_app' 			=> $totapp,
				'input_by' 				=> $this->session->userdata('pn_name'),
			'edited' 				=> "Y",
			'waktu'					=> date('Y-m-d H:i:s')
	);

		$this->db->insert("dk_penawaran_log_history",$data_h1);
		
		$this->db->where("id_penawaran",$id_penawaran);
		$this->db->delete("dk_penawaran_dekor");
		$jum 			= $this->input->post('jum_area');
		$id_area_		= $this->input->post('id_area_');
		for($i=1;$i<=$jum;$i++){
			$nm_ket		= $this->input->post('area_'.$i.'_ket');
			$sfc		= $this->input->post('area_'.$i.'_sfc');
			$hargax		= $this->input->post('areax_'.$i.'_harga');
			$harga		= $this->input->post('area_'.$i.'_harga');
			$paket		= $this->input->post('paket_'.$i.'_harga');
			$nama		= $this->input->post('area_'.$i.'_nama');
			$h = $i-1;
			for($j=0;$j<count($nm_ket);$j++){
				if($nm_ket[$j] != ""){
					if($paket[$j] == "p"){
						$tambahan = "N";
					}else{
						$tambahan = "Y";
					}
					$data_d	= array(
						'id_area'		=> $id_area_[$h],
						'nm_area'		=> $nama[0],
						'keterangan'	=> $nm_ket[$j],
						'spesifikasi'	=> $sfc[$j],
						'harga'			=> $harga[$j],
						'no'			=> $j,
						'id_penawaran'	=> $this->input->post('kd_penawaran'),
						'id_prospek'	=> $this->input->post('id_prospek'),
						'tambahan'		=> $tambahan
					);

                		//echo "<br>id_area".$id_area_[$i];
						//echo "nm_area".$nama[0];
						//echo "keterangan".$nm_ket[$j];
						//echo "spesifikasi".$sfc[$j];
					
					$this->db->insert("dk_penawaran_dekor",$data_d);

					$jodohin_tabel 			= $this->order_model->jodohin_tbl_penawaran();
					if($jodohin_tabel > 0){
						foreach($jodohin_tabel as $r_nawar){
							$log_id 		= $r_nawar->id_log;
							$penawaran_id 	= $r_nawar->id_penawaran;
						}
					}		

				$data_h2	= array(
					'id_area'		=> $id_area_[$h],
						'nm_area'		=> $nama[0],
						'keterangan'	=> $nm_ket[$j],
						'spesifikasi'	=> $sfc[$j],
						'harga'			=> $harga[$j],
						'no'			=> $j,
						'id_penawaran'	=> $this->input->post('kd_penawaran'),
						'id_prospek'	=> $this->input->post('id_prospek'),
						'tambahan'		=> $tambahan,
					'id_log'		=> $log_id
				);
				$this->db->insert("dk_penawaran_dekor_log_history",$data_h2);
				}
			}
		}
		
		$jenis_paket 	= $this->input->post('jenis_paket');
		$id_gedung	= $this->order_model->get_id_gedung($jenis_paket);
		if($id_gedung > 0){
			foreach($id_gedung as $row){
				$id			= $row->id_gedung;
				$nm_gedung	= $row->nm_gedung;
			}
		}else{
				$id			= "";
				$nm_gedung	= "";
		}
		$data2	= array(
					'id_penawaran'		=> $this->input->post('kd_penawaran'),
					'id_prospek'		=> $this->input->post('id_prospek'),
					'id_gedung'			=> $id,
					'nm_gedung'			=> $nm_gedung,
					'tanggal_resepsi'	=> $this->input->post('tgl_resepsi'),
					'jam_resepsi'		=> $this->input->post('jam_resepsi'),
					'inc_gedung'		=> $this->input->post('inc_gedung')
					);
		$this->db->where("id_penawaran",$this->input->post('kd_penawaran'));
		$this->db->where("id_prospek",$this->input->post('id_prospek'));
		$this->db->update("dk_komisi_gedung",$data2);
		redirect("order/prospecting");
	}
	
	public function save_spd_edit(){
		echo "<div class=\"alert alert-success alert-dismissible\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                <h4><i class=\"icon fa fa-check\"></i> warning!</h4>
                Update SPD berhasil, silahkan close form ini.
              </div>";
		$id_penawaran 	= $this->input->post('kd_penawaran');
		$nm_barang 	= $this->input->post('nm_barang');
		$qty 		= $this->input->post('qty');
		$area 		= $this->input->post('area');
		
		$this->db->where("id_penawaran",$id_penawaran);
		$this->db->delete("dk_penawaran_tambahan");
		
		for($j=0;$j<count($nm_barang);$j++){
			if($nm_barang[$j] != '0'){
				$barang		= explode("+^",$nm_barang[$j]);
				$nm_baranga	= $barang[1];
				$id_baranga	= $barang[0];
				$data_barang = array(
							'id_barang'		=> $id_baranga,
							'id_penawaran'	=> $id_penawaran,
							'nm_barang'		=> $nm_baranga,
							'jumlah'		=> $qty[$j],
							'keterangan'	=> $area[$j],
							'sts'			=> "inc"			
				);
				$this->db->insert("dk_penawaran_tambahan",$data_barang);
			}
		}
		
		$kategori 	= $this->input->post('kategori');
		$this->db->where("id_penawaran",$id_penawaran);
		$this->db->delete("dk_penawaran_kategori");		
		for($i=0;$i<count($kategori);$i++){
			if(substr($kategori[$i],0,1) == '1'){
				$data_inc = array(
							'id_kategori'	=> substr($kategori[$i],1),
							'id_penawaran'	=> $id_penawaran,
							'sts'			=> "no"			
				);
				$this->db->insert("dk_penawaran_kategori",$data_inc);
			}
		}
		
		$inc_barang 	= $this->input->post('inc_barang');
		for($i=0;$i<count($inc_barang);$i++){
			if(substr($inc_barang[$i],0,1) == '1'){
				$data_inc = array(
							'id_barang'		=> substr($inc_barang[$i],1),
							'id_penawaran'	=> $id_penawaran,
							'sts'			=> "min"			
				);
				$this->db->insert("dk_penawaran_tambahan",$data_inc);
			}
		}
		$data	= array(
		'id_penawaran' 		=> $this->input->post('kd_penawaran'),
		'id_prospek' 		=> $this->input->post('id_prospek'),
		'input_date' 		=> date("Y-m-d",strtotime($this->input->post('tgl_input'))),
		'pengantin_pria' 	=> $this->input->post('pria'),
		'pengantin_wanita' 	=> $this->input->post('wanita'),
		'tanggal_respsi' 	=> date("Y-m-d",strtotime($this->input->post('tgl_resepsi'))),
		'jam_resepsi' 		=> $this->input->post('jam_resepsi'),
		'color_tone' 		=> $this->input->post('color_tone'),
		'tema' 				=> $this->input->post('tema'),
		'tempat_resepsi1' 	=> $this->input->post('tempat1a'),
		'tempat_resepsi2' 	=> $this->input->post('tempat2'),
		'tempat_resepsi3' 	=> $this->input->post('tempat3'),
		'tempat1' 			=> $this->input->post('aaaaa'),
		'alamat1' 			=> $this->input->post('alamat1'),
		'kota1' 			=> $this->input->post('kota1'),
		'provinsi1' 		=> $this->input->post('provinsi1'),
		'panjang1' 			=> $this->input->post('panjang1'),
		'tinggi1' 			=> $this->input->post('tinggi1'),
		'lebar1' 			=> $this->input->post('lebar1'),
		't_panggung1' 		=> $this->input->post('t_panggung1'),
		'jenis_paket' 		=> $this->input->post('jenis_paket'),
		'inc_gedung' 		=> $this->input->post('inc_gedung'),
		'harga' 			=> $this->input->post('harga'),
		'input_by' 			=> $this->session->userdata('pn_name')
		);
		$this->db->where("id_penawaran",$this->input->post('kd_penawaran'));
		$this->db->update("dk_penawaran",$data);
		
		$data2	= array(
		'id_prospek' 	=> $this->input->post('id_prospek'),
		'edit_date' 	=> date("Y-m-d",strtotime($this->input->post('tgl_input'))),
		'edit_by' 		=> $this->session->userdata('pn_name'),
		'calon_pria' 	=> $this->input->post('pria'),
		'calon_wanita' 	=> $this->input->post('wanita'),
		'telfon' 		=> $this->input->post('telfon'),
		'email1' 		=> $this->input->post('email'),
		'email2' 		=> $this->input->post('email2'),
		'resepsi_date' 	=> date("Y-m-d",strtotime($this->input->post('tgl_resepsi'))),
		'resepsi_jam' 	=> $this->input->post('jam_resepsi'),
		'tempat1' 		=> $this->input->post('tempat1a'),
		'tempat2' 		=> $this->input->post('tempat2'),
		'tempat3' 		=> $this->input->post('tempat3')
		);
		$this->db->where("id_prospek",$this->input->post('id_prospek'));
		$this->db->update("dk_prospek",$data2);
		
		$piutang = $this->input->post('harga') - $this->input->post('dp1') - $this->input->post('dp2') - $this->input->post('dp3') - $this->input->post('dp4');
		$data3	= array(
		'id_prospek' 	=> $this->input->post('id_prospek'),
		'tgl_update' 	=> date("Y-m-d",strtotime($this->input->post('tgl_input'))),
		'updateby' 		=> $this->session->userdata('pn_name'),
		'pengantin_pria' 	=> $this->input->post('pria'),
		'pengantin_perempuan' 	=> $this->input->post('wanita'),
		'tlp' 		=> $this->input->post('telfon'),
		'email1' 		=> $this->input->post('email'),
		'email2' 		=> $this->input->post('email2'),
		'kd_penawaran' 	=> $this->input->post('kd_penawaran'),
		'alamat' 		=> $this->input->post('tempat1a'),
		'total_deal' 		=> $this->input->post('harga'),
		'kota' 		=> $this->input->post('tempat2'),
		'kode_pos' 		=> $this->input->post('tempat3'),
		'tanggal_dp1' 		=> date("Y-m-d",strtotime($this->input->post('tgl_dp1'))),
		'tanggal_dp2' 		=> date("Y-m-d",strtotime($this->input->post('tgl_dp2'))),
		'tanggal_dp3' 		=> date("Y-m-d",strtotime($this->input->post('tgl_dp3'))),
		'tanggal_dp4' 		=> $this->input->post('tgl_dp4'),
		'via_dp1' 		=> $this->input->post('via_dp1'),
		'via_dp2' 		=> $this->input->post('via_dp2'),
		'via_dp3' 		=> $this->input->post('via_dp3'),
		'via_dp4' 		=> $this->input->post('via_dp4'),
		'dp1' 		=> $this->input->post('dp1'),
		'dp2' 		=> $this->input->post('dp2'),
		'dp3' 		=> $this->input->post('dp3'),
		'dp4' 		=> $this->input->post('dp4'),
		'piutang' 		=> $piutang
		);
		$this->db->where("id_prospek",$this->input->post('id_prospek'));
		$this->db->update("dk_master_customer",$data3);
		
		$jenis_paket 	= $this->input->post('jenis_paket');
		$id_gedung	= $this->order_model->get_id_gedung($jenis_paket);
		if($id_gedung > 0){
			foreach($id_gedung as $row){
				$id			= $row->id_gedung;
				$nm_gedung	= $row->nm_gedung;
			}
		}else{
				$id			= "";
				$nm_gedung	= "";
		}
		$data5	= array(
					'id_penawaran'		=> $this->input->post('kd_penawaran'),
					'id_prospek'		=> $this->input->post('id_prospek'),
					'id_gedung'			=> $id,
					'nm_gedung'			=> $nm_gedung,
					'tanggal_resepsi'	=> $this->input->post('tgl_resepsi'),
					'jam_resepsi'		=> $this->input->post('jam_resepsi'),
					'inc_gedung'		=> $this->input->post('inc_gedung')
					);
		$this->db->where("id_penawaran",$this->input->post('kd_penawaran'));
		$this->db->where("id_prospek",$this->input->post('id_prospek'));
		$this->db->update("dk_komisi_gedung",$data5);
	}
	
	public function edit_prospek(){
		$data['judul']				= "Edit Prospek"; 
		$data['data_ref']			= $this->order_model->get_ref();
		$data['data_event']			= $this->order_model->get_event();
		$data['data_sosmed']		= $this->order_model->get_sosmed();
		$data['data_competitor']	= $this->order_model->get_competitor();
		$id							= $this->uri->segment(3);
		$data['data_prospek'] 		= $this->order_model->get_prospek($id);
		$data['data_marketing']		= $this->order_model->get_marketing();
		$data['data_reason_cancel']	= $this->order_model->get_reason_cancel();
		$data['data_reason_lost_order']	= $this->order_model->get_reason_lost_order();
		$this->load->view('order/v_edit_prospecting',$data);
	}
	
	public function lihat_penawaran(){
		$id = $this->input->get('option');
		$data['data_penawaran']		= $this->order_model->edit_penawaran($id);
		$this->load->view('order/v_edit_penawaran',$data);
	}
	
	public function insert_data_customer(){
		$kd_prospek				= $this->input->get('option');
		$data['kd_prospek']		= $this->input->get('option');
		$data['data_prospek']	= $this->order_model->get_prospek($kd_prospek);
		$this->load->view('order/v_input_data_customer',$data);
	}
	
	function inc_gedung1(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text'  class='form-control skills2 ui-autocomplete-input'  name='aaaaa' id='aaaaa' value='".$row->nm_gedung."'>";
			}
		}else{
			echo "<input type='text'  class='form-control skills2 ui-autocomplete-input' name='aaaaa' id='aaaaa' value=''>";
		}
	}
	function tes_data(){
		$data = 2;
		echo $data;
	}
	
	function inc_gedung2(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text' class='form-control'  name='alamat' id='alamat1' value='".$row->alamat."'>";
			}
		}else{
			echo "<input type='text' class='form-control'  name='alamat' id='alamat1' value=''>";
		}
	}
	
	function inc_gedung3(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text'  class='form-control' name='kota' id='kota1' value='".$row->kota."'>";
			}
		}else{
			echo "<input type='text'  class='form-control' name='kota' id='kota1' value=''>";
		}
	}
	
	function inc_gedung4(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text' class='form-control'  name='provinsi' id='provinsi1' value=''>";
			}
		}else{
			echo "<input type='text'  class='form-control' name='provinsi' id='provinsi1' value=''>";
		}
	}
	
	function inc_gedung5(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text'  class='form-control' name='panjang1' id='panjang1' value='".$row->panjang."'>";
			}
		}else{
			echo "<input type='text'  class='form-control' name='panjang1' id='panjang1' value=''>";
		}
	}
	
	function inc_gedung6(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text'  class='form-control' name='tinggi1' id='tinggi1' value='".$row->tinggi."'>";
			}
		}else{
			echo "<input type='text' class='form-control'  name='tinggi1' id='tinggi1' value=''>";
		}
	}
	
	function inc_gedung7(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text'  class='form-control' name='lebar1' id='lebar1' value='".$row->lebar."'>";
			}
		}else{
			echo "<input type='text'  class='form-control' name='lebar1' id='lebar1' value=''>";
		}
	}
	
	function inc_gedung8(){
		$id_paket 	= $this->input->get('option');
		$id_gedung		= $this->master_model->get_id_gedung($id_paket);
		$data		= $this->master_model->get_gedung($id_gedung);
		if($data > 0){
			foreach($data as $row){
				echo "<input type='text'  class='form-control' name='t_panggung1' id='t_panggung1' value='".$row->tinggi_panggung."'>";
			}
		}else{
			echo "<input type='text'  class='form-control' name='t_panggung1' id='t_panggung1' value=''>";
		}
	}
	
	function gedung(){
		echo "<select onchange='return sssssssssss()' class='form-control' name='inc_gedung' id='inc_gedung'>
				<option value='yes' selected>YES</option>
				<option value='no'>NO</option>
			</select>";
	}
	
	function data_customer(){
		$kd_prospek				= $this->uri->segment(3);
		$data['kd_prospek']		= $kd_prospek;
		$data['proses']			= 1;//1 input 0 edit
		$data['judul']			= "Input Data Customer";
		$data['data_penawaran']	= $this->order_model->get_penawaran($kd_prospek);
		$data['data_prospek']	= $this->order_model->get_prospek($kd_prospek);
		$this->load->view('order/v_input_customer',$data);
	}
	
	function edit_data_customer(){
		$kd_prospek				= $this->uri->segment(3);
		$data['id_cust']		= $this->order_model->get_id_cust($kd_prospek);
		$data['kd_prospek']		= $kd_prospek;
		$data['proses']			= 0;//1 input 0 edit
		$data['judul']			= "Input Data Customer";
		$data['data_penawaran']	= $this->order_model->get_penawaran($kd_prospek);
		$data['data_prospek']	= $this->order_model->get_prospek($kd_prospek);
		$this->load->view('order/v_input_customer',$data);
	}
	
	function print_penawaran(){
		$id_penawaran 			= $this->uri->segment(3);
		$id_penawaran			= str_replace("_","|",$id_penawaran);
		$kd_prospek 			= $this->order_model->get_kode_pros($id_penawaran);
		$data['kd_prospek'] 	= $kd_prospek;
		$data['kd_penawaran']	= $id_penawaran;
		$data['data_prospek'] = $this->order_model->get_prospek($kd_prospek);
		$data['data_penawaran']	= $this->order_model->edit_penawaran($id_penawaran);
		$data['data_owner'] 	= $this->order_model->get_owner();
		$data['data_customer'] 	= $this->order_model->get_dp_cust($kd_prospek);
		$data['data_dekor'] 	= $this->order_model->get_penawaran_dekor($kd_prospek);
		$html					= $this->load->view('order/v_print_penawaran',$data,true);
		$pdfFilePath		= $id_penawaran.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
	}
	
	function inc_gedung(){
		echo "<select onchange='return sssssssssss()' class='form-control' name='inc_gedung' id='inc_gedung'>
									<option value='yes'>YES</option>
									<option value='no' selected>NO</option>
								</select>";
	}
	
	function pilih_paket(){
		$data['id_cust'] = $this->input->get('option');
		$this->load->view('order/paket',$data);
	}
	
	function harga(){
		$data = $this->input->get('option');
		$harga = $this->order_model->get_harga2($data);
		echo "<input onkeypress='return isNumber(event)' readonly placeholder='Rp.' type='hidden' name='harga' id='harga' value='$harga'>";
		echo "<input readonly placeholder='' id='hargax' value='".number_format($harga)."'>";
	}
	
	function harga2(){
		$data = $this->input->get('option');
		$harga = $this->order_model->get_harga2($data);
		echo "<input onkeypress='return isNumber(event)' readonly placeholder='Rp.' type='text' name='harga' id='harga' value='".number_format($harga)."'>";
	}
	
	function total(){
		$data = $this->input->get('option');
		$harga = $this->order_model->get_harga2($data);
		// echo "<input onkeypress='return isNumber(event)' readonly placeholder='Rp.' type='hidden' name='total' id='total' value='$harga'>";
		//echo "<input  readonly placeholder='Rp.' type='text' name='totalx2' id='totalx2' value='".number_format($harga)."'>"; 
		echo $harga;
	}
	
	function save_customer(){
		$id_cust = $this->input->post('nocust');
		$data	= array(
					'nocust'		=> $this->input->post('nocust'),
					'id_prospek'	=> $this->input->post('id_prospek'),
					'kd_penawaran'	=> $this->input->post('kd_penawaran'),
					'tgl_deal'		=> date("Y-m-d",strtotime($this->input->post('tgl_input'))),
					'pengantin_perempuan'	=> $this->input->post('wanita'),
					'pengantin_pria'		=> $this->input->post('pria'),
					'alamat'		=> $this->input->post('tempat1'),
					'tlp'			=> $this->input->post('telfon'),
					'email1'		=> $this->input->post('email'),
					'kota'			=> $this->input->post('tempat2'),
					'kode_pos'		=> $this->input->post('tempat3'),
					'insertby'		=> $this->session->userdata('pn_name'),
					'total_deal'	=> str_replace(".","",str_replace(",","",$this->input->post('tot_deal'))),
					'piutang'		=> str_replace(".","",str_replace(",","",$this->input->post('tot_deal')))
		);
		$this->db->insert("dk_master_customer",$data);
		
		$this->db->query("update dk_prospek set sts_progres='Sudah Deal', tgl_deal='".date("Y-m-d")."' where id_prospek='".$this->input->post('id_prospek')."'");
		$this->db->query("update dk_penawaran set sts_prospek='2' where id_prospek='".$this->input->post('id_prospek')."'");
		for($i=1;$i<=4;$i++){
			if($i==1){
				$due_date = date("Y-m-d",strtotime($this->input->post('tgl_input')));
			}else if($i==2){
				$due_date = date("Y-m-d",strtotime("-2 month",strtotime($this->input->post('tgl_resepsi'))));
			}else if($i==3){
				$due_date = date("Y-m-d",strtotime("-14 days",strtotime($this->input->post('tgl_resepsi'))));
			}else{
				$due_date = date("Y-m-d",strtotime("+1 days",strtotime($this->input->post('tgl_resepsi'))));
			}
			$data_sch = array(
						'id_penawaran'	=> $this->input->post('kd_penawaran'),
						'id_prospek'	=> $this->input->post('id_prospek'),
						'nm_cust'		=> $this->input->post('pria')." & ".$this->input->post('wanita'),
						'no_cust'		=> $this->input->post('nocust'),
						'pria'			=> $this->input->post('pria'),
						'wanita'		=> $this->input->post('wanita'),
						'tanggal_resepsi'=> $this->input->post('tgl_resepsi'),
						'jam_resepsi'	=> $this->input->post('jam_resepsi'),
						'no_bayar'		=> $i,
						'due_date'		=> $due_date,
						'insert_by'		=> $this->session->userdata('pn_name'),
						'insert_date'	=> date("Y-m-d"),
						'status_bayar'	=> "N"
					);
			$this->db->insert("dk_schedule",$data_sch);
		}
		$c_cus = explode("|",$id_cust);
		$c_cus = $c_cus[1]+0;
		$this->db->query("update dk_counter set c_customer = '$c_cus'");
		redirect("order/prospecting");
	}
	
	function save_customer_edit(){
		$id_cust = $this->input->post('nocust');
		
		$tot_deal 	= str_replace(".","",str_replace(",","",$this->input->post('tot_deal')));
		$tot_bayar 	= str_replace(".","",str_replace(",","",$this->input->post('sudah_bayar')));
		$piutang	= $tot_deal - $tot_bayar;
		$data	= array(
					'total_deal'	=> $tot_deal,
					'piutang'		=> $piutang
		);
		$this->db->where("nocust",$id_cust);
		$this->db->update("dk_master_customer",$data);
		$this->db->query("update dk_prospek set sts_progres='Sudah Deal' where id_prospek='".$this->input->post('id_prospek')."'");
		$this->db->query("update dk_penawaran set sts_prospek='2' where id_prospek='".$this->input->post('id_prospek')."'");
		redirect("order/prospecting");
	}
	
	function daftar_deal(){
		$v_look	= $this->uri->segment(3);
		if ($v_look == 'month') {
			//$data['list_invoice'] 	= $this->invoice_model->get_list_invoice();
			
			$data['list_spd']	= $this->order_model->get_spd_month();
			//$data['get_totdeal']	= $this->order_model->get_spd_month2();
			$data['judul']		= "List SPD Deal";
		} else {
			//$data['list_invoice'] 	= $this->invoice_model->get_list_invoice();
			
			$data['list_spd']	= $this->order_model->get_spd();
			$data['judul']		= "List SPD";
		}
		//$data['list_invoice'] 	= $this->invoice_model->get_list_invoice();
		$this->load->view("order/v_list_spd",$data);
	}
	
	public function edit_spd(){
		$data['kd_prospek'] = $this->input->get('option');
		$kd_prospek 		= $this->input->get('option');
		$id1 				= $this->input->get('option1');
		$id2 				= $this->input->get('option2');
		if(strlen($id2)==1){
			$kdadd		= "0000";
		}else if(strlen($id2)==2){
			$kdadd		= "000";
		}else if(strlen($id2)==3){
			$kdadd		= "00";
		}else if(strlen($id2)==4){
			$kdadd		= "0";
		}else{
			$kdadd		= '0';
		}
		$id_penawaran 			= "P".$id1."|".$kdadd.$id2;
		$data['kd_penawaran']	= $id_penawaran;
		$data['data_penawaran']	= $this->order_model->edit_penawaran($id_penawaran);
		$jenis_paket			= $this->order_model->get_jenis_penawaran($id_penawaran);
		$data['data_kategori'] 	= $this->master_model->get_kategori($jenis_paket);
		$data['data_prospek'] 	= $this->order_model->get_prospek($kd_prospek);
		$data['data_customer'] 	= $this->order_model->get_dp_cust($kd_prospek);
		$data['list_kategori']	= $this->order_model->get_barang();
		$data['data_tambahan']		= $this->order_model->tambah_penawaran($id_penawaran);
		$data['data_tambahan_min']	= $this->order_model->tambah_penawaran_min($id_penawaran);
		$data['data_kategori_min']	= $this->order_model->tambah_kategori_min($id_penawaran);
		$this->load->view('order/v_edit_spd',$data);
	}
	
	function hapus_barang(){
		$id1		= $this->input->get('option');
		$id2		= $this->input->get('option2');
		$id3		= $this->input->get('option3');
		if(strlen($id3)==1){
			$kdadd		= "0000";
		}else if(strlen($id3)==2){
			$kdadd		= "000";
		}else if(strlen($id3)==3){
			$kdadd		= "00";
		}else if(strlen($id3)==4){
			$kdadd		= "0";
		}else{
			$kdadd		= '0';
		}
		$idxx		= "P".$id2."|".$kdadd.$id3;
		$this->db->where("id_barang",$id1);
		$this->db->where("id_penawaran",$idxx);
		$this->db->where("sts","inc");
		$this->db->delete("dk_penawaran_tambahan");
		echo "";
	}
	
	public function request_vendor(){
		$data['judul']		= "Request Vendor";
		$data['list_spd']	= $this->order_model->get_list_vendor();
		$data['jenis']		= "vendor";
		$this->load->view("order/v_list_data_vendor",$data);
	}
	
	public function input_request_vendor(){
		$data['judul']		= "Input Request Vendor";
		$data['req_vendor']	= $this->order_model->get_vendor();
		$data['id_pros']	= $this->order_model->get_id_spd();
		$data['id_request']	= $this->order_model->id_request_vendor();
		$this->load->view("order/v_request_vendor",$data);
	}
	
	public function request_gedung(){
		$data['judul']		= "Request Gedung";
		$data['list_spd']	= $this->order_model->get_list_gedung();
		$data['jenis']		= "vendor";
		$this->load->view("order/v_list_data_gedung",$data);
	}
	
	public function input_request_gedung(){
		$data['judul']		= "Input Request Vendor";
		$data['req_vendor']	= $this->order_model->get_vendor();
		$data['id_pros']	= $this->order_model->get_id_spd();
		$data['id_request']	= $this->order_model->id_request_gedung();
		$this->load->view("order/v_request_gedung",$data);
	}
	
	public function jenis_vendor(){
		$id1		= $this->input->get('option');
		$id = explode("+^",$id1);
		$jenis_vendor 	= $this->order_model->get_jenis_vendor($id[0]);
		echo "<input type=\"text\" class=\"form-control\" name=\"jenis_vendora\" id=\"jenis_vendora\" value='".$jenis_vendor."' readonly>";
	}
	
	public function proses_reques_vendor(){
		$id_prospek 	= $this->input->post('id_prospek');
		$vendor 	= $this->input->post('vendor');
		$vendor 	= explode("+^",$vendor);
		$id_vendor 	= $vendor[0];
		$nm_vendor 	= $vendor[1];
		$data	= array(
				'id'				=> $this->input->post('id_request'),
				'id_vendor'			=> $id_vendor,
				'nm_vendor'			=> $nm_vendor,
				'id_prospek'		=> $id_prospek,
				'tgl_awal'			=> date("Y-m-d",strtotime($this->input->post('tgl_awal'))),
				'jenis'				=> $this->input->post('jenis_vendora'),
				'jam_awal'			=> $this->input->post('jam_awal'),
				'jumlah'			=> str_replace(",","",str_replace(".","",$this->input->post('jumlah'))),
				'tgl_akhir'			=> date("Y-m-d",strtotime($this->input->post('tgl_akhir'))),
				'komisi'			=> str_replace(",","",str_replace(".","",$this->input->post('komisi'))),
				'jam_akhir'			=> date("Y-m-d",strtotime($this->input->post('jam_akhir'))),
				'insert_by'			=> $this->session->userdata('pn_name'),
				'insert_date'		=> date("Y-m-d"),
				'ket'				=> $this->input->post('ket')
			);
		$this->db->insert('dk_po_vendor',$data);
		$count 	= explode("|",$this->input->post('id_request'));
		$count	= $count[1] + 0;
		$data2	= array('c_request_vendor' => $count);
		$this->db->update("dk_counter",$data2);
		$this->db->query("update dk_prospek set vendor='1' where id_prospek='$id_prospek'");
		redirect("order/request_vendor");
	}
	
	public function proses_reques_gedung(){
		$id_prospek 	= $this->input->post('id_prospek');
		$vendor 	= $this->input->post('vendor');
		$nm_vendor 	= $vendor;
		$data	= array(
				'id'				=> $this->input->post('id_request'),
				'id_vendor'			=> "",
				'nm_vendor'			=> $nm_vendor,
				'id_prospek'		=> $id_prospek,
				'tgl_awal'			=> date("Y-m-d",strtotime($this->input->post('tgl_awal'))),
				'jenis'				=> $this->input->post('jenis_vendora'),
				'jam_awal'			=> $this->input->post('jam_awal'),
				'jumlah'			=> str_replace(",","",str_replace(".","",$this->input->post('jumlah'))),
				'tgl_akhir'			=> date("Y-m-d",strtotime($this->input->post('tgl_akhir'))),
				'komisi'			=> str_replace(",","",str_replace(".","",$this->input->post('komisi'))),
				'jam_akhir'			=> date("Y-m-d",strtotime($this->input->post('jam_akhir'))),
				'insert_by'			=> $this->session->userdata('pn_name'),
				'insert_date'		=> date("Y-m-d"),
				'ket'				=> $this->input->post('ket')
			);
		$this->db->insert('dk_po_gedung',$data);
		$count 	= explode("|",$this->input->post('id_request'));
		$count	= $count[1] + 0;
		$data2	= array('c_request_gedung' => $count);
		$this->db->update("dk_counter",$data2);
		//$this->db->query("update dk_prospek set vendor='1' where id_prospek='$id_prospek'");
		redirect("order/request_gedung");
	}
	
	public function proses_edit_request_vendor(){
		$id_prospek 	= $this->input->post('id_prospek');
		$vendor 	= $this->input->post('vendor');
		$vendor 	= explode("+^",$vendor);
		$id_vendor 	= $vendor[0];
		$nm_vendor 	= $vendor[1];
		$data	= array(
				'id'				=> $this->input->post('id_request'),
				'id_vendor'			=> $id_vendor,
				'nm_vendor'			=> $nm_vendor,
				'id_prospek'		=> $id_prospek,
				'tgl_awal'			=> date("Y-m-d",strtotime($this->input->post('tgl_awal'))),
				'jenis'				=> $this->input->post('jenis_vendora'),
				'jam_awal'			=> $this->input->post('jam_awal'),
				'jumlah'			=> str_replace(",","",str_replace(".","",$this->input->post('jumlah'))),
				'tgl_akhir'			=> date("Y-m-d",strtotime($this->input->post('tgl_akhir'))),
				'komisi'			=> str_replace(",","",str_replace(".","",$this->input->post('komisi'))),
				'jam_akhir'			=> date("Y-m-d",strtotime($this->input->post('jam_akhir'))),
				'insert_by'			=> $this->session->userdata('pn_name'),
				'insert_date'		=> date("Y-m-d"),
				'ket'				=> $this->input->post('ket')
			);
		$this->db->where('id',$this->input->post('id_request'));
		$this->db->update('dk_po_vendor',$data);
		$this->db->query("update dk_prospek set vendor='1' where id_prospek='$id_prospek'");
		redirect("order/request_vendor");
	}
	
	public function proses_edit_request_gedung(){
		$id_prospek 	= $this->input->post('id_prospek');
		$vendor 	= $this->input->post('vendor');
		$nm_vendor 	= $vendor;
		$data	= array(
				'id'				=> $this->input->post('id_request'),
				'id_vendor'			=> "",
				'nm_vendor'			=> $nm_vendor,
				'id_prospek'		=> $id_prospek,
				'tgl_awal'			=> date("Y-m-d",strtotime($this->input->post('tgl_awal'))),
				'jenis'				=> $this->input->post('jenis_vendora'),
				'jam_awal'			=> $this->input->post('jam_awal'),
				'jumlah'			=> str_replace(",","",str_replace(".","",$this->input->post('jumlah'))),
				'tgl_akhir'			=> date("Y-m-d",strtotime($this->input->post('tgl_akhir'))),
				'komisi'			=> str_replace(",","",str_replace(".","",$this->input->post('komisi'))),
				'jam_akhir'			=> date("Y-m-d",strtotime($this->input->post('jam_akhir'))),
				'insert_by'			=> $this->session->userdata('pn_name'),
				'insert_date'		=> date("Y-m-d"),
				'ket'				=> $this->input->post('ket')
			);
		$this->db->where('id',$this->input->post('id_request'));
		$this->db->update('dk_po_gedung',$data);
		//$this->db->query("update dk_prospek set vendor='1' where id_prospek='$id_prospek'");
		redirect("order/request_vendor");
	}
	
	function request_list(){
		$data['judul'] = "List Request Barang Baru";
		$data['list_data'] = $this->order_model->list_request_stock();
		$this->load->view('order/v_list_stock_order',$data);
	}
	
	function list_add_stock(){
		$data['judul'] = "List Request Tambah Stock Barang";
		$data['list_data'] = $this->order_model->list_request_tambah_stock();
		$this->load->view('order/v_list_tambah_stock_order',$data);
	}
	
	function req_new_stock(){
		$data['judul'] = "Request Barang Baru";
		$data['list_data'] = $this->order_model->list_request_stock();
		$this->load->view('order/v_list_stock_order',$data);
	}
	
	function request_use(){
		$data['judul']		= "Checklist Barang Pakai";
		$data['list_spd']	= $this->order_model->get_spd();
		$data['jenis']		= "barang";
		$this->load->view("order/v_list_order_use",$data);
	}
	
	function edit_request(){
		$data['judul']		= "Pengajuan Request Barang";
		$data['id_penawaran']	= $this->uri->segment(3);
		$id_penawaran		= $this->uri->segment(3);
		$id_penawaran		= str_replace('_','|',$id_penawaran);
		$jenis_paket 		= $this->order_model->get_jenis_paket($id_penawaran);
		//$data['list_barang_paket'] = $this->order_model->get_all_use_paket($id_penawaran,$jenis_paket);
		//$data['list_barang_add'] = $this->order_model->get_all_use_tambahan($id_penawaran);
		$data['list_kategori']	= $this->order_model->get_barang();
		$data['list_area']	= $this->order_model->get_area();
		$this->load->view("order/v_input_request_use",$data);
	}
	
	function new_stock(){
		$data['judul']			= "Pengajuan Request Barang";
		$data['list_supplier']	= $this->master_model->get_supplier();
		$this->load->view("order/v_input_request_new_item",$data);
	}
	
	function new_tambah_stock(){
		$data['judul']			= "Pengajuan Request Tambah Barang";
		$data['list_kategori']	= $this->order_model->get_barang();
		$data['list_supplier']	= $this->master_model->get_supplier();
		$this->load->view("order/v_input_tambah_item",$data);
	}
	
	function save_new(){
		$this->order_model->save_new();
		redirect('order/req_new_stock');
	}
	
	function save_tambah_new(){
		$this->order_model->save_tambah_new();
		redirect('order/list_add_stock');
	}
	
	function edit_new(){
		$this->order_model->edit_new();
		redirect('order/req_new_stock');
	}
	
	function edit_tambah_new(){
		$this->order_model->edit_tambah_new();
		redirect('order/req_new_stock');
	}
	
	function proses_barang_use(){
		$this->order_model->proses_barang_use();
		redirect('order/request_use');
	}
	
	function print_request(){
		$id_penawaran 		= $this->uri->segment(3);
		$id_penawaran		= str_replace("_","|",$id_penawaran);
		$data['list_print']		= $this->order_model->get_print_req($id_penawaran);
		$data['ket_print']		= $this->order_model->get_ket_req($id_penawaran);
		$data['data_penawaran']		= $this->order_model->get_penawaran2($id_penawaran);
		$html			= $this->load->view('order/v_print_use',$data,true);
		$pdfFilePath	= $id_penawaran.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
	}
	
	function print_request_new(){
		$id_penawaran 		= $this->uri->segment(3);
		$data['list_print']		= $this->order_model->get_print_req_new($id_penawaran);
		$data['list_head']		= $this->order_model->get_print_req_new_head($id_penawaran);
		$html			= $this->load->view('order/v_print_new',$data,true);
		$pdfFilePath	= $id_penawaran.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
	}
	
	function print_request_tambah(){
		$id_penawaran 		= $this->uri->segment(3);
		$data['list_print']		= $this->order_model->get_print_req_tambah($id_penawaran);
		$data['list_head']		= $this->order_model->get_print_req_tambah_head($id_penawaran);
		$html			= $this->load->view('order/v_print_tambah',$data,true);
		$pdfFilePath	= $id_penawaran.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
	}
	
	function daftar_order(){
		$data['judul']		= "Request Barang Baru";
		$data['list_new2']	= $this->order_model->list_order_tambah();
		$data['list_new']	= $this->order_model->list_order_new();
		$data['list_use']	= $this->order_model->list_order_use();
		$this->load->view("order/v_list_order_app",$data);
	}
	
	function approve_req_new(){
		$id_aju = $this->uri->segment(3);
		$this->db->query("update dk_request_stock set sts_app='1',approve_by='".$this->session->userdata('pn_name')."',approve_date=NOW() where id_aju= '$id_aju'");
		redirect('order/daftar_order');
	}
	
	function approve_req_tambah(){
		$id_aju = $this->uri->segment(3);
		$this->db->query("update dk_request_tambah_stock set sts_app='1',approve_by='".$this->session->userdata('pn_name')."',approve_date=NOW() where id_aju= '$id_aju'");
		redirect('order/daftar_order');
	}
	
	function reject_req_new(){
		$id_aju = $this->uri->segment(3);
		$this->db->query("update dk_request_stock set sts_app='2',approve_by='".$this->session->userdata('pn_name')."',approve_date=NOW() where id_aju= '$id_aju'");
		redirect('order/daftar_order');
	}
	
	function reject_req_tambah(){
		$id_aju = $this->uri->segment(3);
		$this->db->query("update dk_request_tambah_stock set sts_app='2',approve_by='".$this->session->userdata('pn_name')."',approve_date=NOW() where id_aju= '$id_aju'");
		redirect('order/daftar_order');
	}
	
	function approve_req_use(){
		$id_aju = $this->uri->segment(3);
		$id_aju = str_replace('_','|',$id_aju );
		$this->db->query("update dk_barang_request_use set app='1',app_by='".$this->session->userdata('pn_name')."',app_date=NOW() where id_penawaran= '$id_aju'");
		redirect('order/daftar_order');
	}
	
	function reject_req_use(){
		$id_aju = $this->uri->segment(3);
		$id_aju = str_replace('_','|',$id_aju );
		$this->db->query("update dk_barang_request_use set app='2',app_by='".$this->session->userdata('pn_name')."',app_date=NOW() where id_penawaran= '$id_aju'");
		redirect('order/daftar_order');
	}
	
	function edit_req_use(){
		$data['judul']		= "Edit Pengajuan Request Barang";
		$data['id_penawaran']	= $this->uri->segment(3);
		$id_penawaran		= $this->uri->segment(3);
		$id_penawaran		= str_replace('_','|',$id_penawaran);
		$jenis_paket 		= $this->order_model->get_jenis_paket($id_penawaran);
		//$data['list_barang_paket'] = $this->order_model->get_all_use_paket($id_penawaran,$jenis_paket);
		$data['list_barang_non_paket'] = $this->order_model->get_all_use_non_paket($id_penawaran);
		//$data['list_barang_add'] = $this->order_model->get_all_use_tambahan2($id_penawaran);
		$data['list_kategori']	= $this->order_model->get_barang();
		$data['list_area']	= $this->order_model->get_area();
		
		//simpan data log spd before
		$cek_before = $this->order_model->cek_before($id_penawaran);
		if($cek_before > 0){ //cek apakah data di dk_log_edit_spd_before ada sesuai id penawaran yg dipilih, jika ada,maka:
			$ambil_data = $this->order_model->get_log_spd_before($id_penawaran);
			if($ambil_data > 0){
				foreach($ambil_data as $row_log1){
					$id___		=	$row_log1->id;
					$nama_brg	=	$row_log1->nm_barang;
					$id_brg		=	$row_log1->id_barang;
					$id_spd		=	$row_log1->id_penawaran;
					$qty		=	$row_log1->qty;
					$app		=	$row_log1->app;
					$area		=	$row_log1->area;
					$aju_by		=	$row_log1->aju_by;
					$aju_date	=	$row_log1->aju_date;
					$app_by		=	$row_log1->app_by;
					$app_date	=	$row_log1->app_date;
					$tambahan	=	$row_log1->tambahan;
					$sts_penawaran	=	$row_log1->sts_penawaran;			
										
						$data_log_before = array(
							'nm_barang'		=> $nama_brg,
							'id_barang'		=> $id_brg,
							'id_penawaran'	=> $id_spd,
							'qty'			=> $qty,
							'app'			=> '1',
							'area'			=> $area,
							'aju_by'		=> $aju_by,
							'aju_date'		=> $aju_date,
							'app_by'		=>	$app_by,
							'app_date'		=>	$app_date,
							'tambahan'		=>	$tambahan,
							'sts_penawaran'	=>	$sts_penawaran
						);		
					$this->db->where('id_brg_req_use',$id___);
					$this->db->update('dk_log_edit_spd_before',$data_log_before);				
					}
					
				}	
							
			}else{						
				$ambil_data = $this->order_model->get_log_spd_before($id_penawaran);
				if($ambil_data > 0){
					foreach($ambil_data as $row_log1){
						$id___		=	$row_log1->id;
						$nama_brg	=	$row_log1->nm_barang;
						$id_brg		=	$row_log1->id_barang;
						$id_spd		=	$row_log1->id_penawaran;
						$qty		=	$row_log1->qty;
						$app		=	$row_log1->app;
						$area		=	$row_log1->area;
						$aju_by		=	$row_log1->aju_by;
						$aju_date	=	$row_log1->aju_date;
						$app_by		=	$row_log1->app_by;
						$app_date	=	$row_log1->app_date;
						$tambahan	=	$row_log1->tambahan;
						$sts_penawaran	=	$row_log1->sts_penawaran;			
											
							$data_log_before = array(
								'id_brg_req_use'=> $id___,
								'nm_barang'		=> $nama_brg,
								'id_barang'		=> $id_brg,
								'id_penawaran'	=> $id_spd,
								'qty'			=> $qty,
								'app'			=> '1',	
								'area'			=> $area,							
								'aju_by'		=> $aju_by,
								'aju_date'		=> $aju_date,
								'app_by'		=>	$app_by,
								'app_date'		=>	$app_date,
								'tambahan'		=>	$tambahan,
								'sts_penawaran'	=>	$sts_penawaran
							);
							$this->db->insert('dk_log_edit_spd_before',$data_log_before);
						}
					}					
				}	
		$this->load->view("order/v_edit_request_use",$data);
	}
	
	function hapus_use(){
		$id = $this->input->get('option');
		$this->db->query("delete from dk_barang_request_use where id='$id'");
		echo "<tr></tr>";
	}
	
	function hapus_new(){
		$id = $this->input->get('option');
		$this->db->query("delete from dk_request_stock_detail where id='$id'");
		echo "<tr></tr>";
	}
	
	function edit_req_new(){
		$data['judul']			= "Edit Request Barang Baru";
		$id						= $this->uri->segment(3);
		$data['list_barang'] 	= $this->order_model->get_req_new($id);
		$data['data_barang'] 	= $this->order_model->get_req_head($id);
		$data['list_supplier']	= $this->master_model->get_supplier();
		$this->load->view('order/v_edit_request_new_item',$data);
	}
	
	function edit_req_tambah_new(){
		$data['judul']			= "Edit Request Tambah Stock";
		$id						= $this->uri->segment(3);
		$data['list_barang'] 	= $this->order_model->get_req_new_stock($id);
		$data['data_barang'] 	= $this->order_model->get_req_head_stock($id);
		$data['list_kategori']	= $this->order_model->get_barang();
		$data['list_supplier']	= $this->master_model->get_supplier();
		$this->load->view('order/v_edit_request_tambah_stock',$data);
	}
	
	function input_use_out(){
		$data['judul']			= "List Barang Keluar";
		$id						= $this->uri->segment(3);
		$id						= str_replace("_","|",$id);
		$data['id_penawaran']	= $id;
		$data['list_barang'] 	= $this->order_model->get_use_out($id);
		$this->load->view('order/v_list_use_out',$data);
	}
	
	function proses_out(){
		$this->order_model->proses_out();
		redirect("order/spj_out");
	}
	
	function proses_in(){
		$this->order_model->proses_in();
		redirect("order/spj_in");
	}
	
	function spj_out(){
		$data['judul']		= "List Spj Barang Keluar";
		$data['list_spj']	= $this->order_model->get_spj_out();
		$this->load->view("order/v_list_spj_out",$data);
	}
	
	function spj_in(){
		$data['judul']		= "List Spj Barang Masuk";
		$data['list_spj']	= $this->order_model->get_spj_in();
		$this->load->view("order/v_list_spj_in",$data);
	}
	
	function print_spj_out(){
		$id_spj 				= $this->uri->segment(3);
		$data['id_spj']			= $this->uri->segment(3);
		$id_penawaran			= str_replace("_","|",$this->uri->segment(4));
		$data['list_print']		= $this->order_model->get_print_spj_out($id_spj);
		$data['data_penawaran']	= $this->order_model->get_penawaran_a($id_penawaran);
		$data['data_owner'] 	= $this->order_model->get_owner();
		$html			= $this->load->view('order/v_print_spj_out',$data,true);
		$pdfFilePath	= $id_penawaran.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
	}
	
	function input_use_in(){
		$data['judul']			= "List Barang Masuk";
		$id						= $this->uri->segment(3);
		$id						= str_replace("_","|",$id);
		$data['id_penawaran']	= $id;
		$data['list_barang'] 	= $this->order_model->get_use_out($id);
		$this->load->view('order/v_list_use_in',$data);
	}
	
	function print_in(){
		$id_spj 				= $this->uri->segment(3);
		$data['id_spj']			= $this->uri->segment(3);
		$id_penawaran			= str_replace("_","|",$this->uri->segment(4));
		$data['list_print']		= $this->order_model->get_print_spj_in($id_spj);
		$data['data_penawaran']	= $this->order_model->get_penawaran_a($id_penawaran);
		$data['data_owner'] 	= $this->order_model->get_owner();
		$html			= $this->load->view('order/v_print_spj_out',$data,true);
		$pdfFilePath	= $id_penawaran.".pdf";
		$this->load->library('m_pdf');
		$pdf			= $this->m_pdf->load();
		//$mpdf = new mPDF('c', 'A4-L'); 
		$pdf->AddPage('P', '', '', '',
				30, // margin_left
				30, // margin right
				20, // margin top
				10, // margin bottom
				10, // margin header
				10); // margin footer
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I"); 
	}
	
	function input_new(){
		$data['judul']			= "List Barang Masuk";
		$data['id']				= $this->uri->segment(3);
		$id						= $this->uri->segment(3);
		$data['list_supplier']	= $this->master_model->get_supplier();
		$data['list_barang'] 	= $this->order_model->get_barang_new($id);
		$data['data_barang'] 	= $this->order_model->get_req_head($id);
		$this->load->view('order/v_input_in_new',$data);
	}
	
	function proses_input_new(){
		$this->order_model->proses_input_new();
		redirect("order/request_list");
	}
	
	function input_tambah_new(){
		$data['judul']			= "List Barang Masuk";
		$data['id']				= $this->uri->segment(3);
		$id						= $this->uri->segment(3);
		$data['list_supplier']	= $this->master_model->get_supplier();
		$data['list_barang'] 	= $this->order_model->get_barang_new2($id);
		$data['data_barang'] 	= $this->order_model->get_req_head2($id);
		$data['add']			= "1";
		$this->load->view('order/v_input_in_new',$data);
	}
	
	function proses_input_tambah_new(){
		$this->order_model->proses_input_tambah_new();
		redirect("order/request_list");
	}
	
	function not_goal(){
		$data['judul']	= "List Prospek Lost Order/Cancel Order";
		$data['data_prospek']	= $this->order_model->get_lost();
		$this->load->view('order/v_list_lost_order',$data);
	}
	
	function app_vendor(){
		$data['judul']	= "List Approval Request Vendor";
		$data['data_prospek']	= $this->order_model->get_list_vendor();
		$this->load->view('order/v_list_app_vendor',$data);
	}
	
	function app_gedung(){
		$data['judul']	= "List Approval Request Gedung";
		$data['data_prospek']	= $this->order_model->get_list_gedung();
		$this->load->view('order/v_list_app_gedung',$data);
	}
	
	function app_diskon(){
		$data['judul']	= "List Approval Diskon";
		$data['data_penawaran']	= $this->order_model->get_penawaran_diskon();
		$this->load->view('order/v_list_app_diskon',$data);
	}
	
	function app_disk(){
		$id=$this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$this->db->query("update dk_penawaran set app_diskon='1', diskon_app='0', harga_app='0' where id_penawaran='$id'");
		redirect('order/app_diskon');
	}
	
	function rjk_disk(){
		$id=$this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$this->db->query("update dk_penawaran set app_diskon='2', harga=harga_app, discount=diskon_app, diskon_app='0', harga_app='0' where id_penawaran='$id'");
		redirect('order/app_diskon');
	}
	
	function rjk_vendor(){
		$id=$this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$this->db->query("update dk_po_vendor set sts='2' where id='$id'");
		redirect('order/app_vendor');
	}
	
	function app_vendor2(){
		$id = $this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$this->db->query("update dk_po_vendor set sts='1' where id='$id'");
		redirect('order/app_vendor');
	}
	
	function rjk_gedung(){
		$id=$this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$this->db->query("update dk_po_gedung set sts='2' where id='$id'");
		redirect('order/app_gedung');
	}
	
	function app_gedung2(){
		$id = $this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$this->db->query("update dk_po_gedung set sts='1' where id='$id'");
		redirect('order/app_gedung');
	}
	
	function edit_request_vendor(){
		$data['judul']		= "Edit Request Vendor";
		$id = $this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$data['req_vendor']	= $this->order_model->get_vendor();
		$data['id_pros']	= $this->order_model->get_id_spd();
		$data['id_request']	= $this->order_model->id_request_vendor();
		$data['data_vendor']	= $this->order_model->id_data_vendor($id);
		$this->load->view("order/v_edit_request_vendor",$data);
	}
	
	function edit_request_gedung(){
		$data['judul']		= "Edit Request Vendor";
		$id = $this->uri->segment(3);
		$id = str_replace("_","|",$id);
		$data['req_vendor']	= $this->order_model->get_vendor();
		$data['id_pros']	= $this->order_model->get_id_spd();
		$data['id_request']	= $this->order_model->id_request_vendor();
		$data['data_vendor']	= $this->order_model->id_data_gedung($id);
		$this->load->view("order/v_edit_request_gedung",$data);
	}
	
	/* function checklis_gabungan(){
		redirect('order/checklist_gabungan');
		$data['judul']		= "Daftar Checklist Gabungan";
		if($this->input->post('view')=="View List Excel"){
			$date = $this->input->post('daterange');
			$date = str_replace(" - ","_",$date);
			redirect('order/view_excel_gabungan/'.$date);
		}else{
			$data['list_spd']	= $this->order_model->get_spd_gabungan();
			$data['jenis']		= "barang";
			$this->load->view("order/v_list_order_use_gabungan",$data);
		}
	} */
	
    function view_excel_gabungan(){
		$date = $this->uri->segment(3);
		$data['data_gedung']	= $this->order_model->view_gedung($date);
		$data['data_ket']		= $this->order_model->view_ket($date);
		$data['range']			= $date;
		$this->load->view("order/view_excel_gabungan",$data);
	}
	
	/* --------------------------- UPDATE PROGRAM --------------------------- */
	function checklist_gabungan(){
		$data['judul']		= "Daftar Checklist Gabungan";
		if($this->input->post('view')=="View List Excel"){
			$date = $this->input->post('tanggal');
			$date = str_replace(" - ","_",$date);
			$date2 = $this->input->post('tanggal2');
			$date2 = str_replace(" - ","_",$date2);
		redirect('order/view_excel_gabunganx/'.$date.'/'.$date2);
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
		
			$data['jenis']			= "barang";
			$data['list_tempat']	= $this->order_model->get_tempat_lokasi($tanggal,$tanggal2);
			$data['list_barang']	= $this->order_model->checklist_barang($tanggal,$tanggal2);
			$this->load->view("order/v_list_order_use_gabungan",$data);
		}
	}
	
  function view_excel_gabunganx(){
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
		
        $data['list_tempat']	= $this->order_model->get_tempat_lokasi($tanggal,$tanggal2);
		$data['list_barang']	= $this->order_model->checklist_barang($tanggal,$tanggal2);
		$this->load->view("order/view_excel_gabunganx",$data);
	}
	function daftar_jatuh_tempo(){
		
			$data['judul']		= "Pembayaran Lewat Jatuh Tempo";
			$data['tempo']	= $this->order_model->daftar_tempo();
			$this->load->view("order/v_list_daftar_jatuh_tempo",$data);

	}

	/* --------------------------- END UPDATE PROGRAM --------------------------- */
}