<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Posting_new extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->helper('menu');
		$this->load->model('Posting_new_model');
		$this->load->model('Report_model');
		$this->folder	= 'report';
	}

	function index()
	{
		$cab_pilih		= $this->session->userdata('singkat_cbg');
		$rows_cabang	= $this->Posting_new_model->get_cabang();
		$rows_data		= array(
			'title'			=> 'Jurnal Posting',
			'rows_cabang'	=> $rows_cabang,
			'cab_pilih'		=> $cab_pilih
		);

		$this->load->view($this->folder . '/main_posting', $rows_data);
	}

	function proses_posting($Jenis_Posting = 'N')
	{
		if ($this->input->post()) {
			// echo"<pre>";print_r($this->input->post());exit;
			$rows_Bulan		= array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			$Kode_Cabang	= $this->input->post('kode_cabang');
			$current_coa4 = 0;
			$current_coa5 = 0;
			$current_coa6 = 0;
			$current_coa71 = 0;
			$current_coa72 = 0;
			$current_coa8 = 0;
			$current_coa9 = 0;

			/*
			$Periode_Pilih	= $this->input->post('periode_proses');			
			$Pecah_Tgl		= explode(" ",$Periode_Pilih);
			
			$Tahun_Pros		= $Pecah_Tgl[1];
			$Month_Pros		= array_search($Pecah_Tgl[0],$rows_Bulan);
			*/

			$det_Cabang		= $this->db->get_where('pastibisa_tb_cabang', array('kdcab' => $Kode_Cabang))->result();

			$Nocab			= $det_Cabang[0]->nocab;
			$Subcab			= $det_Cabang[0]->subcab;

			if ($Jenis_Posting === 'Y') {
				$Tahun_Pros		= date('Y');
				$Month_Pros		= date('n');
				$Periode_Pilih	= date('F Y');
			} else {
				$Query_Periode	= "SELECT * FROM periode WHERE kdcab='" . $Kode_Cabang . "' AND stsaktif='O' ORDER BY periode ASC LIMIT 1";
				$get_Periode	= $this->db->query($Query_Periode)->result();
				$Pecah_Periode	= explode('-', $get_Periode[0]->periode);
				$Tahun_Pros		= $Pecah_Periode[1];
				$Month_Pros		= intval($Pecah_Periode[0]);
				$Periode_Pilih	= date('F Y', mktime(0, 0, 0, $Month_Pros, 1, $Tahun_Pros));
			}


			$Periode_Proses	= date('Y-m', mktime(0, 0, 0, $Month_Pros, 1, $Tahun_Pros));
			$Periode_Cari	= date('m-Y', mktime(0, 0, 0, $Month_Pros, 1, $Tahun_Pros));

			$Tahun_Lalu	= date('Y', mktime(0, 0, 0, $Month_Pros - 1, 1, $Tahun_Pros));
			$Bulan_Lalu	= date('n', mktime(0, 0, 0, $Month_Pros - 1, 1, $Tahun_Pros));




			$Tahun_Now		= date('Y');
			$Bulan_Now		= date('n');
			$Periode_Now	= date('Y-m');

			$OK_Next		= 0;
			if ($Periode_Proses < $Periode_Now) {
				$OK_Next	= 1;
				$Tahun_Next	= date('Y', mktime(0, 0, 0, $Month_Pros + 1, 1, $Tahun_Pros));
				$Bulan_Next	= date('n', mktime(0, 0, 0, $Month_Pros + 1, 1, $Tahun_Pros));
			}

			## AMBIL PERIODE ##
			$det_Periode	= $this->db->get_where('periode', array('kdcab' => $Kode_Cabang, 'periode' => $Periode_Cari))->result();
			if ($det_Periode) {
				if ($det_Periode[0]->stsaktif === 'C') {

					$rows_Return	= array(
						'status'		=> 3,
						'pesan'			=> 'Data has been locked....'
					);
				} else {
					$Post_Laba		= $det_Periode[0]->post_laba;
					//echo "$Kode_Cabang $Periode_Cari post laba $Post_Laba";
					//exit;
					$this->db->trans_start();

					## PROSES UNPOSTING ##
					$Qry_UnPost	= "UPDATE coa SET debet=0,kredit=0 WHERE kdcab='" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "'";
					$this->db->query($Qry_UnPost);

			

					## CEK JURNAL BALANCE ATAU TIDAK ##
					$Qry_Cek_Balance	= "SELECT
												SUM(IF(debet > 0, debet, 0)) AS total_debet,
												SUM(IF(kredit > 0, kredit, 0)) AS total_kredit
											FROM
												jurnal
											WHERE
												tanggal LIKE '" . $Periode_Proses . "%'
											AND nomor LIKE '" . $Nocab . "%'
											AND (

												IF (debet > 0, debet, 0) > 0
												OR
												IF (kredit > 0, kredit, 0) > 0
											)";
					$det_Balance		= $this->db->query($Qry_Cek_Balance)->result();

					if ($det_Balance[0]->total_debet === $det_Balance[0]->total_kredit) {
						## AMBIL DATA JURNAL BASED ON NO PERKIRAAN ##
						$Qry_Perkiraan	= "SELECT
												no_perkiraan,
												SUM(IF(debet > 0, debet, 0)) AS total_debet,
												SUM(IF(kredit > 0, kredit, 0)) AS total_kredit
											FROM
												jurnal
											WHERE
												tanggal LIKE '" . $Periode_Proses . "%'
											AND nomor LIKE '" . $Nocab . "%'
											AND (

												IF (debet > 0, debet, 0) > 0
												OR
												IF (kredit > 0, kredit, 0) > 0
											)
											GROUP BY
												no_perkiraan";
						$det_Perkiraan	= $this->db->query($Qry_Perkiraan)->result();
						$Ok_Exists		= 0;
						$Pesan			= '';
						
						$Total_coa4		= $Total_coa5	= $Total_coa6 = $Total_coa71 = $Total_coa72	= $Total_coa9	= $Total_Laba	= 0;
						if ($det_Perkiraan) {
							$intE		  	= 0;
							$Message_Error	= '';
							foreach ($det_Perkiraan as $keyI => $valI) {
								$No_Coa		= $valI->no_perkiraan;
								$Tot_Debet	= $valI->total_debet;
								$Tot_Kredit	= $valI->total_kredit;

								$Level4		= substr($No_Coa, 0, 7) . '-00';
								$Level3		= substr($No_Coa, 0, 4) . '-00-00';
								$Level1		= substr($No_Coa, 0, 1);
								$Level2		= substr($No_Coa, 0, 2);

								## CEK EXIST NO PERKIRAAN ##

								$Saldo_Awal		= 0;
								$Faktor_Kali	= 1;

								$num_coa	= $this->db->get_where('coa', array('bln' => $Month_Pros, 'thn' => $Tahun_Pros, 'kdcab' => $Nocab . '-' . $Subcab, 'no_perkiraan' => $No_Coa))->num_rows();
								if ($num_coa < 1) {
									$intE++;
									if ($intE === 1) {
										$Message_Error	= "<h4 class='alert-heading'>Unbalance Journal !</h4>
															<hr>
															<p>";
									}
									$Ambil_Perkiraan	= "SELECT
																nomor,
																tipe
															FROM
																jurnal
															WHERE
																tanggal LIKE '" . $Periode_Proses . "%'
															AND nomor LIKE '" . $Nocab . "%'
															AND (

																IF (debet > 0, debet, 0) > 0
																OR
																IF (kredit > 0, kredit, 0) > 0
															)
															AND no_perkiraan ='" . $No_Coa . "'";
									$get_Perkiraan	= $this->db->query($Ambil_Perkiraan)->result();
									if ($get_Perkiraan) {
										foreach ($get_Perkiraan as $keyP => $valP) {
											$Message_Error	.= "Account No <b>" . $No_Coa . "</b>  In The Journal  <b><i>" . $valP->nomor . "</i> (" . $valP->tipe . ")</b>  Was Not Found At Master coa<br>";
										}
									}
									$Ok_Exists		= 1;
								} else {
									$detail_coa		= $this->db->get_where('coa', array('bln' => $Month_Pros, 'thn' => $Tahun_Pros, 'kdcab' => $Nocab . '-' . $Subcab, 'no_perkiraan' => $No_Coa))->result();
									if ($detail_coa) {
										$Saldo_Awal		= $detail_coa[0]->saldoawal;
										$Faktor_Kali	= $detail_coa[0]->faktor;
									}
								}
								if ($Ok_Exists === 0) {
									$num_coa	= $this->db->get_where('coa', array('bln' => $Month_Pros, 'thn' => $Tahun_Pros, 'kdcab' => $Nocab . '-' . $Subcab, 'no_perkiraan' => $Level4))->num_rows();
									if ($num_coa < 1) {
										$intE++;
										$Message_Error	.= "Account No <b<" . $Level4 . "</b> Was Not Found At Master coa<br>";

										$Ok_Exists		= 1;
									}
								}

								if ($Ok_Exists === 0) {
									$num_coa	= $this->db->get_where('coa', array('bln' => $Month_Pros, 'thn' => $Tahun_Pros, 'kdcab' => $Nocab . '-' . $Subcab, 'no_perkiraan' => $Level3))->num_rows();
									if ($num_coa < 1) {
										$intE++;
										$Message_Error	.= "Account No " . $Level3 . " Was Not Found At Master coa<br>";
										$Ok_Exists		= 1;
									}
								}

								$Saldo_Akhir		= ($Saldo_Awal + $Tot_Debet - $Tot_Kredit) * $Faktor_Kali;
								if ($Ok_Exists === 0) {
									if ($Level1 === '4') {
										$Total_coa4		+= $Saldo_Akhir;
										$current_coa4   += ($Tot_Debet - $Tot_Kredit) * $Faktor_Kali;
									} else if ($Level1 === '5') {
										$Total_coa5		+= $Saldo_Akhir;
										$current_coa5   += ($Tot_Debet - $Tot_Kredit) * $Faktor_Kali;
									} else if ($Level1 === '6') {
										$Total_coa6		+= $Saldo_Akhir;
										$current_coa6   += ($Tot_Debet - $Tot_Kredit) * $Faktor_Kali;
									} else if ($Level1 === '9') {
										$Total_coa9		+= $Saldo_Akhir;
										$current_coa9   += ($Tot_Debet - $Tot_Kredit) * $Faktor_Kali;
									} else if ($Level2 === '71') {
										$Total_coa71		+= $Saldo_Akhir;
										$current_coa71   += ($Tot_Debet - $Tot_Kredit) * $Faktor_Kali;
									} else if ($Level2 === '72') {
										$Total_coa72		+= $Saldo_Akhir;
										$current_coa72   += ($Tot_Debet - $Tot_Kredit) * $Faktor_Kali;
									}

									$Upd_Saldo		= "UPDATE coa SET debet = debet + " . $Tot_Debet . ", kredit = kredit + " . $Tot_Kredit . " WHERE kdcab='" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "' AND no_perkiraan IN ('" . $No_Coa . "','" . $Level4 . "','" . $Level3 . "')";
									$this->db->query($Upd_Saldo);
								}
							}

							if ($Ok_Exists === 1) {
								$this->db->trans_complete();
								$this->db->trans_rollback();
								if (!empty($Message_Error)) $Message_Error	.= "</p><hr>";
								$rows_Return	= array(
									'status'		=> 2,
									'pesan'			=> $Message_Error
								);
							} else {
								## NEED KONFIRMASI ##

								if ($OK_Next === 1) {
									$Upd_Saldo_next		= "UPDATE coa new_det
															INNER JOIN coa old_det ON new_det.kdcab = old_det.kdcab
															AND new_det.no_perkiraan = old_det.no_perkiraan
															SET new_det.saldoawal = (
																IF (
																	old_det.saldoawal IS NULL
																	OR old_det.saldoawal = '',
																	0,
																	old_det.saldoawal
																) +
																IF (
																	old_det.debet IS NULL
																	OR old_det.debet = '',
																	0,
																	old_det.debet
																) -
																IF (
																	old_det.kredit IS NULL
																	OR old_det.kredit = '',
																	0,
																	old_det.kredit
																)
															)
															WHERE
																old_det.bln = '" . $Month_Pros . "'
															AND old_det.thn = '" . $Tahun_Pros . "'
															AND new_det.bln = '" . $Bulan_Next . "'
															AND new_det.thn = '" . $Tahun_Next . "'
															AND old_det.kdcab = '" . $Nocab . '-' . $Subcab . "'
															AND old_det.`level` IN ('5', '4', '3')
															AND old_det.no_perkiraan NOT LIKE '39%'";
									$this->db->query($Upd_Saldo_next);
								}

								$Total_Laba			= $current_coa4 + $current_coa71 - $current_coa5 - $current_coa6 - $current_coa72 - $current_coa9;

								$det_Coa_Laba		= $this->db->get_where('coa', array('bln' => $Month_Pros, 'thn' => $Tahun_Pros, 'kdcab' => $Nocab . '-' . $Subcab, 'no_perkiraan' => '3903-01-01'))->result();
								$Faktor_Laba		= 1;
								if ($det_Coa_Laba) {
									$Faktor_Laba	= $det_Coa_Laba[0]->faktor;
									$det_Laba_Tahun	= $this->db->get_where('coa', array('bln' => $Month_Pros, 'thn' => $Tahun_Pros, 'kdcab' => $Nocab . '-' . $Subcab, 'no_perkiraan' => '3902-01-01'))->result();

									## JIKA POSTING LABA BELUM DIPROSES => LABA TAHUN BERJALAN += LABA BERJALAN##									
									if ($Post_Laba !== '1') {
										$Laba_Uncalc_Laba	= $det_Coa_Laba[0]->saldoawal;
										//echo "laba $Laba_Uncalc_Laba ";
										//exit;
										
										if ($Month_Pros === 1) {  
										    //jika bulan JANUARI
											## AMBIL DATA LABA TAHUN BERJALAN ##
											$Tahun_Berjalan	= $Laba_Uncalc_Laba;
											if ($det_Laba_Tahun) {
												$Tahun_Berjalan	+= $det_Laba_Tahun[0]->saldoawal;
											}
                                     
													
											$Update_Uncalc_Tahun	= "UPDATE coa SET saldoawal= saldoawal + (" . $Tahun_Berjalan . ") WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "' AND no_perkiraan IN ('3901-01-01','3901-01-00','3901-00-00')";
											//echo $Update_Laba;exit;
											$this->db->query($Update_Uncalc_Tahun);

											$Update_Uncalc_Laba	= "UPDATE coa SET saldoawal= 0,debet=0,kredit=0 WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "' AND no_perkiraan IN ('3902-01-01','3902-01-00','3902-00-00','3903-00-00','3903-01-00','3903-01-01')";
											//echo $Update_Laba;exit;
											$this->db->query($Update_Uncalc_Laba);
										} else {
										
											$Update_Laba		= "UPDATE coa SET saldoawal='0',kredit='" . $Total_Laba . "' WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "' AND no_perkiraan IN ('3903-01-01','3903-01-00','3903-00-00')";
								//echo $Update_Laba;exit;saldoawal=0,debet=0 
								$this->db->query($Update_Laba);

											$Update_Uncalc_Laba	= "UPDATE coa SET saldoawal= saldoawal + (" . $Laba_Uncalc_Laba . ") WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "' AND no_perkiraan IN ('3902-01-01','3902-01-00','3902-00-00')";
											//echo $Update_Laba;exit;
											$this->db->query($Update_Uncalc_Laba);
										}
									}
								}

								$Update_Laba		= "UPDATE coa SET saldoawal='0',kredit='" . $Total_Laba . "' WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "' AND no_perkiraan IN ('3903-01-01','3903-01-00','3903-00-00')";
								//echo $Update_Laba;exit;saldoawal=0,debet=0 
								$this->db->query($Update_Laba);

								$Laba_Ditahan		= 0;
								$Laba_Tahun_Ini		= 0;

								## NEED KONFIRMASI ##

								if ($OK_Next === 1) {
									if ($Month_Pros === 12) {
										$Laba_Ditahan	 = ($Total_Laba * $Faktor_Laba);
										$Qry_Laba_Tahan	 = "SELECT * FROM coa WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "' AND no_perkiraan IN ('3901-01-01','3902-01-01') AND `level`='5'";
										$det_Laba_Tahan	 = $this->db->query($Qry_Laba_Tahan)->result();
										if ($det_Laba_Tahan) {
											foreach ($det_Laba_Tahan as $keyL => $valL) {
												$Laba_Ditahan	+= ($valL->saldoawal + $valL->debet - $valL->kredit);
											}
										}

										$Update_Laba_Next	= "UPDATE coa SET saldoawal='" . $Laba_Ditahan . "',debet=0,kredit=0 WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Bulan_Next . "' AND thn='" . $Tahun_Next . "' AND no_perkiraan IN ('3901-01-01','3901-01-00','3901-00-00')";
									} else if ($Month_Pros === 1) {
										$Laba_Tahun_Ini	 = ($Total_Laba * $Faktor_Laba);

										$Update_Laba_Next	= "UPDATE coa SET saldoawal='" . $Laba_Tahun_Ini . "',debet=0,kredit=0 WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Bulan_Next . "' AND thn='" . $Tahun_Next . "' AND no_perkiraan IN ('3902-01-01','3902-01-00','3902-00-00')";
									} else {
										$Qry_Coa_Laba	 = "SELECT * FROM coa WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Bulan_Lalu . "' AND thn='" . $Tahun_Lalu . "' AND no_perkiraan IN ('3902-01-01','3903-01-01') AND `level`='5'";
										$det_Coa_Laba	 = $this->db->query($Qry_Coa_Laba)->result();
										if ($det_Coa_Laba) {
											foreach ($det_Coa_Laba as $keyL => $valL) {
												if ($valL->no_perkiraan === '3902-01-01') {
													$Laba_Tahun_Ini	+= ($valL->saldoawal + $valL->debet - $valL->kredit);
												} else {
													$saldoawal_3903 = $valL->saldoawal * $valL->faktor;
													$kredit_3903 = $valL->kredit;
													$Laba_Tahun_Ini	+= ($valL->saldoawal + $valL->debet - $valL->kredit) * $valL->faktor; // 3903-01-01
												}
											}
										}
										## Rin 070420 ##
										// $get_data_3903 =$this->db->query("SELECT * FROM coa WHERE kdcab = '".$Nocab.'-'.$Subcab."' AND bln='".$Bulan_Lalu."' AND thn='".$Tahun_Lalu."' AND no_perkiraan = '3903-01-01' AND `level`='5'")->result();

										// if($get_data_3903){
										// 	foreach($get_data_3903 as $keyL=>$valL){
										// 		if($valL->no_perkiraan === '3902-01-01'){
										// 			$Laba_Tahun_Ini	+= ($valL->saldoawal + $valL->debet - $valL->kredit);
										// 		}else{
										// 			$saldoawal_3903
										// 			$Laba_Tahun_Ini	+= ($valL->saldoawal + $valL->debet - $valL->kredit) * $valL->faktor; // 3903-01-01
										// 		}
										// 	}
										// }
										// if ($Laba_Tahun_Ini === "0") {
										// 	$Laba_Tahun_Ini = $saldoawal_3903;
										// 	$Update_Laba_Next	= "UPDATE coa SET saldoawal='" . $Laba_Tahun_Ini . "',debet=0,kredit=0 WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Bulan_Next . "' AND thn='" . $Tahun_Next . "' AND no_perkiraan IN ('3902-01-01','3902-01-00','3902-00-00')";
										// } else {
										// echo $Laba_Tahun_Ini;
										// exit;
										$Update_Laba_Next	= "UPDATE coa SET saldoawal='" . $Laba_Tahun_Ini . "',debet=0,kredit=0 WHERE kdcab = '" . $Nocab . '-' . $Subcab . "' AND bln='" . $Bulan_Next . "' AND thn='" . $Tahun_Next . "' AND no_perkiraan IN ('3902-01-01','3902-01-00','3902-00-00')";
										// }
										## -Rin 070420- ##
									}

									$this->db->query($Update_Laba_Next);
								}


								$Update_Periode	= "UPDATE periode SET stspost='1', post_laba='1' WHERE kdcab='" . $Kode_Cabang . "' AND periode='" . $Periode_Cari . "'";
								$this->db->query($Update_Periode);
								$this->db->trans_complete();

								if ($this->db->trans_status() !== TRUE) {
									$this->db->trans_rollback();
									$rows_Return	= array(
										'pesan'			=> 'Posting process failed. Please try again later ...',
										'status'		=> 3
									);
								} else {
									$this->db->trans_commit();
									$rows_Return	= array(
										'pesan'		=> 'Posting process success. Thanks ...',
										'status'	=> 1

									);
								}
							}
						} else {
							$this->db->trans_complete();
							$this->db->trans_rollback();

							$rows_Return	= array(
								'status'		=> 3,
								'pesan'			=> 'No records was found......'
							);
						}
					} else {
						$this->db->trans_complete();
						$this->db->trans_rollback();
						$Message_Error	= "<h4 class='alert-heading'>Unbalance Journal !</h4>
										<hr>
										<p>";

						$Ambil_Unbalance	= "SELECT
													nomor,tipe,
													SUM(IF(debet > 0, debet, 0)) AS total_debet,
													SUM(IF(kredit > 0, kredit, 0)) AS total_kredit
												FROM
													jurnal
												WHERE
													tanggal LIKE '" . $Periode_Proses . "%'
												AND nomor LIKE '" . $Nocab . "%'
												AND (

													IF (debet > 0, debet, 0) > 0
													OR
													IF (kredit > 0, kredit, 0) > 0
												)
												GROUP BY nomor,tipe";
						$rows_Balance		= $this->db->query($Ambil_Unbalance)->result();
						if ($rows_Balance) {
							foreach ($rows_Balance as $key => $vals) {
								if ($vals->total_debet !== $vals->total_kredit) {
									$Message_Error	.= "Journal No : <b>" . $vals->nomor . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type : <b>" . $vals->tipe . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Debet : <b>" . number_format($vals->total_debet) . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kredit : <b>" . number_format($vals->total_kredit) . "</b><br>";
								}
							}
						}
						$Message_Error	.= "</p><hr>";
						$rows_Return	= array(
							'status'		=> 2,
							'pesan'			=> $Message_Error
						);
					}
				}
			} else {
				$rows_Return	= array(
					'status'		=> 3,
					'pesan'			=> 'Period not found....'
				);
			}
		} else {
			$rows_Return	= array(
				'status'		=> 3,
				'pesan'			=> 'No record was found to process......'
			);
		}
		echo json_encode($rows_Return);
	}


	function proses_unposting()
	{
		$rows_Bulan		= array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$Kode_Cabang	= $this->input->post('kode_cabang');


		$det_Cabang		= $this->db->get_where('pastibisa_tb_cabang', array('kdcab' => $Kode_Cabang))->result();
		$Nocab			= $det_Cabang[0]->nocab;
		$Subcab			= $det_Cabang[0]->subcab;

		$Query_Periode	= "SELECT * FROM periode WHERE kdcab='" . $Kode_Cabang . "' AND stsaktif='O'  ORDER BY periode ASC LIMIT 1";
		$get_Periode	= $this->db->query($Query_Periode)->result();
		$Pecah_Periode	= explode('-', $get_Periode[0]->periode);
		$id_periode     = $get_Periode[0]->id;
		$Tahun_Pros		= $Pecah_Periode[1];
		$Month_Pros		= intval($Pecah_Periode[0]);
		$Periode_Pilih	= date('F Y', mktime(0, 0, 0, $Month_Pros, 1, $Tahun_Pros));

		/*
		$Periode_Pilih	= $this->input->post('periode');		
		$Pecah_Tgl		= explode(" ",$Periode_Pilih);		
		$Tahun_Pros		= $Pecah_Tgl[1];
		$Month_Pros		= array_search($Pecah_Tgl[0],$rows_Bulan);
		
		*/

		$Periode_Proses	= date('Y-m', mktime(0, 0, 0, $Month_Pros, 1, $Tahun_Pros));
		$this->db->trans_start();

		## PROSES UNPOSTING ##
		$Qry_UnPost	= "UPDATE coa SET debet=0,kredit=0 WHERE kdcab='" . $Nocab . '-' . $Subcab . "' AND bln='" . $Month_Pros . "' AND thn='" . $Tahun_Pros . "'";
		$this->db->query($Qry_UnPost);
		
		
		## UPDATE PERIODE ##
		$Qry_postlaba	= "UPDATE periode SET post_laba=0 WHERE id='" . $id_periode ."'";
		$this->db->query($Qry_postlaba);

		$this->db->trans_complete();

		if ($this->db->trans_status() !== TRUE) {
			$this->db->trans_rollback();
			$rows_Return	= array(
				'pesan'			=> 'Unposting process failed. Please try again later ...',
				'status'		=> 3
			);
		} else {
			$this->db->trans_commit();
			$rows_Return	= array(
				'pesan'		=> 'Unposting process success. Thanks ...',
				'status'	=> 1

			);
		}
		echo json_encode($rows_Return);
	}

	function detail_unbalance()
	{
		$rows_Bulan		= array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$Kode_Cabang	= $this->input->post('cabang');


		$det_Cabang		= $this->db->get_where('pastibisa_tb_cabang', array('kdcab' => $Kode_Cabang))->result();
		$Nocab			= $det_Cabang[0]->nocab;
		$Subcab			= $det_Cabang[0]->subcab;

		$Query_Periode	= "SELECT * FROM periode WHERE kdcab='" . $Kode_Cabang . "' AND stsaktif='O' ORDER BY periode ASC LIMIT 1";
		$get_Periode	= $this->db->query($Query_Periode)->result();
		$Pecah_Periode	= explode('-', $get_Periode[0]->periode);
		$Tahun_Pros		= $Pecah_Periode[1];
		$Month_Pros		= intval($Pecah_Periode[0]);
		$Periode_Pilih	= date('F Y', mktime(0, 0, 0, $Month_Pros, 1, $Tahun_Pros));

		/*
		$Periode_Pilih	= $this->input->post('periode');		
		$Pecah_Tgl		= explode(" ",$Periode_Pilih);		
		$Tahun_Pros		= $Pecah_Tgl[1];
		$Month_Pros		= array_search($Pecah_Tgl[0],$rows_Bulan);
		
		*/

		$Periode_Proses	= date('Y-m', mktime(0, 0, 0, $Month_Pros, 1, $Tahun_Pros));
		
		// print_r($Periode_Proses);
		// exit;

		$Qry_Cek_Balance	= "SELECT
									nomor,tipe,
									SUM(IF(debet > 0, debet, 0)) AS total_debet,
									SUM(IF(kredit > 0, kredit, 0)) AS total_kredit
								FROM
									jurnal
								WHERE
									tanggal LIKE '" . $Periode_Proses . "%'
								AND nomor LIKE '" . $Nocab . "%'
								AND (

									IF (debet > 0, debet, 0) > 0
									OR
									IF (kredit > 0, kredit, 0) > 0
								)
								GROUP BY nomor,tipe";
		$det_Balance		= $this->db->query($Qry_Cek_Balance)->result();

		$rows_data		= array(
			'title'			=> 'List Unbalance Jurnal',
			'cab_pilih'		=> $det_Cabang[0]->cabang,
			'periode_pilih'	=> $Periode_Pilih,
			'rows_header'	=> $det_Balance
		);

		$this->load->view($this->folder . '/main_unbalance', $rows_data);
	}
}
