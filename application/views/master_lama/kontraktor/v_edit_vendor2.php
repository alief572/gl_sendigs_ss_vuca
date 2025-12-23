			<?php
				if($data_vendor > 0){
					foreach($data_vendor as $row1){

			?>
			<form method='post' action="<?=base_url().'index.php/master/proses_edit_vendor';?>">
				<input type='hidden' name='id_ven' value='<?=$idaa?>'>
				<div class="example-modal">
					<div class="modal" id='myModal' style="display:show;">
					  <div class="modal-dialog" style="display:show;">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Edit Supplier</h4>
						  </div>
							<div class="form-group has-success col-lg-6"  id="c_user_id">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Vendor</label>
							  <input type="text" class="form-control" id="nm_vendor" name='nm_vendor' placeholder="Masukan Nama Vendor " value="<?=$row1->nm_vendor?>">
							</div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Pelayanan</label>
							<select class="form-control" id="jenis" name='jenis'>
							<?php
							if($jenis_vendor > 0){
								echo "<option value=''>Pilih Jenis Vendor</option>";
								foreach($jenis_vendor as $row){
									if($row->nm_jenis == $row1->jenis_vendor){
										echo "<option value='".$row->nm_jenis."' selected>".$row->nm_jenis."</option>";
									}else{
										echo "<option value='".$row->nm_jenis."'>".$row->nm_jenis."</option>";
									}
								}
							}
							?>
						  </select>
						  </div>
						  <div class="form-group has-success col-lg-6"  id="c_name">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alamat</label>
							  <input type="text" class="form-control" id="alamat" name='alamat' placeholder="Masukan Alamat " value="<?=$row1->alamat?>">
							</div>
							<div class="form-group has-success col-lg-6"  id="c_name">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Telpon</label>
							  <input type="text" class="form-control" id="telp1" name='telp1' placeholder="Masukan Telfon " value="<?=$row1->telp1?>">
							</div>
							<div class="form-group has-success col-lg-6"  id="c_name">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Telpon 2</label>
							  <input type="text" class="form-control" id="telp2" name='telp2' placeholder="Masukan Telfon " value="<?=$row1->telp2?>">
							</div>
							<div class="form-group has-success col-lg-6"  id="c_name">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email</label>
							  <input type="email" class="form-control" id="email1" name='email1' placeholder="Masukan Email " value="<?=$row1->email1?>">
							</div>
							<div class="form-group has-success col-lg-6"  id="c_name">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email 2</label>
							  <input type="email" class="form-control" id="email2" name='email2' placeholder="Masukan Email" value="<?=$row1->email2?>">
							</div>
							<div class="form-group has-success col-lg-6"  id="c_name">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> PIC</label>
							  <input type="text" class="form-control" id="pic" name='pic' placeholder="Masukan PIC " value="<?=$row1->pic?>">
							</div>
							<div class="form-group has-success col-lg-6"  id="c_name">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Keterangan</label>
							  <textarea class="form-control" id="keterangan" name='keterangan' placeholder="Masukan keterangan"><?=$row1->keterangan?></textarea>
							</div>
							<div class="form-group has-success col-lg-6">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status</label>
							  <select class="form-control" id="sts" name='sts'>
								<?php if($row1->sts == '1'){?>
									<option value='0'>Non-Aktif</option>
									<option value='1' selected>Aktif</option>
								<?php }else{?>
									<option value='0' selected>Non-Aktif</option>
									<option value='1'>Aktif</option>
								<?php }?>
							  </select>
							</div>
						  <div class="modal-footer">
							<input type="submit" class="btn btn-primary pull-right" value="Save" onClick="return check1();">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						  </div>
						</div>
						<!-- /.modal-content -->
					  </div>
					  <!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				  </div>
				  </form>
				<?php }
				}
				?>
				
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