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
				<form action="<?=base_url()?>index.php/order/not_goal" method="post">
				<div class="col-xs-2">
					<select type="text" name="tahun" class="form-control" onchange="this.form.submit()">
						<?php
						$tahun = @$this->input->post('tahun');
						if(empty($tahun)){
							$tahun = date("Y")+0;
						}
						for($i=date("Y")-2;$i<=date("Y")+2;$i++){
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
						$nm_bulan = array('All','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						$bulan = @$this->input->post('bulan');
						if(empty($bulan)){
							$bulan = 0;
						}
						for($i=0;$i<=12;$i++){
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
			  <a href="<?=base_url()?>index.php/order/input" class="btn btn-warning" >Tambah Prospek <i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>Marketing</th>
					  <th>Id Prospek</th>
					  <th>Calon Pria</th>
					  <th>Calon Wanita</th>
					  <th>Telpon</th>
					  <th>Tanggal Resepsi</th>
					  <th>Jam Resepsi</th>
					  <th>Tempat Resepsi</th>
					  <th>Progres</th>
					  <th>Cancel</th>
					  <th>Competitor</th>
					  <th>Alasan Lost</th>
					  <th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_prospek > 0){
							foreach($data_prospek as $row){
							$i++;
					?>
					<tr>
					  <td><?=$row->salesman?></td>
					  <td><?=$row->id_prospek?></td>
					  <td><?=$row->calon_pria?></td>
					  <td><?=$row->calon_wanita?></td>
					  <td><?=$row->telfon?></td>
					  <td><?=date("d-M-Y",strtotime($row->resepsi_date));?></td>
					  <td><?=$row->resepsi_jam?></td>
					  <td><?=$row->tempat1." ".$row->tempat2." ".$row->tempat3?></td>
					  <td><?=$row->sts_progres?></td>
					  <td><?=$row->alasan_cancel?></td>
					  <td><?=$row->nm_competitor?></td>
					  <td><?=$row->alasan_lost?></td>
					  <td>
					  <a href="<?=base_url()?>index.php/order/edit_prospek/<?=$row->id_prospek?>"class='btn btn-primary btn-sm' onclick="return edit_stock(<?=$row->id_prospek?>)">
					  Edit <i class="fa fa-edit"></i>
					  </a>
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
	</section>
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
   $(function () {
    $(".example1").DataTable({
        "order": [[ 1, "desc" ]]
    });
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