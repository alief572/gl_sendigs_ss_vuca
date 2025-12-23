<?php
	$q = $this->db->query("select c_customer from dk_counter");
	if($q->num_rows() > 0){
		$ret = $q->result();
		$kode			= $ret[0]->c_customer+1;
		if(strlen($kode)==1){
			$kdadd		= "0000";
		}else if(strlen($kode)==2){
			$kdadd		= "000";
		}else if(strlen($kode)==3){
			$kdadd		= "00";
		}else if(strlen($kode)==4){
			$kdadd		= "0";
		}else{
			$kdadd		= '0';
		}
		$kd_customer	= "C".date("ym")."|".$kdadd.$kode;
	}
	if($data_prospek > 0){
		foreach($data_prospek as $row){
			$pria			= $row->calon_pria;
			$wanita			= $row->calon_wanita;
			$tgl_resepsi	= $row->tgl_resepsi;
			$tempat1		= $row->tempat1;
			$tempat2		= $row->tempat2;
			$tempat3		= $row->tempat3;
			$jam			= $row->jam;
			$total_deal		= $row->total_deal;
		}
	}
?>

<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog modal-lg" style="display:show;">
		<div class="modal-content">
			<div class="modal-header modal-lg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Input Data Customer</h4>
			</div>
			<div id="message"></div>
				<div class="box-body table-responsive no-padding">
					<div class="form-group col-lg-12"  id="c_user_id">
						<table class="table table-bordered">
							<tr>
								<td width="35%">Kode Prospek</td><td ><input class="form-control" size="10" value="<?=$kd_prospek?>" readonly type="text"></td>
							</tr>
							<tr>
								<td>Kode Pelanggan</td><td><input class="form-control" size="1" value="<?=$kd_customer?>" readonly type="text"></td>
							</tr>
							<tr>
								<td>Tanggal Deal</td><td><input class="form-control" size="1" value="<?=date("d-M-Y")?>" readonly type="text"></td>
							</tr>
							<tr>
								<td>Nama Calon Pengantin Pria</td><td><input class="form-control" size="1" value="<?=$pria?>" readonly type="text"></td>
							</tr>
							<tr>
								<td>Nama Calon Pengantin Wanita</td><td><input class="form-control" size="1" value="<?=$wanita?>" readonly type="text"></td>
							</tr>
							<tr>
								<td>Tempat Resepsi</td><td><input class="form-control" size="1" value="<?=$tempat1?>" readonly type="text"></td>
							</tr><tr>
								<td></td><td><input class="form-control" size="1" value="<?=$tempat2?>" readonly type="text"></td>
							</tr><tr>
								<td></td><td><input class="form-control" size="1" value="<?=$tempat3?>" readonly type="text"></td>
							</tr>
							<tr>
								<td>Total Deal</td><td><input class="form-control" size="1" value="" readonly type="text"></td>
							</tr>
						</table>
						<table class="table table-bordered">
							<tr>
								<th>Area</th><th>Keterangan</th><th>Harga</th>
							</tr>
							<tr>
								<td>Area</td><td>Keterangan</td><td>Harga</td>
							</tr>
						</table>
					</div>
					<div class="form-group has-success btn-group col-lg-6"></div>
						<div class="form-group has-success col-lg-6"  id="c_">
						<input type="button" name="submit" value="Save" class='pull-right btn btn-success' onClick="return save();">
						<button class="btn btn-default pull-right" type="button" data-dismiss="modal">Close</button>
					</div>
				<!-- /.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>
<script>
function save(){
	$.get( "<?= base_url(); ?>index.php/order/save_penawaran" , { option :"" } , function ( data ) {
		$( '#message' ) . html ( data ) ;
	} ) ;
}
$(document).ready(function(){
	$('#penawaran').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
</script>
