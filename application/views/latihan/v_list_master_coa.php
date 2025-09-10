<?php $this->load->view('header'); ?>
<section class="content-header">
	<h1>
		<?= $judul ?> <?= $this->session->userdata('') ?>
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
						<button class="btn btn-warning btn-sm" onclick="return add_stock()">Tambah COA <i class="fa fa-plus"></i></button>
						<!-- <button class="btn btn-warning btn-sm" onclick="return print_bulanan()">print <i class=""></i></button> -->
						<a href="<?= base_url() ?>index.php/Latihan/update_tipe_coa2/" onclick="" class='btn btn-warning btn-sm'>
							update <i class=""></i></a>
					</div>
					<div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
							<thead>
								<tr bgcolor='#9acfea'>
									<th rowspan='2'>
										<center>NAMA COA</center>
									</th>
									<th rowspan='2'>
										<center>NO. COA</center>
									</th>
									<th rowspan='2'>
										<center>KODE CABANG</center>
									</th>
									<th rowspan='2'>
										<center>LEVEL</center>
									</th>
								</tr>
								<tr bgcolor='#9acfea'>

									<th>
										<center>AKSI</center>
									</th>

								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								if ($data_coa > 0) {
									foreach ($data_coa as $row) {
										$i++;
										$id = $row->id;
								?>
										<tr bgcolor='#DCDCDC'>
											<?php
											if ($row->level == "2") {
											?>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;<?= $row->nama ?></td>
											<?php
											} elseif ($row->level == "3") {
											?>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row->nama ?></td>
											<?php
											} elseif ($row->level == "4") {
											?>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row->nama ?></td>
											<?php
											} elseif ($row->level == "5") {
											?>
												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row->nama ?></td>
											<?php
											} else {
											?>
												<td><?= $row->nama ?></td>
											<?php
											}
											?>
											<td align="center"><?= $row->no_perkiraan ?></td>
											<td align="center"><?= $row->kdcab ?></td>
											<td align="center"><?= $row->level ?></td>
											<td align="center">
												<button class='btn btn-primary btn-sm' onclick="return edit_stock(<?= $row->id ?>)">
													Edit <i class="fa fa-edit"></i>
												</button>
												<a href="<?= base_url() ?>index.php/Latihan/delete_coa_master/<?= $row->id ?>" onclick="return validasi_hapus()" class='btn btn-danger btn-sm'>
													Hapus <i class="fa fa-eraser"></i>

										</tr>
								<?php
									}
								}
								?>

							</tbody>
						</table>
						<div id="show_stock"></div>
					</div>
				</div>
			</div>
		</div>
</section>

<?php $this->load->view('footer'); ?>
<!-- DataTables -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
	$(function() {
		$(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[1, 'asc']
			] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		});
	});


	function add_stock() {

		$.get("<?= base_url(); ?>index.php/Latihan/add_coa_master", {
			option: ""
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}

	function edit_stock(id) {
		$.get("<?= base_url(); ?>index.php/Latihan/edit_coa", {
			option: id
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}

	function update() {
		$.get("<?= base_url(); ?>index.php/Latihan/update_tpe_coa", {
			option: id
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}

	function validasi_hapus() {
		var dd = confirm("hapus data ?");
		if (dd == false) {
			return false;
		}
	}

	function print_bulanan() {

		$.get("<?= base_url(); ?>index.php/Latihan/print_bulanan", {
			option: ""
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}
</script>