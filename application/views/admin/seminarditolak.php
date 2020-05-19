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
                       
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($seminarditolak as $row) :?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['nama_seminar']; ?></td>
                            <td><img src="<?= base_url('assets/'); ?><?= $row['poster']; ?>" alt="" class="poster"></td>
                            <td><?= $row['jadwal']; ?>&nbsp;<?= $row['waktu']; ?></td>
                            <td><?= $row['tempat_seminar']; ?></td>
                            <td><?= $row['narasumber']; ?></td>
                            <td><?= $row['jml_peserta']; ?></td>
                            <td><button type="button" class="btn btn-sm btn-primary btn-round waves-effect waves-classic" data-original-title="Detail" data-toggle="modal" data-target="#modalDetail" onclick="getDataSeminar(<?= $row['id_seminar']; ?>);" >Detail</button></td>
                            
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



      <div class="flash-data-success" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
      <div class="flash-data-failed" data-flash="<?= $this->session->flashdata('message_failed'); ?>"></div>


