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
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar barang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_items" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Kode barang</th>
                        <th>Nama barang</th>
                        <th>Jumlah</th>
                        <th>Harga pokok</th>
                        <th>Harga jual</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($items as $key => $item): ?>

                        <tr>
                          <th scope="row" width="5px"><?=++$key?></th>
                          <td>
                            <div class="btn-group d-flex justify-content-center" data-id="<?=$item['item_code']?>">
                              <button class="btn btn-sm btn-default" id="add-stock" data-toggle="modal" data-target="#modal-add-stock"><i class="fa fa-tw fa-plus"></i></button>
                              <button class="btn btn-sm btn-default" id="detail" data-toggle="modal" data-target="#modal-detail"><i class="fa fa-tw fa-search-plus"></i></button>
                            </div>
                          </td>
                          <td><?=$item['item_code']?></td>
                          <td><?=$item['item_name']?></td>
                          <td><?=$item['quantity']?> (<?=$item['unit']?>)</td>
                          <td><?=convertToMoney((int)$item['capital_price'])?></td>
                          <td><?=convertToMoney((int)$item['selling_price'])?></td>
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