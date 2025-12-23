<?php $this->load->view('header');?>
    <section class="content-header">
      <h1> Jadwal Invoice
       
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
				<form action="<?=base_url()?>index.php/invoice/list_inv" method="post">
				<div class="col-xs-2">PERIODE RESEPSI 
				</div>
				<div class="col-xs-2"> 
					<select type="text" name="tahun" class="form-control" onchange="this.form.submit()">
						<?php
						$tahun = @$this->input->post('tahun');
						if(empty($tahun)){
							$tahun = date("Y");
						}
						for($i=date("Y")-2;$i<=date("Y")+2;$i++){
							if($tahun == $i){
								echo "<option selected value='$i'>$i</option>";
							}else{
								echo "<option value='$i'>$i</option>";
							}
						}
						?>
					</select>
				</div>
				<div class="col-xs-2">
					<select type="text" name="bulan" class="form-control" onchange="this.form.submit()">
						<?php
						$nm_bulan = array('All','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						$bulan = $this->input->post('bulan');
						$uri_s3 	= $this->uri->segment(3);
						if($uri_s3 == 'month'){
							$bulan = date('m');
						} else if(!empty($post_bulan)){
							$bulan = 0;
						} 
						for($i=0;$i<=12;$i++){
							if($i==$bulan){
								echo "<option selected value='$i'>".$nm_bulan[$i]."</option>";	
							}else{
								echo "<option value='$i'>".$nm_bulan[$i]."</option>";	
							}
						}
						?>
					</select>
				</div>
				</form>
			</div>
            
			<div class="box-body">
			 <!--<a href="<?=base_url()?>index.php/order/input" class="btn btn-warning" >Tambah Prospek <i class="fa fa-plus"></i></a>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No.</th>
					  <th>No. Customer</th>
					  <th>Pemesan</th>
					  <th>Calon Pengantin</th>
					  <th>Alamat</th>
					  <th>Tanggal Resepsi</th>
					  <th>Total Deal</th>
					  <th>Sisa Bayar</th>
					  <th>Invoice</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_invoice > 0){
							$no=0;
							foreach($list_invoice as $row){
							$aaa = $this->invoice_model->get_tgl($row->id_prospek);
							$no++;
							if($aaa > 0){
								foreach($aaa as $row2){
									$tgl_resepsi = $row2->tanggal_respsi;
									
								}
							}
							$id_prospek = $row->id_prospek;
							$tot_bayar = $this->invoice_model->get_tot_bayar($id_prospek);
							$jum_bayar = $row->total_deal - $tot_bayar;
							if($jum_bayar >=0){
					?>
					<tr>
					  <td><?=$no?></td>
					  <td><?=$row->nocust?></td>
					  <td><?=$row->nama_pemesan_tunggal?></td>
					  <td><?=$row->pengantin_pria." & ".$row->pengantin_perempuan?></td>
					  <td><?=$row->alamat?></td>
					  <td><?=date("d M Y",strtotime($tgl_resepsi))?></td>
					  <td  align="right"><?= number_format($row->total_deal)?></td>
					  <td  align="right"><?php
						echo number_format($jum_bayar);
					  ?></td>
					  <td width="15%">
					  <a href="<?=base_url()?>index.php/invoice/list_detail/<?=$id_prospek?>" class="btn btn-primary" width="20%" >Detail <i class="fa fa-list"></i></a>
					  </td>
					</tr>
					<?php	}
							}
						}
					?>

				</tbody>
              </table>
            </div>
        </div>
        </div>
    </div>
	<div id="show_stock"><div>
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