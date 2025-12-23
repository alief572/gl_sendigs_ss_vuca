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
        <div class="col-xs-13">
          <div class="box">
            <div class="box-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
						<form action="<?=base_url()?>index.php/Latihan/proses" method="post">		
			
              <table class="table table-bordered">
					
					 <?php

													$i=0;
													if($data_jv > 0){
													foreach($data_jv as $row){
                                                    $i++;
                                                    
																										$js=$row->noJS;//utuk memanggil data dari model/foreach
																										$js=$row->noJP;
																										$js=$row->noJO;
																										$js=$row->noJC;
																										$js=$row->noJM;
										        ?>

                <tr>
					<td id="js_td" width="160">Nomor JS Awal</td>
					<td>                            
					<input type="text" width="70" class="form-control" size='' name="js1" id="js1" value="<?=$row->noJS?>" >
					</td>
				</tr>
				<tr>
					<td>Nomor JP Awal</td>
					<td>
					<input type="text" class="form-control" size='' name="jp" id="jp" value="<?=$row->noJP?>">
					</td>
				</tr>
				<tr>
					<td>Nomor JO Awal</td>
					<td>
					<input type="text" class="form-control" size='' name="jo" id="jo" value="<?=$row->noJO?>">
					</td>
					</tr>
				<tr>
					<td>Nomor JC Awal</td>
					<td>
					<input type="text" class="form-control" size='' name="jc" id="jc" value="<?=$row->noJC?>">
					</td>
				</tr>
				<tr>
					<td width="">Nomor JM Awal</td>
					<td>
					<input type="text" class="form-control" size='' id="jm" name="jm" value="<?=$row->noJM?>">
					</td>
				</tr>
				<tr>
					<td>Nomor JD Awal</td>
					<td>
					<input type="text" class="form-control" size='' name="jd" id="jd" value="<?=$row->noJD?>">
					</td>
				</tr>
				<tr>
					<td>
					<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onClick="return check()">
                    			
                    </td>
				</tr>
										
                    <?php
														}
												
															}
															echo $this->session->flashdata('message');
												?>
		
				</table>
			  </form>
            </div>
						</section>
        </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>

<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>
<script>

function tampil(){	
		var js = $("#auto").val();
		$.get( "<?= base_url(); ?>index.php/latihan/tampil_buton" , { option : js } , function ( data ) {
			$( '#js_td' ) . html ( data ) ;
		} ) ;
		
	}



$(document).ready(function(){
	$('#datepicker').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
$(document).ready(function(){
	$('#penawaran').datepicker({
		dateFormat:'yy-mm-dd'
	});
});
$(document).ready(function(){
$('.clockpicker').clockpicker()
		.find('input').change(function(){
			console.log(this.value);
		});
		var input = $('#single-input').clockpicker({
			placement: 'bottom',
			align: 'left',
			autoclose: true,
			'default': 'now'
		});
});

	
</script>