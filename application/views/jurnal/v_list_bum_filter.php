<?php $this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
?>
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
						<form action="<?= base_url() ?>index.php/jurnal/filter_tgl_bum" method="post">
							<div class="col-xs-3">
								<b>Tampilkan Berdasarkan Tanggal :</b>
							</div>
							<br><br>
							<div class="col-xs-2">
								Dari Tanggal :<input type="text" class="form-control" size='1' id="datepicker" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal" value="<?= $tanggal ?>" readonly>
							</div>
							<div class="col-xs-2">
								Sampai Tanggal :<input type="text" class="form-control" size='1' id="datepicker2" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal2" value="<?= $tanggal2 ?>" readonly>
							</div>
							<br>
							<div class="col-xs-4">
								<input class="btn btn-success" type="submit" name="view" value="View List">
								<input class="btn btn-success" type="submit" name="view" value="View List Excel" target="blank">
								<a href="<?= base_url() ?>index.php/jurnal/list_dana_masuk" class="btn btn-success">View All</a>
							</div>

						</form>

						<a href="<?= base_url() ?>index.php/jurnal/dana_masuk" class="btn btn-warning">Input Dana Masuk</a>
						<!-- <a href="<?= base_url() ?>index.php/jurnal/multi_print_bum" class="btn btn-success">Multiprint</a> -->
					</div>
					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr bgcolor='#9acfea'>
										<th>
											<center>NO. BUM</center>
										</th>
										<th>
											<center>TANGGAL</center>
										</th>
										<th>
											<center>METODE BAYAR</center>
										</th>
										<!-- <th>
											<center>NO. PROJECT</center>
										</th> -->
										<th>
											<center>TERIMA DARI</center>
										</th>
										<th>
											<center>NOTE</center>
										</th>
										<th>
											<center>JUMLAH (Rp.)</center>
										</th>
										<th>
											<center>OPSI</center>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$num_temp	= 0;
									if ($filter_tgl > 0) {
										$arr_tgl	= array();
										foreach ($filter_tgl as $row_temp) {
											$num_temp++;
											if (!empty($row_temp->tgl)) {
												$arr_tgl[]	= $row_temp->tgl;

												$format_jumlah = number_format($row_temp->jml, 0, ',', '.');
												$id_bum = $row_temp->nomor;

												$id_bumx = str_replace("-", "_", $id_bum);
												$tgl_bum = date("d-M-Y", strtotime($row_temp->tgl));
												$tgl_bumx = str_replace("-", "_", $tgl_bum);
												echo "<tr bgcolor='#DCDCDC'>";
												echo "<td style='text-align:left'>$row_temp->nomor</td>";
												echo "<td style='text-align:center'>$tgl_bum</td>";

												echo "<td style='text-align:center'>$row_temp->jenis_reff</td>";
												// echo "<td style='text-align:center'>$row_temp->no_reff</td>";
												echo "<td style='text-align:center'>$row_temp->terima_dari</td>";
												echo "<td style='text-align:left'>$row_temp->note</td>";
												echo "<td style='text-align:right'>$format_jumlah</td>";
												echo "<td style='text-align:center'>";
												echo "<button class='btn btn-primary btn-sm' onclick='return view_detail('" . $row_temp->nomor . "')'><i class='fa fa-search'></i></button>&nbsp;";
												echo "<a href='" . base_url() . "index.php/multi_bum/print_jbum/" . $row_temp->nomor . "' target='_blank' title='Print' class='btn btn-info btn-sm'><i class='fa fa-print'></i></a>&nbsp;";
												echo '<a href="' . base_url() . 'index.php/jurnal/vmodal_batal_bum/' . $row_temp->nomor . '" title="Batal" onclick="return validasi_hapus()" class="btn btn-danger btn-sm"><i class="fa fa-close"></i></a>';
												echo "</td>";
												echo "</tr>";
											} else {
												$arr_tgl[]	= "";
												echo "<th>Tidak ada data</th>";
											}
										}
									}
									?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="show_stock">
			</div>
			<div class="modal fade" id="modal-bum">
				<div class="modal-dialog modal-dialog-scrollable" style="width:90%; height:1000px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="Mymodal-title">Detail Jurnal</h4>
						</div>
						<div class="modal-body" id="modal-bumlist">

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
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
	function view_detail(nomorjurnal) {
		$.ajax({
			url: base_url + 'index.php/jurnal/modal_detailbum/' + nomorjurnal,
			cache: false,
			type: "GET",
			success: function(data) {
				$('#modal-bumlist').html(data);
				$("#modal-bum").modal('show');
			}
		});
	}
	$(function() {
		$(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [
				[0, 'desc']
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
			dateFormat: 'dd-mm-yyyy'
		});

		$('#datepicker2').datepicker({
			dateFormat: 'dd-mm-yyyy'
		});
	});
</script>