<?php 
$this->load->view('header');
$Arr_Coa		= array();
$Arr_Coa_bank		= array();
$Arr_Project	= array();

if($data_bank){
	foreach($data_bank as $key=>$vals){
		$kode_Coa			= $vals->no_perkiraan.'^'.$vals->nama;
		$Arr_Coa_bank[$kode_Coa]	= $vals->no_perkiraan.'  '.$vals->nama;
	}
}

if($data_perkiraan){
	foreach($data_perkiraan as $key=>$vals){
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
<section class="content">     
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<form method="post" action="<?=base_url()?>index.php/jurnal/proses_input_dana_masuk_lain" id="form-proses-bro">   
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Detail Dana Masuk Lain-lain</h3>		
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group row">
							<label class="control-label col-sm-2">No. BUM</label>
							<div class="col-sm-4">
								<span class="badge bg-maroon">Otomatis System</span>
							</div>
							<label class="control-label col-sm-2">Tgl Input</label>
							<div class="col-sm-4">
								<!-- tgl input -->
								<input type="hidden" class="form-control" size='1' id="datepicker1" format="yy-mm-dd" data-date-format="yyyy-mm-dd" name="tanggal" value="<?=date("Y-m-d")?>">
								<input type="text" class="form-control" size='1' id="datepicker" name="tanggal_tampil" value="<?=date('d-m-Y')?>">

								<!-- nomor kwitansi 
								<input type="hidden" class="form-control" name="no_kwitansi" value="<?=$row->no_kwitansi?>" placeholder="Automatic" readonly> -->

								<!-- tgl kwitansi -->
								<input type="hidden" class="form-control" size='1' id="datepicker" name="tgl_kwitansi" value="<?=date('d-m-Y')?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Terima Dari</label>
							<div class="col-sm-4">
								<input type="text" class="form-control input-sm" name="terimadr" id="terimadr" autocomplete="off">
							</div>
							<label class="control-label col-sm-2">Note</label>
							<div class="col-sm-4">
								<textarea cols="75" rows="2" class="form-control input-sm" name="note" id="note"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Setor Ke</label>
							<div class="col-sm-4">
								<select name="setorke"  id="setorke"  class="form-control input-sm">
									<option value=""> -- PILIH --</option>
										<?php
										foreach($Arr_Coa_bank as $key=>$row2){
											echo "<option value='".$key."'>".$row2."</option>";														
											}
										?>
								</select>
							</div>
							<label class="control-label col-sm-2">No. Cek/Giro</label>
							<div class="col-sm-4">
								<div class="btn-group">
									<select name="jenistransf"  id="jenistransf"  class="form-control input-sm">
										<option selected>-Metode Pembayaran-</option>
										<option value="Cash">Cash</option>
										<option value="Check">Check</option>
										<option value="BG">BG</option>
										<option value="Transfer">Transfer</option>
									</select>
								</div>
								<div class="btn-group">
									<input type="text" class="form-control input-sm" name="nocek" id="nocek">
								</div>
							</div>
						</div>
											
					</div>
					<div class="box-body">
						<!--<div class="box box-warning">-->
							<div class="box-header">
								<h3 class="box-title">Detail Transaction</h3>		
							</div>
							<!-- /.box-header -->
							<!--<div class="box-body" style="overflow-x:scroll;">-->								
								<table class="table table-bordered table-striped">
									<thead>
										<tr class="bg-blue">
											<th class="text-center">No Perkiraan</th>
											<th class="text-center">Keterangan</th>
											<th class="text-center">No. Reff</th>
											<th class="text-center">Jumlah</th>
											<th class="text-center">Option</th>
										</tr>
									</thead>
									<tbody id="list_detail">
										<tr id="tr_1">
											<td>
												<select name="detail[1][noperkiraan]"  id="noperkiraan1"  class="form-control input-sm">
													<option value="">- No.Perkiraan -</option>
													<?php
													foreach($Arr_Coa as $key=>$row2){
														echo "<option value='".$key."'>".$row2."</option>";

														//	echo "<option value='".$row2->no_perkiraan." --- ".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
														}
													?>
												</select>
											</td> 
											<td>
												<input type="text" class="form-control input-sm" id="keterangan1" name="detail[1][keterangan]" placeholder="- Keterangan -" value="">
											</td>
											<td> 
												<select name="detail[1][project]"  id="project1"  class="form-control input-sm">
													<option value="Umum">  Umum  </option>
													<?php
													foreach($Arr_Project as $key=>$row2){
														echo "<option value='".$key."'>".$row2."</option>";

														//	echo "<option value='".$row2->id_penawaran." --- ".$row2->pengantin_pria."'>".$row2->id_penawaran." --- ".$row2->pengantin_pria."</option>";
														}
													?> 
												</select>
											</td>
											<td>
												<?php
													echo form_input(array('id'=>'jumlah1','name'=>'detail[1][jumlah]','class'=>'form-control input-sm harga','onblur'=>'stopCalculation();','onfocus'=>'startCalculation(1);','data-decimal'=>'.','data-thousand'=>'','data-prefix'=>'','data-precision'=>'0'));
												?>
											</td>
											<td class="text-center">
												<button type="button" class="btn btn-md btn-primary" id="add_field_button">Tambah</button>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr class="bg-gray">
											<td colspan="3" class="text-center"><b>Grand Total</b></td>
											<td>
												<input type="text" class="form-control input-sm" name="total" id="total" readOnly>
											</td>
											<td></td>
										</tr>
									</tfoot>
								</table>
								
							<!-- 	</div>
						</div>>-->
					</div>
					<div class="box-footer">
						<?php
						echo form_button(array('type'=>'button','class'=>'btn btn-md btn-success','value'=>'save','content'=>'SIMPAN','id'=>'simpan-bro')).' ';
						//echo form_button(array('type'=>'button','class'=>'btn btn-md btn-danger','value'=>'back','id'=>'btn-back','content'=>'KEMBALI','onClick'=>'javascript:back()'));
						?>
						<a href="<?=base_url()?>index.php/jurnal/list_dana_masuk_lain" class="btn btn-danger">KEMBALI</a>
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
<script src="<?=base_url();?>dist/jquery.min.js">
<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>
<script>
var data_coa		= <?php echo json_encode($Arr_Coa);?>;
var data_project	= <?php echo json_encode($Arr_Project);?>;
 var max_fields     = 15; //maximum records
$(document).ready(function() {
   $(".harga").maskMoney();
   $('#simpan-bro').click(function(e){
	   e.preventDefault();
	   $('#simpan-bro, #btn-back').prop('disabled',true);
	   loading_spinner();
	   
	   var bayar_to		= $('#terimadr').val();
	   var bank_bayar	= $('#setorke').val();
	   var tipe_bayar	= $('#jenistransf').val();
	   var notes		= $('#note').val();
	   if(bayar_to=='' || bayar_to==null || bayar_to=='-'){
		   close_spinner();
		   alert('Terima dari belum diinput, mohon input terima dari terlebih dahulu..');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   if(bank_bayar=='' || bank_bayar==null){
		   close_spinner();
		   alert('Coa Bank /  Kas belum dipilih, mohon pilih Coa Pembayaran terlebih dahulu..');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   if(tipe_bayar=='' || tipe_bayar==null){
		   close_spinner();
		   alert('Jenis Pembayaran belum dipilih, mohon pilih Jenis Pembayaran terlebih dahulu..');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   if(notes=='' || notes==null || notes=='-'){
		   close_spinner();
		   alert('Note detail belum diinput, mohon input Note terlebih dahulu..');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   var intC	= 0;
	   var intD	= 0;
	   var intP	= 0;
	   var intJ	= 0;
	   $('#list_detail').find('tr').each(function(){			
			var nil		= $(this).attr('id');
			var jum		= nil.split('_');
			var loop	= jum[1];
			var kode_coa 	= $('#noperkiraan'+loop).val();
			var descr		= $('#keterangan'+loop).val();
			var project 	= $('#project'+loop).val();
			var nilai		= $('#jumlah'+loop).val().replace(/\,/g,'');
			if(kode_coa =='' || kode_coa==null){
				intC++;
			}
			if(descr =='' || descr==null || descr=='-'){
				intD++;
			}
			if(project =='' || project==null){
				intP++;
			}
			if(nilai =='' || nilai==null || parseInt(nilai) < 1){
				intJ++;
			}
	   });
	   if(intC > 0){
		   close_spinner();
		   alert('No Perkiraan Belum dipilih. Mohon pilih no perkiraan terlebih dahulu');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   if(intD > 0){
		   close_spinner();
		   alert('Keterangan detail Belum diinput. Mohon input keterangan terlebih dahulu');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   if(intP > 0){
		   close_spinner();
		   alert('Project Belum dipilih. Mohon pilih project terlebih dahulu');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   
	   if(intJ > 0){
		   close_spinner();
		   alert('Nilai Trnsaksi kosong. Mohon input nilai transaksi terlebih dahulu');
		   $('#simpan-bro, #btn-back').prop('disabled',false);
		   return false;
	   }
	   
	   $('#form-proses-bro').submit();
   });
   $('#add_field_button').click(function(){
	   var total_row	= parseInt($('#list_detail').find('tr').length);
	   if(total_row < max_fields){
		    var last_row	= $('#list_detail tr:last').attr('id');
			var beda		= last_row.split('_');
			var awal		= parseInt(beda[1]) + 1;
			
			var Template		= '<tr id="tr_'+awal+'">';
			
				Template		+=	'<td>';
					Template	+=		'<select name="detail['+awal+'][noperkiraan]" id="noperkiraan'+awal+'" class="form-control input-sm">';
						Template+=			'<option value="">- No Perkiraan -</option>';
						$.each(data_coa,function(key,nilai){
							Template	+=	'<option value="'+key+'">'+nilai+'</option>';
						});
					Template	+=		'</select>';
				Template		+=	'</td>';
				Template		+=	'<td>';
					Template	+=		'<input type="text" name="detail['+awal+'][keterangan]" id="keterangan'+awal+'" class="form-control input-sm">';
				Template		+=	'</td>';
				Template		+=	'<td>';
					Template	+=		'<select name="detail['+awal+'][project]" id="project'+awal+'" class="form-control input-sm">';
						Template+=			'<option value="Umum">  Umum  </option>';
						$.each(data_project,function(key,nilai){
							Template	+=	'<option value="'+key+'">'+nilai+'</option>';
						});
					Template	+=		'</select>';
				Template		+=	'</td>';
				Template		+=	'<td>';
					Template			+='<input type="text" class="form-control input-sm harga" name="detail['+awal+'][jumlah]" id="jumlah'+awal+'" onblur="stopCalculation();" onfocus="startCalculation('+awal+');" data-decimal="." data-thousand="" data-prefix="" data-precision="0">';
				Template		+=	'</td>';
				Template	+='<td align="center"><button type="button" class="btn btn-sm btn-danger" onClick="return DelRow('+awal+');">Delete <i class="fa fa-trash-o"></i></button></td>';
			
			Template			+='</tr>';
			$('#list_detail').append(Template);
			$('.harga').maskMoney();
			$('#noperkiraan'+awal+', #project'+awal).chosen();
	   }
   });
    $('#datepicker').datepicker({
		dateFormat:'yy-mm-dd'
	});
	
});

function DelRow(id){
	$('#list_detail #tr_'+id).remove();	
	Calculation();
}
function startCalculation(id){  
	intervalCalculation = setInterval('Calculation()',1);
}
function Calculation(){  
	var sub_tot		=0;
	
	
	$('#list_detail').find('tr').each(function(){			
		var nil		= $(this).attr('id');
		var jum		= nil.split('_');
		var loop	= jum[1];
		var awal	= $('#jumlah'+loop).val().replace(/\,/g,'');
		if(awal=='' || awal==null){
			var awal	= 0;
		}
		sub_tot		= parseFloat(sub_tot) + parseFloat(awal); 
		
	});
	
	grand_tot		= parseFloat(sub_tot);
	$('#total').val(grand_tot.format(0,3,','));
}
function stopCalculation(){   
	clearInterval(intervalCalculation);
}
Number.prototype.format = function(n, x, s, c) {
	var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
	num = this.toFixed(Math.max(0, ~~n));

	return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};					
		

</script>
