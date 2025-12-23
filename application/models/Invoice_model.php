<?php 

	class Invoice_model extends CI_Model{

		public function __construct(){

			parent::__construct();

			$this->load->database(); 

		}

		public function get_bank(){	
		
			$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '1102%') AND level like '%5%'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		public function get_cash(){	
		
			$query 	= "SELECT * FROM COA WHERE (no_perkiraan like '%1101-01-01%') AND level like '%5%'";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){ 
				return $query->result();
			}else{
				return 0;
			}
		}

		function get_list_invoice(){

   			if($this->session->userdata('pn_name') <> 'admin')
				$nama_marketing=$this->session->userdata('pn_name');
            else
				$nama_marketing="%";
        	
			$vbulan = date("m")+0;
			$vtahun = date("Y");

			$query	= "SELECT
						*,a.salesman,b.tempat1 as temp
					from dk_penawaran b inner join dk_prospek a on b.id_prospek = a.id_prospek
					inner JOIN dk_master_customer c ON b.id_prospek = c.id_prospek where b.sts_prospek ='2'
				    and a.salesman like '".$nama_marketing."' AND b.harga > 0              
					";
			//AND c.piutang > 0    
            if(!empty($vbulan))
			{
				$query	.= " and year(a.resepsi_date)='$vtahun' ";
			}
			else
			{
                if(empty($vtahun))  
                    $vtahun=date("Y"); 
				$query	.= " and year(a.resepsi_date)='$vtahun' and month(a.resepsi_date)='$vbulan' ";	
			}			
     			$query	.= " order by a.resepsi_date ";	
            //echo $query;            
            //exit; 
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		function get_list_invoice_change(){

			if($this->session->userdata('pn_name') <> 'admin')
			 $nama_marketing=$this->session->userdata('pn_name');
		 	else
			 $nama_marketing="%";		 
		 
			if($this->input->post()){
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');
			}		  

			$query	= "SELECT
						*,a.salesman,b.tempat1 as temp
					from dk_penawaran b inner join dk_prospek a on b.id_prospek = a.id_prospek
					inner JOIN dk_master_customer c ON b.id_prospek = c.id_prospek where b.sts_prospek ='2'
					and a.salesman like '".$nama_marketing."' AND b.harga > 0 			
					";
			//AND c.piutang > 0 	
			if(!empty($bulan))
			{
				$query	.= " and year(a.resepsi_date)='$tahun' and month(a.resepsi_date)='$bulan' ";
			}
			else
			{
				if(empty($tahun))  
					$tahun=date("Y");
				$query	.= " and year(a.resepsi_date)='$tahun'  ";	
			}		 
				$query	.= " order by a.resepsi_date "; 
			//echo $query;		 
			//exit; 
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
	 }		

		function get_tgl($id){

			$query = $this->db->query("select tanggal_respsi,id_penawaran from dk_penawaran where id_prospek = '$id'");

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		function get_hrg($id){			

			$query	= "SELECT * FROM dk_penawaran WHERE id_prospek='$id'";

			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}   

		function invoice_detail($id){			

			$query	= "SELECT a.*, a.due_date AS jadwal_invoice, a.id_penawaran, b.total, b.billed_to, b.due_date AS due_date_inv FROM dk_schedule a LEFT JOIN dk_invoice b ON a.nomor_invoice = b.invoice_no WHERE a.id_prospek = '$id' ORDER BY a.no_bayar";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function get_piutang1($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=1";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function get_angsuran1($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=1";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function get_piutang2($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=2";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function get_angsuran2($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=2";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function get_piutang3($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=3";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}  
		
		function get_angsuran3($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=3";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}  

		function get_piutang4($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=4";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function get_angsuran4($id){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id' AND no_bayar=4";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function get_tot_piutang($id){			

			$query	= "SELECT * FROM dk_master_customer WHERE id_prospek='$id' ";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   

		function print_invoice($id){

			$query	= "SELECT

							a.*,b.total_deal,b.dp1,b.dp2,b.dp3,b.dp4,b.nocust

						FROM

							dk_penawaran a

							join dk_master_customer b on a.id_prospek = b.id_prospek

						WHERE

							b.id_prospek = '$id'";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		

		function daftar_invoice(){
/*
             if($this->input->post())
             {
				$bulan = $this->input->post('bulan');
				$tahun = $this->input->post('tahun');
			 } 
*/
			$bulan = date("m")+0;
			$tahun = date("Y");

			//$query	= "select * from dk_invoice where 1 and bayar > 0";
			$query	= "SELECT * FROM dk_invoice WHERE 1";
            if(!empty($bulan))
            {
               $query .=" and year(tanggal_resepsi)='$tahun' and month(tanggal_resepsi)='$bulan' "; 

            }
 
			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		function daftar_invoice2(){
			
			   $bulan = date("m")+0;
			   $tahun = date("Y");
			
		   //$query	= "SELECT * FROM dk_invoice WHERE 1 AND bayar = 0 OR bayar IS NULL";
		   $query	= "SELECT * FROM dk_invoice WHERE 1";

		   if(!empty($bulan))
		   {
			  //$query .=" and year(tanggal_resepsi)='$tahun' and month(tanggal_resepsi)='$bulan' "; 
			  $query .=" and year(due_date)='$tahun' and month(due_date)='$bulan' "; 

		   }

		   $query 	= $this->db->query($query);

		   if($query->num_rows() > 0){

			   return $query->result();

		   }else{

			   return 0;

		   }

	   }

		function daftar_invoice_change(){

			if($this->input->post())
			{
			   $bulan = $this->input->post('bulan');
			   $tahun = $this->input->post('tahun');
			} 

		   //$query	= "select * from dk_invoice where 1 and bayar = 0 or bayar is null";
		   $query	= "SELECT * FROM dk_invoice WHERE 1";

		   if(!empty($bulan))
		   {
			 $query .=" and year(tanggal_resepsi)='$tahun' and month(tanggal_resepsi)='$bulan' "; 
			 //$query .=" and year(due_date)='$tahun' and month(due_date)='$bulan' ";  
		   }

		   $query 	= $this->db->query($query);

		   if($query->num_rows() > 0){

			   return $query->result();

		   }else{

			   return 0;

		   }

	   }

		function data_customer($id){

			$query	= "select a.*, b.telfon,b.email1 from dk_penawaran as a left join dk_prospek as b on a.id_prospek = b.id_prospek where a.id_prospek='$id' group by a.id_prospek";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		

		function detail($noinv){

			$query	= "select * from dk_invoice where invoice_no = '$noinv'";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		

		function get_inv($pros,$no){

			$query	= "select * from dk_invoice where id_prospek='$pros' and bayar_no='$no'";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		function get_inv2($pros,$no){

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$pros' AND no_bayar='$no'";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		function get_inv3($pros,$no){
			$cek_angsuran_edit = "SELECT * FROM dk_schedule WHERE id_prospek='$pros' and no_bayar='$no'";

			if($cek_angsuran_edit > 0){
				foreach($cek_angsuran_edit as $row){

					if($row->angsuran_ed > 0){
						$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$pros' and no_bayar='$no'";
					}else{
						$query	= "select * from dk_invoice where id_prospek='$pros' and bayar_no='$no'";
					}
				}
			}

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		

		function get_inv_no(){

			$query	= "select c_inv from dk_counter";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				$ret =  $query->result();

				return $ret[0]->c_inv;

			}else{

				return 0;

			}

		}

		

		function check($no,$id){

			$query	= "SELECT invoice_no from dk_invoice where bayar_no='$no' and id_prospek='$id' and total !='0'";

			$query 	= $this->db->query($query);

			if($query->num_rows() >0){

				return 1;

			}else{

				return 0;

			}

		}

		

		function check2($no,$id){

			$query	= "select invoice_no from dk_invoice where bayar_no='$no' and id_prospek='$id' and bayar >'0'";

			$query 	= $this->db->query($query);

			if($query->num_rows() >0){

				return 1;

			}else{

				return 0;

			}

		}

		

		function get_data($inv){

			$query = "select * from dk_invoice where invoice_no ='$inv'";

			$query = $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		

		function get_owner(){

			$query = "select nm_bank, cab_bank,no_bank from dk_master_owner";

			$query = $this->db->query($query);

			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		function get_owner2(){

			$query = "SELECT nama, no_bank2 from dk_master_owner where no_bank2 = '1' ORDER BY id";

			$query = $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}

		function get_tot_deal($id){

			$query = "SELECT total_deal FROM dk_master_customer WHERE id_prospek ='$id'";

			$query = $this->db->query($query);

			if($query->num_rows() > 0){

				$return = $query->result();

				return $return[0]->total_deal;

			}else{

				return 0;

			}

		}

		

		function get_tot_bayar($id){

			$query = "select sum(bayar) as tot from dk_invoice where id_prospek ='$id'";

			$query = $this->db->query($query);

			if($query->num_rows() > 0){

				$return = $query->result();

				return $return[0]->tot;

			}else{

				return 0;

			}

		}

      
		function get_last_no_kwitansi($format){

			$sql	= "SELECT no_kwitansi FROM dk_invoice WHERE no_kwitansi LIKE '".$format."%' ORDER BY no_kwitansi DESC LIMIT 1";

			$query	= $this->db->query($sql);

			if($query->num_rows() > 0) {

				return $query->row()->no_kwitansi;

			} else {

				return false;

			}

		}

		function q_schedule_invoice_tomorrow() {
			$query 	= "SELECT count(a.id_prospek) as ab
	    				FROM dk_schedule a 
	    				INNER JOIN dk_prospek b ON a.id_prospek=b.id_prospek 
	    				INNER JOIN dk_master_customer c ON a.id_prospek = c.id_prospek
						WHERE a.due_date= CURDATE()+1 ";
						$query	= $this->db->query($query);
						if($query->num_rows() > 0){
							$ret = $query->result();
							return $ret[0]->ab;
						}else{
							return 0;
						}
					}
		
		function q_schedule_invoice_tomorrow1(){			

			$query 	= "SELECT
							count(a.id_prospek) as ab
						FROM
							dk_invoice a
						JOIN dk_schedule b on a.id_prospek = b.id_prospek
						where
						a.invoice_date > NOW() + 1";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				$ret = $query->result();
				return $ret[0]->ab;
			}else{
				return 0;
			}
		}
		function q_schedule_invoice_tomorrow2(){			
	
			$query 	= "SELECT
							*
						FROM
							dk_invoice
						
						where
						due_date > NOW()+7";
			$query	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}

		function cek_angsuran($id_prospek){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$id_prospek' ORDER BY no_bayar";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}   

		function cek_angsuran2($prospek,$no){			

			$query	= "SELECT * FROM dk_schedule WHERE id_prospek='$prospek' AND no_bayar='$no' ORDER BY no_bayar";
			$query 	= $this->db->query($query);
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return 0;
			}
		}
		
		function nokir_jurnal($inv,$jml_byr){			

			$query	= "SELECT * FROM jurnal WHERE keterangan LIKE '%$inv%' AND debet LIKE '%$jml_byr%' ORDER BY id";

			$query 	= $this->db->query($query);

			if($query->num_rows() > 0){

				return $query->result();

			}else{

				return 0;

			}

		}   


	}

?>