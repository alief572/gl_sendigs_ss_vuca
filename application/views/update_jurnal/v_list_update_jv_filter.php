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
						<form action="<?= base_url() ?>index.php/update_jurnal/filter_update_jurnal_jv" method="post">
							<table>
								<tr>
									<td width="20%" align="right">
										<b>Cari Berdasarkan : &nbsp;</b>
									</td>

									<td width="20%">
										<select name="filter_by" id="filter_by" class="form-control input-sm">
											<?php
											if ($filter_by_ == "no_jurnal") {
											?>
												<option value="no_jurnal" selected>No. Jurnal</option>
												<option value="keterangan">Keterangan</option>
											<?php
											} else {
											?>
												<option value="no_jurnal">No. Jurnal</option>
												<option value="keterangan" selected>Keterangan</option>
											<?php
											}
											?>
										</select>
									</td>
									<td width="5%">

									</td>
									<td width="20%">
										<input type="text" class="form-control input-sm" size='1' id="filter_text" name="filter_text" value="<?= $filter_text_ ?>">
									</td>
									<td>&nbsp;&nbsp;</td>
									<td>
										<input class=" btn btn-success" type="submit" name="cari" value="Cari" onclick="return check()">
									</td>
								</tr>
								<tr>
									<td><br></td>
									<td><br></td>
									<td><br></td>
									<td><br></td>
								</tr>
								<tr>
									<td align="right">
										<b>Bulan</b> &nbsp;
									</td>
									<td>
										<select type="text" name="bulan_update" class="form-control">
											<?php
											$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
											$bulan = @$this->input->post('bulan_update');
											if (empty($bulan)) {
												// $bulan = date("m")+0;
												$singkat_cbg = $this->session->userdata('singkat_cbg');
												$cek_periode = $this->db->query("SELECT * FROM periode WHERE stsaktif='O' AND kdcab='$singkat_cbg'")->result();
												if ($cek_periode > 0) {
													foreach ($cek_periode as $r_periode) {
														$bln_thn	= $r_periode->periode;	// 12-2019
														$bulan		= substr($bln_thn, 0, 2);
													}
												}
											}
											for ($i = 1; $i <= 12; $i++) {
												if ($i == $bulan) {
													echo "<option selected value='$i'>" . $nm_bulan[$i] . "</option>";
												} else {
													echo "<option value='$i'>" . $nm_bulan[$i] . "</option>";
												}
											}
											?>
										</select>

										<!-- <input type="text" class="form-control" size='1' id="datepicker" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal" value="<?= date("d-m-Y") ?>" readonly> -->
									</td>
									<td width="5%">
										&nbsp;&nbsp; <b>Tahun</b> &nbsp;
									</td>
									<td>
										<select type="text" name="tahun_update" class="form-control">
											<?php
											$tahun = @$this->input->post('tahun_update');
											if (empty($tahun)) {
												//$tahun = date("Y")+0;
												$singkat_cbg = $this->session->userdata('singkat_cbg');
												$cek_periode2 = $this->db->query("SELECT * FROM periode WHERE stsaktif='O' AND kdcab='$singkat_cbg'")->result();
												if ($cek_periode2 > 0) {
													foreach ($cek_periode2 as $r_periode2) {
														$bln_thn2	= $r_periode2->periode;	// 12-2019
														$tahun		= substr($bln_thn2, 3, 4);
													}
												}
											}
											for ($i = date("Y") - 8; $i <= date("Y") + 2; $i++) {
												if ($tahun == $i) {
													echo "<option selected value='$i'>$i</option>";
												} else {
													echo "<option value='$i'>$i</option>";
												}
											}
											?>
										</select>

										<!-- <input type="text" class="form-control" size='1' id="datepicker2" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal2" value="<?= date("d-m-Y") ?>" readonly> -->
									</td>

									<td>&nbsp;&nbsp;</td>
									<td>
										<input class="btn btn-success" type="submit" name="cari" value="Display"> &nbsp;
										<a href="<?= base_url() ?>index.php/update_jurnal/update_jv" title='Refresh' class='btn btn-primary btn-sm'><i class='fa fa-refresh'></i> Refresh</a>
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
											<center>No. Jurnal</center>
										</th>
										<th>
											<center>Tanggal</center>
										</th>
										<th>
											<center>Koreksi No.</center>
										</th>
										<th>
											<center>Cabang</center>
										</th>
										<th>
											<center>Keterangan</center>
										</th>
										<th>
											<center>Jumlah</center>
										</th>
										<th>
											<center>Bulan</center>
										</th>
										<th>
											<center>Tahun</center>
										</th>
										<th>
											<center>Opsi</center>
										</th>
									</tr>
								</thead>
								<tbody>

									<?php

									$i = 0;
									if ($filter_update > 0) {
										$no = 0;
										foreach ($filter_update as $row) {
											$no++;

											$format_debet = number_format($row->debet, 0, ',', '.');
											$format_kredit = number_format($row->kredit, 0, ',', '.');
									?>
											<tr bgcolor='#DCDCDC'>
												<td align="center"><a href="<?= base_url() ?>index.php/update_jurnal/edit_jurnal_jv/<?= $row->nomor ?>" data-toggle="tooltip" title="Click for edit"><?= $row->nomor ?></a></td>
												<td align="center"><?= date_format(new DateTime($row->tgl), "d-m-Y") ?></td>
												<td align="center"><?= $row->koreksi_no ?></td>
												<td align="center"><?= $row->kdcab ?></td>
												<td><?= $row->keterangan ?></td>
												<td align="right"><?= number_format($row->jml, 0, ',', '.') ?></td>
												<td align="center"><?= $row->bulan ?></td>
												<td align="center"><?= $row->tahun ?></td>
												<td style="text-align:center"><a href="<?= base_url() ?>index.php/update_jurnal/edit_jurnal_jv/<?= $row->nomor ?> " title='Edit' class='btn btn-primary btn-sm'><i class='fa fa-pencil-square-o'></i> Edit</a></td>
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

<script type="text/javascript">
	function check() {
		if ($("#filter_text").val() == '') {
			alert('Key Search harus diisi!!!');
			document.getElementById("filter_text").focus();
			return false;
		}
	}
</script>