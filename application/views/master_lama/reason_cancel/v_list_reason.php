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
			  <button class="btn btn-warning btn-sm" onclick="return add_reason()">Tambah Alasan <i class="fa fa-plus"></i>
			  </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%">Id</th>
					  <th width="50%">Alasan</th>
					  <th>Status</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i=0;
						if($list_reason > 0){
							foreach($list_reason as $row){
							$i++;
					?>
					<tr>
					  <td align='center'><?=$i?>.</td>
					  <td><?=$row->alasan?></td>
					  <td>
					  <?= (!empty($row->sts)) ? "<span class='label label-success'>AKTIF</span>" : "<span class='label label-success'>NON AKTIF</span>";?>
					  </td>
					  <td>
						<button class="btn btn-primary btn-sm" onclick="return edit_reason(<?=$row->id?>)">Edit <i class="fa fa-edit"></i></button>
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
              </table>
			  <div id="show_reason"></div>
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
  
  function edit_reason(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_reason_cancel" , { id :id } , function ( data ) {
		$( '#show_reason' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  
  function add_reason(){
	$.get( "<?= base_url(); ?>index.php/master/add_reason_cancel" , { option :"" } , function ( data ) {
		$( '#show_reason' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>