<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komisi extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->model('order_model');
		$this->load->model('komisi_model');
		$this->load->helper('menu');
	}
	
	public function index(){
		$this->setup_menu();
		
	}
	
	public function komisi_gedung(){
		$data['judul']			= "List Pembayaran Gedung";
		$data['list_komisi']	= $this->komisi_model->get_komisi_gedung();
		$this->load->view("komisi/v_komisi_gedung",$data);
	}
	
	public function komisi_vendor(){
		$data['judul']			= "List Pembayaran Vendor";
		$data['list_komisi']	= $this->komisi_model->get_komisi_vendor();
		$this->load->view("komisi/v_komisi_vendor",$data);
	}
	
	public function komisi_sales(){
		$data['judul']			= "List Pembayaran Sales";
		$data['list_komisi']	= $this->komisi_model->get_komisi_sales();
		$this->load->view("komisi/v_komisi_sales",$data);
	}
	
	public function edit_bayar(){
		$data['judul']			= "Masukan Pembayaran Komisi Vendor";
		$id = $this->uri->segment(3);
		$id = str_replace("_","|",$id);
		if(substr($id,0,2)=="RG"){
			$data['komisi']	= $this->komisi_model->get_data_gedung($id);
		}else{
			$data['komisi']	= $this->komisi_model->get_data_vendor($id);
		}
		$this->load->view("komisi/v_bayar_vendor",$data);
	}
	
	public function input_bayar_sales(){
		$data['judul']			= "Input Pembayaran Karyawan";
		$data['karyawan']		= $this->komisi_model->get_data_karyawan();
		$this->load->view("komisi/v_bayar_sales",$data);
	}
	
	function proses_bayar_sales(){
		$data = array(
						'id_req'	=> $this->input->post('id_request'),
						'jenis'		=> $this->input->post('jenis'),
						'bayar'		=> str_replace(",","",str_replace(".","",$this->input->post('total'))),
						'nama'		=> $this->input->post('karyawan'),
						'bayar_oleh'=> $this->session->userdata('pn_name'),
						'keterangan'=> $this->input->post('ket'),
						'bayar_date'=> date("Y-m-d H:i:s")
						);
		$this->db->insert("dk_bayar",$data);
		$this->db->query("update dk_counter set c_request_sales='".$this->input->post('count')."'");
		redirect("komisi/komisi_sales");
	}
	
	function proses_bayar_vendor(){
		$data = array(
						'id_req'	=> $this->input->post('id_request'),
						'jenis'		=> "VENDOR",
						'bayar'		=> str_replace(",","",str_replace(".","",$this->input->post('bayar'))),
						'nama'		=> $this->input->post('nama'),
						'bayar_oleh'=> $this->session->userdata('pn_name'),
						'bayar_date'=> date("Y-m-d H:i:s")
						);
		$this->db->insert("dk_bayar",$data);
		redirect("komisi/komisi_vendor");
	}
	
	function proses_bayar_gedung(){
		$data = array(
						'id_req'	=> $this->input->post('id_request'),
						'jenis'		=> "GEDUNG",
						'bayar'		=> str_replace(",","",str_replace(".","",$this->input->post('bayar'))),
						'nama'		=> $this->input->post('nama'),
						'bayar_oleh'=> $this->session->userdata('pn_name'),
						'bayar_date'=> date("Y-m-d H:i:s")
						);
		$this->db->insert("dk_bayar",$data);
		redirect("komisi/komisi_gedung");
	}
}