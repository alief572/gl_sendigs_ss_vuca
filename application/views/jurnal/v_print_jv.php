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
		border-width: 1px;
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
<?php
$singkat_cbg	= $this->session->userdata('singkat_cbg');
$company 		= $this->db->query("SELECT * FROM pastibisa_tb_cabang WHERE kdcab = '$singkat_cbg'")->row();
?>
<table width="100%">
	<tr>
		<td width="50%" align="left"><?= $company->cabang ?></td>
		<td rowspan="2" align="right">No. : <?= $nomor_jurnal ?></td>
	</tr>
	<tr>
		<td width="50%"><?= $company->namacabang ?></td>
	</tr>
</table>

<table width="100%">
	<?php
	$nm_bln = $data_bulan_post;
	if ($nm_bln == 1) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br>Periode : Januari " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 2) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Februari " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 3) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Maret " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 4) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : April " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 5) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Mei " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 6) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Juni " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 7) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Juli " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 8) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Agustus " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 9) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : September " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 10) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Oktober " . $data_tahun_post . "</center></th></tr>";
	} elseif ($nm_bln == 11) {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : November " . $data_tahun_post . "</center></th></tr>";
	} else {
		echo "<tr><th style='text-align:center;font-size:15px;'><center>JURNAL VOUCHER<br><br>Periode : Desember " . $data_tahun_post . "</center></th></tr>";
	}
	?>
</table>

<?php
if ($data_javh > 0) {
	foreach ($data_javh as $row_javh) {
?>
		<table width="100%">
			<tr>
				<td width="31%">Penyesuaian Koreksi Data No.</td>
				<td>: <?= $row_javh->koreksi_no ?></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>: <?= date('d-m-Y', strtotime($row_javh->tgl)) ?></td>
			</tr>
		</table>
<?php
	}
}
?>
<br>
KETERANGAN
<table width="100%" class="gridtable2">
	<tr>
		<td><?= $row_javh->keterangan ?> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
	</tr>
</table>
<br>
<table width="100%" class="gridtable2">
	<tr>
		<th>
			<center>No.</center>
		</th>
		<th>
			<center>No. COA</center>
		</th>
		<th>
			<center>KETERANGAN</center>
		</th>
		<th>
			<center>DEBET</center>
		</th>
		<th>
			<center>KREDIT</center>
		</th>
	</tr>

	<?php
	$no = 0;
	$total_debet = 0;
	$total_kredit = 0;
	if ($jurnal_jv > 0) {
		foreach ($jurnal_jv as $row_jurnal) {
			$no++;
	?>
			<tr>
				<td align="center"><?= $no ?>.</td>
				<td align="center"><?= $row_jurnal->no_perkiraan ?></td>
				<td><?= $row_jurnal->keterangan ?></td>
				<td align="right"><?= number_format($row_jurnal->debet, 0, ',', '.') ?></td>
				<td align="right"><?= number_format($row_jurnal->kredit, 0, ',', '.') ?></td>
			</tr>
	<?php
			$total_debet 	+= $row_jurnal->debet;
			$total_kredit 	+= $row_jurnal->kredit;
		}
	}
	?>
	<tr>
		<td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
		<td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
		<td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
		<td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
		<td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
	</tr>
	<tr>
		<td colspan="3" align="right"><b>TOTAL</b></td>
		<td align="right"><b><?= number_format($total_debet, 0, ',', '.') ?></b></td>
		<td align="right"><b><?= number_format($total_kredit, 0, ',', '.') ?></b></td>
	</tr>
</table>
<br>
<table width="100%" class="gridtable2">
	<tr>
		<th>DISETUJUI :</th>
		<th>DIPERIKSA :</th>
		<th>DIBUKUKAN :</th>
	</tr>
	<tr>
		<td><br><br><br><br><br><br></td>
		<td><br><br><br><br><br><br></td>
		<td><br><br><br><br><br><br></td>
	</tr>
</table>
<table width="100%">
	<tr>
		<td align="right">By : <?= strtoupper($this->session->userdata('pn_name')) ?> | <?= date('d M Y') ?> | Jam : <?= date('H:i:s') ?></td>
	</tr>
</table>