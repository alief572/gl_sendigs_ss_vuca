    <style type="text/css">
    	.str {
    		mso-number-format: \@;
    	}
    </style>
    <?php
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=Laporan_Performance_Konsolidasi_$data_bulan_post-$data_tahun_post.xls"); //ganti nama sesuai keperluan
	header("Pragma: no-cache");
	header("Expires: 0");
	//disini script laporan anda

	?>
    <table width='50%' border="1" cellpadding="5" cellspacing="0">
    	<?php
		//
		if ($data_bulan_post > 0) {
			$nm_bln = $data_bulan_post;
			if ($nm_bln == 1) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br>Periode : Januari " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 2) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Februari " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 3) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Maret " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 4) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : April " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 5) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Mei " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 6) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Juni " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 7) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Juli " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 8) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Agustus " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 9) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : September " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 10) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Oktober " . $data_tahun_post . "</center></th></tr>";
			} elseif ($nm_bln == 11) {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : November " . $data_tahun_post . "</center></th></tr>";
			} else {
				echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>LAPORAN PERFORMANCE KONSOLIDASI<br><br>Periode : Desember " . $data_tahun_post . "</center></th></tr>";
			}
		}
		?>
    	</tr>

    	<tr>
    		<th>
    			<center>CABANG</center>
    		</th>
    		<th>
    			<center>OMZET</center>
    		</th>
    		<th>
    			<center>HPP</center>
    		</th>
    		<th>
    			<center>BIAYA PENJUALAN</center>
    		</th>
    		<th>
    			<center>UMUM</center>
    		</th>
    		<th>
    			<center>PENDAPATAN LAIN</center>
    		</th>
    		<th>
    			<center>BIAYA LAIN</center>
    		</th>
    		<th>
    			<center>LABA</center>
    		</th>
    	</tr>
    	<!-- DATA DARI COA -->
    	<?php
		$total_omzet			= 0;
		$total_hpp				= 0;
		$total_penjualan		= 0;
		$total_umum				= 0;
		$total_pendapatan_lain	= 0;
		$total_laba				= 0;

		if ($data_coa > 0) {
			foreach ($data_coa as $r_coa) {
				$kdcab			= $r_coa->kdcab; // 202-A
				$nocab			= substr($kdcab, 0, 3); // 202
				$subcab			= substr($kdcab, 4, 1); // A

				$data_cabang	= $this->db->query("SELECT * FROM pastibisa_tb_cabang WHERE nocab='$nocab' AND subcab='$subcab'")->result();

				if ($data_cabang > 0) {
					foreach ($data_cabang as $r_cbg) {
						$cabang	= $r_cbg->cabang;
					}
				}

				$data_coa_4	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '4%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

				if ($data_coa_4 > 0) {
					foreach ($data_coa_4 as $r_coa_4) {
						$saldoawal_4	= $r_coa_4->saldoawal;
						$debet_4		= $r_coa_4->debet;
						$kredit_4		= $r_coa_4->kredit;
						$faktor_4		= $r_coa_4->faktor;
						$omzet			= ($debet_4 - $kredit_4) * $faktor_4;
						$total_omzet 	+=	$omzet;

						$data_coa_5	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '5%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

						if ($data_coa_5 > 0) {
							foreach ($data_coa_5 as $r_coa_5) {
								$saldoawal_5	= $r_coa_5->saldoawal;
								$debet_5		= $r_coa_5->debet;
								$kredit_5		= $r_coa_5->kredit;
								$faktor_5		= $r_coa_5->faktor;
								$hpp			= ($debet_5 - $kredit_5) * $faktor_5;
								$total_hpp 		+=	$hpp;

								$data_coa_612	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '61%' OR no_perkiraan like '62%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

								if ($data_coa_612 > 0) {
									foreach ($data_coa_612 as $r_coa_612) {
										$saldoawal_612	= $r_coa_612->saldoawal;
										$debet_612		= $r_coa_612->debet;
										$kredit_612		= $r_coa_612->kredit;
										$faktor_612		= $r_coa_612->faktor;
										$penjualan		= ($debet_612 - $kredit_612) * $faktor_612;
										$total_penjualan +=	$penjualan;

										// $data_coa_63456789	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '63%' OR no_perkiraan like '64%' OR no_perkiraan like '65%' OR no_perkiraan like '66%' OR no_perkiraan like '67%' OR no_perkiraan like '68%' OR no_perkiraan like '69%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

										// if($data_coa_63456789 > 0){
										// 	foreach($data_coa_63456789 as $r_coa_63456789){
										// 		$saldoawal_63456789	= $r_coa_63456789->saldoawal;
										// 		$debet_63456789		= $r_coa_63456789->debet;
										// 		$kredit_63456789	= $r_coa_63456789->kredit;
										// 		$faktor_63456789	= $r_coa_63456789->faktor;
										// 		$umum				= ($saldoawal_63456789 + $debet_63456789 - $kredit_63456789) * $faktor_63456789;
										// 		$total_umum 		+=	$umum;

										$data_coa_71	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '71%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

										if ($data_coa_71 > 0) {
											foreach ($data_coa_71 as $r_coa_71) {
												$saldoawal_71			= $r_coa_71->saldoawal;
												$debet_71				= $r_coa_71->debet;
												$kredit_71				= $r_coa_71->kredit;
												$faktor_71				= $r_coa_71->faktor;
												$pendapatan_lain		= ($debet_71 - $kredit_71) * $faktor_71;
												$total_pendapatan_lain 	+=	$pendapatan_lain;

												$data_coa_39	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '39%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

												if ($data_coa_39 > 0) {
													foreach ($data_coa_39 as $r_coa_39) {
														$saldoawal_39			= $r_coa_39->saldoawal;
														$debet_39				= $r_coa_39->debet;
														$kredit_39				= $r_coa_39->kredit;
														$faktor_39				= $r_coa_39->faktor;
														// $laba					= ($saldoawal_39 + $debet_39 - $kredit_39) * $faktor_39;
														$laba					= $omzet - $hpp - $penjualan + $pendapatan_lain;
														$total_laba 			+=	$laba;

		?>
    													<tr>
    														<td><?= $cabang ?></td>
    														<td align="right"><?= number_format($omzet, 0, ',', '.') ?></td>
    														<td align="right"><?= number_format($hpp, 0, ',', '.') ?></td>
    														<td align="right"><?= number_format($penjualan, 0, ',', '.') ?></td>
    														<td align="right">0</td>
    														<td align="right"><?= number_format($pendapatan_lain, 0, ',', '.') ?></td>
    														<td align="right">0</td>
    														<td align="right"><?= number_format($laba, 0, ',', '.') ?></td>
    													</tr>
    	<?php
													}
												}
											}
										}
										// 	}
										// }

									}
								}
							}
						}
					}
				}
			}
		}
		/* else{
									echo "<td><?=$cabang?></td>";
									echo "<td align='right'><?=number_format($omzet,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($hpp,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($penjualan,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($umum,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($pendapatan_lain,0,',','.')?></td>";
									echo "<td align='right'></td>";
									echo "<td align='right'></td>";
								} */
		?>
    	<tr>
    		<td align="right"><b>TOTAL</b></td>
    		<td align="right"><?= number_format($total_omzet, 0, ',', '.') ?></td>
    		<td align="right"><?= number_format($total_hpp, 0, ',', '.') ?></td>
    		<td align="right"><?= number_format($total_penjualan, 0, ',', '.') ?></td>
    		<td align="right">0</td>
    		<td align="right"><?= number_format($total_pendapatan_lain, 0, ',', '.') ?></td>
    		<td align="right">0</td>
    		<td align="right"><?= number_format($total_laba, 0, ',', '.') ?></td>

    	</tr>

    </table>