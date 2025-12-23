<?php
	if($list_stock > 0){
		foreach($list_stock as $row){
			$id		= $row->id;
			$no_perkiraan		= $row->no_perkiraan;
			$nama		= $row->nama;
			$kdcab	= $row->kdcab;
			$saldoawal	= $row->saldoawal;
			$bln		= $row->bln;
			$thn			= $row->thn;
			$debet			= $row->debet;
			$kredit			= $row->kredit;

			$char0			= substr($no_perkiraan,0,1); // 1000-00-00 lv1
			$char1			= substr($no_perkiraan,1,1); // 1100-00-00 lv2
			$char2			= substr($no_perkiraan,2,1); // 1101-00-00 lv3
			$char3			= substr($no_perkiraan,3,1); // 1101-01-00 lv4
			$char5			= substr($no_perkiraan,5,1); // 1101-01-01 lv5
			$char6			= substr($no_perkiraan,6,1);
			$char8			= substr($no_perkiraan,8,1);
			$char9			= substr($no_perkiraan,9,1);
			
			
			if($char0 > 0 && $char1 == 0 && $char2 == 0 && $char3 == 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 1 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 == 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 2 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 3 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 3 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 3 ";
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 == 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 == 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 == 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 > 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 > 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";
			}elseif($char8 == 0 && $char9 > 0){
				$cek_level		= " Level 5 ";		
			}elseif($char8 > 0 && $char9 == 0){
				$cek_level		= " Level 5 ";		
			}elseif($char8 > 0 && $char9 >= 0){
				$cek_level		= " Level 5 ";		
			}
		}
?>
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Edit COA</h4>
			</div>
			<div class="box-body table-responsive no-padding">
				<form method='post' action="<?=base_url().'index.php/Latihan/proses_edit_stock';?>" enctype="multipart/form-data">
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> ID</label>
					  <input type="text" class="form-control" id="id" name='id' placeholder="Masukan No Id " value="<?=$id?>" readonly="readonly">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> No Perkiraan (<?=$cek_level?>)</label>
					  <input type="text" class="form-control" id="no_perkiraan" name='no_perkiraan' placeholder="Masukan No nomor " value="<?=$no_perkiraan?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama</label>
					  <input type="text" class="form-control" id="nama" name='nama' placeholder="Masukan nama" value="<?=$nama?>">
					</div>
					
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kode Cabang</label>
					  <input type="text" class="form-control" id="kdcab" name='kdcab' placeholder="Masukan Merek" value="<?=$kdcab?>">
					</div>
						<div class="form-group has-success col-lg-6"  id="c_jabatan">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Bulan</label>
					  <input type="text" class="form-control" id="bln" name='bln' placeholder="Jumlah barang Bagus" value="<?=$bln?>">
					</div>
					<div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Tahun</label>
					  <input type="text" class="form-control" id="thn" name='thn' value="<?=$thn?>">
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
<?php } ?>