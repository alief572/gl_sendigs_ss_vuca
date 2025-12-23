<style>
	table,
	th,
	td {
		border: 0px;
		/* border-collapse: collapse; */
	}
</style>
<?php
// error_reporting(E_ALL & ~E_NOTICE);
?>
<!-- <div id="space"></div> -->
<!-- <table class="gridtable" width="100%"> -->
<div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scrollable" style="width:95%; height:1000px" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><b>Master Jurnal Detail</b></h4>
				</div>
				<!-- <div class="col-lg"> -->
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button> -->
				<?php
				if ($data_header) {
					foreach ($data_header as $row_header) {
						$kode_master_jurnal	= $row_header->kode_master_jurnal;
						$nama_jurnal		= $row_header->nama_jurnal;
						$keterangan_header	= $row_header->keterangan_header;
						$tipe_jurnal		= $row_header->tipe;
					}
				}
				?>
				<table width="90%">
					<tr>
						<td width="10%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Kode Master Jurnal</b></td>
						<td width="1%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td width="20%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $kode_master_jurnal ?></td>
						<td width="1%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
						<td width="2%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Tipe Jurnal</b></td>
						<td width="1%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td width="20%" style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $tipe_jurnal ?></td>
					</tr>
					<tr>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Nama Jurnal</b></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $nama_jurnal ?></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><b>Keterangan</b></td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;">:</td>
						<td style="border-top-style:none; border-right:none; border-bottom-style:none; border-left-style:none;"><?= $keterangan_header ?></td>
					</tr>
				</table>
				<br>
				<table id="my-grid" class="table table-striped table-bordered table-hover" width="100%">
					<thead>
						<tr bgcolor='#0073B7'>
							<th style="color: white;">No. COA</th>
							<th style="color: white;">Keterangan</th>
							<th style="color: white;">No. Parameter</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						if ($data_detail) {
							foreach ($data_detail as $row_detail) {
								$i++;
								$no_perkiraan	= $row_detail->no_perkiraan;
								$keterangan		= $row_detail->keterangan;
								$parameter_no	= $row_detail->parameter_no;
						?>
								<tr>
									<td><?= $no_perkiraan ?></td>
									<td><?= $keterangan ?></td>
									<td><?= $parameter_no ?></td>
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