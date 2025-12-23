<?php $this->load->view('header');?>
<?php 
foreach($data_barang as $row2){
	$nama_aju 		= $row2->insert_by;
	$tgl_aju 		= $row2->tgl_aju;
	$id_supplier 	= $row2->id_supplier;
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
			if(!empty($add)){
			?>
				<form method="post" action="<?=base_url()?>index.php/order/proses_input_tambah_new">
			<?php
			}else{
			?>
				<form method="post" action="<?=base_url()?>index.php/order/proses_input_new">
			<?php
			}
			?>
				<input type="hidden" class="form-control" size='1' name="id_spd" value="<?=$id?>" readonly>
				<table class="table table-bordered">
				<tr class="widget-user-header bg-yellow">
					<td colspan="6" style="text-align:center;font-size:20px;" ><center>List Pengajuan Barang Baru</center></td>
				</tr>
				<?php 
				$no =0;
				if($list_barang > 0){
					foreach($list_barang as $row){
						$no++;
						if(!empty($add)){
							$barang = explode("+^",$row->nm_barang);
							$nm_barang = $barang[1];
							$id_barang = $barang[0];
						}
				?>
				<tr>
					<td width="15%">No</td>
					<td width="35%"><b><?=$no?></b></td>
					<td width="15%">Nama Barang</td>
					<td width="35%">
					<?php
					if(!empty($add)){
						?>
						<input type="text" name="nama[]" value="<?=$nm_barang?>" readonly>
						<input type="hidden" name="id_barang[]" value="<?=$id_barang?>" readonly></td>
						<?php
						}else{
					?>
					<input type="text" name="nama[]" value="<?=$row->nm_barang?>" readonly></td>
					<?php
					}
					?>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td>Total : <input size='3' type="text" name="jumlah[]" value="<?=$row->jumlah?>" readonly>
					Masuk : 
						<select name="jum_in[]" id="jum_in[]">
							<option value="">-Jumlah Masuk-</option>
							<?php
							for($i=1;$i<=$row->jumlah;$i++){
							?>
								<option value="<?=$i?>"><?=$i?></option>
							<?php
							}
							?>
						</select>
					</td>
					<td>Harga</td>
					<td><input type="text" name="harga[]" value="<?=$row->harga?>" readonly></td>
				</tr>
					<td>Merk</td>
					<td><input type="text" name="asal[]" value=""></td>
					<td>Nama Supplier</td>
					<td>
						<select name="supplier[]" id="supplier[]">
							<option value="">Pilih Supllier</option>
							<?php
							if($list_supplier > 0){
								foreach($list_supplier as $row){
									if($id_supplier == $row->id){
										echo "<option selected value='".$row->id."+^".$row->nm_supplier."'>".$row->nm_supplier."</option>";
									}else{
										echo "<option value='".$row->id."+^".$row->nm_supplier."'>".$row->nm_supplier."</option>";
									}
								}
							}
							?>
						</select>
					</td>
				<tr>
				</tr>
					<td>Barang Stock</td>
					<td>
						<select name="stock[]" id="stock[]">
							<option value="">-Pilih Jenis Barang-</option>
							<option value="Y">Barang Stock</option>
							<option value="N">Barang Non-Stock</option>
						</select>
					</td>
					<td>Barang Bagus</td>
					<td><input type="text" name="bagus[]" readonly value=""></td>
				<tr>
				</tr>
					<td>Barang Sedang</td>
					<td><input type="text" name="sedang[]" readonly value=""></td>
					<td>Barang Jelek</td>
					<td><input type="text" name="buruk[]" readonly value=""></td>
				<tr>
				<?php
				if(count($list_barang) != $no){
				?>
				</tr>
					<td colspan="4" style='background-color:gray'></td>
				<tr>
				<?php
					}
					}
				}
				?>
				</tr>
					<td colspan="4" align="center"><input type="submit" name="submit" value="Save" class="btn btn-success btn-lg" onclick="return check();"></td>
				<tr>
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
	fCode = document.getElementsByName("jum_in[]");
	for ( var i = 0; i < fCode.length; i++ ){
		if ( fCode[i].value == "") {
			alert("Silahkan isi jumlah barang masuk");
			fCode[i].focus();
			return false;
		}
	}
	fCode2 = document.getElementsByName("supplier[]");
	for ( var i = 0; i < fCode2.length; i++ ){
		if ( fCode2[i].value == "") {
			alert("Silahkan pilih supllier");
			fCode2[i].focus();
			return false;
		}
	}
	fCode3 = document.getElementsByName("stock[]");
	for ( var i = 0; i < fCode3.length; i++ ){
		if ( fCode3[i].value == "") {
			alert("Silahkan jenis barang");
			fCode3[i].focus();
			return false;
		}
	}
}
</script>