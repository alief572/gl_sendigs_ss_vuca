
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
			//$bayar 			= $rowf->jumlah;
			$billed_to		= $rowf->billed_to;
			$due_date		= $rowf->due_date;
			$penagih		= $rowf->ditagihkan_oleh;
			$cicilke		= $rowf->bayar_no;
			$tgl_inv		= $rowf->invoice_date;
		}
	}
	if($data_s2 > 0){
		foreach($data_s2 as $row2){
			$cicilke		= $row2->no_bayar;
			//$bayar			= $row2->angsuran_ed;
			$totale			= $bayar + $discount + $dasar_ppn + $ppn + $materai;
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

table.gridtable3 {
	border: 1px solid #C6C6C6;
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
}

</style>
	<table width="100%" class="gridtable">
		<tr>			
			<th align="left"><h2><img src="<?=base_url()?>assets/Logo_Pisilia_Decoration.png"></h2></th>
			<th align="center" class="font"><h1>INVOICE</h1></th>
		</tr>
	</table><br>
	<table width="100%" class="gridtable3">
		
			<tr>
				<td width="14%">Tgl. Invoice</td>
				<td width="30%">: <?=date("d F Y",strtotime($tgl_inv))?></td>
				<td width="20%">ID Customer</td>
				<td>: <?=$nocust?></td>			
			</tr>
			<tr>
				<td>No. Invoice</td>	
				<td>: <?=$inv_no?></td>	
				<td>Nama Pengantin</td>
				<td>: <?=strtoupper($pemesan)?></td>			
			</tr>
			<tr>
				<td>Kepada Yth.</td>	
				<td>: <b><?=strtoupper($pemesan)?></b></td>	
				<td></td>
				<td></td>			
			</tr>
	
	</table><br>
	Detail Invoice
	<table width="100%" class="gridtable">
		<tr class="bg-gray disabled color-palette">
			<td align="center" width="5%" style="background-color:#d2d6de"><b>No<br></b></td>
			<td align="center" width="32%" colspan="2" style="background-color:#d2d6de"><b>Keterangan<br></b></td>
			<td align="center" width="5%" style="background-color:#d2d6de"><b>Jumlah<br></b></td>
			<td align="center" width="10%" style="background-color:#d2d6de"><b>Tgl Resepsi<br></b></td>
			<td align="center" width="20%" style="background-color:#d2d6de"><b>Tempat Resepsi<br></b></td>
			<td align="center" width="10%" style="background-color:#d2d6de"><b>Jam<br></b></td>
			<td align="center" width="10%" style="background-color:#d2d6de"><b>Total Tagihan (Rp)<br></b></td>
		</tr>
		<tr>
			<td align="center" width="3%">1.</td>
			<td align="center" width="32%" colspan="2">Pembayaran ke-<?=$cicilke?> Paket Dekorasi (Spesifikasi Terlampir)</td>
			<td align="center" width="5%">1</td>
			<td align="center" width="10%"><?=date("d F Y",strtotime($tgl_resepsi))?></td>
			<td align="center" width="20%"><?=$tempat_resepsi?></td>
			<td align="center" width="10%"><?=$jam_resepsi?></td>
			<!-- <td align="right" width="10%"><?=number_format($bayar)?></td> -->
			<?php
				if($total > 0){
			?>
			<td align="right"><?=number_format($total)?></td>
			<?php 
				}else{
			?>
			<td align="right"><?=number_format($totale)?></td>
			<?php 
				}
			?>
		</tr>
	</table><br>
	
	<table width="100%" class="gridtable">	
		<tr>
			<?php
				if($total > 0){
			?>
			<td width="100%" colspan="8" align="center">#<?=Terbilang($total)?> rupiah<br>#<?=Terbilang_inggris($total)?> rupiahs</td>
			<?php 
				}else{
			?>
			<td width="100%" colspan="8" align="center">#<?=Terbilang($totale)?> rupiah<br>#<?=Terbilang_inggris($totale)?>
			<?php 
				}
			?> 
		</tr>
	</table><br>

	<table width="100%" class="gridtable3">
		<tr>
			<td align="center" colspan="5"><b>Pembayaran mohon dilakukan melalui :</b></td>
			
		</tr>
		<tr>
			<td align="center" colspan="5"></td>
			
		</tr>
		<tr>
			<td align="center"></td>
			<td align="center"><b>Bank <?=$nm_bank[0]?> <?=$cab_bank[0];?></b></td>
			<td align="center"></td>
			<td align="center"><b>Bank <?=$nm_bank[1]?> <?=$cab_bank[1]?></b></td>
			<td align="center"></td>
		</tr>
		<tr>
			<td align="center"></td>
			<td align="center"><b>Nomor : <?=$no_bank[0]?></b></td>
			<td align="center">atau</td>
			<td align="center"><b>Nomor : <?=$no_bank[1]?></b></td>
			<td align="center"></td>
		</tr>
		<tr>
			<td align="center"></td>
			<td align="center"><b>a.n <?=$an_bank[0]?></b></td>
			<td align="center"></td>
			<td align="center"><b>a.n <?=$an_bank[1]?></b></td>
			<td align="center"></td>
		</tr>
	</table><br>

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
