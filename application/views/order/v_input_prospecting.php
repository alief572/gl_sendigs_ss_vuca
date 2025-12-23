<?php $this->load->view('header');?>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>dist/jquery.timepicker.css">
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
			<form method="post" action="<?=base_url()?>index.php/order/proses_input_prospek"> <!-- arah proses -->
              <table class="table table-bordered">
				<tr>
					<td width="25%">Tanggal Input</td><td>
					<input type="text" class="form-control" size='1' value="<?=date("d-M-Y")?>" readonly> <!-- tgl.saat ini -->
					<input type="hidden" class="form-control" size='1'id="tgl_input" name='tgl_input' value="<?=date("Y-m-d")?>">
					</td><td align='center' style="background-color:yellow;height:10px;"> 
						<h4><b>Progres Prospek</b></h4>
					</td>
				</tr>
				<tr>
					<td>Kode Prospek</td><td>
						<?php $kd_prospek	= $this->order_model->get_kode();?>
						<input type="text" class="form-control" size='1' name="kd_prospek" value="<?=$kd_prospek?>" readonly>
					</td><td><input type="radio" name="sts_progres" id='sts_progres1' value="Baru Tanya - Tanya">Baru Tanya - Tanya</td>
				</tr>
				<tr>
					<td>Nama Marketing</td>
					<td>
						<?php
						if($this->session->userdata('marketing') == "Y"){
							echo "<input type='text' readonly class='form-control' value='".$this->session->userdata('pn_name')."'>";
							echo "<input type='hidden' readonly name='marketing'  id='marketing'  class='form-control' value='".$this->session->userdata('pn_id')."+^".$this->session->userdata('pn_name')."'>";
						}else{
						?>
						<select name="marketing"  id="marketing"  class="form-control">
							<option value="0">-Pilih Marketing-</option>
						<?php
							if($data_marketing > 0){
								foreach($data_marketing as $rowm){
									if($this->session->userdata('pn_id')==$rowm->pn_id && $this->session->userdata('marketing')=="Y"){
										echo "<option selected value='".$rowm->pn_id."+^".$rowm->pn_name."'>".$rowm->pn_name."</option>";
									}else{
										echo "<option value='".$rowm->pn_id."+^".$rowm->pn_name."'>".$rowm->pn_name."</option>";
									}
								}
							}
						?>
						</select>
						<?php
						}
						?>
					</td>
					<td><input type="radio" name="sts_progres" id='sts_progres2' value="Sudah Diberi Penawaran">Sudah Diberi Penawaran</td>
				</tr>
				<tr>
					<td>Nama Calon Pengantin Pria</td>
					<td>
					<input type="text" class="form-control" size='1' name="pria" id="pria" value="">
					</td>
					<td align='center'>
					<?php 
						$id_prospek = $kd_prospek;
					$check_penwaran	= $this->order_model->check_penawaran($id_prospek);
					if($check_penwaran > 0){
						foreach($check_penwaran as $row5){
							$id_penawaran = $row5->id_penawaran;
							$id_penawaranx = str_replace("|","_",$id_penawaran);
							$id_penawaran = explode("|",$id_penawaran);
							$id_penawaran1 = substr($id_penawaran[0],1,4);
							$id_penawaran2 = $id_penawaran[1];
						}
					}
					?>
						<!--
						<a href="#" class="btn btn-warning" width="20%" onclick="return buat_penawaran(<?=$id_prospek?>)">Buat Penawaran</a>
						-->
						<a href="#" class="btn btn-warning" width="20%" onclick="return warning_alert()">Buat Penawaran</a>
					</td>
				</tr>
				<tr>
					<td>Nama Calon Pengantin Wanita</td>
					<td>
					<input type="text" class="form-control" size='1' name="wanita" id="wanita" value="">
					</td>
					<td><input type="radio" name="sts_progres" id='sts_progres3' value="Sudah Survey Lihat Dekor Prisilia">Sudah Survey Lihat Dekor Pisilia</td>
				</tr>
				<tr>
					<td>Telepon/HP</td>
					<td>
					<input type="text" class="form-control" size='1' name="telfon" id="telfon" value="">
					</td>
					<td>
					<?php 
						$check_id	= $this->order_model->check_id_prospek($kd_prospek);
					?>
					<input type="hidden" id='check_id' value="<?=$check_id?>">
					<input type="radio" name="sts_progres" id='sts_progres4' value="Sudah Deal">Sudah Deal &nbsp;&nbsp;
					</td>
				</tr>
				<tr>
					<td>Telepon/HP 2</td>
					<td>
					<input type="text" class="form-control" size='1' name="telfon2" id="telfon2" value="">
					</td>
					<td align="center">
						<div id="aku"></div>
						<a href="#" class="btn btn-default" width="20%" onclick="return warning()">Input Data Customer</a>
					</td>
				</tr>
				<tr>
					<td>Email 1</td>
					<td>
					<input type="text" class="form-control" size='1' id="email" name="email" value="">
					</td>
					<td><input type="radio" name="sts_progres" id='sts_progres5' value="Cancel Order">Cancel Order<br>
						<table>
							<tr>
								<td width="15%"></td><td>&nbsp;Alasan Cancel</td><td>&nbsp;&nbsp;&nbsp;&nbsp;
								<select name="alasan_cancel" id='alasan_cancel'>
									<option value="0">Pilih Alasan</option>
									<?php 
										foreach ($data_reason_cancel as $row) {
											echo "<option value='$row->alasan'>$row->alasan</option>";
										}
									?>
								</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>Email 2</td>
					<td>
					<input type="text" class="form-control" size='1' name="email2" id="email2" value="">
					</td>
					<td rowspan='2'>
					<input type="radio" name="sts_progres" id='sts_progres6' value="Lost Order">Lost Order<br>
						<table>
							<tr>
								<td></td><td>Nama Dekor Lain</td><td>&nbsp;&nbsp;&nbsp;&nbsp;
								<select name="nm_competitor" id='nm_competitor'>
									<?php
									echo "<option value='0'>Pilih Competitor</option>";
									if($data_competitor > 0){
										foreach($data_competitor as $row3){
											echo "<option value='".$row3->id."+^".$row3->nm_competitor."'>".$row3->nm_competitor."</option>";
										}
									}
									echo "<option value='Unknown Competitor'>Competitor Tidak Diketahui</option>";
									?>
								</select>
								</td>
							</tr>
							<tr>
								<td width="10%"></td><td>Alasan Lost Order</td><td>&nbsp;&nbsp;&nbsp;&nbsp;
								<select name="alasan_lost_order" id="alasan_lost">
									<option value='0'>Pilih Alasan Lost Order</option>
									<?php 
										foreach ($data_reason_lost_order as $row) {
											echo "<option value='$row->alasan'>$row->alasan</option>";
										}
									?>
									<option value='Lain-lain'>Lain - Lain</option>
								</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>Alamat Pengantin</td>
					<td>
					<input type="text" class="form-control" size='1' name="tempat1" id="tempat1" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td>Kota</td>
					<td>
					<input type="text" class="form-control" size='1' name="tempat2" id="tempat2" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td>Kode Pos</td>
					<td>
					<input type="text" class="form-control" size='1' name="tempat3"  id="tempat3" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td>Tanggal Resepsi</td>
					<td>
					<input type="text" class="form-control" size='1' id="datepicker" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" name="tgl_resepsi" value="">
					</td>
					<td></td>
				</tr>
				<tr>
					<td>Jam Resepsi</td>
					<td>
						<input size="10" name="jam_resepsi" id="jam_resepsi" type="text" class="form-control" value="" placeholder="00:00"><i class="icon-time"></i>
					</td>
				</tr>
				<tr>
					<td>Tempat Resepsi</td>
					<td>
						<input type="text" name="tempat_resepsi" class="form-control">
					</td>
					<td></td>
				</tr>
				<tr>
					<td>Sumber Prospek (beri tanda <i class='fa fa-check'></i>)</td>
					<td>
					<?php 
					if($data_ref > 0){
						$xx=0;
						foreach($data_ref as $row){
							$xx++;
							$id 	= $row->id_ref;
							$nm_ref = $row->nm_ref;
							echo "<input type='checkbox' id='sumber_$xx' onclick='return sumber($xx)' name='sumber[]' value='".$nm_ref."'>$nm_ref";
							if($id == "5"){
								echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Masukan Nama Socmed&nbsp;&nbsp;";echo "<select name='sosmed'>
								<option value='0'>Pilih Sosial media</option>
								";
								foreach($data_sosmed as $row2){
									echo "<option value='".$row2->id."+^".$row2->nm_sosmed."'>".$row2->nm_sosmed."</option>";
								}
								echo "</select>";
							}
							
							if($id == "6"){
								echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Masukan Nama Event&nbsp;&nbsp;";echo "<select name='event'>
								<option value='0'>Pilih Event</option>
								";
								foreach($data_event as $row4){
									echo "<option value='".$row4->id_event."+^".$row2->nm_event."'>".$row4->nm_event."</option>";
								}
								echo "</select>";
							}
							echo "<br>";
						}
					}
					?>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3" align="center"><input type="submit" class='btn btn-success btn-lg' name='submit' value='Save' onclick="return check();"></td>
				</tr>
              </table>
			  </form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>

