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
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No.</th>
					  <th>ID Request</th>
					  <th>ID Vendor</th>
					  <th>Nama Vendor</th>
					  <th>Jenis Vendor</th>
					  <th>Jumlah</th>
					  <th>Total</th>
					  <th>Tanggal Pemakaian</th>
					  <th>Total Bayar</th>
					  <th>Sisa Bayar</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_komisi > 0){
							foreach($list_komisi as $row){
							$i++;
							$tot_bayar = $this->komisi_model->get_bayar($row->id);
							$sisa = $row->komisi - $tot_bayar;
					?>
					<tr>
					  <td><?=$i?></td>
					  <td><?=$row->id?></td>
					  <td><?=$row->id_vendor?></td>
					  <td><?=$row->nm_vendor?></td>
					  <td><?=$row->jenis?></td>
					  <td align="right"><?=number_format($row->jumlah)?></td>
					  <td align="right"><?=number_format($row->komisi)?></td>
					  <td><?=date("d-M-Y",strtotime($row->tgl_awal))." s/d ".date("d-M-Y",strtotime($row->tgl_akhir))?></td>
					  <td  align="right"><?=number_format($tot_bayar)?></td>
					  <td  align="right"><?=number_format($sisa)?></td>
					  <td>
					  <?php
					  if($row->komisi > $tot_bayar){
					  ?>
					  <a href="<?=base_url()?>index.php/komisi/edit_bayar/<?=str_replace("|","_",$row->id)?>" class='btn btn-primary btn-sm' title="Update Pembayaran" onclick="return edit_stock(<?=$row->id?>)">
					  <i class="fa fa-edit"></i>
					  </a>
					  <?php }?>
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