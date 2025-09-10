<style>
	table,
	th,
	td {
		border: 0px;
		/* border-collapse: collapse; */
	}
</style>
<?php
// error_reporting(E_ALL & ~E_NOTICE);
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


?>
<!-- <div id="space"></div> -->
<!-- <table class="gridtable" width="100%"> -->
<div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable" style="width:95%; height:1000px" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><b>Master Jurnal Detail</b></h4>
				</div>
				<!-- <div class="col-lg"> -->
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button> -->
				<?php
				if ($data_header) {
					foreach ($data_header as $row_header) {
						$kode_master_jurnal	= $row_header->kode_master_jurnal;
						$nama_jurnal		= $row_header->nama_jurnal;
						$keterangan_header	= $row_header->keterangan_header;
						$tipe_jurnal		= $row_header->tipe;
						$jenis_jurnal		= $row_header->jenis_jurnal;
						$eksekusi    		= $row_header->eksekusi;
					}
				}
				?>
				<table width="90%">
					<tr>
						<td width="10%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Kode Master Jurnal</b></td>
						<td width="1%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td width="20%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $kode_master_jurnal ?></td>
						<td width="1%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
						<td width="2%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Tipe Jurnal</b></td>
						<td width="1%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td width="20%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $tipe_jurnal ?></td>
					    <td width="1%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
					</tr>
					<tr>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Nama Jurnal</b></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nama_jurnal ?></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Keterangan</b></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $keterangan_header ?></td>
					</tr>
					
					<tr>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Jenis Pembelian</b></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= ucfirst($jenis_jurnal) ?></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Eksekusi Saat</b></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= ucfirst($eksekusi) ?></td>
					</tr>
					
					
					
				</table>
				<br>
				<table class="table table-bordered table-striped">
						<thead>
							<thead>
								<tr class="bg-blue">
								  <tr class="bg-blue">
								    <th class="text-center">Nama Tabel</th>
									<th class="text-center">Nama Kolom </th>
									<th class="text-center">No. Perkiraan</th>
									<th class="text-center">Keterangan</th>									
									<th class="text-center">Posisi</th>
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
										<select name='detail[1][nama_menu]' id='nama_menu' class='form-control input-sm' readonly>
											<option value=''>- Nama Tabel -</option>";
											
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
									echo "<td>";
									echo "  <select name='detail[1][nama_field]' id='nama_field' class='form-control input-sm' readonly>
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
									
									echo "<td width='25%'>";
							?>
									
									<select name="detDetail[<?= $no ?>][no_perkiraan]" id="no_perkiraan_<?= $no ?>" class="form-control input-sm" readonly>
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
									echo form_input(array('id' => 'keterangan_' . $no, 'name' => 'detDetail[' . $no . '][keterangan]', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'readonly'=>'readonly'), $Keterangan);
									echo "</td>";
									echo" <td>
										<select name='detail[1][posisi]' id='posisi' class='form-control input-sm' readonly>";
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
			</div>
		</div>
	</div>
</div>