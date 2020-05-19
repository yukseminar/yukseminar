<section class="batas-section pb-4" style="background: #edf5ff; position: relative;">
    <div class="container">
      <div class="flash">
        <div id="flash-data-absen" data-success="<?= $this->session->flashdata('successabsen'); ?>" data-failed="<?= $this->session->flashdata('failedabsen'); ?>" data-wrong="<?= $this->session->flashdata('failedpass'); ?>"></div>
      </div>
      <div class="card border-top-yukseminar shadow">
        <div class="card-header">
          <div class="row justify-content-between">
            <div class="col-lg-4">
              <h4 class="m-0"><b>Tabel Presensi Peserta</b></h4>
            </div>
            <div class="col-lg-4">
              <form class="" action="<?= base_url('seminar/printKehadiran') ?>" method="post">
                <input type="hidden" name="url" value="<?= $url ?>">
                <button type="submit" class="float-right"><i class="fas fa-print"></i></button>
              </form>
              
            </div>
          </div>
        </div>
        <div class="card-body">
              <!-- AWAL TABEL BARU -->
    <div class="table-wrapper mt-3">
      <table class="table table-striped table-hover" id="TableKehadiran">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Peserta</th>
            <th>No. Hp</th>
            <th>Universitas</th>
            <th>Jurusan</th>
            <th>Status</th>
            <th>Kehadiran</th>
            <th>Kelola</th>
          </tr>
        </thead>
        <tbody>
          <?php $i =1; ?>
          <?php foreach ($daftar as $row): ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $row['nama_user'] ?></td>
            <td><?= $row['phone_user'] ?></td>
            <td><?= $row['universitas'] ?></td>
            <td><?= $row['jurusan'] ?></td>
            <td><?php if ($row['konfirmasi_peserta']==0) {
                echo '<span class="badge badge-warning">Belum diterima</span>';
              }else {
                echo '<span class="badge badge-success">Diterima</span>';
              } ?>
            </td>
            <td>
              <?php if ($row['hadir']==0) {
                echo "Belum hadir";
              }else {
                echo "Sudah hadir";
              } ?>
            </td>
            <td>

                <?php
                if ($row['konfirmasi_peserta']==1) {
                   if ($row['hadir']==0) {
                     ?>
                      <button type="button" name="button" class="btn btn-primary btn-hadir btn-sm" data-toggle="modal" data-target="#hadir" data-peserta="<?= $row['id_peserta'] ?>" data-id="<?= $row['id_user'] ?>" data-whatever="@getbootstrap">Hadir</button>
                <?php
                    }
                }
                 ?>

            </td>
          </tr>
          <?php $i++ ?>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <!-- AKHIR TABEL BARU -->   
        </div>
      </div>
    </div>

     <!-- Hadir Peserta -->
    <div class="modal fade" id="hadir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi password Peserta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('user/absenIkutSeminar') ?>" method="post">
          <div class="modal-body">
              <!-- <input type="text" id="hadir_nama" name="hadir_nama" value=""> -->
              <div class="form-group">
                <label for="nama" class="col-form-label">Nama Peserta</label>
                <input type="text" class="form-control nama"  value="" disabled>
                <input type="hidden" class="nama" name="nama" value="">
              </div>

              <div class="form-group">
                <label for="email" class="col-form-label">Email Peserta</label>
                <input type="text" class="form-control email" value="" disabled >
                <input type="hidden" class="email" name="email" value="">
              </div>

              <div class="form-group">
                <label for="pass" class="col-form-label">Password :</label>
                <input type="password" class="form-control"  name="pass" placeholder="Masukan Password" value="" autofocus required/>
              </div>
              <input type="hidden" name="url" value="<?= $url ?>" />
             
              <input type="hidden" name="peserta" id="peserta" />


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Hadir</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Hadir Peserta -->
</section>

<script type="text/javascript">
  var base_url = '<?= base_url(); ?>';
</script>
<script type="text/javascript" src="<?= base_url('assets/js/absenpeserta.js') ?>">

</script>




