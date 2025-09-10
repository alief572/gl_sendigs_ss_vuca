<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Kategori Area</h4>
			</div>
				<div class="box-body table-responsive no-padding">
				<form method='post' action="<?=base_url().'index.php/master/proses_add_area';?>" enctype="multipart/form-data">
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Area</label>
					  <input type="text" class="form-control" id="nm_area" name='nm_area' placeholder="Masukan Nama area" value="">
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
			<script>
			function check(){
				if($("#nm_kategori").val() == ''){
					alert('Masukan nama kategori');
					document.getElementById("nm_kategori").focus();
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