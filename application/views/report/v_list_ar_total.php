<?php
$tampilkan = @$this->input->post('tampilkan');
if($tampilkan!='View Excel') {

$this->load->view('header');?> 

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
					<b>PERIODE : </b><br><br>
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" target="_blank" action="<?=base_url()?>index.php/report/tampilkan_ar_total" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="25%" align="right"><b>Bulan</b></td>
									<td>
									
									<select type="text" name="bulan_labarugi" class="form-control">
										<?php
										$nm_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
										$bulan = @$this->input->post('bulan_labarugi');
										if(empty($bulan)){
											$bulan = date("m")+0;
										}
										for($i=1;$i<=12;$i++){
											if($i==$bulan){
												echo "<option selected value='$i'>".$nm_bulan[$i]."</option>";	
											}else{
												echo "<option value='$i'>".$nm_bulan[$i]."</option>";	
											}
																
										}
										?>
									</select>
									
									</td>
								</tr>

								<tr>
									<td width="25%" align="right"><b>Tahun</b></td>
									<td>

										<select type="text" name="tahun_labarugi" class="form-control">
											<?php
											$tahun = @$this->input->post('tahun_labarugi');
											if(empty($tahun)){
												$tahun = date("Y")+0;
											}
											for($i=date("Y")-8;$i<=date("Y")+2;$i++){
												if($tahun == $i){
													echo "<option selected value='$i'>$i</option>";
												}else{
													echo "<option value='$i'>$i</option>";
												}
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td width="15%" align="right"><b>Customer</b></td>
									<td>

									 <?php
									$datklien[0]	= 'Select An Option';						
									echo form_dropdown('id_klien',$datklien, set_value('id_klien', isset($data->id_klien) ? $data->id_klien : 'selected'), array('name'=>'id_klien','id'=>'id_klien','class'=>'form-control id_klien'));											
									?> 

									</td>
								</tr>

				<tr>
					<td width="25%" align="right"></td>
					<td width="25%" align="left">
						<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center">                             
						<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn btn-success pull-center">
					</td>
				</tr>
				
				</table>
			  <!-- <a href="<?=base_url()?>index.php/report/print_labarugi" class="btn btn-warning" target="_blank">CETAK</a> -->
				
			  </form>
            
        </div>
    </div>
    </div>
</section>
<?php } ?>
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
								//
												if($data_bulan_post > 0){
														$nm_bln = $data_bulan_post;
														if($nm_bln == 1){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br>Periode : Januari ".$data_tahun_post."</center></th></tr>";															
														}elseif($nm_bln == 2){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Februari ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 3){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Maret ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 4){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : April ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 5){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Mei ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 6){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Juni ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 7){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Juli ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 8){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Agustus ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 9){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : September ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 10){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Oktober ".$data_tahun_post."</center></th></tr>";
														}elseif($nm_bln == 11){
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : November ".$data_tahun_post."</center></th></tr>";
														}else{
															echo "<tr><th colspan='5' style='text-align:center;font-size:15px;'><center>LAPORAN PIUTANG<br><br>Periode : Desember ".$data_tahun_post."</center></th></tr>";
														}														
												}
											?>
							</tr>

							<tr>
								
								<td><left><b>Nama customer</b></left></td>
								<td><center><b>Saldo Awal</b></center></td>
								<td><center><b>Tr Debet</b></center></td>
								<td><center><b>Tr Kredit</b></center></td>
								<td><center><b>Saldo Akhir</b></center></td>
								
							</tr>

							
							<?php
							     $rp_total_saldo_akhir = 0;
								 $rp_total_saldo_awal = 0;
								 $rp_total_debet = 0;
								 $rp_total_kredit = 0;
								 
								if($data_ar > 0){
									
									
									$total_saldo_akhir = 0;
									$total_saldo_awal = 0;
									$total_debet = 0;
									$total_kredit = 0;

									foreach($data_ar as $row){
                                       
										$no_invoice				= $row->no_invoice;
										$nama_klien  			= $row->nama_klien;
										$saldo_awal					= $row->saldo_awal;
										$debet					    = $row->debet;
										$kredit					    = $row->kredit;
										$saldo_akhir					= $row->saldo_akhir;
										// $pYTD_pdptn					= ($row->saldoawal) * $v_faktor;
										// $cmonth_pdptn				= $row->kredit;
										// $YTD_pdptn					= $pYTD_pdptn + $cmonth_pdptn;

										// $total_pYTD_pdptn 	+=  $pYTD_pdptn;
										// $total_cmonth_pdptn +=  $cmonth_pdptn;
										$total_saldo_akhir		+=  $saldo_akhir;
										$total_saldo_awal		+=  $saldo_awal;
										$total_debet			+=  $debet;
										$total_kredit			+=  $kredit;

										// $rp_pYTD_pdptn			= "Rp. " . number_format($pYTD_pdptn,0,',','.');
										// $rp_cmonth_pdptn		= "Rp. " . number_format($cmonth_pdptn,0,',','.');
										// $rp_YTD_pdptn				= "Rp. " . number_format($YTD_pdptn,0,',','.');
									
										// $rp_total_pYTD_pdptn			= "Rp. " . number_format($total_pYTD_pdptn,0,',','.');
										// $rp_total_cmonth_pdptn		= "Rp. " . number_format($total_cmonth_pdptn,0,',','.');
										$rp_saldo_akhir				= "Rp. " . number_format($saldo_akhir,0,',','.');
										$rp_saldo_awal				= "Rp. " . number_format($saldo_awal,0,',','.');
										$rp_debet				= "Rp. " . number_format($debet,0,',','.');
										$rp_kredit				= "Rp. " . number_format($kredit,0,',','.');
										$rp_total_saldo_akhir				= "Rp. " . number_format($total_saldo_akhir,0,',','.');
										$rp_total_saldo_awal				= "Rp. " . number_format($total_saldo_awal,0,',','.');
										$rp_total_debet				= "Rp. " . number_format($total_debet,0,',','.');
										$rp_total_kredit			= "Rp. " . number_format($total_kredit,0,',','.');
										
						
						?>
						<tr>
							
							<td><?=$nama_klien?></td>
							<td align="right"><?=$rp_saldo_awal?></td>
							<td align="right"><?=$rp_debet?></td>
							<td align="right"><?=$rp_kredit?></td>
							<td align="right"><?=$rp_saldo_akhir?></td>
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td colspan="1"><b>TOTAL</b></td>
							<td align="right"><b><?=$rp_total_saldo_awal?></b></td>	
							<td align="right"><b><?=$rp_total_debet?></b></td>	
							<td align="right"><b><?=$rp_total_kredit?></b></td>	
							<td align="right"><b><?=$rp_total_saldo_akhir?></b></td>		
						</tr>
						
						</tbody>

							</table>

						</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>
<?php
if($tampilkan!='View Excel') {	
	$this->load->view('footer');?>

<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script>
	function check(){
		if($("#bulan_labarugi").val()=="0"){
			alert("Silahkan Pilih Bulan");
			return false;
		}else if($("#tahun_labarugi").val()=="0"){
			alert("Silahkan Pilih Tahun");
			return false;
		}else if($("#level").val()==""){
			alert("Silahkan Pilih Level");
			return false;
		}
	}
	
</script>
<?php } ?>