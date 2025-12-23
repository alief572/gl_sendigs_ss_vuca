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
						<form method="post" action="<?=base_url()?>index.php/kartu_piutang/tampilkan_detail_invoice" autocomplete="off">
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
										$klien    	= $datvendor;
										
										$supp  = $this->db->query("SELECT * FROM waterco_live.master_customers WHERE id_customer='$klien'")->row();
									
											
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>Laporan Detail Invoice<br>Periode :  " . date_format(new DateTime($awal), "d-m-Y") . " S/D ". date_format(new DateTime($akhir), "d-m-Y") ."</center></th></tr>";
										echo "<tr><th colspan='8' style='text-align:center;font-size:15px;'><center>NAMA KLIEN : " . $supp->nama_klien . "</center></th></tr>";
										
										?>
									</tr>

									<tr>
									    <td>
										<center><b>Tgl Invoice</b></center>
										</td>
										<td>
										<center><b>No Invoice</b></center>
										</td>
										<td>
											<center><b>No SPK</b></center>
										</td>
										<td>
											<center><b>Nama Customer</b></center>
										</td>
										<td>
											<center><b>Total</b></center>
										</td>
										
										
									</tr>
									
																										
									<!-- DATA DARI JURNAL -->
											<?php
											
											$detail_jurnal	= $this->Kartupiutang_model->get_detail_invoice($awal,$akhir,$klien);
											if ($detail_jurnal > 0) {
												$count2 = 0;
												$count3 = 0;

												foreach ($detail_jurnal as $row_dj) {
													$count2++;
													$count3++;
													$tgl_invoice				= $row_dj->tgl_invoice;
													$no_invoice				    = $row_dj->no_invoice;
													$no_po					    = $row_dj->no_po;
													$klien					    = $row_dj->nama_klien;
													$total   				    = $row_dj->total;
													$totalall   				+= $row_dj->total;
											?>
													<tr>
                                                        <td align="center"><?= date_format(new DateTime($tgl_invoice), "d-m-Y")  ?></td>
														<td><?= $no_invoice ?></td>
														<td><?= $no_po ?></td>
														<td><?= $klien ?></td>
														<td align="right"><?= number_format($total, 0, ',', '.'); ?></td>
														
													</tr>
											<?php
												}
											}
											else{
												
											}
											?>

											<tr>
										
									
								</tbody>
								            <tr>
                                                        <td colspan="4" align="center"><b>Total</td>
														
														<td align="right"><b><?= number_format($totalall, 0, ',', '.'); ?></td>
														
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