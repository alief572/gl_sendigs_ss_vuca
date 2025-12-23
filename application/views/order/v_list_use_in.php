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
            <div class="box-body table-responsive no-padding">
			<form method="post" action="<?=base_url()?>index.php/order/proses_in">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
					  <th>No.</th>
					  <th>ID Barang</th>
					  <th>Nama Barang</th>
					  <th>Sisa</th>
					  <th>Sudah Keluar</th>
					  <th>Total</th>
					  <th>Masuk</th>
					</tr>
				</thead>
				<tbody>
				<input type="hidden" name="id_penawaran" value="<?=$id_penawaran?>" readonly>
					<?php
					$i=0;
						if($list_barang > 0){
							$no=0;
							foreach($list_barang as $row){
								$no++;
								$jum_out = $this->order_model->check_out($id_penawaran,$row->id_barang) + 0;
								$sisa = $row->tot_qty - $jum_out;
								
					?>
					<tr>
					  <td><?=$no?></td>
					  <td><input type="text" name="id_barang[]" size="12" value="<?=$row->id_barang?>" readonly></td>
					  <td><input type="text" name="nm_barang[]" size="50" value="<?=$row->nm_barang?>" readonly></td>
					  <td>
					  <?=$sisa?>
					  </td>
					  <td><?=$jum_out?></td>
					  <input type="hidden" name="sudah_keluar[]" value="<?=$jum_out?>" readonly>
					  <td><?=$row->tot_qty?></td>
					  <td><input type="text" name="out[]" value="<?=$sisa?>" size="5"></td>
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
				<tr>
					<td colspan="7"><input type="submit" name="save" onclick="return check()" class="btn btn-success pull-right" value="Create History"></td>
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
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
	function check(){
		fCode = document.getElementsByName("out[]");
		fCode2 = document.getElementsByName("sudah_keluar[]");

		for ( var i = 0; i < fCode.length; i++ ){
			if ( fCode[i].value > fCode2[i].value) {
				alert("barang Masuk tidak boleh lebih besar dari barang yang sudah keluar");
				fCode[i].focus();
				return false;
			}
		}
	}
</script>