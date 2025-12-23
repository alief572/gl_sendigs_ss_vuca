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
			<form method="post" action="<?=base_url()?>index.php/order/proses_barang_use">
				<?php
					$id = $this->uri->segment(3);
					$id = str_replace('_','|',$id);
				?>
				<input type="hidden" class="form-control" size='1' name="id_spd" value="<?=$id?>" readonly>
              <table class="table table-bordered">
				<tr class="widget-user-header bg-yellow">
					<th colspan="6" style="text-align:center;font-size:20px;" ><center>List Pengajuan Barang Non-SPD</center></th>
				</tr>
				</tr>
					<td colspan="6">
						<div class="form-group has-success col-lg-2">
							<select class="form-control" id="area" value ="" name="area[]">
								<?php
								if($list_area > 0){
									foreach($list_area as $rowsz){
								?>
								<option value="<?=$rowsz->nm_area?>"><?=$rowsz->nm_area?></option>
								<?php
									}
								}
								?>
							</select>
						</div>
						<div class="form-group has-success col-lg-5 this_form">
							<select class="chosen-select form-control" name="nm_barang_2[]" id="nm_barang_2[]" data-placeholder="Choose a Location" tabindex="10">
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
						<div class="form-group has-success col-lg-2">
						  <input type="text" class="form-control" id="qty" name='qty_2[]'  onkeypress="return isNumber(event)" placeholder="Masukan jumlah " value="">
						</div>
						<div class="form-group has-success">
							<a href="#" class="form-group has-success col-lg-2 remove_field"><button class="btn btn-primary add_field_button">Tambah</button></a>
						</div>
						<div class="input_fields_wrap"></div>
				</td>
				</tr>
				<tr>
					<td colspan="6" align="center"><input type="submit" class='btn btn-success btn-lg' name='submit' value='Save' onclick="return check();"></td>
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
			$(wrapper).append('<?php echo "<div><div class=\"form-group has-success col-lg-2\"><select class=\"form-control\" id=\"area\" name=\"area[]\">";
								if($list_area > 0){
									foreach($list_area as $rowsz){
										$nama_area = $rowsz->nm_area;
										echo "<option value=\"$nama_area\">$nama_area</option>";
									}
								}
							echo "</select></div><div class=\"form-group has-success col-lg-5 this_form\"><select class=\"chosen-select form-control\" name=\"nm_barang_2[]\" id=\"nm_barang_2[]\" data-placeholder=\"Choose a Location\" tabindex=\"10\"><option value=\"0\">Pilih Barang</option>";
			if($list_kategori > 0){
				foreach($list_kategori as $row){
					$val	= $row->id."+^".$row->nm_barang;
					$nm		= $row->nm_barang;
					echo "<option value=\"$val\">$nm</option>";
				}
			}
			echo "</select></div>";
			echo "<div class=\"form-group has-success col-lg-2\" placeholder=\"Masukan jumlah\">";
				echo "<input class=\"form-control\" type=\"text\" placeholder=\"Masukan jumlah\" name=\"qty_2[]\">";
			echo "</div>";
			echo "<a href=\"#\" class=\"form-group has-success col-lg-2 remove_field\"><button class=\"btn btn-warning \">Hapus</button></a><div>";?>')
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
function check(){
	fCode = document.getElementsByName("qty_2[]");
	fCode2 = document.getElementsByName("nm_barang_2[]");

	for ( var i = 0; i < fCode.length; i++ ){
		if ( fCode[i].value == "" && fCode2[i].value != "0") {
			alert("Silahkan isi jumlah barang non spd");
			fCode[i].focus();
			return false;
		}
	}
}
</script>