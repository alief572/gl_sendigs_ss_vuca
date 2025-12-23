<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Print Bulanan</h4>
			</div>
			<div class="box-body table-responsive no-padding">
			<form method='post' action="<?=base_url().'index.php/Latihan/proses_print_bln';?>" enctype="multipart/form-data">
					
					<div class="form-group has-success col-lg-6"  id="c_user_id">
					<select type="text" name="thn" class="form-control" onchange="this.form.submit()">
						<?php
						$thn = @$this->input->post('thn');
						if(empty($thn)){
							$thn = date("Y");
						}
						for($i=date("Y")-2;$i<=date("Y")+2;$i++){
							if($thn == $i){
								echo "<option selected value='$i'>$i</option>";
							}else{
								echo "<option value='$i'>$i</option>";
							}
						}
						?>
					</select>
					</div>
					<div class="form-group has-success col-lg-6"  id="c_name">
					<select type="text" name="bln" class="form-control" onchange="this.form.submit()">
						<?php
						$nm_bulan = array('All','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						$bln = $this->input->post('bln');
						$uri_s3 	= $this->uri->segment(3);
						if($uri_s3 == 'month'){
							$bln = date('m');
						} else if(!empty($post_bulan)){
							$bln = 0;
						} 
						for($i=0;$i<=12;$i++){
							if($i==$bln){
								echo "<option selected value='$i'>".$nm_bulan[$i]."</option>";	
							}else{
								echo "<option value='$i'>".$nm_bulan[$i]."</option>";	
							}
						}
						?>
					</select>

					</div>
					
		
						<div class="form-group has-success btn-group col-lg-6"></div>
						<div class="form-group has-success col-lg-6"  id="c_">
						<input type="submit" name="submit" value="Print" class='pull-right btn btn-success'>
					</div>
				</form>	
				<!-- /.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>

