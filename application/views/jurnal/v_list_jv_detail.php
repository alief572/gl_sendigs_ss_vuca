<style type="text/css">
	.str {
		mso-number-format: \@;
	}
</style>
<?php

$singkat_cbg    = $this->session->userdata('singkat_cbg');
$cek_periode    = $this->db->query("SELECT * FROM periode WHERE stsaktif = 'O' and kdcab='$singkat_cbg'")->result();
if ($cek_periode > 0) {
	foreach ($cek_periode as $brs_periode) {
		$tanggal_periode    = $brs_periode->periode;
		$bln                = substr($tanggal_periode, 0, 2);
		$thn                = substr($tanggal_periode, 3, 4);
	}
}
				
error_reporting(E_ALL & ~E_NOTICE);
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=JV_DETAIL_$bln-$thn.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

				

?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th colspan="7">
			<h2>Daftar JV
				<h3><br>Bulan : <?= $bln?> Tahun : <?= $thn?>
					
		</th>
	</tr>

	<thead>
	<tr>
		<th>No.</th>
		<th>Tgl Transaksi</th>
		<th>No Bukti</th>
		<th>No Coa</th>
		<th>Nama Coa</th>
		<th>Keterangan</th>
		<th>Debet</th>
		<th>Kredit</th>
	</tr>
	</thead>
		<?php
		$i = 0;
		if ($data_listjv > 0) {
			foreach ($data_listjv as $row) {
				$i++;
				$id_buk = $row->nomor;							
											
					$bum = $this->db->query("SELECT * FROM jurnal WHERE nomor='$id_buk'")->result();
					$no  = 0;
					$tdebet = 0;
					$tkredit = 0;
						foreach ($bum as $baris) {
						$no++;			
						$tdebet += $baris->debet;
						$tkredit += $baris->kredit;
						$tgl = date("d-M-Y", strtotime($baris->tanggal));
						
						

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
						echo "<td style='text-align:center'>$baris->keterangan</td>";
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
				echo "<td style='text-align:center'></td>";
				echo "<td style='text-align:center'><b>Jumlah</b></td>";
				echo "<td style='text-align:center'><b>$tdebet</b></td>";
				echo "<td style='text-align:left'><b>$tkredit</b></td>";
				echo "</tr>";
				echo "<tfoot>";
				
				} 
				
			}else{
			echo "<script>alert('DATA TIDAK ADA !')</script>";
			}
?>

</table>
											
