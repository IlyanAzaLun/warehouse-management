<?php $this->load->view('components/header')?>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed pace-primary">
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
              <div class="card">
                <div class="card-header bg-success">
                  <h3 class="card-title">Daftar berhasil dikirim</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <table id="tbl_invoice_send" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Kode Pengembalian</th>
                        <th>Kode Referensi</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-danger">
                  <h3 class="card-title">Daftar barang kembali, dari pengiriman</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_history_return" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Kode pengembalian</th>
                        <th>Kode pemesanan referensi</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($invoices as $key => $invoice): ?>
                    <tr>
                      <th scope="row" width="5px"><?=++$key?></th>
                      <td>
                        <div class="btn-group d-flex justify-content-center" data-id="<?=$invoice['invoice_order_id']?>" data-id-invoice="<?=$invoice['invoice_id']?>">
                          <a href="<?=base_url('shipping/info?id=').$invoice['invoice_reverence']?>" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-tw fa-search-plus"></i></a>
                        </div>
                      </td>
                      <td>
                        <p>
                          <?=$invoice['invoice_id']?>
                          <?=($invoice['status_active']=='0')?'<span class="right badge badge-danger">Cancel</span>':'';?>
                        </p>
                      </td>
                      <td>
                          <?=$invoice['invoice_reverence']?>
                      </td>
                      <td>
                        <small>
                          <?=date("d/F/Y H:i:s", strtotime($invoice['date']));?>
                        </small>
                      </td>
                      <td>
                        <small>
                          <a href="<?=base_url('customer/'.$invoice['to_customer_destination'])?>">
                            <?=$invoice['user_fullname']?>
                          </a>
                          <p><?=$invoice['user_address']?>,<?=$invoice['village']?><br><?=$invoice['sub-district']?>,<?=$invoice['district']?>,<?=$invoice['province']?>,<?=$invoice['zip']?></p>
                          <a href="https://wa.me/<?=$invoice['user_contact_phone']?>" target="_blank"><?=$invoice['user_contact_phone']?></a>

                        </small>
                      </td>
                      <td><small><?=$invoice['note']?></small></td>
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
    <script>
      $('table#tbl_invoice_send').dataTable({
      'dom': `<'row'<'col-6 col-lg col-xl'<'row'<'col-6float-left'f><'col-6 float-left'B>>><'col-6 col-lg col-xl'<'float-right'l>>>
          <'row'<'col-12'tr>>
          <'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      ordering : true,
      order: [[2, 'desc']],
      lengthMenu: [[10, 25, 50, 100, 200, <?=$this->db->count_all('tbl_item')?>], [10, 25, 50, 100, 200, "All"]],
      ajax: {
          "url": "<?php echo base_url('shipping/serverside_datatables_data_shipping') ?>",
          "type": "POST",
          "data": {
            "<?php echo $this->security->get_csrf_token_name(); ?>" : $('meta[name=csrf_token_hash]').attr('content')
          }
      },
      columns: [
          {
              data : "invoice_id",
              render: function(data, type, row){
                return `${data} ${(row['status_active']=='0')?'<span class="float-right right badge badge-danger">Cancel</span>':''}`;
              }},
          {
              data : "invoice_reverence"},
          {
              data : "date",
              },
          {
              data : "user_fullname",
              render : function (data, type, row) {
                  return `<b>${data}</b>, ${row['user_address']}, ${row['district']}, ${row['sub-district']}, ${row['village']}`;
              }},
          {
          data : "invoice_id",
          render: function (data, type, row) {
              return `
              <div class="btn-group d-flex justify-content-center" data-id="${data}">
                <a onclick="return false" href="<?=base_url('items/update')?>?id=${data}" target="_blank"
                  class="btn btn-sm btn-default" id="update" data-target="#modal-update"><i
                    class="fa fa-tw fa-pencil-alt"></i></a>
                <a onclick="return false" href="<?=base_url('items/history')?>?id=${data}" target="_blank"
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