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

	.warnaTombolExcel {
		background-color: #02723B;
		color: white;
	}

	.warnaTombolPdf {
		background-color: #DE0B0B;
		color: white;
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
			<form method="post" action="<?= base_url() ?>index.php/report/tampilkan_labarugi" autocomplete="off">
				<div class="row">
					<div class="col-sm-10">
						<div class="col-sm-2">
							<div class="form-group">
								<br>
								<label>Bulan</label>
								<select type="text" name="bulan_labarugi" class="form-control">
									<?php
									$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bulan = @$this->input->post('bulan_labarugi');
									if (empty($bulan)) {
										$bulan = $bln_aktif;
										//$bulan = date("m")+0;
									}
									for ($i = 1; $i <= 12; $i++) {
										if ($i == $bulan) {
											echo "<option selected value='$i'>" . $nm_bulan[$i] . "</option>";
										} else {
											echo "<option value='$i'>" . $nm_bulan[$i] . "</option>";
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<br>
								<label>Tahun</label>
								<select type="text" name="tahun_labarugi" class="form-control">
									<?php
									$tahun = @$this->input->post('tahun_labarugi');
									if (empty($tahun)) {
										$tahun = $thn_aktif;
										// $tahun = date("Y")+0;
									}
									for ($i = date("Y") - 8; $i <= date("Y") + 2; $i++) {
										if ($tahun == $i) {
											echo "<option selected value='$i'>$i</option>";
										} else {
											echo "<option value='$i'>$i</option>";
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<br>
								<label>Level</label>
								<select name="level" id="level" class="form-control input-sm">
									<!-- <option value="" selected>-Pilih Level-</option> -->
									<option value="3">Level 3</option>
									<option value="5" selected>Level 5</option>
								</select>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="form-group">
								<br>
								<label> &nbsp;</label><br>
								<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn warnaTombol pull-center"> &nbsp;
								<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn warnaTombolExcel pull-center"> &nbsp;
								<input type="submit" name="tampilkan" value="View Pdf" onclick="return check()" class="btn warnaTombolPdf pull-center">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php $this->load->view('footer'); ?>

<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/moment.min.js"></script>
<script>
	function check() {
		if ($("#bulan_labarugi").val() == "0") {
			alert("Silahkan Pilih Bulan");
			return false;
		} else if ($("#tahun_labarugi").val() == "0") {
			alert("Silahkan Pilih Tahun");
			return false;
		} else if ($("#level").val() == "") {
			alert("Silahkan Pilih Level");
			return false;
		}
	}
</script>