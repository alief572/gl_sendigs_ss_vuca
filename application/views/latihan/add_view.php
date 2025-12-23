<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
		<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Form input COA</h4>
				</div>
				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?= base_url() . 'index.php/Latihan/proses_add_stock'; ?>" enctype="multipart/form-data">
						<div class="form-group has-success col-lg-6" id="c_name">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> No. Perkiraan (Level 4)</label>
							<select type="text" name="project" class="form-control" id="project" onchange="changeValue(this.value)">
								<option value="">-- Pilih Nomor Perkiraan Level 4 --</option>
								<?php
								if ($data_nokir > 0) {
									foreach ($data_nokir as $row_nokir) {
										$nokir = $row_nokir->no_perkiraan;
										$nama = $row_nokir->nama;

										echo "<option value='" . $nokir . "'>" . $nokir . " " . $nama . "</option>";
									}
								}
								?>
							</select>
						</div>

						<div class="form-group has-success col-lg-6" id="c_user_id">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> No.Perkiraan Baru (Level 5)</label>
							<input type="text" class="form-control" id="no_perkiraan" name="no_perkiraan" value="" readonly>
						</div>
						<div class="form-group has-success col-lg-6" id="c_name">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Perkiraan</label>
							<input type="text" class="form-control" id="nama" name='nama' placeholder="Masukan Nama Perkiraan" value="">
						</div>
						<div class="form-group has-success col-lg-6" id="c_name">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kode Cabang</label>
							<input type="text" class="form-control" id="kdcab" name='kdcab' value="<?= $this->session->userdata('kode_cabang') ?>" readonly>
						</div>
						<div class="form-group has-success col-lg-6" id="c_jabatan">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Bulan</label>
							<input type="text" class="form-control" id="bln" name='bln' placeholder="Jumlah barang Bagus" value="<?= $bln_periode ?>" readonly>
						</div>
						<div class="form-group has-success col-lg-6" id="c_new_password">
							<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Tahun</label>
							<input type="text" class="form-control" id="thn" name='thn' value="<?= $thn_periode ?>" readonly>
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