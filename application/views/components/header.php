<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title ?></title>
  <link rel="icon" href="<?= base_url() ?>assets/images/logo.png">  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE-3.0.5/dist/css/ionicons.min.css">
  <!-- PLugins -->
  <?php if (isset($plugins['css'])) {
      foreach (
          $plugins['css']
          as $key => $value
      ) { ?><link href="<?= $value ?>" rel="stylesheet" type="text/css"/><?php }
  } ?>
  <!-- PLugins -->
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url(
      'assets/AdminLTE-3.0.5/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'
  ) ?>">
  <!-- pace-progress -->
  <link rel="stylesheet" href="<?= base_url(
      'assets/AdminLTE-3.0.5/plugins/pace-progress/themes/black/pace-theme-flat-top.css'
  ) ?>">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url(
      'assets/AdminLTE-3.0.5/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'
  ) ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(
      'assets/AdminLTE-3.0.5/dist/css/adminlte.min.css'
  ) ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="<?= base_url(
      'assets/Font/Source Sans Pro.css'
  ) ?>" rel="stylesheet">
</head>