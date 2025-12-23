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
			<form action="<?=base_url()?>index.php/order/daftar_deal" method="post">
				<div class="col-xs-2">
					
				</div>
              	<div class="col-xs-2"> 
					
				</div>
			</form>
			</div>
			<div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <!-- <th>No.</th> -->
					
					  <!-- <th>Marketing</th> -->
					  <th>No.SPD</th>
					  <th>Nama Pengantin</th>
					  <th>Nomor Customer</th>
					  <th>No Invoice</th>
					  <th>Alamat</th>
            <th>Due Date</th>
					 <!-- <th>Payment Status</th> -->
					  
					</tr>
				</thead>
				<tbody>
                <?php
					
						if ($tempo > 0){
							foreach($tempo as $row){ 
							  $resepsi_date=$row->tanggal_resepsi; 
								$pria_wanita = $row->pengantin_pria.' & '.$row->pengantin_wanita;       
					?>

					<tr>
					     <td><?=$row->id_penawaran?></td>
               <td><?=$pria_wanita?></td>
							 <td><?=$row->no_cust?></td>
							 <td><?=$row->nomor_invoice?></td>
							 <td><?=$row->tempat1?></td>
							 <td><?=$row->due_date?></td>
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
    $(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [[ 1, 'asc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
    });
  });
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
</script>