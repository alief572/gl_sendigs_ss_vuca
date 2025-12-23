<?php if(!defined('BASEPATH')) exit('No directed script access allowed');
	class Login extends CI_Controller {
		function __construct(){
			parent::__construct();
			$this->load->model('login_model');
			$this->load->model('all_model');
			if($this->session->userdata('logged_in')){
				redirect('dashboard');
			}
		}
		public function index(){
			if(isset($this->error_massage)){
				$data = array(
				   'message' => $this->error_massage
				);
			}
			else {
				$data = array(
				   'message' => ''
				);
			}
			$this->load->view('viewLogin', $data);
		}
		function login_check(){
			$data = array(
				'pn_uname'	=> $this->input->post('pn_name'),
				'pn_pass'	=> md5($this->input->post('pn_pass'))
			);
			
			$query = $this->login_model->check_login($data);
			//echo $this->db->last_query();exit;
			// if($query->num_rows() > 0){
			// 	$row	= $query->row();
			// 	$kdcab	=	$row->kdcab; // RDI
			// 	$cek_cabang	= $this->login_model->get_cabang($kdcab); // dari pastibisa_tb_cabang
			// 	foreach($cek_cabang as $row_cbg){
			// 		$no_cabang		= $row_cbg->nocab;	// 202
			// 		$sub_cabang		= $row_cbg->subcab;	// A
			// 		$kode_cabang	= $no_cabang."-".$sub_cabang; // 201-A
			// 		$nm_cbg			= $row_cbg->kdcab; // JKT					
			// 		$nama_cabang	= $row_cbg->cabang;
			// 	}

			// 	$data = array(
			// 		'pn_id' 	=> $row->pn_id,
			// 		'pn_uname' 	=> $row->pn_uname,
			// 		'pn_name' 	=> $row->pn_name,
			// 		'pn_jabatan'=> $row->pn_jabatan,
			// 		'pn_wilayah'=> $row->pn_wilayah,
			// 		'pn_akses'	=> $row->pn_akses,
			// 		'marketing'	=> $row->sts_marketing,
			// 		'kode_cabang'	=> $kode_cabang,
			// 		'singkat_cbg'	=> $nm_cbg,
			// 		'nomor_cabang'	=> $no_cabang,
			// 		'sub_cabang'	=> $sub_cabang,
			// 		'nama_cabang'	=> $nama_cabang,
			// 		'logged_in' => TRUE
			// 	);
			
			if($query->num_rows() > 0){
				$row 		= $query->row();
				$wlyh		= $row->pn_wilayah;

				$cek_cabang	= $this->login_model->get_cabang($wlyh); // dari dk_cabang

				foreach($cek_cabang as $row_cbg){
					$kode_cabang	= $row_cbg->kdcab; // 201-A
				}
				// echo $kode_cabang;
				// exit;
				$no_cabang		= substr($kode_cabang,0,3); // 201
				$sub_cbg		= substr($kode_cabang,4,1); // A
				
				$cek_cabang2	= $this->login_model->get_cabang2($no_cabang,$sub_cbg); // dari pastibisa_tb_cabang
				foreach($cek_cabang2 as $row_cbg2){
					$nm_cbg			= $row_cbg2->kdcab;		// JKT -> RDI
					$no_cabang2		= $row_cbg2->nocab;		// 201
					$sub_cabang2	= $row_cbg2->subcab;	// A
					$nama_cabang2	= $row_cbg2->cabang;	// RADIN INTEN SALES
				}

				$data = array(
					'pn_id' 	=> $row->pn_id,
					'pn_uname' 	=> $row->pn_uname,
					'pn_name' 	=> $row->pn_name,
					'pn_jabatan'=> $row->pn_jabatan,
					'pn_wilayah'=> $row->pn_wilayah,
					'pn_akses'	=> $row->pn_akses,
					'marketing'	=> $row->sts_marketing,
					'kode_cabang'	=> $kode_cabang,
					'singkat_cbg'	=> $nm_cbg,
					'nomor_cabang'	=> $no_cabang2,
					'sub_cabang'	=> $sub_cabang2,
					'nama_cabang'	=> $nama_cabang2,
					'logged_in' => TRUE
				);				

				$this->session->set_userdata($data);
				$this->all_model->log_login($row->pn_id,$row->pn_uname,$row->pn_jabatan,$row->pn_wilayah);
				redirect('dashboard');
			}
			else{
				$this->error_massage = 'Wrong email or password!';
				$this->index();
			}
		}

		public function bekasi(){	
			$this->session->sess_destroy();		
				$wlyh	=	1;
				$cek_cabang	= $this->login_model->get_cabang($wlyh); // dari dk_cabang
				foreach($cek_cabang as $row_cbg){
					$kode_cabang	= $row_cbg->kdcab; // 201-A
				}
				$no_cabang		= substr($kode_cabang,0,3);
				
				$cek_cabang2	= $this->login_model->get_cabang2($no_cabang); // dari pastibisa_tb_cabang
				foreach($cek_cabang2 as $row_cbg2){
					$nm_cbg			= $row_cbg2->kdcab; // JKT
					$no_cabang2		= $row_cbg2->nocab; // 201
					$sub_cabang2	= $row_cbg2->subcab;
					$nama_cabang2	= $row_cbg2->cabang;
				}

				$data = array(
					'pn_id' 		=> "1190800019",
					'pn_uname' 		=> "admin_bks",
					'pn_name' 		=> "root",
					'pn_jabatan'	=> "6",
					'pn_wilayah'	=> $wlyh,
					'pn_akses'		=> "1",
					// 'marketing'	=> $row->sts_marketing,
					'kode_cabang'	=> $kode_cabang,
					'singkat_cbg'	=> $nm_cbg,
					'nomor_cabang'	=> $no_cabang2,
					'sub_cabang'	=> $sub_cabang2,
					'nama_cabang'	=> $nama_cabang2
					// 'logged_in' => TRUE
				);  

				$this->session->set_userdata($data);
				//$this->all_model->log_login($row->pn_id,$row->pn_uname,$row->pn_jabatan,$row->pn_wilayah);
				redirect('dashboard');			
		}

		public function pemalang_data(){			
			$data = array(
				'pn_uname'	=> "admin",
				'pn_pass'	=> md5("developer12345678")
			);
			$query = $this->login_model->check_login2($data);
			
			if($query->num_rows() > 0){
				$row = $query->row();
				$wlyh	=	2;
				$cek_cabang	= $this->login_model->get_cabang($wlyh); // dari dk_cabang
				foreach($cek_cabang as $row_cbg){
					$kode_cabang	= $row_cbg->kdcab; // 201-A
				}
				echo $kode_cabang;
				exit;
				$no_cabang		= substr($kode_cabang,0,3);
				
				$cek_cabang2	= $this->login_model->get_cabang2($no_cabang); // dari pastibisa_tb_cabang
				foreach($cek_cabang2 as $row_cbg2){
					$nm_cbg			= $row_cbg2->kdcab; // JKT
					$no_cabang2		= $row_cbg2->nocab; // 201
					$sub_cabang2	= $row_cbg2->subcab;
					$nama_cabang2	= $row_cbg2->cabang;
				}

				$data2 = array(
					'pn_id' 	=> $row->pn_id,
					'pn_uname' 	=> "admin",
					'pn_name' 	=> $row->pn_name,
					'pn_jabatan'=> "6",
					'pn_wilayah'=> $row->pn_wilayah,
					'pn_akses'	=> $row->pn_akses,
					'marketing'	=> $row->sts_marketing,
					'kode_cabang'	=> $kode_cabang,
					'singkat_cbg'	=> $nm_cbg,
					'nomor_cabang'	=> $no_cabang2,
					'sub_cabang'	=> $sub_cabang2,
					'nama_cabang'	=> $nama_cabang2
					// 'logged_in' => TRUE
				);				

				$this->session->set_userdata($data2);
				//$this->all_model->log_login($row->pn_id,$row->pn_uname,$row->pn_jabatan,$row->pn_wilayah);
				redirect('dashboard');
			}
			else{
				$this->error_massage = 'Wrong email or password!';
				$this->index();
			}
	}
	public function pemalang(){
		$this->session->sess_destroy();
		redirect('login/pemalang_data');
	}
}