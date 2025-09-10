<?php $this->load->view('header');?> 
    <section class="content-header">
      <h1>
       BATAL BUM
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">KONFIRMASI BATAL BUM</li>
      </ol>
    </section>

	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">   
				<div class="box-body">
					<?php
						// if($pesan_on == 1){
						// 	echo "<div class='alert alert-success' role='alert'>Data BUK Sudah di Batalkan !</div>";
						// }		
					?>
				<form method='post' action="<?=base_url().'index.php/jurnal/proses_vmodal_batal_bum';?>" id="form-batal-bum">
				<table>
						<tr>
							<td>
								<label class="control-label" for="inputSuccess">Benar-benar Yakin dibatalkan ?</label>
							</td>
														
						</tr>

						<tr>
							<td>
								<input type="hidden" class="form-control" id="id_bum" name='id_bum' value="<?=$id_bum?>">
					 			
								 <input type="text" class="form-control" id="alasan_batal_bum" name='alasan_batal_bum' placeholder="-Berikan Alasan Pembatalan-" value="">
							</td>		
												
						</tr>	
						<tr>
							<td>
								<br>
							</td>		
												
						</tr>						
					

						<tr>
							<td align="right">
							<a href="<?=base_url()?>index.php/jurnal/list_dana_masuk" class="btn btn-success">Tidak</a>	<input type="submit" name="submit" value="Ya" class='pull-right btn btn-danger' onclick="return check()">
							</td>
							
						</tr>
				</table>
					
				</form>	
        	</div>
    	</div>
	</div>
    </div>
	</div>
	<div id="show_stock"><div>
	</section>
<?php $this->load->view('footer');?>

<script src="<?=base_url()?>dist/moment.min.js"></script>
<script type="text/javascript">
function check(){
	if($("#alasan_batal_bum").val() == ''){
		alert('Silahkan isi alasan batal dahulu');
		document.getElementById("alasan_batal_bum").focus();
		return false;
	}

	$('#form-batal-bum').submit();
}
</script>