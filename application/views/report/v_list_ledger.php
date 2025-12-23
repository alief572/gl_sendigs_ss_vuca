<?php $this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
$Arr_Coa		= array();
$Arr_Project	= array();
if ($data_perkiraan) {
	foreach ($data_perkiraan as $key => $vals) {
		$kode_Coa			= $vals->no_perkiraan . '^' . $vals->nama;
		$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan . '  ' . $vals->nama;
	}
}
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
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<b>PERIODE : </b><br><br>
				<!-- /.box-header -->
				<!-- <div class="box-body table-responsive no-padding"> -->
				<form method="post" action="<?= base_url() ?>index.php/report/tampilkan_ledger" autocomplete="off">
					<table class="table table-bordered">
						<tr>
							<td width="25%" align="right"><b>Bulan</b></td>
							<td>

								<select type="text" name="bulan_ledger" class="form-control">
									<?php
									$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bulan = @$this->input->post('bulan_ledger');
									if (empty($bulan)) {
										// $bulan = date("m") + 0;
										$bulan = $bln_ledger;
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

							</td>
						</tr>

						<tr>
							<td width="25%" align="right"><b>Tahun</b></td>
							<td>

								<select type="text" name="tahun_ledger" class="form-control">
									<?php
									$tahun = @$this->input->post('tahun_ledger');
									if (empty($tahun)) {
										// $tahun = date("Y") + 0;
										$tahun = $thn_ledger;
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

							</td>
						</tr>
						<tr>
							<td></td>
						</tr>

						<tr>
							<td width="25%"><b>Pilih Dari Nomor COA</b></td>
							<td>
								<select name="filter_nokir" id="filter_nokir" class="form-control input-sm">
									<option value="<?= $filter_nokir ?>" selected><?= str_replace("^", " ", $filter_nokir) ?></option>
									<?php
									foreach ($Arr_Coa as $key => $row2) {
										echo "<option value='" . $key . "'>" . $row2 . "</option>";
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td width="25%"><b>Pilih Sampai Nomor COA</b></td>
							<td>
								<select name="filter_nokir2" id="filter_nokir2" class="form-control input-sm">
									<option value="<?= $filter_nokir2 ?>" selected><?= str_replace("^", " ", $filter_nokir2) ?></option>
									<?php
									foreach ($Arr_Coa as $key => $row2) {
										echo "<option value='" . $key . "'>" . $row2 . "</option>";
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td width="25%" align="right"></td>
							<td width="25%" align="left">
								<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center">
								<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn btn-success pull-center">
							</td>
						</tr>

					</table>
					<!-- <a href="<?= base_url() ?>index.php/report/print_ledger" class="btn btn-warning" target="_blank">CETAK</a> -->

				</form>

			</div>
		</div>
	</div>
</section>

<section class="content-header">

	<div class="col-xs-12">

		<div class="box">

			<div class="row">

				<div class="box-header">

					<div class="box-body">

						<div class="box-body table-responsive no-padding">

							<table class="table table-bordered table-hover dataTable example1">

								<tbody>

									<tr>
										<?php
										//
										if ($bln_ledger > 0) {
											$nm_bln = $bln_ledger;
											if ($nm_bln == 1) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br>Periode : Januari " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 2) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Februari " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 3) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Maret " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 4) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : April " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 5) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Mei " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 6) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Juni " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 7) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Juli " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 8) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Agustus " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 9) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : September " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 10) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Oktober " . $thn_ledger . "</center></th></tr>";
											} elseif ($nm_bln == 11) {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : November " . $thn_ledger . "</center></th></tr>";
											} else {
												echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>LAPORAN LEDGER<br><br>Periode : Desember " . $thn_ledger . "</center></th></tr>";
											}
										}
										?>
									</tr>

									<tr>
										<td>
											<center><b>Nama COA</b></center>
										</td>
										<td>
											<center><b>Keterangan</b></center>
										</td>
										<td>
											<center><b>No. COA</b></center>
										</td>
										<td>
											<center><b>Tanggal Bukti</b></center>
										</td>
										<td>
											<center><b>Nomor Bukti</b></center>
										</td>
										<td>
											<center><b>SM</b></center>
										</td>
										<td>
											<center><b>Debet</b></center>
										</td>
										<td>
											<center><b>Kredit</b></center>
										</td>
										<td>
											<center><b>Saldo</b></center>
										</td>
									</tr>
									<!-- DATA DARI COA -->
									<?php
									//$count=0;

									if ($coa_sa > 0) {
										$count = 0;
										foreach ($coa_sa as $row_sa) {
											$count++;

											$nokir_induk 		= $row_sa->no_perkiraan;
											$nama_perkiraan		= $row_sa->nama;
											$saldo_awal[$count]	= $row_sa->saldoawal;
									?>

											<tr>
												<td><b><?= $nama_perkiraan ?></b></td>
												<td></td>
												<td align="center"><b><?= $nokir_induk ?></b></td>
												<td align="right" colspan="3">Saldo Awal -></td>
												<td></td>
												<td></td>
												<!-- <td align="right"><?= number_format($saldo_awal[$count]); ?></td> -->
												<td align="right"><?= number_format($saldo_awal[$count], 0, ',', '.'); ?></td>
											</tr>
											<!-- DATA DARI JURNAL -->
											<?php
											$sum_debet = 0;
											$sum_kredit = 0;
											$sum_debet = array();
											$sum_kredit = array();
											$nilai_debet = array();
											$nilai_kredit = array();

											$detail_jurnal	= $this->Report_model->get_detail_jurnal2($nokir_induk, $var_tgl_awal, $var_tgl_akhir);
											
											
											if ($detail_jurnal > 0) {
												$count2 = 0;
												$count3 = 0;

												foreach ($detail_jurnal as $row_dj) {
													$count2++;
													$count3++;
													//$nokir 					= $row_dj->no_perkiraan;
													$nama_perkiraan2[$count2] 	= $row_dj->keterangan;
													$tgl_bukti[$count2]			= $row_dj->tanggal;
													$nomor_bukti[$count2] 		= $row_dj->nomor;
													$tipe_sm[$count2] 			= $row_dj->tipe;
													$nilai_debet[$count2] 		= $row_dj->debet;
													$nilai_kredit[$count2] 		= $row_dj->kredit;
													// if ((isset($sum_debet[$count]))  == "" || (isset($sum_kredit[$count])) == "" || (isset($nilai_debet[$count2]))  == "" || (isset($nilai_kredit[$count2])) == "") {
													// 	$sum_debet[$count]	 		+= $nilai_debet[$count2];
													// 	$sum_kredit[$count]  		+= $nilai_kredit[$count2];
													// } else {

													$sum_debet[$count]	 		+= $nilai_debet[$count2];
													$sum_kredit[$count]  		+= $nilai_kredit[$count2];
													//}

													//$current_saldo[$count3]	= $saldo_awal[$count];
													$current_saldo[$count3]		= $saldo_awal[$count] + $nilai_debet[$count2] - $nilai_kredit[$count2];
													//$current_saldo[$count2]	+= $current_saldo[$count2] + $nilai_debet[$count2] - $nilai_kredit[$count2];
													// $saldo_akhir				= $sum_debet + $saldo_awal[$count] - $sum_kredit;	
													$saldo_akhir				= $current_saldo[$count3];
											?>
													<tr>
														<td></td>
														<td><?= $nama_perkiraan2[$count2] ?></td>
														<td></td>
														<td align="center"><?= date_format(new DateTime($tgl_bukti[$count2]), "d-m-Y")  ?></td>
														<td align="center"><?= $nomor_bukti[$count2] ?></td>
														<td align="center"><?= $tipe_sm[$count2] ?></td>
														<td align="right"><?= number_format($nilai_debet[$count2], 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($nilai_kredit[$count2], 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($current_saldo[$count3], 0, ',', '.'); ?></td>
													</tr>
											<?php
													$saldo_awal[$count] = $current_saldo[$count3];
												}
											} else {
												$saldo_akhir				= $saldo_awal[$count];
											}
											?>

											<tr>
												<td></td>
												<td></td>
												<td align="right" colspan="4">Saldo Akhir -></td>

												<td align="right"><?= number_format($sum_debet[$count], 0, ',', '.'); ?></td>
												<td align="right"><?= number_format($sum_kredit[$count], 0, ',', '.'); ?></td>
												<td align="right"><?= number_format($saldo_akhir, 0, ',', '.'); ?></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td align="right" colspan="4"></td>
												<td align="right"></td>
												<td align="right"></td>
												<td align="right"></td>
											</tr>

									<?php
											//							$current_saldo[$count3]=0;
										}
									}
									//$count++;
									?>

								</tbody>

							</table>

						</div>

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
		if ($("#bulan_ledger").val() == "0") {
			alert("Silahkan Pilih Bulan");
			return false;
		} else if ($("#tahun_ledger").val() == "0") {
			alert("Silahkan Pilih Tahun");
			return false;
		} else if ($("#filter_nokir").val() == "0") {
			alert("Silahkan Pilih Dari Nomor Perkiraan Mana");
			return false;
		} else if ($("#filter_nokir2").val() == "0") {
			alert("Silahkan Pilih Sampai Nomor Perkiraan Mana");
			return false;
		}
	}
</script>