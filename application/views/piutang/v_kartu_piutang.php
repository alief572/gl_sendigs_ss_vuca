<?php $this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
$Arr_Coa		= array();
$Arr_Project	= array();
if ($data_perkiraan) {
	foreach ($data_perkiraan as $key => $vals) {
		$kode_Coa			= $vals->no_perkiraan . '^' . $vals->nama;
		$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan . '  ' . $vals->nama;
	}
}
?>

<section class="content-header">
	<h1>
		<?= $judul ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?= $judul ?></li>
	</ol>
</section>

<section class="content-header">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
					<b>PERIODE : </b><br><br>
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" action="<?=base_url()?>index.php/kartu_piutang/tampilkan_kartu_piutang" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="15%" align="right"><b>Periode Awal</b></td>
									<td width="15%">
									 <input type="text" id="tgl_awal" name="tgl_awal" value="" class="datepicker" /> 
                                    </td>
									<td width="15%">
									</td>
									<td width="15%">																			 
									</td>
								</tr>
								<tr>
									<td width="15%" align="right"><b>Periode Akhir</b></td>
									<td width="15%">
									<input type="text" id="tgl_akhir" name="tgl_akhir" value="" class="datepicker" />	
                                    </td>
									<td width="15%">																			 
									</td>
									<td width="15%">																			 
									</td>
								</tr>

								<tr>
									<td width="15%" align="right"><b>Vendor</b></td>
									<td>
                                    <?php
									$datklien[0]	= 'All Customer';						
									echo form_dropdown('id_klien',$datklien, set_value('id_klien', isset($data->id_klien) ? $data->id_klien : 'selected'), array('name'=>'id_klien','id'=>'id_klien','class'=>'form-control id_klien'));											
									?>

									</td>
									<td width="15%">
									</td>
									<td width="15%">																			 
									</td>
								</tr>
				     <tr>
					<td width="15%" align="right"></td>
					<td width="25%" align="left">
						<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center">                             
					    <input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn btn-success pull-center">
					
					</td>
					
				</tr>
				
				</table>
			  
			  </form>
            
        </div>
    </div>
    </div>
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
										<?php
										
										$awal 		= $datawal;
										$akhir		= $datakhir;
										$klien    	= $datvendor;
										
										if($klien <> '0'){
										
										$kl  = $this->db->query("SELECT * FROM waterco_demo.master_customers WHERE id_customer='$klien'")->row();
										$supp  = $this->db->query("SELECT * FROM waterco_demo.master_customers WHERE id_customer='$klien'")->result();
										
										
										$coa_sa = $this->Kartupiutang_model->GetData($awal,$id_klien);	
											
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>KARTU PIUTANG<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " S/D ". date_format(new DateTime($akhir), "d-m-Y") ."</center></th></tr>";
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>NAMA KLIEN : " . $kl->name_customer . "</center></th></tr>";
										}
										else{
										$supp  = $this->db->query("SELECT * FROM waterco_demo.master_customers")->result();
										
											
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>KARTU PIUTANG<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " S/D ". date_format(new DateTime($akhir), "d-m-Y") ."</center></th></tr>";
										}
										?>
									</tr>

									<tr>
										<td>
										<center><b>Customer</b></center>
										</td>
									    <td>
										<center><b>No Invoice</b></center>
										</td>
										<td>
										<center><b>Tanggal Bukti</b></center>
										</td>
										<td>
											<center><b>Nomor Bukti</b></center>
										</td>
										<td>
											<center><b>Keterangan</b></center>
										</td>
										
										<td>
											<center><b>Debet</b></center>
										</td>
										<td>
											<center><b>Kredit</b></center>
										</td>
										<td>
											<center><b>Saldo</b></center>
										</td>
									</tr>
									
									<?php
									
									foreach ($supp as $cust) {
										
										$id_klien = $cust->id_customer;	
										$nm_klien = $cust->name_customer;	
										$coa_sa = $this->Kartupiutang_model->GetData($awal,$id_klien);	
									
										$count = 0;
										foreach ($coa_sa as $row_sa) {
											$count++;
     										$saldo_awal[$count]	= $row_sa->saldo;
											
											?>
									
									<tr>
												<td width='260px'><b><?=$nm_klien?></b></td>
												<td></td>
												<td></td>
												<td align="center"></td>
												<td align="right">Saldo Awal -></td>
												<td></td>
												<td></td>
												<td align="right"><?= number_format($saldo_awal[$count], 0, ',', '.'); ?></td>
									</tr>
																	
									<!-- DATA DARI JURNAL -->
											<?php
											$sum_debet = 0;
											$sum_kredit = 0;
											$sum_debet = array();
											$sum_kredit = array();
											$nilai_debet = array();
											$nilai_kredit = array();

											$detail_jurnal	= $this->Kartupiutang_model->get_detail_kartu_piutang($awal,$akhir,$id_klien);
											if ($detail_jurnal > 0) {
												$count2 = 0;
												$count3 = 0;

												foreach ($detail_jurnal as $row_dj) {
													$count2++;
													$count3++;
													//$nokir 					= $row_dj->no_perkiraan;
													$nama_perkiraan2[$count2] 	= $row_dj->keterangan;
													$tgl_bukti[$count2]			= $row_dj->tanggal;
													$nomor_bukti[$count2] 		= $row_dj->nomor;
													$nomor_reff[$count2] 		= $row_dj->no_reff;
													$tipe_sm[$count2] 			= $row_dj->tipe;
													$nilai_debet[$count2] 		= $row_dj->debet;
													$nilai_kredit[$count2] 		= $row_dj->kredit;
													// if ((isset($sum_debet[$count]))  == "" || (isset($sum_kredit[$count])) == "" || (isset($nilai_debet[$count2]))  == "" || (isset($nilai_kredit[$count2])) == "") {
													// 	$sum_debet[$count]	 		+= $nilai_debet[$count2];
													// 	$sum_kredit[$count]  		+= $nilai_kredit[$count2];
													// } else {

													$sum_debet[$count]	 		+= $nilai_debet[$count2];
													$sum_kredit[$count]  		+= $nilai_kredit[$count2];
													//}

													//$current_saldo[$count3]	= $saldo_awal[$count];
													$current_saldo[$count3]		= $saldo_awal[$count] + $nilai_debet[$count2] - $nilai_kredit[$count2];
													//$current_saldo[$count2]	+= $current_saldo[$count2] + $nilai_debet[$count2] - $nilai_kredit[$count2];
													// $saldo_akhir				= $sum_debet + $saldo_awal[$count] - $sum_kredit;	
													$saldo_akhir				= $current_saldo[$count3];
											?>
													<tr>
													    <td align="center"><?=$nm_klien?></td>
                                                        <td align="center"><?= $nomor_reff[$count2] ?></td>
													    <td align="center"><?= date_format(new DateTime($tgl_bukti[$count2]), "d-m-Y")  ?></td>
														<td align="center"><?= $nomor_bukti[$count2] ?></td>
														<td><?= $nama_perkiraan2[$count2] ?></td>
														<td align="right"><?= number_format($nilai_debet[$count2], 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($nilai_kredit[$count2], 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($current_saldo[$count3], 0, ',', '.'); ?></td>
													</tr>
											<?php
													$saldo_awal[$count] = $current_saldo[$count3];
												}
											} else {
												$saldo_akhir				= $saldo_awal[$count];
											}
											?>

											<tr>
											    <td><b><?=$nm_klien?></b></td>
												<td></td>
												<td></td>
												<td></td>
												<td align="right">Saldo Akhir -></td>

												<td align="right"><b><?= number_format($sum_debet[$count], 0, ',', '.'); ?></td>
												<td align="right"><b><?= number_format($sum_kredit[$count], 0, ',', '.'); ?></td>
												<td align="right"><b><?= number_format($saldo_akhir, 0, ',', '.'); ?></td>
											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td align="right"></td>
												<td align="right"></td>
												<td align="right"></td>
												<td align="right"></td>
											</tr>

									<?php
											
										}
									}
									
									?>

								</tbody>

							</table>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>
<?php $this->load->view('footer'); ?>

<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/moment.min.js"></script>
<script>
	function check() {
		if ($("#bulan_ledger").val() == "0") {
			alert("Silahkan Pilih Bulan");
			return false;
		} else if ($("#tahun_ledger").val() == "0") {
			alert("Silahkan Pilih Tahun");
			return false;
		} else if ($("#filter_nokir").val() == "0") {
			alert("Silahkan Pilih Dari Nomor Perkiraan Mana");
			return false;
		} else if ($("#filter_nokir2").val() == "0") {
			alert("Silahkan Pilih Sampai Nomor Perkiraan Mana");
			return false;
		}
	}
	
	$(function() {
		$('.datepicker').datepicker({
			format   : 'dd-mm-yyyy',
			autoclose: true,
			todayHighlight: true
		});

		$('#datepicker2').datepicker({
			dateFormat: 'yyyy-mm-dd'
		});
	});
</script>