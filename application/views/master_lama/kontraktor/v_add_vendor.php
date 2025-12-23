<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Vendor</h4>
			</div>
				<div class="box-body table-responsive no-padding">
				<form method='post' action="<?=base_url().'index.php/master/proses_add_vendor';?>">
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Vendor</label>
					  <input type="text" class="form-control" id="nm_vendor" name='nm_vendor' placeholder="Masukan Nama Vendor " value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_user_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Jenis Vendor</label>
					  <select class="form-control" id="jenis" name='jenis'>
						<?php
						if($jenis_vendor > 0){
							echo "<option value=''>Pilih Jenis Vendor</option>";
							foreach($jenis_vendor as $row){
								echo "<option value='".$row->nm_jenis."'>".$row->nm_jenis."</option>";
							}
						}
						?>
					  </select>
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alamat</label>
					  <input type="text" class="form-control" id="alamat" name='alamat' placeholder="Masukan Alamat " value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Telpon</label>
					  <input type="text" class="form-control" id="telp1" name='telp1' placeholder="Masukan Telpon " value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Telpon 2</label>
					  <input type="text" class="form-control" id="telp2" name='telp2' placeholder="Masukan Telpon " value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email</label>
					  <input type="email" class="form-control" id="email1" name='email1' placeholder="Masukan Email " value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email 2</label>
					  <input type="email" class="form-control" id="email2" name='email2' placeholder="Masukan Email" value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> PIC</label>
					  <input type="text" class="form-control" id="pic" name='pic' placeholder="Masukan PIC " value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Keterangan</label>
					  <textarea class="form-control" id="keterangan" name='keterangan' placeholder="Masukan keterangan"></textarea>
					</div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status</label>
					  <select class="form-control" id="sts" name='sts'>
						<option value='0'>Non-Aktif</option>
						<option value='1' selected>Aktif</option>
					  </select>
					</div>
					<div class="form-group has-success btn-group col-lg-6"></div>
						<div class="form-group has-success col-lg-6"  id="c_">
						<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onClick="return check();">
					</div>
				</form>	
				<!-- /.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>
			<script>
			function check(){
				if($("#nm_vendor").val() == ''){
					alert('Masukan nama vendor');
					document.getElementById("nm_vendor").focus();
					return false;
				}else if($("#jenis").val() == ''){
					alert('Pillih jenis vendor');
					document.getElementById("jenis").focus();
					return false;
				}else if($("#telp1").val() == ''){
					alert('Masukan nomor telfon');
					document.getElementById("telp1").focus();
					return false;
				}else if($("#email1").val() == ''){
					alert('Masukan Email');
					document.getElementById("email1").focus();
					return false;
				}
			}
			</script>