<?php $this->load->view('header');
error_reporting('E_ALL & ~E_NOTICE');
?>

<style>
	.myDiv {
		background-color: #d3eefa;
		font-family: verdana;
		border: none;
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
		/* border: 1px solid black; */
		border: none;
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
			<form method="post" action="<?= base_url() ?>index.php/konsolidasi/ctrl_labarugi" autocomplete="off">
				<div class="row">
					<div class="col-sm-10">
						<div class="col-sm-2">
							<div class="form-group">
								<br>
								<label>Bulan</label>
								<select type="text" name="bulan_ctrlabarugi" class="form-control">
									<?php
									$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bulan = @$this->input->post('bulan_ctrlabarugi');
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
								<select type="text" name="tahun_ctrlabarugi" class="form-control">
									<?php
									$tahun = @$this->input->post('tahun_ctrlabarugi');
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
						<div class="col-sm-5">
							<div class="form-group">
								<br>
								<label> &nbsp;</label><br>
								<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn warnaTombol pull-center"> &nbsp;
								<!-- <input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn warnaTombolExcel pull-center"> &nbsp;
								<input type="submit" name="tampilkan" value="View Pdf" onclick="return check()" class="btn warnaTombolPdf pull-center"> -->
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

		<div class="box">
			<div class="row">
				<div class="box-header">
					<div class="box-body">
						<table class="table table-bordered">
							<thead>
								<tr bgcolor='#0073B7'>
									<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center>KODE</center>
									</th>
									<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center>CABANG</center>
									</th>
									<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center>LABA (Income Statement)</center>
									</th>
									<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center>LABA (3903-01-01)</center>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$total_cmonth41			= 0;
								$total_cmonth51			= 0;
								$total_cmonth61			= 0;
								$total_cmonth62			= 0;
								$total_cmonth68			= 0;
								$total_cmonth71			= 0;
								$total_cmonth72			= 0;
								$total_cmonth91			= 0;

								if ($data_coa) {
									foreach ($data_coa as $r_coa) {
										$kdcab			= $r_coa->kdcab; // 202-A
										$nocab			= substr($kdcab, 0, 3); // 202
										$subcab			= substr($kdcab, 4, 1); // A

										$data_cabang	= $this->db->query("SELECT * FROM pastibisa_tb_cabang WHERE nocab='$nocab' AND subcab='$subcab'")->result();

										if ($data_cabang) {
											foreach ($data_cabang as $r_cbg) {
												$cabang	= $r_cbg->cabang;
												// $kdcab	= $r_cabang->nocab . "-" . $r_cabang->subcab;
											}
										}

										$get_laba3903 = $this->db->query("SELECT * FROM coa WHERE no_perkiraan = '3903-01-01' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->row();

										$laba3903 = ($get_laba3903->saldoawal + $get_laba3903->debet - $get_laba3903->kredit) * $get_laba3903->faktor;

										$get41 = $this->db->query("SELECT *,SUM(debet) as debet41,SUM(kredit) as kredit41 FROM coa WHERE no_perkiraan like '41%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get41) {
											foreach ($get41 as $r41) {
												$total_cmonth41		= ($r41->debet41 - $r41->kredit41) * $r41->faktor;
												// $cmonth41		= ($r41->debet - $r41->kredit) * $r41->faktor;
												// $total_cmonth41 +=  $cmonth41;

												// print_r(number_format($cmonth41, 0, ',', '.'));
												// echo "<br>";
												// print_r($baris);
												// echo "<br>";
												// print_r($brske_41);
												// echo "<br>";
											}
										}

										$get51 = $this->db->query("SELECT *,SUM(debet) as debet51,SUM(kredit) as kredit51 FROM coa WHERE no_perkiraan like '51%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get51) {
											foreach ($get51 as $r51) {
												$total_cmonth51		= ($r51->debet51 - $r51->kredit51) * $r51->faktor;
												//$total_cmonth51 +=  $cmonth51;

												// print_r(number_format($cmonth51, 0, ',', '.'));
												// echo "<br>";
											}
										}
										$labarugi_kotor = $total_cmonth41 - $total_cmonth51;

										$get61 = $this->db->query("SELECT *,SUM(debet) as debet61,SUM(kredit) as kredit61 FROM coa WHERE no_perkiraan like '61%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get61) {
											foreach ($get61 as $r61) {
												$total_cmonth61		= ($r61->debet61 - $r61->kredit61) * $r61->faktor;
												//$total_cmonth61 +=  $cmonth61;
											}
										}

										$get62 = $this->db->query("SELECT *,SUM(debet) as debet62,SUM(kredit) as kredit62 FROM coa WHERE no_perkiraan like '62%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get62) {
											foreach ($get62 as $r62) {
												$total_cmonth62		= ($r62->debet62 - $r62->kredit62) * $r62->faktor;
												//$total_cmonth62 +=  $cmonth62;
											}
										}

										$get68 = $this->db->query("SELECT *,SUM(debet) as debet68,SUM(kredit) as kredit68 FROM coa WHERE no_perkiraan like '68%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get68) {
											foreach ($get68 as $r68) {
												$total_cmonth68		= ($r68->debet68 - $r68->kredit68) * $r68->faktor;
												// $total_cmonth68 +=  $cmonth68;
											}
										}

										$total_biaya = $total_cmonth61 + $total_cmonth62 + $total_cmonth68;

										$get71 = $this->db->query("SELECT *,SUM(debet) as debet71,SUM(kredit) as kredit71 FROM coa WHERE no_perkiraan like '71%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get71) {
											foreach ($get71 as $r71) {
												$total_cmonth71		= ($r71->debet71 - $r71->kredit71) * $r71->faktor;
												//$total_cmonth71 +=  $cmonth71;
											}
										}

										$get72 = $this->db->query("SELECT *,SUM(debet) as debet72,SUM(kredit) as kredit72 FROM coa WHERE no_perkiraan like '72%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get72) {
											foreach ($get72 as $r72) {
												$total_cmonth72		= ($r72->debet72 - $r72->kredit72) * $r72->faktor;
												//$total_cmonth72 +=  $cmonth72;
											}
										}

										$get91 = $this->db->query("SELECT *,SUM(debet) as debet91,SUM(kredit) as kredit91 FROM coa WHERE no_perkiraan like '91%' and level='5' and kdcab = '$kdcab' and bln='$data_bulan_post' and thn='$data_tahun_post'")->result();

										if ($get91) {
											foreach ($get91 as $r91) {
												$total_cmonth91		= ($r91->debet91 - $r91->kredit91) * $r91->faktor;
												//$total_cmonth91 +=  $cmonth91;
											}
										}

										$labarugi_bulan_berjalan = $labarugi_kotor - $total_biaya + $total_cmonth71 - $total_cmonth72 - $total_cmonth91;
								?>
										<?php?>
										<tr>
											<td width="5%"><?= $kdcab ?></td>
											<td width="20%"><?= $cabang ?></td>
											<td width="25%" align="right"><?= number_format($labarugi_bulan_berjalan, 0, ',', '.') ?></td>
											<td width="25%" align="right"><?= number_format($laba3903, 0, ',', '.') ?></td>
										</tr>
								<?php
									}
								}
								?>
							</tbody>
						</table>
						<?php
						?>
					</div>
				</div>
			</div>
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