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
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%">Id</th>
					  <th width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
					  <th>Alamat</th>
					  <th>Telpon</th>
					  <th>Email</th>
					  <!-- <th>Kecamatan</th> -->
					  <th>Kota</th>
					  <!-- <th>Provinsi</th> -->
					  <th>Nama Bank</th>
					  <th>Cab Bank</th>
					  <th>No. Rekening</th>
					  <th>Atas Nama</th>
					  <th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_data > 0){
							foreach($list_data as $row){
							$i++;
					?>
					<tr>
					  <td><?=$row->id?></td>
					  <td><?=$row->nama?></td>
					  <td><?=$row->alamat?></td>
					  <td><?=$row->no_telfon?></td>
					  <td><?=$row->email1?></td>
					  <!-- <td><?=$row->kecamatan?></td> -->
					  <td><?=$row->kota?></td>
					  <!-- <td><?=$row->provinsi?></td> -->
					  <td><?=$row->nm_bank?></td>
					  <td><?=$row->cab_bank?></td>
					  <td><?=$row->no_bank?></td>
					  <td><?=$row->an_bank?></td>
					  <td>
						<button class="btn btn-primary btn-sm" onclick="return edit_owner(<?=$row->id?>)">Edit <i class="fa fa-edit"></i></button>
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
  
  function edit_owner(id){
	$.get( "<?= base_url(); ?>index.php/master/edit_owner" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  
</script>