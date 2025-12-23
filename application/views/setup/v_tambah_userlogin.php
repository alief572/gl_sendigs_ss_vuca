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
					
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" action="<?=base_url()?>index.php/setup/tambah_userlogin_" autocomplete="off">
              <table class="table table-bordered">	
							
								<tr>
									<td width="25%"><b>Username</b></td>
									<td width="25%">										
										<input type="text" class="form-control" name="username" id="username" value="" required>
									</td>									
								</tr>

								<tr>
									<td width="25%"><b>Jabatan</b></td>
									<td width="25%">									
										<select name="jabatan"  id="jabatan"  class="form-control" required>
											<option value="">- Pilih Jabatan -</option>
											<?php
												if($data_jab > 0){
													foreach($data_jab as $rowm){											
															echo "<option value='".$rowm->id."'>".$rowm->nm_jabatan."</option>";	
														}
													}												
											?>
										</select>
									</td>
								</tr>
								
								<tr>
									<td width="25%"><b>Status Marketing</b></td>
									<td width="25%">
										<select name="marketing"  id="marketing" class="custom-select">
											<option selected value="Y">Ya</option>
											<option value="N">Tidak</option>											
										</select>
									</td>
								</tr>

								<tr>
									<td width="25%"><b>Set Password</b></td>
									<td width="25%">										
									</td>							
								</tr>
								
								<tr>
									<td width="25%" align="right"><b>Create Password</b></td>
									<td width="25%"><input type="text" class="form-control" name="npassword" id="npassword" value="" required></td>
									<!-- <?= form_error('npassword'); ?> -->
								</tr>
								<tr>
									<td width="25%" align="right"><b>Re-type Password</b></td>
									<td width="25%"><input type="text" class="form-control" name="rpassword" id="rpassword" value="" required></td>
								</tr>

								<tr>   

								<td align="right"><a href="<?=base_url()?>index.php/setup/user_login" class="btn btn-primary" width="20%">Cancel</a></td>

								<td align="left"><button type="submit" class="btn btn-primary" width="20%">Simpan</button>
	
								</td>

								</tr>

				<tr>
				
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
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	function check(){
		if($("#username").val()=="0"){
			alert("Silahkan isi Username");
			return false;
		}else if($("#password").val()=="0"){
			alert("Silahkan isi Password");
			return false;
		}else if($("#jabatan").val()=="0"){
			alert("Silahkan isi Jabatan");
			return false;
		}
	}
	/*
	$(function () {
    $(".example1").DataTable();
  });
	*/
</script>
