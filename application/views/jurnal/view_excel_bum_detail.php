<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=BUM_DETAIL_$tanggal-_-$tanggal2.xls"); //ganti nama sesuai keperluan
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
   <thead>
	<tr>
		<th>No.</th>
		<th>Tgl Transaksi</th>
		<th>No Bukti</th>
		<th>No Coa</th>
		<th>Nama Coa</th>
		<th>Debet</th>
		<th>Kredit</th>
	</tr>
	</thead>

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
				
				$bum = $this->db->query("SELECT * FROM jurnal WHERE nomor='$id_buk'")->result();
				$no  = 0;
				$tdebet = 0;
				$tkredit = 0;
				foreach ($bum as $baris) {
				$no++;			
				$tdebet += $baris->debet;
				$tkredit += $baris->kredit;
				$tgl = date("d-M-Y", strtotime($baris->tanggal));
				
				
				$singkat_cbg    = $this->session->userdata('singkat_cbg');
                $cek_periode    = $this->db->query("SELECT * FROM periode WHERE stsaktif = 'O' and kdcab='$singkat_cbg'")->result();
                if ($cek_periode > 0) {
                    foreach ($cek_periode as $brs_periode) {
                        $tanggal_periode    = $brs_periode->periode;
                        $bln                = substr($tanggal_periode, 0, 2);
                        $thn                = substr($tanggal_periode, 3, 4);
                    }
                }

                $kode_cabang    = $this->session->userdata('kode_cabang');
                $data_buk_coa    = $this->db->query("SELECT * FROM coa WHERE no_perkiraan = '$baris->no_perkiraan' and bln='$bln' and thn='$thn' and kdcab='$kode_cabang'")->result();
                if ($data_buk_coa > 0) {
                    foreach ($data_buk_coa as $brs_coa) {
                        $nama_coa = $brs_coa->nama;
                    }
                } else {
                    $nama_coa = "";
                }
				
                echo "<tbody>";
				echo "<tr>";
				echo "<td style='text-align:center'>$no</td>";
				echo "<td style='text-align:center'>$tgl</td>";
				echo "<td style='text-align:center'>$baris->nomor</td>";
				echo "<td style='text-align:center'>'$baris->no_perkiraan</td>";
				echo "<td style='text-align:center'>$nama_coa</td>";
				echo "<td style='text-align:center'>$baris->debet</td>";
				echo "<td style='text-align:left'>$baris->kredit</td>";
				echo "</tr>";
				echo "<tbody>";
				
				
				} 
				
				echo "<tfoot>";
				echo "<tr>";
				echo "<td style='text-align:center'></td>";
				echo "<td style='text-align:center'></td>";
				echo "<td style='text-align:center'></td>";
				echo "<td style='text-align:center'></td>";
				echo "<td style='text-align:center'><b>Jumlah</b></td>";
				echo "<td style='text-align:center'><b>$tdebet</b></td>";
				echo "<td style='text-align:left'><b>$tkredit</b></td>";
				echo "</tr>";
				echo "<tfoot>";
			}
		}
	}
	?>
</table>