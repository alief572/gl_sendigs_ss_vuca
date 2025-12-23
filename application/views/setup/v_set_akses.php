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
              <h3 class="box-title"><?=$judul." ".$data_jabatan?></h3>

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
			<form method='post' action="<?=base_url().'index.php/setup/proses_menu_akses';?>">
              <table id="example1" class="table table-bordered table-hover dataTable">
				<thead>
					<tr class='bg-gray disabled color-palette'>
					  <th width='5%'>No</th>
					  <th>Nama Menu</th>
					  <th>URL</th>
					  <th width='7%'>Read</th>
					  <th width='7%'>Update</th>
					  <th width='7%'>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($data_menu > 0){
							foreach($data_menu as $row){
							$id_menu = $row->id_menu;
							echo "<input type='hidden' value='$id_menu' name='id_menu[$i]'>";
							echo "<input type='hidden' value='$id_jab' name='jabatan'>";
							$i++;
							$sel1 = "";
							$sel2 = "";
							$sel3 = "";
							$menu_akses = $this->menu_model->get_all_menu($id_jab,$id_menu);
							if($menu_akses > 0){
								foreach($menu_akses as $row2){
									$read 	= $row2->r;
									$update = $row2->u;
									$delete = $row2->d;
									if($read=="Y"){
										$sel1	= "checked";
									}
									if($update=="Y"){
										$sel2	= "checked";
									}
									if($delete=="Y"){
										$sel3	= "checked";
									}
								?>
								<tr>
								  <td><?=$i?></td>
								  <td><?=$row->nm_menu?></td>
								  <td><?=$row->url?></td>
								  <td>
								  <input type='checkbox' name='r[<?=$i?>]' <?=$sel1?> value='Y'>
								  </td>
								  <td>
								  <input type='checkbox' name='u[<?=$i?>]]' <?=$sel2?> value='Y'>
								  </td>
								  <td>
								  <input type='checkbox' name='d[<?=$i?>]]' <?=$sel3?> value='Y'>
								  </td>
								</tr>
								<?php 
									}
								}else{
								?>
								<tr>
								  <td><?=$i?></td>
								  <td><?=$row->nm_menu?></td>
								  <td><?=$row->url?></td>
								  <td><input type='checkbox' name='r[<?=$i?>]]' value='Y'></td>
								  <td><input type='checkbox' name='u[<?=$i?>]]' value='Y'></td>
								  <td><input type='checkbox' name='d[<?=$i?>]]' value='Y'></td>
								</tr>
								<?php
								}
							}	
						}
						?>
				</tbody>
				<tr>
					<td colspan='5'><input type='submit' name='save' value='SAVE' class='btn pull-right btn-success'></td>
				</tr>
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
<?php $this->load->view('footer');?>