<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form input Cabang</h4>
			</div>
			<div class="box-body table-responsive no-padding">
			<form method='post' action="<?=base_url().'index.php/Latihan/proses_add_cabang';?>" enctype="multipart/form-data">		
					<div class="form-group has-success col-lg-6"  id="c_user_id">
                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> No Cabang</label>
					  <input type="text" class="form-control" id="nocab" name='nocab' placeholder="Masukan Nama Perkiraan" value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Sub Cabang</label>
					  <input type="text" class="form-control" id="subcab" name='subcab' placeholder="Masukan Nama Perkiraan" value="">
					</div>
						<div class="form-group has-success col-lg-6"  id="c_jabatan">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Cabang</label>
					  <input type="text" class="form-control" id="cabang" name='cabang' placeholder="Jumlah barang Bagus" value="" >
					</div>
					<div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Area</label>
					  <input type="text" class="form-control" id="area" name='area' value="" >
					</div>
					<div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Kode Cabang</label>
					  <input type="text" class="form-control" id="kode" name='kode' value="" >
					</div>
                    <div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Alamat</label>
					  <input type="text" class="form-control" id="alamat" name='alamat' value="" >
					</div>
                    <div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Nama Cabang</label>
					  <input type="text" class="form-control" id="nama_cabang" name='nama_cabang' value="" >
					</div>
                    <div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>Perusahaan</label>
					  <input type="text" class="form-control" id="perusahaan" name='perusahaan' value="" >
					</div>
						
						<div class="form-group has-success btn-group col-lg-6"></div>
						<div class="form-group has-success col-lg-6"  id="c_">
						<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onclick="return check()">
					</div>
				</form>	
				<!-- /.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script type="text/javascript">
	function check(){		// updated by Rindra
		if($("#no_perkiraan").val() == ''){
			alert('Silahkan Isi No Perkiraan');
			document.getElementById("no_perkiraan").focus();
			return false;
		}else if($("#nama").val()==''){
			alert('Silahkan Isi Nama Perkiraan');
			document.getElementById("nama").focus();
			return false;
		}else if($("#kdcab").val()==''){
			alert('Silahkan Pilih Kode Cabang');
			document.getElementById("kdcab").focus();
			return false;
		}
	}
	function changeValue(id){
		$.get( "<?= base_url(); ?>index.php/Latihan/cetak_nokir" , { option : id } , function ( data ) {
		$( '#c_user_id' ) . html ( data ) ;
		} ) ;
	}
</script>

