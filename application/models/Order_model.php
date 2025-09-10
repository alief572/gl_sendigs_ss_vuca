<?php 
	class Order_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		public function jodohin_tbl_penawaran(){
			$query = "SELECT id_log, id_penawaran from dk_penawaran_log_history";
			//$query = "SELECT * from dk_penawaran_log_history a left join dk_penawaran_dekor_log_history b on a.id_log=b.id_log";

			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function get_log_spd_before($id_penawaran){
			$query = "SELECT * from dk_barang_request_use where id_penawaran='$id_penawaran'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function cek_before($id_penawaran){
			$query = "SELECT * from dk_log_edit_spd_before where id_penawaran='$id_penawaran'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function get_before($id_penawaran){
			$query = "SELECT * from dk_log_edit_spd_before where id_penawaran='$id_penawaran'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function get_after($id_penawaran){
			$query = "SELECT * from dk_log_edit_spd_after where id_penawaran='$id_penawaran'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_ref(){
			$query 	= "select * from dk_referensi where sts='1' order by id_ref";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function get_harga_barang($nama){
			$query	= $this->db->query("select jumlah from dk_master_kategori where nm_keterangan = '$nama' and jumlah != ''");
			if($query->num_rows() > 0){
				$ret	= $query->result();
				return $ret[0]->jumlah;
			}else{
				return 0;
			}
		}
		
		public function get_id_pen($nama){
			$query	= $this->db->query("select id_penawaran from dk_penawaran where id_prospek='".$nama."'");
			if($query->num_rows() > 0){
				$ret	= $query->result();
				return str_replace("|","_",$ret[0]->id_penawaran);
			}else{
				return 0;
			}
		}
		
		public function get_harga2($id){
			$query	= $this->db->query("select harga as jumlah from dk_master_paket where id_paket = '$id'");
			if($query->num_rows() > 0){
				$ret	= $query->result();
				return $ret[0]->jumlah;
			}else{
				return 0;
			}
		}
		
		public function get_id_cust($id){
			$query	= $this->db->query("select nocust from dk_master_customer where id_prospek = '$id'");
			if($query->num_rows() > 0){
				$ret	= $query->result();
				return $ret[0]->nocust;
			}else{
				return 0;
			}
		}
		
		public function get_bayar_invoice($id){
			$query	= $this->db->query("select sum(bayar) as jum from dk_invoice where nocust = '$id'");
			if($query->num_rows() > 0){
				$ret	= $query->result();
				return $ret[0]->jum;
			}else{
				return 0;
			}
		}
		
		public function get_event(){
			$query 	= "select id_event,nm_event from dk_event order by id_event";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function get_kategori_detx($id_cust,$r){
			$query 	= "select nm_keterangan,jumlah, nm_sfesifikasi from dk_kategori_detail where id_paket='$id_cust' and id_area='$r' and nm_keterangan != '' and no='1' order by no";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function get_kategori_det($id_cust,$r){
			$query 	= "select nm_keterangan,jumlah, nm_sfesifikasi from dk_kategori_detail where id_paket='$id_cust' and id_area='$r' and nm_keterangan != '' and no!='1' order by no";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function check_cust($id_prospek){
			$query 	= "select nocust from dk_master_customer where id_prospek='$id_prospek'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return 1;
			}else{
				return 0;
			}
		}
		
		public function get_harga($id){
			$query 	= "select total_deal from dk_master_customer where nocust='$id'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0]->total_deal;
			}else{
				return 0;
			}
		}
		
		public function tgl_input($id){
			$query 	= "select tgl_deal from dk_master_customer where nocust='$id'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0]->tgl_deal;
			}else{
				return 0;
			}
		}
		
		public function get_kategori_save($id_cust,$r){
			$query 	= "select keterangan as nm_keterangan,harga as jumlah, spesifikasi as nm_sfesifikasi, tambahan from dk_penawaran_dekor where id_prospek='$id_cust' and id_area='$r' and no !='0'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function get_discount($jab){
			$query 	= "select discount from dk_jabatan where id='$jab'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0]->discount;
			}else{
				return Null;
			}
		}
		
		
		public function get_kategori_savex($id_cust,$r){
			$query 	= "select keterangan as nm_keterangan,harga as jumlah, spesifikasi as nm_sfesifikasi,tambahan from dk_penawaran_dekor where id_prospek='$id_cust' and id_area='$r' and no ='0'";
			//echo $query."<br>";
			//exit;
            $q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function get_competitor(){
			$query 	= "select id,nm_competitor from dk_competitor order by id";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function get_sosmed(){
			$query 	= "select id,nm_sosmed from dk_sosmed order by id";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return Null;
			}
		}
		
		public function check_id_prospek($kd_prospek){
			$query 	= "select id_prospek from dk_master_customer where id_prospek='$kd_prospek'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0]->id_prospek;
			}else{
				return 0;
			}
		}
		
		public function get_customer($kd_prospek){
			$query 	= "select * from dk_master_customer where id_prospek='$kd_prospek'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function check_penawaran($kd_prospek){
			$query 	= "select id_penawaran from dk_penawaran where id_prospek='$kd_prospek'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				return $q->result();
			}else{
				return 0;
			}
		}
		
		public function get_kode(){
			$query 	= "select c_prospek from dk_counter order by id";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret =  $q->result();
				$kdadd			= "";
				$kd_barang		= $ret[0]->c_prospek+1;
				if(strlen($kd_barang)==1){
					$kdadd		= "0000";
				}else if(strlen($kd_barang)==2){
					$kdadd		= "000";
				}else if(strlen($kd_barang)==3){
					$kdadd		= "00";
				}else if(strlen($kd_barang)==4){
					$kdadd		= "0";
				}else{
					$kdadd		= '0';
				}
				$thnbln			= date("ym");
				$id = $thnbln.$kdadd.$kd_barang;
				return $id;
			}else{
				return Null;
			}
		}
		
		public function proses_input_prospek(){
			$tgl_input		= $this->input->post('tgl_input');
			$kd_prospek		= $this->input->post('kd_prospek');
			$pria			= $this->input->post('pria');
			$wanita			= $this->input->post('wanita');
			$telfon			= $this->input->post('telfon');
			$telfon2		= $this->input->post('telfon2');
			$email			= $this->input->post('email');
			$email2			= $this->input->post('email2');
			$tempat_resepsi	= $this->input->post('tempat_resepsi');
			$tgl_resepsi	= $this->input->post('tgl_resepsi');
			$jam_resepsi	= $this->input->post('jam_resepsi');
			$tempat1		= $this->input->post('tempat1');
			$tempat2		= $this->input->post('tempat2');
			$tempat3		= $this->input->post('tempat3');
			$sumber			= $this->input->post('sumber');
			$sosmed			= $this->input->post('sosmed');//ini jika id sumber = 5
			$event			= $this->input->post('event');//ini jika id sumber = 6
			$sts_progres	= $this->input->post('sts_progres');
			$alasan_cancel	= $this->input->post('alasan_cancel');//ini jika sts_progres = 'Cancel Order'
			$nm_competitor	= $this->input->post('nm_competitor');//ini jika sts_progres = 'lost_order'
			$alasan_lost	= $this->input->post('alasan_lost_order');//ini jika sts_progres = 'lost_order'
			if(count($sumber)>1){
				$sumber		= implode(",",$sumber);
				$sumber		= ",".$sumber;
			}else if(!empty($sumber)){
				$sumber		= $sumber[0];
				$sumber		= ",".$sumber;
			}else{
				$sumber		= "";
			}
			$posisi1		= strpos($sumber,"Social Media");
			$posisi2		= strpos($sumber,"Pameran");
			if($posisi1==true){
				$sosmed		= explode("+^",$sosmed);
				$nm_sosmed	= $sosmed[1];
				$id_sosmed	= $sosmed[0];
			}else{
				$nm_sosmed	= "";
				$id_sosmed	= "";
			}
			if($posisi2==true){
				$event		= explode("+^",$event);
				$nm_event	= $event[1];
				$id_event	= $event[0];
			}else{
				$nm_event	= "";
				$id_event	= "";
			}
			if($sts_progres == "Cancel Order"){
				$alasan_cancel	= $alasan_cancel;
			}else{
				$alasan_cancel	= "";
			}
			if($sts_progres == "lost_order"){
				$nm_competitor	= explode("+^",$nm_competitor);
				$nm_competitor	= $nm_competitor[1];
				$id_competitor	= $nm_competitor[0];
				$alasan_lost	= $alasan_lost;
			}else{
				$nm_competitor 	= "";
				$id_competitor	= "";
				$alasan_lost	= "";
			}
			
			if($sts_progres == "Cancel Order" || $sts_progres == "Lost Order"){
				$sts = '0';
			}else{
				$sts = '1';
			}
			$datasts = array('sts_prospek'=> $sts);
			$id_penawaran = $this->order_model->check_penawaran($kd_prospek);
			if($id_penawaran > 0){
				foreach($id_penawaran as $row){
					$id_penawaran = $row->id_penawaran;
					$this->db->where("id_penawaran",$id_penawaran);
					$this->db->update("dk_penawaran",$datasts);
					echo $this->db->last_query();
				}
			}
			
			$marketing			= $this->input->post('marketing');
			$marketing			= explode("+^",$marketing);
			$id_marketing		= $marketing[0];
			$nm_marketing		= $marketing[1];
			
			$data = array(
					'id_prospek'	=> $kd_prospek,
					'calon_pria'	=> $pria,
					'calon_wanita'	=> $wanita,
					'telfon'		=> $telfon,
					'telfon2'		=> $telfon2,
					'email1'		=> $email,
					'email2'		=> $email2,
					'resepsi_date'	=> date("Y-m-d",strtotime($tgl_resepsi)),
					'resepsi_jam'	=> $jam_resepsi,
					'tempat1'		=> $tempat1,
					'tempat2'		=> $tempat2,
					'tempat3'		=> $tempat3,
					'sumber'		=> $sumber,
					'nm_sosmed'		=> $nm_sosmed,
					'id_sosmed'		=> $id_sosmed,
					'nm_event'		=> $nm_event,
					'id_event'		=> $id_event,
					'sts_progres'	=> $sts_progres,
					'alasan_cancel'	=> $alasan_cancel,
					'nm_competitor'	=> $nm_competitor,
					'id_competitor'	=> $id_competitor,
					'alasan_lost'	=> $alasan_lost,
					'insert_date'	=> $tgl_input,
					'insert_by'		=> $this->session->userdata('pn_name'),
					'tempat_resepsi'=> $tempat_resepsi,
					'salesman'		=> $nm_marketing,
					'id_salesman'	=> $id_marketing
			);
			$this->db->insert("dk_prospek",$data);
			
			$data2 = array(
				'pengantin_pria'	=> $pria,
				'pengantin_wanita'	=> $wanita,
				'tanggal_respsi'	=> date("Y-m-d",strtotime($tgl_resepsi)),
				'jam_resepsi'		=> $jam_resepsi,
				'tempat_resepsi1'	=> $tempat1,
				'tempat_resepsi2'	=> $tempat2,
				'tempat_resepsi3'	=> $tempat3
			);
			$this->db->where("id_prospek",$kd_prospek);
			$this->db->update("dk_penawaran",$data2);
			
			$data3 = array(
				'pengantin_pria'	=> $pria,
				'pengantin_perempuan'	=> $wanita,
				'alamat'		=> $tempat1,
				'kota'			=> $tempat2,
				'kode_pos'		=> $tempat3,
				'tlp'			=> $telfon,
				'tlp2'			=> $telfon2,
				'email1'		=> $email,
				'email2'		=> $email2
			);
			$this->db->where("id_prospek",$kd_prospek);
			$this->db->update("dk_master_customer",$data3);
			
			$this->db->query("UPDATE dk_counter set c_prospek=c_prospek+1");
		}
		
		public function proses_edit_prospek(){
			$tgl_input		= $this->input->post('tgl_input');
			$kd_prospek		= $this->input->post('kd_prospek');
			$pria			= $this->input->post('pria');
			$wanita			= $this->input->post('wanita');
			$telfon			= $this->input->post('telfon');
			$tempat_resepsi = $this->input->post('tempat_resepsi');
			$telfon2		= $this->input->post('telfon2');
			$email			= $this->input->post('email');
			$email2			= $this->input->post('email2');
			$tgl_resepsi	= $this->input->post('tgl_resepsi');
			$jam_resepsi	= $this->input->post('jam_resepsi');
			$tempat1		= $this->input->post('tempat1');
			$tempat2		= $this->input->post('tempat2');
			$tempat3		= $this->input->post('tempat3');
			$sumber			= $this->input->post('sumber');
			$sosmed			= $this->input->post('sosmed');//ini jika id sumber = 5
			$event			= $this->input->post('event');//ini jika id sumber = 6
			$sts_progres	= $this->input->post('sts_progres');
			$alasan_cancel	= $this->input->post('alasan_cancel');//ini jika sts_progres = 'Cancel Order'
			$nm_competitor	= $this->input->post('nm_competitor');//ini jika sts_progres = 'lost_order'
			$alasan_lost	= $this->input->post('alasan_lost_order');//ini jika sts_progres = 'lost_order'
			if(count($sumber)>1){
				$sumber		= implode(",",$sumber);
				$sumber		= ",".$sumber;
			}else if(!empty($sumber)){
				$sumber		= $sumber[0];
				$sumber		= ",".$sumber;
			}else{
				$sumber		= "";
			}
			
			$posisi1		= strpos($sumber,"Social Media");
			$posisi2		= strpos($sumber,"Pameran");
			if($posisi1==true){
				$sosmed		= explode("+^",$sosmed);
				$nm_sosmed	= $sosmed[1];
				$id_sosmed	= $sosmed[0];
			}else{
				$nm_sosmed	= "";
				$id_sosmed	= "";
			}
			
			if($posisi2==true){
				$event		= explode("+^",$event);
				$nm_event	= $event[1];
				$id_event	= $event[0];
			}else{
				$nm_event	= "";
				$id_event	= "";
			}
			
			if($sts_progres == "Cancel Order"){
				$alasan_cancel	= $alasan_cancel;
			}else{
				$alasan_cancel	= "";
			}
			
			if($sts_progres == "Lost Order"){
				$nm_competitorx	= explode("+^",$nm_competitor);
				$nm_competitor	= $nm_competitorx[1];
				$id_competitor	= $nm_competitorx[0];
				$alasan_lost	= $alasan_lost;
			}else{
				$nm_competitor 	= "";
				$id_competitor	= "";
				$alasan_lost	= "";
			}
			
			$id_penawaran = $this->db->query("SELECT id_penawaran from dk_penawaran where id_prospek='$kd_prospek'");
			if($id_penawaran->num_rows() > 0){
				$ret = $id_penawaran->result();
				$id_penawaran = $ret[0]->id_penawaran;
			}else{
				$id_penawaran = "";
			}
			if($sts_progres == "Cancel Order" || $sts_progres == "Lost Order"){
				$sts = '0';
				$direct = "order/not_goal";
				$this->db->query("UPDATE dk_schedule set status_prospek='0',pria='$pria',wanita='$wanita' where id_prospek='$kd_prospek'");
				$this->db->query("UPDATE dk_barang_request_use set sts_penawaran='0' where id_penawaran='$id_penawaran'");
				$this->db->query("UPDATE dk_prospek set tgl_cancel='".date("Y-m-d")."' where id_prospek='$kd_prospek'");
			}else if($sts_progres == "Sudah Deal"){
				$sts_prospek = '2';
				$sts = '2';
				$direct = "order/daftar_deal";
				$this->db->query("UPDATE dk_prospek set tgl_deal='".date("Y-m-d")."' where id_prospek='$kd_prospek'");
				$this->db->query("UPDATE dk_schedule set status_prospek='1',pria='$pria',wanita='$wanita' where id_prospek='$kd_prospek'");
			}else{
				$sts = '1';
				$direct = "order/prospecting";
				$this->db->query("UPDATE dk_schedule set status_prospek='1',pria='$pria',wanita='$wanita' where id_prospek='$kd_prospek'");
			}
			
			$datasts = array('sts_prospek'=> $sts);
			$id_penawaran = $this->order_model->check_penawaran($kd_prospek);
			
			if($id_penawaran > 0){
				foreach($id_penawaran as $row){
					$id_penawaran = $row->id_penawaran;
					$this->db->where("id_penawaran",$id_penawaran);
					$this->db->update("dk_penawaran",$datasts);
				}
			}
			
			$marketing			= $this->input->post('marketing');
			$marketing			= explode("+^",$marketing);
			$id_marketing		= $marketing[0];
			$nm_marketing		= $marketing[1];
			
			$data = array(
					'id_prospek'	=> $kd_prospek,
					'calon_pria'	=> $pria,
					'calon_wanita'	=> $wanita,
					'telfon'		=> $telfon,
					'telfon2'		=> $telfon2,
					'email1'		=> $email,
					'email2'		=> $email2,
					'resepsi_date'	=> date("Y-m-d",strtotime($tgl_resepsi)),
					'resepsi_jam'	=> $jam_resepsi,
					'tempat1'		=> $tempat1,
					'tempat2'		=> $tempat2,
					'tempat3'		=> $tempat3,
					'sumber'		=> $sumber,
					'nm_sosmed'		=> $nm_sosmed,
					'id_sosmed'		=> $id_sosmed,
					'nm_event'		=> $nm_event,
					'id_event'		=> $id_event,
					'sts_progres'	=> $sts_progres,
					'alasan_cancel'	=> $alasan_cancel,
					'nm_competitor'	=> $nm_competitor,
					'id_competitor'	=> $id_competitor,
					'alasan_lost'	=> $alasan_lost,
					'edit_date'		=> date("Y-m-d"),
					'edit_by'		=> $this->session->userdata('pn_name'),
					'salesman'		=> $nm_marketing,
					'tempat_resepsi'=> $tempat_resepsi,
					'id_salesman'	=> $id_marketing
			);
			$this->db->where("id_prospek",$kd_prospek);
			$this->db->update("dk_prospek",$data);
			
			$data2 = array(
				'pengantin_pria'	=> $pria,
				'pengantin_wanita'	=> $wanita,
				'tanggal_respsi'	=> date("Y-m-d",strtotime($tgl_resepsi)),
				'jam_resepsi'		=> $jam_resepsi,
				'tempat_resepsi1'	=> $tempat1,
				'tempat_resepsi2'	=> $tempat2,
				'tempat_resepsi3'	=> $tempat3
			);
			$this->db->where("id_prospek",$kd_prospek);
			$this->db->update("dk_penawaran",$data2);
			
			$data3 = array(
				'pengantin_pria'	=> $pria,
				'pengantin_perempuan'	=> $wanita,
				'alamat'		=> $tempat1,
				'kota'			=> $tempat2,
				'kode_pos'		=> $tempat3,
				'tlp'			=> $telfon,
				'tlp2'			=> $telfon2,
				'email1'		=> $email,
				'email2'		=> $email2
			);
			$this->db->where("id_prospek",$kd_prospek);
			$this->db->update("dk_master_customer",$data3);
			$this->db->query("update dk_invoice set pria='$pria',wanita='$wanita' where id_prospek='$kd_prospek'");
			redirect($direct);
		}
		
		public function get_data_prospek(){

            if($this->session->userdata('pn_name') <> 'admin')
				$nama_marketing=$this->session->userdata('pn_name');
            else
				$nama_marketing="%";    
 
			if($this->input->post()){
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

				if (empty($bulan)) {
					$thnbln	= empty($tahun) ? date('Y') : $tahun;
				} else {
					$thnbln = date("Y-m",strtotime($tahun."-".$bulan."-01"));
				}
				
				$query 	= "SELECT id_prospek, calon_pria,calon_wanita,telfon,insert_date,salesman,tempat1,tempat2,tempat_resepsi,tempat3,resepsi_date,resepsi_jam,sts_progres from dk_prospek where sts_progres !='Cancel Order' and sts_progres !='Lost Order' and sts_progres !='Sudah Deal' and resepsi_date like '%".$thnbln."%' 

                           and salesman like '".$nama_marketing."' order by insert_date ASC";

                //echo $query; 
                //exit;
			} else {
				if($this->uri->segment(3) == "month"){
					$query 	= "SELECT id_prospek, calon_pria,calon_wanita,telfon,insert_date,tempat_resepsi,salesman,tempat1,tempat2,tempat3,resepsi_date,resepsi_jam,sts_progres from dk_prospek where sts_progres !='Cancel Order' and sts_progres !='Lost Order' and sts_progres !='Sudah Deal' and resepsi_date like '%".date("Y-m")."%' and salesman like '".$nama_marketing."' order by insert_date ASC";
				} else {
					$thnbln = date("Y");
					$query 	= "SELECT id_prospek, calon_pria,calon_wanita,telfon,insert_date,tempat_resepsi,salesman,tempat1,tempat2,tempat3,resepsi_date,resepsi_jam,sts_progres from dk_prospek where sts_progres !='Cancel Order' and sts_progres !='Lost Order' and sts_progres !='Sudah Deal' and resepsi_date like '%".$thnbln."%' and salesman like '".$nama_marketing."' order by insert_date ASC";
				}
			}

           //echo $query;
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_marketing(){
			$query 	= "select * from dk_user where sts_marketing ='Y'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_nm_marketing($id){
			$query 	= "select salesman from dk_prospek where id_prospek ='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->salesman;
			}else{
				return 0;
			}
		}
		
		public function get_prospek($id){
			$query 	= "select * from dk_prospek where id_prospek ='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function edit_penawaran($id){
			$query 	= "select * from dk_penawaran where id_penawaran ='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function tambah_penawaran($id){
			$query 	= "select * from dk_penawaran_tambahan where id_penawaran ='$id' and sts='inc'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function tambah_penawaran_min($id_penawaran){
			$query 	= "select * from dk_penawaran_tambahan where id_penawaran ='$id_penawaran' and sts='min'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function tambah_kategori_min($id_penawaran){
			$query 	= "select * from dk_penawaran_kategori where id_penawaran ='$id_penawaran' and sts='no'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_owner(){
			$query 	= "select * from dk_master_owner where sts='1'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_check_gedung($kd_prospek){
			$query 	= "select nocust from dk_master_customer where id_prospek='$kd_prospek'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_area(){
			$query 	= "select * from dk_area order by id";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_area_penawaran($id){
			$query 	= "select * from dk_penawaran_dekor where id_prospek='$id' order by id";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function count_area($area,$id){
			$query 	= "select count(id_area) as tot from dk_penawaran_dekor where id_prospek='$id' and id_area='$area'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret= $query->result();
				return $ret[0]->tot;
			}else{
				return 0;
			}
		}
		
		public function get_jenis_penawaran($id_penawaran){
			$query 	= "select jenis_paket from dk_penawaran where id_penawaran ='$id_penawaran'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$re = $query->result();
				return $re[0]->jenis_paket;
			}else{
				return 0;
			}
		}
		
		public function get_paket($id_prospek){
			$query 	= "select jenis_paket from dk_penawaran where id_prospek ='$id_prospek'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$re = $query->result();
				return $re[0]->jenis_paket;
			}else{
				return 0;
			}
		}
		
		public function inc_gedung($id_prospek){
			$query 	= "select inc_gedung from dk_penawaran where id_prospek ='$id_prospek'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$re = $query->result();
				return $re[0]->inc_gedung;
			}else{
				return 0;
			}
		}
		
		public function get_kode_pros($id_penawaran){
			$query 	= "select id_prospek from dk_penawaran where id_penawaran ='$id_penawaran'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$re = $query->result();
				return $re[0]->id_prospek;
			}else{
				return 0;
			}
		}
		
		public function get_app($id){
			$query 	= "select app from dk_barang_request_use where id_penawaran ='$id' group by id_penawaran";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$re = $query->result();
				return $re[0]->app;
			}else{
				return 3;
			}
		}
		
		public function get_spd(){
		    if($this->session->userdata('pn_name') <> 'admin')
				$nama_marketing=$this->session->userdata('pn_name');
            else
				$nama_marketing="%";
        
         	if($this->input->post()){
				$bulan	= $this->input->post('bulan');
				$tahun 	= $this->input->post('tahun');
				
				$query	= "SELECT
						*,a.salesman,b.tempat1 as temp
					from dk_penawaran b inner join dk_prospek a on b.id_prospek = a.id_prospek
					inner JOIN dk_master_customer c ON b.id_prospek = c.id_prospek where b.sts_prospek ='2'
					and a.salesman like '".$nama_marketing."' AND b.harga > 0				
					";
			
				if(!empty($bulan))
				{
					$query	.= " and year(a.resepsi_date)='$tahun' and month(a.resepsi_date)='$bulan' ";
				}
				else
				{
					if(empty($tahun))  
						$tahun=date("Y");
					$query	.= " and year(a.resepsi_date)='$tahun'  ";	
				}		 
					$query	.= " order by a.resepsi_date "; 
/*
            $query	= "SELECT
						*,a.saldoawal,b.tempat1 as temp
					from dk_penawaran b inner join dk_prospek a on b.id_prospek = a.id_prospek
					inner JOIN dk_master_customer c ON b.id_prospek = c.id_prospek where b.sts_prospek ='2'
					and a.salesman like '".$nama_marketing."' AND b.harga > 0				
					";

				$query 	= "SELECT
								a.*, b.salesman, b.sts_progres, a.tempat1 AS temp,
								(SELECT tanggal_bayar FROM dk_invoice WHERE id_penawaran=a.id_penawaran AND bayar > 0 ORDER BY bayar_no DESC LIMIT 1) as last_payment,
								(SELECT bayar_no FROM dk_invoice WHERE id_penawaran=a.id_penawaran AND bayar > 0 ORDER BY bayar_no DESC LIMIT 1) as invoice_ke,
								SUM(c.bayar) as ttl_payment
							FROM
								dk_penawaran a
							LEFT JOIN dk_prospek b ON a.id_prospek = b.id_prospek
							LEFT JOIN dk_invoice c ON a.id_penawaran = c.id_penawaran
							
							WHERE
								a.sts_prospek = '2'
                            AND b.salesman like '".$nama_marketing."' 
							AND b.resepsi_date LIKE '%".$thnbln."%' GROUP BY a.id_penawaran";
*/
			}else{ 
				   
				$vbulan = date("m")+0;
			$vtahun = date("Y");

			$query	= "SELECT
						*,a.salesman,b.tempat1 as temp
					from dk_penawaran b inner join dk_prospek a on b.id_prospek = a.id_prospek
					inner JOIN dk_master_customer c ON b.id_prospek = c.id_prospek where b.sts_prospek ='2'
				    and a.salesman like '".$nama_marketing."' AND b.harga > 0                
					";
			//AND c.piutang > 0 
            if(!empty($vbulan))
			{
				$query	.= " and year(a.resepsi_date)='$vtahun' ";
			}
			else
			{
                if(empty($vtahun))  
                    $vtahun=date("Y"); 
				$query	.= " and year(a.resepsi_date)='$vtahun' and month(a.resepsi_date)='$vbulan' ";	
			}			
     			$query	.= " order by a.resepsi_date ";
/*
				if($this->uri->segment(3) == "month"){
					$query 	= "SELECT
									a.*, b.salesman, b.sts_progres, a.tempat1 AS temp,
									(SELECT tanggal_bayar FROM dk_invoice WHERE id_penawaran=a.id_penawaran AND bayar > 0 ORDER BY bayar_no DESC LIMIT 1) as last_payment,
									(SELECT bayar_no FROM dk_invoice WHERE id_penawaran=a.id_penawaran AND bayar > 0 ORDER BY bayar_no DESC LIMIT 1) as invoice_ke,
									SUM(c.bayar) as ttl_payment
								FROM
									dk_penawaran a
								LEFT JOIN dk_prospek b ON a.id_prospek = b.id_prospek
								LEFT JOIN dk_invoice c ON a.id_penawaran = c.id_penawaran
								WHERE
									a.sts_prospek = '2'
									AND b.salesman like '".$nama_marketing."' 
								AND b.resepsi_date LIKE '%".date("Y-m")."%' GROUP BY a.id_penawaran";
				}else{
					$thnbln = date("Y");
					$query 	= "SELECT
									a.*, b.salesman, b.sts_progres, a.tempat1 AS temp,
									(SELECT tanggal_bayar FROM dk_invoice WHERE id_penawaran=a.id_penawaran AND bayar > 0 ORDER BY bayar_no DESC LIMIT 1) as last_payment,
									(SELECT bayar_no FROM dk_invoice WHERE id_penawaran=a.id_penawaran AND bayar > 0 ORDER BY bayar_no DESC LIMIT 1) as invoice_ke,
									SUM(c.bayar) as ttl_payment
								FROM
									dk_penawaran a
								LEFT JOIN dk_prospek b ON a.id_prospek = b.id_prospek
								LEFT JOIN dk_invoice c ON a.id_penawaran = c.id_penawaran
								WHERE
									a.sts_prospek = '2'
		                      	AND b.salesman like '".$nama_marketing."' 						
								AND b.resepsi_date LIKE '%".$thnbln."%' GROUP BY a.id_penawaran";
				}
*/
			}
			//echo $query;
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		

		public function get_list_vendor(){
			if($this->input->post()){
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');
				$thnbln = date("Y-m",strtotime($tahun."-".$bulan."-01"));
				$query 	= "select * from dk_po_vendor where insert_date like '%".$thnbln."%' order by insert_date desc";
			}else{
				if($this->uri->segment(3) == "month"){
					$query 	= "select *,b.salesman from dk_penawaran a left join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and b.tgl_deal like '%".date("Y-m")."%'";
				}else{
					$thnbln = date("Y-m");
					$query 	= "select * from dk_po_vendor order by insert_date desc";
				}
			}
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_list_gedung(){
			if($this->input->post()){
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');
				$thnbln = date("Y-m",strtotime($tahun."-".$bulan."-01"));
				$query 	= "select * from dk_po_gedung where insert_date like '%".$thnbln."%' order by insert_date desc";
			}else{
				if($this->uri->segment(3) == "month"){
					$query 	= "select *,b.salesman from dk_penawaran a left join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and b.tgl_deal like '%".date("Y-m")."%'";
				}else{
					$thnbln = date("Y-m");
					$query 	= "select * from dk_po_gedung order by insert_date desc";
				}
			}
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_penawaran($id){
			$query 	= "select * from dk_penawaran where id_prospek='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		
		public function get_penawaran2($id){
			$query 	= "select * from dk_penawaran where id_penawaran='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_penawaran_diskon(){
			$query 	= "select * from dk_penawaran where app_diskon = '0' and diskon_app > '0'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function id_data_vendor($id){
			$query 	= "select * from dk_po_vendor where id='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function id_data_gedung($id){
			$query 	= "select * from dk_po_gedung where id='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_id_spd(){
			$query 	= "select id_prospek,calon_pria,calon_wanita from dk_prospek";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_dp_cust($kd_prospek){
			$query 	= "select dp1,via_dp1,tanggal_dp1,dp2,via_dp2,tanggal_dp2,dp3,via_dp3,tanggal_dp3,dp4,via_dp4,tanggal_dp4,piutang from dk_master_customer where id_prospek='$kd_prospek'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_barang(){
			$query 	= "select * from dk_master_barang where sts='1' order by nm_barang";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_id_gedung($jenis_paket){
			$query 	= "select nm_gedung,id_gedung from dk_master_paket where id_paket='$jenis_paket'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_vendor(){
			$query 	= "select nm_vendor, id from dk_master_vendor where sts='1'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_jenis_vendor($id1){
			$query 	= "select jenis_vendor from dk_master_vendor where id='$id1'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$return = $query->result();
				return $return[0]->jenis_vendor;
			}else{
				return 0;
			}
		}
		
		public function id_request_vendor(){
			$query 	= "select c_request_vendor from dk_counter";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$kdadd			= "";
				$ret			= $query->result();
				$kd_barang		= $ret[0]->c_request_vendor+1;
				if(strlen($kd_barang)==1){
					$kdadd		= "0000";
				}else if(strlen($kd_barang)==2){
					$kdadd		= "000";
				}else if(strlen($kd_barang)==3){
					$kdadd		= "00";
				}else if(strlen($kd_barang)==4){
					$kdadd		= "0";
				}else{
					$kdadd		= '0';
				}
				$thnbln			= date("ym");
				$id = "RV".$thnbln."|".$kdadd.$kd_barang;
				return $id;
			}else{
				return 0;
			}
		}
		
		public function id_request_gedung(){
			$query 	= "select c_request_gedung from dk_counter";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$kdadd			= "";
				$ret			= $query->result();
				$kd_barang		= $ret[0]->c_request_gedung+1;
				if(strlen($kd_barang)==1){
					$kdadd		= "0000";
				}else if(strlen($kd_barang)==2){
					$kdadd		= "000";
				}else if(strlen($kd_barang)==3){
					$kdadd		= "00";
				}else if(strlen($kd_barang)==4){
					$kdadd		= "0";
				}else{
					$kdadd		= '0';
				}
				$thnbln			= date("ym");
				$id = "RG".$thnbln."|".$kdadd.$kd_barang;
				return $id;
			}else{
				return 0;
			}
		}
		
		public function get_jenis_paket($id_penawaran){
			$query 	= "select jenis_paket from dk_penawaran where id_penawaran = '$id_penawaran'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$return =  $query->result();
				return $return[0]->jenis_paket;
			}else{
				return 0;
			}
		}
		
		public function get_all_use_paket($id_penawaran,$jenis_paket){
			$query 	= "select * from dk_kategori_detail where id_paket = '$jenis_paket' and id_barang not in(select id_barang from dk_penawaran_tambahan where id_penawaran = '$id_penawaran' and sts = 'min')";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_all_use_tambahan($id_penawaran){
			$query 	= "select id_barang from dk_penawaran_tambahan where id_penawaran = '$id_penawaran' and sts = 'inc'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_all_use_tambahan2($id_penawaran){
			$query 	= "select * from dk_penawaran_tambahan where id_penawaran = '$id_penawaran' and sts = 'inc'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function list_request_stock(){
			if($this->input->post()){
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');
				$thnbln = date("Y-m",strtotime($tahun."-".$bulan."-01"));
				$query 	= "select * from dk_request_stock where jumlah_in < jumlah and tgl_aju like '".$thnbln."%' order by tgl_aju desc";
			}else{
				$query 	= "select * from dk_request_stock where jumlah_in < jumlah order by tgl_aju desc";
			}
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function list_request_tambah_stock(){
			if($this->input->post()){
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');
				$thnbln = date("Y-m",strtotime($tahun."-".$bulan."-01"));
				$query 	= "select * from dk_request_tambah_stock where jumlah != jumlah_in and tgl_aju like '%".$thnbln."%' order by tgl_aju desc";
			}else{
				$query 	= "select * from dk_request_tambah_stock where jumlah != jumlah_in order by tgl_aju desc";
			}
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function save_new(){
			$supplier 	= $this->input->post('supplier');
			if($supplier != "0"){
				$supplier	= explode("+^",$supplier);
				$nm_supplier = $supplier[1];
				$id_supplier = $supplier[0];
			}else{
				$nm_supplier = "";
				$id_supplier = "";
			}
			$nm_barang 	= $this->input->post('nm_barang');
			$desc 		= $this->input->post('desc');
			$qty 		= $this->input->post('qty');
			$harga 		= $this->input->post('harga');
			$query 		= $this->db->query("select max(id_aju) as id from dk_request_stock");
			$ret		= $query->result();
			$id_aju		= $ret[0]->id+1;
			$data1 		= array(	'id_aju'		=> $id_aju,
									'tgl_aju'		=> date("Y-m-d"),
									'insert_by'		=> $this->session->userdata('pn_name'),
									'sts_app'		=> '0',
									'supplier'		=> $nm_supplier,
									'id_supplier'	=> $id_supplier
									); 
			$this->db->insert('dk_request_stock',$data1);
			$no = 0;
			$q_tot = 0;
			for($i=0;$i<count($nm_barang);$i++){
				if(!empty($nm_barang[$i]) || $nm_barang[$i] != ""){
					$no++;
					$data2		= array(
									'id_aju'		=> $id_aju,
									'nm_barang'		=> $nm_barang[$i],
									'jumlah'		=> $qty[$i],
									'keterangan'	=> $desc[$i],
									'harga'			=> $harga[$i],
									'supplier'		=> $nm_supplier,
									'id_supplier'	=> $id_supplier
									);
					$this->db->insert('dk_request_stock_detail',$data2);
					$q_tot = $q_tot + $qty[$i];
				}
			}
			$this->db->query("update dk_request_stock set jumlah='$q_tot' where id_aju = '$id_aju'");
		}
		
		public function save_tambah_new(){
			$supplier 	= $this->input->post('supplier');
			if($supplier != "0"){
				$supplier	= explode("+^",$supplier);
				$nm_supplier = $supplier[1];
				$id_supplier = $supplier[0];
			}else{
				$nm_supplier = "";
				$id_supplier = "";
			}
			$nm_barang 	= $this->input->post('nm_barang');
			$desc 		= $this->input->post('desc');
			$qty 		= $this->input->post('qty');
			$harga 		= $this->input->post('harga');
			$query 		= $this->db->query("select max(id_aju) as id from dk_request_tambah_stock");
			$ret		= $query->result();
			$id_aju		= $ret[0]->id+1;
			$data1 		= array(	'id_aju'		=> $id_aju,
									'tgl_aju'		=> date("Y-m-d"),
									'insert_by'		=> $this->session->userdata('pn_name'),
									'sts_app'		=> '0',
									'supplier'		=> $nm_supplier,
									'id_supplier'	=> $id_supplier
									); 
			$this->db->insert('dk_request_tambah_stock',$data1);
			$no = 0;
			$q_tot = 0;
			for($i=0;$i<count($nm_barang);$i++){
				if(!empty($nm_barang[$i]) || $nm_barang[$i] != ""){
					$no++;
					$data2		= array(
									'id_aju'		=> $id_aju,
									'nm_barang'		=> $nm_barang[$i],
									'jumlah'		=> $qty[$i],
									'keterangan'	=> $desc[$i],
									'harga'			=> $harga[$i],
									'supplier'		=> $nm_supplier,
									'id_supplier'	=> $id_supplier
									);
					$this->db->insert('dk_request_tambah_stock_detail',$data2);
					$q_tot  = $qty[$i] + $q_tot;
				}
			}
			$this->db->query("update dk_request_tambah_stock set jumlah='$q_tot' where id_aju = '$id_aju'");
		}
		
		public function edit_new(){
			$supplier 	= $this->input->post('supplier');
			if($supplier != "0"){
				$supplier	= explode("+^",$supplier);
				$nm_supplier = $supplier[1];
				$id_supplier = $supplier[0];
			}else{
				$nm_supplier = "";
				$id_supplier = "";
			}
			$nm_barang 	= $this->input->post('nm_barang');
			$desc 		= $this->input->post('desc');
			$qty 		= $this->input->post('qty');
			$harga 		= $this->input->post('harga');
			$id_aju 		= $this->input->post('id_aju');
			$no = 0;
			$this->db->where("id_aju",$id_aju);
			$this->db->delete("dk_request_stock_detail");
			for($i=0;$i<count($nm_barang);$i++){
				if(!empty($nm_barang[$i]) || $nm_barang[$i] != ""){
					$no++;
					$data2		= array(
									'id_aju'		=> $id_aju,
									'nm_barang'		=> $nm_barang[$i],
									'jumlah'		=> $qty[$i],
									'keterangan'	=> $desc[$i],
									'harga'			=> $harga[$i],
									'supplier'		=> $nm_supplier,
									'id_supplier'	=> $id_supplier
									);
					$this->db->insert('dk_request_stock_detail',$data2);
				}
			}
			$this->db->query("update dk_request_stock set jumlah='$no', supplier='$nm_supplier', id_supplier='$id_supplier', sts_app='0' where id_aju = '$id_aju'");
		}
		
		public function edit_tambah_new(){
			$supplier 	= $this->input->post('supplier');
			if($supplier != "0"){
				$supplier	= explode("+^",$supplier);
				$nm_supplier = $supplier[1];
				$id_supplier = $supplier[0];
			}else{
				$nm_supplier = "";
				$id_supplier = "";
			}
			$nm_barang 	= $this->input->post('nm_barang');
			$desc 		= $this->input->post('desc');
			$qty 		= $this->input->post('qty');
			$harga 		= $this->input->post('harga');
			$id_aju 		= $this->input->post('id_aju');
			$no = 0;
			$this->db->where("id_aju",$id_aju);
			$this->db->delete("dk_request_tambah_stock_detail");
			for($i=0;$i<count($nm_barang);$i++){
				if(!empty($nm_barang[$i]) || $nm_barang[$i] != "0"){
					$no++;
					$data2		= array(
									'id_aju'		=> $id_aju,
									'nm_barang'		=> $nm_barang[$i],
									'jumlah'		=> $qty[$i],
									'keterangan'	=> $desc[$i],
									'harga'			=> $harga[$i],
									'supplier'		=> $nm_supplier,
									'id_supplier'	=> $id_supplier
									);
					$this->db->insert('dk_request_tambah_stock_detail',$data2);
				}
			}
			$this->db->query("update dk_request_tambah_stock set jumlah='$no', supplier='$nm_supplier', id_supplier='$id_supplier', sts_app='0' where id_aju = '$id_aju'");
		}
		
		public function proses_barang_use(){
			if($this->input->post('submit_edit')=="Save"){
				$this->db->where('id_penawaran',$this->input->post('id_spd'));
				$this->db->delete('dk_barang_request_use');
				$nm_barang 	= $this->input->post('nm_barang');
				$id_barang 	= $this->input->post('id_barang');
				$qty 		= $this->input->post('qty');
				$id_spd		= $this->input->post('id_spd');
				for($i=0;$i<count($id_barang);$i++){
					$data1 		= array(	'nm_barang'		=> $nm_barang[$i],
											'id_barang'		=> $id_barang[$i],
											'id_penawaran'	=> $id_spd,
											'qty'			=> $qty[$i],
											'app'			=> '1',
											'aju_by'		=> $this->session->userdata('pn_name'),
											'aju_date'		=> date("Y-m-d")
									); 
					$this->db->insert('dk_barang_request_use',$data1);
				}
				$nm_barang_2 	= $this->input->post('nm_barang_2');
				$qty_2 		= $this->input->post('qty_2');
				$area 		= $this->input->post('area');
				for($j=0;$j<count($nm_barang_2);$j++){
					if($nm_barang_2[$j] != '0'){
						$barang = explode("+^",$nm_barang_2[$j]);
						$id_barangx = $barang[0];
						$nm_barangx = $barang[1];
						$data2 		= array(	'nm_barang'		=> $nm_barangx,
												'id_barang'		=> $id_barangx,
												'id_penawaran'	=> $id_spd,
												'qty'			=> $qty_2[$j],
												'area'			=> $area[$j],
												'app'			=> '1',
												'aju_by'		=> $this->session->userdata('pn_name'),
												'aju_date'		=> date("Y-m-d"),
												'tambahan'		=> '1'
												); 
						$this->db->insert('dk_barang_request_use',$data2);
					}
				}
			}else{
				$nm_barang 	= $this->input->post('nm_barang');
				$id_barang 	= $this->input->post('id_barang');
				$qty 		= $this->input->post('qty');
				$id_spd		= $this->input->post('id_spd');
				for($i=0;$i<count($id_barang);$i++){
					$data1 		= array(	'nm_barang'		=> $nm_barang[$i],
											'id_barang'		=> $id_barang[$i],
											'id_penawaran'	=> $id_spd,
											'qty'			=> $qty[$i],
											'app'			=> '1',
											'aju_by'		=> $this->session->userdata('pn_name'),
											'aju_date'		=> date("Y-m-d")
									); 
					$this->db->insert('dk_barang_request_use',$data1);
				}
				$nm_barang_2 	= $this->input->post('nm_barang_2');
				$qty_2 		= $this->input->post('qty_2');
				$area 		= $this->input->post('area');
				for($j=0;$j<count($nm_barang_2);$j++){
					if($nm_barang_2[$j] != '0'){
						$barang = explode("+^",$nm_barang_2[$j]);
						$id_barangx = $barang[0];
						$nm_barangx = $barang[1];
						$data2 		= array(	'nm_barang'		=> $nm_barangx,
												'id_barang'		=> $id_barangx,
												'id_penawaran'	=> $id_spd,
												'qty'			=> $qty_2[$j],
												'area'			=> $area[$j],
												'app'			=> '1',
												'aju_by'		=> $this->session->userdata('pn_name'),
												'aju_date'		=> date("Y-m-d"),
												'tambahan'		=> '1'
												); 
						$this->db->insert('dk_barang_request_use',$data2);
					}
				}
			}
		}
		
		public function get_print_req($id){
			$query = "select * from dk_barang_request_use where id_penawaran = '$id' order by area";
            //echo  $query;
			//exit;
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_ket_req($id){
			$query = "select *,sum(qty) as jum_barang, count(id_penawaran) as jum_item from dk_barang_request_use where id_penawaran = '$id' group by id_penawaran";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_print_req_new($id){
			$query = "select * from dk_request_stock a join dk_request_stock_detail b on a.id_aju = b.id_aju where a.id_aju = '$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_print_req_tambah($id){
			$query = "select * from dk_request_tambah_stock a join dk_request_tambah_stock_detail b on a.id_aju = b.id_aju where a.id_aju = '$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function list_order_new(){
			if($this->uri->segment(3)=="waiting"){
				$query = "select * from dk_request_stock where sts_app = '0' order by sts_app";
			}else{
				$query = "select * from dk_request_stock order by sts_app";
			}
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function list_order_new_2(){
			$query = "select * from dk_request_stock where sts_app = '0' order by sts_app";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function list_order_tambah(){
			if($this->uri->segment(3)=="waiting"){
				$query = "select * from dk_request_tambah_stock where sts_app = '0' order by sts_app";
			}else{
				$query = "select * from dk_request_tambah_stock order by sts_app";
			}
			
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function list_order_tambah_2(){
			$query = "select * from dk_request_tambah_stock where sts_app = '0' order by sts_app";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function list_order_use(){
			if($this->uri->segment(3)=="waiting"){
				$query = "select count(id_barang) as jum_barang, id_penawaran, sum(qty) as jum_qty,app, aju_by,aju_date from dk_barang_request_use where sts_penawaran='1' and app = '0' group by id_penawaran order by app";
			}else{
				$query = "select count(id_barang) as jum_barang, id_penawaran, sum(qty) as jum_qty,app, aju_by,aju_date from dk_barang_request_use where sts_penawaran='1' group by id_penawaran order by app";
			}
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		
		public function list_order_use_2(){
			$query = "select count(id_barang) as jum_barang, id_penawaran, sum(qty) as jum_qty,app, aju_by,aju_date from dk_barang_request_use where sts_penawaran='1' and app = '0' group by id_penawaran order by app";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_all_use_non_paket($id){
			$query = "select * from dk_barang_request_use where id_penawaran='$id' and tambahan='1'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_print_req_new_head($id){
			$query = "select * from dk_request_stock where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_print_req_tambah_head($id){
			$query = "select * from dk_request_tambah_stock where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_req_new($id){
			$query = "select * from dk_request_stock_detail where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_req_head($id){
			$query = "select * from dk_request_stock where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_req_head2($id){
			$query = "select * from dk_request_tambah_stock where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_req_new_stock($id){
			$query = "select * from dk_request_tambah_stock_detail where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_req_head_stock($id){
			$query = "select * from dk_request_tambah_stock where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_use_out($id){
			$query = "select *,sum(qty) as tot_qty from dk_barang_request_use where id_penawaran='$id' group by id_barang";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_spj_out(){
			$query = "select * from dk_history_out group by no_spj";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_spj_in(){
			$query = "select * from dk_history_in group by no_spj";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function check_out($id_spd,$id_barang){
			$query 	= "select sum(qty_out) as qty_out from dk_history_out where id_penawaran='$id_spd' and id_barang = '$id_barang'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0]->qty_out;
			}else{
				return 0;
			}
		}
		
		public function check_in($id_spd,$id_barang){
			$query 	= "select sum(qty_out) as qty_out from dk_history_in where id_penawaran='$id_spd' and id_barang = '$id_barang'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0]->qty_out;
			}else{
				return 0;
			}
		}
		
		public function get_pengantin($id_spd){
			$query 	= "select pengantin_pria,pengantin_wanita from dk_penawaran where id_penawaran='$id_spd'";
			$q 		= $this->db->query($query);
			if($q->num_rows() > 0){
				$ret = $q->result();
				return $ret[0]->pengantin_pria." & ".$ret[0]->pengantin_wanita;
			}else{
				return 0;
			}
		}
		
		public function proses_out(){
			$id_barang 		= $this->input->post('id_barang');
			$nama_barang 	= $this->input->post('nm_barang');
			$out		 	= $this->input->post('out');
			$id_penawaran 	= $this->input->post('id_penawaran');
			$no_spj 		= $this->db->query("select c_spj from dk_counter");
			if($no_spj->num_rows() > 0){
				$ret =  $no_spj->result();
				$kdadd			= "";
				$kd_barang		= $ret[0]->c_spj+1;
				if(strlen($kd_barang)==1){
					$kdadd		= "0000";
				}else if(strlen($kd_barang)==2){
					$kdadd		= "000";
				}else if(strlen($kd_barang)==3){
					$kdadd		= "00";
				}else if(strlen($kd_barang)==4){
					$kdadd		= "0";
				}else{
					$kdadd		= '0';
				}
				$thnbln			= date("ym");
				$id_spj = "SPJ".$thnbln.$kdadd.$kd_barang;
			}
			$id = $this->input->post('id_barang');
			for($i=0;$i<count($id_barang);$i++){
				if($out[$i] != "0"){
					$data = array('id_barang'		=> $id_barang[$i],
									'nm_barang'		=> $nama_barang[$i],
									'id_penawaran'	=> $id_penawaran,
									'qty_out'		=> $out[$i],
									'out_by'		=> $this->session->userdata('pn_name'),
									'out_date'		=> date("Y-m-d H:i:s"),
									'no_spj'		=> $id_spj
									);
					$this->db->insert('dk_history_out',$data);
				}
			}
			$this->db->query("update dk_counter set c_spj = c_spj+1");
		}
		
		public function proses_in(){
			$id_barang 		= $this->input->post('id_barang');
			$nama_barang 	= $this->input->post('nm_barang');
			$out		 	= $this->input->post('out');
			$id_penawaran 	= $this->input->post('id_penawaran');
			$no_spj 		= $this->db->query("select c_spj_in from dk_counter");
			if($no_spj->num_rows() > 0){
				$ret =  $no_spj->result();
				$kdadd			= "";
				$kd_barang		= $ret[0]->c_spj_in+1;
				$xxx 			= $ret[0]->c_spj_in+1;
				if(strlen($kd_barang)==1){
					$kdadd		= "0000";
				}else if(strlen($kd_barang)==2){
					$kdadd		= "000";
				}else if(strlen($kd_barang)==3){
					$kdadd		= "00";
				}else if(strlen($kd_barang)==4){
					$kdadd		= "0";
				}else{
					$kdadd		= '0';
				}
				$thnbln			= date("ym");
				$id_spj = "IN".$thnbln.$kdadd.$kd_barang;
			}
			$id = $this->input->post('id_barang');
			for($i=0;$i<count($id_barang);$i++){
				if($out[$i] != "0"){
					$data = array('id_barang'		=> $id_barang[$i],
									'nm_barang'		=> $nama_barang[$i],
									'id_penawaran'	=> $id_penawaran,
									'qty_out'		=> $out[$i],
									'out_by'		=> $this->session->userdata('pn_name'),
									'out_date'		=> date("Y-m-d H:i:s"),
									'no_spj'		=> $id_spj
									);
					$this->db->insert('dk_history_in',$data);
				}
			}
			$this->db->query("update dk_counter set c_spj_in = '$xxx'");
		}
		
		function get_print_spj_out($id){
			$query = "select * from dk_history_out where no_spj='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_print_spj_in($id){
			$query = "select * from dk_history_in where no_spj='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_penawaran_a($id){
			$query = "select * from dk_penawaran where id_penawaran='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_barang_new($id){
			$query = "select * from dk_request_stock_detail where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_barang_new2($id){
			$query = "select * from dk_request_tambah_stock_detail where id_aju='$id'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function proses_input_new(){
			$nm_barang 		= $this->input->post("nama");
			$jumlah 		= $this->input->post("jumlah");
			$jum_in 		= $this->input->post("jum_in");
			$harga 			= $this->input->post("harga");
			$asal 			= $this->input->post("asal");
			$supplier 		= $this->input->post("supplier");
			$stock 			= $this->input->post("stock");
			$bagus 			= $this->input->post("bagus");
			$sedang 		= $this->input->post("sedang");
			$jelek 			= $this->input->post("jelek");
			$id_spd			= $this->input->post("id_spd");
			$tot = 0;
			$jum = 0;
			for($i=0;$i<count($nm_barang);$i++){
				$supplierx  = explode("+^",$supplier[$i]);
				$id_sup		= $supplierx[0];
				$nm_sup		= $supplierx[1];
				$q_user		= $this->db->query("select c_barang from dk_counter");
				$ret 		= $q_user->result();
				$kd_barang		= $ret[0]->c_barang + 1;
				$kdadd			= "";
				if(strlen($kd_barang)==1){
					$kdadd		= "0000";
				}else if(strlen($kd_barang)==2){
					$kdadd		= "000";
				}else if(strlen($kd_barang)==3){
					$kdadd		= "00";
				}else if(strlen($kd_barang)==4){
					$kdadd		= "0";
				}else{
					$kdadd		= "";
				}
				$thnbln			= date("ym");
				if($stock[$i]=="N"){
					$id				= '1'.$thnbln.$kdadd.$kd_barang;
				}else{
					$id				= '2'.$thnbln.$kdadd.$kd_barang;
				}
				$data = array(
					'id'			=> $id,
					'nm_barang'		=> strtoupper($nm_barang[$i]),
					'produk_asal'	=> $asal[$i],
					'id_supplier'	=> $id_sup,
					'nm_supplier'	=> $nm_sup,
					'harga'			=> $harga[$i],
					'barang_stock'	=> $stock[$i],
					'bagus'			=> $bagus[$i],
					'sedang'		=> $sedang[$i],
					'jelek'			=> $jelek[$i],
					'stock'			=> $jum_in[$i],
					'insert_date'	=> date("Y-m-d"),
					'insert_by'		=> $this->session->userdata('pn_name'),
					'sts'			=> '1',
					'order_terakhir'		=> date("Y-m-d"),
					'qty_order_terakhir'	=> $stock[$i]

				);
				$this->db->insert("dk_master_barang",$data);
				$this->db->query("update dk_counter set c_barang=c_barang+1");
				$jum = $jum_in[$i];
				$data2 = array(
								'id_barang' => $id,
								'nm_barang' => strtoupper($nm_barang[$i]),
								'qty_in' 	=> $jum,
								'in_by' 	=> $this->session->userdata('pn_name'),
								'in_date' 	=> date("Y-m-d"),
								'no_aju' 	=> $id_spd,
								'jenis' 	=> 'new'
							);
				$this->db->insert("dk_history_in_stock",$data2);
				$tot += $jum;
			}
			$this->db->query("update dk_request_stock set jumlah_in='$tot' where id_aju='$id_spd'");
			
		}
		
		function proses_input_tambah_new(){
			$nm_barang 		= $this->input->post("nama");
			$id_barang 		= $this->input->post("id_barang");
			$jumlah 		= $this->input->post("jumlah");
			$jum_in 		= $this->input->post("jum_in");
			$harga 			= $this->input->post("harga");
			$asal 			= $this->input->post("asal");
			$supplier 		= $this->input->post("supplier");
			$stock 			= $this->input->post("stock");
			$bagus 			= $this->input->post("bagus");
			$sedang 		= $this->input->post("sedang");
			$jelek 			= $this->input->post("jelek");
			$id_spd			= $this->input->post("id_spd");
			$tot = 0;
			$jum = 0;
			for($i=0;$i<count($nm_barang);$i++){
				$jum = $jum_in[$i];
				$data2 = array(
								'id_barang' => $id_barang[$i],
								'nm_barang' => strtoupper($nm_barang[$i]),
								'qty_in' 	=> $jum,
								'in_by' 	=> $this->session->userdata('pn_name'),
								'in_date' 	=> date("Y-m-d"),
								'no_aju' 	=> $id_spd,
								'jenis' 	=> 'stock'
							);
				$this->db->insert("dk_history_in_stock",$data2);
				$tot += $jum;
				//update master barang
				$check_harga = "select harga,stock from dk_master_barang where id='".$id_barang[$i]."'";
				$query = $this->db->query($check_harga);
				if($query->num_rows() > 0){
					$return = $query->result();
					$harga2 = $return[0]->harga;
					$stock2 = $return[0]->stock;
				}else{
					$harga2 = 0;
					$stock2 = 0;
				}
				
				$stock2;echo "<br>";
				echo $harga[$i];echo "<br>";
				echo $harga2;echo "<br>";
				echo (($harga2*$stock2)+($jum*$harga[$i]));echo "<br>";
				echo (($stock2+$jum));echo "<br>";
				echo $jum;echo "<br>";
				$elitx = (($harga2*$stock2)+($jum*$harga[$i]));
				$elity = (($stock2+$jum));
				$elit = $elitx/$elity;
				$this->db->query("update dk_master_barang set harga='$elit',bagus=bagus+$jum,stock=stock+$jum,edit_by='".$this->session->userdata('pn_name')."',edit_date='".date("Y-m-d")."' where id='".$id_barang[$i]."'");
			}
			$this->db->query("update dk_request_tambah_stock set jumlah_in='$tot' where id_aju='$id_spd'");
			
			
			
		}
		
		function get_penawaran_dekor($id){
			$query 	= "select * from dk_penawaran_dekor where id_prospek = '$id' order by id_area";
           // echo $query;
			//exit;
 
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_lost(){
			if($this->input->post()){
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');

                 if($bulan=="0") {
                    $thnbln=$tahun;  
                 }
				 else
				{
                    
					$thnbln = date("Y-m",strtotime($tahun."-".$bulan."-01"));
                 }


				$query 	= "select * from dk_prospek where sts_progres = 'Cancel Order' or sts_progres='Lost Order' and tgl_cancel like '%".$thnbln."%'";
			}else{
				if($this->uri->segment(3)=="month"){
					$query 	= "select * from dk_prospek where sts_progres = 'Cancel Order' or sts_progres='Lost Order' and tgl_cancel like '%".date("Y-m")."%'";
				}else{
					$thnbln = date("Y-m");
					$query 	= "select * from dk_prospek where sts_progres = 'Cancel Order' or sts_progres='Lost Order' and tgl_cancel like '%".$thnbln."%'";
				}
			}
			
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function get_lost_month(){
			$query 	= "select count(id_prospek) as jum from dk_prospek where sts_progres = 'Cancel Order' or sts_progres='Lost Order' and tgl_cancel like '%".date("Y-m")."%'";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$re = $query->result();
				return $re[0]->jum;
			}else{
				return 0;
			}
		}
		
		function count_jum($id,$idp){
			$query 	= "select count(id_area) as aaaa from dk_penawaran_dekor where id_area = '$id' and id_prospek='$idp' order by id_area";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}
		
		public function get_data_prospek_month(){
			$query 	= "select count(id_prospek) as aaaa from dk_prospek where sts_progres !='Cancel Order' and sts_progres !='Lost Order' and sts_progres !='Sudah Deal' and resepsi_date like '%".date("Y-m")."%'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}
		
		public function get_tgl_resepsi($id){
			$query 	= "select tanggal_respsi, tempat1 from dk_penawaran where id_penawaran='$id'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_total_spd_month(){
			$query 	= "select count(id_penawaran) as jumlah_deal from dk_penawaran a left join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and tgl_deal like '%".date("Y-m")."%' ORDER BY b.resepsi_date ASC";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->jumlah_deal;
			}else{
				return 0;
			}
		}
		
		public function get_spd_month(){
			$query 	= "select *,b.salesman,a.tempat1 as temp from dk_penawaran a left join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and tgl_deal like '%".date("Y-m")."%' ORDER BY b.resepsi_date ASC";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		/* ----------------------------- UPDATE PROGRAM ----------------------------- */
		
		public function get_list_tempat_lokasi($tanggal){
			$query 	= "SELECT
						a.tempat1 AS tempat
					FROM
						dk_penawaran a
					INNER JOIN dk_prospek b ON a.id_prospek = b.id_prospek
					WHERE
						a.sts_prospek = '2'
					AND b.resepsi_date like '$tanggal%'
					GROUP BY
						a.tempat1";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function get_spd_month_marketing($username, $tahun=null, $bulan=null){
			if (empty($tahun)) {
				$tahun	= date('Y');
			}
			if (empty($bulan)) {
				$bulan	= date('m');
			}
			$date 	= $tahun."-".$bulan;

			$query 	= "select count(DISTINCT a.id_prospek) as aaaa from dk_penawaran a inner join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and b.insert_date like '%".$date."%' AND b.salesman='".$username."'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}
		
		public function get_prospek_month_marketing($username, $tahun=null, $bulan=null){
			if (empty($tahun)) {
				$tahun	= date('Y');
			}
			if (empty($bulan)) {
				$bulan	= date('m');
			}
			$date 	= $tahun."-".$bulan;

			$query 	= "select count(DISTINCT a.id_prospek) as aaaa from dk_penawaran a inner join dk_prospek b on a.id_prospek = b.id_prospek where a.input_date like '%".$date."%' AND b.salesman='".$username."' ORDER BY resepsi_date ASC";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}

		public function get_spd_month_gedung($tempat, $tahun=null, $bulan=null){
			if (empty($tahun)) {
				$tahun	= date('Y');
			}
			if (empty($bulan)) {
				$bulan	= date('m');
			}
			$date 	= $tahun."-".$bulan;

			$query 	= "select count(DISTINCT a.id_prospek) as aaaa from dk_penawaran a inner join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and b.insert_date like '%".$date."%' AND a.tempat1='".$tempat."'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}
		
		public function get_prospek_month_gedung($tempat, $tahun=null, $bulan=null){
			if (empty($tahun)) {
				$tahun	= date('Y');
			}
			if (empty($bulan)) {
				$bulan	= date('m');
			}
			$date 	= $tahun."-".$bulan;

			$query 	= "select count(DISTINCT a.id_prospek) as aaaa from dk_penawaran a INNER JOIN dk_prospek b ON a.id_prospek=b.id_prospek where a.input_date like '%".$date."%' AND a.tempat1='".$tempat."'";
			//echo $query."<br><BR>";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}

		/* ----------------------------- END UPDATE PROGRAM ----------------------------- */
		
		public function get_jatuh_tempo(){
			$query 	= "SELECT
							count(a.id_prospek) as aaaa
						FROM
							dk_master_customer a
						JOIN dk_schedule b on a.id_prospek = b.id_prospek
						where a.piutang < a.total_deal
						and b.status_prospek ='1' and 
						b.due_date < NOW()";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}
		
		public function get_spd_gabungan(){
			if($this->input->post()){
				$range = $this->input->post('daterange');
				$range = explode(" - ",$range);
				$range1 = date("Y-m-d",strtotime($range[0]));
				$range2 = date("Y-m-d",strtotime($range[1]));
				$query 	= "select *,b.salesman,a.tempat1 as temp from dk_penawaran a left join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and b.resepsi_date = '$range1' or b.resepsi_date = '$range2' ";
			}else{
				if($this->uri->segment(3) == "month"){
					$query 	= "select *,b.salesman,a.tempat1 as temp from dk_penawaran a left join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and b.resepsi_date like '%".date("Y-m")."%'";
				}else{
					$thnbln = date("Y-m");
					$query 	= "select *,b.salesman,a.tempat1 as temp from dk_penawaran a left join dk_prospek b on a.id_prospek = b.id_prospek where a.sts_prospek ='2' and b.resepsi_date = '0'";
				}
			}
            echo $query;
exit; 
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}


		/* ----------------------------- UPDATE PROGRAM ----------------------------- */
		
		public function get_tempat_lokasi($tanggal,$tanggal2){
			$query 	= "SELECT
						b.tempat_resepsi AS tempatx,
                        a.tempat1 as tempat
					FROM
						dk_penawaran a
					INNER JOIN dk_prospek b ON a.id_prospek = b.id_prospek
					INNER JOIN dk_barang_request_use c ON a.id_penawaran = c.id_penawaran
					WHERE
						a.sts_prospek = '2'
					AND c.app = '1'
					AND (b.resepsi_date >='$tanggal'
					      AND b.resepsi_date <= '$tanggal2')
				
	                GROUP BY
						a.tempat1 ";

		//	echo $query;
			//exit; b.tempat_resepsi
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function checklist_barang($tanggal,$tanggal2){
			$query	= "SELECT
							mstr.*,
                            req.area,
							offer.id_penawaran,
							prospek.tempat_resepsi
						FROM
							dk_barang_request_use req
						INNER JOIN dk_master_barang mstr ON req.id_barang = mstr.id
						INNER JOIN dk_penawaran offer ON req.id_penawaran = offer.id_penawaran
						INNER JOIN dk_prospek prospek ON offer.id_prospek = prospek.id_prospek
						WHERE
							mstr.barang_stock = 'Y'
						AND offer.sts_prospek = '2'
						AND req.app = '1'
						AND (offer.tanggal_respsi >= '$tanggal' 
						     AND offer.tanggal_respsi <= '$tanggal2') 
						GROUP BY
							mstr.id, offer.tempat1";
			//echo $query;

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}

		}

		public function sum_checklist_barang($tempat, $id_barang, $tanggal, $tanggal2){
			if (empty($tanggal)) {
				$tanggal = date('Y-m-d');
			}
			$query	= "SELECT
							SUM(req.qty) AS qty
						FROM
							dk_barang_request_use req
						INNER JOIN dk_master_barang mstr ON req.id_barang = mstr.id
						INNER JOIN dk_penawaran offer ON req.id_penawaran = offer.id_penawaran
						INNER JOIN dk_prospek prospek ON offer.id_prospek = prospek.id_prospek
						WHERE
							mstr.barang_stock = 'Y'
						AND offer.sts_prospek = '2'
						AND req.app = '1'
						AND (offer.tanggal_respsi >= '$tanggal'
						      AND offer.tanggal_respsi <= '$tanggal2')
						
						AND offer.tempat1 = '$tempat'
						AND req.id_barang='$id_barang'";
           // echo "<br>".$query;
//AND prospek.tempat_resepsi LIKE '$tempat'
						
			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){
				$r = $query->result();
				return $r[0]->qty;
			}else{
				return 0;
			}
		}

		/* ----------------------------- END UPDATE PROGRAM ----------------------------- */

		public function view_gedung($date){
			$range = $date;
			$range = explode("_",$range);
			$range1 = date("Y-m-d",strtotime($range[0]));
			$range2 = date("Y-m-d",strtotime($range[1]));
			$query = "select tempat1 from dk_penawaran where tanggal_respsi >= '$range1' and tanggal_respsi <= '$range2' group by tempat1";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function view_ket($date){
			$range = $date;
			$range = explode("_",$range);
			$range1 = date("Y-m-d",strtotime($range[0]));
			$range2 = date("Y-m-d",strtotime($range[1]));
			$query = "SELECT
						b.nm_barang as keterangan
					FROM
						dk_penawaran a
					JOIN dk_barang_request_use b ON a.id_penawaran = b.id_penawaran
					WHERE
						a.tanggal_respsi >= '$range1' and a.tanggal_respsi <= '$range2' GROUP BY nm_barang";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function count_ket($date,$tempat,$barang){
			$range = $date;
			$range = explode("_",$range);
			$range1 = date("Y-m-d",strtotime($range[0]));
			$range2 = date("Y-m-d",strtotime($range[1]));
			$query = "SELECT
							count(nm_barang) as jum
						FROM
							dk_penawaran a
						JOIN dk_barang_request_use b ON a.id_penawaran = b.id_penawaran
						WHERE
							nm_barang = '$barang'
						AND tempat1 = '$tempat'
						AND a.tanggal_respsi >= '$range1'
						AND a.tanggal_respsi <= '$range2'";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				$r = $query->result();
				return $r[0]->jum;
			}else{
				return 0;
			}
		}
		
		public function count_stock($barang){
			$query = "SELECT
							stock
						FROM
							dk_master_barang
						WHERE
							nm_barang = '$barang'
							";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				$r = $query->result();
				return $r[0]->stock;
			}else{
				return 0;
			}
		}
		
		public function view_area($date){
			$range = $date;
			$range = explode("_",$range);
			$range1 = date("Y-m-d",strtotime($range[0]));
			$range2 = date("Y-m-d",strtotime($range[1]));
			$query = "select a.area from dk_barang_request_use a join dk_penawaran b on a.id_penawaran = b.id_penawaran where b.tanggal_respsi >= '$range1' and b.tanggal_respsi <= '$range2' group by a.area";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_spesifikasi_area($nm_area,$id_penawaran){
			$query = "select qty,nm_barang from dk_barang_request_use where area='$nm_area' and id_penawaran = '$id_penawaran' order by nm_barang";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_barang_area($nm_area,$range){
			$range = explode("_",$range);
			$range1 = date("Y-m-d",strtotime($range[0]));
			$range2 = date("Y-m-d",strtotime($range[1]));
			$query = "SELECT
						nm_barang,sum(qty) as aa
					FROM
						dk_barang_request_use a
					JOIN dk_penawaran b ON a.id_penawaran = b.id_penawaran
					WHERE
						b.tanggal_respsi >= '$range1'
					AND b.tanggal_respsi <= '$range2'
					and area = '$nm_area'
					GROUP BY nm_barang";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_reason_cancel(){
			$query 	= "select * from dk_reason_cancel where sts='1'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		public function get_reason_lost_order(){
			$query 	= "select * from dk_reason_lost_order where sts='1'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function daftar_tempo(){
			$query 	= "SELECT
							*
						FROM
							dk_penawaran a
						JOIN dk_schedule b on a.id_prospek = b.id_prospek
						where a.sts_prospek ='2' and 
						b.due_date < NOW()";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		public function daftar_tempo1(){
			$query 	= "SELECT
							count(a.id_prospek) as aaaa
						FROM
							dk_penawaran a
						JOIN dk_schedule b on a.id_prospek = b.id_prospek
						where a.sts_prospek ='2' and 
						b.due_date < NOW()";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->aaaa;
			}else{
				return 0;
			}
		}
		public function daftar_tem(){
			$query 	= "SELECT
							count(a.id_prospek) as ab
						FROM
							dk_invoice a
						JOIN dk_schedule b on a.id_prospek = b.id_prospek
						where
						a.invoice_date  NOW + 1()";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->abs;
			}else{
				return 0;
			}
		}
		
	}