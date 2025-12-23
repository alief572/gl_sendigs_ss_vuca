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
						
	</section>

	<section class="content-header">
    	<div class="row">
        	<div class="col-xs-12">
          		<div class="box">
            		<div class="box-header">
						<div class="box-body">
								<table>
									<tr>
										<td colspan="7" align="right"><b>-- DATA SETELAH DI EDIT --</b></td>						
									</tr>
									<tr>
										<td colspan="7" align="right"><b></b></td>						
									</tr>
									<tr>
										<td width="6%"><b>Nomor SPD</b></td>
										<td width="2%"><b> : </b></td>
										<td width="10%"><b><?=$id_penawaran?></b></td>
										<td width="10%"></td>
										<td width="7%"><b>ID Prospek</b></td>
										<td width="2%"><b> : </b></td>
										<td width="20%"><b><?=$id_prospek?></b></td>
									</tr>
									<tr>
										<td><b>Tgl. SPD</b></td>
										<td><b> : </b></td>
										<td><b><?=$tgl_spd?></b></td>
										<td></td>
										<td><b>Calon Pengantin</b></td>
										<td><b> : </b></td>
										<td><b><?=$penganten?></b></td>
									</tr>
								</table>
							</div>
						<div class="box-body">
            				<div class="box-body table-responsive no-padding">
              					<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr>
										<th>ID Barang</th>
										<th>Nama Barang</th>
										<th>Area Barang</th>
										<th>Qty</th>
										<th>Di Edit Oleh</th>
										<th>Jam</th>
										<th>Tanggal</th>
									<!--
										<th>ID Editor</th>
										<th>Editor</th>
										<th>Jabatan</th>
										<th>Waktu Edit</th>
									-->
									</tr>
								</thead>
								<tbody>
									<?php
									$no=0;
										if($data_after > 0){
											foreach($data_after as $row1){
												$no++;
												$wkt_edit = $row1->waktu_edit;
												$jam = substr($wkt_edit,11,8);
												$tgl_ = substr($wkt_edit,0,10);
												$tgl = date('d F Y', strtotime($tgl_));
								?>

									<tr>
										<td><?=$row1->id_barang?></td>
										<td><?=$row1->nm_barang?></td>
										<td><?=$row1->area?></td>
										<td><?=$row1->qty?></td>
										<td><?=$row1->nama_editor?></td>
										<td><?=$jam?></td>
										<td><?=$tgl?></td>
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
		</div>
    </div>
			<div id="show_stock"><div>
</section>

<section class="content-header">
    	<div class="row">
        	<div class="col-xs-12">
          		<div class="box">
            		<div class="box-header">
						<div class="box-body">
								<table>
									<tr>
										<td colspan="7" align="right"><b>-- DATA SEBELUM DI EDIT --</b></td>						
									</tr>
									<tr>
										<td colspan="7" align="right"><b></b></td>						
									</tr>
									<tr>
										<td width="6%"><b>Nomor SPD</b></td>
										<td width="2%"><b> : </b></td>
										<td width="10%"><b><?=$id_penawaran?></b></td>
										<td width="10%"></td>
										<td width="7%"><b>ID Prospek</b></td>
										<td width="2%"><b> : </b></td>
										<td width="20%"><b><?=$id_prospek?></b></td>
									</tr>
									<tr>
										<td><b>Tgl. SPD</b></td>
										<td><b> : </b></td>
										<td><b><?=$tgl_spd?></b></td>
										<td></td>
										<td><b>Calon Pengantin</b></td>
										<td><b> : </b></td>
										<td><b><?=$penganten?></b></td>
									</tr>
								</table>
							</div>
						<div class="box-body">
            				<div class="box-body table-responsive no-padding">
              					<table class="table table-bordered table-hover dataTable example1">
								<thead>
									<tr>
										<th>ID Barang</th>
										<th>Nama Barang</th>
										<th>Area Barang</th>
										<th>Qty</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no2=0;
										if($data_before > 0){
											foreach($data_before as $row2){
												$no2++;
									?>

									<tr>
										<td><?=$row2->id_barang?></td>
										<td><?=$row2->nm_barang?></td>
										<td><?=$row2->area?></td>
										<td><?=$row2->qty?></td>
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
/*
  $(function () {
    $(".example1").DataTable();
  });
*/
  
  	$(function () {
    $(".example1").DataTable(
			{
				"ordering": true, // Set true agar bisa di sorting
				"order": [[ 0, 'asc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
			}
		);
  });
  

</script>