<?php $this->load->view('header');?>
<!-- chart -->
<script src="<?=base_url()?>assets/js/jquery.js"></script>
<script src="<?=base_url()?>assets/js/highcharts.js"></script>
<!-- endchart -->

    <section class="content-header">
      <h1>
        <?=$this->session->userdata('pn_name')?>
      </h1>
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
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			    <div class="box-body">
			        <form action="<?=base_url()?>index.php/Latihan/list_account" method="post">
				        <div class="col-xs-2">
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
               
				    </form> 
						<a href="<?=base_url()?>index.php/latihan2/view_excel" class="btn btn-warning">eksport to excel</a>

			   </div>
	

										
            <!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
								<thead>
											<tr>

																			
													<th >No perkiraan</th>
													<th >nama</th>
													<th >Januari</th>
													<th >Februari</th>
													<th >Maret</th>
													<th >April</th>
													<th >Mei</th>		
													<th >Juni</th>
													<th >Juli</th>
													<th >Agustus</th>		
													<th >September</th>
													<th >Oktober</th>
													<th >November</th>		
													<th>Desember</th>							
											</tr>
								</thead>
										<tbody>
										<?php
									if($data_accound > 0){
									foreach($data_accound as $row){
									$nokir = $row->no_perkiraan; //1101-00-00
										//$nokir_=substr($nokir,0,4); //1101
									$namkir= $row->nama;
										
									$jan=$row->jan;
									$feb=$row->feb;
									$mart=$row->mart;
									$apr=$row->apr;
									$mei=$row->mei;
									$jun=$row->jun;
									$jul=$row->jul;
									$agt=$row->agt;
									$sept=$row->sept;
									$okt=$row->okt;
									$nov=$row->nov;
									$des=$row->des;
										
										?>
<tr>
	<td><?=$nokir?></td>
	<td><?=$namkir?></td>

	<td><?=$jan?></td>
	<td><?=$feb?></td>
	<td><?=$mart?></td>
	<td><?=$apr?></td>
	<td><?=$mei?></td>
	<td><?=$jun?></td>
	<td><?=$jul?></td>
	<td><?=$agt?></td>
	<td><?=$sept?></td>
	<td><?=$okt?></td>
	<td><?=$nov?></td>
	<td><?=$des?></td>
</tr>
<?php
		}
	}else{
		echo "<script>alert('DATA TIDAK ADA !')</script>";
	}
?>
										
										</tbody>
              			</table>
										</div>
									<div id="show_stock"></div>
						</div>
					</div>
				</div>
			</div>
	</section>
	
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->


<script type="text/javascript">
  $(function () {
    $(".example1").DataTable();
  });

	
        </script>