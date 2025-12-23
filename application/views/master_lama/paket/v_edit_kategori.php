<?php
	if($list_data > 0){
		foreach($list_data as $row){
			$id = $row->id;
			$id2 = $row->nm_keterangan;
			$id3 = $row->jumlah;
		}
?>

<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Kategori Paket</h4>
			</div>
				<div class="box-body table-responsive no-padding">
				<form method='post' action="<?=base_url().'index.php/master/proses_edit_kategori_paket';?>" enctype="multipart/form-data">
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Kategori</label>
					  <input type="text" class="form-control" id="nm_kategori" name='nm_kategori' placeholder="Masukan Nama Barang" value="<?=$id2?>">
					  <input type="hidden" class="form-control" id="id" name='id' value="<?=$id?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Harga</label>
					  <input type="text" class="form-control" onkeypress="return isNumber(event)" id="harga" name='harga' placeholder="Masukan Merek" value="<?=$id3?>">
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
?>
			<script>
			function check(){
				if($("#nm_kategori").val() == ''){
					alert('Masukan nama kategori');
					document.getElementById("nm_kategori").focus();
					return false;
				}else if($("#harga").val() == ''){
					alert('masukan Harga');
					document.getElementById("harga").focus();
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