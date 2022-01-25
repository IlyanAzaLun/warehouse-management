<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
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
                <div class="float-right">
                	<label for="">Batal pengiriman: </label>
	            	<button class="btn btn-danger" data-toggle="modal" data-target="#modal-cancel"><i class="fa fa-tw fa-ban"></i></button>
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

                </div>
                <hr>
                <table class="table table-striped table-bordered table-hover table-sm">
	                <thead>
	                	<tr>
							<th>#</th>
	                		<th>Item code</th>
	                		<th>Item name</th>
	                		<th>Jumlah pemesanan barang	</th>
							<?php if (@$order_return): ?>
							<th colspan="2">Permintaan dari shipping</th>
							<?php endif ?>
	                	</tr>
	                </thead>
	                <tbody>
		                <?php foreach ($items as $key => $item):?>
		                <tr>
		                	<td><?=$key+1?></td>
		                	<td><?=$item['item_code']?></td>
		                	<td><?=$item['item_name']?></td>
		                	<td><?=abs($item['quantity_order'])?></td>
							<?php if (@$order_return): ?>
							<td><?= abs($order_return[$key]['quantity_order']) ?></td>
							<td><?= ($order_return[$key]['quantity_order']>0)?'Lebih':'Kurang' ?></td>
							<?php endif ?>
		                </tr>
		                <?php endforeach?>
	                </tbody>
                </table>
                <!-- order-item -->                
                <!-- add item order -->
                <!-- ./end add item order -->

              </div>
              <!-- /.card-body -->
            </div>

			<?php if (@$order_return[0]): ?>
	        <div class="card" id="order_item">
	          <div class="card-header bg-primary">
	            <h3 class="card-title">Informasi barang</h3>
	            <div class="card-tools">
	              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
	              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
	            </div>
	          </div>
			  <hr>
			  <div class="card-body">
			  <div class="row">

			    <div class="col-6 offset-6">
			      <div class="mb-2 float-right">
			        <p><?=@$invoice_return['note']?></p>
			      </div>
			    </div>
			  </div>
			    <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
			      <thead>
			        <tr>
			          <th>#</th>
			          <th>Kode barang</th>
			          <th>Kategori</th>
			          <th>Jumlah pemesanan</th>
			        </tr>
			      </thead>
			      <tbody>
			      <?php foreach ($items as $key => $item): ?>
			      <tr>
			        <th scope="row" width="5px"><?= $key+1 ?></th>
			        <td><?=$item['item_code']?></td>
                	<td><?=$item['item_name']?></td>
			        <?php($item['MG'])?'(MG: '.$item['MG'].')':''?></th>
			        <th><?= abs($item['quantity_order']+$order_return[$key]['quantity_order']) ?></th>
			      </tr>
			      <?php endforeach; ?>
			      </tbody>
			    </table>
			  <p><?=@$invoice_return['note']?></p>
			  </div>
			  <!-- /.card-body -->
			<?php endif ?>
			</div>
    	  </div>
          <!-- ./end OERDER -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modals -->
    <?php $this->load->view('components/footer')?>
    <div class="modal fade" id="modal-cancel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cancel invoice</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?= base_url('shipping/validation_cancel') ?>">
				<div class="modal-body">
					<p>Apakah anda yakin untuk <b class="text-danger">membatalkan </b>pengiriman ?</p>
					<input type="hidden" name="invoice_id" id="invoice_id" value="<?=$invoice['invoice_id']?>">
					<input type="hidden" name="status_validation" id="status_validation" value="0" readonly>
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