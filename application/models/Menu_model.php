<?php
class Menu_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function m_get_menu_utama($pn_jabatan)
	{
		$query 	= "select a.nm_menu,a.id_menu,a.url,a.img,a.urutan,a.jenis,b.r,b.d,b.u from dk_menu as a join dk_menu_akses as b on a.id_menu = b.id_menu where tampil = 'Y' and parent = '0' and jabatan='$pn_jabatan' and b.r='Y' ORDER BY urutan ASC";
		$q 		= $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return Null;
		}
	}

	public function m_get_submenu($pn_jabatan, $id_menu)
	{
		$query 	= "select a.nm_menu,a.url,a.urutan,a.jenis,b.r,b.d,b.u from dk_menu as a join dk_menu_akses as b on a.id_menu = b.id_menu where tampil = 'Y' and parent = '$id_menu' and jabatan='$pn_jabatan' and b.r='Y' ORDER BY a.urutan,a.nm_menu ASC";
		$q 		= $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return Null;
		}
	}

	public function check_active_submenu($parent)
	{
		$query	= "SELECT url FROM dk_menu WHERE parent='$parent'";
		$q 		= $this->db->query($query);
		if ($q->num_rows() > 0) {
			$result	= $q->result();
			foreach ($result as $row) {
				if (site_url('/') . $row->url == current_url()) {
					return true;
				}
			}
		} else {
			return false;
		}
	}

	public function m_get_menu($parent)
	{
		$query 	= "SELECT *FROM dk_menu WHERE parent='$parent' AND tampil ='Y'";
		$q 		= $this->db->query($query);
		if ($q->num_rows() > 0) {
			return $q->result();
		} else {
			return Null;
		}
	}
	public function cek_akses($id_menu, $pn_uid)
	{
		$query 	= "SELECT r,u,d FROM dk_menu_akses WHERE id_user='$pn_uid' AND id_menu='$id_menu'";
		$q 		= $this->db->query($query);
		if ($q->num_rows() > 0) {
			$ret 	= $q->row();
			$hasil  = $ret->r;
			return $hasil;
		} else {
			return Null;
		}
	}

	function get_daftar()
	{
		$query	= "select * from dk_menu where parent='0' order by urutan,nm_menu";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_urutan()
	{
		$query	= "select urutan from dk_menu where parent='0'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function sub_menu($id_menu)
	{
		$query	= "select * from dk_menu where parent='$id_menu'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	//note jangan ada row yg hilang, nanti error. tidak boleh hapus record database menu
	function update_menu()
	{
		
		
		$tampil			= $this->input->post('tampil');
		$id_menu		= $this->input->post('id_menu');
		$nama_urut		= $this->input->post('nama_urut');
		for ($i = 1; $i <= count($nama_urut); $i++) {
			$query	= "update dk_menu set urutan='" . $nama_urut[$i] . "' where id_menu='" . $id_menu[$i] . "'";
			$query 	= $this->db->query($query);
		}
		for ($i = 1; $i <= count($tampil); $i++) {
			$query	= "update dk_menu set tampil='" . $tampil[$i] . "' where id_menu='" . $i . "'";
			$query 	= $this->db->query($query);
		}
	}

	function list_user()
	{
		$query	= "select * from dk_user";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function jabatan()
	{
		$query	= "select * from dk_jabatan where sts='1'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function cabang()
	{
		$query	= "select * from dk_cabang where sts='1'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_user($pn_id)
	{
		$query	= "select * from dk_user where pn_id = '$pn_id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_wilayah($kd_wil)
	{
		$query	= "select nm_cabang from dk_cabang where id='$kd_wil'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			$ret = $query->result();
			return $ret[0]->nm_cabang;
		} else {
			return 0;
		}
	}

	function get_jabatan($kd_jab)
	{
		$query	= "select nm_jabatan from dk_jabatan where id='$kd_jab'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			$ret = $query->result();
			return $ret[0]->nm_jabatan;
		} else {
			return 0;
		}
	}

	function proses_edit()
	{
		$pn_id			= $this->input->post('pn_id');
		$pn_uname		= $this->input->post('pn_uname');
		$pn_name		= $this->input->post('pn_name');
		$pn_pass		= $this->input->post('pn_pass');
		$pn_pass_new	= $this->input->post('pn_pass_new');
		$pn_jabatan		= $this->input->post('pn_jabatan');
		$pn_wilayah		= $this->input->post('pn_wilayah');
		$pn_akses		= $this->input->post('pn_akses');
		$marketing		= $this->input->post('marketing');
		if ($pn_pass_new == "") {
			$data	= array(
				'pn_name'		=> $pn_name,
				'pn_jabatan'	=> $pn_jabatan,
				'pn_wilayah'	=> $pn_wilayah,
				'pn_akses'		=> $pn_akses,
				'sts_marketing'	=> $marketing,
				'update_date'	=> date("Y-m-d")
			);
		} else {
			$data	= array(
				'pn_name'		=> $pn_name,
				'pn_pass'		=> md5($pn_pass_new),
				'pn_jabatan'	=> $pn_jabatan,
				'pn_wilayah'	=> $pn_wilayah,
				'pn_akses'		=> $pn_akses,
				'sts_marketing'	=> $marketing,
				'update_date'	=> date("Y-m-d")
			);
		}
		$this->db->where('pn_id', $pn_id);
		$this->db->update('dk_user', $data);
		// $data2 = array ('nosales'	=> $pn_id,
		// 					'nama' 	=> $pn_name,
		// 					'kategori' => $pn_jabatan
		// 				);
		// $this->db->where('nosales',$pn_id);
		// $this->db->update('dk_master_salesman',$data2);
	}

	function proses_tambah()
	{
		$pn_id			= $this->input->post('pn_id');
		$pn_uname		= $this->input->post('pn_uname');
		$pn_name		= $this->input->post('pn_name');
		$pn_pass		= $this->input->post('pn_pass');
		$pn_jabatan		= $this->input->post('pn_jabatan');
		$pn_wilayah		= $this->input->post('pn_wilayah');
		$pn_akses		= $this->input->post('pn_akses');
		$marketing		= $this->input->post('marketing');
		$q_user			= $this->db->query("select c_user from dk_counter where id='$pn_wilayah'");
		$ret 			= $q_user->result();
		$kd_user		= $ret[0]->c_user + 1;
		$kdadd			= "";
		if (strlen($kd_user) == 1) {
			$kdadd		= "0000";
		} else if (strlen($kd_user) == 2) {
			$kdadd		= "000";
		} else if (strlen($kd_user) == 3) {
			$kdadd		= "00";
		} else if (strlen($kd_user) == 4) {
			$kdadd		= "0";
		} else {
			$kdadd		= "";
		}
		$thnbln			= date("ym");
		$pn_id			= $pn_wilayah . $thnbln . $kdadd . $kd_user;
		$data	= array(
			'pn_id'			=> $pn_id,
			'pn_uname'		=> $pn_uname,
			'pn_name'		=> $pn_name,
			'pn_pass'		=> md5($pn_pass),
			'pn_jabatan'	=> $pn_jabatan,
			'pn_wilayah'	=> $pn_wilayah,
			'pn_akses'		=> $pn_akses,
			'sts_marketing'	=> $marketing,
			'insert_date'	=> date("Y-m-d")
		);
		$this->db->insert('dk_user', $data);
		$this->db->query("update dk_counter set c_user ='$kd_user' where id='$pn_wilayah'");
		$data2 = array(
			'nosales'	=> $pn_id,
			'nama' 	=> $pn_name,
			'kategori' => $pn_jabatan
		);
		// $this->db->insert('dk_master_salesman', $data2);
		return $pn_id;
	}

	function get_menu()
	{
		$query	= "select * from dk_menu";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_all_menu($id_jab, $id_menu)
	{
		$query	= "select r,u,d from dk_menu_akses where jabatan='$id_jab' and id_menu='$id_menu'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_jabatan2($id_jab)
	{
		$query	= "select nm_jabatan from dk_jabatan where id='$id_jab'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			$res = $query->result();
			return $res[0]->nm_jabatan;
		} else {
			return 0;
		}
	}

	function get_mark($id_jab)
	{
		$query	= "select sts_marketing from dk_user where pn_id='$id_jab'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			$res = $query->result();
			return $res[0]->sts_marketing;
		} else {
			return 0;
		}
	}

	function proses_menu_akses()
	{
		$data = $this->input->post();

		// print_r ($data);
		// exit;

		$jabatan	= $this->input->post('jabatan');
		$id_menu	= $this->input->post('id_menu');
		$r			= $this->input->post('r');
		$u			= $this->input->post('u');
		$d			= $this->input->post('d');
		$this->db->query("delete from dk_menu_akses where jabatan='$jabatan'");
		for ($i = 0; $i < count($id_menu); $i++) {
			$index	= $id_menu[$i];
			if (!empty($r[$index])) {
				$r[$index] = "Y";
			} else {
				$r[$index] = "N";
			}
			if (!empty($u[$index])) {
				$u[$index] = "Y";
			} else {
				$u[$index] = "N";
			}
			if (!empty($d[$index])) {
				$d[$index] = "Y";
			} else {
				$d[$index] = "N";
			}
			$data	= array(
				'id'		=> $jabatan . '-' . $i,
				'jabatan'	=> $jabatan,
				'id_menu'	=> $id_menu[$i],
				'r'			=> $r[$index],
				'u'			=> $u[$index],
				'd'			=> $d[$index]
			);
			$this->db->insert("dk_menu_akses", $data);
		}
	}

	function proses_add_jab()
	{
		$sts_jab	= $this->input->post('sts_jab');
		$nm_jab		= $this->input->post('nm_jab');
		$q_user		= $this->db->query("select max(id) as id from dk_jabatan");
		$ret 		= $q_user->result();
		$id			= $ret[0]->id + 1;
		$data	= array(
			'id'			=> $id,
			'nm_jabatan'	=> $nm_jab,
			'sts'			=> $sts_jab
		);
		$this->db->insert("dk_jabatan", $data);
	}

	function proses_add_cab()
	{
		$sts_cab	= $this->input->post('sts_cab');
		$nm_cab		= $this->input->post('nm_cab');
		$q_user		= $this->db->query("select max(id) as id from dk_cabang");
		$ret 		= $q_user->result();
		$id			= $ret[0]->id + 1;
		$data	= array(
			'id'			=> $id,
			'nm_cabang'		=> $nm_cab,
			'sts'			=> $sts_cab
		);
		$this->db->insert("dk_cabang", $data);
		$this->db->query("insert into dk_counter(id) values('$id')");
	}
}
