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
                          <label>Code item</label>
                          <input type="text" class="form-control" name="item_code" id="item_code"  value="<?=set_value('item_code')?>" required readonly>
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
                        <th>Options</th>
                        <th>Code item</th>
                        <th>Item name</th>
                        <th>Quantity</th>
                        <th>Capital price</th>
                        <th>Selling price</th>
                        <th>Item image</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($items as $key => $item): ?>

                        <tr>
                          <th scope="row" width="5px"><?=++$key?></th>
                          <td>
                            <div class="btn-group d-flex justify-content-center" data-id="<?=$item['item_code']?>">
                              <button class="btn btn-default" id="update" data-toggle="modal" data-target="#modal-update"><i class="fa fa-tw fa-pencil-alt"></i></button>
                              <button class="btn btn-default" id="delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-tw fa-trash-alt"></i></button>
                            </div>
                          </td>
                          <td><?=$item['item_code']?></td>
                          <td><?=$item['item_name']?></td>
                          <td><?=$item['quantity']?> (<?=$item['unit']?>)</td>
                          <td><?=convertToMoney((int)$item['capital_price'])?></td>
                          <td><?=convertToMoney((int)$item['selling_price'])?></td>
                          <td><?=$item['image_id']?></td>
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