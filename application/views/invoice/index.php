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
          <form action="<?=base_url('invoice')?>" method="post" id="insert">
            <div class="row">

              <div class="col-sm-12 col-lg-6">
                <!-- /.col -->          

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Item information</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" id="order_item">

                    <div class="row">

                      <div class="col-12">
                        <div class="form-group">
                          <input type="text" name="order_id" id="order_id" class="form-control" placeholder="order_id" readonly>
                        </div>
                      </div>

                      <div class="col-5">
                        <div class="form-group">
                          <label for="item_name">Item name</label>
                          <input required type="text" name="item_name[]" id="item_name" class="form-control" value="<?=set_value('item_name[]')?>">
                        </div>
                          <?=form_error('item_name[]', '<small class="text-danger">','</small>')?>
                      </div>

                      <div class="col-5">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Quantity</label>
                          <div class="input-group mb-3">
                            <input required type="text" class="form-control" name="quantity[]" id="quantity"  value="<?=set_value('quantity[]')?>">
                            <div class="input-group-append">
                              <select class="input-group-text" name="unit[]" id="unit" required>
                                <option value="pcs">PCS</option>
                                <option value="pac">PAC</option>
                              </select>
                            </div>
                          </div>
                          <?=form_error('quantity[]', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      <div class="col-2">
                        <label for="">&nbsp;</label>
                        <button type="button" class="btn btn-block btn-primary" id="add_order_item"><i class="fa fa-tw fa-plus"></i></button>
                      </div>

                    </div>

                  </div>
                  <!-- /.card-body -->
                </div>

              </div>
              <div class="col-sm-12 col-lg-6">
                <!-- /.col -->          

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Customer information</h3>
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
                          <input type="text" name="customer_id" id="customer_id" class="form-control" placeholder="customer_id" readonly>
                        </div>
                      </div>

                      <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                          <label for="fullname">Full name</label>
                          <input type="text" name="fullname" id="fullname" class="form-control" value="">
                        </div>
                      </div>

                      <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                          <label for="contact_number">Contact phone <small class="text-primary">(whatsapp)</small></label>
                          <input type="text" name="contact_number" id="contact_number" class="form-control" value="">
                        </div>
                      </div>

                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="address">Address or destination</label>
                          <textarea type="text" name="address" id="address" class="form-control" value=""></textarea>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                </div>

              </div>
              <div class="col-12">

                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Insert invoice</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="row">

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
                <div class="card-header">
                  <h3 class="card-title">List invoice</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_invoice" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Options</th>
                        <th>Code invoice</th>
                        <th>Date</th>
                        <th>Destination</th>
                        <th>Status payment</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($invoices as $key => $invoice): ?>

                        <tr>
                          <th scope="row" width="5px"><?=++$key?></th>
                          <td>
                            <div class="btn-group d-flex justify-content-center" data-id="<?=$invoice['invoice_id']?>">
                              <a href="<?=base_url('invoice/info')?>" class="btn btn-sm btn-default" id="info" data-toggle="modal" data-target="#modal-info"><i class="fa fa-tw fa-expand-alt"></i></a>
                              <button class="btn btn-sm btn-default" id="update" data-toggle="modal" data-target="#modal-update"><i class="fa fa-tw fa-pencil-alt"></i></button>
                              <button class="btn btn-sm btn-default" id="delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-tw fa-trash-alt"></i></button>
                            </div>
                          </td>
                          <td><?=$invoice['invoice_id']?></td>
                          <td>
                            <small>
                              <?=date('d F Y', $invoice['date'])?> /<br><span class="text-danger"><?=date('d F Y', $invoice['date_due'])?></span>
                            </small>
                          </td>
                          <td>
                            <small>
                              <a href="<?=base_url('customer/'.$invoice['to_customer_destination'])?>">
                                <?=$invoice['customer_fullname']?>
                              </a>
                              <p><?=$invoice['customer_address']?></p>
                              <a href="https://wa.me/<?=$invoice['customer_contact_phone']?>" target="_blank"><?=$invoice['customer_contact_phone']?></a>
                            </small>
                          </td>
                          <td class="text-center"><?=($invoice['status_payment']=='1')?'<span class="badge badge-success">Payed</span>':'<span class="badge badge-danger">Unpayed</span>';?></td>
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