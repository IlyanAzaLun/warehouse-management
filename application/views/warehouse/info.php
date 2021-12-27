<?php $this->load->view('components/header'); ?>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed pace-primary">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->load->view('components/navbar'); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view('components/sidebar'); ?>
    <!-- /.Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <!-- container-fluid -->
        <?php $this->load->view('components/breadcrumb'); ?>
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
                  <h3 class="card-title">Daftar riwayat pemesanan keluar</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <div class="mb-2 float-left">Tujuan: <b><?=$orders[0]['user_fullname']?>(<?=$orders[0]['owner_name']?>)</b>
                        <p>Contact: <b><?=$orders[0]['user_contact_phone']?></b></p>
                        <p><?=$orders[0]['village']?>, <?=$orders[0]['sub-district']?>, <?=$orders[0]['district']?>, <?=$orders[0]['province']?>, <?=$orders[0]['zip']?></p><p><b><?=$orders[0]['type_id']?></b></p>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="mb-2 float-right">
                        <p><?=@$invoice['note']?></p>
                      </div>
                    </div>
                  </div>

                  <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Kode barang</th>
                        <th>Kategori</th>
                        <th>Nama barang</th>
                        <th>Jumlah pemesanan barang</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $key => $order): ?>
                    <tr>
                      <th scope="row" width="5px"><?= ++$key ?></th>
                      <th><?= $order['item_code'] ?></th>
                      <th><?= $order['item_category'] ?></th>
                      <th><?= $order['item_name'] ?> 
                      <?php($order['MG'])?'(MG: '.$order['MG'].')':''?></th>
                      <th><?= abs($order['quantity_order']) ?></th>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->

                <!-- /.card-header -->
                <?php if (@$order_return[0]): ?>
                  <hr>
                  <div class="card-body">
                  <div class="row">

                    <div class="col-6 offset-6">
                      <div class="mb-2 float-right">
                        <p><?=@$invoice_return['note']?></p>
                      </div>
                    </div>
                  </div>
                    <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Kode barang</th>
                          <th>Kategori</th>
                          <th>Nama barang</th>
                          <th>Jumlah pemesanan barang</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($order_return as $key => $order): ?>
                      <tr>
                        <th scope="row" width="5px"><?= ++$key ?></th>
                        <th><?= $order['item_code'] ?></th>
                        <th><?= $order['item_category'] ?></th>
                        <th><?= $order['item_name'] ?> 
                        <?php($order['MG'])?'(MG: '.$order['MG'].')':''?></th>
                        <th><?= $order['quantity_order'] ?></th>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <p><?=@$invoice_return['note']?></p>
                  <!-- /.card-body -->
                <?php endif ?>
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
    <?php $this->load->view('components/footer'); ?>
