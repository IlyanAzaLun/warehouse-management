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
        <form action="<?=base_url('warehouse/update')?>?id=<?=$invoice['invoice_id']?>" method="POST">
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
                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?=$invoice['user_fullname']?>"required>
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
                            <input type="hidden" id="item_id" class="form-control">
                            <input type="text" id="item_name" class="form-control" placeholder="Cari barang...">
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
      	                <div class="col-3">
      	                  <div class="form-group">
      	                    <small>Kode barang</small>
                            <input type="hidden" name="index_order[]" value="<?=$order['index_order']?>">
      	                    <input type="text" name="item_code[]" id="item_code" class="form-control" value="<?=$order['item_code']?>" readonly>
      	                  </div>
      	                </div>

      	                <div class="col-5">
      	                  <div class="form-group">
      	                    <small>Nama barang</small>
      	                    <input type="text" name="item_name[]" id="item_name" class="form-control" value="<?=$order['item_name']?>" readonly>
      	                  </div>
      	                </div>

            				  	<div class="col-3">
              						<div class="form-group">
              							<div class="row">
              								<div class="col-5">
              									<small>Jumlah stok barang</small>
              							  	</div>
              								<div class="col-7">
              								  	<small>Jumlah yang dipesan</small>
              								</div>
              							</div>
              							<div class="input-group mb-3" id="field-item_attribute">
              								<input type="number" readonly class="form-control" name="current[]" id="current" value="<?=((int)$this->M_items->item_select($order['item_code'])['quantity']+abs($order['quantity_order']));?>" required>
              								<input type="number" class="form-control" name="quantity[]" id="quantity" value="<?=abs($order['quantity_order'])?>" min="0" max="<?=((int)$this->M_items->item_select($order['item_code'])['quantity']+abs($order['quantity_order']));?>" required>
              								<input type="hidden" class="form-control" name="unit[]" id="unit"  value="<?=$order['unit']?>" required>
        					      	    <div class="input-group-append">
        					              <span class="input-group-text"><?=$order['unit']?></span>
        					            </div>
        		          			</div>
          		        		</div>
          		        	</div>
                        <div class="col-1">
                          <small>&nbsp;</small>
      	                	<button <?php echo (sizeof($orders)<=1)?'disabled':'';?> type="button" class="btn btn-block btn-danger" id="remove_order_item" data-id="<?=$order['index_order']?>" data-toggle="modal" data-target="#modal-delete_order"><i class="fa fa-tw fa-times"></i></button>
                        </div>
                      </div>
                      <?php endforeach?>
                      <hr>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg col-sm-12">
                          <div class="form-group">
                            <label for="note">Catatan</label>
                            <textarea name="note" id="note" class="form-control"><?=$invoice['note']?></textarea>
                          </div>
                        </div>
                      </div>
                    <!-- /.card-body -->
                    </div>
                    <div class="card-footer">
                      <div class="float-right">
                        <button class="btn btn-sm btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-sm btn-secondary" type="button" onclick="window.close();">Cancel</button>
                      </div>
                    </div>
                  </div>
              </div>
            <!-- ./end OERDER -->
          </div><!-- /.row -->
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
      <!-- /.content -->
    </div>

<div class="modal fade" id="modal-delete_order">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?=base_url('warehouse/order-item-remove')?>">
        <div class="modal-body">
          <p>Are you sure to <b class="text-danger">remove</b> from order ?</p>
          <input type="text" name="index_order" id="index-order" readonly>
          <input type="text" name="order_id" id="order-id" readonly>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Yes do it&hellip;</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal delete -->
    <!-- /.content-wrapper -->
    <!-- Modals -->
    <?php $this->load->view('components/footer')?>