<?php
	$data_paket = $this->master_model->get_list_paket();
	foreach($data_penawaran as $row6){
		$kd_penawaran	= $row6->id_penawaran;
		$pria			= $row6->pengantin_pria;
		$wanita			= $row6->pengantin_wanita;
		$tgl_resepsi	= $row6->tanggal_respsi;
		$jam_resepsi	= $row6->jam_resepsi;
		$tempat1		= $row6->pengantin_wanita;
		$tempat2		= $row6->pengantin_wanita;
		$tempat3		= $row6->pengantin_wanita;
		$color_tone		= $row6->color_tone;
		$tema			= $row6->tema; 
		$tambahan_paket	= $row6->tambahan_paket; 
		$harga			= $row6->harga;
		$harga_deal		= $row6->harga_deal;
		$discount		= $row6->discount;
		$harga_paket	= $row6->harga_paket;
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
		$harga_app		= $row6->harga_app;
		$diskon_app		= $row6->diskon_app;
		if($inc_gedung == "yes"){
			$che = "checked";
			$re = "readonly";
		}else{
			$che = "";
			$re = "";
		}
		if($harga_app > 0){
			$harga = $harga_app;
			$discount = $diskon_app;
		}
	}
	foreach($data_prospek as $rowp){
		$telfon			= $rowp->telfon;
		$telfon2		= $rowp->telfon2;
		$email			= $rowp->email1;
		$email2			= $rowp->email2;
		$id_prospek		= $rowp->id_prospek;
	}
	$q = $this->db->query("select c_customer from dk_counter");
	if($q->num_rows() > 0){
		$ret = $q->result();
		$kode			= $ret[0]->c_customer+1;
		if(strlen($kode)==1){
			$kdadd		= "0000";
		}else if(strlen($kode)==2){
			$kdadd		= "000";
		}else if(strlen($kode)==3){
			$kdadd		= "00";
		}else if(strlen($kode)==4){
			$kdadd		= "0";
		}else{
			$kdadd		= '0';
		}
		$kd_customer	= "C".date("ym")."|".$kdadd.$kode;
	}
