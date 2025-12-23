<?php
	$data_paket = $this->master_model->get_list_paket();
	foreach($data_penawaran as $row6){
		$color_tone		= $row6->color_tone;
		$tema			= $row6->tema; 
		$harga			= $row6->harga;
		$tempat_r1		= $row6->tempat_resepsi1;
		$tempat_r2		= $row6->tempat_resepsi2;
		$tempat_r3		= $row6->tempat_resepsi3;
		$tempat1		= $row6->tempat1;
		$alamat1		= $row6->alamat1;
		$kota1			= $row6->kota1;
		$provinsi1		= $row6->provinsi1;
		$panjang1		= $row6->panjang1;
		$tinggi1		= $row6->tinggi1;
		$lebar1			= $row6->lebar1;
		$t_panggung1	= $row6->t_panggung1;
		$inc_gedung		= $row6->inc_gedung;
		$jenis_paket	= $row6->jenis_paket;
		if($inc_gedung == "yes"){
			$che = "checked";
			$re = "readonly";
		}else{
			$che = "";
			$re = "";
		}
	}
	if($data_prospek > 0){
		foreach($data_prospek as $row){
			$pria 		= $row->calon_pria;
			$wanita 	= $row->calon_wanita;
			$telfon 	= $row->telfon;
			$telfon2 	= $row->telfon2;
			$email1 	= $row->email1;
			$email2 	= $row->email2;
			$jam_resepsi 	= $row->resepsi_jam;
			$tgl_resepsi 	= $row->resepsi_date;
		}
	}
	if($data_customer > 0){
		foreach($data_customer as $row2){
			$dp1 			= $row2->dp1;
			$via_dp1 		= $row2->via_dp1;
			$tanggal_dp1 	= date("d-M-Y",strtotime($row2->tanggal_dp1));
			$dp2 			= $row2->dp2;
			$via_dp2 		= $row2->via_dp2;
			$tanggal_dp2 	= date("d-M-Y",strtotime($row2->tanggal_dp2));
			$tanggal_dp2x 	= date("d-M-Y",strtotime($row2->tanggal_dp2));
			$dp3 			= $row2->dp3;
			$via_dp3 		= $row2->via_dp3;
			$tanggal_dp3 	= date("d-M-Y",strtotime($row2->tanggal_dp3));
			$dp4 			= $row2->dp4;
			$via_dp4 		= $row2->via_dp4;
			$tanggal_dp4 	= date("d-M-Y",strtotime($row2->tanggal_dp4));
			$piutang 		= $row2->piutang;
			$rea = "readonly";
			if(date("Y-m-d",strtotime($tanggal_dp1)) < date("Y-m-d",strtotime("-240 month",strtotime(date("Y-m-d"))))){
				$tanggal_dp1 = "";
			}
			if(date("Y-m-d",strtotime($tanggal_dp2)) < date("Y-m-d",strtotime("-240 month",strtotime(date("Y-m-d"))))){
				$tanggal_dp2 = "";
			}
			if(date("Y-m-d",strtotime($tanggal_dp3)) < date("Y-m-d",strtotime("-240 month",strtotime(date("Y-m-d"))))){
				$tanggal_dp3 = "";
			}
			if(date("Y-m-d",strtotime($tanggal_dp4))< date("Y-m-d",strtotime("-240 month",strtotime(date("Y-m-d"))))){
				$tanggal_dp4 = "";
			}
		}
	}
