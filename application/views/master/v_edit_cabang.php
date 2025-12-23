<?php
if ($data_cabang > 0) {
	foreach ($data_cabang as $row) {
		$id		= $row->id;
		$nocab		= $row->nocab;
		$subcab		= $row->subcab;
		$cabang	= $row->cabang;
		$area	= $row->area;
		$kdcab		= $row->kdcab;
		$alamat			= $row->alamat;
		$namacabang			= $row->namacabang;
		$perusahaan			= $row->perusahaan;
	}
?>
	<div class="example-modal">
		<div class="modal" id='myModal' style="display:show;">
			<div class="modal-dialog" style="display:show;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Form edit Cabang</h4>
					</div>
					<div class="box-body table-responsive no-padding">
						<form method='post' action="<?= base_url() . 'index.php/master/proses_edit_cabang'; ?>" enctype="multipart/form-data">
							<div class="form-group has-success col-lg-6" id="c_user_id">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> No Cabang</label>
								<input type="text" class="form-control" id="nocab" name='nocab' value="<?= $nocab ?>" maxlength="3">
							</div>
							<!-- hidden -->
							<div class="form-group has-success col-lg-6" id="no_cab" style="display:none">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> id</label>
								<input type="text" class="form-control" id="id" name='id' value="<?= $id ?>">
							</div>
							<div class="form-group has-success col-lg-6" id="c_name">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Sub Cabang</label>
								<input type="text" class="form-control" id="subcab" name='subcab' value="<?= $subcab ?>" maxlength="1">
							</div>
							<div class="form-group has-success col-lg-6" id="c_jabatan">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Cabang</label>
								<input type="text" class="form-control" id="cabang" name='cabang' value="<?= $cabang ?>">
							</div>
							<div class="form-group has-success col-lg-6" id="c_new_password">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Area</label>
								<input type="text" class="form-control" id="area" name='area' value="<?= $area ?>" maxlength="1">
							</div>
							<div class="form-group has-success col-lg-6" id="c_new_password">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Kode Cabang</label>
								<input type="text" class="form-control" id="kode" name='kode' value="<?= $kdcab ?>" maxlength="3">
							</div>
							<div class="form-group has-success col-lg-6" id="c_new_password">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Alamat</label>
								<input type="text" class="form-control" id="alamat" name='alamat' value="<?= $alamat ?>">
							</div>
							<div class="form-group has-success col-lg-6" id="c_new_password">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Nama Cabang</label>
								<input type="text" class="form-control" id="nama_cabang" name='nama_cabang' value="<?= $namacabang ?>">
							</div>
							<div class="form-group has-success col-lg-6" id="c_new_password">
								<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Perusahaan</label>
								<input type="text" class="form-control" id="perusahaan" name='perusahaan' value="<?= $perusahaan ?>">
							</div>

							<div class="form-group has-success btn-group col-lg-6"></div>
							<div class="form-group has-success col-lg-6" id="c_">
								<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onclick="return check()">
							</div>
						</form>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<script src="<?= base_url() ?>dist/moment.min.js"></script>
<script type="text/javascript">
	function check() { // updated by Rindra
		if ($("#no_perkiraan").val() == '') {
			alert('Silahkan Isi No Perkiraan');
			document.getElementById("no_perkiraan").focus();
			return false;
		} else if ($("#nama").val() == '') {
			alert('Silahkan Isi Nama Perkiraan');
			document.getElementById("nama").focus();
			return false;
		} else if ($("#kdcab").val() == '') {
			alert('Silahkan Pilih Kode Cabang');
			document.getElementById("kdcab").focus();
			return false;
		}
	}

	function changeValue(id) {
		$.get("<?= base_url(); ?>index.php/Latihan/cetak_nokir", {
			option: id
		}, function(data) {
			$('#c_user_id').html(data);
		});
	}
</script>