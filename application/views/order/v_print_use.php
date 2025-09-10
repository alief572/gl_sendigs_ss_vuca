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
	padding: 10px;
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
<?php
foreach($ket_print as $row2){
	$aju_by 	= $row2->aju_by;
	$app_by 	= $row2->app_by;
	$aju_date 	= $row2->aju_date;
	$app_date 	= $row2->app_date;
	$jum_item 	= $row2->jum_item;
	$jum_barang = $row2->jum_barang;
}
foreach($data_penawaran as $row3){
	$nama 	= $row3->pengantin_pria." & ".$row3->pengantin_wanita;
	$nm_mmkt = $this->order_model->get_nm_marketing($row3->id_prospek);
	$tempat = $row3->tempat1;
	$color_tone = $row3->color_tone;
	$tema = $row3->tema;
	$tanggal_respsi = $row3->tanggal_respsi;
	$jam_resepsi = $row3->jam_resepsi;
}
?>
</style>
<table class="gridtable2" width="100%">
	<tr class="widget-user-header bg-yellow">
		<th colspan="4" style="text-align:center;font-size:15px;" ><center>List Pengajuan Barang SPD</center></th>
	</tr>
	<tr>
		<td><b>Nama Marketing</b></td>
		<td><?=$nm_mmkt?></td>
		<td><b>Tempat</b></td>
		<td><?=$tempat?></td>
	</tr>
	<tr>
		<td><b>Tanggal Checklist</b></td>
		<td><?=date("d-M-Y",strtotime($aju_date))?></td>
		<td><b>Color Tone</b></td>
		<td><?=$color_tone?></td>
	</tr>
	<tr>
		<td><b>Calon Pengantin</b></td>
		<td><?=$nama?></td>
		<td><b>Tema Yang Diinginkan</b></td>
		<td><?=$tema?></td>
	</tr>
	<tr>
		<td><b>Tanggal Resepsi</b></td>
		<td><?=date("d-M-Y",strtotime($tanggal_respsi))?></td>
		<td><b>Jumlah Barang</b></td>
		<td><?=$jum_barang?></td>
	</tr>
	<tr>
		<td><b>Jam Resepsi</b></td>
		<td><?=date("H:i",strtotime($jam_resepsi))?></td>
		<td><b></b></td>
		<td></td>
	</tr>
</table>
<br>
 <table class="gridtable2">
	<tr>
		<th style="background-color:gray">No</th>
		<th style="background-color:gray">Area</th>
		<th style="background-color:gray">Nama Barang</th>
		<th style="background-color:gray">Jumlah</th>
		<th style="background-color:gray">Check</th>
	</tr>

		<?php
		$jum = ceil(count($list_print)/2);
		$no = 0; 
		$nox = $jum; 
		$noxx = 0;
		$areax = "";
		if($list_print > 0){
		foreach($list_print as $row){
			$nm_barang = $row->nm_barang;
			$area = $row->area;
			$jumlah = $row->qty;
			$no++;
			//if($area == $areax){ $area = ""; }
		?>
		<tr>
			<td width="5%" style='background-color:#d3d3d3'>
				<?=$no?>
			</td>
			<td width="15%">
				<?=$area?>
			</td>
			<td width="15%">
				<?=$nm_barang?>
			</td>
			<td width="15%" align="center">
				<?=$jumlah?>
			</td>
			<td width="15%"  align="center">
				<input type="checkbox"  size='1'>
			</td>
		</tr>
	<?php
			$areax= $area;
			}
		}
	?>
  </table>