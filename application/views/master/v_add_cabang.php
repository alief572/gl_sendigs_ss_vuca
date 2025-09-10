<?php
error_reporting(E_ALL & ~E_NOTICE);
?>
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
		<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Form input Cabang</h4>
				</div>
				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?= base_url() . 'index.php/master/proses_add_cabang'; ?>" enctype="multipart/form-data">
						<!-- <form method='post' action="<?= base_url() . 'index.php/Latihan/proses_add_cabang'; ?>" enctype="multipart/form-data"> -->
						<div class="form-group has-success col-lg-6" id="c_user_id">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> No Cabang</label>
							<input type="text" class="form-control" id="nocab" name='nocab' value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_name">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Sub Cabang</label>
							<input type="text" class="form-control" id="subcab" name='subcab' value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_jabatan">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Cabang</label>
							<input type="text" class="form-control" id="cabang" name='cabang' value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_new_password">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Area</label>
							<input type="text" class="form-control" id="area" name='area' value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_new_password">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Kode Cabang</label>
							<input type="text" class="form-control" id="kode" name='kode' value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_new_password">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Alamat</label>
							<input type="text" class="form-control" id="alamat" name='alamat' value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_new_password">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Nama Cabang</label>
							<input type="text" class="form-control" id="nama_cabang" name='nama_cabang' value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_new_password">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Perusahaan</label>
							<input type="text" class="form-control" id="perusahaan" name='perusahaan' value="">
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
<script src="<?= base_url() ?>dist/moment.min.js"></script>
<script type="text/javascript">
	function check() { // updated by Rindra
		if ($("#nocab").val() == '') {
			alert('Silahkan Isi Nomor cabang');
			document.getElementById("nocab").focus();
			return false;
		} else if ($("#subcab").val() == '') {
			alert('Silahkan Isi subcab cabang');
			document.getElementById("subcab").focus();
			return false;
		} else if ($("#cabang").val() == '') {
			alert('Silahkan Isi cabang');
			document.getElementById("cabang").focus();
			return false;
		} else if ($("#area").val() == '') {
			alert('Silahkan isi area');
			document.getElementById("area").focus();
			return false;
		} else if ($("#kode").val() == '') {
			alert('Silahkan isi kode');
			document.getElementById("kode").focus();
			return false;
		} else if ($("#alamat").val() == '') {
			alert('Silahkan isi alamat');
			document.getElementById("alamat").focus();
			return false;
		} else if ($("#nama_cabang").val() == '') {
			alert('Silahkan isi nama_cabang');
			document.getElementById("nama_cabang").focus();
			return false;
		} else if ($("#perusahaan").val() == '') {
			alert('Silahkan isi perusahaan');
			document.getElementById("perusahaan").focus();
			return false;
		}
	}

	// function changeValue(id) {
	// 	$.get("<?= base_url(); ?>index.php/Latihan/cetak_nokir", {
	// 		option: id
	// 	}, function(data) {
	// 		$('#c_user_id').html(data);
	// 	});
	// }
</script>