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
            <div class="col-lg-5 col-md-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="card-title">List roles</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_roles" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Role name</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($roles as $key => $role): ?>

                        <tr>
                          <td scope="row" width="5px"><?=++$key?></td>
                          <td><?=$role['role_name']?></td>
                          <td>
                            <div class="btn-group d-flex justify-content-center" data-id="<?=$role['id']?>">
                              <button class="btn btn-default" id="info"><i class="fa fa-tw fa-info"></i></button>
                              <button class="btn btn-default"><i class="fa fa-tw fa-trash"></i></button>
                            </div>
                          </td>
                        </tr>

                      <?php endforeach ?>                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.col -->
            </div>
            <!-- role -->

            <!-- list menu -->
            <div class="col-lg-7 col-md-12">
                      
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="card-title">List accsess menu</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body" id="info">
                  
                </div>
              </div>
            </div>
            <!-- ./list menu -->
          </div>
          <!-- /.row -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modals -->
    <?php $this->load->view('components/footer')?>