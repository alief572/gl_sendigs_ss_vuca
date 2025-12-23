<?php $this->load->view('header');
	$Arr_Coa		= array();
	if($data_bank){
		foreach($data_bank as $key=>$vals){
			$kode_Coa			= $vals->no_perkiraan.'^'.$vals->nama;
			$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan.'  '.$vals->nama;
		}
	}

	if($data_project){
		foreach($data_project as $key=>$vals){
			$kode_Project				= $vals->id_penawaran;
			$Arr_Project[$kode_Project]	= $vals->id_penawaran.' - '.$vals->pengantin_pria.' & '.$vals->pengantin_wanita;
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
            <div class="box-header">
            <!-- /.box-header -->
             <!-- <div class="box-body table-responsive no-padding"> -->
			<form method="post" action="<?=base_url()?>index.php/invoice/proses_payment" autocomplete="off">
			<table class="table table-bordered">
			  <?php
			  if($data_invoice > 0){
				foreach($data_invoice as $row){
			  ?>
				<tr>
					<td width="15%"><b>No. BUM</b></td>
					<td width="25%">
						<span class="badge bg-maroon">Otomatis System</span>						
					</td>
					<td width="15%"></td>
					<td width="25%"></td>
				<tr>
					<td width="15%"><b>No. Project</b></td>
					<td width="25%">
						<select name="detail[1][project]"  id="project1"  class="form-control input-sm">
													<option value="">- Project -</option>
													<?php
													foreach($Arr_Project as $key=>$row2){
														echo "<option value='".$key."'>".$row2."</option>";

														//	echo "<option value='".$row2->id_penawaran." --- ".$row2->pengantin_pria."'>".$row2->id_penawaran." --- ".$row2->pengantin_pria."</option>";
														}
													?>
						</select>
					</td>
					<td width="15%"><b>Jumlah Tagih</b></td>
					<td width="25%">
						<input type="text" class="form-control" size='1' name="jumlah" value="<?=number_format($row->jumlah,0,",",".")?>" readonly>
					</td>
				</tr>
				<tr>
					<td><b>Nama Pengantin</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="prjct" value="<?=$row->pria?> & <?=$row->wanita?>" readonly>
					</td>
					<td><b>Materai</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="materai" value="<?=number_format($row->materai)?>" readonly>
					</td>
				</tr>
				<tr>
					<td><b>Dasar Pengenan Pajak</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="dpp" value="<?=number_format($row->dasar_ppn)?>" readonly>
					</td>
					<td><b>Total Penagihan</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="total" value="<?=number_format($row->total,0,",",".")?>" readonly>
					</td>
				</tr>
				<tr>
					<td><b>PPN</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="ppn" value="<?=number_format($row->ppn)?>" readonly>
					</td>
				</tr>

				<tr>
					<td><b>No. Kwitansi</b></td>
					<td><input type="text" class="form-control" name="no_kwitansi" value="<?=$row->no_kwitansi?>" placeholder="Automatic" readonly></td>
					<!--
					<td><b></b></td>
					<td>&nbsp;
					</td>
					-->
				</tr>
				
				<tr>
					<td><b>Tgl Kwitansi</b></td>
					<td><input type="text" class="form-control datepicker" id="datepicker" name="tgl_kwitansi" value="<?=date('d-m-Y')?>" format="yy-mm-dd" data-date-format="dd MM yyyy"></td>
					<!--
					<td><input type="text" class="form-control datepicker" name="tgl_kwitansi" value="<?=(empty($row->tgl_kwitansi)) ? '' : date('d F Y', strtotime($row->tgl_kwitansi))?>" data-date-format="dd MM yyyy"></td>
					-->

				</tr>

				<tr>
					<td><b>Sudah Terima Dari</b></td>
					<td><input type="text" class="form-control" name="receipt_by" value="<?=$row->pria?> & <?=$row->wanita?>"></td>
				<!-- <td><input type="text" class="form-control" name="receipt_by" value="<?=$row->receipt_by?>"></td> -->
				</tr>
				
				<tr>
					<td><b>Metode Pembayaran</b></td>
					<td>
						<select name="metode" class="form-control" id="metode">
						<?php
							for ($i=0; $i<count($pay_methods); $i++) { 
								$select_pay	= ($row->bayar_via == $pay_methods[$i]) ? "selected" : "";
								echo "<option value='$pay_methods[$i]' $select_pay>$pay_text[$i]</option>";
							}
						?>
						</select>
					</td>
					<!--
					<td><b>No. Reff</b></td>
					<td><input type="text" class="form-control" name="noref" value=""></td>
					-->
				</tr>
				<tr>
					<td><b>Bank</b></td>
					<td>
						<select name="nm_bank" class="form-control" id="nm_bank" onchange="return bank()">
							<option value="0">-Pilih Bank-</option>
							<?php
								foreach($Arr_Coa as $key=>$row2){
									echo "<option value='".$key."'>".$row2."</option>";														
									}

								/*
								if($data_owner > 0){
									foreach($data_owner as $rows){
										$select_bank	= ($rows->nm_bank == $row->bank) ? "selected" : "";
										echo "<option value='".$rows->nm_bank."' $select_bank>".$rows->nm_bank."</option>";
									}
								}
								*/
							?>
						</select>
					</td>
				</tr>
<!--
				<tr>
					<td><b>Cabang Bank</b></td>
					<td id="cab_bank_td">
						<select name="cab_bank" class="form-control" id="cab_bank">
							<option value="0">-Pilih Cabang Bank-</option>
							<?php
							if (!empty($row->norek)) {
								$cab_bank	= $this->db->query("SELECT cab_bank FROM dk_master_owner WHERE no_bank='$row->norek'")->row()->cab_bank;
								echo "<option value='$cab_bank' selected>$cab_bank</option>";
							}
							?>
						</select>
					</td>

					<td><b>Nomor Rekening</b></td>
					<td id="no_bank_td">
						<select name="no_bank" class="form-control" id="no_bank">
							<option value="0">-Pilih No Rekening-</option>
							<?php
							if (!empty($row->norek)) {
								echo "<option value='$row->norek' selected>$row->norek</option>";
							}
							?>
						</select>
					</td>
				
				</tr>
-->
				<tr>
					<td><b>Jumlah Dibayarkan</b></td>
					<td>
					<!--	<input type="text" class="form-control" size='1' onkeypress="return isNumber(event)" name="jum_bayar" id="jum_bayar" value="<?=$row->bayar?>">
					-->

						<input type="text" class="form-control" size='1' id="jum_bayar" name="jum_bayar" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" value="<?=$row->bayar?>"> 

					</td>
					<!--
					<td></td>
					<td></td>
					-->
				</tr>
				
				<tr>
					
						<td colspan="4"><input type="submit" name="submit" value="Save" onclick="return check()" class="btn btn-success pull-right"></td>
					
				</tr>
				<?php
					}
				}
				?>
				</table>
			  <div id="check_data">
			  <input type="hidden" name="check_cus" value="" id="check_cus">
			  </div>
			  </form>
            <!--</div>-->
        </div>
    </div>
    </div>
</section>
<?php $this->load->view('footer');?>

<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script>
	function check(){
		if($("#metode").val()=="0"){
			alert("Silahkan Pilih Metode Pembayaran");
			return false;
		}else if($("#nm_bank").val()=="0"){
			alert("Silahkan Pilih Bank");
			return false;
		}else if($("#cab_bank").val()=="0"){
			alert("Silahkan Pilih Cabang Bank");
			return false;
		}else if($("#no_bank").val()=="0"){
			alert("Silahkan Pilih Nomor Rekening Bank");
			return false;
		}else if($("#jum_bayar").val()==""){
			alert("Silahkan isi jumlah pembayaran");
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
	
	function bank(){	
		var nm_bank = $("#nm_bank").val();
		$.get( "<?= base_url(); ?>index.php/invoice/get_cabang" , { option : nm_bank } , function ( data ) {
			$( '#cab_bank_td' ) . html ( data ) ;
		} ) ;
		$.get( "<?= base_url(); ?>index.php/invoice/get_norek" , { option : nm_bank } , function ( data ) {
			$( '#no_bank_td' ) . html ( data ) ;
		} ) ;
	}

	$(document).ready(function(){
		$('.datepicker').datepicker({
			dateFormat:'yy-mm-dd',
			autoclose: true
		});
	});

	function tandaPemisahTitik(b){
		var _minus = false;
		if (b<0) _minus = true;
		b = b.toString();
		b=b.replace(".","");
		b=b.replace("-","");
		c = "";
		panjang = b.length;
		j = 0;
		for (i = panjang; i > 0; i--){
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)){
		c = b.substr(i-1,1) + "." + c;
		} else {
		c = b.substr(i-1,1) + c;
		}
		}
		if (_minus) c = "-" + c ;
		return c;
		}

		function numbersonly(ini, e){
		if (e.keyCode>=49){
		if(e.keyCode<=57){
		a = ini.value.toString().replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
		ini.value = tandaPemisahTitik(b);
		return false;
		}
		else if(e.keyCode<=105){
		if(e.keyCode>=96){
		//e.keycode = e.keycode - 47;
		a = ini.value.toString().replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
		ini.value = tandaPemisahTitik(b);
		//alert(e.keycode);
		return false;
		}
		else {return false;}
		}
		else {
		return false; }
		}else if (e.keyCode==48){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
		ini.value = tandaPemisahTitik(b);
		return false;
		} else {
		return false;
		}
		}else if (e.keyCode==95){
		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
		ini.value = tandaPemisahTitik(b);
		return false;
		} else {
		return false;
		}
		}else if (e.keyCode==8 || e.keycode==46){
		a = ini.value.replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = b.substr(0,b.length -1);
		if (tandaPemisahTitik(b)!=""){
		ini.value = tandaPemisahTitik(b);
		} else {
		ini.value = "";
		}

		return false;
		} else if (e.keyCode==9){
		return true;
		} else if (e.keyCode==17){
		return true;
		} else {
		//alert (e.keyCode);
		return false;
		}

	}

</script>
