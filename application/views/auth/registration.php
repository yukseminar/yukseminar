<div id="">
    <div class="container bungkus">
        <div class="row align-items-center h-100">
            <div class="col-lg-12 kotak-login mx-auto p-0">

                <div class="col-lg-12 gambar">
                    <a href="<?= base_url('user'); ?>"><i class="fas fa-times float-right"></i></a>
                    <div class="mt-3">
                        <?= $this->session->flashdata('message'); ?>
                    </div>
                    <h1>Daftar Akun</h1><br />
                        <form action="<?= base_url('auth/registration'); ?>" method="post" class="form">

                         <div class="form-group">
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username" value="<?= set_value('username'); ?>">
                            <?= form_error('username','<small class="text-danger">','</small>'); ?>
                          </div>
                          <div class="form-group">
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?= set_value('email'); ?>">
                            <?= form_error('email','<small class="text-danger">','</small>'); ?>
                          </div>
                            <div class="form-group">
                             <input type="text" name="jurusan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Jurusan anda (Kosongkan Jika tidak ada)" value="<?= set_value('jurusan'); ?>">
                         </div>
                         <div class="form-group">
                            <input type="text" name="universitas" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Universitas anda (Kosongkan Jika tidak ada)" value="<?= set_value('universitas'); ?>">
                        </div>
                         <div class="form-group">
                            <input type="text" name="nim" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="NIM anda (Kosongkan Jika tidak ada)" value="<?= set_value('nim'); ?>" >
                        </div>
                        <div class="form-group">
                          <input type="text" name="phone_user" class="form-control"  placeholder="Nomer HP" value="<?= set_value('phone_user'); ?>" >
                          <?= form_error('phone_user','<small class="text-danger">','</small>'); ?>
                        </div>

                          <div class="row">
                            <div class="col-lg-6 pr-2">
                              <div class="form-group">
                                <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            <?= form_error('pass','<small class="text-danger">','</small>'); ?>
                              </div>
                            </div>
                            <div class="col-lg-6 pl-2">
                              <div class="form-group">
                                <input type="password" name="pass2" class="form-control" id="exampleInputPassword1" placeholder="Konfirmasi Password">
                                <?= form_error('pass2','<small class="text-danger">','</small>'); ?>
                              </div>
                            </div>
                            
                          </div>
                          
                          <!-- <div class="form-check mb-2">
                            <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" required="">
                            <label class="form-check-label" for="exampleCheck1">Remember me!</label>
                          </div> -->
                          <button type="submit" class="btn abu putih w-100 m-0">Daftar</button>

                        </form>
                        <p class="p-daftar">Jika sudah mempunyai akun silakan Login</p><hr>
                        <a href="<?= base_url('auth'); ?>"><button type="submit" class="btn biru putih w-100 mb-3 m-0">Login</button></a>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- mx-auto -->
<!-- buat ketengahin col -->
