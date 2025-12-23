<?php $this->load->view('header');
	foreach($data_penawaran as $rows){
		$id_penawaran 	= $rows->id_penawaran;
		$color_tone 	= $rows->color_tone;
		$tema 			= $rows->tema;
		$tempat1x 		= $rows->tempat1;
		$tempat_resepsi1 = $rows->tempat_resepsi1;
		$tempat_resepsi2 = $rows->tempat_resepsi2;
		$tempat_resepsi3 = $rows->tempat_resepsi3;
		$provinsi1	 	= $rows->provinsi1;
		$panjang1 		= $rows->panjang1;
		$tinggi1 		= $rows->tinggi1;
		$lebar1 		= $rows->lebar1;
		$t_panggung1 	= $rows->t_panggung1;
		$id_paket 		= $rows->jenis_paket;
		$harga_tawar	= $rows->harga;
		$discount		= $rows->discount;
		$harga_paket	= $rows->harga_paket;
		$tambahan_paket	= $rows->tambahan_paket;
		$diskon_app		= $rows->diskon_app;
		$app_diskon		= $rows->app_diskon;
		$harga_app		= $rows->harga_app;
		$harga_deal		= $rows->harga_deal;
		$pajak			= $rows->pajak;
		$komisi_gedung	= $rows->komisi_gedung;
		$harga_net		= $rows->harga_net;
        if(empty($harga_deal))
        {
           $harga_deal=$harga_paket+$tambahan_paket-($discount*($harga_paket+$tambahan_paket));
		} 

        if(empty($harga_net))
        {
           $harga_net=$harga_deal-$pajak-$komisi_gedung;
        } 

	}
	$data_paket = $this->master_model->get_list_paket();
