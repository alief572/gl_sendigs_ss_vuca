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
			  <a href="<?=base_url()?>index.php/master/create_paket" class="btn btn-warning btn-sm" >Tambah Paket <i class="fa fa-plus"></i>
			  </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%">Id Paket</th>
					  <th>Nama Paket</th>
					  <th>Nama Gedung</th>
					  <th>Harga Paket</th>
					  <th>Note</th>
					  <th>Status</th>
					  <th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_paket > 0){
							foreach($list_paket as $row){
							$i++;
					?>
					<tr>
					  <td><?=$row->id_paket?></td>
					  <td><?=$row->nm_paket?></td>
					  <td><?=$row->nm_gedung?></td>
					  <td><?=number_format($row->harga)?></td>
					  <td><?=$row->note?></td>
					  <td><?php if($row->sts == 1){echo "Aktif";}else{echo "Non-Aktif";} ?></td>
					  <td>
					  <?php 
							$id_paket = str_replace("|","_",$row->id_paket);
						?>
					  <div class="btn-group">
						<a class='btn btn-primary btn-sm' href="<?=base_url()?>index.php/master/edit_paket/<?=$id_paket?>"><i class="fa fa-edit"></i> Edit</a>
					  </div>
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
              </table>
			  <div id="show_supp"></div>
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
  function info_kategori(id,id2){
	$.get( "<?= base_url(); ?>index.php/master/detail_kategori" , { option :id,option2 : id2 } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit_kategori(id,id2){
	$.get( "<?= base_url(); ?>index.php/master/edit_kategori" , { option :id,option2 : id2} , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function add_kategori(){
	$.get( "<?= base_url(); ?>index.php/master/add_kategori" , { option :"" } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function info_paket(id,id2){
	$.get( "<?= base_url(); ?>index.php/master/detail_paket" , { option :id,option2 : id2 } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit_paket(id,id2){
	$.get( "<?= base_url(); ?>index.php/master/edit_paket" , { option : id,option2 : id2 } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function add_paket(){
	$.get( "<?= base_url(); ?>index.php/master/add_paket" , { option :"" } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>