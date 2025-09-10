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
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
					<b></b><br><br>
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" action="<?=base_url()?>index.php/report/tampilkan_labarugi_event" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="15%" align="right"><b>PROJECT</b></td>
									<td>
										<?php
											if($data_project > 0 ){
												foreach($data_project as $row_project){
														$id_project = $row_project->id_penawaran;
														$pria		= $row_project->pengantin_pria;
														$wanita		= $row_project->pengantin_wanita;
														$nganten	= $pria." & ".$wanita;
													
												}
											}
										?>
									
										<select type="text" name="project" id="project" class="form-control" onchange="changeValue(this.value)">
											<option value=""> -- PILIH PROJECT --</option>
											<?php											
												foreach($data_project as $row_project){
													$id_project = $row_project->id_penawaran;
													$pria		= $row_project->pengantin_pria;
													$wanita		= $row_project->pengantin_wanita;
													$nganten	= $pria." & ".$wanita;
													echo "<option value='".$id_project."'>".$id_project." ".$nganten."</option>";
												}											
											?>
										</select>									
									</td>
								</tr>
								<tr>								
									<td width="15%" align="right"><b>Nama Pengantin</b></td>
									<td id="nganten_td">
										<input class="form-control" name="nganten" id="nganten" readonly/>					
									</td>
								</tr>

				<tr>
					<td width="15%" align="right"></td>
					<td width="25%" align="left">
						<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center">                             
						<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn btn-success pull-center">
					</td>
					
				</tr>
				
				</table>
			  
			  </form>
            
        </div>
    </div>
    </div>
</section>
<?php $this->load->view('footer');?>

<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script>
	function check(){
		if($("#project").val()=="0"){
			alert("Silahkan Pilih Project");
			return false;
		}
	}

	function changeValue(id){
		$.get( "<?= base_url(); ?>index.php/report/change_lr_event" , { option : id } , function ( data ) {
		$( '#nganten_td' ) . html ( data ) ;
		} ) ;
	}
	
</script>
