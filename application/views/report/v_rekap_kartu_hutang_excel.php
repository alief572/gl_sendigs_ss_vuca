<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rekap_kartu_hutang_$datawal-$datakhir.xls"); //ganti nama sesuai keperluan
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
																			
																	
										echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>REKAP KARTU HUTANG<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " S/D ". date_format(new DateTime($akhir), "d-m-Y") ."</center></th></tr>";
										
										?>
									</tr>

									<tr>
									    <td>
										<center><b>Kode Supplier</b></center>
										</td>
										<td>
											<center><b>Nama Supplier</b></center>
										</td>
										<td>
											<center><b>Saldo Awal</b></center>
										</td>
										
										<td>
											<center><b>Debet</b></center>
										</td>
										<td>
											<center><b>Kredit</b></center>
										</td>
										<td>
											<center><b>Saldo Akhir</b></center>
										</td>
									</tr>
									
									<?php
									
										$count = 0;
										foreach ($vendor as $vend) {
											$count++;
     										$id_supplier   = $vend->id_supplier;
											$nm_supplier   = $vend->nama_supplier;
											
											
											$detail_jurnal	= $this->Kartuhutang_model->get_rekap_kartu_hutang($awal,$akhir,$id_supplier);
											
											if ($detail_jurnal > 0) {
												$count2 = 0;
												$count3 = 0;

												foreach ($detail_jurnal as $row_dj) {
													$count2++;
													$count3++;
													$saldo_awal	= $row_dj->saldo_awal;
													$debet 	= $row_dj->debet;
													$kredit	= $row_dj->kredit;
													$saldo_akhir	= $row_dj->saldo_akhir;
													$salakh			= $saldo_awal+$saldo_akhir;
													
													$tot_saldoawal    += $saldo_awal;
													$tot_debet        += $debet;
													$tot_kredit       += $kredit;
													$tot_saldoakhir   += $saldo_akhir;
													$tot_salakh       = $tot_saldoawal + $tot_saldoakhir;
									?>
									
																									
												<tr>
												<td><?= $id_supplier ?> </td>
												<td><?= $nm_supplier ?> </td>
												<td align="right"><?= number_format($saldo_awal, 0, ',', '.'); ?></td>
												<td align="right"><?= number_format($debet, 0, ',', '.'); ?></td>
												<td align="right"><?= number_format($kredit, 0, ',', '.'); ?></td>
												<td align="right"><?= number_format($salakh, 0, ',', '.'); ?></td>
												</tr>
												
												
									<?php
									
												}
												
											}
											
										}
									
									?>
									         <tr>
												<td> </td>
												<td></td>
												<td align="right"><b><?= number_format($tot_saldoawal, 0, ',', '.'); ?></td>
												<td align="right"><b><?= number_format($tot_debet, 0, ',', '.'); ?></td>
												<td align="right"><b><?= number_format($tot_kredit, 0, ',', '.'); ?></td>
												<td align="right"><b><?= number_format($tot_salakh, 0, ',', '.'); ?></td>
											</tr>


								</tbody>

							


</table>