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
        <div class="row">
          <!-- OERDER -->
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
                      <input type="text" name="user_id" id="user_id" class="form-control" placeholder="customer_id" value="<?=$invoice['to_customer_destination']?>" readonly>
                    </div>
                  </div>

                  <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                      <label for="fullname">Nama lengkap</label>
                      <input type="text" name="fullname" id="fullname" class="form-control" value="<?=$invoice['user_fullname']?>" required>
                    </div>
                  </div>

                  <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                      <label for="contact_number">Nomor kontak <small class="text-primary">(whatsapp)</small></label>
                      <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?=$invoice['user_contact_phone']?>" required readonly>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="address">Alamat atau tujuan</label>
                      <textarea type="text" name="address" id="address" class="form-control" required readonly><?=$invoice['user_address']?>, <?=$invoice['village']?>, <?=$invoice['sub-district']?>, <?=$invoice['district']?>, <?=$invoice['province']?>, <?=$invoice['zip']?> </textarea>
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
                      <input type="text" name="order_id" id="order_id" class="form-control" placeholder="order_id" readonly value="<?=$invoice['invoice_order_id']?>">
                    </div>
                  </div>

                  <div class="col-10">
                    <div class="form-group">
                      <label for="item_name">Cari nama barang...</label>
                      <input required type="hidden" id="item_id" class="form-control">
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
                <?php foreach ($orders as $key => $order):?>
                <!-- order-item -->
                <div class="row" id="order-item">

                <div class="col-1">
                  <div class="form-group">
                    <small>Kode barang</small>
                    <input type="text" name="item_code[]" id="item_code" class="form-control" value="<?=$order['item_code']?>" readonly>
                  </div>
                </div>

                <div class="col-3">
                  <div class="form-group">
                    <small>Nama barang</small>
                    <input type="text" name="item_name[]" id="item_name" class="form-control" value="<?=$order['item_name']?>" readonly>
                  </div>
                </div>
                
                <div class="col-1">
                  <div class="form-group">
                    <small>Harga pokok</small>
                    <input type="text" name="item_capital_price[]" id="item_capital_price" class="form-control" value="<?=$order['capital_price']?>" placeholder="${result.capital_price}" required>
                  </div>
                </div>

                <div class="col-1">
                  <div class="form-group">
                    <small>Harga jual</small>
                    <input type="text" name="item_selling_price[]" id="item_selling_price" class="form-control" value="<?=$order['selling_price']?>" placeholder="${result.selling_price}" required>
                  </div>
                </div>

                <div class="col-2">
                  <!-- text input -->
                  <div class="form-group">
                    <small>Jumlah barang</small>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="<?=$order['quantity']?>" required>
                      <input type="hidden" class="form-control" name="unit[]" id="unit"  value="<?=$order['unit']?>" required>
                      <div class="input-group-append">
                        <span class="input-group-text"><?=$order['unit']?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-2">
                  <div class="form-group">
                    <small>Harga total</small>
                    <input type="text" name="item_total_price[]" id="item_total_price" class="form-control" value="<?=convertToMoney(((int)str_replace([',', '.'], ['',''], $order['capital_price'])*(int)$order['quantity']))?>" placeholder="" readonly required>
                  </div>
                </div>

                <div class="col-1">
                  <div class="form-group">
                    <small>Potongan harga</small>
                    <input type="text" name="rebate_price[]" id="rebate_price" class="form-control" value="<?=$order['rabate']?>" placeholder="" required>
                  </div>
                </div>

                <div class="col-1">
                    <small>&nbsp;</small>
                  <button type="button" class="btn btn-block btn-danger" id="remove_order_item" data-id="<?=$order['index_order']?>"><i class="fa fa-tw fa-times"></i></button>
                </div>

                </div>
                <?php endforeach?>
                <!-- order-item -->                
                <!-- add item order -->
                <!-- ./end add item order -->

              </div>
              <!-- /.card-body -->
            </div>

            </div>
          <!-- ./end OERDER -->
          
          <div class="col-12 col-lg-6 offset-lg-6">

            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Simpan pemesanan</h3>
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
                      <input type="text" name="sub_total" id="sub_total" class="form-control" value="<?=$invoice['sub_total']?>" required>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                          <h6>Discount :</h6>
                          <div class="input-group mb-3">
                            <input type="number" name="discount" id="discount" class="form-control" value="<?=$invoice['discount']?>" max="100" required>
                            <div class="input-group-append">
                              <span class="input-group-text">%</span>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                          <h6>Ongkos kirim :</h6>
                          <input type="text" name="shipping_cost" id="shipping_cost" class="form-control" value="<?=$invoice['shipping_cost']?>" required>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                      <h6>Biaya lainnya :</h6>
                      <input type="text" name="other_cost" id="other_cost" class="form-control" value="<?=$invoice['other_cost']?>" required>
                    </div>
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                      <h6>Grand total :</h6>
                      <input type="text" name="grand_total" id="grand_total" class="form-control" value="<?=$invoice['grand_total']?>" required>
                    </div>
                  </div>
                  <div class="col-lg col-sm-12">
                    <div class="form-group">
                      <label for="note">Catatan</label>
                      <textarea name="note" id="note" class="form-control"><?=$invoice['note']?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-lg">
                  <div class="form-check float-right">
                    <input type="checkbox" class="form-check-input" id="status_payment" name="status_payment" <?=($invoice['status_payment'])?'checked':'';?>>
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

          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3"> 
              <pre>
                <?php
                  var_dump($invoice);
                ?>
                <br>
                <?php
                  var_dump($orders);
                ?>
              </pre>
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