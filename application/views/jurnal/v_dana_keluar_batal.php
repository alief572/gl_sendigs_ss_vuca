<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">KONFIRMASI</h4>
			</div>
			<div class="box-body table-responsive no-padding">
			<form method='post' action="<?=base_url().'index.php/jurnal/list_dana_keluar';?>" enctype="multipart/form-data">
				<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess">APAKAH YAKIN MAU DI BATALKAN ? </label><br>
					  <a href="<?=base_url()?>index.php/jurnal/proses_batal_dana_keluar/<?=$id_bukx?>" class="btn btn-danger">YA</a> &nbsp; <input type="submit" name="submit" value="TIDAK" class='pull-right btn btn-success'>
					  
				</div>			
			</form>
				<!-- 
					
					<a href="<?=base_url()?>index.php/jurnal/list_dana_keluar" class="btn btn-success">TIDAK</a>
					
					/.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script type="text/javascript">
	
</script>

