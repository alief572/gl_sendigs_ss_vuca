<?php $this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
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
						<form action="<?= base_url() ?>index.php/report/filter_query_jurnal" method="post">
							<table>
								<tr>
									<td width="20%">
										<b>Cari Berdasarkan</b>
									</td>

									<td width="20%">
										<select name="filter_by" id="filter_by" class="form-control input-sm">
											<!-- <option value="" selected>-Pilih Level-</option> -->
											<?php
											if ($filter_by == "no_reff") {
											?>
												<option value="no_reff" selected>No. Reff</option>
												<option value="no_jurnal">No. Jurnal</option>
												<option value="no_perkiraan">No. Perkiraan</option>
												<option value="keterangan">Keterangan</option>
												<option value="tipe">Tipe</option>
											<?php
											} elseif ($filter_by == "no_jurnal") {
											?>
												<option value="no_reff">No. Reff</option>
												<option value="no_jurnal" selected>No. Jurnal</option>
												<option value="no_perkiraan">No. Perkiraan</option>
												<option value="keterangan">Keterangan</option>
												<option value="tipe">Tipe</option>
											<?php
											} elseif ($filter_by == "no_perkiraan") {
											?>
												<option value="no_reff">No. Reff</option>
												<option value="no_jurnal">No. Jurnal</option>
												<option value="no_perkiraan" selected>No. Perkiraan</option>
												<option value="keterangan">Keterangan</option>
												<option value="tipe">Tipe</option>
											<?php
											} elseif ($filter_by == "keterangan") {
											?>
												<option value="no_reff">No. Reff</option>
												<option value="no_jurnal">No. Jurnal</option>
												<option value="no_perkiraan">No. Perkiraan</option>
												<option value="keterangan" selected>Keterangan</option>
												<option value="tipe">Tipe</option>
											<?php
											} elseif ($filter_by == "tipe") {
											?>
												<option value="no_reff">No. Reff</option>
												<option value="no_jurnal">No. Jurnal</option>
												<option value="no_perkiraan">No. Perkiraan</option>
												<option value="keterangan">Keterangan</option>
												<option value="tipe" selected>Tipe</option>
											<?php
											}
											?>
										</select>
									</td>
									<td width="5%">

									</td>
									<td width="20%">
										<input type="text" class="form-control input-sm" size='1' id="filter_text" name="filter_text" value="<?= $filter_text ?>" required>
									</td>
								</tr>
								<tr>
									<td><br></td>
									<td><br></td>
									<td><br></td>
									<td><br></td>
								</tr>
								<tr>
									<td>
										<b>Tanggal Jurnal</b>
									</td>
									<td>
										<input type="text" class="form-control" size='1' id="datepicker" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal" value="<?= $tanggal ?>" readonly>
									</td>
									<td width="5%">
										&nbsp; s/d
									</td>
									<td>
										<input type="text" class="form-control" size='1' id="datepicker2" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal2" value="<?= $tanggal2 ?>" readonly>
									</td>
									<td>&nbsp;&nbsp;</td>
									<td>
										<input class="btn btn-success" type="submit" name="cari" value="CARI">
									</td>
									<td>&nbsp;&nbsp;</td>
									<td>
										<input class="btn btn-success" type="submit" name="cari" value="EXPORT TO EXCEL">
									</td>
								</tr>
							</table>
						</form>
					</div>
					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr bgcolor='#9acfea'>
										<th>
											<center>Tipe</center>
										</th>
										<th>
											<center>Tanggal</center>
										</th>
										<th>
											<center>No. Jurnal</center>
										</th>
										<th>
											<center>No. COA</center>
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
									if ($filter_query > 0) {
										$no = 0;
										foreach ($filter_query as $row) {
											$no++;

											$format_debet = number_format($row->debet, 0, ',', '.');
											$format_kredit = number_format($row->kredit, 0, ',', '.');
									?>
											<tr bgcolor='#DCDCDC'>
												<td align="center"><?= $row->tipe ?></td>
												<td align="center"><?= date_format(new DateTime($row->tanggal), "d-m-Y") ?></td>
												<td align="center"><a href="<?= base_url() ?>index.php/report/detail_qjurnal/<?= $row->tipe ?>/<?= $row->nomor ?>" data-toggle="tooltip" title="Click for detail"><?= $row->nomor ?></a></td>
												<td align="center"><?= $row->no_perkiraan ?></td>
												<td><?= $row->keterangan ?></td>
												<td align="center"><?= $row->no_reff ?></td>
												<td align="right"><?= $format_debet ?></td>
												<td align="right"><?= $format_kredit ?></td>
											</tr>
									<?php
										}
									} else {
										echo "<div><center>DATA TIDAK ADA</center></div>";
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
				[1, 'desc']
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