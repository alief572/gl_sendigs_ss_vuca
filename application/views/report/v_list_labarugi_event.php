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
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
					<b>PERIODE : </b><br><br>
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" target="_blank" action="<?=base_url()?>index.php/report/tampilkan_labarugi_event" autocomplete="off">
              <table class="table table-bordered">			 
			  <tr>
									<td width="15%" align="right"><b>PROJECT</b></td>
									<td>
										<select type="text" name="project" class="form-control" onchange="changeValue(this.value)">
											<option value=""> -- PILIH PROJECT --</option>
											<?php
											if($data_project > 0 ){
												foreach($data_project as $row_project){
														$id_project = $row_project->id_penawaran;
														$pria		= $row_project->pengantin_pria;
														$wanita		= $row_project->pengantin_wanita;
														$nganten	= $pria." & ".$wanita;
													echo "<option value='".$id_project."'>".$id_project." ".$nganten."</option>";	
												}
											}
											?>
										</select>									
									</td>
								</tr>	
								<tr>								
									<td width="15%" align="right"><b>Nama Pengantin</b></td>
									<td id="nganten_td">
										<input class="form-control" name="nganten" id="nganten" readonly/>					
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

<section class="content-header">
	<div class="col-xs-12">
		<div class="box">
			<div class="row">
				<div class="box-header">
					<div class="box-body">
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">

							<tbody>
									<?php
											if($data_project2 > 0 ){
												foreach($data_project2 as $row_project2){
														$id_project2 = $row_project2->id_penawaran;
														$pria2		= $row_project2->pengantin_pria;
														$wanita2		= $row_project2->pengantin_wanita;
														$nganten2	= $pria2." & ".$wanita2;
													
												}
											}
										?>
							<tr>
								<th colspan="3" style="text-align:center;font-size:15px;"><center>LAPORAN LABA RUGI BY PROJECT<br>Nomor Project : <?=$id_project2?><br>Nama Pengantin : <?=$nganten2?></center></th>
							</tr>

							<tr>
								<td><center><b>No. Perkiraan</b></center></td>
								<td><center><b>Nama Perkiraan</b></center></td>
								<td><center><b>Jumlah</b></center></td>								
							</tr>

							<!-- PENDAPATAN -->
							<tr>
								<td><b>41</b></td>
								<td><b>PENDAPATAN</b></td>
								<td></td>							
							</tr>

							<?php
								if($data_nokir_pdptn > 0){
									$sum_kredit=0;
									$sub_tot_pdptn=0;
									
									foreach($data_nokir_pdptn as $row){

										$nokir						= $row->no_perkiraan;
										$nm_perkiraan				= $row->keterangan;
										$nilai_kredit				= $row->kredit;
										$sum_kredit					+= $nilai_kredit;
										$sub_tot_pdptn				+= $sum_kredit;						

										$rp_sum_kredit				= "Rp. " . number_format($sum_kredit,0,',','.');
										$rp_sub_tot_pdptn			= "Rp. " . number_format($sum_kredit,0,',','.');
										$rp2_nilai_kredit			= "Rp. " . number_format($nilai_kredit,0,',','.');
						?>
						<tr>
							<td><?=$nokir?></td>
							<td><?=$nm_perkiraan?></td>
							<td align="right"><?=$rp2_nilai_kredit?></td>							
						</tr>
						<?php
							}
						}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total PENDAPATAN</b></td>
							<td align="right"><b><?=$rp_sub_tot_pdptn?></b></td>		
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
							</tr>

						<!-- HPP -->
						<tr>
							<td><b>51</b></td>
							<td><b>HARGA POKOK PENJUALAN</b></td>
							<td></td>
						</tr>
						
						<?php
								if($data_nokir_hpp > 0){
									$sum_debet2=0;
									$sub_tot_hpp=0;
									$kotor=0;
									
									foreach($data_nokir_hpp as $row2){

										$nokir2						= $row2->no_perkiraan;
										$nm_perkiraan2				= $row2->keterangan;
										$nilai_debet2				= $row2->debet;
										$sum_debet2					+= $nilai_debet2;
										$sub_tot_hpp				+= $sum_debet2;	
										$kotor						= $sub_tot_pdptn - 	$sub_tot_hpp;				

										$rp_sum_debet				= "Rp. " . number_format($sum_debet2,0,',','.');
										$rp_sub_tot_hpp				= "Rp. " . number_format($sub_tot_hpp,0,',','.');
										$rp_kotor					= "Rp. " . number_format($kotor,0,',','.');
						?>
						<tr>
							<td><?=$nokir2?></td>
							<td><?=$nm_perkiraan2?></td>
							<td align="right"><?=$rp_sum_debet?></td>
							
						</tr>
							<?php
									}
								}else{
									$sub_tot_hpp=0;
									$kotor						= $sub_tot_pdptn - 	$sub_tot_hpp;
									$rp_kotor					= "Rp. " . number_format($kotor,0,',','.');						
								}
							?>
						<tr>
							<td></td>
							<td><b>Sub Total HARGA POKOK PENJUALAN</b></td>
							<td align="right"><b><?=$rp_sub_tot_hpp?></b></td>
							
						</tr>
						<tr>
							<td></td>
							<td align="center"><b>LABA/RUGI KOTOR</b></td>
							<td align="right"><b><?=$rp_kotor?></b></td>
									
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>								
						</tr>

						<!-- BIAYA PENJUALAN-->
						<tr>
							<td><b>61</b></td>
							<td><b>BIAYA PENJUALAN</b></td>
							<td></td>							
						</tr>
						
						<?php			
								if($data_nokir_biaya > 0){
									$sum_debet3=0;
									$sub_tot_biaya=0;
									
									foreach($data_nokir_biaya as $row3){

										$nokir3						= $row3->no_perkiraan;
										$nm_perkiraan3				= $row3->keterangan;
										$nilai_debet3				= $row3->debet;
										$sum_debet3					+= $nilai_debet3;
										$sub_tot_biaya				+= $sum_debet3;											

										$rp_sum_debet3				= "Rp. " . number_format($sum_debet3,0,',','.');
										$rp_sub_tot_biaya			= "Rp. " . number_format($sub_tot_biaya,0,',','.');			
						?>
						<tr>
							<td><?=$nokir3?></td>
							<td><?=$nm_perkiraan3?></td>
							<td align="right"><?=$rp_sum_debet3?></td>							
						</tr>
						<?php
									}	
								}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA PENJUALAN</b></td>
							<td align="right"><b><?=$rp_sub_tot_biaya?></b></td>							
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>								
						</tr>
						<?php
								
						?>
						
						<!-- BIAYA KANTOR DAN UMUM-->
						<tr>
							<td><b>68</b></td>
							<td><b>BIAYA KANTOR DAN UMUM</b></td>
							<td></td>
							
						</tr>
						
						<?php			
								if($data_nokir_biaya2 > 0){
									$sum_debet4=0;
									$sub_tot_biaya2=0;
									
									foreach($data_nokir_biaya2 as $row4){

										$nokir4						= $row4->no_perkiraan;
										$nm_perkiraan4				= $row4->keterangan;
										$nilai_debet4				= $row4->debet;
										$sum_debet4					+= $nilai_debet4;
										$sub_tot_biaya2				+= $sum_debet4;	
										$tot_biaya					= $sub_tot_biaya + $sub_tot_biaya2;											

										$rp_sum_debet4				= "Rp. " . number_format($sum_debet4,0,',','.');
										$rp_sub_tot_biaya2			= "Rp. " . number_format($sub_tot_biaya2,0,',','.');
										$rp_tot_biaya				= "Rp. " . number_format($tot_biaya,0,',','.');	
						?>
						<tr>
							<td><?=$nokir4?></td>
							<td><?=$nm_perkiraan4?></td>
							<td align="right"><?=$rp_sum_debet4?></td>							
						</tr>
						<?php
							}
									}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA KANTOR</b></td>
							<td align="right"><b><?=$rp_sub_tot_biaya2?></b></td>
							
						</tr>
						<tr>
							<td></td>
							<td><b>Total BIAYA</b></td>
							<td align="right"><b><?=$rp_tot_biaya?></b></td>
							
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>
								
							</tr>
						<?php
									
						?>

						<!-- PENDAPATAN LAIN-LAIN -->
						<tr>
								<td><b>71</b></td>
								<td><b>PENDAPATAN LAIN-LAIN</b></td>
								<td></td>
								
							</tr>

							<?php
								if($data_nokir_pdptn2 > 0){
									$sum_kredit5=0;
									$sub_tot_pdptn5=0;
									
									foreach($data_nokir_pdptn2 as $row5){

										$nokir5						= $row5->no_perkiraan;
										$nm_perkiraan5				= $row5->keterangan;
										$nilai_kredit5				= $row5->kredit;
										$sum_kredit5				+= $nilai_kredit5;
										$sub_tot_pdptn5				+= $sum_kredit5;						

										$rp_sum_kredit5				= "Rp. " . number_format($sum_kredit5,0,',','.');
										$rp_sub_tot_pdptn5			= "Rp. " . number_format($sub_tot_pdptn5,0,',','.');
						?>
						<tr>
							<td><?=$nokir5?></td>
							<td><?=$nm_perkiraan5?></td>
							<td align="right"><?=$rp_sum_kredit5?></td>
								
						</tr>
						<?php 
									}
								}
						?>
						<tr>
							<td></td>
							<td><b>Sub Total PENDAPATAN LAIN-LAIN</b></td>
							<td align="right"><b><?=$rp_sub_tot_pdptn5?></b></td>							
						</tr>
						<tr>
								<td></td>
								<td></td>
								<td></td>								
							</tr>

						<!-- BIAYA LAIN-LAIN-->
						<tr>
							<td><b>72</b></td>
							<td><b>BIAYA LAIN-LAIN</b></td>
							<td></td>							
						</tr>
						
						<?php
						if($data_nokir_biaya3 > 0){
							$sum_debet6=0;
							$sub_tot_biaya3=0;
							
							foreach($data_nokir_biaya3 as $row6){

								$nokir6						= $row6->no_perkiraan;
								$nm_perkiraan6				= $row6->keterangan;
								$nilai_debet6				= $row6->debet;
								$sum_debet6					+= $nilai_debet6;
								$sub_tot_biaya3				+= $sum_debet6;	
								
								$bersih						= $kotor - $tot_biaya + $sub_tot_pdptn5 - $sub_tot_biaya3;			

								$rp_sum_debet6				= "Rp. " . number_format($sum_debet6,0,',','.');
								$rp_sub_tot_biaya3			= "Rp. " . number_format($sub_tot_biaya3,0,',','.');
								$rp_bersih					= "Rp. " . number_format($bersih,0,',','.');			
						?>
						<tr>
							<td><?=$nokir6?></td>
							<td><?=$nm_perkiraan6?></td>
							<td align="right"><?=$rp_sum_debet6?></td>							
						</tr>
						<?php
							}
						}else{
							/*
							$tot_biaya					= $sub_tot_biaya + $sub_tot_biaya2;
							$bersih						= $kotor - $tot_biaya + $sub_tot_pdptn5 - $sub_tot_biaya3;
							$rp_bersih					= "Rp. " . number_format($bersih,0,',','.');
							*/
						}							
						?>
						<tr>
							<td></td>
							<td><b>Sub Total BIAYA LAIN-LAIN</b></td>
							<td align="right"><b><?=$rp_sub_tot_biaya3?></b></td>
						</tr>

						<tr>
							<td></td>
							<td align="center"><b>LABA/RUGI BERSIH</b></td>
							<td align="right"><b><?=$rp_bersih?></b></td>							
						</tr>
						<?php
						
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
<?php $this->load->view('footer');?>

<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script>
	function check(){
		if($("#project").val()=="0"){
			alert("Silahkan Pilih Project");
			return false;
		}
	}
	function changeValue(id){
		$.get( "<?= base_url(); ?>index.php/report/change_lr_event" , { option : id } , function ( data ) {
		$( '#nganten_td' ) . html ( data ) ;
		} ) ;
	}
	
</script>
