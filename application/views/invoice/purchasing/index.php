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

          <!-- insert -->
          <form action="<?=base_url('purchase')?>" method="post" id="insert">
            <div class="row">

              <div class="col-12 col-lg-12">
                <!-- /.col -->          

                <div class="card">
                  <div class="card-header bg-primary">
                    <h3 class="card-title">Informasi pemasok</h3>
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
                          <input type="text" name="user_id" id="user_id" class="form-control" placeholder="customer_id" readonly>
                        </div>
                      </div>

                      <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                          <label for="fullname">Nama lengkap</label>
                          <input type="text" name="fullname" id="fullname" class="form-control" value="" required>
                        </div>
                      </div>

                      <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                          <label for="contact_number">Nomor kontak <small class="text-primary">(whatsapp)</small></label>
                          <input type="text" name="contact_number" id="contact_number" class="form-control" value="" required readonly>
                        </div>
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="address">Alamat atau tujuan</label>
                          <textarea type="text" name="address" id="address" class="form-control" value="" required readonly></textarea>
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
                          <input required type="text" id="item_name" class="form-control" value="<?=set_value('item_name[]')?>" placeholder="Cari barang...">
                        </div>
                        <?=form_error('item_name[]', '<small class="text-danger">','</small>')?>
                        <?=form_error('quantity[]', '<small class="text-danger">','</small>')?>
                        <?=form_error('unit[]', '<small class="text-danger">','</small>')?>
                      </div>
                      <div class="col-2">
                        <label for="">&nbsp;</label>
                        <button type="button" class="btn btn-block btn-primary" id="add_order_item"><i class="fa fa-tw fa-plus"></i></button>
                      </div>

                    </div>

                    <hr>

                  </div>
                  <!-- /.card-body -->
                </div>

              </div>

              <div class="col-12 col-lg-6 offset-lg-6">

                <div class="card">
                  <div class="card-header bg-primary">
                    <h3 class="card-title">Tambah pemesanan</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <h6>Sub total :</h6>
                          <input type="text" name="sub_total" id="sub_total" class="form-control" required>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                              <h6>Discount :</h6>
                              <div class="input-group mb-3">
                                <input type="number" name="discount" id="discount" class="form-control" value="0" max="100" required>
                                <div class="input-group-append">
                                  <span class="input-group-text">%</span>
                                </div>
                              </div>
                            </div>
                          </div>


                          <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                              <h6>Ongkos kirim :</h6>
                              <input type="text" name="shipping_cost" id="shipping_cost" class="form-control" value="0" required>
                            </div>
                          </div>

                        </div>
                      </div>

                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                          <h6>Biaya lainnya :</h6>
                          <input type="text" name="other_cost" id="other_cost" class="form-control" value="0" required>
                        </div>
                      </div>
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                          <h6>Grand total :</h6>
                          <input type="text" name="grand_total" id="grand_total" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg col-sm-12">
                        <div class="form-group">
                          <label for="note">Catatan</label>
                          <textarea name="note" id="note" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg">
                      <div class="form-check float-right">
                        <input type="checkbox" class="form-check-input" id="status_payment" name="status_payment">
                        <label class="form-check-label" for="status_payment">Pembayaran lunas ?</label>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary float-right">Save</button>
                      <button type="cancel" class="btn btn-default mr-2">Cancel</button>
                    </div>
                  </div>
                </div>

                <!-- /.col -->
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
                  <h3 class="card-title">Daftar pemesanan</h3>
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
                        <th>Jumlah pembayaran</th>
                        <th>Keterangan</th>
                        <th>Status pembayaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($invoices as $key => $invoice): ?>

                        <tr>
                          <th scope="row" width="5px"><?=++$key?></th>
                          <td>
                            <div class="btn-group d-flex justify-content-center" data-id="<?=$invoice['invoice_order_id']?>" data-id-invoice="<?=$invoice['invoice_id']?>">
                              <a href="<?=base_url('purchase/info')?>?id=<?=$invoice['invoice_id']?>" target="_blank" class="btn btn-sm btn-default" id="info"><i class="fa fa-tw fa-expand-alt"></i></a>
                              
                              <button class="btn btn-sm btn-default" id="update" data-toggle="modal" data-target="#modal-update"><i class="fa fa-tw fa-pencil-alt"></i></button>
                              <?php if (boolval((int)$invoice['status_active'])): ?>                                
                              <button class="btn btn-sm btn-default" id="cancel" data-toggle="modal" data-target="#modal-cancel" data-status="<?=$invoice['status_active']?>"><i class="fa fa-tw fa-ban"></i></button>
                              <?php endif ?>
                            </div>
                          </td>
                          <td>
                            <p>
                              <?=$invoice['invoice_id']?>
                              <?=($invoice['status_active']=='0')?'<span class="right badge badge-danger">Cancel</span>':'';?>
                            </p>
                          </td>
                          <td>
                            <small>
                              <?=date('d F Y - H:m:s', $invoice['date'])?></span>
                            </small>
                          </td>
                          <td>
                            <small>
                              <a href="<?=base_url('supplier#'.$invoice['to_customer_destination'])?>">
                                <?=$invoice['user_fullname']?>
                              </a>
                              <p><?=$invoice['user_address']?>,<?=$invoice['village']?><br><?=$invoice['sub-district']?>,<?=$invoice['district']?>,<?=$invoice['province']?>,<?=$invoice['zip']?></p>
                              <a href="https://wa.me/<?=$invoice['user_contact_phone']?>" target="_blank"><?=$invoice['user_contact_phone']?></a>

                            </small>
                          </td>
                          <td><?=$invoice['grand_total']?></td>
                          <td><small><?=$invoice['note']?></small></td>
                          <td id="payment" class="text-right" data-id="<?=$invoice['invoice_id']?>">
                            <?=($invoice['status_settlement']=='1'?
                              '<button class="btn btn-sm btn-primary m-1" data-variabel="status_settlement">Tunai</button>':
                              ($invoice['status_settlement']=='2'?
                                '<button class="btn btn-sm btn-secondary m-1" data-variabel="status_settlement">Cicilan</button>':
                                ''
                              ));?>

                            <?=($invoice['status_payment']=='1')?
                            '<button class="btn btn-sm btn-success m-1" data-variabel="status_payment">Lunas</button>':
                            '<button class="btn btn-sm btn-danger m-1" data-variabel="status_payment">Belum Lunas</button>';?>
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
    