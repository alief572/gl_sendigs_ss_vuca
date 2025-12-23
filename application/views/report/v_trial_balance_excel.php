<style type="text/css">
	.str {
		mso-number-format: \@;
	}

	.myDiv {
		background-color: #d3eefa;
		font-family: verdana;
	}

	.warnaTombol {
		background-color: #286090;
		color: white;
	}

	.warnaTombol {
		background-color: #286090;
		color: white;
	}

	.warnaTombolExcel {
		background-color: #02723B;
		color: white;
	}

	.warnaTombolPdf {
		background-color: #DE0B0B;
		color: white;
	}

	.teksPutih {
		color: white;
	}

	.teksBiru {
		color: #005279;
	}

	/* table,
	th,
	td {
		border: 1px solid black;
		border-collapse: collapse;
	} */

	th,
	td {
		padding: 15px;
	}
</style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Laporan_TrialBalance_$data_bulan_post-$data_tahun_post.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda

?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
	<tr>
		<?php
		$nocab = $this->session->userdata('nomor_cabang');
		$cek_cabang = $this->db->query("SELECT nocab,namacabang FROM pastibisa_tb_cabang WHERE nocab='$nocab'")->row();
		$nama_cabang = $cek_cabang->namacabang;

		if ($data_bulan_post > 0) {
			$nm_bln = $data_bulan_post;
			if ($nm_bln == 1) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Januari " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 2) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Februari " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 3) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Maret " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 4) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : April " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 5) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Mei " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 6) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Juni " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 7) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Juli " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 8) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Agustus " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 9) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : September " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 10) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Oktober " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} elseif ($nm_bln == 11) {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : November " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			} else {
				echo "<th colspan='6' style='text-align:center;font-size:18px;'><center>TRIAL BALANCE REPORT<br>Periode : Desember " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
			}
		}
		?>
	</tr>

	<tr>
		<td>
			<center><b>No. Perkiraan</b></center>
		</td>
		<td>
			<center><b>Nama Perkiraan</b></center>
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

	<!-- HARTA LANCAR -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>11</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>HARTA LANCAR</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_11 = 0;
	$subtotal_debet_11 = 0;
	$subtotal_kredit_11 = 0;
	$subtotal_saldoakhir_11 = 0;

	if ($data_nokir_hartalancar11 > 0) {
		foreach ($data_nokir_hartalancar11 as $row11) {

			$nokir_11			= $row11->no_perkiraan;
			$nm_perkiraan_11	= $row11->nama;
			$faktor_11			= $row11->faktor;
			$saldoawal_11		= ($row11->saldoawal) * $faktor_11;
			$debet_11			= $row11->debet;
			$kredit_11			= $row11->kredit;

			$saldoakhir_11		= ($saldoawal_11 + $debet_11 - $kredit_11) * $faktor_11;

			$subtotal_saldoawal_11	+= $saldoawal_11;
			$subtotal_debet_11		+= $debet_11;
			$subtotal_kredit_11		+= $kredit_11;
			$subtotal_saldoakhir_11	+= $saldoakhir_11;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_11 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_11 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_11, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_11, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_11, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_11, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total HARTA LANCAR</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_11, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_11, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_11, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_11, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<!--AKTIVA TETAP -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>13</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>AKTIVA TETAP</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_13 = 0;
	$subtotal_debet_13 = 0;
	$subtotal_kredit_13 = 0;
	$subtotal_saldoakhir_13 = 0;

	if ($data_nokir_aktivatetap13 > 0) {
		foreach ($data_nokir_aktivatetap13 as $row13) {

			$nokir_13			= $row13->no_perkiraan;
			$nm_perkiraan_13	= $row13->nama;
			$faktor_13			= $row13->faktor;
			$saldoawal_13		= ($row13->saldoawal) * $faktor_13;
			$debet_13			= $row13->debet;
			$kredit_13			= $row13->kredit;

			$saldoakhir_13		= ($saldoawal_13 + $debet_13 - $kredit_13) * $faktor_13;

			$subtotal_saldoawal_13	+= $saldoawal_13;
			$subtotal_debet_13		+= $debet_13;
			$subtotal_kredit_13		+= $kredit_13;
			$subtotal_saldoakhir_13	+= $saldoakhir_13;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_13 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_13 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_13, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_13, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_13, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_13, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total AKTIVA TETAP</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_13, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_13, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_13, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_13, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--AKTIVA LAIN-LAIN -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>14</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>AKTIVA LAIN-LAIN</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_19 = 0;
	$subtotal_debet_19 = 0;
	$subtotal_kredit_19 = 0;
	$subtotal_saldoakhir_19 = 0;

	if ($data_nokir_aktivalain19 > 0) {
		foreach ($data_nokir_aktivalain19 as $row19) {

			$nokir_19			= $row19->no_perkiraan;
			$nm_perkiraan_19	= $row19->nama;
			$faktor_19			= $row19->faktor;
			$saldoawal_19		= ($row19->saldoawal) * $faktor_19;
			$debet_19			= $row19->debet;
			$kredit_19			= $row19->kredit;

			$saldoakhir_19		= ($saldoawal_19 + $debet_19 - $kredit_19) * $faktor_19;

			$subtotal_saldoawal_19	+= $saldoawal_19;
			$subtotal_debet_19		+= $debet_19;
			$subtotal_kredit_19		+= $kredit_19;
			$subtotal_saldoakhir_19	+= $saldoakhir_19;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_19 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_19 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_19, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_19, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_19, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_19, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total AKTIVA LAIN-LAIN</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_19, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_19, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_19, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_19, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--TOTAL AKTIVA-->

	<?php
	$subtotal_saldoawal_totalaktiva = 0;
	$subtotal_debet_totalaktiva = 0;
	$subtotal_kredit_totalaktiva = 0;
	$subtotal_saldoakhir_totalaktiva = 0;

	if ($data_nokir_totalaktiva > 0) {
		foreach ($data_nokir_totalaktiva as $rowtotalaktiva) {
			$faktor_totalaktiva			= $rowtotalaktiva->faktor;
			$saldoawal_totalaktiva		= ($rowtotalaktiva->tot_aktiva_saldoawal) * $faktor_totalaktiva;
			$debet_totalaktiva			= $rowtotalaktiva->tot_aktiva_debet;
			$kredit_totalaktiva			= $rowtotalaktiva->tot_aktiva_kredit;

			$saldoakhir_totalaktiva		= ($saldoawal_totalaktiva + $debet_totalaktiva - $kredit_totalaktiva) * $faktor_totalaktiva;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>TOTAL AKTIVA</b></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($saldoawal_totalaktiva, 0, ',', '.'); ?></b></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($debet_totalaktiva, 0, ',', '.'); ?></b></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($kredit_totalaktiva, 0, ',', '.'); ?></b></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($saldoakhir_totalaktiva, 0, ',', '.'); ?></b></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--HUTANG -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>21</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>HUTANG</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_21 = 0;
	$subtotal_debet_21 = 0;
	$subtotal_kredit_21 = 0;
	$subtotal_saldoakhir_21 = 0;

	if ($data_nokir_hutang21 > 0) {
		foreach ($data_nokir_hutang21 as $row21) {

			$nokir_21			= $row21->no_perkiraan;
			$nm_perkiraan_21	= $row21->nama;
			$faktor_21			= $row21->faktor;
			$saldoawal_21		= ($row21->saldoawal) * $faktor_21;
			$debet_21			= $row21->debet;
			$kredit_21			= $row21->kredit;

			$saldoakhir_21		= ($saldoawal_21 + $debet_21 - $kredit_21) * $faktor_21;

			$subtotal_saldoawal_21	+= $saldoawal_21;
			$subtotal_debet_21		+= $debet_21;
			$subtotal_kredit_21		+= $kredit_21;
			$subtotal_saldoakhir_21	+= $saldoakhir_21;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_21 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_21 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_21, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_21, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_21, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_21, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total HUTANG</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_21, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_21, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_21, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_21, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
		</td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
		</td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
		</td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
		</td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
		</td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
		</td>
	</tr>

	<!--MODAL -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>31</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>MODAL</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_32 = 0;
	$subtotal_debet_32 = 0;
	$subtotal_kredit_32 = 0;
	$subtotal_saldoakhir_32 = 0;

	if ($data_nokir_modal31 > 0) {
		foreach ($data_nokir_modal31 as $row32) {

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
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_32 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_32 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_32, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_32, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_32, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_32, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total MODAL</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_32, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_32, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_32, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_32, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--LABA -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>39</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>LABA</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_39 = 0;
	$subtotal_debet_39 = 0;
	$subtotal_kredit_39 = 0;
	$subtotal_saldoakhir_39 = 0;

	if ($data_nokir_laba39 > 0) {
		foreach ($data_nokir_laba39 as $row39) {

			$nokir_39			= $row39->no_perkiraan;
			$nm_perkiraan_39	= $row39->nama;
			$faktor_39			= $row39->faktor;
			$saldoawal_39		= ($row39->saldoawal) * $faktor_39;
			$debet_39			= $row39->debet;
			$kredit_39			= $row39->kredit;

			$saldoakhir_39		= ($saldoawal_39 + $debet_39 - $kredit_39) * $faktor_39;

			$subtotal_saldoawal_39	+= $saldoawal_39;
			$subtotal_debet_39		+= $debet_39;
			$subtotal_kredit_39		+= $kredit_39;
			$subtotal_saldoakhir_39	+= $saldoakhir_39;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_39 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_39 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_39, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_39, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_39, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_39, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total LABA</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_39, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_39, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_39, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_39, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--TOTAL PASSIVA-->

	<?php
	$subtotal_saldoawal_totalpassiva = 0;
	$subtotal_debet_totalpassiva = 0;
	$subtotal_kredit_totalpassiva = 0;
	$subtotal_saldoakhir_totalpassiva = 0;

	if ($data_nokir_totalpassiva > 0) {
		foreach ($data_nokir_totalpassiva as $rowtotalpassiva) {
			$faktor_totalpassiva		= $rowtotalpassiva->faktor;
			$saldoawal_totalpassiva		= ($rowtotalpassiva->tot_passiva_saldoawal) * $faktor_totalpassiva;
			$debet_totalpassiva			= $rowtotalpassiva->tot_passiva_debet;
			$kredit_totalpassiva		= $rowtotalpassiva->tot_passiva_kredit;

			$saldoakhir_totalpassiva	= ($saldoawal_totalpassiva + $debet_totalpassiva - $kredit_totalpassiva) * $faktor_totalpassiva;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>TOTAL PASSIVA</b></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($saldoawal_totalpassiva, 0, ',', '.'); ?></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($debet_totalpassiva, 0, ',', '.'); ?></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($kredit_totalpassiva, 0, ',', '.'); ?></td>
				<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($saldoakhir_totalpassiva, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--PENDAPATAN -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>41</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>PENDAPATAN</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_41 = 0;
	$subtotal_debet_41 = 0;
	$subtotal_kredit_41 = 0;
	$subtotal_saldoakhir_41 = 0;

	if ($data_nokir_pendapatan41 > 0) {
		foreach ($data_nokir_pendapatan41 as $row41) {

			$nokir_41			= $row41->no_perkiraan;
			$nm_perkiraan_41	= $row41->nama;
			$faktor_41			= $row41->faktor;
			$saldoawal_41		= ($row41->saldoawal) * $faktor_41;
			$debet_41			= $row41->debet;
			$kredit_41			= $row41->kredit;

			$saldoakhir_41		= ($saldoawal_41 + $debet_41 - $kredit_41) * $faktor_41;

			$subtotal_saldoawal_41	+= $saldoawal_41;
			$subtotal_debet_41		+= $debet_41;
			$subtotal_kredit_41		+= $kredit_41;
			$subtotal_saldoakhir_41	+= $saldoakhir_41;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_41 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_41 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_41, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_41, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_41, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_41, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total LABA</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_41, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_41, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_41, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_41, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--HARGA POKOK PENJUALAN -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>51</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>HARGA POKOK PENJUALAN</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_51 = 0;
	$subtotal_debet_51 = 0;
	$subtotal_kredit_51 = 0;
	$subtotal_saldoakhir_51 = 0;

	if ($data_nokir_hpp51 > 0) {
		foreach ($data_nokir_hpp51 as $row51) {

			$nokir_51			= $row51->no_perkiraan;
			$nm_perkiraan_51	= $row51->nama;
			$faktor_51			= $row51->faktor;
			$saldoawal_51		= ($row51->saldoawal) * $faktor_51;
			$debet_51			= $row51->debet;
			$kredit_51			= $row51->kredit;

			$saldoakhir_51		= ($saldoawal_51 + $debet_51 - $kredit_51) * $faktor_51;

			$subtotal_saldoawal_51	+= $saldoawal_51;
			$subtotal_debet_51		+= $debet_51;
			$subtotal_kredit_51		+= $kredit_51;
			$subtotal_saldoakhir_51	+= $saldoakhir_51;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_51 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_51 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_51, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_51, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_51, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_51, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total HARGA POKOK PENJUALAN</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_51, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_51, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_51, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_51, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--BIAYA PENJUALAN -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>61</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>BIAYA PENJUALAN</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_61 = 0;
	$subtotal_debet_61 = 0;
	$subtotal_kredit_61 = 0;
	$subtotal_saldoakhir_61 = 0;

	if ($data_nokir_biayapenjualan61 > 0) {
		foreach ($data_nokir_biayapenjualan61 as $row61) {

			$nokir_61			= $row61->no_perkiraan;
			$nm_perkiraan_61	= $row61->nama;
			$faktor_61			= $row61->faktor;
			$saldoawal_61		= ($row61->saldoawal) * $faktor_61;
			$debet_61			= $row61->debet;
			$kredit_61			= $row61->kredit;

			$saldoakhir_61		= ($saldoawal_61 + $debet_61 - $kredit_61) * $faktor_61;

			$subtotal_saldoawal_61	+= $saldoawal_61;
			$subtotal_debet_61		+= $debet_61;
			$subtotal_kredit_61		+= $kredit_61;
			$subtotal_saldoakhir_61	+= $saldoakhir_61;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_61 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_61 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_61, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_61, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_61, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_61, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total BIAYA PENJUALAN</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_61, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_61, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_61, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_61, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--BIAYA KANTOR DAN UMUM -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>68</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>BIAYA KANTOR DAN UMUM</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_68 = 0;
	$subtotal_debet_68 = 0;
	$subtotal_kredit_68 = 0;
	$subtotal_saldoakhir_68 = 0;

	if ($data_nokir_biayakantor68 > 0) {
		foreach ($data_nokir_biayakantor68 as $row68) {

			$nokir_68			= $row68->no_perkiraan;
			$nm_perkiraan_68	= $row68->nama;
			$faktor_68			= $row68->faktor;
			$saldoawal_68		= ($row68->saldoawal) * $faktor_68;
			$debet_68			= $row68->debet;
			$kredit_68			= $row68->kredit;

			$saldoakhir_68		= ($saldoawal_68 + $debet_68 - $kredit_68) * $faktor_68;

			$subtotal_saldoawal_68	+= $saldoawal_68;
			$subtotal_debet_68		+= $debet_68;
			$subtotal_kredit_68		+= $kredit_68;
			$subtotal_saldoakhir_68	+= $saldoakhir_68;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_68 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_68 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_68, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_68, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_68, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_68, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total BIAYA KANTOR DAN UMUM</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_68, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_68, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_68, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_68, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--TAKSIRAN PAJAK -->
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>91</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>TAKSIRAN PAJAK</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>

	<?php
	$subtotal_saldoawal_91 = 0;
	$subtotal_debet_91 = 0;
	$subtotal_kredit_91 = 0;
	$subtotal_saldoakhir_91 = 0;

	if ($data_nokir_taksiranpajak91 > 0) {
		foreach ($data_nokir_taksiranpajak91 as $row91) {

			$nokir_91			= $row91->no_perkiraan;
			$nm_perkiraan_91	= $row91->nama;
			$faktor_91			= $row91->faktor;
			$saldoawal_91		= ($row91->saldoawal) * $faktor_91;
			$debet_91			= $row91->debet;
			$kredit_91			= $row91->kredit;

			$saldoakhir_91		= ($saldoawal_91 + $debet_91 - $kredit_91) * $faktor_91;

			$subtotal_saldoawal_91	+= $saldoawal_91;
			$subtotal_debet_91		+= $debet_91;
			$subtotal_kredit_91		+= $kredit_91;
			$subtotal_saldoakhir_91	+= $saldoakhir_91;
	?>
			<tr>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_91 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_91 ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoawal_91, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($debet_91, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($kredit_91, 0, ',', '.'); ?></td>
				<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= number_format($saldoakhir_91, 0, ',', '.'); ?></td>
			</tr>
	<?php
		}
	}
	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>Sub Total TAKSIRAN PAJAK</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoawal_91, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_debet_91, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_kredit_91, 0, ',', '.'); ?></b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($subtotal_saldoakhir_91, 0, ',', '.'); ?></b></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
	</tr>
	<!--IKHTISAR LABA/RUGI-->

	<?php
	if ($data_nokir_4 > 0) {
		foreach ($data_nokir_4 as $rowtotal_nokir_4) {
			$faktor_total_nokir_4		= $rowtotal_nokir_4->faktor;
			$saldoawal_total_nokir_4	= ($rowtotal_nokir_4->tot_nokir_4_saldoawal) * $faktor_total_nokir_4;
			$debet_total_nokir_4		= $rowtotal_nokir_4->tot_nokir_4_debet;
			$kredit_total_nokir_4		= $rowtotal_nokir_4->tot_nokir_4_kredit;
		}
	}
	if ($data_nokir_5 > 0) {
		foreach ($data_nokir_5 as $rowtotal_nokir_5) {
			$faktor_total_nokir_5		= $rowtotal_nokir_5->faktor;
			$saldoawal_total_nokir_5	= ($rowtotal_nokir_5->tot_nokir_5_saldoawal) * $faktor_total_nokir_5;
			$debet_total_nokir_5		= $rowtotal_nokir_5->tot_nokir_5_debet;
			$kredit_total_nokir_5		= $rowtotal_nokir_5->tot_nokir_5_kredit;
		}
	}
	if ($data_nokir_6 > 0) {
		foreach ($data_nokir_6 as $rowtotal_nokir_6) {
			$faktor_total_nokir_6		= $rowtotal_nokir_6->faktor;
			$saldoawal_total_nokir_6	= ($rowtotal_nokir_6->tot_nokir_6_saldoawal) * $faktor_total_nokir_6;
			$debet_total_nokir_6		= $rowtotal_nokir_6->tot_nokir_6_debet;
			$kredit_total_nokir_6		= $rowtotal_nokir_6->tot_nokir_6_kredit;
		}
	}
	if ($data_nokir_71 > 0) {
		foreach ($data_nokir_71 as $rowtotal_nokir_71) {
			$faktor_total_nokir_71		= $rowtotal_nokir_71->faktor;
			$saldoawal_total_nokir_71	= ($rowtotal_nokir_71->tot_nokir_71_saldoawal) * $faktor_total_nokir_71;
			$debet_total_nokir_71		= $rowtotal_nokir_71->tot_nokir_71_debet;
			$kredit_total_nokir_71		= $rowtotal_nokir_71->tot_nokir_71_kredit;
		}
	}
	if ($data_nokir_72 > 0) {
		foreach ($data_nokir_72 as $rowtotal_nokir_72) {
			$faktor_total_nokir_72		= $rowtotal_nokir_72->faktor;
			$saldoawal_total_nokir_72	= ($rowtotal_nokir_72->tot_nokir_72_saldoawal) * $faktor_total_nokir_72;
			$debet_total_nokir_72		= $rowtotal_nokir_72->tot_nokir_72_debet;
			$kredit_total_nokir_72		= $rowtotal_nokir_72->tot_nokir_72_kredit;
		}
	}
	if ($data_nokir_9 > 0) {
		foreach ($data_nokir_9 as $rowtotal_nokir_9) {
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
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>IKHTISAR LABA/RUGI</b></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"></td>
	</tr>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="center"><b>GRAND TOTAL</b></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($grandtot_saldoawal, 0, ',', '.'); ?></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($grandtot_debet, 0, ',', '.'); ?></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($grandtot_kredit, 0, ',', '.'); ?></td>
		<td style="border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= number_format($grandtot_saldoakhir, 0, ',', '.'); ?></td>
	</tr>
	<?php

	?>
	<tr>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
		<td style="border-top-style:none; border-right:none; border-left-style:none;"></td>
	</tr>

</table>