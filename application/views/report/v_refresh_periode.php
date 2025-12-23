<?php $this->load->view('header');
// $Arr_Coa		= array(); 
// $Arr_Project	= array();
// if($data_perkiraan){
// 	foreach($data_perkiraan as $key=>$vals){
// 		$kode_Coa			= $vals->no_perkiraan.'^'.$vals->nama;
// 		$Arr_Coa[$kode_Coa]	= $vals->no_perkiraan.'  '.$vals->nama;
// 	}
// }
?>

<section class="content-header">
	<h1>
		<?= $judul ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?= $judul ?></li>
	</ol>
</section>

<section class="content-header">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<!-- /.box-header -->
				<!-- <div class="box-body table-responsive no-padding"> -->
				<form method="post" action="<?= base_url() ?>index.php/report/proses_refresh_periode" autocomplete="off">
					<table class="table table-bordered">
						<tr>
							<td><b>PILIH PERIODE : </b></td>
						</tr>

						<tr>
							<td width="25%" align="right"><b>Bulan</b></td>
							<td>

								<select type="text" name="bulan_periode" class="form-control">
									<?php
									$nm_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
									$bulan = @$this->input->post('bulan_periode');
									if (empty($bulan)) {
										// $bulan = date("m")+0;
										$bulan = $bln_aktif;
									}
									for ($i = 1; $i <= 12; $i++) {
										if ($i == $bulan) {
											echo "<option selected value='$i'>" . $nm_bulan[$i] . "</option>";
										} else {
											echo "<option value='$i'>" . $nm_bulan[$i] . "</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td width="25%" align="right"><b>Tahun</b></td>
							<td>

								<select type="text" name="tahun_periode" class="form-control">
									<?php
									$tahun = @$this->input->post('tahun_periode');
									if (empty($tahun)) {
										$tahun = date("Y") + 0;
										//$tahun = $thn_aktif;
									}
									for ($i = date("Y") - 8; $i <= date("Y") + 2; $i++) {
										if ($tahun == $i) {
											echo "<option selected value='$i'>$i</option>";
										} else {
											echo "<option value='$i'>$i</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>

						<tr>
							<td colspan="2" align="center"><input type="submit" name="tmb_proses_periode" value="Proses" onclick="return check()" class="btn btn-success pull-center" target="_blank"></td>

						</tr>
					</table>
				</form>
			</div>
			<?php
			//$proses = 0;
			if ($proses == 2) {

				echo "<div class='alert alert-success' role='alert'>Refresh Periode Berhasil</div>";
			}

			?>
		</div>
	</div>
</section>
<?php $this->load->view('footer'); ?>

<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/moment.min.js"></script>
<script>
	function check() {
		if ($("#bulan_periode").val() == "0") {
			alert("Silahkan Pilih Bulan");
			return false;
		} else if ($("#tahun_periode").val() == "0") {
			alert("Silahkan Pilih Tahun");
			return false;
		}
	}
</script>