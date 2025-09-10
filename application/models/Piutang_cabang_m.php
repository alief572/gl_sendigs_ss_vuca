<?php 
class Piutang_cabang_m extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
// ////////////////////////////////////////piutang cabang//////////////////////////////////////
// SQL.Text := 'SELECT CB.kdcab AS "Kode Cabang",CB.cabang AS Cabang,SUM(AR.saldo_awal) AS "Saldo Awal",';
//     SQL.Add('SUM(AR.debet) AS Debet,SUM(AR.kredit) AS Kredit,SUM(AR.saldo_akhir) AS "Saldo Akhir",AR.bln AS Bulan,AR.thn AS Tahun,');
//     SQL.Add('SUM(IF(MONTH(CURRENT_DATE)=AR.bln AND YEAR(CURRENT_DATE)=AR.thn,IF(DATEDIFF(CURRENT_DATE,AR.tgl_invoice)<=15,AR.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY("'+tahun+'-'+bulan+'-1"),AR.tgl_invoice)<=15,AR.saldo_akhir,NULL))) AS "<= 15",');
//     SQL.Add('SUM(IF(MONTH(CURRENT_DATE)=AR.bln AND YEAR(CURRENT_DATE)=AR.thn,IF(DATEDIFF(CURRENT_DATE,AR.tgl_invoice) BETWEEN 16 AND 30,AR.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY("'+tahun+'-'+bulan+'-1"),AR.tgl_invoice) BETWEEN 16 AND 30,AR.saldo_akhir,NULL))) AS "16 - 30",');
//     SQL.Add('SUM(IF(MONTH(CURRENT_DATE)=AR.bln AND YEAR(CURRENT_DATE)=AR.thn,IF(DATEDIFF(CURRENT_DATE,AR.tgl_invoice) BETWEEN 31 AND 60,AR.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY("'+tahun+'-'+bulan+'-1"),AR.tgl_invoice) BETWEEN 31 AND 60,AR.saldo_akhir,NULL))) AS "31 - 60",');
//     SQL.Add('SUM(IF(MONTH(CURRENT_DATE)=AR.bln AND YEAR(CURRENT_DATE)=AR.thn,IF(DATEDIFF(CURRENT_DATE,AR.tgl_invoice) BETWEEN 61 AND 90,AR.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY("'+tahun+'-'+bulan+'-1"),AR.tgl_invoice) BETWEEN 61 AND 90,AR.saldo_akhir,NULL))) AS "61 - 90",');
//     SQL.Add('SUM(IF(MONTH(CURRENT_DATE)=AR.bln AND YEAR(CURRENT_DATE)=AR.thn,IF(DATEDIFF(CURRENT_DATE,AR.tgl_invoice)>90,AR.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY("'+tahun+'-'+bulan+'-1"),AR.tgl_invoice)>90,AR.saldo_akhir,NULL))) AS "> 90"');
//     SQL.Add('FROM ar AR');
//     SQL.Add('JOIN pastibisa_tb_cabang CB ON AR.kdcab=CB.kdcab');
//     SQL.Add('WHERE AR.bln='+bulan+' AND AR.thn='+tahun);
//     SQL.Add('AND AR.stat_gl="tarik" ');
//     SQL.Add('GROUP BY CB.kdcab');
//     SQL.Add('ORDER BY CB.nocab ASC');

	public function piutang_cabang(){
		//$kode_cabang	= $this->session->userdata('sub_cabang');
		if($this->input->post()){
			$bulan	= $this->input->post('bln');
			$tahun	= $this->input->post('thn');
		}else{
			$bulan	= date('m');
			$tahun	= date('Y');
		}
		$query="SELECT b.kdcab as kode_cabang, b.cabang as cabang,
		SUM(a.saldo_awal) as saldo,
		SUM(a.debet) as debet,
		SUM(a.kredit) as kredit,
		SUM(a.saldo_akhir) as saldo_akhir, a.bln as bulan, a.thn as tahun,
		SUM(IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice)<=15,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('.$tahun.'-'.$bulan.'-1),a.tgl_invoice)<=15,a.saldo_akhir,NULL))) AS ab,
		SUM(IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice)BETWEEN 16 AND 30,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('.$tahun.'-'.$bulan.'-1),a.tgl_invoice)BETWEEN 16 AND 30,a.saldo_akhir,NULL))) AS ac,
		SUM(IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice)BETWEEN 31 AND 60,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('.$tahun.'-'.$bulan.'-1),a.tgl_invoice)BETWEEN 31 AND 60,a.saldo_akhir,NULL))) AS ad,
		SUM(IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice)BETWEEN 61 AND 90,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('.$tahun.'-'.$bulan.'-1),a.tgl_invoice)BETWEEN 61 AND 90,a.saldo_akhir,NULL))) AS ae,
		SUM(IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice)>90,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('.$tahun.'-'.$bulan.'-1),a.tgl_invoice)>90,a.saldo_akhir,NULL))) AS af
		
		from ar a join pastibisa_tb_cabang b on a.kdcab=b.kdcab
			where a.bln='$bulan' and a.thn='$tahun' and a.stat_gl='tarik'
			group by b.kdcab
			order by b.nocab asc";

			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
			return $query->result();
			}else{
				return 0;
			}
	}
	public function piutang_cabang_detail($kdcab){
		//$kode_cabang	= $this->session->userdata('sub_cabang');
		if($this->input->post()){
			$bulan	= $this->input->post('bln');
			$tahun	= $this->input->post('thn');
		}else{
			$bulan	= date('m');
			$tahun	= date('Y');
		}
		
		$query="SELECT a.no_invoice AS nomor_invoice, a.tgl_invoice AS tanggal_invoice, a.customer AS customer,
		a.saldo_awal as saldo,
		a.debet as debet,
		a.kredit as kredit,
		a.saldo_akhir as saldo_akhir, a.bln as bulan, a.thn as tahun,
		IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,DATEDIFF(CURRENT_DATE,a.tgl_invoice),DATEDIFF(LAST_DAY('$tahun'-'$bulan'-1),a.tgl_invoice)) AS umur,
    	IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice)<=15,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('$tahun'-'$bulan'-1),a.tgl_invoice)<=15,a.saldo_akhir,NULL)) AS ab,
		IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice) BETWEEN 16 AND 30,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('$tahun'-'$bulan'-1),a.tgl_invoice) BETWEEN 16 AND 30,a.saldo_akhir,NULL)) AS ac,
		IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,
		IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice) BETWEEN 31 AND 60,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('$tahun'-'$bulan'-1),a.tgl_invoice) BETWEEN 31 AND 60,a.saldo_akhir,NULL)) AS ad,
    	IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice) BETWEEN 61 AND 90,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('$tahun'-'$bulan'-1),a.tgl_invoice) BETWEEN 61 AND 90,a.saldo_akhir,NULL)) AS ae,
		IF(MONTH(CURRENT_DATE)=a.bln AND YEAR(CURRENT_DATE)=a.thn,IF(DATEDIFF(CURRENT_DATE,a.tgl_invoice)>90,a.saldo_akhir,NULL),
		IF(DATEDIFF(LAST_DAY('$tahun'-'$bulan'-1),a.tgl_invoice)>90,a.saldo_akhir,NULL)) AS af

		from ar a
			where a.bln='$bulan' and a.thn='$tahun' and a.kdcab='$kdcab' and a.stat_gl='tarik'
			order by af desc";

			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
			return $query->result();
			}else{
				return 0;
			}
	}
	
