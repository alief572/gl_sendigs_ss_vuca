<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Kartu_piutang_$datawal-$datakhir.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda

?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">

	<tbody>

									<tr>
										<?php
										
										$awal 		= $datawal;
										$akhir		= $datakhir;
										$klien    	= $datvendor;
										
										if($klien <> '0'){
										
										$kl  = $this->db->query("SELECT * FROM waterco_live.master_customers WHERE id_customer='$klien'")->row();
										$supp  = $this->db->query("SELECT * FROM waterco_live.master_customers WHERE id_customer='$klien'")->result();
										
										
										$coa_sa = $this->Kartupiutang_model->GetData($awal,$id_klien);	
											
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>KARTU PIUTANG<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " S/D ". date_format(new DateTime($akhir), "d-m-Y") ."</center></th></tr>";
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>NAMA KLIEN : " . $kl->name_customer . "</center></th></tr>";
										}
										else{
										$supp  = $this->db->query("SELECT * FROM waterco_live.master_customers")->result();
										
											
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>KARTU PIUTANG<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " S/D ". date_format(new DateTime($akhir), "d-m-Y") ."</center></th></tr>";
										}
										
										?>
									</tr>

									<tr>
									    <td>
										<center><b>Customer</b></center>
										</td>
										
									    <td>
										<center><b>Nomor Bukti</b></center>
										</td>
										<td>
											<center><b>Tanggal Bukti</b></center>
										</td>
										<td>
											<center><b>Keterangan</b></center>
										</td>
										
										<td>
											<center><b>Debet</b></center>
										</td>
										<td>
											<center><b>Kredit</b></center>
										</td>
										<td>
											<center><b>Saldo</b></center>
										</td>
									</tr>
									
									<?php
									foreach ($supp as $cust) {
										
										$id_klien = $cust->id_customer;	
										$nm_klien = $cust->name_customer;	
										$coa_sa = $this->Kartupiutang_model->GetData($awal,$id_klien);	
										
										
										$count = 0;
										foreach ($coa_sa as $row_sa) {
											$count++;
     										$saldo_awal[$count]	= $row_sa->saldo;
											
											?>
									
									<tr>
												<td width='260px'><b><?=$nm_klien?></b></td>
												<td></td>
												<td></td>
												<td align="center"></td>
												<td align="right">Saldo Awal -></td>
												<td></td>
												<td></td>
												<td align="right"><?= number_format($saldo_awal[$count], 0, ',', '.'); ?></td>
									</tr>
																	
									<!-- DATA DARI JURNAL -->
											<?php
											$sum_debet = 0;
											$sum_kredit = 0;
											$sum_debet = array();
											$sum_kredit = array();
											$nilai_debet = array();
											$nilai_kredit = array();

											$detail_jurnal	= $this->Kartupiutang_model->get_detail_kartu_piutang($awal,$akhir,$id_klien);
											if ($detail_jurnal > 0) {
												$count2 = 0;
												$count3 = 0;

												foreach ($detail_jurnal as $row_dj) {
													$count2++;
													$count3++;
													//$nokir 					= $row_dj->no_perkiraan;
													$nama_perkiraan2[$count2] 	= $row_dj->keterangan;
													$tgl_bukti[$count2]			= $row_dj->tanggal;
													$nomor_bukti[$count2] 		= $row_dj->nomor;
													$nomor_reff[$count2] 		= $row_dj->no_reff;
													$tipe_sm[$count2] 			= $row_dj->tipe;
													$nilai_debet[$count2] 		= $row_dj->debet;
													$nilai_kredit[$count2] 		= $row_dj->kredit;
													// if ((isset($sum_debet[$count]))  == "" || (isset($sum_kredit[$count])) == "" || (isset($nilai_debet[$count2]))  == "" || (isset($nilai_kredit[$count2])) == "") {
													// 	$sum_debet[$count]	 		+= $nilai_debet[$count2];
													// 	$sum_kredit[$count]  		+= $nilai_kredit[$count2];
													// } else {

													$sum_debet[$count]	 		+= $nilai_debet[$count2];
													$sum_kredit[$count]  		+= $nilai_kredit[$count2];
													//}

													//$current_saldo[$count3]	= $saldo_awal[$count];
													$current_saldo[$count3]		= $saldo_awal[$count] + $nilai_debet[$count2] - $nilai_kredit[$count2];
													//$current_saldo[$count2]	+= $current_saldo[$count2] + $nilai_debet[$count2] - $nilai_kredit[$count2];
													// $saldo_akhir				= $sum_debet + $saldo_awal[$count] - $sum_kredit;	
													$saldo_akhir				= $current_saldo[$count3];
											?>
													<tr>
													    <td align="center"><?=$nm_klien?></td>
                                                        <td align="center"><?= $nomor_reff[$count2] ?></td>
													    <td align="center"><?= date_format(new DateTime($tgl_bukti[$count2]), "d-m-Y")  ?></td>
														<td align="center"><?= $nomor_bukti[$count2] ?></td>
														<td><?= $nama_perkiraan2[$count2] ?></td>
														<td align="right"><?= number_format($nilai_debet[$count2], 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($nilai_kredit[$count2], 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($current_saldo[$count3], 0, ',', '.'); ?></td>
													</tr>
											<?php
													$saldo_awal[$count] = $current_saldo[$count3];
												}
											} else {
												$saldo_akhir				= $saldo_awal[$count];
											}
											?>

											<tr>
											    <td><b><?=$nm_klien?></b></td>
												<td></td>
												<td></td>
												<td></td>
												<td align="right">Saldo Akhir -></td>

												<td align="right"><b><?= number_format($sum_debet[$count], 0, ',', '.'); ?></td>
												<td align="right"><b><?= number_format($sum_kredit[$count], 0, ',', '.'); ?></td>
												<td align="right"><b><?= number_format($saldo_akhir, 0, ',', '.'); ?></td>
											</tr>
											<tr>
											    <td></td>
												<td></td>
												<td></td>
												<td align="right"></td>
												<td align="right"></td>
												<td align="right"></td>
												<td align="right"></td>
											</tr>

									<?php
											
										}
									}
									
									?>

								</tbody>


</table>