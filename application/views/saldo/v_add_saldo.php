<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Input Saldo</h4>
			</div>
			<div class="box-body table-responsive no-padding">
			<form method='post' action="<?=base_url().'index.php/Latihan2/proses_add_saldo';?>" enctype="multipart/form-data">
					
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> No Perkiraan</label>
					  <input type="text" class="form-control" id="no_perkiraan" name='no_perkiraan' placeholder="Masukan No nomor " value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama</label>
					  <input type="text" class="form-control" id="nama" name='nama' placeholder="Masukan nama" value="">
					</div>
					
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kode Cabang</label>
					  <input type="text" class="form-control" id="kdcab" name='kdcab' placeholder="Masukan Kode" value="">
					</div>
						<div class="form-group has-success col-lg-6"  id="c_jabatan">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Bulan</label>
					  <input type="text" class="form-control" id="bln" name='bln' placeholder="Jumlah barang Bagus" value="<?=date("m")?>" readonly>
					</div>
					<div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Tahun</label>
					  <input type="text" class="form-control" id="thn" name='thn' value="<?=date("Y")?>" readonly>
					</div>
					<div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Saldo</label>
					  <input type="text" class="form-control" id="saldoawal" name='saldoawal' value="">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name" type="hidden">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i></label>
					  <input type="hidden" class="form-control" id="level" name='level' placeholder="Masukan Kode" value="5"readonly>
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

