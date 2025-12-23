<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Invoice extends CI_Controller {

	public function __construct(){

		parent::__construct();

		if(!$this->session->userdata('logged_in')){

			redirect('login');

		}

		$this->load->model('invoice_model');
		$this->load->model('master_model');

		$this->load->model('Jurnal_model');

		$this->load->model('order_model');

		$this->load->helper('menu'); 

	}

	function index(){

		$this->list_invoice();
		//$this->list_inv();

	}

	function list_inv(){

		$data['judul']			= "List Customer";

		$data['list_invoice'] 	= $this->invoice_model->get_list_invoice();
		

		$this->load->view('invoicing/v_list_invoice',$data);

	}

	function list_inv_change(){

		$data['judul']			= "List Customer";

		$data['list_invoice'] 	= $this->invoice_model->get_list_invoice_change();

		$this->load->view('invoicing/v_list_invoice',$data);

	}

	

	function list_detail(){

		$data['judul']			= "Detail Invoice";

		$id						= $this->uri->segment(3);
		
		$id						= str_replace('_','|',$id);

		$data['list_invoice'] 	= $this->invoice_model->invoice_detail($id);
		
		$data['data_angsuran'] 	= $this->invoice_model->cek_angsuran($id);

		$data['data_piutang1'] 	= $this->invoice_model->get_piutang1($id);
		$data['data_piutang2'] 	= $this->invoice_model->get_piutang2($id);
		$data['data_piutang3'] 	= $this->invoice_model->get_piutang3($id);
		$data['data_piutang4'] 	= $this->invoice_model->get_piutang4($id);
		$data['tot_piutang'] 	= $this->invoice_model->get_tot_piutang($id);

		$data['data_prospek'] 	= $this->order_model->get_prospek($id);
		

		$data['total_deal']		= $this->invoice_model->get_tot_deal($id);
		

    	$this->load->view('invoicing/v_invoice_detail',$data);

	}

	function edit_angsuran(){

		$data['judul']			= "Edit Angsuran";

		$id						= $this->uri->segment(3);
		
		$id						= str_replace('_','|',$id);

		$data['list_invoice'] 	= $this->invoice_model->invoice_detail($id);
		
		

		$data['data_angsuran1'] 	= $this->invoice_model->get_angsuran1($id);
		$data['data_angsuran2'] 	= $this->invoice_model->get_angsuran2($id);
		$data['data_angsuran3'] 	= $this->invoice_model->get_angsuran3($id);
		$data['data_angsuran4'] 	= $this->invoice_model->get_angsuran4($id);
		$data['tot_piutang'] 	= $this->invoice_model->get_tot_piutang($id);

		$data['data_prospek'] 	= $this->order_model->get_prospek($id);

		$data['total_deal']		= $this->invoice_model->get_tot_deal($id);
		

    	$this->load->view('invoicing/v_edit_angsuran',$data);

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
		//redirect('invoice/list_inv'); 

	}

	

	function daftar(){

		$data['judul']		= "Daftar Invoice & Receipt";

		$data['list_invoice']	= $this->invoice_model->daftar_invoice();

		$this->load->view("invoicing/daftar_invoice", $data);

	}

	function daftar_change(){

		$data['judul']		= "Daftar Invoice & Receipt";

		$data['list_invoice']	= $this->invoice_model->daftar_invoice_change();

		$this->load->view("invoicing/daftar_invoice", $data);

	}

	

	function print_invoice2(){

		$prospek 				= $this->uri->segment(3);

		$data['no']				= $this->uri->segment(4);

		$no						= $this->uri->segment(4);

		$data['data_invoice'] 	= $this->invoice_model->print_invoice($prospek);

		$data_invoice 			= $this->invoice_model->print_invoice($prospek);

		$data['data_owner'] 	= $this->order_model->get_owner();

		$cek_edit_angsuran		= $this->invoice_model->get_inv2($prospek,$no);
		$data['data_s2'] 		= $this->invoice_model->get_inv2($prospek,$no);	
		$data['data_s'] 		= $this->invoice_model->get_inv($prospek,$no);
/*
		if($cek_edit_angsuran > 0){			
			foreach($cek_edit_angsuran as $row2){
				if($row2->angsuran_ed > 0){
					$data['data_s2'] 		= $this->invoice_model->get_inv2($prospek,$no);					
				}
			}
		}else{
			$data['data_s'] 		= $this->invoice_model->get_inv($prospek,$no);
		}		
*/
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
		$data['total_deal']		= $this->invoice_model->get_tot_deal($prospek);
		$data['nominal_invoice'] = $this->invoice_model->cek_angsuran2($prospek,$no);
		$data['data_invoice'] 	= $this->invoice_model->print_invoice($prospek);

		$data['data_customer'] 	= $this->invoice_model->data_customer($prospek);

		$data['data_owner'] 	= $this->order_model->get_owner();
		$data['data_owner2']	= $this->invoice_model->get_owner2();

		$this->load->view('invoicing/v_view_invoice',$data);

	}

	

	function cancel(){

		$inv 				= $this->uri->segment(3);

		$pro 				= $this->uri->segment(4);

		$this->db->query("DELETE FROM dk_invoice WHERE invoice_no = '$inv' ");
		$this->db->query("UPDATE dk_schedule set nomor_invoice=null WHERE id_prospek='$pro' AND nomor_invoice='$inv'");

		//$this->db->query("update dk_invoice set jumlah='0',total='0' where invoice_no='$inv' and bayar !=''");

		//redirect('invoice/list_detail/'.$pro);
		redirect('invoice/daftar'); 

	}

	function cancel_byr(){

		$inv 						= $this->uri->segment(3);
		$no_prospek 				= $this->uri->segment(4);
		$nganten					= str_replace("_"," & ",$this->uri->segment(5));							
		$jml_byr					= $this->uri->segment(6);
		$no_penawaran				= str_replace("_","|",$this->uri->segment(7));
		$bayar_via					= $this->uri->segment(8);
		
		$this->db->query("UPDATE dk_invoice set bayar=NULL,bayar_via=NULL,bank=NULL,updateby=NULL, tanggal_bayar=NULL, no_kwitansi=NULL, tgl_kwitansi=NULL, receipt_by=NULL where invoice_no ='$inv'");

		$this->db->query("UPDATE dk_schedule set bayar=NULL,bayar_via=NULL,bank=NULL,insert_bayar_by=NULL,bayar_tgl=NULL where nomor_invoice ='$inv'");

		$this->db->query("UPDATE dk_master_customer set piutang=piutang+$jml_byr where id_prospek ='$no_prospek'");

		//$this->db->query("DELETE from jarh where note LIKE '%$inv%' ");
		// jangan di delete tapi di update, dikasih status batal=1

		$this->db->query("DELETE from jurnal where keterangan LIKE '%$inv%' ");

		//$this->db->query("DELETE from jarh where note LIKE '%$inv%' ");
		// jangan di delete tapi di update, dikasih status batal=1
		
		//str_replace(",","",str_replace(".","",$this->uri->segment(7)));

		//redirect('invoice/list_detail/'.$pro); 

		// insert ke jarh dan jurnal
/*
		$Nomor_BUM		= $this->Jurnal_model->get_no_bum();
		//$NoProject 		= $this->input->post('noprjct');
		$var_teks 		= "Pembatalan Pembayaran a/n. ";
		$KurungBuka		= " ( ";
		$KurungTutup	= " )";
		$var_note 		= $var_teks.$nganten.$KurungBuka.$inv.$KurungTutup;

		$input_jarh			= array(
			'nomor'			=> $Nomor_BUM,
			'tgl'			=> date("Y-m-d"),
			'jml'			=> $jml_byr,
			'kdcab'			=> '201',
			'jenis_reff'	=> $bayar_via,
			'no_reff'		=> $no_penawaran,
			'terima_dari'	=> $nganten,
			'jenis_ar'		=> 'V',
			'note'			=> $var_note,
			'batal'			=> '1'
		);

		//$nokirbank 		= $this->input->post('nm_bank');
		//$ambilnokir 	= substr($nokirbank,0,10);
		
		//$ambilnokir 	= $this->db->query("SELECT no_perkiraan FROM jurnal WHERE keterangan LIKE '%$inv%' AND debet LIKE '%$jml_byr%' ORDER BY id");

		$ambilnokir 	= $this->invoice_model->nokir_jurnal($inv,$jml_byr);

		

		if($ambilnokir > 0){
			foreach($ambilnokir as $row5){
				$nokir = $row5->no_perkiraan;
			}
		}
		
		$input_jurnal_debit	= array(
			'tipe'          => 'BUM',
			'nomor'			=> $Nomor_BUM,
			'tanggal'		=> date("Y-m-d"),
			'no_perkiraan'	=> $nokir,
			'keterangan'	=> $var_note,
			'jenis_trans'	=> $bayar_via,
			'no_reff'		=> $no_penawaran,
			'debet'         => '0',
			'kredit'        => $jml_byr
			
		);

		$input_jurnal_kredit= array(
			'tipe'          => 'BUM',
			'nomor'			=> $Nomor_BUM,
			'tanggal'		=> date("Y-m-d"),
			'no_perkiraan'	=> '4101-01-01',
			'keterangan'	=> $var_note,
			'jenis_trans'	=> $bayar_via,
			'no_reff'		=> $no_penawaran,
			'debet'         => $jml_byr,
			'kredit'        => '0'
			
		);
		
		
		$this->db->insert("jarh",$input_jarh);
		$this->db->insert("jurnal",$input_jurnal_debit);
		$this->db->insert("jurnal",$input_jurnal_kredit);
		$this->db->query("UPDATE dk_invoice set bayar='0',batal='1', tanggal_bayar=NULL, bayar_via=NULL, bank=Null, no_kwitansi=NULL, tgl_kwitansi=NULL, receipt_by=NULL where invoice_no='$inv' and bayar !=''");

	//update last NOMOR BUM ke pastibisa_tb_cabang

		$ambilnobum = substr($Nomor_BUM,8,4);
		$data3 = array('nobum'=> $ambilnobum);
		$this->db->update("pastibisa_tb_cabang",$data3);

		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>";
	
*/
		//redirect('invoice/list_inv'); 
		redirect('invoice/daftar');
	}

	

	function edit_invoice(){

		$data['judul']			= "Edit Invoice";

		$invoice_no				= $this->uri->segment(3);
		$id_prospek				= $this->uri->segment(4);
		$cicilan_ke				= $this->uri->segment(5);

		$data['total_deal']		= $this->invoice_model->get_tot_deal($id_prospek);

		$data['data_angsuran'] 	= $this->invoice_model->cek_angsuran2($id_prospek,$cicilan_ke);

		$data['data_invoice']	= $this->invoice_model->get_data($invoice_no);
		$data['data_owner2']	= $this->invoice_model->get_owner2();

		$this->load->view('invoicing/v_edit_invoice',$data);

	}



	function proses_edit_invoice(){
		$nomor_prospek 	= $this->input->post('id_prospek');
		$invoice_no 	= $this->input->post('inv');
		$cici_ke 		= $this->input->post('no_byr');

		$billed_to		= $this->input->post('billed_to');
		$penagih		= $this->input->post('nm_owner');

		$due_date		= date('Y-m-d', strtotime($this->input->post('due_date')));

		$angs 		= str_replace(",","",str_replace(".","",$this->input->post('angsuran')));

		$jumlah 		= str_replace(",","",str_replace(".","",$this->input->post('jumlah')));

		$materai 		= str_replace(",","",str_replace(".","",$this->input->post('materai')));

		$dpp 			= str_replace(",","",str_replace(".","",$this->input->post('dpp')));

		$ppn 			= str_replace(",","",str_replace(".","",$this->input->post('ppn')));

		$total 			= str_replace(",","",str_replace(".","",$this->input->post('total')));



		$this->db->query("UPDATE dk_invoice set ditagihkan_oleh='$penagih', jumlah='$jumlah', materai='$materai', dasar_ppn='$dpp', ppn='$ppn', total='$total' where invoice_no ='$invoice_no'");

		$this->db->query("UPDATE dk_schedule set angsuran_ed='$angs' where id_prospek = $nomor_prospek and no_bayar ='$cici_ke' ");

		redirect('invoice/daftar'); 


	}

	

	function payment(){

		$data['judul']			= "Input Pembayaran";
		

		$invoice_no				= $this->uri->segment(3);
		$data['data_bank']		= $this->invoice_model->get_bank();
		$data['data_cash']		= $this->invoice_model->get_cash();

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

		// insert ke jarh dan jurnal

		$Nomor_BUM		= $this->Jurnal_model->get_no_bum();
		$NoProject 		= $this->input->post('noprjct');
		$var_teks 		= "Pembayaran a/n. ";
		$KurungBuka		= " ( ";
		$KurungTutup	= " )";
		$var_note 		= $var_teks.$receipt_by.$KurungBuka.$invoice_no.$KurungTutup;

		$input_jarh			= array(
			'nomor'			=> $Nomor_BUM,
			'tgl'			=> $tgl_kwitansi,
			'jml'			=> $jum_bayar,
			'kdcab'			=> '201',
			'jenis_reff'	=> $metode,
			'no_reff'		=> $NoProject,
			'terima_dari'	=> $receipt_by,
			'jenis_ar'		=> 'V',
			'note'			=> $var_note,
			'batal'			=> '0'
		);

		$nokirbank 		= $this->input->post('nm_bank');
		$ambilnokir 	= substr($nokirbank,0,10);
		
		$input_jurnal_debit	= array(
			'tipe'          => 'BUM',
			'nomor'			=> $Nomor_BUM,
			'tanggal'		=> $tgl_kwitansi,
			'no_perkiraan'	=> $ambilnokir,
			'keterangan'	=> $var_note,
			'jenis_trans'	=> $metode,
			'no_reff'		=> $NoProject,
			'debet'         => $jum_bayar,
			'kredit'        => '0'
			
		);

		$input_jurnal_kredit= array(
			'tipe'          => 'BUM',
			'nomor'			=> $Nomor_BUM,
			'tanggal'		=> $tgl_kwitansi,
			'no_perkiraan'	=> '4101-01-01',
			'keterangan'	=> $var_note,
			'jenis_trans'	=> $metode,
			'no_reff'		=> $NoProject,
			'debet'         => '0',
			'kredit'        => $jum_bayar
			
		);
		
		
		$this->db->insert("jarh",$input_jarh);
		$this->db->insert("jurnal",$input_jurnal_debit);
		$this->db->insert("jurnal",$input_jurnal_kredit);


	//update last NOMOR BUM ke pastibisa_tb_cabang

		$ambilnobum = substr($Nomor_BUM,8,4);
		$data3 = array('nobum'=> $ambilnobum);
		$this->db->update("pastibisa_tb_cabang",$data3);
	
		echo "<script> alert('Data berhasil di simpan!')";
		echo "</script>"; 

		redirect('invoice/daftar'); 

	}

	

	function get_bank_cash(){

		$id = $this->input->get('option');
		//echo $id;
		//exit;

		if($id == 'CASH'){
			$data_cash 	= $this->invoice_model->get_cash();
			if($data_cash > 0){
				foreach($data_cash as $key=>$vals){
					$kode_Coa			= $vals->no_perkiraan.'^'.$vals->nama;
					$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan.'  '.$vals->nama;
				}
			} 
			echo "<select name='nm_bank' class='form-control' id='nm_bank'>";
			echo "<option value='0'>-Bank-</option>";
			
				if($data_cash > 0){
					foreach($Arr_Coa as $key=>$row3){
						echo "<option value='".$key."'>".$row3."</option>";														
					}
				}
			echo "</select>";
		}
		else{
			$data_bank 	= $this->invoice_model->get_bank();
			if($data_bank > 0){
				foreach($data_bank as $key2=>$vals2){
					$kode_Coa2			= $vals2->no_perkiraan.'^'.$vals2->nama;
					$Arr_Coa2[$kode_Coa2]	= $vals2->no_perkiraan.'  '.$vals2->nama;
				}
			} 
			echo "<select name='nm_bank' class='form-control' id='nm_bank'>";
			echo "<option value='0'>-Bank-</option>";
			
			if($data_bank > 0){
				foreach($Arr_Coa2 as $key2=>$row4){
					echo "<option value='".$key2."'>".$row4."</option>";														
				}
			}
			echo "</select>";
		}
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

		$data['judul'] 			= "Data Schedule";	
		$data ['schedule'] 	= $this->invoice_model->q_schedule_invoice_tomorrow1();
		$this->load->view('invoicing/v_list_schedule', $data);
	}
	
	function edit_jadwal_invoice() {
		$id_penawaran	= $this->input->post('id_penawaran');
		$id_prospek		= $this->input->post('id_prospek');
		$no_bayar		= $this->input->post('no_bayar');
		$jadwal			= $this->input->post('jadwal');
		$edi_angsur		= $this->input->post('edit_angsuran');

		$this->db->query("UPDATE dk_schedule SET due_date='$jadwal' WHERE id_penawaran='$id_penawaran' AND no_bayar='$no_bayar'");
		redirect('invoice/list_detail/'.$id_prospek);
	}

	function proses_edit_angsuran() {
		//$id_prospek		= $this->input->post('id_prospek');
		$id_prospek		= $this->uri->segment(3);
		
		$ang1			= str_replace(",","",str_replace(".","",$this->input->post('angsuran1')));
		$ang2			= str_replace(",","",str_replace(".","",$this->input->post('angsuran2')));
		$ang3			= str_replace(",","",str_replace(".","",$this->input->post('angsuran3')));
		$ang4			= str_replace(",","",str_replace(".","",$this->input->post('angsuran4')));

		$this->db->query("UPDATE dk_schedule SET angsuran_ed='$ang1' WHERE id_prospek='$id_prospek' AND no_bayar='1'");
		$this->db->query("UPDATE dk_schedule SET angsuran_ed='$ang2' WHERE id_prospek='$id_prospek' AND no_bayar='2'");
		$this->db->query("UPDATE dk_schedule SET angsuran_ed='$ang3' WHERE id_prospek='$id_prospek' AND no_bayar='3'");
		$this->db->query("UPDATE dk_schedule SET angsuran_ed='$ang4' WHERE id_prospek='$id_prospek' AND no_bayar='4'");
		redirect('invoice/list_inv');
	}

}