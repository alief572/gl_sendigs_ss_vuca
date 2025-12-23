<?php
$this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
$Arr_Coa		= array();
$Arr_Coa_bank	= array();

if ($data_bank) {
	foreach ($data_bank as $key => $vals) {
		$kode_Coa			= $vals->no_perkiraan . '^' . $vals->nama;
		$Arr_Coa_bank[$kode_Coa]	= $vals->no_perkiraan . '  ' . $vals->nama;
	}
}

if ($data_perkiraan) {
	foreach ($data_perkiraan as $key => $vals) {
		$kode_Coa			= $vals->no_perkiraan . '^' . $vals->nama;
		$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan . '  ' . $vals->nama;
	}
}

if ($data_javh) {
	foreach ($data_javh as $row_javh) {
		$nomor_jv				= $row_javh->nomor;
		$tgl_jv					= $row_javh->tgl;
		$koreksi_no				= $row_javh->koreksi_no;
		$note					= $row_javh->note;
		$jenis_transaksi		= $row_javh->jenis_reff;
	}
}
$jml_total = 0;
if ($data_jurnal) {
	foreach ($data_jurnal as $row_jurnal) {

		$jml_total += $row_jurnal->kredit;
	}
}

?>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>dist/jquery.timepicker.css">
<section class="content-header">
	<h1>
		<?= $judul ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?= $judul ?></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<form method="post" action="<?= base_url() ?>index.php/update_jurnal/proses_update_jv" id="form-proses-bro">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Detail Jurnal Voucher</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group row">
							<label class="control-label col-sm-2">No. JV</label>
							<div class="col-sm-4">
								<input type="text" class="form-control input-sm" name="nomor_jurnal" id="nomor_jurnal" value="<?= $nomor_jv ?>" readonly>
							</div>
							<label class="control-label col-sm-2">Koreksi No.</label>
							<div class="col-sm-4">
								<input type="text" class="form-control input-sm" name="koreksi_no" id="koreksi_no" autocomplete="off" value="<?= $koreksi_no ?>">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Periode</label>
							<div class="col-sm-2">
								<?php
								$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
								$bulan = $row_javh->bulan;
								echo "<input type='text' class='form-control input-sm' name='periode_bulan_show' id='periode_bulan' autocomplete='off' value='" . $nm_bulan[$bulan] . "' readonly>";
								echo "<input type='hidden' class='form-control input-sm' name='periode_bulan' id='periode_bulan' autocomplete='off' value='" . $bulan . "' readonly>";
								?>
							</div>
							<div class="col-sm-2">
								<?php
								$tahun = $row_javh->tahun;
								echo "<input type='text' class='form-control input-sm' name='periode_tahun' id='periode_tahun' autocomplete='off' value='" . $tahun . "' readonly>";
								?>
							</div>
							<label class="control-label col-sm-2">Tgl Input</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" size='1' id="datepicker" name="tanggal" value="<?= date_format(new DateTime($tgl_jv), "d-m-Y") ?>" data-date-format="dd-mm-yyyy">
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Keterangan</label>
							<div class="col-sm-4">
								<input type="text" class="form-control input-sm" name="ket_javh" id="ket_javh" autocomplete="off" value="<?= $row_javh->keterangan ?>">
							</div>
						</div>

					</div>
					<div class="box-body">
						<!--<div class="box box-warning">-->
						<div class="box-header">
							<h3 class="box-title">Detail Transaction</h3>
							<div class="box-tools pull-right">
								<button type="button" class="btn btn-md btn-primary" id="add_field_button">Add Row</button>
							</div>
						</div>
						<!-- /.box-header -->
						<!--<div class="box-body" style="overflow-x:scroll;">	-->
						<table class="table table-bordered table-striped">
							<thead>
								<tr class="bg-blue">
									<th class="text-center">No. COA</th>
									<th class="text-center">Keterangan</th>
									<!-- <th class="text-center">No. Reff</th> -->
									<th class="text-center">Debet</th>
									<th class="text-center">Kredit</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody id="list_detail">
								<?php
								$no = 0;
								$nama_coa2 = "";
								$Total_Debet	= $Total_Kredit	= 0;
								if ($data_jurnal) {
									foreach ($data_jurnal as $row_jurnal) {
										$no++;
										$No_Coa			= $row_jurnal->no_perkiraan;
										$Debet			= ($row_jurnal->debet > 0) ? $row_jurnal->debet : 0;
										$Kredit			= ($row_jurnal->kredit > 0) ? $row_jurnal->kredit : 0;

										$Pecah_Coa		= explode('-', $No_Coa);
										$Cek_Coa		= $Pecah_Coa[0];

										$Total_Debet	+= $Debet;
										$Total_Kredit	+= $Kredit;

										$No_Reff		= $row_jurnal->no_reff;
										$Keterangan		= $row_jurnal->keterangan;

										$Action_link	= '-';

										if ($Cek_Coa !== '1101' && $Cek_Coa !== '1102' && $Cek_Coa !== '1103' &&  $Cek_Coa !== '1104') {
											$Action_link	= '<button type="button" class="btn btn-sm btn-danger" onClick="return delRows(\'' . $no . '\');"> <i class="fa fa-trash"></i></button>';
										}

										echo "<tr id='tr_" . $no . "'>";
										echo "<td width='30%'>";
										echo form_dropdown('detDetail[' . $no . '][no_perkiraan]', $data_perkiraan, $No_Coa, array('id' => 'no_perkiraan_' . $no, 'class' => 'form-control input-sm'));
										echo "</td>";
										echo "<td>";
										echo form_input(array('id' => 'keterangan_' . $no, 'name' => 'detDetail[' . $no . '][keterangan]', 'class' => 'form-control input-sm', 'autocomplete' => 'off'), $Keterangan);
										echo "</td>";
										echo "<td width='15%'>";
										echo form_input(array('id' => 'debet_' . $no, 'name' => 'detDetail[' . $no . '][debet]', 'class' => 'form-control input-sm harga', 'autocomplete' => 'off', 'onblur' => 'stopCalculation();', 'onfocus' => 'startCalculation(' . $no . ');', 'data-decimal' => '.', 'data-thousand' => '', 'data-prefix' => '', 'data-precision' => '0'), number_format($Debet));
										echo "</td>";
										echo "<td width='15%'>";
										echo form_input(array('id' => 'kredit_' . $no, 'name' => 'detDetail[' . $no . '][kredit]', 'class' => 'form-control input-sm harga', 'autocomplete' => 'off', 'onblur' => 'stopCalculation();', 'onfocus' => 'startCalculation(' . $no . ');', 'data-decimal' => '.', 'data-thousand' => '', 'data-prefix' => '', 'data-precision' => '0'), number_format($Kredit));
										echo "</td>";
										echo "<td class='text-center' width='5%'>";
										echo $Action_link;
										echo "</td>";
										echo "</tr>";
										// , 'readOnly' => true
									}
								} else {
									echo alert('Nomor Jurnal tidak ada !');
									redirect('update_jurnal/update_jv');
								}
								?>
							</tbody>
							<tfoot>
								<tr class="bg-gray">
									<td colspan="2" class="text-center"><b>Grand Total</b></td>
									<td>
										<input type="text" class="form-control input-sm" name="total_debet" id="total_debet" value="<?= number_format($Total_Debet) ?>" readOnly>
									</td>
									<td>
										<input type="text" class="form-control input-sm" name="total_kredit" id="total_kredit" value="<?= number_format($Total_Kredit) ?>" readOnly>
									</td>
								</tr>
							</tfoot>
						</table>
						<!--</div><div class="box-body" style="overflow-x:scroll;">-->
						<!--</div> <div class="box box-warning">-->
					</div>
					<div class="box-footer">
						<?php
						echo form_button(array('type' => 'button', 'class' => 'btn btn-md btn-success', 'value' => 'save', 'content' => 'SIMPAN', 'id' => 'simpan-bro')) . ' ';
						//echo form_button(array('type'=>'button','class'=>'btn btn-md btn-danger','value'=>'back','id'=>'btn-back','content'=>'KEMBALI','onClick'=>'javascript:back()'));
						?>
						<a href="<?= base_url() ?>index.php/update_jurnal/update_jv" class="btn btn-danger">KEMBALI</a>
					</div>
				</div>
		</div>
	</div>
