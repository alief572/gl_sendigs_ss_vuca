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
					<b><?=$judul2?></b><br><br>
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" action="<?=base_url()?>index.php/report/proses_trial_balance" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="25%"><b>Bulan</b></td>
									<td>
									<select type="text" name="bulan_posting" class="form-control">
										<?php
										$nm_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
										$bulan = @$this->input->post('bulan_posting');
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
									</td>
								</tr>

								<tr>
									<td width="25%"><b>Tahun</b></td>
									<td>
									<select type="text" name="tahun_posting" class="form-control">
										<?php
										$tahun = @$this->input->post('tahun_posting');
										if(empty($tahun)){
											$tahun = date("Y")+0;
										}
										for($i=date("Y")-8;$i<=date("Y")+2;$i++){
											if($tahun == $i){
												echo "<option selected value='$i'>$i</option>";
											}else{
												echo "<option value='$i'>$i</option>";
											}
										}
										?>
									</select>
									</td>
								</tr>

				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="proses" value="OK" onclick="return check()" class="btn btn-success pull-center" target="_blank">
					</td>
					
				</tr>
				
				
				</table>
			  
			  </form>

        </div>
				<?php
				if($pesan_on == 1){
					echo "<div class='alert alert-danger' role='alert'>Lakukan UnPosting terlebih dahulu !</div>";
				}
					//$proses = 0;
					if($proses == 2){
				
						echo "<div class='alert alert-success' role='alert'>Proses Posting Berhasil</div>";
					}
			
				?>
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
		if($("#bulan_posting").val()=="0"){
			alert("Silahkan Pilih Bulan");
			return false;
		}else if($("#tahun_posting").val()=="0"){
			alert("Silahkan Pilih Tahun");
			return false;
		}
	}
	/*
	$(function () {
    $(".example1").DataTable();
  });
	*/
</script>
