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
            </div>
            <div class="box-body table-responsive no-padding">

              <table class="table table-bordered table-hover dataTable example1">

				<thead>

					<tr>
                      <th>No.</th>
                      <th>No. SPD</th>
                      <th>Marketing</th>
                      <th>Nama Pengantin</th>
                      <th>Tempat Resepsi</th>
                      <th>Invoice Ke</th>
                      <th>Sisa Tagihan</th>
					</tr>

				</thead>

				<tbody>
                    <?php
                      $no	= 1;
                      if($schedule > 0){
                        foreach($schedule as $row){
                       
                    ?>
                        <tr>
                          <td style="width: 5%"><?=$no?>.</td>
                          <td><?=$row->id_penawaran?></td>
                          <td><?=$row->salesman?></td>
                          <td><?=$row->pria.' & '.$row->wanita?></td>
                          <td><?=$row->tempat_resepsi?></td>
                          <!-- <td><?=date('d-M-Y', strtotime($row->resepsi_date))?></td> -->
                          <td style="text-align:center"><?=$row->no_bayar?></td>
                          <td><?=number_format($row->piutang)?></td>
                          <?php
                    	$no++;
                        }
                      }
                    ?>
                        </tr>

                    
				</tbody>

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