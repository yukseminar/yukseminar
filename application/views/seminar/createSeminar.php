

<section class="batas-section pb-5" style="background: #edf5ff; position: relative;">
<div class="container">
<!-- Container -->
<div class="flash-data" data-flash="<?= $this->session->flashdata('message'); ?>" data-failed="<?= $this->session->flashdata('messagefailed'); ?>"></div>
<div class="flash-data-failed" data-failed="<?= $this->session->flashdata('messagefailed'); ?>"></div>
<div class="row">
  <div class="col-lg-7" style="background: white">
    <img src="<?= base_url('assets/img/step.png'); ?>" style="width:100%; height: auto;">
  </div>
  <div class="col-lg-5" style="background: white">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12 mt-4 mb-4 text-center">
          <img src="<?= base_url('assets/img/newlogo2.svg'); ?>" class="logo-form">
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12">
          <form method="post" action="<?= base_url('seminar/regisSeminar'); ?>" enctype="multipart/form-data">
          <div class="row form-daftar mb-3">
            <div class="header-float mb-4">
              <h5 class="m-0"><i class="fas fa-pencil-alt"></i> Form Daftar Seminar</h5>
            </div>
            <div class="form-group col-12 p-0">
              <label for="judul_seminar"><b>Judul Seminar :</b></label>
              <input type="text" id="judul_seminar" class="form-control form-control-sm" name="namaseminar" placeholder="Masukan judul seminar" value="<?= set_value('namaseminar'); ?>" required>
              <?= form_error('namaseminar','<small class="text-danger">','</small>'); ?>
            </div>

            <div class="form-group col-12 p-0">
              <label for="kategori_seminar"><b>Kategori Seminar :</b></label>
              <select id="kategori_seminar" class="form-control form-control-sm select2" name="kategori" required>
                <option value="">Pilh Kategori</option>
                <?php foreach ($kategori as $row): ?>
                  <option value="<?= $row['id_kategori'] ?>" <?php echo set_select('kategori',$row['id_kategori']); ?>><?= $row['nama_kategori'] ?></option>
                <?php endforeach; ?>
              </select>
              <?= form_error('kategori','<small class="text-danger">','</small>'); ?>
            </div>

            <div class="form-group col-12 p-0">
              <label for="descseminar"><b>Deskripsi Seminar :</b></label>
              <textarea class="form-control form-control-sm" rows="4" id="descseminar" name="descseminar" placeholder="Deskripsikan seminar kamu" required><?php echo set_value('descseminar'); ?></textarea>
              <?= form_error('descseminar','<small class="text-danger">','</small>'); ?>
            </div>

            <div class="form-group  col-12 p-0">
              <label for="alamat_seminar"><b>Alamat / Lokasi Seminar :</b></label>
              <textarea type="text" id="alamat_seminar" class="md-textarea form-control form-control-sm" rows="2" name="tempatseminar" required placeholder="Masukan alamat seminar kamu"><?php echo set_value('tempatseminar'); ?></textarea>
              <?= form_error('tempatseminar','<small class="text-danger">','</small>'); ?>
            </div>
            <div class="col-6 p-0 pr-3">
                
                <input type="text" class="form-control form-control-sm" name="nama_gedung" required placeholder="Gedung (cth: Gedung A)" value="<?php echo set_value('nama_gedung'); ?>">
                <?= form_error('nama_gedung','<small class="text-danger">','</small>'); ?>
            </div>
            <div class="col-6 p-0 pl-3">
             
                <input type="text" class="form-control form-control-sm" name="lantai" required placeholder="Lantai (cth: 15)" value="<?php echo set_value('lantai'); ?>">
              
                <?= form_error('lantai','<small class="text-danger">','</small>'); ?>
            </div>

            <div class="form-group col-12 p-0 mt-3">
              <label for="narasumber"><b>Narasumber :</b></label>
              <input type="text" id="narasumber" class="form-control form-control-sm" name="narasumber" placeholder="Masukan nama narasumber" required value="<?php echo set_value('narasumber'); ?>">
              <?= form_error('narasumber','<small class="text-danger">','</small>'); ?>
            </div>


            <div class="col-6 p-0 pr-3">
                <label for="jadwal_seminar"><b>Jadwal Seminar :</b></label>
                <input type="date" class="form-control form-control-sm" name="jadwalseminar" id="jadwal_seminar" name="jadwalseminar" required value="<?php echo set_value('jadwalseminar'); ?>">
                <?= form_error('jadwalseminar','<small class="text-danger">','</small>'); ?>
            </div>
            <div class="col-6 p-0 pl-3">
                <label for="jam_seminar"><b>Jam Seminar :</b></label>
                <input type="time" id="jam_seminar" class="form-control form-control-sm" name="jamseminar" min="06:00" max="21:00" required value="<?php echo set_value('jamseminar'); ?>">
                <small class="text-danger">Format 24 jam</small>
                <?= form_error('jamseminar','<small class="text-danger">','</small>'); ?>
            </div>

            <div class="form-group col-12 p-0">
              <label for="jumlah_peserta"><b>Jumlah Peserta / Kuota</b></label>
              <input type="text" class="form-control form-control-sm" name="jumlahpeserta" id="jumlah_peserta" required name="jml_peserta" placeholder="cth : 100" value="<?php echo set_value('jumlahpeserta'); ?>">
              <?= form_error('jamseminar','<small class="text-danger">','</small>'); ?>
            </div>


                <div class="form-group  col-12 p-0">
                  <label for="paper"><b>Paper :</b></label>
                  <div class="custom-control custom-radio form-check-inline">
                      <input type="radio" class="custom-control-input" id="paper" name="paper"  value="1" <?php echo set_value('paper', 1) == 1 ? "checked" : ""; ?>>
                      <label class="custom-control-label" for="paper">Ya</label>
                  </div>
                  <div class="custom-control custom-radio form-check-inline">
                      <input type="radio" class="custom-control-input" id="paper2" name="paper"  value="0" <?php echo set_value('paper', 0) == 0 ? "checked" : ""; ?>>
                      <label class="custom-control-label" for="paper2">Tidak</label>
                  </div>
                </div>

                <div class="form-group col-12 p-0">
                  <label for=""><b>Berbayar :</b></label>
                  <div class="custom-control custom-radio form-check-inline">
                      <input type="radio" class="custom-control-input" id="rdbayar" name="berbayar"  value="1" <?php echo set_value('berbayar', 1) == 1 ? "checked" : ""; ?>>
                      <label class="custom-control-label" for="rdbayar">Ya</label>
                  </div>
                 <div class="custom-control custom-radio form-check-inline">
                      <input type="radio" class="custom-control-input" id="rdgratis" name="berbayar"  value="0" <?php echo set_value('berbayar', 0) == 0 ? "checked" : ""; ?>>
                      <label class="custom-control-label" for="rdgratis">Tidak</label>
                  </div>
                </div>


                <div class="form-bayar col-lg-12 p-0">
                  <div class="form-group">
                    <label for="exampleInputPassword1"><b>Rekening</b></label>
                    <input type="text" class="form-control form-control-sm" name="rekening" placeholder="Masukan nomor rekening" value="<?php echo set_value('rekening'); ?>">
                    <?= form_error('rekening','<small class="text-danger">','</small>'); ?>
                  </div>


                <div class="form-group">
                  <label for="exampleInputPassword1"><b>Bank</b></label>
                  <input type="text" class="form-control form-control-sm" name="bank" placeholder="(cth: BCA/BRI/BNI/Mandiri)" value="<?php echo set_value('bank'); ?>">
                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1"><b>Atas Nama</b></label>
                  <input type="text" class="form-control form-control-sm" name="atasnama" placeholder="Atas nama" value="<?php echo set_value('atasnama'); ?>">
                </div>


                <div class="row mb-4">
            


                 <div class="col-6">
                    <label for="exampleInputPassword1"><b>Harga Umum</b></label>
                    <div class="md-form input-group m-0">
                        <div class="input-group-prepend">
                          <div class="input-group-text md-addon">Rp</div>
                        </div>
                        <input type="text" class="form-control form-control-sm" name="hargaumum" placeholder="Harga perindividu">
                        <?= form_error('hargaumum','<small class="text-danger">','</small>'); ?>
                      </div>

                </div>

                <div class="col-6">
                    <label for="exampleInputPassword1"><b>Harga Internal</b></label>
                    <div class="md-form input-group m-0">
                        <div class="input-group-prepend">
                          <span class="input-group-text md-addon">Rp</span>
                        </div>
                        <input type="text" class="form-control form-control-sm hargainternal" name="hargainternal" placeholder="Harga perindividu">
                        <?= form_error('hargainternal','<small class="text-danger">','</small>'); ?>
                      </div>

                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1"><b>Kode Promo</b></label><small class="text-danger font-italic"> * Kode digunakan untuk harga internal</small>
                  <input type="text" class="form-control form-control-sm kode_promo" name="kode_promo" placeholder="Kode Promo (cth: XYZ22)">
                   <?= form_error('kode_promo','<small class="text-danger">','</small>'); ?>
                </div>


              </div>


              <div class="form-group">
                <label><b>Poster Seminar :</b></label><small class="text-danger font-italic"> * Pastikan format A4 / 210mm x 297mm</small>
                <div class="file-field">
                  <div class="btn btn-outline-primary waves-effect btn-sm float-left m-0 btn-upload-poster">
                    <span>Choose file</span>
                    <input type="file" name="poster">
                  </div>
                  <div class="file-path-wrapper">
                    <span>No file uploaded</span>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 p-0">
                <div class="">
                  <button class="btn btn-primary m-0 w-100" type="submit">Submit
                  </button>
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
<!-- Akhir container -->
</section>

<script type="text/javascript" src="<?= base_url('assets/js/createSeminar.js');?>"></script>

<!-- <script src="vendor/js/jquery-3.1.1.min.js"></script> -->
<!-- <script type="text/javascript">


</script> -->
