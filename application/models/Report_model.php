<?php
class Report_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_nokir_41tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '41%',(saldoawal*faktor),0)) as sum41, sum(if(no_perkiraan like '41%',debet,0)) as debet41, sum(if(no_perkiraan like '41%',kredit,0)) as kredit41, sum(if(no_perkiraan like '41%',((debet-kredit)*faktor),0)) as sumtrans41, sum(if(no_perkiraan like '41%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir41 FROM coa WHERE no_perkiraan like '41%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_51tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '51%',(saldoawal*faktor),0)) as saldoawal51, sum(if(no_perkiraan like '51%',debet,0)) as debet51, sum(if(no_perkiraan like '51%',kredit,0)) as kredit51, sum(if(no_perkiraan like '51%',((debet-kredit)*faktor),0)) as sumtrans51, sum(if(no_perkiraan like '51%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir51 FROM coa WHERE no_perkiraan like '51%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_61tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '61%',(saldoawal*faktor),0)) as saldoawal61, sum(if(no_perkiraan like '61%',debet,0)) as debet61, sum(if(no_perkiraan like '61%',kredit,0)) as kredit61, sum(if(no_perkiraan like '61%',((debet-kredit)*faktor),0)) as sumtrans61, sum(if(no_perkiraan like '61%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir61 FROM coa WHERE no_perkiraan like '61%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_6811tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT *, sum(if(no_perkiraan like '6811%',(saldoawal*faktor),0)) as sum6811, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans6811, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir6811 FROM coa WHERE (no_perkiraan like '6811%') and level='3' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query 	= "SELECT *, sum(if(no_perkiraan like '6811%',(saldoawal*faktor),0)) as saldoawal6811, sum(if(no_perkiraan like '6811%',debet,0)) as debet6811, sum(if(no_perkiraan like '6811%',kredit,0)) as kredit6811, sum(if(no_perkiraan like '6811%',((debet-kredit)*faktor),0)) as sumtrans6811, sum(if(no_perkiraan like '6811%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir6811 FROM coa WHERE no_perkiraan like '6811%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_6821tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '6821%',(saldoawal*faktor),0)) as saldoawal6821, sum(if(no_perkiraan like '6821%',debet,0)) as debet6821, sum(if(no_perkiraan like '6821%',kredit,0)) as kredit6821, sum(if(no_perkiraan like '6821%',((debet-kredit)*faktor),0)) as sumtrans6821, sum(if(no_perkiraan like '6821%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir6821 FROM coa WHERE no_perkiraan like '6821%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_6831tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '6831%',(saldoawal*faktor),0)) as saldoawal6831, sum(if(no_perkiraan like '6831%',debet,0)) as debet6831, sum(if(no_perkiraan like '6831%',kredit,0)) as kredit6831, sum(if(no_perkiraan like '6831%',((debet-kredit)*faktor),0)) as sumtrans6831, sum(if(no_perkiraan like '6831%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir6831 FROM coa WHERE no_perkiraan like '6831%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_71tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '71%',(saldoawal*faktor),0)) as saldoawal71, sum(if(no_perkiraan like '71%',debet,0)) as debet71, sum(if(no_perkiraan like '71%',kredit,0)) as kredit71, sum(if(no_perkiraan like '71%',((debet-kredit)*faktor),0)) as sumtrans71, sum(if(no_perkiraan like '71%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir71 FROM coa WHERE no_perkiraan like '71%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_72tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '72%',(saldoawal*faktor),0)) as saldoawal72, sum(if(no_perkiraan like '72%',debet,0)) as debet72, sum(if(no_perkiraan like '72%',kredit,0)) as kredit72, sum(if(no_perkiraan like '72%',((debet-kredit)*faktor),0)) as sumtrans72, sum(if(no_perkiraan like '72%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir72 FROM coa WHERE no_perkiraan like '72%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_91tb_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '91%',(saldoawal*faktor),0)) as saldoawal91, sum(if(no_perkiraan like '91%',debet,0)) as debet91, sum(if(no_perkiraan like '91%',kredit,0)) as kredit91, sum(if(no_perkiraan like '91%',((debet-kredit)*faktor),0)) as sumtrans91, sum(if(no_perkiraan like '91%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir91 FROM coa WHERE no_perkiraan like '91%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_4($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_4_saldoawal,SUM(debet) as tot_nokir_4_debet,SUM(kredit) as tot_nokir_4_kredit FROM coa WHERE (no_perkiraan like '4%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_5($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_5_saldoawal,SUM(debet) as tot_nokir_5_debet,SUM(kredit) as tot_nokir_5_kredit FROM coa WHERE (no_perkiraan like '5%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_6($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_6_saldoawal,SUM(debet) as tot_nokir_6_debet,SUM(kredit) as tot_nokir_6_kredit FROM coa WHERE (no_perkiraan like '6%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_71($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_71_saldoawal,SUM(debet) as tot_nokir_71_debet,SUM(kredit) as tot_nokir_71_kredit FROM coa WHERE (no_perkiraan like '71%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_72($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_72_saldoawal,SUM(debet) as tot_nokir_72_debet,SUM(kredit) as tot_nokir_72_kredit FROM coa WHERE (no_perkiraan like '72%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_9($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_9_saldoawal,SUM(debet) as tot_nokir_9_debet,SUM(kredit) as tot_nokir_9_kredit FROM coa WHERE (no_perkiraan like '9%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_41_konsolidasi($var_bulan, $var_tahun, $level)
	{

		// $query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal41,sum(debet) as debet41,sum(kredit) as kredit41 FROM coa WHERE (no_perkiraan like '41%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";

		$query 	= "SELECT *, sum(if(no_perkiraan like '41%',(saldoawal*faktor),0)) as sum41, sum(if(no_perkiraan like '41%',((debet-kredit)*faktor),0)) as sumtrans41, sum(if(no_perkiraan like '41%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir41 FROM coa WHERE no_perkiraan like '41%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_41a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan = no_perkiraan,(saldoawal*faktor),0)) as sum41, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans41, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir41 FROM coa WHERE no_perkiraan like '41%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_51_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal51,sum(debet) as debet51,sum(kredit) as kredit51 FROM coa WHERE (no_perkiraan like '51%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";

		$query 	= "SELECT *, sum(if(no_perkiraan like '51%',(saldoawal*faktor),0)) as sum51, sum(if(no_perkiraan like '51%',((debet-kredit)*faktor),0)) as sumtrans51, sum(if(no_perkiraan like '51%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir51 FROM coa WHERE no_perkiraan like '51%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_51a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan = no_perkiraan,(saldoawal*faktor),0)) as sum51, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans51, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir51 FROM coa WHERE no_perkiraan like '51%' and no_perkiraan not like '%-00-00%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_61_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal61,sum(debet) as debet61,sum(kredit) as kredit61 FROM coa WHERE (no_perkiraan like '61%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";

		$query 	= "SELECT *, sum(if(no_perkiraan like '61%',(saldoawal*faktor),0)) as sum61, sum(if(no_perkiraan like '61%',((debet-kredit)*faktor),0)) as sumtrans61, sum(if(no_perkiraan like '61%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir61 FROM coa WHERE no_perkiraan like '61%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_61a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan = no_perkiraan,(saldoawal*faktor),0)) as sum61, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans61, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir61 FROM coa WHERE (no_perkiraan like '61%') and no_perkiraan not like '%-00-00%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_6811_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal6811,sum(debet) as debet6811,sum(kredit) as kredit6811 FROM coa WHERE (no_perkiraan like '6811%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_6811a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '6811%',(saldoawal*faktor),0)) as sum6811, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans6811, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir6811 FROM coa WHERE (no_perkiraan like '6811%') and level='3' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_6821a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '6821%',(saldoawal*faktor),0)) as sum6821, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans6821, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir6821 FROM coa WHERE (no_perkiraan like '6821%') and level='3' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_6831a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan like '6831%',(saldoawal*faktor),0)) as sum6831, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans6831, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir6831 FROM coa WHERE (no_perkiraan like '6831%') and level='3' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_6821_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal6821,sum(debet) as debet6821,sum(kredit) as kredit6821 FROM coa WHERE (no_perkiraan like '6821%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_6831_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal6831,sum(debet) as debet6831,sum(kredit) as kredit6831 FROM coa WHERE (no_perkiraan like '6831%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_68induk_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_68a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT DISTINCT *,no_perkiraan FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		// $query 	= "SELECT *, sum(if(no_perkiraan = no_perkiraan,(saldoawal*faktor),0)) as sum68, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans68, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir68 FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun'";
		// $query 	= "SELECT *, sum(saldoawal*faktor) as sum68, sum((debet-kredit)*faktor) as sumtrans68 FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun' group by no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_68b_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT DISTINCT *,no_perkiraan FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		// $query 	= "SELECT *, sum(if(no_perkiraan = no_perkiraan,(saldoawal*faktor),0)) as sum68, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans68, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir68 FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query 	= "SELECT *, sum(saldoawal*faktor) as sum68, sum((debet-kredit)*faktor) as sumtrans68 FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun'";
		// $query 	= "SELECT * FROM coa WHERE (no_perkiraan like '68%') and level='5' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_71_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal71,sum(debet) as debet71,sum(kredit) as kredit71 FROM coa WHERE (no_perkiraan like '71%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";

		$query 	= "SELECT *, sum(if(no_perkiraan like '71%',(saldoawal*faktor),0)) as sum71, sum(if(no_perkiraan like '71%',((debet-kredit)*faktor),0)) as sumtrans71, sum(if(no_perkiraan like '71%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir71 FROM coa WHERE no_perkiraan like '71%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_71a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan = no_perkiraan,(saldoawal*faktor),0)) as sum71, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans71, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir71 FROM coa WHERE no_perkiraan like '71%' and no_perkiraan not like '%-00-00%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_72_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal72,sum(debet) as debet72,sum(kredit) as kredit72 FROM coa WHERE (no_perkiraan like '72%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";

		$query 	= "SELECT *, sum(if(no_perkiraan like '72%',(saldoawal*faktor),0)) as sum72, sum(if(no_perkiraan like '72%',((debet-kredit)*faktor),0)) as sumtrans72, sum(if(no_perkiraan like '72%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir72 FROM coa WHERE no_perkiraan like '72%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_72a_konsolidasi($var_bulan, $var_tahun, $level)
	{
		$query 	= "SELECT *, sum(if(no_perkiraan = no_perkiraan,(saldoawal*faktor),0)) as sum72, sum(if(no_perkiraan = no_perkiraan,((debet-kredit)*faktor),0)) as sumtrans72, sum(if(no_perkiraan = no_perkiraan,((saldoawal+debet-kredit)*faktor),0)) as sumakhir72 FROM coa WHERE no_perkiraan like '72%' and no_perkiraan not like '%-00-00%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_nokir_91_konsolidasi($var_bulan, $var_tahun, $level)
	{
		// $query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal91,sum(debet) as debet91,sum(kredit) as kredit91 FROM coa WHERE (no_perkiraan like '91%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";

		$query 	= "SELECT *, sum(if(no_perkiraan like '91%',(saldoawal*faktor),0)) as sum91, sum(if(no_perkiraan like '91%',((debet-kredit)*faktor),0)) as sumtrans91, sum(if(no_perkiraan like '91%',((saldoawal+debet-kredit)*faktor),0)) as sumakhir91 FROM coa WHERE no_perkiraan like '91%' and level='$level' AND bln='$var_bulan' AND thn='$var_tahun'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_hartalancar11($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '11%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_aktivatetap13($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '13%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_aktivalain19($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '14%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_totalaktiva($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_aktiva_saldoawal,SUM(debet) as tot_aktiva_debet,SUM(kredit) as tot_aktiva_kredit FROM coa WHERE (no_perkiraan like '1%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_totalpassiva($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_passiva_saldoawal,SUM(debet) as tot_passiva_debet,SUM(kredit) as tot_passiva_kredit FROM coa WHERE (no_perkiraan like '2%' or no_perkiraan like '3%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_totalaktiva($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_aktiva_saldoawal,SUM(debet) as tot_aktiva_debet,SUM(kredit) as tot_aktiva_kredit FROM coa WHERE (no_perkiraan like '1%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function kons_nokir_totalpassiva($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_passiva_saldoawal,SUM(debet) as tot_passiva_debet,SUM(kredit) as tot_passiva_kredit FROM coa WHERE (no_perkiraan like '2%' or no_perkiraan like '3%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_4($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_4_saldoawal,SUM(debet) as tot_nokir_4_debet,SUM(kredit) as tot_nokir_4_kredit FROM coa WHERE (no_perkiraan like '4%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_5($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_5_saldoawal,SUM(debet) as tot_nokir_5_debet,SUM(kredit) as tot_nokir_5_kredit FROM coa WHERE (no_perkiraan like '5%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_6($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_6_saldoawal,SUM(debet) as tot_nokir_6_debet,SUM(kredit) as tot_nokir_6_kredit FROM coa WHERE (no_perkiraan like '6%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_71($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_71_saldoawal,SUM(debet) as tot_nokir_71_debet,SUM(kredit) as tot_nokir_71_kredit FROM coa WHERE (no_perkiraan like '71%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_72($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_72_saldoawal,SUM(debet) as tot_nokir_72_debet,SUM(kredit) as tot_nokir_72_kredit FROM coa WHERE (no_perkiraan like '72%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_9($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,SUM(saldoawal) as tot_nokir_9_saldoawal,SUM(debet) as tot_nokir_9_debet,SUM(kredit) as tot_nokir_9_kredit FROM coa WHERE (no_perkiraan like '9%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC ";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_hutang21($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '21%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_modal31($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '31%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function get_nokir_modal32($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '32%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_laba39($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '39%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_pendapatan41($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '41%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_hpp51($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '51%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biayapenjualan61($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '61%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biayakantor68($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '68%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_taksiranpajak91($var_bulan, $var_tahun)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '91%') AND level='3' AND bln='$var_bulan' AND thn='$var_tahun' AND kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nganten($id)
	{
		$query 	= "SELECT * from dk_penawaran where id_penawaran='$id' AND sts_prospek='2'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function proses_tutup_bulan()
	{
		$query 	= "SELECT * from dk_penawaran where id_penawaran='$var_project' AND sts_prospek='2'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function ambil_data_project2($var_project)
	{
		$query 	= "SELECT * from dk_penawaran where id_penawaran='$var_project' AND sts_prospek='2'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function ambil_data_project()
	{
		$query 	= "SELECT * from dk_penawaran where sts_prospek='2' ORDER BY id_penawaran DESC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_pdptn_event($var_project)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE no_perkiraan like '41%' AND no_reff='$var_project' and nomor like '$kode_cabang%' ORDER BY id";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_pdptn2_event($var_project)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (no_perkiraan like '71%') AND no_reff='$var_project' and nomor like '$kode_cabang%' ORDER BY id";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_hpp_event($var_project)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (no_perkiraan like '51%') AND no_reff='$var_project' and nomor like '$kode_cabang%' ORDER BY id";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya_event($var_project)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (no_perkiraan like '61%') AND no_reff='$var_project' and nomor like '$kode_cabang%' ORDER BY id";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya2_event($var_project)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (no_perkiraan like '68%') AND no_reff='$var_project' and nomor like '$kode_cabang%' ORDER BY id";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya3_event($var_project)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM jurnal WHERE (no_perkiraan like '72%') AND no_reff='$var_project' and nomor like '$kode_cabang%' ORDER BY id";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_newcoa($nu_bln_aktif, $nu_thn_aktif, $nokir)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query 	= "SELECT * from coa where bln='$nu_bln_aktif' and thn='$nu_thn_aktif' AND no_perkiraan='$nokir' and kdcab='$kode_cabang'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa($bln_aktif, $thn_aktif)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query 	= "SELECT * from coa where bln='$bln_aktif' and thn='$thn_aktif' and kdcab='$kode_cabang'";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_coa_sa($filter_nokir, $filter_nokir2, $var_bulan, $var_tahun)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query 	= "SELECT * from coa where no_perkiraan between '$filter_nokir' and '$filter_nokir2' and bln='$var_bulan' and thn='$var_tahun' and level='5'  and kdcab='$kode_cabang' order by no_perkiraan";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_detail_jurnal($filter_nokir, $filter_nokir2, $var_tgl_awal, $var_tgl_akhir)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query 	= "SELECT * from jurnal where no_perkiraan between '$filter_nokir' and '$filter_nokir2' and tanggal between STR_TO_DATE('$var_tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$var_tgl_akhir','%Y-%m-%d') and nomor like '$kode_cabang%' order by id asc";
		//$query 	= "SELECT * from jurnal where no_perkiraan = '$nokir_induk' and tanggal between '$var_tgl_awal' and '$var_tgl_akhir' order by tanggal, nomor asc";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_detail_jurnal2($nokir_induk, $var_tgl_awal, $var_tgl_akhir)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		//$query 	= "SELECT * from jurnal where no_perkiraan between '$filter_nokir' and '$filter_nokir2' and tanggal between '$var_tgl_awal' and '$var_tgl_akhir' and nomor like '$kode_cabang%' order by id";
		$query 	= "SELECT * from jurnal where no_perkiraan = '$nokir_induk' and tanggal between STR_TO_DATE('$var_tgl_awal','%Y-%m-%d') AND STR_TO_DATE('$var_tgl_akhir','%Y-%m-%d') order by tanggal, nomor asc";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_jurnal($nokir, $var_tgl_awal, $var_tgl_akhir)
	{
		$kode_cabang = $this->session->userdata('kode_cabang');
		$query 	= "SELECT sum(debet) as total_debet, sum(kredit) as total_kredit from jurnal where no_perkiraan='$nokir' and tanggal between '$var_tgl_awal' and '$var_tgl_akhir' and nomor like '$kode_cabang%' order by id";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_bulan_coa()
	{
		$query 	= "SELECT DISTINCT bln from coa";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_tahun_coa()
	{
		$query 	= "SELECT DISTINCT thn from coa";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_project()
	{
		$query 	= "select * from dk_penawaran where sts_prospek = '2'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_jurnal()
	{

		$query 	= "SELECT * FROM jurnal ORDER BY tanggal DESC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_filter()
	{
		$var_nokir	= $this->input->post('filter_nokir');
		$ambilnokir = substr($var_nokir, 0, 10);

		$query 	= "SELECT * FROM jurnal WHERE no_perkiraan = '$ambilnokir' ORDER BY no_perkiraan ASC";


		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir()
	{
		$var_nokir	= $this->input->post('filter_nokir');
		$ambilnokir = substr($var_nokir, 0, 10);

		$query 	= "SELECT * FROM jurnal WHERE no_perkiraan = $ambilnokir ORDER BY no_perkiraan ASC";

		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function filter_tgl_jurnal($tanggal, $tanggal2)
	{

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
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_dana_keluar()
	{
		$query 	= "SELECT * from japh order by nomor desc";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function list_dana_masuk()
	{
		$query 	= "SELECT * from jarh order by nomor desc";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_keluardari()
	{
		$Bulan	= 1;
		$Tahun	= date('Y');
		if (date('n') == 1) {
			$Bulan	= 12;
			$Tahun	= date('Y') - 1;
		}
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND level like '%5%' AND bln='$Bulan' AND thn='$Tahun'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_noperkiraan()
	{
		$Bulan	= 1;
		$Tahun	= date('Y');
		if (date('n') == 1) {
			$Bulan	= 12;
			$Tahun	= date('Y') - 1;
		}
		$query 	= "SELECT * FROM coa WHERE level='5' AND bln='$Bulan' AND thn='$Tahun' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_pdptn($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '41%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_hpp($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '51%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya52($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '52%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya61($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '61%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '62%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya2($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '68%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biaya3($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '72%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_fee($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '91%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_biayalain($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '72%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_nokir_pdptn2($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '71%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	function inputDataKeluar()
	{
		$Nomor_BUK		= $this->get_no_buk();
		$var_keluardr	= $this->input->post('keluardari');
		$var_total		= str_replace(',', '', $this->input->post('total'));
		$Tgl_Jurnal		= $this->input->post('tanggal');
		$coa_Bank		= explode('^', $this->input->post('keluardari'));
		$var_jenistransf = $this->input->post('jenistransf');
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

		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',', '', $vals['jumlah']);
			$Detail_BUK[$intL]		= array(
				'nomor'         => $Nomor_BUK,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'BUK',
				'no_perkiraan'  => $Kode_coa[0],
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
			'no_perkiraan'  => $coa_Bank[0],
			'keterangan'    => $var_note,
			'no_reff'       => $var_nocek,
			'debet'         => '0',
			'kredit'        => $var_total

		);
		$this->db->insert("japh", $Header_BUK);
		$this->db->insert_batch("jurnal", $Detail_BUK);

		//update last NOMOR BUK ke pastibisa_tb_cabang

		$ambilnobuk = substr($Nomor_BUK, 8, 4);
		$data3 = array('nobuk' => $ambilnobuk);
		$this->db->update("pastibisa_tb_cabang", $data3);

		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	function inputDataMasuk()
	{
		$Nomor_BUM		= $this->get_no_bum();
		$var_setorke	= $this->input->post('setorke');
		$var_total		= str_replace(',', '', $this->input->post('total'));
		$Tgl_Jurnal		= $this->input->post('tanggal');
		$coa_Bank		= explode('^', $this->input->post('setorke'));
		$var_jenistransf = $this->input->post('jenistransf');
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

		$intL	= 0;
		foreach ($det_Detail as $key => $vals) {
			$intL++;
			$Kode_coa			= explode('^', $vals['noperkiraan']);
			$descr				= $vals['keterangan'];
			$no_reff			= $vals['project'];
			$nilai_debet		= str_replace(',', '', $vals['jumlah']);
			$Detail_BUM[$intL]	= array(
				'nomor'         => $Nomor_BUM,
				'tanggal'       => $Tgl_Jurnal,
				'tipe'          => 'BUM',
				'no_perkiraan'  => $Kode_coa[0],
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
			'no_perkiraan'  => $coa_Bank[0],
			'keterangan'    => $var_note,
			'no_reff'       => $var_nocek,
			'debet'         => $var_total,
			'kredit'        => '0'
		);
		$this->db->insert("jarh", $Header_BUM);
		$this->db->insert_batch("jurnal", $Detail_BUM);

		//update last NOMOR BUM ke pastibisa_tb_cabang

		$ambilnobum = substr($Nomor_BUM, 8, 4);
		$data3 = array('nobum' => $ambilnobum);
		$this->db->update("pastibisa_tb_cabang", $data3);

		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	}

	public function get_print_req($id)
	{
		$query = "SELECT * from japh where nomor = '$id' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_print_reqbum($id)
	{
		$query = "SELECT * from jarh where nomor = '$id' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_print_detail($no_bu, $sg_tglxx, $tipe_bu)
	{
		$query = "SELECT * from jurnal where tipe = '$tipe_bu' AND nomor = '$no_bu' AND tanggal = '$sg_tglxx' order by nomor";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_print_keluardr($no_bum, $sg_tglxx, $tipe_bu)
	{
		//$query = "SELECT * from jurnal where (no_perkiraan like '1101%' OR no_perkiraan like '1102%') AND nomor = '$no_buk' AND tanggal = '$sg_tglxx' order by nomor";
		$query = "SELECT * FROM jurnal WHERE tipe = '$tipe_bu' AND nomor = '$no_bum' AND tanggal = '$sg_tglxx' AND (no_perkiraan LIKE '1101%' OR no_perkiraan like '1102%')  ORDER BY id";
		//echo  $query;
		//exit;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function filter_tgl_buk($tanggal, $tanggal2)
	{

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
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_HartaLancar($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '11%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_tdkHartaLancar($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '12%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_AktivaTetap($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '13%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_AktivaLain($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '14%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_Hutang($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '21%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_Modal($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '31%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_Laba($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT * FROM coa WHERE (no_perkiraan like '39%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' and kdcab='$kode_cabang' ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_HartaLancar_kons1101($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1101,sum(debet) as debet1101,sum(kredit) as kredit1101 FROM coa WHERE (no_perkiraan like '1101%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1102($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1102,sum(debet) as debet1102,sum(kredit) as kredit1102 FROM coa WHERE (no_perkiraan like '1102%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1104($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1104,sum(debet) as debet1104,sum(kredit) as kredit1104 FROM coa WHERE (no_perkiraan like '1104%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1105($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1105,sum(debet) as debet1105,sum(kredit) as kredit1105 FROM coa WHERE (no_perkiraan like '1105%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1106($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1106,sum(debet) as debet1106,sum(kredit) as kredit1106 FROM coa WHERE (no_perkiraan like '1106%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1107($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1107,sum(debet) as debet1107,sum(kredit) as kredit1107 FROM coa WHERE (no_perkiraan like '1107%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1108($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1108,sum(debet) as debet1108,sum(kredit) as kredit1108 FROM coa WHERE (no_perkiraan like '1108%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1110($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1110,sum(debet) as debet1110,sum(kredit) as kredit1110 FROM coa WHERE (no_perkiraan like '1110%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_HartaLancar_kons1111($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1111,sum(debet) as debet1111,sum(kredit) as kredit1111 FROM coa WHERE (no_perkiraan like '1111%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_AktivaTetap_kons1301($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1301,sum(debet) as debet1301,sum(kredit) as kredit1301 FROM coa WHERE (no_perkiraan like '1301%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_AktivaTetap_kons1302($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1302,sum(debet) as debet1302,sum(kredit) as kredit1302 FROM coa WHERE (no_perkiraan like '1302%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_AktivaTetap_kons1303($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1303,sum(debet) as debet1303,sum(kredit) as kredit1303 FROM coa WHERE (no_perkiraan like '1303%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_AktivaTetap_kons1304($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1304,sum(debet) as debet1304,sum(kredit) as kredit1304 FROM coa WHERE (no_perkiraan like '1304%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_AktivaTetap_kons1305($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1305,sum(debet) as debet1305,sum(kredit) as kredit1305 FROM coa WHERE (no_perkiraan like '1305%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_AktivaTetap_kons1306($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1306,sum(debet) as debet1306,sum(kredit) as kredit1306 FROM coa WHERE (no_perkiraan like '1306%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_AktivaTetap_kons1307($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1307,sum(debet) as debet1307,sum(kredit) as kredit1307 FROM coa WHERE (no_perkiraan like '1307%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_AktivaTetap_kons1309($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal1309,sum(debet) as debet1309,sum(kredit) as kredit1309 FROM coa WHERE (no_perkiraan like '1309%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_AktivaLain_kons($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal19,sum(debet) as debet19,sum(kredit) as kredit19 FROM coa WHERE (no_perkiraan like '19%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_Hutang_kons2101($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal2101,sum(debet) as debet2101,sum(kredit) as kredit2101 FROM coa WHERE (no_perkiraan like '2101%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_Hutang_kons2102($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal2102,sum(debet) as debet2102,sum(kredit) as kredit2102 FROM coa WHERE (no_perkiraan like '2102%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_Hutang_kons2107($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal2107,sum(debet) as debet2107,sum(kredit) as kredit2107 FROM coa WHERE (no_perkiraan like '2107%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_Hutang_kons2108($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal2108,sum(debet) as debet2108,sum(kredit) as kredit2108 FROM coa WHERE (no_perkiraan like '2108%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_Modal_kons($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal32,sum(debet) as debet32,sum(kredit) as kredit32 FROM coa WHERE (no_perkiraan like '32%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_Laba_kons3901($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal3901,sum(debet) as debet3901,sum(kredit) as kredit3901 FROM coa WHERE (no_perkiraan like '3901%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_Laba_kons3902($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal3902,sum(debet) as debet3902,sum(kredit) as kredit3902 FROM coa WHERE (no_perkiraan like '3902%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	public function get_Laba_kons3903($var_bulan, $var_tahun, $level)
	{
		$kode_cabang	= $this->session->userdata('kode_cabang');
		$query 	= "SELECT *,sum((saldoawal) * faktor) as saldoawal3903,sum(debet) as debet3903,sum(kredit) as kredit3903 FROM coa WHERE (no_perkiraan like '3903%') AND level='$level' AND bln='$var_bulan' AND thn='$var_tahun' GROUP BY no_perkiraan ORDER BY no_perkiraan ASC";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function get_periode($blnthn_periode)
	{
		$singkat_cbg = $this->session->userdata('singkat_cbg');
		$query 	= "SELECT * FROM periode WHERE periode='$blnthn_periode' and kdcab='$singkat_cbg'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function cek_periode_aktif()
	{
		$singkat_cbg = $this->session->userdata('singkat_cbg');
		$query 	= "SELECT * FROM periode WHERE stsaktif='O' and kdcab='$singkat_cbg'";
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	
	## SYAM REPORT PIUTANG

	public function get_ar($var_bulan, $var_tahun, $cust)
	{
		if ($cust =='0'){
		$query 	= "SELECT * FROM ar WHERE bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_invoice ASC";
		}
		else{
		$query 	= "SELECT * FROM ar WHERE bln='$var_bulan' AND thn='$var_tahun' AND id_klien='$cust' ORDER BY no_invoice ASC";
		}
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function get_ar_total($var_bulan, $var_tahun, $cust)
	{
		if ($cust =='0'){
		$query 	= "SELECT no_invoice, nama_klien, sum(saldo_awal)as saldo_awal, sum(debet) as debet, sum(kredit) as kredit, sum(saldo_akhir) as saldo_akhir FROM ar WHERE bln='$var_bulan' AND thn='$var_tahun'  GROUP BY id_klien";
		}
		else{
		$query 	= "SELECT  no_invoice, nama_klien, sum(saldo_awal)as saldo_awal, sum(debet) as debet, sum(kredit) as kredit, sum(saldo_akhir) as saldo_akhir FROM ar WHERE bln='$var_bulan' AND thn='$var_tahun' AND id_klien='$cust' GROUP BY id_klien";
		}
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}

	public function pilih_klien(){
		$aMenu		= array();

//		$where  ="status='Aktif'";

		if(!empty($where)){

			//$this->db->distinct();
			$query = $this->db->get_where(DBACC.".ms_customer",$where);

		}else{

			//$this->db->distinct();
			$query = $this->db->get(DBACC.".ms_customer");

		}

		$results	= $query->result_array();
		if($results){
			foreach($results as $key=>$vals){
				$aMenu[$vals['id_klien']]	= $vals['nama_klien'];
			}
		}
		return $aMenu;

	}
	
	
	
	## SYAM REPORT HUTANG

	public function get_ap($var_bulan, $var_tahun, $cust)
	{
		if ($cust =='0'){
		$query 	= "SELECT * FROM ap WHERE bln='$var_bulan' AND thn='$var_tahun' ORDER BY no_invoice ASC";
		}
		else{
		$query 	= "SELECT * FROM ap WHERE bln='$var_bulan' AND thn='$var_tahun' AND id_klien='$cust' ORDER BY no_invoice ASC";
		}
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}


	public function get_ap_total($var_bulan, $var_tahun, $cust)
	{
		if ($cust =='0'){
		$query 	= "SELECT no_invoice, nama_klien, sum(saldo_awal)as saldo_awal, sum(debet) as debet, sum(kredit) as kredit, sum(saldo_akhir) as saldo_akhir FROM ap WHERE bln='$var_bulan' AND thn='$var_tahun'  GROUP BY id_klien";
		}
		else{
		$query 	= "SELECT  no_invoice, nama_klien, sum(saldo_awal)as saldo_awal, sum(debet) as debet, sum(kredit) as kredit, sum(saldo_akhir) as saldo_akhir FROM ap WHERE bln='$var_bulan' AND thn='$var_tahun' AND id_klien='$cust' GROUP BY id_klien";
		}
		$query	= $this->db->query($query);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return 0;
		}
	}
	
	public function pilih_vendor(){
		$aMenu		= array();

//		$where  ="status='Aktif'";

		if(!empty($where)){

			//$this->db->distinct();
			$query = $this->db->get_where(DBACC.".ms_vendor",$where);

		}else{

			//$this->db->distinct();
			$query = $this->db->get(DBACC.".ms_vendor");

		}

		$results	= $query->result_array();
		if($results){
			foreach($results as $key=>$vals){
				$aMenu[$vals['id_vendor']]	= $vals['nama'];
			}
		}
		return $aMenu;

	}
}
