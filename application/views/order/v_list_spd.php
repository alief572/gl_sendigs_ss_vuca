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
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<div class="box-body">
			<form action="<?=base_url()?>index.php/order/daftar_deal" method="post">
				<div class="col-xs-2">
					<select type="text" name="tahun" class="form-control" onchange="this.form.submit()">
						<?php
						$tahun = @$this->input->post('tahun');
						if(empty($tahun)){
							$tahun = date("Y")+0;
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
							$bulan = 0;
						}

						for($i=0;$i<=12;$i++){
							if($i==$bulan){
								echo "<option selected value='$i'>".$nm_bulan[$i]."</option>";	
							}else{
								echo "<option value='$i'>".$nm_bulan[$i]."</option>";	
							}
						}
						?>
					</select>
				</div>
			</form>
			</div>
			<div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <!-- <th>No.</th> -->
						<th>Edit</th>
					  <!-- <th>Marketing</th> -->
					  <th>No. SPD (Marketing)</th>
					  <th>Tanggal Transaksi</th>
					  <th>Calon Pengantin</th>
					  <th>Telpon</th>
					  <th>Tanggal Resepsi</th>
					  <th>Jam Resepsi</th>
					  <th>Tempat</th>
					 <!-- <th>Payment Status</th> -->
					  <th>Harga Deal</th>
					  <!-- <th>Harga Net</th> -->
					    
					  <th>Total Bayar</th>
					  <th>Piutang</th>
					  
					</tr>
				</thead>
				<tbody>
					<?php
													
					$i=0;
						if($list_spd > 0){
							$no=0;
							foreach($list_spd as $row){
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
								/*
								$get_piutang = $this->master_model->get_customer2($id);
													if($get_piutang > 0){ 
														foreach($get_piutang as $row3){
															$tot_deal = $row3->total_deal;
															$piutang = $row3->piutang;
															$ttl_byr	= ($tot_deal)-($piutang);
														}
													}
													*/
								$pria_wanita = $row->pengantin_pria.' & '.$row->pengantin_wanita;
								
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
									//$piutang = $row3->piutang;
									//$ttl_byr	= ($row4->total_deal)-($row4->piutang);
									//$ttl_byr	= $sdh_byr;
									}
								}

							//	$sts_payment	= (empty($row->last_payment)) ? "" : "Invoice ".$row->invoice_ke.": ".date('d F Y', strtotime($row->last_payment));
								//$ttl_payment	= (empty($row->ttl_payment)) ? 0 : $row->ttl_payment;
								//$ttl_payment	= ($row->total_deal)-($row->piutang);
								//$ttl_payment	= ($tot_deal)-($piutang);
								//$ttl_payment	+= $row->bayar;
								$sisa_bayar		= $row->harga - $tot_byr;
                                if(!empty($row->komisi_gedung))
 									$net=$row->harga - $row->komisi_gedung;
                                else
									$net=$row->harga;
 
					?>
					<tr>
					  <!-- <td><?=$no?></td> -->
						<td width="15%">
					  <a href="<?=base_url()?>index.php/order/edit_prospek/<?=$row->id_prospek?>"class='btn btn-primary btn-sm' title="Edit Prospek" onclick="return edit_stock(<?=$row->id_prospek?>)"><i class="fa fa-edit"></i>
					  </a>
					  <?php
					  if($row->sts_progres =="Sudah Diberi Penawaran"){
						$xx = $this->order_model->get_id_pen($row->id_prospek);
						$id_penawaran = $xx;
						if($id_penawaran != '0'){
						?>
							<a class="btn btn-info" href="<?=base_url()?>index.php/order/edit_penawaran/<?=$row->id_prospek?>" width="20%" title="Edit Penawaran"><i class="fa fa-undo"></i></a>
							<a class="btn btn-default" href="<?=base_url()?>index.php/order/print_penawaran/<?=$id_penawaranx?>" target="blank" width="20%" title="Print Penawaran"><i class="fa fa-print"></i></a>
							 <a class="btn btn-warning" href="<?=base_url()?>index.php/order/data_customer/<?=$row->id_prospek?>" width="20%" title="Input Customer"><i class="fa fa-group"></i></a>
							 <?php
						}else{
						?>
							<a class="btn btn-warning" href="<?=base_url()?>index.php/order/buat_penawaran/<?=$row->id_prospek?>" width="20%" title="Buat Penawaran"><i class="fa fa-file"></i></a>
						<?php
						}
					  }elseif($row->sts_progres =="Sudah Deal"){
						?>
						<a class="btn btn-warning" href="<?=base_url()?>index.php/order/edit_data_customer/<?=$row->id_prospek?>/1" width="20%" title="Edit Data Customer"><i class="fa fa-wrench"></i></a>
						<a class="btn btn-default" href="<?=base_url()?>index.php/order/print_penawaran/<?=$id_penawaranx?>" target="blank" width="20%" title="Print Penawaran"><i class="fa fa-print"></i></a>
						<?php
					  }else{
					  ?>
						 <a class="btn btn-warning" href="<?=base_url()?>index.php/order/buat_penawaran/<?=$row->id_prospek?>" width="20%" title="Buat Penawaran"><i class="fa  fa-file"></i></a>
					  <?php
					  }
					 /* 
					  
				*/
					  ?>
					  </td>
					  <!-- <td><?=$salesman?></td> -->
					  <td><?=$id_penawarana?><br>(<?=$salesman?>)</td>
					  <td><?=date("d F Y",strtotime($tgl_deal))?></td>
					  <td><?=$pria_wanita?></td>
					  <td><?=$telfon?></td>
					  
					  <td><?=date("d F Y",strtotime($resepsi_date))?></td>
					  <td><?=$resepsi_jam?></td>
					  <td><?=$tempat_resepsi?></td>
					  	<!-- <td><?=$sts_payment?></td> -->
					  <td align="right"><?=number_format($row->harga)?></td>
                     
					 	 <!-- <td align="right"><?=number_format($net)?></td> -->
					  
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
    $(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [[ 1, 'asc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
    });
  });
  function edit_spd(kd_prospek,id1,id2){
	$.get( "<?= base_url(); ?>index.php/order/edit_spd" , { 
		option :kd_prospek,
		option1 :id1,
		option2 :id2
		},
		function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
}
</script>