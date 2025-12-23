<!DOCTYPE html>
<html>
<head>
	<title>PRINT RECEIPT</title>
</head>
<style>
	html{
		padding: 20px;
	}
	.border1-solid{
	    border-bottom: 1px solid black;
	}
	.border2-solid{
	    border-bottom: 2px solid black;
	}
	.border1-dashed{
	    border-bottom: 0.5px dashed black;
	}
	td{
		font-size: 12;
	}
</style>
<body>
<?php
	foreach($data_invoice as $row6){
		if($no == 1){
			$persen = 20;
		}else if($no == 2){
			$persen = 30;
		}else{
			$persen = 0;
		}

		$id_prospek 	= $row6->id_prospek;
		$tempat_resepsi = $row6->tempat1;
		$tgl_resepsi 	= $row6->tanggal_respsi;
		$jam_resepsi 	= date('H:i', strtotime($row6->jam_resepsi));

		/* $dp1 = $row6->dp1;
		$dp2 = $row6->dp2;
		$dp3 = $row6->dp3;
		$dp4 = $row6->dp4;
		$total_deal = $row6->total_deal;
		$sisa_total = $total_deal;
		$bayar = $sisa_total * $persen/100;
		if($no == 3){
			$bayar = $total_deal - $dp1 - $dp2 - $dp3 - $dp4;
		} */
	}

	if($data_owner > 0){
		$no =0;
		foreach($data_owner as $row7){
			$perusahaan	= $row7->nama;
			$alamat		= $row7->alamat;
			$kecamatan	= $row7->kecamatan;
			$kota		= $row7->kota;
			$no_telfon	= $row7->no_telfon;
			$email1		= $row7->email1;
			$nm_bank[$no]	= $row7->nm_bank;
			$no_bank[$no]	= $row7->no_bank;
			$cab_bank[$no]	= $row7->cab_bank;
			$an_bank[$no]	= $row7->an_bank;
			$no++;
		}
	}

	if($data_s > 0){
		foreach($data_s as $rowf){
			$nocust 		= $rowf->nocust;
			$pemesan 		= $rowf->pria." & ".$rowf->wanita;
			$inv_no 		= $rowf->invoice_no;
			$bayar_no		= $rowf->bayar_no;
			$id_penawaran 	= $rowf->id_penawaran;
			$ppn 			= $rowf->ppn;
			$total 			= $rowf->total;
			$materai 		= $rowf->materai;
			$dasar_ppn 		= $rowf->dasar_ppn;
			$discount 		= $rowf->penalty;
			$bayar 			= $rowf->bayar;
			$billed_to		= $rowf->billed_to;
			$due_date		= $rowf->due_date;
			$no_kwitansi	= $rowf->no_kwitansi;
			$tgl_kwitansi	= date('d F Y', strtotime($rowf->tgl_kwitansi));
			$receipt_by		= $rowf->receipt_by;
		}
	}

	if($data_customer > 0){
		foreach($data_customer as $rowf){
			$alamat1 		= $rowf->alamat1;
			$kota1 			= $rowf->kota1;
			$telfon1 		= $rowf->telfon;
			$emailx 		= $rowf->email1;
		}
	}
?>
	<div>
		<table style="width:100%;">
			<tr>
				<td rowspan="7" style="width:20%"><B>PT. ANUGRAH KREASINDO MULIA</B></td>
				<td style="width:55%"><b><?=strtoupper($perusahaan)?></b></td>
				<td colspan="3" class="border2-solid"><b>KWITANSI</b></td>
			</tr>
			<tr>
				<td><?=$alamat?></td>
				<td colspan="3"><b>RECEIPT</b></td>
			</tr>
			<tr>
				<td><?=$kecamatan?></td>
			</tr>
			<tr>
				<td><?=$kota?></td>
			</tr>
			<tr>
				<td>Telp. <?=$no_telfon?></td>
				<td class="border1-solid">No</td>
				<td>:</td>
				<td class="border1-dashed"><?=$no_kwitansi?></td>
			</tr>
			<tr>
				<td>Email: <?=$email1?></td>
				<td>Number</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
	</div>
	
	<div style="padding-top:10px">
		<table style="border:1px solid black;padding:10px;width:100%">
			<tr style="padding-top:10px">
				<td class="border1-solid" width="20%">Sudah Terima Dari</td>
				<td width="10px">:</td>
				<td class="border1-dashed"><?=$receipt_by?></td>
			</tr>
			<tr style="padding-top:10px">
				<td>Received From</td>
				<td></td>
				<td></td>
			</tr>
			<tr style="padding-top:10px">
				<td class="border1-solid" width="20%">Banyaknya uang</td>
				<td width="10px">:</td>
				<td class="border1-dashed"><?=Terbilang($bayar)?> rupiah</td>
			</tr>
			<tr style="padding-top:10px">
				<td>Amount Recived</td>
				<td></td>
				<td></td>
			</tr>
			<tr style="padding-top:10px">
				<td class="border1-solid" width="20%">Untuk Pembayaran</td>
				<td width="10px">:</td>
				<td class="border1-dashed">Pembayaran ke-<?=$bayar_no?> Paket Dekorasi</td>
			</tr>
			<tr style="padding-top:10px">
				<td>In Payment Of</td>
				<td></td>
				<td></td>
			</tr>
		</table>

		<table style="width: 100%">
			<tr>
				<td>
					<hr width="75%" style="margin:5px 0; text-align:left">
					<div>&nbsp;&nbsp;&nbsp;<b>Rp. <font size="4"><?=number_format($bayar)?></font></b></div>
					<hr width="75%" style="margin:5px 0; text-align:left">
				</td>
				<td style="text-align: right;">
					<?=$kecamatan." - ".$kota.", ".$tgl_kwitansi?>
				</td>
			</tr>
		</table>

		<div style="padding-top: 10px"><font size="2">Catatan:</font></div>
		<div><font size="2">- Pembayaran baru dianggap sah jika cek/giro telah dicairkan</font></div>

		<div style="text-align: right; font-size: 12;"><?=$an_bank[0]?></div>
		<hr width="20%" style="text-align:right; margin: 0 5px">
		<div style="text-align: right; margin-right: 50px; font-size: 12;">Owner</div>

	</div>

</body>
</html>