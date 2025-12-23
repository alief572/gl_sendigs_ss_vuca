<?php
	if($data_master_coa > 0){
		foreach($data_master_coa as $row){
            $nama		    = $row->nama;
            $no_perkiraan   = $row->no_perkiraan; // 1105-02-00
			$kode           = $row->kdcab;
			$char0			= substr($no_perkiraan,0,1); // 1000-00-00 lv1
			$char1			= substr($no_perkiraan,1,1); // 1100-00-00 lv2
			$char2			= substr($no_perkiraan,2,1); // 1101-00-00 lv3
			$char3			= substr($no_perkiraan,3,1); // 1101-01-00 lv4
			$char5			= substr($no_perkiraan,5,1); // 1101-01-01 lv5
			$char6			= substr($no_perkiraan,6,1);
			$char8			= substr($no_perkiraan,8,1);
			$char9			= substr($no_perkiraan,9,1);
			
			
			if($char0 > 0 && $char1 == 0 && $char2 == 0 && $char3 == 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 1 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 == 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 2 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 3 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 3 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 == 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 3 ";
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 == 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 == 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 == 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 > 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 > 0 && $char6 == 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";
			}elseif($char0 > 0 && $char1 > 0 && $char2 == 0 && $char3 > 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 == 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";		
			}elseif($char0 > 0 && $char1 > 0 && $char2 > 0 && $char3 > 0 && $char5 > 0 && $char6 > 0 && $char8 == 0 && $char9 == 0){
				$cek_level		= " Level 4 ";
			}elseif($char8 == 0 && $char9 > 0){
				$cek_level		= " Level 5 ";		
			}elseif($char8 > 0 && $char9 == 0){
				$cek_level		= " Level 5 ";		
			}elseif($char8 > 0 && $char9 >= 0){
				$cek_level		= " Level 5 ";		
			}
			
		}
?>

<div class="example-modal">
	<div class="modal" id='myModal' style="display:show;">
	  <div class="modal-dialog" style="display:show;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form edit COA</h4>
			</div>
			<div class="box-body table-responsive no-padding">
			<form method='post' action="<?=base_url().'index.php/Latihan/proses_add_master_coa';?>" enctype="multipart/form-data">
			
			<div class="form-group has-success col-lg-6"  id="c_jabatan">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nomor Perkiraan (<?=$cek_level?>)</label>
					  <input type="text" class="form-control" id="no_perkiraan" name="no_perkiraan" placeholder="Masukkan No Perkiraan" value="<?=$no_perkiraan ?>">
					</div>
			
					<div class="form-group has-success col-lg-6"  id="c_name">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Nama Perkiraan</label>
					  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Perkiraan" value="<?=$nama ?>">
					</div>
						
					<div class="form-group has-success col-lg-6"  id="c_new_password">
					  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Kode</label>
					  <input type="text" class="form-control" id="kdcab" name="kdcab" placeholder="Masukkan kode" value="<?=$kode?>">
					</div>
						<div class="form-group has-success btn-group col-lg-6"></div>
						<div class="form-group has-success col-lg-6"  id="c_">
						<input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onclick="return check()">
					</div>
				</form>	
				<!-- /.box-body -->
			  </div>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<script src="<?=base_url()?>dist/moment.min.js"></script>
<script type="text/javascript">
	function check(){		// updated by Rindra
		if($("#no_perkiraan").val() == ''){
			alert('Silahkan Isi No Perkiraan');
			document.getElementById("no_perkiraan").focus();
			return false;
		}else if($("#nama").val()==''){
			alert('Silahkan Isi Nama Perkiraan');
			document.getElementById("nama").focus();
			return false;
		}else if($("#kdcab").val()==''){
			alert('Silahkan Pilih Kode Cabang');
			document.getElementById("kdcab").focus();
			return false;
		}
	}
	function changeValue(id){
		$.get( "<?= base_url(); ?>index.php/Latihan/cetak_nokir" , { option : id } , function ( data ) {
		$( '#c_user_id' ) . html ( data ) ;
		} ) ;
	}
</script>

