<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="url" content="<?= base_url() ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $title; ?></title>
  <!-- SOURCE CSS -->
 <!-- Bootstrap core CSS -->
 <link href="<?= base_url('vendor/css/bootstrap.min.css'); ?>" rel="stylesheet">
 <!-- Material Design Bootstrap -->
 <link href="<?= base_url('vendor/css/mdb.min.css'); ?>" rel="stylesheet">
 <!-- Your custom styles (optional) -->
 <!-- Myfonts -->
<link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">

<link href="<?= base_url('vendor/css/style.min.css'); ?>" rel="stylesheet">


  <!-- SELECT 2 -->
  <link href="<?= base_url('vendor/select2/css/select2.css'); ?>" rel="stylesheet" />
  <!-- AKHIR SELECT 2 -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <link href="<?= base_url('assets/css/searchbar.css'); ?>" rel="stylesheet">
  <link rel="icon" href="<?= base_url('assets/img/fav.png'); ?>" type="image/gif" sizes="16x16">
  <!-- Custom Css -->
  <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet">
  <!-- Akhir Custom Css -->

  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <!-- Akhir DataTables -->

  <script src="<?= base_url('vendor/js/jquery-3.1.1.min.js'); ?>"></script>

  <!-- SWEET ALERT2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <!-- AKHIR SWEET ALERT2 -->
  <!-- JS  -->
  <script src="<?= base_url('assets/js/panel_user.js'); ?>"></script>
  <script src="<?= base_url('assets/js/home_user.js'); ?>"></script>
  <!-- AKHIR JS  -->

</head>

<body>

  <header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="<?= base_url(''); ?>">
          <img src="<?= base_url('vendor/img/newlogo.svg'); ?>" width="150">
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?= base_url(); ?>">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="" id="Tentang" >Tentang</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" target="_blank">Hubungi Kami</a>
            </li>

          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">

            <?php if ($this->session->userdata('role')): ?>
              <?php if($this->session->userdata('role') !== 'pengawas'): ?>
              <li class="nav-item">
                <a href="<?= base_url('user/panel'); ?>" class="mt-2 nav-link">
                  Halaman Panel
                </a>
              </li>
              <!--  <li class="nav-item">
                <a class="nav-link waves-effect waves-light mt-2">1
                  <i class="fas fa-envelope"></i>
                </a>
              </li> -->
              <?php else: ?>
                <li class="nav-item">
                <a href="<?= base_url('pengawas'); ?>" class="mt-2 nav-link">
                  Konfirmasi Peserta
                </a>
              </li>
              <?php endif; ?>

              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <img src="
                <?php if ($user['photo_user'] != null): ?>
                  <?= base_url('assets/'); ?><?= $user['photo_user']; ?>
                <?php else: ?>
                  <?= base_url('assets/img_user/default.jpg'); ?>
                <?php endif; ?>

                " class="rounded-circle z-depth-0" alt="avatar image" width="45" height="45">
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                <a class="dropdown-item waves-effect waves-light" href="<?= base_url('user/editprofile'); ?>">Edit Profil</a>
                <a class="dropdown-item waves-effect waves-light tombol-logout" href="<?= base_url('auth/logout'); ?>">Keluar</a>
              </div>
              </li>

            <?php else: ?>
              <li class="nav-item">
              <a href="<?= base_url('auth'); ?>" class="mt-2 nav-link">
                Masuk
              </a>
            </li>&nbsp;

            <li class="nav-item">
              <a href="<?= base_url('auth/registration'); ?>" class="nav-link btn btn-outline-white btn-rounded">
                Daftar !
              </a>
            </li>

            <?php endif; ?>



          </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->
