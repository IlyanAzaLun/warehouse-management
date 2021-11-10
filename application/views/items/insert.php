<?$this->load->view('components/header')?>

<body class="hold-transition sidebar-mini layout-fixed pace-primary">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?$this->load->view('components/navbar')?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?$this->load->view('components/sidebar')?>
  <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- container-fluid -->
      <?$this->load->view('components/breadcrumb')?>
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
              <div class="card-header">
                <h3 class="card-title"><a href="<?=base_url('item/insert')?>" class="btn btn-primary"><i class="fa fa-plus"></i></a></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
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
<?$this->load->view('components/footer')?>