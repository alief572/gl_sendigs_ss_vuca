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
					  <th width='7%'>Urutan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
					$d=0;
						if($data_menu > 0){
							foreach($data_menu as $row){
							$id_menu = $row->id_menu;
							$no_urut = $row->urutan;
							$i++;
							$d++;
					?>
					<tr class="bg-gray disabled color-palette">
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
					  <select name='nama_urut[<?=$d?>]'>
					  <?php for($x=1;$x<=count($data_urut);$x++){
						if($x==$row->urutan){
							echo "<option value='".$x."' selected>".$x."</option>";
						}else{
							echo "<option value='".$x."'>".$x."</option>";
						}
					  }
					  ?>
					  </select>
					  <input type='hidden' name='id_menu[<?=$d?>]' value='<?=$id_menu?>'>
					  <input type='hidden' name='tampil_id_menu[<?=$id_menu?>]' value='<?=$id_menu?>'>
					  </td>
					</tr>
					<?php
							$data_sub	= $this->menu_model->sub_menu($id_menu);
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
										<input type='hidden' name='tampil_id_menu[<?=$id_menu?>]' value='<?=$id_menu?>'>
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