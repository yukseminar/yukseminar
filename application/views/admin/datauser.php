<!-- Page -->
<div class="page">
  <div class="page-content container-fluid">
    <div class="row" data-plugin="matchHeight" data-by-row="true">

   
   
    <?php foreach ($getalluser as $row): ?>
      <div class="col-xl-4 col-lg-6">
        <!-- Widget Info -->
        <div class="card card-shadow">
          <div class="card-header cover overlay">
            <div class="cover-background h-150" style="background-image: url('<?= base_url('vendor/admin_template/global/photos/placeholder.png'); ?>"></div>
          </div>
          <div class="card-block px-30 py-20">
            <div class="mb-10 text-center" style="margin-top: -70px;">
              <a class="avatar avatar-100 bg-white img-bordered" href="javascript:void(0)">
                <img src="<?= base_url('assets'); ?>/<?= $row['photo_user']; ?>" alt="">
              </a>
            </div>
            <div class="mb-15 text-center">
              <div class="font-size-20"><?= $row['nama_user']; ?></div>
              <?php if($row['is_active'] == 1):?>
              <div class="font-size-14 grey-500">
                <span><?= $row['seminar'];?> Buat Seminar</span> |
                <span><?= $row['peserta'];?> Mengikut Seminar</span>
              </div>
              <?php else: ?>
              <?php endif; ?>
              <?php if($row['is_active'] == 1):?>
                <div class="font-size-15"><span class="badge badge-success">Aktif</span></div>
              <?php else: ?>
                <div class="font-size-15"><span class="badge badge-warning">Belum Aktif</span></div>
              <?php endif; ?>
              
            </div>
            <div class="col-lg-12 p-0">
              <button class="btn btn-outline-primary btn-detail-user" data-iduser="<?= $row['id_user']; ?>" style="width: 100%">Detail</button>
            </div>
          </div>
        </div>
        <!-- End Widget Info -->
      </div>
    <?php endforeach; ?>

      

    </div>
  </div>
</div>
<!-- End Page -->

<div class="modal fade modal-primary" id="modaldetailuser" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Detail User</h4>
                          </div>
                          

                          <div class="modal-body">
                            <pre>
                             
                            Email           : <span id="email"></span>
                            No. HP          : <span id="hp"></span>
                            NIM             : <span id="nim"></span>
                            Jurusan         : <span id="jurusan"></span>
                            Universitas     : <span id="universitas"></span>
                            Alamat          : <span id="alamat"></span>
                            bday            : <span id="bday"></span>
                            Akun Dibuat     : <span id="created_at"></span>
                            Terakhir diedit : <span id="updated_at"></span>
                           
                            </pre>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-pure waves-effect waves-classic" data-dismiss="modal">Close</button>
                          
                          </div>
                    
                        </div>
                      </div>
                    </div>