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
			  <a href="<?=base_url()?>index.php/setup/add_user" class="btn btn-warning btn-sm">Tambah Karyawan <i class="fa fa-plus"></i>
			 <!--  <a href="<?=base_url()?>index.php/master/add_salesman" class="btn btn-warning btn-sm">Tambah Karyawan <i class="fa fa-plus"></i> -->
			  </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No Karyawan</th>
					  <th>Nama Karyawan</th>
					  <th>Jabatan</th>
					  <th>Marketing</th>
					  <th>Alamat</th>
					  <th>No HP</th>
					  <th>Tanggal Masuk</center></th>
					  <th>Pengalaman</th>
					  <th>Sts</th>
					  <th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_salesman > 0){
							foreach($data_salesman as $row){
							$i++;
					?>
					<tr>
					  <td><?=$row->nosales?></td>
					  <td><?=$row->nama?></td>
					  <td><?=$jab = $this->menu_model->get_jabatan2($row->kategori)?></td>
					  <td align="center"><?php $mark = $this->menu_model->get_mark($row->nosales);
					  if($mark == "Y"){
						  echo "Yes";
					  }else if($mark == "N"){
						  echo "No";
					  }else{
						  echo "No";
					  }
					  ?></td>
					  <td><?=$row->alamat?></td>
					  <td><?=$row->nohp?></td>
					  <td><?=$row->tgl_masuk?></td>
					  <td><?=$row->pengalaman?></td>
					  <td><?=$row->status?></td>
					  <td>
					  <div class="btn-group">
						<a class='btn btn-primary btn-sm' href="<?=base_url()?>index.php/master/edit_sales/<?=$row->nosales?>">Edit Profile</a>
						<a href="<?=base_url().'index.php/setup/edit_profile/'.$row->nosales;?>" class='btn btn-warning btn-sm'>Edit Akses <i class="fa fa-edit"></i></a>
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
  function info(id){
	$.get( "<?= base_url(); ?>index.php/master/detail_supplier" , { option : id } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_salesman" , { option : id } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function add_cus(){
	$.get( "<?= base_url(); ?>index.php/master/add_customer" , { option :"" } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>