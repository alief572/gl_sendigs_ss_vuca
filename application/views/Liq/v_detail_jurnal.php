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
		<tr bgcolor='#0073B7'>
			<th style="color: white;">Nomor Jurnal</th>
			<th style="color: white;">Tipe</th>
			<th style="color: white;">Tanggal</th>
			<th style="color: white;">Keterangan</th>
			<th style="color: white;">No. Reff</th>
			<th style="color: white;">Debet</th>
			<th style="color: white;">Kredit</th>
			<th style="color: white;">Aksi</th>
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

					<td><button class='btn btn-info btn-sm' onclick="return trans_jur('<?= $nomor_jurnal ?>')">
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
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
				<!-- <button class='btn btn-info btn-sm' onclick="return detail_jur(<?= $detjur_segmen1 ?>,<?= $detjur_segmen2 ?>,<?= $detjur_segmen3 ?>)"> -->
				<?php
				// echo $detjur_segmen1 . " >> " . $detjur_segmen2 . " >> " . $nokir5 . " <br> ";
				// exit;
				$data_nokir = explode("-", $nokir5);

				$nokir_segmen1 =  $data_nokir[0];

				$nokir_segmen2 =  $data_nokir[1];

				$nokir_segmen3 =  $data_nokir[2];
				?>
				<!-- <button class='btn btn-secondary' onclick="return detail_jur(<?= $nokir5 ?>)">Close</button> -->
				<button class='btn btn-secondary btn-sm' onclick="return detail_jur(<?= $nokir_segmen1 ?>,<?= $nokir_segmen2 ?>,<?= $nokir_segmen3 ?>)">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	// function detail_jur(nokir5) {
	// 	$.ajax({
	// 		url: base_url + 'index.php/Ledger_in_query/detail_jurnal_backlink/' + nokir5,
	// 		cache: false,
	// 		type: "GET",
	// 		success: function(data) {
	// 			$('#Mymodal-list6').html(data);
	// 			$("#Mymodal6").modal('show');
	// 		}
	// 	});
	// }

	function detail_jur(nokir_segmen1, nokir_segmen2, nokir_segmen3) {
		$.ajax({
			url: base_url + 'index.php/Ledger_in_query/detail_jurnal/' + nokir_segmen1 + '/' + nokir_segmen2 + '/' + nokir_segmen3,
			cache: false,
			type: "GET",
			success: function(data) {
				$('#Mymodal-list6').html(data);
				$("#Mymodal6").modal('show');
			}
		});
	}

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