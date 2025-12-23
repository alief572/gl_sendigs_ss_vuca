<?php $this->load->view('header');?>
<?php
$id_request = str_replace("_","|",$this->uri->segment(3));
if($komisi > 0){
	foreach($komisi as $row){
		$id_vendor = $row->id_vendor;
		$nm_vendor = $row->nm_vendor;
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
				<?php
				if(substr($id_request,0,2) == "RG"){
				?>
				<form method="post" action="<?=base_url()?>index.php/komisi/proses_bayar_gedung">
				<?php
				}else{
				?>
				<form method="post" action="<?=base_url()?>index.php/komisi/proses_bayar_vendor">
				<?php }?>
					<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Request</b></td>
							<td><input type="text" name="id_request" class="form-control" id="id_request" value="<?=$id_request?>" readonly></td>
							<td><b>Nama Vendor</b></td>
							<td><input type="text" name="nama" class="form-control" readonly id="nama" value="<?=$nm_vendor?>" readonly></td>
						</tr>
						<tr>
							<td><b>Jenis Vendor</b></td>
							<td><input type="text" name="jenis" readonly class="form-control" id="jenis" value="<?=$jenis?>" readonly></td>
							<td><b>Total Pembayaran</b></td>
							<td>
							<input type="hidden" name="total" readonly class="form-control" id="total" value="<?=$komisi?>" readonly>
							<input type="text" readonly class="form-control" value="<?=number_format($komisi)?>" readonly></td>
						</tr>
						<tr>
							<td>Sisa Bayar</td>
							<td>
							<?php
							$tot_bayar = $this->komisi_model->get_bayar($row->id);
							$sisa = $komisi - $tot_bayar;
							?>
							<input type="hidden" id="sisa" readonly class="form-control" value="<?=$sisa?>" readonly>
							
							<input type="text" readonly class="form-control" value="<?=number_format($sisa)?>" readonly>
							</td>
							</td>
							<td><b>Jumlah Bayar</b></td>
							<td>
							<input type="text" name="bayar" onkeypress="return isNumber(event)" class="form-control" id="bayar" value="" ></td>
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