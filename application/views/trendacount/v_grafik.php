<?php $this->load->view('header'); ?>

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
                <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

            </div>
        </div>
    </div>
</section>
<?php
if ($data_accound1 > 0) {
    foreach ($data_accound1 as $row) {
        $nokir = $row->no_perkiraan; //1101-00-00
        //$nokir_=substr($nokir,0,4); //1101
        $namkir = $row->nama;
        //$id=$row->id;
        $jan = intval($row->jan);
        $feb = intval($row->feb);
        $mart = intval($row->mart);
        $apr = intval($row->apr);
        $mei = intval($row->mei);
        $jun = intval($row->jun);
        $jul = intval($row->jul);
        $agt = intval($row->agt);
        $sept = intval($row->sept);
        $okt = intval($row->okt);
        $nov = intval($row->nov);
        $des = intval($row->des);
    }
}
//print_r(json_encode($namkir));
?>
<a href="<?= base_url() ?>index.php/Latihan/Trend_Account" title="" class="btn btn-primary btn-sm" width="20%"><i class="">Kembali</i></a>
<?php $this->load->view('footer'); ?>

<script src="<?= base_url() ?>assets/highcharts/code/highcharts.js"></script>
<script src="<?= base_url() ?>assets/highcharts/code/modules/exporting.js"></script>

<script type="text/javascript">
    Highcharts.chart('container', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'TREND ACCOUNT'
        },
        subtitle: {
            text: 'Report Jan - Desember 2019'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'JUMLAH'
            },
            labels: {
                formatter: function() {
                    return this.value; // / 1000
                }
            }
        },
        tooltip: {
            split: true,
            valueSuffix: ''
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [{
            name: <?= json_encode($namkir); ?>,
            data: [<?= json_encode($jan); ?>, <?= json_encode($feb); ?>, <?= json_encode($mart); ?>, <?= json_encode($apr); ?>, <?= json_encode($mei); ?>, <?= json_encode($jun); ?>, <?= json_encode($jul); ?>, <?= json_encode($agt); ?>, <?= json_encode($sept); ?>, <?= json_encode($okt); ?>, <?= json_encode($nov); ?>, <?= json_encode($des); ?>]
            // [502, 635, 809, 947, 1402, 3634, 5268]
        }]
    });

    $(function() {
        $(".example1").DataTable({
            "ordering": true, // Set true agar bisa di sorting
            "order": [
                [0, 'desc']
            ] // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
        });
    });
</script>