?>
	<section class="content-header">
      <h1>
       <?=$judul?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<form action="<?=base_url()?>index.php/order/save_penawaran_edit" method="post" autocomplete="off">
				<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Penawaran</b></td>
							<td><input type="text" name="kd_penawaran" class='form-control' id="kd_penawaran" value="<?=$id_penawaran?>" readonly></td>
							<td><b>Color Tone</b></td>
							<td><input type="text" name="color_tone"  class='form-control' id="color_tone" value="<?=$color_tone?>" ></td>
						</tr>
						<tr>
							<td><b>ID Prospek</b></td>
							<td><input type="text" name="id_prospek"  class='form-control' id="id_prospek" value="<?=$kd_prospek?>" readonly></td>
							<td><b>Tema Spesifik yang diingikan</b></td>
							<td><input type="text" name="tema"  class='form-control' id="tema" value="<?=$tema?>"></td>
						</tr>
						<tr>
							<td><b>Tanggal Input</b></td>
							<td><input type="text" name="tgl_input"  class='form-control' id="tgl_input" value="<?=date("d-M-Y")?>" readonly></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Pria</b></td>
							<td><input type="text" id="pria" name="pria"  class='form-control' value="<?=$pria?>" readonly></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Wanita</b></td>
							<td><input type="text" name="wanita" id="wanita"  class='form-control' value="<?=$wanita?>" readonly></td>
							<td><b>Nama Tempat</b></td>
							<td id="tempat"><input type="text" name="aaaaa"  class='form-control skills2' id="aaaaa" value="<?=$tempat1x?>"></td>
						</tr>
						<tr>
							<td><b>Telpon / HP</b></td>
							<td><input type="text" name="telfon" id="telfon" class='form-control'  value="<?=$telfon?>" readonly></td>
							<td><b>Alamat</b></td>
							<td id="alamat"><input type="text" name="alamat"  class='form-control' id="alamat1"  value="<?=$tempat_resepsi1?>"></td>
						</tr>
						<tr>
							<td><b>Email 1</b></td>
							<td><input type="text" name="email" id="email" class='form-control'  value="<?=$email?>" readonly></td>
							<td><b>Kota / Kabupaten</b></td>
							<td id="kota"><input type="text" name="kota"  class='form-control' id="kota1"  value="<?=$tempat_resepsi2?>"></td>
						</tr>
						<tr>
							<td><b>Email 2</b></td>
							<td><input type="text" name="email2" id="email2"  class='form-control' value="<?=$email2?>" readonly></td>
							<td><b>Provinsi</b></td>
							<td id="provinsi"><input type="text" name="provinsi"  class='form-control' id="provinsi1"  value="<?=$provinsi1?>"></td>
						</tr>
						<tr>
							<td><b>Tanggal Resepsi</b></td>
							<td><input type="text" name="tgl_resepsi" id="tgl_resepsi"  class='form-control' value="<?=$tgl_resepsi?>" readonly></td>
							<td style="display:none" colspan="2" align="center"><b>Spesifikasi Panggung</b></td>
						</tr>
						<tr style="display:none">
							<td><b>Alamat</b></td>
							<td><input type="text" name="tempat1" id="tempat1"  class='form-control' value="<?=$tempat1?>" readonly></td>
							<td><b>Panjang</b></td>
							<td id="panjang"><input type="text" name="panjang1"  class='form-control' id="panjang1"  value="<?=$panjang1?>"></td>
						</tr>
						<tr style="display:none">
							<td></td>
							<td><input type="text" name="tempat2" id="tempat2"  class='form-control' value="<?=$tempat2?>" readonly></td>
							<td><b>Tinggi</b></td>
							<td id="tinggi"><input type="text" name="tinggi1"  class='form-control' id="tinggi1"  value="<?=$tinggi1?>"></td>
						</tr>
						<tr style="display:none">
							<td></td>
							<td><input type="text" name="tempat3" id="tempat3"  class='form-control' value="<?=$tempat3?>" readonly></td>
							<td><b>Lebar</b></td>
							<td id="lebar"><input type="text" name="lebar1"  class='form-control' id="lebar1"   value="<?=$lebar1?>"></td>
						</tr>
						<tr>
							<td><b>Jam Resepsi</b></td>
							<td><input type="text" name="jam_resepsi"  class='form-control' id="jam_resepsi" value="<?=$jam_resepsi?>" readonly></td>
							<td style="display:none"><b>Tinggi Panggung</b></td>
							<td style="display:none" id="t_panggung"><input type="text" name="t_panggung1"  class='form-control' id="t_panggung1"  value="<?=$t_panggung1?>"></td>
						</tr>
						<tr>
							<td><b>Tempat Resepsi Awal</b></td>
							<td><input type="text" class='form-control' value="<?=$tempat_resepsi?>" readonly></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4" height="40px"></td>
						</tr>
						<tr>
							<td><b>Spesifikasi Dekor</b></td>
							<td colspan="4"><div class="col-lg-6">
								<select name="jenis_paket" class='form-control' id="jenis_paket"  onchange="return pilih_paket()">
									<option value=""> Pilih Paket </option>
									<?php
									if($data_paket > 0){
										foreach($data_paket as $row){
											if($id_paket == $row->id_paket){
												echo "<option selected value='".$row->id_paket."'>".$row->nm_paket."</option>";
											}else{
												echo "<option value='".$row->id_paket."'>".$row->nm_paket."</option>";
											}
										}
									}
									
									?>
								</select>
								</div>
								<div style="display:none">
								<div class="col-lg-2">
								Include Gedung
								</div>
								<div class="col-lg-3">
								<label id="inc_gedungx">
								<select onchange='return sssssssssss()' class="form-control" name="inc_gedung" id="inc_gedung">
								<?php
									if($inc_gedung == "yes"){
								?>
									<option value="yes" selected>YES</option>
									<option value="no">NO</option>
								<?php }else{?>
									<option value="yes">YES</option>
									<option value="no" selected>NO</option>
								<?php }?>
								</select>
								</label>
								</div>
								</div>
							</td>
						</tr>
					</table>
				
					<table width="100%" class="table table-bordered table-hover" id="pilih_paket">
						<tr>
							<th style="text-align:center;background-color:lightblue">AREA</th>
							<th style="text-align:center;background-color:lightblue">SPESIFIKASI</th>
							<th style="text-align:center;background-color:lightblue">KETERANGAN</th>
							<th style="text-align:center;background-color:lightblue">HARGA</th>
						</tr>
						<?php
							$tambahanx = "N";
							$data_area = $this->order_model->get_area();
							if($data_area >0){
								$varx=0;
								foreach($data_area as $r_a){
									$data_paket_detailx = $this->order_model->get_kategori_savex($id_prospek,$r_a->id);
									$count = 1;
									if($r_a->use == '0'){
										$tampilkan = 'show';
									}else{
										$tampilkan = 'none';
									}
									$varx++;
									if($data_paket_detailx > 0){
										foreach($data_paket_detailx as $r_paketx){
											$harga 			= $r_paketx->jumlah;
											$nm_keterangan 	= $r_paketx->nm_keterangan;
											$sfc			= $r_paketx->nm_sfesifikasi;
											$tambahanx		= $r_paketx->tambahan;
										}
									}else{
										$harga = "";
										$nm_keterangan = "";
										$sfc	="";
									}
									$idxx = $r_a->id;
									if($tambahanx == "N" && $nm_keterangan != ""){
										$read = "readonly";
									}else{
										$read = "";
									}
								?>
								<tr style="display:<?=$tampilkan?>">
									<td rowspan="<?=($r_a->jum)?>" width="30%"><b><?=$r_a->nm_area?></b>
										<input type="hidden" class="form-control" name="id_area_[]" value="<?=$r_a->id?>">
									</td>
									<td width="30%"><input type="text" id="skill_<?=$varx?>" <?=$read?> class="form-control skills" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]" 
value="<?=$nm_keterangan?>"></td>
									<td width="25%"><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$sfc?>"></td>
									<td width="15%" id="harga_<?=$varx?>">	
										<?php
											if($tambahanx == "N"){
												echo "<input type='text' class='form-control' readonly>";
												echo "<input type='hidden' class='form-control' name='paket_".$r_a->id."_harga[]' onchange='hitung_ulang($varx,$r_a->id)' value='p' readonly>";
											}else{
												echo "<input type='text' class='form-control'  id='harganyax_$varx' value='$harga' onchange='hitung_ulang($varx,$r_a->id)' onkeypress='return isNumber(event)' name='areax_".$idxx."_harga[]'>";
											}
										?>
										<input type="hidden" class="form-control" id="harganya_<?=$varx?>" readonly name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)" value="<?=$harga?>">
										
										
									</td>
									<input type="hidden" class="form-control" name="area_<?=$r_a->nm_area?>_nama[]">
								</tr>
								<?php
									$data_paket_detail = $this->order_model->get_kategori_save($id_prospek,$r_a->id);
									$count = 1;
									if($data_paket_detail > 0){
										foreach($data_paket_detail as $r_paket){
										$count++;
										$varx++;
										$tambahan = $r_paket->tambahan;
										if($tambahan == "N"){
											$readx = "readonly";
										}else{
											$readx = "";
										}
									?>
										<tr style="display:<?=$tampilkan?>">
											<td><input type="text" class="form-control skills" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" <?=$readx?> name="area_<?=$r_a->id?>_ket[]"  id="skill_<?=$varx?>" value="<?=$r_paket->nm_keterangan?>"></td>
											<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$r_paket->nm_sfesifikasi?>"></td>
											<td id="harga_<?=$varx?>">
												<?php
													if($tambahan == "N"){
														echo "<input type='text' class='form-control' readonly>";
														echo "<input type='hidden' class='form-control' name='paket_".$r_a->id."_harga[]' onchange='hitung_ulang($varx,$r_a->id)' value='p' readonly>";
													}else{
														$harga = $r_paket->jumlah;
														echo "<input type='text' class='form-control'  id='harganyax_$varx' value='$harga' onkeypress='return isNumber(event)' onchange='hitung_ulang($varx,$r_a->id)' name='areax_".$idxx."_harga[]'>";
													}
												?>
												<input type="hidden" class="form-control" name="area_<?=$r_a->id?>_harga[]" id="harganya_<?=$varx?>" onkeypress="return isNumber(event)" readonly value="<?=$r_paket->jumlah?>">
											
											</td>
											<input type="hidden" class="form-control" name="area_<?=$r_a->id?>_nama[]" value="<?=$r_a->nm_area?>" readonly>
										</tr>
									<?php
										}
									}
									for($i=1;$i<=($r_a->jum-1-($count));$i++){
									$varx++;
									?>
									<tr style="display:<?=$tampilkan?>">
										<td><input type="text" class="form-control skills"  id="skill_<?=$varx?>" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]"></td>
										<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]"></td>
										<td id="harga_<?=$varx?>">
											<input type="text" class="form-control" readonly id="harganya_<?=$varx?>" name="area_<?=$r_a->id?>_harga[]" onchange="hitung_ulang(<?=$varx?>,<?=$r_a->id?>)" onkeypress="return isNumber(event)" readonly>
											
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
					<input type="hidden" name="jum_area" value="<?=count($data_area)?>">
					<table width="100%" class="table table-hover">
						
			

						<tr style="background-color:gray">
                        	<td width="50px">
							</td>
							<td width="50px" colspan="2" align="right">Harga Penawaran
								<p id="harga_td">
									<input onkeypress="return isNumber(event)" readonly placeholder="Rp." type="hidden" name="harga" id="harga" value="<?=$harga_paket?>">
								</p>
						
								<p id="harga_tambah_td">
								<input onkeypress="return isNumber(event)" readonly placeholder="Rp." type="hidden" name="harga_tambahan" id="harga_tambahan" value="<?=$tambahan_paket?>">
								</p>
		<input onkeypress="return isNumber(event)" placeholder="Rp."  onchange="return hitung()" type="hidden" name="discount" id="discount" value="<?=$discount?>">
						
							</td>
							<td width="50px">
								<p id="total_td">
								<input onkeypress="return isNumber(event)" readonly placeholder="Rp." type="hidden" name="total" id="total" value="<?=$harga_tawar?>">
						
								<input  readonly placeholder="Rp." type="text" name="totalx2" id="totalx2" value="<?=number_format($harga_tawar)?>">
								</p>
								<input onkeypress="return isNumber(event)" readonly placeholder="Rp." type="hidden" name="max" id="max" value="<?=$this->order_model->get_discount($this->session->userdata('pn_jabatan'))?>">
								<input onkeypress="return isNumber(event)" readonly placeholder="Rp." type="hidden" name="count_area" id="count_area" value="<?=$varx?>">
							</td>
						</tr> 

						<tr style="background-color:gray">
							<td colspan="2" width="50%" align="right"></td>
							<td align="right">Harga Deal</td>
							<td align="right" width="50px">
								<input onkeypress="return isNumber(event)" placeholder="Rp." type="text" name="harga_deal" id="harga_deal" value="<?=number_format($harga_deal)?>">
							</td>
						</tr>

						<tr style="background-color:gray">
							<td colspan="2" width="50%" align="right"></td>
							<td align="right">Potongan Pajak</td>
							<td align="right" width="50px">
								<input onkeypress="return isNumber(event)" placeholder="Rp." type="text" name="pajak" id="pajak" value="<?=$pajak?>">
							</td>
						</tr>

						<tr style="background-color:gray">
							<td colspan="2" width="50%" align="right"></td>
							<td align="right">Komisi Gedung</td>
							<td align="right" width="50px">
								<input onkeypress="return isNumber(event)" placeholder="Rp." type="text" name="komisi_gedung" id="komisi_gedung" value="<?=$komisi_gedung?>">
							</td>
						</tr>

						<tr style="background-color:gray">
							<td colspan="2" width="50%" align="right"></td>
							<td align="right">Harga Net</td>
							<td align="right" width="50px">
								<input onkeypress="return isNumber(event)" placeholder="Rp." type="text" name="harga_net" id="harga_net" value="<?=number_format($harga_net)?>" readonly>
							</td>
						</tr>
						
					</table>
						<?php
						if($harga_app > 0){
						?>	
						<table width="100%" id="discountapp" style="display:show" style="background-color:gray" class="table">
							<tr  width="100%">
								<td align="right" style="background-color:gray"></td>
								<td align="right" style="background-color:gray">Discount Sebelum Approve(%)</td>
								<td align="right"  width="50px" style="background-color:gray">
									<p id="discountxx_td">
									<input type="text" name="discountxx" value="<?=number_format($diskon_app)?>" readonly id="discountxx" >
									</p>
								</td>
							</tr>
							<tr width="100%">
								<td align="right" width="60%" style="background-color:gray"></td>
								<td align="right" width="30%" style="background-color:gray">Total Sebelum Appove</td>
								<td align="right"  width="50px" style="background-color:gray">
									<p id="totalapp_td">
									<input type="text" name="totalapp" value="<?=number_format($harga_app)?>" id="totalapp" >
									</p>
								</td>
							</tr>
						</table>
						<?php
						}else{
						?>	
						<table width="100%" id="discountapp" style="display:none" style="background-color:gray" class="table">
							<tr  width="100%">
								<td align="right" style="background-color:gray"></td>
								<td align="right" style="background-color:gray">Discount Sebelum Approve(%)</td>
								<td align="right"  width="50px" style="background-color:gray">
									<p id="discountxx_td">
									<input type="text" name="discountxx" value="0" readonly id="discountxx" >
									</p>
								</td>
							</tr>
							<tr width="100%">
								<td align="right" width="60%" style="background-color:gray"></td>
								<td align="right" width="30%" style="background-color:gray">Total Sebelum Appove</td>
								<td align="right"  width="50px" style="background-color:gray">
									<p id="totalapp_td">
									<input type="text" name="totalapp" value="0" id="totalapp" >
									</p>
								</td>
							</tr>
						</table>
						<?php	
						}
						?>
					<table width="100%" style="background-color:gray" class="table">
						<tr>
							<td colspan="5" align="right" style="background-color:white" >
							<input type="submit" name="submit" value="Save" class="btn btn-success"></td>
						</tr>
					</table >
					</form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="<?=base_url()?>dist/jquery-ui.css">
