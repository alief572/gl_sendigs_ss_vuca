<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=BUM_JV_$tanggal-_-$tanggal2.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
$dfgh = count($filter_tgl_bum);
?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th colspan="7">
			<h2>Daftar BUM
				<h3><br>Tanggal : <?= date('d-M-Y', strtotime($tanggal)); ?>
					<br>sd Tanggal : <?= date('d-M-Y', strtotime($tanggal2)); ?>
		</th>
	</tr>

	<tr>
		<th>No. BUM</th>
		<th>Tanggal</th>
		<th>Metode Pembayaran</th>
		<th>No. Reff</th>
		<th>Terima Dari</th>
		<th>Note</th>
		<th>Jumlah (Rp.)</th>
	</tr>

	<?php
	$num_temp	= 0;
	if ($filter_tgl_bum > 0) {
		$arr_tgl	= array();
		foreach ($filter_tgl_bum as $row_temp) {
			$num_temp++;
			if (!empty($row_temp->tgl)) {
				$arr_tgl[]	= $row_temp->tgl;

				//$format_jumlah = "Rp. " . number_format($row_temp->jml,0,',','.');
				$format_jumlah = number_format($row_temp->jml, 0, ',', '.');
				$id_buk = $row_temp->nomor;

				$id_bukx = str_replace("-", "_", $id_buk);
				$tgl_buk = date("d-M-Y", strtotime($row_temp->tgl));
				$tgl_bukx = str_replace("-", "_", $tgl_buk);

				echo "<tr>";
				echo "<td style='text-align:center'>$row_temp->nomor</td>";
				echo "<td style='text-align:center'>$tgl_buk</td>";
				echo "<td style='text-align:center'>$row_temp->jenis_reff</td>";
				echo "<td style='text-align:center'>$row_temp->no_reff</td>";
				echo "<td style='text-align:center'>$row_temp->terima_dari</td>";
				echo "<td style='text-align:left'>$row_temp->note</td>";
				echo "<td style='text-align:right'>$format_jumlah</td>";
				//echo "<td style='text-align:right'><a href='".base_url()."'index.php/jurnal/print_request_buk/'".$id_bukx."'/'".$tgl_bukx."' title='Print'  target='blank' class='btn btn-info' width='20%' ><i class='fa fa-print'></i></a></td>";

				echo "</tr>";
			} else {
				$arr_tgl[]	= "";
				echo "<th>Tidak ada data</th>";
			}
		}
	}
	?>
</table>