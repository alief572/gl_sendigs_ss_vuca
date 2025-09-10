<?php
	if($data_kategori > 0){
		foreach($data_kategori as $row){
			$id_kat			= $row->id_kategori;
			$nm_kategori	= $row->nm_kategori;
			$id_paket		= $row->id_paket;
			$keterangan		= $row->keterangan;
			$sts			= $row->sts;
			$nm_paket		= $row->nm_paket;
		}
?>
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Info Kategori</h4> 
			</div>
				<div class="box-body table-responsive no-padding">
				<form method='post' action="<?=base_url().'index.php/master/proses_edit_kategori';?>">
					<div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Id Kategori</label>
					  <input type="text" class="form-control" id="id" name='id' value="<?=$id_kat?>" readonly>
					</div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Kategori</label>
					  <input type="text" class="form-control" id="qty" name='nm_kategori' placeholder="Masukan nama kategori" value="<?=$nm_kategori?>" readonly>
					</div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Jenis Paket</label>
					  <select class="form-control" id="qty" name='jenis_kategory' readonly>
						<option value="0">Pilih Paket</option>
						<?php 
						if($list_paket >0){
							foreach($list_paket as $row1){
								if($id_paket == $row1->id_paket){
									echo "<option value='".$row1->id_paket."+^".$row1->nm_paket."' selected>".$row1->nm_paket."</option>";
								}else{
									echo "<option value='".$row1->id_paket."+^".$row1->nm_paket."'>".$row1->nm_paket."</option>";
								}
							}
						}
						?>
					  </select>
					</div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Keterangan</label>
					  <input type="text" class="form-control" id="qty" name='keterangan' placeholder="Masukan keterangan" value="<?=$keterangan?>" readonly>
					</div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Harga</label>
					  <input type="text" class="form-control" id="qty" name='harga' placeholder="Masukan harga" value="" readonly>
					</div>
					<div class="form-group has-success col-lg-6">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status</label>
					  <select class="form-control" id="qty" name='status' readonly>
						<?php
						if($sts ==1){
						?>
							<option value="1" selected>Aktif</option>
							<option value="0">Non-Aktif</option>
						<?php }else{?>
							<option value="1">Aktif</option>
							<option value="0" selected>Non-Aktif</option>
						<?php } ?>
					  </select>
					</div>
					<?php
					if($kategori_detail > 0){
						foreach($kategori_detail as $row3){
						$idxx	= $row3->id_barang;
						$harganya	= $this->master_model->get_harga_detail($idxx);
						$qtyxx	= $row3->jumlah;
						$tot_harga = $qtyxx * $harganya;
					?>
					<div id="detail_<?=$row3->id?>">
						<div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Barang</label>
						  <input type="hidden" class="form-control" name='nm_barang2[]' placeholder="Masukan keterangan" value="<?=$row3->id_barang."+^".$row3->nm_barang;?>" readonly>
						  <input type="text" class="form-control" name='' placeholder="Masukan keterangan" value="<?=$row3->nm_barang?>" readonly>
						</div>
						<div class="form-group has-success col-lg-3">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Jumlah</label>
						  <input type="text" class="form-control" name='qty[]' placeholder="Masukan keterangan" value="<?=$row3->jumlah?>" readonly>
						</div>
						<div class="form-group has-success col-lg-3">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Harga Total</label>
						  <input type="text" class="form-control" name='qty[]' placeholder="Masukan keterangan" value="<?=number_format($tot_harga)?>" readonly>
						</div>
					</div>
					<?php
						}	
					}
					?>
				</form>	
				<!-- /.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>
<?php 
}
?>