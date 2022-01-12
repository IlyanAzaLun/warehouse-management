<?php $this->load->view('components/header')?>

<body
  class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed pace-primary">
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
                <div class="card-header bg-primary">
                  <h3 class="card-title">Tambah data barang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <form action="<?=base_url('items')?>" method="post" id="insert">
                  <div class="card-body">

                    <div class="row">

                      <div class="col-sm-3 category">
                        <div class="form-group">
                          <label>Kategori barang</label>
                          <select class="form-control select2" style="width: 100%;" name="category" id="category"
                            value="<?=set_value('category')?>" required>
                            <option value="" selected="selected">Pilih kategori barang</option>
                            <option value="ACC" data-id="ACC" <?=set_select('category', 'ACC' )?>>ACC</option>
                            <option value="ATOMIZER" data-id="ATOMIZER" <?=set_select('category', 'ATOMIZER' )?>
                              >ATOMIZER</option>
                            <option value="BATTERY" data-id="BATTERY" <?=set_select('category', 'BATTERY' )?>>BATTERY
                            </option>
                            <option value="CATTRIDGE & COIL" data-id="CATTRIDGE & COIL"
                              <?=set_select('category', 'CATTRIDGE & COIL' )?>>CATTRIDGE & COIL</option>
                            <option value="COTTON" data-id="COTTON" <?=set_select('category', 'COTTON' )?>>COTTON
                            </option>
                            <option value="DEVICE" data-id="DEVICE" <?=set_select('category', 'DEVICE' )?>>DEVICE
                            </option>
                            <option value="LIQUID" data-id="LIQUID" <?=set_select('category', 'LIQUID' )?>>LIQUID
                            </option>
                            <option value="PODS" data-id="PODS" <?=set_select('category', 'PODS' )?>>PODS</option>
                            <option value="WIRE" data-id="WIRE" <?=set_select('category', 'WIRE' )?>>WIRE</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-2">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kode barang</label>
                          <input type="text" class="form-control" name="item_code" id="item_code"
                            value="<?=set_value('item_code')?>" required readonly>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nama barang</label>
                          <input type="text" class="form-control" name="item_name" id="item_name"
                            value="<?=set_value('item_name')?>" required>
                        </div>
                      </div>

                      <div class="col-sm-2">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Harga pokok</label>
                          <input type="text" class="form-control" name="capital_price" id="capital_price"
                            value="<?=set_value('capital_price')?>" required>
                          <?=form_error('capital_price', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Harga jual</label>
                          <input type="text" class="form-control" name="selling_price" id="selling_price"
                            value="<?=set_value('selling_price')?>" required>
                          <?=form_error('selling_price', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      <div class="col">

                        <!-- text input -->
                        <div class="form-group">
                          <label>Keterangan</label>
                          <textarea type="text" class="form-control" name="note"
                            id="note"><?=set_value('note')?></textarea>
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
                <div class="card-header bg-success">
                  <h3 class="card-title">Daftar barang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_items" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Opsi</th>
                        <th>Kode barang</th>
                        <th>Nama barang</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
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
        <script>
      $('table#tbl_items').dataTable({
      'dom': `<'row'<'col-6 col-lg col-xl'<'row'<'col-6float-left'f><'col-6 float-left'B>>><'col-6 col-lg col-xl'<'float-right'l>>>
          <'row'<'col-12'tr>>
          <'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      ajax: {
          "url": "<?php echo base_url('items/serverside_datatables_data_items') ?>",
          "type": "POST",
          "data": {
            "<?php echo $this->security->get_csrf_token_name(); ?>" : $('meta[name=csrf_token_hash]').attr('content')
          }
      },
      columns: [
          {
              data : "item_code"},
          {
              data : "item_name"},
          {
              render : function (data, type, row) {
                  return `${row['item_quantity']} (${row['item_unit']})`;
              }},
          {
          data : "item_code",
          render: function (data, type, row) {
              return `
              <div class="btn-group d-flex justify-content-center" data-id="${data}">
                <a href="<?=base_url('items/update')?>?id=${data}" target="_blank"
                  class="btn btn-sm btn-default" id="update" data-target="#modal-update"><i
                    class="fa fa-tw fa-pencil-alt"></i></a>
                <a href="<?=base_url('items/history')?>?id=${data}" target="_blank"
                  class="btn btn-sm btn-default" id="detail" data-target="#modal-detail"><i
                    class="fa fa-tw fa-search-plus"></i></a>
                <button class="btn btn-sm btn-default" id="delete" data-toggle="modal"
                  data-target="#modal-delete" onclick="$('#modal-delete input#item_code').val($(this).parent().data('id'));"><i class="fa fa-tw fa-trash-alt"></i></button>
              </div>
              `;
              }},
      ],
      buttons: [
        {
          text: 'Export', 
          extend: 'excelHtml5',
          className: 'btn-sm',
          customize: function ( xlsx ){
                  var sheet = xlsx.xl.worksheets['sheet1.xml'];
          }},
        {
          text: 'Import',
          className: 'btn-sm',
          action: function ( e, dt, node, config ) {
            $('#modal-import').modal('show');
          }},      
      ],
    });
    </script>