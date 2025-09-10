<?php 
	$form_action	= (empty($id)) ? "add_competitor" : "edit_competitor";
	$id				= (empty($id)) ? "" : $id;
	$nm_competitor	= (empty($nm_competitor)) ? "" : $nm_competitor;
	$keunggulan		= (empty($keunggulan)) ? "" : $keunggulan;
	$alamat			= (empty($alamat)) ? "" : $alamat;
?>

<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  	<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Competitor</h4>
				</div>

				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?=site_url('master/'.$form_action);?>" enctype="multipart/form-data" autocomplete="off">

						<input type="hidden" name="id" value="<?=$id?>">

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Competitor</label>
						  <input type="text" class="form-control" id="nm_competitor" name='nm_competitor' placeholder="Masukan Nama Competitor" value="<?=$nm_competitor?>">
						</div>

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Keunggulan</label>
						  <input type="text" class="form-control" id="keunggulan" name='keunggulan' placeholder="Masukan Keunggulan" value="<?=$keunggulan?>">
						</div>

						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alamat</label>
						  <input type="text" class="form-control" id="alamat" name='alamat' placeholder="Masukan Alamat" value="<?=$alamat?>">
						</div>

						<?php if (!empty($id)) {?>
							<div class="form-group has-success col-lg-6">
							  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status</label>
							  <select name="sts" class="form-control">
							  	<option value="1" <?php if($sts==1){echo "selected";}?>>AKTIF</option>
							  	<option value="0" <?php if($sts==0){echo "selected";}?>>NON AKTIF</option>
							  </select>
							</div>
						<?php } ?>

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
		if($("#nm_competitor").val() == ''){
			alert('Masukan Nama Competitor');
			document.getElementById("nm_competitor").focus();
			return false;
		}

		if($("#keunggulan").val() == ''){
			alert('Masukan Keunggulan');
			document.getElementById("keunggulan").focus();
			return false;
		}

		if($("#alamat").val() == ''){
			alert('Masukan Alamat');
			document.getElementById("alamat").focus();
			return false;
		}
	}
</script>