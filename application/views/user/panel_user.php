
<section class="batas-section pb-5" style="background: #edf5ff; position: relative;">
	<div class="container ">
	  <div class="row">
	    <div class="col-lg-3">
	    	<!-- Card -->
				<div class="card testimonial-card">

				  <!-- Background color -->
				  <div class="card-up indigo lighten-1"></div>

				  <!-- Avatar -->
				  <div class="avatar mx-auto white">
				    <img src="<?= base_url('assets/'); ?><?= $user['photo_user'] ?>" class="rounded-circle" alt="woman avatar">
				  </div>

				  <!-- Content -->
				  <div class="card-body">
				    <!-- Name -->
				    <h4 class="card-title"><?= $user['nama_user'] ?></h4>
				    <hr>
				    <!-- Quotation -->
				    <p><i class="fas fa-quote-left"></i> Pendidikan mempunyai akar yang pahit, tapi buahnya manis." - Aristoteles</p>

				  </div>

				</div>
				<!-- Card -->
				<div class="card mt-3">
				    <div class="card-body text-center" style="padding:10px">
				        <a href="<?= base_url("seminar/createSeminar") ?>" target="blank">
				            <!--<button class="btni btn1 btn-buatSeminar"><i class="fas fa-plus"></i> Buat Seminar</button>-->
				            <button class="btn btn-primary btn-buatSeminar"><i class="fas fa-plus"></i> &nbsp;Buat Seminar</button>
                        </a>
				    </div>
				</div>
	    </div>
	    <div class="col-lg-9">
    	    <div class="row">
						<div class="flash-content1">
							<div id="flash-data-paper" data-success="<?= $this->session->flashdata('message'); ?>" data-failed="<?= $this->session->flashdata('failed'); ?>"></div>
							<div id="flash-data-bukti" data-success="<?= $this->session->flashdata('messagebukti'); ?>" data-failed="<?= $this->session->flashdata('failedbukti'); ?>"></div>
							<div id="flash-data-selesai" data-success="<?= $this->session->flashdata('messageselesai'); ?>" data-failed="<?= $this->session->flashdata('failedselesai'); ?>"></div>
							<div id="flash-data-pengawas" data-success="<?= $this->session->flashdata('pengawassuccess'); ?>" data-failed="<?= $this->session->flashdata('pengawasfailed'); ?>"></div>
						</div>
              <!-- Card -->
              <div class="col-lg-3">

                  <div class="card bar-panel" id="bar-satu">
                  <!-- Card content -->
                      <div class="card-body">
                        <div class="panel-icon float-right biru"><i class="fas fa-file-import icon"></i></div>
                        <!-- Title -->
                        <h1 class="card-title float-left"><?= $jumlah_seminar_diikuti ?></h1>
                        <!-- Text -->
                        <p class="card-text" style="clear:both">Seminar yang diikuti</p>
                      </div>
                  </div>
              </div>
              <!-- Card -->
              <!-- Card -->
              <div class="col-lg-3">

                  <div class="card bar-panel" id="bar-dua">
                  <!-- Card content -->
                      <div class="card-body">
                        <div class="panel-icon float-right merah"><i class="fas fa-chalkboard-teacher icon"></i></div>
                        <!-- Title -->
                        <h1 class="card-title float-left"><?= $jumlah_seminar_dihadiri ?></h1>
                        <!-- Text -->
                        <p class="card-text" style="clear:both">Seminar yang dihadiri</p>
                      </div>
                </div>

              </div>
              <!-- Card -->
        	    <!-- Card -->
        	    <div class="col-lg-3">

        	    		<div class="card bar-panel" id="bar-tiga">
        					<!-- Card content -->
        	  					<div class="card-body">
        	  						<div class="panel-icon float-right kuning"><i class="fas fa-file-signature icon"></i></div>
        		    				<!-- Title -->
        		    				<h1 class="card-title float-left"><?= $jumlah_seminar_dibuat ?></h1>
        		    				<!-- Text -->
        		    				<p class="card-text" style="clear:both">Seminar yang dibuat</p>
        	  					</div>
        				</div>
          		</div>
          		<!-- Card -->
          		<!-- Card -->
          	  <div class="col-lg-3">

          	    		<div class="card bar-panel" id="bar-empat">
          					<!-- Card content -->
          	  					<div class="card-body">
          	  						<div class="panel-icon float-right biru-muda"><i class="fas fa-history icon"></i></div>
          		    				<!-- Title -->
          		    				<h1 class="card-title float-left"><?= $jumlah_riwayat_seminar ?></h1>
          		    				<!-- Text -->
          		    				<p class="card-text" style="clear:both">Riwayat Seminar</p>
          	  					</div>
          				</div>

          			</div>
          		<!-- Card -->
    		   </div>
          <div class="row mt-3">
						<!-- Seminar yang di ikuti -->
            <div class="col-lg-12">
              <div class="card panel-content satu">
                <div class="card-body">
                  <?php
                  //include 'seminarku.php';
                  ?>
                  <!-- SeminarKu -->
                  <div class="container">

											<div class="row">
												<div class="col-md-12">
													<h3>Seminar yang diikuti</h3>
												</div>
											</div>
                      <div class="row mt-4">
                      	<div class="col-md-12">
                          <table class="table table-striped table-bordered table-responsive" id="TableSeminarku">
                          <thead>
                                  <tr>
                                    <th>#</th>
                                    <th class="th-sm">Poster</th>
                                    <th class="th-lg">Nama Seminar</th>
                                    <th class="th-sm">Paper</th>
                                    <th class="th-sm">Pembayaran</th>
                                    <th class="th-sm">Status</th>
                                    <th class="th-lg">QR Code</th>
                                  </tr>
                          </thead>
                          <tbody>
                                  <?php
                                  $i = 1;
                                   foreach ($list_seminarku as $row): ?>
                                    <tr>
                                      <th><?= $i ?></th>
                                      <td><img src="<?= base_url("assets/")  ?><?= $row['poster'] ?>" alt="thumbnail" style="width:100px;height:100px"></td>
                                      <td><?= $row['nama_seminar'] ?></td>
                                      <td>
                                        <?php if ($row['paper']==1): ?>
                                           <?php if ($row['paper_peserta']== null): ?>
                                             <button type="button" name="button" class="btn btn-primary btn-sm btn-paper" data-toggle="modal" data-peserta="<?= $row['id_peserta'] ?>" data-target="#uploadPDF">Upload File PDF</button>
                                           <?php else: ?>
                                             <span class="badge badge-info">Paper sudah diupload</span>
                                           <?php endif; ?>
                                        <?php else: ?>
                                           Tidak ada Paper
                                        <?php endif; ?>
                                      </td>
                                      <td>
                                        <?php if ($row['pembayaran']==1): ?>
                                          <?php if ($row['pembayaran_peserta']== null): ?>
                                            <!-- <span class="badge badge-secondary">Berbayar!</span> -->
                                            <?php if($row['promo'] == 1): ?>
                                            	<button type="button" name="button" class="btn btn-primary btn-sm konfirmasi btn-bukti" data-toggle="modal" data-target="#uploadBukti" data-peserta="<?= $row['id_peserta'] ?>" data-seminar="<?= $row['url_seminar'] ?>" >
												<span class="oi oi-data-transfer-upload"></span>
												Konfirmasi Pembayaran
											</button>
                                            <?php else: ?>
                                            	<button type="button" name="button" class="btn btn-primary btn-sm konfirmasi btn-bukti" data-toggle="modal" data-target="#uploadBukti" data-peserta="<?= $row['id_peserta'] ?>" data-seminar="<?= $row['url_seminar'] ?>" >
												<span class="oi oi-data-transfer-upload"></span>
												Konfirmasi Pembayaran
											</button>
                                            <?php endif; ?>

											
                                          <?php else: ?>
                                            <span class="badge badge-success">Bukti sudah diupload</span>
                                          <?php endif; ?>
                                        <?php else: ?>
                                           <span class="badge badge-secondary">Gratis!</span>
                                        <?php endif; ?>
                                      </td>
                                      <td>
                                        	<?php if ($row['konfirmasi_peserta']==0): ?>
                                              <span class="badge badge-warning">Pending</span>
                                            <?php else: ?>
                                              <span class="badge badge-success">Diterima</span>
                                            <?php endif; ?>
                                      </td>
                                      <td>
                                        	<?php if ($row['konfirmasi_peserta']==0): ?> :
                                              -
                                            <?php else: ?>
                                              <button type="button" class="btn-barcode btn btn-sm btn-outline-info waves-effect" data-idseminar="<?= $row['id_seminar']; ?>" data-iduser="<?= $user['id_user']; ?>">Show QR Code</button>
                                            <?php endif; ?>
                                      </td>

                                    </tr>


                                  <?php
                                  $i++;
                                  endforeach; ?>

		<!-- Modal BUKTI -->
		<div class="modal fade" id="uploadBukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form class="" action="<?= base_url("user/uploadBukti") ?>" method="post" enctype="multipart/form-data">
	
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-lg-8">
											<h5 class="text-center">Jumlah yang Harus dibayar:</h5>
										</div>
									</div>
									<div class="row justify-content-center text-center">
										<div class="col-lg-5">
											<div class="">
												<input type="text" class="form-control kotak-harga" id="internal" value="Internal : "  disabled>
												<input type="text" class="form-control kotak-harga mt-2" id="umum" value="Umum : "  disabled>
											</div>
										</div>
									</div>
									
									
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1"><b>Rekening Tujuan : </b></label>
									<input type="text" class="form-control" id="an" value="Atas Nama : "  disabled>
									<input type="text" class="form-control mt-2" id="bank" value="Bank : "  disabled>
									<input type="text" class="form-control mt-2" id="rek" value="Nomor Rekening : "  disabled>
								</div>

							<div class="form-group">
								<label for="exampleInputEmail1"><b>Dari Rekening : </b></label>
								<input type="text" class="form-control" name="rekening"  placeholder="BCA, BNI, BRI, dll" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><b>Rekening atas nama : </b></label>
								<input type="text" class="form-control" name="atasnama"  placeholder="Masukan nama pemilik rekening" required>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"><b>Bukti Pembayaran</b></label> <span class="text-danger font-italic">*Pastikan format jpg / jpeg / png</span>
								<input type="file" class="form-control" name="bukti" required>
							</div>
							<input type="hidden" name="peserta" id="buktipeserta" value="">


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
							</form>
					</div>
				</div>
			</div>
		<!-- AKHIR MODAL BUKTI -->


			<!-- Modal PDF -->
			<div class="modal fade" id="uploadPDF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Upload File PDF</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form class="" action="<?= base_url("user/uploadPaper") ?>" method="post" enctype="multipart/form-data">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="paper" accept=".doc, .docx, .pdf" required >
									<input type="hidden" name="peserta" value="" id="pdfpeserta">
									<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Upload paper !</button>
								</form>
						</div>
					</div>
				</div>
			</div>
			<!-- AKHIR MODAL PDF -->
                                </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- Akhir SeminarKu -->
                </div>
              </div>
            </div>

						<!-- Seminar yang dihadiri -->
            <div class="col-lg-12">
              <div class="card panel-content dua">
                <div class="card-body">
									 <!-- Container -->
										 <div class="container">
												 <div class="row">
	 												<div class="col-md-12">
	 													<h3>Seminar yang dihadiri</h3>
	 												</div>
	 											</div>
												 <div class="row mt-4">
												 	<div class="col-md-12">
														 <table class="table table-striped table-bordered table-responsive w-100" id="TableSeminarHadir">
														 <thead>
																		 <tr>
																			 <th>#</th>
																			 <th class="th-sm">Poster</th>
																			 <th class="th-sm">Nama Seminar</th>
																			 <th class="th-sm">Jadwal</th>
																			 <th class="th-sm">Tempat</th>
																			 <th class="th-sm">Kehadiran</th>
																		 </tr>
																	 </thead>
														 <tbody>
																		 <?php
																		 $i = 1;
																			foreach ($seminardihadiri as $row): ?>
																			 <tr>
																				 <th><?= $i ?></th>
																				 <td>
																					 <img src="<?= base_url('assets/')  ?><?= $row['poster'] ?>" alt="thumbnail" style="width:100px;height:100px"></td>
																				 </td>
																				 <td><?= $row['nama_seminar'] ?></td>
																				 <td> <?= date('l, d F Y', strtotime($row['jadwal'])); ?></td>
																				 <td><?= $row['tempat_seminar'] ?></td>
																				 <td>
																					 <?php if ($row['hadir']==0): ?>
																					 		<span class="badge badge-warning">Belum hadir</span>
																						<?php else: ?>
																							<span class="badge badge-success">Sudah hadir</span>
																					 <?php endif; ?>
																				 </td>
																			 </tr>
																		 <?php
																		 $i++;
																		 endforeach; ?>
																	 </tbody>
													 </table>
												 </div>
											</div>
										 </div>
									 <!-- Akhir container -->
                </div>
              </div>
            </div>

						<!-- Seminar yang dibuat -->
      			<div class="col-lg-12">
      				<div class="card panel-content tiga">
      					<div class="card-body">
      						<?php
      						//include 'kelola_seminar.php';
      						?>
									<div class="container">

											<div class="row">
												<div class="col-md-12">
													<h3>Kelola Seminar</h3>
												</div>
											</div>


											<div class="row mt-4">
												<div class="col-md-12">
													<!-- AWAL TABEL BARU -->
													<table id="TableKelolaSeminar" class="table table-striped table-bordered table-responsive mt-2" cellspacing="0" width="100%">
													  <thead>
													    <tr>
													      <th class="">#
													      </th>
													      <th class="th-sm">Poster
													      </th>
													      <th class="th-sm">Nama Seminar
													      </th>
													      <th class="th-sm">Status
													      </th>
													      <th class="th-sm">Pendaftaran
													      </th>
													      <th class="th-sm">Selesai
													      </th>
													      <th class="th-sm">Kelola
													      </th>
													    </tr>
													  </thead>
													  <tbody>
													    <?php $i=1; ?>
													    <?php foreach ($seminardibuat as $row): ?>
														  <tr>
														  	<td><?= $i; ?>
														    <td><img src="<?= base_url('assets/')  ?><?= $row['poster'] ?>" style="width:100px;height:100px"/></td>
														    <td><?= $row['nama_seminar'] ?></td>
														    <td>

														      <?php if ($row['status'] == 0): ?>
														      <span class="badge badge-warning">Pending</span>
														      <?php elseif ($row['status'] == 1): ?>
														      	<span class="badge badge-success">Diterima</span>
														      
														      <?php endif; ?>
														    </td>
																<td class="text-center">
																	<?php if ($row['status'] == 1): ?>
																		<div class="custom-control custom-switch">
																				<input type="checkbox" class="custom-control-input" id="<?= $row['id_seminar'] ?>" value="<?= $row['nama_seminar'] ?>"
																					<?php if ($row['buka_pendaftaran']==1) : ?>
																							checked
																					<?php
																					endif; ?>
																					>
																				<label class="custom-control-label pendaftaran-change" id="" for="<?= $row['id_seminar'] ?>" data-url="<?= $row['url_seminar'] ?>">  </label>
																		</div>
																	<?php endif; ?>
																</td>
																<td class="text-center" id="td<?= $row['url_seminar'] ?>">
																	<?php if ($row['buka_pendaftaran']==0): ?>
																				<span class="btn-selesaiseminar" data-toggle="modal" data-target="#seminar_selesai" data-url="<?= $row['url_seminar'] ?>"><i class="fas fa-trash-alt sampah"></i></span>
																			<?php endif; ?>
																	<?php if ($row['buka_pendaftaran']==1): ?>
																				<span class=""><i class="fas fa-trash-alt sampah-disable"></i></span>
																			<?php endif; ?>
																</td>
														    <td>
														    	<div class="dropdown">



														      	<button type="button" name="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php if ($row['status']==0) {echo "disabled";
														      	}?>>
																				<span class="oi oi-cog"></span>
														  			</button>

																	  <div class="dropdown-menu" id="" aria-labelledby="dropdownMenuButton">
																	    <a class="dropdown-item" href="<?= base_url("user/daftarPeserta/") ?><?= $row['url_seminar'] ?>" target="_blank"><span class="oi oi-people"></span> Daftar Peserta</a>
																	    <a class="dropdown-item" href="<?= base_url("user/absenPesertaOption/") ?><?= $row['url_seminar'] ?>" target="_blank"><span class="oi oi-task"></span> Presensi Peserta</a>
																	    <a class="dropdown-item" href="<?= base_url("seminar/updateSeminar/") ?><?= $row['url_seminar'] ?>"><span class="oi oi-wrench"></span> Edit Seminar</a>
																			 <?php if ($row['id_pengawas'] != null): ?>
																				 	<a class="dropdown-item btn-pengawas" href="" data-toggle="modal" data-target="#detail_pengawas" data-pengawas="<?= $row['id_pengawas'] ?>"><span class="oi oi-clipboard"></span> Info Pengawas</a>
																			 <?php else: ?>
																				 <?php if ($row['paper']==1 || $row['pembayaran']==1): ?>
																						 <a class="dropdown-item" href="<?= base_url("user/daftarPengawas/") ?><?= $row['url_seminar'] ?>" target=""><span class="oi oi-clipboard"></span> Daftar Pengawas</a>
																				 <?php endif; ?>
																			 <?php endif; ?>
																	  </div>
														  		</div>
														  	</td>
														  </tr>


															<?php $i++; ?>
															<?php endforeach; ?>

															<!-- Modal Detail Pengawas -->
															 <div class="modal fade" id="detail_pengawas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																 <div class="modal-dialog" role="document">
																	 <div class="modal-content">
																		 <div class="modal-header">
																			 <h5 class="modal-title" id="exampleModalLabel">Detail Pengawas</h5>
																			 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				 <span aria-hidden="true">&times;</span>
																			 </button>
																		 </div>

																			<div class="modal-body detail-pengawas">
																				<div class="" id="nama_pengawas">
																					Nama Pengawas :
																				</div>
																				<div class="" id="email_pengawas">
																					Email Pengawas :
																				</div>
																		 </div>
																		 <div class="modal-footer">
																			 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																		 </div>
																	 </div>
																 </div>
															 </div>
															 <!-- Akhir Modal Detail Pengawas -->

															<!-- Modal Selesai Seminar -->
															<div class="modal fade" id="seminar_selesai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog" role="document">
																	<form action="<?= base_url('user/selesaiSeminar') ?>" method="post">
																		<div class="modal-content">
																			<div class="modal-header">
																        <h5 class="modal-title">Seminar Selesai</h5>
																        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
																          <span aria-hidden="true">&times;</span>
																        </button>
																      </div>
																      <div class="modal-body">
																        <p id="pselesai_seminar">Semua data pembayaran maupun paper akan dihapus, anda yakin untuk menyelesaikan seminar  ?</p>
																				<input type="hidden" id="iselesai_seminar" name="iselesai_seminar" value="">
																      </div>
																      <div class="modal-footer">
																      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
																				<button class="btn btn-danger" type="submit">Selesai</button>
																        <!-- <a href="process/seminar/selesaiSeminar_proses.php?i=<?= $row['id_seminar'] ?>"><button type="button" class="btn btn-danger">Selesai</button></a> -->
																      </div>
																		</div>
																	</form>
																</div>
															</div>
															<!-- Akhir Modal Selesai Seminar -->

														</tbody>
													</table>
												</div>
											</div>

											<!-- AKHIR TABEL BARU -->

									</div>
      					</div>
      				</div>
      			</div>

						<!-- Riwayat Seminar -->
      			<div class="col-lg-12">
      				<div class="card panel-content empat">
      					<div class="card-body">
									<div class="container">
										<div class="row">
											<div class="col-md-12">
												<h3>Riwayat seminar</h3>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-md-12">
												<table class="table table-striped table-bordered table-hover table-responsive mt-2 w-100" id="TableRiwayat">
						                <thead>
						                    <tr>
						                        <th>#</th>
						                        <th class="th-sm">Poster</th>
						                        <th class="th-sm">Nama Seminar</th>
						                        <th class="th-lg">Hari dan Tanggal</th>
						                        <th class="th-sm">Total Peserta</th>
						                        <th class="th-sm">Status</th>
						                        <th class="th-sm">Keterangan</th>
						                    </tr>
						                </thead>
						                <tbody>
						                  <?php $i =1; ?>
						                  <?php foreach ($riwayatseminar as $row ): ?>
											          <tr>
											            <td><?= $i; ?></td>
											            <td><img src="<?= base_url('assets/') ?><?= $row['poster'] ?>" style="width:100px;height:100px"/></td>
											            <td><?= $row['nama_seminar'] ?></td>
											            <td>
											              <?php $jadwal = date('l, d F Y', strtotime($row['jadwal'])); ?>
											              <?= $jadwal ?>
											            </td>
											            <td>
											            	<?php if ($row['total_peserta'] == 0): ?>
											            		-
											            	<?php else: ?>
											            	<?= $row['total_peserta'] ?> Peserta
											            	<?php endif; ?>
											            </td>
											            <td>	
											            	<?php if ($row['status'] == 2): ?>
														    <span class="badge badge-danger">Ditolak</span>
														   	<?php elseif ($row['status'] == 1): ?>
														   		<span class="badge badge-success">Diterima</span>
														   	<?php endif; ?>
														</td>
														<td>
															<button type="button" class="btn btn-sm btn-info btn-lihat" data-ket="<?= $row['keterangan']; ?>"><i class="fas fa-eye"></i> Lihat</button>
														</td>
											          </tr>
											        <?php $i++; ?>
											        <?php endforeach; ?>
						                </tbody>
						            </table>
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


<!-- Modal -->
<div class="modal fade" id="modalLihat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keterangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="ket-lihat"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal Barcode -->
<div class="modal fade" id="modalBarcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><b>Your Qrcode</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-auto">
      	<h3 class="text-center text-yukseminar judul-seminar"></h3>
        <p class="text-center mb-0">Gunakan QRcode dibawah ini untuk absensi kamu</p>
        	<img src="" class="barcode-image justify-content-center">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal Barcode -->

</section>

<script>var base_url = '<?php echo base_url() ?>';</script>
<script type="text/javascript" src="<?= base_url("assets/js/panel_user.js") ?>">

</script>
