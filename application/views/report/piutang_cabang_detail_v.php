<?php $this->load->view('header');?>
    <section class="content-header">
      <h1>
       <?=$judul?> <?=$this->session->userdata('')?>
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
			
			<form action="<?=base_url()?>index.php/piutang_cabang_c/detail_cabang/<?=$kdcab?>" method="post">
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
					&nbsp;&nbsp;&nbsp;
				
				</div>
				</form>
				<button class="btn btn-warning btn-sm" onclick="return print_bulanan()">Print Data <i class=""></i></button>
				<a href="<?=base_url()?>index.php/Latihan/excel_stok_mobil/" title="Print Semua Item"  target="blank" class="btn btn-info btn-sm" width="" >EXPORT TO EXCEL<i class=""></i></a>

			</div>
		<div >
					</div>
            <!-- /.box-header -->
						<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr>									
										<th >No. Invoice</th>
										<th >Tgl. Invoice</th>
										<th >Customer</th>
										<th >Umur</th>
										<!-- <th >Total Invoice</th> -->
										<th >SALDO AWAL</th>
										<th >DEBET</th>
										<th >KREDIT</th>
										<th >SALDO AKHIR</th>
										<th >< =15</th>										
										<th >16-30</th>
										<th >31-60</th>
										<th >61-90</th>	
                                        <th >>90</th>								
									</tr>
									
								</thead>
								<tbody>
									
                                <?php
										 $i=0;
								 if($piutang_cab > 0){
										foreach($piutang_cab as $row){	
											
                                ?> 
									<tr>										
										<td align="right"><?=$row->nomor_invoice?></td>
										<td align="right"><?=$row->tanggal_invoice?></td>
										<td align="right"><?=$row->customer?></td>
										<td align="right"><?=$row->umur?></td>
                                        <td align="right"><?=number_format( $row->saldo,0,',','.');?></td>									
										<td align="right"><?=number_format( $row->debet,0,',','.');?></td>
                                        <td align="right"><?=number_format( $row->kredit,0,',','.');?></td>
                                        <td align="right"><?=number_format($row->saldo_akhir,0,',','.');?></td>
									
                                        <td align="right"><?=number_format($row->ab,0,',','.');?></td>	
										<td align="right"><?=number_format($row->ac,0,',','.');?></td>
										<td align="right"><?=number_format($row->ad,0,',','.');?></td>
                                        <td  align="right"><?=number_format($row->ae,0,',','.');?></td>
										<td align="right"><?=number_format($row->af,0,',','.');?></td>
									</tr>
										
                                   <?php								
								}
							}                           
                                   ?>
						</tbody>
              				</table>
						<div id="show_stock"></div>
				   </div>
				   <div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
								<tr>									
										<td><a href="<?=base_url()?>index.php/piutang_cabang_c/piutang_cabang/" title=""  target="blank" class="btn btn-info btn-sm" width="" >KEMBALI</a>
</td>		
										<td width="18%"></td>
										<td width="4%"> </td>
										<td width="10%"></td>						
									</tr>
									
								
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
</script>