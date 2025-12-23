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
					  <th>Diajukan Oleh</th>
					  <th>Diajukan Tanggal</th>
					  <th>Jumlah Item</th>
					  <th>Status Approval</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_new > 0){
							$no=0;
							foreach($list_new as $row){
								$no++;
								$sts_app = $row->sts_app;

					?>
					<tr>
					  <td><?=$row->id_aju?></td>
					  <td><?=$row->insert_by?></td>
					  <td><?=date("d-F-Y",strtotime($row->tgl_aju))?></td>
					  <td><?=$row->jumlah?></td>
					  <td><?php if($row->sts_app == '1'){echo "Approved";}else if($row->sts_app == '2'){echo "Rejected";}else{echo "Waiting Approval";}?></td>
					  <td width="15%">
						<?php
						if($row->sts_app == '1'){
						?>
							<a href="<?=base_url()?>index.php/order/reject_req_new/<?=$row->id_aju?>" class="btn btn-warning" title="Reject"><i class="fa fa-edit"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request_new/<?=$row->id_aju?>" class="btn btn-default" title="View"  target="blank"><i class="fa fa-search"></i></a>
						<?php
						}elseif($row->sts_app == '2'){
						?>
							<a href="<?=base_url()?>index.php/order/approve_req_new/<?=$row->id_aju?>" class="btn btn-danger" title="Approve"><i class="fa fa-close"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request_new/<?=$row->id_aju?>" class="btn btn-default" title="View"  target="blank"><i class="fa fa-search"></i></a>
						<?php
						}else{
						?>
							<a href="<?=base_url()?>index.php/order/approve_req_new/<?=$row->id_aju?>" class="btn btn-info" title="Approve"><i class="fa fa-check-square"></i></a>
							<a href="<?=base_url()?>index.php/order/reject_req_new/<?=$row->id_aju?>" class="btn btn-warning" title="Reject"><i class="fa fa-remove"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request_new/<?=$row->id_aju?>" class="btn btn-default" title="View"  target="blank"><i class="fa fa-search"></i></a>
						<?php
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
	</section>
	<section class="content-header">
      <h1>
       Request Tambah Barang Stock
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
					  <th>Diajukan Oleh</th>
					  <th>Diajukan Tanggal</th>
					  <th>Jumlah Item</th>
					  <th>Status Approval</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_new2 > 0){
							$no=0;
							foreach($list_new2 as $row){
								$no++;
								$sts_app = $row->sts_app;

					?>
					<tr>
					  <td><?=$row->id_aju?></td>
					  <td><?=$row->insert_by?></td>
					  <td><?=date("d-F-Y",strtotime($row->tgl_aju))?></td>
					  <td><?=$row->jumlah?></td>
					  <td><?php if($row->sts_app == '1'){echo "Approved";}else if($row->sts_app == '2'){echo "Rejected";}else{echo "Waiting Approval";}?></td>
					  <td width="15%">
						<?php
						if($row->sts_app == '1'){
						?>
							<a href="<?=base_url()?>index.php/order/reject_req_tambah/<?=$row->id_aju?>" class="btn btn-warning" title="Reject"><i class="fa fa-edit"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request_tambah/<?=$row->id_aju?>" class="btn btn-default" title="View"  target="blank"><i class="fa fa-search"></i></a>
						<?php
						}elseif($row->sts_app == '2'){
						?>
							<a href="<?=base_url()?>index.php/order/approve_req_tambah/<?=$row->id_aju?>" class="btn btn-danger" title="Approve"><i class="fa fa-close"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request_tambah/<?=$row->id_aju?>" class="btn btn-default" title="View"  target="blank"><i class="fa fa-search"></i></a>
						<?php
						}else{
						?>
							<a href="<?=base_url()?>index.php/order/approve_req_tambah/<?=$row->id_aju?>" class="btn btn-info" title="Approve"><i class="fa fa-check-square"></i></a>
							<a href="<?=base_url()?>index.php/order/reject_req_tambah/<?=$row->id_aju?>" class="btn btn-warning" title="Reject"><i class="fa fa-remove"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request_tambah/<?=$row->id_aju?>" class="btn btn-default" title="View"  target="blank"><i class="fa fa-search"></i></a>
						<?php
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
	</section>
	<section class="content-header">
      <h1>
       Request Barang Pakai
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Request Barang Pakai</li>
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
					  <th>Id SPD</th>
					  <th>Diajukan Oleh</th>
					  <th>Diajukan Tanggal</th>
					  <th>Tanggal Resepsi</th>
					  <th>Tempat Resepsi</th>
					  <th>Sts Approval</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_use > 0){
							$no=0;
							foreach($list_use as $row){
								$no++;
								$id_penawaran = $row->id_penawaran;
								$id_penawaranx = $row->id_penawaran;
								$id_penawaran = str_replace('|','_',$id_penawaran);
								$tgl_resepsi = $this->order_model->get_tgl_resepsi($row->id_penawaran);
								if($tgl_resepsi > 0){
									foreach($tgl_resepsi as $rowss){
										$tgl_res = $rowss->tanggal_respsi;
										$tempat_res = $rowss->tempat1;
									}
								}else{
									$tgl_res = "";
									$tempat_res = "";
								}

					?>
					<tr>
					  <td><?=$id_penawaranx?></td>
					  <td><?=$row->aju_by?></td>
					  <td><?=date("d-F-Y",strtotime($row->aju_date))?></td>
					  <td><?=$tgl_res?></td>
					  <td><?=$tempat_res?></td>
					  <td><?php if($row->app == '1'){echo "Approved";}else if($row->app == '2'){echo "Rejected";}else{echo "Waiting Approval";}?></td>
					  <td width="15%">
						<?php
						if($row->app == '1'){
						?>
							<a href="<?=base_url()?>index.php/order/reject_req_use/<?=$id_penawaran?>" class="btn btn-warning" title="Reject"><i class="fa fa-edit"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request/<?=$id_penawaran?>" class="btn btn-default" title="View" target="blank"><i class="fa fa-search"></i></a>
						<?php
						}elseif($row->app == '2'){
						?>
							<a href="<?=base_url()?>index.php/order/approve_req_use/<?=$id_penawaran?>" class="btn btn-danger" title="Approve"><i class="fa fa-close"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request/<?=$id_penawaran?>" class="btn btn-default" title="View" target="blank"><i class="fa fa-search"></i></a>
						<?php
						}else{
						?>
							<a href="<?=base_url()?>index.php/order/approve_req_use/<?=$id_penawaran?>" class="btn btn-info" title="Approve"><i class="fa fa-check-square"></i></a>
							<a href="<?=base_url()?>index.php/order/reject_req_use/<?=$id_penawaran?>" class="btn btn-warning" title="Reject"><i class="fa fa-remove"></i></a>
							<a href="<?=base_url()?>index.php/order/print_request/<?=$id_penawaran?>" class="btn btn-default" title="View" target="blank"><i class="fa fa-search"></i></a>
						<?php
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