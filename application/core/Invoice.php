<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Invoice extends CI_Controller {

	public function __construct(){

		parent::__construct();

		if(!$this->session->userdata('logged_in')){

			redirect('login');

		}

		$this->load->model('invoice_model');

		$this->load->model('Jurnal_model');

		$this->load->model('order_model');

		$this->load->helper('menu'); 

	}

	function index(){

		$this->list_invoice();

	}

	function list_inv(){

		$data['judul']			= "List Customer";

		$data['list_invoice'] 	= $this->invoice_model->get_list_invoice();

		$this->load->view('invoicing/v_list_invoice',$data);

	}

	

	function list_detail(){

		$data['judul']			= "Detail Invoice";

		$id						= $this->uri->segment(3);

		$id						= str_replace('_','|',$id);

		$data['list_invoice'] 	= $this->invoice_model->invoice_detail($id);

		$data['data_prospek'] 	= $this->order_model->get_prospek($id);

		$data['total_deal']		= $this->invoice_model->get_tot_deal($id);

	
    	$this->load->view('invoicing/v_invoice_detail',$data);

	}

	

	function create_invoice(){

		$data['judul']			= "List Detail";

		$id						= $this->uri->segment(3);

		$id						= str_replace('_','|',$id);

		$data['list_invoice'] 	= $this->invoice_model->invoice_detail($id);

		$this->load->view('invoicing/v_invoice_detail',$data);

	}

	

	function print_invoice(){

		$prospek 		= $this->uri->segment(3);

		$no		 		= $this->uri->segment(4);

		$data['no'] 	= $no;

		$data['data_invoice'] 	= $this->invoice_model->print_invoice($prospek);

		$data_invoice 			= $this->invoice_model->print_invoice($prospek);

		$data['data_owner'] 	= $this->order_model->get_owner();

		$data_owner		= $this->order_model->get_owner();

		$inv_nox 	= $this->invoice_model->get_inv_no();

		$inv_nox  	= $inv_nox+1;

		$inv_no 	= "INV".date("ym").$inv_nox;

		$data['inv_no'] =  $inv_no;

		if($data_invoice>0){

			foreach($data_invoice as $row){

				if($this->uri->segment(4)==1){

					$jumlah = $row->harga * 20/100;

				}else if($this->uri->segment(4)==2){

					$jumlah = $row->harga * 20/100;

				}else if($this->uri->segment(4)==3){

					$jumlah = $row->harga - $row->dp1 - $row->dp2 - $row->dp3 - $row->dp4;

				}else{

					$jumlah = $row->harga - $row->dp1 - $row->dp2 - $row->dp3 - $row->dp4;

				}

				$data_inv = array(

				'invoice_no'		=> $inv_no,

				'invoice_date'		=> date("Y-m-d"),

				'id_prospek'		=> $row->id_prospek,

				'id_penawaran'		=> $row->id_penawaran,

				'date_customer'		=> "",

				'ditagihkan_oleh'	=> $this->input->post('nm_owner'),

				'billed_to'			=> $this->input->post('billed_to'),

				'due_date'			=> date('Y-m-d', strtotime($this->input->post('due_date'))),

				'receiveby'			=> "",

				'sendby'			=> "",

				'receive_cust_date'	=> "",

				'tanggal_resepsi'	=> $row->tanggal_respsi,

				'pria'				=> $row->pengantin_pria,

				'wanita'			=> $row->pengantin_wanita,

				'nocust'			=> $row->nocust,

				'namacust'			=> $row->pengantin_pria,

				'address'			=> $row->alamat1,

				'jumlah'			=> str_replace(",","",str_replace(".","",$this->input->post('harga'))),

				'ppn'				=> str_replace(",","",str_replace(".","",$this->input->post('ppn'))),

				'total'				=> str_replace(",","",str_replace(".","",$this->input->post('tot'))),

				'materai'			=> str_replace(",","",str_replace(".","",$this->input->post('materai'))),

				'dasar_ppn'			=> str_replace(",","",str_replace(".","",$this->input->post('dpp'))),

				'rev_by'			=> "",

				'date_rev'			=> "",

				'cancel_reason'		=> "",

				'cancel_by'			=> "",

				'cancel_date'		=> "",

				'npwp'				=> "",

				'nppkp'				=> "",

				'periode'			=> $row->tanggal_respsi,

				'faktur_tmp'		=> "",

				'batal'				=> "",

				'entryby'			=> $this->session->userdata('pn_name'),

				'updateby'			=> "",

				'keterangan'		=> "pembayaran ke-".$this->uri->segment(4)." sebesar ".$jumlah,

				'penalty'			=> str_replace(",","",str_replace(".","",$this->input->post('discount'))),

				'bayar_no'			=> $this->uri->segment(4)

				);

				$this->db->insert('dk_invoice',$data_inv);

			}

			

			$this->db->query("update dk_schedule set nomor_invoice = '$inv_no',id_penawaran='".$row->id_penawaran."' where id_prospek='".$row->id_prospek."' and no_bayar='".$this->uri->segment(4)."'");

			

			$this->db->query("update dk_counter set c_inv=c_inv+1");

			

			$data['pemesan'] 		= $row->pengantin_pria." & ".$row->pengantin_wanita;

			$data['nocust'] 		= $row->nocust;

			$data['id_penawaran'] 	= $row->id_penawaran;

		}

		/* $html			= $this->load->view('invoicing/v_print_invoice',$data,true);

		$pdfFilePath	= $prospek."-".$no.".pdf";

		$this->load->library('m_pdf');

		$pdf			= $this->m_pdf->load();

		//$mpdf = new mPDF('c', 'A4-L'); 

		$pdf->AddPage('P', '', '', '',

				30, // margin_left

				30, // margin right

				20, // margin top

				10, // margin bottom

				10, // margin header

				10); // margin footer

		$pdf->WriteHTML($html);

		$pdf->Output($pdfFilePath, "I"); */

		redirect('invoice/daftar'); 

	}

	

	function daftar(){

		$data['judul']		= "Daftar Invoice & Receipt";

		$data['list_invoice']	= $this->invoice_model->daftar_invoice2();

		$this->load->view("invoicing/daftar_invoice", $data);

	}

	

	function print_invoice2(){

		$prospek 				= $this->uri->segment(3);

		$data['no']				= $this->uri->segment(4);

		$no						= $this->uri->segment(4);

		$data['data_invoice'] 	= $this->invoice_model->print_invoice($prospek);

		$data_invoice 			= $this->invoice_model->print_invoice($prospek);

		$data['data_owner'] 	= $this->order_model->get_owner();

		$data['data_s'] 		= $this->invoice_model->get_inv($prospek,$no);

		$data['data_customer'] 		= $this->invoice_model->data_customer($prospek);

		$html					= $this->load->view('invoicing/v_print_invoice2',$data,true);

		$pdfFilePath			= $prospek."-".$no.".pdf";

		$this->load->library('m_pdf');

		$pdf			= $this->m_pdf->load();

		//$mpdf = new mPDF('c', 'A4-L'); 

		$pdf->AddPage('P', '', '', '',

				30, // margin_left

				30, // margin right

				20, // margin top

				10, // margin bottom

				10, // margin header

				10); // margin footer

		$pdf->WriteHTML($html);

		$pdf->Output($pdfFilePath, "I");

	}



	function print_receipt(){

		$prospek 				= $this->uri->segment(3);

		$no						= $this->uri->segment(4);

		$data['no']				= $no;

		$data['data_invoice'] 	= $this->invoice_model->print_invoice($prospek);

		$data['data_owner'] 	= $this->order_model->get_owner();

		$data['data_s'] 		= $this->invoice_model->get_inv($prospek,$no);

		$data['data_customer']	= $this->invoice_model->data_customer($prospek);

		$html					= $this->load->view('invoicing/v_print_receipt',$data,true);

		$pdfFilePath			= $prospek."-".$no.".pdf";

		$this->load->library('m_pdf');

		$pdf			= $this->m_pdf->load();

		//$mpdf = new mPDF('c', 'A4-L'); 

		$pdf->AddPage('P', '', '', '',

				30, // margin_left

				30, // margin right

				20, // margin top

				10, // margin bottom

				10, // margin header

				10); // margin footer

		$pdf->WriteHTML($html);

		$pdf->Output($pdfFilePath, "I");

	}

	

	function detail_invoice(){

		$data['judul']			= "Detail Invoice";

		$noinv			= $this->uri->segment(3);

		$data['list_invoice']	= $this->invoice_model->detail($noinv);

		$this->load->view("invoicing/v_detail",$data);

	}

	

	function view_invoice(){

		$prospek 				= $this->uri->segment(3);

		$no		 				= $this->uri->segment(4);

		$data['judul'] 			= "Invoice Detail";

		$data['no'] 			= $no;

		$data['data_invoice'] 	= $this->invoice_model->print_invoice($prospek);

		$data['data_customer'] 	= $this->invoice_model->data_customer($prospek);

		$data['data_owner'] 	= $this->order_model->get_owner();
		$data['data_owner2']	= $this->invoice_model->get_owner2();

		$this->load->view('invoicing/v_view_invoice',$data);

	}

	

	function cancel(){

		$inv 				= $this->uri->segment(3);

		$pro 				= $this->uri->segment(4);

		$this->db->query("update dk_invoice set jumlah='0',total='0' where invoice_no='$inv' and bayar !=''");

		redirect('invoice/list_detail/'.$pro); 

	}

	

	function edit_invoice(){

		$data['judul']			= "Edit Invoice";

		$invoice_no				= $this->uri->segment(3);

		$data['data_invoice']	= $this->invoice_model->get_data($invoice_no);
		$data['data_owner2']	= $this->invoice_model->get_owner2();

		$this->load->view('invoicing/v_edit_invoice',$data);

	}



	function proses_edit_invoice(){

		$invoice_no 	= $this->input->post('inv');

		$billed_to		= $this->input->post('billed_to');
		$penagih		= $this->input->post('nm_owner');

		$due_date		= date('Y-m-d', strtotime($this->input->post('due_date')));

		$jumlah 		= str_replace(",","",str_replace(".","",$this->input->post('jumlah')));

		$materai 		= str_replace(",","",str_replace(".","",$this->input->post('materai')));

		$dpp 			= str_replace(",","",str_replace(".","",$this->input->post('dpp')));

		$ppn 			= str_replace(",","",str_replace(".","",$this->input->post('ppn')));

		$total 			= str_replace(",","",str_replace(".","",$this->input->post('total')));



		$this->db->query("update dk_invoice set ditagihkan_oleh='$penagih', jumlah='$jumlah', materai='$materai', dasar_ppn='$dpp', ppn='$ppn', total='$total' where invoice_no ='$invoice_no'");



		redirect('invoice/daftar'); 


	}

	

	function payment(){

		$data['judul']			= "Input Pembayaran";
		$data['data_bank']		= $this->Jurnal_model->get_bank();

		$invoice_no				= $this->uri->segment(3);

		$data['data_invoice']	= $this->invoice_model->get_data($invoice_no);

		$data['data_owner']		= $this->invoice_model->get_owner();

		$data['pay_methods']	= array(0, "CASH", "CHECK", "TRANSFER", "BG");

		$data['pay_text']		= array("-Pilih Metode Pembayaran-", "CASH", "CHECK", "TRANSFER", "BG");

		$this->load->view('invoicing/v_input_pembayaran',$data);

	}

	

	function proses_payment(){

		$invoice_no 	= $this->input->post('inv');

		$nocust 		= $this->input->post('nocust');

		$metode 		= $this->input->post('metode');
		
		$namabank 	  	= $this->input->post('nm_bank');
		$bank		 	= substr($namabank,11,21);

		$no_bank 		= $this->input->post('no_bank');

		$tgl_kwitansi	= date("Y-m-d", strtotime($this->input->post('tgl_kwitansi')));

		$receipt_by		= $this->input->post('receipt_by');

		$jumlah 		= str_replace(",","",str_replace(".","",$this->input->post('jumlah')));

		$materai 		= str_replace(",","",str_replace(".","",$this->input->post('materai')));

		$dpp 			= str_replace(",","",str_replace(".","",$this->input->post('dpp')));

		$ppn 			= str_replace(",","",str_replace(".","",$this->input->post('ppn')));

		$total 			= str_replace(",","",str_replace(".","",$this->input->post('total')));

		$jum_bayar 		= str_replace(",","",str_replace(".","",$this->input->post('jum_bayar')));

		$tot_bayar		= $jum_bayar - $ppn - $materai;



		$f_kwitansi				= "K/".date("Y/m", strtotime($tgl_kwitansi))."/";

		$get_last_no_kwitansi	= $this->invoice_model->get_last_no_kwitansi($f_kwitansi);

		if ($get_last_no_kwitansi) {

			$last_no_kwitansi	= str_replace($f_kwitansi, "", $get_last_no_kwitansi);

			$no_kwitansi		= $f_kwitansi.sprintf("%04s", $last_no_kwitansi+1);

		} else {

			$no_kwitansi		= $f_kwitansi."0001";

		}

		

		$this->db->query("update dk_invoice set bayar='$tot_bayar',bayar_via='$metode',bank='$bank',updateby='".$this->session->userdata('pn_name')."', tanggal_bayar='".date("Y-m-d H:i:s")."', no_kwitansi='".$no_kwitansi."', tgl_kwitansi='".$tgl_kwitansi."', receipt_by='".$receipt_by."' where invoice_no ='$invoice_no'");
		/*
		$this->db->query("update dk_invoice set bayar='$tot_bayar',bayar_via='$metode',bank='$bank',norek='$no_bank',updateby='".$this->session->userdata('pn_name')."', tanggal_bayar='".date("Y-m-d H:i:s")."', no_kwitansi='".$no_kwitansi."', tgl_kwitansi='".$tgl_kwitansi."', receipt_by='".$receipt_by."' where invoice_no ='$invoice_no'");
		*/
		$this->db->query("update dk_schedule set bayar='$tot_bayar',bayar_via='$metode',bank='$bank',insert_bayar_by='".$this->session->userdata('pn_name')."',bayar_tgl='".$tgl_kwitansi."' where nomor_invoice ='$invoice_no'");

		$this->db->query("update dk_master_customer set piutang=piutang-$tot_bayar where nocust ='$nocust'");

		redirect('invoice/list_inv'); 

	}

	

	function get_cabang(){

		$id = $this->input->get('option');

		$data_owner 	= $this->order_model->get_owner();

		echo "<select name='cab_bank' class='form-control' id='cab_bank'>";

			echo "<option value='0'>-Pilih Cabang-</option>";

			if($data_owner > 0){

				foreach($data_owner as $rows){

					if($rows->nm_bank == $id){

						echo "<option value='".$rows->cab_bank."' selected>".$rows->cab_bank."</option>";

					}

				}

			}

			

		echo "</select>";

	}

	

	function get_norek(){

		$id = $this->input->get('option');

		$data_owner 	= $this->order_model->get_owner();

		echo "<select name='no_bank' class='form-control' id='no_bank'>";

			echo "<option value='0'>-Pilih No Rekening-</option>";

			if($data_owner > 0){

				foreach($data_owner as $rows){

					if($rows->nm_bank == $id){

						echo "<option value='".$rows->no_bank."' selected>".$rows->no_bank."</option>";

					}

				}

			}

			

		echo "</select>";

	}
	
	function list_schedule_invoice() {
    	$schedule	= $this->invoice_model->q_schedule_invoice_tomorrow();
		$data	= array(
				'judul'		=> 'List Schedule Tomorrow',
				'schedule'	=> $schedule
			);

		$this->load->view('invoicing/v_list_schedule', $data);
	}
	
	function edit_jadwal_invoice() {
		$id_penawaran	= $this->input->post('id_penawaran');
		$id_prospek		= $this->input->post('id_prospek');
		$no_bayar		= $this->input->post('no_bayar');
		$jadwal			= $this->input->post('jadwal');

		$this->db->query("UPDATE dk_schedule SET due_date='$jadwal' WHERE id_penawaran='$id_penawaran' AND no_bayar='$no_bayar'");
		redirect('invoice/list_detail/'.$id_prospek);
	}

}