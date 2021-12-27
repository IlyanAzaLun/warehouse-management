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
          <form action="<?=base_url('shipping/queue')?>" method="post" id="insert">
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
                            <input type="text" name="user_id" id="user_id" class="form-control" placeholder="customer_id" value="<?=$invoice['user_id']?>" readonly>
                          </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          <div class="form-group">
                            <label for="fullname">Nama toko</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" value="<?=$invoice['user_fullname']?>" required readonly>
                            <?=form_error('user_id[]', '<small class="text-danger">','</small>')?>
                          </div>
                        </div>

                        <div class="col-sm-12 col-lg-6">
                          <div class="form-group">
                            <label for="contact_number">Nomor kontak <small class="text-primary">(whatsapp)</small></label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?=$invoice['user_contact_phone']?> (<?=$invoice['owner_name']?>)" required readonly>
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="address">Alamat atau tujuan</label>
                            <textarea type="text" name="address" id="address" class="form-control" required readonly><?=$invoice['user_address']?>, <?=$invoice['village']?>, <?=$invoice['sub-district']?>, <?=$invoice['district']?>, <?=$invoice['province']?>, <?=$invoice['zip']?></textarea>
                          </div>
                        </div>
                        
                        <div class="col-6 offset-6">
                          <div class="form-group">
                            <label for="note">Kode Invoice</label>
                            <input type="text" name="invoice_reverence_id" id="invoice_reverence_id" class="form-control" value="<?=$invoice['invoice_id']?>" readonly>
                          </div>
                        </div>
                        
                      </div>

                    </div>
                    <!-- /.card-body -->
                  </div>
              </div>
              <div class="col-sm-12 col-lg-12">
              <div class="card" id="order_item">
                  <div class="card-header bg-primary">
                    <h3 class="card-title">Informasi barang</h3>
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
                          <input type="text" name="order_id" id="order_id" class="form-control" placeholder="<?=$invoice['invoice_order_id']?>" readonly>
                        </div>
                      </div>
                      <table class="table table-bordered table-hover table-sm">
                        <thead>
                          <tr>
                            <th scope="col" rowspan="2" class="align-middle">No</th>
                            <th scope="col" rowspan="2" class="align-middle text-center">Nama barang</th>
                            <th scope="col" class="text-center align-middle" colspan="2">Jumlah barang</th>
                          </tr>
                          <tr class="text-center align-middle">
                            <th>Saat ini</th>
                            <th><small><b>lebih (nominal) / kurang (-nominal)</b></small></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($orders as $key => $order):?>
                          <tr>
                            <td>
                              <?=$key+1?>.
                            </td>
                            <td class="col-8">
                              <input type="hidden" name="item_code[]" class="form-control" value="<?=$order['item_code']?>">
                              <?=$order['item_name']?> <?=($order['MG'])?'(MG: '.$order['MG'].')':'';?>
                            </td>
                            <td class="text-center col-2">
                                <?=abs($order['quantity_order'])?> (<?=$order['unit']?>)
                            </td>
                            <td class="text-center col-2">
                              <div class="form-group form-group-sm row">
                                <label for="quantity" class="col-2"><i class="fa fa-tw fa-angle-up"></i></label>
                                <input type="number" name="quantity[]" id="quantity" class="form-control form-control-sm col-8" value="0">
                                <input type="hidden" name="unit[]" id="unit" class="form-control form-control-sm col-8" value="<?=$order['unit']?>">
                                <label for="quantity" class="col-2"><i class="fa fa-tw fa-angle-down"></i></label>
                              </div>
                            </td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="note">Catatan</label>
                          <textarea name="note" id="note" class="form-control" disabled><?=$invoice['note']?></textarea>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <div class="card-footer">
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
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modals -->
    <?php $this->load->view('components/footer')?>