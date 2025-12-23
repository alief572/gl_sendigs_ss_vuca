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
					  <th>ID Penawaran</th>
					  <th>Nama Pengantin</th>
					  <th>Tanggal Resepsi</th>
					  <th>Tempat Resepsi</th>
					  <th>Harga Total</th>
					  <th>Permintaan Diskon</th>
					  <th>Total Permintaan</th>
					  <th>Status</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_penawaran > 0){
							$no=0;
							foreach($data_penawaran as $row){
								$no++;
					?>
					<tr>
					  <td><?=$no?></td>
					  <td><?=$row->id_prospek?></td>
					  <td><?=$row->id_penawaran?></td>
					  <td><?=$row->pengantin_pria." & ".$row->pengantin_wanita?></td>
					  <td><?=date("d M Y",strtotime($row->tanggal_respsi))." ".$row->jam_resepsi?></td>
					  <td><?=$row->tempat1?></td>
					  <td align="right"><?=number_format($qq = $row->harga_paket+$row->tambahan_paket)?></td>
					  <td align="right"><?=$row->discount?></td>
					  <td align="right"><?=number_format($row->harga)?></td>
					  <td><?php if($row->app_diskon=='1'){echo "Approved";}elseif($row->app_diskon=='2'){echo "Rejeced";}else{echo "Waiting Approval";}?></td>
					  <td width="15%">
					  <?php
					  if($row->app_diskon == '2'){
					  ?>
						<a href="<?=base_url()?>index.php/order/app_disk/<?=str_replace("|","_",$row->id_penawaran)?>" title="Approve Request" class="btn btn-danger" width="20%" onclick="return confirm_app()"><i class="fa fa-close"></i></a>
					  <?php
					  }else if($row->app_diskon == '1'){
					  ?>
						<a href="<?=base_url()?>index.php/order/rjk_disk/<?=str_replace("|","_",$row->id_penawaran)?>" title="Reject Request" class="btn btn-warning" width="20%" onclick="return confirm_rjk()"><i class="fa fa-edit"></i></a>
					  <?php
					  }else{
					  ?>
						<a href="<?=base_url()?>index.php/order/app_disk/<?=str_replace("|","_",$row->id_penawaran)?>" title="Approve Request" class="btn btn-info" width="20%" onclick="return confirm_app()"><i class="fa fa-check"></i></a>
						<a href="<?=base_url()?>index.php/order/rjk_disk/<?=str_replace("|","_",$row->id_penawaran)?>" title="Reject Request" class="btn btn-warning" width="20%" onclick="return confirm_rjk()"><i class="fa fa-close"></i></a>
					  <?php
					  }
					  ?>
					  <a href="<?=base_url()?>index.php/order/print_penawaran/<?=str_replace("|","_",$row->id_penawaran)?>" target="blank" class="btn btn-default"><i class="fa fa-print"></i>
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
	function confirm_app(){
		var aa = confirm("Approve Request ?");
		if(aa == false){
			return false;
		}
	}
	function confirm_rjk(){
		var aa = confirm("Reject Request ?");
		if(aa == false){
			return false;
		}
	}
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