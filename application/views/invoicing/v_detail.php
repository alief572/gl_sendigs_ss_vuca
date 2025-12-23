<?php $this->load->view('header');?>
	<?php
	if($list_invoice > 0){
		foreach($list_invoice as $row){
			$invoice_no 	= $row->invoice_no;
			$invoice_date 	= $row->invoice_date;
			$id_prospek 	= $row->id_prospek;
			$date_customer 	= $row->date_customer;
			$receiveby 		= $row->receiveby;
			$sendby 		= $row->sendby;
			$receive_cust_date = $row->receive_cust_date;
			$tanggal_resepsi = $row->tanggal_resepsi;
			$paid_cust 		= $row->paid_cust;
			$pria 			= $row->pria;
			$wanita 		= $row->wanita;
			$nocust 		= $row->nocust;
			$namacust 		= $row->namacust;
			$address 		= $row->address;
			$jumlah 		= $row->jumlah;
			$ppn 			= $row->ppn;
			$total 			= $row->total;
			$rev_by 		= $row->rev_by;
			$date_rev 		= $row->date_rev;
			$cancel_reason 	= $row->cancel_reason;
			$cancel_by 		= $row->cancel_by;
			$cancel_date 	= $row->cancel_date;
			$npwp 			= $row->npwp;
			$nppkp 			= $row->nppkp;
			$periode 		= $row->periode;
			$faktur_tmp 	= $row->faktur_tmp;
			$batal 			= $row->batal;
			$entryby 		= $row->entryby;
			$updateby 		= $row->updateby;
			$keterangan 	= $row->keterangan;
			$penalty 		= $row->penalty;
			$bayar_no 		= $row->bayar_no;
		}
	}
	?>
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
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
			<form method="post" action="<?=base_url()?>index.php/order/proses_input_prospek">
              <table class="table table-bordered">
				<tr>
					<td width="25%">Nomor Invoice</td>
					<td>
						<input type="text" class="form-control" size='1' value="<?=$invoice_no?>" readonly>
					</td>
					<td width="25%">Nomor Pelanggan</td>
					<td>
						<input type="text" class="form-control" size='1' value="<?=$nocust?>" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Tanggal Input</td>
					<td>
						<input type="text" class="form-control" size='1' value="<?=$invoice_no?>" readonly>
					</td>
					<td width="25%">Pengantin</td>
					<td>
						<input type="text" class="form-control" size='1' value="<?=$pria." & ".$wanita?>" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Alamat</td>
					<td>
						<input type="text" class="form-control" size='1' value="<?=$address?>" readonly>
					</td>
					<td width="25%">Pemesan</td>
					<td>
						<input type="text" class="form-control" size='1' value="" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Tanggal Resepsi</td>
					<td>
						<input type="text" class="form-control" size='1' value="" readonly>
					</td>
					<td width="25%">Pembayaran Ke</td>
					<td>
						<input type="text" class="form-control" size='1' value="" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Jumlah Tagih</td>
					<td>
						<input type="text" class="form-control" size='1' value="" readonly>
					</td>
					<td width="25%">Receive By</td>
					<td>
						<input type="text" class="form-control" size='1' value="" readonly>
					</td>
				</tr>
				<tr>
					<td width="25%">Receive Date</td>
					<td>
						<input type="text" class="form-control" size='1' value="" readonly>
					</td>
					<td width="25%">Tanggal Bayar</td>
					<td>
						<input type="text" class="form-control" size='1' value="" readonly>
					</td>
				</tr>
				<?php}?>
			</table>
        </div>
    </div>
	</section>
<?php $this->load->view('footer');?>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url()?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>dist/js/bootstrap-clockpicker.min.js"></script>