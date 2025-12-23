<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=QueryJurnal_$tanggal-_-$tanggal2.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
$dfgh = count($filter_tgl);
?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
	<!-- <tr>
		<th>
			<h2>
				<h3>
		</th> -->
	<!--<th colspan="<?= 5 + $dfgh; ?>"><h2><h3></th>-->
	<!-- </tr> -->
	<tr>
		<th colspan="8">
			<h2>Daftar Jurnal<h3><br>Tanggal : <?= date('d-M-Y', strtotime($tanggal)); ?>
					<br>sd Tanggal : <?= date('d-M-Y', strtotime($tanggal2)); ?>
		</th>
		<!--
		<th colspan="<?= 1 + $dfgh; ?>"><h2>Daftar Jurnal<h3><br>Tanggal : <?= date('d-M-Y', strtotime($tanggal)); ?>
     		<br>sd Tanggal : <?= date('d-M-Y', strtotime($tanggal2)); ?> 
    	</th>
		-->
	</tr>

	<tr>
		<th>
			<center>Tipe</center>
		</th>
		<th>
			<center>Tanggal</center>
		</th>
		<th>
			<center>No. Jurnal</center>
		</th>
		<th>
			<center>No. COA</center>
		</th>
		<th>
			<center>Keterangan</center>
		</th>
		<th>
			<center>No. Reff</center>
		</th>
		<th>
			<center>Debit</center>
		</th>
		<th>
			<center>Kredit</center>
		</th>
	</tr>

	<?php
	$i = 0;
	$sum_debet	= 0;
	$sum_kredit	= 0;
	if ($filter_query > 0) {
		$no = 0;
		foreach ($filter_query as $row) {
			$no++;

			$format_debet = number_format($row->debet, 0);
			// $format_debet = number_format($row->debet, 0, ',', '.');
			$format_kredit = number_format($row->kredit, 0);

			$sum_debet		+= $row->debet;
			$sum_kredit		+= $row->kredit;
			$sum_debet_rp 	= number_format($sum_debet, 0, ',', '.');
			$sum_kredit_rp 	= number_format($sum_kredit, 0, ',', '.');
	?>
			<tr>
				<td align="center"><?= $row->tipe ?></td>
				<td align="center"><?= date_format(new DateTime($row->tanggal), "d-m-Y") ?></td>
				<td align="center"><?= $row->nomor ?></td>
				<td class="str" align="center"><?= $row->no_perkiraan ?></td>
				<td><?= $row->keterangan ?></td>
				<td align="center"><?= $row->no_reff ?></td>
				<td align="right"><?= $format_debet ?></td>
				<td align="right"><?= $format_kredit ?></td>
			</tr>
	<?php
		}
	} else {
		$sum_debet_rp 	= 0;
		$sum_kredit_rp 	= 0;
		echo "<div><center>DATA TIDAK ADA</center></div>";
	}
	echo "<tr>";
	echo "<td colspan='6' style='text-align:right'><b>TOTAL</b></td>";
	echo "<td style='text-align:right'><b>$sum_debet_rp</b></td>";
	echo "<td style='text-align:right'><b>$sum_kredit_rp</b></td>";
	echo "</tr>";
	?>
</table>