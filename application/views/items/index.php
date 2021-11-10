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

          <!-- insert -->
          <div class="row">
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Insert item</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <form action="<?=base_url('items')?>" method="post">
                  <div class="card-body">

                    <div class="row">
                      
                      <div class="col-sm-3 category">
                        <div class="form-group">
                          <label>Category item</label>
                          <select class="form-control select2" style="width: 100%;" name="category" id="category"  value="<?=set_value('category')?>" required>
                            <option value="" selected="selected">Select category item</option>
                            <option value="Liquid" data-id="LQD" <?=set_select('category', 'Liquid')?>>Liquid</option>
                            <option value="Accessories" data-id="ACC" <?=set_select('category', 'Accessories')?>>Accessories</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Code item</label>
                          <input type="text" class="form-control" name="item_code" id="item_code"  value="<?=set_value('item_code')?>" required>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Name item</label>
                          <input type="text" class="form-control" name="item_name" id="item_name"  value="<?=set_value('item_name')?>" required>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Quantity</label>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" name="quantity" id="quantity"  value="<?=set_value('quantity')?>">
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
                          <label>Capital price</label>
                          <input type="number" class="form-control" name="capital_price" id="capital_price"  value="<?=set_value('capital_price')?>" required>
                          <?=form_error('capital_price', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Selling price</label>
                          <input type="number" class="form-control" name="selling_price" id="selling_price"  value="<?=set_value('selling_price')?>" required>
                          <?=form_error('selling_price', '<small class="text-danger">','</small>')?>
                        </div>
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
                  <h3 class="card-title">List items</h3>
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
                        <th>Code item</th>
                        <th>Item name</th>
                        <th>Quantity</th>
                        <th>Capital price</th>
                        <th>Selling price</th>
                        <th>Item image</th>
                        <th>Options</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($items as $key => $item): ?>

                        <tr>
                          <td scope="row" width="5px"><?=++$key?></td>
                          <td><?=$item['item_code']?></td>
                          <td><?=$item['item_name']?></td>
                          <td><?=$item['quantity']?> (<?=$item['unit']?>)</td>
                          <td><?=convertToMoney((int)$item['capital_price'])?></td>
                          <td><?=convertToMoney((int)$item['selling_price'])?></td>
                          <td><?=$item['image_id']?></td>
                          <td>
                            <div class="btn-group">
                              <a href="" class="btn btn-default"><i class="fa fa-tw fa-edit"></i></a>
                              <a href="" class="btn btn-default"><i class="fa fa-tw fa-trash"></i></a>
                            </div>
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
    <?$this->load->view('components/footer')?>