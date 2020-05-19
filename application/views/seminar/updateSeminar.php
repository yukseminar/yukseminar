

<section class="batas-section" style="background: #edf5ff; position: relative;">
<!-- Container -->
<div class="container">
  <div class="flash-content1">
    <div id="flash-data-edit" data-success="<?= $this->session->flashdata('message'); ?>" data-failed="<?= $this->session->flashdata('messagefailed'); ?>"></div>

  </div>

	
	<div class="col-lg-12">

		<div class="row mt-2">
			<div class="col-md-4 poster p-0">
				<form class="" action="<?= base_url('seminar/editSeminarPhoto'); ?>" method="post" enctype="multipart/form-data">
					<div class="container_pict">
						  <img src="<?= base_url('assets/'); ?><?= $data['poster']; ?>" class="edit-profile img-thumbnail w-100 img_pict">
						  <input type="file" id="fileInput" name="photo" style="display: none;" class="btn-upload-profile"/>
						  <div class="overlay_pict" onclick="chooseFile();"  style="cursor: pointer;">
						    <div class="text_pict">Upload poster</div>
						  </div>
						</div>
						<p class="file-path-wrapper text-center mt-2"></p>
						<input type="hidden" name="url" value="<?= $data['url_seminar'] ?>">
						<input type="hidden" name="id" value="<?= $data['id_seminar'] ?>">
						<input type="hidden" name="alamatlama" value="<?= $data['poster'] ?>">

						<button class="btn btn-primary btn-block mt-3" type="submit">Save Photos</button>
				</form>

			</div>

			<div class="col-md-8">
				<h5>
					<span class="badge badge-secondary">
						<?php if ($data['pembayaran']==0): ?>
							Gratis !
						<?php else: ?>
							Berbayar !
						<?php endif; ?>

					</span>
				</h5>
				<h1><?= $data['nama_seminar'] ?></h1>
				<span class="font-italic font-weight-bold">Description:</span>
				<p><?= $data['deskripsi_seminar'] ?></p>
				<button type="button" class="btn btn-secondary tombol2" data-toggle="modal" data-target="#editSeminar" data-whatever="@getbootstrap"><span class="oi oi-wrench"></span> Edit Seminar</button>
				<button type="button" class="btn btn-primary tombol2 ml-1" onclick="copyLink();"><span class="oi oi-share-boxed"></span> Bagikan Seminar</button>
        <input type="text" style="opacity:0;" id="link" value="<?= base_url('seminar/detailSeminar/')  ?><?= $data['url_seminar'] ?>">
				<hr class="my-4">
				<h5 class="more">Detail Information :</h5>


				<table class="table table-striped  mt-2">

					<tr>
						<th>Nama</th>
						<td><?= $data['nama_seminar'] ?></td>
					</tr>

					<tr>
						<th>Kategori</th>
						<td><?= $get_kategori['nama_kategori'] ?></td>
					</tr>

					<tr>
						<th>Jadwal</th>
						<td><?= date("d/m/Y", strtotime($data['jadwal'])); ?></td>
					</tr>

					<tr>
						<th>Alamat Seminar</th>
						<td><?= $data['tempat_seminar'] ?></td>
					</tr>

					<tr>
						<th>Nama Gedung</th>
						<td><?= $data['nama_gedung'] ?></td>
					</tr>

					<tr>
						<th>Lantai</th>
						<td><?= $data['lantai'] ?></td>
					</tr>

					<tr>
						<th>Narasumber</th>
						<td><?= $data['narasumber'] ?></td>
					</tr>

					<tr>
						<th>Paper</th>
						<td>
							<?php if ($data['paper']==0): ?>
								Tidak
							<?php else: ?>
								Ya
							<?php endif; ?>
						</td>
					</tr>

					<tr>
						<th>Kuota</th>
						<td><?= $data['jml_peserta'] ?></td>
					</tr>
					<?php if ($data['pembayaran']==1): ?>
						<tr>
							<th>Biaya Internal</th>
							<td><?= $data['harga_seminar'] ?></td>
						</tr>
						<tr>
							<th>Biaya Umum</th>
							<td><?= $data['harga_umum'] ?></td>
						</tr>
					<?php else: ?>
						<tr>
							<th>Biaya</th>
							<td>Gratis</td>
						</tr>
					<?php endif; ?>

				</table>

				
			</div>
		</div>

		<hr class="my-5">
		<div class="row">
			
		</div>
	</div>


</div>
<!-- Akhir container -->
</section>


<!-- Modal Edit-->
<div class="modal fade" id="editSeminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Seminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('seminar/editSeminar') ?>" method="post">
					<input type="hidden" name="url" value="<?= $data['url_seminar'] ?>">
        		<div class="form-group">
			    		<label for="namaseminar"><b>Nama Seminar</b></label>
			    		<input type="text" class="form-control" id="namaseminar" value="<?= $data['nama_seminar'] ?> " disabled>
			  		</div>
			  		<div class="form-group">
			    		<label for="kategoriseminar"><b>Kategori Seminar</b></label>
			    		<input type="text" class="form-control" id="kategoriseminar" value="<?= $get_kategori['nama_kategori'] ?>" disabled>
			  		</div>
			  		<div class="form-group">
			    		<label for="deskripsiseminar"><b>Deskripsi Seminar</b></label>
			    		<textarea class="form-control" rows="3" id="deskripsiseminar" name="deskripsi"><?= $data['deskripsi_seminar'] ?></textarea>
              <?= form_error('deskripsi','<small class="text-danger">','</small>'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="alamatseminar"><b>Alamat Seminar</b></label>
			    		<textarea class="form-control" rows="1" id="alamatseminar" name="tempat"><?= $data['tempat_seminar'] ?></textarea>
              <?= form_error('tempat','<small class="text-danger">','</small>'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="gedung"><b>Nama Gedung</b></label>
			    		<input type="text" class="form-control" id="nama_gedung" name="nama_gedung" value="<?= $data['nama_gedung'] ?>">
              <?= form_error('gedung','<small class="text-danger">','</small>'); ?>
          			</div>
              <div class="form-group">
			    		<label for="lantai"><b>Lantai</b></label>
			    		<input type="text" class="form-control" id="lantai" name="lantai" value="<?= $data['lantai'] ?>">
              <?= form_error('narasumber','<small class="text-danger">','</small>'); ?>
          </div>
			  		<div class="form-group">
			    		<label for="narasumberseminar"><b>Narasumber</b></label>
			    		<input type="text" class="form-control" id="narasumberseminar" name="narasumber" value="<?= $data['narasumber'] ?>">
              <?= form_error('narasumber','<small class="text-danger">','</small>'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="jdwl"><b>Jadwal Seminar</b></label>
			    		<input type="date" class="form-control" name="jadwal" value="<?= $data['jadwal'] ?>">
              <?= form_error('jadwal','<small class="text-danger">','</small>'); ?>
			  		</div>
			  		<div class="form-group">
			    		<label for="jam"><b>Jam Seminar</b></label><br>
			    		<input type="time" id="jam" name="jam" min="06:00" max="21:00" required  value="<?= $data['waktu'] ?>"> <span class="text-danger font-italic">*Format Jam 06:00 - 21:00</span>
              <?= form_error('jam','<small class="text-danger">','</small>'); ?>
			  		</div>
					 <div class="form-group">


			  </div>
			 </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      			</div>
    </div>
  </div>
</div>


<script src="<?= base_url('assets/js/seminar/updateSeminar.js') ?>" charset="utf-8"></script>
