<?php $this->load->view('header');?>
<?php
	$id_kategori	= $this->db->query("select c_paket from dk_counter");
	if($id_kategori->num_rows() > 0){
		$ret	= $id_kategori->result();
		$id		= $ret[0]->c_paket;
	}else{
		$id = 1;
	}
	$kd_barang = $id+1;
	if(strlen($kd_barang)==1){
		$kdadd		= "0000";
	}else if(strlen($kd_barang)==2){
		$kdadd		= "000";
	}else if(strlen($kd_barang)==3){
		$kdadd		= "00";
	}else if(strlen($kd_barang)==4){
		$kdadd		= "0";
	}else{
		$kdadd		= '0';
	}
	$thnbln			= date("ym");
	$id = "PKT".$thnbln."|".$kdadd.$kd_barang;
	$id_cust = "";
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
				<form action="<?=base_url()?>index.php/master/save_paket" method="post">
					<table class="table table-bordered table-hover">
						<tr>
							<td><b>ID Paket</b></td>
							<td><input type="text" name="id_paket" class='form-control' id="id_paket" value="<?=$id?>" readonly></td>
							<td><b>Nama Paket</b></td>
							<td><input type="text" name="nm_paket" class='form-control' id="nm_paket" value=""></td>
						</tr>
						<tr>
							<td><b>Nama Gedung</b></td>
							<td>
								<select name="gedung" id="gedung" class='form-control'>
									<option value="0">-Pilih Nama Gedung-</option>
									<?php
									if($data_gedung >0){
										foreach($data_gedung as $rows){
											echo "<option value='".$rows->id."+^".$rows->nm_gedung."'>".$rows->nm_gedung."</option>";
										}
									}
									?>
								</select>
							</td>
							<td><b>Harga Paket</b></td>
							<td><input type="text" name="harga" class='form-control' id="harga" onkeypress="return isNumber(event)" value=""></td>
						</tr>
						<tr>
							<td><b>Status</b></td>
							<td>
								<select name="sts" id="sts" class='form-control'>
									<option value="1">Aktif</option>
									<option value="0">Non-Aktif</option>
								<select></td>
							<td><b>Note</b></td>
							<td><textarea name="note" class='form-control'></textarea></td>
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
								$varx=0;;
								foreach($data_area as $r_a){
									if($r_a->use == '0'){
										$tampilkan = 'show';
									}else{
										$tampilkan = 'none';
									}
									$varx++;
									$data_paket_detailx = $this->order_model->get_kategori_detx($id_cust,$r_a->id);
									$count = 1;
									if($data_paket_detailx > 0){
										foreach($data_paket_detailx as $r_paketx){
											$harga 			= $r_paketx->jumlah;
											$nm_keterangan 	= $r_paketx->nm_keterangan;
											$sfc			= $r_paketx->nm_sfesifikasi;
										}
									}else{
										$harga = "";
										$nm_keterangan = "";
										$sfc	= "";
									}
								?>
								<tr style="display:<?=$tampilkan?>">
									<td rowspan="<?=$r_a->jum?>" width="30%"><b><?=$r_a->nm_area?></b></td>
									<td width="30%"><input type="text" id="skill_<?=$varx?>" class="form-control skills" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]" value="<?=$nm_keterangan?>"></td>
									<td width="25%"><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$sfc?>"></td>
									<td width="15%" id="harga_<?=$varx?>">
										<input type="text" class="form-control" name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)" readonly value="<?=$harga?>">
									</td>
									<input type="hidden" class="form-control" name="area_<?=$r_a->nm_area?>_nama[]">
								</tr>
								<?php
									$data_paket_detail = $this->order_model->get_kategori_det($id_cust,$r_a->id);
									$count = 1;
									if($data_paket_detail > 0){
										foreach($data_paket_detail as $r_paket){
										$count++;
										$varx++;
									?>
										<tr style="display:<?=$tampilkan?>">
											<td><input type="text" class="form-control skills" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]" id="skill_<?=$varx?>" value="<?=$r_paket->nm_keterangan?>"></td>
											<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]" value="<?=$r_paket->nm_sfesifikasi?>"></td>
											<td id="harga_<?=$varx?>">
											<input type="text" class="form-control" readonly name="area_<?=$r_a->id?>_harga[]" onkeypress="return isNumber(event)"  value="<?=$r_paket->jumlah?>">
											
											</td>
											<input type="hidden" class="form-control" readonly name="area_<?=$r_a->id?>_nama[]" value="<?=$r_a->nm_area?>">
										</tr>
									<?php
										}
									}
									for($i=1;$i<=($r_a->jum-1-($count));$i++){
									$varx++;
									?>
									<tr style="display:<?=$tampilkan?>">
										<td><input type="text" class="form-control skills" id="skill_<?=$varx?>" onchange="return cari_harga(<?=$varx?>,<?=$r_a->id?>)" name="area_<?=$r_a->id?>_ket[]"></td>
										<td><input type="text" class="form-control" name="area_<?=$r_a->id?>_sfc[]"></td>
										<td id="harga_<?=$varx?>">
											<input type="text" class="form-control" readonly onkeypress="return isNumber(event)" name="area_<?=$r_a->id?>_harga[]">
											
										</td>
										<input type="hidden" class="form-control" readonly id="harga_<?=$varx?>" name="area_<?=$r_a->id?>_nama[]" value="<?=$r_a->nm_area?>">
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
      source: 'search'
	  });
    });
	function cari_harga(id,id2){
		var barang = $("#skill_"+id).val();
		$.get( "<?= base_url(); ?>index.php/master/cari_harga" , { option : barang, option2 : id2 } , function ( data ) {
			$( '#harga_'+id ) . html (data) ;
		} ) ;
	}
</script>