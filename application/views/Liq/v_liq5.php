<link rel="stylesheet" href="<?= base_url("assets/pdf/style.css"); ?>">
<?php
error_reporting(E_ALL & ~E_NOTICE);
?>

<div id="space"></div>
<!-- <table class="gridtable" width="100%"> -->
<div class="col-lg">
	<?php
	$kode_cabang	= $this->session->userdata('kode_cabang');
	$get_namacoa4	= $this->db->query("SELECT nama FROM coa WHERE kdcab='$kode_cabang' AND bln='$bln_aktif' AND thn='$thn_aktif' AND no_perkiraan LIKE '$nokir4%' AND level='4'")->row();

	$namacoa4					= $get_namacoa4->nama;
	$data4						= $nokir4 . "-00" . " ( " . $namacoa4 . " ) ";

	?>

	<label class="control-label col-lg-7">COA Level 5 dari No. COA : <?= $data4 ?></label>
</div>
<table id="my-grid" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr bgcolor='#0073B7'>
			<th style="color: white;">Nama COA</th>
			<th style="color: white;">No. COA</th>
			<th style="color: white;">Saldo Awal</th>
			<th style="color: white;">Debet</th>
			<th style="color: white;">Kredit</th>
			<th style="color: white;">Saldo Akhir</th>
			<th style="color: white;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		if ($data_liq > 0) {
			foreach ($data_liq as $row) {
				$i++;
				$nokir		= $row->no_perkiraan; // 1101-01-01
				$sa			= $row->saldoawal;

				$debet		= $row->debet;
				$kredit		= $row->kredit;
				$saldoakhir = $row->saldoakhir;

				$nokir_segmen1		= substr($row->no_perkiraan, 0, 4); // 1101-01-01
				$nokir_segmen2		= substr($row->no_perkiraan, 5, 2); // 01
				$nokir_segmen3		= substr($row->no_perkiraan, 8, 2); // 01

		?>
				<tr>
					<td><?= $row->nama ?></td>
					<td><?= $row->no_perkiraan ?></td>
					<td align="right"><?= number_format($sa, 0, ',', '.'); ?></td>
					<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
					<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>
					<td align="right" width="12%"><?= number_format($saldoakhir, 0, ',', '.'); ?></td>

					<td><button class='btn btn-info btn-sm' onclick="return detail_jur(<?= $nokir_segmen1 ?>,<?= $nokir_segmen2 ?>,<?= $nokir_segmen3 ?>)">
							View Detail <i class="fa fa-search"></i>
						</button></td>
				</tr>
		<?php
			}
		}
		?>
	</tbody>
</table>
<div class="modal fade" id="Mymodal6">
	<div class="modal-dialog modal-dialog-scrollable" style="width:80%; height:1000px">
		<div class="modal-content">
			<div class="modal-body" id="Mymodal-list6">

			</div>
			<div class="modal-footer">
				<button class='btn btn-secondary' onclick="return detail5(<?= $nokir4_segmen1 ?>,<?= $nokir4_segmen2 ?>)">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
	function detail5(nokir_segmen1, nokir_segmen2) {
		$.ajax({
			url: base_url + 'index.php/Ledger_in_query/list_liq5/' + nokir_segmen1 + '/' + nokir_segmen2,
			cache: false,
			type: "GET",
			success: function(data) {
				$('#Mymodal-list5').html(data);
				$("#Mymodal5").modal('show');


			}
		});
	}

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

	// function detail_jur(id) {
	// 	$.get("<?= base_url(); ?>index.php/Ledger_in_query/list_liq5", {
	// 		option: id
	// 	}, function(data) {
	// 		$('#show_modal5').html(data);
	// 		$('#myModal5').modal('show');
	// 	});
	// }
</script>