<section class="batas-section" style="background: #edf5ff; position: relative;">

<!-- Container -->
<div class="container">
<div class="row">
      <div class="col-lg-12">
        <div class="card border-top-yukseminar shadow mb-4">
          <div class="card-header">
           
              <div class="row">
                <div class="col-lg-12">
                  <h4 class="m-0" style="font-weight: 600;"><b>Daftar Konfirmasi Peserta</b></h4>
                </div>
              </div>
            
          </div>
          <div class="card-body">
            <p class="note note-primary mb-4"><strong>Nama Seminar:</strong> <?= $seminar['nama_seminar'] ?></p>
            <table class="table table-striped" id="tablepengawas"> 
              <thead>
      <tr>
        <th>No</th>
        <th>Nama Peserta</th>
        <th>Universitas</th>
        <th>Jurusan</th>
        <th>No. HP</th>
        <th>Paper</th>
        <th>Bukti Transfer</th>
        <th>Konfirmasi</th>

      </tr>
      </thead>
      <tbody>
      <?php $i=1;
      foreach ($list as $row):
        ?>
        <tr>
          <td><?= $i ?></td>
          <td><?= $row['nama_user'] ?></td>
          <td><?= $row['universitas'] ?></td>
          <td><?= $row['jurusan'] ?></td>
          <td><?= $row['phone_user']; ?></td>
    
          
            <td>
              <?php if ($seminar['paper']==1): ?>
                <?php if ($row['paper_peserta']==null): ?>
                  Belum Dikirim
                <?php else: ?>
                <form class="" action="<?= base_url('assets/') ?><?= $row['paper_peserta'] ?>" method="get">
                  <button type="submit" class="btn btn-primary btn-sm">Cek Paper</button>
                </form>
               <?php endif; ?>
             
            <?php else: ?>
              Tidak ada paper
            <?php endif; ?>

             </td>
          

          
          <td>
            <?php if ($row['pembayaran']==1): ?>
              <?php if ($row['rekening_user']==null): ?>
                Belum dibayar
              <?php else: ?>
                <button type="button" class="btn btn-primary btn-sm btn-bukti" data-promo="<?= $row['promo']; ?>" data-rekening="<?= $row['rekening_user'] ?>" data-anuser="<?= $row['an_user'] ?>" data-hargaumum="<?= $row['harga_umum']; ?>" data-hargainternal="<?= $row['harga_seminar']; ?>" data-bukti="<?= $row['pembayaran_peserta'] ?>">Bukti Transfer</button>
                <?php endif; ?>
                </a>

            <?php else: ?>
              Gratis!
            <?php endif; ?>

            </td>
            
          <td>

            <?php if ($row['konfirmasi_peserta']==0): ?>
              <form class="" action="<?= base_url('pengawas/konfirmasi') ?>" method="post">
                <input type="hidden" value="<?= $row['id_peserta'] ?>" name="peserta">
                <input type="hidden" value="<?= $row['id_seminar'] ?>" name="seminar">

               <button type="submit" name="button"
               class="btn btn-primary btn-sm"
              <?php if ($row['paper']==1): //cek ada paper? jika ada apa sudah kirim? jika belum disabled?>
                <?php if ($row['paper_peserta']==null): ?>
                  disabled
                <?php endif; ?>
              <?php endif; ?>
              <?php if ($row['pembayaran']==1): //cek ada pembayaran? jika ada apa sudah bayar? jika belum disabled?>
                <?php if ($row['pembayaran_peserta']==null): ?>
                  disabled
                <?php endif; ?>
              <?php endif; ?>
               >
               Terima
             </button>
             </form>
             <?php else: ?>
               <span class="badge badge-success">Terkonfirmasi</span>
             <?php endif; ?>
          </td>
        </tr>

      <?php $i++; ?>
      <?php endforeach; ?>
      </tbody>

    </table>

          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal bukti-->
<div class="modal fade" id="buktitransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bukti Transfer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row justify-content-center">
                    <div class="col-lg-8">
                      <h5 class="text-center">Jumlah yang Harus dibayar:</h5>
                    </div>
                  </div>
                  <div class="row justify-content-center ">
                    <div class="col-lg-5">
                      <input type="text" class="form-control kotak-harga" id="harga" disabled>
                    </div>
                  </div>
                    <div class="form-group mt-3">
                      <label for="bank"><b>Dari Rekening : </b></label>
                      <input type="text" class="form-control" id="bank"  disabled>
                      <input type="text" class="form-control mt-2" id="an" disabled>
                      <!-- <input type="text" class="form-control mt-2" id="rek" disabled> -->
                    
                    </div>
                    <div class="col-lg-12 p-0">
                      <label for="img-bukti"><b>Struk Bukti : </b></label>
                      <div class="text-center">
                      
                      <img id="img-bukti" src="" class="w-100">
                      </div>
                    </div>

                  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--akhir modal-->
  <div class="row flash-content1">
    <div id="flash-data-peserta" data-success="<?= $this->session->flashdata('selesaisuccess'); ?>" data-failed="<?= $this->session->flashdata('selesaifailed'); ?>"></div>
  </div>

    


<script type="text/javascript">
  var base_url = '<?= base_url(); ?>';
</script>
  <script type="text/javascript" src="<?= base_url('assets/js/pengawas.js') ?>">

  </script>
