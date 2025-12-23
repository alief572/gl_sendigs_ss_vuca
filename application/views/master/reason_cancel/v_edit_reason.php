<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  	<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Alasan</h4>
				</div>

				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?=base_url().'index.php/master/edit_reason_cancel';?>" enctype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="id" value="<?=$id?>">

						<div class="form-group has-success col-lg-12">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Alasan</label>
						  <input type="text" class="form-control" id="alasan" name='alasan' placeholder="Masukan Alasan" value="<?=$alasan?>">
						</div>

						<div class="form-group has-success col-lg-12">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status</label>
						  <select name="sts" class="form-control">
						  	<option value="1" <?php if($sts==1){echo "selected";}?>>AKTIF</option>
						  	<option value="0" <?php if($sts==0){echo "selected";}?>>NON AKTIF</option>
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
	if($("#alasan").val() == ''){
		alert('Masukan Alasan');
		document.getElementById("alasan").focus();
		return false;
	}
}

</script>