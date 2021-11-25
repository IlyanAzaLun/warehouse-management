
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version:</b> Alpha 0.0.1
    </div>
    <strong>Copyright &copy; <?=date('Y')?> <a href="http://adminlte.io">AdminLTE.io</a> | <a href="https://ilyanazalun.github.io">Ilyan Aza-lun</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <?php $this->load->view('components/sidebar_config')?>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal-logout">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ready to Leave?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select "Sign out" below if you are redy ti end your current session.&hellip;</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?=base_url('auth/signout')?>" class="btn btn-primary">Sign out</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- jQuery -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<?php
if (isset($plugins['js'])) {
      foreach ($plugins['js'] as $key => $value) {
          ?><script src="<?= $value ?>"></script><?php
      }
  }
?>
<!-- overlayScrollbars -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- pace-progress -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/pace-progress/pace.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Moment -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/plugins/moment/moment.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for app purposes -->
<script src="<?=base_url()?>assets/AdminLTE-3.0.5/dist/js/app.js"></script>
<script src="<?=base_url()?>assets/utility/attrib.js"></script>
<?php
if (isset($plugins['module'])) {
      foreach ($plugins['module'] as $key => $value) {
          ?><script type="module" src="<?= $value ?>"></script><?php
      }
  }
?>
<!-- page script -->
</body>
</html>
