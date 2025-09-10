<style type="text/css"> .str{ mso-number-format:\@; } </style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Laba_Rugi_per_event_$var_project_.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda

?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
<?php
											if($data_project2 > 0 ){
												foreach($data_project2 as $row_project2){
														$id_project2 = $row_project2->id_penawaran;
														$pria2		= $row_project2->pengantin_pria;
														$wanita2		= $row_project2->pengantin_wanita;
														$nganten2	= $pria2." & ".$wanita2;
													
												}
											}
										?>
							<tr>
								<th colspan="3" style="text-align:center;font-size:15px;"><center>LAPORAN LABA RUGI BY PROJECT<br>Nomor Project : <?=$id_project2?><br>Nama Pengantin : <?=$nganten2?></center></th>
							</tr>

							<tr>
								<td><center><b>No. Perkiraan</b></center></td>
								<td><center><b>Nama Perkiraan</b></center></td>
								<td><center><b>Jumlah</b></center></td>								
							</tr>

							<!-- PENDAPATAN -->
							<tr>
								<td><b>41</b></td>
								<td><b>PENDAPATAN</b></td>
								<td></td>							
							</tr>

							<?php
								if($data_nokir_pdptn > 0){
									$sum_kredit=0;
									$sub_tot_pdptn=0;
									
									foreach($data_nokir_pdptn as $row){

										$nokir						= $row->no_perkiraan;
										$nm_perkiraan				= $row->keterangan;
										$nilai_kredit				= $row->kredit;
										$sum_kredit					+= $nilai_kredit;
										$sub_tot_pdptn				+= $sum_kredit;						

										$rp_sum_kredit				= "Rp. " . number_format($sum_kredit,0,',','.');
										$rp_sub_tot_pdptn			= "Rp. " . number_format($sub_tot_pdptn,0,',','.');
						?>
						<tr>
							<td class='str'><?=$nokir?></td>
							<td><?=$nm_perkiraan?></td>
							<td align="right"><?=$rp_sum_kredit?></td>							
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total PENDAPATAN</b></td>
							<td align="right"><b><?=$rp_sub_tot_pdptn?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						<!-- HPP -->
						<tr>
							<td><b>51</b></td>
							<td><b>HARGA POKOK PENJUALAN</b></td>
							<td></td>
						</tr>
						
						<?php
								if($data_nokir_hpp > 0){
									$sum_debet2=0;
									$sub_tot_hpp=0;
									$kotor=0;
									
									foreach($data_nokir_hpp as $row2){

										$nokir2						= $row2->no_perkiraan;
										$nm_perkiraan2				= $row2->keterangan;
										$nilai_debet2				= $row2->debet;
										$sum_debet2					+= $nilai_debet2;
										$sub_tot_hpp				+= $sum_debet2;	
										$kotor						= $sub_tot_pdptn - 	$sub_tot_hpp;				

										$rp_sum_debet				= "Rp. " . number_format($sum_debet2,0,',','.');
										$rp_sub_tot_hpp				= "Rp. " . number_format($sub_tot_hpp,0,',','.');
										$rp_kotor					= "Rp. " . number_format($kotor,0,',','.');
						?>
						<tr>
							<td class='str'><?=$nokir2?></td>
							<td><?=$nm_perkiraan2?></td>
							<td align="right"><?=$rp_sum_debet?></td>
							
						</tr>
							<?php
									}
								}else{
									$sub_tot_hpp=0;
									$kotor						= $sub_tot_pdptn - 	$sub_tot_hpp;
									$rp_kotor					= "Rp. " . number_format($kotor,0,',','.');						
								}
							?>
						<tr>
							<td></td>
							<td><b>Sub Total HARGA POKOK PENJUALAN</b></td>
							<td align="right"><b><?=$rp_sub_tot_hpp?></b></td>
							
						</tr>
						<tr>
							<td></td>
							<td align="center"><b>LABA/RUGI KOTOR</b></td>
							<td align="right"><b><?=$rp_kotor?></b></td>
									
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>								
						</tr>

						<!-- BIAYA PENJUALAN-->
						<tr>
							<td><b>61</b></td>
							<td><b>BIAYA PENJUALAN</b></td>
							<td></td>							
						</tr>
						
						<?php			
								if($data_nokir_biaya > 0){
									$sum_debet3=0;
									$sub_tot_biaya=0;
									
									foreach($data_nokir_biaya as $row3){

										$nokir3						= $row3->no_perkiraan;
										$nm_perkiraan3				= $row3->keterangan;
										$nilai_debet3				= $row3->debet;
										$sum_debet3					+= $nilai_debet3;
										$sub_tot_biaya				+= $sum_debet3;											

										$rp_sum_debet3				= "Rp. " . number_format($sum_debet3,0,',','.');
										$rp_sub_tot_biaya			= "Rp. " . number_format($sub_tot_biaya,0,',','.');			
						?>
						<tr>
							<td class='str'><?=$nokir3?></td>
							<td><?=$nm_perkiraan3?></td>
							<td align="right"><?=$rp_sum_debet3?></td>							
						</tr>
						<?php
									}	
								}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA PENJUALAN</b></td>
							<td align="right"><b><?=$rp_sub_tot_biaya?></b></td>							
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>								
						</tr>
						<?php
								
						?>
						
						<!-- BIAYA KANTOR DAN UMUM-->
						<tr>
							<td><b>68</b></td>
							<td><b>BIAYA KANTOR DAN UMUM</b></td>
							<td></td>
							
						</tr>
						
						<?php			
								if($data_nokir_biaya2 > 0){
									$sum_debet4=0;
									$sub_tot_biaya2=0;
									
									foreach($data_nokir_biaya2 as $row4){

										$nokir4						= $row4->no_perkiraan;
										$nm_perkiraan4				= $row4->keterangan;
										$nilai_debet4				= $row4->debet;
										$sum_debet4					+= $nilai_debet4;
										$sub_tot_biaya2				+= $sum_debet4;	
										$tot_biaya					= $sub_tot_biaya + $sub_tot_biaya2;											

										$rp_sum_debet4				= "Rp. " . number_format($sum_debet4,0,',','.');
										$rp_sub_tot_biaya2			= "Rp. " . number_format($sub_tot_biaya2,0,',','.');
										$rp_tot_biaya				= "Rp. " . number_format($tot_biaya,0,',','.');	
						?>
						<tr>
							<td class='str'><?=$nokir4?></td>
							<td><?=$nm_perkiraan4?></td>
							<td align="right"><?=$rp_sum_debet4?></td>							
						</tr>
						<?php
							}
									}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA KANTOR</b></td>
							<td align="right"><b><?=$rp_sub_tot_biaya2?></b></td>
							
						</tr>
						<tr>
							<td></td>
							<td><b>Total BIAYA</b></td>
							<td align="right"><b><?=$rp_tot_biaya?></b></td>
							
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								
							</tr>
						<?php
									
						?>

						<!-- PENDAPATAN LAIN-LAIN -->
						<tr>
								<td><b>71</b></td>
								<td><b>PENDAPATAN LAIN-LAIN</b></td>
								<td></td>
								
							</tr>

							<?php
								if($data_nokir_pdptn2 > 0){
									$sum_kredit5=0;
									$sub_tot_pdptn5=0;
									
									foreach($data_nokir_pdptn2 as $row5){

										$nokir5						= $row5->no_perkiraan;
										$nm_perkiraan5				= $row5->keterangan;
										$nilai_kredit5				= $row5->kredit;
										$sum_kredit5				+= $nilai_kredit5;
										$sub_tot_pdptn5				+= $sum_kredit5;						

										$rp_sum_kredit5				= "Rp. " . number_format($sum_kredit5,0,',','.');
										$rp_sub_tot_pdptn5			= "Rp. " . number_format($sub_tot_pdptn5,0,',','.');
						?>
						<tr>
							<td class='str'><?=$nokir5?></td>
							<td><?=$nm_perkiraan5?></td>
							<td align="right"><?=$rp_sum_kredit5?></td>
								
						</tr>
						<?php 
									}
								}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total PENDAPATAN LAIN-LAIN</b></td>
							<td align="right"><b><?=$rp_sub_tot_pdptn5?></b></td>							
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>								
							</tr>

						<!-- BIAYA LAIN-LAIN-->
						<tr>
							<td><b>72</b></td>
							<td><b>BIAYA LAIN-LAIN</b></td>
							<td></td>							
						</tr>
						
						<?php
						if($data_nokir_biaya3 > 0){
							$sum_debet6=0;
							$sub_tot_biaya3=0;
							
							foreach($data_nokir_biaya3 as $row6){

								$nokir6						= $row6->no_perkiraan;
								$nm_perkiraan6				= $row6->keterangan;
								$nilai_debet6				= $row6->debet;
								$sum_debet6					+= $nilai_debet6;
								$sub_tot_biaya3				+= $sum_debet6;	
								$bersih						= $kotor - $tot_biaya + $sub_tot_pdptn5 - $sub_tot_biaya3;			

								$rp_sum_debet6				= "Rp. " . number_format($sum_debet6,0,',','.');
								$rp_sub_tot_biaya3			= "Rp. " . number_format($sub_tot_biaya3,0,',','.');
								$rp_bersih					= "Rp. " . number_format($bersih,0,',','.');			
						?>
						<tr>
							<td class='str'><?=$nokir6?></td>
							<td><?=$nm_perkiraan6?></td>
							<td align="right"><?=$rp_sum_debet6?></td>							
						</tr>
						<?php
							}
						}else{
							$bersih						= $kotor - $tot_biaya + $sub_tot_pdptn5 - $sub_tot_biaya3;
							$rp_bersih					= "Rp. " . number_format($bersih,0,',','.');
						}							
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA LAIN-LAIN</b></td>
							<td align="right"><b><?=$rp_sub_tot_biaya3?></b></td>
						</tr>

						<tr>
							<td></td>
							<td align="center"><b>LABA/RUGI BERSIH</b></td>
							<td align="right"><b><?=$rp_bersih?></b></td>							
						</tr>
</table>