?>
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog modal-ex-lg" style="display:show;">
		<div class="modal-content modal-lg">
			<div class="modal-header modal-lg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit SPD</h4>
			</div>
				<div class="box-body table-responsive no-padding">
				<div id="message">
					<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Penawaran</b></td>
							<td><input type="text" name="kd_penawaran" id="kd_penawaran" value="<?=$kd_penawaran?>" readonly></td>
							<td><b>Color Tone</b></td>
							<td><input type="text" name="color_tone" id="color_tone" value="<?=$color_tone?>" ></td>
						</tr>
						<tr>
							<td><b>ID Prospek</b></td>
							<td><input type="text" name="id_prospek" id="id_prospek" value="<?=$kd_prospek?>" readonly></td>
							<td><b>Tema Spesifik yang diingikan</b></td>
							<td><input type="text" name="tema" id="tema" value="<?=$tema?>"></td>
						</tr>
						<tr>
							<td><b>Tanggal Edit</b></td>
							<td><input type="text" name="tgl_input" id="tgl_input" value="<?=date("d-M-Y")?>" readonly></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Pria</b></td>
							<td><input type="text" id="pria" name="pria" value="<?=$pria?>"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Wanita</b></td>
							<td><input type="text" name="wanita" id="wanita" value="<?=$wanita?>"></td>
							<td><b>Nama Tempat</b></td>
							<td id="tempat"><input type="text" name="aaaaa" id="aaaaa" value="<?=$tempat1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Telpon / HP</b></td>
							<td><input type="text" name="telfon" id="telfon" value="<?=$telfon?>"></td>
							<td><b>Alamat</b></td>
							<td id="alamat"><input type="text" name="alamat" id="alamat1"  value="<?=$alamat1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Email 1</b></td>
							<td><input type="text" name="email" id="email" value="<?=$email1?>"></td>
							<td><b>Kota / Kabupaten</b></td>
							<td id="kota"><input type="text" name="kota" id="kota1"  value="<?=$kota1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Email 2</b></td>
							<td><input type="text" name="email2" id="email2" value="<?=$email2?>"></td>
							<td><b>Provinsi</b></td>
							<td id="provinsi"><input type="text" name="provinsi" id="provinsi1"  value="<?=$provinsi1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Tanggal Resepsi</b></td>
							<td><input type="text" name="tgl_resepsi" id="tgl_resepsi" value="<?=date("d-M-Y",strtotime($tgl_resepsi))?>" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy"></td>
							<td colspan="2" align="center"><b>Spesifikasi Panggung</b></td>
						</tr>
						<tr>
							<td><b>Tempat Resepsi</b></td>
							<td><input type="text" name="tempat1" id="tempat1a" value="<?=$tempat_r1?>"></td>
							<td><b>Panjang</b></td>
							<td id="panjang"><input type="text" name="panjang" id="panjang1"  value="<?=$panjang1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="text" name="tempat2" id="tempat2" value="<?=$tempat_r2?>"></td>
							<td><b>Tinggi</b></td>
							<td id="tinggi"><input type="text" name="tinggi" id="tinggi1"  value="<?=$tinggi1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="text" name="tempat3" id="tempat3" value="<?=$tempat_r3?>"></td>
							<td><b>Lebar</b></td>
							<td id="lebar"><input type="text" name="lebar" id="lebar1"   value="<?=$lebar1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Jam Resepsi</b></td>
							<td class="input-append bootstrap-timepicker-component clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
							<input size="10" name="jam_resepsi" id="jam_resepsi" type="text" value="<?=$jam_resepsi?>" readonly placeholder="00:00"><i class="icon-time"></i>
							</td>
							<td><b>Tinggi Panggung</b></td>
							<td id="t_panggung"><input type="text" name="t_panggung" id="t_panggung1"  value="<?=$t_panggung1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td colspan="4" height="40px"></td>
						</tr>
						<tr>
							<td><b>Spesifikasi Dekor</b></td>
							<td colspan="4">
								<select name="jenis_paket" id="jenis_paket"  onchange="return pilih_paket()">
									<option value=""> Pilih Paket </option>
									<?php
									if($data_paket > 0){
										foreach($data_paket as $row){
											if($jenis_paket == $row->id_paket){
												echo "<option value='".$row->id_paket."' selected>".$row->nm_paket."</option>";
											}else{
												echo "<option value='".$row->id_paket."'>".$row->nm_paket."</option>";
											}
										}
									}
									
									?>
								</select>
								<label id="inc_gedungx">
								Include Gedung : <select onchange="return inc_gedung()" name="inc_gedung" id="inc_gedung">
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
							</td>
						</tr>
					</table>
					<div id="input_temp"></div>
					<table width="100%" class="table table-bordered table-hover" id="tabel_paket">
						<tr>
							<th>Area</th>
							<th>Keterangan</th>
							<th>Spesifikasi Bunga</th>
							<th>Hargax</th>
						</tr>
						<?php
							$data_area = $this->order_model->get_area();
							if($data_area >0){
								foreach($data_area as $r_a){
								?>
								<tr>
									<td rowspan="<?=$r_a->jum?>" width="30%"><?=$r_a->nm_area?></td>
									<td width="30%"><input type="text" class="form-control" name="area_<?=$r_a->id?>_ket[]"></td>
									<td width="25%"><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]"></td>
									<td width="15%"><input type="text" class="form-control" name="area_<?=$r_a->id?>_harga[]"></td>
								</tr>
								<?php for($i=1;$i<=($r_a->jum-1);$i++){?>
									<tr>
										<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_ket[]"></td>
										<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]"></td>
										<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_harga[]"></td>
									</tr>
									<?php } ?>
									<td style="background-color:#876dda" colspan="4"></td>
								<?php
								}
							}
						?>
					</table>
					<table class="table table-striped" width="100%" >
						<tr class="bg-orange disabled color-palette">
							<th style="text-align:center">Nama Barang</th>
							<th style="text-align:center">Jumlah Barang</th>
							<th style="text-align:center">Option</th>
						</tr>
					</table>
					<?php
						if($data_tambahan > 0){
							$k=0;
							foreach($data_tambahan as $row8){
							$k++;
							$kd_penawaran_edit1 = substr($kd_penawaran,1);
							$kd_pen = explode("|",$kd_penawaran_edit1);
							$kd_pen1 = $kd_pen[0];
							$kd_pen2 = $kd_pen[1]+0;
						?>
						<div id="div_hapus_<?=$k?>">
							<div class="form-group has-success col-lg-2">
								<input type="text" class="form-control" id="area" value ="<?=$row8->keterangan?>" name="area[]" placeholder="Masukan Area">
							</div>
							<div class="form-group has-success col-lg-5 this_form">
							<input type="text" class="chosen-select form-control" data-placeholder="Choose a Location" tabindex="10" value="<?=$row8->nm_barang?>">
							<input type="hidden" name="nm_barang[]" data-placeholder="Choose a Location" value="<?=$row8->id_barang."+^".$row8->nm_barang?>">
							</div>
							<div class="form-group has-success col-lg-2">
							  <input type="text" class="form-control" placeholder="Masukan jumlah" name='qty[]' value="<?=$row8->jumlah?>">
							</div>
							<div class="form-group has-success col-lg-2">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="return hapus_barang(<?=$row8->id_barang.",".$k.",".$kd_pen1.",".$kd_pen2;?>)">Hapus</button>
							</div>
						</div>
						
						<?php }}?>
						<div class="form-group has-success col-lg-2">
							<input type="text" class="form-control" id="area" value ="" name="area[]" placeholder="Masukan Area">
						</div>
						<div class="form-group has-success col-lg-5 this_form">
						<select class="chosen-select form-control" name="nm_barang[]" id="nm_barang[]" data-placeholder="Choose a Location" tabindex="10">
								<option value="0">Pilih Barang</option>
								<?php
								if($list_kategori > 0){
									$i=0;
									foreach($list_kategori as $row){
										$i++;
										echo "<option value='".$row->id."+^".$row->nm_barang."'>".$row->nm_barang."</option>";
									}
									if($i>=20){
										$i=20;
									}
								}
								?>
							</select>
						</div>
						<div class="form-group has-success col-lg-2">
						  <input type="text" class="form-control" id="qty" name='qty[]' placeholder="Masukan jumlah " value="">
						</div>
						<div class="form-group has-success">
							<a href="#" class="form-group has-success col-lg-2 remove_field"><button class="btn btn-primary add_field_button">Tambah</button></a>
						</div>
						<div class="input_fields_wrap"></div>
					<table width="100%" style="background-color:gray" class="table table-hover">
						<tr style="background-color:gray">
							<td colspan="3" align="right"></td><td align="right"><input placeholder="Rp." type="text" name="harga" id="harga" value="<?=$harga?>"></td>
						</tr>
					</table>
					<?php
					if($data_customer > 0){
					?>
					<table class="table table-striped" style="border:2px" width="100%" id="tabel_paket">
						<tbody>
						<tr class="bg-aqua disabled color-palette">
							<th colspan="6" style="text-align:center">Update Pembayaran</th>
						</tr>
						<?php
						if($dp1 == ""){
						?>
						<tr>
							<td>DP 1</td>
							<td><input type="text" name="dp1" id="dp1"></td>
							<td>Tanggal DP1</td>
							<td><input type="text" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" name="tgl_dp1" id="tgl_dp1"></td>
							<td>Via DP1</td>
							<td><input type="text" name="via_dp1" id="via_dp1"></td>
						</tr>
						<?php
						}else{
						?>
						<tr>
							<td>DP 1</td>
							<td><input type="text" name="dp1" id="dp1" value="<?=$dp1?>"></td>
							<td>Tanggal DP1</td>
							<td><input type="text" name="tgl_dp1" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" id="tgl_dp1" value="<?=$tanggal_dp1?>"></td>
							<td>Via DP1</td>
							<td><input type="text" name="via_dp1" id="via_dp1" value="<?=$via_dp1?>"></td>
						</tr>
						<?php }
						if($dp2 == ""){
						?>
						<tr>
							<td>DP 2</td>
							<td><input type="text" name="dp2" id="dp2"></td>
							<td>Tanggal DP2</td>
							<td><input type="text" name="tgl_dp2" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" id="tgl_dp2"></td>
							<td>Via DP2</td>
							<td><input type="text" name="via_dp2" id="via_dp2"></td>
						</tr>
						<?php
						}else{
						?>
						<tr>
							<td>DP 2</td>
							<td><input type="text" name="dp2" id="dp2" value="<?=$dp2?>"></td>
							<td>Tanggal DP2</td>
							<td><input type="text" name="tgl_dp2" id="tgl_dp2" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" value="<?=$tanggal_dp2?>"></td>
							<td>Via DP2</td>
							<td><input type="text" name="via_dp2" id="via_dp2" value="<?=$via_dp2?>"></td>
						</tr>
						<?php }
						if($dp3 == ""){
						?>
						<tr>
							<td>DP 3</td>
							<td><input type="text" name="dp3" id="dp3"></td>
							<td>Tanggal DP3</td>
							<td><input type="text" name="tgl_dp3" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" id="tgl_dp3"></td>
							<td>Via DP3</td>
							<td><input type="text" name="via_dp3" id="via_dp3"></td>
						</tr>
						<?php
						}else{
						?>
						<tr>
							<td>DP 3</td>
							<td><input type="text" name="dp2" id="dp3" value="<?=$dp3?>"></td>
							<td>Tanggal DP3</td>
							<td><input type="text" name="tgl_dp3" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" id="tgl_dp3" value="<?=$tanggal_dp3?>"></td>
							<td>Via DP3</td>
							<td><input type="text" name="via_dp3" id="via_dp3" value="<?=$via_dp3?>"></td>
						</tr>
						<?php }
						if($dp4 == ""){
						?>
						<tr>
							<td>DP 4</td>
							<td><input type="text" name="dp4" id="dp4"></td>
							<td>Tanggal DP4</td>
							<td><input type="text" name="tgl_dp4" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" id="tgl_dp4"></td>
							<td>Via DP4</td>
							<td><input type="text" name="via_dp4" id="via_dp4"></td>
						</tr>
						<?php
						}else{
						?>
						<tr>
							<td>DP 4</td>
							<td><input type="text" name="dp4" id="dp4" value="<?=$dp4?>"></td>
							<td>Tanggal DP4</td>
							<td><input type="text" name="tgl_dp4" id="tgl_dp4" class="tgl_resepsi" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" value="<?=$tanggal_dp4?>"></td>
							<td>Via DP3</td>
							<td><input type="text" name="via_dp4" id="via_dp4" value="<?=$via_dp4?>"></td>
						</tr>
						<?php }?>
						</tbody>
						<tr style="background-color:gray">
							<td colspan="5"><b style="text-color:white">Sisa Piutang (Rp.)</b></td>
							<td><input type="text" value="<?=number_format($piutang)?>" readonly></td>
						</tr>
					</table>
					<?php }else{?>
					 <div class="alert alert-warning alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-warning"></i> Alert!</h4>
						Data Customer belum diisi, silahkan update prospek untuk mengisi data customer.
					</div>
			  <?php }?>
					<div class="form-group has-success btn-group col-lg-6"></div>
						<div class="form-group has-success col-lg-6"  id="c_">
						<input type="button" name="submit" value="Save" class='pull-right btn btn-success' onClick="return save();">
						<button class="btn btn-default pull-right" type="button" data-dismiss="modal">Close</button>
					</div>
				<!-- /.box-body -->
			  </div>
			</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>
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
});
$(document).ready(function(){
$('.clockpicker').clockpicker()
		.find('input').change(function(){
			console.log(this.value);
		});
		var input = $('#single-input').clockpicker({
			placement: 'bottom',
			align: 'left',
			autoclose: true,
			'default': 'now'
		});
});
$(document).ready(function(){
	$('.tgl_resepsi').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
function save(){
	if($("#harga").val()==""){
		alert('silahkan isi harga paket');
		document.getElementById("harga").focus();
		return false;
	}else if($("#jenis_paket").val()==""){
		alert('silahkan pilih jenis paket');
		document.getElementById("jenis_paket").focus();
		return false;
	}else{
		var values_barang = [];
		var fields = document.getElementsByName("nm_barang[]");
		for(var i = 0; i < fields.length; i++) {
			values_barang.push(fields[i].value);
		}
		var values_qty = [];
		var fields = document.getElementsByName("qty[]");
		for(var i = 0; i < fields.length; i++) {
			values_qty.push(fields[i].value);
		}
		var values_inc = [];
		var fields = document.getElementsByName("inc_barang[]");
		for(var i = 0; i < fields.length; i++) {
			values_inc.push(fields[i].value);
		}
		var kategori = [];
		var fields = document.getElementsByName("inc_kategori[]");
		for(var i = 0; i < fields.length; i++) {
			kategori.push(fields[i].value);
		}
		var area = [];
		var fields = document.getElementsByName("area[]");
		for(var i = 0; i < fields.length; i++) {
			area.push(fields[i].value);
		}
		$.post( "<?= base_url(); ?>index.php/order/save_spd_edit" , {
		kd_penawaran : $("#kd_penawaran").val(),
		id_prospek : $("#id_prospek").val(),
		tgl_input : $("#tgl_input").val(),//format date
		pria : $("#pria").val(),
		wanita : $("#wanita").val(),
		telfon : $("#telfon").val(),
		email : $("#email").val(),
		email2 : $("#email2").val(),
		tgl_resepsi : $("#tgl_resepsi").val(),
		tempat1a : $("#tempat1a").val(),
		tempat2 : $("#tempat2").val(),
		tempat3 : $("#tempat3").val(),
		jam_resepsi : $("#jam_resepsi").val(),
		color_tone : $("#color_tone").val(),
		tema : $("#tema").val(),
		aaaaa : $("#aaaaa").val(),//15
		alamat1 : $("#alamat1").val(),
		kota1 : $("#kota1").val(),
		provinsi1 : $("#provinsi1").val(),
		panjang1 : $("#panjang1").val(),
		tinggi1 : $("#tinggi1").val(),
		lebar1 : $("#lebar1").val(),
		nm_barang : values_barang,
		qty : values_qty,
		inc_barang : values_inc,
		kategori : kategori,
		t_panggung1 : $("#t_panggung1").val(),
		jenis_paket : $("#jenis_paket").val(),
		inc_gedung : $("#inc_gedung").val(),
		area : area,
		harga : $("#harga").val(),
		dp1 : $("#dp1").val(),
		tgl_dp1 : $("#tgl_dp1").val(),
		via_dp1 : $("#via_dp1").val(),
		dp2 : $("#dp2").val(),
		tgl_dp2 : $("#tgl_dp2").val(),
		via_dp2 : $("#via_dp2").val(),
		dp3 : $("#dp3").val(),
		tgl_dp3 : $("#tgl_dp3").val(),
		via_dp3 : $("#via_dp3").val(),
		dp4 : $("#dp4").val(),
		tgl_dp4 : $("#tgl_dp4").val(),
		via_dp4 : $("#via_dp4").val()
		} , function ( data ) {
			$( '#message' ) . html ( data ) ;
		} ) ;
	}
}
function pilih_paket(){
	$.get( "<?= base_url(); ?>index.php/order/get_paket" , { option : $("#jenis_paket").val() } , function ( data ) {
		$( '#tabel_paket' ) . html ( data ) ;
	} ) ;
	$.get( "<?= base_url(); ?>index.php/order/inc_gedung" , { option : "" } , function ( data ) {
		$( '#inc_gedungx' ) . html ( data ) ;
	} ) ;
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
function inc_gedung(){
	if($("#inc_gedung").val() == 'yes')
	{
		$.get( "<?= base_url(); ?>index.php/order/inc_gedung1" , { option : $("#jenis_paket").val() } , function ( data ) {
			$( '#tempat' ) . html ( data ) ;
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
</script>
