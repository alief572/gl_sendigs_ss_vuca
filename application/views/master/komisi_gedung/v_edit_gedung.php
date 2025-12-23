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
	<?php
		if($data_gedung > 0){
			foreach($data_gedung as $row){
	?>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
			<form method="post" action="<?=base_url()?>index.php/master/proses_edit_gedung">
              <table class="table table-bordered">
				<tr>
					<td width="15%">Tanggal Edit</td>
					<td width="25%">
					<input type="text" class="form-control" size='1' value="<?=date("d-M-Y")?>" readonly>
					<input type="hidden" class="form-control" size='1'id="tgl_input" name='tgl_input' value="<?=date("Y-m-d")?>">
					</td>
					<td width="15%">ID Gedung</td>
					<td width="35%">
					<input type="text" class="form-control" size='1'id="id_gedung" name='id_gedung' value="<?=$row->id?>" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Nama Gedung</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->nm_gedung?>" name='nm_gedung' id='nm_gedung'>
					</td>
					<td>Alamat</td>
					<td>
					<input type="text" class="form-control" size='1' id="alamat" name='alamat' value="<?=$row->alamat?>">
					</td>
				</tr>
				<tr>
					<td width="25%">Kota / Kabupaten</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->kota?>" id="kota" name='kota'>
					</td>
					<td>Kode Pos</td>
					<td>
					<input type="text" class="form-control" size='1'id="kode_pos" name='kode_pos' value="<?=$row->kode_pos?>">
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
					<input type="text" class="form-control" size='1'id="cp1" name='cp1' value="<?=$row->cp?>">
					</td>
					<td>Lebar</td>
					<td>
					<input type="text" class="form-control" size='1'id="lebar" name='lebar' value="<?=$row->lebar?>">
					</td>
				</tr>
				<tr>
					<td width="25%">Jabatan</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->jabatan1?>" id="jabatan1" name='jabatan1'>
					</td>
					<td>Panjang</td>
					<td>
					<input type="text" class="form-control" size='1'id="panjang" name='panjang' value="<?=$row->panjang?>">
					</td>
				</tr>
				<tr>
					<td width="25%">Nomor Telfon</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->telp1?>" id="telp1" name='telp1'>
					</td>
					<td>Tinggi</td>
					<td>
					<input type="text" class="form-control" size='1'id="tinggi" name='tinggi' value="<?=$row->tinggi?>">
					</td>
				</tr>
				<tr>
					<td width="25%">Email</td><td>
					<input type="email" class="form-control" size='1' value="<?=$row->email1?>" id="email1" name='email1'>
					</td>
					<td width="25%">Tinggi Panggung</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->tinggi_panggung?>" id="t_panggung" name='t_panggung'>
					</td>
				</tr>
				<tr>
					<td>ULang Tahun</td>
					<td>
					<input type="text" class="form-control datepicker" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" size='1' id="ultah1" name='ultah1' value="<?=date("d-M-Y",strtotime($row->ultah_cp1))?>" readonly>
					</td>
					<td>Kapasitas Ruangan</td>
					<td>
					<input type="text" class="form-control" size='1'id="kapasitas_ruangan" name='kapasitas_ruangan' value="<?=$row->kapasitas?>">
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<b>CONTACT PERSON 2</b>
					</td>
					<td>Kapasitas Parkir</td>
					<td>
					<input type="text" class="form-control" size='1'id="kapasitas_parkir" name='kapasitas_parkir' value="<?=$row->kapasitas_parkir?>">
					</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>
					<input type="text" class="form-control" size='1'id="cp2" name='cp2' value="<?=$row->cp2?>">
					</td>
					<td>Kapasitas Listrik</td>
					<td>
					<input type="text" class="form-control" size='1'id="kapasitas_listrik" name='kapasitas_listrik' value="<?=$row->listrik?>">
					</td>
				</tr>
				<tr>
					<td width="25%">Jabatan</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->jabatan2?>" id="jabatan2" name='jabatan2'>
					</td>
					<td>Jam Awal Siang</td>
					<td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" class="form-control" placeholder="00:00" size='5'id="awal_siang" name='awal_siang' value="<?=$row->jam_awal_siang?>" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Nomor Telfon</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->telp2?>" id="telp2" name='telp2'>
					</td>
					<td>Jam Akhir Siang</td>
					<td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" class="form-control" placeholder="00:00" size='5'id="akhir_siang" name='akhir_siang' value="<?=$row->jam_akhir_siang?>" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Email</td><td>
					<input type="email" class="form-control" size='1' value="<?=$row->email2?>" id="email2" name='email2'>
					</td>
					<td>Jam Awal Malam</td>
					<td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" class="form-control" placeholder="00:00" size='5'id="awal_malam" name='awal_malam' value="<?=$row->jam_awal_malam?>" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Ulang Tahun</td><td>
					<input type="text" class="form-control datepicker" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" size='1' value="<?=date("d-M-Y",strtotime($row->ultah_cp2))?>" id="ultah2" name='ultah2' readonly>
					</td>
					<td width="25%">Jam Akhir Malam</td><td class="input-append bootstrap-timepicker-component input-group clockpicker pull-center" data-placement="left" data-align="top" data-autoclose="true">
					<input type="text" placeholder="00:00" class="form-control" size='5' value="<?=$row->jam_akhir_malam?>" id="akhir_malam" name='akhir_malam' readonly>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
					<b>CONTACT PERSON 3</b>
					</td>
					<td>Harga Siang</td>
					<td>
					<input type="text" class="form-control" size='1'id="harga_siang" name='harga_siang' value="<?=$row->harga_siang?>">
					</td>
				</tr>
				<tr>
					<td width="25%">Nama</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->cp3?>" id="cp3" name='cp3'>
					</td>
					<td>Harga Malam</td>
					<td>
					<input type="text" class="form-control" size='1' value="<?=$row->harga_malam?>" id="harga_malam" name='harga_malam' >
					</td>
				</tr>
				<tr>
					<td width="25%">Jabatan</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->jabatan3?>" id="jabatan3" name='jabatan3' >
					</td>
					<td width="25%">No Account</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->no_account?>" id="account" name='account'>
					</td>
				</tr>
				<tr>
					<td width="25%">Nomor Telfon</td><td>
					<input type="text" class="form-control" size='1' value="<?=$row->telp3?>" id="telp3" name='telp3' >
					</td>
					<td>Nama Bank</td>
					<td>
					<input type="text" class="form-control" size='1' value="<?=$row->nm_bank?>" id="bank" name='bank' >
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
					<input type="email" class="form-control" size='1'id="email3" name='email3' value="<?=$row->email3?>">
					</td>
					<td>Sts Transver</td>
					<td>
						<select id="sts_trv" name='sts_trv' class="form-control">
						<?php
						if($row->sts_transver == "Y"){
							echo "<option value=\"Y\" selected>Yes</option>
							<option value=\"N\">No</option>";
						}else{
							echo "<option value=\"Y\">Yes</option>
							<option value=\"N\" selected>No</option>";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td width="25%">Ulang Tahun</td><td>
					<input type="text" class="form-control datepicker" format="dd-mm-yyyy" data-date-format="dd-MM-yyyy" size='1' value="<?=date("d-M-Y",strtotime($row->ultah_cp3))?>" id="ultah3" name='ultah3' readonly>
					</td>
					<td>Status Gedung</td>
					<td>
					<select class="form-control" size='1' value="" id="sts_book" name='sts_book'>
						<?php
							if($row->sts_book ==1 || $sts_book == 0){
								echo "<option value=\"0\">Pilih Status Booking</option>
								<option value=\"1\" selected>Free</option>
								<option value=\"2\">Booked</option>
								<option value=\"3\">Non_aktif</option>";
							}else if($row->sts_book ==2){
								echo "<option value=\"0\">Pilih Status Booking</option>
								<option value=\"1\">Free</option>
								<option value=\"2\" selected>Booked</option>
								<option value=\"3\">Non_aktif</option>";
							}else if($row->sts_book ==3){
								echo "<option value=\"0\">Pilih Status Booking</option>
								<option value=\"1\">Free</option>
								<option value=\"2\">Booked</option>
								<option value=\"3\" selected>Non_aktif</option>";
							}
						?>
					</select>
					</td>
				</tr>
				<tr>
					<td>Persentase</td>
					<td>
					<input type="text" class="form-control" size='1'id="persentase" name='persentase' value="<?=$row->persentase?>">
					</td>
					<td>Jumlah Jam Pakai</td>
					<td>
					<input type="text" class="form-control" size='1'id="jam_pakai" name='jam_pakai' value="<?=$row->jumlah_jam_pakai?>">
					</td>
				</tr>
				<tr>
					<td width="25%">Fasilitas (max : 255 karakter)</td>
					<td>
					<textarea name="fasilitas" class="form-control"><?=$row->fasilitas?></textarea>
					</td>
					<td>Keterangan</td>
					<td>
					<textarea name="keterangan" class="form-control"><?=$row->keterangan?></textarea>
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
	<?php
			}
		}
	?>
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