<script src="<?=base_url()?>plugins/jQuery/jquery-2.2.3.min"></script>
<script src="<?=base_url()?>dist/jquery-ui.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
			$(wrapper).append('<?php echo "<div class=\"form-group has-success col-lg-2\"><input type=\"text\" class=\"form-control\" id=\"area\" name=\"area[]\" placeholder=\"Masukan Area\"></div><div><div class=\"form-group has-success col-lg-5 this_form\"><select class=\"chosen-select form-control\" name=\"nm_barang[]\" id=\"nm_barang[]\" data-placeholder=\"Choose a Location\" tabindex=\"10\"><option value=\"0\">Pilih Barang</option>";
			if($list_kategori > 0){
				foreach($list_kategori as $row){
					$val	= $row->id."+^".$row->nm_barang;
					$nm		= $row->nm_barang;
					echo "<option value=\"$val\">$nm</option>";
				}
			}
			echo "</select></div>";
			echo "<div class=\"form-group has-success col-lg-2\" placeholder=\"Masukan jumlah\">";
				echo "<input class=\"form-control\" type=\"text\" placeholder=\"Masukan jumlah\" name=\"qty[]\">";
			echo "</div>";
			echo "<a href=\"#\" class=\"form-group has-success col-lg-2 remove_field\"><button class=\"btn btn-warning \">Hapus</button></a><div>";?>')
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

    $('#harga_deal').change(function() {
    	var hrg_deal	= $('#harga_deal').val();
    	var kom_gedung	= $('#komisi_gedung').val();
    	var pajak		= $('#pajak').val();

    	var harga_net	= hrg_deal - kom_gedung - pajak;
		
    	$('#harga_net').val(harga_net.toLocaleString('en-US', {minimumFractionDigits: 0}));
    })

    $('#komisi_gedung').change(function() {
    	var hrg_deal	= $('#harga_deal').val();
    	var kom_gedung	= $('#komisi_gedung').val();
    	var pajak		= $('#pajak').val();

    	var harga_net	= hrg_deal - kom_gedung - pajak;
    	$('#harga_net').val(harga_net.toLocaleString('en-US', {minimumFractionDigits: 0}));
    })

    $('#pajak').change(function() {
    	var hrg_deal	= $('#harga_deal').val();
    	var kom_gedung	= $('#komisi_gedung').val();
    	var pajak		= $('#pajak').val();

    	var harga_net	= hrg_deal - kom_gedung - pajak;
    	$('#harga_net').val(harga_net.toLocaleString('en-US', {minimumFractionDigits: 0}));
    })
});

