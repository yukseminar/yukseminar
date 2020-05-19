<div id="">
    <div class="container bungkus">
        <div class="row align-items-center">
            <div class="col-lg-12 kotak-login mx-auto p-0">
                <div class="col-lg-12 gambar">
                    <a href="<?= base_url(); ?>"><i class="fas fa-times float-right"></i></a>
                    <div class="mt-3">
                        <?= $this->session->flashdata('message'); ?>
                    </div>

                    <h1>Masuk</h1><br />
                        <form action="<?= base_url('auth'); ?>" method="post" class="form">
                            <img class="mx-auto d-block" src="vendor/img/people.svg" width="160"><br />
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukan Email" value="<?= set_value('email'); ?>">
                            <?= form_error('email','<small class="text-danger">','</small>'); ?>
                        </div>
                          <div class="form-group">
                            <input type="password" name="pass" class="form-control" id="exampleInputPassword1" placeholder="Masukan Password">
                            <?= form_error('pass','<small class="text-danger">','</small>'); ?>
                          </div>
                        <button class="btn abu putih w-100 m-0" type="submit">Masuk</button>

                        </form>
                        <p class="p-daftar">Jika belum mempunyai akun silakan Daftar</p><hr>
                        <a href="<?= base_url('auth/registration'); ?>"><button class="btn biru putih w-100 mb-3 m-0" type="submit">Daftar</button></a>

                </div>
            </div>
        </div>

</div>


</div>
