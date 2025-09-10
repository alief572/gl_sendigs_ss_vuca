<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Umur_kartu_piutang.xls"); //ganti nama sesuai keperluan
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
										$vendor 	= $datvendor;
										
										$supp  = $this->db->query("SELECT * FROM prisma_system.ms_customer WHERE id_klien='$vendor'")->row();
											
										echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>KARTU PIUTANG<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " </center></th></tr>";
										echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>NAMA KLIEN : " . $supp->nama_klien . "</center></th></tr>";
										
										?>
									</tr>

									<tr>
									    <td>
										<center><b>Tanggal Bukti</b></center>
										</td>
										<td>
											<center><b>Nomor Bukti</b></center>
										</td>
										<td>
											<center><b>Keterangan</b></center>
										</td>
										
										<td>
											<center><b>0-30 hari</b></center>
										</td>
										<td>
											<center><b>31-60 hari</b></center>
										</td>
										<td>
											<center><b>61-90 hari</b></center>
										</td>
										<td>
											<center><b>91-120 hari</b></center>
										</td>
										<td>
											<center><b>>120 hari</b></center>
										</td>
										<td>
											<center><b>Jumlah</b></center>
										</td>
									</tr>
									
									<?php
									    if ($coa_sa > 0) {
										$count = 0;
										foreach ($coa_sa as $row_sa) {
											$count++;
     										$bukti	= $row_sa->no_reff;
											$tgl_bukti	= $row_sa->tanggal;
											
									?>
									
															
									<!-- DATA DARI JURNAL -->
											<?php
											

											$detail_jurnal	= $this->Kartupiutang_model->get_detail_umur_kartu_piutang($awal,$akhir,$vendor, $bukti);
											if ($detail_jurnal > 0) {
												
												foreach ($detail_jurnal as $row_dj) {
													
													$tgl_j       		= $row_dj->tanggal;
													$nilai_debet 		= $row_dj->debet;
													$nilai_kredit 		= $row_dj->kredit;
													$keterangan         = $row_dj->keterangan;
                                                    $saldo30         = $row_dj->saldo30;
													$saldo31         = $row_dj->saldo31;
													$saldo60         = $row_dj->saldo60;
													$saldo90         = $row_dj->saldo90;
													$saldo120         = $row_dj->saldo120;
													
													
													
													if  ($saldo30 != 0 ){
													$totsaldo30     = $saldo30;
													$totsaldo31     = 0;
													$totsaldo60     = 0;
													$totsaldo90     = 0;
													$totsaldo120    = 0;
													}
													// if ($saldo30 < 0 ) {
													// $totsaldo30     = 0;
													// }
													if ($saldo31 != 0 ) {
													$totsaldo30     = 0;
													$totsaldo31     = $saldo31+$saldo30;
													$totsaldo60     = 0;
													$totsaldo90     = 0;
													$totsaldo120    = 0;
													}
													// if ($saldo31 < 0 ) {
													// $totsaldo31     = 0;
													// }
													if  ( $saldo60 != 0 ) {
													$totsaldo30     = 0;
													$totsaldo31     = 0;
													$totsaldo60     = $saldo60+$saldo31+$saldo30;
													$totsaldo90     = 0;
													$totsaldo120    = 0;
													}
													// if ($saldo60 < 0 ) {
													// $totsaldo60     = 0;
													// }
													if ( $saldo90 != 0 ) {
													$totsaldo30     = 0;
													$totsaldo31     = 0;
													$totsaldo60     = 0;
													$totsaldo90     = $saldo90+$saldo60+$saldo31+$saldo30;
													$totsaldo120    = 0;
													}
													// if ($saldo90 < 0 ) {
													// $totsaldo90     = 0;
													// }
													if ($saldo120 != 0) {
													$totsaldo30     = 0;
													$totsaldo31     = 0;
													$totsaldo60     = 0;
													$totsaldo90     = 0;
													$totsaldo120     = $saldo120+$saldo90+$saldo60+$saldo31+$saldo30;
													}
													// if ($saldo120 < 0 ) {
													// $totsaldo120     = 0;
													// }
													
													$totalall = $totsaldo30+$totsaldo31+$totsaldo60+$totsaldo90+$totsaldo120;
													
												
													
													
													
													
												
											?>
													<tr>
													    <td align="center"><?= date_format(new DateTime($tgl_j), "d-m-Y")  ?></td>
														<td align="center"><?= $bukti ?></td>
														<td><?= $keterangan?></td>
														<td align="right"><?= number_format($totsaldo30, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo31, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo60, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo90, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo120, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totalall, 0, ',', '.'); ?></td>
														
													</tr>
											

											
										
									<?php
												}
											
										   }
										}
										
										}
									
									?>

								</tbody>
</table>