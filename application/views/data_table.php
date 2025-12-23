<?php $this->load->view('header');?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
              <h3 class="box-title"><?=$judul?></h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
			<form method='post' action="<?=base_url().'index.php/setup/edit_menu';?>">
              <table id="example1" class="table table-bordered table-hover dataTable">
				<thead>
					<tr>
					  <th width='5%'>No</th>
					  <th>Nama Menu</th>
					  <th>URL</th>
					  <th width='10%'>Status</th>
					  <th width='10%'>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_menu > 0){
							foreach($data_menu as $row){
							$no_urut = $row->urutan;
							$id_menu = $row->id_menu;
							$i++;
					?>
					<tr>
					  <td><?=$i?></td>
					  <td><?=$row->nm_menu?></td>
					  <td><?=$row->url?></td>
					  <td>
						<select name='tampil[<?=$id_menu?>]'>
							<?php 
							if($row->tampil=="Y"){
								echo "<option value='Y' selected>Show</option>";
							}else{
								echo "<option value='Y'>Show</option>";
							}
							if($row->tampil=="N"){
								echo "<option value='N' selected>None</option>";
							}else{
								echo "<option value='N'>None</option>";
							}
							?>
						</select>
					  </td>
					  <td>
					  <select name='nama_urut[<?=$row->urutan?>]'>
					  <?php foreach($data_urut as $urut){
						if($urut->urutan==$row->urutan){
							echo "<option value='".$urut->urutan."' selected>".$urut->urutan."</option>";
						}else{
							echo "<option value='".$urut->urutan."'>".$urut->urutan."</option>";
						}
					  }
					  ?>
					  </select>
					  </td>
					</tr>
					<?php
							$data_sub	= $this->menu_model->sub_menu($no_urut);
							if($data_sub>0){
								foreach($data_sub as $row_sub){
									$id_menu = $row_sub->id_menu;
									$i++;
									?>
									<tr>
									  <td><?=$i?></td>
									  <td><?=$row_sub->nm_menu?></td>
									  <td><?=$row_sub->url?></td>
									  <td>
										<select name='tampil[<?=$id_menu?>]'>
										<?php 
										if($row_sub->tampil=="Y"){
											echo "<option value='Y' selected>Show</option>";
										}else{
											echo "<option value='Y'>Show</option>";
										}
										if($row_sub->tampil=="N"){
											echo "<option value='N' selected>None</option>";
										}else{
											echo "<option value='N'>None</option>";
										}
										?>
									</select>
									  </td>
									  <td></td>
									</tr>
									<?php
									}
								}
							}
						}
					?>
					
				</tbody>
              </table>
			</form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>