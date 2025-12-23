<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Latihan2 extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('login');
		}
		$this->load->library('session');
        $this->session->userdata('pn_name');
		$this->load->model('Model_latihan2');
		$this->load->model('Model_latihan');
		$this->load->model('Jurnal_model');
		$this->load->helper('menu');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function cetak_nokir1(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10); // 1111-11-11

		$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan1' name='detail[1][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir2(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
		$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan2' name='detail[2][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir3(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
		$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan3' name='detail[3][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir4(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
		$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan4' name='detail[4][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir5(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
		$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan5' name='detail[5][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir6(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan6' name='detail[6][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir7(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan7' name='detail[7][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir8(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan8' name='detail[8][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir9(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan9' name='detail[9][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir10(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan10' name='detail[10][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir11(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan11' name='detail[11][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir12(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan12' name='detail[12][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir13(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan13' name='detail[13][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir14(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan14' name='detail[14][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}
	public function cetak_nokir15(){
		$id_ = $this->input->get('option');
		$id = substr($id_,0,10);
$data_periode_aktif = $this->Model_latihan2->cek_periode_aktif();	

		if($data_periode_aktif > 0){
			foreach($data_periode_aktif as $row_pa){
				$tgl_periode = $row_pa->periode;
				$bln_periode = substr($tgl_periode,0,2);
				$thn_periode = substr($tgl_periode,3,4);
			}
		}
				$data_namkir1	= $this->Model_latihan2->cek_nokir2($id,$bln_periode,$thn_periode);
				if($data_namkir1 > 0){
					foreach($data_namkir1 as $row_namkir1){
						$nama1		= $row_namkir1->nama;				
					}
				}		
				echo "<input type='text' class='form-control input-sm' id='keterangan15' name='detail[15][keterangan]' value='".$nama1."'>";
				echo "</td>";
	}	
	
public function project1(){
	$data['judul'] 			= "Daftar COA";	
	$data['data_stock']		= $this->Model_latihan->stock();
	$this->load->view('latihan/v_brg1',$data);

	}
	//====================================================== stock ==============================================
	public function update_tipe_coa(){
		$data_tipe	= $this->Model_latihan->get_tipe();	
		if($data_tipe > 0){
			foreach($data_tipe as $row_tipe){
				$coa	= $row_tipe->COA;
				$tipe 	= $row_tipe->tipe; 
				$faktor = $row_tipe->faktor;

				$this->db->query("UPDATE COA set tipe ='$tipe', faktor='$faktor' where no_perkiraan like '$coa%'");
				}
				
			}
			
		
			redirect('Latihan/project1');

	}
	
	public function add_stock(){
		
		$data['data_cabang']=$this->Model_latihan->cek_kode_cabang();
		$data['data_nokir']=$this->Model_latihan->cek_nokir();
		$this->load->view('latihan/add_view',$data);
	}
	public function cetak_nokir(){
		$id = $this->input->get('option'); // 1101-01-00
		$id_ = substr($id,0,8); // 1101-01-
		
		$data_nokirbr	= $this->Model_latihan->get_nokirbr($id_);
		if($data_nokirbr > 0){
			foreach($data_nokirbr as $row_nokirbr){
				$nokir_		= $row_nokirbr->no_perkiraan;//hasil 1101-01-02
				$id_1 = substr($nokir_,0,4); 
				$id_2 = substr($nokir_,5,2);
				$id_3 = substr($nokir_,8,2);
				$id_34 = $id_3 +1;
				if ($id_34 < 10 ){
					$id_5 =$id_1."-".$id_2."-"."0".$id_34;
				}
				else{
				$id_5 =$id_1."-".$id_2."-".$id_34;
			}
			}
		} 
//echo "<label class='control-label' for='inputSuccess'><i class='fa fa-check'></i>'No.Perkiraan Baru (Level 5)'</label>";

echo "<input type='text' class='form-control' id='no_perkiraan' name='no_perkiraan' readonly value='".$id_5."'>";
		}

		public function proses_add_stock(){
		$this->Model_latihan->proses_add_stock();
		redirect('Latihan/project1');
	}
	public function delete_stock_barang(){
		$this->db->query("delete from COA where id='".$this->uri->segment(3)."'");
		redirect('Latihan/project1');
	}

	public function proses_edit_stock(){
		$this->Model_latihan->proses_edit_stock();
		redirect('Latihan/project1');
	}
	public function edit_stock(){
						$id 			= $this->input->get('option');
				$data['list_stock']		= $this->Model_latihan->list_stock($id);
		$this->load->view('latihan/v_edit',$data);
	}

	function list_coa(){
		$data['judul'] 			= "Daftar COA";
		/*$var_bulan			= $this->input->post('bln');
		$var_tahun			= $this->input->post('thn');*/
		$data['data_stock'] 	= $this->Model_latihan->get_list_coa();

		$this->load->view('latihan/v_brg1',$data);

	}

	function print_request(){
		
		$id 		= $this->uri->segment(3);
		$data['data_stock']	= $this->Model_latihan->print_data($id);
		$html			= $this->load->view('latihan/v_brg_print',$data,true);
		$pdfFilePath	= $id.".pdf";
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

	function proses_print_bln()
	{
		
		$id 		= $this->uri->segment(3);
		$data['data_stock']	= $this->Model_latihan->get_list_coa();
		$html			= $this->load->view('latihan/v_brg_print_bln',$data,true);
		$pdfFilePath	= $id.".pdf";
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

	function print_bulanan(){
		
		$this->load->view('latihan/add_view_bln'); 
	}



//====================================================== saldo awal ==============================================
function saldoawal(){
	$data['judul'] 			= "Saldo"; 
	$data['data_stock']		= $this->Model_latihan->saldo();
	$this->load->view('saldo/v_saldoawal',$data);
	
	
}

public function tambah_saldo(){
	$this->load->view('saldo/v_add_saldo');
}
public function proses_add_saldo(){
	$this->Model_latihan->proses_add_saldo();
	redirect('Latihan/saldoawal');
}
public function hapus_saldo(){
	$this->db->query("delete from COA where id='".$this->uri->segment(3)."'");
		redirect('Latihan/saldoawal');
}
public function edit_saldo(){
	$id 			= $this->input->get('option');
$data['list_saldo']		= $this->Model_latihan->list_saldo($id);
$this->load->view('saldo/v_edit_saldo',$data);
}
public function proses_edit_saldo(){
	$this->Model_latihan->proses_edit_saldo();
	redirect('Latihan/saldoawal');
}
function print_saldo(){
		
	$id 		= $this->uri->segment(3);
	$data['list_saldo']	= $this->Model_latihan->print_saldo($id);
	$html			= $this->load->view('saldo/v_saldo_print',$data,true);
	$pdfFilePath	= $id.".pdf";
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
function list_saldo(){
	$data['judul'] 			= "Daftar Saldo";
	/*$var_bulan			= $this->input->post('bln');
	$var_tahun			= $this->input->post('thn');*/
	$data['data_stock'] 	= $this->Model_latihan->get_list_saldo();

	$this->load->view('saldo/v_saldoawal',$data);

}
function posting(){
	$data['judul'] 			= "Daftar Saldo";
	//$data_periode_aktif = $this->Model_latihan->cek_periode_aktif();
	//$data['data_stock'] 	= $this->Model_latihan->posting();
	

	//if($data_periode_aktif > 0){
	//	foreach($data_periode_aktif as $row_pa){
		//	$tgl_periode = $row_pa->periode;
		//	$bln_periode = substr($tgl_periode,0,2);
		//	$thn_periode = substr($tgl_periode,3,4);
		
	//}
	//$data['data_stock'] 	= $this->Model_latihan->posting2($bln_periode,$thn_periode);
	$data['data_stock'] 	= $this->Model_latihan->posting2();
	$this->load->view('saldo/v_saldoawal',$data);

}

function saldoawal2(){
	$data['judul'] 			= "Setup Saldo"; 
	$data['data_saldo']		= $this->Model_latihan->get_saldo_awal2();
	$this->load->view('saldo/v_list_saldoawal2',$data);	
}

function posting_saldoawal2(){
	$data['judul'] 			= "Daftar Saldo";
	
	//$data_periode_aktif = $this->Model_latihan->cek_periode_aktif();
	//$data['data_stock'] 	= $this->Model_latihan->posting();
	

	//if($data_periode_aktif > 0){
	//	foreach($data_periode_aktif as $row_pa){
		//	$tgl_periode = $row_pa->periode;
		//	$bln_periode = substr($tgl_periode,0,2);
		//	$thn_periode = substr($tgl_periode,3,4);
		
	//}
	//$data['data_stock'] 	= $this->Model_latihan->posting2($bln_periode,$thn_periode);
	$data['data_saldo'] 	= $this->Model_latihan->posting2();
	$this->load->view('saldo/v_list_saldoawal2',$data);

}

//====================================================== JV ==============================================
function jv(){
	//$this->load->view('saldo/v_saldoawal',$data);
//$data['Judul']			="Setup System";	
//$nocab ['nocab']		= $this->input->get('option');
//$data['data_jv'] 		=$this->Model_latihan->jv();
//$this->load->view('JV/v_jv');
	//$data['judul'] 			= "Daftar COA";
	$data['judul'] 			= "Setup Nomor JV  ";	
	$data['data_jv']		= $this->Model_latihan->jv();
	$this->load->view('JV/v_jv',$data);

}

public function proses(){

	$this->Model_latihan->proses_update();
	$this->session->set_flashdata('message', '<b><h2>Data Berhasil di Input</h2></b>');
	redirect('latihan/jv');
}

function tampil_buton (){
	$id = $this->input->get('input');

		$data_jv 	= $this->model_latihan->jv();
		//$data['data_jv']		= $this->Model_latihan->jv();
		//$this->load->view('JV/v_jv',$data);
		
			if($data_jv > 0){

				foreach($data_jv as $rows1){
					$js1=$rows1->noJS;

					if($id =="js1"){

						echo "<tr><td id='js_td'>Nomor JS Awal</td><td><input type='text' class='form-control' size='' name='js1' id='js1' value='".$js."' width='120'></td></tr>";
					}
				}
			}
}
//====================================================== Trend ACcount ==============================================

public function Trend_Account(){
	$data['judul'] 			= "Trend Accunt";	
		//$data['data_accound']		= $this->Model_latihan->trend_account();
		//$data['data_namkir']		= $this->Model_latihan->get_namkir();
		//$data['data_accound4']		= $this->Model_latihan->trend_account4();
		$data ['data_accound1'] 	= $this->Model_latihan->trend_accound();
		$this->load->view('trendacount/v_t_account',$data);
	}

	function list_account(){
		$data['judul'] 			= "Trend Accunt";
		/*$var_bulan			= $this->input->post('bln');
		$var_tahun			= $this->input->post('thn');*/
		$data['data_accound1'] 	= $this->Model_latihan->list_account();

		$this->load->view('trendacount/v_t_account',$data);
	}


	public function chart()
	{
		$data['judul'] 			= "Trend Accunt";
		/*$var_bulan			= $this->input->post('bln');
		$var_tahun			= $this->input->post('thn');*/
		$data['data_accound1'] 	= $this->Model_latihan->grafik();

		$this->load->view('trendacount/v_t_account',$data);
	}
    
//====================================================== Replace Coa ==============================================



	public function repleace_coa (){
		$data['judul'] 			= "Replace COA";	
//$data['data_repleace']		= $this->Model_latihan->repleace_coa();
		$this->load->view('latihan/v_replace_coa',$data);
	
		}

		public function repleace_coa_proses (){
			$data['judul'] 			= "Replace COA";	
			//$data_replace		= $this->Model_latihan->cek_perode_aktif();
			$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if($cek_periode_aktif > 0){
			foreach($cek_periode_aktif as $row_periode_aktif){
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif,0,2);
				$thn_aktif			= substr($tgl_periode_aktif,3,4);
			}
		}

			$awal=1;
			$akhir=31;
			$enol=0;
			if($bln_aktif > 9){
				$var_tgl_awal = $thn_aktif."-".$bln_aktif."-0".$awal;
				$var_tgl_akhir = $thn_aktif."-".$bln_aktif."-".$akhir;
			}else{
				$var_tgl_awal = $thn_aktif."-".$enol.$bln_aktif."-0".$awal;
				$var_tgl_akhir = $thn_aktif."-".$enol.$bln_aktif."-".$akhir;
			}

			$coa_lama  =$this->input->post('no_perkiraan_L');
			$coa_baru  =$this->input->post('no_perkiraan_B');
			$this->db->query("UPDATE jurnal set no_perkiraan ='$coa_baru' where no_perkiraan='$coa_lama' and tanggal between '$var_tgl_awal' and '$var_tgl_akhir'");
		//	$data['pesan']=1;
			$this->session->set_flashdata('message', '<b><h2>Data Berhasil di Input</h2></b>');
			$this->load->view('latihan/v_replace_coa',$data);
		
			}
//====================================================== update cabang ==============================================


		public function cabang (){
			$data['judul'] 			= "Data Cabang";	
			$data['data_cabang']		= $this->Model_latihan->cabang();
			$this->load->view('latihan/v_cabang',$data);
		
			}


			public function delete_cabang(){
				$id 		= $this->uri->segment(3);
				$this->db->query("UPDATE pastibisa_tb_cabang set nocab='',subcab='',cabang='',area='',spkid='',kdcab='', nofak='',nocust='',nosales='',lastupdate='',kepala='',alamat='',namacabang='',kabagjualan='',kepalacabang='',admcabang='',gudang='' where id='$id'");
				redirect('Latihan/cabang');
			}

		public function edit_cbg(){	
		$data['judul'] 			= "Data Edit Cabang";	
		$data['list_cab']		= $this->Model_latihan->list_cab();
		$this->load->view('latihan/v_edit_cab',$data);
}
  public function proses_edit_cab(){
	$this->Model_latihan->proses_edit_cab();
	redirect('Latihan/cabang');
}
//====================================================== create jv by jurnal dan javh ==============================================

public function list_jv (){
	$data['judul'] 			= "View JV";	
	$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
	if($cek_periode_aktif > 0){
		foreach($cek_periode_aktif as $row_periode_aktif){
			$tgl_periode_aktif	= $row_periode_aktif->periode;
			$bln_aktif			= substr($tgl_periode_aktif,0,2);
			$thn_aktif			= substr($tgl_periode_aktif,3,4);
		}
	}
	$data['data_listjv']		= $this->Model_latihan->list_jv($bln_aktif,$thn_aktif);
	$this->load->view('jurnal/v_list_jv',$data);

	}
	public function add_listjv(){
		$this->load->view('jurnal/v_add_listjv');
	}
	
	public function detail_list_jv (){
		$data['judul'] 			= "View Detail JV";	
			//$data_replace		= $this->Model_latihan->cek_perode_aktif();
			$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if($cek_periode_aktif > 0){
			foreach($cek_periode_aktif as $row_periode_aktif){
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif,0,2);
				$thn_aktif			= substr($tgl_periode_aktif,3,4);
			}
		}

			$awal=1;
			$akhir=31;
			$enol=0;
			if($bln_aktif > 9){
				$var_tgl_awal = $thn_aktif."-".$bln_aktif."-0".$awal;
				$var_tgl_akhir = $thn_aktif."-".$bln_aktif."-".$akhir;
			}else{
				$var_tgl_awal = $thn_aktif."-".$enol.$bln_aktif."-0".$awal;
				$var_tgl_akhir = $thn_aktif."-".$enol.$bln_aktif."-".$akhir;
			}

		$ambil_tanggal			= $this->Model_latihan->list_jv($bln_aktif,$thn_aktif);
		if($ambil_tanggal > 0){
			foreach($ambil_tanggal as $ambil){
				$tanggal=$ambil->tgl;
				
				$nomor=$ambil->nomor;
			}
		} 
		$data['data_d_listjv']		= $this->Model_latihan->detail_list_jv($var_tgl_awal,$var_tgl_akhir);
		$this->load->view('jurnal/v_detail_listjv',$data);
	
}
public function jvcost(){
	$data['judul'] 			= "Input JV";	

	$data['data_cabang']=$this->Model_latihan2->cek_list_kode_cabang();
	//$data['data_nokir1']=$this->Model_latihan2->cek_nokir1();

	$cek_periode_aktif			= $this->Model_latihan->cek_periode_aktif();
		if($cek_periode_aktif > 0){
			foreach($cek_periode_aktif as $row_periode_aktif){
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif,0,2);
				$thn_aktif			= substr($tgl_periode_aktif,3,4);
			}
		}

	$data['data_bank']		= $this->Jurnal_model->get_bank($bln_aktif,$thn_aktif);
		//$data['data_keluar']		= $this->Jurnal_model->get_keluardari();
		
		$data['data_perkiraan']		= $this->Jurnal_model->get_noperkiraan($bln_aktif,$thn_aktif);
		//$data['data_project']		= $this->Jurnal_model->get_project();
		$data['pesan'] 			= 0;
	$this->load->view('jurnal/v_add_jvcost2',$data);
}

public function proses_input_jvcost(){
	if($this->input->post()){
		$hasil	= $this->Model_latihan2->inputJvCost();
		$data['pesan'] 			= 1;
		
		// redirect('latihan2/jvcost');
		redirect('latihan/list_jv');
	}		
}
			
function list_jvcoz(){
				$data['judul'] 			= "Daftar COA";
				/*$var_bulan			= $this->input->post('bln');
				$var_tahun			= $this->input->post('thn');*/
				$data['data_listjv'] 	= $this->Model_latihan->get_list_jvcoz();
		
				$this->load->view('jurnal/v_list_jv',$data);
		
}
			
public function list_ledq2 (){
		$data['judul'] 			= "ledger inq";
	
		$cek_periode_aktif			= $this->Model_latihan2->cek_periode_aktif();
		if($cek_periode_aktif > 0){
			foreach($cek_periode_aktif as $row_periode_aktif){
				$tgl_periode_aktif	= $row_periode_aktif->periode;
				$bln_aktif			= substr($tgl_periode_aktif,0,2);
				$thn_aktif			= substr($tgl_periode_aktif,3,4);
			}
		}

			$awal=1;
			$akhir=31;
			$enol=0;
			if($bln_aktif > 9){
				$var_tgl_awal = $thn_aktif."-".$bln_aktif."-0".$awal;
				$var_tgl_akhir = $thn_aktif."-".$bln_aktif."-".$akhir;
			}else{
				$var_tgl_awal = $thn_aktif."-".$enol.$bln_aktif."-0".$awal;
				$var_tgl_akhir = $thn_aktif."-".$enol.$bln_aktif."-".$akhir;
			}
			$data['coa_lv3']		= $this->Model_latihan2->get_coa3($bln_aktif,$thn_aktif);

				$data['data_ledq']		= $this->Model_latihan2->led_inq($var_tgl_awal,$var_tgl_akhir,$bln_aktif	,	$thn_aktif);
				$this->load->view('latihan/ledger_inquery2',$data);
			
}

}
?>