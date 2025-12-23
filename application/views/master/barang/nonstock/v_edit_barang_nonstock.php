<?php
	if($list_stock > 0){
		foreach($list_stock as $row){
			$nm_barang		= $row->nm_barang;
			$id_cabang		= $row->id_cabang;
			$produk_asal	= $row->produk_asal;
			$detail			= $row->detail;
			$supplier		= $row->id_supplier;
			$harga			= $row->harga;
			$sts			= $row->sts;
			$id				= $row->id;
		}
?>
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Barang non-Stock</h4>
			</div>
				<div class="box-body table-responsive no-padding">
				<form method='post' action="<?=base_url().'index.php/master/proses_edit_nonstock';?>" enctype="multipart/form-data">
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Barang</label>
					  <input type="text" class="form-control" id="nm_barang" name='nm_barang' placeholder="Masukan Nama Barang " value="<?=$nm_barang?>">
					  <input type="hidden" class="form-control" id="id" name='id' placeholder="Masukan Nama Barang " value="<?=$id?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_user_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Supplier</label>
					  <select class="form-control" id="supplier" name='supplier'>
						<?php
							echo "<option value='0'>Pilih Supplier</option>";
							foreach($list_supplier as $row){
								if($supplier == $row->id){
									echo "<option value='".$row->id."+^".$row2->nm_supplier."' selected>".$row->nm_supplier."</option>";
								}else{
									echo "<option value='".$row->id."+^".$row2->nm_supplier."'>".$row->nm_supplier."</option>";
								}
							}
						?>
					  </select>
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Merek</label>
					  <input type="text" class="form-control" id="name" name='asal' placeholder="Masukan Merek" value="<?=$produk_asal?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Detail (maksimal 255 karakter)</label>
					  <input type="text" class="form-control" id="password" name='detail' placeholder="Masukan Detail " value="<?=$detail?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Harga</label>
					  <input type="text" class="form-control" onkeypress="return isNumber(event)" id="password" name='harga' placeholder="Masukan harga " value="<?=$harga?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Cabang</label>
					  <select class="form-control" id="cabang" name='pn_wilayah'>
						<?php
							echo "<option value='0'>Pilih Cabang</option>";
							foreach($list_cabang as $row2){
								if($id_cabang == $row2->id){
									echo "<option value='".$row2->id."+^".$row2->nm_cabang."' selected>".$row2->nm_cabang."</option>";
								}else{
									echo "<option value='".$row2->id."+^".$row2->nm_cabang."'>".$row2->nm_cabang."</option>";
								}
							}
						?>
					  </select>
					</div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status</label>
					  <select class="form-control" id="inputSuccess" name='sts'>
					  <?php 
						if($sts==1){
					  ?>
						<option value='0'>Non-Aktif</option>
						<option value='1' selected>Aktif</option>
						<?php
						}else{
						?>
						<option value='0' selected>Non-Aktif</option>
						<option value='1'>Aktif</option>
						<?php }?>
					  </select>
					</div>
					<div class="form-group has-success col-lg-6">
						<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Upload Gambar</label>
						 <input type="file" class="form-control" name='filefoto'>
					</div>
					<div class="form-group has-success col-lg-6">
						<label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Gambar</label><br>
						<img src="<?=base_url()?>gambar_barang/<?=$id?>.jpg" width="100">
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
<?php } ?>
			<script>
			function check(){
				if($("#nm_barang").val() == ''){
					alert('Masukan nama barang');
					document.getElementById("nm_barang").focus();
					return false;
				}else if($("#supplier").val() == '0'){
					alert('Pillih Supplier');
					document.getElementById("supplier").focus();
					return false;
				} else if($("#cabang").val() == '0'){
					alert('pilih Cabang');
					document.getElementById("cabang").focus();
					return false;
				}
			}
			
			function isNumber(evt) {
				evt = (evt) ? evt : window.event;
				var charCode = (evt.which) ? evt.which : evt.keyCode;
				if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
				}
				return true;
			}
			</script>