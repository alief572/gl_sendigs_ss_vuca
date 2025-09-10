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
				<form method="post" action="<?=base_url()?>index.php/order/proses_reques_gedung">
					<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Request</b></td>
							<td><input type="text" name="id_request" class="form-control" id="id_request" value="<?=$id_request?>" readonly></td>
							<td><b>Nama gedung</b></td>
							<td>
								<input type="text" placeholder="Masukan Nama Gedung" class="form-control" name="vendor" id="vendor">
							</td>
						</tr>
						<tr>
							<td><b>Tanggal Awal Pakai</b></td>
							<td><input type="text" class="datepicker form-control" readonly placeholder="Masukan Tanggal Awal Pakai" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" name="tgl_awal" id="tgl_awal" value="" ></td>
							<td><b>Alamat Gedung</b></td>
							<td id="jenis">
							<input type="text" name="jenis_vendora" class="form-control" placeholder="Masukan Alamat Gedung" id="jenis_vendora"  value="" >
							</td>
						</tr>
						<tr>
							<td><b>Jam Awal Pakai</b></td>
							<td class="input-append bootstrap-timepicker-component input-group form-control clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true"><input type="text" readonly placeholder="00:00" class="form-control" name="jam_awal" id="jam_awal" value="" ></td>
							<td><b>Kapasitas</b></td>
							<td><input type="text" onkeypress="return isNumber(event)" class="form-control" name="jumlah" placeholder="Masukan Kapasitas gedung" id="jumlah" value="" ></td>
						</tr>
						<tr>
							<td><b>Tanggal Akhir Pakai</b></td>
							<td>
							<input type="text" class="datepicker form-control" format="dd-mm-yyyy" placeholder="Masukan Tanggal akhir Pakai" data-date-format="dd-MM-yyyy" name="tgl_akhir" id="tgl_akhir" value="" readonly></td>
							<td><b>Komisi (Rp.)</b></td>
							<td><input type="text" onkeypress="return isNumber(event)" name="komisi" class="form-control" placeholder="masukan komisi (Rp.)" id="komisi" value="" ></td>
							
						</tr>
						<tr>
							<td><b>Jam Akhir Pakai</b></td>
							<td class="input-append bootstrap-timepicker-component input-group form-control clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true"><input type="text" name="jam_akhir" id="jam_akhir" value="" readonly class="form-control" placeholder="00:00"><i class="icon-time"></i></td>
							<td><b>ID Prospek</b></td>
							<td>
							<select name="id_prospek" id="id_prospek" class="form-control">
								<option value=''>-Id Prospek-</option>
								<?php
								if($id_pros > 0){
									foreach($id_pros as $rowx){
										
										echo "<option value='".$rowx->id_prospek."'>".$rowx->id_prospek." (".$rowx->calon_pria." & ".$rowx->calon_wanita.")</option>";
									}
								}
								?>
							</select>
							</td>
						</tr>
						<tr>
							<td><b>Keterangan</b></td>
							<td>
								<textarea name="ket" class="form-control"></textarea>
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
		alert('silahkan Isi nama gedung');
		document.getElementById("vendor").focus();
		return false;
	}else if($("#tgl_akhir").val() == ''){
		alert('silahkan isi tanggal akhir pakai');
		document.getElementById("tgl_akhir").focus();
		return false;
	}else if($("#komisi").val() == ''){
		alert('silahkan isi komisi gedung');
		document.getElementById("komisi").focus();
		return false;
	}else if($("#id_prospek").val() == ''){
		alert('silahkan Pilih ID Prospek');
		document.getElementById("id_prospek").focus();
		return false;
	}
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
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
</script>