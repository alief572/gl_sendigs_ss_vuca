<?php $this->load->view('header'); ?>
<section class="content-header">
	<h1>
		<?= $judul ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?= $judul ?></li>
	</ol>
</section>
<section class="content-header">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">

					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr bgcolor='#9acfea'>
										<th>
											<center>No. COA</center>
										</th>
										<th>
											<center>Keterangan</center>
										</th>
										<th>
											<center>No Reff</center>
										</th>
										<th>
											<center>Debet</center>
										</th>

										<th>
											<center>Kredit</center>
										</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									$totaldb = 0;
									$totalkr = 0;
									if ($data_d_listjv > 0) {
										foreach ($data_d_listjv as $row) {
											$i++;
											$debet = $row->debet;
											$kredit = $row->kredit;

											$totaldb += $debet;

											$totalkr += $kredit;
									?>
											<tr bgcolor='#DCDCDC'>
												<td><?= $row->no_perkiraan ?></td>
												<td><?= $row->keterangan ?></td>
												<td><?= $row->no_reff ?></td>
												<td align="right"><?= number_format($row->debet, 0, ',', '.'); ?></td>
												<td align="right"><?= number_format($row->kredit, 0, ',', '.'); ?></td>
										<?php

										}
									} else {
										echo "<script>alert('DATA TIDAK ADA !')</script>";
									}

										?>
										<td>

											</tr>
								</tbody>
							</table>
							<div class="box-body table-responsive no-padding">
								<table class="table table-bordered">
									<tr class="bg-gray">
										<td></td>
										<td></td>
										<td width="50%" class="text-right"><b>Grand Total</b></td>

										<td width="20%" align="right">
											<input type="text" class="text-right" name="total" id="total" value="<?= number_format($totaldb, 0, ',', '.'); ?>" readOnly>
										</td>
										<td width="20%" align="right">
											<input type="text" class="text-right" name="total" id="total" value="<?= number_format($totalkr, 0, ',', '.'); ?>" readOnly>
										</td>
									</tr>
								</table>
							</div>
							<div class="box-body">
								<table>
									<tr>
										<td>
											<a href="<?= base_url() ?>index.php/latihan/list_jv" class="btn btn-danger">KEMBALI</a>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="show_stock">
				<div>
</section>
<?php $this->load->view('footer'); ?>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?= base_url() ?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/js/bootstrap-clockpicker.min.js"></script>

<!-- <script src="<?= base_url() ?>dist/jquery.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>dist/jquery.timepicker.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script>
	$(function() {
		$(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'desc']
			] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		});
	});

	function batal(id) {
		$.get("<?= base_url() ?>index.php/jurnal/vmodal_batal_buk", {
			option: id
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}

	function validasi_hapus() {
		var dd = confirm("Yakin di Batalkan ?");
		if (dd == false) {
			return false;
		}
	}
</script>
<script>
	$(function() {
		$('#datepicker').datepicker({
			dateFormat: 'dd-mm-yyyy'
		});

		$('#datepicker2').datepicker({
			dateFormat: 'dd-mm-yyyy'
		});
	});
</script>