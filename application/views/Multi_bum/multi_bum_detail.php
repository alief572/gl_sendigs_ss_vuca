<link rel="stylesheet" href="<?= base_url("assets/pdf/style.css"); ?>">
<div id="space"></div>
<!-- <table class="gridtable" width="100%"> -->
<div class="form-group row">
	<label class="control-label col-sm-2">Nomor BUM</label>
	<div class="col-sm-4 text-left">
		<?php
			echo $rows_header[0]->nomor;
		?>
	</div>
	<label class="control-label col-sm-2">Tgl BUM</label>
	<div class="col-sm-4 text-left">
		<?php
			echo date('d-m-Y',strtotime($rows_header[0]->tgl));
		?>
	</div>
</div>
<div class="form-group row">
	<label class="control-label col-sm-2">Keterangan</label>
	<div class="col-sm-4 text-left">
		<?php
			echo $rows_header[0]->terima_dari;
		?>
	</div>
	<label class="control-label col-sm-2">Total BUM</label>
	<div class="col-sm-4 text-left">
		<?php
			echo number_format($rows_header[0]->jml);
		?>
	</div>
</div>
<table id="my-grid" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th width="10">#</th>
            <th>Keterangan</th>
            <th>Reff</th>
            <th>No. Perkiraan</th>
			<th>Nama Perkiraan</th>
            <th>D/K</th>
            <th>Jumlah (Rp.)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($detail->num_rows() > 0)
        {
            $no=1;
            foreach($detail->result() as $d){
                if ($d->debet > 0) {
					$jenis_tr	='D';
                    $jumlah = $d->debet;
                } else {
					$jenis_tr	='K';
                    $jumlah = $d->kredit;
                }
                echo "
                <tr>
                    <td>".$no.".</td>
                    <td>".$d->keterangan."</td>
                    <td>".$d->no_reff."</td>
                    <td>".$d->no_perkiraan."</td>
					<td>".$d->nama."</td>
                    <td>".$jenis_tr."</td>
                    <td align='right'>".number_format($jumlah)."</td>
                </tr>
                ";
                $no++;
            }
        }
        ?>
    </tbody>
</table>