<?php $this->load->view('header');?>
<?php
	foreach($data_paket as $row){
		$nm_paket	= $row->nm_paket;
		$sts		= $row->sts;
		$harga2		= $row->harga;
		$note		= $row->note;
		$id_gedung	= $row->id_gedung;
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
				<form action="<?=base_url()?>index.php/master/save_paket_edit" method="post">
					<table class="table table-bordered table-hover">
						<tr>
							<td><b>ID Paket</b></td>
							<td><input type="text" name="id_paket" class='form-control' id="id_paket" value="<?=$id_paket?>" readonly></td>
							<td><b>Nama Paket</b></td>
							<td><input type="text" name="nm_paket" class='form-control' id="nm_paket" value="<?=$nm_paket?>"></td>
						</tr>
						<tr>
							<td><b>Nama Gedung</b></td>
							<td>
								<select name="gedung" id="gedung" class='form-control'>
									<option value="0">-Pilih Nama Gedung-</option>
									<?php
									if($data_gedung >0){
										foreach($data_gedung as $rows){
											if($id_gedung == $rows->id){
												echo "<option selected value='".$rows->id."+^".$rows->nm_gedung."'>".$rows->nm_gedung."</option>";
											}else{
												echo "<option value='".$rows->id."+^".$rows->nm_gedung."'>".$rows->nm_gedung."</option>";
											}
										}
									}
									?>
								</select>
							</td>
							<td><b>Harga Paket</b></td>
							<td><input type="text" name="harga" class='form-control' id="harga" onkeypress="return isNumber(event)" value="<?=number_format($harga2)?>"></td>
						</tr>
						<tr>
							<td><b>Status</b></td>
							<td>
								<select name="sts" id="sts" class='form-control'>
									<?php
									if($sts=='1'){
										echo "<option value='1' selected>Aktif</option>";
										echo "<option value='0'>Non-Aktif</option>";
									}else{
										echo "<option value='1'>Aktif</option>";
										echo "<option value='0' selected>Non-Aktif</option>";
									}
									?>
								<select></td>
							<td><b>Note</b></td>
							<td><textarea name="note" class='form-control'><?=$note?></textarea></td>
						</tr>
					</table>
					<table width="100%" class="table table-bordered table-hover" id="pilih_paket">
						<tr>
							<th style="text-align:center;background-color:lightblue">AREA</th>
							<th style="text-align:center;background-color:lightblue">SPESIFIKASI</th>
							<th style="text-align:center;background-color:lightblue">KETERANGAN</th>
							<th style="text-align:center;background-color:lightblue">HARGA</th>
						</tr>
						<?php
							$data_area = $this->order_model->get_area();
							if($data_area >0){
								$varx=0;
								foreach($data_area as $r_a){
									if($r_a->use == '0'){
										$tampilkan = 'show';
									}else{
										$tampilkan = 'none';
									}
									$varx++;
									$data_paket_detailx = $this->master_model->get_kategori_detx($id_paket,$r_a->id);
									$count = 1;
									if($data_paket_detailx > 0){
										foreach($data_paket_detailx as $r_paketx){
											$harga 			= floor($r_paketx->jumlah);
											$nm_keterangan 	= $r_paketx->nm_keterangan;
											$sfc			= $r_paketx->nm_sfesifikasi;
										}
									}else{
										$harga = 0;
										$nm_keterangan = "";
										$sfc	= "";
									}
								?>
								<tr style="display:<?=$tampilkan?>">
									<td rowspan="<?=$r_a->jum?>" width="30%"><b><?=$r_a->nm_area?></b></td>
									<td width="30%"><input type="text" class="form-control skills" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" id="skill_<?=$varx?>" name="area_<?=$r_a->id?>_ket[]" value="<?=$nm_keterangan?>"></td>
									<td width="25%"><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$sfc?>"></td>
									<td width="15%" id="harga_<?=$varx?>">
										<input type="text" class="form-control" readonly onkeypress="return isNumber(event)" value="<?=number_format($harga)?>">
										<input type="hidden" class="form-control" id="harga_<?=$varx?>" name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)" value="<?=$harga?>">
										
									</td>
									<input type="hidden" class="form-control" name="area_<?=$r_a->nm_area?>_nama[]">
								</tr>
								<?php
									$data_paket_detail = $this->master_model->get_kategori_det($id_paket,$r_a->id);
									$count = 1;
									if($data_paket_detail > 0){
										foreach($data_paket_detail as $r_paket){
										$varx++;
										$count++;
										$hargaxx = floor($r_paket->jumlah);
									?>
										<tr style="display:<?=$tampilkan?>">
											<td><input type="text" class="form-control skills" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" id="skill_<?=$varx?>" name="area_<?=$r_a->id?>_ket[]" value="<?=$r_paket->nm_keterangan?>"></td>
											<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$r_paket->nm_sfesifikasi?>"></td>
											<td id="harga_<?=$varx?>">
												<input readonly  type="text" class="form-control"  value="<?php if($hargaxx == 0){echo "0";}else{echo number_format($hargaxx);}?>">
												<input type='hidden'id="harga_<?=$varx?>" class="form-control" name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)" value="<?php if($hargaxx ==""){echo "0";}else{echo $hargaxx;}?>">
											</td>
												<input type="hidden" class="form-control" name="area_<?=$r_a->id?>_nama[]" value="<?=$r_a->nm_area?>">
										</tr>
									<?php
										}
									}
									for($i=1;$i<=($r_a->jum-1-($count));$i++){
									$varx++;
									?>
									<tr style="display:<?=$tampilkan?>">
										<td><input type="text" class="form-control skills" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" id="skill_<?=$varx?>" name="area_<?=$r_a->id?>_ket[]"></td>
										<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]"></td>
										<td id="harga_<?=$varx?>">
											<input type="text" class="form-control" readonly onkeypress="return isNumber(event)" value="">
											<input type="hidden" class="form-control" id="harga_<?=$varx?>" onkeypress="return isNumber(event)" name="area_<?=$r_a->id?>_harga[]">
										</td>
										<input type="hidden" class="form-control" name="area_<?=$r_a->id?>_nama[]" value="<?=$r_a->nm_area?>">
									</tr>
									<?php } ?>
									<td style="background-color:gray" colspan="4"></td>
								<?php
								}
							}
						?>
						<tr>
							<td colspan="4">
							<input type="hidden" class="form-control" name="jum_area" value="<?=count($data_area)?>">
							<input type="submit" class="btn btn-success pull-right" name="submit" onclick="return save()" value="Save"></td>
						</tr>
					</table>
				</form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="<?=base_url()?>dist/jquery-ui.css">
<script src="<?=base_url()?>plugins/jQuery/jquery-2.2.3.min"></script>
<script src="<?=base_url()?>dist/jquery-ui.js"></script>
<script>
	function save(){
		if($("#nm_paket").val()==""){
			alert('silahkan Isi Nama Paket !!');
			document.getElementById("nm_paket").focus();
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
	
	$(function() {
    $(".skills").autocomplete({
      source: '<?=base_url("index.php/master/search")?>'
	  });
    });
	function cari_harga(id,id2){
		var barang = $("#skill_"+id).val();
		$.get( "<?=base_url(); ?>index.php/master/cari_harga" , { option : barang, option2 : id2 } , function ( data ) {
			$( '#harga_'+id ) . html (data) ;
		} ) ;
	}
</script>