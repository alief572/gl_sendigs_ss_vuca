<style type="text/css">
	@page {
		margin-top: 0.5cm;
		margin-bottom: 0.5cm;
		margin-left: 1cm;
		margin-right: 1cm;
	}

	.font {
		font-family: verdana, arial, sans-serif, tahoma;
		font-size: 14px;
	}

	.fontheader {
		font-family: verdana, arial, sans-serif;
		font-size: 14px;
	}

	table.gridtable2 {
		font-family: verdana, arial, sans-serif;
		font-size: 11px;
		color: #333333;
		border-width: thin;
		border-color: #666666;
		border-collapse: collapse;
	}

	table.gridtable2 th {

		padding: 10px;
		border-style: solid;
		background-color: #ffffff;
		font-family: tahoma;
		font-size: 11px;
	}

	table.gridtable2 td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #666666;
		background-color: #ffffff;
		font-family: verdana, arial, sans-serif;
		font-size: 10px;
	}

	#kiri {
		width: 50%;
		float: left;
	}

	#kanan {
		width: 50%;
		float: right;
	}
</style>
<table width="100%">

	<tr class="widget-user-header bg-yellow">
		<th width="20%" style="text-align:left; border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
			<!-- <img src="<?= base_url() ?>/assets/logo duta_transparan2.png" height="80" width="100"> -->
		</th>

		<?php
		$nocab = $this->session->userdata('nomor_cabang');
		$cek_cabang = $this->db->query("SELECT nocab,namacabang FROM pastibisa_tb_cabang WHERE nocab='$nocab'")->row();
		$nama_cabang = $cek_cabang->namacabang;

		if ($data_bulan_post > 0) {
			$nm_bln = $data_bulan_post;
			if ($nm_bln == 1) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Januari " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 2) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Februari " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 3) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Maret " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 4) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : April " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 5) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Mei " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 6) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Juni " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 7) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Juli " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 8) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Agustus " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 9) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : September " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 10) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Oktober " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 11) {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : November " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} else {
				echo "<th width='60%' style='text-align:center;font-size:15px;'><center>BALANCE SHEET<br>Periode : Desember " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			}
		}

		function tgl_indo($tanggal)
		{
			$hari = date('l');
			if ($hari == "Monday") {
				$hari = "Senin";
			} elseif ($hari == "Tuesday") {
				$hari = "Selasa";
			} elseif ($hari == "Wednesday") {
				$hari = "Rabu";
			} elseif ($hari == "Thursday") {
				$hari = "Kamis";
			} elseif ($hari == "Friday") {
				$hari = "Jumat";
			} elseif ($hari == "Saturday") {
				$hari = "Sabtu";
			} else {
				$hari = "Minggu";
			}

			$tgl = date('d');

			$bulan = date('F');
			if ($bulan == "January") {
				$bulan = "Januari";
			} elseif ($bulan == "February") {
				$bulan = "Februari";
			} elseif ($bulan == "March") {
				$bulan = "Maret";
			} elseif ($bulan == "April") {
				$bulan = "April";
			} elseif ($bulan == "May") {
				$bulan = "Mei";
			} elseif ($bulan == "June") {
				$bulan = "Juni";
			} elseif ($bulan == "July") {
				$bulan = "Juli";
			} elseif ($bulan == "August") {
				$bulan = "Agustus";
			} elseif ($bulan == "September") {
				$bulan = "September";
			} elseif ($bulan == "November") {
				$bulan = "November";
			} else {
				$bulan = "Desember";
			}

			$tahun = date('Y');
			$jam = date('H:i:s');

			return $hari . ", " . $tgl . " " . $bulan . " " . $tahun . " " . $jam;
		}
		?>
		<td width="20" style="font-size:11px; text-align:right; border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= tgl_indo(date('l, d F Y H:i:s')); ?></td>
	</tr>
</table>

