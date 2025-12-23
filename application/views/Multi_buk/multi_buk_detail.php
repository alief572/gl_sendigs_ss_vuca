<link rel="stylesheet" href="<?= base_url("assets/pdf/style.css"); ?>">
<?php
error_reporting(E_ALL & ~E_NOTICE);
?>
<div id="space"></div>
<!-- <table class="gridtable" width="100%"> -->
<div class="form-group row">
    <label class="control-label col-sm-2">Nomor BUK</label>
    <div class="col-sm-4 text-left">
        <?php
        echo $rows_header[0]->nomor;
        ?>
    </div>
    <label class="control-label col-sm-2">Tgl BUK</label>
    <div class="col-sm-4 text-left">
        <?php
        echo date('d-m-Y', strtotime($rows_header[0]->tgl));
        ?>
    </div>
</div>
<div class="form-group row">
    <label class="control-label col-sm-2">Keterangan</label>
    <div class="col-sm-4 text-left">
        <?php
        echo $rows_header[0]->bayar_kepada;
        ?>
    </div>
    <label class="control-label col-sm-2">Total BUK</label>
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
            <th>No. COA</th>
            <th>Nama COA</th>
            <th>D/K</th>
            <th>Jumlah (Rp.)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($detail->num_rows() > 0) {
            $no = 1;
            foreach ($detail->result() as $d) {
                if ($d->debet > 0) {
                    $jenis_tr    = 'D';
                    $jumlah = $d->debet;
                } else {
                    $jenis_tr    = 'K';
                    $jumlah = $d->kredit;
                }

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
                $data_buk_coa    = $this->db->query("SELECT * FROM coa WHERE no_perkiraan = '$d->no_perkiraan' and bln='$bln' and thn='$thn' and kdcab='$kode_cabang'")->result();
                if ($data_buk_coa > 0) {
                    foreach ($data_buk_coa as $brs_coa) {
                        $nama_coa = $brs_coa->nama;
                    }
                } else {
                    $nama_coa = "";
                }

                echo "
                <tr>
                    <td>" . $no . ".</td>
                    <td>" . $d->keterangan . "</td>                    
                    <td>" . $d->no_perkiraan . "</td>
                    <td>" . $nama_coa . "</td>
                    <td>" . $jenis_tr . "</td>
                    <td align='right'>" . number_format($jumlah) . "</td>
                </tr>
                ";
                $no++;
            }
        }
        ?>
    </tbody>
</table>