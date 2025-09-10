<?php $this->load->view('header'); ?>
<section class="content-header">
	<h1>
		<!--?=$this->session->userdata('pn_name')?-->
	</h1>
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
						<form action="<?= base_url() ?>index.php/Latihan/list_account" method="post">
							<div class="col-xs-2">
								<select type="text" name="thn" class="form-control" onchange="this.form.submit()">
									<?php
									$thn = @$this->input->post('thn');
									if (empty($thn)) {
										//$thn = date("Y");
										$singkat_cbg = $this->session->userdata('singkat_cbg');
										$cek_periode2 = $this->db->query("SELECT * FROM periode WHERE stsaktif='O' AND kdcab='$singkat_cbg'")->result();
										if ($cek_periode2 > 0) {
											foreach ($cek_periode2 as $r_periode2) {
												$bln_thn2	= $r_periode2->periode;	// 12-2019
												$thn		= substr($bln_thn2, 3, 4);
											}
										}
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
						</form>
					</div>
					<div></div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
							<thead>
								<tr>
									<th>Nama COA</th>
									<th>No. COA</th>
									<th>View Chart</th>
									<th>Januari</th>
									<th>Februari</th>
									<th>Maret</th>
									<th>April</th>
									<th>Mei</th>
									<th>Juni</th>
									<th>Juli</th>
									<th>Agustus</th>
									<th>September</th>
									<th>Oktober</th>
									<th>November</th>
									<th>Desember</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($data_accound1 > 0) {
									foreach ($data_accound1 as $row) {
										$nokir = $row->no_perkiraan; //1101-00-00
										//$nokir_=substr($nokir,0,4); //1101
										$namkir = $row->nama;
										//$id=$row->id;
										$jan = $row->jan;
										$feb = $row->feb;
										$mart = $row->mart;
										$apr = $row->apr;
										$mei = $row->mei;
										$jun = $row->jun;
										$jul = $row->jul;
										$agt = $row->agt;
										$sept = $row->sept;
										$okt = $row->okt;
										$nov = $row->nov;
										$des = $row->des;
								?>
										<tr>
											<td><?= $namkir ?></td>
											<td><?= $nokir ?></td>
											<td>
												<a href="<?= base_url() ?>index.php/Latihan/grafik/<?= $nokir ?>/<?= $row->thn ?>" title="" class="btn btn-primary btn-sm" width="20%"><i class="">view</i></a>
												<!-- <a href="<?= base_url() ?>index.php/Latihan/sample_database_highcart/<?= $row->id ?>" title=""  target="blank" class="btn btn-primary btn-sm" width="20%" ><i class="">view</i></a> -->
											</td>
											<td align="right" width="12%"><?= number_format($jan, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($feb, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($mart, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($apr, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($mei, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($jun, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($jul, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($agt, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($sept, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($okt, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($nov, 0, ',', '.'); ?>
											<td align="right" width="12%"><?= number_format($des, 0, ',', '.'); ?>
										</tr>
								<?php
									}
								} else {
									echo " <script>alert('Data Tidak Ada')</script>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $this->load->view('footer'); ?>

<!-- DataTables -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Charts -->
<script src="<?= base_url() ?>assets/highcharts/code/highcharts.js"></script>
<script src="<?= base_url() ?>assets/highcharts/code/modules/exporting.js"></script>
<!-- <script src="<?= base_url() ?>assets/highcharts/code/modules/export-data.js"></script>
<script src="<?= base_url() ?>assets/highcharts/code/modules/series-label.js"></script> -->

<!-- SlimScroll -->

<script>
	$(function() {
		$(".example1").DataTable();
	});

	//fungsi tampil grafik
	// function tampilGrafik(dataSeries){

	// 	//ambil data series melalui parameter
	// 	// Create the chart
	// 	//cari elemen dengan id trend, kemudian isikan highcart ke element tersebut
	// 	$('[id="trend"]').highcharts({
	// 		chart: {
	//         type: 'line'
	//     	},
	// 		title: {
	// 			text: 'Report Jan - Desember',
	// 		},
	// 		subtitle: {
	// 			text: ''
	// 		},
	// 		xAxis: {
	// 			categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug','Sept','okt','nov','des']
	// 		},
	// 		yAxis: {
	// 			title: {
	// 				text: 'Jumlah'
	// 			}
	// 		},
	// 		legend: {
	// 			enabled: false
	// 		},
	// 		plotOptions: {
	// 			series: {
	// 				borderWidth: 0,
	// 				dataLabels: {
	// 					enabled: true,
	// 					format: '{point.y:.1f}%'
	// 				}
	// 			}
	// 		},
	// 		tooltip: {
	// 			headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	// 			pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
	// 		},
	// 		series: dataSeries

	// 	});
	// }

	// $(document).ready(function(){
	// 	// mengambil data highcart di controller
	// 	$.ajax({
	// 		url: '<?= site_url() ?>/latihan/sample_database_highcart<?= $id ?>', //URL controller//bnr ga gni?
	// 		type: 'POST', //tipe data terkirim
	// 		data: {}, // isi jika ada data yang hendak dikirim
	// 			dataType: 'json', //tipe data diterima
	// 			beforeSend: function() {
	// 				//saat proses mengambil data sedang berjalan
	// 				//console.log('proses data higcart');
	// 			},
	// 			success: function(dataJSON) {
	// 				//saat berhasil mengambil data
	// 				//eksekusi fungsi tampil Grafik
	// 				tampilGrafik(dataJSON);
	// 			},
	// 			error: function(xhr) { // if error occured
	// 				//saat terjadi error dalam mengambil data
	// 				console.log('error');
	// 			}
	// 		})
	// 	});
</script>