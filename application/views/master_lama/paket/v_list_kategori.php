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
			  <button class="btn btn-warning btn-sm" onclick="return add_nonstock()">Tambah Kategori <i class="fa fa-plus"></i>
			  </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%">Id</th>
					  <th>Kategori</th>
					  <th>Harga</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_Kategori > 0){
							foreach($list_Kategori as $row){
							$i++;
					?>
					<tr>
					  <td><?=$row->id?></td>
					  <td><?=$row->nm_keterangan?></td>
					  <td><?=$row->jumlah?></td>
					  <td>
						<button class="btn btn-primary btn-sm" onclick="return edit_nonstock(<?=$row->id?>)">Edit <i class="fa fa-edit"></i></button>
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
              </table>
			  <div id="show_stock"></div>
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
  
  function edit_nonstock(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_kategori_paket" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  
  function add_nonstock(){
	$.get( "<?= base_url(); ?>index.php/master/add_kategori_paket" , { option :"" } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>