<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  	<div class="modal-dialog" style="display:show;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Event</h4>
				</div>

				<div class="box-body table-responsive no-padding">
					<form method='post' action="<?=base_url().'index.php/master/proses_add_event';?>" enctype="multipart/form-data" autocomplete="off">

						<div class="form-group has-success col-lg-4">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Event</label>
						  <input type="text" class="form-control" id="nm_event" name='nm_event' placeholder="Masukan Nama Event" value="">
						</div>

						<div class="form-group has-success col-lg-4">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Lokasi</label>
						  <input type="text" class="form-control" id="lokasi" name='lokasi' placeholder="Masukan Lokasi" value="">
						</div>

						<div class="form-group has-success col-lg-4">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Tanggal</label>
						  <input type="text" class="form-control" id="date_event" name='date_event' placeholder="Masukan Tanggal Event" value="" >
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

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>

<script>

function check(){
	if($("#nm_event").val() == ''){
		alert('Masukan Nama Event');
		document.getElementById("nm_event").focus();
		return false;
	}else if($("#lokasi").val() == ''){
		alert('Masukan Lokasi');
		document.getElementById("lokasi").focus();
		return false;
	}else if($("#date_event").val() == ''){
		alert('Masukan Tanggal Event');
		document.getElementById("date_event").focus();
		return false;
	}
}

$(document).ready(function(){
	$('#date_event').datepicker({
		format:'yyyy-mm-dd',
		autoclose: true
	});
});

</script>