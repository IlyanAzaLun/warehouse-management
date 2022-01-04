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

          <!-- insert -->
          <form action="<?= base_url('warehouse/queue') ?>" method="post" id="insert">
            <div class="row">

              <div class="col-sm-12 col-lg-12">
                  <!-- /.col -->          

                  <div class="card">
                    <div class="card-header bg-primary">
                      <h3 class="card-title">Informasi pelanggan</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <div class="row">

                        <div class="col-sm-12">
                          <div class="form-group">
                            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="customer_id" value="<?= set_value('user_id') ?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          <div class="form-group">
                            <label for="fullname">Nama toko</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" value="<?= set_value('fullname') ?>" autoComplete="off" required>
                            <?= form_error('user_id','<small class="text-danger">','</small>') ?>
                          </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          <div class="form-group">
                            <label for="contact_number">Nomor kontak <small class="text-primary">(whatsapp)</small></label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?= set_value('contact_number') ?>" required readonly>
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="address">Alamat atau tujuan</label>
                            <textarea type="text" name="address" id="address" class="form-control" required readonly><?= set_value('address') ?></textarea>
                          </div>
                        </div>
                      </div>

                    </div>
                    <!-- /.card-body -->
                  </div>
              </div>
              <div class="col-sm-12 col-lg-12">
                <!-- /.col -->          
                <div class="card" id="order_item">
                  <div class="card-header bg-primary">
                    <h3 class="card-title">Informasi barang</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" id="order_item">
                    <div class="row" id="order_item">
                      <div class="col-12">
                        <div class="form-group">
                          <input type="text" name="order_id" id="order_id" class="form-control" placeholder="order_id" readonly>
                        </div>
                      </div>
                      <div class="col-10">
                        <div class="form-group">
                          <label for="item_name">Cari nama barang...</label>
                          <input required type="hidden" id="item_id" class="form-control" autocomplete="off">
                          <input required type="text" id="item_name" class="form-control" placeholder="Cari barang..." autocomplete="off">
                        </div>
                        <?= form_error('item_name[]','<small class="text-danger">','</small>') ?>
                        <?= form_error('quantity[]','<small class="text-danger">','</small>') ?>
                        <?= form_error('unit[]','<small class="text-danger">','</small>') ?>
                      </div>
                      <div class="col-2">
                        <label for="">&nbsp;</label>
                        <button type="button" class="btn btn-block btn-primary" id="add_order_item"><i class="fa fa-tw fa-plus"></i></button>
                      </div>
                    </div>
                    <hr>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg col-sm-12">
                        <div class="form-group">
                          <label for="note">Catatan</label>
                          <textarea name="note" id="note" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <div class="card-footer" id="save">
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary float-right">Save</button>
                      <button type="cancel" class="btn btn-default mr-2">Cancel</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </form>
          <!-- insert -->
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="card-title">Daftar pemesanan keluar</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Kode pemesanan</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Keterangan</th>
                        <th>Status validasi barang</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($invoices as $key => $invoice): ?>
                    <tr>
                      <th scope="row" width="5px"><?= ++$key ?></th>
                      <td>
                        <div class="btn-group d-flex justify-content-center" data-id="<?= $invoice['invoice_order_id'] ?>" data-id-invoice="<?= $invoice['invoice_id'] ?>">
                          <!-- // -->
                          <!-- <a onclick="return false;" href="<?= base_url('warehouse/info') ?>?id=<?= $invoice['invoice_id'] ?>" target="_blank" class="btn btn-sm btn-default" id="info"><i class="fa fa-tw fa-expand-alt"></i></a> -->
                          <!-- <a onclick="return false;" href="<?= base_url('warehouse/update') ?>?id=<?= $invoice['invoice_id'] ?>" target="_blank" class="btn btn-sm btn-default" id="update"><i class="fa fa-tw fa-pencil-alt"></i></a> -->
                          <!-- // -->
                          <button class="btn btn-sm btn-default" id="detail-order" data-toggle="modal" data-target="#modal-detail"><i class="fa fa-tw fa-search-plus"></i></button>
                          <?php if (boolval((int) $invoice['status_active']) AND !boolval((int) $invoice['status_item'])): ?>
                          <button class="btn btn-sm btn-default" id="cancel" data-toggle="modal" data-target="#modal-cancel" data-status="<?= $invoice['status_active'] ?>">
                            <i class="fa fa-tw fa-ban"></i>
                          </button>
                          <?php endif; ?>
                        </div>
                      </td>
                      <td>
                        <p>
                          <?= $invoice['invoice_id'] ?>
                          <?= $invoice['status_active'] == '0'
                              ? '<span class="right badge badge-danger">Cancel</span>'
                              : '' ?>
                        </p>
                      </td>
                      <td>
                        <small>
                          <?=date("d/F/Y H:i:s", strtotime($invoice['date']));?>
                        </small>
                      </td>
                      <td>
                        <small>
                          <a href="<?= base_url('customer/' . $invoice['to_customer_destination']) ?>">
                            <?= $invoice['user_fullname'] ?>
                          </a>
                          <p><?= $invoice['user_address'] ?>,<?= $invoice['village'] ?><br>
                             <?= $invoice['sub-district'] ?>,<?= $invoice['district'] ?>,<?= $invoice['province'] ?>,<?= $invoice['zip'] ?></p>
                          <a href="https://wa.me/<?= $invoice['user_contact_phone'] ?>" target="_blank"><?= $invoice['user_contact_phone'] ?></a>

                        </small>
                      </td>
                      <td><small><?= $invoice['note'] ?></small></td>
                      <td id="validation" class="text-right" data-id="<?= $invoice[
                          'invoice_id'
                      ] ?>">
                        <?= $invoice['status_item'] == '3'
                            ? '<button class="btn btn-sm btn-success m-1" id="status-item" data-variabel="status_item" data-toggle="modal">Checked</button>'
                            : ($invoice['status_item'] == '2'
                                ? '<button class="btn btn-sm btn-warning m-1" id="status-item" data-variabel="status_item" data-toggle="modal">Recheck on warehouse</button>'
                                : ($invoice['status_item'] == '1'
                                    ? '<button class="btn btn-sm btn-warning m-1" id="status-item" data-variabel="status_item" data-toggle="modal">Recheck on marketing</button>'
                                    : '<button class="btn btn-sm btn-danger m-1"  id="status-item" data-variabel="status_item" data-toggle="modal">Uncheck</button>')) ?>
                        <?= $invoice['status_validation'] == '1'
                            ? '<button class="btn btn-sm btn-success m-1" id="status-item" data-variabel="status_validation" data-toggle="modal">Send</button>'
                            : '<button class="btn btn-sm btn-secondary m-1" id="status-item" data-variabel="status_validation" data-toggle="modal">Hold</button>' ?>
                      </td>
                      <!--tambahkan untuk menambahkan aksi pada setiap button` data-target="#modal-status-item" ` -->
                    </tr>

                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.col -->
            </div>
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-danger">
                  <h3 class="card-title">Daftar barang kembali, dari pengiriman</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Kode pengembalian</th>
                        <th>Kode referesni pemesanan</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Keterangan</th>
                        <th>Status validasi barang</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($returns as $key => $return): ?>
                    <tr>
                      <th scope="row" width="5px"><?= ++$key ?></th>
                      <td>
                        <div class="btn-group d-flex justify-content-center" data-id="<?= $return['invoice_order_id'] ?>" data-id-invoice="<?= $return['invoice_id'] ?>">
                          <!-- // -->
                          <!-- <a onclick="return false;" href="<?= base_url('shipping/update') ?>?id=<?= $return['invoice_id'] ?>" target="_blank" class="btn btn-sm btn-default" id="update"><i class="fa fa-tw fa-pencil-alt"></i></a> -->
                          <!-- // -->
                          <button class="btn btn-sm btn-default" id="detail-return" data-toggle="modal" data-target="#modal-detail"><i class="fa fa-tw fa-search-plus"></i></button>
                          <!-- <a href="<?= base_url('shipping/return') ?>?id=<?= $return['invoice_id'] ?>" target="_blank" class="btn btn-sm btn-default" id="info"><i class="fa fa-tw fa-undo-alt"></i></a> -->
                          <?php if (boolval((int) $return['status_active'])): ?>
                          <!-- <button class="btn btn-sm btn-default" id="cancel" data-toggle="modal" data-target="#modal-cancel" data-status="<?= $return['status_active'] ?>"><i class="fa fa-tw fa-ban"></i></button> -->
                          <?php endif; ?>
                        </div>
                      </td>
                      <td>
                        <p>
                          <?= $return['invoice_id'] ?>
                          <?= $return['status_active'] == '0'
                              ? '<span class="right badge badge-danger">Cancel</span>'
                              : '' ?>
                        </p>
                      </td>
                      <td>
                        <?= $return['invoice_reverence'] ?>
                      </td>
                      <td>
                        <small>
                          <?=date("d/F/Y H:i:s", strtotime($return['date']));?>

                        </small>
                      </td>
                      <td>
                        <small>
                          <a href="<?= base_url('customer/' . $return['to_customer_destination']) ?>">
                            <?= $return['user_fullname'] ?>
                          </a>
                          <p><?= $return['user_address'] ?>,<?= $return['village'] ?><br><?= $return['sub-district'] ?>,<?= $return['district'] ?>,<?= $return['province'] ?>,<?= $return['zip'] ?></p>
                          <a href="https://wa.me/<?= $return['user_contact_phone'] ?>" target="_blank"><?= $return['user_contact_phone'] ?></a>
                        </small>
                      </td>
                      <td><small><?= $return['note'] ?></small></td>
                      <td id="validation" class="text-right" data-id="<?= $return['invoice_reverence'] ?>">
                        <!-- <?= $return['status_item'] == '3'
                            ? '<button class="btn btn-sm btn-success m-1" id="status-item-return" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item-return">Checked</button>'
                            : ($return['status_item'] == '2'
                                ? '<button class="btn btn-sm btn-warning m-1" id="status-item-return" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item-return">Recheck on warehouse</button>'
                                : ($return['status_item'] == '1'
                                    ? '<button class="btn btn-sm btn-warning m-1" id="status-item-return" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item-return">Recheck on marketing</button>'
                                    : '<button class="btn btn-sm btn-danger m-1"  id="status-item-return" data-variabel="status_item" data-toggle="modal" data-target="#modal-status-item-return">Uncheck</button>')) ?> -->
                        <?= $return['status_validation'] == '1'
                            ? '<button class="btn btn-sm btn-success m-1" id="status-item-return" data-variabel="status_validation" data-toggle="modal" data-target="#modal-status-item-return">Send</button>'
                            : '<button class="btn btn-sm btn-secondary m-1" id="status-item-return" data-variabel="status_validation" data-toggle="modal" data-target="#modal-status-item-return">Hold</button>' ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
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
    <?php $this->load->view('components/footer'); ?>
