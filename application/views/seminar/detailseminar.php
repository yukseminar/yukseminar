<section class="batas-section" style="background: #edf5ff; position: relative;">
<div class="container">
  <div class="row">
    <div class="col-md-8">
    	<div class="row mt-2">
			<div class="col-lg-4 poster">
				<img class="img-thumbnail" src="<?= base_url('assets/')?><?= $tampil_seminarbyid['poster'] ?>" alt="thumbnail-seminar">
			</div>

      <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>" data-flashdatafailed="<?= $this->session->flashdata('failed'); ?>"> </div>

<?php if($this->session->flashdata('failed-kode')): ?>
	<div class="flash-data-kode" data-flashdatakode="<?= $this->session->flashdata('failed-kode'); ?>"></div>
	<script type="text/javascript">
		$(document).ready( function () {
			$('#ikutseminarbayar').modal('show');
			var kode_salah = $('.flash-data-kode').attr('data-flashdatakode');
			$('#text-salah').text(kode_salah);
		});
	</script>
<?php endif; ?>
			<div class="col-lg-8">
				<h5 class="fee">
					<span class="badge badge-info">
						<?php if ($tampil_seminarbyid['pembayaran']==0): ?>
							Gratis !
						<?php else: ?>
							Berbayar !
						<?php endif; ?>

					</span>
				</h5>
				<h2><?= $tampil_seminarbyid['nama_seminar'] ?></h2>
				<span class="font-italic font-weight-bold">Description:</span>
				<p><?= $tampil_seminarbyid['deskripsi_seminar'] ?></p>

				<?php if ($this->session->userdata('role')): ?>
				<button type="button" class="btn btn-primary btn-ikut" data-toggle="modal" 
						<?php if($tampil_seminarbyid['harga_seminar'] != 0): ?>
						data-target="#ikutseminarbayar"
						<?php else: ?>
						data-target="#ikutseminargratis"
						<?php endif; ?> data-whatever="@getbootstrap"
					<?php if ($pemilik['id_user'] == $user['id_user']): ?>
						disabled
					<?php endif; ?>
					<?php if ($sudah_ikut == 1): ?>
						disabled
					<?php endif; ?>
					<?php if ($kurangHasil==0): ?>
						disabled
					<?php endif; ?>
					<?php if ($tampil_seminarbyid['selesai_seminar']==1 || $tampil_seminarbyid['buka_pendaftaran']==0 ):?>
						disabled
					<?php endif; ?>
					>
					<span class="oi oi-pin"></span>
					<?php if ($kurangHasil==0): ?>
						Sudah Penuh
					<?php elseif($sudah_ikut ==1): ?>
						Sudah Terdaftar
					<?php elseif($tampil_seminarbyid['selesai_seminar']==1): ?>
						Seminar sudah Selesai
					<?php elseif($tampil_seminarbyid['buka_pendaftaran']==0): ?>
						Pendaftaran Tutup
					<?php else: ?>
						Ikuti Seminar
					<?php endif; ?>
				</button>

				<?php else: ?>
					<a href="<?= base_url('auth')?>">
						<button type="button" class="btn btn-primary btn-ikut"
							<?php if ($kurangHasil==0): //jika sudah penuh akan disabled?>
								disabled
							<?php endif; ?>
							<?php //if ($data['selesai_seminar']==1 || $data['buka_pendaftaran']==0 ):?>

							<?php //endif; ?>
              <?php if ($tampil_seminarbyid['selesai_seminar']==1 || $tampil_seminarbyid['buka_pendaftaran']==0 ): ?>
                disabled
              <?php endif; ?>

						>
							<span class="oi oi-pin"></span>
							<?php if ($kurangHasil==0): ?>
								Sudah Penuh
							<?php elseif($tampil_seminarbyid['selesai_seminar']==1): ?>
								Seminar sudah Selesai
							<?php elseif($tampil_seminarbyid['buka_pendaftaran']==0): ?>
								Pendaftaran Tutup

							<?php else: ?>
								Ikuti Seminar
							<?php endif; ?>

						</button>
					</a>


				<?php endif; ?>



			</div>
		</div>
		<hr class="my-5">
		<div class="row">
		<div class="col-lg-12">
			<h3 class="more">More Information :</h3>

			<table class="table table-striped  mt-4">

					<tr>
						<th>Nama</th>
						<td><?= $tampil_seminarbyid['nama_seminar'] ?></td>
					</tr>

					<tr>
						<th>Kategori</th>

						<td><?= $get_kategori['nama_kategori'] ?></td>
					</tr>

					<tr>
						<th>Tanggal dan Waktu</th>
						<td>
							<?php $jadwal = date('l, d F Y', strtotime($tampil_seminarbyid['jadwal'])); ?>
							<?= $jadwal; ?> | <?= $tampil_seminarbyid['waktu']; ?>
						</td>
					</tr>

					<tr>
						<th>Tempat</th>
						<td><?= $tampil_seminarbyid['tempat_seminar'] ?></td>
					</tr>

					<tr>
						<th>Narasumber</th>
						<td><?= $tampil_seminarbyid['narasumber'] ?></td>
					</tr>

					<?php if ($tampil_seminarbyid['selesai_seminar']==0): ?>
					<tr>
						<th>Paper</th>
						<td>
							<?php if ($tampil_seminarbyid['paper']==0): ?>
								Tidak
							<?php else: ?>
								Ya
							<?php endif; ?>
						</td>
					</tr>
					<?php endif; ?>

					<?php if ($tampil_seminarbyid['selesai_seminar']==0): ?>
						<tr>
							<th>Kuota Tersisa</th>
							<td><?= $kurangHasil ?></td>
						</tr>
					<?php endif; ?>



					<?php if ($tampil_seminarbyid['pembayaran']==1): ?>
						<tr>
							<th>Biaya Internal</th>
							<td>Rp. <?= $tampil_seminarbyid['harga_seminar'] ?></td>
						</tr>
						<tr>
							<th>Biaya Umum</th>
							<td>Rp. <?= $tampil_seminarbyid['harga_umum'] ?></td>
						</tr>
					<?php endif; ?>

				</table>
			</div>
		</div>
    </div>

    <div class="col-md-4">
    	<div class="recent-post">
				<table class="w-100">
					<tr>
						<th class="bar-biru">Recent Seminar</th>
					</tr>
					<?php foreach ($recentSeminar as $row): ?>

						<tr>
							<td>
									<a href="<?= base_url('seminar/detailseminar'); ?>/<?= $row['url_seminar'] ?>">
								<img src="<?= base_url('assets/'); ?><?= $row['poster'] ?>">

									<h1><?= $row['nama_seminar'] ?></h1>
									<p>
										<?php
										$full = $row['deskripsi_seminar'];
										$string = strip_tags($row['deskripsi_seminar']);
										if (strlen($string) > 50) {

											// truncate string
											$stringCut = substr($string, 0, 50);
											$endPoint = strrpos($stringCut, ' ');

											//if the string doesn't contain any space then it will cut without word basis.
											$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
											$string .= '...';
										}
										echo $string;
										 ?>

									</p>
								</a>
							</td>
						</tr>
					<?php endforeach; ?>


				</table>
			</div>
    </div>
  </div>




	<!-- Modal Ikut Seminar -->
	<div class="modal fade" id="ikutseminargratis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ikut Seminar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				 <p>Apakah Anda yakin untuk mengikuti seminar <?= $tampil_seminarbyid['nama_seminar']; ?>?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          <form action="<?= base_url('seminar/registration'); ?>/<?= $tampil_seminarbyid['url_seminar'] ?>" method="post">
            <!-- <input type="hidden" name="idsm" value="1"> -->
            <button type="submit" class="btn btn-primary">Yakin</button>
          </form>

				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Ikut Seminar-->

		<!-- Modal Ikut Seminar Bayar -->
	<div class="modal fade" id="ikutseminarbayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ikut Seminar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('seminar/registration'); ?>/<?= $tampil_seminarbyid['url_seminar'] ?>" method="post">
				 <p>Apakah Anda yakin untuk mengikuti seminar <b><?= $tampil_seminarbyid['nama_seminar']; ?></b>?</p>
				 <div class="row justify-content-center text-center">
				 	<div class="col-6">
				 		<div class="form-group mb-0">
				 			<input type="text" name="kode_promo" class="form-control form-control-lg" placeholder="Kode Promo">
				 		</div>
				 		<small id="text-salah" class="text-danger"></small>
				 	</div>
				 	
				 </div>
				 <div class="row col-12 mt-2">
				 	<small>*Masukan Kode Promo untuk mendapatkan harga khusus (kosongkan jika tidak ada)</small>
				 </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          
            <!-- <input type="hidden" name="idsm" value="1"> -->
            <button type="submit" class="btn btn-primary">Yakin</button>
          </form>

				</div>
			</div>
		</div>
	</div>
	<!-- Akhir Modal Ikut Seminar Bayar-->


<!-- Akhir container -->
</div>
</section>
 <!-- JQuery -->

  <script type="text/javascript" src="<?= base_url('assets/js/detailSeminar.js'); ?>"></script>
