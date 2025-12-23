<link rel="stylesheet" href="<?= base_url("assets/pdf/style.css"); ?>">
<?php
error_reporting(E_ALL & ~E_NOTICE);
?>
<div id="space"></div>
<!-- <table class="gridtable" width="100%"> -->
<div class="col-lg">
	<?php
	// $kode_cabang	= $this->session->userdata('kode_cabang');
	// $get_namacoa5	= $this->db->query("SELECT nama FROM coa WHERE kdcab='$kode_cabang' AND bln='$bln_aktif' AND thn='$thn_aktif' AND no_perkiraan LIKE '$nokir5%' AND level='5'")->row();

	// $namacoa5					= $get_namacoa5->nama;
	// $data5						= $nokir5 . " ( " . $namacoa5 . " ) ";

	?>

	<label class="control-label col-lg-7">Transaksi Jurnal : <?= $nomor_jurnal; ?></label>
</div>
<table id="my-grid" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th>No. COA</th>
			<th>Keterangan</th>
			<th>No. Reff</th>
			<th>Debet</th>
			<th>Kredit</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		if ($data_liq > 0) {
			foreach ($data_liq as $row) {
				$i++;
				// 101-A2000010

				$debet		= $row->debet;
				$kredit		= $row->kredit;
		?>
				<tr>
					<td><?= $row->no_perkiraan ?></td>
					<!-- <td><?= date('d/m/Y', strtotime($row->tanggal)); ?></td> -->
					<td><?= $row->keterangan ?></td>
					<td><?= $row->no_reff ?></td>
					<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
					<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>
					<td></td>
					<!-- <td><button class='btn btn-primary btn-sm' onclick="return trans_jur(<?= $debet ?>,<?= $kredit ?>)">
				View Detail <i class="fa fa-search"></i>
			</button></td> -->
				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>

<script>

</script>