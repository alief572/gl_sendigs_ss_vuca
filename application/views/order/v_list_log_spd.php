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

			<?php

			if($jenis == "vendor"){

				?>

				<form action="<?=base_url()?>index.php/order/request_vendor" method="post">

			<?php

			}else{

				?>

				<form action="<?=base_url()?>index.php/order/request_use" method="post">

			<?php

			}

			?>

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

					  <th>No.</th>

					  <th>ID Prospek</th>

					  <th>No. SPD</th>

					  <th>Tanggal SPD</th>

					  <th>Calon Pengantin</th>

					  <th>Tanggal Resepsi</th>

					  <th>Jam Resepsi</th>

					  <th>Tempat Resepsi</th>

					  <th>Approve</th>

					  <th>Option</th>

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

								$data_prospek = $this->order_model->get_prospek($id);

								if($data_prospek > 0){

									foreach($data_prospek as $row2){

										$resepsi_date = $row2->resepsi_date;

										$resepsi_jam = $row2->resepsi_jam;

										$tempat			= $row2->tempat1." ".$row2->tempat2." ".$row2->tempat3;

									}

								}
								$nganten_pria=str_replace(' ','_',$row->pengantin_pria);
								$nganten_wanita=str_replace(' ','_',$row->pengantin_wanita);
								$pria_wanita = $row->pengantin_pria.' & '.$row->pengantin_wanita;
								$pria_wanita2 = $nganten_pria.'%'.$nganten_wanita;

								$piutang = $this->master_model->get_customer2($id);
								$tgl_spd_=date("d-M-Y",strtotime($row->input_date));
								
								$tgl_spd=str_replace('-','_',$tgl_spd_);
								

								$id_penawaran = $row->id_penawaran;

								$id_penawarana = $row->id_penawaran;

								$id_penawaranx = str_replace("|","_",$id_penawaran);

								$id_penawaran = explode("|",$id_penawaran);

								$id_penawaran1 = substr($id_penawaran[0],1,4);

								$id_penawaran2 = $id_penawaran[1] + 0;

								$app = $this->order_model->get_app($id_penawarana);

								if($app == "1"){

									$note = "Approve";

								}else if($app == "2"){

									$note = "Rejected";

								}else if($app == "3"){

									$note = "Not Created Yet";

								}else{

									$note = "Waiting Approval";

								}

					?>

					<tr>

					  <td><?=$no?></td>

					  <td><?=$id?></td>

					  <td><?=$id_penawarana?></td>

					  <td><?=date("d-M-Y",strtotime($row->input_date))?></td>

					  <td><?=$pria_wanita?></td>

					  <td><?=date("d-M-Y",strtotime($resepsi_date))?></td>

					  <td><?=$resepsi_jam?></td>

					  <td><?=$row->temp?></td>

					  <td><?=$note?></td>

					  <td width="15%">

					  <?php

					  if($jenis == "vendor"){

						  if($row->vendor == '2'){

							   echo '<a href="'.base_url().'index.php/order/input_payment/'.$id.'" title="Input Pembayaran" class="btn btn-success" width="20%" ><i class="fa fa-money"></i></a>';

						  }else if($row->vendor == '1'){

							  echo '<a href="'.base_url().'index.php/order/edit_request_vendor/'.$id.'" title="Edit Request" class="btn btn-info" width="20%" ><i class="fa fa-edit"></i></a>';

						  }else{

							  echo '<a href="'.base_url().'index.php/order/input_request_vendor/'.$id.'" title="Input Vendor"  class="btn btn-primary" width="20%" ><i class="fa fa-calendar-o"></i></a>';

							 

						  }

					  }else{

							if($app == "1"){
								

									echo '<a href="'.base_url().'index.php/order/log_edit_req_use/'.$id_penawaranx.'/'.$id.'/'.$tgl_spd.'/'.$pria_wanita2.'" title="View Log"  class="btn btn-success" width="20%" ><i class="fa fa-edit"></i></a>&nbsp;';

								echo '<a href="'.base_url().'index.php/order/print_request/'.$id_penawaranx.'" title="Print Semua Item"  target="blank" class="btn btn-info" width="20%" ><i class="fa fa-print"></i></a>';

								//echo '<a href="'.base_url().'index.php/order/input_use_out/'.$id_penawaranx.'" title="Input Stok Keluar"  class="btn btn-warning" width="20%" ><i class="fa fa-share-square-o"></i></a>';

							//	echo "<a href='".base_url()."index.php/order/input_use_in/".$id_penawaranx."' title='Input Stock masuk'  class='btn btn-primary' width='20%' ><i class='fa fa-download'></i></a>";

							}else if($app == "2"){
								
								echo '<button title="Rejected" class="btn btn-danger" width="20%" ><i class="fa fa-remove"></i></button>';

								echo '<a href="'.base_url().'index.php/order/log_edit_req_use/'.$id_penawaranx.'/'.$id.'/'.$tgl_spd.'/'.$pria_wanita2.'" title="View Log"  class="btn btn-success" width="20%" ><i class="fa fa-edit"></i></a>&nbsp;';

							}else{
								
								if($app == "3"){

									echo '<a href="'.base_url().'index.php/order/edit_request/'.$id_penawaranx.'" title="Input Request" class="btn btn-primary" width="20%" ><i class="fa fa-check-square"></i></a>';

								}else{
									
									echo '<a href="'.base_url().'index.php/order/log_edit_req_use/'.$id_penawaranx.'/'.$id.'/'.$tgl_spd.'/'.$pria_wanita2.'" title="View Log"  class="btn btn-success" width="20%" ><i class="fa fa-edit"></i></a>&nbsp;';

									echo '<a href="'.base_url().'index.php/order/print_request/'.$id_penawaranx.'" title="Print Semua Item"  target="blank" class="btn btn-info" width="20%" ><i class="fa fa-print"></i></a>';

								//echo '<a href="'.base_url().'index.php/order/input_use_out/'.$id_penawaranx.'" title="Input Stok Keluar"  class="btn btn-warning" width="20%" ><i class="fa fa-share-square-o"></i></a>';

								//echo "<a href='".base_url()."index.php/order/input_use_in/".$id_penawaranx."' title='Input Stock masuk'  class='btn btn-primary' width='20%' ><i class='fa fa-download'></i></a>";

								}

							}

					  }

						?>

					  </td>

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

    $(".example1").DataTable();

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