<div id="kiri">

	<table class="gridtable2">

		<tbody>

			<tr>
				<td width="10%">
					<center><b>Code</b></center>
				</td>
				<td width="15%">
					<center><b>Description</b></center>
				</td>
				<td width="15%">
					<center><b>Amount</b></center>
				</td>
				<td width="1%"></td>
			</tr>

			<!-- HARTA LANCAR -->
			<tr>
				<td><b>11</b></td>
				<td><b>HARTA LANCAR</b></td>
				<td></td>
				<td></td>
			</tr>

			<?php
			$SubTotal_HartaLancar = 0;
			$rp_SubTotal_HartaLancar = 0;
			if ($data_HartaLancar > 0) {

				foreach ($data_HartaLancar as $row) {

					$nokir_HartaLancar			= $row->no_perkiraan;
					$nm_perkiraan_HartaLancar	= $row->nama;
					$vFaktor 					= $row->faktor;
					$vSaldoAwal 				= $row->saldoawal;
					$vDebet 					= $row->debet;
					$vKredit 					= $row->kredit;

					$jml_HartaLancar			= $vSaldoAwal + ($vDebet - $vKredit) * $vFaktor;

					$SubTotal_HartaLancar 		+=  $jml_HartaLancar;

					$rp_SubTotal_HartaLancar	= number_format($SubTotal_HartaLancar, 0, ',', '.');
			?>
					<tr>
						<td><?= $nokir_HartaLancar ?></td>
						<td><?= $nm_perkiraan_HartaLancar ?></td>
						<td align="right"><?= $rp_jml_HartaLancar = number_format($jml_HartaLancar, 0, ',', '.'); ?></td>
						<td></td>
				<?php
				}
			}
				?>
					</tr>

					<tr>
						<td></td>
						<td><b>Sub Total HARTA LANCAR</b></td>
						<td align="right"><b><?= $rp_SubTotal_HartaLancar ?></b></td>
						<td></td>
					</tr>

					<tr>

						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>

					<!-- HARTA LANCAR -->
					<tr>
						<td><b>12</b></td>
						<td><b>HARTA TIDAK LANCAR</b></td>
						<td></td>
						<td></td>
					</tr>

					<?php
					$SubTotal_tdkHartaLancar = 0;
					$rp_SubTotal_tdkHartaLancar = 0;
					if ($data_tdkHartaLancar > 0) {

						foreach ($data_tdkHartaLancar as $row12) {

							$nokir_tdkHartaLancar			= $row12->no_perkiraan;
							$nm_perkiraan_tdkHartaLancar	= $row12->nama;
							$vFaktor12 					= $row12->faktor;
							$vSaldoAwal12 				= $row12->saldoawal;
							$vDebet12 					= $row12->debet;
							$vKredit12 					= $row12->kredit;

							$jml_tdkHartaLancar			= $vSaldoAwal12 + ($vDebet12 - $vKredit12) * $vFaktor12;

							$SubTotal_tdkHartaLancar 		+=  $jml_tdkHartaLancar;

							$rp_SubTotal_tdkHartaLancar	= number_format($SubTotal_tdkHartaLancar, 0, ',', '.');
					?>
							<tr>
								<td><?= $nokir_tdkHartaLancar ?></td>
								<td><?= $nm_perkiraan_tdkHartaLancar ?></td>
								<td align="right"><?= $rp_jml_tdkHartaLancar = number_format($jml_tdkHartaLancar, 0, ',', '.'); ?></td>
								<td></td>
						<?php
						}
					}
						?>
							</tr>

							<tr>
								<td></td>
								<td><b>Sub Total HARTA TIDAK LANCAR</b></td>
								<td align="right"><b><?= $rp_SubTotal_tdkHartaLancar ?></b></td>
								<td></td>
							</tr>

							<tr>

								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<!-- AKTIVA TETAP -->
							<tr>
								<td><b>13</b></td>
								<td><b>AKTIVA TETAP</b></td>
								<td></td>
								<td></td>
							</tr>

							<?php
							$SubTotal_AktivaTetap = 0;
							$rp_SubTotal_AktivaTetap = 0;
							if ($data_AktivaTetap > 0) {

								foreach ($data_AktivaTetap as $row2) {

									$nokir_AktivaTetap				= $row2->no_perkiraan;
									$nm_perkiraan_AktivaTetap		= $row2->nama;
									$vFaktor_AktivaTetap 			= $row2->faktor;
									$vSaldoAwal_AktivaTetap			= $row2->saldoawal;
									$vDebet_AktivaTetap				= $row2->debet;
									$vKredit_AktivaTetap			= $row2->kredit;

									$jml_AktivaTetap				= $vSaldoAwal_AktivaTetap + ($vDebet_AktivaTetap - $vKredit_AktivaTetap) * $vFaktor_AktivaTetap;

									$SubTotal_AktivaTetap 			+=  $jml_AktivaTetap;

									$rp_SubTotal_AktivaTetap		= number_format($SubTotal_AktivaTetap, 0, ',', '.');
							?>
									<tr>
										<td><?= $nokir_AktivaTetap ?></td>
										<td><?= $nm_perkiraan_AktivaTetap ?></td>
										<td align="right"><?= $rp_jml_AktivaTetap		= number_format($jml_AktivaTetap, 0, ',', '.'); ?></td>
										<td></td>
								<?php
								}
							}
								?>
									</tr>

									<tr>
										<td></td>
										<td><b>Sub Total AKTIVA TETAP</b></td>
										<td align="right"><b><?= $rp_SubTotal_AktivaTetap ?></b></td>
										<td></td>
									</tr>

									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>

									<!-- AKTIVA LAIN-LAIN -->
									<tr>
										<td><b>14</b></td>
										<td><b>AKTIVA LAIN-LAIN</b></td>
										<td></td>
										<td></td>
									</tr>

									<?php
									$SubTotal_AktivaLain = 0;
									$rp_SubTotal_AktivaLain = 0;
									if ($data_AktivaLain > 0) {

										foreach ($data_AktivaLain as $row3) {

											$nokir_AktivaLain				= $row3->no_perkiraan;
											$nm_perkiraan_AktivaLain		= $row3->nama;
											$vFaktor_AktivaLain				= $row3->faktor;
											$vSaldoAwal_AktivaLain			= $row3->saldoawal;
											$vDebet_AktivaLain				= $row3->debet;
											$vKredit_AktivaLain 			= $row3->kredit;

											$jml_AktivaLain					= ($vSaldoAwal_AktivaLain + $vDebet_AktivaLain - $vKredit_AktivaLain) * $vFaktor_AktivaLain;

											$SubTotal_AktivaLain 			+=  $jml_AktivaLain;

											$rp_SubTotal_AktivaLain			= number_format($SubTotal_AktivaLain, 0, ',', '.');
									?>
											<tr>
												<td><?= $nokir_AktivaLain ?></td>
												<td><?= $nm_perkiraan_AktivaLain ?></td>
												<td align="right"><?= $rp_jml_AktivaLain		= number_format($jml_AktivaLain, 0, ',', '.'); ?></td>
												<td></td>
										<?php
										}
									} else {
										$SubTotal_AktivaLain 			= 0;
										$rp_SubTotal_AktivaLain			= number_format($SubTotal_AktivaLain, 0, ',', '.');
									}
										?>
											</tr>

											<tr>
												<td></td>
												<td><b>Sub Total AKTIVA LAIN-LAIN</b></td>
												<td align="right"><b><?= $rp_SubTotal_AktivaLain ?></b></td>
												<td></td>
											</tr>

											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>

											<tr>
												<td></td>
												<td>
													<center><b>TOTAL ASSETS</b></center>
												</td>
												<?php
												$TotalAssets 			= $SubTotal_HartaLancar + $SubTotal_tdkHartaLancar + $SubTotal_AktivaTetap + $SubTotal_AktivaLain;
												$rp_TotalAssets		= number_format($TotalAssets, 0, ',', '.');
												?>
												<td align="right"><b><?= $rp_TotalAssets ?></b></td>
												<td></td>
											</tr>
		</tbody>
	</table>
