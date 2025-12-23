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
foreach($list_head as $rowx){
	$id_aju 		= $rowx->id_aju;
	$tgl_aju 		= $rowx->tgl_aju;
	$insert_by 		= $rowx->insert_by;
	$jumlah 		= $rowx->jumlah;
	$approve_by 	= $rowx->approve_by;
	$approve_date 	= $rowx->approve_date;
}
?>
</style> 
 <table class="gridtable2" width="100%">
	<tr class="widget-user-header bg-yellow">
		<th colspan="8" style="text-align:center;font-size:15px;" ><center>List Pengajuan Barang Baru</center></th>
	</tr>
	<tr>
		<td widtd="5%" colspan="2">Diajukan Oleh</td>
		<td widtd="15%" colspan="2"><?=$insert_by?></td>
		<td widtd="15%" colspan="2">Approve Oleh</td>
		<td widtd="15%" colspan="2"><?=$approve_by?></td>
	</tr>
	<tr>
		<td widtd="5%" colspan="2">Diajukan Tanggal</td>
		<td widtd="15%" colspan="2"><?=$id_aju?></td>
		<td widtd="15%" colspan="2">Approve Tanggal</td>
		<td widtd="15%" colspan="2"><?=$approve_date?></td>
	</tr>
	<tr>
		<td widtd="5%" colspan="2">Jumlah Item</td>
		<td widtd="15%" colspan="2"><?=$jumlah?></td>
		<td widtd="15%" colspan="2">Id Pengajuan</td>
		<td widtd="15%" colspan="2"><?=$id_aju?></td>
	</tr>
 </table>
 <br>
 <table class="gridtable2">
	<tr>
		<th width="5%" style="background-color:gray">No</th>
		<th width="15%" style="background-color:gray">Nama Barang</th>
		<th width="15%" style="background-color:gray">Jumlah</th>
		<th width="15%" style="background-color:gray">Check</th>
		<th width="5%" style="background-color:gray">No</th>
		<th width="15%" style="background-color:gray">Nama Barang</th>
		<th width="15%" style="background-color:gray">Jumlah</th>
		<th width="15%" style="background-color:gray">Check</th>
	</tr>

		<?php
		$jum = ceil(count($list_print)/2);
		$no = 0; 
		$nox = $jum; 
		$noxx = 0;
		if($list_print > 0){
		foreach($list_print as $row){
			$nm_barang = $row->nm_barang;
			$jumlah = $row->jumlah;
			$no++;
			$aaa = $no % 2;
			if($aaa == 1){
				echo "<tr>";
				$noxx++;
			}else{
				$nox++;
			}
		?>
		
		<td width="5%">
			<?php 
				if($aaa == 1){
					echo $noxx;
				}else{
					echo $nox;
				}
			?>
		</td>
			<td width="15%"><?=$nm_barang?>
		</td>
			<td width="15%" align="center"><?=$jumlah?>
		</td>
		<td width="15%"  align="center">
			<input type="checkbox"  size='1'>
		</td>
	<?php
			}
		}
		
		if($jum%2==1){
			$var = 0;
		}else{
			$var = 1;
		}
		for($i=0;$i<$var;$i++){
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		}
	?>
  </table>
   <br>
  <table class="gridtable" width="100%">
	<tr>
		<td width="30%" align="center"></td>
		<td align="center"></td>
		<td align="center" width="30%">Jakarta, <?=date("d F Y")?></td>
	</tr>
	<br>
	<tr>
		<td align="center">DIAJUKAN OLEH</td>
		<td align="center"></td>
		<td align="center">DISETUJUI OLEH</td>
	</tr>
	<tr>
		<td height="70px"></td>
		<td align="center"></td>
		<td align="center"></td>
	</tr>
	<tr>
		<td align="center">(____________________________)</td>
		<td></td>
		<td align="center">(____________________________)</td>
	</tr>
  </table>