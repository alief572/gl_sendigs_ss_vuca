<?php 
	$form_action	= (empty($id)) ? "add_reason_lost_order" : "edit_reason_lost_order";
	$id				= (empty($id)) ? "" : $id;
	$alasan			= (empty($alasan)) ? "" : $alasan;
?>

<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  	<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Alasan</h4>
				</div>

				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?=site_url('master/'.$form_action);?>" enctype="multipart/form-data" autocomplete="off">

						<input type="hidden" name="id" value="<?=$id?>">

						<div class="form-group has-success col-lg-12">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alasan Lost Order</label>
						  <input type="text" class="form-control" id="alasan" name='alasan' placeholder="Masukan Alasan" value="<?=$alasan?>">
						</div>

						<?php if (!empty($id)) {?>
							<div class="form-group has-success col-lg-12">
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
		if($("#alasan").val() == ''){
			alert('Masukan Alasan');
			document.getElementById("alasan").focus();
			return false;
		}
	}
</script>