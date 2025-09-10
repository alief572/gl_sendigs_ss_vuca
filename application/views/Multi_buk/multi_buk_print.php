<link rel="stylesheet" href="<?= base_url("assets/pdf/style.css"); ?>">
<style type="text/css">
    @media print {
        .pagebreak {
            page-break-after: always;
        }
    }

    table tr td {
        font-weight: bold;
        color: #000;
    }

    .footer-text {
        color: #000;
        font-size: 11px;
        font-weight: bold;
        font-family: Arial;
    }
</style>
<?php
error_reporting(E_ALL & ~E_NOTICE);
$urutan = 0;
$no_buk = explode(",", $nomor_buk);
foreach ($no_buk as $key => $nobuk) {
    $detail = $this->db->query("
        SELECT 
            * 
        FROM 
            jurnal 
        WHERE 
            tipe = 'BUK' 
            AND nomor = '" . $nobuk . "'
        ORDER BY 
            debet DESC
    ");
    $japh_detail  = $detail->result_array();
    // $japh_detail_r  = $detail->row();
    //echo"<pre>";print_r($detail);exit;
    $total_detail = $detail->num_rows();
    $japh         = $this->m_list->getSQL("SELECT * FROM japh WHERE nomor = '" . $nobuk . "' ")->row();
    $cbg          = $this->m_list->getSQL("SELECT cabang FROM pastibisa_tb_cabang WHERE nocab='" . $japh->kdcab . "'")->row();

    $jur_kasbank  = $this->m_list->getSQL("SELECT * FROM jurnal WHERE nomor = '" . $nobuk . "' and tipe='BUK' and (no_perkiraan like '1102%' or no_perkiraan like '1101%') order by nomor");
    $ar_jur_kasbank  = $jur_kasbank->result_array();
    $jml_jur_kasbank = $jur_kasbank->num_rows();

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
    $nokir_kasbank1  = $ar_jur_kasbank[$urutan]['no_perkiraan'];
    $data_buk_coa1    = $this->db->query("SELECT * FROM coa WHERE no_perkiraan = '$nokir_kasbank1' and bln='$bln' and thn='$thn' and kdcab='$kode_cabang'")->row();

    $i            = 0;
    $j            = 1;
    $tdebet       = 0;
    $page         = ceil($total_detail / 10);

    for ($j; $j <= $page; $j++) {
        if ($j > 1) {
            echo "<br />";
        }

        $limit = $j * 10;
?>
        <div class="header-no" style="font-family:Arial;font-size:14px;padding-bottom:-19px;">No. : <?php echo $japh->nomor; ?></div>
        <div class="header-text" style="font-family:arial;font-size:14px;">BUKTI UANG KELUAR<span></span></div>

        <table class="" width="100%" style="padding:0px;font-size:11px;font-family: verdana;border-spacing:0 -4px;">
            <!-- <tr>
                <td width="30%" style="border:none;text-align:center;"></td>
                <td width="16%" style="border:none;text-align:left;">
                    CASH/CHEQUE/BG NO.
                </td>
                <td width="4%" style="border:none;text-align:center;">:</td>
                <td width="45%" style="border:none;text-align:left;">
                <?php echo $japh->no_reff; ?>
                </td>
            </tr> -->
            <tr>
                <td width="30%" style="border:none;text-align:center;"></td>
                <td width="16%" style="border:none;text-align:left;">
                    Bank / Kas
                </td>
                <td width="4%" style="border:none;text-align:center;">:</td>
                <td width="45%" style="border:none;text-align:left;">
                    <?php echo $data_buk_coa1->nama; ?> (<?php echo $nokir_kasbank1; ?>)
                </td>
            </tr>
            <tr>
                <td width="30%" style="border:none;text-align:center;"></td>
                <td width="16%" style="border:none;text-align:left;">
                    Bayar Kepada
                </td>
                <td width="4%" style="border:none;text-align:center;">:</td>
                <td width="45%" style="border:none;text-align:left;">
                    <?php echo $japh->bayar_kepada; ?>
                </td>
            </tr>
			<tr>
                <td width="30%" style="border:none;text-align:center;"></td>
                <td width="16%" style="border:none;text-align:left;">
                    &nbsp;
                </td>
                <td width="4%" style="border:none;text-align:center;"></td>
                <td width="45%" style="border:none;text-align:left;">
                </td>
            </tr>
        </table>
        <?php

        ?>
        <div class="header-cab" style="font-family:Arial;padding-top:-2px;"><?php echo $cbg->cabang; ?></div>
        <table class="gridtable" width="100%" style="border-spacing:0 -3px;">
            <tr>
                <td align="center" style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;width:5%;font-size:11px;">No</td>
                <td align="center" style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;font-size:11px;">Keterangan</td>
                <td align="center" style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;width:15%;font-size:11px;">Nama coa</td>
                <td align="left" style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;width:13%;font-size:11px;">No. coa</td>
                <td align="center" style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;width:5%;font-size:11px;">D/K</td>
                <td align="right" style="border-top-style:dotted; border-right-style:dotted; border-bottom-style:dotted; border-left-style:dotted;width:12%;font-size:11px;">Jumlah (Rp.)</td>
            </tr>
            <?php
            $jdebet  = 1;
            $jkredit = 1;
            $debet   = 0;
            $kredit  = 0;

            for ($i; $i < $limit; $i++) {
            ?>
                <?php
                $jumlah        = '';
                $jenis_tr    = '';
                //if (substr($japh_detail[$i]["no_perkiraan"], 0, 4) !== "1102" && substr($japh_detail[$i]["no_perkiraan"], 0, 4) !== "1101") {
                    if ($i < $total_detail) {
                        if ($japh_detail[$i]["debet"] > 0) {
                            $jenis_tr        = 'D';
                            $jumlah         = number_format($japh_detail[$i]["debet"]);
                            $debet          = $debet + $japh_detail[$i]["debet"];
                            $tdebet         = $tdebet + $japh_detail[$i]["debet"];
                            $jdebet++;
                        } else if ($japh_detail[$i]["kredit"] > 0) {
                            $jenis_tr        = 'K';
                            $jumlah         = number_format($japh_detail[$i]["kredit"]);
                            $kredit         = $kredit + $japh_detail[$i]["kredit"];
                            $jkredit++;
                        } else if ($japh_detail[$i]["tp"] === "") {
                            $jumlah         = "";
                            $jenis_tr        = '';
                            $debet          = $debet + $japh_detail[$i][""];
                            $tdebet         = $tdebet + $japh_detail[$i][""];
                            $jdebet++;
                        }
                    //}

                    $kode_cabang    = $this->session->userdata('kode_cabang');
                    $nokir_kasbank2[$i]  = $japh_detail[$i]["no_perkiraan"];
                    // echo $japh_detail[1]["no_perkiraan"];
                    // exit;
                    if ($nokir_kasbank2[$i] > 0) {
                        $data_buk_coa2    = $this->db->query("SELECT * FROM coa WHERE no_perkiraan = '$nokir_kasbank2[$i]' and kdcab='$kode_cabang'")->result();
                        if ($data_buk_coa2 > 0) {
                            foreach ($data_buk_coa2 as $brs_coa2) {
                                $nama_coa2 = $brs_coa2->nama;
                            }
                        } else {
                            $nama_coa2 = "";
                        }
                    } else {
                        $nama_coa2 = "";
                    }
                ?>
                    <tr>
                        <td class="text-center" style="border-right-style: dotted;border-left-style: dotted; border-bottom:none;border-top:none;font-size:11px;"><?php echo $i + 1; ?></td>

                        <td class="text-left" style="border-left:none;border-right:none;border-bottom:none;border-top:none; font-size:11px;"><?php echo substr($japh_detail[$i]["keterangan"], 0, 53); ?></td>

                        <td class="text-left" style="border-left-style: dotted; border-right:none;border-bottom:none;border-top:none;font-size:10px;"><?php echo $nama_coa2; ?></td>

                        <td style="border-left-style: dotted; border-right:none;border-bottom:none;border-top:none;font-size:11px;"><?php echo $japh_detail[$i]["no_perkiraan"]; ?></td>

                        <td class="text-center" style="border-left-style: dotted; border-right:none;border-bottom:none;border-top:none;font-size:11px;"><?php echo $jenis_tr; ?></td>

                        <td class="text-right" style="border-left-style: dotted; border-right-style: dotted; border-bottom:none;border-top:none;font-size:11px;">
                            <?php
                            echo $jumlah;
                            ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

            <?php if ((int) $page !== 1) { ?>
                <tr>
                    <td class="footer-detail-left" colspan="3" style="border-left-style: none; border-right:none; border-bottom-style: none;border-top-style: dotted;font-size:11px;"> </td>
                    <td class="footer-detail-left" colspan="2" style="border-left-style: dotted; border-right:none; border-bottom-style: dotted;border-top-style: dotted;font-size:11px;">SUB TOTAL</td>
                    <td class="text-right" style="border-left-style:dotted; border-right-style:dotted; border-bottom-style:dotted; border-top-style:dotted;font-size:11px;">
                        <?php
                        if ((int) $debet !== 0) {
                            echo number_format($debet);
                        } else {
                            echo number_format($debet);
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if ((int) $j === (int) $page) { ?>
                <tr>
                    <?php
                    if ((int) $page !== 1) {
                    ?>
                        <td class="footer-detail-left" colspan="3" style="border-left-style: none; border-right:none; border-bottom-style: none;border-top-style: none;"></td>
                    <?php } else { ?>

                        <td class="footer-detail-left" colspan="3" style="border-left-style: none; border-right:none; border-bottom-style: none;border-top-style: dotted;font-size:11px;"></td>

                    <?php } ?>

                    <td class="footer-detail-left" colspan="2" style="border-left-style: dotted; border-right:none; border-bottom-style: dotted;border-top-style: dotted;font-size:11px;">TOTAL</td>
                    <td class="text-right" style="border-left-style:dotted; border-right-style:dotted; border-bottom-style:dotted; border-top-style:dotted;font-size:11px;">
                        <?php
                        echo number_format($japh->jml);
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <div class="footer-text" style="font-size:11px;padding-top:-20px;padding-bottom:-2px;">Terbilang :
            <?php
            if ((int) $j === (int) $page) {
                echo substr(Terbilang($japh->jml), 0, 80);
            } else {
                echo substr(Terbilang($debet - $kredit), 0, 80);
            }
            ?>
            Rupiah
        </div>
        <div class="footer-text">Note : <?php echo $japh->note; ?></div>

        <?php
        if ((int) $j === (int) $page) {
        ?>
            <table class="gridtable" width="100%">
                <tr>
                    <td class="text-center" style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;font-size:11px">Dibukukan</td>
                    <td class="text-center" style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;font-size:11px;">Diperiksa</td>
                    <td class="text-center" style="border-top-style:dotted; border-right-style:dotted; border-bottom-style:dotted; border-left-style:dotted;font-size:11px;">Disetujui</td>
                    <td colspan="2" style="border:none;text-align:right;font-size:11px;">
                        Jakarta, <?php echo date('d-m-Y', strtotime($japh->tgl)); ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;"></td>
                    <td style="border-top-style:dotted; border-right:none; border-bottom-style:dotted; border-left-style:dotted;"></td>
                    <td style="border-top-style:dotted; border-right-style:dotted; border-bottom-style:dotted; border-left-style:dotted;"></td>
                    <td colspan="2" style="border-top:none; border-right:none; border-bottom:none; border-left:none; text-align:right;font-size:11px;">
                        <br /><br />(___________________________)<br />Penerima
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td colspan="2" style="border-top:none; border-right:none; border-bottom:none; border-left:none; text-align:right;font-size:11px;">
                        <br /><br />(___________________________)<br />Kasir
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
            </table>

            <span style="display:none !important;height:0px !important;">
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <?php if ((int) $page === 1) { ?>
                    <div id="space"></div>
                    <div id="space" style="padding-top:-9px;"></div>
                <?php } else { ?>
                    <div style="padding-top:-10px;"></div>
                <?php } ?>
            </span>
        <?php
        } else {
        ?>
            <span style="display:none !important;height:0px !important;">
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
                <div id="space"></div>
            </span>
<?php
        }
    }
}
?>