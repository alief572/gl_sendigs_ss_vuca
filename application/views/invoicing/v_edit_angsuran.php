<?php $this->load->view('header');?>

<?php

	if($data_prospek > 0){

		foreach($data_prospek as $row){

			$pengantin = $row->calon_pria." & ".$row->calon_wanita;

			$telfon = $row->telfon;

			$email = $row->email1;

			$salesman = $row->salesman;

			$resepsi_date = $row->resepsi_date;

			$resepsi_time = $row->resepsi_jam;

			$tempat_resepsi = $row->tempat_resepsi;

			$alamat = $row->tempat1." ".$row->tempat2." ".$row->tempat3;

		}

	}

	if($list_invoice > 0){
		foreach($list_invoice as $row2){
			$no_cust = $row2->no_cust;
			$id_prospek = $row2->id_prospek;
			$id_penawaran	= $row2->id_penawaran;
		}
	}
/*
	if($total_deal > 0){
		foreach($total_deal as $row3){
			$dp1 = $row3->dp1;
			$dp2 = $row3->dp2;
			$dp3 = $row3->dp3;
			$dp4 = $row3->dp4;
			
		}
	}
*/
	if($data_angsuran1 > 0){
		foreach($data_angsuran1 as $row4){
			$bayar4 = $row4->bayar;
			$no_byr4 = $row4->no_bayar;
		}
	}
	if($data_angsuran2 > 0){
		foreach($data_angsuran2 as $row5){
			$bayar5 = $row5->bayar;
			$no_byr5 = $row5->no_bayar;
		}
	}
	if($data_angsuran3 > 0){
		foreach($data_angsuran3 as $row6){
			$bayar6 = $row6->bayar;
			$no_byr6 = $row6->no_bayar;
		}
	}
	if($data_angsuran4 > 0){
		foreach($data_angsuran4 as $row7){
			$bayar7 = $row7->bayar;
			$no_byr7 = $row7->no_bayar;
		}
	}

	if($tot_piutang > 0){
		foreach($tot_piutang as $row8){
			$tot_deal = $row8->total_deal;
			$total_piutang = $row8->piutang;
		}
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

		<div class="col-xs-12">

			<div class="box">

				<div class="row">

					<div class="box-header">

						<div class="box-body">

							<div class="box-body table-responsive no-padding">

							<table class="table table-bordered table-hover dataTable example1">

							<tbody>

								<tr>

									<td><b>ID Prospek</b></td>

									<td><?=$id_prospek?></td>

									<td><b>Nama Pengantin</b></td>

									<td><?=$pengantin?></td>

								</tr>


							</tbody>

							</table>

						</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
							<div class="box-body">
								<div class="box-body table-responsive no-padding">
									<form method="post" action="<?=base_url()?>index.php/invoice/proses_edit_angsuran" id="form-edit-angsuran"> <!-- arah proses -->
										<table class="table table-bordered">
											<tr>
												<td align="center" width="10%"><b>Angsuran Ke-</b></td>
												<td align="center" width="10%"><b>Jumlah Bayar</b></td>
												<td align="center" width="10%"><b>Piutang</b></td>
												<td align="center" width="10%"><b>Jumlah Angsuran</b></td>
											</tr>
											<tr>
												<input type="hidden" class="form-control" size='1' name="id_prospek" id="id_prospek" value="<?=$id_prospek?>">

												<td align="center">1</td>
												<td><input type="text" class="form-control" size='1' name="jml_byr1" id="jml_byr1" value="<?=number_format($bayar4)?>" readonly></td>
												<?php
													if($row4->angsuran_ed > 0){
												?>
												<td><input type="text" class="form-control" size='1' name="piutang1" id="piutang1" value="<?=number_format($row4->angsuran_ed - $bayar4)?>"readonly></td>
												<?php
													}else{
														$angsuran1 = $total_deal * 20/100;
												?>
												<td><input type="text" class="form-control" size='1' name="piutang1" id="piutang1" value="<?=number_format($angsuran1 - $bayar4)?>"readonly></td>
												<?php
													}
												?>

												<?php
													if($bayar4 > 0){ //jika sudah bayar
														if($row4->angsuran_ed > 0){ //jika ada edit angsuran
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran1" id="angsuran1" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row4->angsuran_ed)?>" readonly></td>
												<?php
														}else{
															
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran1" id="angsuran1" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran1)?>" readonly></td>
												<?php 
														}
													}else{ //jika belum bayar dan tidak edit angsuran
														if($row4->angsuran_ed > 0){
												?>
																		<td><input type="text" class="form-control" size='1' name="angsuran1" id="angsuran1" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row4->angsuran_ed)?>"></td>
											  <?php
														}else{															
												?>
																		<td><input type="text" class="form-control" size='1' name="angsuran1" id="angsuran1" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran1)?>"></td>
												<?php
														}
													}
												?>
											</tr>
											<tr>
												<td align="center">2</td>
												<td><input type="text" class="form-control" size='1' name="jml_byr2" id="jml_byr2" value="<?=number_format($bayar5)?>" readonly></td>
												<?php
													if($row5->angsuran_ed > 0){
												?>
												<td><input type="text" class="form-control" size='1' name="piutang2" id="piutang2" value="<?=number_format($row5->angsuran_ed - $bayar5)?>"readonly></td>
												<?php
													}else{
														$angsuran2 = $total_deal * 30/100;
												?>
												<td><input type="text" class="form-control" size='1' name="piutang2" id="piutang2" value="<?=number_format($angsuran2 - $bayar5)?>"readonly></td>
												<?php
													}
												?>

												<?php
													if($bayar5 > 0){ //jika sudah bayar
														if($row5->angsuran_ed > 0){ //jika ada edit angsuran
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran2" id="angsuran2" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row5->angsuran_ed)?>" readonly></td>
												<?php
														}else{
															
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran2" id="angsuran2" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran2)?>" readonly></td>
												<?php 
														}
													}else{ //jika belum bayar dan tidak edit angsuran
														if($row5->angsuran_ed > 0){
												?>
																		<td><input type="text" class="form-control" size='1' name="angsuran2" id="angsuran2" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row5->angsuran_ed)?>"></td>
												<?php
														}else{															
												?>
																		<td><input type="text" class="form-control" size='1' name="angsuran2" id="angsuran2" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran2)?>"></td>
												<?php
														}
													}
												?>
											</tr>
											<tr>
												<td align="center">3</td>
												<td><input type="text" class="form-control" size='1' name="jml_byr3" id="jml_byr3" value="<?=number_format($bayar6)?>" readonly></td>
												<?php
													if($row6->angsuran_ed > 0){
												?>
												<td><input type="text" class="form-control" size='1' name="piutang3" id="piutang3" value="<?=number_format($row6->angsuran_ed - $bayar6)?>"readonly></td>
												<?php
													}else{
														$angsuran3 = $total_deal * 25/100;
												?>
												<td><input type="text" class="form-control" size='1' name="piutang3" id="piutang3" value="<?=number_format($angsuran3 - $bayar6)?>"readonly></td>
												<?php
													}
												?>

												<?php
													if($bayar6 > 0){ //jika sudah bayar
														if($row6->angsuran_ed > 0){ //jika ada edit angsuran
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran3" id="angsuran3" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row6->angsuran_ed)?>" readonly></td>
												<?php
														}else{
															
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran3" id="angsuran3" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran3)?>" readonly></td>
												<?php 
														}
													}else{ //jika belum bayar dan tidak edit angsuran
														if($row6->angsuran_ed > 0){
												?>
															<td><input type="text" class="form-control" size='1' name="angsuran3" id="angsuran3" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row6->angsuran_ed)?>"></td>
												<?php
														}else{															
												?>
															<td><input type="text" class="form-control" size='1' name="angsuran3" id="angsuran3" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran3)?>"></td>
												<?php
														}
													}
												?>
											</tr>
											<tr>
												<td align="center">4</td>
												<td><input type="text" class="form-control" size='1' name="jml_byr4" id="jml_byr4" value="<?=number_format($bayar7)?>" readonly></td>
												<?php
													if($row7->angsuran_ed > 0){
												?>
												<td><input type="text" class="form-control" size='1' name="piutang4" id="piutang4" value="<?=number_format($row7->angsuran_ed - $bayar7)?>"readonly></td>
												<?php
													}else{
														$angsuran4 = $total_deal * 25/100;
												?>
												<td><input type="text" class="form-control" size='1' name="piutang4" id="piutang4" value="<?=number_format($angsuran4 - $bayar7)?>"readonly></td>
												<?php
													}
												?>

												<?php
													if($bayar7 > 0){ //jika sudah bayar
														if($row7->angsuran_ed > 0){ //jika ada edit angsuran
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran4" id="angsuran4" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row7->angsuran_ed)?>" readonly></td>
												<?php
														}else{
															
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran4" id="angsuran4" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran4)?>" readonly></td>
												<?php 
														}
													}else{ //jika belum bayar dan tidak edit angsuran
														if($row7->angsuran_ed > 0){
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran4" id="angsuran4" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($row7->angsuran_ed)?>"></td>
												<?php
														}else{															
												?>
												<td><input type="text" class="form-control" size='1' name="angsuran4" id="angsuran4" onkeypress="return angkaSaja(event);" onkeyup="return Calculation();" value="<?=number_format($angsuran4)?>"></td>
												<?php
													}
												}
												?>
											</tr>		
											
											<tr>
												<td></td>
												<td></td>
												<td  align="right"><b>TOTAL</b></td>
												<?php
													if($row4->angsuran_ed > 0){
														$total_angsuran_ed = $row4->angsuran_ed + $row5->angsuran_ed + $row6->angsuran_ed + $row7->angsuran_ed;													
												?>
												<td><input type="text" class="form-control" size='1' name="total" id="total" value="<?=number_format($total_angsuran_ed)?>" readonly></td>
												<?php
													}else{
														$total_angsuran = $angsuran1 + $angsuran2 + $angsuran3 + $angsuran4;
												?>
												<td><input type="text" class="form-control" size='1' name="total" id="total" value="<?=number_format($total_angsuran)?>" readonly></td>
												<?php
													}
												?>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td  align="right"><b>TOTAL SEBELUMNYA</b></td>
												<td><input type="text" class="form-control" size='1' name="prev_total" id="prev_total" value="<?=number_format($total_deal)?>" readonly></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td align="right"><a href="<?=base_url()?>index.php/invoice/list_inv" class="btn btn-primary" width="20%" >Cancel</a></td>	
												<td align="left"><input type="submit" class='btn btn-success' width="30%" name='Save' value='Save' onclick="return check();"></td>
											</tr>

										</table>
									</form>
								</div>
        			</div>
        		</div>
    			</div>
		  	</div>
		</div>
	</section>

