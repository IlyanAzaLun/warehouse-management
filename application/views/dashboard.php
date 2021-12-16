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
                <p class="text-muted text-center"><small>Member since <?=date('d F Y', $user['date_created'])?></small></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('components/footer')?>