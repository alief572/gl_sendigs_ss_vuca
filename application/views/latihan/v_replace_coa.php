<?php $this->load->view('header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>dist/jquery.timepicker.css">
<section class="content-header">
  <h1>
    <?= $judul ?>
  </h1>
</section>
<section class="content-header">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">

            <form action="<?= base_url() ?>index.php/Latihan/repleace_coa_proses" method="post">

              <table class="table table-bordered">
                <tr>
                  <td width="25%">No Coa Lama</td>
                  <td>
                    <input type="text" class="form-control" size='' value="" name="no_perkiraan_L" id="no_perkiraan_L">
                  </td>
                </tr>
                <tr>
                  <td width="25%">No Coa Baru</td>
                  <td>
                    <input type="text" class="form-control" size='' value="" name="no_perkiraan_B" id="no_perkiraan_B">
                  </td>
                </tr>


                <tr>
                  <td>
                    <a href="<?= base_url() ?>index.php/Gl_laporan/repleace_coa" class='btn btn-danger btn-sm'><i class="fa fa-close"></i>Cancel</a>

                    </a>
                    <input type="submit" name="proses" value="Replace" onclick="return check()" class="btn btn-succes pull-center">

                  </td>
                </tr>
              </table>
            </form>
</section>
</div>
</div>
</div>
</div>
</div>
<div class="container">
  <p><?php echo $this->session->flashdata('message'); ?></p>
</div>

<?php $this->load->view('footer'); ?>
<link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?= base_url() ?>dist/css/bootstrap-clockpicker.min.css">
<!-- bootstrap datepicker -->
<script src="<?= base_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>dist/js/bootstrap-clockpicker.min.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>dist/jquery.timepicker.min.js"></script>
<script>
  $('#jam_resepsi').timepicker({
    'timeFormat': 'H:i',
    'step': 60
  });

  function validasi() {
    var dd = confrim("simpan data?");
    if (dd == true) {

      $.get("<?= base_url() ?>index.php/latihan/repleace_coa_proses", {
        option: ""
      }, function(data) {
        $('#show_stock').html(data);

      });
    } else {
      return false;
    }
  }

  function cancel() {
    var dd = confrim("simpan data?");
    if (dd == true) {

      $.get("<?= base_url() ?>index.php/latihan/repleace_coa_proses", {
        option: ""
      }, function(data) {
        $('#show_stock').html(data);

      });
    } else {
      return false;
    }
  }

  function check() {
    if ($("#no_perkiraan_L").val() == '') {
      alert('Silahkan Isi Coa Lama');
      document.getElementById("no_perkiraan_L").focus();
      return false;
    } else if ($("#no_perkiraan_B").val() == '') {
      alert('Silahkan Isi Coa Baru');
      document.getElementById("no_perkiraan_B").focus();
      return false;
    }
  }
</script>