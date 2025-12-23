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
			  <button class="btn btn-warning btn-sm" onclick="return add_kategori_brg()">Tambah Kategori Barang <i class="fa fa-plus"></i>
			  </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%" align="center">Id</th>
					  <th width="50%" align="center">Kategori</th>
					  <th width="10%" align="center">Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i=0;
						if($list_kat_brg > 0){
							foreach($list_kat_brg as $row){
							$i++;
					?>
					<tr>
					  <td align='center'><?=$row->id?></td>
					  <td><?=$row->kategori?></td>
					  <td>
						<button class="btn btn-primary btn-sm" onclick="return edit_kategori_brg(<?=$row->id?>)">Edit <i class="fa fa-edit"></i></button>
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
              </table>
			  <div id="show_kategori_barang"></div>
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
  
  function edit_kategori_brg(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_kategori_barang" , { id :id } , function ( data ) {
		$( '#show_kategori_barang' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  
  function add_kategori_brg(){
	$.get( "<?= base_url(); ?>index.php/master/add_kategori_barang" , { option :"" } , function ( data ) {
		$( '#show_kategori_barang' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>