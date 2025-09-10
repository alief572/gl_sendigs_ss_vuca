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
				<form action="<?=base_url()?>index.php/order/request_vendor" method="post">
				<div class="col-xs-2">
					<select type="text" name="tahun" class="form-control" onchange="this.form.submit()">
						<?php
						$tahun = @$this->input->post('tahun');
						if(empty($tahun)){
							$tahun = date("Y")+0;
						}
						for($i=2016;$i<=date("Y");$i++){
							if($tahun == $i){
								echo "<option selected value='$i'>$i</option>";
							}else{
								echo "<option value='$i'>$i</option>";
							}
						}
						?>
					</select>
				</div>
				<div class="col-xs-2">
					<select type="text" name="bulan" class="form-control" onchange="this.form.submit()">
						<?php
						$nm_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						$bulan = @$this->input->post('bulan');
						if(empty($bulan)){
							$bulan = date("m")+0;
						}
						for($i=1;$i<=12;$i++){
							if($i==$bulan){
								echo "<option selected value='$i'>".$nm_bulan[$i]."</option>";	
							}else{
								echo "<option value='$i'>".$nm_bulan[$i]."</option>";	
							}
												
						}
						?>
					</select>
				</div>
			</form>
			<a href="<?=base_url()?>index.php/order/input_request_vendor" class="btn btn-warning">Tambah Request</a>
			</div>
			<div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No.</th>
					  <th>No. Prospek</th>
					  <th>Tanggal Insert</th>
					  <th>Nama Vendor</th>
					  <th>Jumlah</th>
					  <th>Harga</th>
					  <th>Sisa Bayar</th>
					  <th>Keterangan</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_spd > 0){
							$no=0;
							foreach($list_spd as $row){
								$no++;
								$id2=$row->id;
								$idx=$row->id;
								$id2=str_replace("|","_",$id2);
								$id=$row->id_prospek;
								$insert_date=$row->insert_date;
								$nm_vendor=$row->nm_vendor;
								$jumlah=$row->jumlah;
								$komisi=$row->komisi;
								$ket=$row->ket;
								$tot_bayar = $this->komisi_model->get_bayar($idx);
								$sisa = $komisi - $tot_bayar;
					?>
					<tr>
					  <td><?=$no?></td>
					  <td><?=$id?></td>
					  <td><?=date("d M Y",strtotime($insert_date))?></td>
					  <td><?=$nm_vendor?></td>
					  <td align="right"><?=number_format($jumlah)?></td>
					  <td align="right"><?=number_format($komisi)?></td>
					  <td align="right"><?=number_format($sisa)?></td>
					  <td><?=$ket?></td>
					  <td width="15%">
					  <?php
					  if($jenis == "vendor"){
						  if($row->sts == '1'){
							   echo '<a href="'.base_url().'index.php/komisi/edit_bayar/'.$id2.'" title="Input Pembayaran" class="btn btn-success" width="20%" ><i class="fa fa-money"></i></a>';
						  }else if($row->sts == '2'){
							  echo '<button class="btn btn-danger" width="20%" title="Request Rejected"><i class="fa fa-close"></i></button>';
							  echo '<a href="'.base_url().'index.php/order/edit_request_vendor/'.$id2.'" title="Edit Vendor"  class="btn btn-primary" width="20%" ><i class="fa fa-edit"></i></a>';
						  }else{
							  echo '<a href="'.base_url().'index.php/order/edit_request_vendor/'.$id2.'" title="Edit Vendor"  class="btn btn-primary" width="20%" ><i class="fa fa-edit"></i></a>';
							 
						  }
					  }
						?>
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
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
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