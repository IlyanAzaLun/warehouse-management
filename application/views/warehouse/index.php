<?php $this->load->view('components/header'); ?>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed pace-primary">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->load->view('components/navbar'); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->load->view('components/sidebar'); ?>
    <!-- /.Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <!-- container-fluid -->
        <?php $this->load->view('components/breadcrumb'); ?>
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
                  <h3 class="card-title">Daftar riwayat pemesanan keluar</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_invoice" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th width="10%">Kode pemesanan</th>
                        <th width="10%">Tanggal</th>
                        <th width="20%">Tujuan</th>
                        <th width="40%">Keterangan</th>
                        <th width="10%">Status validasi barang</th>
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
    <?php $this->load->view('components/footer'); ?>
    <script>
    $('table#tbl_invoice').dataTable({
      'dom': `<'row'<'col-6 col-lg col-xl'<'row'<'col-6float-left'f><'col-6 float-left'B>>><'col-6 col-lg col-xl'<'float-right'l>>>
          <'row'<'col-12'tr>>
          <'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      lengthMenu: [[10, 25, 50, 100, 200, <?=$this->db->count_all('tbl_item')?>], [10, 25, 50, 100, 200, "All"]],
      ajax: {
          "url": "<?php echo base_url('warehouse/serverside_datatables_data_warehouse') ?>",
          "type": "POST",
          "data": {
            "<?php echo $this->security->get_csrf_token_name(); ?>" : $('meta[name=csrf_token_hash]').attr('content')
          }
      },
      columns: [
          {
              data : "invoice_id",
              render: function(data, type, row){
                  return `<small><b>${data}</b></small></small>`;
              }},
          {
              data : "date",
              render: function(data, type, row){
                  return `<small>${data}</small>`;
              }},
          {
              render : function (data, type, row) {
                  return `<small><b>${row['user_fullname']}, ${row['owner_name']}</b>, ${row['user_address']}, ${row['village']}, ${row['sub-district']}, ${row['village']}, ${row['district']}, ${row['province']}, ${row['zip']}, ${row['zip']}, <a href="https://wa.me/${row['user_contact_phone']}" target="_blank">${row['user_contact_phone']}</a></small>`;
              }},
          {
              data : "note_invoice",
              render : function(data, type, row){
                  return `<small>${data}</small>`
              }},
          {
              data : "status_validation",
              render: function(data, type, row){
                  let status_validation = ``;
                  let status_item = ``;
                  parseInt(data)?
                  status_validation+=`<button disabled class="btn btn-sm btn-success"><i class="fa fa-tw fa-check"></i></button>`:
                  status_validation+=`<button disabled class="btn btn-sm btn-danger"><i class="fa fa-tw fa-times"></i></button>`;
                  parseInt(row['status_item'])?
                  status_item+=`<button disabled class="btn btn-sm btn-success"><i class="fa fa-tw fa-check"></i></button>`:
                  status_item+=`<button disabled class="btn btn-sm btn-danger"><i class="fa fa-tw fa-times"></i></button>`;
                  return `
                  <div class="btn-group d-flex justify-content-center">
                  ${status_item}
                  ${status_validation}
                  </div>`;
              }},
          {
              data : "invoice_id",
              render: function (data, type, row) {
                  return `
                  <div class="btn-group d-flex justify-content-center" data-id="${data}">
                    <a href="<?=base_url('warehouse/info?id=')?>${data}" target="_blank" class="btn btn-sm btn-default">
                      <i class="fa fa-tw fa-search-plus"></i>
                    </a>
                  </div>`;
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
          text: 'Buat antrian barang',
          className: 'btn-sm',
          action: function(){
            window.location.replace("<?php echo base_url('warehouse/queue') ?>");
          }},
      ],
    });
    </script>