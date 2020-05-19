<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title"><?= $title; ?></h1>
        <div class="page-header-actions">
        </div>
      </div>
    <div class="page-content">
            <!-- Panel -->
            <div class="panel">
              <div class="panel-body container-fluid">

                  <!-- Example Hover Table -->
                  <div class="example-wrap">
                    <h4 class="example-title">Tabel Request Seminar</h4>

                    <div class="example table-responsive">
                      <table class="table table-striped datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nama Seminar</th>
                            <th>Poster</th>
                            <th>Tanggal & Waktu</th>
                            <th>Lokasi Seminar</th>
                            <th>Narasumber</th>
                            <th>Kuota Perserta</th>
                            <th>Detail</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($requestSeminar as $row) :?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['nama_seminar']; ?></td>
                            <td><img src="<?= base_url('assets/'); ?><?= $row['poster']; ?>" alt="" class="poster"></td>
                            <td><?= $row['jadwal']; ?>&nbsp;<?= $row['waktu']; ?></td>
                            <td><?= $row['tempat_seminar']; ?></td>
                            <td><?= $row['narasumber']; ?></td>
                            <td><?= $row['jml_peserta']; ?></td>
                            <td><button type="button" class="btn btn-sm btn-primary btn-round waves-effect waves-classic" data-original-title="Detail" data-toggle="modal" data-target="#modalDetail" onclick="getDataSeminar(<?= $row['id_seminar']; ?>);" >Detail</button></td>
                            <td style="min-width: 70px;">
                                <a class="tombol-silang" data-id="<?= $row['id_seminar']; ?>" data-namaseminar="<?= $row['nama_seminar']; ?>"><button type="button" class="btn btn-sm btn-icon btn-pure btn-default waves-effect waves-classic" data-toggle="tooltip" data-original-title="Tolak">
                                <i class="fas fa-times" aria-hidden="true"></i>
                              </button></a>
                              <a class="tombol-check" href="<?= base_url('admin/terimaSeminar'); ?>/<?= $row['id_seminar']; ?>" data-id="<?= $row['id_seminar']; ?>"><button type="button" class="btn btn-sm btn-icon btn-pure btn-default waves-effect waves-classic" data-original-title="Terima" data-toggle="tooltip">
                                <i class="fas fa-check" aria-hidden="true"></i>
                              </button></a>
                            </td>
                          </tr>

                   
                        <?php $i++ ; ?>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- End Example Hover Table -->

                </div>
              </div>
    </div>
</div>
<!-- End Page -->


                <div class="modal fade modal-primary" id="modalDetail" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Detail Seminar</h4>
                          </div>
                          

                          <div class="modal-body">
                            <table>
                              <tr>
                                <td><strong>Nama Seminar</strong></td>
                                <td>:</td>
                                <td id="nama_seminar"></td>
                              </tr>
                              <tr>
                                <td><strong>Kategori</strong></td>
                                <td>:</td>
                                <td id="kategori_seminar"></td>
                              </tr>
                              <tr>
                                <td><strong>Tanggal</strong></td>
                                <td>:</td>
                                <td id="jadwal"></td>
                              </tr>
                              <tr>
                                <td><strong>Jam</strong></td>
                                <td>:</td>
                                <td id="waktu"></td>
                              </tr>
                              <tr>
                                <td><strong>Lokasi</strong></td>
                                <td>:</td>
                                <td id="tempat_seminar"></td>
                              </tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>:</td>
                                <td id="deskripsi_seminar"></td>
                              </tr>
                              <tr>
                                <td><strong>Narasumber</strong></td>
                                <td>:</td>
                                <td id="narasumber"></td>
                              </tr>
                              <tr>
                                <td><strong>Kuota Peserta</strong></td>
                                <td>:</td>
                                <td id="jml_peserta"></td>
                              </tr>
                              </tr>
                                <td><strong>Paper</strong></td>
                                <td>:</td>
                                <td id="paper"></td>
                              </tr>
                              <tr>
                                <td><strong>Harga Internal</strong></td>
                                <td>:</td>
                                <td id="harga_internal"></td>
                              </tr>
                              <tr>
                                <tr>
                                <td><strong>Harga Eksternal</strong></td>
                                <td>:</td>
                                <td id="harga_eksternal"></td>
                              </tr>
                              <tr>
                                <tr>
                                <td><strong>Rekening Bank</strong></td>
                                <td>:</td>
                                <td id="bank_rekening"></td>
                              </tr>
                              <tr>
                                <tr>
                                <td><strong>Atas nama</strong></td>
                                <td>:</td>
                                <td id="an_penyelenggara"></td>
                              </tr>
                              <tr>
                                <tr>
                                <td><strong>No. Rek</strong></td>
                                <td>:</td>
                                <td id="rekening_seminar"></td>
                              </tr>
                              <tr>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-pure waves-effect waves-classic" data-dismiss="modal">Close</button>
                           
                          </div>
                       
                        </div>
                      </div>
                    </div>


                    <div class="modal fade modal-primary" id="modalTerima" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Terima Seminar</h4>
                          </div>
                          

                          <div class="modal-body">
                            <p>Apakah anda yakin untuk menerima seminar <span class="nama_seminar"></span>?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-pure waves-effect waves-classic" data-dismiss="modal">Close</button>
                            <a href="" class="tombol-terima"><button type="button" class="btn btn-primary waves-effect waves-classic">Terima</button></a>
                           
                          </div>
                       
                        </div>
                      </div>
                    </div>

                     <div class="modal fade modal-danger" id="modalTolak" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tolak Seminar</h4>
                          </div>
                          <form action="<?= base_url('admin/tolakSeminar'); ?>" method="post">
                          <div class="modal-body">
                            <p>Apakah anda yakin untuk menolak seminar <span class="nama_seminar"></span>?</p>
                            <div class="form-group">
                              <textarea class="form-control" rows="5" name="keterangan" placeholder="Masukan krtik dan saran agar seminar selanjutnya dapat terima..."></textarea>
                            </div>
                            <input type="hidden" name="id_seminar" id="id2">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-pure waves-effect waves-classic" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-classic">Tolak</button>
                          </form>
                           
                          </div>
                       
                        </div>
                      </div>
                    </div>

      <div class="flash-data-success" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
      <div class="flash-data-failed" data-flash="<?= $this->session->flashdata('message_failed'); ?>"></div>