<?php $this->load->view('footer');?>

<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script src="<?=base_url();?>dist/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
		var a1a = $('#angsuran1').val();
		var a2a = $('#angsuran2').val();
		var a3a = $('#angsuran3').val();
		var a4a = $('#angsuran4').val();
	   if(a1a=='' || a1a==null){
			a1a=0;
	   }
		 if(a2a=='' || a2a==null){
			a2a=0;
	   }
		 if(a3a=='' || a3a==null){
			a3a=0;
	   }
		 if(a4a=='' || a4a==null){
			a4a=0;
	   }
});

function angkaSaja(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function Calculation(){  
	var sub_tot		=0;
	
		var a1 = $('#angsuran1').val().replace(/\,/g,'');
		var a2 = $('#angsuran2').val().replace(/\,/g,'');
		var a3 = $('#angsuran3').val().replace(/\,/g,'');
		var a4 = $('#angsuran4').val().replace(/\,/g,'');

	sub_tot		= parseFloat(sub_tot) + parseFloat(a1) + parseFloat(a2) + parseFloat(a3) + parseFloat(a4); 
	
	grand_tot		= parseFloat(sub_tot);
	$('#total').val(grand_tot.format(0,3,','));
}

Number.prototype.format = function(n, x, s, c) {
	var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
	num = this.toFixed(Math.max(0, ~~n));

	return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

function check(){
	if($("#angsuran1").val() == ''){
		alert('silahkan isi angsuran 1');
		document.getElementById("angsuran1").focus();
		return false;
	}else if($("#angsuran2").val() == ''){
		alert('silahkan isi angsuran 2');
		document.getElementById("angsuran2").focus();
		return false;
	}else if($("#angsuran3").val() == ''){
		alert('silahkan isi angsuran 3');
		document.getElementById("angsuran3").focus();
		return false;
	}else if($("#angsuran4").val() == ''){
		alert('silahkan isi angsuran 4');
		document.getElementById("angsuran4").focus();
		return false;
	}else if($("#total").val() != $("#prev_total").val()){
		alert('TOTAL harus sama dengan TOTAL SEBELUMNYA');
		return false;
	}

	$('#form-edit-angsuran').submit();
}


</script>