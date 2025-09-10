<?php $this->load->view('header');?>
<?php
$id = $this->komisi_model->get_id_req() + 1;
if($id<10){
	$kd_add = "0000";
}else if($id<100){
	$kd_add = "000";
}else if($id<1000){
	$kd_add = "00";
}else if($id<10000){
	$kd_add = "00";
}else{
	$kd_add = "0";
}
$id_request = "BK".date("ym")."|".$kd_add.$id;
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
				<form method="post" onsubmit="return check();" action="<?=base_url()?>index.php/komisi/proses_bayar_sales">
					<input type="hidden" name="count" value="<?=$id?>">
					<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Request</b></td>
							<td><input type="text" name="id_request" class="form-control" id="id_request" value="<?=$id_request?>" readonly></td>
							<td><b>Nama Karyawan</b></td>
							<td>
								<select name="karyawan" id="karyawan" class="form-control">
									<option value="">-Pilih Karyawan-</option>
									<?php
									if($karyawan > 0){
										foreach($karyawan as $row){
											echo "<option value='".$row->nama."'>".$row->nama."</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td><b>Jenis Pembayaran</b></td>
							<td><input type="text" name="jenis" readonly class="form-control" id="jenis" value="KARYAWAN"></td>
							<td><b>Total Pembayaran</b></td>
							<td>
							<input type="text" name="total" class="form-control" id="total" value="">
							</td>
						</tr>
						<tr>
							<td><b>Keterangan</b></td>
							<td><textarea name="ket" class="form-control"></textarea></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4" align="right"><input type="submit" class='btn btn-success' name='submit' value='Save'></td>
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
<script>
function check(){
	if($("#bayar").val() == ''){
		alert('silahkan masukan Jumlah Pembayaran');
		document.getElementById("bayar").focus();
		return false;
	}else if(parseInt($("#bayar").val()) > parseInt($("#sisa").val())){
		alert('Total Bayar Tidak Boleh Lebih besar dari Sisa Pembayaran');
		document.getElementById("bayar").focus();
		return false;
	}
}
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
</script>