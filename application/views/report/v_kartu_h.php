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
						<form method="post" action="<?=base_url()?>index.php/kartu_hutang/tampilkan_kartu_hutang" autocomplete="off">
              <table class="table table-bordered">			 
								<tr>
									<td width="15%" align="right"><b>Periode Awal</b></td>
									<td width="15%">
									 <input type="text" id="tgl_awal" name="tgl_awal" class="datepicker"  /> 
                                    </td>
									<td width="15%">
									</td>
									<td width="15%">																			 
									</td>
								</tr>
								<tr>
									<td width="15%" align="right"><b>Periode Akhir</b></td>
									<td width="15%">
									<input type="text" id="tgl_akhir" name="tgl_akhir" value="" class="datepicker" />	
                                    </td>
									<td width="15%">																			 
									</td>
									<td width="15%">																			 
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
									<td width="15%">
									</td>
									<td width="15%">																			 
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
	
	$(function() {
		$('.datepicker').datepicker({
			format   : 'yyyy-mm-dd',
			autoclose: true,
			todayHighlight: true
		});


		$('#datepicker2').datepicker({
			dateFormat: 'yyyy-mm-dd'
		});
	});
	
</script>
