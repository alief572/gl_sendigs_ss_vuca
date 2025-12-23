<?php 
	class Report_model extends CI_Model{
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
	
	public function get_coa_sa($filter_nokir,$filter_nokir2,$var_bulan,$var_tahun){
			$query 	= "SELECT * from COA where no_perkiraan between '$filter_nokir' and '$filter_nokir2' and bln='$var_bulan' and thn='$var_tahun' and level='5' order by no_perkiraan";

			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	}

	public function get_detail_jurnal($filter_nokir,$filter_nokir2,$var_tgl_awal,$var_tgl_akhir){
		$query 	= "SELECT * from jurnal where no_perkiraan between '$filter_nokir' and '$filter_nokir2' and tanggal between '$var_tgl_awal' and '$var_tgl_akhir' order by no_perkiraan";
		
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}

	public function get_bulan_coa(){
			$query 	= "SELECT DISTINCT bln from COA";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	}

	public function get_tahun_coa(){
		$query 	= "SELECT DISTINCT thn from COA";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	public function get_project(){
			$query 	= "select * from dk_penawaran where sts_prospek = '2'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	}

	public function list_jurnal(){
		
		$query 	= "SELECT * FROM jurnal ORDER BY tanggal DESC";
		
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		
	}

	public function get_nokir_filter(){
		$var_nokir	= $this->input->post('filter_nokir');
		$ambilnokir = substr($var_nokir,0,10);
		
		$query 	= "SELECT * FROM jurnal WHERE no_perkiraan = '$ambilnokir' ORDER BY no_perkiraan ASC";
		
		
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}	
	}

	public function get_nokir(){
		$var_nokir	= $this->input->post('filter_nokir');
		$ambilnokir = substr($var_nokir,0,10);
		
		$query 	= "SELECT * FROM jurnal WHERE no_perkiraan = $ambilnokir ORDER BY no_perkiraan ASC";
		
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		
	}

	public function filter_tgl_jurnal($tanggal,$tanggal2){
		
		$query 	= "SELECT
						*
					FROM
						jurnal
					WHERE						
					(tanggal >= '$tanggal'
						  AND tanggal <= '$tanggal2') 
					ORDER BY
						  tanggal ASC";

		//	echo $query;
			//exit; 
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	}
    
		public function list_dana_keluar(){					
			$query 	= "SELECT * from japh order by nomor desc";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function list_dana_masuk(){					
			$query 	= "SELECT * from jarh order by nomor desc";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
	public function get_keluardari(){	
			$Bulan	= 1;
			$Tahun	= date('Y');
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
			$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND level like '%5%' AND bln='$Bulan' AND thn='$Tahun'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	}

	public function get_noperkiraan(){
			$Bulan	= 1;
			$Tahun	= date('Y');
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
			$query 	= "SELECT * FROM COA WHERE level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	}	

	public function get_nokir_pdptn($var_bulan,$var_tahun){
		/*
		$Bulan	= 1;
		$Tahun	= date('Y');
		if(date('n')==1){
			$Bulan	= 12;
			$Tahun	= date('Y') - 1;
		}
		*/
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '41%') AND level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_nokir_hpp($var_bulan,$var_tahun){
		
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '51%') AND level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_nokir_biaya($var_bulan,$var_tahun){
		
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '61%') AND level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_nokir_biaya2($var_bulan,$var_tahun){
		
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '68%') AND level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		} 
	}	

	public function get_nokir_biaya3($var_bulan,$var_tahun){
		
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '72%') AND level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		} 
	}	

	public function get_nokir_pdptn2($var_bulan,$var_tahun){
		
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '71%') AND level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	function inputDataKeluar(){
		$Nomor_BUK		= $this->get_no_buk();
		$var_keluardr	= $this->input->post('keluardari');
		$var_total		= str_replace(',','',$this->input->post('total'));
		$Tgl_Jurnal		= $this->input->post('tanggal');
		$Coa_Bank		= explode('^',$this->input->post('keluardari'));		
		$var_jenistransf= $this->input->post('jenistransf');
		$var_nocek		= $this->input->post('nocek');
		$var_kepada 	= $this->input->post('kepada');
		$var_note 		= $this->input->post('note');
		$det_Detail		= $this->input->post('detail');
		$Header_BUK		= array(
			'nomor'			=> $Nomor_BUK,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $var_total,
			'kdcab'			=> '201',
			'jenis_reff'	=> $var_jenistransf,
			'no_reff'		=> $var_nocek,
			'bayar_kepada'	=> $var_kepada,
			'jenis_ap'		=> 'V',
			'note'			=> $var_note,
			'batal'			=> '0'
		);
		
		$Detail_BUK			= array();
		
		$intL	=0;
		foreach($det_Detail as $key=>$vals){
			$intL++;
			$Kode_Coa			= explode('^',$vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',','',$vals['jumlah']);
			$Detail_BUK[$intL]		= array(
				  'nomor'         => $Nomor_BUK,
				  'tanggal'       => $Tgl_Jurnal,
				  'tipe'          => 'BUK',
				  'no_perkiraan'  => $Kode_Coa[0],
				  'keterangan'    => $descr,
				  'no_reff'       => $no_reff,
				  'debet'         => $nilai_debet,
				  'kredit'        => '0'
			);
		}
		$intL++;
		$Detail_BUK[$intL]		= array(
			  'nomor'         => $Nomor_BUK,
			  'tanggal'       => $Tgl_Jurnal,
			  'tipe'          => 'BUK',
			  'no_perkiraan'  => $Coa_Bank[0],
			  'keterangan'    => $var_note,
			  'no_reff'       => $var_nocek,
			  'debet'         => '0',
			  'kredit'        => $var_total
		
		);
		$this->db->insert("japh",$Header_BUK);
		$this->db->insert_batch("jurnal",$Detail_BUK);

	//update last NOMOR BUK ke pastibisa_tb_cabang

		$ambilnobuk = substr($Nomor_BUK,8,4);
		$data3 = array('nobuk'=> $ambilnobuk);
		$this->db->update("pastibisa_tb_cabang",$data3);
	
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	function inputDataMasuk(){
		$Nomor_BUM		= $this->get_no_bum();
		$var_setorke	= $this->input->post('setorke');
		$var_total		= str_replace(',','',$this->input->post('total'));
		$Tgl_Jurnal		= $this->input->post('tanggal');
		$Coa_Bank		= explode('^',$this->input->post('setorke'));		
		$var_jenistransf= $this->input->post('jenistransf');
		$var_nocek		= $this->input->post('nocek');
		$var_terimadr 	= $this->input->post('terimadr');
		$var_note 		= $this->input->post('note');
		$det_Detail		= $this->input->post('detail');
		$Header_BUM		= array(
			'nomor'			=> $Nomor_BUM,
			'tgl'			=> $Tgl_Jurnal,
			'jml'			=> $var_total,
			'kdcab'			=> '201',
			'jenis_reff'	=> $var_jenistransf,
			'no_reff'		=> $var_nocek,
			'terima_dari'	=> $var_terimadr,
			'jenis_ar'		=> 'V',
			'note'			=> $var_note,
			'batal'			=> '0'
		);
		
		$Detail_BUM			= array();
		
		$intL	=0;
		foreach($det_Detail as $key=>$vals){
			$intL++;
			$Kode_Coa			= explode('^',$vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',','',$vals['jumlah']);
			$Detail_BUM[$intL]	= array(
				  'nomor'         => $Nomor_BUM,
				  'tanggal'       => $Tgl_Jurnal,
				  'tipe'          => 'BUM',
				  'no_perkiraan'  => $Kode_Coa[0],
				  'keterangan'    => $descr,
				  'no_reff'       => $no_reff,
				  'debet'         => '0',
				  'kredit'        => $nilai_debet			
			);
		}
		$intL++;
		$Detail_BUM[$intL]		= array(
			  'nomor'         => $Nomor_BUM,
			  'tanggal'       => $Tgl_Jurnal,
			  'tipe'          => 'BUM',
			  'no_perkiraan'  => $Coa_Bank[0],
			  'keterangan'    => $var_note,			 
			  'no_reff'       => $var_nocek,
			  'debet'         => $var_total,
			  'kredit'        => '0'	
		);
		$this->db->insert("jarh",$Header_BUM);
		$this->db->insert_batch("jurnal",$Detail_BUM);

	//update last NOMOR BUM ke pastibisa_tb_cabang

		$ambilnobum = substr($Nomor_BUM,8,4);
		$data3 = array('nobum'=> $ambilnobum);
		$this->db->update("pastibisa_tb_cabang",$data3);
	
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	} 

	public function get_print_req($id){
		$query = "SELECT * from japh where nomor = '$id' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}

	public function get_print_reqbum($id){
		$query = "SELECT * from jarh where nomor = '$id' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		} 
	}

	public function get_print_detail($no_bu,$sg_tglxx,$tipe_bu){
		$query = "SELECT * from jurnal where tipe = '$tipe_bu' AND nomor = '$no_bu' AND tanggal = '$sg_tglxx' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}

	public function get_print_keluardr($no_bum,$sg_tglxx,$tipe_bu){
		//$query = "SELECT * from jurnal where (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND nomor = '$no_buk' AND tanggal = '$sg_tglxx' order by nomor";
		$query = "SELECT * FROM jurnal WHERE tipe = '$tipe_bu' AND nomor = '$no_bum' AND tanggal = '$sg_tglxx' AND (no_perkiraan LIKE '1101%' OR no_perkiraan like '1102%')  ORDER BY id";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}

	public function filter_tgl_buk($tanggal,$tanggal2){
		
		$query 	= "SELECT
						*
					FROM
						japh
					WHERE						
					(tgl >= '$tanggal'
						  AND tgl <= '$tanggal2') 
					ORDER BY
						  tgl ASC";

		//	echo $query;
			//exit; 
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	}

	public function get_HartaLancar($var_bulan,$var_tahun){
		$Bulan	= $var_bulan;
		$Tahun	= $var_tahun;
		//$Tahun	= date('Y');
		/*
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
		*/
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '11%') AND level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_AktivaTetap($var_bulan,$var_tahun){
		$Bulan	= $var_bulan;
		$Tahun	= $var_tahun;
		//$Tahun	= date('Y');
		/*
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
		*/
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '13%') AND level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_AktivaLain($var_bulan,$var_tahun){
		$Bulan	= $var_bulan;
		$Tahun	= $var_tahun;
		//$Tahun	= date('Y');
		/*
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
		*/
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '19%') AND level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_Hutang($var_bulan,$var_tahun){
		$Bulan	= $var_bulan;
		$Tahun	= $var_tahun;
		//$Tahun	= date('Y');
		/*
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
		*/
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '21%') AND level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_Modal($var_bulan,$var_tahun){
		$Bulan	= $var_bulan;
		$Tahun	= $var_tahun;
		//$Tahun	= date('Y');
		/*
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
		*/
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '32%') AND level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}	

	public function get_Laba($var_bulan,$var_tahun){
		$Bulan	= $var_bulan;
		$Tahun	= $var_tahun;
		//$Tahun	= date('Y');
		/*
			if(date('n')==1){
				$Bulan	= 12;
				$Tahun	= date('Y') - 1;
			}
		*/
		$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '39%') AND level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
	
	public function get_periode($blnthn_periode){
		$query 	= "SELECT * FROM periode WHERE periode='$blnthn_periode'";
		$query	= $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return 0;
		}
	}
}
?>
