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
			<form method="post" action="<?=base_url()?>index.php/master/proses_add_sales">
              <table class="table table-bordered">
				<tr>
					<td width="15%">Tanggal Input</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' value="<?=date("d-M-Y")?>" readonly>
					<input type="hidden" class="form-control" size='1'id="tgl_input" name='tgl_input' value="<?=date("Y-m-d")?>">
					</td>
					<td width="15%">ID Salesman</td>
					<td width="35%">
					<input type="text" class="form-control" size='1'id="id_sales" name='id_sales' value="<?=$id_salesman?>" readonly>
					</td>
				<tr>
				<tr>
					<td width="15%">Nama Sales</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' name="nm_sales" id="id_sales" value="">
					</td>
					<td width="15%">No Telpon</td>
					<td width="35%">
					<input type="text" class="form-control" size='1'id="no_telp" name='no_telp' value="">
					</td>
				<tr>
				<tr>
					<td width="15%">Email</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' name="email" id="email" value="">
					</td>
					<td width="15%">Tanggal Masuk</td>
					<td width="35%">
					<input type="text" class="form-control" id="penawaran" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" size='1'id="tgl_masuk" name='tgl_masuk' value="">
					</td>
				<tr>
				<tr>
					<td width="15%">Pengalaman</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' name="pengalaman" id="pengalaman" value="">
					</td>
					<td width="15%">Kategori</td>
					<td width="35%">
					<input type="text" class="form-control" size='1'id="kategori" name='kategori' value="">
					</td>
				<tr>
				<tr>
					<td width="15%">Level</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' name="level" id="level" value="">
					</td>
					<td width="15%">Status</td>
					<td width="35%">
					<input type="text" class="form-control" size='1'id="status" name='status' value="">
					</td>
				<tr>
				<tr>
					<td width="15%">Status Aktif</td>
					<td width="25%">
						<select class="form-control" name="sts_aktiv">
							<option value="1">Aktif</option>
							<option value="0">Non-Aktif</option>
						</select>
					</td>
					<td width="15%">Alamat</td>
					<td width="35%">
					<textarea name="alamat" class="form-control"></textarea>
					</td>
				<tr>
				<tr>
					<td colspan="4">
					<input type="submit" class='btn btn-success btn-lg pull-right' name='submit' value='Save' onclick="return check();">
					</td>
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
	if($("#pria").val() == '' && $("#wanita").val() == '' && $("#pemesan").val() == ''){
		alert('silahkan isi nama pemesan, pengantin pria atau wanita');
		document.getElementById("pria").focus();
		return false;
	}else if($("#telfon1").val() == ''){
		alert('silahkan isi nomor telfon 1');
		document.getElementById("telfon1").focus();
		return false;
	}else if($("#email1").val() == ''){
		alert('silahkan isi nomor email 1');
		document.getElementById("email1").focus();
		return false;
	}else if($("#alamat").val() == ''){
		alert('silahkan isi nomor alamat');
		document.getElementById("alamat").focus();
		return false;
	}else if($("#kota").val() == ''){
		alert('silahkan isi nomor kota');
		document.getElementById("kota").focus();
		return false;
	}
}
function buat_penawaran(kd_prospek){
	$.get( "<?= base_url(); ?>index.php/order/buat_penawaran" , { option :kd_prospek } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
}
$(document).ready(function(){
	$('#penawaran').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
</script>