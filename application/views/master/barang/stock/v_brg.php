<?php $this->load->view('header');?>
    <section class="content-header">
      <h1>
       
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
					  
					  <!-- <td><?=$row->sts?></td> -->

					  
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
	
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function () {
    $(".example1").DataTable();
  });
  
</script>