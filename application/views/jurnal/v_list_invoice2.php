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
				<form action="<?=base_url()?>index.php/jurnal/list_dana_masuk" method="post">
				<div class="col-xs-2">PERIODE RESEPSI <br><br>
					<a href="<?=base_url()?>index.php/jurnal/list_dana_masuk" class="btn btn-warning">Tampilkan yang sudah bayar</a>
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
				<div class="col-xs-2">
					<!--<a href="<?=base_url()?>index.php/jurnal/dana_masuk" class="btn btn-success">Input Dana Masuk Lain-lain</a> -->
				</div>
			</div>
            
			<div class="box-body">
			 <!--<a href="<?=base_url()?>index.php/order/input" class="btn btn-warning" >Tambah Prospek <i class="fa fa-plus"></i></a>
            </div>-->
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <!-- <th>No.</th> -->
						<th>No.Invoice</th>
					  <th>Project</th>
					  
					  <th>Due Date</th>
					  <th>Ditagihkan Kepada</th>
					  <th>Status Bayar</th>
						<th>Total Tagihan</th>
						 <!--
					  <th>Tanggal Bayar</th>
					  <th>Metode Pembayaran</th>
					 
					  <th>Via Bank</th>
					  <th>Ke Rekening</th>
						-->
					  <th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i=0;
						if($list_invoice > 0){
							$no=0;
							foreach($list_invoice as $row){
							$no++;
							$id_prospek = $row->id_prospek;
							$check_ = $this->invoice_model->check($row->bayar_no,$row->id_prospek);
					?>
				
					<tr>
					  <!-- <td><?=$no?>.</td> -->
						<td><?=$row->invoice_no?></td>
					  <td><?=$row->id_penawaran?></td>
					  
					  <td><?=date("d-M-Y",strtotime($row->due_date))?></td>
					  <td><?=$row->billed_to?></td>
					  <td><?php if($row->bayar > 0){echo "LUNAS";}else{echo "BELUM LUNAS";}?></td>
						<td><?=number_format($row->total,0,",",".")?></td>
						<!--
					  <td><?=(empty($row->tanggal_bayar)) ? "" : date("d-M-Y",strtotime($row->tanggal_bayar));?></td>
					  <td><?=$row->bayar_via?></td>
					  
					  <td><?=$row->bank?></td>
					  <td><?=$row->norek?></td>
						-->
					  <td width="16%">
					<?php
						if($row->bayar == 0){
							if($check_ == 0){
						?>
								<a href="<?=base_url()?>index.php/invoice/view_invoice/<?=$row->id_prospek?>/<?=$row->bayar_no?>" class="btn btn-primary btn-sm" width="20%" title='Create Invoice'><i class="fa fa-calendar-o"></i></a>
						<?php
							}else{
						?>
								<a href="<?=base_url()?>index.php/jurnal/payment/<?=$row->invoice_no?>" class="btn btn-warning btn-sm" width="20%" title='Payment'><i class="fa fa-money"></i></a>

								<a href="<?=base_url()?>index.php/invoice/edit_invoice/<?=$row->invoice_no?>" class="btn btn-primary btn-sm" width="20%" title='Edit Invoice'><i class="fa fa-edit"></i></a>

					  			<a href="<?=base_url()?>index.php/invoice/print_invoice2/<?=$row->id_prospek."/".$row->bayar_no?>" class="btn btn-success btn-sm" width="20%" title='Print Invoice'><i class="fa fa-print"></i></a>
								<?php
								if($this->session->userdata('pn_jabatan')=="0" && $row->invoice_no !=''){//hanya admin yang bisa batal
									?>
									<a href="<?=base_url()?>index.php/invoice/cancel/<?=$row->invoice_no."/".$row->id_prospek?>" class="btn btn-danger btn-sm" width="20%" title='Batal'><i class="fa fa-close"></i></a>
									<?php
								}
							}
						}

						if($this->session->userdata('pn_jabatan')=="0" && $row->bayar !=''){//hanya admin yang bisa edit
						?>
							<a href="<?=base_url()?>index.php/jurnal/payment/<?=$row->invoice_no?>" class="btn btn-info btn-sm" width="20%" title='Edit Payment'><i class="fa fa-edit"></i></a>

					  		<a href="<?=base_url()?>index.php/invoice/print_invoice2/<?=$row->id_prospek."/".$row->bayar_no?>" class="btn btn-success btn-sm" width="20%" title='Print Invoice'><i class="fa fa-print"></i></a>

					  		<a href="<?=base_url()?>index.php/invoice/print_receipt/<?=$row->id_prospek."/".$row->bayar_no?>" class="btn btn-primary btn-sm" width="20%" title='Print Kwitansi'><i class="fa fa-print"></i></a>
						<?php
						}
						?>
					  </td>
					</tr>
					<?php
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
    $(".example1").DataTable(
			{
				"ordering": true, // Set true agar bisa di sorting
				"order": [[ 0, 'desc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			}
		);
  });
</script>