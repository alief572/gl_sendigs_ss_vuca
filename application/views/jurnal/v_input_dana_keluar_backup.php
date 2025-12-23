<?php $this->load->view('header');?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>dist/jquery.timepicker.css">

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
								<form method="post" action="<?=base_url()?>index.php/jurnal/proses_input_dana_keluar">
									<table class="table table-bordered">
										<tr>
											<td width="15%">No. BUK</td>
											<td>
												<?php $no_keluar	= $this->Jurnal_model->get_no_buk();?>
												<input type="text" class="form-control" size='1' name="kd_buk" value="<?=$no_keluar?>">
											</td>					
											<td align='right' width="10%">Tanggal Input</td>
											<td>
												<input type="text" class="form-control" size='1' id="datepicker" format="yy-mm-dd" data-date-format="yyyy-mm-dd" name="tanggal" value="<?=date("Y-m-d")?>">
											</td>				
										</tr>

										<tr>
											<td>Bayar Kepada</td>
											<td>
												<input type="text" class="form-control" size='2' name="kepada" value="">
											</td>

											<td align='right'>Note</td>
											<td>
												<input type="text" class="form-control" size='2' name="note" value="">
											</td>
										</tr>

										<tr>
											<td>Uang keluar dari</td>
											<td>												
												<select name="keluardari"  id="keluardari"  class="form-control">
													<option value=""></option>
														<?php
														foreach($data_keluar as $row2){
															echo "<option value='keluardari_opt[]'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";

																//echo "<option value='".$row2->no_perkiraan."+^".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
															}
														?>
												</select>											
											</td>
											
											<td align='right'>No. Cek/Giro</td>
											<td>
												<select name="jenistransf"  id="jenistransf"  class="form-control">
													<option selected>-Metode Pembayaran-</option>
													<option value="cash">Cash</option>
													<option value="cek">Check</option>
													<option value="bg">BG</option>
													<option value="transfer">Transfer</option>
												</select>	
												<input type="text" class="form-control" size='2' name="nocek" value="">
											</td>
										</tr>
									</table>

									<table class="table table-bordered">
										<tr></tr>
									</table>

									<table class="table table-bordered">			  	
										<tr>
											<td width="25%">No. Perkiraan</td>
											<td width="20%">Keterangan</td>									
											<td width="20%">Project</td>
											<td width="15%">Jumlah</td>
											<td>Option</td>
																				
										</tr>
						
										<tr>
											<td colspan="6">
												<div class="form-group has-success col-lg-3">
													<select name="noperkiraan[]"  id="noperkiraan"  class="form-control">
															<option value="">- No.Perkiraan -</option>
																<?php
																foreach($data_perkiraan as $row2){
																	echo "<option value='".$row2->no_perkiraan."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";

																	//	echo "<option value='".$row2->no_perkiraan." --- ".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
																	}
																?>
													</select>
												</div>

												<div class="form-group has-success col-lg-2">
													<input type="text" class="form-control" size='1' id="keterangan" name="keterangan[]" placeholder="- Keterangan -" value="">
												</div>
	
												<div class="form-group has-success col-lg-3">
													<select name="project[]"  id="project"  class="form-control">
															<option value="">- Project -</option>

														<?php
														foreach($data_project as $row2){
															echo "<option value='".$row2->id_penawaran."'>".$row2->id_penawaran." --- ".$row2->pengantin_pria."</option>";

															//	echo "<option value='".$row2->id_penawaran." --- ".$row2->pengantin_pria."'>".$row2->id_penawaran." --- ".$row2->pengantin_pria."</option>";
															}
														?>
													</select>
												</div>									
											
										
												<div class="form-group has-success col-lg-2">
													<input type="number" class="form-control prc" id="jumlah" name='jumlah[]' onkeypress="return isNumber(event)" placeholder="Masukan jumlah " value="">
												</div>									
											

												<div class="form-group has-success">
													<a href="#" class="form-group has-success col-lg-2 remove_field">
														<button class="btn btn-primary add_field_button">Tambah</button>
													</a>
												</div>

												<div class="input_fields_wrap"></div>
											</td>
										</tr>
										
										<tr>
											<td></td>
											<td></td>
											<td></td>											
											<td>
											TOTAL
												<output id="total"></output>
												<!--<output type="text" class="form-group" id="total" name='total' value="" readonly>-->
											</td>
										
										</tr>

										<tr>
											<td colspan="6" align="center"><input type="submit" class='btn btn-success btn-lg' name='submit' value='Simpan' onclick="return check();"></td>
										</tr>
									</table>
								</form>
							</div>
						</div>
		  		</div>
				</div>
			</div>
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

<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>
<script>

$(document).ready(function() {
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
			$(wrapper).append('<?php echo "<div><div class=\"form-group has-success col-lg-3\"><select class=\"form-control\" id=\"noperkiraan\" name=\"noperkiraan[]\">";
									echo "<option value=\"\">- No.Perkiraan -</option>";
									foreach($data_perkiraan as $row2){
										$nokira = $row2->no_perkiraan." --- ".$row2->nama;
										
									//	echo "<option value=\"$nokira\">$nokira</option>";
										echo "<option value=\"noperkiraan_opt[]\">$nokira</option>";
									}
								
			echo "</select></div><div class=\"form-group has-success col-lg-2 \"><input class=\"form-control\" type=\"text\" placeholder=\"- Keterangan -\" name=\"keterangan[]\"></div><div class=\"form-group has-success col-lg-3\"><select name=\"project[]\" id=\"project\" class=\"form-control\">";
									echo "<option value=\"\">- Project -</option>";
									foreach($data_project as $row2){
										$proyek = $row2->id_penawaran." --- ".$row2->pengantin_pria;
										
									//	echo "<option value=\"$proyek\">$proyek</option>";
										echo "<option value=\"project_opt[]\">$proyek</option>";
									}
			echo "</select></div><div class=\"form-group has-success col-lg-2\" placeholder=\"Masukan jumlah\"><input class=\"form-control prc\" type=\"number\" placeholder=\"Masukan jumlah\" name=\"jumlah[]\"></div><a href=\"#\" class=\"form-group has-success col-lg-2 remove_field\"><button class=\"btn btn-warning\">Hapus</button></a></div>";?>')
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
					/*
				function check(){
					fCode = document.getElementsByName("qty_2[]");
					fCode2 = document.getElementsByName("nm_barang_2[]");

					for ( var i = 0; i < fCode.length; i++ ){
						if ( fCode[i].value == "" && fCode2[i].value != "0") {
							alert("Silahkan isi jumlah barang non spd");
							fCode[i].focus();
							return false;
						}
					}
				}
					*/
		$('.form-group').on('input',' .prc',function(){
			var totalSum = 0;
			$('.form-group .prc').each(function(){
				//var inputVal = $(this).val();
				//jum = document.getElementByName("jumlah[]");
							var rpjum = $(this).val();
							if($.isNumeric(rpjum)){
								totalSum += parseFloat(rpjum);
							}
			});
			$('#total').val(totalSum);
		});



$(document).ready(function(){
	$('#datepicker').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
</script>

<script src="<?=base_url();?>dist/jquery.min.js">
	
</script>