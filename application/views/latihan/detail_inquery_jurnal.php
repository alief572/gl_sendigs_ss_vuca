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
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<div class="box-body">
			</div>
			 <div >
					</div>
                      <!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
								<table class="table table-bordered table-hover dataTable example1">
										<thead>
										    <tr>
											<th >Jurnal</th>
                                            </tr>
                                           
                                            <tr>
                                            
												<td >Nomor</td>
												<td>Tipe</td>
												<td>Tanggal</td>
												<td>Keterangan</td>
												<td>No.Rff</td>
												<td>Debet</td>
												<td>Kredit</td>
												<td></td>
                                                
											</tr>
											<?php
									if($list_lev6 > 0){
									foreach($list_lev6 as $row3){
												
												$nokir3 = $row3->no_perkiraan;
												
										$debet3 = $row3->debet;
										$kredit3= $row3->kredit;	
                                       
                                        ?>
                                            <tr>
																				
                    <td><?=$row3->nomor?></td>
                    <td><?=$row3->tipe?></td>
                    <td><?=$row3->tanggal?></td>
										<td><?=$row3->keterangan?></td>
										<td><?=$row3->no_reff?></td>
										<td align="right" width="12%"><?=number_format($debet3,0,',','.');?></td>
										<td align="right" width="12%"><?=number_format($kredit3,0,',','.');?></td>
										<td></td>
                                       
										<?php 
										}
                                 										
										}
										?>
                                        </tr>                                   
                                                                         
										</thead>

                                            </tr>

										</thead>

									<tbody>
										
											
									</tbody>
              					</table>
												<a href="<?=base_url()?>index.php/Latihan/list_ledq/" title=""  target="blank" class="btn btn-info" width="20%" ><i>Back</i></a>
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
</script>