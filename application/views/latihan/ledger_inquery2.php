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
			<div class="box-body">
			<form action="<?=base_url()?>index.php/Latihan2/list_coa" method="post">
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
				<button class="btn btn-warning btn-sm" onclick="return add_stock()">Tambah COA <i class="fa fa-plus"></i></button>
				<button class="btn btn-warning btn-sm" onclick="return print_bulanan()">print <i class=""></i></button>
				<a href="<?=base_url()?>index.php/Latihan2/update_tipe_coa/" onclick="" class='btn btn-warning btn-sm'>	update <i class=""></i></a>
			</div>
			 <div >
					</div>
            <!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
			<table class="table table-bordered table-hover dataTable example1">
			<thead>
									<tr>

																			
									<th>No perkiraan</th>
									<th>nama</th>
																		
									<th>Saldo Awal</th>
									<th>Debet</th>
									<th>Kredit</th>
									<th>Saldo Akhir</th>
																		
									</tr>
								    
									</thead>
									<tbody>
									<?php
									
									if($coa_lv3 > 0){
									foreach($coa_lv3 as $row){
																		
												$nokir_coa 	= $row->no_perkiraan;
												$nama_coa 	= $row->nama;
												$s_aw_coa	= $row->saldoawal;
												$debt3 = $row->debet;
		$kred3 = $row->kredit;
		$salakhir3=$s_aw_coa + $debt3 - $kred3;

									?>
									

<tr>
				
													<td><?=$nokir_coa?></td>
													<td><?=$nama_coa?></td>
													<td align="right"><?=number_format($s_aw_coa,0,',','.');?></td>
									<?php
									$cek_periode_aktif			= $this->Model_latihan2->cek_periode_aktif();
									if($cek_periode_aktif > 0){
										foreach($cek_periode_aktif as $row_periode_aktif){
											$tgl_periode_aktif	= $row_periode_aktif->periode;
											$bln_aktif			= substr($tgl_periode_aktif,0,2);
											$thn_aktif			= substr($tgl_periode_aktif,3,4);
										}
									}
							
										$awal=1;
										$akhir=31;
										$enol=0;
										if($bln_aktif > 9){
											$var_tgl_awal = $thn_aktif."-".$bln_aktif."-0".$awal;
											$var_tgl_akhir = $thn_aktif."-".$bln_aktif."-".$akhir;
										}else{
											$var_tgl_awal = $thn_aktif."-".$enol.$bln_aktif."-0".$awal;
											$var_tgl_akhir = $thn_aktif."-".$enol.$bln_aktif."-".$akhir;
										}
									?>
													<td align="right"><?=number_format($debt3,0,',','.');?></td>
													<td align="right"><?=number_format($kred3,0,',','.');?></td>
													<td align="right"><?=number_format($salakhir3,0,',','.');?></td>			
													<?php

													}
												 }
															
													?>
													</tr>
												
									</tbody>
            		</table>
					<div id="show_stock"></div>
					</div>

					<div class="box-body table-responsive no-padding">
			<table class="table table-bordered table-hover dataTable example2">
			<thead>
									<tr>

									<th></th>
									<th></th>
									<th></th>	
									<th>Total Debet</th>
									<th>Total Kredit</th>
									<th>Total Saldo Akhir</th>
												
									</tr>
								    
			</thead>
									<tbody>
									<tr>
									<td></td>
									<td></td>
									<td>Level 5</td>
<?php
$tot_debt_jur=0;
$tot_kred_jur=0;
$s_ak_jur=0;
$cek_periode_aktif			= $this->Model_latihan2->cek_periode_aktif();
if($cek_periode_aktif > 0){
	foreach($cek_periode_aktif as $row_periode_aktif){
		$tgl_periode_aktif	= $row_periode_aktif->periode;
		$bln_aktif			= substr($tgl_periode_aktif,0,2);
		$thn_aktif			= substr($tgl_periode_aktif,3,4);
	}
}

	$awal=1;
	$akhir=31;
	$enol=0;
	if($bln_aktif > 9){
		$var_tgl_awal = $thn_aktif."-".$bln_aktif."-0".$awal;
		$var_tgl_akhir = $thn_aktif."-".$bln_aktif."-".$akhir;
	}else{
		$var_tgl_awal = $thn_aktif."-".$bln_aktif."-0".$awal;
		$var_tgl_akhir = $thn_aktif."-".$bln_aktif."-".$akhir;
	}
									
$coa5 = $this->db->query("SELECT * FROM COA where level='5' and bln='$bln_aktif' and thn='$thn_aktif' ")->result();
	if($coa5 > 0){
				foreach($coa5 as $r_coa5){
						$nokir_coa5 = $r_coa5->no_perkiraan;
						$s_aw_coa5 = $r_coa5->saldoawal;
						$debt_coa5 = $r_coa5->debet;
						$kred_coa5 = $r_coa5->kredit;
						//$tot_s_aw_coa5 += $s_aw_coa5;
						$s_ak_coa = $s_aw_coa5 + $debt_coa5 - $kred_coa5;
						

$data_jurnal = $this->db->query("SELECT * FROM jurnal where no_perkiraan='$nokir_coa5' and tanggal between '$var_tgl_awal' and '$var_tgl_akhir' ")->result();

	if($data_jurnal > 0){
				foreach($data_jurnal as $r_jur){
					$debt_jur = $r_jur->debet;
					$kred_jur = $r_jur->kredit;
					$tot_debt_jur += $debt_jur;
					$tot_kred_jur += $kred_jur;
					$s_ak_jur += $s_ak_coa; 
				}
			}
		}
	}
?>
									

	
	<td align="right"><?=number_format($tot_debt_jur,0,',','.');?></td>
	<td align="right"><?=number_format($tot_kred_jur,0,',','.');?></td>
	<td align="right"><?=number_format($s_ak_jur,0,',','.');?></td>

</tr>

												
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
    $(".example1").DataTable(
		{
				"ordering": true, // Set true agar bisa di sorting
				"order": [[ 0, 'asc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			}
	);
  });

	
  function add_stock(){
		
	$.get( "<?= base_url(); ?>index.php/Latihan2/add_stock" , { option : "" } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit_stock(id){
	$.get( "<?= base_url(); ?>index.php/Latihan2/edit_stock" , { option :id } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
	function update(){
	$.get( "<?= base_url(); ?>index.php/Latihan2/update_tpe_coa" , { option :id } , function ( data ) {
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
	
  function print_bulanan(){
		
		$.get( "<?= base_url(); ?>index.php/Latihan2/print_bulanan" , { option : "" } , function ( data ) {
			$( '#show_stock' ) . html ( data ) ;
			$('#myModal').modal('show');
		} ) ;
		}</script>