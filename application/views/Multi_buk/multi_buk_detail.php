<?php
error_reporting(E_ALL & ~E_NOTICE);

$singkat_cbg = $this->session->userdata('singkat_cbg');
$kode_cabang = $this->session->userdata('kode_cabang');

$bln = date('m');
$thn = date('Y');
$cek_periode = $this->db->query("SELECT * FROM periode WHERE stsaktif = 'O' and kdcab='$singkat_cbg'")->result();
if (!empty($cek_periode)) {
    foreach ($cek_periode as $brs_periode) {
        $tanggal_periode = $brs_periode->periode;
        $bln             = substr($tanggal_periode, 0, 2);
        $thn             = substr($tanggal_periode, 3, 4);
    }
}
?>

<!-- Header Info Card -->
<div class="panel panel-default" style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 20px; border-top: 3px solid #3c8dbc;">
    <div class="panel-body" style="padding: 15px 20px; background-color: #fafbfc;">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <table class="table table-condensed" style="margin-bottom: 0; background: transparent;">
                    <tr>
                        <td style="width: 120px; font-weight: 600; color: #555; border: none; padding: 6px 0;">Nomor BUK</td>
                        <td style="width: 15px; border: none; padding: 6px 0;">:</td>
                        <td style="border: none; padding: 6px 0;">
                            <span class="label label-primary" style="font-size: 12px; padding: 4px 8px; font-weight: 600; letter-spacing: 0.5px;">
                                <?= !empty($rows_header[0]->nomor) ? $rows_header[0]->nomor : '-' ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #555; border: none; padding: 6px 0;">Keterangan</td>
                        <td style="border: none; padding: 6px 0;">:</td>
                        <td style="border: none; padding: 6px 0; color: #333;">
                            <?= !empty($rows_header[0]->bayar_kepada) ? $rows_header[0]->bayar_kepada : '-' ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6 col-sm-6">
                <table class="table table-condensed" style="margin-bottom: 0; background: transparent;">
                    <tr>
                        <td style="width: 120px; font-weight: 600; color: #555; border: none; padding: 6px 0;">Tgl BUK</td>
                        <td style="width: 15px; border: none; padding: 6px 0;">:</td>
                        <td style="border: none; padding: 6px 0; color: #333;">
                            <i class="fa fa-calendar text-muted" style="margin-right: 5px;"></i>
                            <?= !empty($rows_header[0]->tgl) ? date('d-m-Y', strtotime($rows_header[0]->tgl)) : '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; color: #555; border: none; padding: 6px 0;">Total BUK</td>
                        <td style="border: none; padding: 6px 0;">:</td>
                        <td style="border: none; padding: 6px 0; font-size: 15px; font-weight: bold; color: #00a65a;">
                            Rp. <?= !empty($rows_header[0]->jml) ? number_format($rows_header[0]->jml) : '0' ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Detail Table -->
<div class="table-responsive" style="margin-top: 10px;">
    <table id="my-grid" class="table table-striped table-bordered table-hover" style="width: 100%; margin-bottom: 0; font-size: 12px;">
        <thead>
            <tr style="background: linear-gradient(180deg, #3c8dbc 0%, #357ca5 100%); color: #fff;">
                <th style="width: 40px; text-align: center; vertical-align: middle;">#</th>
                <th style="text-align: center; vertical-align: middle;">Keterangan</th>
                <th style="width: 110px; text-align: center; vertical-align: middle;">No. COA</th>
                <th style="text-align: center; vertical-align: middle;">Nama COA</th>
                <th style="width: 50px; text-align: center; vertical-align: middle;">D/K</th>
                <th style="width: 130px; text-align: center; vertical-align: middle;">Jumlah (Rp.)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_debet  = 0;
            $total_kredit = 0;

            if ($detail->num_rows() > 0) {
                $no = 1;
                foreach ($detail->result() as $d) {
                    if ($d->debet > 0) {
                        $jenis_tr    = '<span class="badge" style="background-color: #3c8dbc; font-size: 10px; padding: 3px 6px;">D</span>';
                        $jumlah      = $d->debet;
                        $total_debet += $d->debet;
                    } else {
                        $jenis_tr     = '<span class="badge" style="background-color: #dd4b39; font-size: 10px; padding: 3px 6px;">K</span>';
                        $jumlah       = $d->kredit;
                        $total_kredit += $d->kredit;
                    }

                    $data_buk_coa = $this->db->query("SELECT nama FROM coa WHERE no_perkiraan = '$d->no_perkiraan' AND bln='$bln' AND thn='$thn' AND kdcab='$kode_cabang' LIMIT 1")->row();
                    $nama_coa     = !empty($data_buk_coa) ? $data_buk_coa->nama : '';

                    echo "<tr>";
                    echo "<td style='text-align: center; vertical-align: middle;'>" . $no . ".</td>";
                    echo "<td style='vertical-align: middle;'>" . htmlspecialchars($d->keterangan) . "</td>";
                    echo "<td style='text-align: center; vertical-align: middle; font-family: monospace; font-weight: 600;'>" . $d->no_perkiraan . "</td>";
                    echo "<td style='vertical-align: middle;'>" . htmlspecialchars($nama_coa) . "</td>";
                    echo "<td style='text-align: center; vertical-align: middle;'>" . $jenis_tr . "</td>";
                    echo "<td style='text-align: right; vertical-align: middle; font-weight: 500;'>" . number_format($jumlah) . "</td>";
                    echo "</tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='6' class='text-center text-muted' style='padding: 20px;'>Tidak ada data detail</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr style="background-color: #f9fbfd; font-weight: bold; border-top: 2px solid #d2d6de;">
                <td colspan="4" style="text-align: right; vertical-align: middle; font-size: 12px; text-transform: uppercase;">
                    Total Debet (D) :
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <span class="badge" style="background-color: #3c8dbc; font-size: 10px; padding: 3px 6px;">D</span>
                </td>
                <td style="text-align: right; vertical-align: middle; font-size: 12px; font-weight: bold; color: #3c8dbc;">
                    <?= number_format($total_debet) ?>
                </td>
            </tr>
            <tr style="background-color: #f9fbfd; font-weight: bold;">
                <td colspan="4" style="text-align: right; vertical-align: middle; font-size: 12px; text-transform: uppercase;">
                    Total Kredit (K) :
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <span class="badge" style="background-color: #dd4b39; font-size: 10px; padding: 3px 6px;">K</span>
                </td>
                <td style="text-align: right; vertical-align: middle; font-size: 12px; font-weight: bold; color: #dd4b39;">
                    <?= number_format($total_kredit) ?>
                </td>
            </tr>
            <tr style="background-color: #edf2f7; font-weight: bold; border-top: 1px solid #cbd5e0;">
                <td colspan="5" style="text-align: right; vertical-align: middle; font-size: 13px; text-transform: uppercase; color: #2d3748;">
                    Total Transaksi BUK :
                </td>
                <td style="text-align: right; vertical-align: middle; font-size: 13px; font-weight: bold; color: #00a65a;">
                    Rp. <?= !empty($rows_header[0]->jml) ? number_format($rows_header[0]->jml) : number_format($total_debet) ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>