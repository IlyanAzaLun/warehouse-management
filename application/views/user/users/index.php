<?php $this->load->view('components/header')?>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse pace-primary">
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
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="card-title">Daftar pengguna</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <!-- <div id="tbl_users"></div> -->
                  <table id="tbl_user" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Nama pengguna (user)</th>
                        <th>Nama peran</th>
                        <th>Alamat pengguna</th>
                        <th>Kontak pengguna</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $key => $user): ?>

                        <tr>
                          <th scope="row" width="5px"><?=++$key?></th>
                          <td>
                            <div class="btn-group d-flex justify-content-center" data-id="<?=$user['user_id']?>">
                              <button class="btn btn-sm btn-default" id="update" data-toggle="modal" data-target="#modal-update"><i class="fa fa-tw fa-pencil-alt"></i></button>
                              <button class="btn btn-sm btn-default" id="delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-tw fa-trash-alt"></i></button>
                            </div>
                          </td>
                          <td><?=$user['user_fullname']?> (<?=$user['user_email']?>)</td>
                          <td><?=$user['role_name']?></td>
                          <td><?=$user['user_address'].$user['village']?>,<?=$user['sub-district']?>,<?=$user['district']?>,<?=$user['province']?>,<?=$user['zip']?></td>
                          <td><?=$user['user_contact_email']?>/<br><a target="_blank" href="https://wa.me/<?=$user['user_contact_phone']?>"><?=$user['user_contact_phone']?></a></td>
                          </tr>

                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.col -->
              </div>
            </div>
            <!-- /.row -->
          </div>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <!-- Modals -->
      <?php $this->load->view('components/footer')?>