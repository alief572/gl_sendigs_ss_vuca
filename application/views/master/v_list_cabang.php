<?php $this->load->view('header');
error_reporting(E_ALL & ~E_NOTICE);
?>
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
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="box-body">
            <button class="btn btn-primary btn-sm" onclick="return add_cabang()">Tambah Cabang <i class="fa fa-plus"></i></button>
          </div>
          <div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-bordered table-hover dataTable example1">
              <thead>
                <tr bgcolor='#9acfea'>
                  <th rowspan='2'>
                    <center>NO. CABANG</center>
                  </th>
                  <th rowspan='2'>
                    <center>SUB CABANG</center>
                  </th>
                  <th rowspan='2'>
                    <center>CABANG</center>
                  </th>
                  <th rowspan='2'>
                    <center>AREA</center>
                  </th>
                  <th rowspan='2'>
                    <center>KODE CABANG</center>
                  </th>
                  <th rowspan='2'>
                    <center>ALAMAT</center>
                  </th>
                  <th rowspan='2'>
                    <center>NAMA CABANG</center>
                  </th>
                  <th rowspan='2'>
                    <center>PERUSAHAAN</center>
                  </th>
                </tr>
                <tr bgcolor='#9acfea'>
                  <th>
                    <center>AKSI</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 0;
                if ($data_cabang > 0) {
                  foreach ($data_cabang as $row) {
                    $i++;
                ?>
                    <tr bgcolor='#DCDCDC'>

                      <td align="center"><?= $row->nocab ?></td>
                      <td align="center"><?= $row->subcab ?></td>
                      <td><?= $row->cabang ?></td>
                      <td align="center"><?= $row->area ?></td>
                      <td align="center"><?= $row->kdcab ?></td>
                      <td><?= $row->alamat ?></td>
                      <td><?= $row->namacabang ?></td>
                      <td><?= $row->perusahaan ?></td>
                      <td>
                        <button class='btn btn-primary btn-sm' onclick="return edit_cabang(<?= $row->id ?>)">
                          Edit <i class="fa fa-edit"></i>
                        </button>
                        <a href="<?= base_url() ?>index.php/master/hapus_cabang/<?= $row->id ?>" onclick="return validasi_hapus()" class='btn btn-danger btn-sm'>
                          Hapus <i class="fa fa-eraser"></i>
                        </a>
                      </td>
                    </tr>
                <?php
                  }
                }
                ?>

              </tbody>
            </table>
            <div id="show_stock"></div>
          </div>
        </div>
</section>

<?php $this->load->view('footer'); ?>
<!-- DataTables -->
<script src="<?= base_url() ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script>
  $(function() {
    $(".example1").DataTable();
  });


  function add_cabang() {

    $.get("<?= base_url(); ?>index.php/master/add_cabang", {
      option: ""
    }, function(data) {
      $('#show_stock').html(data);
      $('#myModal').modal('show');
    });
  }

  function edit_cabang(id) {
    $.get("<?= base_url(); ?>index.php/master/edit_cabang", {
      option: id
    }, function(data) {
      $('#show_stock').html(data);
      $('#myModal').modal('show');
    });
  }

  function validasi_hapus() {
    var dd = confirm("hapus data ?");
    if (dd == false) {
      return false;
    }
  }
</script>