</div>

<div id="kanan">

	<table class="gridtable2">

		<tbody>
			<tr>
				<td width="10%">
					<center><b>Code</b></center>
				</td>
				<td width="15%">
					<center><b>Description</b></center>
				</td>
				<td width="15%">
					<center><b>Amount</b></center>
				</td>
				<td width="1%"></td>
			</tr>

			<!-- HUTANG -->
			<tr>
				<td><b>21</b></td>
				<td><b>HUTANG</b></td>
				<td></td>
				<td></td>
			</tr>

			<?php
			$SubTotal_Hutang = 0;
			$rp_SubTotal_Hutang = 0;

			if ($data_Hutang > 0) {

				foreach ($data_Hutang as $row4) {

					$nokir_Hutang				= $row4->no_perkiraan;
					$nm_perkiraan_Hutang		= $row4->nama;
					$vFaktor_Hutang				= $row4->faktor;
					$vSaldoAwal_Hutang			= $row4->saldoawal;
					$vDebet_Hutang 				= $row4->debet;
					$vKredit_Hutang 			= $row4->kredit;

					$jml_Hutang					= ($vSaldoAwal_Hutang + $vDebet_Hutang - $vKredit_Hutang) * $vFaktor_Hutang;

					$SubTotal_Hutang 			+=  $jml_Hutang;

					$rp_SubTotal_Hutang			= number_format($SubTotal_Hutang, 0, ',', '.');
			?>
					<tr>
						<td><?= $nokir_Hutang ?></td>
						<td><?= $nm_perkiraan_Hutang ?></td>
						<td align="right"><?= $rp_jml_Hutang		= number_format($jml_Hutang, 0, ',', '.'); ?></td>
						<td></td>
				<?php
				}
			}
				?>
					</tr>

					<tr>
						<td></td>
						<td><b>Sub Total HUTANG</b></td>
						<td align="right"><b><?= $rp_SubTotal_Hutang ?></b></td>
						<td></td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>

					<!-- MODAL -->
					<tr>
						<td><b>31</b></td>
						<td><b>MODAL</b></td>
						<td></td>
						<td></td>
					</tr>

					<?php
					$SubTotal_Modal = 0;
					$rp_SubTotal_Modal = 0;
					if ($data_Modal > 0) {
						foreach ($data_Modal as $row5) {

							$nokir_Modal				= $row5->no_perkiraan;
							$nm_perkiraan_Modal			= $row5->nama;
							$vFaktor_Modal				= $row5->faktor;
							$vSaldoAwal_Modal 			= $row5->saldoawal;
							$vDebet_Modal 				= $row5->debet;
							$vKredit_Modal				= $row5->kredit;

							$jml_Modal					= ($vSaldoAwal_Modal + $vDebet_Modal - $vKredit_Modal) * $vFaktor_Modal;

							$SubTotal_Modal 			+=  $jml_Modal;

							$rp_SubTotal_Modal			= number_format($SubTotal_Modal, 0, ',', '.');
					?>
							<tr>
								<td><?= $nokir_Modal ?></td>
								<td><?= $nm_perkiraan_Modal ?></td>
								<td align="right"><?= $rp_jml_Modal		= number_format($jml_Modal, 0, ',', '.'); ?></td>
								<td></td>
						<?php
						}
					}
						?>
							</tr>

							<tr>
								<td></td>
								<td><b>Sub Total MODAL</b></td>
								<td align="right"><b><?= $rp_SubTotal_Modal ?></b></td>
								<td></td>
							</tr>

							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>

							<!-- LABA -->
							<tr>
								<td><b>39</b></td>
								<td><b>LABA</b></td>
								<td></td>
								<td></td>
							</tr>

							<?php
							$SubTotal_Laba = 0;
							$rp_SubTotal_Laba = 0;
							if ($data_Laba > 0) {

								foreach ($data_Laba as $row6) {

									$nokir_Laba				= $row6->no_perkiraan;
									$nm_perkiraan_Laba		= $row6->nama;
									$vFaktor_Laba 			= $row6->faktor;
									$vSaldoAwal_Laba 		= $row6->saldoawal;
									$vDebet_Laba 			= $row6->debet;
									$vKredit_Laba 			= $row6->kredit;

									// $jml_Laba				= ($vDebet_Laba - $vKredit_Laba);
									$jml_Laba			= ($vSaldoAwal_Laba + $vDebet_Laba - $vKredit_Laba) * $vFaktor_Laba;

									$SubTotal_Laba 			+=  $jml_Laba;

									$rp_SubTotal_Laba		= number_format($SubTotal_Laba, 0, ',', '.');
							?>
									<tr>
										<td><?= $nokir_Laba ?></td>
										<td><?= $nm_perkiraan_Laba ?></td>
										<td align="right"><?= $rp_jml_Laba = number_format($jml_Laba, 0, ',', '.'); ?></td>
										<td></td>
								<?php
								}
							}
								?>
									</tr>

									<tr>
										<td></td>
										<td><b>Sub Total LABA</b></td>
										<td align="right"><b><?= $rp_SubTotal_Laba ?></b></td>
										<td></td>
									</tr>

									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>

									<tr>
										<td></td>
										<td>
											<center><b>TOTAL PASSIVA</b></center>
										</td>
										<?php
										$TotalLaba 			= $SubTotal_Hutang + $SubTotal_Modal + $SubTotal_Laba;
										$rp_TotalLaba		= number_format($TotalLaba, 0, ',', '.');

										?>
										<td align="right"><b><?= $rp_TotalLaba ?></b></td>
										<td></td>
									</tr>


									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>

									<tr>
										<td></td>
										<td>
											<center><b>TOTAL LIABILITIES AND EQUITY</b></center>
										</td>
										<?php
										$TotalLaba 			= $SubTotal_Hutang + $SubTotal_Modal + $SubTotal_Laba;
										$rp_TotalLaba		= number_format($TotalLaba, 0, ',', '.');
										?>
										<td align="right"><b><?= $rp_TotalLaba ?></b></td>
										<td></td>
									</tr>
		</tbody>
	</table>
</div>
<!-- <div>
	<table width="100%">
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>

		<tr>
			<td></td>
			<td>
				<center><b>TOTAL ASSETS</b></center>
			</td>
			<?php
			$TotalAssets 		= $SubTotal_HartaLancar + $SubTotal_tdkHartaLancar + $SubTotal_AktivaTetap + $SubTotal_AktivaLain;
			$rp_TotalAssets		= number_format($TotalAssets, 0, ',', '.');
			?>
			<td align="right"><b><?= $rp_TotalAssets ?></b></td>
			<td></td>

			<td></td>
			<td>
				<center><b>TOTAL LIABILITIES AND EQUITY</b></center>
			</td>
			<?php
			$TotalLaba 			= $SubTotal_Hutang + $SubTotal_Modal + $SubTotal_Laba;
			$rp_TotalLaba		= number_format($TotalLaba, 0, ',', '.');

			?>
			<td align="right"><b><?= $rp_TotalLaba ?></b></td>
			<td></td>
		</tr>
	</table>
</div> -->