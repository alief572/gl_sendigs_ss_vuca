<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment;");

header("Pragma: no-cache");

header("Expires: 0");

?>

<div class="box-body table-responsive no-padding">

	<table class="table table-bordered table-hover dataTable example1">
		<thead>
			<tr>
				<th colspan="6">
					<h2><b>LEDGER INQUERY

				</th>

			<tr>
				<th><b>Nama COA</th>
				<th><b>No. COA</th>
				<th><b>Saldo Awal</th>
				<th><b>>Debet</th>
				<th><b>Kredit</th>
				<th><b>Saldo Akhir</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0;
			if ($data_ledq > 0) {
				foreach ($data_ledq as $row) {
					$i++;
					$nokir = $row->no_perkiraan;
					$sa = $row->saldoawal;
					$debet = $row->debet;
					$kredit = $row->kredit;
					$saldoakhir = $row->saldoakhir;
					//	$saakhir=$sa+$debet-$kredit;								
					//	$data_nokir_biaya=$this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$id_buk' and no_perkiraan like '6%'")->result();
			?>
					<tr>
						<td><?= $row->nama ?></td>
						<td><?= $row->no_perkiraan ?></td>
						<td align="right"><?= number_format($sa, 0, ',', '.'); ?></td>
						<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
						<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>
						<td align="right" width="12%"><?= number_format($saldoakhir, 0, ',', '.'); ?></td>
				<?php
				}
			}
				?>
					</tr>

		</tbody>
	</table>

</div>