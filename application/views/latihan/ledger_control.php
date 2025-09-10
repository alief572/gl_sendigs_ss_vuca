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
					<div class="box-body">
						<form action="<?= base_url() ?>index.php/Latihan/list_ledger_control_level" method="post">

							<div class="col-xs-2">
								<select type="text" name="level" class="form-control" onchange="this.form.submit()">
									<option value=""> -- Pilih Level --</option>
									<?php
									$nm_level = array(All, 'Level 1', 'Level 2', 'Level 3', 'Level 4', 'Level 5');
									$levels        =  $this->input->post('level');

									for ($i = 0; $i <= 5; $i++) {
										if ($i == $levels) {
											echo "<option selected value='$i'>" . $nm_level[$i] . "</option>";
										} else {
											echo "<option value='$i'>" . $nm_level[$i] . "</option>";
										}
									}
									?>
								</select>
								&nbsp;&nbsp;&nbsp;

							</div>
							
							<input type="submit" name="tampilkan" value="View Excel" class="btn btn-success pull-center">
					
						</form>
						<!--<a href="<?= base_url() ?>index.php/Latihan/excel_ledger_control/" title="Print Semua Item" target="blank" class="btn btn-info" width="">EXPORT TO EXCEL<i class=""></i></a>-->
					</div>
					<div>
					</div>

					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
							<thead>
								<tr>


									<th>No perkiraan</th>
									<th>nama</th>
									<th>Saldo Awal</th>
									<th>Debet</th>
									<th>Kredit</th>
									<th>Saldo Akhir</th>
								</tr>

							</thead>
							<tbody>
								<?php
								$i = 0;
								if ($data_ledgr_cont > 0) {
									foreach ($data_ledgr_cont as $row_c) {
										$i++;
										$nokir = $row_c->no_perkiraan;
										$sa = $row_c->saldoawal;
										$debet = $row_c->debet;
										$kredit = $row_c->kredit;
										$saldoakhir = $row_c->saldoakhir;
										//	$saakhir=$sa+$debet-$kredit;								
										//	$data_nokir_biaya=$this->db->query("SELECT * FROM jurnal WHERE tipe='BUK' and nomor='$id_buk' and no_perkiraan like '6%'")->result();
								?>


										<tr>

											<td><?= $row_c->no_perkiraan ?></td>
											<td><?= $row_c->nama ?></td>
											<td align="right" width="12%"><?= number_format($sa, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>
											<td align="right" width="12%"><?= number_format($saldoakhir, 0, ',', '.'); ?></td>
									<?php
									}
								}
									?>
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
</script>