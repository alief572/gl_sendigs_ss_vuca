<?php
$tampilkan = @$this->input->get('tampilkan');
if($tampilkan!='View Excel') {
	$this->load->view('header');?>
	<section class="content-header">
	  <h1><?=$judul?></h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?=$judul?></li>
	  </ol>
	</section>

	<section class="content-header">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
			  <form method="get" action="<?=base_url()?>index.php/report/umur_piutang" autocomplete="off">
              <table class="table table-bordered">
				<tr>
					<td width="25%" align="right"><b>Sampai dengan tanggal</b></td>
					<td>
					<?php
					$nm_bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
					echo date("d") .' '. $nm_bulan[date("n")].' '. date("Y")?>
					<input type="hidden" name="bulan" readonly value="<?=date("n")?>" />
					<input type="hidden" name="tahun" readonly value="<?=date("Y")?>" /></td>
				</tr>
				<tr>
					<td width="25%" align="right"><strong>Rekap</strong></td>
					<td><input type="checkbox" name="rekap" id="rekap" value="rekap" <?=(isset($rekap) ? ' checked': '')?> onclick="checked_customer()" /></td>
				</tr>
				<tr id="row_id_klien">
					<td width="25%" align="right"><b>Customer</b></td>
					<td>
					 <?php
					//$datklien[0]	= 'Select Customer';
					echo form_dropdown('id_klien',$datklien, set_value('id_klien', isset($id_klien) ? $id_klien : 0), array('name'=>'id_klien','id'=>'id_klien','class'=>'form-control id_klien'));
					?>
					</td>
				</tr>
				<tr>
					<td width="25%" align="right"></td>
					<td align="left">
						<input type="submit" name="tampilkan" value="Tampilkan" onclick="return check()" class="btn btn-success pull-center">
						<input type="submit" name="tampilkan" value="View Excel" onclick="return check()" class="btn btn-success pull-center">
					</td>
				</tr>
				</table>
			  </form>
			</div>
		  </div>
		</div>
	</section>
<?php } ?>
	<section class="content-header">
		<div class="col-xs-12">
			<div class="box">
				<div class="row">
					<div class="box-header">
						<div class="box-body">
						<?php if(!empty($data_ar)){
							if ($rekap=='rekap') { ?>
							<div class="box-body table-responsive no-padding">
							<table class="table table-bordered table-hover dataTable example1">
							<tbody>
							<tr>
								<td align=center>Kode Customer</td>
								<td align=center>Nama Customer</td>
								<td align=center>0-30 hari</td>
								<td align=center>31-60 hari</td>
								<td align=center>61-90 hari</td>
								<td align=center>91-120 hari</td>
								<td align=center>>120 hari</td>
								<td align=center>Jumlah</td>
							</tr>
							<?php
								$total_all_array=array(0,0,0,0,0,0);
								foreach($data_ar as $row){
									$total_row_array=array(0,0,0,0,0);
									$umurpiutang=0;
									$total_row=0;
									$id_klien	= $row->id_klien;
									$nama_klien	= $row->nama_klien;
							?>
							<tr>
								<td><a href="?bulan=<?=date('n')?>&tahun=<?=date('Y')?>&id_klien=<?=$id_klien?>" target="_blank" title="Detail Invoice"><?=$id_klien?></a></td>
								<td><?=$nama_klien?></td>
								<?php
								for($i=0;$i<5;$i++){
									$nilai=$row->{'umur_'.$i};
									echo '<td align=right>'.number_format($nilai).'</td>';
									$total_row=$nilai;
									$total_all_array[$i]=($total_all_array[$i]+$total_row);
								}
								echo '<td align=right>'.number_format($total_row).'</td>';
								$total_all_array[5]=($total_all_array[5]+$total_row);
								?>
							</tr>
							<?php } ?>
						<tr>
							<td colspan="2"><b>TOTAL</b></td>
							<?php
							foreach($total_all_array as $nilai){
								echo '<td align=right>'.number_format($nilai).'</td>';
							}
							?>
						</tr>

						</tbody>
						</table>
						</div>

							<?php }else{ ?>
							<div class="box-body table-responsive no-padding">
							Kode Customer: 	<?=$data_ar[0]->id_klien?><br />
							Nama Customer: 	<?=$data_ar[0]->nama_klien?>

							<table class="table table-bordered table-hover dataTable example1">
							<tbody>
							<tr>
								<td align=center>Tgl. Bukti</td>
								<td align=center>No. Bukti</td>
								<td align=center>0-30 hari</td>
								<td align=center>31-60 hari</td>
								<td align=center>61-90 hari</td>
								<td align=center>91-120 hari</td>
								<td align=center>>120 hari</td>
								<td align=center>Jumlah</td>
							</tr>
							<?php
								$total_all_array=array(0,0,0,0,0,0);
								foreach($data_ar as $row){
									$total_row_array=array(0,0,0,0,0);
									$umurpiutang=0;
									$total_row=0;
									$no_invoice	= $row->no_invoice;
									$tgl_invoice	= $row->tgl_invoice;
									$saldo_awal	= $row->saldo_awal;
									$debet	= $row->debet;
									$kredit	= $row->kredit;
									$saldo_akhir	= $row->saldo_akhir;
									$umurpiutang=(strtotime(date("Y-m-d"))-strtotime($tgl_invoice));
									if($umurpiutang<=30){
										$total_row_array=array($saldo_akhir,0,0,0,0);
										$total_all_array[0]=($total_all_array[0]+$saldo_akhir);
									}
									if($umurpiutang>30 && $umurpiutang<=60){
										$total_row_array=array(0,$saldo_akhir,0,0,0);
										$total_all_array[1]=($total_all_array[1]+$saldo_akhir);
									}
									if($umurpiutang>30 && $umurpiutang<=60){
										$total_row_array=array(0,0,$saldo_akhir,0,0);
										$total_all_array[2]=($total_all_array[2]+$saldo_akhir);
									}
									if($umurpiutang>60 && $umurpiutang<=120){
										$total_row_array=array(0,0,0,$saldo_akhir,0);
										$total_all_array[3]=($total_all_array[3]+$saldo_akhir);
									}
									if($umurpiutang>120){
										$total_row_array=array(0,0,0,0,$saldo_akhir);
										$total_all_array[4]=($total_all_array[4]+$saldo_akhir);
									}
							?>
							<tr>
								<td><?=$tgl_invoice?></td>
								<td><?=$no_invoice?></td>
								<?php
								foreach($total_row_array as $nilai){
									echo '<td align=right>'.number_format($nilai).'</td>';
									$total_row=$nilai;
								}
								echo '<td align=right>'.number_format($total_row).'</td>';
								$total_all_array[5]=($total_all_array[5]+$total_row);
								?>
							</tr>
							<?php } ?>
						<tr>
							<td colspan="2"><b>TOTAL</b></td>
							<?php
							foreach($total_all_array as $nilai){
								echo '<td align=right>'.number_format($nilai).'</td>';
							}
							?>
						</tr>

						</tbody>
						</table>
						</div>
						<?php }
						}	?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php
if($tampilkan!='View Excel') {
	$this->load->view('footer');?>
	<script>
		function check(){
		}

		function checked_customer(){
			if(document.getElementById('rekap').checked) {
				$("#row_id_klien").hide();
			} else {
				$("#row_id_klien").show();
			}
		}
		<?=(isset($rekap) ? ' checked_customer();': '')?>
	</script>
<?php } ?>
