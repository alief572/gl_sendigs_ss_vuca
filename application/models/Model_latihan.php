<?php
class Model_latihan extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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

	public function get_COA_level5($bln_periode, $thn_periode, $kode_cabang)
	{
		$query	= "SELECT * FROM coa WHERE level='5' AND bln='$bln_periode' AND thn='$thn_periode' and kdcab='$kode_cabang' GROUP BY no_perkiraan";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function sum_saldo_5($ambil_nokir, $bln_periode, $thn_periode, $kode_cabang)
	{
		$query	= "SELECT sum(saldoawal) AS total FROM coa WHERE no_perkiraan LIKE '$ambil_nokir%' AND level='5' AND bln='$bln_periode' AND thn='$thn_periode' and kdcab='$kode_cabang'";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function sum_saldo_4($ambil_nokir2, $bln_periode, $thn_periode, $kode_cabang)
	{
		$query	= "SELECT sum(saldoawal) AS total2 FROM coa WHERE no_perkiraan LIKE '$ambil_nokir2%' AND level='4' AND bln='$bln_periode' AND thn='$thn_periode' and kdcab='$kode_cabang'";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_nokir()
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
		$query	= "SELECT * FROM coa WHERE level = '4' and bln = '$bln_periode' and thn = '$thn_periode' and kdcab = '$kode_cabang' order by no_perkiraan";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_tipe()
	{ //	coa tipe
		//$query	= "SELECT * from COA_tipe"; 
		$query	= "SELECT *,a.tipe,a.faktor from COA_tipe a join coa b on a.tipe = b.tipe";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}
	//======================================================= stock =======================================
	public function stock($kode_cabang, $bln_periode, $thn_periode)
	{

		$query	= "SELECT * from coa where bln='$bln_periode' and thn='$thn_periode' and kdcab='$kode_cabang'"; //	updated by Rindra
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function ambil_COA4()
	{
		$query = "SELECT * FROM coa WHERE level = '4'  ";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokirbr($id)
	{
		$query 	= "SELECT * from coa where no_perkiraan LIKE '$id%' AND level ='5'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_stock($id)
	{
		$query	= "select * from coa where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_add_stock()
	{
		// $id      	    = $this->input->post('id');
		$project   	    = substr($this->input->post('project'), 0, 8); // 1101-01-
		$no_perkiraan	= $this->input->post('no_perkiraan'); // 11
		$nokir1	= substr($no_perkiraan, 0, 1);
		$nokir2	= substr($no_perkiraan, 1, 1);
		if ($nokir2 == "") {
			$nokir_baru	= $project . "0" . $nokir1;
		} else {
			$nokir_baru	= $project . $nokir1 . $nokir2;
		}
		$nama	        = $this->input->post('nama');
		$kdcab		    = $this->input->post('kdcab');

		$bln		    = $this->input->post('bln');
		$thn		= $this->input->post('thn');

		// updated by Rindra
		$data	= array(
			// 'id'			=> "$id",
			'no_perkiraan'		=> $nokir_baru,
			'nama'		=> $nama,
			'kdcab'		=> $kdcab,

			'bln'	=> $bln,
			'thn'		=> $thn,
			'tmp' => "O",
			'level' => "5",
			'faktor' => "1"
		);
		$this->db->insert('coa', $data);
	}
	public function proses_edit_stock()
	{
		$id      	    = $this->input->post('id');
		$no_perkiraan	= $this->input->post('no_perkiraan');
		$nama	        = $this->input->post('nama');
		$kdcab		    = $this->input->post('kdcab');

		$bln		    = $this->input->post('bln');
		$thn		= $this->input->post('thn');

		$data	= array(
			// 'id'			=> "$id",
			'no_perkiraan'		=> $no_perkiraan,
			'nama'		=> $nama,
			'kdcab'		=> $kdcab,
			'saldoawal'		=> $saldoawal,
			'bln'	=> $bln,
			'thn'		=> $thn
		);
		$this->db->where('id', $id);
		$this->db->update('coa', $data);
	}

	function get_list_COA()

	{
		if ($this->input->post()) {
			$bln = $this->input->post('bln');
			$thn = $this->input->post('thn');

			if (empty($bln)) {
				$thnbln	= empty($thn) ? date('Y') : $thn;
			} else {
				$thnbln = date("Y-m", strtotime($thn . "-" . $bln . "-01"));
			}
			$kode_cabang	= $this->session->userdata('kode_cabang');
			$query	= "SELECT * from coa where (bln)='$bln' and (thn) = '$thn' and kdcab='$kode_cabang'";


			if ($bln == 0) {
				$kode_cabang	= $this->session->userdata('kode_cabang');

				$data_periode_aktif = $this->cek_periode_aktif();

				if ($data_periode_aktif > 0) {
					foreach ($data_periode_aktif as $row_pa_COA) {
						$tgl_periode = $row_pa_COA->periode;
						$bln_periode = substr($tgl_periode, 0, 2);
						$thn_periode = substr($tgl_periode, 3, 4);
					}
				}
				$query	= "SELECT * from coa where bln='$bln_periode' and thn = '$thn_periode' and kdcab='$kode_cabang'";
				$query	= $this->db->query($query);
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return 0;
				}
			} else {
				$kode_cabang	= $this->session->userdata('kode_cabang');
				$query	= "SELECT * from coa where bln='$bln' and thn = '$thn' and kdcab='$kode_cabang'";
				$query	= $this->db->query($query);
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return 0;
				}
			}
		}
	}

	public function print_data($id)
	{
		$query	= "select * from coa where id ='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	//======================================================= stock =======================================

	public function saldo()
	{
		$kode_cabang		= $this->session->userdata('kode_cabang');
		$cek_periode_aktif	= $this->cek_periode_aktif();
		if ($cek_periode_aktif > 0) {
			foreach ($cek_periode_aktif as $row_periode_aktif) {
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
				$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
			}
		}
		$query	= "SELECT * FROM coa where kdcab='$kode_cabang' and bln='$bln_aktif' and thn='$thn_aktif'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_add_saldo()
	{
		$id      	    = $this->input->post('id');
		$no_perkiraan	= $this->input->post('no_perkiraan');
		$nama	        = $this->input->post('nama');
		$kdcab		    = $this->input->post('kdcab');
		$saldoawal		= $this->input->post('saldoawal');
		$bln		    = $this->input->post('bln');
		$thn		= $this->input->post('thn');
		$level		= $this->input->post('level');

		$data	= array(
			'id'			=> "$id",
			'no_perkiraan'		=> $no_perkiraan,
			'nama'		=> $nama,
			'kdcab'		=> $kdcab,
			'saldoawal' => $saldoawal,
			'bln'	=> $bln,
			'thn'		=> $thn,
			'level'		=> $level,

		);
		$this->db->insert('coa', $data);
	}
	public function list_saldo($id)
	{
		$query	= "SELECT * FROM `coa` WHERE id ='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function proses_edit_saldo()
	{
		$id      	    = $this->input->post('id');
		$no_perkiraan	= $this->input->post('no_perkiraan');
		$nama	        = $this->input->post('nama');
		$kdcab		    = $this->input->post('kdcab');
		$saldoawal		= $this->input->post('saldoawal');
		$bln		    = $this->input->post('bln');
		$thn		= $this->input->post('thn');



		$data	= array(
			'id'			=> "$id",
			'no_perkiraan'		=> $no_perkiraan,
			'nama'		=> $nama,
			'kdcab'		=> $kdcab,
			'saldoawal'		=> $saldoawal,
			'bln'	=> $bln,
			'thn'		=> $thn,



		);
		$this->db->where('id', $id);
		$this->db->update('coa', $data);
	}

	public function print_saldo($id)
	{
		$query	= "select * from coa where id ='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_list_saldo()

	{
		if ($this->input->post()) {
			$kode_cabang		= $this->session->userdata('kode_cabang');
			$bln = $this->input->post('bln');
			$thn = $this->input->post('thn');
			$level = $this->input->post('level');

			if (empty($bln)) {
				$thnbln	= empty($thn) ? date('Y') : $thn;
			} else {
				$thnbln = date("Y-m", strtotime($thn . "-" . $bln . "-01"));
			}
			$query	= "SELECT * from coa where (bln)='$bln' and (thn) = '$thn' and kdcab='$kode_cabang'";
			// $query	= "SELECT * from coa where (bln)='$bln' and (thn) = '$thn' and level  LIKE '%5%'";


			if ($bln == 0) {
				$query	= "SELECT * from coa where kdcab='$kode_cabang' ";
				// $query	= "SELECT * from coa where level  LIKE '%5%' ";
				$query	= $this->db->query($query);
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return 0;
				}
			} else {
				$query	= "SELECT * from coa where bln='$bln' and thn = '$thn' and kdcab='$kode_cabang'";
				// $query	= "SELECT * from coa where bln='$bln' and thn = '$thn' and level  LIKE '%5%'";
				$query	= $this->db->query($query);
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return 0;
				}
			}
		}
	}
	public function posting()
	{
		$bln = date('m');
		$thn = date('Y');
		$query	= "SELECT *, SUM(saldoawal) as saldoawal from coa where level = '5' and kdcab= '201-A' and bln='$bln' and thn='$thn'
		GROUP BY no_perkiraan";

		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	//public function posting2($bln_periode,$thn_periode){
	public function posting2()
	{
		$query	= "SELECT no_perkiraan,level,kdcab,saldoawal, SUM(saldoawal) from coa GROUP BY level ";

		/*$query	= "SELECT SUM(saldoawal) from coa where level = '5' and kdcab= '201-A' and
			bln='$bln_periode' and thn='$thn_periode' GROUP BY no_perkiraan";
			*/
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
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

	//======================================================= JV =======================================

	function jv($no_cabang2)
	{
		//$query	= "SELECT * from coa where no_perkiraan LIKE '%6821-01-%' ORDER BY no_perkiraan";
		$query = "SELECT * from pastibisa_tb_cabang where nocab='$no_cabang2'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function proses_update()
	{
		//$id      	= $this->input->post('id');
		$js1		= $this->input->post('js1');
		$jp	        = $this->input->post('jp');
		$jo		    = $this->input->post('jo');
		$jc			= $this->input->post('jc');
		$jm		    = $this->input->post('jm');
		$jd			= $this->input->post('jd');

		$data	= array(
			//'id'		=> $id,
			'noJS'		=> $js1,
			'noJP'		=> $jp,
			'noJO'		=> $jo,
			'noJC'		=> $jc,
			'noJM'		=> $jm,
			'noJD'		=> $jd

		);

		//$this->db->where('id',$id);
		$this->db->update('pastibisa_tb_cabang', $data);
	}

	function cek_periode()
	{
		$singkat_cbg = $this->session->userdata('singkat_cbg');
		$query = "SELECT * FROM periode WHERE stsaktif='O' AND kdcab='$singkat_cbg'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	//====================================================== Trend ACcount ==============================================
	public function trend_accound($kode_cabang)
	{
		//$bln = date('m');
		if ($this->input->post()) {
			$thn = $this->input->post('thn');
		} else {
			//$thn = date('Y');

			$cek_periode2 = $this->cek_periode();
			if ($cek_periode2 > 0) {
				foreach ($cek_periode2 as $r_periode2) {
					$bln_thn2	= $r_periode2->periode;	// 12-2019
					$thn		= substr($bln_thn2, 3, 4);
				}
			}
		}

		//$pesan = echo "<script>alert('data tidak ada')</script>";

		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
			SUM(IF(bln='1',saldoawal+debet-kredit*faktor,0)) as jan,
			SUM(IF(bln='2',saldoawal+debet-kredit*faktor,0)) as feb,
			SUM(IF(bln='3',saldoawal+debet-kredit*faktor,0)) as mart,
			SUM(IF(bln='4',saldoawal+debet-kredit*faktor,0)) as apr,
			SUM(IF(bln='5',saldoawal+debet-kredit*faktor,0)) as mei,
			SUM(IF(bln='6',saldoawal+debet-kredit*faktor,0)) as jun,
			SUM(IF(bln='7',saldoawal+debet-kredit*faktor,0)) as jul,
			SUM(IF(bln='8',saldoawal+debet-kredit*faktor,0)) as agt,
			SUM(IF(bln='9',saldoawal+debet-kredit*faktor,0)) as sept,
			SUM(IF(bln='10',saldoawal+debet-kredit*faktor,0)) as okt,
			SUM(IF(bln='11',saldoawal+debet-kredit*faktor,0)) as nov,
			SUM(IF(bln='12',saldoawal+debet-kredit*faktor,0)) as des
			FROM coa
			WHERE thn= '$thn' and (level ='3' or  level = '5' ) and  kdcab = '$kode_cabang'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}

	public function list_account($kode_cabang)
	{
		if ($this->input->post()) {

			//$bln = $this->input->post('bln');
			$thn = $this->input->post('thn');

			// if (empty($bln)) {
			// 	$thnbln	= empty($thn) ? date('Y') : $thn;
			// } else {
			// 	$thnbln = date("Y-m",strtotime($thn."-".$bln."-01"));
			// }	 
			$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
				SUM(IF(bln='1',saldoawal+debet-kredit,0)) as jan,
				SUM(IF(bln='2',saldoawal+debet-kredit,0)) as feb,
				SUM(IF(bln='3',saldoawal+debet-kredit,0)) as mart,
				SUM(IF(bln='4',saldoawal+debet-kredit,0)) as apr,
				SUM(IF(bln='5',saldoawal+debet-kredit,0)) as mei,
				SUM(IF(bln='6',saldoawal+debet-kredit,0)) as jun,
				SUM(IF(bln='7',saldoawal+debet-kredit,0)) as jul,
				SUM(IF(bln='8',saldoawal+debet-kredit,0)) as agt,
				SUM(IF(bln='9',saldoawal+debet-kredit,0)) as sept,
				SUM(IF(bln='10',saldoawal+debet-kredit,0)) as okt,
				SUM(IF(bln='11',saldoawal+debet-kredit,0)) as nov,
				SUM(IF(bln='12',saldoawal+debet-kredit,0)) as des
				FROM coa
				WHERE thn= '$thn' and (level ='3' or  level = '5' ) and  kdcab = '$kode_cabang'
				GROUP BY no_perkiraan";

			$query	= $this->db->query($query);

			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
				//return echo "data tidak tersedia";
			}
		}
	}
	public function trend_accound3($kode_cabang, $nokircoa, $thn)
	{
		//$bln = date('m');
		//$thn = $this->input->post('thn');
		//$thn = date('Y');
		//$pesan = echo "<script>alert('data tidak ada')</script>";

		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn,
			SUM(IF(bln='1',saldoawal+debet-kredit*faktor,0)) as jan,
			SUM(IF(bln='2',saldoawal+debet-kredit*faktor,0)) as feb,
			SUM(IF(bln='3',saldoawal+debet-kredit*faktor,0)) as mart,
			SUM(IF(bln='4',saldoawal+debet-kredit*faktor,0)) as apr,
			SUM(IF(bln='5',saldoawal+debet-kredit*faktor,0)) as mei,
			SUM(IF(bln='6',saldoawal+debet-kredit*faktor,0)) as jun,
			SUM(IF(bln='7',saldoawal+debet-kredit*faktor,0)) as jul,
			SUM(IF(bln='8',saldoawal+debet-kredit*faktor,0)) as agt,
			SUM(IF(bln='9',saldoawal+debet-kredit*faktor,0)) as sept,
			SUM(IF(bln='10',saldoawal+debet-kredit*faktor,0)) as okt,
			SUM(IF(bln='11',saldoawal+debet-kredit*faktor,0)) as nov,
			SUM(IF(bln='12',saldoawal+debet-kredit*faktor,0)) as des
			FROM coa
			WHERE thn= '$thn' and (level ='3' or  level = '5' ) and  kdcab = '$kode_cabang' and no_perkiraan='$nokircoa'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}
	public function trend_accound4($kode_cabang)
	{
		//$bln = date('m');
		//$thn = $this->input->post('thn');
		$thn = date('Y');
		//$pesan = echo "<script>alert('data tidak ada')</script>";

		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn,
			SUM(IF(bln='1',saldoawal+debet-kredit*faktor,0)) as jan,
			SUM(IF(bln='2',saldoawal+debet-kredit*faktor,0)) as feb,
			SUM(IF(bln='3',saldoawal+debet-kredit*faktor,0)) as mart,
			SUM(IF(bln='4',saldoawal+debet-kredit*faktor,0)) as apr,
			SUM(IF(bln='5',saldoawal+debet-kredit*faktor,0)) as mei,
			SUM(IF(bln='6',saldoawal+debet-kredit*faktor,0)) as jun,
			SUM(IF(bln='7',saldoawal+debet-kredit*faktor,0)) as jul,
			SUM(IF(bln='8',saldoawal+debet-kredit*faktor,0)) as agt,
			SUM(IF(bln='9',saldoawal+debet-kredit*faktor,0)) as sept,
			SUM(IF(bln='10',saldoawal+debet-kredit*faktor,0)) as okt,
			SUM(IF(bln='11',saldoawal+debet-kredit*faktor,0)) as nov,
			SUM(IF(bln='12',saldoawal+debet-kredit*faktor,0)) as des
			FROM coa
			WHERE thn= '$thn' and (level ='3' or  level = '5' ) and  kdcab = '$kode_cabang'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}

	public function trend_accound2($kode_cabang, $id)
	{
		//$bln = date('m');
		$thn = date('Y');
		//$pesan = echo "<script>alert('data tidak ada')</script>";

		$query	= "SELECT id,kdcab,no_perkiraan,nama, 
			SUM(IF(bln='1',saldoawal+debet-kredit*faktor,0)) as jan,
			SUM(IF(bln='2',saldoawal+debet-kredit*faktor,0)) as feb,
			SUM(IF(bln='3',saldoawal+debet-kredit*faktor,0)) as mart,
			SUM(IF(bln='4',saldoawal+debet-kredit*faktor,0)) as apr,
			SUM(IF(bln='5',saldoawal+debet-kredit*faktor,0)) as mei,
			SUM(IF(bln='6',saldoawal+debet-kredit*faktor,0)) as jun,
			SUM(IF(bln='7',saldoawal+debet-kredit*faktor,0)) as jul,
			SUM(IF(bln='8',saldoawal+debet-kredit*faktor,0)) as agt,
			SUM(IF(bln='9',saldoawal+debet-kredit*faktor,0)) as sept,
			SUM(IF(bln='10',saldoawal+debet-kredit*faktor,0)) as okt,
			SUM(IF(bln='11',saldoawal+debet-kredit*faktor,0)) as nov,
			SUM(IF(bln='12',saldoawal+debet-kredit*faktor,0)) as des
			FROM coa
			WHERE thn= '$thn' and (level ='3' or  level = '5' ) and  kdcab = '$kode_cabang' and id = '$id'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}

	public function grafik_trend_accound($kode_cabang, $id)
	{
		//$bln = date('m');
		//	$thn = date('Y');
		//$pesan = echo "<script>alert('data tidak ada')</script>";

		$query	= "SELECT no_perkiraan,nama, 
			SUM(IF(bln='1',saldoawal+debet-kredit*faktor,0)) as jan,
			SUM(IF(bln='2',saldoawal+debet-kredit*faktor,0)) as feb,
			SUM(IF(bln='3',saldoawal+debet-kredit*faktor,0)) as mart,
			SUM(IF(bln='4',saldoawal+debet-kredit*faktor,0)) as apr,
			SUM(IF(bln='5',saldoawal+debet-kredit*faktor,0)) as mei,
			SUM(IF(bln='6',saldoawal+debet-kredit*faktor,0)) as jun,
			SUM(IF(bln='7',saldoawal+debet-kredit*faktor,0)) as jul,
			SUM(IF(bln='8',saldoawal+debet-kredit*faktor,0)) as agt,
			SUM(IF(bln='9',saldoawal+debet-kredit*faktor,0)) as sept,
			SUM(IF(bln='10',saldoawal+debet-kredit*faktor,0)) as okt,
			SUM(IF(bln='11',saldoawal+debet-kredit*faktor,0)) as nov,
			SUM(IF(bln='12',saldoawal+debet-kredit*faktor,0)) as des
			FROM coa
			WHERE id= '$id' and (level ='3' or  level = '5' )and thn= '$thn' and  kdcab = '$kode_cabang'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}

	public function get_namkir()
	{
		$bln = date('m');
		$thn = date('Y');
		$query = "SELECT DISTINCT nama from coa where bln = '$bln' AND thn = '$thn' AND level='3' or level='5'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function trend_account()
	{
		$bln = date('m');
		$thn = date('Y');
		$query = "SELECT DISTINCT no_perkiraan,nama,level from coa where bln = '$bln' AND thn = '$thn' AND level='3' or level='5'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function trend_account4()
	{
		$query = "SELECT * from coa WHERE bln='4' order by no_perkiraan ";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	//======================================================cabang==============================================

	public function cabang()
	{
		$query = "SELECT * from pastibisa_tb_cabang ";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_cab()
	{
		$query	= "select * from pastibisa_tb_cabang ";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	function proses_edit_cab()
	{

		$nocab			= $this->input->post('nocab');
		$subcab	        = $this->input->post('subcab');
		$cabang	   		= $this->input->post('cabang');
		$area			= $this->input->post('area');
		$spkid		    = $this->input->post('spkid');
		$kdcab			= $this->input->post('kdcab');
		$nofak			= $this->input->post('nofak');
		$nocust			= $this->input->post('nocust');
		$nosales		= $this->input->post('nosales');
		$lastupdate		= $this->input->post('lastupdate');
		$kepala			= $this->input->post('kepala');
		$alamat			= $this->input->post('alamat');
		$namacabang		= $this->input->post('namacabang');
		$kabagjualan	= $this->input->post('kabagjualan');
		$kepalacabang	= $this->input->post('kepalacabang');
		$admcabang		= $this->input->post('admcabang');
		$gudang			= $this->input->post('gudang');


		$data	= array(

			'nocab'			=> $nocab,
			'subcab'		=> $subcab,
			'cabang'		=> $cabang,
			'area'			=> $area,
			'spkid'			=> $spkid,
			'kdcab'			=> $kdcab,
			'nofak'			=> $nofak,
			'nocust'		=> $nocust,
			'nosales'		=> $nosales,
			'lastupdate'	=> $lastupdate,
			'kepala'		=> $kepala,
			'alamat'		=> $alamat,
			'namacabang'	=> $namacabang,
			'kabagjualan'	=> $kabagjualan,
			'kepalacabang'	=> $kepalacabang,
			'admcabang'		=> $admcabang,
			'gudang'		=> $gudang

		);

		$this->db->update('pastibisa_tb_cabang', $data);
	}

	public function cek_nokir1()
	{
		$bulan = date('m');
		$tahun = date('Y');
		$query	= "SELECT * FROM coa WHERE level = '5' and bln = '$bulan' and thn = '$tahun' order by no_perkiraan";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function cek_nokir2($id)
	{
		$bulan = date('m');
		$tahun = date('Y');
		$query	= "SELECT * FROM coa WHERE level = '5' and bln = '$bulan' and thn = '$tahun' and no_perkiraan='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function inputjvcost()
	{
		$nojvcost		= $this->get_no_jvcost();
		$bln1 		= $this->input->post('bulan');
		$thn1 		= $this->input->post('tahun');
		$koreksi 		= $this->input->post('koreksi');
		$kode 		= $this->input->post('kode');
		$trans 		= $this->input->post('trans');
		$project 		= $this->input->post('project');
		$nama 		= $this->input->post('nama');
		$debet 		= $this->input->post('debet');
		$kredit 		= $this->input->post('kredit');
		$tanggal 		= $this->input->post('tanggal');
		$koreksi = $this->input->post('koreksi');
		$ket = $this->input->post('ket');
		$noperkiraan = $this->input->post('project');
		$jenis = $this->input->post('trans');

		//insert ke javh
		$data1	= array(
			'nomor'         => $nojvcost,
			'tgl'       	=> $tanggal,
			'tahun' 		=> $thn1,
			'bulan'    		=> $bln1,
			'kdcab'      	=> $kode,
			'jml'        	=> $debet,
			'koreksi_no'    => $koreksi,
			'jenis'			=> "V",
			'keterangan'	=> $ket

		);

		//insert jurnal
		$data2 = array(
			'tipe'				=> "JC",
			'nomor'        		=> $nojvcost,
			'tanggal'       	=> $tanggal,
			'no_perkiraan'		=> $noperkiraan,
			'keterangan'		=> $ket,
			'jenis_trans' => $jenis,
			'no_reff' => "0",
			'debet'        	=> $debet,
			'kredit'        	=> $kredit,
			'stspos' => "0",
			'stsedit' => "0"
		);
		$this->db->insert('jurnal', $data2);
		$this->db->insert('javh', $data1);

		$ambilnojvc = substr($nojvcost, 10, 4);
		$data3 = array('nomorJC' => $ambilnojvc);
		$this->db->update("pastibisa_tb_cabang", $data3);
	}



	public function get_no_jvcost()
	{
		$query 	= "select nocab,subcab,nomorJC from pastibisa_tb_cabang order by id";
		$q 		= $this->db->query($query);

		if ($q->num_rows() > 0) {
			$ret =  $q->result();
			$kd_cab = $ret[0]->nocab;
			$min = "-";
			$sub_cab = $ret[0]->subcab;
			$jv = "JC";
			$kdadd			= "";
			$kd_jc		= $ret[0]->nomorJC + 1;
			if (strlen($kd_jc) == 1) {
				$kdadd		= "0000";
			} else if (strlen($kd_jc) == 2) {
				$kdadd		= "000";
			} else if (strlen($kd_jc) == 3) {
				$kdadd		= "00";
			} else if (strlen($kd_jc) == 4) {
				$kdadd		= "0";
			} else {
				$kdadd		= '0';
			}
			$thn			= date("y");



			$id = $kd_cab . $min . $sub_cab . $jv . $thn . $kdadd . $kd_jc;
			//$kodebuk = $qkd_cbg.$id;
			return $id;
		} else {
			return Null;
		}
	}

	function get_list_jvcoz()
	{ //combobox jvCoz	
		if ($this->input->post()) {
			$bln = $this->input->post('bln');
			$thn = $this->input->post('thn');
			if (empty($bln)) {
				$thnbln	= empty($thn) ? date('Y') : $thn;
			} else {
				$thnbln = date("Y-m", strtotime($thn . "-" . $bln . "-01"));
			}
			$query = "SELECT * from javh where bulan='$bln' and tahun='$thn'";
			$query	= $this->db->query($query);

			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
				//return echo "data tidak tersedia";
			}
		}
	}
	//====================================================== view ledger in query n query control==============================================
	//ledger_in_qery
	public function led_inq($bln_aktif, $thn_aktif, $kode_cabang)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM coa WHERE bln='$bln_aktif' and thn='$thn_aktif' AND level='3' and kdcab='$kode_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	//ledger_control
	public function ledger_control($bln_aktif, $thn_aktif, $kode_cabang)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM coa WHERE bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang' ";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function get_list_ledger_cont($bln_aktif, $thn_aktif, $kode_cabang) 
	{
		if ($this->input->post()) {
			$level = $this->input->post('level');
			// print_r($level);
			// exit;
			if ($level == '0') {
				$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM coa WHERE bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang' ";
			} else {
				$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM coa WHERE level='$level' and bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang' ";
			}
			$query 	= $this->db->query($query);
			if ($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}
	}
	
	public function excel_control($bln_aktif, $thn_aktif)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM coa WHERE bln='$bln_aktif' and thn='$thn_aktif'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	//SYAM 07-12-2020
	public function excel_control_level($bln_aktif, $thn_aktif, $level)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM coa WHERE level='$level' and bln='$bln_aktif' and thn='$thn_aktif'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	function ledger_lev3($id, $kode_cabang)
	{
		$query = "SELECT * FROM coa where  id='$id' and kdcab='$kode_cabang' ";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function ledger_lev4($nokir1, $bln_aktif, $thn_aktif, $kode_cabang)
	{
		$query = "SELECT * FROM coa where  no_perkiraan like '$nokir1%' and level='4' and bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	function ledger_lev5($nokir1, $bln_aktif, $thn_aktif, $kode_cabang)
	{
		$query = "SELECT * FROM coa where  no_perkiraan like '$nokir1%' and level='5' and bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang' ";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	function ledger_jurnal($nokir3, $var_tgl_awal, $var_tgl_akhir, $kode_cabang)
	{
		$query = "SELECT * FROM jurnal where  tanggal between  '$var_tgl_awal'and '$var_tgl_akhir' and no_perkiraan like '$nokir3%' and nomor like'$kode_cabang%'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function excel_inquery($bln_aktif, $thn_aktif)
	{
		$query = " SELECT *,saldoawal+debet-kredit as saldoakhir FROM coa WHERE bln='$bln_aktif' and thn='$thn_aktif' AND level='3' ";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	

	function update_nobuk()
	{
		//$id      	= $this->input->post('id');
		$nobuk		= $this->input->post('buk');
		$data	= array(
			//'id'		=> $id,
			'nobuk'		=> $nobuk
		);
		$this->db->where('nocab', $this->session->userdata('nomor_cabang'));
		$this->db->update('pastibisa_tb_cabang', $data);
	}


	function update_nobum()
	{
		//$id      	= $this->input->post('id');
		$nobum		= $this->input->post('bum');
		$data	= array(
			//'id'		=> $id,
			'nobum'		=> $nobum
		);
		$this->db->where('nocab', $this->session->userdata('nomor_cabang'));
		$this->db->update('pastibisa_tb_cabang', $data);
	}

	public function get_list_cabang()
	{
		$query	= "SELECT id,nocab,subcab,cabang,area,kdcab,alamat,namacabang,perusahaan from pastibisa_tb_cabang";
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
			'namacabang' 	=>  $nama_cabang,
			'perusahaan' 	=>  $perusahaan

		);
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
			'id'			=> "$id",
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
		$query	= "SELECT id,nocab,subcab,cabang,area,kdcab,alamat,namacabang,perusahaan from pastibisa_tb_cabang where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_coa_master()
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query	= "SELECT id,no_perkiraan,nama,kdcab from coa_master where kdcab='$kode_cabang' AND bln='11' and thn='2019'";
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
		$query	= "SELECT * FROM coa WHERE level = '4' and bln = '$bln_periode' and thn = '$thn_periode' and kdcab = '$kode_cabang' order by no_perkiraan";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function cek_coatipe($Lv_2)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query	= "SELECT * from coa_tipe where coa='$Lv_2'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function cek_ketersediaan_coa($no_perkiraan, $kdcab, $bln, $thn)
	{

		$query	= "SELECT * from coa where no_perkiraan='$no_perkiraan' and kdcab='$kdcab' and bln='$bln' and thn='$thn'";
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
				$COA2	= $brs_coatipe->coa;
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
		$this->db->insert('coa', $data);

		$transaksi = "Tambah coa baru oleh " . $this->session->userdata('pn_name') . " no.coa : " . $no_perkiraan;
		$add_log = array(
			'transaksi' => $transaksi,
			'nama_user' => $this->session->userdata('pn_name'),
			'waktu' => date('Y-m-d H:i:s')
		);
		$this->db->insert('log_transaksi', $add_log);
	}
	public function get_nokirbr2($id)
	{
		$query 	= "SELECT * from coa_master where no_perkiraan LIKE '$id%' AND level ='5'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_tipe2()
	{ //	coa tipe
		//$query	= "SELECT * from COA_tipe"; 
		$query	= "SELECT *,a.tipe,a.faktor from COA_tipe a join coa_master b on a.tipe = b.tipe";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	public function get_edit_coa_master($id)
	{
		$query	= "SELECT id,no_perkiraan,nama,kdcab from coa_master where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
