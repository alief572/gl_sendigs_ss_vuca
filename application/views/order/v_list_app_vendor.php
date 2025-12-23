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
					  <th>ID Request</th>
					  <th>Nama Vendor</th>
					  <th>Jenis Vendor</th>
					  <th>Tanggal Request</th>
					  <th>Diajukan Oleh</th>
					  <th>Jumlah</th>
					  <th>Harga</th>
					  <th>Tanggal Awal</th>
					  <th>Tanggal Awal</th>
					  <th>Status</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_prospek > 0){
							$no=0;
							foreach($data_prospek as $row){
								$no++;
								$idx = $row->id;
								$idx = str_replace("|","_",$idx);
					?>
					<tr>
					  <td><?=$no?></td>
					  <td><?=$row->id?></td>
					  <td><?=$row->nm_vendor?></td>
					  <td><?=$row->jenis?></td>
					  <td><?=date("d M Y",strtotime($row->insert_date))?></td>
					  <td><?=$row->insert_by?></td>
					  <td align="right"><?=number_format($row->jumlah)?></td>
					  <td align="right"><?=number_format($row->komisi)?></td>
					  <td><?=date("d M Y",strtotime($row->tgl_awal))." ".$row->jam_awal?></td>
					  <td><?=date("d M Y",strtotime($row->tgl_akhir))." ".$row->jam_akhir?></td>
					  <td><?php if($row->sts=='1'){echo "Approved";}elseif($row->sts=='2'){echo "Rejeced";}else{echo "Waiting Approval";}?></td>
					  <td width="15%">
					  <?php
					  if($row->sts == '2'){
					  ?>
						<a href="<?=base_url()?>index.php/order/app_vendor2/<?=$idx?>" title="Approve Request" class="btn btn-danger" width="20%" onclick="return confirm_app()"><i class="fa fa-close"></i></a>
					  <?php
					  }else if($row->sts == '1'){
					  ?>
						<a href="<?=base_url()?>index.php/order/rjk_vendor/<?=$idx?>" title="Reject Request" class="btn btn-warning" width="20%" onclick="return confirm_rjk()"><i class="fa fa-edit"></i></a>
					  <?php
					  }else{
					  ?>
						<a href="<?=base_url()?>index.php/order/app_vendor2/<?=$idx?>" title="Approve Request" class="btn btn-info" width="20%" onclick="return confirm_app()"><i class="fa fa-check"></i></a>
						<a href="<?=base_url()?>index.php/order/rjk_vendor/<?=$idx?>" title="Reject Request" class="btn btn-warning" width="20%" onclick="return confirm_rjk()"><i class="fa fa-close"></i></a>
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