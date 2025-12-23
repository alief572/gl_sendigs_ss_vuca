
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
<section class="content">     
	<div class="row">
		<div class="col-lg-12 col-xs-12">
			<form method="post" action="<?=base_url()?>index.php/latihan/proses_input_jvcost" id="form-proses-bro"> 
			
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title"></h3>		
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group row">
							<label class="control-label col-sm-2">No JV</label>
							<div class="col-sm-4">
								<span class="badge bg-maroon">Otomatis System</span>
							</div>
							<label class="control-label col-sm-2">Tgl Input</label>
							<div class="col-sm-4">
														<!-- TGL INPUT -->
								<input type="hidden" class="form-control" size='1' id="datepicker1" format="yy-mm-dd" data-date-format="yyyy-mm-dd" name="tanggal" value="<?=date("Y-m-d")?>">
								<input type="text" class="form-control" size='1' id="datepicker" readonly name="tanggal_tampil" value="<?=date('d-m-Y')?>">
								<!-- TGL KWITANSI -->
														</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Periode</label>
							<div class="col-sm-2">
								<input type="text" class="form-control input-sm" name="bulan" id="bulan" readonly autocomplete="off" value="<?=date('m')?>">
							</div>
                            <div class="col-sm-2">
								<input type="text" class="form-control input-sm" name="tahun" id="tahun" readonly autocomplete="off" value="<?=date('Y')?>">
							</div>
							<label class="control-label col-sm-2">Koreksi Data No</label>
							<div class="col-sm-4">
								<textarea cols="75" rows="2" class="form-control input-sm" name="koreksi" id="koreksi"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-sm-2">Kode Cabang</label>
							<div class="col-sm-4">
								<select name="kode"  id="kode"  class="form-control input-sm">
									<option value=""> -- Kode Cabang --</option>
                                    <?php
					  	if($data_cabang > 0){
							foreach($data_cabang as $row_cbg){
								$no_cab		= $row_cbg->nocab;
								$sub_cab	= $row_cbg->subcab;
								$kd_cab		= $no_cab."-".$sub_cab;
								
								echo "<option value='".$kd_cab."'>".$kd_cab."</option>";
								
								//<input type="text" class="form-control" id="kdcab" name='kdcab' placeholder="Masukan Kode" value="">
							}
						}
					  ?>
								</select>
							</div>
							<label class="control-label col-sm-2">No. Cek/Giro</label>
							<div class="col-sm-4">
								<div class="btn-group">
									<select name="trans"  id="trans"  class="form-control input-sm">
										<option selected>-Metode Pembayaran-</option>
										<option value="Cash">Cash</option>
										<option value="Check">Check</option>
										<option value="BG">BG</option>
										<option value="Transfer">Transfer</option>
									</select>
									
									
								</div>

             			
							</div>
						</div>
											
					</div>
					<label class="control-label col-sm-2">Keterangan</label>
							<div class="col-sm-4">
														<!-- TGL INPUT -->
								<input type="text" class="form-control input-sm" size='1' id="ket" name="ket" value="">
								<!-- TGL KWITANSI -->
														</div>
					<div class="box-body">
						<!--<div class="box box-warning">-->
							<div class="box-header">
								<h3 class="box-title">Detail Transaction</h3>		
							</div>
							<!-- /.box-header -->
							<!--<div class="box-body" style="overflow-x:scroll;">	-->							
								<table class="table table-bordered table-striped">
									<thead>
										<tr class="bg-blue">
											<th class="text-center">No Perkiraan</th>
											<th class="text-center">Keterangan</th>
											
											<th class="text-center">Debet</th>
											<th class="text-center">Kredit</th>
										</tr>
									</thead>
									<tbody id="list_detail">
										<tr id="tr_1">
											<td>
              <select type="text" name="project" class="form-control" id = "project" onchange="changeValue(this.value)">
			<option value="">- No.Perkiraan -</option>
			<?php
											if($data_nokir1 > 0 ){
							
									foreach($data_nokir1 as $row_nokir){
									$nokir = $row_nokir->no_perkiraan;
									$nama = $row_nokir->nama;
									
									echo "<option value='".$nokir."'>".$nokir." ".$nama."</option>";	
												}
											}
										
											?>
           			</select>
			</td>
			<td id="nama_td">
			<input type="text" class="form-control input-sm" id="nama" name="nama" placeholder=" " readonly>
			</td>

               
            
			<td>
			<input type="text" class="form-control input-sm" id="debet" name="debet" placeholder="" value="" onkeyup="copytextbox();" />
			
			</td>
											
			<td>
			<input type="text" class="form-control input-sm" id="kredit" name="kredit" placeholder="" value="" onkeyup="copytextbox1();" />									
			</td>
			
			</tr>
			</tbody>
			<tfoot>
			<tr class="bg-gray">
			<td colspan="2" class="text-center"><b>Grand Total</b></td>
			<td>
			<input type="text" class="form-control input-sm" name="totaldeb" id="totaldeb" value="" readOnly>
			</td>
            <td>
			<input type="text" class="form-control input-sm" name="totalkret" id="totalkret" readOnly>
			</td>
			<td></td>
			</tr>
			</tfoot>
			</table>								
							<!--</div><div class="box-body" style="overflow-x:scroll;">-->
						<!--</div> <div class="box box-warning">-->
		</div>
	<div class="box-footer">
						<input type="submit" name="submit" value="Save" class='pull-left btn btn-success' onclick="return check()">
						<a href="<?=base_url()?>index.php/jurnal/list_dana_keluar" class="btn btn-danger">KEMBALI</a>
					</div>
				</div>
				
		</div>
	</div>
</section>					
									

<?php $this->load->view('footer');?>

<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>
<script src="<?=base_url();?>dist/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>

<script type="text/javascript">
	function check(){
		if($("#project").val()=="0"){
			alert("Silahkan Pilih Project");
			return false;
		}
	}

	function changeValue(id){
		$.get( "<?= base_url(); ?>index.php/Latihan/cetak_nokir1" , { option : id } , function ( data ) {
		$( '#nama_td' ) . html ( data ) ;
		} ) ;
	}

	function changedebet(){
	var debet1 =$('#debet').val();
	document.getElementById("totaldeb").value()=$('#debet').val();
	}
	function changekredit(){
		var kredit2 =$('#kredit').val();
		document.getElementById("totalkret").value()=$('#kredit').val();
	}
	function copytextbox() {
    document.getElementById('totaldeb').value = document.getElementById('debet').value;
}
function copytextbox1() {
    document.getElementById('totalkret').value = document.getElementById('kredit').value;
}


</script>

	
