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
        <h3 class="card-title">History perubahan data barang <?= $this->input->get('id') ?></h3>
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
      				<th>Jumlah sebelumnya</th>
      				<th>Jumlah masuk/keluar</th>
      				<th>Diubah</th>
      			</tr>
      		</thead>
      		<tbody>
            <?php if (@$history[0]): ?>
            
            <?php foreach($history as $key => $value):?>
            <tr>
              <td><?= $value['previous_quantity']?></td>
              <td><?= $value['status_in_out']?></td>
              <td><?= date("d/F/Y H:i:s", strtotime($value['update_at']));?></td>
            </tr>
            <?php endforeach ?>

            <?php else: ?>
              <tr><td colspan="3" class="text-center"><b>Data Kosong</b></td></tr>
            <?php endif ?>
      			
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
