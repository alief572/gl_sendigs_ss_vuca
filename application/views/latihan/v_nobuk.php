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
            <div class="col-xs-13">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <!-- /.box-header -->
                                    <div class="box-body table-responsive no-padding">
                                        <form action="<?=base_url()?>index.php/Latihan/setup_buk" method="post">		

                                            <table class="table table-bordered">

                                            <?php

                                                $i=0;
                                                if($data_buk > 0){
                                                 foreach($data_buk as $row){
                                               $nobuk=$row->nobuk;
     
                                            ?>

                                            <?php
                                            }
                                            }
                                            $this->session->userdata('nomor_cabang');
                                            echo $this->session->flashdata('message');
                                            ?>
                                            <tr>
                                                <td width="10%">Nomor BUK</td>
                                                    <td>
                                                        <input type="text" class="form-control" size='15%' name="buk" id="buk" value="<?=$nobuk?>">
                                                     </td>
                                                </tr>
                                                <tr>
                                                    <td><input type="submit" name="submit" value="Save" class='pull-right btn btn-success' onClick="return check()"></td>
                                                </tr>

                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    
    <script type="text/javascript" src="<?=base_url();?>dist/jquery.timepicker.min.js"></script>
    