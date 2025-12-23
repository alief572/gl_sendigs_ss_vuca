<?php $this->load->view('header');


  if(empty($tanggal2)) 
     $tanggal2=date("Y-m-d");

?>

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

			<form action="<?=base_url()?>index.php/order/checklist_gabungan" method="post">

				<div>
					<input type="text" name="tanggal" id="datepicker" format="dd-mm-yyyy" data-date-format="yyyy-mm-dd" value="<?=$tanggal?>" >
		    		<input type="text" name="tanggal2" id="datepicker2" format="dd-mm-yyyy" data-date-format="yyyy-mm-dd" value="<?=$tanggal2?>" >
		    
    
					<input class="btn btn-success" type="submit" name="view" value="View List">

					<input class="btn btn-success" type="submit" name="view" value="View List Excel" target="blank">

				</div>

			</form>

			<div style="padding-top: 10px"><b>Tanggal Resepsi : <?=date('d-M-Y', strtotime($tanggal))?></b></div>
	
			</div>

			<div class="box-body">

            <div class="box-body table-responsive no-padding">

              <table class="table table-bordered table-hover dataTable example1">

				<thead>

					<tr>

					  <th>No.</th>

					  
					  <th>Kategori</th>
                      <th>Barang</th>
 
						
					<?php
						$num_temp	= 0;
						if($list_tempat > 0){
							$arr_tempat	= array();
							foreach($list_tempat as $row_temp){
								$num_temp++;
								if (!empty($row_temp->tempat)) {
									$arr_tempat[]	= $row_temp->tempat;
									echo "<th>".$row_temp->tempat."</th>";
								} else {
									$arr_tempat[]	= "";
									echo "<th>Tempat Belum Ditentukan</th>";
								}
							}
						}

					?>
						<th><i>Total</i></th>
						<th><i>Total Stock di gudang</i></th>
						<th><i>Stock Tersisa</i></th>

					</tr>

				</thead>

				<tbody>

					<?php
						$no = 0;
						if($list_barang > 0){

							$arr_barang		= array();
							$arr_tempatx	= array();
							foreach($list_barang as $row_b){
								$jum_barang = $ttl_barang = $stock_akhir = 0;
								if (!in_array($row_b->id, $arr_barang)) {
									$arr_barang[]	= $row_b->id;

									$no++;

									echo "<tr>";

									echo "<td>".$no."</td>";
									echo "<td>".$row_b->kategori."</td>";
									
									echo "<td>".$row_b->nm_barang."</td>";
									//echo "<td>".$row_b->area."</td>";

									$stock 		= $row_b->stock;
									if ($num_temp > 0) {
										for ($i=0; $i<$num_temp; $i++) {
											//if ($arr_tempat[$i] == $row_b->tempat1) {
												$jum_barang	= $this->order_model->sum_checklist_barang($arr_tempat[$i], $row_b->id, $tanggal, $tanggal2);
												if (empty($jum_barang)) {
													echo "<td>0</td>";
												} else {
													echo "<td>".$jum_barang."</td>";
												}
												$ttl_barang	+= $jum_barang;
											//} else {
											//	echo "<td>0</td>";
											//}
										}
									}
									
									$stock_akhir	= $stock-$ttl_barang;

									echo "<td>".$ttl_barang."</td>";
									echo "<td>".$stock."</td>";
									echo "<td>".$stock_akhir."</td>";
									echo "</tr>";
								}
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

<script type="text/javascript" src="<?=base_url()?>dist/moment.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>dist/bootstrap.css" />

<script type="text/javascript" src="<?=base_url()?>dist/daterangepicker.js"></script>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>dist/daterangepicker.css" />

<!-- SlimScroll -->
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>

<script>

  $(function () {

    $(".example1").DataTable();

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

<script type="text/javascript">

$(function() {

	/*$('input[name="daterange"]').daterangepicker({
		locale: {
		  format: 'DD-MM-YYYY'
		}
	})*/


	$('#datepicker').datepicker({
		dateFormat:'yy-mm-dd'
	});

	$('#datepicker2').datepicker({
		dateFormat:'yy-mm-dd'
	});


});



</script>