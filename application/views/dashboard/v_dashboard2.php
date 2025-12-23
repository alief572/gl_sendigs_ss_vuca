<?php $this->load->view('header');?>
<section class="content-header">
	<h1>
		<?=$judul?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">DASHBOARD</li>
	</ol>
</section>
<section class="content-header">
	<div class="row">

	<div class="col-xs-12">
      	<div class="box">
        	<div class="box-header">
				<div class="box-body">
						<form action="<?=base_url()?>index.php/dashboard/ganti_tahun" method="post">
							<div class="col-xs-2">
								<select type="text" name="thn" class="form-control" onchange="this.form.submit()">
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
              				<div>
							  	<h3>
									<right><b>GRAFIK LABA RUGI KOTOR</b></right>
								</h3>
								
							</div>
						</form>
					</div>
				<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>	

        	</div>
    	</div>
    </div>	

		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					
					<div>
						<h3>
							<b>TABEL LABA RUGI KOTOR</b>
						</h3>
					</div>
		<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered">
            <!-- <table class="table table-bordered table-hover dataTable example1"> -->
							<thead>
								<tr class="bg-primary">																
                					<th><center>Keterangan</center></th>
									<th><center>Jan</center></th>
									<th><center>Feb</center></th>
                  					<th><center>Mar</center></th>
									<th><center>Apr</center></th>
                  					<th><center>Mei</center></th>
									<th><center>Jun</center></th>
                  					<th><center>Jul</center></th>
									<th><center>Ags</center></th>
                 					<th><center>Sep</center></th>
									<th><center>Okt</center></th>
                  					<th><center>Nov</center></th>
									<th><center>Des</center></th>
								</tr>
							</thead>
							<tbody>
								<?php									
									if($omzet > 0){
										foreach($omzet as $row){
                     						$nokir = $row->no_perkiraan; //1101-00-00
											//$nokir_=substr($nokir,0,4); //1101
											$namkir= $row->nama;
											//$id=$row->id;
											$jan_lk=intval($row->jan);
											$feb_lk=intval($row->feb);
											$mart_lk=intval($row->mart);
											$apr_lk=intval($row->apr);
											$mei_lk=intval($row->mei);
											$jun_lk=intval($row->jun);
											$jul_lk=intval($row->jul);
											$agt_lk=intval($row->agt);
											$sept_lk=intval($row->sept);
											$okt_lk=intval($row->okt);
											$nov_lk=intval($row->nov);
											$des_lk=intval($row->des);
										}
									}else{
										echo " <script>alert('Data Tidak Ada')</script>";											
									}
								?>
								<tr class="bg-info">
                  					<td>Omzet</td>
									<td align="right" width="12%"><?=number_format($jan_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($feb_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mart_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($apr_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mei_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jun_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jul_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($agt_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($sept_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($okt_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($nov_lk,0,',','.');?>
									<td align="right" width="12%"><?=number_format($des_lk,0,',','.');?>	
								</tr>
								<?php															
									if($hpp > 0){
										foreach($hpp as $row2){
                     						$nokir = $row2->no_perkiraan; //1101-00-00
											//$nokir_=substr($nokir,0,4); //1101
											$namkir= $row2->nama;
											//$id=$row2->id;
											$jan2=intval($row2->jan);
											$feb2=intval($row2->feb);
											$mart2=intval($row2->mart);
											$apr2=intval($row2->apr);
											$mei2=intval($row2->mei);
											$jun2=intval($row2->jun);
											$jul2=intval($row2->jul);
											$agt2=intval($row2->agt);
											$sept2=intval($row2->sept);
											$okt2=intval($row2->okt);
											$nov2=intval($row2->nov);
											$des2=intval($row2->des);
										}
									}else{
										echo " <script>alert('Data Tidak Ada')</script>";											
									}
								?>
								<tr class="bg-info">
									<td>HPP</td>
									<td align="right" width="12%"><?=number_format($jan2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($feb2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mart2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($apr2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mei2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jun2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jul2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($agt2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($sept2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($okt2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($nov2,0,',','.');?>
									<td align="right" width="12%"><?=number_format($des2,0,',','.');?>	
								</tr>
               				 	<?php									
											$jan3=intval($jan_lk-$jan2);
											$feb3=intval($feb_lk-$feb2);
											$mart3=intval($mart_lk-$mart2);
											$apr3=intval($apr_lk-$apr2);
											$mei3=intval($mei_lk-$mei2);
											$jun3=intval($jun_lk-$jun2);
											$jul3=intval($jul_lk-$jul2);
											$agt3=intval($agt_lk-$agt2);
											$sept3=intval($sept_lk-$sept2);
											$okt3=intval($okt_lk-$okt2);
											$nov3=intval($nov_lk-$nov2);
                      						$des3=intval($des_lk-$des2);                  
								?>
								<tr class="bg-info">
									<td>LABA</td>
									<td align="right" width="12%"><?=number_format($jan3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($feb3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mart3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($apr3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mei3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jun3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jul3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($agt3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($sept3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($okt3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($nov3,0,',','.');?>
									<td align="right" width="12%"><?=number_format($des3,0,',','.');?>	
								</tr>
							</tbody>
						</table>
							<div id="show_stock"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
							<div>
							  	<h3>
									<right><b>PERBANDINGAN PIUTANG (AR) DAN HUTANG (AP)</b></right>
								</h3>
								
							</div>
	<div id="container4" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	
	<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					
					<div>
						<h3>
							<b>TABEL PERBANDINGAN PIUTANG (AR) DAN HUTANG (AP)</b>
						</h3>
					</div>
		<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered">
            <!-- <table class="table table-bordered table-hover dataTable example1"> -->
							<thead>
								<tr class="bg-primary">																
                					<th><center>ACCOUNT</center></th>
									<th><center>Jan</center></th>
									<th><center>Feb</center></th>
                  					<th><center>Mar</center></th>
									<th><center>Apr</center></th>
                  					<th><center>Mei</center></th>
									<th><center>Jun</center></th>
                  					<th><center>Jul</center></th>
									<th><center>Ags</center></th>
                 					<th><center>Sep</center></th>
									<th><center>Okt</center></th>
                  					<th><center>Nov</center></th>
									<th><center>Des</center></th>
								</tr>
							</thead>
							<tbody>
								<?php									
									if($data_ar > 0){
										foreach($data_ar as $row3){
                     						$nokir = $row3->no_perkiraan; //1101-00-00
											//$nokir_=substr($nokir,0,4); //1101
											$namkir= $row3->nama;
											//$id=$row3->id;
											$jan_ar=intval($row3->jan);
											$feb_ar=intval($row3->feb);
											$mart_ar=intval($row3->mart);
											$apr_ar=intval($row3->apr);
											$mei_ar=intval($row3->mei);
											$jun_ar=intval($row3->jun);
											$jul_ar=intval($row3->jul);
											$agt_ar=intval($row3->agt);
											$sept_ar=intval($row3->sept);
											$okt_ar=intval($row3->okt);
											$nov_ar=intval($row3->nov);
											$des_ar=intval($row3->des);
										}
									}else{
										echo " <script>alert('Data Tidak Ada')</script>";											
									}
								?>
								<tr class="bg-info">
                  					<td>AR</td>
									<td align="right" width="12%"><?=number_format($jan_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($feb_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mart_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($apr_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mei_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jun_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jul_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($agt_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($sept_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($okt_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($nov_ar,0,',','.');?>
									<td align="right" width="12%"><?=number_format($des_ar,0,',','.');?>	
								</tr>
								<?php															
									if($data_ap > 0){
										foreach($data_ap as $row4){
                     						$nokir = $row4->no_perkiraan; //1101-00-00
											//$nokir_=substr($nokir,0,4); //1101
											$namkir= $row4->nama;
											//$id=$row4->id;
											$jan_ap=intval($row4->jan);
											$feb_ap=intval($row4->feb);
											$mart_ap=intval($row4->mart);
											$apr_ap=intval($row4->apr);
											$mei_ap=intval($row4->mei);
											$jun_ap=intval($row4->jun);
											$jul_ap=intval($row4->jul);
											$agt_ap=intval($row4->agt);
											$sept_ap=intval($row4->sept);
											$okt_ap=intval($row4->okt);
											$nov_ap=intval($row4->nov);
											$des_ap=intval($row4->des);
										}
									}else{
										echo " <script>alert('Data Tidak Ada')</script>";											
									}
								?>
								<tr class="bg-info">
									<td>AP</td>
									<td align="right" width="12%"><?=number_format($jan_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($feb_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mart_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($apr_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mei_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jun_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jul_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($agt_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($sept_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($okt_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($nov_ap,0,',','.');?>
									<td align="right" width="12%"><?=number_format($des_ap,0,',','.');?>	
								</tr>
							</tbody>
						</table>
							<div id="show_stock"></div>
					</div>
				</div>
			</div>

<!-- ini lb -->
							<div>
							  	<h3>
									<right><b>Grafik Laba Bersih</b></right>
								</h3>
								
							</div>
	<div id="container6" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					
					<div>
						<h3>
							<b>TABEL LABA BERSIH</b>
						</h3>
					</div>
		<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered">
            <!-- <table class="table table-bordered table-hover dataTable example1"> -->
							<thead>
								<tr class="bg-primary">																
                					<th><center>ACCOUNT</center></th>
									<th><center>Jan</center></th>
									<th><center>Feb</center></th>
                  					<th><center>Mar</center></th>
									<th><center>Apr</center></th>
                  					<th><center>Mei</center></th>
									<th><center>Jun</center></th>
                  					<th><center>Jul</center></th>
									<th><center>Ags</center></th>
                 					<th><center>Sep</center></th>
									<th><center>Okt</center></th>
                  					<th><center>Nov</center></th>
									<th><center>Des</center></th>
								</tr>
							</thead>
							<tbody>
								<?php									
									if($data_lb > 0){
										foreach($data_lb as $row6){
                     						$nokir = $row6->no_perkiraan; //1101-00-00
											//$nokir_=substr($nokir,0,4); //1101
											$namkir= $row6->nama;
											//$id=$row3->id;
											$jan_lb=intval($row6->jan);
											$feb_lb=intval($row6->feb);
											$mart_lb=intval($row6->mart);
											$apr_lb=intval($row6->apr);
											$mei_lb=intval($row6->mei);
											$jun_lb=intval($row6->jun);
											$jul_lb=intval($row6->jul);
											$agt_lb=intval($row6->agt);
											$sept_lb=intval($row6->sept);
											$okt_lb=intval($row6->okt);
											$nov_lb=intval($row6->nov);
											$des_lb=intval($row6->des);
										}
									}else{
										echo " <script>alert('Data Tidak Ada')</script>";											
									}
								?>
								<tr class="bg-info">
                  					<td>PENDAPATAN</td>
									<td align="right" width="12%"><?=number_format($jan_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($feb_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mart_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($apr_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mei_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jun_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jul_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($agt_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($sept_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($okt_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($nov_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($des_lb,0,',','.');?>	
								</tr>	
							</tbody>
						</table>
							<div id="show_stock"></div>
					</div>
				</div>
			</div>
		</div>


		<!-- ini biaya lain2 -->

		<div id="container8" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					
					<div>
						<h3>
							<b>TABEL BIAYA</b>
						</h3>
					</div>
		<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-bordered">
            <!-- <table class="table table-bordered table-hover dataTable example1"> -->
							<thead>
								<tr class="bg-primary">																
                					<th><center>ACCOUNT</center></th>
									<th><center>Jan</center></th>
									<th><center>Feb</center></th>
                  					<th><center>Mar</center></th>
									<th><center>Apr</center></th>
                  					<th><center>Mei</center></th>
									<th><center>Jun</center></th>
                  					<th><center>Jul</center></th>
									<th><center>Ags</center></th>
                 					<th><center>Sep</center></th>
									<th><center>Okt</center></th>
                  					<th><center>Nov</center></th>
									<th><center>Des</center></th>
								</tr>
							</thead>
							<tbody>
								<?php									
									if($data_biaya > 0){
										foreach($data_biaya as $rowby){
                     						// $nokir = $row5->no_perkiraan; //1101-00-00
											// //$nokir_=substr($nokir,0,4); //1101
											// $namkir= $row5->nama;
											//$id=$row3->id;
											$jan_by=intval($rowby->jan);
											$feb_by=intval($rowby->feb);
											$mart_by=intval($rowby->mart);
											$apr_by=intval($rowby->apr);
											$mei_by=intval($rowby->mei);
											$jun_by=intval($rowby->jun);
											$jul_by=intval($rowby->jul);
											$agt_by=intval($rowby->agt);
											$sept_by=intval($rowby->sept);
											$okt_by=intval($rowby->okt);
											$nov_by=intval($rowby->nov);
											$des_by=intval($rowby->des);
										}
									}else{
										echo " <script>alert('Data Tidak Ada')</script>";											
									}
								?>
								<tr class="bg-info">
                  					<td>BIAYA</td>
									<td align="right" width="12%"><?=number_format($jan_by,0,',','.');?></td>
									<td align="right" width="12%"><?=number_format($feb_by,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mart_by,0,',','.');?>
									<td align="right" width="12%"><?=number_format($apr_by,0,',','.');?>
									<td align="right" width="12%"><?=number_format($mei_by,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jun_by,0,',','.');?>
									<td align="right" width="12%"><?=number_format($jul_by,0,',','.');?>
									<td align="right" width="12%"><?=number_format($agt_by,0,',','.');?>
									<td align="right" width="12%"><?=number_format($sept_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($okt_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($nov_lb,0,',','.');?>
									<td align="right" width="12%"><?=number_format($des_lb,0,',','.');?>	
								</tr>	
							</tbody>
						</table>
							<div id="show_stock"></div>
					</div>
				</div>
			</div>
		</div>
 </section>
 
<!-- <section class="content-header"> -->
	
<!-- </section> -->
<?php $this->load->view('footer');?>

<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Charts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
   $(function () {
    $(".example1").DataTable();
  });

////////	CHART LABA RUGI KOTOR ////////////////
Highcharts.chart('container2', {

title: {
    text: 'OMZET HPP LABA KOTOR'
},

subtitle: {
    text: ''
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
    }
},
legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
},

plotOptions: {
    series: {
        label: {
            connectorAllowed: false
        },
        // pointStart: 01
    }
},

series: [{
    name: 'OMZET',
    data: [<?=json_encode($jan_lk);?>, <?=json_encode($feb_lk);?>, <?=json_encode($mart_lk);?>, <?=json_encode($apr_lk);?>, <?=json_encode($mei_lk);?>, <?=json_encode($jun_lk);?>, <?=json_encode($jul_lk);?>, <?=json_encode($agt_lk);?>, <?=json_encode($sept_lk);?>, <?=json_encode($okt_lk);?>, <?=json_encode($nov_lk);?>, <?=json_encode($des_lk);?>]
}, {
    name: 'HPP',
    data: [<?=json_encode($jan2);?>, <?=json_encode($feb2);?>, <?=json_encode($mart2);?>, <?=json_encode($apr2);?>, <?=json_encode($mei2);?>, <?=json_encode($jun2);?>, <?=json_encode($jul2);?>, <?=json_encode($agt2);?>, <?=json_encode($sept2);?>, <?=json_encode($okt2);?>, <?=json_encode($nov2);?>, <?=json_encode($des2);?>]
}, {
    name: 'LABA',
    data: [<?=json_encode($jan3);?>, <?=json_encode($feb3);?>, <?=json_encode($mart3);?>, <?=json_encode($apr3);?>, <?=json_encode($mei3);?>, <?=json_encode($jun3);?>, <?=json_encode($jul3);?>, <?=json_encode($agt3);?>, <?=json_encode($sept3);?>, <?=json_encode($okt3);?>, <?=json_encode($nov3);?>, <?=json_encode($des3);?>]
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});

////////////////	CHART AR VS AP	///////////////////////

Highcharts.chart('container4', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'AR vs AP'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'JUMLAH'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0,
            borderWidth: 0
        }
    },
    series: [{
        name: 'AR',
        data: [<?=json_encode($jan_ar);?>, <?=json_encode($feb_ar);?>, <?=json_encode($mart_ar);?>, <?=json_encode($apr_ar);?>, <?=json_encode($mei_ar);?>, <?=json_encode($jun_ar);?>, <?=json_encode($jul_ar);?>, <?=json_encode($agt_ar);?>, <?=json_encode($sept_ar);?>, <?=json_encode($okt_ar);?>, <?=json_encode($nov_ar);?>, <?=json_encode($des_ar);?>]

    }, {
        name: 'AP',
        data: [<?=json_encode($jan_ap);?>, <?=json_encode($feb_ap);?>, <?=json_encode($mart_ap);?>, <?=json_encode($apr_ap);?>, <?=json_encode($mei_ap);?>, <?=json_encode($jun_ap);?>, <?=json_encode($jul_ap);?>, <?=json_encode($agt_ap);?>, <?=json_encode($sept_ap);?>, <?=json_encode($okt_ap);?>, <?=json_encode($nov_ap);?>, <?=json_encode($des_ap);?>]

    }]
});




// ////////	CHART LABA Bersih ////////////////
// Highcharts.chart('container6', {

// title: {
//     text: 'OMZET HPP LABA BERSIH'
// },
// chart: {
//         type: 'area'
//     },
// subtitle: {
//     text: ''
// },

// plotOptions: {
//         area: {
//             marker: {
//                 enabled: false,
//                 symbol: 'circle',
//                 radius: 2,
//                 states: {
//                     hover: {
//                         enabled: true
//                     }
//                 }
//             }
//         }
//     },

// xAxis: {
//         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
//         tickmarkPlacement: 'on',
//         title: {
//             enabled: false
//         }
//     },

// yAxis: {
//     title: {
//         text: 'JUMLAH'
//     }
// },
// legend: {
//     layout: 'vertical',
//     align: 'right',
//     verticalAlign: 'middle'
// },


// series: [{
//     name: 'Laba Bersih',
//     data: [<?=json_encode($jan_lb);?>, <?=json_encode($feb_lb);?>, <?=json_encode($mart_lb);?>, <?=json_encode($apr_lb);?>, <?=json_encode($mei_lb);?>, <?=json_encode($jun_lb);?>, <?=json_encode($jul_lb);?>, <?=json_encode($agt_lb);?>, <?=json_encode($sept_lb);?>, <?=json_encode($okt_lb);?>, <?=json_encode($nov_lb);?>, <?=json_encode($des_lb);?>]
// },],

// responsive: {
//     rules: [{
//         condition: {
//             maxWidth: 500
//         },
//         chartOptions: {
//             legend: {
//                 layout: 'horizontal',
//                 align: 'center',
//                 verticalAlign: 'bottom'
//             }
//         }
//     }]
// }

// });


// ////////	CHART Biaya Lain-lain ////////////////
// Highcharts.chart('container8', {

// title: {
//     text: 'Biaya Lain-lain'
// },
// chart: {
//         type: 'area'
//     },
// subtitle: {
//     text: ''
// },

// plotOptions: {
//         area: {
//             marker: {
//                 enabled: false,
//                 symbol: 'circle',
//                 radius: 2,
//                 states: {
//                     hover: {
//                         enabled: true
//                     }
//                 }
//             }
//         }
//     },

// xAxis: {
//         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
//         tickmarkPlacement: 'on',
//         title: {
//             enabled: false
//         }
//     },

// yAxis: {
//     title: {
//         text: 'JUMLAH'
//     }
// },
// legend: {
//     layout: 'vertical',
//     align: 'right',
//     verticalAlign: 'middle'
// },


// series: [{
//     name: 'Biaya',
//     data: [<?=json_encode($jan_by);?>, <?=json_encode($feb_by);?>, <?=json_encode($mart_by);?>, <?=json_encode($apr_by);?>, <?=json_encode($mei_by);?>, <?=json_encode($jun_by);?>, <?=json_encode($jul_by);?>, <?=json_encode($agt_by);?>, <?=json_encode($sept_by);?>, <?=json_encode($okt_by);?>, <?=json_encode($nov_by);?>, <?=json_encode($des_by);?>]
// },],

// responsive: {
//     rules: [{
//         condition: {
//             maxWidth: 500
//         },
//         chartOptions: {
//             legend: {
//                 layout: 'horizontal',
//                 align: 'center',
//                 verticalAlign: 'bottom'
//             }
//         }
//     }]
// }

// });

</script>