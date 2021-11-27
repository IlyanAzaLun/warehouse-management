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
            <div class="col-8">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><button class="btn btn-primary" data-toggle="modal" data-target="#modal-menu"><i class="fa fa-plus"></i></button></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_menu" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Menu</th>
                        <th>Category</th>
                        <th>Url</th>
                        <th>Icon</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($menus as $key => $menu): ?>
                        
                        <tr>
                          <td scope="row" width="5px"><?=++$key?></td>
                          <td><?=$menu['title']?></td>
                          <td><?=$menu['category_name']?></td>
                          <td><?=$menu['url']?></td>
                          <td><i class="<?=$menu['icon']?>"></i> <span class="badge <?=($menu['is_active'])?'badge-success':'badge-danger'?> ml-1"><?=($menu['is_active'])?'Active':'Inactive'?></span></td>
                          <td>
                            <div class="btn-group">
                              <a href="" class="btn btn-default"><i class="fa fa-tw fa-edit"></i></a>
                              <a href="" class="btn btn-default"><i class="fa fa-tw fa-trash"></i></a>
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
            <div class="col-4">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><button class="btn btn-primary" data-toggle="modal" data-target="#modal-category"><i class="fa fa-plus"></i></button></h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_menu" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Category name</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($categorys as $key => $category): ?>
                        
                        <tr>
                          <td scope="row" width="5px"><?=++$key?></td>
                          <td><?=$category['category_name']?></td>
                          <td>
                            <div class="btn-group">
                              <a href="" class="btn btn-default"><i class="fa fa-tw fa-edit"></i></a>
                              <a href="" class="btn btn-default"><i class="fa fa-tw fa-trash"></i></a>
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
          </div>
          <!-- /.row -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modals -->
    <?php $this->load->view('components/footer')?>