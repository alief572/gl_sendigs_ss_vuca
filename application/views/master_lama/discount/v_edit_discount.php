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
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
				<form action="<?=base_url()?>index.php/master/save_discount" method="post">
					<table width="100%" class="table table-bordered">
						<?php
						if($list_jabatan > 0){
							foreach($list_jabatan as $row){
								$id			= $row->id;
								$nm_jabatan	= $row->nm_jabatan;
								$discount	= $row->discount;
							}
						?>
						<tr>
							<td><b>Nama Jabatan</b></td>
							<td>
								<input type="hidden" name="id" class='form-control' id="id" value="<?=$id?>" readonly>
								<input type="text" name="nm" class='form-control' id="nm" value="<?=$nm_jabatan?>" readonly>
							</td>
							<td><b>Discount (%)</b></td>
							<td><input type="text" name="discount"  class='form-control' id="discount" value="<?=$discount?>" ></td>
						</tr>
						<tr>
							<td colspan="4" align="right" style="background-color:white" ><input type="submit" name="submit" value="Save" class="btn btn-success"></td>
						</tr>
						<?php
						}
						?>
					</table>
					</form>
            </div>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
