<?php $this->load->view('header');?> 
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
            <div class="box-body table-responsive no-padding">
			<form method="post" action="<?=base_url()?>index.php/invoice/proses_edit_invoice" id="form-edit-invoice">
              <table class="table table-bordered">
			  <?php
			  if($data_invoice > 0){
				foreach($data_invoice as $row){
			  ?>

				<tr>
					<td width="20%"><b>Nomor Invoice</b></td>
					<td width="25%">
						<input type="hidden" class="form-control" size='1' name="id_prospek" value="<?=$row->id_prospek?>">
						<input type="hidden" class="form-control" size='1' name="no_byr" value="<?=$row->bayar_no?>">
						<input type="text" class="form-control" size='1' name="inv" value="<?=$row->invoice_no?>" readonly>
					</td>

					<td width="20%"><b>Due Date</b></td>
					<td width="25%">
						<input type="text" class="form-control datepicker" size='1' name="due_date" id="due_date" value="<?=date('d F Y', strtotime($row->due_date))?>" data-date-format="dd MM yyyy">
					</td>
				</tr>
				
				<tr>
				<td><b>Ditagihkan Oleh</b></td>
				<td>
						<select name="nm_owner" class="form-control" id="nm_owner">
							<option value="<?= $row->ditagihkan_oleh ?>"><?= $row->ditagihkan_oleh ?></option> <!-- <?=(empty($row->ditagihkan_oleh))?> -->
							<?php
							if($data_owner2 > 0){
								foreach($data_owner2 as $rows5){
									
									echo "<option value='".$rows5->nama."'>".$rows5->nama."</option>";
								}
							}
							?>
						</select>
					</td>
					<td><b>Besar Angsuran</b></td>
					<?php
		
						if($data_angsuran > 0){
							foreach($data_angsuran as $row3){
								$dt_edit_ang = $row3->angsuran_ed;
							}
						}
						if($total_deal > 0){
							foreach($total_deal as $row4){
								$tot_deal = $row4->total_deal;
							}
						}
						
						if($dt_edit_ang > 0){
							$dt_edit_ang = $row3->angsuran_ed;
						}else{
							$no_byr = $row->bayar_no;
							if($no_byr == 1){
								$persen = 20;									
								$dt_edit_ang = $total_deal * $persen/100;
							}elseif($no_byr == 2){
								$persen = 30;									
								$dt_edit_ang = $total_deal * $persen/100;
							}elseif($no_byr == 3){
								$persen = 25;									
								$dt_edit_ang = $total_deal * $persen/100;
							}else{
								$persen = 25;									
								$dt_edit_ang = $total_deal * $persen/100;
							}
						}
						
					?>
					<td>
						<input type="text" class="form-control" size='1' name="angsuran" id="angsuran" value="<?=$dt_edit_ang?>" onchange="return edit_angs()" readonly>
						<!-- 
							<input type="text" class="form-control" size='1' name="angsuran" id="angsuran" value="<?=$dt_edit_ang?>" onchange="return edit_angs()" readonly>
						-->
					</td>
			</tr>

				<tr>
					<td><b>Ditagihkan Kepada</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="billed_to" id="billed_to" value="<?=$row->billed_to?>">
					</td>

					<td><b>Jumlah Tagih</b></td>
					<td id="jml_td">
						<input type="text" class="form-control" size='1' name="jumlah" id="jumlah" value="<?=$row->jumlah?>" onchange="return hitung()">
					</td>
						<!--
						<?php
							if($row->bayar > 0){
						?>
						<td id="jml_td1">
							<input type="text" class="form-control" size='1' name="jumlah" id="jumlah1" value="<?=$row->jumlah?>" onchange="return hitung()" readonly>
						</td>
						<?php }else{ ?>
						<td id="jml_td">
							<input type="text" class="form-control" size='1' name="jumlah" id="jumlah" value="<?=$row->jumlah?>" onchange="return hitung()">
						</td>
						<?php } ?>
						-->
				</tr>

				<tr>
					<td><b>Dasar Pengenan Pajak</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="dpp" id="dpp" value="<?=$row->jumlah?>" readonly>
					</td>

					<td><b>Materai</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="materai" id="materai" value="<?=$row->materai?>" onchange="return hitung()">
					</td>
				</tr>

				<tr>
					<td><b>PPN</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="ppn" id="ppn" value="<?=$row->ppn?>" onchange="return hitung()">
					</td>

					<td><b>Total</b></td>
					<td>
						<input type="text" class="form-control" size='1' name="total" id="total" value="<?=$row->total?>" readonly>
						<input type="hidden" class="form-control" size='1' name="prev_total" id="prev_total" value="<?=number_format($total_deal)?>">
						<input type="hidden" class="form-control" size='1' name="update_total" id="update_total" value="<?=number_format($total_deal)?>" onchange="return hitung()">
					</td>
				</tr>

				<tr>
					<td colspan="4"><input type="submit" name="submit" value="Save" class="btn btn-success pull-right" onclick="return check();"></td>
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
            </div>
        </div>
    </div>
    </div>
</section>
<?php $this->load->view('footer');?>

<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/moment.min.js"></script>

<script type="text/javascript">

	function hitung(){

		var harga 		= parseFloat($("#jumlah").val());
		var materai 	= parseFloat($("#materai").val());
		var ppn 		= parseFloat($("#ppn").val());

		document.getElementById('dpp').value = harga;

		total = harga + materai + ppn;

		document.getElementById('total').value = total;
		//document.getElementById('total').value = number_format(total,0,",",".");
	}

	function edit_angs(){	
		//var jml_berubah 		= parseFloat($("#jumlah").val());
		var ubah_angs 	= parseFloat($("#angsuran").val());

		document.getElementById('jumlah').value=ubah_angs;
		//document.getElementById('dpp').value=ubah_angs;

		var harga 		= parseFloat($("#jumlah").val());
		var materai 	= parseFloat($("#materai").val());
		var ppn 		= parseFloat($("#ppn").val());

		document.getElementById('dpp').value=harga;

		total = harga + materai + ppn;

		document.getElementById('total').value=total;
	}

	function check(){
	if($("#due_date").val() == ''){
		alert('silahkan isi due_date');
		document.getElementById("due_date").focus();
		return false;
	}else if($("#angsuran").val() == ''){
		alert('silahkan isi Besar Angsuran');
		document.getElementById("angsuran").focus();
		return false;
	}else if($("#nm_owner").val() == ''){
		alert('silahkan isi Ditagihkan Oleh');
		document.getElementById("nm_owner").focus();
		return false;
	}else if($("#billed_to").val() == ''){
		alert('silahkan isi Ditagihkan Kepada');
		document.getElementById("billed_to").focus();
		return false;
	}else if($("#jumlah").val() == ''){
		alert('silahkan isi Jumlah Tagih');
		document.getElementById("jumlah").focus();
		return false;	
	}else if($("#dpp").val() == ''){
		alert('silahkan isi Dasar Pengenaan Pajak');
		document.getElementById("dpp").focus();
		return false;
	}else if($("#materai").val() == ''){
		alert('silahkan isi Materai');
		document.getElementById("materai").focus();
		return false;
	}else if($("#ppn").val() == ''){
		alert('silahkan isi ppn');
		document.getElementById("ppn").focus();
		return false;
	}else if($("#update_total").val() != $("#prev_total").val()){
		alert('Ubah Angsuran, tidak sesuai Total Deal');
		return false;
	}else if($("#jumlah").val() != $("#angsuran").val()){
		alert('Jumlah tagih harus sama dengan Besar Angsuran');
		document.getElementById("jumlah").focus();
		return false;
	}else{
		$('#form-edit-invoice').submit();
	}
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