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
			  <button class="btn btn-warning btn-sm" onclick="return tambah_vendor()">Tambah Vendor <i class="fa fa-plus"></i>
			  </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width="5%">No</th>
					  <th>ID Vendor</th>
					  <th>Nama Vendor</th>
					  <th>Jenis Vendor</th>
					  <th>Alamat</th>
					  <th>Telpon</th>
					  <th>Email</center></th>
					  <th>PIC</th>
					  <th>Keterangan</th>
					  <th>sts</th>
					  <th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_vendor > 0){
							foreach($data_vendor as $row){
							$i++;
							$id	= explode("|",$row->id);
							$id1	= substr($id[0],0,4) +0;
							$id2	= $id[1] +0;
							
					?>
					<tr>
					  <td><?=$i++?></td>
					  <td><?=$row->id?></td>
					  <td><?=$row->nm_vendor?></td>
					  <td><?=$row->jenis_vendor?></td>
					  <td><?=$row->alamat?></td>
					  <td><?=$row->telp1?></td>
					  <td><?=$row->email1?></td>
					  <td><?=$row->pic?></td>
					  <td><?=$row->keterangan?></td>
					  <td><?=$row->sts?></td>
					  <td>
					  <div class="btn-group">
						<button onclick="return edit(<?=$id1?>,<?=$id2?>)" class='btn btn-info btn-sm'>Edit</button>
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
  function edit(id1,id2){
	$.get( "<?= base_url(); ?>index.php/master/edit_vendor" , { option1 : id1, option2 : id2} , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function tambah_vendor(){
	$.get( "<?= base_url(); ?>index.php/master/tambah_vendor" , { option :"" } , function ( data ) {
		$( '#show_supp' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
</script>