?>
<?php $this->load->view('header');?>
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
					<?php
					if($proses == 1){
					?>
						<form action="<?=base_url()?>index.php/order/save_customer" method="post">
					<?php
					}else{
						$kd_customer = $id_cust;
						$tgl_input = $this->order_model->tgl_input($id_cust);
					
					?>
						<form action="<?=base_url()?>index.php/order/save_customer_edit" method="post"> <!-- arah proses -->
					<?php
					}
					?>
					<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Penawaran</b></td>
							<td><input type="text"  class="form-control"  name="kd_penawaran" id="kd_penawaran" value="<?=$kd_penawaran?>" readonly></td>
							<td><b>Color Tone</b></td>
							<td><input type="text"  class="form-control"  name="color_tone" id="color_tone" readonly value="<?=$color_tone?>" ></td>
						</tr>
						<tr>
							<td><b>ID Prospek</b></td>
							<td><input type="text"  class="form-control"  name="id_prospek" id="id_prospek" value="<?=$kd_prospek?>" readonly></td>
							<td><b>Tema Spesifik yang diingikan</b></td>
							<td><input type="text"  class="form-control"  name="tema" id="tema" value="<?=$tema?>" readonly></td>
						</tr>
						<tr>
							<td><b>Nomor Customer</b></td>
							<td><input type="text"  class="form-control"  name="nocust" id="nocust" value="<?=$kd_customer?>" readonly></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Tanggal Deal</b></td>
							<td><input type="text"  class="form-control" name="tgl_input" id="datepicker" readonly format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" value="<?=date("d-M-Y")?>" readonly></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Pria</b></td>
							<td><input type="text"  class="form-control" id="pria" name="pria" readonly value="<?=$pria?>"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Nama Calon Pengantin Wanita</b></td>
							<td><input type="text"  class="form-control" name="wanita" id="wanita" readonly  value="<?=$wanita?>"></td>
							<td><b>Nama Tempat</b></td>
							<td id="tempat"><input type="text"  class="form-control" name="aaaaa" readonly id="aaaaa" value="<?=$tempat1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Telpon / HP</b></td>
							<td><input type="text" name="telfon"  class="form-control" id="telfon" readonly value="<?=$telfon?>"></td>
							<td><b>Alamat Resepsi</b></td>
							<td id="alamat"><input type="text"  class="form-control" name="alamat" readonly id="alamat1"  value="<?=$tempat_r1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Email 1</b></td>
							<td><input type="text" name="email"  class="form-control" id="email" readonly value="<?=$email?>"></td>
							<td><b>Kota / Kabupaten</b></td>
							<td id="kota"><input type="text"  class="form-control" name="kota" readonly id="kota1"  value="<?=$tempat_r2?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Email 2</b></td>
							<td><input type="text" name="email2"  class="form-control" id="email2" readonly value="<?=$email2?>"></td>
							<td><b>Provinsi</b></td>
							<td id="provinsi"><input type="text"  class="form-control" name="provinsi" readonly id="provinsi1"  value="<?=$provinsi1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Tanggal Resepsi</b></td>
							<td><input type="text" name="tgl_resepsi"  class="form-control" id="tgl_resepsi" readonly value="<?=date("d M Y",strtotime($tgl_resepsi))?>"></td>
							<td colspan="2" align="center"><b>Spesifikasi Panggung</b></td>
						</tr>
						<tr>
							<td><b>Jam Resepsi</b></td>
							<td><input type="text" name="jam_resepsi"  class="form-control" id="jam_resepsi" readonly value="<?=$jam_resepsi?>"></td>
							<td><b>Tinggi Panggung</b></td>
							<td id="t_panggung"><input type="text"  class="form-control" name="t_panggung" readonly id="t_panggung1"  value="<?=$t_panggung1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td><b>Alamat</b></td>
							<td><input type="text" name="tempat1"  class="form-control" id="tempat1a" readonly value="<?=$alamat1?>"></td>
							<td><b>Panjang</b></td>
							<td id="panjang"><input type="text"  class="form-control" name="panjang" readonly id="panjang1"  value="<?=$panjang1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="text" name="tempat2"  class="form-control" id="tempat2" readonly value="<?=$kota1?>"></td>
							<td><b>Tinggi</b></td>
							<td id="tinggi"><input type="text"  class="form-control" name="tinggi" readonly id="tinggi1"  value="<?=$tinggi1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="text" name="tempat3"  class="form-control" id="tempat3" readonly value="<?=$tempat_r3?>"></td>
							<td><b>Lebar</b></td>
							<td id="lebar"><input type="text"  class="form-control" name="lebar" readonly id="lebar1"   value="<?=$lebar1?>" <?=$re?>></td>
						</tr>
						<tr>
							<td colspan="4" style="background:lightgray;" align="center"><b>SPESIFIKASI PEMBAYARAN</b></td>
						</tr>
						<tr>
							<td><b>Harga Paket</b></td>
							<td>
								<input type="text" value="<?=number_format($harga_paket)?>" readonly class="form-control">
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Harga Tambahan Paket</b></td>
							<td>
								<input type="text" value="<?=number_format($tambahan_paket)?>" readonly class="form-control">
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Discount</b></td>
							<td>
								<input type="text" value="<?=number_format($discount)?>" readonly class="form-control">
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Harga Penawaran</b></td>
							<td>
								<input type="text" value="<?=number_format($harga)?>" readonly class="form-control">
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Sudah Dibayar</b></td>
							<td>
								<?php
									$sudah_bayar = $this->order_model->get_bayar_invoice($kd_customer);
								?>
								<input type="text" value="<?=number_format($sudah_bayar)?>"  readonly class="form-control">
								<input type="hidden" value="<?=$sudah_bayar?>" name="sudah_bayar" id="sudah_bayar" readonly class="form-control">
							</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><b>Total Deal (Rp.)</b></td>
							<td>
								<?php
									if($proses == 1){//1 artinya input
								?>
								<!-- update by Rindra RABU 31-07-2019 --> 
									<input type="text" readonly value="<?=(number_format($harga))?>" onkeypress="return isNumber(event)" name="tot_deal" id="tot_deal" class="form-control">
								<!--	
									<input type="text" readonly value="<?=(number_format($harga_deal))?>" onkeypress="return isNumber(event)" name="tot_deal" id="tot_deal" class="form-control">
								-->
								<?php
									}else{//0 artinya edit customer
									//$harga = $this->order_model->get_harga($id_cust);
								?>
								<!-- update by Rindra RABU 31-07-2019 -->
									<input type="text" readonly value="<?=(number_format($harga))?>" onkeypress="return isNumber(event)" name="tot_deal" id="tot_deal" class="form-control">
								<!-- update by Rindra 
									<input type="text" readonly value="<?=(number_format($harga_deal))?>" onkeypress="return isNumber(event)" name="tot_deal" id="tot_deal" class="form-control">
								-->
								<?php
									}
								?>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4" height="40px"></td>
						</tr>
						<tr>
							<td><b>Jenis Paket Dekor</b></td>
							<td colspan="4">
								<?php
									if($data_paket > 0){
										foreach($data_paket as $row){
											if($jenis_paket == $row->id_paket){
												$nm_paket = $row->nm_paket;
											}
										}
									}
									
								?>
								<div class="col-lg-4">
								<input type="text" class="form-control" value="<?=$nm_paket?>" readonly>
								</div>
								<div class="col-lg-3">
									<input type="checkbox" disabled value="yes" <?=$che?> name="inc_gedung" id="inc_gedung">
									Include Gedung
								</div>
								<input type="hidden" value="<?=$jenis_paket?>" name="jenis_paket" id="jenis_paket">
								<input type="hidden" class="form-control" value="yes" <?=$che?> name="inc_gedung" id="inc_gedung">
							</td>
						</tr>
					</table>
					<div id="input_temp"></div>
					<table class="table table-striped table-bordered" style="border:2px" width="100%" id="tabel_paket">
						<tbody>
						<tr class="bg-green disabled color-palette">
							<th width="25%">Area</td><th width="35%">Spesifikasi Dekor</th><th width="25%">Keterangan</th><th width="30%">Harga</th>
						</tr>
						<?php
						$data_area = $this->order_model->get_area_penawaran($id_prospek);
						$no=0;
						if($data_area > 0){
							foreach($data_area as $row){
							$count_area = $this->order_model->count_area($row->id_area,$id_prospek);
						?>
						<tr>
							
							<td><?php if($row->no==0){echo "<b>".$row->nm_area."</b>";}?></td>
							<td><?=$row->keterangan?></td>
							<td><?=$row->spesifikasi?></td>
							<td align="right"><?php if($row->harga!=0){echo number_format($row->harga);}?></td>
						<tr>
						<?php
							$no++;
							}
						}
						?>
					</table>
					<table width="100%" class="table table-bordered">
						<tr style="background-color:gray">
							<td colspan="4" align="right"></td>
						</tr>
						<tr>
							<td colspan="4" align="right" ><input type="submit" onclick="return check()" class="btn btn-success pull-right" name="submit" value="Save"></td>
						</tr>
					</table>
					</form>
				</div>
			</div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
	function check(){
		if($("#tot_deal").val() < $("#sudah_bayar").val()){
			alert("Total deal tidak boleh lebih kecil dari jumlah pembayaran sebelumnya !");
			return false;
		}
	}

function save(){
		$.post( "<?= base_url(); ?>index.php/order/save_customer", {
		kd_penawaran : $("#kd_penawaran").val(),
		id_prospek : $("#id_prospek").val(),
		nocust : $("#nocust").val(),
		deal : $("#deal").val(),//format date
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
		harga : $("#harga").val()
		} , function ( data ) {
			$( '#message' ) . html ( data ) ;
		} ) ;
}
$(document).ready(function(){
	$('#datepicker').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
</script>
