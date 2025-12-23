<?php 
	$form_action	= (empty($id)) ? "add_kategori_barang" : "edit_kategori_barang";
	$id				= (empty($id)) ? "" : $id;
	$nm_kategori_barang	= (empty($nm_kategori_barang)) ? "" : $nm_kategori_barang;
	
?>

<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  	<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<?php
						if($judul == "Tambah Kategori Barang"){	
							$form_action = "add_kategori_barang";				
					?>
					<h4 class="modal-title"><?=$judul?></h4>
					<?php }else{ $form_action = "edit_kategori_barang"; ?>
							<h4 class="modal-title">Edit Kategori Barang</h4>
						<?php } ?>
				</div>

				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?=site_url('master/'.$form_action);?>" enctype="multipart/form-data" autocomplete="off">
					<?php
						
						if($list_kat_brg > 0){
							foreach($list_kat_brg as $row){
							$id 	= $row->id;
							$nama 	= $row->kategori;							
							}
						}
					?>
						<input type="hidden" name="id" value="<?=$id?>">

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Kategori Barang</label>
						  <input type="text" class="form-control" id="nm_kategori_barang" name='nm_kategori_barang' placeholder="Masukan Nama Kategori Barang" value="<?=$nama?>">
						</div>

						<div class="form-group has-success btn-group col-lg-6"></div>
							<div class="form-group has-success col-lg-6">
							<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onclick="return check();">
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
		if($("#nm_kategori_barang").val() == ''){
			alert('Masukan Nama Kategori Barang');
			document.getElementById("nm_kategori_barang").focus();
			return false;
		}
	}
</script>