<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_detail_invoice_$datawal-$datakhir.xls"); //ganti nama sesuai keperluan
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
										
										$supp  = $this->db->query("SELECT * FROM prisma_system.ms_customer WHERE id_klien='$klien'")->row();
											
										echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>Laporan Detail Invoice<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " S/D ". date_format(new DateTime($akhir), "d-m-Y") ."</center></th></tr>";
										echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>NAMA KLIEN : " . $supp->nama_klien . "</center></th></tr>";
										
										?>
									</tr>

									<tr>
									    <td>
										<center><b>Tgl Invoice</b></center>
										</td>
										<td>
										<center><b>No Invoice</b></center>
										</td>
										<td>
											<center><b>No SPK</b></center>
										</td>
										<td>
											<center><b>Nama Customer</b></center>
										</td>
										<td>
											<center><b>Total</b></center>
										</td>
										
										
									</tr>
									
																										
									<!-- DATA DARI JURNAL -->
											<?php
											
											$detail_jurnal	= $this->Kartupiutang_model->get_detail_invoice($awal,$akhir,$klien);
											if ($detail_jurnal > 0) {
												$count2 = 0;
												$count3 = 0;

												foreach ($detail_jurnal as $row_dj) {
													$count2++;
													$count3++;
													$tgl_invoice				= $row_dj->tgl_invoice;
													$no_invoice				    = $row_dj->no_invoice;
													$no_po					    = $row_dj->no_po;
													$total   				    = $row_dj->total;
													$klien					    = $row_dj->nama_klien;
											?>
													<tr>
                                                         <td align="center"><?= date_format(new DateTime($tgl_invoice), "d-m-Y")  ?></td>
														<td><?= $no_invoice ?></td>
														<td><?= $no_po ?></td>
														<td><?= $klien ?></td>
														<td align="right"><?= number_format($total, 0, ',', '.'); ?></td>
														
													</tr>
											<?php
												}
											}
											else{
												
											}
											?>

											<tr>
										
									
								</tbody>

							</table>