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
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
			<form method="post" action="<?=base_url()?>index.php/order/edit_tambah_new">
				<input type="hidden" name="id_aju" value="<?=$this->uri->segment(3);?>">
				<table class="table table-bordered table-striped">
				<?php 
				foreach($data_barang as $row2){
					$nama_aju 		= $row2->insert_by;
					$tgl_aju 		= $row2->tgl_aju;
					$id_supplier 	= $row2->id_supplier;
				}
				?>
				<tr>
					<td><b>Tanggal Pengajuan</b></td>
					<td><?=date("d F Y",strtotime($tgl_aju))?></td>
					<td><b>Diajukan Oleh</b></td>
					<td><?=$nama_aju?></td>
				</tr>
				<tr>
					<td><b>No. Aju</b></td>
					<td>
					<?php echo $this->uri->segment(3);?>
					</td>
					<td><b>Supplier</b></td>
					<td><select class="form-control" id="supplier" name='supplier'>
						<?php
							echo "<option value='0'>Pilih Supplier</option>";
							foreach($list_supplier as $row){
								if($id_supplier == $row->id){
									echo "<option selected value='".$row->id."+^".$row->nm_supplier."'>".$row->nm_supplier."</option>";
								}else{
									echo "<option value='".$row->id."+^".$row->nm_supplier."'>".$row->nm_supplier."</option>";
								}
							}
						?>
					  </select>
					</td>
				</tr>
			</table>
              <table class="table table-bordered">
				<thead>
					<tr style="background:lightgray">
						<th width="34%">Nama Barang</th>
						<th width="25%">Keterangan</th>
						<th width="8%">Jumlah</th>
						<th width="18%">Harga Satuan</th>
						<th>Option</th>
						<th></th>
					</tr>
				</thead>
              <table class="table table-bordered">
				<?php
					if($list_barang > 0){
						foreach($list_barang as $row){
				?>
				<tr id="show_stock_<?=$row->id?>">
					<td colspan="6">
						<div class="form-group has-success col-lg-4 this_form">
							<select class="chosen-select form-control" name="nm_barang[]" id="nm_barang[]" data-placeholder="Choose a Location" tabindex="10">
								<option value="0">Pilih Barang</option>
								<?php
								$nm_barang = explode("+^",$row->nm_barang);
								$id_barang = $nm_barang[0];
								
								if($list_kategori > 0){
									$i=0;
									foreach($list_kategori as $row2){
										$i++;
										if($id_barang == $row2->id){
											echo "<option selected value='".$row2->id."+^".$row2->nm_barang."'>".$row2->nm_barang."</option>";
										}else{
											echo "<option value='".$row2->id."+^".$row2->nm_barang."'>".$row2->nm_barang."</option>";
										}
										
									}
									if($i>=20){
										$i=20;
									}
								}
								?>
							</select>
						</div>
						<div class="form-group has-success col-lg-3">
						  <input type="text" class="form-control" id="qty" name='desc[]' placeholder="Masukan Keterangan " value="<?=$row->keterangan?>">
						</div>
						<div class="form-group has-success col-lg-1">
							<input type="text" class="form-control" id="area" value ="<?=$row->jumlah?>" name="qty[]" placeholder="Qty">
						</div>
						<div class="form-group has-success col-lg-2">
						  <input type="text" class="form-control" id="qty" name='harga[]' placeholder="Harga Satuan" value="<?=$row->harga?>">
						</div>
						<div class="form-group has-success">
							<p class="form-group has-warning col-lg-2"><input type="button" class="btn btn-warning" value="Hapus" onclick="return hapus(<?=$row->id?>)"></p>
						</div>
					</td>
				</tr>
				<?php
					}
				}
				?>
				<tr>
					<td colspan="6">
						<div class="form-group has-success col-lg-4 this_form">
							<select class="chosen-select form-control" name="nm_barang[]" id="nm_barang[]" data-placeholder="Choose a Location" tabindex="10">
								<option value="0">Pilih Barang</option>
								<?php
								if($list_kategori > 0){
									$i=0;
									foreach($list_kategori as $row){
										$i++;
										echo "<option value='".$row->id."+^".$row->nm_barang."'>".$row->nm_barang."</option>";
									}
									if($i>=20){
										$i=20;
									}
								}
								?>
							</select>
						</div>
						<div class="form-group has-success col-lg-3">
						  <input type="text" class="form-control" id="qty" name='desc[]' placeholder="Masukan Keterangan " value="">
						</div>
						<div class="form-group has-success col-lg-1">
							<input type="text" class="form-control" id="area" value ="" name="qty[]" placeholder="Qty">
						</div>
						<div class="form-group has-success col-lg-2">
						  <input type="text" class="form-control" id="qty" name='harga[]' placeholder="Harga Satuan" value="">
						</div>
						<div class="form-group has-success">
							<a href="#" class="form-group has-success col-lg-2 remove_field"><button class="btn btn-primary add_field_button">Tambah</button></a>
						</div>
						<div class="input_fields_wrap"></div>
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center"><input type="submit" class='btn btn-success btn-lg' name='submit' value='Save' onclick="return check();"></td>
				</tr>
              </table>
			  </form>
            </div>
        </div>
        </div>
    </div>
	<div id="show_stock"><div>
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
<script>
$(document).ready(function() {
    var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
			$(wrapper).append('<?php echo "<div><div class=\"form-group has-success col-lg-4\"><select class=\"chosen-select form-control\" name=\"nm_barang[]\" id=\"nm_barang[]\" data-placeholder=\"Choose a Location\" tabindex=\"10\"><option value=\"0\">Pilih Barang</option>";
			if($list_kategori > 0){
				foreach($list_kategori as $row2){
					$val	= $row2->id."+^".$row2->nm_barang;
					$nm		= $row2->nm_barang;
					echo "<option value=\"$val\">$nm</option>";
				}
			}
			echo "</select></div><div class=\"form-group has-success col-lg-3 this_form\"><input type=\"text\" class=\"form-control\" id=\"desc\" name=\"desc[]\" placeholder=\"Masukan Keterangan\"></div>";
			echo "<div class=\"form-group has-success col-lg-1\" placeholder=\"Masukan jumlah\">";
				echo "<input type=\"text\" class=\"form-control\" id=\"qty\" value =\"\" name=\"qty[]\" placeholder=\"Qty\">";
			echo "</div>";
			echo "<div class=\"form-group has-success col-lg-2\" placeholder=\"Harga Satuan\">";
				echo "<input type=\"text\" class=\"form-control\" id=\"harga\" value =\"\" name=\"harga[]\" placeholder=\"Harga Satuan\">";
			echo "</div>";
			echo "<a href=\"#\" class=\"form-group has-success col-lg-2 remove_field\"><button class=\"btn btn-warning \">Hapus</button></a><div>";?>')
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
function check(){
	fCode = document.getElementsByName("qty[]");
	fCode2 = document.getElementsByName("nm_barang[]");

	for ( var i = 0; i < fCode.length; i++ ){
		if ( fCode2[i].value != "0" && fCode[i].value == "") {
			alert("Silahkan isi jumlah barang");
			fCode[i].focus();
			return false;
		}
	}
}
function hapus(id){
	var r = confirm("Hapus ?");
	if (r == true) {
		$.get( "<?= base_url(); ?>index.php/order/hapus_new" , { option : id } , function ( data ) {
			$( '#show_stock_'+id ) . html ( data ) ;
		} ) ;
	}
}
</script>