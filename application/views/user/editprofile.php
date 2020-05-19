<section class="batas-section pb-5" style="background: #edf5ff; position: relative;">
<div class="container"> 
	<div class="col-lg-12">

		<div class="row no-margin">
			<div class="col-lg-4 text-center">
				<form method="post" action="<?= base_url('user/editphoto'); ?>" enctype="multipart/form-data">
						<div class="container_pict">
						  <img src="<?= base_url('assets/'); ?><?= $user['photo_user']; ?>" class="edit-profile img-thumbnail w-100 img_pict">
						  <input type="file" id="fileInput" name="photo" style="display: none;" class="btn-upload-profile"/>
						  <div class="overlay_pict" onclick="chooseFile();"  style="cursor: pointer;">
						    <div class="text_pict">Upload photo</div>
						  </div>
						</div>
						<?= form_error('nama_user','<small class="text-danger">','</small>'); ?>
						<p class="file-path-wrapper mt-2"></p>
						<input type="hidden" name="id2" value="<?= $user['id_user']; ?>">
						<button class="btn btn-primary btn-block mt-3" type="submit">Save Photos</button>
				</form>
			</div>

			<div class="col-lg-8">
				<div class="card border-top-yukseminar card-profile shadow py-2">
					<div class="card-body">
						<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
						<form method="post" action="<?= base_url('user/editbio'); ?>">
						<p class="text-yukseminar">My profile</p>

						<!-- Material input text -->
					      <div class="md-form">
					        <i class="fa fa-user prefix grey-text"></i>
					        <input type="text" id="nama_user" name="nama_user" class="form-control form-control-sm" value="<?= $user['nama_user']; ?>">
					        <label for="nama_user" class="font-weight-light">Your name</label>
					        <?= form_error('nama_user','<small class="text-danger">','</small>'); ?>
					      </div>

					      <!-- Material input email -->
					      <div class="md-form">
					        <i class="fa fa-envelope prefix grey-text"></i>
					        <input type="text" id="email_user" name="email_user" class="form-control form-control-sm" readonly="" value="<?= $user['email_user']; ?>">
					        <label for="email_user" class="font-weight-light">Your email</label>
					      </div>

					      <!-- Material input email -->
					      <div class="md-form">
					        <i class="fa fa-mobile prefix grey-text"></i>
					        <?php if($user['phone_user']): ?>
					        <input type="text" id="phone_user" name="phone_user" class="form-control form-control-sm" name="phone_user" value="<?= $user['phone_user']; ?>">
					        <?php else: ?>
					        <input type="text" id="phone_user" name="phone_user" class="form-control form-control-sm" name="phone_user" value="<?= set_value('phone_user'); ?>">
					        <?php endif;?>
					        <label for="phone_user" class="font-weight-light">Your phone</label>
					        <?= form_error('phone_user','<small class="text-danger">','</small>'); ?>
					      </div>

					      <!-- Material input email -->
					      <div class="md-form">
					        <i class="fa fa-map-marker-alt prefix grey-text"></i>
					        <?php if($user['address_user']): ?>
					        <input type="text" id="address_user" name="address_user" class="form-control form-control-sm" name="address_user" value="<?= $user['address_user']; ?>">
					        <?php else: ?>
					        <input type="text" id="address_user" name="address_user" class="form-control form-control-sm" name="address_user" value="<?= set_value('address_user'); ?>">
					        <?php endif;?>
					        <label for="address_user" class="font-weight-light">Your address</label>
					      </div>
					      <p class="text-yukseminar">Education Information</p>
						<!-- Material input email -->
					      <div class="md-form">
					        <i class="fa fa-university prefix grey-text"></i>
					        <?php if($user['universitas']): ?>
					        <input type="text" id="universitas" name="universitas" class="form-control form-control-sm" name="universitas" value="<?= $user['universitas']; ?>">
					        <?php else: ?>
					        <input type="text" id="universitas" name="universitas" class="form-control form-control-sm" name="universitas" value="<?= set_value('universitas'); ?>">
					        <?php endif;?>
					        <label for="universitas" class="font-weight-light">Your campus</label>
					        <?= form_error('universitas','<small class="text-danger">','</small>'); ?>
					      </div>

					      <!-- Material input email -->
					      <div class="md-form">
					        <i class="fa fa-id-badge prefix grey-text"></i>
					        <?php if($user['nim_user']): ?>
					        <input type="text" id="nim_user" name="nim_user" class="form-control form-control-sm" name="nim_user" value="<?= $user['nim_user']; ?>">
					        <?php else: ?>
					        <input type="text" id="nim_user" name="nim_user" class="form-control form-control-sm" name="nim_user" value="<?= set_value('nim_user'); ?>">
					        <?php endif;?>
					        <label for="nim_user" class="font-weight-light">Your nim / nrp</label>
					        <?= form_error('nim_user','<small class="text-danger">','</small>'); ?>
					      </div>

					      <p class="text-yukseminar">Basic Information</p>

					      <div class="md-form">
					        <i class="fa fa-birthday-cake prefix grey-text"></i>
					        <?php if($user['bday_user']): ?>
					        <input type="date" id="bday_user" class="form-control form-control-sm" name="bday_user" value="<?= $user['bday_user']; ?>">
					        <?php else: ?>
					        <input type="date" id="bday_user" class="form-control form-control-sm" name="bday_user" value="<?= set_value('bday_user'); ?>">
					        <?php endif;?>
					      </div>

					      	<div class="form-group col-12 p-0">
					      	<?php if($user['gender_user']): ?>
					      		<?php if($user['gender_user'] == "Male") : ?>
					      			<div class="custom-control custom-radio custom-control-inline">
			                     	<input type="radio" class="custom-control-input" id="gender_userm" name="gender_user"  value="Male" checked="">
			                     	<label class="custom-control-label" for="gender_userm">Male</label>
			                  		</div>
			                  	<?php else: ?>
			                  		<div class="custom-control custom-radio custom-control-inline">
			                     	<input type="radio" class="custom-control-input" id="gender_userm" name="gender_user"  value="Male">
			                     	<label class="custom-control-label" for="gender_userm">Male</label>
			                  		</div>
			                  	<?php endif; ?>
					      		<?php if($user['gender_user'] == "Female"): ?>
					      			<div class="custom-control custom-radio custom-control-inline">
			                     	<input type="radio" class="custom-control-input" id="gender_userf" name="gender_user"  value="female" checked="">
			                     	<label class="custom-control-label" for="gender_userf">Female</label>
			                  		</div>
			                  	<?php else: ?>
			                  		<div class="custom-control custom-radio custom-control-inline">
			                     	<input type="radio" class="custom-control-input" id="gender_userf" name="gender_user"  value="Female">
			                     	<label class="custom-control-label" for="gender_userf">Female</label>
			                  		</div>
			                   <?php endif; ?>
					      	<?php else: ?>
					      		<div class="custom-control custom-radio custom-control-inline">
			                     <input type="radio" class="custom-control-input" id="gender_userm" name="gender_user"  value="Male">
			                     <label class="custom-control-label" for="gender_userm">Male</label>
			                  </div>
			                 	<div class="custom-control custom-radio custom-control-inline">
			                     <input type="radio" class="custom-control-input" id="gender_userf" name="gender_user"  value="Female">
			                     <label class="custom-control-label" for="gender_userf">Female</label>
			                  </div>
					      	<?php endif; ?>
			                  
			                </div>

			                <button class="btn btn-primary btn-block mt-3" type="submit">Simpan</button>
			              </form>
					</div>
				</div>
				<div class="card border-top-yukseminar shadow mt-4">
					<div class="card-body">
						<div class="flash-data-wrong" data-flashdata="<?= $this->session->flashdata('message_wrong'); ?>"></div>
						<form method="post" action="<?= base_url('user/changepassword'); ?>">
						<p class="text-yukseminar">Privacy Information</p>
						<!-- Material input email -->
					      <div class="md-form">
					        <i class="fa fa-key prefix grey-text"></i>
					        <input type="password" id="current_password" name="current_password" class="form-control form-control-sm" name="current_password">
					        <label for="current_password" class="font-weight-light">Old password</label>
					        <?= form_error('current_password','<small class="text-danger">','</small>'); ?>
					      </div>

					      <div class="md-form">
					        <i class="fa fa-unlock-alt prefix grey-text"></i>
					        <input type="password" id="new_password1" name="new_password1" class="form-control form-control-sm" name="new_password1">
					        <label for="new_password1" class="font-weight-light">New password</label>
					        <?= form_error('new_password1','<small class="text-danger">','</small>'); ?>
					      </div>

					      <div class="md-form">
					        <i class="fa fa-unlock-alt prefix grey-text"></i>
					        <input type="password" id="new_password2" name="new_password2" class="form-control form-control-sm" name="new_password2">
					        <label for="new_password2" class="font-weight-light">Repeat password</label>
					        <?= form_error('new_password2','<small class="text-danger">','</small>'); ?>
					      </div>
					      <button class="btn btn-primary btn-block mt-3" type="submit">Simpan</button>
					     </form>
					</div>
				</div>
			</div>
		</div>

	</div>


</div>
</section>




<script>
   function chooseFile() {
      $("#fileInput").click();
   }
</script>
