<?php $this->load->view('header'); ?>
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
			<form method="post" action="<?= base_url() ?>index.php/setting/proses_switch_cabang" autocomplete="off">
				<div class="row">
					<div class="col-sm-10">
						<div class="col-sm-5">
							<div class="form-group">
								<br>
								<label>Switch Cabang</label>
								<select type="text" name="cb_cabang" class="form-control">
									<option selected value="">-- Pilih Cabang --</option>
									<?php
									if ($list_data > 0) {
										foreach ($list_data as $row) {
											$kode_cabang = $row->kdcab;
											echo "<option value='$kode_cabang'>" . $row->cabang . "</option>";
										}
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-sm-5">
							<div class="form-group">
								<br>
								<label> &nbsp;</label><br>
								<input type="submit" name="switch" value="Save" onclick="return check()" class="btn warnaTombol pull-center">
								<!-- <input type="submit" name="tmb_proses_periode" value="Proses" onclick="return check()" class="btn warnaTombol pull-center"> -->
								<!-- <input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn warnaTombol pull-center"> &nbsp;
								<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn warnaTombolExcel pull-center"> &nbsp;
								<input type="submit" name="tampilkan" value="View Pdf" onclick="return check()" class="btn warnaTombolPdf pull-center"> -->
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	if ($pesan_on == 1) {
		echo "<div class='alert alert-success' role='alert'>Berhasil Berganti Cabang !</div>";
	} elseif ($pesan_on == 2) {
		echo "<div class='alert alert-danger' role='alert'>Di Pilih Dulu Cabangnya !</div>";
	}
	?>
	<!-- </div>
    </div>		 -->
</section>

<?php $this->load->view('footer'); ?>

<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/moment.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
	function check() {
		if ($("#cb_cabang").val() == "") {
			alert("Silahkan Pilih Cabang Dulu !");
			return false;
		}
	}
</script>