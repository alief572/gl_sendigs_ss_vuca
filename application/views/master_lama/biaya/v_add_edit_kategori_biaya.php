<?php 
	$form_action	= (empty($id)) ? "add_kategori_Biaya" : "edit_kategori_Biaya";
	$id				= (empty($id)) ? "" : $id;
	$nm_kategori_Biaya	= (empty($nm_kategori_Biaya)) ? "" : $nm_kategori_Biaya;
	
?>

<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  	<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<?php
						if($judul == "Tambah Kategori Biaya"){	
							$form_action = "add_kategori_biaya";
					?>
					<h4 class="modal-title"><?=$judul?></h4>
					<?php }else{ $form_action = "edit_kategori_biaya";?>
							<h4 class="modal-title">Edit Kategori Biaya</h4>
						<?php } ?>
				</div>

				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?=site_url('master/'.$form_action);?>" enctype="multipart/form-data" autocomplete="off">
					<?php
						
						if($list_kat_biaya > 0){
							foreach($list_kat_biaya as $row){
							$id 	= $row->id_kategori_biaya;
							$nama 	= $row->kategori_biaya;
							$kode 	= $row->kode_kategori_biaya;
							}
						}
					?>

						<input type="hidden" name="id" value="<?=$id?>">

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Kategori Biaya</label>
						  <input type="text" class="form-control" id="nm_kategori_biaya" name='nm_kategori_biaya' placeholder="Masukan Nama Kategori Biaya" value="<?=$nama?>">
						</div>

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kode Kategori Biaya</label>
						  <input type="text" class="form-control" id="kode_kategori_biaya" name='kode_kategori_biaya' placeholder="Masukan Kode Kategori Biaya" value="<?=$kode?>">
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
		if($("#nm_kategori_biaya").val() == ''){
			alert('Masukan Nama Kategori Biaya');
			document.getElementById("nm_kategori_biaya").focus();
			return false;
		}

		if($("#kode_kategori_biaya").val() == ''){
			alert('Masukan Kode Kategori Biaya');
			document.getElementById("kode_kategori_biaya").focus();
			return false;
		}
	};
</script>