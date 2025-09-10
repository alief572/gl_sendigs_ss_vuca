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
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
			<?php
if($nominal_invoice > 0){
	foreach($nominal_invoice as $row5){		
		if($no == 1){
			if($row5->angsuran_ed > 0){
				$bayar = $row5->angsuran_ed;
			}else{
				$persen = 20;									
				$bayar = $total_deal * $persen/100;
			}
		}else if($no == 2){
			if($row5->angsuran_ed > 0){
				$bayar = $row5->angsuran_ed;
			}else{
				$persen = 30;									
				$bayar = $total_deal * $persen/100;
			}
		}else if($no == 3){
			if($row5->angsuran_ed > 0){
				$bayar = $row5->angsuran_ed;
			}else{
				$persen = 50;									
				$bayar = $total_deal * $persen/100;
			}
		}else if($no == 4){
			if($row5->angsuran_ed > 0){
				$bayar = $row5->angsuran_ed;
			}else{
				$persen = 50;									
				$bayar = $total_deal * $persen/100;
			}
		}
	}//tutup foreach
}//tutup if induk

	foreach($data_invoice as $row6){
	
		$id_prospek = $row6->id_prospek;
		$tempat_resepsi = $row6->tempat1;
		$tgl_resepsi = $row6->tanggal_respsi;
		$jam_resepsi = date('H:i', strtotime($row6->jam_resepsi));
		$dp1 = $row6->dp1;
		$dp2 = $row6->dp2;
		$nocust = $row6->nocust;
		$dp3 = $row6->dp3;
		$dp4 = $row6->dp4;
		/*
		$total_deal = $row6->total_deal;
		$sisa_total = $total_deal;
		$bayar = $sisa_total * $persen/100;
		
		if($no == 3){
			$bayar = $total_deal - $dp1 - $dp2 - $dp3 - $dp4;
		}
		*/
	}
	if($data_owner > 0){
		foreach($data_owner as $row7){
			$perusahaan	= $row7->nama;
			$alamat		= $row7->alamat;
			$kecamatan	= $row7->kecamatan;
			$kota		= $row7->kota;
			$no_telfon	= $row7->no_telfon;
			$email1		= $row7->email1;
			$nm_bank	= $row7->nm_bank;
			$nm_bank2	= $row7->nm_bank2;
			$no_bank	= $row7->no_bank;
			$no_bank2	= $row7->no_bank2;
			$cab_bank	= $row7->cab_bank;
			$cab_bank2	= $row7->cab_bank2;
			$an_bank	= $row7->an_bank;
			$an_bank2	= $row7->an_bank2;
		}
	}
	
	
	if($data_customer > 0){
		foreach($data_customer as $rows){
			$id_prospek = $rows->id_prospek;
			$id_penawaran = $rows->id_penawaran;
			$nama = $rows->pengantin_pria." & ".$rows->pengantin_wanita;
			$id_penawaran = $rows->id_penawaran;
		}
	}
