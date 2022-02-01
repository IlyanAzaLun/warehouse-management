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
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="card-title">Daftar barang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_items" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Kode barang</th>
                        <th>Nama barang</th>
                        <th>Jumlah</th>
                        <th>Opsi</th>
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
      lengthMenu: [[10, 25, 50, 100, 200, <?=$this->db->count_all('tbl_item')?>], [10, 25, 50, 100, 200, "All"]],
      ajax: {
          "url": "<?php echo base_url('stock/serverside_datatables_data_stock') ?>",
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
                <a href="<?= base_url('stock/restock')?>?id=${data}" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-tw fa-plus"></i></a>
                <a href="<?=base_url('items/history')?>?id=${data}" target="_blank"
                  class="btn btn-sm btn-default" id="detail" data-target="#modal-detail"><i
                    class="fa fa-tw fa-search-plus"></i></a>
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
      ]

    });
    </script>