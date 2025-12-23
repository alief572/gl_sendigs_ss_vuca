<?php
$this->load->view('header'); 

?> 
<section class="content-header">
	<h1>
		<?= $title ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?= $title ?></li>
	</ol>
</section>
<section class="content-header">
	<div class="col-xs-12">
		<form action="#" method="POST" id="form-proses">
			<div class="box box-warning">
				<div class="box-header">
					<b>PERIODE : </b><br><br>
				</div>
				<div class="box-body">
					<div class='form-group row'>			
						<label class='label-control col-sm-3'><b>Cabang <span class='text-red'>*</span></b></label> 
						<div class='col-sm-8'>
							<?php
								echo form_dropdown('kode_cabang',$rows_cabang,$cab_pilih, array('id'=>'kode_cabang', 'class'=>'form-control input-sm'));
							?>							
						</div>							
					</div>
					<!--
					<div class='form-group row'>			
						<label class='label-control col-sm-3'><b>Periode <span class='text-red'>*</span></b></label> 
						<div class='col-sm-8'>
							<?php
								echo form_input(array('id'=>'periode_proses','name'=>'periode_proses','class'=>'form-control input-sm','readOnly'=>true,'data-role'=>'datepicker'),date('F Y'));
							?>							
						</div>									
					</div>	
					!-->
					
				</div>
				<div class="box-footer">
					<?php
						echo"<button type='button' class='btn btn-md btn-warning' id='btn-back'> <i class='fa fa-angle-double-left'></i> Check Balance </button>&nbsp;&nbsp;&nbsp;";	
						echo"<button type='button' class='btn btn-md btn-success' id='btn-save'>POSTING <i class='fa fa-refresh'></i>  </button>&nbsp;&nbsp;&nbsp;";
						//echo"<button type='button' class='btn btn-md btn-primary' id='btn-save-current'>POSTING CURRENT MONTH <i class='fa fa-calender'></i>  </button>&nbsp;&nbsp;&nbsp;";
						echo"<button type='button' class='btn btn-md btn-danger' id='btn-unpost'>UNPOSTING <i class='fa fa-recycle'></i>  </button>";
					?>
				</div>
			</div>
		</form>
		<div class="box box-primary" id="list_error">
			<div class="box-header">
				<b>ERROR MESSAGE : </b><br><br>
			</div>
			<div class="box-body">
				<div class="alert alert-warning" role="alert" id="alert_error">
							
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="MyBalance">
	<div class="modal-dialog" style="width:80%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="MyBalance-title">Unbalance Journal</h4>
			</div>
			<div class="modal-body" id="MyBalance-list">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $this->load->view('footer'); ?>
