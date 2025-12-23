<?php $this->load->view('header');?>
<?php
$id_request = str_replace("_","|",$this->uri->segment(3));
if($data_vendor > 0){
	foreach($data_vendor as $row){
		$id_vendor = $row->id_vendor;
		$jenis = $row->jenis;
		$jumlah = $row->jumlah;
		$komisi = $row->komisi;
		$id_prospek = $row->id_prospek;
		$tgl_awal = $row->tgl_awal;
		$tgl_akhir = $row->tgl_akhir;
		$jam_awal = $row->jam_awal;
		$jam_akhir = $row->jam_akhir;
		$ket = $row->ket;
	}
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
				<form method="post" action="<?=base_url()?>index.php/order/proses_edit_request_vendor">
					<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Request</b></td>
							<td><input type="text" name="id_request" class="form-control" id="id_request" value="<?=$id_request?>" readonly></td>
							<td><b>Nama Vendor</b></td>
							<td>
								<select class="form-control" name="vendor" id="vendor_aa" onchange="return jenis_vendoraa()">
									<option value="">Pilih Vendor</option>
									<?php 
									if($req_vendor){
										foreach($req_vendor as $row){
											if($id_vendor == $row->id){
												echo "<option selected value='".$row->id."+^".$row->nm_vendor."'>".$row->nm_vendor."</option>";
											}else{
												echo "<option value='".$row->id."+^".$row->nm_vendor."'>".$row->nm_vendor."</option>";
											}
											
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td><b>Tanggal Awal Pakai</b></td>
							<td><input type="text" class="datepicker form-control" readonly placeholder="Masukan Tanggal Awal Pakai" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" name="tgl_awal" id="tgl_awal" value="<?=date("d-F-Y",strtotime($tgl_awal))?>" ></td>
							<td><b>Jenis Vendor</b></td>
							<td id="jenis">
							<input type="text" name="jenis_vendora" class="form-control" placeholder="jenis vendor" id="jenis_vendora" readonly value="<?=$jenis?>" >
							</td>
						</tr>
						<tr>
							<td><b>Jam Awal Pakai</b></td>
							<td class="input-append bootstrap-timepicker-component input-group form-control clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true"><input type="text" readonly placeholder="00:00" class="form-control" name="jam_awal" id="jam_awal" value="<?=$jam_awal?>" ></td>
							<td><b>Jumlah Item</b></td>
							<td><input type="text" class="form-control" name="jumlah" placeholder="Masukan jumlah request" id="jumlah" value="<?=$jumlah?>" ></td>
						</tr>
						<tr>
							<td><b>Tanggal Akhir Pakai</b></td>
							<td>
							<input type="text" class="datepicker form-control" format="dd-mm-yyyy" placeholder="Masukan Tanggal akhir Pakai" data-date-format="dd-MM-yyyy" name="tgl_akhir" id="tgl_akhir" value="<?=date("d-F-Y",strtotime($tgl_akhir))?>" readonly></td>
							<td><b>Komisi (Rp.)</b></td>
							<td><input type="text" name="komisi" class="form-control" placeholder="masukan komisi (Rp.)" id="komisi" value="<?=$komisi?>" ></td>
							
						</tr>
						<tr>
							<td><b>Jam Akhir Pakai</b></td>
							<td class="input-append bootstrap-timepicker-component input-group form-control clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true"><input type="text" name="jam_akhir" id="jam_akhir" value="<?=$jam_akhir?>" readonly class="form-control" placeholder="00:00"><i class="icon-time"></i></td>
							<td><b>ID Prospek</b></td>
							<td>
							<select name="id_prospek" id="id_prospek" class="form-control">
								<option value=''>-Id Prospek-</option>
								<?php
								if($id_pros > 0){
									foreach($id_pros as $rowx){
										if($id_prospek == $rowx->id_prospek){
											echo "<option selected value='".$rowx->id_prospek."'>".$rowx->id_prospek." (".$rowx->calon_pria." & ".$rowx->calon_wanita.")</option>";
										}else{
											echo "<option value='".$rowx->id_prospek."'>".$rowx->id_prospek." (".$rowx->calon_pria." & ".$rowx->calon_wanita.")</option>";
										}
										
									}
								}
								?>
							</select>
							</td>
						</tr>
						<tr>
							<td><b>Keterangan</b></td>
							<td>
								<textarea name="ket" class="form-control"><?=$ket?></textarea>
							</td>
							<td></td>
							<td>
							</td>
						</tr>
						<tr>
							<td colspan="4" align="right"><input type="submit" class='btn btn-success' name='submit' value='Save' onclick="return check();"></td>
						</tr>
					</table>
			  </form>
            </div>
        </div>
        </div>
    </div>
	<div id="show_stock"><div>
	</section>
<?php }?>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>
<script>
function check(){
	if($("#tgl_awal").val() == ''){
		alert('silahkan isi tanggal awal pakai');
		document.getElementById("tgl_awal").focus();
		return false;
	}else if($("#vendor").val() == ''){
		alert('silahkan pilih nama vendor');
		document.getElementById("vendor").focus();
		return false;
	}else if($("#tgl_akhir").val() == ''){
		alert('silahkan isi tanggal akhir pakai');
		document.getElementById("tgl_akhir").focus();
		return false;
	}else if($("#komisi").val() == ''){
		alert('silahkan isi komisi vendor');
		document.getElementById("komisi").focus();
		return false;
	}else if($("#id_prospek").val() == ''){
		alert('silahkan Pilih ID Prospek');
		document.getElementById("id_prospek").focus();
		return false;
	}
}
function jenis_vendoraa(){
	$id = $("#vendor_aa").val();
	$.get( "<?= base_url(); ?>index.php/order/jenis_vendor" , { option :$id } , function ( data ) {
		$( '#jenis' ) . html ( data ) ;
	} ) ;
}
	$(document).ready(function(){
		$('.datepicker').datepicker({
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