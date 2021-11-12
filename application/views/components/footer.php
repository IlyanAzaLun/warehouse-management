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
<?
if (isset($plugins['js'])) {
  foreach ($plugins['js'] as $key => $value) {
    ?><script src="<?= $value ?>"></script><?
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
<?
if (isset($plugins['module'])) {
  foreach ($plugins['module'] as $key => $value) {
    ?><script type="module" src="<?= $value ?>"></script><?
  }
}
?>
<!-- page script -->
</body>
</html>
