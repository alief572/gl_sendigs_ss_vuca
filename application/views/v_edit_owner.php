<?php
	if($detail_owner > 0){
		foreach($detail_owner as $row){
		
		
	
?>
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Owner</h4>
			</div>
				<div class="box-body table-responsive no-padding">
				<form method='post' action="<?=base_url().'index.php/master/proses_edit_owner';?>" enctype="multipart/form-data">
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama</label>
					  <input type="text" class="form-control" id="nama" name='nama' placeholder="Masukan Nama Barang" value="<?=$row->nama?>">
					  <input type="hidden" class="form-control" id="id" name='id' value="<?=$row->id?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alamat</label>
					  <input type="text" class="form-control"  id="alamat" name='alamat' placeholder="Masukan Merek" value="<?=$row->alamat?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Telpon</label>
					  <input type="text" class="form-control"  id="telfon" name='telfon' placeholder="Masukan Merek" value="<?=$row->no_telfon?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Email</label>
					  <input type="text" class="form-control"  id="email" name='email' placeholder="Masukan Merek" value="<?=$row->email1?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kecamatan</label>
					  <input type="text" class="form-control"  id="kecamatan" name='kecamatan' placeholder="Masukan Merek" value="<?=$row->kota?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kota</label>
					  <input type="text" class="form-control"  id="kota" name='kota' placeholder="Masukan Merek" value="<?=$row->kecamatan?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Provinsi</label>
					  <input type="text" class="form-control"  id="provinsi" name='provinsi' placeholder="Masukan Merek" value="<?=$row->provinsi?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Bank</label>
					  <input type="text" class="form-control"  id="bank" name='bank' placeholder="Masukan Merek" value="<?=$row->nm_bank?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Cabang Bank</label>
					  <input type="text" class="form-control"  id="cabang" name='cabang' placeholder="Masukan Merek" value="<?=$row->cab_bank?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Rekening Bank</label>
					  <input type="text" class="form-control"  id="norek" name='norek' placeholder="Masukan Merek" value="<?=$row->no_bank?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Atas Nama Bank</label>
					  <input type="text" class="form-control"  id="an" name='an' placeholder="Masukan Merek" value="<?=$row->an_bank?>">
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
<?php
	}
}
?>
			<script>
			function check(){
				
				if($("#nama").val() == ''){
					alert('Masukan Nama Owner');
					document.getElementById("nama").focus();
					return false;
				}else if($("#alamat").val() == ''){
					alert('Masukan Alamat');
					document.getElementById("alamat").focus();
					return false;
				}else if($("#telfon").val() == ''){
					alert('Masukan telfon !');
					document.getElementById("telfon").focus();
					return false;
				}else if($("#email").val() == ''){
					alert('Masukan Email ! ');
					document.getElementById("email").focus();
					return false;
				}else if($("#kecamatan").val() == ''){
					alert('Masukan Kecamatan ! ');
					document.getElementById("kecamatan").focus();
					return false;
				}else if($("#kota").val() == ''){
					alert('Masukan Kota ! ');
					document.getElementById("kota").focus();
					return false;
				}else if($("#provinsi").val() == ''){
					alert('Masukan Provinsi ! ');
					document.getElementById("provinsi").focus();
					return false;
				}else if($("#bank").val() == ''){
					alert('Masukan Nama Bank ! ');
					document.getElementById("bank").focus();
					return false;
				}else if($("#cabang").val() == ''){
					alert('Masukan Nama Cabang Bank ! ');
					document.getElementById("Cabang").focus();
					return false;
				}else if($("#norek").val() == ''){
					alert('Masukan Nomor Rekening Bank ! ');
					document.getElementById("norek").focus();
					return false;
				}else if($("#an").val() == ''){
					alert('Masukan Atas Nama Bank ! ');
					document.getElementById("an").focus();
					return false;
				}
				
			}
			</script>