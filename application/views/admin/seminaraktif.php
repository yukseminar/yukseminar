<!-- Page -->
<div class="page">
  <div class="page-header">
        <h1 class="page-title"><?= $title; ?></h1>
        <div class="page-header-actions">
        </div>
      </div>
    <div class="page-content">
            <!-- Panel -->
            
                <div class="row">
                  <?php foreach ($getseminaraktif as $row): ?>

                  
                  <div class="col-lg-3">
                    <div class="card shadow">

                                

                                      <div class="view overlay">
              <a href="<?= base_url('seminar/detailseminar'); ?>/<?= $row['url_seminar'] ?>">
              <img class="card-img-top h-100" src="<?= base_url('assets/'); ?><?= $row['poster'] ?>" alt="Card image cap">

                <div class="mask rgba-white-slight"></div>

            </div>

                            
                                      </a><div class="card-body"><a href="http://localhost/yukseminar/seminar/detailSeminar/Covid">
                                        <h5 class="card-title title"><?= $row['nama_seminar'] ?></h5>
                                        </a>
                                        <p class="card-text desc"><?= $row['deskripsi_seminar'] ?></p>
                                      </div>

                                      <!-- Card footer -->
                                      <div class="rounded-bottom lighten-3 text-center cardfooter" style="background: #f5f5f5;">
                                        <ul class="list-unstyled list-inline font-small">
                                          <li class="list-inline-item pr-2"><i class="fas fa-map-marker-alt pr-1"></i><?= $row['tempat_seminar'] ?></li>
                                        </ul>
                                      </div>

                                    </div>
                  </div>
                  <?php endforeach; ?>
                </div>
                  

    </div>
</div>
<!-- End Page -->



              

