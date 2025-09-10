<style type="text/css">
	#headerDiv,
	#contentDiv {
		float: left;
		width: 510px;
	}

	#headerDiv a {
		float: right;
		margin: 10px 10px 5px 5px;
	}

	#myHeader {
		font-size: 1.1em;
		font-weight: bold;
		margin: 5px;
		float: left;
	}

	#titleText {
		font-size: 1.3em;
		font-weight: bold;
		margin: 8px;
	}

	#headerDiv {
		background-color: #a0a0a0;
		color: #ffffff;
	}

	#contentDiv {
		background-color: #f0f0f0;
	}

	#myContent {
		margin: 1px;
	}
</style>
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
						<div class="col-xs-2">

							<body>
								Click collapse/expand image to toggle the content below.
								<div id="headerDiv">
									<a id="imgHeader" href="javascript:toggle('myContent','imgHeader');">
										<img title="Collapse" alt="" src="<?= base_url() ?>/collapse.png" border="0" />
									</a>
									<div id="titleText">Demo Toggle Element Div</div>
								</div>
								<div style="clear: both;"></div>
								<div id="contentDiv">
									<div id="myContent" style="display: block;">
										<ul>
											<li>This is line one of the content.</li>
											<li>This is line two of the content.</li>
											<li>This is line three of the content.</li>
										</ul>
									</div>
								</div>
								<div style="clear: both;"></div>
								This is the demo of collapse/expand element.
							</body>
							<!-- <i href="<?= base_url() ?>index.php/Ledger_in_query/excel_liq/" title="Print Semua Item" target="blank" class="btn btn-info" width="">EXPORT TO EXCEL<i class=""></i></a> -->
						</div>
					</div>
					<div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
							<thead>
								<tr>
									<th>Nama COA</th>
									<th>No. COA</th>
									<th>Saldo Awal</th>
									<th>Debet</th>
									<th>Kredit</th>
									<th>Saldo Akhir</th>
									<td>Aksi</td>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								if ($data_ledq > 0) {
									foreach ($data_ledq as $row) {
										$i++;
										$nokir = $row->no_perkiraan;
										$sa = $row->saldoawal;

										$debet = $row->debet;
										$kredit = $row->kredit;
										$saldoakhir = $row->saldoakhir;
								?>
										<tr>
											<td><?= $row->nama ?></td>
											<td><?= $row->no_perkiraan ?></td>
											<td align="right"><?= number_format($sa, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($saldoakhir, 0, ',', '.'); ?></td>
											<!-- <td> <a href="<?= base_url() ?>index.php/Ledger_in_query/detail_list_inquery/<?= $row->id ?>/<?= $row->no_perkiraan ?>" title="" target="blank" class="btn btn-info" width="20%"><i>View Detail</i></a></td> -->
											<td></td>
										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<div id="show_stock"></div>
				</div>
				<div class="box-body table-responsive no-padding">
					<table class="table table-bordered table-hover dataTable example2">
						<thead>
							<tr>
								<th width="62%"></th>
								<th>Total Debet</th>
								<th>Total Kredit</th>
								<th>Total Saldo Akhir</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php
								$cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
								if ($cek_periode_aktif > 0) {
									foreach ($cek_periode_aktif as $row_periode_aktif) {
										$tgl_periode_aktif	= $row_periode_aktif->periode;
										$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
										$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
									}
								}
								$lev3 = $this->db->query("SELECT Sum(saldoawal) as saldoawal,sum(debet) as debet,sum(kredit) as kredit,sum(saldoawal+debet-kredit) as saldoakhir from COA WHERE bln='$bln_aktif' and thn='$thn_aktif' AND level='3' ")->result();

								if ($lev3 > 0) {
									foreach ($lev3 as $r_jur) {
										$deb = $r_jur->debet;
										$kred = $r_jur->kredit;
										$saldoakhir = $r_jur->saldoakhir;
									}
								}
								?>
								<td width="64%" align="right">Level 3</td>
								<td align="right" width="12%"><?= number_format($deb, 0, ',', '.'); ?></td>
								<td align="right" width="12%"><?= number_format($kred, 0, ',', '.'); ?></td>
								<td align="right" width="12%"><?= number_format($saldoakhir, 0, ',', '.'); ?></td>
							</tr>

							<tr>
								<?php
								$cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
								if ($cek_periode_aktif > 0) {
									foreach ($cek_periode_aktif as $row_periode_aktif) {
										$tgl_periode_aktif	= $row_periode_aktif->periode;
										$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
										$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
									}
								}
								$lev4 = $this->db->query("SELECT Sum(saldoawal) as saldoawal,sum(debet) as debet,sum(kredit) as kredit,sum(saldoawal+debet-kredit) as saldoakhir from COA WHERE bln='$bln_aktif' and thn='$thn_aktif' AND level='4' ")->result();

								if ($lev4 > 0) {
									foreach ($lev4 as $r_jur4) {
										$deb4 = $r_jur4->debet;
										$kred4 = $r_jur4->kredit;
										$saldoakhir4 = $r_jur4->saldoakhir;
									}
								}
								?>
								<td width="62%" align="right">Level 4</td>
								<td align="right"><?= number_format($deb4, 0, ',', '.'); ?></td>
								<td align="right"><?= number_format($kred4, 0, ',', '.'); ?></td>
								<td align="right"><?= number_format($saldoakhir4, 0, ',', '.'); ?></td>
							</tr>

							<tr>
								<?php
								$cek_periode_aktif			= $this->Liq_model->cek_periode_aktif();
								if ($cek_periode_aktif > 0) {
									foreach ($cek_periode_aktif as $row_periode_aktif) {
										$tgl_periode_aktif	= $row_periode_aktif->periode;
										$bln_aktif			= substr($tgl_periode_aktif, 0, 2);
										$thn_aktif			= substr($tgl_periode_aktif, 3, 4);
									}
								}
								$lev5 = $this->db->query("SELECT Sum(saldoawal) as saldoawal,sum(debet) as debet,sum(kredit) as kredit,sum(saldoawal+debet-kredit) as saldoakhir from COA WHERE bln='$bln_aktif' and thn='$thn_aktif' AND level='5' ")->result();

								if ($lev5 > 0) {
									foreach ($lev5 as $r_jur5) {
										$deb5 = $r_jur5->debet;
										$kred5 = $r_jur5->kredit;
										$saldoakhir5 = $r_jur5->saldoakhir;
									}
								}
								?>
								<td width="62%" align="right">Level 5</td>
								<td align="right"><?= number_format($deb5, 0, ',', '.'); ?></td>
								<td align="right"><?= number_format($kred5, 0, ',', '.'); ?></td>
								<td align="right"><?= number_format($saldoakhir5, 0, ',', '.'); ?></td>
							</tr>
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
		$(".example1").DataTable();
	});

	// function add_stock() {

	// 	$.get("<?= base_url(); ?>index.php/Latihan/add_stock", {
	// 		option: ""
	// 	}, function(data) {
	// 		$('#show_stock').html(data);
	// 		$('#myModal').modal('show');
	// 	});
	// }

	// function edit_stock(id) {
	// 	$.get("<?= base_url(); ?>index.php/Latihan/edit_stock", {
	// 		option: id
	// 	}, function(data) {
	// 		$('#show_stock').html(data);
	// 		$('#myModal').modal('show');
	// 	});
	// }

	// function update() {
	// 	$.get("<?= base_url(); ?>index.php/Latihan/update_tpe_coa", {
	// 		option: id
	// 	}, function(data) {
	// 		$('#show_stock').html(data);
	// 		$('#myModal').modal('show');
	// 	});
	// }

	// function validasi_hapus() {
	// 	var dd = confirm("hapus data ?");
	// 	if (dd == false) {
	// 		return false;
	// 	}
	// }

	// function print_bulanan() {

	// 	$.get("<?= base_url(); ?>index.php/Latihan/print_ledge_inquery", {
	// 		option: ""
	// 	}, function(data) {
	// 		$('#show_stock').html(data);
	// 		$('#myModal').modal('show');
	// 	});
	// }
</script>
<script type="text/javascript">
	function toggle(showHideDiv, switchImgTag) {
		var ele = document.getElementById(showHideDiv);
		var imageEle = document.getElementById(switchImgTag);
		if (ele.style.display == "block") {
			ele.style.display = "none";
			imageEle.innerHTML = '<img src="<?= base_url() ?>/expand.png" title="Expand" border=0>';
		} else {
			ele.style.display = "block";
			imageEle.innerHTML = '<img src="<?= base_url() ?>/collapse.png" title="Collapse" border=0>';
		}
	}
</script>