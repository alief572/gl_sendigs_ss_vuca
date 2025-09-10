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
foreach($list_saldo as $row2){
	$noperkiraan 	= $row2->no_perkiraan;
	$nama 	= $row2->nama;
	$kode 	= $row2->kdcab;
    $saldo 	= $row2->saldoawal;
	$tahun	= $row2->thn;
	$bulan  = $row2->bln;
	
}

?>
</style>
<table class="gridtable2" width="100%">
	<tr class="widget-user-header bg-yellow">
		<th colspan="4" style="text-align:center;font-size:15px;" ><center>List Saldo</center></th>
	</tr>
	<tr>
		<td><b>Nomor Perkiraan</b></td>
		<td><?=$noperkiraan?></td>
		<td><b>Nama</b></td>
		<td><?=$nama?></td>
	</tr>
	<tr>
		<td><b>kode cabang</b></td>
		<td><?=$kode?></td>
        <td><b>saldo awal</b></td>
		<td><?=$saldo ?></td>
		
	</tr>
	<tr>
		<td><b>bulan</b></td>
		<td><?=$bulan?></td>
		<td><b>Tahun</b></td>
		<td><?=$tahun?></td>
	</tr>
	
</table>