/////////////////////////////////////////piutang cabang by bln tahun////////////////////////
public function piutang_cabang_bln(){
	//$kode_cabang	= $this->session->userdata('sub_cabang');
	$bln = $this->input->post('bln');
	$thn = $this->input->post('thn');
	$thn_bln=$thn."-".$bln;

	$query="SELECT pastibisa_tb_cabang.cabang as cabang,
	SUM(ar.saldo_awal) as saldo,SUM(ar.debet) as debet,
	SUM(ar.kredit) as kredit,SUM(ar.saldo_akhir) as saldo_akhir,
	SUM(IF(MONTH($bln)=ar.bln AND YEAR($thn)=ar.thn,IF(DATEDIFF(CURDATE,ar.tgl_invoice)
		<=15,ar.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY($thn-$bln-1),ar.tgl_invoice)
		<=15,ar.saldo_akhir,NULL)) AS ab,
	SUM(IF(MONTH($bln)=ar.bln AND YEAR($thn)=ar.thn,IF(DATEDIFF(CURDATE,ar.tgl_invoice)
		BETWEEN 16 AND 30,ar.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY($thn-$bln-1),ar.tgl_invoice)
		BETWEEN 16 AND 30,ar.saldo_akhir,NULL))) AS ac,
	SUM(IF(MONTH($bln)=ar.bln AND YEAR($thn)=ar.thn,IF(DATEDIFF(CURDATE,ar.tgl_invoice)
		BETWEEN 31 AND 60,ar.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY($thn-$bln-1),ar.tgl_invoice)
		BETWEEN 31 AND 60,ar.saldo_akhir,NULL))) AS ad,
	SUM(IF(MONTH($bln)=ar.bln AND YEAR($thn)=ar.thn,IF(DATEDIFF(CURDATE,ar.tgl_invoice)
		BETWEEN 61 AND 90,ar.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY($thn-$bln-1),ar.tgl_invoice)
		BETWEEN 61 AND 90,ar.saldo_akhir,NULL))) AS ae,
	SUM(IF(MONTH($bln)=ar.bln AND YEAR($thn)=ar.thn,IF(DATEDIFF(CURDATE,ar.tgl_invoice)
		>90,ar.saldo_akhir,NULL),IF(DATEDIFF(LAST_DAY($thn-$bln-1),ar.tgl_invoice)  
		>90,ar.saldo_akhir,NULL))) AS af
	
		from ar join pastibisa_tb_cabang ON ar.kdcab=pastibisa_tb_cabang.kdcab 
		   where ar.bln='$bln' and ar.thn = '$thn'
		   and ar.stat_gl='tarik'
		   group by pastibisa_tb_cabang.kdcab";

		$query 	= $this->db->query($query);
		if($query->num_rows() > 0){
		return $query->result();
		}else{
			return 0;
		} 
	}
}
	?>
	
	