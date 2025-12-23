<?php $this->load->view('header');
error_reporting('E_ALL & ~E_NOTICE');
?>

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
	<!-- <div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<form method="post" action="<?= base_url() ?>index.php/konsolidasi/performance" autocomplete="off">
					<table class="table table-bordered">
						<tr bgcolor='#DCDCDC'>
							<td width="15%" align="right"><b>Bulan</b></td>
							<td>
								<select type="text" name="bulan_performance" class="form-control">
									<?php
									$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bulan = @$this->input->post('bulan_performance');
									if (empty($bulan)) {
										$bulan = $bln_aktif;
										// $bulan = date("m") + 0;
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

						<tr bgcolor='#DCDCDC'>
							<td width="15%" align="right"><b>Tahun</b></td>
							<td>

								<select type="text" name="tahun_performance" class="form-control">
									<?php
									$tahun = @$this->input->post('tahun_performance');
									if (empty($tahun)) {
										$tahun = $thn_aktif;
										// $tahun = date("Y") + 0;
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
						<tr bgcolor='#DCDCDC'>
							<td width="15%" align="right"></td>
							<td width="25%" align="left">
								<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center">
								<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn btn-success pull-center">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div> -->

	<div class="box box-primary">
		<div class="myDiv">
			<form method="post" action="<?= base_url() ?>index.php/konsolidasi/performance" autocomplete="off">
				<div class="row">
					<div class="col-sm-10">
						<div class="col-sm-2">
							<div class="form-group">
								<br>
								<label>Bulan</label>
								<select type="text" name="bulan_performance" class="form-control">
									<?php
									$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bulan = @$this->input->post('bulan_performance');
									if (empty($bulan)) {
										$bulan = $bln_aktif;
										// $bulan = date("m") + 0;
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
								<select type="text" name="tahun_performance" class="form-control">
									<?php
									$tahun = @$this->input->post('tahun_performance');
									if (empty($tahun)) {
										$tahun = $thn_aktif;
										// $tahun = date("Y") + 0;
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
								<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn warnaTombolExcel pull-center"> &nbsp;
								<!-- <input type="submit" name="tampilkan" value="View Pdf" onclick="return check()" class="btn warnaTombolPdf pull-center"> -->
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
					<table class="table table-bordered">
						<thead>
							<tr bgcolor='#0073B7'>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>CABANG</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>OMZET</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>HPP</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>BIAYA PENJUALAN</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>UMUM</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>PENDAPATAN LAIN</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>BIAYA LAIN</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>LABA</center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_omzet			= 0;
							$total_hpp				= 0;
							$total_penjualan		= 0;
							$total_umum				= 0;
							$total_pendapatan_lain	= 0;
							$total_laba				= 0;

							$omzet				= 0;
							$hpp				= 0;
							$penjualan			= 0;
							$umum				= 0;
							$pendapatan_lain	= 0;
							$laba				= 0;

							if ($data_coa > 0) {
								foreach ($data_coa as $r_coa) {
									$kdcab			= $r_coa->kdcab; // 202-A
									$nocab			= substr($kdcab, 0, 3); // 202
									$subcab			= substr($kdcab, 4, 1); // A

									$data_cabang	= $this->db->query("SELECT * FROM pastibisa_tb_cabang WHERE nocab='$nocab' AND subcab='$subcab'")->result();

									if ($data_cabang > 0) {
										foreach ($data_cabang as $r_cbg) {
											$cabang	= $r_cbg->cabang;
										}
									}

									$data_coa_4	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '4%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

									if ($data_coa_4 > 0) {
										foreach ($data_coa_4 as $r_coa_4) {
											$saldoawal_4	= $r_coa_4->saldoawal;
											$debet_4		= $r_coa_4->debet;
											$kredit_4		= $r_coa_4->kredit;
											$faktor_4		= $r_coa_4->faktor;
											// $omzet			= ($saldoawal_4 + $debet_4 - $kredit_4) * $faktor_4;
											$omzet			= ($debet_4 - $kredit_4) * $faktor_4;
											$total_omzet 	+=	$omzet;

											$data_coa_5	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '5%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

											if ($data_coa_5 > 0) {
												foreach ($data_coa_5 as $r_coa_5) {
													$saldoawal_5	= $r_coa_5->saldoawal;
													$debet_5		= $r_coa_5->debet;
													$kredit_5		= $r_coa_5->kredit;
													$faktor_5		= $r_coa_5->faktor;
													// $hpp			= ($saldoawal_5 + $debet_5 - $kredit_5) * $faktor_5;
													$hpp			= ($debet_5 - $kredit_5) * $faktor_5;
													$total_hpp 		+=	$hpp;

													$data_coa_612	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '61%' OR no_perkiraan like '62%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

													if ($data_coa_612 > 0) {
														foreach ($data_coa_612 as $r_coa_612) {
															$saldoawal_612	= $r_coa_612->saldoawal;
															$debet_612		= $r_coa_612->debet;
															$kredit_612		= $r_coa_612->kredit;
															$faktor_612		= $r_coa_612->faktor;
															// $penjualan		= ($saldoawal_612 + $debet_612 - $kredit_612) * $faktor_612;
															$penjualan		= ($debet_612 - $kredit_612) * $faktor_612;
															$total_penjualan +=	$penjualan;

															$data_coa_63456789	= $this->db->query("SELECT sum(saldoawal) as saldoawal, sum(debet) as debet,sum(kredit) as kredit,faktor FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '63%' OR no_perkiraan like '64%' OR no_perkiraan like '65%' OR no_perkiraan like '66%' OR no_perkiraan like '67%' OR no_perkiraan like '68%' OR no_perkiraan like '69%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

															if ($data_coa_63456789 > 0) {
																foreach ($data_coa_63456789 as $r_coa_63456789) {
																	$saldoawal_63456789	= $r_coa_63456789->saldoawal;
																	$debet_63456789		= $r_coa_63456789->debet;
																	$kredit_63456789	= $r_coa_63456789->kredit;
																	$faktor_63456789	= $r_coa_63456789->faktor;
																	$umum				= ($debet_63456789 - $kredit_63456789) * $faktor_63456789;
																	$total_umum 		+=	$umum;

																	$data_coa_71	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '71%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

																	if ($data_coa_71 > 0) {
																		foreach ($data_coa_71 as $r_coa_71) {
																			$saldoawal_71			= $r_coa_71->saldoawal;
																			$debet_71				= $r_coa_71->debet;
																			$kredit_71				= $r_coa_71->kredit;
																			$faktor_71				= $r_coa_71->faktor;
																			// $pendapatan_lain		= ($saldoawal_71 + $debet_71 - $kredit_71) * $faktor_71;
																			$pendapatan_lain		= ($debet_71 - $kredit_71) * $faktor_71;
																			$total_pendapatan_lain 	+=	$pendapatan_lain;

																			$data_coa_72	= $this->db->query("SELECT sum(saldoawal) as saldoawal, sum(debet) as debet,sum(kredit) as kredit,faktor FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '72%' or no_perkiraan like '91%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

																			if ($data_coa_72 > 0) {
																				foreach ($data_coa_72 as $r_coa_72) {
																					$saldoawal_72			= $r_coa_72->saldoawal;
																					$debet_72				= $r_coa_72->debet;
																					$kredit_72				= $r_coa_72->kredit;
																					$faktor_72				= $r_coa_72->faktor;
																					// $pendapatan_lain		= ($saldoawal_72 + $debet_72 - $kredit_72) * $faktor_72;
																					$biaya_lain		= ($debet_72 - $kredit_72) * $faktor_72;
																					$total_biaya_lain 	+=	$biaya_lain; { {
																							/*
																				$data_coa_39	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '39%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

																				if ($data_coa_39 > 0) {
																					foreach ($data_coa_39 as $r_coa_39) {
																						$saldoawal_39			= $r_coa_39->saldoawal;
																						$debet_39				= $r_coa_39->debet;
																						$kredit_39				= $r_coa_39->kredit;
																						$faktor_39				= $r_coa_39->faktor;
																						$laba					= $omzet - $hpp - $penjualan + $pendapatan_lain;
																						$total_laba 			+=	$laba;
                                                                                    */
							?>
																							<?php $laba = $omzet - $hpp - $penjualan - $umum + $pendapatan_lain - $biaya_lain; ?>
																							<tr>
																								<td><?= $cabang ?></td>
																								<td align="right"><?= number_format($omzet, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($hpp, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($penjualan, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($umum, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($pendapatan_lain, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($biaya_lain, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($laba, 0, ',', '.') ?></td>
																							</tr>
							<?php $total_laba += $laba;
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
							/* else{
									echo "<td><?=$cabang?></td>";
									echo "<td align='right'><?=number_format($omzet,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($hpp,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($penjualan,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($umum,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($pendapatan_lain,0,',','.')?></td>";
									echo "<td align='right'></td>";
									echo "<td align='right'></td>";
								} */
							?>
							<tr>
								<td align="right"><b>TOTAL</b></td>
								<td align="right"><?= number_format($total_omzet, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_hpp, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_penjualan, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_umum, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_pendapatan_lain, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_biaya_lain, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_laba, 0, ',', '.') ?></td>

							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


YEAR TO DATE
	<div class="box">
		<div class="row">
			<div class="box-header">
				<div class="box-body">
					<table class="table table-bordered">
						<thead>
							<tr bgcolor='#0073B7'>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>CABANG</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>OMZET</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>HPP</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>BIAYA PENJUALAN</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>UMUM</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>PENDAPATAN LAIN</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>BIAYA LAIN</center>
								</th>
								<th class="teksPutih" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">
									<center>LABA</center>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total_omzet			= 0;
							$total_hpp				= 0;
							$total_penjualan		= 0;
							$total_umum				= 0;
							$total_pendapatan_lain	= 0;
							$total_laba				= 0;

							$omzet				= 0;
							$hpp				= 0;
							$penjualan			= 0;
							$umum				= 0;
							$pendapatan_lain	= 0;
							$laba				= 0;

							if ($data_coa > 0) {
								foreach ($data_coa as $r_coa) {
									$kdcab			= $r_coa->kdcab; // 202-A
									$nocab			= substr($kdcab, 0, 3); // 202
									$subcab			= substr($kdcab, 4, 1); // A

									$data_cabang	= $this->db->query("SELECT * FROM pastibisa_tb_cabang WHERE nocab='$nocab' AND subcab='$subcab'")->result();

									if ($data_cabang > 0) {
										foreach ($data_cabang as $r_cbg) {
											$cabang	= $r_cbg->cabang;
										}
									}

									$data_coa_4	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '4%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

									if ($data_coa_4 > 0) {
										foreach ($data_coa_4 as $r_coa_4) {
											$saldoawal_4	= $r_coa_4->saldoawal;
											$debet_4		= $r_coa_4->debet;
											$kredit_4		= $r_coa_4->kredit;
											$faktor_4		= $r_coa_4->faktor;
											// $omzet			= ($saldoawal_4 + $debet_4 - $kredit_4) * $faktor_4;
											$omzet			= ($saldoawal_4 + $debet_4 - $kredit_4) * $faktor_4;
											$total_omzet 	+=	$omzet;

											$data_coa_5	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '5%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

											if ($data_coa_5 > 0) {
												foreach ($data_coa_5 as $r_coa_5) {
													$saldoawal_5	= $r_coa_5->saldoawal;
													$debet_5		= $r_coa_5->debet;
													$kredit_5		= $r_coa_5->kredit;
													$faktor_5		= $r_coa_5->faktor;
													$hpp			= ($saldoawal_5 + $debet_5 - $kredit_5) * $faktor_5;
													$total_hpp 		+=	$hpp;

													$data_coa_612	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '61%' OR no_perkiraan like '62%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

													if ($data_coa_612 > 0) {
														foreach ($data_coa_612 as $r_coa_612) {
															$saldoawal_612	= $r_coa_612->saldoawal;
															$debet_612		= $r_coa_612->debet;
															$kredit_612		= $r_coa_612->kredit;
															$faktor_612		= $r_coa_612->faktor;
															// $penjualan		= ($saldoawal_612 + $debet_612 - $kredit_612) * $faktor_612;
															$penjualan		= ($saldoawal_612 + $debet_612 - $kredit_612) * $faktor_612;
															$total_penjualan +=	$penjualan;

															$data_coa_63456789	= $this->db->query("SELECT sum(saldoawal) as saldoawal, sum(debet) as debet,sum(kredit) as kredit,faktor FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '63%' OR no_perkiraan like '64%' OR no_perkiraan like '65%' OR no_perkiraan like '66%' OR no_perkiraan like '67%' OR no_perkiraan like '68%' OR no_perkiraan like '69%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

															if ($data_coa_63456789 > 0) {
																foreach ($data_coa_63456789 as $r_coa_63456789) {
																	$saldoawal_63456789	= $r_coa_63456789->saldoawal;
																	$debet_63456789		= $r_coa_63456789->debet;
																	$kredit_63456789	= $r_coa_63456789->kredit;
																	$faktor_63456789	= $r_coa_63456789->faktor;
																	$umum				= ($saldoawal_63456789 + $debet_63456789 - $kredit_63456789) * $faktor_63456789;
																	$total_umum 		+=	$umum;

																	$data_coa_71	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '71%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

																	if ($data_coa_71 > 0) {
																		foreach ($data_coa_71 as $r_coa_71) {
																			$saldoawal_71			= $r_coa_71->saldoawal;
																			$debet_71				= $r_coa_71->debet;
																			$kredit_71				= $r_coa_71->kredit;
																			$faktor_71				= $r_coa_71->faktor;
																			// $pendapatan_lain		= ($saldoawal_71 + $debet_71 - $kredit_71) * $faktor_71;
																			$pendapatan_lain		= ($saldoawal_71 + $debet_71 - $kredit_71) * $faktor_71;
																			$total_pendapatan_lain 	+=	$pendapatan_lain;

																			$data_coa_72	= $this->db->query("SELECT sum(saldoawal) as saldoawal, sum(debet) as debet,sum(kredit) as kredit,faktor FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and (no_perkiraan like '72%' or no_perkiraan like '91%') and level='3' and kdcab='$kdcab' group by kdcab ")->result();

																			if ($data_coa_72 > 0) {
																				foreach ($data_coa_72 as $r_coa_72) {
																					$saldoawal_72			= $r_coa_72->saldoawal;
																					$debet_72				= $r_coa_72->debet;
																					$kredit_72				= $r_coa_72->kredit;
																					$faktor_72				= $r_coa_72->faktor;
																					// $pendapatan_lain		= ($saldoawal_72 + $debet_72 - $kredit_72) * $faktor_72;
																					$biaya_lain		= ($saldoawal_72 + $debet_72 - $kredit_72) * $faktor_72;
																					$total_biaya_lain 	+=	$biaya_lain; { {
																							/*
																				$data_coa_39	= $this->db->query("SELECT * FROM coa where bln='$data_bulan_post' and thn='$data_tahun_post' and no_perkiraan like '39%' and level='3' and kdcab='$kdcab' group by kdcab ")->result();

																				if ($data_coa_39 > 0) {
																					foreach ($data_coa_39 as $r_coa_39) {
																						$saldoawal_39			= $r_coa_39->saldoawal;
																						$debet_39				= $r_coa_39->debet;
																						$kredit_39				= $r_coa_39->kredit;
																						$faktor_39				= $r_coa_39->faktor;
																						$laba					= $omzet - $hpp - $penjualan + $pendapatan_lain;
																						$total_laba 			+=	$laba;
                                                                                    */
							?>
																							<?php $laba = $omzet - $hpp - $penjualan - $umum + $pendapatan_lain - $biaya_lain; ?>
																							<tr>
																								<td><?= $cabang ?></td>
																								<td align="right"><?= number_format($omzet, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($hpp, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($penjualan, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($umum, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($pendapatan_lain, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($biaya_lain, 0, ',', '.') ?></td>
																								<td align="right"><?= number_format($laba, 0, ',', '.') ?></td>
																							</tr>
							<?php $total_laba += $laba;
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
							/* else{
									echo "<td><?=$cabang?></td>";
									echo "<td align='right'><?=number_format($omzet,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($hpp,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($penjualan,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($umum,0,',','.')?></td>";
									echo "<td align='right'><?=number_format($pendapatan_lain,0,',','.')?></td>";
									echo "<td align='right'></td>";
									echo "<td align='right'></td>";
								} */
							?>
							<tr>
								<td align="right"><b>TOTAL YTD</b></td>
								<td align="right"><?= number_format($total_omzet, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_hpp, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_penjualan, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_umum, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_pendapatan_lain, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_biaya_lain, 0, ',', '.') ?></td>
								<td align="right"><?= number_format($total_laba, 0, ',', '.') ?></td>

							</tr>
						</tbody>
					</table>
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