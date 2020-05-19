<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title"><?= $title; ?></h1>
        <div class="page-header-actions">
          <button class="btn btn-sm btn-primary btn-round waves-effect waves-classic btntambah-kategori" data-toggle="modal" data-target="#modalKategori">
        <i class="fas fa-plus" aria-hidden="true"></i>
        <span class="hidden-sm-down">Tambah Kategori</span>
      </button>
        </div>
      </div>

    <div class="page-content">
            <!-- Panel -->
            <div class="panel">
              <div class="panel-body container-fluid">

                  <!-- Example Hover Table -->
                  <div class="example-wrap">
                    <h4 class="example-title">Tabel Kategori</h4>

                    <div class="example table-responsive">
                      <table class="table table-striped datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Tanggal Buat</th>
                            <th>Tanggal Ubah</th>
                            <th>Aktif</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($kategori as $row) :?>
                          <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
                            <td><?= $row['created_at']; ?></td>
                            <td><?= $row['updated_at']; ?></td>
                            <?php if ($row['aktif'] == '1'): ?>
                            <td><i class="fas fa-check" style="color:#4caf50"></i></td>
                            <?php else: ?>
                            <td><i class="fas fa-times" style="color:#f44336"></i></td>

                            <?php endif; ?>
                            <td>
                              <button type="button" class="btn btn-sm btn-icon btn-pure btn-default waves-effect waves-classic btnedit-kategori" data-toggle="modal" data-target="#modalKategori" data-nama_kategori="<?= $row['nama_kategori']; ?>" data-id_kategori="<?= $row['id_kategori']; ?>">
                                <i class="p-0 icon md-wrench" aria-hidden="true" style="color: black; Font-size: 16px;"></i>
                              </button>
                              <?php if ($row['aktif'] == '1'): ?>
                                <button type="button" class="btn btn-sm btn-icon btn-pure btn-default waves-effect waves-classic" data-toggle="tooltip" data-original-title="Cannot be delete" disabled>
                                  <i class="p-0 fas fa-trash-alt" aria-hidden="true" style="color: gray; Font-size: 16px;"></i>
                                </button>
                              <?php else: ?>
                                <a class="tombol-hapus" href="<?= base_url('admin/hapusKategori'); ?>/<?= $row['id_kategori']; ?>" data-nama_kategori="<?= $row['nama_kategori']; ?>"><button type="button" class="btn btn-sm btn-icon btn-pure btn-default waves-effect waves-classic" data-toggle="tooltip" data-original-title="Delete">
                                  <i class="p-0 fas fa-trash-alt" aria-hidden="true" style="color: black; Font-size: 16px;"></i>
                                </button></a>
                              <?php endif; ?>
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

<?php if (form_error('nama_kategori')) : ?>
<script type="text/javascript">
$(document).ready( function () {
$('#modalKategori').modal('show');
});
</script>
<?php endif; ?>


<div class="modal fade modal-primary" id="modalKategori" aria-labelledby="exampleModalPrimary" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title">Tambah Kategori</h4>
                          </div>
                          <form class="modal-form" action="<?= base_url('admin/tambahkategori'); ?>" method="post">

                          <div class="modal-body">
                            <input type="text" class="form-control" id="nama_kategori" placeholder="Masukan Nama Kategori" name="nama_kategori">
                            <?= form_error('nama_kategori','<small class="text-danger">','</small>'); ?>

                            <input type="hidden" name="id_kategori" value="" id="id2">

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-pure waves-effect waves-classic" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-classic">Simpan</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>

      <div class="flash-data-success" data-flash="<?= $this->session->flashdata('message'); ?>"></div>
      <div class="flash-data-failed" data-flash="<?= $this->session->flashdata('message_failed'); ?>"></div>