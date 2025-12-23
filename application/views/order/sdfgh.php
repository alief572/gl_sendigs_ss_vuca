<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog modal-ex-lg" style="display:show;">
		<div class="modal-content modal-lg">
			<div class="modal-header modal-lg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Input Data Customer</h4>
			</div>
				<div class="box-body table-responsive no-padding">
				<div id="message">
					<table width="100%" class="table table-bordered">
						<tr>
							<td><b>ID Request</b></td>
							<td><input type="text" name="kd_penawaran" id="kd_penawaran" value="" readonly></td>
							<td><b>Nama Vendor</b></td>
							<td><input type="text" name="color_tone" id="color_tone" value="" ></td>
						</tr>
						<tr>
							<td><b>Jenis Vendor</b></td>
							<td><input type="text" name="kd_penawaran" id="kd_penawaran" value="" readonly></td>
							<td><b>Jumlah Reques</b></td>
							<td><input type="text" name="color_tone" id="color_tone" value="" ></td>
						</tr>
						<tr>
							<td><b>Komisi</b></td>
							<td><input type="text" name="kd_penawaran" id="kd_penawaran" value="" readonly></td>
							<td><b>ID Penawaran</b></td>
							<td><input type="text" name="color_tone" id="color_tone" value="" ></td>
						</tr>
						<tr>
							<td><b>Tanggal Awal Pakai</b></td>
							<td><input type="text" name="kd_penawaran" id="kd_penawaran" value="" readonly></td>
							<td><b>Tanggal Akhir Pakai</b></td>
							<td><input type="text" name="color_tone" id="color_tone" value="" ></td>
						</tr>
					</table>					
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
</div>

<script>
function save(){
		$.post( "<?= base_url(); ?>index.php/order/save_customer", {
		kd_penawaran : $("#kd_penawaran").val(),
		id_prospek : $("#id_prospek").val(),
		nocust : $("#nocust").val(),
		deal : $("#deal").val(),//format date
		pria : $("#pria").val(),
		wanita : $("#wanita").val(),
		telfon : $("#telfon").val(),
		email : $("#email").val(),
		email2 : $("#email2").val(),
		tgl_resepsi : $("#tgl_resepsi").val(),
		tempat1a : $("#tempat1a").val(),
		tempat2 : $("#tempat2").val(),
		tempat3 : $("#tempat3").val(),
		jam_resepsi : $("#jam_resepsi").val(),
		color_tone : $("#color_tone").val(),
		tema : $("#tema").val(),
		aaaaa : $("#aaaaa").val(),//15
		alamat1 : $("#alamat1").val(),
		kota1 : $("#kota1").val(),
		provinsi1 : $("#provinsi1").val(),
		panjang1 : $("#panjang1").val(),
		tinggi1 : $("#tinggi1").val(),
		lebar1 : $("#lebar1").val(),
		t_panggung1 : $("#t_panggung1").val(),
		jenis_paket : $("#jenis_paket").val(),
		inc_gedung : $("#inc_gedung").val(),
		harga : $("#harga").val()
		} , function ( data ) {
			$( '#message' ) . html ( data ) ;
		} ) ;
}
$(document).ready(function(){
	$('#deal').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
</script>
