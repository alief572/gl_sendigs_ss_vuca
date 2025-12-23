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
			<a href="<?=base_url()?>index.php/komisi/input_bayar_sales" class="btn btn-warning">Bayar Karyawan</a><br>
			<div class="box-body">
			
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No.</th>
					  <th>ID Request</th>
					  <th>Nama Karyawan</th>
					  <th>Jenis Bayar</th>
					  <th>Keterangan</th>
					  <th>Tanggal Bayar</th>
					  <th>Bayar Oleh</th>
					  <th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_komisi > 0){
							foreach($list_komisi as $row){
							$i++;
					?>
					<tr>
					  <td><?=$i?></td>
					  <td><?=$row->id_req?></td>
					  <td><?=$row->nama?></td>
					  <td><?=$row->jenis?></td>
					  <td><?=$row->keterangan?></td>
					  <td><?=date("d-M-Y",strtotime($row->bayar_date))?></td>
					  <td><?=$row->bayar_oleh?></td>
					  <td align="right"><?=number_format($row->bayar)?></td>
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