function hitung(){
	var harga_paket = parseInt($("#harga").val());
	var harga_tambahan = parseInt($("#harga_tambahan").val());
	var discount = parseInt($("#discount").val());
	var max = parseInt($("#max").val());
	if(discount > max){
		alert('discount tidak boleh lebih dari '+max+' %, mohon tunggu Approval ');
		document.getElementById('discountxx').value=max;
		discount2 = max;
		document.getElementById('discountapp').style.display='initial';
		//document.getElementById('totapp').style.display='initial';
	}else{
		discount2 = discount;
		document.getElementById('discountxx').value='0';
		document.getElementById('totalapp').value='0';
		document.getElementById('discountapp').style.display='none';
		//document.getElementById('totapp').style.display='none';
	}
	var tot_harga = harga_tambahan + harga_paket;
	var tot_discount = (tot_harga * parseInt(discount)/100);
	var tot_discount2 = (tot_harga * parseInt(discount2)/100);
	total = harga_paket +  harga_tambahan - tot_discount;
	totalapp = harga_paket +  harga_tambahan - tot_discount2;
	document.getElementById('total').value=total.toLocaleString('en-US', {minimumFractionDigits: 0});
	if(discount <= max){
		document.getElementById('totalapp').value='0';
	}else{
		document.getElementById('totalapp').value=totalapp.toLocaleString('en-US', {minimumFractionDigits: 0});
	}
	document.getElementById('totalx2').value=total.toLocaleString('en-US', {minimumFractionDigits: 0});
}

