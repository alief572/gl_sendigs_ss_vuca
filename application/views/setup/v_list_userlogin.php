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
			
            </div>
			<center>
				<a href="<?=base_url()?>index.php/setup/tambah_userlogin" class="btn btn-primary" width="20%">Tambah User <i class="fa fa-plus"></i></a>
			</center>
				<br>
            <!-- /.box-header -->
           <!--  <div class="box-body table-responsive no-padding"> -->
		   		
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
				
				
					<tr>
					  <th width="5%">No</th>
					  <th>Nama User Login</th>
					  <th>Jabatan</th>
					  <th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_userlogin > 0){
							foreach($list_userlogin as $row){
							$i++;
							
							$id_jabatan 	= $row->id;
							$nama_jabatan = $row->nm_jabatan;
							$id_user			= $row->pn_id;
							$nama_user		= $row->pn_name;
							
					?>
					<tr>
					  <td><?=$i?></td>
					  <td><?=$row->pn_name?></td>
					  <td><?=$row->nm_jabatan?></td>
					  
					  <td>
						<!--
							<button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#myModal" onclick="return edit_userlogin('<?=$row->pn_name?>', <?=$row->pn_pass?>, <?=$row->nm_jabatan?>)">Edit <i class="fa fa-edit"></i></button>
							-->
							<div class="btn-group">
								<a href="<?=base_url()?>index.php/setup/ke_EditUser/<?=$row->pn_name?>" class='btn btn-warning'>Edit</a>
								
							</div>
							<div class="btn-group">								
								<a href="<?=base_url()?>index.php/setup/ke_HapusUser/<?=$row->pn_name?>" class='btn btn-danger'>Hapus</a>
							</div>
							
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
              </table>

							<div id="show_user"></div>
								
							<!-- </div> -->
						</div>
          </div>
        </div>
      </div> 

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<form action="<?=site_url('setup/edit_userlogin')?>" method='POST' autocomplete="off">
										<div class="modal-dialog modal-sm" role="document">
											<div class="modal-content">

												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Edit User Login</h4>
												</div>

												<div class="modal-body">

													<div class="form-group">
														<label for="recipient-name" class="control-label">Username :</label>															
															<div class="input-group">																
																<input type="hidden" name="user_id" id="user_id" value="<?=$id_user?>">
																<input type="text" class="form-control" name="username" id="username" value="<?=$nama_user?>"><br>																
															</div>

															<label for="recipient-name" class="control-label">Password :</label>															
															<div class="input-group">															
																<input type="text" class="form-control" name="password" id="password" value="">
															</div>	
														
															<label for="recipient-name" class="control-label">Jabatan :</label>															
															<div class="input-group">	
																<select name="jabatan" class="form-control" id="jabatan">
																	<option value="<?=$id_jabatan?>"><?=$nama_jabatan?></option>
																	<?php
																		$i=0;
																		if($list_userlogin > 0){
																			foreach($list_userlogin as $row2){
																			$i++;
																			$id_jab 	= $row2->id;
																			$nama_jab = $row2->nm_jabatan;
																			echo "<option value='".$id_jab."'>".$nama_jab."</option>";														
																			}
																		}
																	?>
																</select>														
																<!-- <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?=$row->nm_jabatan?>"> -->
															</div>															
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Ubah</button>
												</div>
											</div>
										</div>
										</form>
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
/*
	function edit_userlogin(id){
	$.get( "<?= base_url(); ?>index.php/setup/edit_userlogin" , { id :id } , function ( data ) {
		$( '#show_user' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
*/
	function edit_userlogin(data_username,data_password,data_jabatan) {
		$('#username').val(data_username);
		$('#password').val(data_password);
		$('#jabatan').val(data_jabatan);
	}
</script>