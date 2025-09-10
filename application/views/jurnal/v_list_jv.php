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
						<form action="<?= base_url() ?>index.php/Latihan/list_jvcoz" method="post">
							<div class="col-xs-2">
								<select type="text" name="thn" class="form-control" onchange="this.form.submit()">
									<?php
									$thn = @$this->input->post('thn');
									if (empty($thn)) {
										$thn = date("Y");
									}
									for ($i = date("Y") - 2; $i <= date("Y") + 2; $i++) {
										if ($thn == $i) {
											echo "<option selected value='$i'>$i</option>";
										} else {
											echo "<option value='$i'>$i</option>";
										}
									}
									?>
								</select>
							</div>
							<div class="col-xs-2">
								<select type="text" name="bln" class="form-control" onchange="this.form.submit()">
									<?php
									$nm_bulan = array('All', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bln = $this->input->post('bln');
									$uri_s3 	= $this->uri->segment(3);
									if ($uri_s3 == 'month') {
										$bln = date('m');
									} else if (!empty($post_bulan)) {
										$bln = 0;
									}
									for ($i = 0; $i <= 12; $i++) {
										if ($i == $bln) {
											echo "<option selected value='$i'>" . $nm_bulan[$i] . "</option>";
										} else {
											echo "<option value='$i'>" . $nm_bulan[$i] . "</option>";
										}
									}
									?>
								</select>
								&nbsp;&nbsp;&nbsp;
							</div>
						</form>
						<a href="<?= base_url() ?>index.php/jurnal/jvcost" class="btn btn-warning">Input JV</a>&nbsp;&nbsp;
						<!-- <a href="<?= base_url() ?>index.php/latihan2/jvcost" class="btn btn-warning">Input JV</a> -->
						<!-- <a href="<?= base_url() ?>index.php/Latihan/detail_list_jv/" title="" target="blank" class="btn btn-info" width="20%"><i>View Detail</i></a> -->
						<!-- <button class="btn btn-warning btn-sm" onclick="return print_bulanan()">print <i class=""></i></button> -->
						<a href="<?= base_url() ?>index.php/jurnal/list_jv_excel" class="btn btn-success">View JV Detail</a>
					</div>

					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr bgcolor='#9acfea'>
										<th>
											<center>Nomor</center>
										</th>
										<th>
											<center>Tanggal</center>
										</th>
										<th>
											<center>Koreksi No</center>
										</th>
										<th>
											<center>Cab</center>
										</th>
										<th>
											<center>Keterangan</center>
										</th>
										<th>
											<center>Bulan</center>
										</th>
										<th>
											<center>Tahun</center>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 0;
									if ($data_listjv > 0) {
										foreach ($data_listjv as $row) {
											$i++;
									?>
											<tr bgcolor='#DCDCDC'>
												<td align="left"><a href="<?= base_url() ?>index.php/jurnal/detail_jv/<?= $row->nomor ?>" data-toggle="tooltip" title="Click for detail"><?= $row->nomor ?></a></td>
												<!-- <td><?= $row->nomor ?></td> -->
												<td><?= date_format(new DateTime($row->tgl), "d-m-Y") ?></td>
												<td><?= $row->koreksi_no ?></td>
												<td><?= $row->kdcab ?></td>
												<td><?= $row->keterangan ?></td>
												<td><?= $row->bulan ?></td>
												<td><?= $row->tahun ?></td>
										<?php }
									} else {
										echo "<script>alert('DATA TIDAK ADA !')</script>";
									}
										?>
											</tr>
								</tbody>
							</table>
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

<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>


<!-- SlimScroll -->
<script>
	$(function() {
		$(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'desc']
			],
			   "dom": 'Blfrtip',
				"buttons": [
				{
                "extend": 'excel',
				}],// Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
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