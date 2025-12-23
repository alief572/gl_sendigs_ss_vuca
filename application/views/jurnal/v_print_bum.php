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
foreach($list_print as $row){
	$nomor_bum 	= $row->nomor;
	$tgl_input	= $row->tgl;
	$trima_dr 	= $row->terima_dari;
	$var_note 	= $row->note;
	$metod_byr 	= $row->jenis_reff;
	$reff_byr 	= $row->no_reff;

	$format_total = "Rp. " . number_format($row->jml,0,',','.');
}

foreach($data_keluardr as $row3){
	$keluar_dari = $row3->no_perkiraan;
	$keluar_dari2 = $row3->keterangan;
	
}

?>
</style>
<table class="gridtable2" width="100%">
	<tr class="widget-user-header bg-yellow">
		<th colspan="4" style="text-align:center;font-size:15px;" ><center>BUKTI UANG MASUK (BUM)</center></th>
		
	</tr>
	<tr>
		<td><b>No. BUM</b></td>
		<td><?=$nomor_bum?></td>
		<td><b>Tanggal Input</b></td>
		<td><?=date("d-M-Y",strtotime($tgl_input))?></td>
	</tr>
	<tr>
		<td><b>Terima Dari</b></td>
		<td><?=$trima_dr?></td>
		<td><b>No. Reff</b></td>
		<td><?=$reff_byr?></td>	
	</tr>
	<?php
		$panggil_nama_perkiraan = $this->db->query("SELECT nama FROM COA WHERE no_perkiraan = '$keluar_dari' ORDER BY no_perkiraan;");
	
			foreach($panggil_nama_perkiraan->result() as $row4){
				$nama_coa = $row4->nama;
				$gab_coa = $keluar_dari;				
			}		
	?>
	<tr>
		<td rowspan="2"><b>Setor Ke</b></td>
		<td><?=$gab_coa?> <?=$nama_coa?></td>
		<td><b>Metode Pembayaran</b></td>
		<td><?=$metod_byr?></td>		
	</tr>
	<tr>
		
		<td><?=$keluar_dari2?></td>
		<td><b>Note</b></td>
		<td><?=$var_note?></td>	
		
	</tr>
</table>
<br>
 <table class="gridtable2">
 <tr>
		<th style="background-color:gray">No. Perkiraan</th>
		<th style="background-color:gray">Keterangan</th>
		<th style="background-color:gray">Project</th>
		<th style="background-color:gray">Debit</th>
		<th style="background-color:gray">Kredit</th>
	</tr>

 <?php

		if($list_detail > 0){
		foreach($list_detail as $row2){
		
			$nomor_kira 	= $row2->no_perkiraan;
			$data_ket 		= $row2->keterangan;
			$data_project = $row2->no_reff;
			
			$format_debet = "Rp. " . number_format($row2->debet,0,',','.');
			$format_kredit = "Rp. " . number_format($row2->kredit,0,',','.');
			
		?>
		<tr>
			
			<td width="15%">
				<?=$nomor_kira?>
			</td>
			<td width="15%">
				<?=$data_ket?>
			</td>
			<td width="15%">
				<?=$data_project?>
			</td>
			<td width="15%">
				<?=$format_debet?>
			</td>
			<td width="15%">
				<?=$format_kredit?>
			</td>
			
		</tr>
	<?php
		
			}
		}
	?>

	<tr>
		
		<td colspan="3" align="right"><b>Grand Total</b></td>
		<td colspan="2"><?=$format_total?></td>
	</tr>
  </table>