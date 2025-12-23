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
						<form method="post" action="<?=base_url()?>index.php/report/tampilkan_ap" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="15%" align="right"><b>Bulan</b></td>
									<td>

									<select type="text" name="bulan_labarugi" class="form-control">
										<?php
										$nm_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
										$bulan = @$this->input->post('bulan_labarugi');
										if(empty($bulan)){
											// $bulan = date("m")+0;
											$singkat_cbg = $this->session->userdata('singkat_cbg');
											$cek_periode = $this->db->query("SELECT * FROM periode WHERE stsaktif='O' AND kdcab='$singkat_cbg'")->result();
											if($cek_periode > 0){
												foreach($cek_periode as $r_periode){
													$bln_thn	= $r_periode->periode;	// 12-2019
													$bulan		= substr($bln_thn,0,2);
												}
											}
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

									<select type="text" name="tahun_labarugi" class="form-control">
										<?php
										$tahun = @$this->input->post('tahun_labarugi');
										if(empty($tahun)){
											//$tahun = date("Y")+0;
											$singkat_cbg = $this->session->userdata('singkat_cbg');
											$cek_periode2 = $this->db->query("SELECT * FROM periode WHERE stsaktif='O' AND kdcab='$singkat_cbg'")->result();
											if($cek_periode2 > 0){
												foreach($cek_periode2 as $r_periode2){
													$bln_thn2	= $r_periode2->periode;	// 12-2019
													$tahun		= substr($bln_thn2,3,4);
												}
											}
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
									<td width="15%" align="right"><b>Vendor</b></td>
									<td>
                                    <?php
									$datklien[0]	= 'Select An Option';						
									echo form_dropdown('id_klien',$datklien, set_value('id_klien', isset($data->id_klien) ? $data->id_klien : 'selected'), array('name'=>'id_klien','id'=>'id_klien','class'=>'form-control id_klien'));											
									?>

									</td>
								</tr>
				<tr>
					<td width="15%" align="right"></td>
					<td width="25%" align="left">
						<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center">                             
						<!-- <input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn btn-success pull-center">
					-->
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
		if($("#bulan_labarugi").val()=="0"){
			alert("Silahkan Pilih Bulan");
			return false;
		}else if($("#tahun_labarugi").val()=="0"){
			alert("Silahkan Pilih Tahun");
			return false;
		}else if($("#level").val()==""){
			alert("Silahkan Pilih Vendor");
			return false;
		}
	}
	
</script>
