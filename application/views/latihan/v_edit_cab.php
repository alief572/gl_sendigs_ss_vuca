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
						<form action="<?=base_url()?>index.php/Latihan/proses_edit_cab" method="post">		
			
              <table class="table table-bordered">
              <?php

$i=0;
if($list_cab > 0){
foreach($list_cab as $row){
$i++;
                                                                            $js=$row->nocab;//utuk memanggil data dari model/foreach
																			$js=$row->subcab;
																			$js=$row->area;
																			$js=$row->spkid;
                                                                            $js=$row->kdcab;
                                                                            $js=$row->nofak;
																			$js=$row->nocust;
																			$js=$row->nosales;
                                                                            $js=$row->lastupdate;
                                                                            $js=$row->kepala;
																			$js=$row->alamat;
																			$js=$row->namacabang;
                                                                            $js=$row->kabagjualan;
                                                                            $js=$row->kepalacabang;
																			$js=$row->admcabang;
																			$js=$row->gudang;
                                                   
?>
					
                    <tr>
					<td width="160">No Cabang</td>
					<td>                            
<input type="text" width="70" class="form-control" name="nocab" id="nocab" value="<?=$row->nocab?>">
					</td>

			</tr>
				<tr>
					<td>Sub Cabang</td>
					<td>
		<input type="text" class="form-control" size='' name="subcab" id="subcab" value="<?=$row->subcab?>">
					</td>
				</tr>
		<tr>
					<td>Area</td>
					<td>
				<input type="text" class="form-control" size='' name="area" id="area" value="<?=$row->area?>">
					</td>
					</tr>
				<tr>
					<td>SKPID</td>
					<td>
					<input type="text" class="form-control" size='' name="spkid" id="spkid" value="<?=$row->spkid?>">
					</td>
				</tr>
				<tr>
					<td width="">Kode Cabang</td>
					<td>
					<input type="text" class="form-control" size='' id="kdcab" name="kdcab" value="<?=$row->kdcab?>">
					</td>
				</tr>
				<tr>
					<td>No Faktur</td>
					<td>
					<input type="text" class="form-control" size='' name="nofak" id="nofak" value="<?=$row->nofak?>">
					</td>
				</tr>
                <tr>
					<td>No Customer</td>
					<td>
					<input type="text" class="form-control" size='' name="nocust" id="nocust" value="<?=$row->nocust?>">
					</td>
				</tr>
                <tr>
					<td>No Sales</td>
					<td>
			<input type="text" class="form-control" size='' name="nosales" id="nosales" value="<?=$row->nosales?>">
					</td>
				</tr>
                <tr>
					<td>Last Update</td>
					<td>
					<input type="text" class="form-control" size='' name="lastupdate" id="lastupdate" value="<?=$row->lastupdate?>">
					</td>
				</tr>
                <tr>
					<td>Perusahaan</td>
					<td>
					<input type="text" class="form-control" size='' name="kepala" id="kepala" value="<?=$row->kepala?>">
					</td>
				</tr>
                <tr>
					<td>Alamat</td>
					<td>
					<input type="text" class="form-control" size='' name="alamat" id="alamat" value="<?=$row->alamat?>">
					</td>
				</tr>
                <tr>
					<td>Nama Cabang</td>
					<td>
					<input type="text" class="form-control" size='' name="namacabang" id="namacabang" value="<?=$row->namacabang?>">
					</td>
				</tr>
                <tr>
					<td>Kabag Penjualan</td>
					<td>
					<input type="text" class="form-control" size='' name="kabagjualan" id="kabagjualan" value="<?=$row->kabagjualan?>">
					</td>
				</tr>
                <tr>
					<td>Kepala Cabang</td>
					<td>
					<input type="text" class="form-control" size='' name="kepalacabang" id="kepalacabang" value="<?=$row->kepalacabang?>">
					</td>
				</tr>
                <tr>
					<td>Adm Cabang</td>
					<td>
					<input type="text" class="form-control" size='' name="admcabang" id="admcabang" value="<?=$row->admcabang?>">
					</td>
				</tr>
                <tr>
					<td>Gudang</td>
					<td>
					<input type="text" class="form-control" size='' name="gudang" id="gudang" value="<?=$row->gudang?>">
					</td>
				</tr>
				<tr>
					<td>
					<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onClick="return check()">
                    <a href="<?=base_url()?>index.php/Latihan/cabang/"   target="blank" class="btn btn-info" width="20%" >Cancel<i class=""></i></a>

			
                    </td>
				</tr>
	
			            <?php
														}
															}
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