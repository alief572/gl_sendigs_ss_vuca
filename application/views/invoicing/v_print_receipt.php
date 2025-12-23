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
			$perusahaan1	= $row7->nama;
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
			$perusahaan		= $rowf->ditagihkan_oleh;
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
				<td rowspan="3" width="20%"><img src="<?=base_url()?>assets/Logo_Pisilia_Decoration.png" width="40%"></td>	
				<td width="5%"></td>
				<td colspan="2" align="center"><h1><b>KWITANSI</b></h1></td>
				<td></td>
			</tr>
			
			<tr>	
				<td width="5%"></td>
				<td width="10%">Nomor : </td>
				<td align="left" class="border1-solid" width="15%"><?=$no_kwitansi?></td>
				<td></td>
			</tr>
		
			<tr>
				<td></td>
			</tr>
		</table>
	</div>
	<br>
	<div style="padding-top:10px">
		<table style="border:0px solid black;padding:10px;width:100%">
			<tr style="padding-top:10px">
				<td class="border1-solid" width="28%">Sudah Terima Dari</td>
				<td width="10px">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="border1-solid"><?=strtoupper($receipt_by)?></td>
			</tr>
			<tr style="padding-top:10px">
				<td><i>Received From</i></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr style="padding-top:10px">
				<td class="border1-solid" width="27%">Jumlah Uang Yang Diterima</td>
				<td width="10px">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="border1-solid">Rp. <?=number_format($bayar,0,',','.')?> (<?=Terbilang($bayar)?> Rupiah)</td>
			</tr>
			<tr style="padding-top:10px">
				<td><i>Amount Recived</i></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr style="padding-top:10px">
				<td class="border1-solid" width="27%">Tanggal & Tempat Event</td>
				<td width="10px">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="border1-solid"><?=date("d F Y",strtotime($tgl_resepsi))?> (<?=$tempat_resepsi?>)</td>
			</tr>
			<tr style="padding-top:10px">
				<td><i>Date & Venue of Event</i></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr style="padding-top:10px">
				<td class="border1-solid" width="27%">Untuk Pembayaran</td>
				<td width="10px">&nbsp;&nbsp;:&nbsp;&nbsp;</td>
				<td class="border1-solid">Pembayaran ke-<?=$bayar_no?> Paket Dekorasi</td>
			</tr>
			<tr style="padding-top:10px">
				<td><i>In Payment Of</i></td>
				<td></td>
				<td></td>
			</tr>
		</table>

		<table style="width: 100%">
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td align="center"><?=$tgl_kwitansi?></td>
				<td style="text-align: right;">Catatan:</td>
			</tr>
			<tr>
				<td style="text-align: center;"></td>
				<td style="text-align: right;"><font size="2">- Pembayaran baru dianggap sah jika cek/giro telah dicairkan</font></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr><br>
			<tr>
				<td align="center">(<?=$an_bank[0]?>)</td>
			</tr>
		</table>

	</div>

</body>
</html>