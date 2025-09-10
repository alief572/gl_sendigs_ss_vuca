<?php
class Model_dashboard extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cek_periode_aktif()
	{
		$singkat_cbg	= $this->session->userdata('singkat_cbg');
		$query 	= "SELECT * FROM periode WHERE stsaktif = 'O' and kdcab='$singkat_cbg' ORDER BY id ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_omzet($kode_cabang, $thn)
	{

		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
			SUM(IF(bln='1',(debet-kredit)*faktor,0)) as jan,
			SUM(IF(bln='2',(debet-kredit)*faktor,0)) as feb,
			SUM(IF(bln='3',(debet-kredit)*faktor,0)) as mart,
			SUM(IF(bln='4',(debet-kredit)*faktor,0)) as apr,
			SUM(IF(bln='5',(debet-kredit)*faktor,0)) as mei,
			SUM(IF(bln='6',(debet-kredit)*faktor,0)) as jun,
			SUM(IF(bln='7',(debet-kredit)*faktor,0)) as jul,
			SUM(IF(bln='8',(debet-kredit)*faktor,0)) as agt,
			SUM(IF(bln='9',(debet-kredit)*faktor,0)) as sept,
			SUM(IF(bln='10',(debet-kredit)*faktor,0)) as okt,
			SUM(IF(bln='11',(debet-kredit)*faktor,0)) as nov,
			SUM(IF(bln='12',(debet-kredit)*faktor,0)) as des
			FROM coa
			WHERE kdcab = '$kode_cabang' and thn= '$thn' and no_perkiraan LIKE '4101%' and level ='3' 
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}
	public function get_hpp($kode_cabang, $thn)
	{

		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
			SUM(IF(bln='1',(debet-kredit)*faktor,0)) as jan,
			SUM(IF(bln='2',(debet-kredit)*faktor,0)) as feb,
			SUM(IF(bln='3',(debet-kredit)*faktor,0)) as mart,
			SUM(IF(bln='4',(debet-kredit)*faktor,0)) as apr,
			SUM(IF(bln='5',(debet-kredit)*faktor,0)) as mei,
			SUM(IF(bln='6',(debet-kredit)*faktor,0)) as jun,
			SUM(IF(bln='7',(debet-kredit)*faktor,0)) as jul,
			SUM(IF(bln='8',(debet-kredit)*faktor,0)) as agt,
			SUM(IF(bln='9',(debet-kredit)*faktor,0)) as sept,
			SUM(IF(bln='10',(debet-kredit)*faktor,0)) as okt,
			SUM(IF(bln='11',(debet-kredit)*faktor,0)) as nov,
			SUM(IF(bln='12',(debet-kredit)*faktor,0)) as des
			FROM coa
			WHERE thn= '$thn' and level ='3' and no_perkiraan LIKE '5101%' and kdcab = '$kode_cabang'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}
	public function get_ar($kode_cabang, $thn)
	{
		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
			SUM(IF(bln='1',debet*faktor,0)) as jan,
			SUM(IF(bln='2',debet*faktor,0)) as feb,
			SUM(IF(bln='3',debet*faktor,0)) as mart,
			SUM(IF(bln='4',debet*faktor,0)) as apr,
			SUM(IF(bln='5',debet*faktor,0)) as mei,
			SUM(IF(bln='6',debet*faktor,0)) as jun,
			SUM(IF(bln='7',debet*faktor,0)) as jul,
			SUM(IF(bln='8',debet*faktor,0)) as agt,
			SUM(IF(bln='9',debet*faktor,0)) as sept,
			SUM(IF(bln='10',debet*faktor,0)) as okt,
			SUM(IF(bln='11',debet*faktor,0)) as nov,
			SUM(IF(bln='12',debet*faktor,0)) as des
			FROM coa
			WHERE thn= '$thn' and level ='3' and no_perkiraan LIKE '1104%' and kdcab = '$kode_cabang'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}
	public function get_ap($kode_cabang, $thn)
	{
		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
			SUM(IF(bln='1',(saldoawal+debet-kredit)*faktor,0)) as jan,
			SUM(IF(bln='2',(saldoawal+debet-kredit)*faktor,0)) as feb,
			SUM(IF(bln='3',(saldoawal+debet-kredit)*faktor,0)) as mart,
			SUM(IF(bln='4',(saldoawal+debet-kredit)*faktor,0)) as apr,
			SUM(IF(bln='5',(saldoawal+debet-kredit)*faktor,0)) as mei,
			SUM(IF(bln='6',(saldoawal+debet-kredit)*faktor,0)) as jun,
			SUM(IF(bln='7',(saldoawal+debet-kredit)*faktor,0)) as jul,
			SUM(IF(bln='8',(saldoawal+debet-kredit)*faktor,0)) as agt,
			SUM(IF(bln='9',(saldoawal+debet-kredit)*faktor,0)) as sept,
			SUM(IF(bln='10',(saldoawal+debet-kredit)*faktor,0)) as okt,
			SUM(IF(bln='11',(saldoawal+debet-kredit)*faktor,0)) as nov,
			SUM(IF(bln='12',(saldoawal+debet-kredit)*faktor,0)) as des
			FROM coa
			WHERE thn= '$thn' and level ='3' and no_perkiraan LIKE '2102%' and kdcab = '$kode_cabang'
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}


	public function get_lb($kode_cabang, $thn)
	{
		if ($this->input->post()) {
			//$bln = date('m');
			$thn = $this->input->post('thn');
		} else {
			$thn = date('Y');
			//$pesan = echo "<script>alert('data tidak ada')</script>";'
		}

		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
			SUM(IF(bln='1',(saldoawal+debet-kredit)*faktor,0)) as jan,
			SUM(IF(bln='2',(saldoawal+debet-kredit)*faktor,0)) as feb,
			SUM(IF(bln='3',(saldoawal+debet-kredit)*faktor,0)) as mart,
			SUM(IF(bln='4',(saldoawal+debet-kredit)*faktor,0)) as apr,
			SUM(IF(bln='5',(saldoawal+debet-kredit)*faktor,0)) as mei,
			SUM(IF(bln='6',(saldoawal+debet-kredit)*faktor,0)) as jun,
			SUM(IF(bln='7',(saldoawal+debet-kredit)*faktor,0)) as jul,
			SUM(IF(bln='8',(saldoawal+debet-kredit)*faktor,0)) as agt,
			SUM(IF(bln='9',(saldoawal+debet-kredit)*faktor,0)) as sept,
			SUM(IF(bln='10',(saldoawal+debet-kredit)*faktor,0)) as okt,
			SUM(IF(bln='11',(saldoawal+debet-kredit)*faktor,0)) as nov,
			SUM(IF(bln='12',(saldoawal+debet-kredit)*faktor,0)) as des
			FROM coa
			WHERE kdcab = '$kode_cabang' and thn= '$thn' and no_perkiraan LIKE '3903%' and level ='3' 
			GROUP BY no_perkiraan";

		$query	= $this->db->query($query);

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
			//return echo "data tidak tersedia";
		}
	}

	public function get_biaya($kode_cabang, $thn)
	{
		if ($this->input->post()) {
			//$bln = date('m');
			$thn = $this->input->post('thn');
		} else {
			$thn = date('Y');
			//$pesan = echo "<script>alert('data tidak ada')</script>";'
		}

		$query	= "SELECT id,kdcab,no_perkiraan,nama,thn, 
			SUM(IF(bln='1',(saldoawal+debet-kredit)*faktor,0)) as jan,
			SUM(IF(bln='2',(saldoawal+debet-kredit)*faktor,0)) as feb,
			SUM(IF(bln='3',(saldoawal+debet-kredit)*faktor,0)) as mart,
			SUM(IF(bln='4',(saldoawal+debet-kredit)*faktor,0)) as apr,
			SUM(IF(bln='5',(saldoawal+debet-kredit)*faktor,0)) as mei,
			SUM(IF(bln='6',(saldoawal+debet-kredit)*faktor,0)) as jun,
			SUM(IF(bln='7',(saldoawal+debet-kredit)*faktor,0)) as jul,
			SUM(IF(bln='8',(saldoawal+debet-kredit)*faktor,0)) as agt,
			SUM(IF(bln='9',(saldoawal+debet-kredit)*faktor,0)) as sept,
			SUM(IF(bln='10',(saldoawal+debet-kredit)*faktor,0)) as okt,
			SUM(IF(bln='11',(saldoawal+debet-kredit)*faktor,0)) as nov,
			SUM(IF(bln='12',(saldoawal+debet-kredit)*faktor,0)) as des
			FROM coa
			WHERE kdcab = '$kode_cabang' and thn= '$thn' and no_perkiraan LIKE '6200%' and level ='2' 
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
