<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rekap_umur_kartu_piutang.xls"); //ganti nama sesuai keperluan
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
																			
																	
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>REKAP KARTU PIUTANG<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . "</center></th></tr>";
										
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
										   
										   $dt_jurnal	= $this->Kartupiutang_model->get_umur_piutang($id_supplier);
											         
												if ($dt_jurnal > 0) {
												
												     foreach ($dt_jurnal as $row) {
													 $total = $row->saldo30+$row->saldo31+$row->saldo90+$row->saldo120+$row->saldo120plus;
										
											?>
													<tr>
													   
													    <td align="center"><?= $row->id_supplier  ?></td>
														<td align="left"><?= $row->nama_supplier ?></td>
													    <td align="right"><?= number_format($row->saldo30, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($row->saldo31, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($row->saldo90, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($row->saldo120, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($row->saldo120plus, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($total, 0, ',', '.'); ?></td>
														
													</tr>
											
									
									       
									         <?php
													 }
												}
											 ?>
							
                            </tbody>

		</table>

             