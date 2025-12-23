			<form action="<?=base_url()?>index.php/master/proses_add_supplier" method='post'>
				<div class="example-modal">
					<div class="modal" id='myModal' style="display:show;">
					  <div class="modal-dialog" style="display:show;">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Add Supplier</h4>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Supplier</label>
							<input type="text" class="form-control" id="nm_sup" name='nm_sup' placeholder="Masukan nama supplier " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> PIC</label>
							<input type="text" class="form-control" id="pic" name='pic' placeholder="Masukan nama pic " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alamat</label>
							<input type="text" class="form-control" id="alamat" name='alamat' placeholder="Masukan alamat " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Perusahaan</label>
							<input type="text" class="form-control" id="perusahaan" name='perusahaan' placeholder="Masukan perusahaan " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Pelayanan</label>
							<select name='pelayanan' class="form-control">
								<?php
								echo "<option value='bagus'>Bagus</option>";
								echo "<option value='biasa'>Biasa</option>";
								echo "<option value='buruk'>Buruk</option>";
								?>
							</select>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Telpon</label>
							<input type="text" class="form-control" id="telf1" name='telf1' placeholder="Masukan nomor telfon " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Telpon 2</label>
							<input type="text" class="form-control" id="telf2" name='telf2' placeholder="Masukan nomor telfon 2 " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Telpon 3</label>
							<input type="text" class="form-control" id="telf3" name='telf3' placeholder="Masukan nomor telfon 3 " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email</label>
							<input type="text" class="form-control" id="email" name='email' placeholder="Masukan email " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email2</label>
							<input type="text" class="form-control" id="email2" name='email2' placeholder="Masukan email 2 " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Lama Pengiriman (hari)</label>
							<input type="text" class="form-control" id="lama" name='lama' placeholder="Masukan lama pengiriman dalam hari " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Jenis Pengiriman</label>
							<input type="text" class="form-control" id="lama2" name='lama2' placeholder="Masukan jenis pengiriman " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Catatan</label>
							<textarea name="catatan" class="form-control">
							</textarea>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status supplier</label>
						  <select name='sts_sup' class="form-control">
							<option value="1"> Aktif</option>
							<option value="0"> Non-Aktif</option>
						  </select>
						  </div>
						  <div class="modal-footer">
							<input type="submit" class="btn btn-primary pull-right" value="Save" onClick="return check();">
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
				  
				<script>
				function check(){
					if($("#nm_sup").val() == ''){
						alert('Silahkan isi nama supplier');
						document.getElementById("nm_sup").focus();
						return false;
					}else if($("#pic").val() == ''){
						alert('Silahkan isi pic');
						document.getElementById("pic").focus();
						return false;
					}else if($("#alamat").val() == ''){
						alert('Silahkan isi alamat');
						document.getElementById("alamat").focus();
						return false;
					}else if($("#telf1").val() == ''){
						alert('Silahkan isi nomor telfon');
						document.getElementById("telf1").focus();
						return false;
					}
				}
				</script>