<section class="batas-section" style="background: #edf5ff; position: relative;">
  <div class="container">

    <div class="row">
      <div class="col-lg-12">
        <div class="card border-top-yukseminar shadow mb-4">
          <div class="card-header">
           
              <div class="row">
                <div class="col-lg-12">
                  <h4 class="m-0" style="font-weight: 600;"><b>Pendaftaran Pengawas</b></h4>
                </div>
              </div>
            
          </div>
          <div class="card-body">
        

      <div class="col-lg-12">
        <div class="row">
        <div class="col-lg-6 note-pengawas">
          <div class="row">
          <p class="note note-primary mb-0"><strong>Catetan:</strong> akun pengawas hanya dapat digunakan untuk menerima konfirmasi pembayaran peserta dan paper peserta</p>
          </div>
          <div class="row">
            <div class="col-lg-12 container-book">
            <img src="<?= base_url() ?>assets/img/note.svg" class="vert-move mx-auto d-block" />
            </div>
          </div>
        </div>
        <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
          <div class="row mt-4">
            <div class="col-lg-12">
              <form method="post" action="<?= base_url('user/daftarPengawasPost')  ?>" >
              <div class="row form-daftar mb-3">
                <div class="header-float mb-4">
                  <h5 class="m-0"><i class="fas fa-user-plus"></i> Daftar Pengawas</h5>
                </div>
                <div class="form-group col-12 p-0">
                  <label for="nama_pengawas"><b>Nama :</b></label>
                  <input type="text" id="nama_pengawas" class="form-control form-control-md" name="username" placeholder="Masukan nama pengawas" required>
                  <?= form_error('username','<small class="text-danger">','</small>'); ?>
                </div>
                <div class="form-group col-12 p-0">
                  <label for="email_pengawas"><b>Email :</b></label>
                  <input type="email" id="email_pengawas" class="form-control form-control-md" name="email" placeholder="Masukan email pengawas" required>
                  <?= form_error('email','<small class="text-danger">','</small>'); ?>
                </div>
                <div class="form-group col-12 p-0">
                  <label for="pass"><b>Password :</b></label>
                  <input type="password" id="pass" class="form-control form-control-md" name="pass" placeholder="Masukan password" required>
                  <?= form_error('pass','<small class="text-danger">','</small>'); ?>
                </div>
                <div class="form-group col-12 p-0">
                  <label for="pass"><b>Konfirmasi Password :</b></label>
                  <input type="password" id="pass" class="form-control form-control-md" name="pass2" placeholder="Masukan password lagi" required>
                  <?= form_error('pass2','<small class="text-danger">','</small>'); ?>
                </div>
                <input type="hidden" name="id_seminar" value="">
                <input type="hidden" name="url" value="<?= $url ?>">
                <div class="col-lg-12 p-0">
                  <div class="mt-2">
                    <button class="btn btn-primary m-0 w-100" type="submit">Submit
                    </button>
                  </div>
                </div>
                
              </div>
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
  
 
  


  </div>
  <!-- Akhir container -->
</section>


