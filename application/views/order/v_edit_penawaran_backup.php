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
?>
<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog modal-ex-lg" style="display:show;">
		<div class="modal-content modal-lg">
			<div class="modal-header modal-lg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Penawaran</h4>
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
							<td><b>Tanggal Input</b></td>
							<td><input type="text" name="tgl_input" id="tgl_input" value="<?=date("d-M-Y")?>" readonly></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Pria</b></td>
							<td><input type="text" id="pria" name="pria" value="<?=$pria?>" readonly></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Wanita</b></td>
							<td><input type="text" name="wanita" id="wanita" value="<?=$wanita?>" readonly></td>
							<td><b>Nama Tempat</b></td>
							<td id="tempat"><input type="text" name="aaaaa" id="aaaaa" value="<?=$tempat1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Telpon / HP</b></td>
							<td><input type="text" name="telfon" id="telfon" value="<?=$telfon?>" readonly></td>
							<td><b>Alamat</b></td>
							<td id="alamat"><input type="text" name="alamat" id="alamat1"  value="<?=$alamat1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Email 1</b></td>
							<td><input type="text" name="email" id="email" value="<?=$email?>" readonly></td>
							<td><b>Kota / Kabupaten</b></td>
							<td id="kota"><input type="text" name="kota" id="kota1"  value="<?=$kota1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Email 2</b></td>
							<td><input type="text" name="email2" id="email2" value="<?=$email2?>" readonly></td>
							<td><b>Provinsi</b></td>
							<td id="provinsi"><input type="text" name="provinsi" id="provinsi1"  value="<?=$provinsi1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Tanggal Resepsi</b></td>
							<td><input type="text" name="tgl_resepsi" id="tgl_resepsi" value="<?=$tgl_resepsi?>" readonly></td>
							<td colspan="2" align="center"><b>Spesifikasi Panggung</b></td>
						</tr>
						<tr>
							<td><b>Tempat Resepsi</b></td>
							<td><input type="text" name="tempat1" id="tempat1a" value="<?=$tempat_r1?>" readonly></td>
							<td><b>Panjang</b></td>
							<td id="panjang"><input type="text" name="panjang" id="panjang1"  value="<?=$panjang1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="text" name="tempat2" id="tempat2" value="<?=$tempat_r2?>" readonly></td>
							<td><b>Tinggi</b></td>
							<td id="tinggi"><input type="text" name="tinggi" id="tinggi1"  value="<?=$tinggi1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="text" name="tempat3" id="tempat3" value="<?=$tempat_r3?>" readonly></td>
							<td><b>Lebar</b></td>
							<td id="lebar"><input type="text" name="lebar" id="lebar1"   value="<?=$lebar1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Jam Resepsi</b></td>
							<td><input type="text" name="jam_resepsi" id="jam_resepsi" value="<?=$jam_resepsi?>" readonly></td>
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
					<table class="table table-striped" style="border:2px" width="100%" id="tabel_paket">
						<tbody>
						<tr class="bg-green disabled color-palette">
							<th width="25%">Area</td><th width="40%">Keterangan</th><th width="40%">Spesifikasi Dekor</th><th width="40%">Harga</th>
						</tr>
						<?php
						if($data_tambahan_min > 0 ){
							foreach($data_tambahan_min as $row9){
								$data_barang[] = $row9->id_barang;
							}
						}else{
							$data_barang = array();
						}
						if($data_kategori_min > 0 ){
							foreach($data_kategori_min as $rowx){
								$kategori_min[] = $rowx->id_kategori;
							}
						}else{
							$kategori_min = array();
						}
						$j=0;
						if($data_kategori > 0){
							foreach($data_kategori as $row3){
								$id_kategori = $row3->id_kategori;
								if(in_array($id_kategori,$kategori_min)){
									$sele = "selected";
								}else{
									$sele = "";
								}
								$data_kat_det = $this->master_model->kategori_detail($id_kategori);
						?>
								<tr>
									<td width="25%">
									<b><?=$row3->nm_kategori?></b>
									<select name="inc_kategori[]">
										<option value="2<?=$id_kategori?>">Yes</option>
										<option value="1<?=$id_kategori?>" <?=$sele?>>No</option>
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
												<td width="10%">
												<select name="inc_barang[]" id="inc_barang">
												<?php
												if(in_array($row4->id_barang,$data_barang)){
												?>
													<option value="2<?=$row4->id_barang?>">Yes</option>
													<option value="1<?=$row4->id_barang?>" selected>No</option>
												<?php
												}else{
												?>
													<option value="2<?=$row4->id_barang?>" selected>Yes</option>
												<option value="1<?=$row4->id_barang?>">No</option>
												<?php }?>
												</select></td>
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
					<table class="table table-striped" width="100%" >
						<tr class="bg-orange disabled color-palette">
							<th style="text-align:center">Area</th>
							<th style="text-align:center">Nama Barang</th>
							<th style="text-align:center" width="33%">Jumlah Barang</th>
							<th style="text-align:left">Option</th>
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
							<a href="#" class="form-group has-success col-lg-2 remove_field"><button class="btn btn-primary add_field_button">&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button></a>
						</div>
						<div class="input_fields_wrap"></div>
					<table width="100%" style="background-color:gray" class="table table-hover">
						<tr style="background-color:gray">
							<td colspan="3" align="right"></td><td align="right"><input placeholder="Rp." type="text" name="harga" id="harga" value="<?=$harga?>"></td>
						</tr>
					</table>
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
		$.post( "<?= base_url(); ?>index.php/order/save_penawaran_edit" , {
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
		t_panggung1 : $("#t_panggung1").val(),
		jenis_paket : $("#jenis_paket").val(),
		inc_gedung : $("#inc_gedung").val(), 
		nm_barang : values_barang,
		qty : values_qty,
		area : area,
		inc_barang : values_inc,
		kategori : kategori,
		harga : $("#harga").val()
		} , function ( data ) {
			$( '#message' ) . html ( data ) ;
		} ) ;
	}
}
function hapus_barang(id_barang,urutan,penawaran1,penawaran2){
	if (confirm('Hapus barang ?')) {
			$.get( "<?= base_url(); ?>index.php/order/hapus_barang" , { option : id_barang, option2 : penawaran1, option3 : penawaran2 } , function ( data ) {
				$( '#div_hapus_'+urutan) . html ( data ) ;
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
	if($("#inc_gedung").val()=='yes')
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
