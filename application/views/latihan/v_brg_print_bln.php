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

</style>
<table class="gridtable2" width="100%">
<tr class="widget-user-header bg-yellow">
		<th colspan="5" style="text-align:center;font-size:15px;" ><center>List Data Coa</center></th>
	</tr>
	<tr class="widget-user-header bg-yellow">
	
 <thead>
  <tr>
   <td>No Perkiraan</td>
   <td>Nama</td>
   <td>kode</td>
   <td>tahun</td>
   <td>bulan</td>
  </tr>
 </thead>
 <tbody>
 <?php



$i=0;
						if($data_stock > 0){
							foreach($data_stock as $row2){
							$i++;
	$noperkiraan 	= $row2->no_perkiraan;
	$nama 	= $row2->nama;
	$kode 	= $row2->kdcab;
	$tahun	= $row2->thn;
	$bulan  = $row2->bln;
	


?>

  <tr>
   <td><?=$noperkiraan?></td>
   <td><?=$nama?></td>
   <td><?=$kode?></td>
   <td><?=$tahun?></td>
   <td><?=$bulan?></td>
  
  </tr>
  
	<?php
							}
						}
					?>			 
 </tbody>
 
 
</table>

			  
					  
					  
					  
 
				
	

