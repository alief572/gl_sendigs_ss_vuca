<style type="text/css"> .str{ mso-number-format:\@; } </style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Konsolidasi_Laba_Rugi_Lv5_$data_bulan_post-$data_tahun_post.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda

?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
	
	<?php
												if($data_bulan_post > 0){
														$nm_bln = $data_bulan_post;
														if($nm_bln == 1){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br>Periode : Januari ".$data_tahun_post."</center></th></tr>";															
														}elseif($nm_bln == 2){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Februari ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 3){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Maret ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 4){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : April ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 5){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Mei ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 6){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Juni ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 7){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Juli ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 8){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Agustus ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 9){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : September ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 10){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Oktober ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 11){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : November ".$data_tahun_post."</center></th></tr>";
														}else{
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN KONSOLIDASI LABA RUGI<br><br>Periode : Desember ".$data_tahun_post."</center></th></tr>";
														}														
												}
											?>
	

	<tr>
		<td><center><b>No. Perkiraan</b></center></td>
		<td><center><b>Nama Perkiraan</b></center></td>
		<td><center><b>Previous (Year-To-Date)</b></center></td>
		<td><center><b>Current Month</b></center></td>
		<td><center><b>Year-To-Date</b></center></td>
	</tr>
<!-- PENDAPATAN -->
<tr>
								<td><b>41</b></td>
								<td><b>PENDAPATAN</b></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_41_konsolidasi > 0){
									$total_pYTD_pdptn	= 0;
									$total_cmonth_pdptn	= 0;
									$total_YTD_pdptn	= 0;

									foreach($nokir_41_konsolidasi as $row){

										$nokir_pdptn				= $row->no_perkiraan;
										$nm_perkiraan_pdptn			= $row->nama;
										$v_faktor					= $row->faktor;
										$pYTD_pdptn					= $row->sum41;
										$cmonth_pdptn				= $row->sumtrans41;
										$YTD_pdptn					= $pYTD_pdptn + $cmonth_pdptn;

										$total_pYTD_pdptn 	+=  $pYTD_pdptn;
										$total_cmonth_pdptn +=  $cmonth_pdptn;
										$total_YTD_pdptn 	+=  $YTD_pdptn;

										$rp_pYTD_pdptn			= "Rp. " . number_format($pYTD_pdptn,0,',','.');
										$rp_cmonth_pdptn		= "Rp. " . number_format($cmonth_pdptn,0,',','.');
										$rp_YTD_pdptn			= "Rp. " . number_format($YTD_pdptn,0,',','.');
									
										$rp_total_pYTD_pdptn	= "Rp. " . number_format($total_pYTD_pdptn,0,',','.');
										$rp_total_cmonth_pdptn	= "Rp. " . number_format($total_cmonth_pdptn,0,',','.');
										$rp_total_YTD_pdptn		= "Rp. " . number_format($total_YTD_pdptn,0,',','.');
						?>
						<tr>
							<td class="str"><?=$nokir_pdptn?></td>
							<td><?=$nm_perkiraan_pdptn?></td>
							<td align="right"><?=$rp_pYTD_pdptn?></td>
							<td align="right"><?=$rp_cmonth_pdptn?></td>
							<td align="right"><?=$rp_YTD_pdptn?></td>		
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total PENDAPATAN</b></td>
							<td align="right"><b><?=$rp_total_pYTD_pdptn?></b></td>
							<td align="right"><b><?=$rp_total_cmonth_pdptn?></b></td>
							<td align="right"><b><?=$rp_total_YTD_pdptn?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						<!-- HPP -->
						<tr>
							<td><b>51</b></td>
							<td><b>HARGA POKOK PENJUALAN</b></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						
						<?php
								if($nokir_51_konsolidasi > 0){
									$total_pYTD_hpp 	= 0;
									$total_cmonth_hpp 	= 0;
									$total_YTD_hpp 		= 0;
									$SubTotalHpp_pYTD	= 0;
									$SubTotalHpp_cmonth	= 0;
									$SubTotalHpp_YTD	= 0;

									$Saldo_pYTD		= 0;
									$Saldo_cmonth	= 0;
									$Saldo_YTD		= 0;

									foreach($nokir_51_konsolidasi as $row2){
										$nokir_hpp 			= $row2->no_perkiraan;
										$nm_perkiraan_hpp	= $row2->nama;
										$v_faktor			= $row2->faktor;
										$pYTD_hpp			= $row2->sum51;
										$cmonth_hpp			= $row2->sumtrans51;
										$YTD_hpp			= $pYTD_hpp + $cmonth_hpp;

										$SubTotalHpp_pYTD 	+=  $pYTD_hpp;
										$SubTotalHpp_cmonth +=  $cmonth_hpp;
										$SubTotalHpp_YTD 	+=  $YTD_hpp;

										$Saldo_pYTD		= ($total_pYTD_pdptn) - ($SubTotalHpp_pYTD);
										$Saldo_cmonth	= ($total_cmonth_pdptn) - ($SubTotalHpp_cmonth);
										$Saldo_YTD		= ($total_YTD_pdptn) - ($SubTotalHpp_YTD);

										$total_pYTD_hpp 	+=  $pYTD_hpp;
										$total_cmonth_hpp 	+=  $cmonth_hpp;
										$total_YTD_hpp 		+=  $YTD_hpp;

										$rp_pYTD_hpp			= "Rp. " . number_format($pYTD_hpp,0,',','.');
										$rp_cmonth_hpp			= "Rp. " . number_format($cmonth_hpp,0,',','.');
										$rp_YTD_hpp				= "Rp. " . number_format($YTD_hpp,0,',','.');
									
										$rp_total_pYTD_hpp		= "Rp. " . number_format($total_pYTD_hpp,0,',','.');
										$rp_total_cmonth_hpp	= "Rp. " . number_format($total_cmonth_hpp,0,',','.');
										$rp_total_YTD_hpp		= "Rp. " . number_format($total_YTD_hpp,0,',','.');
						?>
						<tr>
							<td class="str"><?=$nokir_hpp?></td>
							<td><?=$nm_perkiraan_hpp?></td>
							<td align="right"><?=$rp_pYTD_hpp?></td>
							<td align="right"><?=$rp_cmonth_hpp?></td>
							<td align="right"><?=$rp_YTD_hpp?></td>		
						</tr>
							<?php
								}
							}
							?>
						<tr>
							<td></td>
							<td><b>Sub Total HARGA POKOK PENJUALAN</b></td>
							<td align="right"><b><?=$rp_SubTotalHpp_pYTD	= "Rp. " . number_format($SubTotalHpp_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalHpp_cmonth	= "Rp. " . number_format($SubTotalHpp_cmonth,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalHpp_YTD		= "Rp. " . number_format($SubTotalHpp_YTD,0,',','.');?></b></td>
						</tr>
						<tr>
							<td></td>
							<td align="center"><b>LABA/RUGI KOTOR</b></td>
							<td align="right"><b><?=$RpSaldo_pYTD			= "Rp. " . number_format($Saldo_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$RpSaldo_cmonth			= "Rp. " . number_format($Saldo_cmonth,0,',','.');?></b></td>
							<td align="right"><b><?=$RpSaldo_YTD			= "Rp. " . number_format($Saldo_YTD,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						<!-- BIAYA PENJUALAN-->
						<tr>
							<td><b>61</b></td>
							<td><b>BIAYA PENJUALAN</b></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						
						<?php			
								if($nokir_61_konsolidasi > 0){
									$total_pYTD_biaya 		=  0;
									$total_cmonth_biaya 	=  0;
									$total_YTD_biaya 		=  0;
									$SubTotalBiaya_pYTD		= 0;
									$SubTotalBiaya_cmonth	= 0;
									$SubTotalBiaya_YTD		= 0;

									foreach($nokir_61_konsolidasi as $row3){
										$nokir_biaya 				= $row3->no_perkiraan;
										$nm_perkiraan_biaya			= $row3->nama;
										$v_faktor					= $row3->faktor;
										$pYTD_biaya					= $row3->sum61;
										$cmonth_biaya				= $row3->sumtrans61;
										$YTD_biaya					= $pYTD_biaya + $cmonth_biaya;
										
										$SubTotalBiaya_pYTD 	+=  $pYTD_biaya;
										$SubTotalBiaya_cmonth 	+=  $cmonth_biaya;
										$SubTotalBiaya_YTD 		+=  $YTD_biaya;

										$total_pYTD_biaya 	+=  $pYTD_biaya;
										$total_cmonth_biaya +=  $cmonth_biaya;
										$total_YTD_biaya 	+=  $YTD_biaya;
						?>
						<tr>
							<td class="str"><?=$nokir_biaya?></td>
							<td><?=$nm_perkiraan_biaya?></td>
							<td align="right">
								<?=$rp_pYTD_biaya			= "Rp. " . number_format($pYTD_biaya,0,',','.');?>
							</td>
							<td align="right">
								<?=
									$rp_cmonth_biaya		= "Rp. " . number_format($cmonth_biaya,0,',','.');
								?>
							</td>
							<td align="right">
								<?=
									$rp_YTD_biaya			= "Rp. " . number_format($YTD_biaya,0,',','.');
								?>
							</td>		
						</tr>
						<?php
							
							}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA PENJUALAN</b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya_pYTD		= "Rp. " . number_format($SubTotalBiaya_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya_cmonth		= "Rp. " . number_format($SubTotalBiaya_cmonth,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya_YTD		= "Rp. " . number_format($SubTotalBiaya_YTD,0,',','.');?></b></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>		
						</tr>
						<?php
							}
						?>
						
						<!-- BIAYA KANTOR DAN UMUM-->
						<tr>
							<td><b>68</b></td>
							<td><b>BIAYA KANTOR DAN UMUM</b></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						
						<?php
							// if($nokir_68induk_konsolidasi > 0){
							// 	foreach($nokir_68_konsolidasi as $row_68induk){
								if($nokir_68_konsolidasi > 0){
									$total_cmonth_biaya2	=  0;
									$total_YTD_biaya2		=  0;
									$SubTotalBiaya2_pYTD	= 0;
									$SubTotalBiaya2_cmonth	= 0;
									$SubTotalBiaya2_YTD		= 0;

									$TotalBiaya_pYTD		= 0;
									$TotalBiaya_cmonth68	= 0;
									$TotalBiaya_YTD			= 0;
									foreach($nokir_68_konsolidasi as $row4){
										$nokir_biaya68 				= $row4->no_perkiraan;
										$nm_perkiraan_biaya68		= $row4->nama;
										$v_faktor					= $row4->faktor;
										
										$pYTD_biaya68_				= ($row4->saldoawal) * $v_faktor;
										$cmonth_biaya68_				= $row4->debet;
										// $YTD_biaya68_				= $pYTD_biaya68 + $cmonth_biaya68;

										$kode_cabang = $this->session->userdata('kode_cabang');

										$sum_cbg = $this->db->query("SELECT *, sum(if(no_perkiraan = '$nokir_biaya68',(saldoawal*faktor),0)) as sum68, sum(if(no_perkiraan = '$nokir_biaya68',(debet-kredit),0)) as sumtrans68 FROM COA WHERE bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if($sum_cbg > 0){
											foreach($sum_cbg as $row_sum68){
												$pYTD_biaya68	= $row_sum68->sum68;
												$cmonth_biaya68	= $row_sum68->sumtrans68;
												$YTD_biaya68	= $pYTD_biaya68 + $cmonth_biaya68;
										

										$SubTotalBiaya2_pYTD		+=  $pYTD_biaya68;
										$SubTotalBiaya2_cmonth		+=  $cmonth_biaya68;
										$SubTotalBiaya2_YTD 		+=  $YTD_biaya68;

										$TotalBiaya_pYTD			= $SubTotalBiaya_pYTD + $SubTotalBiaya2_pYTD;
										$TotalBiaya_cmonth68		= $SubTotalBiaya_cmonth + $SubTotalBiaya2_cmonth;
										$TotalBiaya_YTD				= $SubTotalBiaya_YTD + $SubTotalBiaya2_YTD;

										$Plabarugi_ops	= $Saldo_pYTD - $TotalBiaya_pYTD;
										$Clabarugi_ops	= $Saldo_cmonth - $TotalBiaya_cmonth68;
										$Ylabarugi_ops	= $Saldo_YTD - $TotalBiaya_YTD;
						?>
						<tr>
							<td class="str"><?=$nokir_biaya68?></td>
							<td><?=$nm_perkiraan_biaya68?></td>
							<td align="right">
								<?=$rp_pYTD_biaya68			= "Rp. " . number_format($pYTD_biaya68,0,',','.');?>
							</td>
							<td align="right">
								<?=
									$rp_cmonth_biaya68		= "Rp. " . number_format($cmonth_biaya68,0,',','.');
								?>
							</td>
							<td align="right">
								<?=
									$rp_YTD_biaya68			= "Rp. " . number_format($YTD_biaya68,0,',','.');
								?>
							</td>		
						</tr>
						<?php
									}
								}
							}
						}
						?>
						
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA ADMINISTRASI dan UMUM</b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya2_pYTD		= "Rp. " . number_format($SubTotalBiaya2_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya2_cmonth	= "Rp. " . number_format($SubTotalBiaya2_cmonth,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya2_YTD		= "Rp. " . number_format($SubTotalBiaya2_YTD,0,',','.');?></b></td>
						</tr>
						<tr>
							<td></td>
							<td><b>Total BIAYA OPERASIONAL</b></td>
							<td align="right"><b><?=$rp_TotalBiaya_pYTD		= "Rp. " . number_format($TotalBiaya_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_TotalBiaya_cmonth	= "Rp. " . number_format($TotalBiaya_cmonth68,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_TotalBiaya_YTD		= "Rp. " . number_format($TotalBiaya_YTD,0,',','.');?></b></td>	
						</tr>
						<tr>
							<td></td>
							<td align="center"><b>LABA/RUGI OPERASIONAL</b></td>
							<td align="right"><b><?=$rp_Plabarugi_ops		= "Rp. " . number_format($Plabarugi_ops,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_Clabarugi_ops	= "Rp. " . number_format($Clabarugi_ops,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_Ylabarugi_ops		= "Rp. " . number_format($Ylabarugi_ops,0,',','.');?></b></td>	
						</tr>
						<tr>
								<td></td>
								<td></td>
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
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_71_konsolidasi > 0){
									$total_pYTD_pdptn2=0;
									$total_cmonth_pdptn2=0;
									$total_YTD_pdptn2=0;

									$SubTotalPdptn2_pYTD			= 0;
									$SubTotalPdptn2_cmonth71			= 0;
									$SubTotalPdptn2_YTD			= 0;									

									foreach($nokir_71_konsolidasi as $row5){

										$nokir_pdptn2				= $row5->no_perkiraan;
										$nm_perkiraan_pdptn2	= $row5->nama;
										$v_faktor					= $row5->faktor;
										$pYTD_pdptn2					= $row5->sum71;
										$cmonth_pdptn2				= $row5->sumtrans71;
										$YTD_pdptn2					= $pYTD_pdptn2 + $cmonth_pdptn2;

										$SubTotalPdptn2_pYTD 	+=  $pYTD_pdptn2;
										$SubTotalPdptn2_cmonth71 +=  $cmonth_pdptn2;
										$SubTotalPdptn2_YTD 		+=  $YTD_pdptn2;

										
										$total_pYTD_pdptn2 	+=  $pYTD_pdptn2;
										$total_cmonth_pdptn2 +=  $cmonth_pdptn2;
										$total_YTD_pdptn2 		+=  $YTD_pdptn2;

										$rp_pYTD_pdptn2			= "Rp. " . number_format($pYTD_pdptn2,0,',','.');
										$rp_cmonth_pdptn2		= "Rp. " . number_format($cmonth_pdptn2,0,',','.');
										$rp_YTD_pdptn2			= "Rp. " . number_format($YTD_pdptn2,0,',','.');
									
										$rp_total_pYTD_pdptn2			= "Rp. " . number_format($total_pYTD_pdptn2,0,',','.');
										$rp_total_cmonth_pdptn2		= "Rp. " . number_format($total_cmonth_pdptn2,0,',','.');
										$rp_total_YTD_pdptn2				= "Rp. " . number_format($total_YTD_pdptn2,0,',','.');
						?>
						<tr>
							<td class="str"><?=$nokir_pdptn2?></td>
							<td><?=$nm_perkiraan_pdptn2?></td>
							<td align="right"><?=$rp_pYTD_pdptn2?></td>
							<td align="right"><?=$rp_cmonth_pdptn2?></td>
							<td align="right"><?=$rp_YTD_pdptn2?></td>		
						</tr>
						<?php 
							}
						}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total PENDAPATAN LAIN-LAIN</b></td>
							<td align="right"><b><?=$rp_SubTotalPdptn2_pYTD		= "Rp. " . number_format($SubTotalPdptn2_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalPdptn2_cmonth		= "Rp. " . number_format($SubTotalPdptn2_cmonth71,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalPdptn2_YTD		= "Rp. " . number_format($SubTotalPdptn2_YTD,0,',','.');?></b></td>
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!-- TAKSIRAN PAJAK -->
				<tr>
								<td><b>91</b></td>
								<td><b>TAKSIRAN PAJAK</b></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_91_konsolidasi > 0){
									$total_pYTD_takspajak	= 0;
									$total_cmonth_takspajak	= 0;
									$total_YTD_takspajak	= 0;

									$SubTotaltakspajak_pYTD		= 0;
									$SubTotaltakspajak_cmonth91	= 0;
									$SubTotaltakspajak_YTD		= 0;

									

									foreach($nokir_91_konsolidasi as $row5){

										$nokir_takspajak			= $row5->no_perkiraan;
										$nm_perkiraan_takspajak		= $row5->nama;
										$v_faktor					= $row5->faktor;
										$pYTD_takspajak				= $row5->sum91;
										$cmonth_takspajak			= $row5->sumtrans91;
										$YTD_takspajak				= $pYTD_takspajak + $cmonth_takspajak;

										$SubTotaltakspajak_pYTD 	+=  $pYTD_takspajak;
										$SubTotaltakspajak_cmonth91 +=  $cmonth_takspajak;
										$SubTotaltakspajak_YTD 		+=  $YTD_takspajak;

										
										$total_pYTD_takspajak 		+=  $pYTD_takspajak;
										$total_cmonth_takspajak 	+=  $cmonth_takspajak;
										$total_YTD_takspajak 		+=  $YTD_takspajak;

										$rp_pYTD_takspajak			= "Rp. " . number_format($pYTD_takspajak,0,',','.');
										$rp_cmonth_takspajak		= "Rp. " . number_format($cmonth_takspajak,0,',','.');
										$rp_YTD_takspajak			= "Rp. " . number_format($YTD_takspajak,0,',','.');
									
										$rp_total_pYTD_takspajak	= "Rp. " . number_format($total_pYTD_takspajak,0,',','.');
										$rp_total_cmonth_takspajak	= "Rp. " . number_format($total_cmonth_takspajak,0,',','.');
										$rp_total_YTD_takspajak		= "Rp. " . number_format($total_YTD_takspajak,0,',','.');
						?>
						<tr>
							<td class="str"><?=$nokir_takspajak?></td>
							<td><?=$nm_perkiraan_takspajak?></td>
							<td align="right"><?=$rp_pYTD_takspajak?></td>
							<td align="right"><?=$rp_cmonth_takspajak?></td>
							<td align="right"><?=$rp_YTD_takspajak?></td>		
						</tr>
						<?php 
							}
						}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total PAJAK</b></td>
							<td align="right"><b><?=$rp_SubTotaltakspajak_pYTD		= "Rp. " . number_format($SubTotaltakspajak_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotaltakspajak_cmonth	= "Rp. " . number_format($SubTotaltakspajak_cmonth91,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotaltakspajak_YTD		= "Rp. " . number_format($SubTotaltakspajak_YTD,0,',','.');?></b></td>
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						<!-- BIAYA LAIN-LAIN-->
						<tr>
							<td><b>72</b></td>
							<td><b>BIAYA LAIN-LAIN</b></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						
						<?php			
								if($nokir_72_konsolidasi > 0){
									$total_pYTD_biaya3 	=  0;
									$total_cmonth_biaya3 =  0;
									$total_YTD_biaya3		=  0;
									$SubTotalBiaya3_pYTD			= 0;
									$SubTotalBiaya3_cmonth			= 0;
									$SubTotalBiaya3_YTD			= 0;

									$TotalBiaya_pYTD			= 0;
									//$TotalBiaya_cmonth72			= 0;
									//$TotalBiaya_YTD			= 0;

									$SaldoBersih_pYTD			= 0;
									$SaldoBersih_cmonth			= 0;
									$SaldoBersih_YTD			= 0;

									foreach($nokir_72_konsolidasi as $row6){
										$nokir_biaya3 				= $row6->no_perkiraan;
										$nm_perkiraan_biaya3	= $row6->nama;
										$v_faktor					= $row6->faktor;
										$pYTD_biaya3					= $row6->sum72;
										$cmonth_biaya3				= $row6->sumtrans72;
										$YTD_biaya3					= $pYTD_biaya3 + $cmonth_biaya3;
										
										$SubTotalBiaya3_pYTD		+=  $pYTD_biaya3;
										$SubTotalBiaya3_cmonth	+=  $cmonth_biaya3;
										$SubTotalBiaya3_YTD 		+=  $YTD_biaya3;

										$TotalBiaya_pYTD			= $SubTotalBiaya_pYTD + $SubTotalBiaya3_pYTD;
										//$TotalBiaya_cmonth72		= $SubTotalBiaya_cmonth + $SubTotalBiaya3_cmonth;
										//$TotalBiaya_YTD				= $SubTotalBiaya_YTD + $SubTotalBiaya3_YTD;

										// $SaldoBersih_pYTD			= $Saldo_pYTD - $TotalBiaya_pYTD + $SubTotalPdptn2_pYTD - $SubTotalBiaya3_pYTD; 
										// $SaldoBersih_cmonth		= $Saldo_cmonth - $TotalBiaya_cmonth68 + $SubTotalPdptn2_cmonth71 - $SubTotalBiaya3_cmonth;
										// $SaldoBersih_YTD			= $Saldo_YTD - $TotalBiaya_YTD + $SubTotalPdptn2_YTD - $SubTotalBiaya3_YTD;
										
										$SaldoBersih_pYTD			= $Plabarugi_ops + $SubTotalPdptn2_pYTD - $SubTotaltakspajak_pYTD - $SubTotalBiaya3_pYTD;

										$SaldoBersih_cmonth			= $Clabarugi_ops + $SubTotalPdptn2_cmonth71 - $SubTotaltakspajak_cmonth91 - $SubTotalBiaya3_cmonth;  
										
										$SaldoBersih_YTD			= $Ylabarugi_ops + $SubTotalPdptn2_YTD - $SubTotaltakspajak_YTD - $SubTotalBiaya3_YTD;

										$total_pYTD_biaya3 	+=  $pYTD_biaya3;
										$total_cmonth_biaya3 +=  $cmonth_biaya3;
										$total_YTD_biaya3 		+=  $YTD_biaya3;
						?>
						<tr>
							<td class="str"><?=$nokir_biaya3?></td>
							<td><?=$nm_perkiraan_biaya3?></td>
							<td align="right">
								<?=$rp_pYTD_biaya3			= "Rp. " . number_format($pYTD_biaya3,0,',','.');?>
							</td>
							<td align="right">
								<?=
									$rp_cmonth_biaya3		= "Rp. " . number_format($cmonth_biaya3,0,',','.');
								?>
							</td>
							<td align="right">
								<?=
									$rp_YTD_biaya3				= "Rp. " . number_format($YTD_biaya3,0,',','.');
								?>
							</td>		
						</tr>
						<?php
							
							}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA LAIN-LAIN</b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya3_pYTD		= "Rp. " . number_format($SubTotalBiaya3_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya3_cmonth		= "Rp. " . number_format($SubTotalBiaya3_cmonth,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SubTotalBiaya3_YTD		= "Rp. " . number_format($SubTotalBiaya3_YTD,0,',','.');?></b></td>
						</tr>

						<tr>
							<td></td>
							<td align="center"><b>LABA/RUGI BERSIH</b></td>
							<td align="right"><b><?=$rp_SaldoBersih_pYTD		= "Rp. " . number_format($SaldoBersih_pYTD,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SaldoBersih_cmonth		= "Rp. " . number_format($SaldoBersih_cmonth,0,',','.');?></b></td>
							<td align="right"><b><?=$rp_SaldoBersih_YTD		= "Rp. " . number_format($SaldoBersih_YTD,0,',','.');?></b></td>
						</tr>
						<?php
							}
						?>
</table>