<style type="text/css">
	#kiri {
		width: 50%;
		float: left;
	}

	#kanan {
		width: 50%;
		float: right;
	}

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
<?php
/* nitip

*/
?>

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
	<div class="box box-primary">
		<div class="myDiv">
			<form method="post" action="<?= base_url() ?>index.php/report/tampilkan_neraca" autocomplete="off">
				<div class="row">
					<div class="col-sm-10">
						<div class="col-sm-3">
							<div class="form-group">
								<br>
								<label>Bulan</label>
								<select type="text" name="bulan_neraca" class="form-control">
									<?php
									$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bulan = @$this->input->post('bulan_neraca');
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
								<select type="text" name="tahun_neraca" class="form-control">
									<?php
									$tahun = @$this->input->post('tahun_neraca');
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
									<?php
									if ($level == 3) {
									?>
										<option value="3" selected>3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									<?php
									} elseif ($level == 4) {
									?>
										<option value="3">3</option>
										<option value="4" selected>4</option>
										<option value="5">5</option>
									<?php
									} else {
									?>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5" selected>5</option>
									<?php
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
								<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn warnaTombolExcel pull-center"> &nbsp;
								<input type="submit" name="tampilkan" value="View Pdf" onclick="return check()" class="btn warnaTombolPdf pull-center">
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="box">
		<div class="row">
			<div class="box-header">
				<div class="box-body">
					<table class="table table-bordered table-hover dataTable example1">
						<?php
						$nocab = $this->session->userdata('nomor_cabang');
						$cek_cabang = $this->db->query("SELECT nocab,namacabang FROM pastibisa_tb_cabang WHERE nocab='$nocab'")->row();
						$nama_cabang = $cek_cabang->namacabang;

						if ($data_bulan_post > 0) {
							$nm_bln = $data_bulan_post;
							if ($nm_bln == 1) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Januari " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 2) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Februari " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 3) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Maret " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 4) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : April " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 5) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Mei " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 6) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Juni " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 7) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Juli " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 8) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Agustus " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 9) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : September " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 10) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Oktober " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} elseif ($nm_bln == 11) {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : November " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							} else {
								echo "<th style='text-align:center;font-size:18px;border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;'><center>BALANCE SHEET LEVEL " . $level . "<br>Periode : Desember " . $data_tahun_post . "<br>" . $nama_cabang . "</center></th>";
							}
						}
						?>
					</table>

					<div id="kiri">
						<table class="table table-bordered table-hover dataTable example1">
							<tbody>
								<tr>
									<td align="left" bgcolor='#0073B7' class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center><b>Code</b></center>
									</td>
									<td align="left" bgcolor='#0073B7' class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center><b>Desciption</b></center>
									</td>
									<td align="right" bgcolor='#0073B7' class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center><b>Amount</b></center>
									</td>
									<td class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
								</tr>

								<!-- HARTA LANCAR -->
								<tr>
									<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>11</b></td>
									<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>HARTA LANCAR</b></td>
									<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
									<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
								</tr>

								<?php
								$SubTotal_HartaLancar = 0;
								$rp_SubTotal_HartaLancar = 0;
								if ($data_HartaLancar > 0) {

									foreach ($data_HartaLancar as $row) {

										$nokir_HartaLancar			= $row->no_perkiraan;
										$nm_perkiraan_HartaLancar	= $row->nama;
										$vFaktor 					= $row->faktor;
										$vSaldoAwal 				= $row->saldoawal;
										$vDebet 					= $row->debet;
										$vKredit 					= $row->kredit;

										$jml_HartaLancar			= $vSaldoAwal + ($vDebet - $vKredit) * $vFaktor;

										$SubTotal_HartaLancar 		+=  $jml_HartaLancar;

										$rp_SubTotal_HartaLancar	= number_format($SubTotal_HartaLancar, 0, ',', '.');
								?>
										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_HartaLancar ?></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_HartaLancar ?></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= $rp_jml_HartaLancar = number_format($jml_HartaLancar, 0, ',', '.'); ?></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
									<?php
									}
								}
									?>
										</tr>
										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b></b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b>--------------------</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
										</tr>

										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Sub Total HARTA LANCAR</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_SubTotal_HartaLancar ?></b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
										</tr>

										<tr>

											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
										</tr>

										<!-- HARTA TIDAK LANCAR -->
										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>12</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>HARTA TIDAK LANCAR</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
										</tr>

										<?php
										$SubTotal_tdkHartaLancar = 0;
										$rp_SubTotal_tdkHartaLancar = 0;
										if ($data_tdkHartaLancar > 0) {

											foreach ($data_tdkHartaLancar as $row12) {

												$nokir_tdkHartaLancar			= $row12->no_perkiraan;
												$nm_perkiraan_tdkHartaLancar	= $row12->nama;
												$vFaktor12 					= $row12->faktor;
												$vSaldoAwal12 				= $row12->saldoawal;
												$vDebet12 					= $row12->debet;
												$vKredit12 					= $row12->kredit;

												$jml_tdkHartaLancar			= $vSaldoAwal12 + ($vDebet12 - $vKredit12) * $vFaktor12;

												$SubTotal_tdkHartaLancar 		+=  $jml_tdkHartaLancar;

												$rp_SubTotal_tdkHartaLancar	= number_format($SubTotal_tdkHartaLancar, 0, ',', '.');
										?>
												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_tdkHartaLancar ?></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_tdkHartaLancar ?></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= $rp_jml_tdkHartaLancar = number_format($jml_tdkHartaLancar, 0, ',', '.'); ?></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<?php
											}
										}
											?>
												</tr>
												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b></b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b>--------------------</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
												</tr>

												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Sub Total HARTA TIDAK LANCAR</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_SubTotal_tdkHartaLancar ?></b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
												</tr>

												<tr>

													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
												</tr>

												<!-- AKTIVA TETAP -->
												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>13</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>AKTIVA TETAP</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
												</tr>

												<?php
												$SubTotal_AktivaTetap = 0;
												$rp_SubTotal_AktivaTetap = 0;
												if ($data_AktivaTetap > 0) {

													foreach ($data_AktivaTetap as $row2) {

														$nokir_AktivaTetap				= $row2->no_perkiraan;
														$nm_perkiraan_AktivaTetap		= $row2->nama;
														$vFaktor_AktivaTetap 			= $row2->faktor;
														$vSaldoAwal_AktivaTetap			= $row2->saldoawal;
														$vDebet_AktivaTetap				= $row2->debet;
														$vKredit_AktivaTetap			= $row2->kredit;

														$jml_AktivaTetap				= $vSaldoAwal_AktivaTetap + ($vDebet_AktivaTetap - $vKredit_AktivaTetap) * $vFaktor_AktivaTetap;

														$SubTotal_AktivaTetap 			+=  $jml_AktivaTetap;

														$rp_SubTotal_AktivaTetap		= number_format($SubTotal_AktivaTetap, 0, ',', '.');
												?>
														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_AktivaTetap ?></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_AktivaTetap ?></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= $rp_jml_AktivaTetap		= number_format($jml_AktivaTetap, 0, ',', '.'); ?></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<?php
													}
												}
													?>
														</tr>

														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b></b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b>--------------------</b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
														</tr>

														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-right:none; border-bottom-style:none; border-left-style:none;"><b>Sub Total AKTIVA TETAP</b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_SubTotal_AktivaTetap ?></b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
														</tr>

														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
														</tr>

														<!-- AKTIVA LAIN-LAIN -->
														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>14</b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>AKTIVA LAIN-LAIN</b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
														</tr>

														<?php
														$SubTotal_AktivaLain = 0;
														$rp_SubTotal_AktivaLain = 0;
														if ($data_AktivaLain > 0) {

															foreach ($data_AktivaLain as $row3) {

																$nokir_AktivaLain				= $row3->no_perkiraan;
																$nm_perkiraan_AktivaLain		= $row3->nama;
																$vFaktor_AktivaLain				= $row3->faktor;
																$vSaldoAwal_AktivaLain			= $row3->saldoawal;
																$vDebet_AktivaLain				= $row3->debet;
																$vKredit_AktivaLain 			= $row3->kredit;

																$jml_AktivaLain					= ($vSaldoAwal_AktivaLain + $vDebet_AktivaLain - $vKredit_AktivaLain) * $vFaktor_AktivaLain;

																$SubTotal_AktivaLain 			+=  $jml_AktivaLain;

																$rp_SubTotal_AktivaLain			= number_format($SubTotal_AktivaLain, 0, ',', '.');
														?>
																<tr>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_AktivaLain ?></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_AktivaLain ?></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= $rp_jml_AktivaLain		= number_format($jml_AktivaLain, 0, ',', '.'); ?></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<?php
															}
														} else {
															$SubTotal_AktivaLain 			= 0;
															$rp_SubTotal_AktivaLain			= number_format($SubTotal_AktivaLain, 0, ',', '.');
														}
															?>
																</tr>
																<tr>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b></b></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b>--------------------</b></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
																</tr>

																<tr>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
																	<td style="border-right:none; border-bottom-style:none; border-left-style:none;"><b>Sub Total AKTIVA LAIN-LAIN</b></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_SubTotal_AktivaLain ?></b></td>
																	<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
																</tr>
							</tbody>
						</table>
					</div>

					<div id="kanan">
						<table class="table table-bordered table-hover dataTable example1">
							<tbody>
								<tr>
									<td align="left" bgcolor='#0073B7' class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center><b>Code</b></center>
									</td>
									<td align="left" bgcolor='#0073B7' class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center><b>Desciption</b></center>
									</td>
									<td align="right" bgcolor='#0073B7' class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
										<center><b>Amount</b></center>
									</td>
									<!-- <td class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
								</tr>

								<!-- HUTANG -->
								<tr>
									<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>21</b></td>
									<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>HUTANG</b></td>
									<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
									<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
								</tr>

								<?php
								$SubTotal_Hutang = 0;
								$rp_SubTotal_Hutang = 0;

								if ($data_Hutang > 0) {

									foreach ($data_Hutang as $row4) {

										$nokir_Hutang				= $row4->no_perkiraan;
										$nm_perkiraan_Hutang		= $row4->nama;
										$vFaktor_Hutang				= $row4->faktor;
										$vSaldoAwal_Hutang			= $row4->saldoawal;
										$vDebet_Hutang 				= $row4->debet;
										$vKredit_Hutang 			= $row4->kredit;

										$jml_Hutang					= ($vSaldoAwal_Hutang + $vDebet_Hutang - $vKredit_Hutang) * $vFaktor_Hutang;

										$SubTotal_Hutang 			+=  $jml_Hutang;

										$rp_SubTotal_Hutang			= number_format($SubTotal_Hutang, 0, ',', '.');
								?>
										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_Hutang ?></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_Hutang ?></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= $rp_jml_Hutang		= number_format($jml_Hutang, 0, ',', '.'); ?></td>
											<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
									<?php
									}
								}
									?>
										</tr>
										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b></b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b>--------------------</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
										</tr>

										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-right:none; border-bottom-style:none; border-left-style:none;"><b>Sub Total HUTANG</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_SubTotal_Hutang ?></b></td>
											<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
										</tr>

										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
										</tr>

										<!-- MODAL -->
										<tr>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>31</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>MODAL</b></td>
											<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
											<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
										</tr>

										<?php
										$SubTotal_Modal = 0;
										$rp_SubTotal_Modal = 0;
										if ($data_Modal > 0) {

											foreach ($data_Modal as $row5) {

												$nokir_Modal				= $row5->no_perkiraan;
												$nm_perkiraan_Modal			= $row5->nama;
												$vFaktor_Modal				= $row5->faktor;
												$vSaldoAwal_Modal 			= $row5->saldoawal;
												$vDebet_Modal 				= $row5->debet;
												$vKredit_Modal				= $row5->kredit;

												$jml_Modal					= ($vSaldoAwal_Modal + $vDebet_Modal - $vKredit_Modal) * $vFaktor_Modal;

												$SubTotal_Modal 			+=  $jml_Modal;

												$rp_SubTotal_Modal			= number_format($SubTotal_Modal, 0, ',', '.');
										?>
												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_Modal ?></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_Modal ?></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= $rp_jml_Modal		= number_format($jml_Modal, 0, ',', '.'); ?></td>
													<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
											<?php
											}
										}
											?>
												</tr>
												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b></b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b>--------------------</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
												</tr>

												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-right:none; border-bottom-style:none; border-left-style:none;"><b>Sub Total MODAL</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_SubTotal_Modal ?></b></td>
													<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
												</tr>

												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
												</tr>

												<!-- LABA -->
												<tr>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>39</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>LABA</b></td>
													<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
													<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
												</tr>

												<?php
												$SubTotal_Laba = 0;
												$rp_SubTotal_Laba = 0;
												if ($data_Laba > 0) {
													foreach ($data_Laba as $row6) {
														$nokir_Laba				= $row6->no_perkiraan;
														$nm_perkiraan_Laba		= $row6->nama;
														$vFaktor_Laba 			= $row6->faktor;
														$vSaldoAwal_Laba 		= $row6->saldoawal;
														$vDebet_Laba 			= $row6->debet;
														$vKredit_Laba 			= $row6->kredit;

														// $jml_Laba				= ($vDebet_Laba - $vKredit_Laba);
														$jml_Laba			= ($vSaldoAwal_Laba + $vDebet_Laba - $vKredit_Laba) * $vFaktor_Laba;

														$SubTotal_Laba 			+=  $jml_Laba;

														$rp_SubTotal_Laba		= number_format($SubTotal_Laba, 0, ',', '.');
												?>
														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nokir_Laba ?></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nm_perkiraan_Laba ?></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><?= $rp_jml_Laba = number_format($jml_Laba, 0, ',', '.'); ?></td>
															<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
													<?php
													}
												}
													?>
														</tr>
														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b></b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b>--------------------</b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
														</tr>

														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-right:none; border-bottom-style:none; border-left-style:none;"><b>Sub Total LABA</b></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_SubTotal_Laba ?></b></td>
															<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
														</tr>

														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<!-- <td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td> -->
														</tr>

														<tr>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
																<center><b>TOTAL PASSIVA</b></center>
															</td>
															<?php
															$TotalLaba 			= $SubTotal_Hutang + $SubTotal_Modal + $SubTotal_Laba;
															$rp_TotalLaba		= "Rp. " . number_format($TotalLaba, 0, ',', '.');

															?>
															<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_TotalLaba ?></b></td>
														</tr>
							</tbody>
						</table>
					</div>

					<table class="table table-bordered table-hover dataTable example1">
						<tr>
							<td width="9%"></td>
							<td width="29%"></td>
							<td width="10%" align="right">--------------------</td>
							<td></td>

							<td></td>
							<td align="right">--------------------</td>
							<td></td>
						</tr>
						<tr>
							<td width="9%"></td>
							<td width="29%">
								<center><b>TOTAL ASSETS</b></center>
							</td>
							<?php
							$TotalAssets 		= $SubTotal_HartaLancar + $SubTotal_tdkHartaLancar + $SubTotal_AktivaTetap + $SubTotal_AktivaLain;
							$rp_TotalAssets		= number_format($TotalAssets, 0, ',', '.');
							?>
							<td width="10%" align="right"><b><?= $rp_TotalAssets ?></b></td>
							<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>

							<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
								<center><b>TOTAL LIABILITIES AND EQUITY</b></center>
							</td>
							<?php
							$TotalLaba 			= $SubTotal_Hutang + $SubTotal_Modal + $SubTotal_Laba;
							$rp_TotalLaba		= number_format($TotalLaba, 0, ',', '.');

							?>
							<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;" align="right"><b><?= $rp_TotalLaba ?></b></td>
							<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
						</tr>
						<tr>
							<td width="9%"></td>
							<td width="29%"></td>
							<td width="10%" align="right">=============</td>
							<td></td>

							<td></td>
							<td align="right">=============</td>
							<td></td>

						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- </div>
	</div> -->

</section>
<?php $this->load->view('footer'); ?>

<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/moment.min.js"></script>
<script>
	function check() {
		if ($("#bulan_neraca").val() == "0") {
			alert("Silahkan Pilih Bulan");
			return false;
		} else if ($("#tahun_neraca").val() == "0") {
			alert("Silahkan Pilih Tahun");
			return false;
		}
	}
</script>