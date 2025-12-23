<!DOCTYPE html>
<html>

<head>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  <meta content="utf-8" http-equiv="encoding">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GL TRAS Accounting System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>font-awesome-4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="<?= base_url() ?>font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="shortcut icon" href="<?= base_url() ?>/assets/logo_tras.png" type="image/x-icon" />
  <!-- <link rel="shortcut icon" href="<?= base_url() ?>/assets/icon.ico" type="image/x-icon" />  -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/ionicons.min.css">
  <!-- data tables -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/chosen/chosen.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/sweetalert/dist/sweetalert.css'); ?>">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?= site_url() ?>" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>TRAS GL</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php
            $cek_periode_aktif = $this->db->query("SELECT * FROM periode WHERE stsaktif='O' ORDER BY id")->result();
            if ($cek_periode_aktif > 0) {
              foreach ($cek_periode_aktif as $row_pa) {
                $periode_aktif = $row_pa->periode;
              }
            }
            ?>
            <?php
            if ($this->session->userdata('pn_uname') == "root") {
            ?>
              <font size="4" color="#FFFFFF">Kode Cabang &nbsp; : Super Admin</font><br>
            <?php
            } else {
            ?>
              <font size="4" color="#FFFFFF">Kode Cabang &nbsp;: &nbsp;<?= $this->session->userdata('nomor_cabang') ?>-<?= $this->session->userdata('sub_cabang') ?> &nbsp;(<?= $this->session->userdata('singkat_cbg') ?>)</font><br>
            <?php
            }
            ?>
            <font size="4" color="#FFFFFF">Periode Aktif &nbsp; : &nbsp;<?= $periode_aktif ?></font>

          </ul>

          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url() ?>assets/logo_tras.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $this->session->userdata('pn_name') ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?= base_url() ?>assets/logo_tras.png" class="img-circle" alt="User Image">

                  <p>
                    <?= $this->session->userdata('pn_name') ?>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= base_url() ?>index.php/dashboard/logout" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?= base_url() ?>assets/logo_tras.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?= $this->session->userdata('pn_name') ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <?php
          $pn_jabatan = $this->session->userdata('pn_jabatan');
          $pn_akses = $this->session->userdata('pn_akses');
          if ($pn_akses == '1') {
            echo tampil_menu($pn_jabatan);
          }
          ?>
          <!-- menu here 
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        -->
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->