?>	
		<form action="<?=base_url()?>index.php/invoice/print_invoice/<?=$this->uri->segment(3)."/".$this->uri->segment(4);?>" method="post" autocomplete="off">
		<table width="100%" class="table table-bordered" width='100%'>
			<tr>
				<th rowspan="4" width="60"><img src="<?=base_url()?>/assets/logo.jpg" height="80" width="180"></th>
				<th style="text-align:right" class="font"><h1>INVOICE</h1></th>
			</tr>
		</table>
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4" width="50%"><?=$alamat."<br>".$kecamatan.",".$kota."<br>".$no_telfon."<br>".$email1;?></td>
				<td align="right" colspan="4"><?=$alamat."<br>".$kecamatan.",".$kota."<br>".$no_telfon."<br>".$email1;?></td>
			</tr>
			<tr>
				<td width="20%" colspan="2" style="border: 0">Ditagihkan Oleh <span style="float: right">:</span></td>
				<!--<td style="border: 0" colspan="2"><input type="text" name="billed_to" value="" size="50" required></td>-->
				<td style="border: 0" colspan="2">
						<select name="nm_owner" class="form-control" id="nm_owner">
							<option value="">-Pilih-</option>
							<?php
							$data_owner2	= $this->invoice_model->get_owner2();
							if($data_owner2 > 0){
								foreach($data_owner2 as $rows5){
									echo "<option value='".$rows5->nama."'>".$rows5->nama."</option>";
								}
							}
							?>
						</select>
					</td>
			</tr>
			<tr>
				<td width="20%" colspan="2" style="border: 0">Ditagihkan Kepada <span style="float: right">:</span></td>
				<td style="border: 0" colspan="2"><input type="text" name="billed_to" value="<?=$nama?>" size="50" required></td>
			</tr>
			<tr>
				<td colspan="2" style="border: 0">Due Date <span style="float: right">:</span></td>
				<td style="border: 0"><input type="text" name="due_date" value="" id="due_date" class="datepicker" format="dd-mm-yyyy" data-date-format="dd MM yyyy" required></td>
			</tr>
			<tr>
				<td align="center" width="25%" colspan="2"><b>No Invoice</b></td>
				<td align="center" width="25%" colspan="2"><b>ID Customer</b></td>
				<td align="center" width="25%" colspan="2"><b>Nama Pengantin</b></td>
				<td align="center" width="25%" colspan="2"><b>No Penawaran</b></td>
			</tr>
			<tr>
				<?php
					$inv_nox 	= $this->invoice_model->get_inv_no();
					$inv_nox  	= $inv_nox+1;
					$inv_no 	= "INV".date("ym").$inv_nox;
				?>
				<td align="center" width="25%" colspan="2"><?=$inv_no?></td>
				<td align="center" width="25%" colspan="2"><?=$nocust?></td>
				<td align="center" width="25%" colspan="2"><?=$nama?></td>
				<td align="center" width="25%" colspan="2"><?=$id_penawaran?></td>
			</tr>
			<tr class="bg-gray disabled color-palette">
				<td align="center" width="5%"><b>No<br></b></td>
				<td align="center" width="32%" colspan="2"><b>Keterangan<br></b></td>
				<td align="center" width="5%"><b>Jumlah<br></b></td>
				<td align="center" width="10%"><b>Tgl Resepsi<br></b></td>
				<td align="center" width="20%"><b>Tempat Resepsi<br></b></td>
				<td align="center" width="10%"><b>Jam<br></b></td>
				<td align="center" width="10%"><b>Harga (Rp)<br></b></td>
			</tr>
			<tr>
				<td align="center" width="3%">1.</td>
				<td align="center" width="32%" colspan="2">Pembayaran ke-<?=$no?> Paket Dekorasi (Spesifikasi Terlampir)</td>
				<td align="center" width="5%">1</td>
				<td align="center" width="10%"><?=date("d F Y",strtotime($tgl_resepsi))?></td>
				<td align="center" width="20%"><?=$tempat_resepsi?></td>
				<td align="center" width="10%"><?=$jam_resepsi?></td>
				<td width="10%" align="right"><input type="text" onkeypress="return isNumber(event)" style="width:90px" onchange="return hitung()" name="harga" id="harga" value="<?=$bayar?>"></td>
					<!-- <td width="10%" align="right"><input type="text" onkeypress="return isNumber(event)" style="width:90px" onchange="return hitung()" name="harga" id="harga" value="<?=number_format($bayar)?>"></td> -->
			</tr>
			<tr>
				<td align="center" width="50%" rowspan="2" colspan="4">
				<b>Jatuh Tempo Pembayaran : <span id="due_date1"></span><br>
				(Payment Due Date : <span id="due_date2"></span>)</b>
				</td>
				<td width="33%" colspan="3">Harga Jual / Penggantian (Sales Price / Replacement)</td>
				<td width="17%" align="right"><input type="text" onkeypress="return isNumber(event)" readonly style="width:90px" name="harga2" id="harga2" value="<?=$bayar?>" readonly></td>
			</tr>
			<tr>
				<td  colspan="3">Potongan Harga (Discount) / Denda (Penalty)</td>
				<td align="right"><input type="text" onkeypress="return isNumber(event)" onchange="return hitung()" style="width:90px" name="discount" id="discount" value="0"></td>
			</tr>
			<tr>
				<td width="60%" rowspan="4"  colspan="4">
				<i>
				NOTE: Apabila Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak menilai adanya
				ketidaksesuaian dengan isi invoice, harap diajukan dalam kurun waktu 7 (tujuh) hari kerja
				dihitung sejak diterimanya invoice oleh customer. Setelah masa tersebut invoice ini dianggap
				disetujui.
				</i>
				</td>
				<td  colspan="3">Dasar Pengenaan Pajak (Tax base)</td>
				<td align="right"><input type="text" onkeypress="return isNumber(event)" onchange="return hitung()" style="width:90px" name="dpp" id="dpp" value="0"></td>
			</tr>
			<tr>
				<td  colspan="3">PPN (VAT)</td>
				<td align="right"><input type="text" onkeypress="return isNumber(event)" onchange="return hitung()" style="width:90px" name="ppn" id="ppn" value="0"></td>
			</tr>
			<tr>
				<td  colspan="3">Bea Materai (Stamp Duty)</td>
				<td align="right"><input type="text" onkeypress="return isNumber(event)" onchange="return hitung()" style="width:90px" name="materai" id="materai" value="0"></td>
			</tr>
			<tr>
				<td  colspan="3">Total Tagihan (Total Invoice)</td>
				<td align="right"><input type="text" style="width:90px" name="tot" id="tot" value="<?=number_format($bayar)?>" readonly></td>
			</tr>
			<tr>
				<td width="100%" colspan="8" align="center">#<?=Terbilang($bayar)?> Rupiah<br>#<?=Terbilang_inggris($bayar)?> Rupiahs</td>
			</tr>
			<tr>
				<td width="100%" colspan="8" align="center">Pembayaran dilakukan melalui :<br>Bank <?=$nm_bank?> <?=$cab_bank;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank <?=$nm_bank2?> <?=$cab_bank2?><br>atau&nbsp;&nbsp;&nbsp;&nbsp;<br>Nomor : <?=$no_bank?> a.n <?=$an_bank?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nomor : <?=$no_bank2?> a.n <?=$an_bank2?></td>
			</tr>
		</table>
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="right" colspan="4">
				
				<input type="submit" name="submit" value="Save" class="btn btn-success">
				
				<a href="<?=base_url()?>index.php/invoice/list_detail/<?=$this->uri->segment(3)."/".$this->uri->segment(4);?>" class="btn btn-warning">Kembali <i class="fa fa-rotate-left"></i></a>
				</td>
			</tr>
		</table>
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
<script>
	function hitung(){

		var harga 		= parseFloat($("#harga").val());
		var harga2 		= parseFloat($("#harga2").val());
		var discount 	= parseFloat($("#discount").val());
		var ppn 		= parseFloat($("#ppn").val());
		var materai 	= parseFloat($("#materai").val());

		var tot 	= parseFloat($("#tot").val());

		tot = harga + discount + ppn + materai;
		document.getElementById('tot').value=number_format(tot);		
		//document.getElementById('harga').value=number_format(harga);
		//document.getElementById('harga2').value=number_format(harga);
		//document.getElementById('discount').value=number_format(discount);
		//document.getElementById('ppn').value=number_format(ppn);
		//document.getElementById('materai').value=number_format(materai);		
		//harga2=harga;		
	}

	function number_format (number, decimals, dec_point, thousands_sep) {
		// Strip all characters but numerical ones.
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function (n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}
	
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}

	$(document).ready(function(){
		$('.datepicker').datepicker({
			dateFormat:'yy-mm-dd',
			autoclose: true
		});

		$('#due_date').change(function() {
			var due_date	= new Date($('#due_date').val());
			var due_date1	= moment(due_date).format("DD MMMM Y");
			var due_date2	= moment(due_date).format("MMMM DD, Y");

			$("#due_date1").text(due_date1);
			$("#due_date2").text(due_date2);
		});
	});

	

</script>