<?php
$this->load->view('header');
// error_reporting(E_ALL & ~E_NOTICE);

$Arr_Coa		= array();
$Arr_Coa_bank   = array();
$Arr_Project	= array();
$Arr_Menu	    = array();


if ($data_bank) {
	foreach ($data_bank as $key => $vals) {
		$kode_Coa					= $vals->no_perkiraan . '^' . $vals->nama;
		$Arr_Coa_bank[$kode_Coa]	= $vals->no_perkiraan . '  ' . $vals->nama;
	}
}

if ($data_perkiraan) {
	foreach ($data_perkiraan as $key => $vals) {
		$kode_Coa			= $vals->no_perkiraan . '^' . $vals->nama;
		$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan . '  ' . $vals->nama;
	}
}

if ($data_menu) {
	foreach ($data_menu as $key => $vals) {
		$kode_Menu			    = $vals->nama_table;
		$Arr_Menu[$kode_Menu]	= $vals->nama_menu;
	}
}

if ($data_field) {
	foreach ($data_field as $key => $vals) {
		$kode_Field			    = $vals->nama_field;
		$Arr_Field[$kode_Field]	= $vals->label;
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
			<form method="post" action="<?= base_url() ?>index.php/master/proses_add_jurnal" id="form-proses-bro">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Jurnal Header</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group row">
							<label class="control-label col-sm-2">Kode Master Jurnal</label>
							<div class="col-sm-4">
								<span class="badge bg-maroon">Otomatis System</span>
							</div>
							<label class="control-label col-sm-2">Tipe Jurnal</label>
							<div class="col-sm-3">
								<select type="text" name="tipe" class="form-control" id="tipe" required>
									<option value="">-- Pilih Tipe Jurnal --</option>
									<option value="BUM">BUM</option>
									<option value="BUK">BUK</option>
									<option value="JV">JV</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Nama Jurnal</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="nama_jurnal" name="nama_jurnal" value="" required>
							</div>
							<label class="control-label col-sm-2">Keterangan</label>
							<div class="col-sm-4">
								<textarea cols="75" rows="2" class="form-control input-sm" name="keterangan_header" id="keterangan_header"></textarea>
							</div>
						</div>
						<!-- <div class="form-group row">
							<label class="control-label col-sm-2">Setor Ke</label>
							<div class="col-sm-4">
								<select name="setorke" id="setorke" class="form-control input-sm">
									<option value=""> -- PILIH --</option>
									<?php
									foreach ($Arr_Coa_bank as $key => $row2) {
										echo "<option value='" . $key . "'>" . $row2 . "</option>";
									}
									?>
								</select>
							</div>
						</div> -->
					</div>
					<div class="box-body">
						<!--<div class="box box-warning">-->
						<div class="box-header">
							<h3 class="box-title">Jurnal Detail</h3>
						</div>
						<!-- /.box-header -->
						<!--<div class="box-body" style="overflow-x:scroll;">-->
						<table class="table table-bordered table-striped">
							<thead>
								<tr class="bg-blue">
								    <th class="text-center">Nama Menu</th>
									<th class="text-center">No. Perkiraan</th>
									<th class="text-center">Keterangan</th>
									<th class="text-center">Kolom nominal ERP </th>
									<th class="text-center">Posisi</th>
									<th class="text-center">Opsi</th>
								</tr>
							</thead>
							<tbody id="list_detail">
								<tr id="tr_1">
								    <td>
										<select name="detail[1][nama_menu]" id="nama_menu" class="form-control input-sm">
											<option value="">- Nama Menu -</option>
											<?php
											foreach ($Arr_Menu as $key => $row2) {
												echo "<option value='" . $key . "'>" . $row2 . "</option>";

												//	echo "<option value='".$row2->no_perkiraan." --- ".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
											}
											?>
										</select>
									</td>
									<td width="25%">
										<select name="detail[1][noperkiraan]" id="noperkiraan1" class="form-control input-sm">
											<option value="">- No.Perkiraan -</option>
											<?php
											foreach ($Arr_Coa as $key => $row2) {
												echo "<option value='" . $key . "'>" . $row2 . "</option>";

												//	echo "<option value='".$row2->no_perkiraan." --- ".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
											}
											?>
										</select>
									</td>
									<td>
										<input type="text" class="form-control input-sm" id="keterangan1" name="detail[1][keterangan]" placeholder="- Keterangan -" value="">
									</td>
									 <td>
										<select name="detail[1][nama_field]" id="nama_field" class="form-control input-sm">
											<option value="">- Nama Kolom -</option>
											<?php
											foreach ($Arr_Field as $key => $row2) {
												echo "<option value='" . $key . "'>" . $row2 . "</option>";

												//	echo "<option value='".$row2->no_perkiraan." --- ".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
											}
											?>
										</select>
									</td>
									
									<td>
										<select name="detail[1][posisi]" id="posisi" class="form-control input-sm">
											<option value="D"> Debet </option>
											<option value="K"> Kredit </option>
										</select> 
									</td>
									<td width="10%" class="text-center">
										<button type="button" class="btn btn-md btn-primary" id="add_field_button">Tambah</button>
									</td>
								</tr>
							</tbody>
							<!-- <tfoot>
								<tr class="bg-gray">
									<td colspan="3" class="text-center"><b>Grand Total</b></td>
									<td>
										<input type="text" class="form-control input-sm" name="total" id="total" readOnly>
									</td>
									<td></td>
								</tr>
							</tfoot> -->
						</table>

						<!-- 	</div>
						</div>>-->
					</div>
					<div class="box-footer">
						<?php
						echo form_button(array('type' => 'button', 'class' => 'btn btn-md btn-success', 'value' => 'save', 'content' => 'SIMPAN', 'id' => 'simpan-bro')) . ' ';
						//echo form_button(array('type'=>'button','class'=>'btn btn-md btn-danger','value'=>'back','id'=>'btn-back','content'=>'KEMBALI','onClick'=>'javascript:back()'));
						?>
						<a href="<?= base_url() ?>index.php/master/jurnal_header" class="btn btn-danger">KEMBALI</a>
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
<script type="text/javascript" src="<?= base_url(); ?>dist/jquery.timepicker.min.js"></script>
<script>
	var data_coa = <?php echo json_encode($Arr_Coa); ?>;
	var data_menu = <?php echo json_encode($Arr_Menu); ?>;
	var data_field = <?php echo json_encode($Arr_Field); ?>;
	
	
	var max_fields = 15; //maximum records
	$(document).ready(function() {
		// $(".harga").maskMoney();
		$('#simpan-bro').click(function(e) {
			e.preventDefault();
			$('#simpan-bro, #btn-back').prop('disabled', true);
			loading_spinner();

			var tipe = $('#tipe').val();
			var nama_jurnal = $('#nama_jurnal').val();
			var keterangan_header = $('#keterangan_header').val();
			// var notes = $('#note').val();
			if (tipe == '' || tipe == null || tipe == '-') {
				close_spinner();
				alert('Tipe belum dipilih, mohon pilih tipe jurnal terlebih dahulu..');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}
			if (nama_jurnal == '' || nama_jurnal == null) {
				close_spinner();
				alert('Nama Jurnal belum diinput, mohon isi Nama Jurnal terlebih dahulu..');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}
			if (keterangan_header == '' || keterangan_header == null) {
				close_spinner();
				alert('Keterangan belum diinput, mohon isi Keterangan terlebih dahulu..');
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
				var kode_coa = $('#noperkiraan' + loop).val();
				var descr = $('#keterangan' + loop).val();
				// var no_parameter = $('#no_parameter' + loop).val();
				// var nilai = $('#jumlah' + loop).val().replace(/\,/g, '');
				if (kode_coa == '' || kode_coa == null) {
					intC++;
				}
				if (descr == '' || descr == null || descr == '-') {
					intD++;
				}
				// if (no_parameter == '' || no_parameter == null) {
					// intP++;
				// }
				// if (nilai == '' || nilai == null || parseInt(nilai) < 1) {
				// 	intJ++;
				// }
			});
			if (intC > 0) {
				close_spinner();
				alert('No Perkiraan Belum dipilih. Mohon pilih no perkiraan terlebih dahulu');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}
			if (intD > 0) {
				close_spinner();
				alert('Keterangan detail Belum diinput. Mohon input keterangan terlebih dahulu');
				$('#simpan-bro, #btn-back').prop('disabled', false);
				return false;
			}
			// if (intP > 0) {
			// 	close_spinner();
			// 	alert('No. Parameter Belum diinput. Mohon input no. parameter terlebih dahulu');
			// 	$('#simpan-bro, #btn-back').prop('disabled', false);
			// 	return false;
			// }

			// if (intJ > 0) {
			// 	close_spinner();
			// 	alert('Nilai Transaksi kosong. Mohon input nilai transaksi terlebih dahulu');
			// 	$('#simpan-bro, #btn-back').prop('disabled', false);
			// 	return false;
			// }

			$('#form-proses-bro').submit();
		});
		$('#add_field_button').click(function() {
			var total_row = parseInt($('#list_detail').find('tr').length);
			if (total_row < max_fields) {
				var last_row = $('#list_detail tr:last').attr('id');
				var beda = last_row.split('_');
				var awal = parseInt(beda[1]) + 1;

				var Template = '<tr id="tr_' + awal + '">';
				
                Template += '<td>';
				Template += '<select name="detail[' + awal + '][nama_menu]" id="nama_menu' + awal + '" class="form-control input-sm">';
				Template += '<option value="">- Nama Menu -</option>';
				$.each(data_menu, function(key, nilai) {
					Template += '<option value="' + key + '">' + nilai + '</option>';
				});
				Template += '</select>';
				Template += '</td>';
				Template += '<td>';
				Template += '<select name="detail[' + awal + '][noperkiraan]" id="noperkiraan' + awal + '" class="form-control input-sm">';
				Template += '<option value="">- No Perkiraan -</option>';
				$.each(data_coa, function(key, nilai) {
					Template += '<option value="' + key + '">' + nilai + '</option>';
				});
				Template += '</select>';
				Template += '</td>';
				Template += '<td>';
				Template += '<input type="text" name="detail[' + awal + '][keterangan]" id="keterangan' + awal + '" class="form-control input-sm">';
				Template += '</td>';
				Template += '<td>';
				Template += '<select name="detail[' + awal + '][nama_field]" id="nama_field' + awal + '" class="form-control input-sm">';
				Template += '<option value="">- Nama Menu -</option>';
				$.each(data_field, function(key, nilai) {
					Template += '<option value="' + key + '">' + nilai + '</option>';
				});
				Template += '</select>';
				Template += '</td>';
				Template += '<td>';
				Template += '<select name="detail[' + awal + '][posisi]" id="posisi' + awal + '" class="form-control input-sm">';
				Template += '<option value="D">Debet</option>';
				Template += '<option value="K">Kredit</option>';
				Template += '</td>';
				
				Template += '<td align="center"><button type="button" class="btn btn-sm btn-danger" onClick="return DelRow(' + awal + ');">Delete <i class="fa fa-trash-o"></i></button></td>';

				Template += '</tr>';
				$('#list_detail').append(Template);
				// $('.harga').maskMoney();
				$('#noperkiraan' + awal).chosen();
			}
		});
		$('#datepicker').datepicker({
			dateFormat: 'yy-mm-dd'
		});

	});

	function DelRow(id) {
		$('#list_detail #tr_' + id).remove();
		Calculation();
	}

	function startCalculation(id) {
		intervalCalculation = setInterval('Calculation()', 1);
	}

	function Calculation() {
		var sub_tot = 0;

		$('#list_detail').find('tr').each(function() {
			var nil = $(this).attr('id');
			var jum = nil.split('_');
			var loop = jum[1];
			var awal = $('#jumlah' + loop).val().replace(/\,/g, '');
			if (awal == '' || awal == null) {
				var awal = 0;
			}
			sub_tot = parseFloat(sub_tot) + parseFloat(awal);
		});

		grand_tot = parseFloat(sub_tot);
		$('#total').val(grand_tot.format(0, 3, ','));
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