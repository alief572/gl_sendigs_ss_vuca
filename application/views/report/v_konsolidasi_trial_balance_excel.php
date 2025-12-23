<style type="text/css"> .str{ mso-number-format:\@; } </style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Konsolidasi_TrialBalance_$data_bulan_post-$data_tahun_post.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda

?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
<tr>
								<?php
								//
												if($data_bulan_post > 0){
														$nm_bln = $data_bulan_post;
														if($nm_bln == 1){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Januari ".$data_tahun_post."</center></th></tr>";															
														}elseif($nm_bln == 2){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Februari ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 3){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Maret ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 4){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : April ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 5){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Mei ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 6){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Juni ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 7){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Juli ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 8){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Agustus ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 9){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : September ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 10){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Oktober ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 11){
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : November ".$data_tahun_post."</center></th></tr>";
														}else{
															echo "<tr><th colspan='6' style='text-align:center;font-size:15px;'><center>KONSOLIDASI TRIAL BALANCE REPORT<br>Periode : Desember ".$data_tahun_post."</center></th></tr>";
														}														
												}
											?>
							</tr>

							<tr>
								<td><center><b>No. Perkiraan</b></center></td>
								<td><center><b>Nama Perkiraan</b></center></td>
								<td><center><b>Saldo Awal</b></center></td>
								<td><center><b>Debet</b></center></td>
								<td><center><b>Kredit</b></center></td>
								<td><center><b>Saldo Akhir</b></center></td>
							</tr>

							<!-- HARTA LANCAR -->
							<tr>
								<td><b>11</b></td>
								<td><b>HARTA LANCAR</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($data_HartaLancar1101 > 0){
									foreach($data_HartaLancar1101 as $row11){

										$nokir_11			= $row11->no_perkiraan;
										$nm_perkiraan_11	= $row11->nama;
										$faktor_11			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_11		= $row11->saldoawal1101;
										$debet_11			= $row11->debet1101;
										$kredit_11			= $row11->kredit1101;										
										
										$saldoakhir_11		= ($saldoawal_11 + $debet_11 - $kredit_11) * $faktor_11;
						?>
						<tr>
							<td><?=$nokir_11?></td>
							<td><?=$nm_perkiraan_11?></td>
							<td align="right"><?=number_format($saldoawal_11,0,',','.');?></td>
							<td align="right"><?=number_format($debet_11,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_11,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_11,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1102 > 0){
									
									foreach($data_HartaLancar1102 as $row11){

										$nokir_1102			= $row11->no_perkiraan;
										$nm_perkiraan_1102	= $row11->nama;
										$faktor_1102			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1102		= $row11->saldoawal1102;
										$debet_1102			= $row11->debet1102;
										$kredit_1102			= $row11->kredit1102;										
										
										$saldoakhir_1102		= ($saldoawal_1102 + $debet_1102 - $kredit_1102) * $faktor_1102;
						?>
						<tr>
							<td><?=$nokir_1102?></td>
							<td><?=$nm_perkiraan_1102?></td>
							<td align="right"><?=number_format($saldoawal_1102,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1102,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1102,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1102,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1104 > 0){
									
									foreach($data_HartaLancar1104 as $row11){

										$nokir_1104			= $row11->no_perkiraan;
										$nm_perkiraan_1104	= $row11->nama;
										$faktor_1104			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1104		= $row11->saldoawal1104;
										$debet_1104			= $row11->debet1104;
										$kredit_1104			= $row11->kredit1104;										
										
										$saldoakhir_1104		= ($saldoawal_1104 + $debet_1104 - $kredit_1104) * $faktor_1104;
						?>
						<tr>
							<td><?=$nokir_1104?></td>
							<td><?=$nm_perkiraan_1104?></td>
							<td align="right"><?=number_format($saldoawal_1104,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1104,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1104,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1104,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1105 > 0){
									
									foreach($data_HartaLancar1105 as $row11){

										$nokir_1105			= $row11->no_perkiraan;
										$nm_perkiraan_1105	= $row11->nama;
										$faktor_1105			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1105		= $row11->saldoawal1105;
										$debet_1105			= $row11->debet1105;
										$kredit_1105			= $row11->kredit1105;										
										
										$saldoakhir_1105		= ($saldoawal_1105 + $debet_1105 - $kredit_1105) * $faktor_1105;
						?>
						<tr>
							<td><?=$nokir_1105?></td>
							<td><?=$nm_perkiraan_1105?></td>
							<td align="right"><?=number_format($saldoawal_1105,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1105,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1105,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1105,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1106 > 0){
									
									foreach($data_HartaLancar1106 as $row11){

										$nokir_1106			= $row11->no_perkiraan;
										$nm_perkiraan_1106	= $row11->nama;
										$faktor_1106			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1106		= $row11->saldoawal1106;
										$debet_1106			= $row11->debet1106;
										$kredit_1106			= $row11->kredit1106;										
										
										$saldoakhir_1106		= ($saldoawal_1106 + $debet_1106 - $kredit_1106) * $faktor_1106;
						?>
						<tr>
							<td><?=$nokir_1106?></td>
							<td><?=$nm_perkiraan_1106?></td>
							<td align="right"><?=number_format($saldoawal_1106,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1106,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1106,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1106,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1107 > 0){
									
									foreach($data_HartaLancar1107 as $row11){

										$nokir_1107			= $row11->no_perkiraan;
										$nm_perkiraan_1107	= $row11->nama;
										$faktor_1107			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1107		= $row11->saldoawal1107;
										$debet_1107			= $row11->debet1107;
										$kredit_1107			= $row11->kredit1107;										
										
										$saldoakhir_1107		= ($saldoawal_1107 + $debet_1107 - $kredit_1107) * $faktor_1107;
						?>
						<tr>
							<td><?=$nokir_1107?></td>
							<td><?=$nm_perkiraan_1107?></td>
							<td align="right"><?=number_format($saldoawal_1107,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1107,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1107,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1107,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1108 > 0){
									
									foreach($data_HartaLancar1108 as $row11){

										$nokir_1108			= $row11->no_perkiraan;
										$nm_perkiraan_1108	= $row11->nama;
										$faktor_1108			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1108		= $row11->saldoawal1108;
										$debet_1108			= $row11->debet1108;
										$kredit_1108			= $row11->kredit1108;										
										
										$saldoakhir_1108		= ($saldoawal_1108 + $debet_1108 - $kredit_1108) * $faktor_1108;
						?>
						<tr>
							<td><?=$nokir_1108?></td>
							<td><?=$nm_perkiraan_1108?></td>
							<td align="right"><?=number_format($saldoawal_1108,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1108,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1108,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1108,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1110 > 0){
									
									foreach($data_HartaLancar1110 as $row11){

										$nokir_1110			= $row11->no_perkiraan;
										$nm_perkiraan_1110	= $row11->nama;
										$faktor_1110			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1110		= $row11->saldoawal1110;
										$debet_1110			= $row11->debet1110;
										$kredit_1110			= $row11->kredit1110;										
										
										$saldoakhir_1110		= ($saldoawal_1110 + $debet_1110 - $kredit_1110) * $faktor_1110;
						?>
						<tr>
							<td><?=$nokir_1110?></td>
							<td><?=$nm_perkiraan_1110?></td>
							<td align="right"><?=number_format($saldoawal_1110,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1110,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1110,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1110,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_HartaLancar1111 > 0){
									$subtotal_saldoawal_11=0;
									$subtotal_debet_11=0;
									$subtotal_kredit_11=0;
									$subtotal_saldoakhir_11=0;
									foreach($data_HartaLancar1111 as $row11){

										$nokir_1111			= $row11->no_perkiraan;
										$nm_perkiraan_1111	= $row11->nama;
										$faktor_1111			= $row11->faktor;
										// $saldoawal_11		= ($row11->saldoawal) * $faktor_11;
										$saldoawal_1111		= $row11->saldoawal1111;
										$debet_1111			= $row11->debet1111;
										$kredit_1111			= $row11->kredit1111;										
										
										$saldoakhir_1111		= ($saldoawal_1111 + $debet_1111 - $kredit_1111) * $faktor_1111;
										
										$subtotal_saldoawal_11	= $saldoawal_11 + $saldoawal_1102 + $saldoawal_1104 + $saldoawal_1105 + $saldoawal_1106 + $saldoawal_1107 + $saldoawal_1108 + $saldoawal_1110 + $saldoawal_1111;

										$subtotal_debet_11		= $debet_11 + $debet_1102 + $debet_1104 + $debet_1105 + $debet_1106 + $debet_1107 + $debet_1108 + $debet_1110 + $debet_1111;

										$subtotal_kredit_11		= $kredit_11 + $kredit_1102 + $kredit_1104 + $kredit_1105 + $kredit_1106 + $kredit_1107 + $kredit_1108 + $kredit_1110 + $kredit_1111;

										$subtotal_saldoakhir_11	= $saldoakhir_11 + $saldoakhir_1102 + $saldoakhir_1104 + $saldoakhir_1105 + $saldoakhir_1106 + $saldoakhir_1107 + $saldoakhir_1108 + $saldoakhir_1110 + $saldoakhir_1111;
						?>
						<tr>
							<td><?=$nokir_1111?></td>
							<td><?=$nm_perkiraan_1111?></td>
							<td align="right"><?=number_format($saldoawal_1111,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1111,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1111,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1111,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total HARTA LANCAR</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_11,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_11,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_11,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_11,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
					
					<!--AKTIVA TETAP -->
					<tr>
								<td><b>13</b></td>
								<td><b>AKTIVA TETAP</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($data_AktivaTetap1301 > 0){
									foreach($data_AktivaTetap1301 as $row1301){

										$nokir_1301			= $row1301->no_perkiraan;
										$nm_perkiraan_1301	= $row1301->nama;
										$faktor_1301			= $row1301->faktor;
										// $saldoawal_1301		= ($row1301->saldoawal) * $faktor_1301;
										$saldoawal_1301		= $row1301->saldoawal1301;
										$debet_1301			= $row1301->debet1301;
										$kredit_1301			= $row1301->kredit1301;										
										
										$saldoakhir_1301		= ($saldoawal_1301 + $debet_1301 - $kredit_1301) * $faktor_1301;
						?>
						<tr>
							<td><?=$nokir_1301?></td>
							<td><?=$nm_perkiraan_1301?></td>
							<td align="right"><?=number_format($saldoawal_1301,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1301,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1301,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1301,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_AktivaTetap1302 > 0){
									foreach($data_AktivaTetap1302 as $row1302){

										$nokir_1302			= $row1302->no_perkiraan;
										$nm_perkiraan_1302	= $row1302->nama;
										$faktor_1302			= $row1302->faktor;
										// $saldoawal_1302		= ($row1302->saldoawal) * $faktor_1302;
										$saldoawal_1302		= $row1302->saldoawal1302;
										$debet_1302			= $row1302->debet1302;
										$kredit_1302			= $row1302->kredit1302;										
										
										$saldoakhir_1302		= ($saldoawal_1302 + $debet_1302 - $kredit_1302) * $faktor_1302;
						?>
						<tr>
							<td><?=$nokir_1302?></td>
							<td><?=$nm_perkiraan_1302?></td>
							<td align="right"><?=number_format($saldoawal_1302,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1302,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1302,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1302,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_AktivaTetap1303 > 0){
									foreach($data_AktivaTetap1303 as $row1303){

										$nokir_1303			= $row1303->no_perkiraan;
										$nm_perkiraan_1303	= $row1303->nama;
										$faktor_1303			= $row1303->faktor;
										// $saldoawal_1303		= ($row1303->saldoawal) * $faktor_1303;
										$saldoawal_1303		= $row1303->saldoawal1303;
										$debet_1303			= $row1303->debet1303;
										$kredit_1303			= $row1303->kredit1303;										
										
										$saldoakhir_1303		= ($saldoawal_1303 + $debet_1303 - $kredit_1303) * $faktor_1303;
						?>
						<tr>
							<td><?=$nokir_1303?></td>
							<td><?=$nm_perkiraan_1303?></td>
							<td align="right"><?=number_format($saldoawal_1303,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1303,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1303,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1303,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_AktivaTetap1304 > 0){
									foreach($data_AktivaTetap1304 as $row1304){

										$nokir_1304			= $row1304->no_perkiraan;
										$nm_perkiraan_1304	= $row1304->nama;
										$faktor_1304			= $row1304->faktor;
										// $saldoawal_1304		= ($row1304->saldoawal) * $faktor_1304;
										$saldoawal_1304		= $row1304->saldoawal1304;
										$debet_1304			= $row1304->debet1304;
										$kredit_1304			= $row1304->kredit1304;										
										
										$saldoakhir_1304		= ($saldoawal_1304 + $debet_1304 - $kredit_1304) * $faktor_1304;
						?>
						<tr>
							<td><?=$nokir_1304?></td>
							<td><?=$nm_perkiraan_1304?></td>
							<td align="right"><?=number_format($saldoawal_1304,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1304,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1304,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1304,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_AktivaTetap1305 > 0){
									foreach($data_AktivaTetap1305 as $row1305){

										$nokir_1305			= $row1305->no_perkiraan;
										$nm_perkiraan_1305	= $row1305->nama;
										$faktor_1305			= $row1305->faktor;
										// $saldoawal_1305		= ($row1305->saldoawal) * $faktor_1305;
										$saldoawal_1305		= $row1305->saldoawal1305;
										$debet_1305			= $row1305->debet1305;
										$kredit_1305			= $row1305->kredit1305;										
										
										$saldoakhir_1305		= ($saldoawal_1305 + $debet_1305 - $kredit_1305) * $faktor_1305;
						?>
						<tr>
							<td><?=$nokir_1305?></td>
							<td><?=$nm_perkiraan_1305?></td>
							<td align="right"><?=number_format($saldoawal_1305,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1305,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1305,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1305,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_AktivaTetap1306 > 0){
									foreach($data_AktivaTetap1306 as $row1306){

										$nokir_1306			= $row1306->no_perkiraan;
										$nm_perkiraan_1306	= $row1306->nama;
										$faktor_1306			= $row1306->faktor;
										// $saldoawal_1306		= ($row1306->saldoawal) * $faktor_1306;
										$saldoawal_1306		= $row1306->saldoawal1306;
										$debet_1306			= $row1306->debet1306;
										$kredit_1306			= $row1306->kredit1306;										
										
										$saldoakhir_1306		= ($saldoawal_1306 + $debet_1306 - $kredit_1306) * $faktor_1306;
						?>
						<tr>
							<td><?=$nokir_1306?></td>
							<td><?=$nm_perkiraan_1306?></td>
							<td align="right"><?=number_format($saldoawal_1306,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1306,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1306,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1306,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_AktivaTetap1307 > 0){
									foreach($data_AktivaTetap1307 as $row1307){

										$nokir_1307			= $row1307->no_perkiraan;
										$nm_perkiraan_1307	= $row1307->nama;
										$faktor_1307			= $row1307->faktor;
										// $saldoawal_1307		= ($row1307->saldoawal) * $faktor_1307;
										$saldoawal_1307		= $row1307->saldoawal1307;
										$debet_1307			= $row1307->debet1307;
										$kredit_1307			= $row1307->kredit1307;										
										
										$saldoakhir_1307		= ($saldoawal_1307 + $debet_1307 - $kredit_1307) * $faktor_1307;
						?>
						<tr>
							<td><?=$nokir_1307?></td>
							<td><?=$nm_perkiraan_1307?></td>
							<td align="right"><?=number_format($saldoawal_1307,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1307,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1307,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1307,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_AktivaTetap1309 > 0){
									$subtotal_saldoawal_13=0;
									$subtotal_debet_13=0;
									$subtotal_kredit_13=0;
									$subtotal_saldoakhir_13=0;

									foreach($data_AktivaTetap1309 as $row1309){

										$nokir_1309			= $row1309->no_perkiraan;
										$nm_perkiraan_1309	= $row1309->nama;
										$faktor_1309			= $row1309->faktor;
										// $saldoawal_1309		= ($row1309->saldoawal) * $faktor_1309;
										$saldoawal_1309		= $row1309->saldoawal1309;
										$debet_1309			= $row1309->debet1309;
										$kredit_1309			= $row1309->kredit1309;										
										
										$saldoakhir_1309		= ($saldoawal_1309 + $debet_1309 - $kredit_1309) * $faktor_1309;

										$subtotal_saldoawal_13	= $saldoawal_1301 + $saldoawal_1302 + $saldoawal_1303 + $saldoawal_1304 + $saldoawal_1305 + $saldoawal_1306 + $saldoawal_1307 + $saldoawal_1309;

										$subtotal_debet_13		= $debet_1301 + $debet_1302 + $debet_1303 + $debet_1304 + $debet_1305 + $debet_1306 + $debet_1307 + $debet_1309;

										$subtotal_kredit_13		= $kredit_1301 + $kredit_1302 + $kredit_1303 + $kredit_1304 + $kredit_1305 + $kredit_1306 + $kredit_1307 + $kredit_1309;

										$subtotal_saldoakhir_13	= $saldoakhir_1301 + $saldoakhir_1302 + $saldoakhir_1303 + $saldoakhir_1304 + $saldoakhir_1305 + $saldoakhir_1306 + $saldoakhir_1307 + $saldoakhir_1309;
						?>
						<tr>
							<td><?=$nokir_1309?></td>
							<td><?=$nm_perkiraan_1309?></td>
							<td align="right"><?=number_format($saldoawal_1309,0,',','.');?></td>
							<td align="right"><?=number_format($debet_1309,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_1309,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_1309,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total AKTIVA TETAP</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_13,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_13,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_13,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_13,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
					<!--AKTIVA LAIN-LAIN -->
					<tr>
								<td><b>19</b></td>
								<td><b>AKTIVA LAIN-LAIN</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($data_AktivaLain > 0){
									$subtotal_saldoawal_19=0;
									$subtotal_debet_19=0;
									$subtotal_kredit_19=0;
									$subtotal_saldoakhir_19=0;

									foreach($data_AktivaLain as $row19){

										$nokir_19			= $row19->no_perkiraan;
										$nm_perkiraan_19	= $row19->nama;
										$faktor_19			= $row19->faktor;
										// $saldoawal_19		= ($row19->saldoawal) * $faktor_19;
										$saldoawal_19		= $row19->saldoawal19;
										$debet_19			= $row19->debet19;
										$kredit_19			= $row19->kredit19;										
										
										$saldoakhir_19		= ($saldoawal_19 + $debet_19 - $kredit_19) * $faktor_19;

										$subtotal_saldoawal_19	+= $saldoawal_19;
										$subtotal_debet_19		+= $debet_19;
										$subtotal_kredit_19		+= $kredit_19;
										$subtotal_saldoakhir_19	+= $saldoakhir_19;
						?>
						<tr>
							<td><?=$nokir_19?></td>
							<td><?=$nm_perkiraan_19?></td>
							<td align="right"><?=number_format($saldoawal_19,0,',','.');?></td>
							<td align="right"><?=number_format($debet_19,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_19,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_19,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total AKTIVA LAIN-LAIN</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_19,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_19,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_19,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_19,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--TOTAL AKTIVA-->

							<?php
								if($data_nokir_totalaktiva > 0){
									$subtotal_saldoawal_totalaktiva=0;
									$subtotal_debet_totalaktiva=0;
									$subtotal_kredit_totalaktiva=0;
									$subtotal_saldoakhir_totalaktiva=0;

									foreach($data_nokir_totalaktiva as $rowtotalaktiva){
										$faktor_totalaktiva			= $rowtotalaktiva->faktor;
										$saldoawal_totalaktiva		= ($rowtotalaktiva->tot_aktiva_saldoawal) * $faktor_totalaktiva;
										$debet_totalaktiva			= $rowtotalaktiva->tot_aktiva_debet;
										$kredit_totalaktiva			= $rowtotalaktiva->tot_aktiva_kredit;
										
										$saldoakhir_totalaktiva		= ($saldoawal_totalaktiva + $debet_totalaktiva - $kredit_totalaktiva) * $faktor_totalaktiva;
						?>
						<tr>
							<td></td>
							<td align="center"><b>TOTAL AKTIVA</b></td>
							<td align="right"><?=number_format($saldoawal_totalaktiva,0,',','.');?></td>
							<td align="right"><?=number_format($debet_totalaktiva,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_totalaktiva,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_totalaktiva,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--HUTANG -->
				<tr>
								<td><b>21</b></td>
								<td><b>HUTANG</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($data_Hutang2101 > 0){
									
									foreach($data_Hutang2101 as $row2101){

										$nokir_2101			= $row2101->no_perkiraan;
										$nm_perkiraan_2101	= $row2101->nama;
										$faktor_2101			= $row2101->faktor;
										// $saldoawal_2101		= ($row2101->saldoawal) * $faktor_2101;
										$saldoawal_2101		= $row2101->saldoawal2101;
										$debet_2101			= $row2101->debet2101;
										$kredit_2101			= $row2101->kredit2101;										
										
										$saldoakhir_2101		= ($saldoawal_2101 + $debet_2101 - $kredit_2101) * $faktor_2101;
						?>
						<tr>
							<td><?=$nokir_2101?></td>
							<td><?=$nm_perkiraan_2101?></td>
							<td align="right"><?=number_format($saldoawal_2101,0,',','.');?></td>
							<td align="right"><?=number_format($debet_2101,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_2101,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_2101,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_Hutang2102 > 0){
									
									foreach($data_Hutang2102 as $row2102){

										$nokir_2102			= $row2102->no_perkiraan;
										$nm_perkiraan_2102	= $row2102->nama;
										$faktor_2102			= $row2102->faktor;
										// $saldoawal_2102		= ($row2102->saldoawal) * $faktor_2102;
										$saldoawal_2102		= $row2102->saldoawal2102;
										$debet_2102			= $row2102->debet2102;
										$kredit_2102			= $row2102->kredit2102;										
										
										$saldoakhir_2102		= ($saldoawal_2102 + $debet_2102 - $kredit_2102) * $faktor_2102;
						?>
						<tr>
							<td><?=$nokir_2102?></td>
							<td><?=$nm_perkiraan_2102?></td>
							<td align="right"><?=number_format($saldoawal_2102,0,',','.');?></td>
							<td align="right"><?=number_format($debet_2102,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_2102,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_2102,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_Hutang2107 > 0){
									
									foreach($data_Hutang2107 as $row2107){

										$nokir_2107			= $row2107->no_perkiraan;
										$nm_perkiraan_2107	= $row2107->nama;
										$faktor_2107			= $row2107->faktor;
										// $saldoawal_2107		= ($row2107->saldoawal) * $faktor_2107;
										$saldoawal_2107		= $row2107->saldoawal2107;
										$debet_2107			= $row2107->debet2107;
										$kredit_2107			= $row2107->kredit2107;										
										
										$saldoakhir_2107		= ($saldoawal_2107 + $debet_2107 - $kredit_2107) * $faktor_2107;
						?>
						<tr>
							<td><?=$nokir_2107?></td>
							<td><?=$nm_perkiraan_2107?></td>
							<td align="right"><?=number_format($saldoawal_2107,0,',','.');?></td>
							<td align="right"><?=number_format($debet_2107,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_2107,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_2107,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_Hutang2108 > 0){
									$subtotal_saldoawal_21=0;
									$subtotal_debet_21=0;
									$subtotal_kredit_21=0;
									$subtotal_saldoakhir_21=0;

									foreach($data_Hutang2108 as $row2108){

										$nokir_2108			= $row2108->no_perkiraan;
										$nm_perkiraan_2108	= $row2108->nama;
										$faktor_2108			= $row2108->faktor;
										// $saldoawal_2108		= ($row2108->saldoawal) * $faktor_2108;
										$saldoawal_2108		= $row2108->saldoawal2108;
										$debet_2108			= $row2108->debet2108;
										$kredit_2108			= $row2108->kredit2108;										
										
										$saldoakhir_2108		= ($saldoawal_2108 + $debet_2108 - $kredit_2108) * $faktor_2108;

										$subtotal_saldoawal_21	= $saldoawal_2101 + $saldoawal_2102 + $saldoawal_2107 + $saldoawal_2108;
										$subtotal_debet_21		= $debet_2101 + $debet_2102 + $debet_2107 + $debet_2108;
										$subtotal_kredit_21		= $kredit_2101 + $kredit_2102 + $kredit_2107 + $kredit_2108;
										$subtotal_saldoakhir_21	= $saldoakhir_2101 + $saldoakhir_2102 + $saldoakhir_2107 + $saldoakhir_2108;
						?>
						<tr>
							<td><?=$nokir_2108?></td>
							<td><?=$nm_perkiraan_2108?></td>
							<td align="right"><?=number_format($saldoawal_2108,0,',','.');?></td>
							<td align="right"><?=number_format($debet_2108,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_2108,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_2108,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total HUTANG</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_21,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_21,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_21,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_21,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

				<!--MODAL -->
				<tr>
								<td><b>32</b></td>
								<td><b>MODAL</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($data_Modal > 0){
									$subtotal_saldoawal_32=0;
									$subtotal_debet_32=0;
									$subtotal_kredit_32=0;
									$subtotal_saldoakhir_32=0;

									foreach($data_Modal as $row32){

										$nokir_32			= $row32->no_perkiraan;
										$nm_perkiraan_32	= $row32->nama;
										$faktor_32			= $row32->faktor;
										$saldoawal_32		= ($row32->saldoawal) * $faktor_32;
										$debet_32			= $row32->debet;
										$kredit_32			= $row32->kredit;										
										
										$saldoakhir_32		= ($saldoawal_32 + $debet_32 - $kredit_32) * $faktor_32;

										$subtotal_saldoawal_32	+= $saldoawal_32;
										$subtotal_debet_32		+= $debet_32;
										$subtotal_kredit_32		+= $kredit_32;
										$subtotal_saldoakhir_32	+= $saldoakhir_32;
						?>
						<tr>
							<td><?=$nokir_32?></td>
							<td><?=$nm_perkiraan_32?></td>
							<td align="right"><?=number_format($saldoawal_32,0,',','.');?></td>
							<td align="right"><?=number_format($debet_32,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_32,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_32,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total MODAL</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_32,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_32,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_32,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_32,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--LABA -->
				<tr>
								<td><b>39</b></td>
								<td><b>LABA</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($data_Laba3901 > 0){
									
									foreach($data_Laba3901 as $row3901){

										$nokir_3901			= $row3901->no_perkiraan;
										$nm_perkiraan_3901	= $row3901->nama;
										$faktor_3901			= $row3901->faktor;
										// $saldoawal_3901		= ($row3901->saldoawal) * $faktor_3901;
										$saldoawal_3901		= $row3901->saldoawal3901;
										$debet_3901			= $row3901->debet3901;
										$kredit_3901			= $row3901->kredit3901;										
										
										$saldoakhir_3901		= ($saldoawal_3901 + $debet_3901 - $kredit_3901) * $faktor_3901;
						?>
						<tr>
							<td><?=$nokir_3901?></td>
							<td><?=$nm_perkiraan_3901?></td>
							<td align="right"><?=number_format($saldoawal_3901,0,',','.');?></td>
							<td align="right"><?=number_format($debet_3901,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_3901,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_3901,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_Laba3902 > 0){
									
									foreach($data_Laba3902 as $row3902){

										$nokir_3902			= $row3902->no_perkiraan;
										$nm_perkiraan_3902	= $row3902->nama;
										$faktor_3902			= $row3902->faktor;
										// $saldoawal_3902		= ($row3902->saldoawal) * $faktor_3902;
										$saldoawal_3902		= $row3902->saldoawal3902;
										$debet_3902			= $row3902->debet3902;
										$kredit_3902			= $row3902->kredit3902;										
										
										$saldoakhir_3902		= ($saldoawal_3902 + $debet_3902 - $kredit_3902) * $faktor_3902;
						?>
						<tr>
							<td><?=$nokir_3902?></td>
							<td><?=$nm_perkiraan_3902?></td>
							<td align="right"><?=number_format($saldoawal_3902,0,',','.');?></td>
							<td align="right"><?=number_format($debet_3902,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_3902,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_3902,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($data_Laba3903 > 0){
									$subtotal_saldoawal_39=0;
									$subtotal_debet_39=0;
									$subtotal_kredit_39=0;
									$subtotal_saldoakhir_39=0;

									foreach($data_Laba3903 as $row3903){

										$nokir_3903			= $row3903->no_perkiraan;
										$nm_perkiraan_3903	= $row3903->nama;
										$faktor_3903			= $row3903->faktor;
										// $saldoawal_3903		= ($row3903->saldoawal) * $faktor_3903;
										$saldoawal_3903		= $row3903->saldoawal3903;
										$debet_3903			= $row3903->debet3903;
										$kredit_3903			= $row3903->kredit3903;										
										
										$saldoakhir_3903		= ($saldoawal_3903 + $debet_3903 - $kredit_3903) * $faktor_3903;

										$subtotal_saldoawal_39	= $saldoawal_3901 + $saldoawal_3902 + $saldoawal_3903;
										$subtotal_debet_39		= $debet_3901 + $debet_3902 + $debet_3903;
										$subtotal_kredit_39		= $kredit_3901 + $kredit_3902 + $kredit_3903;
										$subtotal_saldoakhir_39	= $saldoakhir_3901 + $saldoakhir_3902 + $saldoakhir_3903;
						?>
						<tr>
							<td><?=$nokir_3903?></td>
							<td><?=$nm_perkiraan_3903?></td>
							<td align="right"><?=number_format($saldoawal_3903,0,',','.');?></td>
							<td align="right"><?=number_format($debet_3903,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_3903,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_3903,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total LABA</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_39,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_39,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_39,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_39,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--TOTAL PASSIVA-->

				<?php
								if($data_nokir_totalpassiva > 0){
									$subtotal_saldoawal_totalpassiva=0;
									$subtotal_debet_totalpassiva=0;
									$subtotal_kredit_totalpassiva=0;
									$subtotal_saldoakhir_totalpassiva=0;

									foreach($data_nokir_totalpassiva as $rowtotalpassiva){
										$faktor_totalpassiva		= $rowtotalpassiva->faktor;
										$saldoawal_totalpassiva		= ($rowtotalpassiva->tot_passiva_saldoawal) * $faktor_totalpassiva;
										$debet_totalpassiva			= $rowtotalpassiva->tot_passiva_debet;
										$kredit_totalpassiva		= $rowtotalpassiva->tot_passiva_kredit;
										
										$saldoakhir_totalpassiva	= ($saldoawal_totalpassiva + $debet_totalpassiva - $kredit_totalpassiva) * $faktor_totalpassiva;
						?>
						<tr>
							<td></td>
							<td align="center"><b>TOTAL PASSIVA</b></td>
							<td align="right"><?=number_format($saldoawal_totalpassiva,0,',','.');?></td>
							<td align="right"><?=number_format($debet_totalpassiva,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_totalpassiva,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_totalpassiva,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--PENDAPATAN -->
				<tr>
								<td><b>41</b></td>
								<td><b>PENDAPATAN</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_41_konsolidasi > 0){
									$subtotal_saldoawal_41=0;
									$subtotal_debet_41=0;
									$subtotal_kredit_41=0;
									$subtotal_saldoakhir_41=0;

									foreach($nokir_41_konsolidasi as $row41){

										$nokir_41			= $row41->no_perkiraan;
										$nm_perkiraan_41	= $row41->nama;
										$faktor_41			= $row41->faktor;
										$saldoawal_41		= $row41->saldoawal41;
										$debet_41			= $row41->debet41;
										$kredit_41			= $row41->kredit41;										
										
										$saldoakhir_41		= ($saldoawal_41 + $debet_41 - $kredit_41) * $faktor_41;

										$subtotal_saldoawal_41	+= $saldoawal_41;
										$subtotal_debet_41		+= $debet_41;
										$subtotal_kredit_41		+= $kredit_41;
										$subtotal_saldoakhir_41	+= $saldoakhir_41;
						?>
						<tr>
							<td><?=$nokir_41?></td>
							<td><?=$nm_perkiraan_41?></td>
							<td align="right"><?=number_format($saldoawal_41,0,',','.');?></td>
							<td align="right"><?=number_format($debet_41,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_41,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_41,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total LABA</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_41,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_41,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_41,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_41,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--HARGA POKOK PENJUALAN -->
				<tr>
								<td><b>51</b></td>
								<td><b>HARGA POKOK PENJUALAN</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_51_konsolidasi > 0){
									$subtotal_saldoawal_51=0;
									$subtotal_debet_51=0;
									$subtotal_kredit_51=0;
									$subtotal_saldoakhir_51=0;

									foreach($nokir_51_konsolidasi as $row51){

										$nokir_51			= $row51->no_perkiraan;
										$nm_perkiraan_51	= $row51->nama;
										$faktor_51			= $row51->faktor;
										$saldoawal_51		= $row51->saldoawal51;
										$debet_51			= $row51->debet51;
										$kredit_51			= $row51->kredit51;										
										
										$saldoakhir_51		= ($saldoawal_51 + $debet_51 - $kredit_51) * $faktor_51;

										$subtotal_saldoawal_51	+= $saldoawal_51;
										$subtotal_debet_51		+= $debet_51;
										$subtotal_kredit_51		+= $kredit_51;
										$subtotal_saldoakhir_51	+= $saldoakhir_51;
						?>
						<tr>
							<td><?=$nokir_51?></td>
							<td><?=$nm_perkiraan_51?></td>
							<td align="right"><?=number_format($saldoawal_51,0,',','.');?></td>
							<td align="right"><?=number_format($debet_51,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_51,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_51,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total HARGA POKOK PENJUALAN</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_51,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_51,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_51,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_51,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--BIAYA PENJUALAN -->
				<tr>
								<td><b>61</b></td>
								<td><b>BIAYA PENJUALAN</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_61_konsolidasi > 0){
									$subtotal_saldoawal_61=0;
									$subtotal_debet_61=0;
									$subtotal_kredit_61=0;
									$subtotal_saldoakhir_61=0;

									foreach($nokir_61_konsolidasi as $row61){

										$nokir_61			= $row61->no_perkiraan;
										$nm_perkiraan_61	= $row61->nama;
										$faktor_61			= $row61->faktor;
										$saldoawal_61		= $row61->saldoawal61;
										$debet_61			= $row61->debet61;
										$kredit_61			= $row61->kredit61;										
										
										$saldoakhir_61		= ($saldoawal_61 + $debet_61 - $kredit_61) * $faktor_61;

										$subtotal_saldoawal_61	+= $saldoawal_61;
										$subtotal_debet_61		+= $debet_61;
										$subtotal_kredit_61		+= $kredit_61;
										$subtotal_saldoakhir_61	+= $saldoakhir_61;
						?>
						<tr>
							<td><?=$nokir_61?></td>
							<td><?=$nm_perkiraan_61?></td>
							<td align="right"><?=number_format($saldoawal_61,0,',','.');?></td>
							<td align="right"><?=number_format($debet_61,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_61,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_61,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total BIAYA PENJUALAN</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_61,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_61,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_61,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_61,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--BIAYA KANTOR DAN UMUM -->
				<tr>
								<td><b>68</b></td>
								<td><b>BIAYA KANTOR DAN UMUM</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_6811_konsolidasi > 0){
									
									foreach($nokir_6811_konsolidasi as $row6811){

										$nokir_6811			= $row6811->no_perkiraan;
										$nm_perkiraan_6811	= $row6811->nama;
										$faktor_6811			= $row6811->faktor;
										$saldoawal_6811		= $row6811->saldoawal6811;
										$debet_6811			= $row6811->debet6811;
										$kredit_6811			= $row6811->kredit6811;										
										
										$saldoakhir_6811		= ($saldoawal_6811 + $debet_6811 - $kredit_6811) * $faktor_6811;
						?>
						<tr>
							<td><?=$nokir_6811?></td>
							<td><?=$nm_perkiraan_6811?></td>
							<td align="right"><?=number_format($saldoawal_6811,0,',','.');?></td>
							<td align="right"><?=number_format($debet_6811,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_6811,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_6811,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($nokir_6821_konsolidasi > 0){
									
									foreach($nokir_6821_konsolidasi as $row6821){

										$nokir_6821			= $row6821->no_perkiraan;
										$nm_perkiraan_6821	= $row6821->nama;
										$faktor_6821			= $row6821->faktor;
										$saldoawal_6821		= $row6821->saldoawal6821;
										$debet_6821			= $row6821->debet6821;
										$kredit_6821			= $row6821->kredit6821;										
										
										$saldoakhir_6821		= ($saldoawal_6821 + $debet_6821 - $kredit_6821) * $faktor_6821;
						?>
						<tr>
							<td><?=$nokir_6821?></td>
							<td><?=$nm_perkiraan_6821?></td>
							<td align="right"><?=number_format($saldoawal_6821,0,',','.');?></td>
							<td align="right"><?=number_format($debet_6821,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_6821,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_6821,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<?php
								if($nokir_6831_konsolidasi > 0){
									$subtotal_saldoawal_68=0;
									$subtotal_debet_68=0;
									$subtotal_kredit_68=0;
									$subtotal_saldoakhir_68=0;

									foreach($nokir_6831_konsolidasi as $row6831){

										$nokir_6831			= $row6831->no_perkiraan;
										$nm_perkiraan_6831	= $row6831->nama;
										$faktor_6831			= $row6831->faktor;
										$saldoawal_6831		= $row6831->saldoawal6831;
										$debet_6831			= $row6831->debet6831;
										$kredit_6831			= $row6831->kredit6831;										
										
										$saldoakhir_6831		= ($saldoawal_6831 + $debet_6831 - $kredit_6831) * $faktor_6831;

										$subtotal_saldoawal_68	= $saldoawal_6811 + $saldoawal_6821 + $saldoawal_6831;
										$subtotal_debet_68		= $debet_6811 + $debet_6821 + $debet_6831;
										$subtotal_kredit_68		= $kredit_6811 + $kredit_6821 + $kredit_6831;
										$subtotal_saldoakhir_68	= $saldoakhir_6811 + $saldoakhir_6821 + $saldoakhir_6831;
						?>
						<tr>
							<td><?=$nokir_6831?></td>
							<td><?=$nm_perkiraan_6831?></td>
							<td align="right"><?=number_format($saldoawal_6831,0,',','.');?></td>
							<td align="right"><?=number_format($debet_6831,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_6831,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_6831,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total BIAYA KANTOR DAN UMUM</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_68,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_68,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_68,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_68,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
<!--PENDAPATAN LAIN-LAIN -->
<tr>
								<td><b>71</b></td>
								<td><b>PENDAPATAN LAIN-LAIN</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_71_konsolidasi > 0){
									$subtotal_saldoawal_71=0;
									$subtotal_debet_71=0;
									$subtotal_kredit_71=0;
									$subtotal_saldoakhir_71=0;

									foreach($nokir_71_konsolidasi as $row71){

										$nokir_71			= $row71->no_perkiraan;
										$nm_perkiraan_71	= $row71->nama;
										$faktor_71			= $row71->faktor;
										$saldoawal_71		= $row71->saldoawal71;
										$debet_71			= $row71->debet71;
										$kredit_71			= $row71->kredit71;										
										
										$saldoakhir_71		= ($saldoawal_71 + $debet_71 - $kredit_71) * $faktor_71;

										$subtotal_saldoawal_71	+= $saldoawal_71;
										$subtotal_debet_71		+= $debet_71;
										$subtotal_kredit_71		+= $kredit_71;
										$subtotal_saldoakhir_71	+= $saldoakhir_71;
						?>
						<tr>
							<td><?=$nokir_71?></td>
							<td><?=$nm_perkiraan_71?></td>
							<td align="right"><?=number_format($saldoawal_71,0,',','.');?></td>
							<td align="right"><?=number_format($debet_71,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_71,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_71,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total PENDAPATAN LAIN-LAIN</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_71,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_71,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_71,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_71,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
<!--BIAYA ADMINISTRASI BANK -->
<tr>
								<td><b>71</b></td>
								<td><b>BIAYA ADMINISTRASI BANK</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_72_konsolidasi > 0){
									$subtotal_saldoawal_72=0;
									$subtotal_debet_72=0;
									$subtotal_kredit_72=0;
									$subtotal_saldoakhir_72=0;

									foreach($nokir_72_konsolidasi as $row72){

										$nokir_72			= $row72->no_perkiraan;
										$nm_perkiraan_72	= $row72->nama;
										$faktor_72			= $row72->faktor;
										$saldoawal_72		= $row72->saldoawal72;
										$debet_72			= $row72->debet72;
										$kredit_72			= $row72->kredit72;										
										
										$saldoakhir_72		= ($saldoawal_72 + $debet_72 - $kredit_72) * $faktor_72;

										$subtotal_saldoawal_72	+= $saldoawal_72;
										$subtotal_debet_72		+= $debet_72;
										$subtotal_kredit_72		+= $kredit_72;
										$subtotal_saldoakhir_72	+= $saldoakhir_72;
						?>
						<tr>
							<td><?=$nokir_72?></td>
							<td><?=$nm_perkiraan_72?></td>
							<td align="right"><?=number_format($saldoawal_72,0,',','.');?></td>
							<td align="right"><?=number_format($debet_72,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_72,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_72,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total BIAYA ADMINISTRASI BANK</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_72,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_72,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_72,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_72,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--TAKSIRAN PAJAK -->
				<tr>
								<td><b>91</b></td>
								<td><b>TAKSIRAN PAJAK</b></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<?php
								if($nokir_91_konsolidasi > 0){
									$subtotal_saldoawal_91=0;
									$subtotal_debet_91=0;
									$subtotal_kredit_91=0;
									$subtotal_saldoakhir_91=0;

									foreach($nokir_91_konsolidasi as $row91){

										$nokir_91			= $row91->no_perkiraan;
										$nm_perkiraan_91	= $row91->nama;
										$faktor_91			= $row91->faktor;
										$saldoawal_91		= $row91->saldoawal91;
										$debet_91			= $row91->debet91;
										$kredit_91			= $row91->kredit91;										
										
										$saldoakhir_91		= ($saldoawal_91 + $debet_91 - $kredit_91) * $faktor_91;

										$subtotal_saldoawal_91	+= $saldoawal_91;
										$subtotal_debet_91		+= $debet_91;
										$subtotal_kredit_91		+= $kredit_91;
										$subtotal_saldoakhir_91	+= $saldoakhir_91;
						?>
						<tr>
							<td><?=$nokir_91?></td>
							<td><?=$nm_perkiraan_91?></td>
							<td align="right"><?=number_format($saldoawal_91,0,',','.');?></td>
							<td align="right"><?=number_format($debet_91,0,',','.');?></td>
							<td align="right"><?=number_format($kredit_91,0,',','.');?></td>
							<td align="right"><?=number_format($saldoakhir_91,0,',','.');?></td>			
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td align="right"><b>Sub Total TAKSIRAN PAJAK</b></td>
							<td align="right"><b><?=number_format($subtotal_saldoawal_91,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_debet_91,0,',','.');?></b></td>
							<td align="right"><b><?=number_format($subtotal_kredit_91,0,',','.');?></b></td>	
							<td align="right"><b><?=number_format($subtotal_saldoakhir_91,0,',','.');?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
				<!--IKHTISAR LABA/RUGI-->

				<?php
								if($data_nokir_4 > 0){									
									foreach($data_nokir_4 as $rowtotal_nokir_4){
										$faktor_total_nokir_4		= $rowtotal_nokir_4->faktor;
										$saldoawal_total_nokir_4	= ($rowtotal_nokir_4->tot_nokir_4_saldoawal) * $faktor_total_nokir_4;
										$debet_total_nokir_4		= $rowtotal_nokir_4->tot_nokir_4_debet;
										$kredit_total_nokir_4		= $rowtotal_nokir_4->tot_nokir_4_kredit;
									}
								}
								if($data_nokir_5 > 0){
									foreach($data_nokir_5 as $rowtotal_nokir_5){
										$faktor_total_nokir_5		= $rowtotal_nokir_5->faktor;
										$saldoawal_total_nokir_5	= ($rowtotal_nokir_5->tot_nokir_5_saldoawal) * $faktor_total_nokir_5;
										$debet_total_nokir_5		= $rowtotal_nokir_5->tot_nokir_5_debet;
										$kredit_total_nokir_5		= $rowtotal_nokir_5->tot_nokir_5_kredit;
									}
								}
								if($data_nokir_6 > 0){
									foreach($data_nokir_6 as $rowtotal_nokir_6){
										$faktor_total_nokir_6		= $rowtotal_nokir_6->faktor;
										$saldoawal_total_nokir_6	= ($rowtotal_nokir_6->tot_nokir_6_saldoawal) * $faktor_total_nokir_6;
										$debet_total_nokir_6		= $rowtotal_nokir_6->tot_nokir_6_debet;
										$kredit_total_nokir_6		= $rowtotal_nokir_6->tot_nokir_6_kredit;
									}
								}
								if($data_nokir_71 > 0){
									foreach($data_nokir_71 as $rowtotal_nokir_71){
										$faktor_total_nokir_71		= $rowtotal_nokir_71->faktor;
										$saldoawal_total_nokir_71	= ($rowtotal_nokir_71->tot_nokir_71_saldoawal) * $faktor_total_nokir_71;
										$debet_total_nokir_71		= $rowtotal_nokir_71->tot_nokir_71_debet;
										$kredit_total_nokir_71		= $rowtotal_nokir_71->tot_nokir_71_kredit;
									}
								}
								if($data_nokir_72 > 0){
									foreach($data_nokir_72 as $rowtotal_nokir_72){
										$faktor_total_nokir_72		= $rowtotal_nokir_72->faktor;
										$saldoawal_total_nokir_72	= ($rowtotal_nokir_72->tot_nokir_72_saldoawal) * $faktor_total_nokir_72;
										$debet_total_nokir_72		= $rowtotal_nokir_72->tot_nokir_72_debet;
										$kredit_total_nokir_72		= $rowtotal_nokir_72->tot_nokir_72_kredit;
									}
								}
								if($data_nokir_9 > 0){
									foreach($data_nokir_9 as $rowtotal_nokir_9){
										$faktor_total_nokir_9		= $rowtotal_nokir_9->faktor;
										$saldoawal_total_nokir_9	= ($rowtotal_nokir_9->tot_nokir_9_saldoawal) * $faktor_total_nokir_9;
										$debet_total_nokir_9		= $rowtotal_nokir_9->tot_nokir_9_debet;
										$kredit_total_nokir_9		= $rowtotal_nokir_9->tot_nokir_9_kredit;
									}
								}

								$grandtot_saldoawal		=	($saldoawal_total_nokir_4 - $saldoawal_total_nokir_5 - $saldoawal_total_nokir_6) + ($saldoawal_total_nokir_71 - $saldoawal_total_nokir_72 - $saldoawal_total_nokir_9);

								$grandtot_debet			=	($debet_total_nokir_4 - $debet_total_nokir_5 - $debet_total_nokir_6) + ($debet_total_nokir_71 - $debet_total_nokir_72 - $debet_total_nokir_9);

								$grandtot_kredit		=	($kredit_total_nokir_4 - $kredit_total_nokir_5 - $kredit_total_nokir_6) + ($kredit_total_nokir_71 - $kredit_total_nokir_72 - $kredit_total_nokir_9);

								$grandtot_saldoakhir	=	$grandtot_saldoawal + $grandtot_debet - $grandtot_kredit;
						?>
						<tr>
							<td><b>IKHTISAR LABA/RUGI</b></td>
							<td align="center"></td>
							<td align="right"></td>
							<td align="right"></td>
							<td align="right"></td>
							<td align="right"></td>			
						</tr>
						<tr>
							<td></td>
							<td align="right"><b>GRAND TOTAL</b></td>
							<td align="right"><?=number_format($grandtot_saldoawal,0,',','.');?></td>
							<td align="right"><?=number_format($grandtot_debet,0,',','.');?></td>
							<td align="right"><?=number_format($grandtot_kredit,0,',','.');?></td>
							<td align="right"><?=number_format($grandtot_saldoakhir,0,',','.');?></td>			
						</tr>
						<?php
							
						?>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

</table>