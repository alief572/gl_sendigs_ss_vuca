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
						<?php
						if ($pesan_on == 1) {
							echo "<div class='alert alert-success' role='alert'>Data BUK Sudah di Batalkan !</div>";
						}
						?>
						<form action="<?= base_url() ?>index.php/jurnal/filter_tgl_buk" method="post">
							<div class="col-xs-3">
								<b>Tampilkan Berdasarkan Tanggal :</b>
							</div>
							<br><br>
							<div class="col-xs-2">
								Dari Tanggal :<input type="text" class="form-control" size='1' id="datepicker" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal" value="<?= $tanggal_awal ?>" readonly>
							</div>
							<div class="col-xs-2">
								Sampai Tanggal :<input type="text" class="form-control" size='1' id="datepicker2" format="dd-mm-yyyy" data-date-format="dd-mm-yyyy" name="tanggal2" value="<?= $tanggal_akhir ?>" readonly>
							</div>
							<br>
							<div class="col-xs-4">
								<input class="btn btn-success" type="submit" name="view" value="View List">
								<input class="btn btn-success" type="submit" name="view" value="View List Excel" target="blank">
								<input class="btn btn-success" type="submit" name="view" value="View Detail Excel" target="blank">
							</div>
						</form>
						<a href="<?= base_url() ?>index.php/jurnal/dana_keluar" class="btn btn-warning">Input Bukti Uang Keluar (BUK)</a>
						<!-- <a href="<?= base_url() ?>index.php/jurnal/multi_print_buk" class="btn btn-success">Multiprint</a> -->
					</div>

					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr bgcolor='#9acfea'>
										<th>
											<center>NO. BUK</center>
										</th>
										<th>
											<center>TANGGAL</center>
										</th>
										<th>
											<center>METODE BAYAR</center>
										</th>
							
										<th>
											<center>BAYAR KE</center>
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
									$i = 0;
									if ($list_data > 0) {
										$no = 0;
										foreach ($list_data as $row) {
											$no++;
											//$format_jumlah = number_format($row->jml, 0, ',', '.');
											$id_buk = $row->nomor;
											$id_bukx = str_replace("-", "_", $id_buk);
											$id_bukz = str_replace("-", "", $id_buk);
											$tgl_buk = date("d-m-Y", strtotime($row->tgl));
											$tgl_bukx = str_replace("-", "_", $tgl_buk);

											$data_uang_keluar_dari = $this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$id_buk' and no_perkiraan like '1102%' and debet=0")->result();
											
											

											if ($data_uang_keluar_dari > 0) {
												foreach ($data_uang_keluar_dari as $row_jurnal1) {
													// print_r($row_jurnal1->nomor);
													// exit;
													$uang_keluar_dari = $row_jurnal1->no_perkiraan;
													$format_jumlah = number_format($row_jurnal1->kredit, 0, ',', '.');
													$totalrp += $row_jurnal1->kredit;
													$total = number_format($totalrp, 0, ',', '.');
													$cek_periode	= $this->db->query("SELECT * FROM periode WHERE stsaktif = 'O'")->result();
													if ($cek_periode > 0) {
														foreach ($cek_periode as $brs_periode) {
															$tanggal_periode	= $brs_periode->periode;
															$bln				= substr($tanggal_periode, 0, 2);
															$thn				= substr($tanggal_periode, 3, 4);
														}
													}

													$kode_cabang	= $this->session->userdata('kode_cabang');
													$data_buk_coa	= $this->db->query("SELECT * FROM coa WHERE no_perkiraan = '$uang_keluar_dari' and bln='$bln' and thn='$thn' and kdcab='$kode_cabang'")->result();
													if ($data_buk_coa > 0) {
														foreach ($data_buk_coa as $brs_coa) {
															$nama_coa = $brs_coa->nama;
														}
													} else {
														$nama_coa = "";
													}
												}
											}

											$data_nokir_biaya = $this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$id_buk' and kredit !=0")->result();
											// $data_nokir_biaya=$this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$id_buk' and no_perkiraan like '6%'")->result();

											if ($data_nokir_biaya > 0) {
												foreach ($data_nokir_biaya as $row_jurnal2) {
													$nokir_biaya = $row_jurnal2->no_perkiraan;
												}
											} else {
												$nokir_biaya = "-";
											}
									?>

											<tr bgcolor='#DCDCDC'>
												<td align="left"><?= $row->nomor ?></td>

												<td><?= $tgl_buk ?></td>

												<?php

												?>

												<td style='text-align:center'><?= $row->jenis_reff ?></td>
												<td><?= $row->bayar_kepada ?></td>
												<td><?= $row->note ?></td>
												<td style='text-align:right'><?= $format_jumlah ?></td>
												<td>
													<button class='btn btn-primary btn-sm' onclick="return view_detail('<?= $row->nomor ?>')"><i class="fa fa-search"></i></button>&nbsp;

													<a href="<?= base_url() ?>index.php/multi_buk/print_jbuk/<?= $row->nomor ?>" target="_blank" title="Print" class='btn btn-info btn-sm'><i class="fa fa-print"></i></a>&nbsp;

													<a href="<?= base_url() ?>index.php/jurnal/vmodal_batal_buk/<?= $row->nomor ?>" title="Batal" onclick="return validasi_hapus()" class='btn btn-danger btn-sm'><i class="fa fa-close"></i></a>
												</td>
											</tr>
									<?php
										}
									}
									?>

								</tbody>
								<tfoot>
								
									<tr bgcolor='#9acfea'>
										<th>
											<center></center>
										</th>
										<th>
											<center></center>
										</th>
										<th>
											<center>TOTAL</center>
										</th>
										<th>
											<center></center>
										</th>
										
										<th>
											<center></center>
										</th>
										<th>
											<center></center>
										</th>
										<th align="right">
											<?= $total ?>
										</th>
										
									</tr>
								
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="show_stock">
			</div>
			<div class="modal fade" id="modal-buk">
				<div class="modal-dialog modal-dialog-scrollable" style="width:90%; height:1000px">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="Mymodal-title">Detail Jurnal</h4>
						</div>
						<div class="modal-body" id="modal-buklist">

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

<!-- <script src="<?= base_url() ?>dist/jquery.min.js"></script> -->
<script type="text/javascript" src="<?= base_url(); ?>dist/jquery.timepicker.min.js"></script>

<!-- DataTables -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script>
    $(".example1").DataTable();
	
	function view_detail(nomorjurnal) {
		$.ajax({
			url: base_url + 'index.php/jurnal/modal_detailbuk/' + nomorjurnal,
			cache: false,
			type: "GET",
			success: function(data) {
				$('#modal-buklist').html(data);
				$("#modal-buk").modal('show');
			}
		});
	}
    
	
	
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