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
					<h3 class="box-title"><?= $judul ?></h3>
					<div class="box-tools">
						<div class="input-group input-group-sm" style="width: 150px;">
							<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-header -->
				<?php
				if ($data_user > 0) {
					foreach ($data_user as $row) {
						$pn_id			= $row->pn_id;
						$pn_name		= $row->pn_name;
						$pn_uname		= $row->pn_uname;
						$pn_pass		= $row->pn_pass;
						$pn_jabatan		= $row->pn_jabatan;
						$pn_wilayah		= $row->pn_wilayah;
						$pn_akses		= $row->pn_akses;
						$marketing		= $row->sts_marketing;
					}
				?>
					<div class="box-body table-responsive no-padding">
						<form method='post' action="<?= base_url() . 'index.php/setup/proses_edit_profile'; ?>">
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> User Id</label>
								<input type="text" class="form-control" id="inputSuccess" name='pn_id' value="<?= $pn_id ?>" readonly>
							</div>
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> User Name</label>
								<input type="text" class="form-control" id="inputSuccess" name='pn_uname' value="<?= $pn_uname ?>" readonly>
							</div>
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama</label>
								<input type="text" class="form-control" id="inputSuccess" name='pn_name' placeholder="Masukan Nama ..." value="<?= $pn_name ?>">
							</div>
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Marketing</label>
								<select name="marketing" class="form-control">
									<?php
									if ($marketing == "N") {
									?>
										<option value="Y">Yes</option>
										<option value="N" selected>No</option>
									<?php
									} else {
									?>
										<option value="Y">Yes</option>
										<option value="N">No</option>
									<?php
									}
									?>
								</select>
								<input type="hidden" class="form-control" id="inputSuccess" name='pn_pass' value="<?= md5($pn_pass) ?>" readonly>
							</div>
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Jabatan (Kewenangan Hak Akses)</label>
								<select class="form-control" id="inputSuccess" name='pn_jabatan'>
									<?php
									foreach ($list_jabatan as $row1) {
										if ($row1->id == $pn_jabatan) {
											echo "<option value='" . $row1->id . "' selected>" . $row1->nm_jabatan . "</option>";
										} else {
											echo "<option value='" . $row1->id . "'>" . $row1->nm_jabatan . "</option>";
										}
									}
									?>
								</select>
							</div>
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Password Baru(Isi jika pasword akan dirubah)</label>
								<input type="password" class="form-control" id="inputSuccess" name='pn_pass_new' value="" placeholder="Enter New Password ...">
							</div>
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Cabang</label>
								<select class="form-control" id="inputSuccess" name='pn_wilayah'>
									<?php
									foreach ($list_cabang as $row2) {
										if ($row2->id == $pn_wilayah) {
											echo "<option value='" . $row2->id . "' selected>" . $row2->nm_cabang . "</option>";
										} else {
											echo "<option value='" . $row2->id . "'>" . $row2->nm_cabang . "</option>";
										}
									}
									?>
								</select>
							</div>
							<div class="form-group has-success col-lg-6">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Akses</label>
								<select class="form-control" id="inputSuccess" name='pn_akses'>
									<?php
									if (1 == $pn_akses) {
										echo "<option value='1' selected>Aktif</option>";
									} else {
										echo "<option value='1'>Aktif</option>";
									}
									if (0 == $pn_akses) {
										echo "<option value='0' selected>Non-Aktif</option>";
									} else {
										echo "<option value='0'>Non-Aktif</option>";
									}
									if (0 == $pn_akses) {
										echo "<option value='0' selected>Resign</option>";
									} else {
										echo "<option value='0'>Resign</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group has-success btn-group col-lg-6"></div>
							<div class="form-group has-success col-lg-6">
								<input type="submit" name="submit" value="Save" class='pull-right btn btn-success'>
								<a href="<?= base_url() . 'index.php/setup/setup_akses' ?>"><button class="pull-right btn btn-default">Cancel</button></a>
							</div>
						<?php } ?>
						</form>
					</div>
					<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
</section>
<?php $this->load->view('footer'); ?>