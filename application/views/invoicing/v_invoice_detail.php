<?php $this->load->view('header');?>

<?php

	if($data_prospek > 0){

		foreach($data_prospek as $row){

			$pengantin = $row->calon_pria." & ".$row->calon_wanita;

			$telfon = $row->telfon;

			$email = $row->email1;

			$salesman = $row->salesman;

			$resepsi_date = $row->resepsi_date;

			$resepsi_time = $row->resepsi_jam;

			$tempat_resepsi = $row->tempat_resepsi;

			$alamat = $row->tempat1." ".$row->tempat2." ".$row->tempat3;

		}

	}

	if($list_invoice > 0){
		foreach($list_invoice as $row2){
			$no_cust = $row2->no_cust;
			$id_prospek = $row2->id_prospek;
			$id_penawaran	= $row2->id_penawaran;
		}
	}
/*
	if($total_deal > 0){
		foreach($total_deal as $row3){
			$dp1 = $row3->dp1;
			$dp2 = $row3->dp2;
			$dp3 = $row3->dp3;
			$dp4 = $row3->dp4;
			
		}
	}
*/
	$id				= $this->uri->segment(3);

	$data_piutang1 	= $this->invoice_model->get_piutang1($id);
	if($data_piutang1 > 0){
		foreach($data_piutang1 as $row4){
			$bayar = $row4->bayar;
			$no_byr = $row4->no_bayar;
		}
	}
	$data_piutang2 	= $this->invoice_model->get_piutang2($id);
	if($data_piutang2 > 0){
		foreach($data_piutang2 as $row5){
			$bayar = $row5->bayar;
			$no_byr = $row5->no_bayar;
		}
	}
	$data_piutang3 	= $this->invoice_model->get_piutang3($id);
	if($data_piutang3 > 0){
		foreach($data_piutang3 as $row6){
			$bayar = $row6->bayar;
			$no_byr = $row6->no_bayar;
		}
	}
	$data_piutang4 	= $this->invoice_model->get_piutang4($id);
	if($data_piutang4 > 0){
		foreach($data_piutang4 as $row7){
			$bayar = $row7->bayar;
			$no_byr = $row7->no_bayar;
		}
	}
	$tot_piutang 	= $this->invoice_model->get_tot_piutang($id);
	if($tot_piutang > 0){
		foreach($tot_piutang as $row8){
			$tot_deal = $row8->total_deal;
			$total_piutang = $row8->piutang;
		}
	}
?>

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

				<div class="row">

					<div class="box-header">

						<div class="box-body">

							<div class="box-body table-responsive no-padding">

							<table class="table table-bordered table-hover dataTable example1">

							<tbody>

								<tr>

									<td><b>Nama Marketing</b></td>

									<td><?=$salesman?></td>

									<td><b>Telepon</b></td>

									<td><?=$telfon?></td>

								</tr>

								<tr>

									<td width="20%"><b>Nama Pengantin</b></td>

									<td width="30%"><?=$pengantin?></td>

									<td width="20%"><b>Alamat</b></td>

									<td width="50%"><?=$alamat?></td>

								</tr>

								<tr>

									<td><b>ID Prospek</b></td>

									<td><?=$id_prospek?></td>

									<td><b>Email</b></td>

									<td><?=$email?></td>

								</tr>

								<tr>

									<td><b>ID Customer</b></td>

									<td><?=$no_cust?></td>

									<td><b>Total Deal</b></td>
<?php
$get_harga = $this->invoice_model->get_hrg($id_prospek);
								
