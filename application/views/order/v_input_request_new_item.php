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
			<form method="post" action="<?=base_url()?>index.php/order/save_new">
			<table class="table table-bordered table-striped">
				<tr>
					<td><b>Tanggal Pengajuan</b></td>
					<td><?=date("d F Y")?></td>
					<td><b>Diajukan Oleh</b></td>
					<td><?=$this->session->userdata('pn_name')?></td>
				</tr>
				<tr>
					<td><b>No. Aju</b></td>
					<td>
					<?php
					$query 		= $this->db->query("select max(id_aju) as id from dk_request_stock");
					$ret		= $query->result();
					echo $id_aju		= $ret[0]->id+1;
					?>
					</td>
					<td><b>Supplier</b></td>
					<td><select class="form-control" id="supplier" name='supplier'>
						<?php
							echo "<option value='0'>Pilih Supplier</option>";
							foreach($list_supplier as $row){
								echo "<option value='".$row->id."+^".$row->nm_supplier."'>".$row->nm_supplier."</option>";
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
				</tr>
					<td colspan="6">
						<div class="form-group has-success col-lg-4 this_form">
							<input type="text" class="form-control" id="area" value ="" name="nm_barang[]" placeholder="Masukan nama barang">
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
			$(wrapper).append('<?php echo "<div><div class=\"form-group has-success col-lg-4\"><input type=\"text\" class=\"form-control\" id=\"area\" value =\"\" name=\"nm_barang[]\" placeholder=\"Masukan nama barang\"></div><div class=\"form-group has-success col-lg-3 this_form\"><input type=\"text\" class=\"form-control\" id=\"desc\" name=\"desc[]\" placeholder=\"Masukan Keterangan\"></div>";
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
		if ( fCode2[i].value == "") {
			alert("Silahkanm masukan nama barang");
			fCode2[i].focus();
			return false;
		}else if (fCode[i].value == "") {
			alert("Silahkan isi jumlah barang");
			fCode[i].focus();
			return false;
		}
	}
}
</script>