</section>


<?php $this->load->view('footer'); ?>

<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?= base_url() ?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/js/bootstrap-clockpicker.min.js"></script>
<script src="<?= base_url(); ?>dist/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>dist/jquery.timepicker.min.js">
</script>
<script>
	var data_coa = <?php echo json_encode($data_perkiraan); ?>;
	var max_fields = 15; //maximum records
	$(document).ready(function() {
		$(".harga").maskMoney();
		$('#simpan-bro').click(function(e) {
			e.preventDefault();
			$('#simpan-bro, #btn-back').prop('disabled', true);
			loading_spinner();

			var ket_javh = $('#ket_javh').val();
			if (ket_javh == '' || ket_javh == null || ket_javh == '-') {
				close_spinner();
				alert('Keterangan belum diinput, mohon input keterangan epada terlebih dahulu..');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}
			var intC = 0;
			var intD = 0;
			var intP = 0;
			var intJ = 0;
			$('#list_detail').find('tr').each(function() {
				var nil = $(this).attr('id');
				var jum = nil.split('_');
				var loop = jum[1];
				var kode_coa = $('#no_perkiraan_' + loop).val();
				var descr = $('#keterangan_' + loop).val();
				var nilai_debet = $('#debet_' + loop).val().replace(/\,/g, '');
				var nilai_kredit = $('#kredit_' + loop).val().replace(/\,/g, '');
				if (nilai_debet == '' || nilai_debet == null) {
					nilai_debet = 0;
				}
				if (nilai_kredit == '' || nilai_kredit == null) {
					nilai_kredit = 0;
				}

				if (kode_coa == '' || kode_coa == null) {
					intC++;
				}
				if (descr == '' || descr == null || descr == '-') {
					intD++;
				}

				if (parseFloat(nilai_kredit) == 0 && parseFloat(nilai_debet) == 0) {
					intJ++;
				}
			});
			if (intC > 0) {
				close_spinner();
				alert('No. COA Belum dipilih. Mohon pilih no. COA terlebih dahulu');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}
			if (intD > 0) {
				close_spinner();
				alert('Keterangan detail Belum diinput. Mohon input keterangan terlebih dahulu');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}


			if (intJ > 0) {
				close_spinner();
				alert('Nilai Trnsaksi kosong. Mohon input nilai transaksi terlebih dahulu');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}

			var total_debet = $('#total_debet').val();
			var total_kredit = $('#total_kredit').val();

			if (total_debet == total_kredit) {
				$('#form-proses-bro').submit();
			} else {
				close_spinner();
				alert('Total Debet dan Total Kredit harus sama !');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}


		});
		$('#add_field_button').click(function() {
			var total_row = parseInt($('#list_detail').find('tr').length);
			if (total_row < max_fields) {
				var last_row = $('#list_detail tr:last').attr('id');
				var beda = last_row.split('_');
				var awal = parseInt(beda[1]) + 1;

				var Template = '<tr id="tr_' + awal + '">';

				Template += '<td>';
				Template += '<select name="detDetail[' + awal + '][no_perkiraan]" id="no_perkiraan_' + awal + '" class="form-control input-sm">';
				$.each(data_coa, function(key, nilai) {
					Template += '<option value="' + key + '">' + nilai + '</option>';
				});
				Template += '</select>';
				Template += '</td>';
				Template += '<td>';
				Template += '<input type="text" name="detDetail[' + awal + '][keterangan]" id="keterangan_' + awal + '" class="form-control input-sm">';
				Template += '</td>';
				Template += '<td>';
				Template += '<input type="text" class="form-control input-sm harga" name="detDetail[' + awal + '][debet]" id="debet_' + awal + '" onblur="stopCalculation();" onfocus="startCalculation(' + awal + ');" data-decimal="." data-thousand="" data-prefix="" data-precision="0">';
				Template += '</td>';
				Template += '<td>';
				Template += '<input type="text" class="form-control input-sm harga" name="detDetail[' + awal + '][kredit]" id="kredit_' + awal + '" onblur="stopCalculation();" onfocus="startCalculation(' + awal + ');" data-decimal="." data-thousand="" data-prefix="" data-precision="0">';
				Template += '</td>';
				Template += '<td align="center" width="5%"><button type="button" class="btn btn-sm btn-danger" onClick="return delRows(' + awal + ');"> <i class="fa fa-trash-o"></i></button></td>';

				Template += '</tr>';
				$('#list_detail').append(Template);
				$('.harga').maskMoney();
				$('#no_perkiraan_' + awal).chosen();
			}
		});
		$('#datepicker').datepicker({
			dateFormat: 'd-m-Y'
		});
		$('#datepicker2').datepicker({
			dateFormat: 'd-m-Y'
		});
	});

	function delRows(id) {
		$('#list_detail #tr_' + id).remove();
		Calculation();
	}

	function startCalculation(id) {
		intervalCalculation = setInterval('Calculation()', 1);
	}

	function Calculation() {
		var sub_debet = 0;
		var sub_kredit = 0;

		$('#list_detail').find('tr').each(function() {
			var nil = $(this).attr('id');
			var jum = nil.split('_');
			var loop = jum[1];
			var debet_nil = $('#debet_' + loop).val().replace(/\,/g, '');
			var kredit_nil = $('#kredit_' + loop).val().replace(/\,/g, '');
			if (debet_nil == '' || debet_nil == null) {
				var debet_nil = 0;
			}

			if (kredit_nil == '' || kredit_nil == null) {
				var kredit_nil = 0;
			}
			sub_debet = parseFloat(sub_debet) + parseFloat(debet_nil);
			sub_kredit = parseFloat(sub_kredit) + parseFloat(kredit_nil);

		});

		//grand_tot = parseFloat(sub_tot);
		$('#total_debet').val(sub_debet.format(0, 3, ','));
		$('#total_kredit').val(sub_kredit.format(0, 3, ','));
	}

	function stopCalculation() {
		clearInterval(intervalCalculation);
	}
	Number.prototype.format = function(n, x, s, c) {
		var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
			num = this.toFixed(Math.max(0, ~~n));

		return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
	};
</script>