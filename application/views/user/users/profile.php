<?php $this->load->view('components/header')?>

<body class="hold-transition sidebar-mini layout-fixed pace-primary">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view('components/navbar')?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $this->load->view('components/sidebar')?>
  <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- container-fluid -->
      <?php $this->load->view('components/breadcrumb')?>
      <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        
        <!-- Info boxes -->
        <div class="row">
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?=base_url($user['user_image'])?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?=$user['user_fullname']?></h3>

                <p class="text-muted text-center"><?=$user['role_name']?></p>
                <p class="text-muted text-center"><small>Anggota sejak <?=date('d F Y', strtotime($user['created_at']))?></small></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-9">
            <div class="card card-danger card-outline">
              <form action="<?=base_url('profile')?>" method="post" enctype="multipart/form-data" >

                <div class="card-body">
                  <div class="row">
                    <div class="col-2">
                      <label for="user_image">Gambar</label>
                    </div>
                    <div class="col-4 offset-6">
                      <div class="form-group">

                        <div class="custom-file">
                          <input type="hidden" id="user_id" name="user_id" value="<?=$this->data['user']['user_id']?>">
                          <input type="file" class="custom-file-input" id="user_image" name="user_image" required>
                          <label class="custom-file-label" for="user_image">Pilih gambar</label>
                        </div>
                        <?=form_error('user_image', '<small class="text-danger">','</small>')?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="float-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                  </div>
                </div>

              </form>
            </div>            
          </div>
          <div class="col-9 offset-3">

          	<div class="card card-danger card-outline">
          		<form action="<?=base_url('profile/update-password')?>" method="post">

	          		<div class="card-body">
      						<div class="row">
      							<div class="col-2">
      								<label for="password">New password</label>
      							</div>
      							<div class="col-4 offset-6">
      								<div class="form-group">
      									<input id="password" name="password" type="password" class="form-control" required>
      							        <?=form_error('password', '<small class="text-danger">','</small>')?>
      								</div>
      							</div>
      							<div class="col-2">
      								<label for="re-password">retype password</label>
      							</div>
      							<div class="col-4 offset-6">
      								<div class="form-group">
      									<input id="re-password" name="re-password" type="password" class="form-control" required>
      							        <?=form_error('re-password', '<small class="text-danger">','</small>')?>
      								</div>
      							</div>
      						</div>
	          		</div>
	          		<div class="card-footer">
	          			<div class="float-right">
	          				<button type="submit" class="btn btn-primary">Simpan</button>
	          				<button type="reset" class="btn btn-secondary">Batal</button>
	          			</div>
	          		</div>

          		</form>
          	</div>

          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('components/footer')?>