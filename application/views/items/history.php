<?php $this->load->view('components/header'); ?>

<body
class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed layout-footer-fixed pace-primary">
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

<!-- insert -->
<div class="row">
  <div class="col-12">
    <!-- /.col -->
    <div class="card">
      <div class="card-header bg-primary">
        <h3 class="card-title">History perubahan data barang <b><?=$item['item_name']?></b></h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
              class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i
              class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div>
          Jumlah saat ini: <b><?=$item['quantity']?> (<?=$item['unit']?>)</b>
        </div>
      	<table id="tbl_items_history" class="table table-sm table-bordered table-striped table-hover">
      		<thead>
      			<tr>
      				<th>Jumlah sebelumnya</th>
      				<th>Jumlah masuk/keluar</th>
      				<th>Diubah</th>
              <th>Oleh</th>
      			</tr>
      		</thead>
      		<tbody>
      		</tbody>
      	</table>
      </div>
    </div>
  </div>
</div>
    </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- cards -->
<?php $this->load->view('components/footer'); ?>
    <script>
    $('table#tbl_items_history').dataTable({
      'dom': `<'row'<'col-6 col-lg col-xl'<'row'<'col-6float-left'f><'col-6 float-left'B>>><'col-6 col-lg col-xl'<'float-right'l>>>
          <'row'<'col-12'tr>>
          <'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      ajax: {
          "url": "<?php echo base_url('items/serverside_datatables_data_items_history') ?>",
          "type": "POST",
          "data": {
            "<?php echo $this->security->get_csrf_token_name(); ?>" : $('meta[name=csrf_token_hash]').attr('content'),
            id: '<?php echo $this->input->get('id'); ?>'
          }
      },
      columns: [
          {
              data : "previous_quantity",
              render: function(data, type, row){
                  return `<small><b>${data}</b></small></small>`;
              }},
          {
              data : "status_in_out",
              render: function(data, type, row){
                  return `<small>${data}</small>`;
              }},
          {
              data : "created_at",
              render : function(data, type, row){
                  return `<small>${data}</small>`
              }},
          {
              data : "created_by",
              }
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