<?php $this->load->view('components/header')?>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed pace-primary">
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
                        <th>Kode pemesanan referensi</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($invoices as $key => $invoice): ?>
                    <tr>
                      <th scope="row" width="5px"><?=++$key?></th>
                      <td>
                        <div class="btn-group d-flex justify-content-center" data-id="<?=$invoice['invoice_order_id']?>" data-id-invoice="<?=$invoice['invoice_id']?>">
                          <a href="<?=base_url('shipping/info?id=').$invoice['invoice_reverence']?>" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-tw fa-search-plus"></i></a>
                        </div>
                      </td>
                      <td>
                        <p>
                          <?=$invoice['invoice_id']?>
                          <?=($invoice['status_active']=='0')?'<span class="right badge badge-danger">Cancel</span>':'';?>
                        </p>
                      </td>
                      <td>
                          <?=$invoice['invoice_reverence']?>
                      </td>
                      <td>
                        <small>
                          <?= $invoice['date']?></span>
                        </small>
                      </td>
                      <td>
                        <small>
                          <a href="<?=base_url('customer/'.$invoice['to_customer_destination'])?>">
                            <?=$invoice['user_fullname']?>
                          </a>
                          <p><?=$invoice['user_address']?>,<?=$invoice['village']?><br><?=$invoice['sub-district']?>,<?=$invoice['district']?>,<?=$invoice['province']?>,<?=$invoice['zip']?></p>
                          <a href="https://wa.me/<?=$invoice['user_contact_phone']?>" target="_blank"><?=$invoice['user_contact_phone']?></a>

                        </small>
                      </td>
                      <td><small><?=$invoice['note']?></small></td>
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