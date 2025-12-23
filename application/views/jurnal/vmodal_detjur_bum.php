<link rel="stylesheet" href="<?= base_url("assets/pdf/style.css"); ?>">
<?php
error_reporting(E_ALL & ~E_NOTICE);
if ($data_jurnal) {
	foreach ($data_jurnal as $r_tgl) {
		$tgl_jur = date('d/m/Y', strtotime($r_tgl->tanggal));
	}
} else {
	$tgl_jur = "";
}
?>
<div id="space"></div>
<!-- <table class="gridtable" width="100%"> -->
<div class="form-group row">
	<label class="control-label col-sm-2">Nomor Jurnal</label>
	<div class="col-sm-4 text-left">
		<?php
		echo $nomorjurnal;
		?>
	</div>

	<div class="col-sm-4 text-right">
		<label>Tgl BUM : </label>
		<?php
		echo $tgl_jur;
		?>
	</div>
</div>

<!-- <div class="col-lg">

	<label class="control-label col-lg-7">Detail Jurnal : <?= $nomorjurnal ?></label>
</div> -->

<table id="my-grid" class="table table-striped table-bordered table-hover" width="100%">
	<thead>
		<tr>
			<th>
				<center>Nomor COA</center>
			</th>
			<th><center>Nama COA</center></th>
			<th>
				<center>Keterangan</center>
			</th>
			<th>
				<center>No. Reff</center>
			</th>
			<th>
				<center>Debet</center>
			</th>
			<th>
				<center>Kredit</center>
			</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 0;
		$tot_deb = 0;
		$tot_kre = 0;
		if ($data_jurnal > 0) {
			foreach ($data_jurnal as $row) {
				$i++;
				// 101-A2000010
				// $nomor_segmen1		= substr($row->nomor, 0, 3); // 101
				// $nomor_segmen2		= substr($row->nomor, 4, 10); // A2000010
				$nomor_jurnal		= $row->nomor; // 101-A2000010

				$debet		= $row->debet;
				$kredit		= $row->kredit;

				$tot_deb	+= $debet;
				$tot_kre	+= $kredit;
				
				$singkat_cbg    = $this->session->userdata('singkat_cbg');
                $cek_periode    = $this->db->query("SELECT * FROM periode WHERE stsaktif = 'O' and kdcab='$singkat_cbg'")->result();
                if ($cek_periode > 0) {
                    foreach ($cek_periode as $brs_periode) {
                        $tanggal_periode    = $brs_periode->periode;
                        $bln                = substr($tanggal_periode, 0, 2);
                        $thn                = substr($tanggal_periode, 3, 4);
                    }
                }
				
				
				$kode_cabang    = $this->session->userdata('kode_cabang');
                $data_buk_coa    = $this->db->query("SELECT * FROM coa WHERE no_perkiraan = '$row->no_perkiraan' and bln='$bln' and thn='$thn' and kdcab='$kode_cabang'")->result();
                if ($data_buk_coa > 0) {
                    foreach ($data_buk_coa as $brs_coa) {
                        $nama_coa = $brs_coa->nama;
                    }
                } else {
                    $nama_coa = "";
                }
				
		?>
				<tr>
					<td align="center"><?= $row->no_perkiraan ?></td>
					 <td><?=$nama_coa ?></td>
					<td><?= $row->keterangan ?></td>
					<td align="center"><?= $row->no_reff ?></td>
					<td align="right" width="12%"><?= number_format($debet, 0, ',', '.'); ?></td>
					<td align="right" width="12%"><?= number_format($kredit, 0, ',', '.'); ?></td>
					<!-- <td><?= date('d/m/Y', strtotime($row->tanggal)); ?></td> -->
				</tr>
		<?php
			}
		}
		?>
		<tr>
			<td align="right" colspan="3"><b>TOTAL</b></td>
			<td align="right" width="12%"><?= number_format($tot_deb, 0, ',', '.'); ?></td>
			<td align="right" width="12%"><?= number_format($tot_kre, 0, ',', '.'); ?></td>
			<!-- <td><?= date('d/m/Y', strtotime($row->tanggal)); ?></td> -->
		</tr>
	</tbody>
</table>