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

			 <!--<a href="<?=base_url()?>index.php/order/input" class="btn btn-warning" >Tambah Prospek <i class="fa fa-plus"></i></a>

            </div>-->

            <!-- /.box-header -->

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

								$pria_wanita = $row->pengantin_pria.' & '.$row->pengantin_wanita;

								$piutang = $this->master_model->get_customer2($id);

								

								$id_penawaran = $row->id_penawaran;

								$id_penawarana = $row->id_penawaran;

								$id_penawaranx = str_replace("|","_",$id_penawaran);

								$id_penawaran = explode("|",$id_penawaran);

								$id_penawaran1 = substr($id_penawaran[0],1,4);

								$id_penawaran2 = $id_penawaran[1] + 0;

					?>

					<tr>

					  <td><?=$no?></td>

					  <td><?=$id?></td>

					  <td><?=$id_penawarana?></td>

					  <td><?=date("d-M-Y",strtotime($row->input_date))?></td>

					  <td><?=$pria_wanita?></td>

					  <td><?=date("d-M-Y",strtotime($resepsi_date))?></td>

					  <td><?=$resepsi_jam?></td>

					  <td><?=$tempat?></td>

					  <td></td>

					  <td width="15%">

					  

					  <a href="<?=base_url()?>index.php/order/edit_request/<?=$id_penawaranx?>" title="Input Request" class="btn btn-primary" width="20%" ><i class="fa fa-edit"></i></a>

					  

					  <a href="<?=base_url()?>index.php/order/print_request/<?=$id_penawaranx?>" title="Print Semua Item" target="blank" class="btn btn-info" width="20%" ><i class="fa fa-print"></i></a>

					  

					  <button title="Waiting Approval" target="blank" class="btn btn-success" width="20%" ><i class="fa fa-remove"></i></button>

					  

					  <a href="<?=base_url()?>index.php/order/print_request/<?=$id_penawaranx?>" title="Input Stok Keluar" target="blank" class="btn btn-warning" width="20%" ><i class="fa fa-share-square-o"></i></a>

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