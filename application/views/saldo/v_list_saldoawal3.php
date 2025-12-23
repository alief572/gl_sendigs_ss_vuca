<?php $this->load->view('header');?>
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
			        <form action="<?=base_url()?>index.php/Latihan/list_saldo" method="post">
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
                <div class="col-xs-2">
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
				    </form>
                    <button class="btn btn-warning btn-sm" onclick="return tambah_saldo()">Tambah Saldo <i class="fa fa-plus"></i></button>
					<a href="<?=base_url()?>index.php/latihan2/posting_saldoawal2" class="btn btn-warning">Posting Saldo</a>
				 <!-- 	<button class="btn btn-warning btn-sm" onclick="return posting()">Posting Saldo<i class="fa fa-plus"></i></button> -->				
    
			    </div>
										<div >

					                    </div>
            <!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
								<thead>
											<tr>

																			
													<th rowspan='2'>No perkiraan</th>
													<th rowspan='2'>nama</th>
																		
													<th rowspan='2'>kode cabang</th>
													<th rowspan='2'>Saldo Awal</th>
													<th rowspan='2'>Bulan</th>
													<th rowspan='2'>Tahun</th>
													<th rowspan='2'>Level</th>					
											</tr>
											<tr>

																			
													<td>Aksi</td>

											</tr>
								</thead>
										<tbody>
												<?php
													$i=0;
													if($data_saldo > 0){
													foreach($data_saldo as $row){
													$i++;
										        ?>

											<tr>
																				
                                            
																				<td><?=$row->no_perkiraan?></td>
																				<td><?=$row->nama?></td>
																				<td><?=$row->kdcab?></td>
																				<td><?=$row->saldoawal?></td>
																				<td><?=$row->bln?></td>
																				<td><?=$row->thn?></td>
																				<td><?=$row->level?></td>
																				
																				
																				
															
																			
													<td>
                               				 <button class='btn btn-primary btn-sm' onclick="return edit_saldo(<?=$row->id?>)">Edit <i class="fa fa-edit"></i>
																				</button>
																				<a href="<?=base_url()?>index.php/Latihan/print_saldo/<?=$row->id?>" title="Print Semua Item"  target="blank" class="btn btn-info" width="20%" ><i class="fa fa-print"></i></a>

													</td>
											</tr>
												<?php
														}
															}
												?>

										</tbody>
              			</table>
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
<script>
   $(function () {
    $(".example1").DataTable();
  });

	
  function tambah_saldo(){
		
	$.get( "<?= base_url(); ?>index.php/Latihan/tambah_saldo" , { option : "" } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit_saldo(id){
	$.get( "<?= base_url(); ?>index.php/Latihan/edit_saldo" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }

	
  function validasi_hapus(){
	  var dd = confirm("hapus data ?");
	  if(dd == false){
		  return false;
	  }
  }
	function posting(id){
	$.get( "<?= base_url(); ?>index.php/Latihan/posting_saldoawal2" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }

	
  function print_bulanan(){
		
		$.get( "<?= base_url(); ?>index.php/Latihan/print_bulanan" , { option : "" } , function ( data ) {
			$( '#show_stock' ) . html ( data ) ;
			$('#myModal').modal('show');
		} ) ;
		}</script>