<style type="text/css">
@page {
	margin-top: 0cm;
	margin-bottom: 0cm;
	margin-left: ;
	margin-right: ;
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
	#kiri
	{
	width:50%;
	height:100px;
	/* background-color:#FF0; */
	float:left;
	}
	#kanan
	{
	width:50%;
	height:100px;
	/* background-color:#0C0; */
	float:right;
	}
	</style>

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
	$terima_dari = $row3->no_perkiraan;
	$keluar_dari2 = $row3->keterangan;
	
}

?>
<table class="gridtable1" width="100%">	
<?php
$i=0;
$kode_cabang	= $this->session->userdata('kode_cabang');
$cek_periode	= $this->db->query("SELECT * FROM periode WHERE stsaktif = 'O'")->result();
								if($cek_periode > 0){
									foreach($cek_periode as $brs_periode){
										$tanggal_periode	= $brs_periode->periode;
										$bln				= substr($tanggal_periode,0,2);
										$thn				= substr($tanggal_periode,3,4);
									}
								}
		$panggil_nama_perkiraan = $this->db->query("SELECT nama FROM COA WHERE no_perkiraan = '$terima_dari' and bln='$bln' and thn='$thn' and kdcab='$kode_cabang' ORDER BY no_perkiraan;");
	
			foreach($panggil_nama_perkiraan->result() as $row4){
				$nama_coa = $row4->nama;
				$gab_coa = $terima_dari;				
			}	
			$i++;	
	?>

	<tr class="widget-user-header bg-yellow">
		<th colspan="4" style="text-align:center;font-size:15px;" border="0" ><center>BUKTI UANG BUM (BUM)</center></th>
		
	</tr>

	<tr td border ="0">
	<td width="10%"><b>No. BUM</b></td>
	<td width ="1%">:</td>
	<td ><?=$nomor_bum?></td>
	</tr>
	<tr>
	<td width="15%"><b>Diterima Dari</b></td>
	<td width="1%">:</td>
	<td ><?=$trima_dr?></td>
	</tr>
	<tr>
	<td width="10%"><b>Bank/Kas</b></td>
	<td width="1%">:</td>
	<td><?=$terima_dari?> (<?=$nama_coa?>)</td>	
		</tr>
		
</table><br>
<table class="gridtable2">
 <tr>
		<th style="background-color:gray">No</th>
		<th style="background-color:gray">Keterangan</th>
		<th style="background-color:gray">Reff</th>
		<th style="background-color:gray">No. Perkiraan</th>
		<th style="background-color:gray">Jumlah</th>
	</tr>
<?php
			$no = 0;
			$GrandTot = 0;
			if($list_detail3 > 0 ){
				foreach($list_detail3 as $row_jur){
					$no++;
					$ket = $row_jur->keterangan;
					$reff = $row_jur->no_reff;
					$nokir = $row_jur->no_perkiraan;
					$jumlah = $row_jur->kredit;
					$GrandTot += $jumlah;
		?>
		<tr>	
			<td width="5%" height="10%">
				<?=$no?>
			</td>
			
			<td width="15%" height="30px">
				<?=$ket?>
			</td>
			
			<td align="center" width="15%">
				<?=$reff?>
			</td>
			
			<td align="center" width="15%" height="30px">
				<?=$nokir?>
			</td>
			
			<td align="right" width="15%" height="30px">
				<?=number_format($jumlah)?>
			</td>	
		</tr>
		<?php
				}
			}
			// print_r($row_jur->keterangan);
		?>
		
		<tr>	
			<td colspan="4" align="right"><b>Grand Total</b></td>
			<td colspan="" align="right"><?=number_format($GrandTot)?></td>
		</tr>
  </table>
	<table class="gridtable1" width="100%">
	
	<tr td border ="0">
	<td width="10%"><b>Note</b></td>
	<td width ="1%">:</td>
	<td height="40px"><?=$var_note?></td>
	</tr>
	
</table>

<div id="kiri">
		<table class="gridtable2" width="100%" align="left" cellpadding="2" cellspacing="0">
			<tr>
				<th style="background-color:gray">Dibukukan</th>
				<th style="background-color:gray">Diperiksa</th>
				<th style="background-color:gray">Disetujui</th>		
			</tr>
		
			<tr height="50px">		
				<td height="50px"></td>
				<td height="50px"></td>
				<td height="50px"></td>	
			</tr>	
		</table>
	</div>
	<div id="kanan">
		<table align="center" border="0" cellpadding="2" cellspacing="0">
			<tbody>
				<tr><td><center><?=date('d-M-Y')?></center></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td>(_________________)</td></tr>
				<tr><td><center>ADMIN</center></td></tr>
			</tbody>
		</table>
	</div>
	<!-- &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<?=date('d-M-Y')?>
<br><br><br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(_________________)
<br>
&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&emsp;&nbsp;ADMIN
<br><br><br> -->
