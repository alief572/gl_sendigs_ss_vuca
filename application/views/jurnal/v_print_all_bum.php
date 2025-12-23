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
            <form method='post' action="<?=base_url().'index.php/jurnal/print_request_bum';?>" enctype="multipart/form-data">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
					<tr>
						<th>No. BUM</th>
                        <th>Aksi</th>
					</tr>
				</thead>
				<tbody>
                <?php
            $i=0;
              if($list_data > 0){
                $no=0;
                foreach($list_data as $row){
									$no++;
			
									$format_jumlah = number_format($row->jml,0,',','.');
									//$format_jumlah = "Rp. " . number_format($row->jml,0,',','.');

									$id_bum = $row->nomor;

									$id_bumx = str_replace("-","_",$id_bum);
									$tgl_bum = date("d-M-Y",strtotime($row->tgl));
									$tgl_bumx = str_replace("-","_",$tgl_bum);
					?>
					<tr>
					  <td><?=$row->nomor?></td>
  <td><input type="checkbox" name="pilih[]" id="check1" onclick="setChecks(this)" value="(<?=$id_bumx.'/'.$tgl_bumx?>)" ></td>		
	 
					</tr>
					<?php									
					}
				}				
					?>

				</tbody>
              </table>
							<div class="form-group has-success col-lg-6"  id="c_">
						<input type="submit" name="submit" value="Print" class='pull-right btn btn-success' onclick="return check()">
					</div>
							</form>
            </div>
        </div>
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

<!-- <script src="<?=base_url()?>dist/jquery.min.js"></script> -->
<script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>

<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->
<script>
  $(function () {
    $(".example1").DataTable({
			"ordering": true, // Set true agar bisa di sorting
			"order": [[ 0, 'desc' ]] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		});
  });

  function batal(id){		
		$.get( "<?=base_url()?>index.php/jurnal/vmodal_batal_buk" , { option : id } , function ( data ) {
			$( '#show_stock' ) . html ( data ) ;
			$('#myModal').modal('show');
		} ) ;		
	}

function validasi_hapus(){
	  var dd = confirm("Yakin di Batalkan ?");
	  if(dd == false){
		  return false;
	  }
  }
</script>
<script>
$(function () {
	$('#datepicker').datepicker({
		dateFormat:'yyyy-mm-dd'
	});

	$('#datepicker2').datepicker({
		dateFormat:'yyyy-mm-dd'
	});
});
</script>
<script type="text/javascript">
<!--
//initial checkCount of zero
var checkCount=0
//maximum number of allowed checked boxes
var maxChecks=8
function setChecks(obj){
//increment/decrement checkCount
if(obj.checked){
checkCount=checkCount+1
}else{
checkCount=checkCount-1
}
//if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
if (checkCount>maxChecks){
obj.checked=false
checkCount=checkCount-1
alert('you may only choose up to '+maxChecks+' options')
}
}
//-->
</script>
