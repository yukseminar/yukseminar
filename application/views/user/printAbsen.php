<!DOCTYPE html>
<html>
<head>
  <title>Print Absen Tanda Tangan</title>
  <link rel="stylesheet" href="<?= base_url() ?>/vendor/css/stylepdf.css">


   <!-- Myfonts -->
  <link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">


  <link href="<?= base_url() ?>vendor/open-iconic-master/font/css/open-iconic-bootstrap.css" rel="stylesheet">
  <style>
  .text-center {
    text-align: center;
  }

  .garis-absensi:after {
    content: ;
    display: block;
    border-bottom: 1px dotted #333;
    width:90%;
    margin-left:  15px;
    padding-bottom: 5px;
    margin-bottom: -8px;
  }
  </style>
</head>

<body id="page-top">
<div class="container">


  <div class="row">
    <img src="<?= base_url('assets/img/newlogo.png') ?>" class="logo-absen">
  </div>

  <div class="row mt-3 mb-3">
    <div class="col-lg-12">
      <h2 class="text-center"><b>Absensi Peserta <?= $dataseminar['nama_seminar'] ?></b></h2>
    </div>
  </div>

    <p><b>  Hari & Tanggal :</b> <?=  $jadwal ?></p>
    <p><b>  Waktu Seminar :</b> <?=  $dataseminar['waktu'] ?> </p>

<div class="row">

  <table class="" border="1"  width="100%">

    <tr border="1" class="text-center">
      <th class="text-center" width="6%">No</th>
      <th class="text-center" width="15%">Nim</th>
      <th class="text-center" width="20%">Nama</th>
      <th class="text-center" width="15%">Jurusan</th>
      <th class="text-center" width="19%">Universitas</th>
      <th class="text-center" colspan="2" width="25%">Tanda Tangan</th>
    </tr>
    <?php
    $i =1 ;
    $nim = null;
    foreach ($peserta as $row):
      if ($i%2==1) {
    ?>
          <tr>
            <td class="text-center"><?= $i ?></td>
            <td><?= $row['nim_user'] ?></td>
            <td><?= $row['nama_user'] ?></td>
            <td><?= $row['jurusan'] ?></td>
            <td><?= $row['universitas'] ?></td>
            <td><?= $i ?><span class="garis-absensi"></span></td>
            <td></td>
          </tr>
      <?php
      }else{
        ?>
          <tr>
            <td class="text-center"><?= $i ?></td>
            <td><?= $row['nim_user'] ?></td>
            <td><?= $row['nama_user'] ?></td>
            <td><?= $row['jurusan'] ?></td>
            <td><?= $row['universitas'] ?></td>
            <td></td>
            <td><?= $i ?><span class="garis-absensi"></span></td>
          </tr>
        <?php
      }

      $i++;
      endforeach;
    ?>

  </table>
</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
