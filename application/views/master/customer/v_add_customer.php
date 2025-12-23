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
			<form method="post" action="<?=base_url()?>index.php/master/proses_add_customer">
              <table class="table table-bordered">
				<tr>
					<td width="15%">Tanggal Input</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' value="<?=date("d-M-Y")?>" readonly>
					<input type="hidden" class="form-control" size='1'id="tgl_input" name='tgl_input' value="<?=date("Y-m-d")?>">
					</td>
					<td width="15%">No. Customer</td>
					<td width="35%">
					<input type="text" class="form-control" size='1'id="id_customer" name='id_customer' value="<?=$no_cust?>" readonly>
					</td>
				<tr>
				<tr>
					<td width="25%">Nama Perusahaan</td><td>
					<input type="text" class="form-control" size='1' value="" name='perusahaan' id='perusahaan'>
					</td>
					<td>Industri</td>
					<td>
					<input type="text" class="form-control" size='1' id="industri" name='industri' value="">
					</td>
				<tr>
				<tr>
					<td width="25%">Calon Pengantin Pria</td><td>
					<input type="text" class="form-control" size='1' value="" id="pria" name='pria'>
					</td>
					<td>Calon Pengantin Wanita</td>
					<td>
					<input type="text" class="form-control" size='1'id="wanita" name='wanita' value="">
					</td>
				<tr>
				<tr>
					<td width="25%">Agama</td><td>
					<input type="text" class="form-control" size='1' value="" id="agama" name='agama' >
					</td>
					<td>Nama Pemesan</td>
					<td>
					<input type="text" class="form-control" size='1'id="pemesan" name='pemesan' value="">
					</td>
				<tr>
				<tr>
					<td width="25%">No KTP</td><td>
					<input type="text" class="form-control" size='1' value="" id="no_ktp" name='no_ktp' >
					</td>
					<td>Status Customer</td>
					<td>
					<select name='sts_cus' id='sts_cus' class="form-control">
					<option value="1">Aktif</option>
					<option value="0">Non-Aktif</option>
					</select>
					</td>
				<tr>
				<tr>
					<td>Tittle</td>
					<td>
					<input type="text" class="form-control" size='1'id="title" name='title' value="">
					</td>
					<td width="25%">Alamat</td><td>
					<input type="text" class="form-control" size='1' value="" id="alamat" name='alamat'>
					</td>
				<tr>
				<tr>
					<td width="25%">Kota</td><td>
					<input type="text" class="form-control" size='1' value="" id="kota" name='kota'>
					</td>
					<td>Kode Pos</td>
					<td>
					<input type="text" class="form-control" size='1'id="kd_pos" name='kd_pos' value="" >
					</td>
				<tr>
				<tr>
					<td width="25%">Nomor Telpon</td><td>
					<input type="text" class="form-control" size='1' value="" id="telfon1" name='telfon1'>
					</td>
					<td>Nomor Telpon 2</td>
					<td>
					<input type="text" class="form-control" size='1'id="telfon2" name='telfon2' value="">
					</td>
				<tr>
				<tr>
					<td width="25%">Email</td><td>
					<input type="email" class="form-control" size='1' value="" id="email1" name='email1'>
					</td>
					<td>Email 2</td>
					<td>
					<input type="email" class="form-control" size='1'id="email2" name='email2' value="">
					</td>
				<tr>
				<tr>
					<td width="25%">Nama Bank</td>
					<td>
					<input type="text" class="form-control" size='1' value="" id="nm_bank" name='nm_bank'>
					</td>
					<td>No Account</td>
					<td>
					<input type="text" class="form-control" size='1'id="no_account" name='no_account' value="">
					</td>
				<tr>
				<tr>
					<td width="25%">Cabang Bank</td>
					<td>
					<input type="text" class="form-control" size='1' value="" id="cabang" name='cabang'>
					</td>
					<td>Sts Transver</td>
					<td>
						<select id="sts_trv" name='sts_trv' class="form-control">
						<option value="Y">Yes</option>
						<option value="N">No</option>
						</select>
					</td>
				<tr>
				<tr>
					<td width="25%">NPWP</td>
					<td>
					<input type="text" class="form-control" size='1' value="" id="npwp" name='npwp'> 
					</td>
					<td>Sales</td>
					<td>
						<select class="form-control" size='1'id="sales" name='sales'>
							<option value="0">Pilih Sales</option>
							<?php
							if($data_salesman > 0){
								foreach($data_salesman as $row1){
								echo "<option value='".$row1->nosales."+^".$row1->nama."'>".$row1->nama."</option>";
								}
							}
							?>
						</select>
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