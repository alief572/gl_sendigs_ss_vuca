<?php $this->load->view('header');
	$Arr_Coa=array();
	$Arr_Coa2=array();
	

	if($data_bank){
		foreach($data_bank as $key=>$vals){
			$kode_Coa			= $vals->no_perkiraan.'^'.$vals->nama;
			$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan.'  '.$vals->nama;
		}
	} 

	if($data_cash){
		foreach($data_cash as $key2=>$vals2){
			$kode_Coa2			= $vals2->no_perkiraan.'^'.$vals2->nama;
			$Arr_Coa2[$kode_Coa2]	= $vals2->no_perkiraan.'  '.$vals2->nama;
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
					<td width="15%"><b>No. Project</b></td>
					<td width="25%">
						<input type="text" class="form-control" size='1' name="noprjct" value="<?=$row->id_penawaran?>" readonly>
						<input type="hidden" class="form-control" size='1' name="inv" value="<?=$row->invoice_no?>" readonly>
						<input type="hidden" class="form-control" size='1' name="nocust" value="<?=$row->nocust?>" readonly>
					</td>
					<td width="15%"><b>Jumlah Tagih</b></td>
					<td width="25%">
						<input type="text" class="form-control" size='1' name="jumlah" value="<?=number_format($row->jumlah,0,",",".")?>" readonly>
					</td>
				</tr>
				<tr>
					<td><b>Nama Pengantin</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="nama" value="<?=$row->pria?> & <?=$row->wanita?>" readonly>
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
						<select name="metode" class="form-control" id="metode" onchange="return bank()">
							<?php
								for ($i=0; $i<count($pay_methods); $i++) { 
									$select_pay	= ($row->bayar_via == $pay_methods[$i]) ? "selected" : "";
									echo "<option value='$pay_methods[$i]' $select_pay>$pay_text[$i]</option>";
								}
							?>
						</select>			
					</td>
				</tr>

				<tr>
					<td><b>Bank</b></td>
					<td id="nm_bank_td">
						<select name="nm_bank" class="form-control" id="nm_bank">
							<option value="0">-Pilih Bank-</option>
							<?php
								foreach($Arr_Coa as $key=>$row){
									echo "<option value='".$key."'>".$row."</option>";														
									}
							?>
						</select>
					</td>
				</tr>

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
		var metode_cash = $("#metode").val();
		$.get( "<?= base_url(); ?>index.php/invoice/get_bank_cash" , { option : metode_cash } , function ( data ) {
			$( '#nm_bank_td' ) . html ( data ) ;
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