if($get_harga > 0){
	foreach($get_harga as $row9){
		$tot_hrg = $row9->harga;
		//$tot_hrg = $total_deal;
		/*
		if($total_deal > 0){
			$tot_hrg = $total_deal;
		}elseif($row9->harga > 0){
			$tot_hrg = $row9->harga;
		}elseif($row9->harga_deal > 0){
			$tot_hrg = $row9->harga_deal;
		}elseif($row9->harga_net > 0){
			$tot_hrg = $row9->harga_net;
		}elseif($row9->harga_paket > 0){
			$tot_hrg = $row9->harga_paket;
		}
		*/	
	}
}
?>
									<td><?=number_format($tot_hrg)?></td>
									<!-- <td><?=number_format($total_deal)?></td> -->

								</tr>

								<tr>

									<td><b>Tanggal Resepsi</b></td>

									<td><?=date("d F Y",strtotime($resepsi_date))?></td>

									<td></td>

									<td></td>

								</tr>

								<tr>

									<td><b>Tempat Resepsi</b></td>

									<td><?=$tempat_resepsi?></td>

									<td></td>

									<td></td>

								</tr>

								<tr>

									<td><b>Jam Resepsi</b></td>

									<td><?=date("H:i",strtotime($resepsi_time))?></td>

									<td></td>

									<td></td>

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

	<section class="content-header">

    <div class="row">

        <div class="col-xs-12">

          <div class="box">

            <div class="box-header">

			<div class="box-body">

			 <!--<a href="<?=base_url()?>index.php/order/input" class="btn btn-warning" >Tambah Prospek <i class="fa fa-plus"></i></a>

            </div>-->

            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">

              <table class="table table-bordered table-hover dataTable example1">

				<thead>
					<tr>
					  <th>No</th>
					  <th>Jadwal Invoice</th>
					  <th>No. Invoice</th>
					  <th>Due Date</th>
					  <th>Ditagihkan Kepada</th>
					  <th>Status Bayar</th>
						<th>Total Tagihan</th>
					  <th>Jumlah Bayar</th>
						<th>Tanggal Bayar</th>
						<th>Piutang</th>
					  <th>Option</th>

						<!--
					  <th>Via Bank</th>
					  <th>Ke Rekening</th>
					  -->
					</tr>
				</thead>

				<tbody>

					<?php

					$i=0;

						if($list_invoice > 0){

							$no=0;

							$tot_bayar = 0;

							foreach($list_invoice as $row2){

							$no++;
						
							if($no == 1){
								if($row2->angsuran_ed > 0){
									$angsuran = $row2->angsuran_ed;
								}else{
									$persen = 20;						
									$angsuran = $tot_hrg * $persen/100;			
									//$angsuran = $total_deal * $persen/100;
								}

								if($data_piutang1 > 0){				// jika belum bayar angsuran pertama
									if($row2->angsuran_ed > 0){ //jika ada edit angsuran
											$sisa_akhir = $row2->angsuran_ed-$row4->bayar;
										//	$sisa_akhir = $total_deal-$row4->bayar;
									}else{												// jika sudah bayar angsuran pertama
										$persen = 20;									
										$angsuran_ = $tot_hrg * $persen/100;
										$sisa_akhir = $angsuran_ - $row4->bayar;
									//	$sisa_akhir = $row2->angsuran_ed;
									}
									//$persen = 20;								
									//$angsuran = $total_deal * $persen/100;
									//$sisa_akhir = $total_deal-$angsuran;
								}
							}elseif($no == 2){
								if($row2->angsuran_ed > 0){
									$angsuran = $row2->angsuran_ed;
								}else{
									$persen = 30;									
									$angsuran = $tot_hrg * $persen/100;
								}

								if($data_piutang2 > 0){			// jika belum bayar angsuran pertama
									if($row5->angsuran_ed > 0){ //jika ada edit angsuran
										$sisa_akhir = $row5->angsuran_ed-$row5->bayar;
										//$sisa_akhir = $total_deal-$row4->bayar;
									}else{	// jika sudah bayar angsuran pertama
										$persen = 30;									
										$angsuran_ = $tot_hrg * $persen/100;
										$sisa_akhir = $angsuran_ - $row5->bayar;
										//$sisa_akhir = $row2->angsuran_ed;									
									}
								//$persen = 30;
								//$angsuran = $total_deal * $persen/100;
								//$sisa_akhir = $sisa_akhir-$angsuran;
								}
							}elseif($no == 3){
								if($row2->angsuran_ed > 0){
									$angsuran = $row2->angsuran_ed;
								}else{
									$persen = 25;									
									$angsuran = $tot_hrg * $persen/100;
								}

								if($data_piutang3 > 0){			// jika belum bayar angsuran kedua
									if($row6->angsuran_ed > 0){ //jika ada edit angsuran
										$sisa_akhir = $row6->angsuran_ed-$row6->bayar;
										//$sisa_akhir = $total_deal-$row4->bayar;
									}else{	// jika sudah bayar angsuran pertama
										$persen = 25;									
										$angsuran_ = $tot_hrg * $persen/100;
										$sisa_akhir = $angsuran_ - $row6->bayar;
										//$sisa_akhir = $row2->angsuran_ed;									
									}
								}
								//$persen = 25;
								//$angsuran = $total_deal * $persen/100;
							}else{
								if($row2->angsuran_ed > 0){
									$angsuran = $row2->angsuran_ed;
								}else{
									$persen = 25;									
									$angsuran = $tot_hrg * $persen/100;
								}

								if($data_piutang4 > 0){			// jika belum bayar angsuran pertama
									if($row7->angsuran_ed > 0){ //jika ada edit angsuran
										$sisa_akhir = $row7->angsuran_ed-$row7->bayar;
										//$sisa_akhir = $total_deal-$row4->bayar;
									}else{	// jika sudah bayar angsuran pertama
										$persen = 25;									
										$angsuran_ = $tot_hrg * $persen/100;
										$sisa_akhir = $angsuran_ - $row7->bayar;
										//$sisa_akhir = $row2->angsuran_ed;									
									}
									//$persen = 25;
									//$angsuran = $total_deal * $persen/100;		
								
								}
							}							

							$check_ = $this->invoice_model->check($no,$row2->id_prospek);

							$check2 = $this->invoice_model->check2($no,$row2->id_prospek);

							$tot_bayar = $tot_bayar+$row2->bayar;

					?>

					<tr>

					  <td><?=$no?>.</td>
					  <td><?=date('d-M-Y', strtotime($row2->jadwal_invoice))?></td>
					  <td><?=$row2->nomor_invoice?></td>
					 
					  <td><?=(empty($row2->due_date_inv)) ? "" : date("d-M-Y",strtotime($row2->due_date_inv));?></td>
					  <td><?=$row2->billed_to?></td>
						<!-- status bayar -->
					  <td align="center"><?php if($sisa_akhir == 0){echo "LUNAS";}else{echo "BELUM LUNAS";}?></td>
															<!-- <td><?php if($row2->bayar > 0){echo "Paid";}else{echo "None";}?></td> -->
						<!-- total tagihan -->
						<!-- <td><?=number_format($row2->total)?></td> -->
					  <td align="right"><?=number_format($angsuran)?></td>
						<!-- jumlah bayar -->
            		  <td align="right"><?=number_format($row2->bayar)?></td>
						<!-- tgl bayar -->
					<td><?=(empty($row2->bayar_tgl)) ? "" : date("d-M-Y",strtotime($row2->bayar_tgl));?></td>
						<!-- piutang -->
						<!-- <td><?=number_format($row2->total - $row2->bayar)?></td> -->
					<td align="right"><?=number_format($sisa_akhir)?></td>
						<!--
					  
					  <td><?=$row2->bayar_via?></td>
					  <td><?=$row2->bank?></td>
					  <td><?=$row2->norek?></td>
						-->
					  <td width="10%">

						<?php

						if($row2->bayar == 0){

							if($check_ == 0){

								?>

								<button class="btn btn-primary btn-xs" width="20%" title='Edit Jadwal' data-toggle="modal" data-target="#myModal" onclick="return edit_schedule('<?=$row2->jadwal_invoice?>', <?=$row2->no_bayar?>)"><i class="fa fa-calendar-o"></i></button>

								<a href="<?=base_url()?>index.php/invoice/view_invoice/<?=$row2->id_prospek?>/<?=$row2->no_bayar?>" class="btn btn-primary btn-xs" width="20%" title='Create Invoice'><i class="fa fa-file-text"></i></a>

								<?php

							}else{

								?>
								<!--
								<a href="<?=base_url()?>index.php/invoice/payment/<?=$row2->nomor_invoice?>" class="btn btn-warning btn-xs" title='Payment'><i class="fa fa-money"></i></a>



								<a href="<?=base_url()?>index.php/invoice/edit_invoice/<?=$row2->nomor_invoice?>" class="btn btn-primary btn-xs" width="20%" title='Edit Invoice'><i class="fa fa-edit"></i></a>
								-->


					  			<a href="<?=base_url()?>index.php/invoice/print_invoice2/<?=$row2->id_prospek."/".$row2->no_bayar?>" class="btn btn-success btn-xs" width="20%" title='Print Invoice' target="blank"><i class="fa fa-print"></i></a>

								<?php

								if($this->session->userdata('pn_jabatan')=="0" && $row2->nomor_invoice !=''){//hanya admin yang bisa batal

									?>

									<a href="<?=base_url()?>index.php/invoice/cancel/<?=$row2->nomor_invoice."/".$row2->id_prospek?>" class="btn btn-danger btn-xs" title='Batal'><i class="fa fa-close"></i></a>

									<?php

								}

							}

						}

						

						if($this->session->userdata('pn_jabatan')=="0" && $row2->bayar !=''){//hanya admin yang bisa edit

						?>
<!--
							<a href="<?=base_url()?>index.php/invoice/payment/<?=$row2->nomor_invoice?>" class="btn btn-info btn-xs" title='Edit Payment'><i class="fa fa-edit"></i></a>
-->


					  		<a href="<?=base_url()?>index.php/invoice/print_invoice2/<?=$row2->id_prospek."/".$row2->no_bayar?>" class="btn btn-success btn-xs" width="20%" title='Print Invoice' target="blank"><i class="fa fa-print"></i></a>



					  		<a href="<?=base_url()?>index.php/invoice/print_receipt/<?=$row2->id_prospek."/".$row2->no_bayar?>" class="btn btn-primary btn-xs" width="20%" title='Print Kwitansi' target="blank"><i class="fa fa-print"></i></a>

						<?php

						}
					

						?>

					  </td>

					</tr>

					<?php

						//	$angsuran = $angsuran - $row2->bayar;

							}
						}
					?>

				<tr>
				<td align="right">
					<a href="<?=base_url()?>index.php/invoice/list_inv" class="btn btn-success" width="20%" >Kembali</a>
				</td>
						<td colspan="5" align="right"><b>Total</b></td>

						<td align="right"><b><?=number_format($tot_hrg)?></b></td>

						<td align="right"><b><?=number_format($tot_bayar)?></b></td>

						<td></td>

						<td align="right"><b><?=number_format($sisa_akhir=$tot_hrg-$tot_bayar)?></b></td>
						<td></td>
						

					</tr>

				</tbody>

              </table>

            </div>

        </div>

        </div>

    </div>

	<div id="show_stock"></div>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  	<form action="<?=site_url('invoice/edit_jadwal_invoice')?>" method='POST' autocomplete="off">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit Jadwal</h4>
		      </div>
		      <div class="modal-body">
		        <div class="form-group">
		            <label for="recipient-name" class="control-label">Jadwal :</label>
								
		            <div class="input-group">
		            	<div class="input-group-addon">
		            		<i class="fa fa-calendar-o"></i>
		            	</div>
		            	<input type="hidden" name="id_penawaran" value="<?=$id_penawaran?>">
		            	<input type="hidden" name="id_prospek" value="<?=$id_prospek?>">
		            	<input type="hidden" name="no_bayar" id="no_bayar" value="">
		            	<input type="text" class="form-control" name="jadwal" id="jadwal" value="" data-date-format="yyyy-mm-dd"><br>
		            </div>
								<!--
								<br>
								<label for="recipient-name" class="control-label">Angsuran :</label>
								<div class="input-group">
		            	<div class="input-group-addon">
		            		<i class="fa fa-money"></i>
		            	</div>
									<?php
										$no=0;
										foreach($list_invoice as $row2){

											$no++;
										
											if($no == 1){
												if($row2->angsuran_ed > 0){
													$angsuran = $row2->angsuran_ed;
												}else{
													$persen = 20;									
													$angsuran = $total_deal * $persen/100;
												}												
											}elseif($no == 2){
												if($row2->angsuran_ed > 0){
													$angsuran = $row2->angsuran_ed;
												}else{
													$persen = 30;									
													$angsuran = $total_deal * $persen/100;
												}												
											}elseif($no == 3){
												if($row2->angsuran_ed > 0){
													$angsuran = $row2->angsuran_ed;
												}else{
													$persen = 25;									
													$angsuran = $total_deal * $persen/100;
												}
											}else{
												if($row2->angsuran_ed > 0){
													$angsuran = $row2->angsuran_ed;
												}else{
													$persen = 25;									
													$angsuran = $total_deal * $persen/100;
												}												
											}
										}	
									?>
									<input type="text" class="form-control" name="edit_angsuran" id="edit_angsuran" value="">
		            </div>
								-->
		        </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Save changes</button>
		      </div>
		    </div>
		  </div>
	  	</form>
	</div>

	</section>

<?php $this->load->view('footer');?>

<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/moment.min.js"></script>

<script>

	$(document).ready(function(){
		$('#jadwal').datepicker({
			dateFormat:'yy-mm-dd',
			autoclose: true
		});
	});

	$(function () {
		$(".example1").DataTable();
	});

	function edit_schedule(jadwal, no_bayar) {
		$('#jadwal').val(jadwal);
		$('#no_bayar').val(no_bayar);
	}

</script>