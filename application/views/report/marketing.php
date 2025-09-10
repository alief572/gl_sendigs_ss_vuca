<?php $this->load->view('header');?>

    <section class="content-header">

      <h1>

       <?=$judul?>

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active"><?=$judul?></li>

      </ol>

    </section>

	<section class="content-header">

    <div class="row">

        <div class="col-xs-12">

          <div class="box">

            <div class="box-header">

			<div class="box-body">

				<form action="<?=site_url('report/marketing')?>" method="post">
					<div class="col-lg-2">
						<select name="tahun" class="form-control" onchange="this.form.submit()">
							<?php
							$tahun = @$this->input->post('tahun');
							if(empty($tahun)){
								$tahun = date("Y");
							}
							for($i=date('Y');$i>=2016;$i--){
								if($tahun == $i){
									echo "<option selected value='$i'>$i</option>";
								}else{
									echo "<option value='$i'>$i</option>";
								}
							}
							?>
						</select>
					</div>
				</form>
            </div>

            <!-- /.box-header -->

            <div class="box-body table-responsive no-padding">

              <table class="table table-bordered table-hover dataTable">

				<thead>

					<tr>

					  <th rowspan="2">Marketing</th>

					  <?php 

					  	for ($i=1; $i<=12; $i++) { 
							$dateObj   = DateTime::createFromFormat('!m', $i);
							$monthName = $dateObj->format('F');
							echo "<th colspan='2'>".$monthName."</th>";
					  	}

					  ?>
					</tr>
						
					<tr>
					  <?php 

					  	for ($j=1; $j<=12; $j++) { 
							echo "<th>Penawaran</th>";
							echo "<th>Deal</th>";
					  	}

					  ?>
					</tr>

				</thead>

				<tbody>

					<?php

						$i=0;
						$total_prospek	= $total_deal	= array();
						if($list_marketing > 0){
							foreach($list_marketing as $row){
								echo "<tr>";
									echo "<td>".$row->pn_name."</td>";
									for ($k=1; $k<=12; $k++) {
										//echo $k;
										$jum_deal	= $jum_penawaran = 0;
										$bln		= sprintf('%02d', $k);
										$jum_prospek= $this->Order_model->get_prospek_month_marketing($row->pn_name, $tahun, $bln);
										$jum_deal	= $this->Order_model->get_spd_month_marketing($row->pn_name, $tahun, $bln);

										echo "<td>".$jum_prospek."</td>";
										echo "<td>".$jum_deal."</td>";

										$total_prospek[$k]	= !empty($total_prospek[$k]) ? $total_prospek[$k]+$jum_prospek : $jum_prospek;
										$total_deal[$k]		= !empty($total_deal[$k]) ? $total_deal[$k]+$jum_deal : $jum_deal;
								  	}
								echo "</tr>";
							}

						}

					?>



				</tbody>
				<tfoot>
					<tr>
						<th>TOTAL</th>
						<?php
						for ($l=1; $l<=12; $l++) { 
							echo "<th>".$total_prospek[$l]."</th>";
							echo "<th>".$total_deal[$l]."</th>";
						}

						?>
					</tr>
				</tfoot>

              </table>

			  <div id="show_supp"></div>

            </div>

        </div>

        </div>

    </div>

	</section>

<?php $this->load->view('footer');?>

<!-- DataTables -->

<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>

<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>

<!-- SlimScroll -->

<script>

  $(function () {

    $(".example1").DataTable();

  });

</script>