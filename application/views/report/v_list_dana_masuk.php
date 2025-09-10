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

		  <a href="<?=base_url()?>index.php/jurnal/dana_masuk" class="btn btn-warning">Input Bukti Uang Masuk (BUM)</a><br><br>
      
			<div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No. BUM</th>
					  <th>Tanggal</th>
					  <th>Jumlah</th>
					  <th>Kode Cabang</th>
					  <th>Metode Pembayaran</th>
            <th>No. Reff</th>					 
            <th>Terima dari</th>
            <th>Note</th>
					</tr>
				</thead>
				<tbody>
					<?php
            $i=0;
              if($list_data > 0){
                $no=0;
                foreach($list_data as $row){
									$no++;
			
									$format_jumlah = "Rp. " . number_format($row->jml,0,',','.');
					?>
					<tr>
					  <td><?=$row->nomor?></td>
					  <td><?=date("d-M-Y",strtotime($row->tgl))?></td>
					  <td><?=$format_jumlah?></td>
					  <td><?=$row->kdcab?></td>
            <td><?=$row->jenis_reff?></td>
            <td><?=$row->no_reff?></td>            
            <td><?=$row->terima_dari?></td>
            <td><?=$row->note?></td>					 
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
	<div id="show_stock"><div>
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
/*
  function edit_spd(kd_prospek,id1,id2){
	$.get( "<?= base_url(); ?>index.php/order/edit_spd" , { 
		option :kd_prospek,
		option1 :id1,
		option2 :id2
		},
		function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
}
*/
</script>
