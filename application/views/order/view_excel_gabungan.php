<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Ceklis_gabungan_$range.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
$dfgh = count($data_gedung);
?>
<table width='100%' border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th colspan="<?=2+$dfgh;?>"><h2><h3></th>
	</tr>
	<tr>
		<th colspan="<?=2+$dfgh;?>"><h2>Daftar Ceklis Gabungan<h3><br><?=str_replace("_"," S/D ",$range);?></th>
	</tr>
	<tr>
	<?php
	$nm_tempat = array();
	if($data_gedung > 0){
		echo "<tr>";
			echo "<td style='text-align:center'><b>No</b></td>";
			echo "<td style='text-align:center'><b>Nama Barang</b></td>";
		foreach($data_gedung as $row_a){
			$nm_tempat[] = $row_a->tempat1;
			if($row_a->tempat1 == ""){
				echo "<td style='text-align:center'><b>Tidak Menggunakan Gedung</b></td>";
			}else{
				echo "<td style='text-align:center'><b>".$row_a->tempat1."</b></td>";
			}
		}
		echo "<td style='text-align:center'><b>Stock Di Gudang</b></td>";
		echo "<td style='text-align:center'><b>Sisa Stock</b></td>";
		echo "</tr>";
	}
	$no = 0;
	if($data_ket > 0){
		foreach($data_ket as $rows){
			$init = 0;
			$no++;
			echo "<tr>";
				echo "<td style='text-align:center'>$no</td>";
				echo "<td>".$rows->keterangan."</td>";
				for($j=0;$j<count($nm_tempat);$j++){
					$jum = $this->order_model->count_ket($range,$nm_tempat[$j],$rows->keterangan);
					echo "<td style='text-align:center'>".$jum."</td>";
					$init = $init + $jum;
				}
				$stock = $this->order_model->count_stock($rows->keterangan);
				$sisa = $stock - $init;
				echo "<td style='text-align:center'><b>$stock</b></td>";
				echo "<td style='text-align:center'><b>$sisa</b></td>";
			echo "</tr>";
		}
	}
	?>
</table>