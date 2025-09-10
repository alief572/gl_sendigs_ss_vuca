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
	<!--
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<div class="box-body">
              <a href='<?=base_url()?>index.php/setup/add_user'>
			  <button class="btn btn-warning btn-sm">Add User <i class="fa fa-plus"></i>
			  </button>
			  </a>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th width='5%'>No</th>
					  <th>ID</th>
					  <th>User Name</th>
					  <th>Nama</th>
					  <th>Cabang</th>
					  <th width='5%'>Jabatan</th>
					  <th width='5%'>Status</th>
					  <th width='5%'>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_user > 0){
							foreach($list_user as $row){
							$i++;
							$kd_wil 	= $row->pn_wilayah;
							$kd_jab 	= $row->pn_jabatan;
							$wilayah	= $this->menu_model->get_wilayah($kd_wil);
							$jabatan	= $this->menu_model->get_jabatan($kd_jab);
							if($row->pn_akses==1){
								$sts = "Aktif";
							}else if($row->pn_akses==2){
								$sts = "Resign";
							}else{
								$sts = "Non-Aktif";
							}
					?>
					<tr>
					  <td><?=$i?></td>
					  <td><?=$row->pn_id?></td>
					  <td><?=$row->pn_uname?></td>
					  <td><?=$row->pn_name?></td>
					  <td><?=$wilayah?></td>
					  <td><?=$jabatan?></td>
					  <td><?=$sts?></td>
					  <td><a href="<?=base_url().'index.php/setup/edit_profile/'.$row->pn_id;?>" class='btn btn-primary btn-sm'>Edit Profile <i class="fa fa-edit"></i></a></td>
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
	-->
	</section>
	<section class="content-header">
	<div class="box">
	<div class="box-body">
		<div class="box-body">
			<div class="col-md-6"><h3 class="box-title">List Jabatan</h3>
				<a href='#' id = "modal open" onclick="return open_modal1()">
				  <button class="btn btn-warning btn-sm">Add Jabatan <i class="fa fa-plus"></i>
				  </button>
				</a>
				<!-- /.modal ========================================-->
				<form action="<?=base_url()?>index.php/setup/add_jab" method='post'>
				<div class="example-modal">
					<div class="modal" id='myModal' style="margin-top:100px">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Add Jabatan</h4>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Jabatan</label>
							<input type="text" class="form-control" id="nm_jab" name='nm_jab' placeholder="Masukan nama jabatan " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status Jabatan</label>
						  <select name='sts_jab' class="form-control">
							<option value="1"> Aktif</option>
							<option value="0"> Non-Aktif</option>
						  </select>
						  </div>
						  <div class="modal-footer">
							<input type="submit" class="btn btn-primary pull-right" value="Save" onClick="return check1();">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						  </div>
						</div>
						<!-- /.modal-content -->
					  </div>
					  <!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				  </div>
				  </form>
	   <!-- /.modal ========================================-->
				<div class="box box-primary">
				<div class="box-body table-responsive no-padding">
				  <table class="table table-bordered table-hover dataTable example1">
					<thead>
						<tr>
						  <th width='5%'>No</th>
						  <th width='5%'>Jabatan</th>
						  <th width='5%'>Status</th>
						  <th width='5%'>Edit</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
							if($list_jabatan > 0){
								foreach($list_jabatan as $row2){
								$i++;
								if($row2->sts==1){
									$sts2 = "Aktif";
								}else{
									$sts2 = "Non-Aktif";
								}
						?>
						<tr>
						  <td><?=$i?></td>
						  <td><?=$row2->nm_jabatan?></td>
						  <td><?=$sts2?></td>
						  <td><a href='<?=base_url()?>index.php/setup/set_menu/<?=$row2->id?>' class='btn btn-primary btn-sm'>Edit Akses <i class="fa fa-repeat"></i></a></td>
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
			  <div style="margin-left:17px"><h3 class="box-title" >&nbsp;&nbsp;List Cabang</h3></div>
				<a href='#' style="margin-left:17px" onclick="return open_modal2()">
					<button class="btn btn-warning btn-sm">Add Cabang <i class="fa fa-plus"></i></button>
				</a>
				<!-- /.modal ========================================-->
				<form action="<?=base_url()?>index.php/setup/add_cab" method='post'>
				<div class="example-modal">
					<div class="modal" id='myModal2' style="margin-top:100px">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							  <span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Add Cabang</h4>
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Cabang</label>
							<input type="text" class="form-control" id="nm_cab" name='nm_cab' placeholder="Masukan nama jabatan " value="">
						  </div>
						  <div class="form-group has-success col-lg-6">
						  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Status Cabang</label>
						  <select name='sts_cab' class="form-control">
							<option value="1"> Aktif</option>
							<option value="0"> Non-Aktif</option>
						  </select>
						  </div>
						  <div class="modal-footer">
							<input type="submit" class="btn btn-primary pull-right" value="Save" onClick="return check2();">
							<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
						  </div>
						</div>
						<!-- /.modal-content -->
					  </div>
					  <!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
				  </div>
				  </form>
	   <!-- /.modal ========================================-->
			  <div class="col-md-6">
				<div class="box box-primary">
				<div class="box-body table-responsive no-padding"><br>
				  <table class="table table-bordered table-hover dataTable example1">
					<thead>
						<tr>
						  <th width='5%'>No</th>
						  <th>Nama Cabang</th>
						  <th>Status</th>
						  <th width='5%'>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i=0;
							if($list_cabang > 0){
								foreach($list_cabang as $row3){
								$i++;
								if($row3->sts==1){
									$sts3 = "Aktif";
								}else{
									$sts3 = "Non-Aktif";
								}
						?>
						<tr>
						  <td><?=$i?></td>
						  <td><?=$row3->nm_cabang?></td>
						  <td><?=$sts3?></td>
						  <td><a href='#' class='btn btn-primary btn-sm'>Edit <i class="fa fa-repeat"></i></a></td>
						</tr>
						<?php
								}
							}
						?>

					</tbody>
				  </table>
				</div>
				<!-- /.box-body -->
			  </div>
			  </div>
			  <!-- /.box -->
			</div>
        </div>
        </div>
      <!-- /.row -->
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
  
  function open_modal1(){
	$('#myModal').modal('show');
  }
  function open_modal2(){
	$('#myModal2').modal('show');
  }
  function check1(){
	if($("#nm_jab").val() == ''){
		alert('Masukan nama jabatan');
		document.getElementById("nm_jab").focus();
		return false;
	}
}
function check2(){
	if($("#nm_cab").val() == ''){
		alert('Masukan nama cabang');
		document.getElementById("nm_cab").focus();
		return false;
	}
}
</script>