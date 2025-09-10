<?php
$this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
$Arr_Coa		= array();
$Arr_Coa_bank	= array();
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

$data_coa = $this->db->query("SELECT * FROM COA WHERE no_perkiraan = '$no_perkiraan' and bln='$bln_aktif' and thn='$thn_aktif'")->result();

if ($data_coa > 0) {
	foreach ($data_coa as $brs_coa2) {
		$nama_coa2 = $brs_coa2->nama;
		$pndptn = $no_perkiraan . " " . $nama_coa2;
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
			<form method="post" action="<?= base_url() ?>index.php/master/proses_edit_jurnal" id="form-proses-bro">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Jurnal Header</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group row">
							<label class="control-label col-sm-2">Kode Master Jurnal</label>
							<div class="col-sm-4">
								<!-- <span class="badge bg-maroon">Otomatis System</span> -->
								<input type="text" class="form-control" id="kode_master_jurnal" name="kode_master_jurnal" value="<?= $kode_master_jurnal ?>" readonly>
							</div>
							<label class="control-label col-sm-2">Tipe Jurnal</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" id="tipe" name="tipe" value="<?= $tipe ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Nama Jurnal</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="nama_jurnal" name="nama_jurnal" value="<?= $nama_jurnal ?>" required>
							</div>
							<label class="control-label col-sm-2">Keterangan</label>
							<div class="col-sm-4">
								<textarea cols="75" rows="2" class="form-control input-sm" name="keterangan_header" id="keterangan_header"><?= $keterangan_header ?></textarea>
							</div>
						</div>
					</div>
				</div>

				<div class="box-body">
					<!--<div class="box box-warning">-->
					<div class="box-header">
						<h3 class="box-title">Jurnal Detail</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-md btn-primary" id="add_field_button">Add Row</button>
						</div>
					</div>
					<!-- /.box-header -->
					<!--<div class="box-body" style="overflow-x:scroll;">	-->
					<table class="table table-bordered table-striped">
						<thead>
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
						</thead>
						<tbody id="list_detail">
							<?php
							$no = 0;
							$nama_coa2 = "";
							if ($data_detail) {
								foreach ($data_detail as $row_jurnal) {
									$no++;
                                    $Menu			= $row_jurnal->menu;
									$No_Coa			= $row_jurnal->no_perkiraan;
                                    $Field			= $row_jurnal->field;
                                    $Posisi			= $row_jurnal->posisi;

									$Pecah_Coa		= explode('-', $No_Coa);
									$Cek_Coa		= $Pecah_Coa[0];

									$parameter_no	= $row_jurnal->parameter_no;
									$Keterangan		= $row_jurnal->keterangan;

									$Action_link	= '-';

									if ($Cek_Coa !== '1101' && $Cek_Coa !== '1102' && $Cek_Coa !== '1103' &&  $Cek_Coa !== '1104') {
										$Action_link	= '<button type="button" class="btn btn-sm btn-danger" onClick="return delRows(\'' . $no . '\');"> <i class="fa fa-trash"></i></button>';
									}

									echo "<tr id='tr_" . $no . "'>";
									echo"<td>
										<select name='detDetail[$no][nama_menu]' id='nama_menu_$no' class='form-control input-sm'>
											<option value=''>- Nama Menu -</option>";
											
											foreach ($Arr_Menu as $key => $row2) {
											$menu_pisah	= explode('^', $key);
											$menu1		= $menu_pisah[0];

											if ($menu1 == $Menu) {
												echo "<option value='" . $key . "' selected>" . $row2 . "</option>";
											} else {
												echo "<option value='" . $key . "'>" . $row2 . "</option>";
											}

												//	echo "<option value='".$row2->no_perkiraan." --- ".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
											}
										
									echo"</select>
									</td>";
									echo "<td width='25%'>";
							?>
									<select name="detDetail[<?= $no ?>][no_perkiraan]" id="no_perkiraan_<?= $no ?>" class="form-control input-sm">
										<!-- <option value="<?= $No_Coa ?>" selected><?= $pndptn ?></option> -->
										<?php
										foreach ($Arr_Coa as $key => $row2) {
											$coa_pisah	= explode('^', $key);
											$nokir		= $coa_pisah[0];

											if ($nokir == $No_Coa) {
												echo "<option value='" . $key . "' selected>" . $row2 . "</option>";
											} else {
												echo "<option value='" . $key . "'>" . $row2 . "</option>";
											}
										}
										?>
									</select>
							<?php
									// echo form_dropdown('detDetail[' . $no . '][no_perkiraan]', $Arr_Coa, $No_Coa, array('id' => 'no_perkiraan_' . $no, 'class' => 'form-control input-sm'));
									echo "</td>";
									echo "<td>";
									echo form_input(array('id' => 'keterangan_' . $no, 'name' => 'detDetail[' . $no . '][keterangan]', 'class' => 'form-control input-sm', 'autocomplete' => 'off'), $Keterangan);
									echo "</td>";
									echo "<td>";
									echo "  <select name='detDetail[$no][nama_field]' id='nama_field_$no' class='form-control input-sm'>
											<option value=''>- Nama Kolom -</option>";
											
											foreach ($Arr_Field as $key => $row2) {
                                                $field_pisah	= explode('^', $key);
												$field1		= $field_pisah[0];

                                                if ($field1 == $Field) {
												echo "<option value='" . $key . "' selected>" . $row2 . "</option>";
												} else {
													echo "<option value='" . $key . "'>" . $row2 . "</option>";
												}
																								//	echo "<option value='".$row2->no_perkiraan." --- ".$row2->nama."'>".$row2->no_perkiraan." --- ".$row2->nama."</option>";
											}
											
								    echo"</select>
									</td>";
									echo" <td>
										<select name='detDetail[$no][posisi]' id='posisi_$no' class='form-control input-sm'>";
                                          if ($Posisi == 'D') {
											echo" <option value='D' selected > Debet </option>";
											echo" <option value='K'> Kredit </option>";
                                          }else if ($Posisi == 'K') {
                                            echo" <option value='D'> Debet </option>";
											echo" <option value='K' selected> Kredit </option>";
                                          }
                                          
                                    echo"
										</select> 
									</td>";
									echo "<td class='text-center'>";
									echo $Action_link;
									echo "</td>";
									echo "</tr>";
									// , 'readOnly' => true
								}
							}
							?>
						</tbody>
						<!-- <tfoot>
								<tr class="bg-gray">
									<td colspan="3" class="text-center"><b>Grand Total</b></td>
									<td>
										<input type="text" class="form-control input-sm" name="total_debet" id="total_debet" value="<?= number_format($Total_Debet) ?>" readOnly>
									</td>
									<td>
										<input type="text" class="form-control input-sm" name="total_kredit" id="total_kredit" value="<?= number_format($Total_Kredit) ?>" readOnly>
									</td>
								</tr>
							</tfoot> -->
					</table>
					<!--</div><div class="box-body" style="overflow-x:scroll;">-->
					<!--</div> <div class="box box-warning">-->
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
</script>
<script>
	var list_coa = <?php echo json_encode($Arr_Coa); ?>;
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
				var kode_coa = $('#no_perkiraan_' + loop).val();
				var descr = $('#keterangan_' + loop).val();
				var no_parameter = $('#no_parameter_' + loop).val();
				// var nilai = $('#jumlah' + loop).val().replace(/\,/g, '');
				if (kode_coa == '' || kode_coa == null) {
					intC++;
				}
				if (descr == '' || descr == null || descr == '-') {
					intD++;
				}
				if (no_parameter == '' || no_parameter == null) {
					intP++;
				}
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
		//$('#jumlah').val(sub_debet.format(0, 3, ','));
		$('#jumlah').val(sub_kredit.format(0, 3, ','));
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