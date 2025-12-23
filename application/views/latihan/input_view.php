<?php $this->load->view('header');?>
	<link rel="stylesheet" type="text/css" href="<?=base_url();?>dist/jquery.timepicker.css">
    <section class="content-header">
      <h1>
       <?=$judul?>
      </h1>
          </section>
	<section class="content-header">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
			<form method="post" action="">

      <table class="table table-bordered">
				<tr>
					<td width="25%">No Perkiraan</td><td>
					<input type="text" class="form-control" size='1' value="" name="no_perkiraan">
					</td>
				</tr>
        <tr>
					<td width="25%">Nama</td><td>
					<input type="text" class="form-control" size='1' value="" name="nama">
					</td>
				</tr>
        <tr>
					<td width="25%">Kode Cabang</td><td>
					<input type="text" class="form-control" size='1' value="" name="kdcab">
					</td>
				</tr>
        <tr>
					<td width="25%">Nama</td><td>
					<input type="text" class="form-control" size='1' value="" name="nama">
					</td>
				</tr>
				
        </table>
      </form>
      </section>
      </div>
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
$('#jam_resepsi').timepicker({ 
		'timeFormat': 'H:i', 
		'step': 60 
	});