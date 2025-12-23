<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=BUK_$tanggal-_-$tanggal2.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

// $temp_file_uri = tempnam('', 'xyz');
// //$objWriter->save($temp_file_uri);
// //header('Content-Description: File Transfer');
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// //header("Content-type: application/octet-stream");
// header("Content-Disposition: attachment; filename=BUK_$tanggal-_-$tanggal2.xls"); //ganti nama sesuai keperluan
// //header('Content-Transfer-Encoding: binary');
// header("Pragma: no-cache");
// header("Expires: 0");
// // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// // header('Pragma: public');
// header('Content-Length: ' . filesize($temp_file_uri));
// // ob_clean();
// flush();
// //$status = readfile($temp_file_uri);
// readfile($temp_file_uri);
// unlink($temp_file_uri); // deletes the temporary file
// exit;
?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th colspan="9">
			<h2>Daftar BUK
				<h3><br>Tanggal : <?= date('d-M-Y', strtotime($tanggal)); ?>
					<br>sd Tanggal : <?= date('d-M-Y', strtotime($tanggal2)); ?>
		</th>
	</tr>

	<tr>
		<th>No. BUK</th>
		<th>Tanggal</th>
		<th>Metode Pembayaran</th>
		<th>Uang Keluar Dari</th>
		<!-- <th>No.Perkiraan Biaya</th> -->
		<th>No. Reff</th>
		<th>Bayar Kepada</th>
		<th>Note</th>
		<th>Jumlah (Rp.)</th>
	</tr>

	<?php
	$num_temp	= 0;
	if ($filter_tgl > 0) {
		$arr_tgl	= array();
		foreach ($filter_tgl as $row_temp) {
			$num_temp++;
			if (!empty($row_temp->tgl)) {
				$arr_tgl[]	= $row_temp->tgl;

				//$format_jumlah = "Rp. " . number_format($row_temp->jml,0,',','.');
				$format_jumlah = number_format($row_temp->jml, 0, ',', '.');
				$id_buk = $row_temp->nomor;

				// $id_bukx = str_replace("-", "_", $id_buk);
				// $tgl_buk = date("d-M-Y", strtotime($row_temp->tgl));
				$tgl_buk = date_format(new DateTime($row_temp->tgl), "d-m-Y");
				// $tgl_bukx = str_replace("-", "_", $tgl_buk);

				$data_uang_keluar_dari = $this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$id_buk' and no_perkiraan like '1102%' and debet=0")->result();

				// $data_nokir_biaya = $this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$id_buk' and no_perkiraan like '6%'")->result();

				if ($data_uang_keluar_dari > 0) {
					foreach ($data_uang_keluar_dari as $row_jurnal1) {
						$uang_keluar_dari = $row_jurnal1->no_perkiraan;
						$format_jumlah = number_format($row_jurnal1->kredit, 0, ',', '.');
								$totalrp += $row_jurnal1->kredit;
								$total = number_format($totalrp, 0, ',', '.');
						
					}
					$singkat_cbg = $this->session->userdata('singkat_cbg');
					$cek_periode	= $this->db->query("SELECT * FROM periode WHERE stsaktif = 'O' and kdcab='$singkat_cbg'")->result();
					if ($cek_periode > 0) {
						foreach ($cek_periode as $brs_periode) {
							$tanggal_periode	= $brs_periode->periode;
							$bln				= substr($tanggal_periode, 0, 2);
							$thn				= substr($tanggal_periode, 3, 4);
						}
					}
					$kode_cabang	= $this->session->userdata('kode_cabang');
					$data_buk_coa = $this->db->query("SELECT * FROM COA WHERE no_perkiraan = '$uang_keluar_dari' and bln='$bln' and thn='$thn' and kdcab='$kode_cabang'")->result();
					if ($data_buk_coa > 0) {
						foreach ($data_buk_coa as $brs_coa) {
							$nama_coa = $brs_coa->nama;
						}
					}
				}
	?>
				<tr>
					<td style="text-align:center"><?= $row_temp->nomor ?></td>
					<td style="text-align:center"><?= $tgl_buk ?></td>
					<td style="text-align:center"><?= $row_temp->jenis_reff ?></td>
					<td style="text-align:center"><?= $nama_coa ?></td>
					<!-- <td class="str" style="text-align:center"><?= $nokir_biaya ?></td> -->
					<td style="text-align:center"><?= $row_temp->no_reff ?></td>
					<td style="text-align:center"><?= $row_temp->bayar_kepada ?></td>
					<td style="text-align:left"><?= $row_temp->note ?></td>
					<td style="text-align:right"><?= $format_jumlah ?></td>
				</tr>
				<?php
				// if ($data_nokir_biaya > 0) {
				// 	foreach ($data_nokir_biaya as $row_jurnal2) {
				// 		$nokir_biaya = $row_jurnal2->no_perkiraan;
				// 	}
				// }
				// echo "<tr>";
				// echo "<td style='text-align:center'>$row_temp->nomor</td>";
				// echo "<td style='text-align:center'>$tgl_buk</td>";
				// echo "<td style='text-align:center'>$row_temp->jenis_reff</td>";
				// echo "<td style='text-align:center'>$nama_coa</td>";
				// // echo "<td class='str' style='text-align:center'>$nokir_biaya</td>";
				// echo "<td style='text-align:center'>$row_temp->no_reff</td>";
				// echo "<td style='text-align:center'>$row_temp->bayar_kepada</td>";
				// echo "<td style='text-align:left'>$row_temp->note</td>";
				// echo "<td style='text-align:right'>$format_jumlah</td>";
				// //echo "<td style='text-align:right'><a href='".base_url()."'index.php/jurnal/print_request_buk/'".$id_bukx."'/'".$tgl_bukx."' title='Print'  target='blank' class='btn btn-info' width='20%' ><i class='fa fa-print'></i></a></td>";

				// echo "</tr>";
				// } else {
				// 	$arr_tgl[]	= "";
				// 	echo "<th>Tidak ada data</th>";
				// }
				?>
	<?php
			} else {
				$arr_tgl[]	= "";
				echo "<th>Tidak ada data</th>";
			}
		}
	}
	?>
</table>