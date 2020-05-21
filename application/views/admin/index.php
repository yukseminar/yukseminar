<!-- Page -->
<div class="page">
  <div class="page-content container-fluid">
    <div class="row" data-plugin="matchHeight" data-by-row="true">
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea One-->
        <div class="card card-shadow" id="widgetLineareaOne">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    User
              </div>
              <span class="float-right grey-700 font-size-30">1,253</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea One -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Two -->
        <div class="card card-shadow" id="widgetLineareaTwo">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-assignment grey-600 font-size-24 vertical-align-bottom mr-5"></i>                   Seminar aktif
              </div>
              <span class="float-right grey-700 font-size-30">543</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Two -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Three -->
        <div class="card card-shadow" id="widgetLineareaThree">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-delete grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Tolak Seminar
              </div>
              <span class="float-right grey-700 font-size-30">124</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-down red-500 font-size-16"></i>             
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Three -->
      </div>
      <div class="col-xl-3 col-md-6">
        <!-- Widget Linearea Four -->
        <div class="card card-shadow" id="widgetLineareaFour">
          <div class="card-block p-20 pt-10">
            <div class="clearfix">
              <div class="grey-800 float-left py-10">
                <i class="icon md-assignment-return grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    Request Seminar
              </div>
              <span class="float-right grey-700 font-size-30">845</span>
            </div>
            <div class="mb-20 grey-500">
              <i class="icon md-long-arrow-up green-500 font-size-16"></i>                 
            </div>
            <div class="ct-chart h-50"></div>
          </div>
        </div>
        <!-- End Widget Linearea Four -->
      </div>



     

      


    </div>

      <div class="row">
        <div class="col-lg-6">
        <!-- Panel Projects Status -->
        <div class="panel" id="projects-status">
          <div class="panel-heading">
            <h3 class="panel-title">
              Seminar Terbaru
              
            </h3>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td>#</td>
                  <td>Nama Seminar</td>
                  <td>Status Seminar</td>
                  <td class="text-left">Penyelenggara</td>
                </tr>
              </thead>
              <tbody>
              <?php $i = 1;?>
              <?php foreach ($getallseminar as $row): ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $row['nama_seminar']; ?></td>
                  <td>
                    <?php if($row['status'] == 1): ?>
                    <span class="badge badge-success">Diterima</span>
                    <?php else: ?>
                    <span class="badge badge-warning">Pending</span> 
                    <?php endif; ?>
                  </td>
                  <td>
                    <?= $row['nama_user']; ?>
                  </td>
                </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Projects Stats -->
      </div>

      <div class="col-lg-6">
        <!-- Panel Projects Status -->
        <div class="panel" id="projects-status">
          <div class="panel-heading">
            <h3 class="panel-title">
              User Terbaru
              
            </h3>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td>#</td>
                  <td>Nama User</td>
                  <td>Status Akun</td>
                  <td>Universitas</td>
                  <td class="text-left">Role</td>
                </tr>
              </thead>
              <tbody>
              <?php $i = 1;?>
              <?php foreach ($getalluser as $row): ?>
                <tr>
                  <td><?= $i; ?></td>
                  <td><?= $row['nama_user']; ?></td>
                  <td>
                    <?php if($row['is_active'] == 1): ?>
                      <span class="badge badge-primary">Aktif</span>
                    <?php else: ?>
                      <span class="badge badge-danger">Belum Aktif</span>
                    <?php endif; ?>
                    
                  </td>
                  <td>
                    <?= $row['universitas']; ?>
                  </td>
                  <td>
                    <?= $row['role_user']; ?>
                  </td>
                </tr>
              <?php $i++; ?>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- End Panel Projects Stats -->
      </div>
      </div>
  </div>
</div>
<!-- End Page -->
