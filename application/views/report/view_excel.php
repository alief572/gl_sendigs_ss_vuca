<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Jurnal_$tanggal-_-$tanggal2.xls"); //ganti nama sesuai keperluan
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
		<th colspan="9">
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

		<th>Tanggal</th>
		<th>Nomor</th>
		<th>Tipe</th>
		<th>Nama.COA</th>
		<th>No.JV</th>
		<th>Keterangan</th>
		<th>No. Reff</th>
		<th>Debit</th>
		<th>Kredit</th>
	</tr>

	<?php
	$num_temp	= 0;
	$sum_debet	= 0;
	$sum_kredit	= 0;
	if ($filter_tgl > 0) {
		$arr_tgl	= array();
		foreach ($filter_tgl as $row_temp) {
			$num_temp++;
			if (!empty($row_temp->tanggal)) {
				$arr_tgl[]		= $row_temp->tanggal;
				$format_debet 	= number_format($row_temp->debet, 0, ',', '.');
				$format_kredit 	= number_format($row_temp->kredit, 0, ',', '.');
				$sum_debet		+= $row_temp->debet;
				$sum_kredit		+= $row_temp->kredit;
				$sum_debet_rp 	= number_format($sum_debet, 0, ',', '.');
				$sum_kredit_rp 	= number_format($sum_kredit, 0, ',', '.');

				echo "<tr>";
				echo "<td style='text-align:center'><b>" . date_format(new DateTime($row_temp->tanggal), "d-m-Y") . "</b></td>";
				echo "<td style='text-align:center'><b>$row_temp->nomor</b></td>";
				echo "<td style='text-align:center'><b>$row_temp->tipe</b></td>";
				echo "<td style='text-align:left'><b>$row_temp->nama</b></td>";
				echo "<td class='str' style='text-align:center'><b>$row_temp->no_perkiraan</b></td>";
				echo "<td style='text-align:left'><b>$row_temp->keterangan</b></td>";
				echo "<td style='text-align:center'><b>$row_temp->no_reff</b></td>";
				echo "<td style='text-align:right'><b>$format_debet</b></td>";
				echo "<td style='text-align:right'><b>$format_kredit</b></td>";
				echo "</tr>";
			} else {
				$arr_tgl[]	= "";
				echo "<th>Tidak ada data</th>";
			}
		}
	} else {
		$sum_debet_rp 	= 0;
		$sum_kredit_rp 	= 0;
	}
	echo "<tr>";
	echo "<td colspan='7' style='text-align:right'><b>TOTAL</b></td>";
	echo "<td style='text-align:right'><b>$sum_debet_rp</b></td>";
	echo "<td style='text-align:right'><b>$sum_kredit_rp</b></td>";
	echo "</tr>";
	?>
</table>