function pilih_paket(){
	paket = $("#jenis_paket").val();
	$.get( "<?= base_url(); ?>index.php/order/pilih_paket" , { option : paket } , function ( data ) {
		$( '#pilih_paket' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung1" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#tempat' ) . html ( data ) ;
	} ) ;
	$datass = $.get( "<?= base_url(); ?>index.php/order/tes_data" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#s' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung2" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#alamat' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung3" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#kota' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung4" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#provinsi' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung5" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#panjang' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung6" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#tinggi' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung7" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#lebar' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung8" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#t_panggung' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/gedung" , { option : "" } , function ( data ) {
		$( '#inc_gedungx' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/harga" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#harga_td' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/total" , { option : $("#jenis_paket").val() } , function ( data ) {
		
		$('#totalx2').val(parseInt(data).toLocaleString('en-US', {minimumFractionDigits: 0}));
	} ) ;
	
	var id2 = 0;
	var barang = 0;
	var id = 0;
	var harga_tambah = 0;
	$.get( "<?= base_url(); ?>index.php/order/cari_harga_tambah" , { option : barang, option2 : id2,option3:id,option4 : harga_tambah } , function ( data ) {
		$( '#harga_tambah_td') . html (data) ;
	} ) ;
}

function sssssssssss(){
	if($("#inc_gedung").val()=='yes')
	{
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung1" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#tempat' ) . html ( data ) ;
		} ) ;
		$datass = $.get( "<?= base_url(); ?>index.php/order/tes_data" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#s' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung2" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#alamat' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung3" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#kota' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung4" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#provinsi' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung5" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#panjang' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung6" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#tinggi' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung7" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#lebar' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung8" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#t_panggung' ) . html ( data ) ;
		} ) ;
		
		
		
	}else{
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung1" , { option : "" } , function ( data ) {
			$( '#tempat' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung2" , { option : "" } , function ( data ) {
			$( '#alamat' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung3" , { option : "" } , function ( data ) {
			$( '#kota' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung4" , { option : "" } , function ( data ) {
			$( '#provinsi' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung5" , { option : "" } , function ( data ) {
			$( '#panjang' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung6" , { option : "" } , function ( data ) {
			$( '#tinggi' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung7" , { option : "" } , function ( data ) {
			$( '#lebar' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung8" , { option : "" } , function ( data ) {
			$( '#t_panggung' ) . html ( data ) ;
		} ) ;
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
	
	$(function() {
    $(".skills").autocomplete({
      source: '<?=base_url()?>/index.php/order/search'
	  });
    });
	
	$(function() {
    $(".skills2").autocomplete({
      source: '<?=base_url()?>/index.php/order/search2'
	  });
    });
	
	function hitung_ulang(id,id2){
		if($("#jenis_paket").val()!=""){
			var sesudah = parseInt($("#harganyax_"+id).val());
			if(sesudah >=0){
				sesudah = sesudah;
			}else{
				sesudah = 0;
				$.get( "<?= base_url(); ?>index.php/order/cari_hargax" , {option2 : id2,option3:id } , function ( data ) {
					$( '#harga_'+id ) . html (data) ;
				} ) ;
			}
			var tambahan = $("#harga_tambahan").val();
			var sebelum = $("#harganya_"+id).val();
			var paket = $("#harga").val();
			var discount = $("#discount").val();
			var tot_tambahan = parseInt(tambahan)-parseInt(sebelum) + parseInt(sesudah);
			var temp = ((parseInt(paket) + tot_tambahan) * parseInt(discount));
			var temp2 = temp / 100;
			var total = (parseInt(paket) + tot_tambahan)-temp2;
			document.getElementById('harganya_'+id).value = sesudah;
			document.getElementById('harga_tambahan').value = tot_tambahan;
			document.getElementById('total').value = total;
			document.getElementById('totalx2').value = total.toLocaleString('en-US', {minimumFractionDigits: 0});
			
			var max = parseInt($("#max").val());
			if(discount > max){
				var discount = max;
				var tot_tambahan = parseInt(tambahan)-parseInt(sebelum) + parseInt(sesudah);
				var temp = ((parseInt(paket) + tot_tambahan) * parseInt(discount));
				var temp2 = temp / 100;
				var total = (parseInt(paket) + tot_tambahan)-temp2;
				document.getElementById('discountxx').value = max.toLocaleString('en-US', {minimumFractionDigits: 0});
				document.getElementById('totalapp').value = total.toLocaleString('en-US', {minimumFractionDigits: 0});
			}
		}
	}
	
	function cari_harga(id,id2,$check=""){
		if($("#jenis_paket").val()==""){
			var barang = $("#skill_"+id).val();
			if(barang==""){
				$.get( "<?= base_url(); ?>index.php/order/cari_hargax" , { option : barang, option2 : id2,option3:id } , function ( data ) {
					$( '#harga_'+id ) . html (data) ;
				} ) ;

			}else{
				$.get( "<?= base_url(); ?>index.php/order/cari_harga" , { option : barang, option2 : id2,option3:id } , function ( data ) {
					$( '#harga_'+id ) . html (data) ;
				} ) ;
			}
			/*$ (document).ready(function(){
				$.ajax({
					url: "<?= base_url(); ?>index.php/order/tessss/"+barang,
					type:'POST',
					contentType: 'application/json',
					dataType: 'json',
					success: function(result){
						console.log(result);
						//alert(result);
						//rubah total, harga, 
						var temp = $("#harga").val();
						var temp2 = result;
						var tot = $("#total").val();
						if(temp >=0){
							temp = temp;
							tot  = tot;
						}else{
							temp = 0;
							tot  = 0;
						}
						var temp3 = parseInt(temp)+parseInt(temp2);
						var tot2 = parseInt(tot) + parseInt(temp3);
						document.getElementById('harga').value=temp3;
						document.getElementById('total').value=tot2;
						document.getElementById('totalx2').value=tot2;
					}
				});
			}); */
			
		}else{
			var xxx = parseInt($("#harganyax_"+id).val());
			var xxx2 = parseInt($("#harganya_"+id).val());
			var harga_tambah = 0;
			var jum_area = parseInt($("#count_area").val());
			for(i=1;i<=jum_area;i++){
				var tempx = $("#harganyax_"+i).val();
				if(tempx > 0){
					harga_tambah = harga_tambah + parseInt(tempx);
				}
			}
			
			var barang = $("#skill_"+id).val();
			if(barang==""){
				$.get( "<?= base_url(); ?>index.php/order/cari_hargax" , { option : barang, option2 : id2,option3:id } , function ( data ) {
					$( '#harga_'+id ) . html (data) ;
				} ) ;

			}else{
				$.get( "<?= base_url(); ?>index.php/order/cari_harga" , { option : barang, option2 : id2,option3:id } , function ( data ) {
					$( '#harga_'+id ) . html (data) ;
				} ) ;
			}
			
			//kondisi kalo ada penambahan
			if(xxx != xxx2){
				$.get( "<?= base_url(); ?>index.php/order/cari_harga_tambah" , { option : barang, option2 : id2,option3:id,option4 : harga_tambah } , function ( data ) {
					$( '#harga_tambah_td') . html (data) ;
				} ) ;
			}else if(xxx == xxx2 && xxx == '0'){
				$.get( "<?= base_url(); ?>index.php/order/cari_harga_tambah" , { option : barang, option2 : id2,option3:id,option4 : harga_tambah } , function ( data ) {
					$( '#harga_tambah_td') . html (data) ;
				} ) ;
			}
			
			var ganti = parseInt($("#harganya_"+id).val());
			var harga_tot_sebelum = parseInt($("#harga").val());
			var harga_baru = harga_tot_sebelum;
			if($("#harganya_"+id).val() == ''){
				ganti = 0;
			}
			if($("#harga").val() == ''){
				harga_tot_sebelum = 0;
			}
			
			if(xxx != xxx2){
				harga_baru = harga_tot_sebelum - ganti;
			}
			
			/* if($("#harganyax_"+id).val() != "" || $("#harganyax_"+id).val() != "0"){
				if(parseInt($("#harganyax_"+id).val()) > 0 && parseInt($("#harganyax_"+id).val()) == parseInt($("#harganya_"+id).val())){
					var harga_ganti = $("#harganyax_"+id).val();
					var harganya_ = $("#harganya_"+id).val();
					harga_baru = harga_baru - (harga_ganti - harganya_);
				}
			} */
			
			if(xxx > 0 && xxx == xxx2){
				harga_baru = harga_baru + xxx - xxx2;
				harga_tambah = harga_tambah - xxx;
				$.get( "<?= base_url(); ?>index.php/order/cari_harga_tambah" , { option : barang, option2 : id2,option3:id,option4 : harga_tambah} , function ( data ) {
					$( '#harga_tambah_td') . html (data) ;
				} ) ;
			}
			  
			
			
			var skill_temp = $("#harga").val();
			
			var harga_paket = skill_temp;
			var harga_paket = parseFloat(harga_paket);
			var discount = parseFloat($("#discount").val());
			if($("#discount").val() == ""){
				discount = 0;
			}
			var max = parseFloat($("#max").val());
			if(discount > max){
				document.getElementById('discountxx').value=max;
				document.getElementById('discount').value=discount;
				discount2 = max;
				document.getElementById('discountapp').style.display='initial';
				$.get( "<?= base_url(); ?>index.php/order/cari_harga_disk" , { option : barang, option2 : id2,option3:id,option4 : harga_tambah,option5 : max,option6 : harga_paket} , function ( data ) {
					$( '#totalapp_td') . html (data) ;
				} ) ;
			}else{
				discount2 = discount;
				document.getElementById('discountxx').value='0';
				document.getElementById('totalapp').value='0';
				document.getElementById('discountapp').style.display='none';
				//document.getElementById('totapp').style.display='none';
			}
			//kondisi jika ada penambahan kemudian dirubah kembali
			$.get( "<?= base_url(); ?>index.php/order/cari_harga_tambah2" , { option : barang, option2 : id2,option3:id,option4 : harga_tambah,option5 : discount,option6 : harga_paket} , function ( data ) {
				$( '#total_td') . html (data) ;
			} ) ;
		}
	}
</script>