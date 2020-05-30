  <!--Footer-->
  <footer class="page-footer text-center font-small pt-4 wow fadeIn">

     <!-- Call to action -->
      <?php if ($this->session->userdata('email')== null): ?>
        <ul class="list-unstyled list-inline text-center py-2">
          <li class="list-inline-item">
            <h5 class="mb-1">Daftar Gratis</h5>
          </li>
          <li class="list-inline-item">
            <a href="<?= base_url('auth/registration'); ?>" class="btn btn-outline-white btn-rounded">Daftar!</a>
          </li>
        </ul>
      <?php endif; ?>

         <hr class="my-4">


    <!-- Call to action -->



    <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5">
        <div class="mb-5 flex-center">

          <!-- Facebook -->
          <a class="fb-ic">
            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!-- Twitter -->
          <a class="tw-ic">
            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
        </div>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2020 Copyright
      <a href="#" target="_blank"> yukseminar.id </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!-- SELECT 2 -->
  <script src="<?= base_url('vendor/select2/js/select2.js'); ?>"></script>
  <!-- AKHIR SELECT 2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?= base_url('assets/js/script.js'); ?>"></script>
 <!-- AKHIR JS  -->
  <script type="text/javascript" src="<?= base_url('vendor/js/bootstrap.min.js'); ?>"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?= base_url('vendor/js/mdb.min.js'); ?>"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

  </script>


    





  <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


</body>
</html>
