<?php $this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
?>
<style>
	.myDiv {
		background-color: #d3eefa;
		font-family: verdana;
	}

	.warnaTombol {
		background-color: #286090;
		color: white;
	}

	.warnaTombol {
		background-color: #286090;
		color: white;
	}

	.warnaTombolExcel {
		background-color: #02723B;
		color: white;
	}

	.warnaTombolPdf {
		background-color: #DE0B0B;
		color: white;
	}

	.teksPutih {
		color: white;
	}

	.teksBiru {
		color: #005279;
	}

	table,
	th,
	td {
		border: 1px solid black;
		border-collapse: collapse;
	}

	th,
	td {
		padding: 15px;
	}
</style>

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
	<div class="box box-primary">
		<div class="myDiv">
			<?php
			// if ($pesan_on == 1) {
			// 	echo "<div class='alert alert-success' role='alert'>Data BUM Sudah di Batalkan !</div>";
			// }
			?>
			<!-- <form action="<?= base_url() ?>index.php/jurnal/filter_tgl_bum" method="post"> -->
			<div class="row">
				<div class="col-sm-10">
					<div class="col-sm-3">
						<div class="form-group">
							<br>
							<label> &nbsp;</label><br>
							<!-- <button class="btn warnaTombol" onclick="return tambah()"><i class="fa fa-plus"> Add</i></button> -->
							<a href="<?= base_url() ?>index.php/master/add_jurnal_header" class="btn warnaTombol" role="button"><i class="fa fa-plus"> Add</i></a>
							<!-- <a href="#" class="btn warnaTombol" role="button">Tambah</a> -->
							<!-- <a href="<?= base_url() ?>index.php/jurnal/dana_masuk" class="btn warnaTombol" role="button">Tambah</a> -->
						</div>
					</div>
				</div>
			</div>
			<!-- </form> -->
		</div>
	</div>

	<!-- <div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header"> -->

	<div class="box-body">
		<div class="box-body table-responsive no-padding">
			<table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr bgcolor='#0073B7'>
						<th class="text-center" style="color:white;">No.</th>
						<th class="text-center" style="color:white;">Kode Master Jurnal</th>
						<th class="text-center" style="color:white;">Nama Jurnal</th>
						<th class="text-center" style="color:white;">Keterangan Header</th>
						<th class="text-center" style="color:white;">Tipe</th>
						<th class="text-center" style="color:white;">Jenis Pembelian</th>
						<th class="text-center" style="color:white;">Eksekusi Saat</th>
						<th class="text-center" style="color:white;">Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					if ($list_data > 0) {
						foreach ($list_data as $row) {
							$no++;
							$kode_master_jurnal = $row->kode_master_jurnal;
					?>
							<tr>
								<td><?= $no ?>.</td>
								<td><?= $row->kode_master_jurnal ?></td>
								<td><?= $row->nama_jurnal ?></td>
								<td><?= $row->keterangan_header ?></td>
								<td><?= $row->tipe ?></td>
								<td><?= ucfirst($row->jenis_jurnal) ?></td>
								<td><?= ucfirst($row->eksekusi) ?></td>
								<td>
									<a href="<?= base_url() ?>index.php/master/edit_master_jurnal/<?= $row->kode_master_jurnal ?>" class="btn btn-success btn-sm" role="button" title="Edit" width="20%"><i class="fa fa-edit"></i></a>
									&nbsp;
									<!-- <a href="<?= base_url() ?>index.php/master/view_master_jurnal" onclick="return detail4(<?= $row->kode_master_jurnal ?>)" class="btn btn-info btn-sm" role="button" title="View" width="20%"><i class="fa fa-search"></i></a> -->

									<button class='btn btn-info btn-sm' onclick="return view('<?= $kode_master_jurnal ?>')" title="View" width="20%"><i class="fa fa-search"></i></button>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- </div>
			</div> -->
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
<!-- <script src="<?= base_url(); ?>dist/jquery.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>dist/jquery.timepicker.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script type="text/javascript">
	function view(kode_master_jurnal) {
		$.get("<?= base_url(); ?>index.php/Master/view_master_jurnal", {
			option: kode_master_jurnal
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}

	function tambah() {
		$.get("<?= base_url(); ?>index.php/Master/modal_tambah_jurnal_header", {
			option: ""
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}

	$(function() {
		$(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'asc']
			] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		});
	});

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
			dateFormat: 'yyyy-mm-dd'
		});

		$('#datepicker2').datepicker({
			dateFormat: 'yyyy-mm-dd'
		});
	});

	function print() {

		$.get("<?= base_url(); ?>index.php/latihan/v_print_all_buk", {
			option: ""
		}, function(data) {
			$('#show_stock').html(data);
			$('#myModal').modal('show');
		});
	}
</script>