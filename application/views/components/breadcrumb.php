<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <!-- container-fluid -->
    <div class="container-fluid">
      <div class="toast" data-icon="<?=@Flasher::getFlash()['icon']?>" data-title="<?=@Flasher::getFlash()['title'].@Flasher::getFlash()['message']?>"><?Flasher::unsetFlash()?></div>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?=$title?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><?=$title?></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
