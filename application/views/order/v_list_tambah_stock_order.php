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
			<form action="<?=base_url()?>index.php/order/list_add_stock" method="post">
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
			  <a href="<?=base_url()?>index.php/order/new_tambah_stock" class="btn btn-warning">Add Request</a><br><br>
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>ID Pengajuan</th>
					  <th>Tanggal</th>
					  <th>Pengaju</th>
					  <th>Jumlah Item</th>
					  <th>Approve</th>
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_data > 0){
							$no=0;
							foreach($list_data as $row){
								$no++;
					?>
					<tr>
					  <td><?=$row->id_aju?></td>
					  <td><?=date("d-M-Y",strtotime($row->tgl_aju))?></td>
					  <td><?=$row->insert_by?></td>
					  <td><?=$row->jumlah?></td>
					  <td><?php if($row->sts_app == 0){echo "Waiting Approval";}else if($row->sts_app == 1){echo "Approved";}else{echo "Rejected";}?></td>
					  <td width="15%">
					<?php
					  if($row->sts_app == 0){						
						echo "<a href='".base_url()."index.php/order/edit_req_tambah_new/".$row->id_aju."' title='Edit Request Stock'  class='btn btn-success' width='20%' ><i class='fa fa-edit'></i></a>";
					  }else if($row->sts_app == 1){
						echo "<a href='".base_url()."index.php/order/print_request_tambah/".$row->id_aju."' title='Print Semua Item' target='blank' class='btn btn-info' width='20%' ><i class='fa fa-print'></i></a>";
						
						 echo "<a href='".base_url()."index.php/order/input_tambah_new/".$row->id_aju."' title='Input Stok Masuk'  class='btn btn-primary' width='20%' ><i class='fa fa-download'></i></a>";
					  }else{
						echo "<button title='Rejected'  class='btn btn-danger' width='20%' ><i class='fa fa-remove'></i></button>";
						
						echo "<a href='".base_url()."index.php/order/edit_req_tambah_new/".$row->id_aju."' title='Print Semua Item'  class='btn btn-success' width='20%' ><i class='fa fa-edit'></i></a>";
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