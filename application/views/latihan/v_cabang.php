<?php $this->load->view('header');?>
<section class="content-header">
      <h1>
       <?=$judul?> <?=$this->session->userdata('pn_name')?>
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
			    	<!-------/. chart ---------->
	
					<div class="container">
							 <div class="col-xs-2">
									
							 
									
			  			 </div>	
							
				  </div>
	
										
            <!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered table-hover dataTable example1">
								<thead>
											<tr>

																			
													<th >No Cabang</th>
													<th >Sub Cabang</th>
													<th >Area</th>
													<th >SKPID</th>
													<th >Kode Cabang</th>
													<th >No Faktur</th>
													<th >No Customer</th>		
													<th >No Sales</th>
													<th >Last Update</th>
													<th >Perusahaan</th>		
													<th >Alamat</th>
													<th >Nama Cabang</th>
													<th >Kabag Penjual</th>		
													<th>Kepala Cabang</th>	
                                                    <th>Adm Cabang</th>		
                                                    <th>Gudang</th>						
											</tr>
								</thead>
										<tbody>
                    
                                        <?php
                                        $i=0;
                                        if($data_cabang >0) {
                                                foreach($data_cabang as $row){
                                            $i++;
                                        ?>
                                                            
<tr>
	<td><?= $row->nocab?></td>
	<td><?= $row->subcab?></td>

	<td><?= $row->cabang?></td>
	<td><?= $row->spkid?></td>
	<td><?= $row->kdcab ?></td>
	<td><?= $row->nofak?></td>
	<td><?= $row->nocust?></td>
	<td><?= $row->nosales?></td>
	<td><?= $row->lastupdate?></td>
	<td><?= $row->kepala?></td>
	<td><?= $row->alamat?></td>
	<td><?= $row->namacabang?></td>
	<td><?= $row->kabagjualan?></td>
	<td><?= $row->kepalacabang?></td>
    <td><?= $row->admcabang?></td>
	<td><?= $row->gudang?></td>
    <td>

					<a href="<?=base_url()?>index.php/Latihan/edit_cbg/"   
					target="blank" class="btn btn-primary btn-sm" width="20%" ><i class="">Edit</i></a>	

					<a href="<?=base_url()?>index.php/Latihan/delete_cabang/<?= $row->id?>" class='btn btn-danger btn-sm'>
					Hapus <i class="fa fa-eraser"></i>
					 </a>				
						
				    
                   	  
    </td>
</tr>

<?php
														}
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
<!-- Charts -->

-->
<!-- SlimScroll -->

<script type="text/javascript">
  $(function () {
    $(".example1").DataTable();
  });

	function edit_cabang(id){
	$.get( "<?= base_url(); ?>index.php/Latihan/edit_cab" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
	
	} ) ;
  }

	
        </script>