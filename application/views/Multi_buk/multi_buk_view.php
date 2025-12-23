<?php $this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
?>
<section class="content-header">
	<h1> Multi BUK

	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	</ol>
</section>
<section class="content-header">

	<form action="#" method="POST" id="form_data">
		<div class="box box-primary">
			<!-- <div class="box-header">
				<h3 class="box-title">Report Multi BUK</h3>
			</div> -->
			<div class="alert alert-info">
				<form action="<?php echo site_url() ?>index.php/Multi_buk" method="POST" id="form-proses-bro">
					<!-- <form action="<?php echo site_url() . '/multi_buk'; ?>" method="POST" id="form-proses-bro"> -->
					<div class="row">
						<div class="col-sm-10">
							<div class="col-sm-3">
								<div class="form-group">
									<label>Tanggal Awal</label>
									<input type="text" name="datefr" id="datefr" class="form-control" value="<?php echo date_format(new DateTime($tgl_awal), "d-m-Y"); ?>" required readonly>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Tanggal Akhir</label>
									<input type="text" name="datetl" id="datetl" class="form-control" value="<?php echo date_format(new DateTime($tgl_akhir), "d-m-Y"); ?>" required readonly>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Cabang</label>
									<?php
									echo form_dropdown("kode_cabang", $rows_cabang, $cabang_pilih, array("class" => "form-control", "id" => "kode_cabang"));
									?>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label> &nbsp;</label><br>
									<input class="btn btn-primary" type="submit" name="filter" value="Filter" id="filter-btn">
									<!-- <button type="button" class="btn btn-primary btn-sm" name="filter" id="filter-btn"><i class='fa fa-filter'></i> &nbsp;Filter</button> -->
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="box-body">
				<?php
				echo "<span id='Loading'><center>Please Wait... <img src='" . base_url('assets/img/loading_small.gif') . "'></center></span>";
				?>
				<table id="example11" class="table table-striped table-bordered table-hover" width="100%">
					<thead>
						<tr bgcolor='#9acfea'>
							<th class="no-sort text-center"><input type='checkbox' id="checkall"></th>
							<th class="text-center">No. Jurnal</th>
							<!--<th class="no-sort text-center">Nama COA</th>-->
							<th class="text-center">Reff</th>
							<th class="text-center">Tanggal</th>
							<th class="no-sort text-center">Jumlah</th>
							<th class="no-sort text-center">Bayar Kepada</th>
							<th class="no-sort text-center">Note</th>
							<!-- <th class="no-sort text-center">User</th> -->
							<th class="no-sort text-center" width="50px">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($rows_data) {
							$intI	= 0;
							foreach ($rows_data as $keyR => $valR) {
								$intI++;

								$data_uang_keluar_dari = $this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$valR->nomor' and no_perkiraan like '11%'")->result();

								if ($data_uang_keluar_dari > 0) {
									foreach ($data_uang_keluar_dari as $row_jurnal1) {
										$uang_keluar_dari = $row_jurnal1->no_perkiraan;

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
								} else {
									$nama_coa = "";
								}
								echo "<tr style='font-size:11px'>";
								echo "<td class='text-center'><input type='checkbox' id='checkbox_data' class='checkbox_data' value='" . $valR->nomor . "'></td>";
								echo "<td class='text-left'>" . $valR->nomor . "</td>";
								//echo "<td class='text-left'>" . $nama_coa . "</td>";
								echo "<td class='text-left'>" . $valR->no_reff . "</td>";
								echo "<td class='text-center'>" . date('d-m-Y', strtotime($valR->tgl)) . "</td>";
								echo "<td class='text-right'>" . number_format($valR->jml) . "</td>";
								echo "<td class='text-left'>" . $valR->bayar_kepada . "</td>";
								echo "<td class='text-left'>" . $valR->note . "</td>";
								// echo "<td class='text-left'>" . $valR->user_id . "</td>";
								echo "<td class='text-center'> <a href='#' onClick='view_detail(\"" . $valR->nomor . "\");' data-header='Detail Data' ><i class='fa fa-search-plus'></i> Detail</a></td>";
								echo "</tr>";
							}
						} else {
							echo "<div><center>DATA TIDAK ADA</center></div>";
						}

						?>
					</tbody>
				</table>
			</div>

			<div class="box-footer">
				<?php if (!empty($rows_data)) { ?>
					<button type="button" class="btn btn-primary" id="PrintData">
						&nbsp;&nbsp;&nbsp;<i class='fa fa-fw fa-print'></i> Print &nbsp;&nbsp;&nbsp;
					</button>
				<?php } ?>
			</div>
		</div>
	</form>
	<div class="modal fade" id="Mymodal">
		<div class="modal-dialog" style="width:80%">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="Mymodal-title">Detail Data</h4>
				</div>
				<div class="modal-body" id="Mymodal-list">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


	<?php $this->load->view('footer');
	$loading = "<span id='Loading' style='margin-left:200px; display:block;'>Please Wait... <img src='" . base_url('assets/img/loading_small.gif') . "'></span>";
	?>

	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css') ?>">
	<script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js') ?>"></script>
	<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
	<style>
		.ui-datepicker select.ui-datepicker-month,
		.ui-datepicker select.ui-datepicker-year {
			color: #ffa31a;
		}
	</style>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<!-- page script -->
<script type="text/javascript">

		
		var base_url = '<?php echo base_url(); ?>';
		var active_controller = '<?php echo ($this->uri->segment(1)); ?>';
		$(document).ready(function() {
			$("#checkall").change(function() {
				$("input:checkbox").prop('checked', $(this).prop("checked"));
			});
			$("#datefr, #datetl").datepicker({
				dateFormat: 'dd-mm-yy',
				changeMonth: true,
				changeYear: true,
				maxDate: '+0d'
			});
			$('#filter-btn').click(function() {
				let tgl_awal = $('#datefr').val();
				let tgl_akhir = $('#datetl').val();
				if (tgl_akhir < tgl_awal) {
					alert('Incorrect period, please choose correct period first...');
					return false;
				}
				$('#form-proses-bro').submit();
			});
			var myTable = $("#example11").DataTable({
				searchHighlight: true,
				"oLanguage": {
					"sSearch": "<b>Live Search : </b>",
					// "sLengthMenu": "_MENU_ &nbsp;&nbsp;<b>Records Per Page</b>&nbsp;&nbsp;",
					"sLengthMenu": "_MENU_ &nbsp;&nbsp;Records Per Page",
					"sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
					"sInfoFiltered": "(filtered from _MAX_ total entries)",
					"sZeroRecords": "No matching records found",
					"sEmptyTable": "No data available in table",
					"sLoadingRecords": "Please wait - loading...",
					"oPaginate": {
						"sPrevious": "Prev",
						"sNext": "Next"
					}
				},
				"sPaginationType": "simple_numbers",
				"iDisplayLength": 10,
				"aLengthMenu": [
					[5, 10, 20, 50, 100, 150],
					[5, 10, 20, 50, 100, 150]
				],
				"columnDefs": [{
					"targets": 'no-sort',
					"orderable": false,
				}],
				"dom": 'Blfrtip',
				"buttons": [
				{
                "extend": 'excel',
				}],	


			});
		});

		//menghilangkan loading
		$(window).load(function() {
			$("#Loading").fadeOut("slow");
		});


		/**
		 * -----------------------------------------------------------------
		 * ON CLICK PRINT CHECK-BOX
		 */
		$(document).on('click', '#PrintData', function(e) {
			e.preventDefault();
			var dataCheck = $("#example11 tbody input:checkbox:checked").map(function() {
				return $(this).val();
			}).get();

			if (dataCheck == false) {
				alert('No record was selected, please choose at least one records...');
				return false;
			} else {
				window.open("<?php echo site_url('multi_buk/print_buk/?no_buk='); ?>" + dataCheck, "_blank");
			}
		});

		function view_detail(kode) {
			$.ajax({
				url: base_url + 'index.php/' + active_controller + '/detail_buk/' + kode,
				cache: false,
				type: "GET",
				success: function(data) {
					$('#Mymodal-list').html(data);
					$("#Mymodal").modal('show');


				}
			});
		}
	</script>
	<style type="text/css">
		#example11 thead th {
			color: #005279;
		}

		#example11 tbody tr {
			font-size: 12px;
		}
	</style>