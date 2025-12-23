
<?php
	foreach($data_invoice as $row6){
		if($no == 1){
			$persen = 20;
		}else if($no == 2){
			$persen = 30;
		}else{
			$persen = 0;
		}
		$id_prospek = $row6->id_prospek;
		$tempat_resepsi = $row6->tempat1;
		$tgl_resepsi = $row6->tanggal_respsi;
		$jam_resepsi = date('H:i', strtotime($row6->jam_resepsi));
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
			$id_penawaran 	= $rowf->id_penawaran;
			$ppn 			= $rowf->ppn;
			$total 			= $rowf->total;
			$materai 		= $rowf->materai;
			$dasar_ppn 		= $rowf->dasar_ppn;
			$discount 		= $rowf->penalty;
			$bayar 			= $rowf->jumlah;
			$billed_to		= $rowf->billed_to;
			$due_date		= $rowf->due_date;
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
<style type="text/css">
@page {
	margin-top: 0.5cm;
	margin-bottom: 0.5cm;
    margin-left: 1cm;
    margin-right: 1cm;
}
.font{
	font-family: verdana,arial,sans-serif,tahoma;
	font-size:14px;
}

.fontheader{
	font-family: verdana,arial,sans-serif;
	font-size:14px;
}
table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 0px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family: verdana,arial,sans-serif;
	font-size:10px;
}
table.gridtable2 {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: thin;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable2 th {
	border-width: thin;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.gridtable2 td {
	border-width: 0px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family: verdana,arial,sans-serif;
	font-size:10px;
}
table.bordered td {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.bordered th {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
.aa {
	font-size: 10px;
	color:red;
	margin-top:5px;
}

</style>
	<table width="100%" class="gridtable"  width='100%'>
		<tr>
			<th rowspan="4" width="60"><img src="<?=base_url()?>/assets/logo.jpg" height="80" width="180"></th>
			<th align="right" class="font"><h1>INVOICE</h1></th>
		</tr>
	</table>
	<table width="100%" class="gridtable">
		<tr>
			<td align="left" colspan="5" width="50%"><b><?=$perusahaan?></b><br><?=$alamat."<br>".$kecamatan.", ".$kota."<br>".$no_telfon."<br>".$email1;?></td>
			<td align="right" colspan="5"><b><?=$billed_to?></b><br>
				<?=empty($alamat1) ? "<br>" : $alamat1."<br>";
				echo empty($kota1) ? "<br>" : $kota1.",<br>"; 
				echo empty($telfon1) ? "<br>" : $telfon1."<br>";
				echo empty($emailx) ? "" : $emailx;?>
			</td>
		</tr>
		<tr>
			<td align="center" width="25%" colspan="2"><b>No Invoice</b></td>
			<td align="center" width="25%" colspan="2"><b>ID Customer</b></td>
			<td align="center" width="25%" colspan="2"><b>Nama Pengantin</b></td>
			<td align="center" width="25%" colspan="2"><b>No Penawaran</b></td>
		</tr>
		<tr>
			<td align="center" width="25%" colspan="2"><?=$inv_no?></td>
			<td align="center" width="25%" colspan="2"><?=$nocust?></td>
			<td align="center" width="25%" colspan="2"><?=$pemesan?></td>
			<td align="center" width="25%" colspan="2"><?=$id_penawaran?></td>
		</tr>
		<tr class="bg-gray disabled color-palette">
			<td align="center" width="5%" style="background-color:#d2d6de"><b>No<br></b></td>
			<td align="center" width="32%" colspan="2" style="background-color:#d2d6de"><b>Keterangan<br></b></td>
			<td align="center" width="5%" style="background-color:#d2d6de"><b>Jumlah<br></b></td>
			<td align="center" width="10%" style="background-color:#d2d6de"><b>Tgl Resepsi<br></b></td>
			<td align="center" width="20%" style="background-color:#d2d6de"><b>Tempat Resepsi<br></b></td>
			<td align="center" width="10%" style="background-color:#d2d6de"><b>Jam<br></b></td>
			<td align="center" width="10%" style="background-color:#d2d6de"><b>Harga (Rp)<br></b></td>
		</tr>
		<tr>
			<td align="center" width="3%">1.</td>
			<td align="center" width="32%" colspan="2">Pembayaran ke-<?=$no?> Paket Dekorasi (Spesifikasi Terlampir)</td>
			<td align="center" width="5%">1</td>
			<td align="center" width="10%"><?=date("d F Y",strtotime($tgl_resepsi))?></td>
			<td align="center" width="20%"><?=$tempat_resepsi?></td>
			<td align="center" width="10%"><?=$jam_resepsi?></td>
			<td align="right" width="10%"><?=number_format($bayar)?></td>
		</tr>
		<tr>
			<td align="center" width="50%" rowspan="2" colspan="4">
			<b>Jatuh Tempo Pembayaran : <?=date("d F Y",strtotime($due_date));?><br>
			(Payment Due Date : <?=date("F d, Y",strtotime($due_date));?></b>
			</td>
			<td width="33%" colspan="3">Harga Jual / Penggantian (Sales Price / Replacement)</td>
			<td width="17%" align="right"><?=number_format($bayar)?></td>
		</tr>
		<tr>
			<td colspan="3">Potongan Harga (Discount) / Denda (Penalty)</td>
			<td align="right"><?=$discount?></td>
		</tr>
		<tr>
			<td width="50%" rowspan="4" colspan="4">
			<i>
			NOTE: Apabila Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak menilai adanya
			ketidaksesuaian dengan isi invoice, harap diajukan dalam kurun waktu 7 (tujuh) hari kerja
			dihitung sejak diterimanya invoice oleh customer. Setelah masa tersebut invoice ini dianggap
			disetujui.
			</i>
			</td>
			<td colspan="3">Dasar Pengenaan Pajak (Tax base)</td>
			<td align="right"><?=number_format($dasar_ppn)?></td>
		</tr>
		<tr>
			<td colspan="3">PPN (VAT)</td>
			<td align="right"><?=number_format($ppn)?></td>
		</tr>
		<tr>
			<td colspan="3">Bea Materai (Stamp Duty)</td>
			<td align="right"><?=number_format($materai)?></td>
		</tr>
		<tr>
			<td colspan="3">Total Tagihan (Total Invoice)</td>
			<td align="right"><?=number_format($total)?></td>
		</tr>
		<tr>
			<td width="100%" colspan="8" align="center">#<?=Terbilang($total)?> rupiah<br>#<?=Terbilang_inggris($total)?> rupiahs</td>
		</tr>
		<tr>
			<td width="100%" colspan="8" align="center">Pembayaran dilakukan melalui :<br>Bank <?=$nm_bank[0]?> <?=$cab_bank[0];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank <?=$nm_bank[1]?> <?=$cab_bank[1]?><br>atau&nbsp;&nbsp;&nbsp;&nbsp;<br>Nomor : <?=$no_bank[0]?> a.n <?=$an_bank[0]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor : <?=$no_bank[1]?> a.n <?=$an_bank[1]?></td>
		</tr>
	</table>
	<table width="100%" class="gridtable2">
		<tr>
			<td align="right" colspan="4">
			<?=date("d F Y")?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td align="right" colspan="4" height="100px">
			</td>
		</tr>
		<tr>
			<td colspan="1" width="50%"><i>Print by Staf Finance
			<?=date("d/m/y H:i:s")?></i>
			</td>
			<td  width="25%">
			</td>
			<td align="right"  width="25%">
			( Pisilia Triyana Wibawa )
			</td>
		</tr>
	</table>
	<hr>
