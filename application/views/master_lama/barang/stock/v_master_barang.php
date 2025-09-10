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
        <div class="col-xs-13">
          <div class="box">
            <div class="box-header">
			<div class="box-body">
			  <button class="btn btn-warning btn-sm" onclick="return add_stock()">Tambah Barang <i class="fa fa-plus"></i>
			  </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th rowspan='2'>No</th>
					  <th rowspan='2'>Barang</th>
  					  <th rowspan='2'>Kategori</th>
					
					  <th rowspan='2'>Merek</th>
					  <th colspan='3'><center>Kondisi</center></th>
					  <th rowspan='2'>Stock</th>
					  <th rowspan='2'>Supplier</th>
					  <th rowspan='2'>Harga Satuan</th>
					  <th rowspan='2'>Gambar</th>
					  <th rowspan='2'>Edit</th>
					</tr>
					<tr>
						<td>Bagus</td>
						<td>Sedang</td>
						<td>Jelek</td>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_stock > 0){
							foreach($data_stock as $row){
							$i++;
					?>
					<tr>
					  <td><?=$i?></td>
					  <td><?=$row->nm_barang?></td>
			    	  <td><?=$row->kategori?></td>
				
					  <td><?=$row->produk_asal?></td>
					  <td><?=$row->bagus?></td>
					  <td><?=$row->sedang?></td>
					  <td><?=$row->jelek?></td>
					  <td><?=$row->stock?></td>
					  <td><?=$row->nm_supplier?></td>
					  <td><?=number_format($row->harga)?></td>
					  <!-- <td><?=$row->sts?></td> -->

					  <td><img src="<?=base_url()?>gambar_barang/<?=$row->id?>.jpg" width="100px"></td>
					  <td>
					  <button class='btn btn-primary btn-sm' onclick="return edit_stock(<?=$row->id?>)">
					  Edit <i class="fa fa-edit"></i>
					  </button>
					  <?php 
					  if($row->stock == '0'){
					  ?>
					  <a href="<?=base_url()?>index.php/master/delete_stock_barang/<?=$row->id?>" onclick="return validasi_hapus()" class='btn btn-danger btn-sm'>
					  Hapus <i class="fa fa-eraser"></i>
					  </a>
					  <?php } ?>
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
       Daftar Barang Non-Stock
      </h1>
    </section>
	<section class="content-header">
    	<div class="row">
        	<div class="col-xs-12">
          		<div class="box">
            		<div class="box-header">
						<div class="box-body">
			  				<button class="btn btn-warning btn-sm" onclick="return add_nonstock()">Tambah Barang <i class="fa fa-plus"></i></button>
            			</div>
            <!-- /.box-header -->
            			<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr>
									<th>No</th>
									<th>Barang</th>
									<th>Kategori</th>			  
									<th>Cabang</th>
									<th>Merek</th>
									<th>Supplier</th>
									<th>Harga Satuan</th>
									<th>Status</th>
									<th>Gambar</th>
									<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i=0;
										if($data_nonstock > 0){
											foreach($data_nonstock as $row){
											$i++;
									?>
									<tr>
									<td><?=$i?></td>
									<td><?=$row->nm_barang?></td>
									<td><?=$row->kategori?></td>
									
									<td><?=$row->id_cabang?></td>
									<td><?=$row->produk_asal?></td>
									<td><?=$row->nm_supplier?></td>
									<td><?=number_format($row->harga)?></td>
									<td><?=$row->sts?></td>
									<td><img src="<?=base_url()?>gambar_barang/<?=$row->id?>.jpg" width="100px"></td>
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
  function add_stock(){
	$.get( "<?= base_url(); ?>index.php/master/add_stock" , { option :"" } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit_stock(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_stock" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  
  function validasi_hapus(){
	  var dd = confirm("hapus barang ?");
	  if(dd == false){
		  return false;
	  }
  }
  function add_nonstock(){
	$.get( "<?= base_url(); ?>index.php/master/add_nonstock" , { option :"" } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit_nonstock(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_nonstock" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>