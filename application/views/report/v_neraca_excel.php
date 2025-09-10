<style type="text/css">
	.str {
		mso-number-format: \@;
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

<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_Neraca_$data_bulan_post-$data_tahun_post.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>

<table width='50%' border="1" cellpadding="5" cellspacing="0">
	<!-- <table class="table table-bordered table-hover dataTable example1"> -->
	<?php
	//
	if ($data_bulan_post > 0) {
		$nm_bln = $data_bulan_post;
		
		// print_r($nm_bln);
		// exit;
		
		if ($nm_bln == 1) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br>Periode : Januari " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 2) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Februari " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 3) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Maret " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 4) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : April " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 5) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Mei " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 6) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Juni " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 7) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Juli " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 8) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Agustus " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 9) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : September " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 10) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Oktober " . $data_tahun_post . "</center></th></tr>";
		} elseif ($nm_bln == 11) {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : November " . $data_tahun_post . "</center></th></tr>";
		} else {
			echo "<tr><th colspan='3' style='text-align:center;font-size:20px;'><center>LAPORAN NERACA<br><br>Periode : Desember " . $data_tahun_post . "</center></th></tr>";
		}
	}
	?>
</table>

<div id="kiri">
	<table class="table table-bordered table-hover dataTable example1">
		<tbody>
			<tr>
				<td>
					<center><b>Kode</b></center>
				</td>
				<td>
					<center><b>Keterangan</b></center>
				</td>
				<td>
					<center><b>Jumlah</b></center>
				</td>
				<td></td>
			</tr>

			<!-- HARTA LANCAR -->
			<tr>
				<td align="left"><b>11</b></td>
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
						<td class="str"><?= $nokir_HartaLancar ?></td>
						<td><?= $nm_perkiraan_HartaLancar ?></td>
						<td align="right"><?= $rp_jml_HartaLancar	= number_format($jml_HartaLancar, 0, ',', '.'); ?></td>
						<td></td>
					</tr>
			<?php
				}
			}
			?>
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
				<td align="left"><b>12</b></td>
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
						<td class="str"><?= $nokir_tdkHartaLancar ?></td>
						<td><?= $nm_perkiraan_tdkHartaLancar ?></td>
						<td align="right"><?= $rp_jml_tdkHartaLancar	= number_format($jml_tdkHartaLancar, 0, ',', '.'); ?></td>
						<td></td>
					</tr>
			<?php
				}
			}
			?>
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
				<td align="left"><b>13</b></td>
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
						<td class="str"><?= $nokir_AktivaTetap ?></td>
						<td><?= $nm_perkiraan_AktivaTetap ?></td>
						<td align="right"><?= $rp_jml_AktivaTetap = number_format($jml_AktivaTetap, 0, ',', '.'); ?></td>
						<td></td>
					</tr>
			<?php
				}
			}
			?>
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
				<td align="left"><b>14</b></td>
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
						<td class="str"><?= $nokir_AktivaLain ?></td>
						<td><?= $nm_perkiraan_AktivaLain ?></td>
						<td align="right"><?= $rp_jml_AktivaLain = number_format($jml_AktivaLain, 0, ',', '.'); ?></td>
						<td></td>
					</tr>
			<?php
				}
			}
			?>
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
				$TotalAssets		= $SubTotal_HartaLancar + $SubTotal_tdkHartaLancar + $SubTotal_AktivaTetap + $SubTotal_AktivaLain;
				$rp_TotalAssets		= number_format($TotalAssets, 0, ',', '.');
				?>
				<td align="right"><b><?= $rp_TotalAssets ?></b></td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>

<div id="kanan">
	<table class="table table-bordered table-hover dataTable example1">
		<tbody>
			<tr>
				<td>
					<center><b>Kode</b></center>
				</td>
				<td>
					<center><b>Keterangan</b></center>
				</td>
				<td>
					<center><b>Jumlah</b></center>
				</td>
				<td></td>
			</tr>

			<!-- HUTANG -->
			<tr>
				<td align="left"><b>21</b></td>
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
						<td class="str"><?= $nokir_Hutang ?></td>
						<td><?= $nm_perkiraan_Hutang ?></td>
						<td align="right"><?= $rp_jml_Hutang	= number_format($jml_Hutang, 0, ',', '.'); ?></td>
						<td></td>
					</tr>
			<?php
				}
			}
			?>
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
				<td align="left"><b>31</b></td>
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
						<td class="str"><?= $nokir_Modal ?></td>
						<td><?= $nm_perkiraan_Modal ?></td>
						<td align="right"><?= $rp_jml_Modal		= number_format($jml_Modal, 0, ',', '.'); ?></td>
						<td></td>
					</tr>
			<?php
				}
			}
			?>
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
				<td align="left"><b>39</b></td>
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
						<td class="str"><?= $nokir_Laba ?></td>
						<td><?= $nm_perkiraan_Laba ?></td>
						<td align="right"><?= $rp_jml_Laba		= number_format($jml_Laba, 0, ',', '.'); ?></td>
						<td></td>
					</tr>
			<?php
				}
			}
			?>
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
		</tbody>
	</table>