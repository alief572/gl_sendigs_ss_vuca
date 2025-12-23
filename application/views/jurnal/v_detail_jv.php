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
						<?php
						$data_header = $this->db->query("SELECT * FROM javh WHERE nomor='$nomor_jurnal'")->row();
						?>
						<form action="<?= base_url() ?>index.php/report/filter_query_jurnal" method="post">
							<table width="100%">
								<tr>
									<td width="15%">
										<b>No. Jurnal</b>
									</td>

									<td width="40%">
										<input type="text" class="form-control input-sm" size='1' id="filter_text" name="filter_text" value="<?= $data_header->nomor ?>" readonly>
									</td>

									<td width="5%">

									</td>
									<td width="15%">
										<b>Koreksi Data No. </b>
									</td>
									<td width="20%">
										<input type="text" class="form-control input-sm" size='1' id="filter_text" name="filter_text" value="<?= $data_header->koreksi_no ?>" readonly>
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
										<b>Keterangan</b>
									</td>

									<td>
										<input type="text" class="form-control input-sm" size='1' id="filter_text" name="filter_text" value="<?= $data_header->keterangan ?>" readonly>
									</td>
									<td></td>
									<td>
										<b>Tanggal</b>
									</td>
									<td>
										<input type="text" class="form-control input-sm" size='1' id="filter_text" name="filter_text" value="<?= date("d-m-Y", strtotime($data_header->tgl)) ?>" readonly>
									</td>
								</tr>
							</table>
						</form>
					</div>
					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover">
								<thead>
									<tr bgcolor='#9acfea'>
										<!-- <th>
											<center>Tanggal</center>
										</th>
										<th>
											<center>Nomor Jurnal</center>
										</th>
										<th>
											<center>Tipe</center>
										</th> -->
										<th>
											<center>No. COA</center>
										</th>
										<th>
											<center>Nama. COA</center>
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
									$sum_debet = 0;
									$sum_kredit = 0;
									if ($list_data > 0) {
										$no = 0;
										foreach ($list_data as $row) {
											$no++;

											$sum_debet	+= $row->debet;
											$sum_kredit	+= $row->kredit;

											$format_debet = number_format($row->debet, 0, ',', '.');
											$format_kredit = number_format($row->kredit, 0, ',', '.');

											$format_sumdebet = number_format($sum_debet, 0, ',', '.');
											$format_sumkredit = number_format($sum_kredit, 0, ',', '.');

											$periode_jv	= $row->tanggal;
											$bln_jv		= substr($row->tanggal, 5, 2); // 2019-11-20
											$thn_jv		= substr($row->tanggal, 0, 4); // 2019-11-20
									?>
											<tr bgcolor='#DCDCDC'>
												<!-- <td align="center"><?= date_format(new DateTime($row->tanggal), "d-m-Y") ?></td>
												<td align="center"><?= $row->nomor ?></td>
												<td align="center"><?= $row->tipe ?></td> -->
												<td align="center"><?= $row->no_perkiraan ?></td>
												<td align="center"><?= $row->nama ?></td>
												<td><?= $row->keterangan ?></td>
												<td align="center"><?= $row->no_reff ?></td>
												<td align="right"><?= $format_debet ?></td>
												<td align="right"><?= $format_kredit ?></td>
											</tr>
									<?php
										}
									}
									// else {
									// 	$format_sumdebet = 0;
									// 	$format_sumkredit = 0;
									// }
									?>

									<tr bgcolor='#DCDCDC'>
										<td colspan="4" align="right"><b>TOTAL</b></td>
										<td align="right"><b><?= $format_sumdebet ?></b></td>
										<td align="right"><b><?= $format_sumkredit ?></b></td>
									</tr>
									<tr bgcolor='#DCDCDC'>
										<td colspan="8" align="left">
											<a href="<?= base_url() ?>index.php/jurnal/list_jv" class="btn btn-success">Kembali</a>&nbsp;
											<a href="<?= base_url() ?>index.php/multi_bum/print_jv/<?= $row->nomor ?>" target="_blank" title="Print" class='btn btn-info'><i class="fa fa-print"></i> Print</a>&nbsp;
											<!-- <a href="<?= base_url() ?>index.php/jurnal/print_jv/<?= $row->nomor ?>/<?= $bln_jv ?>/<?= $thn_jv ?>" class="btn btn-primary">Print</a> -->
										</td>
									</tr>
									<?php
									// 	}
									// }
									// else {
									// 	$format_sumdebet = 0;
									// 	$format_sumkredit = 0;
									// }
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