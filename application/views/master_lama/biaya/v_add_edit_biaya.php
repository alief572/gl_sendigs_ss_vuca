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
						if($judul == "Tambah Biaya"){	
							$form_action = "add_biaya";
					?>
					<h4 class="modal-title"><?=$judul?></h4>
					<?php 
						}else{
							$form_action = "edit_biaya";
					?>
							<h4 class="modal-title">Edit Biaya</h4>
						<?php } ?>
				</div>

				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?=site_url('master/'.$form_action);?>" enctype="multipart/form-data" autocomplete="off">
					<?php
						
						if($list_biaya > 0){
							foreach($list_biaya as $row){
							$id 				= $row->id_biaya;
							$nama 				= $row->nama_biaya;
							$kategori_biaya 	= $row->kategori_biaya;
							}
						}
					?>

						<input type="hidden" name="id" value="<?=$id?>">

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Biaya</label>
						  <input type="text" class="form-control" id="nm_biaya" name='nm_biaya' placeholder="Masukan Nama Biaya" value="<?=$nama?>">
						</div>

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kategori Biaya</label>
						 <!-- <input type="text" class="form-control" id="kategori_biaya" name='kategori_biaya' placeholder="Masukan Kategori Biaya" value="<?=$kategori_biaya?>"> -->

						  <select class="form-control" name="kategori_biaya" id="kategori_biaya">
							<?php
								if($form_action == "add_biaya"){								
							?>
						  	<option value="">- Pilih Kategori Biaya -</option>
							<?php }else{ ?>
									<option value="<?=$kategori_biaya?>"> <?=$kategori_biaya?> </option>
							<?php } ?>

									<?php
									$get_kategori_biaya	= $this->master_model->get_kategori_biaya();
									
										foreach($get_kategori_biaya as $row2){											
											echo "<option value='".$row2->kategori_biaya."'>".$row2->kategori_biaya."</option>";		
										}
									?>
								</select>
						</div>

						<div class="form-group has-success btn-group col-lg-6"></div>
							<div class="form-group has-success col-lg-6">
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
		if($("#nm_biaya").val() == ''){
			alert('Masukan Nama Biaya');
			document.getElementById("nm_biaya").focus();
			return false;
		}

		if($("#kategori_biaya").val() == ''){
			alert('Masukan Kategori Biaya');
			document.getElementById("kategori_biaya").focus();
			return false;
		}
	};
</script>