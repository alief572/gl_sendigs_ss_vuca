<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Jurnal.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
$dfgh = count($filter_tgl);
?>
<table width='50%' border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th><h2><h3></th>
		<!--<th colspan="<?=5+$dfgh;?>"><h2><h3></th>-->
	</tr>
	<tr>
		<th colspan="6"><h2>Daftar Jurnal<h3>
    	</th>
		<!--
		<th colspan="<?=1+$dfgh;?>"><h2>Daftar Jurnal<h3><br>Tanggal :
		-->
	</tr>
	
	<tr>

						<th>Tanggal</th>
					  <th>No. Perkiraan</th>
					  <th>Keterangan</th>
					  <th>No. Reff</th>
					  <th>Debit</th>
            			<th>Kredit</th>
	</tr>
	
									<?php
									if($data_accound > 0){
									foreach($data_accound as $row){
									$nokir = $row->no_perkiraan; //1101-00-00
										//$nokir_=substr($nokir,0,4); //1101
									$namkir= $row->nama;
										
									$jan=$row->jan;
									$feb=$row->feb;
									$mart=$row->mart;
									$apr=$row->apr;
									$mei=$row->mei;
									$jun=$row->jun;
									$jul=$row->jul;
									$agt=$row->agt;
									$sept=$row->sept;
									$okt=$row->okt;
									$nov=$row->nov;
									$des=$row->des;
										

					echo "<tr>";
					echo "<td style='text-align:center'><b>".$row->jan"</b></td>";
					echo "<td style='text-align:center'><b>$row->feb</b></td>";
					echo "<td style='text-align:left'><b>$row->mart</b></td>";
					echo "<td style='text-align:center'><b>$row->apr</b></td>";
					echo "<td style='text-align:right'><b>$row->mei</b></td>";
					echo "<td style='text-align:right'><b>$row->mei</b></td>";
				echo "</tr>";
				}
									}
		
	?>
</table>