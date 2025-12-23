<?php $this->load->view('header');
$Arr_Coa		= array();
$Arr_Project	= array();
if ($data_perkiraan) {
	foreach ($data_perkiraan as $key => $vals) {
		$kode_Coa			= $vals->no_perkiraan . '^' . $vals->nama;
		$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan . '  ' . $vals->nama;
	}
}
?>

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>dist/jquery.timepicker.css">
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

					<div class="box-body" style="background-color:lightblue">
						<form action="<?= base_url() ?>index.php/report/filter_tgl_jurnal" method="post">
							<div class="col-xs-3">
								<b>Tampilkan Berdasarkan Tanggal :</b>
							</div>
							<br><br>
							<div class="col-xs-2">
								Dari Tanggal :<input type="text" class="form-control" size='1' id="datepicker" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal" value="<?= date("d-m-Y") ?>" readonly>
							</div>
							<div class="col-xs-2">
								Sampai Tanggal :<input type="text" class="form-control" size='1' id="datepicker2" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal2" value="<?= date("d-m-Y") ?>" readonly>
							</div>
							<br>
							<div class="col-xs-4">
								<input class="btn btn-success" type="submit" name="view" value="View List">
								<input class="btn btn-success" type="submit" name="view" value="View List Excel" target="blank">
							</div>
						</form>

						<form action="<?= base_url() ?>index.php/report/filter_noperkiraan" method="post">
							<div class="col-xs-4">
								<select name="filter_nokir" id="filter_nokir" class="form-control input-sm">
									<option value="">- Tampilkan Berdasarkan Nomor Perkiraan -</option>
									<?php
									foreach ($Arr_Coa as $key => $row2) {
										echo "<option value='" . $key . "'>" . $row2 . "</option>";
									}
									?>
								</select><br><br>
								<input class="btn btn-success" type="submit" name="tombol_nokir" value="Tampilkan" target="blank">
							</div>
						</form>
					</div>

					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr bgcolor='#9acfea'>
										<th>
											<center>Tanggal</center>
										</th>
										<th>
											<center>Nomor Jurnal</center>
										</th>
										<th>
											<center>Tipe</center>
										</th>
										<th>
											<center>Nama. COA</center>
										</th>
										<th>
											<center>No. JV</center>
										</th>
										<th>
											<center>Keterangan</center>
										</th>
										<th>
											<center>No. Reff</center>
										</th>
										<th>
											<center>Debit</center>
										</th>
										<th>
											<center>Kredit</center>
										</th>
									</tr>
								</thead>
								<tbody>

									<?php

									$i = 0;
									if ($list_data > 0) {
										$no = 0;
										foreach ($list_data as $row) {

											$no++;

											$format_debet = number_format($row->debet, 0, ',', '.');
											$format_kredit = number_format($row->kredit, 0, ',', '.');
									?>
											<tr bgcolor='#DCDCDC'>
												<td align="center"><?= date_format(new DateTime($row->tanggal), "d-m-Y") ?></td>
												<td align="center"><a href="<?= base_url() ?>index.php/report/detail_jurnal/<?= $row->tipe ?>/<?= $row->nomor ?>" data-toggle="tooltip" title="Click for detail"><?= $row->nomor ?></a></td>
												<td align="center"><?= $row->tipe ?></td>
												<td align="center"><?= $row->nama ?></td>
												<td align="center"><?= $row->no_perkiraan ?></td>
												<td><?= $row->keterangan ?></td>
												<td align="center"><?= $row->no_reff ?></td>
												<td align="right"><?= $format_debet ?></td>
												<td align="right"><?= $format_kredit ?></td>
											</tr>

									<?php
										}
									}
									?>

								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div id="show_stock"></div>
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
<script src="<?= base_url(); ?>dist/jquery.min.js"></script>
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
</script>

<script>
	$(function() {
		$('#datepicker').datepicker({
			dateFormat: 'yyyy-mm-dd'
		});

		$('#datepicker2').datepicker({
			dateFormat: 'yyyy-mm-dd'
		});
	});
</script>