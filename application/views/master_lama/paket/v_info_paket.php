<?php
	//if($data_paket > 0){
		foreach($data_paket as $row){
			$id_paket		= $row->id_paket;
			$persentase		= $row->persentase;
			$sts			= $row->sts;
			$nm_paket		= $row->nm_paket;
			
			$harga	= $this->master_model->get_harga($row->id_paket);
			$aaaa	= $row->persentase;
			$harga_persen	= round(($aaaa/ 100)*$harga);
			$tot		= $harga + $harga_persen;
		}
?>
<div class="row">
<div class="col-xs-12">
<div class="box-header">
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog modal-lg" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Info Paket</h4> 
			</div>
				<div class="box-body table-responsive no-padding" >
				<table class="table" width="100%">
					<tr>
						<td width="15%">Nama Paket</td><td>: <?=$nm_paket?></td>
					</tr>
					<?php
					if($data_gedung > 0){
						foreach($data_gedung as $row2){
					?>
					<tr>
						<td>Nama Tempat</td><td>: <?=$row2->nm_gedung?></td>
					</tr>
					<tr>
						<td colspan="2"><b><h3>Spesifikasi Pelaminan<h3></b></td>
					</tr>
					<tr>
						<td>Width(Lebar)</td><td>: <?=$row2->lebar?></td>
					</tr>
					<tr>
						<td>Tall(Tingg)</td><td>: <?=$row2->tinggi?></td>
					</tr>
					<tr>
						<td>Length(Panjang)</td><td>: <?=$row2->panjang?></td>
					</tr>
					<tr>
						<td>Tinggi Panggung</td><td>: <?=$row2->tinggi_panggung?></td>
					</tr>
					<?php
						}
					}
					?>
				</table>
				<table class="table table-hover table-striped" style="border:2px" width="100%">
					<tr class="bg-green disabled color-palette">
						<th width="25%">Area</td><th width="40%">Spesifikasi Dekor</td>
					</tr>
					<?php
					if($data_kategori > 0){
						foreach($data_kategori as $row3){
							$id_kategori = $row3->id_kategori;
							$data_kat_det = $this->master_model->kategori_detail($id_kategori);
					?>
					<tr>
						<td><?=$row3->nm_kategori?></td>
						<td>
							<table width="100%">
								<?php 
								if($data_kat_det > 0){
									foreach($data_kat_det as $row4){
								?>
								<tr>
									<td width="70%"><?=$row4->nm_barang?></td>
									<td width="8%"><?=$row4->jumlah?> Buah</td>
									<td width="10%"><?php if($row4->sts=='1'){echo "Aktif";}else{echo "Non_aktif";}?></td>
								</tr>
								<?php
									}
								}
								?>
							</table>
						</td>
					</tr>
					<?php
						}
					}
					?>
				</table>
				<!-- /.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
<?php 
//}
?>