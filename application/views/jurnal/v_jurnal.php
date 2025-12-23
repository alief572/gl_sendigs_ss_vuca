<?php $this->load->view('header');?>

<link rel="stylesheet" type="text/css" href="<?=base_url();?>dist/jquery.timepicker.css">
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
                <form method="post" action="<?=base_url()?>index.php/jurnal/proses_input_jurnal">
                      <table class="table table-bordered">
                        <tr>
                          <td width="25%">Saldo Terakhir hari ini <?=date("d-M-Y")?></td>
                    
                          <td>:</td>
                      
                          <td>
                            <input type="text" class="form-control" size='1' name="saldo" id="saldo" value="">
                          </td>
                        </tr>

                        <tr>
                          <td>Dana Masuk/Keluar</td>
                          <td>:</td>
                          <td>
                            <select name="dana"  id="dana"  class="form-control">
                              <option value="0">-Pilih Dana Masuk/Keluar-</option>
                            
                            </select>
                          </td>
                        </tr>

                        <tr>
                          <td colspan="3" align="center"><input type="submit" class='btn btn-success btn-lg' name='submit' value='Simpan' onclick="return check();">
                          <td colspan="3" align="center"><input type="submit" class='btn btn-success btn-lg' name='edit' value='Edit' onclick="return check();">
                        </tr>
                      </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php $this->load->view('footer');?>