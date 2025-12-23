<style type="text/css">
@page {
	margin-top: 0cm;
	margin-bottom: 0cm;
    margin-left: ;
    margin-right: ;
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
	border-width: 0px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
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
	margin-top:0px;
}
table.gridtable1 {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: thin;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable1 th {
	border-width: thin;
	border-width: 0px;
	padding: 10px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.gridtable1 td {
	border-width: 0px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family: verdana,arial,sans-serif;
	font-size:10px;
}
table.bordered td {
	border-width: 0px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	background-color: #ffffff;
	font-family:tahoma;
	font-size:11px;
}
table.bordered th {
	border-width: 0px;
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
	<?php

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
<br>
<table class="gridtable2" width="100%">
<tr class="widget-user-header bg-yellow">
		<th colspan="5" style="text-align:center;font-size:15px;" border="0" ><center>DATA JV</center></th>
		
	</tr>
 <tr>
		<th style="background-color:gray">No Perkiraan</th>
		<th style="background-color:gray">Keterangan</th>
		<th style="background-color:gray">Reff</th>
		<th style="background-color:gray">Debet</th>
		<th style="background-color:gray">Kredit</th>
	</tr>
    <?php
				$i=0;
					$totaldb=0;
					$totalkr=0;
				    if($data_d_listjv > 0){
					foreach($data_d_listjv as $row){
					$i++;
				    $debet=$row->debet;
					$kredit=$row->kredit;
					$totaldb += $debet;

			    	$totalkr += $kredit;
	?>
		<tr>
			
			<td >
			<?=$row->no_perkiraan?>
			</td>
			<td >
            <?=$row->keterangan?>
			</td>
			<td>
            <?=$row->no_reff?>
			</td>
			<td >
            <?= number_format($row->debet,0,',','.');?>
			</td>
			<td >
            <?= number_format($row->kredit,0,',','.');?>
			</td>
			
		</tr>
	<?php
		
                    }
                }
	?>

	  </table>
	</body>
</html>