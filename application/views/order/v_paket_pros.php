				<table class="table table-striped" style="border:2px" width="100%" id="tabel_paket">
					<tbody>
					<tr class="bg-green disabled color-palette">
						<th width="25%">Area</td><th width="40%">Keterangan</th><th width="40%">Spesifikasi Dekor</th><th width="40%">Harga</th>
					</tr>
					<?php
					$j=0;
					if($data_kategori > 0){
						foreach($data_kategori as $row3){
							$id_kategori = $row3->id_kategori;
							$data_kat_det = $this->master_model->kategori_detail($id_kategori);
					?>
					<tr>
						<td width="25%">
						<b><?=$row3->nm_kategori?></b>
						<select name="inc_kategori[]">
							<option value="2<?=$id_kategori?>">Yes</option>
							<option value="1<?=$id_kategori?>">No</option>
						</select>
						</td>
						<td width="35%"><?=$row3->keterangan?></td>
						<td width="35%">
							<table width="100%" class="table table-striped">
								<?php 
								if($data_kat_det > 0){
									foreach($data_kat_det as $row4){
									$j++;
								?>
								<tr>
									<td width="60%"><?=$row4->nm_barang?></td>
									<td width="8%"></td>
									<td width="10%"><?=$row4->jumlah?></td>
									<td width="10%"><select name="inc_barang[<?=$j?>]" id="inc_barang_<?=$j?>"><option value="2<?=$row4->id_barang?>">Yes</option><option value="1<?=$row4->id_barang?>">No</option></select></td>
								</tr>
								<?php
									}
								}
								?>
								</tbody>
							</table>
						</td>
						<td></td>
					</tr>
					
					<?php
						}
					}
					?>
				</table>