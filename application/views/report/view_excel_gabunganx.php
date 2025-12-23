<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Ceklis_gabungan_$tanggal.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
$dfgh = count($list_tempat);
?>
<table width='100%' border="1" cellpadding="5" cellspacing="0">
	<tr>
		<th colspan="<?=5+$dfgh;?>"><h2><h3></th>
	</tr>
	<tr>
		<th colspan="<?=5+$dfgh;?>"><h2>Daftar Ceklis Gabungan<h3><br>Tanggal : <?=date('d-M-Y', strtotime($tanggal));?>
     <br>sd Tanggal : <?=date('d-M-Y', strtotime($tanggal2));?> 
    </th>
	</tr>
	<tr>
	<tr>
		<td style='text-align:center'><b>No</b></td>
		<td style='text-align:center'><b>Nama Barang</b></td>
		<td style='text-align:center'><b>Kategori</b></td>

	<?php
	$num_temp	= 0;
	if($list_tempat > 0){
		$arr_tempat	= array();
		foreach($list_tempat as $row_temp){
			$num_temp++;
			if (!empty($row_temp->tempat)) {
				$arr_tempat[]	= $row_temp->tempat;
				echo "<th>".$row_temp->tempat."</th>";
			} else {
				$arr_tempat[]	= "";
				echo "<th>Tidak Menggunakan Gedung</th>";
			}
		}
	}
	
		echo "<td style='text-align:center'><b>Total</b></td>";
		echo "<td style='text-align:center'><b>Stock Di Gudang</b></td>";
		echo "<td style='text-align:center'><b>Sisa Stock</b></td>";
		echo "</tr>";
	
	$no = 0;
	if($list_barang > 0){
		$arr_barang		= array();
		$arr_tempatx	= array();
		foreach($list_barang as $row_b){
			$jum_barang = $ttl_barang = $stock_akhir = 0;
			if (!in_array($row_b->id, $arr_barang)) {
				$arr_barang[]	= $row_b->id;
				$no++;
				
				echo "<tr>";
					echo "<td style='text-align:center'>$no</td>";
					echo "<td>".$row_b->nm_barang."</td>";
					echo "<td>".$row_b->kategori."</td>";
					
					$stock 		= $row_b->stock;
					if ($num_temp > 0) {
						for ($i=0; $i<$num_temp; $i++) {
							$jum_barang	= $this->order_model->sum_checklist_barang($arr_tempat[$i], $row_b->id, $tanggal,$tanggal2);
							if (empty($jum_barang)) {
								echo "<td>0</td>";
							} else {
								echo "<td>".$jum_barang."</td>";
							}
							$ttl_barang	+= $jum_barang;
						}
					}
					$sisa = $stock - $ttl_barang;
					echo "<td style='text-align:center'><b>$ttl_barang</b></td>";
					echo "<td style='text-align:center'><b>$stock</b></td>";
					echo "<td style='text-align:center'><b>$sisa</b></td>";
				echo "</tr>";
			}
		}
	}
	?>
</table>