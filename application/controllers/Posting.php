<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Posting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		$this->load->helper('menu');
		$this->load->model('Posting_model');
		$this->load->model('Report_model');
	}

	function vposting()
	{
		$data['judul'] = "Posting";
		//$data['list_data'] = $this->Order_model->list_request_stock();
		$data_periode_aktif = $this->Posting_model->cek_periode_aktif();
		if ($data_periode_aktif > 0) {
			foreach ($data_periode_aktif as $row_pa) {
				$tgl_periode = $row_pa->periode;
				$data['bln_aktif'] = substr($tgl_periode, 0, 2);
				$data['thn_aktif'] = substr($tgl_periode, 3, 4);
			}
		}
		$data['pesan_on'] 	= 0;
		$data['proses'] 	= 0;
		$data['aktif_pesan'] = 0;
		$data['pesan_'] = "";
		$this->load->view('report/v_posting', $data);
	}

	function proses_posting()
	{
		$data['aktif_pesan'] = 0;
		$data['pesan_'] = "";
		$data['pesan_on'] 	= 0;
		$data['proses'] = 0;
		$data['judul'] = "Posting";
		$var_bulan					= $this->input->post('bulan_posting');
		$var_tahun					= $this->input->post('tahun_posting');
		$awal = 1;
		$akhir = 31;
		$enol = 0;
		if ($var_bulan > 9) {
			$var_tgl_awal = $var_tahun . "-" . $var_bulan . "-0" . $awal;
			$var_tgl_akhir = $var_tahun . "-" . $var_bulan . "-" . $akhir;
		} else {
			$var_tgl_awal = $var_tahun . "-" . $enol . $var_bulan . "-0" . $awal;
			$var_tgl_akhir = $var_tahun . "-" . $enol . $var_bulan . "-" . $akhir;
		}

		if ($this->input->post('posting') == "Posting") {
			// cek sudah balance apa belum
			$cek_balance = $this->Posting_model->cek_balance($var_tgl_awal, $var_tgl_akhir);

			if ($cek_balance > 0) {
				foreach ($cek_balance as $r_balance) {
					$total_debet	= $r_balance->total_debet;
					$total_kredit	= $r_balance->total_kredit;
					if ($total_debet <> $total_kredit) {
						$data['aktif_pesan'] = 1;
						$data['pesan_'] = "Jurnal tidak balance, silahkan Check! <br> Total Debet = " . number_format($total_debet, 0, ',', '.') . "<br> Total Kredit = " . number_format($total_kredit, 0, ',', '.');

						$this->load->view('report/v_posting', $data);
					} else {
						$cek_nokir_jurnal = $this->Posting_model->cek_nokir_jurnal($var_tgl_awal, $var_tgl_akhir);

						if ($cek_nokir_jurnal > 0) {
							foreach ($cek_nokir_jurnal as $r_nokir_jurnal) {
								//$urutan++;
								$nokir_jurnal = $r_nokir_jurnal->no_perkiraan;
								$nomor_jurnal = $r_nokir_jurnal->nomor;
								$tipe_jurnal = $r_nokir_jurnal->tipe;

								$x_nokir_coa = $this->Posting_model->cek_nokir_coa($var_bulan, $var_tahun, $nokir_jurnal);
								//echo var_dump($cek_nokir_coa);
								// cek nokir dari jurnal ada di coa ga
								//$muncul_pesan=0;
								// echo var_dump($cek_nokir_coa) . "<br>";
								//echo var_dump($cek_nokir_coa->no_perkiraan) . "<br>";

								// foreach ($cek_nokir_coa as $r_nokir_coa) {
								$xnomor_perkiraan = "";
								if ($x_nokir_coa > 0) {
									foreach ($x_nokir_coa as $r_nokir_coa) {
										$xnomor_perkiraan = $r_nokir_coa->no_perkiraan;
									}
								}
								if (empty($xnomor_perkiraan)) {

									$data['aktif_pesan'] = 1;

									//$data['pesan_'] = $nomor_jurnal . "<br>";

									$data['pesan_'] = "<font size='5'> Nomor COA : " . $nokir_jurnal . "<br>pada nomor jurnal : " . $nomor_jurnal . "<br> dan tipe jurnal " . $tipe_jurnal . "<br> Tidak ada di Master COA ! </font> <br>";

									// exit;
								} else {
									$cek_bt_ada = $this->Posting_model->cek_bt_ada($var_bulan, $var_tahun);
									// cek apakah bulan dan tahun yg dipilih ada atau tidak di database					

									if ($cek_bt_ada > 0) { // jika bulan dan tahun yg dipilih ada di database
										$cek_dk_nol = $this->Posting_model->cek_dk_nol($var_bulan, $var_tahun);
										// cek apakah user sudah melakukan unposting terlebih dahulu apa belum

										if ($cek_dk_nol > 0) {	// jika debet kreditnya lebih dari nol atau ada isinya, berarti belum melakukan unposting					
											$data['pesan_on'] 	= 1;	// tampilkan pesan harus unposting dahulu

											$this->load->view('report/v_posting', $data);
										} else {	// jika debit kreditnya sudah nol atau tidak ada isinya, berarti sudah melakukan unposting

											$data_coa_blnthn_terpilih = $this->Posting_model->get_coa_blnthn_terpilih($var_bulan, $var_tahun);

											if ($data_coa_blnthn_terpilih > 0) {
												foreach ($data_coa_blnthn_terpilih as $row_post) {
													$nokir			= $row_post->no_perkiraan; // 1102-01-01
													$nokir_lv3		= substr($nokir, 0, 4); // 1102
													$nokir_lv4		= substr($nokir, 0, 7); // 1102-01

													$data_jurnal = $this->Posting_model->get_data_jurnal($var_tgl_awal, $var_tgl_akhir, $nokir);

													if ($data_jurnal > 0) {
														foreach ($data_jurnal as $row01) {
															$nokira01 = $row01->no_perkiraan;
															$sumDebit01 = $row01->jml_debet;
															$sumKredit01 = $row01->jml_kredit;

															$kode_cabang	= $this->session->userdata('kode_cabang');
															// update data tabel coa dari tabel jurnal yg nokirnya level 5
															$this->db->query("UPDATE COA set debet = '$sumDebit01', kredit = '$sumKredit01' WHERE no_perkiraan='$nokir' AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");
														}
														$data_coa_lv5 = $this->Posting_model->get_coa_lv5($var_bulan, $var_tahun, $nokir_lv3);
														if ($data_coa_lv5 > 0) {
															foreach ($data_coa_lv5 as $r_lv5) {
																//$nokira01 = $r_lv5->no_perkiraan;
																$sumDebit5 = $r_lv5->jml_debet5;
																$sumKredit5 = $r_lv5->jml_kredit5;
															}
															$kode_cabang	= $this->session->userdata('kode_cabang');
															// update debet kredit nokir lv3 di tabel coa
															$this->db->query("UPDATE COA set debet = '$sumDebit5', kredit = '$sumKredit5' WHERE no_perkiraan like '$nokir_lv3%' AND level='3' AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");
															// update debet kredit nokir lv4 di tabel coa
															$this->db->query("UPDATE COA set debet = '$sumDebit5', kredit = '$sumKredit5' WHERE no_perkiraan like '$nokir_lv4%' AND level='4' AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");
														}
													}
												}
												$data_nokir_4				= $this->Posting_model->get_nokir_4($var_bulan, $var_tahun);
												$data_nokir_5				= $this->Posting_model->get_nokir_5($var_bulan, $var_tahun);
												$data_nokir_6				= $this->Posting_model->get_nokir_6($var_bulan, $var_tahun);
												$data_nokir_71				= $this->Posting_model->get_nokir_71($var_bulan, $var_tahun);
												$data_nokir_72				= $this->Posting_model->get_nokir_72($var_bulan, $var_tahun);
												$data_nokir_9				= $this->Posting_model->get_nokir_9($var_bulan, $var_tahun);

												if ($data_nokir_4 > 0) {
													foreach ($data_nokir_4 as $rowtotal_nokir_4) {
														$faktor_total_nokir_4		= $rowtotal_nokir_4->faktor;
														$saldoawal_total_nokir_4	= ($rowtotal_nokir_4->tot_nokir_4_saldoawal);
														$debet_total_nokir_4		= $rowtotal_nokir_4->tot_nokir_4_debet;
														$kredit_total_nokir_4		= $rowtotal_nokir_4->tot_nokir_4_kredit;
														$saldoakhir_nokir4			= ($debet_total_nokir_4 - $kredit_total_nokir_4) * $faktor_total_nokir_4;
													}
												}
												if ($data_nokir_5 > 0) {
													foreach ($data_nokir_5 as $rowtotal_nokir_5) {
														$faktor_total_nokir_5		= $rowtotal_nokir_5->faktor;
														$saldoawal_total_nokir_5	= ($rowtotal_nokir_5->tot_nokir_5_saldoawal);
														$debet_total_nokir_5		= $rowtotal_nokir_5->tot_nokir_5_debet;
														$kredit_total_nokir_5		= $rowtotal_nokir_5->tot_nokir_5_kredit;
														$saldoakhir_nokir5			= ($debet_total_nokir_5 - $kredit_total_nokir_5) * $faktor_total_nokir_5;
													}
												}
												if ($data_nokir_6 > 0) {
													foreach ($data_nokir_6 as $rowtotal_nokir_6) {
														$faktor_total_nokir_6		= $rowtotal_nokir_6->faktor;
														$saldoawal_total_nokir_6	= ($rowtotal_nokir_6->tot_nokir_6_saldoawal);
														$debet_total_nokir_6		= $rowtotal_nokir_6->tot_nokir_6_debet;
														$kredit_total_nokir_6		= $rowtotal_nokir_6->tot_nokir_6_kredit;
														$saldoakhir_nokir6			= ($debet_total_nokir_6 - $kredit_total_nokir_6) * $faktor_total_nokir_6;
													}
												}
												if ($data_nokir_71 > 0) {
													foreach ($data_nokir_71 as $rowtotal_nokir_71) {
														$faktor_total_nokir_71		= $rowtotal_nokir_71->faktor;
														$saldoawal_total_nokir_71	= ($rowtotal_nokir_71->tot_nokir_71_saldoawal);
														$debet_total_nokir_71		= $rowtotal_nokir_71->tot_nokir_71_debet;
														$kredit_total_nokir_71		= $rowtotal_nokir_71->tot_nokir_71_kredit;
														$saldoakhir_nokir71			= ($debet_total_nokir_71 - $kredit_total_nokir_71) * $faktor_total_nokir_71;
													}
												}
												if ($data_nokir_72 > 0) {
													foreach ($data_nokir_72 as $rowtotal_nokir_72) {
														$faktor_total_nokir_72		= $rowtotal_nokir_72->faktor;
														$saldoawal_total_nokir_72	= ($rowtotal_nokir_72->tot_nokir_72_saldoawal);
														$debet_total_nokir_72		= $rowtotal_nokir_72->tot_nokir_72_debet;
														$kredit_total_nokir_72		= $rowtotal_nokir_72->tot_nokir_72_kredit;
														$saldoakhir_nokir72			= ($debet_total_nokir_72 - $kredit_total_nokir_72) * $faktor_total_nokir_72;
													}
												}
												if ($data_nokir_9 > 0) {
													foreach ($data_nokir_9 as $rowtotal_nokir_9) {
														$faktor_total_nokir_9		= $rowtotal_nokir_9->faktor;
														$saldoawal_total_nokir_9	= ($rowtotal_nokir_9->tot_nokir_9_saldoawal);
														$debet_total_nokir_9		= $rowtotal_nokir_9->tot_nokir_9_debet;
														$kredit_total_nokir_9		= $rowtotal_nokir_9->tot_nokir_9_kredit;
														$saldoakhir_nokir9			= ($debet_total_nokir_9 - $kredit_total_nokir_9) * $faktor_total_nokir_9;
													}
												}

												$laba	=	($saldoakhir_nokir4 - $saldoakhir_nokir5 - $saldoakhir_nokir6) + $saldoakhir_nokir71 - $saldoakhir_nokir72 - $saldoakhir_nokir9;

												$this->db->query("UPDATE COA set saldoawal = '$laba' WHERE (no_perkiraan = '3903-01-01' or no_perkiraan = '3903-01-00' or no_perkiraan = '3903-00-00') AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");

												if ($var_bulan <> 1) {
													$kode_cabang	= $this->session->userdata('kode_cabang');

													$get_3903 = $this->Posting_model->cek_saldoawal_3903($var_bulan, $var_tahun);
													if ($get_3903 > 0) {
														foreach ($get_3903 as $row_3903) {
															$laba_bulan_lalu_3903 = $row_3903->saldoawal;
														}
													}
													$this->db->query("UPDATE COA set saldoawal = saldoawal+$laba_bulan_lalu_3903 WHERE (no_perkiraan = '3902-01-01' or no_perkiraan = '3902-01-00' or no_perkiraan = '3902-00-00') AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");

													$this->db->query("UPDATE COA set saldoawal = '$laba' WHERE (no_perkiraan = '3903-01-01' or no_perkiraan = '3903-01-00' or no_perkiraan = '3903-00-00') AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");
												} elseif ($var_bulan == 1) {

													$kode_cabang	= $this->session->userdata('kode_cabang');

													$get_3903 = $this->Posting_model->cek_saldoawal_3903($var_bulan, $var_tahun);
													if ($get_3903 > 0) {
														foreach ($get_3903 as $row_3903) {
															$laba_bulan_lalu_3903 = $row_3903->saldoawal;
														}
													}
													$this->db->query("UPDATE COA set saldoawal = saldoawal+$laba_bulan_lalu_3903 WHERE (no_perkiraan = '3902-01-01' or no_perkiraan = '3902-01-00' or no_perkiraan = '3902-00-00') AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");

													$this->db->query("UPDATE COA set saldoawal = '$laba' WHERE (no_perkiraan = '3903-01-01' or no_perkiraan = '3903-01-00' or no_perkiraan = '3903-00-00') AND bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");

													// =======================================================================


												}

												// $data['proses'] = 2; // munculkan pesan bahwa data telah berhasil di posting
												// $data['pesan_'] = "Laba = " . $laba . "<br>" . "saldoakhir_nokir4 = " . $saldoakhir_nokir4 . "<br>" . "saldoakhir_nokir5 = " . $saldoakhir_nokir5 . "<br>" . "saldoakhir_nokir6 = " . $saldoakhir_nokir6 . "<br>" . "saldoakhir_nokir71 = " . $saldoakhir_nokir71 . "<br>" . "saldoakhir_nokir72 = " . $saldoakhir_nokir72 . "<br>" . "saldoakhir_nokir9 = " . $saldoakhir_nokir9 . "<br>";
												// $this->load->view('report/v_posting', $data);
											}
										}
									} else { // jika bulan dan tahun yg dipilih tidak ada di database
										$data['pesan_on'] 	= 1; // tampilkan pesan harus unposting dahulu
										$data['proses'] = 0;
										//$this->load->view('report/v_posting', $data);
									}
								}
								// 	}	// ending foreach coa
								// } // ending cek nokir coa
							}	// ending foreach jurnal
						} // ending cek nokir jurnal, ada di tabel coa tidak

					}	// ending else total debet <> total kredit
				}	// ending foreach cek balance
			}	// ending if cek balance
			$data['proses'] = 2; // munculkan pesan bahwa data telah berhasil di posting
			$data['pesan_'] = "Laba = " . $laba . "<br>" . "saldoakhir_nokir4 = " . $saldoakhir_nokir4 . "<br>" . "saldoakhir_nokir5 = " . $saldoakhir_nokir5 . "<br>" . "saldoakhir_nokir6 = " . $saldoakhir_nokir6 . "<br>" . "saldoakhir_nokir71 = " . $saldoakhir_nokir71 . "<br>" . "saldoakhir_nokir72 = " . $saldoakhir_nokir72 . "<br>" . "saldoakhir_nokir9 = " . $saldoakhir_nokir9 . "<br>";
			$this->load->view('report/v_posting', $data);
		} else {
			////////////////////// unposting  /////////////////////////////		
			$data['proses'] = 0;
			$data_unpost = $this->Posting_model->get_coa_blnthn_terpilih($var_bulan, $var_tahun);
			// cek apakah bulan dan tahun yg dipilih ada atau tidak di database

			if ($data_unpost > 0) {	// jika bulan dan tahun yg dipilih ada di database
				foreach ($data_unpost as $row_up) {
					$kode_cabang	= $this->session->userdata('kode_cabang');
					//	ubah nilai debet dan kredit di tabel coa menjadi nol berdasarkan bulan dan tahun yg dipilih
					$this->db->query("UPDATE COA set debet = '0', kredit = '0' WHERE bln = '$var_bulan' AND thn = '$var_tahun' AND kdcab='$kode_cabang'");
				}
				$data['proses'] = 2; // munculkan pesan bahwa data telah berhasil di unposting
				$this->load->view('report/v_unposting', $data);
			} else {	//	jika bulan dan tahun yg dipilih tidak ada di database
				$data_periode_aktif = $this->Posting_model->cek_periode_aktif();
				if ($data_periode_aktif > 0) {
					foreach ($data_periode_aktif as $row_pa) {
						$tgl_periode = $row_pa->periode;
						$bln_aktif = substr($tgl_periode, 0, 2);
						$thn_aktif = substr($tgl_periode, 3, 4);
					}
				}
				$data_unpost2 = $this->Posting_model->get_coa_blnthn_terpilih($bln_aktif, $thn_aktif);
				// ambil coa bulan dan tahun periode aktif, kenapa pake data periode aktif ? karena untuk mengcopy seluruh nomor perkiraan, untuk dibuat baru dengan bulan dan tahun yg dipilih
				if ($data_unpost2 > 0) {
					foreach ($data_unpost2 as $row_up2) {
						$nokir2			= $row_up2->no_perkiraan;
						$nm_perkiraan	= $row_up2->nama;
						$lvl			= $row_up2->level;
						$grup			= $row_up2->grup;
						$faktor			= $row_up2->faktor;
						$kode_cabang	= $this->session->userdata('kode_cabang');
						//	copy seluruh nomor perkiraan dalam tabel coa, buat baru dengan bulan dan tahun yg dipilih
						$this->db->query("INSERT INTO COA (no_perkiraan,nama,kdcab,saldoawal,bln,thn,debet,kredit,tmp,tipe,level,grup,faktor) VALUES ('$nokir2','$nm_perkiraan','$kode_cabang',0,'$var_bulan','$var_tahun',0,0,'O','A','$lvl','$grup','$faktor')");
					}
				} else {
					$data_unpost3 = $this->Posting_model->get_coa_blnthn_terpilih2($bln_aktif, $thn_aktif);
					// ambil coa bulan dan tahun periode aktif, kenapa pake data periode aktif ? karena untuk mengcopy seluruh nomor perkiraan, untuk dibuat baru dengan bulan dan tahun yg dipilih
					if ($data_unpost3 > 0) {
						foreach ($data_unpost3 as $row_up3) {
							$nokir3			= $row_up3->no_perkiraan;
							$nm_perkiraan3	= $row_up3->nama;
							$lvl3			= $row_up3->level;
							$grup3			= $row_up3->grup;
							$faktor3		= $row_up3->faktor;
							$kode_cabang3	= $this->session->userdata('kode_cabang');
							//	copy seluruh nomor perkiraan dalam tabel coa, buat baru dengan bulan dan tahun yg dipilih
							$this->db->query("INSERT INTO COA (no_perkiraan,nama,kdcab,saldoawal,bln,thn,debet,kredit,tmp,tipe,level,grup,faktor) VALUES ('$nokir3','$nm_perkiraan3','$kode_cabang3',0,'$var_bulan','$var_tahun',0,0,'O','A','$lvl3','$grup3','$faktor3')");
						}
					}
				}
				$data['proses'] = 2; // munculkan pesan bahwa data telah berhasil di unposting
				$this->load->view('report/v_unposting', $data);
			}
		}
	}
}