<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>
<script>

	$('#jam_resepsi').timepicker({ 
		'timeFormat': 'H:i', 
		'step': 60 
	});
	
	function sumber(no){
		fCode = document.getElementsByName("sumber[]");
		var ceklis = 0;
		for ( var i = 0; i < fCode.length; i++ ){
			if ( fCode[i].checked == true) {
				ceklis++;
			}
		}
		if(ceklis > 1){
			alert('Sumber Hanya boleh satu');
			document.getElementById("sumber_"+no).checked=false;
		}
	}
  function check(){
	if($("#pria").val() == ''){
		alert('silahkan isi nama penganti pria');
		document.getElementById("pria").focus();
		return false;
	}else if($("#wanita").val() == ''){
		alert('silahkan isi nama penganti wanita');
		document.getElementById("wanita").focus();
		return false;
	}else if($("#telfon").val() == ''){
		alert('silahkan isi nomor telfon 1');
		document.getElementById("telfon").focus();
		return false;
	}else if($("#marketing").val() == '0'){
		alert('silahkan isi marketing');
		document.getElementById("marketing").focus();
		return false;
	}else if($("#sts_progres2").is(':checked')){
		if($("#check_penawaran").val() == '0'){
		alert('silahkan buat penawaran');
		document.getElementById("sts_progres2").focus();
		return false;
		}
	}else if($("#sts_progres3").is(':checked')){
		if($("#check_penawaran").val() == '0'){
		alert('silahkan buat penawaran');
		document.getElementById("sts_progres3").focus();
		return false;
		}
	}else if(($("#sts_progres4").is(':checked'))&&($("#check_id").val() == '0')){
		alert('silahkan isi data customer');
		document.getElementById("sts_progres4").focus();
		return false;
	}else if(($("#sts_progres5").is(':checked'))&&($("#alasan_cancel").val() == '0')){
		alert('silahkan Pilih alasan cancel');
		document.getElementById("sts_progres5").focus();
		return false;
	}else if(($("#sts_progres6").is(':checked'))&&($("#nm_competitor").val() == '0')){
		alert('silahkan Pilih nama competitor');
		document.getElementById("sts_progres6").focus();
		return false;
	}else if(($("#sts_progres6").is(':checked'))&&($("#alasan_lost").val() == '0')){
		alert('silahkan Pilih alasan lost');
		document.getElementById("sts_progres6").focus();
		return false;
	}
	if(($("#sts_progres1").is(':checked'))||($("#sts_progres2").is(':checked'))||($("#sts_progres3").is(':checked'))||($("#sts_progres4").is(':checked'))||($("#sts_progres5").is(':checked'))||($("#sts_progres6").is(':checked'))){
		return true;
	}else{
		alert('silahkan Pilih progres');
		document.getElementById("sts_progres1").focus();
		return false;
	}
}
function warning_alert(){
	alert('Simpan Isi Dan Simpan Terlebih Dahulu Form Prospecting');
	return false;
}
function buat_penawaran(kd_prospek){
$data = []
	$.get( "<?= base_url(); ?>index.php/order/buat_penawaran" , {
		option :kd_prospek,
		opt_data : {'pria':$("#pria").val(),'wanita':$("#wanita").val(),'telfon':$("#telfon").val(),'telfon2':$("#telfon2").val(),'email':$("#email").val(),'email2':$("#email2").val(),'tgl_resepsi':$("#datepicker").val(),'jam_resepsi':$("#jam_resepsi").val(),'tempat1':$("#tempat1").val(),'tempat2':$("#tempat2").val(),'tempat3':$("#tempat3").val()}
/* 		option1 :$("#pria").val(),
		option2 :$("#wanita").val(),
		option3 :$("#telfon").val(), 
		option4 :$("#telfon2").val(),
		option5 :$("#email").val(),
		option6 :$("#email2").val(),
		option7 :$("#tgl_resepsi").val(),
		option8 :$("#jam_resepsi").val(),
		option9 :$("#tempat1").val(),
		option10 :$("#tempat2").val(),
		option11 :$("#tempat3").val() */
		} , 
		function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
}
function warning(){
	alert('prospek belum disave dan penawaran belum dibuat !!');
	
	/* $.get( "<?= base_url(); ?>index.php/order/data_customer" , { option : "" } , function ( data ) {
			var obj = parseJSON(data);
			document.getElementById('aku').innerHTML = obj.nilai;
		} ) ; */
		
	
	/* document.getElementById('aku').innerHTML = 5+2; */
}
/* function insert_data(kd_prospek){
	$.get( "<?= base_url(); ?>index.php/order/input_data_customer" , { option :kd_prospek } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
}
function input_data_customer(kd_prospek,id1,id2){
	$.get( "<?= base_url(); ?>index.php/order/data_customer" , { option : kd_prospek } , function ( data ) {
			$( '#check_data' ) . html ( data ) ;
		} ) ;
	alert('Input Data Customer');
	if($("#check_cus").val() == '1'){
		alert('Data customer sudah diisi, untuk mengedit silahkan buka master customer !');
	}else{
		$.get( "<?= base_url(); ?>index.php/order/input_data_customer" , {
			option :kd_prospek,
			option1 :id1,
			option2 :id2,
			opt_data : {'pria':$("#pria").val(),'wanita':$("#wanita").val(),'telfon':$("#telfon").val(),'telfon2':$("#telfon2").val(),'email':$("#email").val(),'email2':$("#email2").val(),'tgl_resepsi':$("#datepicker").val(),'jam_resepsi':$("#jam_resepsi").val(),'tempat1':$("#tempat1").val(),'tempat2':$("#tempat2").val(),'tempat3':$("#tempat3").val()}
			},
			function ( data ) {
			$( '#show_stock' ) . html ( data ) ;
			$('#myModal').modal('show');
		} ) ;
	}
} */
$(document).ready(function(){
	$('#datepicker').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
$(document).ready(function(){
	$('#penawaran').datepicker({
		dateFormat:'yy-mm-dd'
	});
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
</script>