<?php $this->load->view('header');?>
    <section class="content-header">
      <h1> Jadwal Invoice
       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$judul?></li>
      </ol>
    </section>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

			<div class="box-body">
				<form action="<?=base_url()?>index.php/invoice/list_inv_change" method="post">
				<div class="col-xs-2">PERIODE RESEPSI 
				</div>
				<div class="col-xs-2"> 
					
					<select type="text" name="tahun" class="form-control" onchange="this.form.submit()">
						<?php
						$tahun = @$this->input->post('tahun');
						if(empty($tahun)){
							$tahun = date("Y");
						}
						for($i=date("Y")-2;$i<=date("Y")+2;$i++){
							if($tahun == $i){
								echo "<option selected value='$i'>$i</option>";
							}else{
								echo "<option value='$i'>$i</option>";
							}
						}
						?>
					</select>
				</div>
				<div class="col-xs-2">
				
				<select type="text" name="bulan" class="form-control" onchange="this.form.submit()">
						<?php
						$nm_bulan = array('All','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						$bulan = @$this->input->post('bulan');										
										if(empty($bulan)){
											//$bulan = date("m")+0;
											$bulan = 0;
										}
										for($i=0;$i<=12;$i++){
											if($i==$bulan){
												echo "<option selected value='$i'>".$nm_bulan[$i]."</option>";	
											}else{
												echo "<option value='$i'>".$nm_bulan[$i]."</option>";	
											}
																
										}
						/*
						$bulan = $this->input->post('bulan');
						$uri_s3 	= $this->uri->segment(3);
						if($uri_s3 == 'month'){
							$bulan = date('m');
						} /*else if(!empty($post_bulan)){
							$bulan = 0;
						}
						for($i=0;$i<=12;$i++){
							if($i==$bulan){
								echo "<option selected value='$i'>".$nm_bulan[$i]."</option>";	
							}else{
								echo "<option value='$i'>".$nm_bulan[$i]."</option>";	
							}
						}
						*/
						?>
					</select>
				</div>
				
				</form>
			</div>
            
				<div class="box-body">
            <div class="box-body no-padding">
						<!-- <div class="box-body table-responsive no-padding"> -->
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th></th>
						
					  <!--  <th>Marketing</th>  -->	
					  <th>No. SPD (Marketing)</th>
					  <th>Tanggal Transaksi</th>
					  <th>Calon Pengantin</th>
					  <th>Tanggal Resepsi</th>
					  <th>Tempat</th>
					  <th>Payment Status</th>
					  <th>Harga Deal</th>
					 <!-- <th>Harga Net</th>-->	
					    
					  <th>Total Bayar</th>
					  <th>Piutang</th>
					  
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_invoice > 0){
							$no=0;
							foreach($list_invoice as $row){
								$no++;
								$id = $row->id_prospek;
								$tempat_resepsi = $row->temp;
								$data_prospek = $this->order_model->get_prospek($id);
								if($data_prospek > 0){
									foreach($data_prospek as $row2){
										$telfon = $row2->telfon;
										$email = $row2->email1;
										$salesman = $row2->salesman;
										$resepsi_date = $row2->resepsi_date;
										$resepsi_jam = $row2->resepsi_jam;
										$tgl_deal = $row2->tgl_deal;
										$tempat = $row2->tempat1;
										$tempat			= $row2->tempat1." ".$row2->tempat2." ".$row2->tempat3;
									}
								}
								$pria_wanita = $row->pengantin_pria.' & '.$row->pengantin_wanita;
								$piutang = 0;
								
								$id_penawaran = $row->id_penawaran;
								$id_penawarana = $row->id_penawaran;
								$id_penawaranx = str_replace("|","_",$id_penawaran);
								$id_penawaran = explode("|",$id_penawaran);
								$id_penawaran1 = substr($id_penawaran[0],1,4);
								$id_penawaran2 = $id_penawaran[1] + 0;

								$get_tot_byr = $this->master_model->get_customer3($id);
								
								if($get_tot_byr > 0){
									foreach($get_tot_byr as $row4){
									$tot_byr = $row4->sdh_byr;									
									}
								}

								//$sts_payment	= (empty($row->last_payment)) ? "" : "Invoice ".$row->invoice_ke.": ".date('d F Y', strtotime($row->last_payment));
								
								//$ttl_payment	= ($row->total_deal)-($row->piutang);
								//$ttl_payment	= (empty($row->ttl_payment)) ? 0 : $row->ttl_payment;
								$sisa_bayar		= $row->harga - $tot_byr;

								if($sisa_bayar > 0 ){
									$sts_payment	= "Belum Lunas";
								}else{
									$sts_payment	= "Lunas";
								}

                                if(!empty($row->komisi_gedung))
 									$net=$row->harga - $row->komisi_gedung;
                                else
									$net=$row->harga;
 
					?>
					<tr>
					  <td>
							<!--<?=$no?>-->

							<a href="<?=base_url()?>index.php/invoice/list_detail/<?=$id?>" class="btn btn-primary" width="20%" >Detail <i class="fa fa-list"></i></a><br><br>

							<a href="<?=base_url()?>index.php/invoice/edit_angsuran/<?=$id?>" class="btn btn-success" width="20%" >Edit Angsuran</a>
							
						</td>
<!--
						<td>
							<a href="<?=base_url()?>index.php/invoice/list_detail/<?=$id?>" class="btn btn-primary" width="20%" >Detail <i class="fa fa-list"></i></a>
						</td>
-->					
					
					  <!-- <td><?=$salesman?></td> -->
					  <td><?=$id_penawarana?><br>(<?=$salesman?>)</td>
					  <td><?=date("d F Y",strtotime($tgl_deal))?></td>
					  <td><?=$pria_wanita?></td>
					 
					  <td><?=date("d F Y",strtotime($resepsi_date))?></td>
					  
					  <td><?=$tempat_resepsi?></td>
					  <td><?=$sts_payment?></td>
					  <td align="right"><?=number_format($row->harga)?></td>
                     
					  	<!--<td align="right"><?=number_format($net)?></td>-->	
					  
					  <td align="right"><?=number_format($tot_byr)?></td>
					  <td align="right"><?=number_format($sisa_bayar)?></td>
					  
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
	<div id="show_stock"><div>
	</section>
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function () {
    $(".example1").DataTable(
			{
				"ordering": true, // Set true agar bisa di sorting
				"order": [[ 4, 'asc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			}
		);
  });
</script>