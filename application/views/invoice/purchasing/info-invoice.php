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
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <small class="float-right">Tanggal: <?=date('d F Y', $invoice['date'])?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari
                  <address>
                    <strong><?=$invoice['user_fullname']?></strong><br>
                    <?=$invoice['user_address']?>, <?=$invoice['village']?><br>
                    <?=$invoice['sub-district']?>, <?=$invoice['district']?><br>
                    <?=$invoice['province']?>, <?=$invoice['zip']?><br>
                    Phone: <?=$invoice['user_contact_phone']?><br>
                    Email: <?=$invoice['user_contact_email']?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Dikirim ke
                  <address>
                    <strong>CV. B.E.D distribution.</strong><br>
                    Ruko Lucky Town House, Jl. Terusan Jakarta No.30G<br>
                    Babakan Surabaya, Kec. Kiaracondong, Kota Bandung<br>
                    Jawa Barat 40281<br>
                    Phone: -<br>
                    Email: -
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice: <?=$invoice['invoice_id']?></b><br>
                  <br>
                  <b>Order ID:</b> <?=$invoice['invoice_order_id']?><br>
                  <b>Tanggal jatuh tempo:</b> <?=date('d F Y', $invoice['date_due'])?><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Nama barang</th>
                      <th class="text-right">Harga barang</th>
                      <th class="text-center">Jumlah dan unit barang</th>
                      <th class="text-right">Potongan harga barang</th>
                      <th class="text-right">Jumlah harga total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $key => $order): ?>
                    <tr>
                      <td><?=$order['item_name']?>
                      <?php if($order['MG']):?>
                        [MG: <?=$order['MG']?>, ML: <?=$order['ML']?>, VG: <?=$order['VG']?>, PG: <?=$order['PG']?>, (Falvour: <?=$order['falvour']?>)
                      <?php endif?>
                      </td>
                      <td class="text-right"><?=$order['capital_price']?></td>
                      <td class="text-center"><?=$order['quantity']?> (<?=$order['unit']?>)</td>
                      <td class="text-right"><?=$order['rabate']?></td>
                      <td class="text-right"><?=convertToMoney(((int)str_replace([',', '.'], ['',''], $order['capital_price'])*(int)$order['quantity'])-(int)str_replace([',', '.'], ['',''],$order['rabate']))?></td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <button class="btn btn-sm btn-primary"><?=($invoice['status_settlement'])?'Cash':'Credit';?></button>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Catatan: <?=$invoice['note']?>
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Tanggal jatuh tempo: <?=date('d F Y', $invoice['date_due'])?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td class="text-right"><?=$invoice['sub_total']?></td>
                      </tr>
                      <tr>
                        <th>Discount:</th>
                        <td class="text-right"><?=$invoice['discount']?>%</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td class="text-right"><?=$invoice['shipping_cost']?></td>
                      </tr>
                      <tr>
                        <th>Other cost:</th>
                        <td class="text-right"><?=$invoice['other_cost']?></td>
                      </tr>
                      <tr>
                        <th>Grand total:</th>
                        <td class="text-right"><b><?=$invoice['grand_total']?></b></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modals -->
    <?php $this->load->view('components/footer')?>