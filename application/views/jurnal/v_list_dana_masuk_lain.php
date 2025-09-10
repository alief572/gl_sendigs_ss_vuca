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
									<form action="<?=base_url()?>index.php/jurnal/filter_tgl_bum_lain" method="post">
										<div class="col-xs-3">
											<b>Tampilkan Berdasarkan Tanggal :</b>
										</div>
										<br><br>
										<div class="col-xs-2">
											Dari Tanggal :<input type="text" class="form-control" size='1' id="datepicker" format="yyyy-mm-dd" data-date-format="yyyy-mm-dd" name="tanggal" value="<?=date("Y-m-d")?>">
										</div>
										<div class="col-xs-2">
											Sampai Tanggal :<input type="text" class="form-control" size='1' id="datepicker2" format="yyyy-mm-dd" data-date-format="yyyy-mm-dd" name="tanggal2" value="<?=date("Y-m-d")?>">								
										</div>
										<br>
										<div class="col-xs-4">
											<input class="btn btn-success" type="submit" name="view" value="View List">
											<!--<input class="btn btn-success" type="submit" name="view" value="View List Excel" target="blank">-->
										</div>												
									</form>			

									<a href="<?=base_url()?>index.php/jurnal/dana_masuk_lain" class="btn btn-warning">Input Dana Masuk Lain-Lain</a>
								</div>	

			<div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No. BUM</th>
					  <th>Tanggal</th>				 
					  <th>Metode Bayar</th>
            <th>No. Reff</th>					 
            <th>Terima dari</th>
            <th>Note</th>
						<th>Jumlah (Rp.)</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
            $i=0;
              if($list_data > 0){
                $no=0;
                foreach($list_data as $row){
									$no++;
			
									$format_jumlah = number_format($row->jml,0,',','.');
									//$format_jumlah = "Rp. " . number_format($row->jml,0,',','.');

									$id_bum = $row->nomor;

									$id_bumx = str_replace("-","_",$id_bum);
									$tgl_bum = date("d-M-Y",strtotime($row->tgl));
									$tgl_bumx = str_replace("-","_",$tgl_bum);
					?>
					<tr>
					  <td><?=$row->nomor?></td>
					  <td><?=$tgl_bum?></td>
					  
            <td style='text-align:center'><?=$row->jenis_reff?></td>
            <td><?=$row->no_reff?></td>            
            <td><?=$row->terima_dari?></td>
            <td><?=$row->note?></td>	
						<td style='text-align:right'><?=$format_jumlah?></td>			
						<td>
									<?php
										echo '<a href="'.base_url().'index.php/jurnal/print_request_bum/'.$id_bumx.'/'.$tgl_bumx.'" title="Print"  target="blank" class="btn btn-info" width="20%" ><i class="fa fa-print"></i></a>';
									?>
									<!-- <a href="<?=base_url()?>index.php/jurnal/payment/<?=$row->invoice_no?>" class="btn btn-warning btn-sm" width="20%" title='Payment'><i class="fa fa-money"></i></a> -->
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
	<div id="show_stock"><div>
	</section>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>
<script src="<?=base_url();?>dist/jquery.min.js">
<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function () {
    $(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [[ 0, 'desc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		});
  });

</script>

<script>
$(function () {
	$('#datepicker').datepicker({
		dateFormat:'yyyy-mm-dd'
	});

	$('#datepicker2').datepicker({
		dateFormat:'yyyy-mm-dd'
	});
});
</script>