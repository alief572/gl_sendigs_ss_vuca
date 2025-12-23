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
			  <button class="btn btn-warning btn-sm" onclick="return add()">Tambah Supplier <i class="fa fa-plus"></i>
			  </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%">No</th>
					  <th>Nama Supplier</th>
					  <th>Alamat</th>
					  <th>PIC</th>
					  <th>Nama Perusahaan</center></th>
					  <th>Telpon</th>
					  <th>Email</th>
					  <th>Pelayanan</th>
					  <th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_supplier > 0){
							foreach($data_supplier as $row){
							$i++;
					?>
					<tr>
					  <td><?=$i?></td>
					  <td><?=$row->nm_supplier?></td>
					  <td><?=$row->alamat?></td>
					  <td><?=$row->pic?></td>
					  <td><?=$row->perusahaan?></td>
					  <td><?=$row->nomor_telfon?></td>
					  <td><?=$row->email?></td>
					  <td><?=$row->pelayanan?></td>
					  <td>
					  <div class="btn-group">
						<button class='btn btn-info btn-sm' onclick="return info(<?=$row->id?>)">Info</button>
						<button class='btn btn-primary btn-sm' onclick="return edit(<?=$row->id?>)">Edit</button>
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
	$.get( "<?= base_url(); ?>index.php/master/edit_supplier" , { option : id } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function add(){
	$.get( "<?= base_url(); ?>index.php/master/add_supplier" , { option :"" } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>