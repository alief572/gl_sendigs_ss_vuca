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
        <div class="col-xs-13">
          <div class="box">
            <div class="box-header">
			<div class="box-body">

			<button class="btn btn-warning btn-sm" onclick="return add_stock()">Tambah COA <i class="fa fa-plus"></i></button>
			  
				<button class="btn btn-warning btn-sm" onclick="return print_bulanan()">print <i class="fa fa-plus"></i></button>
				
			  
				<div class="col-xs-2">
				<form action="<?=base_url()?>index.php/Latihan/list_coa" method="post">
				<select type="text" name="thn" id="thn" class="form-control" onchange="this.form.submit()">
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
					</div>
					
					<div class="col-xs-2">
					<select type="text" name="bln" id="bln" class="form-control" onchange="this.form.submit()">
						<?php
						$nm_bulan = array('All','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
						$bln = $this->input->post('bln');
						$uri_s3 	= $this->uri->segment(3);
						if($uri_s3 == 'month'){
							$bln = date('m');
						} else if(!empty($post_bln)){
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
					
					</form>
					</div>
					  </div>
						<div >			</div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover dataTable example1">
				<thead>
			<tr>
					  <th rowspan='2'>No perkiraan</th>
  					  <th rowspan='2'>nama</th>
					
					  <th rowspan='2'>kode cabang</th>
					  <th rowspan='2'><center>Saldo Awal</center></th>
					  <th rowspan='2'>Bulan</th>
					  <th rowspan='2'>Tahun</th>
					  
					  
					 
					
						<th>Debet</th>
						<th>Kredit</th>
						<th>Aksi</th>
				</tr>

				</thead>
				<tbody>
				<?php
					$i=0;
						if($data_stock > 0){
							foreach($data_stock as $row){
							$i++;
					?>

<tr>
					  
					  <td><?=$row->no_perkiraan?></td>
			    	  <td><?=$row->nama?></td>
				
					  <td><?=$row->kdcab?></td>
					  <td><?=$row->saldoawal?></td>
					  <td><?=$row->bln?></td>
					  <td><?=$row->thn?></td>
					  <td><?=$row->debet?></td>
					  <td><?=$row->kredit?></td>
					  
					  


					 
					  <td>
						<button class='btn btn-primary btn-sm' onclick="return edit_stock(<?=$row->id?>)">
					  Edit <i class="fa fa-edit"></i>
					  </button>
						
					  <a href="<?=base_url()?>index.php/Latihan/delete_stock_barang/<?=$row->id?>" onclick="return validasi_hapus()" class='btn btn-danger btn-sm'>
					  Hapus <i class="fa fa-eraser"></i>
					  </a>				
						
						<a href="<?=base_url()?>index.php/Latihan/print_request/<?=$row->id?>" title="Print Semua Item"  target="blank" class="btn btn-info" width="20%" ><i class="fa fa-print"></i></a>'
					  </td>
					</tr>
					<?php
							}
						}
					?>

				</tbody>
              </table>
							<div id="show_stock"></div>
            </div>
        </div>
        </div>
    </div>
	</section>
	<!-- <table>	
					<tr>
					<td colspan="2" align="center"><input type="submit" name="tampilkan" value="Tampilkan" onclick="return print_bulanan()" class="btn btn-success pull-center" target="_blank"></td>
					
				</tr>
				
				</table>-->
	
<?php $this->load->view('footer');?>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function () {
    $(".example1").DataTable();
  });

	
  function add_stock(){
		
	$.get( "<?= base_url(); ?>index.php/Latihan/add_stock" , { option : "" } , function ( data ) {
		$( '#show_stock' ) . html ( data ) ;
		$('#myModal').modal('show');
	} ) ;
  }
  function edit_stock(id){
	$.get( "<?= base_url(); ?>index.php/Latihan/edit_stock" , { option :id } , function ( data ) {
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
		
		$.get( "<?= base_url(); ?>index.php/Latihan/print_bulanan" , { option : "" } , function ( data ) {
			$( '#show_stock' ) . html ( data ) ;
			$('#myModal').modal('show');
		} ) ;
		}
 
</script>