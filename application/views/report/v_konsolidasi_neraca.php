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
					<b>PERIODE : </b><br><br>
            <!-- /.box-header -->
           <!-- <div class="box-body table-responsive no-padding"> -->
						<form method="post" action="<?=base_url()?>index.php/report/tampilkan_konsolidasi_neraca" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="15%" align="right"><b>Bulan</b></td>
									<td>

									<select type="text" name="bulan_neraca" class="form-control">
										<?php
										$nm_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
										$bulan = @$this->input->post('bulan_neraca');
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
									<td width="15%" align="right"><b>Tahun</b></td>
									<td>

									<select type="text" name="tahun_neraca" class="form-control">
											<?php
											$tahun = @$this->input->post('tahun_neraca');
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
									<td width="15%" align="right"><b>Pilih Level COA</b></td>
									<td>

									<select name="level"  id="level"  class="form-control input-sm">
										<!-- <option value="" selected>-Pilih Level-</option> -->
										<option value="3">3</option>
										<option value="5" selected>5</option>											
									</select>

									</td>
								</tr>

				<tr>
					<td colspan="2" align="center"><input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center" target="_blank"> <input type="submit" name="tampilkan" value="Print Preview" onclick="return check()" class="btn btn-success pull-center" target="_blank"></td>
					
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
		if($("#bulan_neraca").val()==""){
			alert("Silahkan Pilih Bulan");
			return false;
		}else if($("#tahun_neraca").val()==""){
			alert("Silahkan Pilih Tahun");
			return false;
		}else if($("#level").val()==""){
			alert("Silahkan Pilih Level");
			return false;
		}
	}
	
</script>
