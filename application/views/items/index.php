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

          <!-- insert -->
          <div class="row">
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Tambah data barang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <form action="<?=base_url('items')?>" method="post" id="insert">
                  <div class="card-body">

                    <div class="row">
                      
                      <div class="col-sm-3 category">
                        <div class="form-group">
                          <label>Kategori barang</label>
                          <select class="form-control select2" style="width: 100%;" name="category" id="category"  value="<?=set_value('category')?>" required>
                            <option value="" selected="selected">Pilih kategori barang</option>
                            <option value="ACC" data-id="ACC" <?=set_select('category', 'ACC')?>>ACC</option>
                            <option value="ATOMIZER" data-id="ATOMIZER" <?=set_select('category', 'ATOMIZER')?>>ATOMIZER</option>
                            <option value="BATTERY" data-id="BATTERY" <?=set_select('category', 'BATTERY')?>>BATTERY</option>
                            <option value="CATTRIDGE & COIL" data-id="CATTRIDGE & COIL" <?=set_select('category', 'CATTRIDGE & COIL')?>>CATTRIDGE & COIL</option>
                            <option value="COTTON" data-id="COTTON" <?=set_select('category', 'COTTON')?>>COTTON</option>
                            <option value="DEVICE" data-id="DEVICE" <?=set_select('category', 'DEVICE')?>>DEVICE</option>
                            <option value="LIQUID" data-id="LIQUID" <?=set_select('category', 'LIQUID')?>>LIQUID</option>
                            <option value="PODS" data-id="PODS" <?=set_select('category', 'PODS')?>>PODS</option>
                            <option value="WIRE" data-id="WIRE" <?=set_select('category', 'WIRE')?>>WIRE</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kode barang</label>
                          <input type="text" class="form-control" name="item_code" id="item_code"  value="<?=set_value('item_code')?>" required readonly>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nama barang</label>
                          <input type="text" class="form-control" name="item_name" id="item_name"  value="<?=set_value('item_name')?>" required>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Jumlah</label>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="quantity" id="quantity"  value="<?=set_value('quantity')?>" required>
                            <div class="input-group-append">
                              <select class="input-group-text" name="unit" id="unit" required>
                                <option value="pcs">PCS</option>
                                <option value="pac">PAC</option>
                              </select>
                            </div>
                          </div>
                          <?=form_error('quantity', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Harga pokok</label>
                          <input type="number" class="form-control" name="capital_price" id="capital_price"  value="<?=set_value('capital_price')?>" required>
                          <?=form_error('capital_price', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Harga jual</label>
                          <input type="number" class="form-control" name="selling_price" id="selling_price"  value="<?=set_value('selling_price')?>" required>
                          <?=form_error('selling_price', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      <div class="col">
                        
                        <!-- text input -->
                        <div class="form-group">
                          <label>Keterangan</label>
                          <textarea type="text" class="form-control" name="note" id="note"><?=set_value('note')?></textarea>
                          <?=form_error('note', '<small class="text-danger">','</small>')?>
                        </div>

                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <div class="float-right">
                      <button type="submit" class="btn btn-primary float-right">Simpan</button>
                      <button type="cancel" class="btn btn-default mr-2">Batal</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- insert -->
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
                              <button class="btn btn-sm btn-default" id="update" data-toggle="modal" data-target="#modal-update"><i class="fa fa-tw fa-pencil-alt"></i></button>
                              <button class="btn btn-sm btn-default" id="delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-tw fa-trash-alt"></i></button>
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