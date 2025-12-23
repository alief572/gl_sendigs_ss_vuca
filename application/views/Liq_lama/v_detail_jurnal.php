<link rel="stylesheet" href="<?= base_url("assets/pdf/style.css"); ?>">
<?php
error_reporting(E_ALL & ~E_NOTICE);
?>
<div id="space"></div>
<!-- <table class="gridtable" width="100%"> -->
<div class="col-lg">
	<?php
	$kode_cabang	= $this->session->userdata('kode_cabang');
	$get_namacoa5	= $this->db->query("SELECT nama FROM coa WHERE kdcab='$kode_cabang' AND bln='$bln_aktif' AND thn='$thn_aktif' AND no_perkiraan LIKE '$nokir5%' AND level='5'")->row();

	$namacoa5					= $get_namacoa5->nama;
	$data5						= $nokir5 . " ( " . $namacoa5 . " ) ";

	?>

	<label class="control-label col-lg-7">Detail Jurnal No. COA : <?= $data5 ?></label>
</div>
<table id="my-grid" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th>Nomor Jurnal</th>
			<th>Tipe</th>
			<th>Tanggal</th>
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
				// $nomor_segmen1		= substr($row->nomor, 0, 3); // 101
				// $nomor_segmen2		= substr($row->nomor, 4, 10); // A2000010
				$nomor_jurnal		= $row->nomor; // 101-A2000010

				$debet		= $row->debet;
				$kredit		= $row->kredit;
		?>
				<tr>
					<td><?= $row->nomor ?></td>
					<td><?= $row->tipe ?></td>
					<td><?= date('d/m/Y', strtotime($row->tanggal)); ?></td>
					<td><?= $row->keterangan ?></td>
					<td><?= $row->no_reff ?></td>
					<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
					<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>

					<td><button class='btn btn-primary btn-sm' onclick="return trans_jur('<?= $nomor_jurnal ?>')">
							View Detail <i class="fa fa-search"></i>
						</button></td>
				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>
<div class="modal fade" id="Mymodal7">
	<div class="modal-dialog modal-dialog-scrollable" style="width:70%; height:1000px" role="document">
		<div class="modal-content">
			<div class="modal-body" id="Mymodal-list7">

			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div> -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	function trans_jur(nomor_jurnal) {
		$.ajax({
			url: base_url + 'index.php/Ledger_in_query/transaksi_jurnal/' + nomor_jurnal,
			cache: false,
			type: "GET",
			success: function(data) {
				$('#Mymodal-list7').html(data);
				$("#Mymodal7").modal('show');
			}
		});
	}
</script>