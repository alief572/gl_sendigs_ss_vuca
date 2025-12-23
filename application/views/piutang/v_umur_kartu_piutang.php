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
					<b></b><br><br>
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" action="<?=base_url()?>index.php/kartu_piutang/tampilkan_umur_kartupiutang" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="15%" align="right"><b>PERIODE</b></td>
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
									$datklien[0]	= 'Select An Option';						
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
										$vendor 	= $datvendor;
										
										$supp  = $this->db->query("SELECT * FROM waterco_live.master_customers WHERE id_customer='$vendor'")->row();
											
										echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>KARTU UMUR PIUTANG<br>Periode :  " . date_format(new DateTime($akhir), "d-m-Y") . " </center></th></tr>";
										echo "<tr><th colspan='9' style='text-align:center;font-size:15px;'><center>NAMA KLIEN : " . $supp->name_customer . "</center></th></tr>";
										
										?>
									</tr>

									<tr>
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
											<center><b>0-30 hari</b></center>
										</td>
										<td>
											<center><b>31-60 hari</b></center>
										</td>
										<td>
											<center><b>61-90 hari</b></center>
										</td>
										<td>
											<center><b>91-120 hari</b></center>
										</td>
										<td>
											<center><b>>120 hari</b></center>
										</td>
										<td>
											<center><b>Jumlah</b></center>
										</td>
									</tr>
									
									<?php
									    if ($coa_sa > 0) {
										$count = 0;
										foreach ($coa_sa as $row_sa) {
											$count++;
     										$bukti	= $row_sa->no_reff;
											$tgl_bukti	= $row_sa->tanggal;
											
									?>
									
															
									<!-- DATA DARI JURNAL -->
											<?php
											

											$detail_jurnal	= $this->Kartupiutang_model->get_detail_umur_kartu_piutang($awal,$akhir,$vendor, $bukti);
											if ($detail_jurnal > 0) {
												
												foreach ($detail_jurnal as $row_dj) {
													
													$tgl_j       		= $row_dj->tanggal;
													$nilai_debet 		= $row_dj->debet;
													$nilai_kredit 		= $row_dj->kredit;
													$keterangan         = $row_dj->keterangan;
                                                    $saldo30         = $row_dj->saldo30;
													$saldo31         = $row_dj->saldo31;
													$saldo60         = $row_dj->saldo60;
													$saldo90         = $row_dj->saldo90;
													$saldo120         = $row_dj->saldo120;
													
													
													
													if  ($saldo30 != 0 ){
													$totsaldo30     = $saldo30;
													$totsaldo31     = 0;
													$totsaldo60     = 0;
													$totsaldo90     = 0;
													$totsaldo120    = 0;
													}
													// if ($saldo30 < 0 ) {
													// $totsaldo30     = 0;
													// }
													if ($saldo31 != 0 ) {
													$totsaldo30     = 0;
													$totsaldo31     = $saldo31+$saldo30;
													$totsaldo60     = 0;
													$totsaldo90     = 0;
													$totsaldo120    = 0;
													}
													// if ($saldo31 < 0 ) {
													// $totsaldo31     = 0;
													// }
													if  ( $saldo60 != 0 ) {
													$totsaldo30     = 0;
													$totsaldo31     = 0;
													$totsaldo60     = $saldo60+$saldo31+$saldo30;
													$totsaldo90     = 0;
													$totsaldo120    = 0;
													}
													// if ($saldo60 < 0 ) {
													// $totsaldo60     = 0;
													// }
													if ( $saldo90 != 0 ) {
													$totsaldo30     = 0;
													$totsaldo31     = 0;
													$totsaldo60     = 0;
													$totsaldo90     = $saldo90+$saldo60+$saldo31+$saldo30;
													$totsaldo120    = 0;
													}
													// if ($saldo90 < 0 ) {
													// $totsaldo90     = 0;
													// }
													if ($saldo120 != 0) {
													$totsaldo30     = 0;
													$totsaldo31     = 0;
													$totsaldo60     = 0;
													$totsaldo90     = 0;
													$totsaldo120     = $saldo120+$saldo90+$saldo60+$saldo31+$saldo30;
													}
													// if ($saldo120 < 0 ) {
													// $totsaldo120     = 0;
													// }
													
													$totalall = $totsaldo30+$totsaldo31+$totsaldo60+$totsaldo90+$totsaldo120;
													
												
													$tot30 += $totsaldo30;
													$tot31 += $totsaldo31;
													$tot60 += $totsaldo60;
													$tot90 += $totsaldo90;
													$tot120 += $totsaldo120;
													$totall += $totalall;
													
													
													
												
											?>
													<tr>
													    <td align="center"><?= date_format(new DateTime($tgl_j), "d-m-Y")  ?></td>
														<td align="center"><?= $bukti ?></td>
														<td><?= $keterangan?></td>
														<td align="right"><?= number_format($totsaldo30, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo31, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo60, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo90, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totsaldo120, 0, ',', '.'); ?></td>
														<td align="right"><?= number_format($totalall, 0, ',', '.'); ?></td>
														
													</tr>
											

											
										
									<?php
												}
											
										   }
										}
										
										}
									
									?>

								</tbody>
								
								<tr>
									<td align="center" colspan="3"><b>TOTAL</td>
									<td align="right"><b><?= number_format($tot30, 0, ',', '.'); ?></td>
									<td align="right"><b><?= number_format($tot31, 0, ',', '.'); ?></td>
									<td align="right"><b><?= number_format($tot60, 0, ',', '.'); ?></td>
									<td align="right"><b><?= number_format($tot90, 0, ',', '.'); ?></td>
									<td align="right"><b><?= number_format($tot120, 0, ',', '.'); ?></td>
									<td align="right"><b><?= number_format($totall, 0, ',', '.'); ?></td>
									
								</tr>

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