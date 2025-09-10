<?php
class Model_latihan2 extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_COA3($bln_aktif, $thn_aktif)
	{ //	updated by Rindra
		$query	= "SELECT * from COA where level='3' and bln='$bln_aktif' and thn='$thn_aktif'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_list_kode_cabang()
	{ //	updated by Rindra
		$singkat_cabang	= $this->session->userdata('singkat_cbg');
		$query	= "SELECT * from pastibisa_tb_cabang where kdcab='$singkat_cabang'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_nokir()
	{ //	updated by Rindra
		$bulan = date('m');
		$tahun = date('Y');
		$query	= "SELECT * FROM COA WHERE level = '4' and bln = '$bulan' and thn = '$tahun' order by no_perkiraan";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_tipe()
	{ //	COA tipe
		//$query	= "SELECT * from COA_tipe"; 
		$query	= "SELECT *,a.tipe,a.faktor from COA_tipe a join COA b on a.tipe = b.tipe";
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
	public function stock()
	{
		$bln_aktif = date('m');	//	updated by Rindra
		$thn_aktif = date('Y');	//	updated by Rindra
		$query	= "select * from COA where bln='$bln_aktif' and thn='$thn_aktif'"; //	updated by Rindra
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function ambil_COA4()
	{
		$query = "SELECT * FROM COA WHERE level = '4'  ";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
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

	public function list_stock($id)
	{
		$query	= "select * from COA where id='$id'";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_add_stock()
	{
		$id      	    = $this->input->post('id');
		$no_perkiraan	= $this->input->post('no_perkiraan');
		$nama	        = $this->input->post('nama');
		$kdcab		    = $this->input->post('kdcab');

		$bln		    = $this->input->post('bln');
		$thn		= $this->input->post('thn');

		// updated by Rindra
		$data	= array(
			'id'			=> "$id",
			'no_perkiraan'		=> $no_perkiraan,
			'nama'		=> $nama,
			'kdcab'		=> $kdcab,

			'bln'	=> $bln,
			'thn'		=> $thn,
			'tmp' => "O",
			'level' => "5",
			'faktor' => "1"
		);
		$this->db->insert('COA', $data);
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
			'id'			=> "$id",
			'no_perkiraan'		=> $no_perkiraan,
			'nama'		=> $nama,
			'kdcab'		=> $kdcab,
			'saldoawal'		=> $saldoawal,
			'bln'	=> $bln,
			'thn'		=> $thn,


		);
		$this->db->where('id', $id);
		$this->db->update('COA', $data);
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
			$query	= "select * from COA where (bln)='$bln' and (thn) = '$thn'";


			if ($bln == 0) {
				$query	= "select * from COA";
				$query	= $this->db->query($query);
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return 0;
				}
			} else {
				$query	= "select * from COA where bln='$bln' and thn = '$thn'";
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
		$query	= "select * from COA where id ='$id'";
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
		$query	= "SELECT * FROM COA";
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
		$this->db->insert('COA', $data);
	}
	public function list_saldo($id)
	{
		$query	= "SELECT * FROM COA WHERE id ='$id'";
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
		$this->db->update('COA', $data);
	}

	public function print_saldo($id)
	{
		$query	= "select * from COA where id ='$id'";
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
			$bln = $this->input->post('bln');
			$thn = $this->input->post('thn');
			$level = $this->input->post('level');

			if (empty($bln)) {
				$thnbln	= empty($thn) ? date('Y') : $thn;
			} else {
				$thnbln = date("Y-m", strtotime($thn . "-" . $bln . "-01"));
			}
			$query	= "select * from COA where (bln)='$bln' and (thn) = '$thn' and level  LIKE '%5%'";


			if ($bln == 0) {
				$query	= "select * from COA where level  LIKE '%5%' ";
				$query	= $this->db->query($query);
				if ($query->num_rows() > 0) {
					return $query->result();
				} else {
					return 0;
				}
			} else {
				$query	= "select * from COA where bln='$bln' and thn = '$thn' and level  LIKE '%5%'";
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
		$query	= "SELECT SUM (saldoawal) from COA where level = '5' and kdcab= '201-A' and bln='$bln' and thn='$thn'
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
		$query	= "SELECT no_perkiraan,level,kdcab,saldoawal, SUM(saldoawal) from COA GROUP BY level ";

		/*$query	= "SELECT SUM(saldoawal) from COA where level = '5' and kdcab= '201-A' and
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

	function jv()
	{
		//$query	= "SELECT * from COA where no_perkiraan LIKE '%6821-01-%' ORDER BY no_perkiraan";
		$query = "SELECT * from pastibisa_tb_cabang where nocab='201'";
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

	//====================================================== Trend ACcount ==============================================
	public function trend_accound()
	{
		//$bln = date('m');
		$thn = date('Y');
		//$pesan = echo "<script>alert('data tidak ada')</script>";

		$query	= "SELECT no_perkiraan,nama, 
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
	FROM COA
	WHERE thn= '$thn' and (level ='3' or  level = '5' )
	GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}

	public function list_account()
	{
		if ($this->input->post()) {
			$bln = $this->input->post('bln');
			$thn = $this->input->post('thn');


			if (empty($bln)) {
				$thnbln	= empty($thn) ? date('Y') : $thn;
			} else {
				$thnbln = date("Y-m", strtotime($thn . "-" . $bln . "-01"));
			}
			$query	= "SELECT no_perkiraan,nama, 
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
	FROM COA
	WHERE thn= '$thn' and (level ='3' or  level = '5' )
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
	public function grafik()
	{
		//$bln = date('m');
		$thn = date('Y');
		//$pesan = echo "<script>alert('data tidak ada')</script>";

		$query	= "SELECT no_perkiraan,nama, 
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
FROM COA
WHERE thn= '$thn' and (level ='3' or  level = '5' )
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
		$query = "SELECT DISTINCT nama from COA where bln = '$bln' AND thn = '$thn' AND level='3' or level='5'";
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
		$query = "SELECT DISTINCT no_perkiraan,nama,level from COA where bln = '$bln' AND thn = '$thn' AND level='3' or level='5'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function trend_account4()
	{
		$query = "SELECT * from COA WHERE bln='4' order by no_perkiraan ";
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
	//======================================================list_JV==============================================

	public function list_jv($bln_aktif, $thn_aktif)
	{
		$query = "SELECT * from javh where bulan='$bln_aktif' and tahun='$thn_aktif'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function detail_list_jv($var_tgl_awal, $var_tgl_akhir)
	{
		$bulan = date('m');
		$tahun = date('Y');
		$query = "SELECT * FROM  jurnal where tanggal between  '$var_tgl_awal'and '$var_tgl_akhir' and nomor like '%J%'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_nokir1()
	{
		$bulan = date('m');
		$tahun = date('Y');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query	= "SELECT * FROM COA WHERE level = '5' and bln = '$bulan' and thn = '$tahun' and kdcab='$kode_cabang' order by no_perkiraan";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function cek_nokir2($id, $bln_periode, $thn_periode)
	{
		// $bulan = date ('m');
		// $tahun = date ('Y');
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query	= "SELECT * FROM COA WHERE kdcab='$kode_cabang' and no_perkiraan='$id' and bln='$bln_periode' and thn='$thn_periode' ";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function inputJvCost()
	{
		$nojvcost		= $this->get_no_jvcost();
		$Tgl_Jurnal_	= $this->input->post('tanggal');
		$tanggal		= date("Y-m-d", strtotime($Tgl_Jurnal_));;
		//$tanggal 		= $this->input->post('tanggal');
		$total_debet	= str_replace(',', '', $this->input->post('total'));
		$total_kredit	= str_replace(',', '', $this->input->post('totall'));
		// $total			= $total_debet - $total_kredit;
		$koreksi 		= $this->input->post('koreksi');
		// $kode 			= $this->input->post('kode'); // 202-A
		$kode 			= $this->session->userdata('nomor_cabang');
		// $jenistransf	= $this->input->post('jenistransf');
		$ket 			= $this->input->post('ket');
		$bln1 			= $this->input->post('bulan');
		$thn1 			= $this->input->post('tahun');

		//insert ke javh
		$data_javh	= array(
			'nomor'         => $nojvcost,
			'tgl'       	=> $tanggal,
			'jml'        	=> $total_debet,
			'koreksi_no'    => $koreksi,
			'kdcab'      	=> $kode,
			'jenis'			=> "V",
			'keterangan'	=> $ket,
			'bulan'    		=> $bln1,
			'tahun' 		=> $thn1
		);

		//insert ke jarh
		$data_jarh	= array(
			'nomor'         => $nojvcost,
			'tgl'       	=> $tanggal,
			'jml'        	=> $total_debet,
			'kdcab'      	=> $kode,
			'jenis_reff'   	=> "",
			'no_reff'   	=> $koreksi,
			'jenis_ar'		=> "V",
			'note'			=> $ket
		);

		$det_Detail		= $this->input->post('detail');

		$Detail_BUM			= array();

		// insert ke jurnal
		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_Coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',', '', $vals['jumlah']);
			$nilai_kredit		= str_replace(',', '', $vals['jumlahh']);

			$Detail_BUM[$intL]	= array(
				'nomor'         => $nojvcost,
				'tanggal'       => $tanggal,
				'tipe'          => 'JV',
				'no_perkiraan'  => $Kode_Coa[0],
				'keterangan'    => $descr,
				'jenis_trans'   => "",
				'no_reff'       => $no_reff,
				'debet'         => $nilai_debet,
				'kredit'        => $nilai_kredit
			);
		}

		$this->db->insert('javh', $data_javh);
		$this->db->insert("jarh", $data_jarh);
		$this->db->insert_batch("jurnal", $Detail_BUM);

		//update last nomorJC ke pastibisa_tb_cabang	
		$nomor_cabang = $this->session->userdata('nomor_cabang');
		$ambilnojvc = substr($nojvcost, 10, 4);
		$data3 = array('nomorJC' => $ambilnojvc);
		$this->db->where("nocab", $nomor_cabang);
		$this->db->update("pastibisa_tb_cabang", $data3);
	}

	public function get_no_jvcost()
	{
		$nomor_cabang	= $this->session->userdata('nomor_cabang');
		$query 	= "SELECT nocab,subcab,nomorJC from pastibisa_tb_cabang WHERE nocab='$nomor_cabang' order by id";
		$q 		= $this->db->query($query);

		if ($q->num_rows() > 0) {
			$ret =  $q->result();
			$kd_cab = $ret[0]->nocab;
			$min = "-";
			$sub_cab = $ret[0]->subcab;
			$jv = "JV";
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
	{
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

	public function led_inq($var_tgl_awal, $var_tgl_akhir, $bln_aktif,	$thn_aktif)
	{
		$bulan = date('m');
		$tahun = date('Y');
		$query = " SELECT a.no_perkiraan,  a.nama, a.saldoawal, b.debet ,b.kredit
	from COA a
inner join jurnal b
	on a.no_perkiraan = b.no_perkiraan where tanggal between  '$var_tgl_awal'and '$var_tgl_akhir' and bln='$bln_aktif' and thn='$thn_aktif' order by no_perkiraan	";
		$query 	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
}
