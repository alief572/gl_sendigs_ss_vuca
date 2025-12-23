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
			<form method="post" action="<?=base_url()?>index.php/master/proses_add_gedung">
              <table class="table table-bordered">
				<tr>
					<td width="15%">Tanggal Input</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' value="<?=date("d-M-Y")?>" readonly>
					<input type="hidden" class="form-control" size='1'id="tgl_input" name='tgl_input' value="<?=date("Y-m-d")?>">
					</td>
					<td width="15%">ID Gedung</td>
					<td width="35%">
					<input type="text" class="form-control" size='1'id="id_gedung" name='id_gedung' value="<?=$id_gedung?>" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Nama Gedung</td><td>
					<input type="text" class="form-control" size='1' value="" name='nm_gedung' id='nm_gedung'>
					</td>
					<td>Alamat</td>
					<td>
					<input type="text" class="form-control" size='1' id="alamat" name='alamat' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Kota / Kabupaten</td><td>
					<input type="text" class="form-control" size='1' value="" id="kota" name='kota'>
					</td>
					<td>Kode Pos</td>
					<td>
					<input type="text" class="form-control" size='1'id="kode_pos" name='kode_pos' value="">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<b>CONTACT PERSON 1</b>
					</td>
					<td align="center" colspan="2">
					<b>SPESIFIKASI GEDUNG</b>
					</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>
					<input type="text" class="form-control" size='1'id="cp1" name='cp1' value="" >
					</td>
					<td>Lebar</td>
					<td>
					<input type="text" class="form-control" size='1'id="lebar" name='lebar' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Jabatan</td><td>
					<input type="text" class="form-control" size='1' value="" id="jabatan1" name='jabatan1'>
					</td>
					<td>Panjang</td>
					<td>
					<input type="text" class="form-control" size='1'id="panjang" name='panjang' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Nomor Telfon</td><td>
					<input type="text" class="form-control" size='1' value="" id="telp1" name='telp1'>
					</td>
					<td>Tinggi</td>
					<td>
					<input type="text" class="form-control" size='1'id="tinggi" name='tinggi' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Email</td><td>
					<input type="email" class="form-control" size='1' value="" id="email1" name='email1'>
					</td>
					<td width="25%">Tinggi Panggung</td><td>
					<input type="text" class="form-control" size='1' value="" id="t_panggung" name='t_panggung'>
					</td>
				</tr>
				<tr>
					<td>Ulang Tahun</td>
					<td>
					<input type="text" class="form-control datepicker" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" size='1' id="ultah1" name='ultah1' value="">
					</td>
					<td>Kapasitas Ruangan</td>
					<td>
					<input type="text" class="form-control" size='1'id="kapasitas_ruangan" name='kapasitas_ruangan' value="">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<b>CONTACT PERSON 2</b>
					</td>
					<td>Kapasitas Parkir</td>
					<td>
					<input type="text" class="form-control" size='1'id="kapasitas_parkir" name='kapasitas_parkir' value="">
					</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>
					<input type="text" class="form-control" size='1'id="cp2" name='cp2' value="">
					</td>
					<td>Kapasitas Listrik</td>
					<td>
					<input type="text" class="form-control" size='1'id="kapasitas_listrik" name='kapasitas_listrik' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Jabatan</td><td>
					<input type="text" class="form-control" size='1' value="" id="jabatan2" name='jabatan2'>
					</td>
					<td>Jam Awal Siang</td>
					<td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" class="form-control" placeholder="00:00" size='5'id="awal_siang" name='awal_siang' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Nomor Telfon</td><td>
					<input type="text" class="form-control" size='1' value="" id="telp2" name='telp2'>
					</td>
					<td>Jam Akhir Siang</td>
					<td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" class="form-control" placeholder="00:00" size='5'id="akhir_siang" name='akhir_siang' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Email</td><td>
					<input type="email" class="form-control" size='1' value="" id="email2" name='email2'>
					</td>
					<td>Jam Awal Malam</td>
					<td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" class="form-control" placeholder="00:00" size='5'id="awal_malam" name='awal_malam' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Ulang Tahun</td><td>
					<input type="text" class="form-control datepicker" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" size='1' value="" id="ultah2" name='ultah2'>
					</td>
					<td width="25%">Jam Akhir Malam</td><td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" placeholder="00:00" class="form-control" size='5' value="" id="akhir_malam" name='akhir_malam' >
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<b>CONTACT PERSON 3</b>
					</td>
					<td>Harga Siang</td>
					<td>
					<input type="text" class="form-control" size='1'id="harga_siang" name='harga_siang' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Nama</td><td>
					<input type="text" class="form-control" size='1' value="" id="cp3" name='cp3'>
					</td>
					<td>Harga Malam</td>
					<td>
					<input type="text" class="form-control" size='1' value="" id="harga_malam" name='harga_malam' >
					</td>
				</tr>
				<tr>
					<td width="25%">Jabatan</td><td>
					<input type="text" class="form-control" size='1' value="" id="jabatan3" name='jabatan3' >
					</td>
					<td width="25%">No Account</td><td>
					<input type="text" class="form-control" size='1' value="" id="account" name='account'>
					</td>
				</tr>
				<tr>
					<td width="25%">Nomor Telfon</td><td>
					<input type="text" class="form-control" size='1' value="" id="telp3" name='telp3' >
					</td>
					<td>Nama Bank</td>
					<td>
					<input type="text" class="form-control" size='1' value="" id="bank" name='bank' >
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
					<input type="email" class="form-control" size='1'id="email3" name='email3' value="">
					</td>
					<td>Sts Transfer</td>
					<td>
						<select id="sts_trv" name='sts_trv' class="form-control">
						<option value="Y">Yes</option>
						<option value="N">No</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="25%">Ulang Tahun</td><td>
					<input type="text" class="form-control datepicker" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" size='1' value="" id="ultah3" name='ultah3'>
					</td>
					<td>Status Gedung</td>
					<td>
					<select class="form-control" size='1' value="" id="sts_book" name='sts_book'>
						<option value="0">Pilih Status Booking</option>
						<option value="1">Free</option>
						<option value="2">Booked</option>
						<option value="3">Non_aktif</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Persentase</td>
					<td>
					<input type="text" class="form-control" size='1'id="persentase" name='persentase' value="">
					</td>
					<td>Jumlah Jam Pakai</td>
					<td>
					<input type="text" class="form-control" size='1'id="jam_pakai" name='jam_pakai' value="">
					</td>
				</tr>
				<tr>
					<td width="25%">Fasilitas (max : 255 karakter)</td>
					<td>
					<textarea name="fasilitas" class="form-control"></textarea>
					</td>
					<td>Keterangan</td>
					<td>
					<textarea name="keterangan" class="form-control"></textarea>
					</td>
				</tr>
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
$(document).ready(function(){
	$('.datepicker').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
</script>