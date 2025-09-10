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
					  <th>No. SPJ</th>
					  <th>No. SPD</th>
					  <th>Pengantin</th>
					  <th>Tanggal SPJ</th>
					  <th>Create By</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_spj > 0){
							$no=0;
							foreach($list_spj as $row){
								$no++;
								$pengantin = $this->order_model->get_pengantin($row->id_penawaran);
					?>
					<tr>
					  <td><?=$no?></td>
					  <td><?=$row->no_spj?></td>
					  <td><?=$row->id_penawaran?></td>
					  <td><?=$pengantin?></td>
					  <td><?=$row->out_date?></td>
					  <td><?=$row->out_by?></td>
					  <td width="15%">
						<a href='<?=base_url()?>index.php/order/print_spj_out/<?=$row->no_spj;?>/<?=str_replace("|","_",$row->id_penawaran)?>' title='Print Semua Item' target='blank' class='btn btn-info' width='20%' ><i class='fa fa-print'></i></a>
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