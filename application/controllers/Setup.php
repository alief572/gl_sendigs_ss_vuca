<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->model('menu_model');
		$this->load->helper('menu');
		$this->load->model('Login_model');
	}

	public function index()
	{
		$this->setup_menu();
	}
	public function setup_menu()
	{
		$data['judul']		= "Daftar Menu";
		$data['data_menu']	= $this->menu_model->get_daftar();
		$data['data_urut']	= $this->menu_model->get_urutan();
		$this->load->view('setup/v_daftar_menu', $data);
	}

	public function edit_menu()
	{
		$this->menu_model->update_menu();
		redirect('setup');
	}

	public function setup_akses()
	{
		$data['judul']			= "Daftar User";
		$data['list_user']		= $this->menu_model->list_user();
		$data['list_jabatan']	= $this->menu_model->jabatan();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('setup/v_list_user', $data);
	}

	public function edit_profile()
	{
		$data['judul']		= 'Edit Profile';
		$pn_id				= $this->uri->segment(3);
		$data['data_user']	= $this->menu_model->get_user($pn_id);
		$data['list_jabatan']	= $this->menu_model->jabatan($pn_id);
		$data['list_cabang']	= $this->menu_model->cabang($pn_id);
		$this->load->view('setup/v_edit_profile', $data);
	}

	public function proses_edit_profile()
	{
		$data['data_user']	= $this->menu_model->proses_edit();
		redirect('setup/setup_akses');
		// redirect('master/salesman');
	}

	public function add_user()
	{
		$data['judul']			= 'Add User';
		$data['list_jabatan']	= $this->menu_model->jabatan();
		$data['list_cabang']	= $this->menu_model->cabang();
		$this->load->view('setup/v_add_user', $data);
	}

	public function proses_add_user()
	{
		$data['judul']			= 'Insert User Sukses';
		$pn_id					= $this->menu_model->proses_tambah();
		$data['data_user']		= $this->menu_model->get_user($pn_id);
		$data['list_jabatan']	= $this->menu_model->jabatan($pn_id);
		$data['list_cabang']	= $this->menu_model->cabang($pn_id);
		//redirect('setup/setup_akses');
		redirect('master/salesman');
	}

	public function set_menu()
	{
		$data["judul"]			= "Setup Menu Akses";
		$kd_jab					= $this->uri->segment(3);
		$data['id_jab']			= $this->uri->segment(3);
		$data['data_menu']		= $this->menu_model->get_menu();
		$data['data_jabatan']	= $this->menu_model->get_jabatan($kd_jab);
		$this->load->view('setup/v_set_akses', $data);
	}

	public function add_jab()
	{
		$this->menu_model->proses_add_jab();
		redirect('setup/setup_akses');
	}

	public function add_cab()
	{
		$this->menu_model->proses_add_cab();
		redirect('setup/setup_akses');
	}

	public function proses_menu_akses()
	{
		$this->menu_model->proses_menu_akses();
		redirect('setup/setup_akses');
	}

	public function user_login()
	{
		$data["judul"]			= "List User Login";

		$data['list_userlogin']	= $this->Login_model->user_login();
		$this->load->view('setup/v_list_userlogin', $data);
	}

	public function ke_EditUser()
	{
		$usr					= $this->uri->segment(3);
		$data["judul"]			= "Edit User Login - " . $usr;

		//$data['list_userlogin']	= $this->Login_model->user_login();
		$data['data_userlogin']	= $this->Login_model->get_user($usr);
		$data['data_jab']	= $this->Login_model->get_jab();
		//$data['data_userlogin']	= $this->db->query("SELECT * FROM dk_user WHERE pn_uname='$usr'");

		$this->load->view('setup/v_edit_userlogin', $data);
	}

	public function edit_userlogin()
	{

		$this->form_validation->set_rules('cpassword', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('npassword', 'New Password', 'required|trim|min_length[1]');
		$this->form_validation->set_rules('rpassword', 'Re-type New Password', 'required|trim|min_length[1]');

		$this->form_validation->set_message('required', '%s wajib diisi');
		$this->form_validation->set_error_delimiters('<p class="alert">', '</p>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('setup/v_edit_userlogin');
		} else {
			$post = $this->input->post();
			$id			= $this->input->post('user_id');
			$username	= $this->input->post('username');
			$password	= md5($post['npassword']);
			$jabatan	= $this->input->post('jabatan');
			$smkt = $this->input->post('marketing');

			$current_password = $this->input->post('cpassword');
			$new_password = $this->input->post('npassword');
			$rnew_password = $this->input->post('rpassword');
			$data['cpswd']	= $this->Login_model->cek_cpassword($id);

			$data_cpswd	= $this->Login_model->cek_cpassword($id);
			$cpaswd_md5	= md5($post['cpassword']);

			if ($data_cpswd > 0) {
				foreach ($data_cpswd as $row2) {

					$pswd_ 	= $row2->pn_pass;
				}
			}
			//echo $cpaswd_md5;
			//exit;			

			if (password_verify($current_password, $pswd_)) {
				//echo '<script>alert("Current Password tidak cocok")</script>';
				redirect('setup/pesan_eror1');
			} else {
				if ($current_password == $new_password) {
					//echo '<script>alert("new Password tidak boleh sama dengan current password")</script>';				
					redirect('setup/pesan_eror2');
				} else {
					if ($rnew_password != $new_password) {
						redirect('setup/pesan_eror3');
					} else {
						$udate = date('Y-m-d');

						$this->db->query("UPDATE dk_user SET pn_uname='$username', pn_name='$username', pn_pass='$password', pn_jabatan='$jabatan', update_date='$udate', sts_marketing='$smkt' WHERE pn_id='$id'");

						//echo '<script>alert("berhasil diubah")</script>';
						redirect('setup/pesan_berhasil');
					}
				}
			}
		}
	}

	public function pesan_eror1()
	{
		$this->load->view('errors/error_ubah_userlogin1');
	}

	public function pesan_eror2()
	{
		$this->load->view('errors/error_ubah_userlogin2');
	}

	public function pesan_eror3()
	{
		$this->load->view('errors/error_ubah_userlogin3');
	}

	public function pesan_berhasil()
	{
		$this->load->view('errors/error_ubah_userlogin4');
	}
	public function pesan_berhasil2()
	{
		$this->load->view('errors/error_ubah_userlogin5');
	}

	public function tambah_userlogin()
	{

		$data["judul"]			= "Tambah User Login";
		$data['data_jab']	= $this->Login_model->get_jab();

		$this->load->view('setup/v_tambah_userlogin', $data);
	}

	public function tambah_userlogin_()
	{

		$this->form_validation->set_rules('npassword', 'New Password', 'required|trim|min_length[1]');
		$this->form_validation->set_rules('rpassword', 'Re-type New Password', 'required|trim|min_length[1]');

		$post = $this->input->post();

		$username	= $this->input->post('username');
		$jabatan	= $this->input->post('jabatan');
		$smkt = $this->input->post('marketing');
		$new_password = $this->input->post('npassword');
		$rnew_password = $this->input->post('rpassword');

		if ($rnew_password != $new_password) {
			redirect('setup/pesan_eror3');
		} else {

			$data_usr = array(

				'pn_uname'		=> $username,
				'pn_name'		=> $username,
				'pn_pass'		=> md5($post['npassword']),
				'pn_jabatan'	=> $jabatan,
				'pn_wilayah'	=> 1,
				'insert_date'	=> date("Y-m-d"),
				'sts_marketing'	=> $smkt

			);

			$this->db->insert('dk_user', $data_usr);

			//echo '<script>alert("berhasil diubah")</script>';
			redirect('setup/pesan_berhasil2');
		}
	}

	public function ke_HapusUser()
	{
		$data['usr']		= $this->uri->segment(3);
		$this->load->view('setup/konfirm_hapus_user');
	}

	public function proses_hapus_user()
	{
		$usr		= $this->uri->segment(3);

		$this->db->query("DELETE FROM dk_user WHERE pn_name='$usr'");

		//$data['hps_usr']	= $this->Login_model->kill_user($usr);	

		$this->load->view('setup/konfirm_hapus_user2');
	}
}
