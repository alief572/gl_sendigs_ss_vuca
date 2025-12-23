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
					</div>
					<div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
							<thead>
								<tr>
									<th>Level 3</th>
								</tr>

								<tr>

									<td>NO. COA</td>
									<td>Keterangan</td>
									<td>Saldo AWal</td>
									<td>Debet</td>
									<td>Kredit</td>
									<td>Saldo Akhir</td>
									<td></td>

								</tr>
								<?php
								if ($list_lev3 > 0) {
									foreach ($list_lev3 as $row) {

										$nokir = $row->no_perkiraan;
										$sa = $row->saldoawal;
										$debet = $row->debet;
										$kredit = $row->kredit;
										$sakhir = $sa + $debet - $kredit;
								?>
										<tr>

											<td><?= $nokir ?></td>
											<td><?= $row->nama ?></td>
											<td align="right"><?= number_format($sa, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($sakhir, 0, ',', '.'); ?></td>
											<td></td>

									<?php
									}
								}
									?>
										</tr>

							</thead>
							<thead>

								<tr>
									<th>Level 4</th>
								</tr>
								<tr>
									<td>NO. COA</td>
									<td>Keterangan</td>
									<td>Saldo AWal</td>
									<td>Debet</td>
									<td>Kredit</td>
									<td>Saldo Akhir</td>
									<td></td>
								</tr>
								<?php
								if ($list_lev4 > 0) {
									foreach ($list_lev4 as $row1) {

										$nokir1 = $row1->no_perkiraan;
										$sa1 = $row1->saldoawal;
										$debet1  = $row1->debet;
										$kredit1 = $row1->kredit;
										$sakhir1 = $sa1 + $debet1 - $kredit1;
								?>
										<tr>

											<td><?= $nokir1 ?></td>
											<td><?= $row1->nama ?></td>
											<td align="right"><?= number_format($sa1, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($debet1, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($kredit1, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($sakhir1, 0, ',', '.'); ?></td>
											<td></td>
									<?php
									}
								}
									?>
										</tr>
										<tr>
											<th>Level 5</th>
										</tr>
										<tr>
											<td>NO. COA</td>
											<td>Keterangan</td>
											<td>Saldo AWal</td>
											<td>Debet</td>
											<td>Kredit</td>
											<td>Saldo Akhir</td>
											<td>Aksi</td>
										</tr>
										<?php
										if ($list_lev5 > 0) {
											foreach ($list_lev5 as $row2) {

												$nokir2 = $row2->no_perkiraan;
												$sa2 = $row2->saldoawal;
												$debet2  = $row2->debet;
												$kredit2 = $row2->kredit;
												$sakhir2 = $sa2 + $debet2 - $kredit2;

										?>
												<tr>

													<td><?= $nokir2 ?></td>
													<td><?= $row2->nama ?></td>
													<td align="right"><?= number_format($sa2, 0, ',', '.'); ?></td>
													<td align="right" width="12%"><?= number_format($debet2, 0, ',', '.'); ?></td>
													<td align="right" width="12%"><?= number_format($kredit2, 0, ',', '.'); ?></td>
													<td align="right" width="12%"><?= number_format($sakhir2, 0, ',', '.'); ?></td>
													<td><a href="<?= base_url() ?>index.php/Latihan/detail_jurnal/<?= $row2->id ?>/<?= $row2->no_perkiraan ?>" title="" target="blank" class="btn btn-info" width="20%"><i>View Detail</i></a></td>
											<?php
											}
										}
											?>
												</tr>

							</thead>

							<tbody>


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
</script>