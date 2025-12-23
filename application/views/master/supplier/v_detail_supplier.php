			<?php
				if($detail_supplier > 0){
					foreach($detail_supplier as $row){
						$id					= $row->id;
						$nm_supplier		= $row->nm_supplier;
						$pic				= $row->pic;
						$alamat				= $row->alamat;
						$perusahaan			= $row->perusahaan;
						$pelayanan			= $row->pelayanan;
						$nomor_telfon		= $row->nomor_telfon;
						$nomor_telfon2		= $row->nomor_telfon2;
						$nomor_telfon3		= $row->nomor_telfon3;
						$email				= $row->email;
						$email2				= $row->email2;
						$sts				= $row->sts;
						$lama_pengiriman	= $row->lama_pengiriman;
						$jenis_pengiriman	= $row->jenis_pengiriman;
						$catatan			= $row->catatan;
					}
			?>
				<div class="example-modal">
					<div class="modal" id='myModal' style="display:show;">
					  <div class="modal-dialog" style="display:show;">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Detail Supplier</h4>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Supplier</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$nm_supplier?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> PIC</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$pic?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alamat</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$alamat?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Perusahaan</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$perusahaan?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Pelayanan</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$pelayanan?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Telpon</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$nomor_telfon?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Telpon 2</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$nomor_telfon2?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Telpon 3</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$nomor_telfon3?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$email?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email2</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$email2?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Lama Pengiriman (hari)</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$lama_pengiriman?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Jenis Pengiriman</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="<?=$jenis_pengiriman?>">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Catatan</label>
							<textarea name="" class="form-control"><?=$catatan?>
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
						  </div>
						</div>
						<!-- /.modal-content -->
					  </div>
					  <!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				  </div>
				<?php }?>