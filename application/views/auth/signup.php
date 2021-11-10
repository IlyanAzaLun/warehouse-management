<?$this->load->view('components/auth_header') ?>

<div class="register-box">
  <div class="register-logo">
    <img src="<?=base_url()?>assets/AdminLTE-3.0.5/dist/img/AdminLTELogo.png" alt="">
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?=base_url('auth/signup')?>" method="post">
        <?=form_error('name', '<small class="text-danger">','</small>')?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="name" placeholder="Full name" value="<?=set_value('name')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <?=form_error('email', '<small class="text-danger">','</small>')?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="email" placeholder="Email" value="<?=set_value('email')?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <?=form_error('password', '<small class="text-danger">','</small>')?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <?=form_error('repassword', '<small class="text-danger">','</small>')?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="repassword" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="<?=base_url('auth')?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<?$this->load->view('components/auth_footer') ?>