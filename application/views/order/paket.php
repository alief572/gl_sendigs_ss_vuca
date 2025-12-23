<table width="100%" class="table table-bordered table-hover" id="pilih_paket">
						<tr>
							<th style="text-align:center;background-color:lightblue">AREA</th>
							<th style="text-align:center;background-color:lightblue">KETERANGAN</th>
							<th style="text-align:center;background-color:lightblue">SPESIFIKASI</th>
							<th style="text-align:center;background-color:lightblue">HARGA</th>
						</tr>
						<?php
							$data_area = $this->order_model->get_area();
							if($data_area >0){
								$varx=0;
								foreach($data_area as $r_a){
									$data_paket_detailx = $this->order_model->get_kategori_detx($id_cust,$r_a->id);
									$count = 1;
									$varx++;
									if($r_a->use == '0'){
										$tampilkan = 'show';
									}else{
										$tampilkan = 'none';
									}
									if($data_paket_detailx > 0){
										foreach($data_paket_detailx as $r_paketx){
											$harga 			= $r_paketx->jumlah;
											$nm_keterangan 	= $r_paketx->nm_keterangan;
											$sfc	= $r_paketx->nm_sfesifikasi;;
										}
									}else{
										$harga = "";
										$nm_keterangan = "";
										$sfc	="";
									}
								?>
								<tr style="display:<?=$tampilkan?>">
									<td rowspan="<?=$r_a->jum?>" width="30%"><b><?=$r_a->nm_area?></b>
										<input type="hidden" class="form-control" name="id_area_[]" value="<?=$r_a->id?>">
									</td>
									
									<td width="30%"><input type="text" class="form-control skills" <?php if($nm_keterangan !=""){echo "readonly";}?> id="skill_<?=$varx?>" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]" value="<?=$nm_keterangan?>"></td>
									
									<td width="25%"><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$sfc?>"></td>
									
									<td width="15%" id="harga_<?=$varx?>">
										<input type="text" class="form-control" readonly>
										<input type="hidden" class="form-control" name="paket_<?=$r_a->id?>_harga[]" value="p" readonly>
										<input type="hidden" class="form-control" id="harganya_<?=$varx?>" readonly name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)" value="<?=$harga?>">
										
									</td>
									<input type="hidden" class="form-control" name="area_<?=$r_a->nm_area?>_nama[]">
								</tr>
								<?php
									$data_paket_detail = $this->order_model->get_kategori_det($id_cust,$r_a->id);
									$count = 1;
									if($data_paket_detail > 0){
										foreach($data_paket_detail as $r_paket){
										$count++;
										$varx++;
									?>
								<tr style="display:<?=$tampilkan?>">
									<td><input type="text" class="form-control skills" readonly id="skill_<?=$varx?>" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]" value="<?=$r_paket->nm_keterangan?>"></td>
								
									<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$r_paket->nm_sfesifikasi?>"></td>
								
									<td id="harga_<?=$varx?>">
												<input type="text" class="form-control" readonly>
												<input type="hidden" class="form-control" name="paket_<?=$r_a->id?>_harga[]" value="p" readonly>
												<input type="hidden" class="form-control" name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)" id="harganya_<?=$varx?>" readonly value="<?=$r_paket->jumlah?>">											
									</td>
									
									<input type="hidden" class="form-control" name="area_<?=$r_a->id?>_nama[]" value="<?=$r_a->nm_area?>">
								</tr>

								<?php
										}
									}
									for($i=1;$i<=($r_a->jum-1-($count));$i++){
									$varx++;
								?>

								<tr style="display:<?=$tampilkan?>">
									<td><input type="text" class="form-control skills" id="skill_<?=$varx?>" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]"></td>
								
									<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]"></td>
								
									<td id="harga_<?=$varx?>">
											<input type="hidden" class="form-control" id="harganya_<?=$varx?>" readonly name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)">
									</td>
								
									<input type="hidden" class="form-control" name="area_<?=$r_a->id?>_nama[]" value="<?=$r_a->nm_area?>">
								</tr>
								
									<?php } ?>
									<td style="background-color:gray" colspan="4"></td>
								<?php
								}
							}
						?>
					</table>
<script>
$(function() {
    $(".skills").autocomplete({
      source: '<?=base_url()?>/index.php/order/search'
	  });
    });
</script>