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
			  <button class="btn btn-warning btn-sm" onclick="return add_event()">Tambah Event <i class="fa fa-plus"></i>
			  </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%">Id</th>
					  <th>Nama Event</th>
					  <th>Lokasi</th>
					  <th>Tanggal</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_event > 0){
							foreach($list_event as $row){
							$i++;
					?>
					<tr>
					  <td><?=$row->id_event?></td>
					  <td><?=$row->nm_event?></td>
					  <td><?=$row->lokasi?></td>
					  <td><?=date('d-m-Y', strtotime($row->date_event))?></td>
					  <td>
						<button class="btn btn-primary btn-sm" onclick="return edit_event(<?=$row->id_event?>)">Edit <i class="fa fa-edit"></i></button>
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
              </table>
			  <div id="show_event"></div>
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
  
  function edit_event(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_event" , { id_event :id } , function ( data ) {
		$( '#show_event' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  
  function add_event(){
	$.get( "<?= base_url(); ?>index.php/master/add_event" , { option :"" } , function ( data ) {
		$( '#show_event' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>