<style>
	.ui-datepicker-calendar{
		display : none;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/jquery-ui/jquery-ui.min.css') ?>">
<script src="<?php echo base_url('assets/jquery-ui/jquery-ui.min.js') ?>"></script>
<script>
	var base_url			= '<?php echo base_url(); ?>';
	var active_controller	= '<?php echo($this->uri->segment(1)); ?>';
	$(document).ready(function(){
		$('#list_error').hide();
		$("#periode_proses").datepicker({
			changeMonth		: true,
			changeYear		: true,
			showButtonPanel	: true,
			dateFormat		: 'MM yy',
			maxDate			:'+0d',
			onClose: function(dateText, inst) { 
				$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));				
			}
		});
		
		$('input[type="select"]').chosen();
		$('#btn-back').click(function(){
			let cabang_det		= $('#kode_cabang').val();
			//let tgl_det			= $('#periode_proses').val();
			
			if(cabang_det == null || cabang_det =='' || cabang_det == '0'){
				swal({
				  title				: "Error Message !",
				  text				: 'Empty Branch. Please choose branch first ...',	 					
				  type				: "warning"
				});
				
				return false;
			}
			/*
			if(tgl_det == null || tgl_det =='' || tgl_det == '0'){
				swal({
				  title				: "Error Message !",
				  text				: 'Empty Period Process. Please choose period process first ...',						
				  type				: "warning"
				});
				
				return false;
			}
			
			data	: {'cabang':cabang_det,'periode':tgl_det},
			*/
				
			loading_spinner();
			$.ajax({
				url		: base_url + 'index.php/' + active_controller + '/detail_unbalance',
				cache	: false,
				type	: "POST",
				data	: {'cabang':cabang_det},
				success: function(data) {
					close_spinner();
					$('#MyBalance-list').html(data);
					$("#MyBalance").modal('show');
				}
			});
		});
		
	});
	
	$(document).on('click','#btn-unpost',function(e){
		e.preventDefault();	
		let cabang		= $('#kode_cabang').val();
		//let tgl_pilih	= $('#periode_proses').val();
		
		$('#alert_error').empty();
		$('#list_error').hide();
		$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',true);
		if(cabang == null || cabang =='' || cabang == '0'){
			swal({
			  title				: "Error Message !",
			  text				: 'Empty Branch. Please choose branch first ...',						
			  type				: "warning"
			});
			$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
			return false;
		}
		/*
		if(tgl_pilih == null || tgl_pilih =='' || tgl_pilih == '0'){
			swal({
			  title				: "Error Message !",
			  text				: 'Empty Period Process. Please choose period process first ...',						
			  type				: "warning"
			});
			$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
			return false;
		}
		*/
		swal({
			  title: "Are you sure?",
			  text: "You will not be able to process again this data!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Yes, Process it!",
			  cancelButtonText: "No, cancel process!",
			  closeOnConfirm: true,
			  closeOnCancel: false
			},
			function(isConfirm) {					
				if (isConfirm) {
					loading_spinner();
					var formData 	= new FormData($('#form-proses')[0]);
					var baseurl		= base_url +'index.php/'+ active_controller+'/proses_unposting';
					$.ajax({
						url			: baseurl,
						type		: "POST",
						data		: formData,
						cache		: false,
						dataType	: 'json',
						processData	: false, 
						contentType	: false,				
						success		: function(data){
							close_spinner();
							if(data.status == 1){
								alert(data.pesan);
								/*
								swal({
									  title	: "Save Success!",
									  text	: data.pesan,
									  type	: "success"
									});
								*/
								window.location.href = base_url +'index.php/'+ active_controller;
							}else{
								/*
								if(data.status == 2){
									
									
									swal({
									  title	: "Save Failed!",
									  text	: data.pesan,
									  type	: "warning"
									});
									
								}else{
									
									swal({
									  title	: "Save Failed!",
									  text	: data.pesan,
									  type	: "warning"
									});
									
								}
								*/
								alert(data.pesan);
								$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
								return false;
								
							}
						},
						error: function() {
							close_spinner();
							swal({
							  title				: "Error Message !",
							  text				: 'An Error Occured During Process. Please try again..',						
							  type				: "warning"
							});
							$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
							return false;
						}
					});
					
				} else {
					close_spinner();
					swal("Cancelled", "Data can be process again :)", "error");
					$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
					return false;
				}
		});
	});
	
	$(document).on('click','#btn-save',function(e){
		e.preventDefault();	
		calculate_posting('N');
	});
	
	$(document).on('click','#btn-save-current',function(e){
		e.preventDefault();	
		calculate_posting('Y');
	});
	
	function calculate_posting(kode_bulan){
		
		$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',true);
		let cabang		= $('#kode_cabang').val();
		//let tgl_pilih	= $('#periode_proses').val();
		
		$('#alert_error').empty();
		$('#list_error').hide();
		if(cabang == null || cabang =='' || cabang == '0'){
			swal({
			  title				: "Error Message !",
			  text				: 'Empty Branch. Please choose branch first ...',						
			  type				: "warning"
			});
			$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
			return false;
		}
		/*
		if(tgl_pilih == null || tgl_pilih =='' || tgl_pilih == '0'){
			swal({
			  title				: "Error Message !",
			  text				: 'Empty Period Process. Please choose period process first ...',						
			  type				: "warning"
			});
			$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
			return false;
		}
		*/
		swal({
			  title: "Are you sure?",
			  text: "You will not be able to process again this data!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Yes, Process it!",
			  cancelButtonText: "No, cancel process!",
			  closeOnConfirm: true,
			  closeOnCancel: false
			},
			function(isConfirm) {					
				if (isConfirm) {
					loading_spinner();
					var formData 	= new FormData($('#form-proses')[0]);
					var baseurl		= base_url +'index.php/'+ active_controller+'/proses_posting/'+kode_bulan;
					$.ajax({
						url			: baseurl,
						type		: "POST",
						data		: formData,
						cache		: false,
						dataType	: 'json',
						processData	: false, 
						contentType	: false,				
						success		: function(data){
							close_spinner();
							if(data.status == 1){											
								swal({
									  title	: "Save Success!",
									  text	: data.pesan,
									  type	: "success"
									});
								window.location.href = base_url +'index.php/'+ active_controller;
							}else{
								
								if(data.status == 2){
									$('#alert_error').html(data.pesan);
									$('#list_error').show();
									/*
									swal({
									  title	: "Save Failed!",
									  text	: data.pesan,
									  type	: "warning"
									});
									*/
								}else{
									swal({
									  title	: "Save Failed!",
									  text	: data.pesan,
									  type	: "warning"
									});
									
								}
								$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
								return false;
								
							}
						},
						error: function() {
							close_spinner();
							swal({
							  title				: "Error Message !",
							  text				: 'An Error Occured During Process. Please try again..',						
							  type				: "warning"
							});
							$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
							return false;
						}
					});
					
				} else {
					close_spinner();
					swal("Cancelled", "Data can be process again :)", "error");
					$('#btn-save, #btn-save-current, #btn-unpost, #btn-back').prop('disabled',false);
					return false;
				}
		});
	}
	
</script>
