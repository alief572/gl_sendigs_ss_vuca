<?php
	$data_paket = $this->master_model->get_list_paket();
	foreach($data_penawaran as $row6){
		$color_tone		= $row6->color_tone;
		$tema			= $row6->tema; 
		$harga			= $row6->harga_paket;
		$discount		= $row6->discount;
		$total			= $row6->harga;
		$harga_tambahan	= $row6->tambahan_paket;
		$tempat_r1		= $row6->tempat_resepsi1;
		$tempat_r2		= $row6->tempat_resepsi2;
		$tempat_r3		= $row6->tempat_resepsi3;
		$tempat1		= $row6->tempat1;
		$alamat1		= $row6->alamat1;
		$kota1			= $row6->kota1;
		$provinsi1		= $row6->provinsi1;
		$panjang1		= $row6->panjang1;
		$tinggi1		= $row6->tinggi1;
		$lebar1			= $row6->lebar1;
		$jam_resepsi	= $row6->jam_resepsi;
		$t_panggung1	= $row6->t_panggung1;
		$inc_gedung		= $row6->inc_gedung;
		$jenis_paket	= $row6->jenis_paket;
		$harga_app		= $row6->harga_app;
		$diskon_app		= $row6->diskon_app;
		if($inc_gedung == "yes"){
			$che = "checked";
			$re = "readonly";
		}else{
			$che = "";
			$re = "";
		}
	}
	if($harga_app > 0){
		$total			= $harga_app;
		$discount		= $diskon_app;
	}
	if($data_owner > 0){
		$no=0;
		foreach($data_owner as $row7){
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
	if($data_prospek > 0){
		foreach($data_prospek as $row8){
			$pria		= $row8->calon_pria;
			$wanita		= $row8->calon_wanita;
			$email		= $row8->email1;
			$email2		= $row8->email2;
			$telfon		= $row8->telfon;
			$telfon2		= $row8->telfon2;
			$resepsi_date		= $row8->resepsi_date;
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
	border-width: 0px;
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
	border-width: 1px;
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
			<th align="right"><?=$alamat?></th>
		</tr>
		<tr>
			<th align="right"><?=$kecamatan?>, <?=$kota?></th>
		</tr>
		<tr>
			<th align="right"><?=$no_telfon?></th>
		</tr>
		<tr>
			<th align="right"><b><?=$email1?></b></th>
		</tr>
	</table>
	<hr>
	<table table width="100%" class="gridtable"  width='100%'>
		<tr>
			<th align="center"><b>SURAT PEMESANAN DEKORASI</b></th>
		</tr>
	</table>
	<hr>
	<table width="100%" class="gridtable"  width='100%'>
		<tr>
			<td width="25%"><b>Nama Pengantin</b></td>
			<td colspan="3">: <?=$pria?> & <?=$wanita?></td>
		</tr>
		<tr>
			<td><b>Nomor Telpon / HP</b></td>
			<td colspan="3">: <?=$telfon?></td>
		</tr>
		<tr>
			<td><b>Email</b></td>
			<td>: <?=$email?></td>
			<td colspan="2"><?=$email2?></td>
		</tr>
		<tr>
			<td><b>Tanggal Resepsi & Waktu</b></td>
			<td>: <?=date("d-M-Y",strtotime($resepsi_date))?></td>
			<td width="15%"><b>Waktu</b></td>
			<td>: <?=$jam_resepsi?></td>
		</tr>
		<tr>
			<td><b>Tempat</b></td>
			<td>: <?=$tempat1?></td>
			<td><b>Ruang</b></td>
			<td>: </td>
		</tr>
		<tr>
			<td><b>Tema Yang Diinginkan</b></td>
			<td colspan="3">: <?=$tema?></td>
		</tr>
		<tr>
			<td><b>Color Tone</b></td>
			<td colspan="3">: <?=$color_tone?></td>
		</tr>
		<tr>
			<td colspan="4"><b>Bunga Yang Digunakan</b></td>
		</tr>
	</table>
	<table class="gridtable2"  width="100%" id="tabel_paket">
		<tr class="bg-green disabled color-palette">
			<th width="30%" style="background-color:gray">Area</th>
			<th width="50%" style="background-color:gray">Spesifikasi Dekor</th>
			<th width="20%" style="background-color:gray">Keterangan</th>
			<th width="20%" style="background-color:gray">Harga</th>
		</tr>
		<?php
		$no=$i=0;
		if($data_dekor > 0){
			$temp_area = "";
		  foreach($data_dekor as $row){
			$no++;
			$i++;
			$jum = $this->order_model->count_jum($row->id_area,$kd_prospek);
			?>
					<tr>
						<?php
						if($temp_area != $row->nm_area) {?>
							<td rowspan="<?=$jum?>">&nbsp;<?php echo $row->nm_area;?></td>
						<?php
							$temp_area = $row->nm_area;
						}
						?>
						<td>&nbsp;<?=$row->keterangan?></td>
						<td>&nbsp;<?php echo $row->spesifikasi;?></td>
						<td align="right"><?php if($row->tambahan == "Y"){echo number_format($row->harga);}?></td>
					</tr>
					<?php
			}
		}
		?>
		<tr>
			<td colspan="3" align="center"><b>Harga Paket</b></td>
			<td align="right">&nbsp;<b><?=number_format($harga)?></b></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><b>Harga Tambahan Paket</b></td>
			<td align="right">&nbsp;<b><?=number_format($harga_tambahan)?></b></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><b>Discount</b></td>
			<td align="right">&nbsp;<b><?=number_format($discount)?> %</b></td>
		</tr>
		<tr>
			<td colspan="3" align="center"><b>Total</b></td>
			<td align="right">&nbsp;<b><?=number_format($total)?></b></td>
		</tr>
		<tr>
			<td colspan="3">DP 1 : 20% dari harga dekorasi sebagai tanda jadi<br>DP 2 : 50% dari harga dekorasi, dibayarkan 2 bulan sebelum Acara<br>DP 3 : Pelunasan dekorasi, maksimal 2 minggu sebelum acara</td>
			<td></td>
		</tr>
	</table>
	<table width="100%" class="gridtable"  width='100%'>
		<tr>
			<td colspan="3">Pembayaran dilakukan melalui :</td>
		</tr>
		<tr>
			<td>Bank <?=$nm_bank[0]?> <?=$cab_bank[0];?></td>
			<td rowspan="3">atau</td>
			<td>Bank <?=$nm_bank[1]?> <?=$cab_bank[1]?></td>
		</tr>
		<tr>
			<td>Nomor : <?=$no_bank[0]?> a.n <?=$an_bank[0]?></td>
			<td>Nomor : <?=$no_bank[1]?> a.n <?=$an_bank[1]?></td>
		</tr>
	</table>
	<table width="100%" class="gridtable"  width='100%'>
		<tr>
			<td>Note:</td>
		</tr>
		<tr>
			<td>- Pihak dekorasi berkewajiban dan bertanggung jawab untuk melakukan dekorasi pernikahan pada tempat & tanggal yang tertera diatas sesuai dengan perjanjian yang tertulis pada Surat Pemesanan Dekorasi ini.</td>
		</tr>
		<tr>
			<td>- Selama belum adanya pembayaran Tanda Jadi (DP 1), maka belum ada ikatan janji pesanan maupun kesepakatan harga, maka dapat dibatalkan oleh kedua belah pihak.</td>
		</tr>
		<tr>
			<td>- Segala bentuk pembatalan sebagian maupun seluruh pesanan, menyebabkan secara otomatis transaksi dibatalkan dan uang muka yang sudah dibayarkan tidak dapat dikembalikan</td>
		</tr>
	</table>
		<?php 
		for($a=$i;$a<17;$a++){
			echo "<br>";
		}
		?>
	<table width="100%" class="gridtable"  width='100%'>
		<tr>
			<td width="50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dibuat Oleh,</td>
			<td width="50%" align="right">Menyetujui,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td height="100px"></td>
			<td></td>
		</tr>
		<tr>
			<td>Tanda Tangan & Nama Jelas</td>
			<td align="right">Tanda Tangan & Nama Jelas</td>
		</tr>
		<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;( Pisilia Triyana Wibawa )</td>
			<td align="right">( <?=$pria?> & <?=$wanita?> )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>