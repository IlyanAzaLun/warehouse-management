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

          <!-- insert -->
          <div class="row">
            <div class="col-12">
              <!-- /.col -->          
              <div class="card">
                <div class="card-header bg-primary">
                  <h3 class="card-title">Tambah data pelanggan barang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <form action="<?=base_url('customer')?>" method="post" id="insert">
                  <div class="card-body">

                    <div class="row">

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nama toko pelanggan</label>
                          <input type="text" class="form-control" name="user_fullname" id="user_fullname"  value="<?=set_value('user_fullname')?>" required>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Nama pemeilik</label>
                          <input type="text" class="form-control" name="owner_name" id="owner_name"  value="<?=set_value('owner_name')?>" required>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        
                        <!-- text input -->
                        <div class="form-group">
                          <label>Alamat</label>
                          <textarea type="text" class="form-control" name="user_address" id="user_address" required><?=set_value('user_address')?></textarea>
                          <?=form_error('user_address', '<small class="text-danger">','</small>')?>
                        </div>

                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Desa</label>
                          <input type="text" class="form-control" name="village" id="village"  value="<?=set_value('village')?>" required>
                        </div>
                      </div>
                      
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kecamatan</label>
                          <input type="text" class="form-control" name="sub-district" id="sub-district"  value="<?=set_value('sub-district')?>" required>
                          <?=form_error('sub-district', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kabupaten</label>
                          <input type="text" class="form-control" name="district" id="district"  value="<?=set_value('district')?>" required>
                          <?=form_error('district', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>
                      
                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Provnsi</label>
                          <input type="text" class="form-control" name="province" id="province"  value="<?=set_value('province')?>" required>
                          <?=form_error('province', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kode pos</label>
                          <input type="number" class="form-control" name="zip" id="zip"  value="<?=set_value('zip')?>" required>
                          <?=form_error('zip', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kontak Telepon</label>
                          <input type="number" class="form-control" name="user_contact_phone" id="user_contact_phone"  value="<?=set_value('user_contact_phone')?>" required>
                          <?=form_error('user_contact_phone', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kontak Email</label>
                          <input type="text" class="form-control" name="user_contact_email" id="user_contact_email"  value="<?=set_value('user_contact_email')?>" required>
                          <?=form_error('user_contact_email', '<small class="text-danger">','</small>')?>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Kategori pelanggan</label>
                          <select class="form-control" style="width: 100%;" name="type_id" id="type_id"  value="<?=set_value('type_id')?>" required>
                            <option value="" selected="selected">Pilih kategori pelanggan</option>
                            <option value="WS" <?=set_select('type_id', 'WS')?>>WS</option>
                            <option value="Agen biasa" <?=set_select('type_id', 'Agen biasa')?>>Agen biasa</option>
                            <option value="Agen spesial" <?=set_select('type_id', 'Agen spesial')?>>Agen spesial</option>
                            <option value="Distri" <?=set_select('type_id', 'Distri')?>>Distri</option>
                            <option value="Dll" <?=set_select('type_id', 'Dll')?>>Dll</option>
                          </select>
                        </div>
                      </div>

                      <div class="col">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Keterangan</label>
                          <textarea type="text" class="form-control" name="note" id="note"><?=set_value('note')?></textarea>
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
                  <h3 class="card-title">Daftar pelanggan barang</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="tbl_customer" class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Opsi</th>
                        <th>Kode pelanggan</th>
                        <th>Nama toko pelanggan</th>
                        <th>Nama pemilik pelanggan</th>
                        <th>Alamat</th>
                        <th>Kontak pelanggan</th>
                        <th>Kategori pelanggan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($customers as $key => $customer): ?>

                        <tr id="<?=$customer['user_id']?>" class="<?=((int)$customer['is_active'])?'bg-red':''?>">
                          <th scope="row" width="5px"><?=++$key?></th>
                          <td>
                            <div class="btn-group d-flex justify-content-center" data-id="<?=$customer['user_id']?>">
                              <button class="btn btn-sm btn-default" id="update" data-toggle="modal" data-target="#modal-update"><i class="fa fa-tw fa-pencil-alt"></i></button>
                              <button class="btn btn-sm btn-default" id="delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-tw fa-trash-alt"></i></button>
                            </div>
                          </td>
                          <td><?=$customer['user_id']?></td>
                          <td><?=$customer['user_fullname']?></td>
                          <td><?=$customer['owner_name']?></td>
                          <td>
                            <p><?=$customer['user_address']?>, <?=$customer['village']?><br>
                            <?=$customer['sub-district']?>, <?=$customer['district']?><br>
                            <?=$customer['province']?>, <?=$customer['zip']?></p>
                          </td>
                          <td>
                            <span><?=$customer['user_contact_phone']?> /<br></span>
                            <span><?=$customer['user_contact_email']?></span>
                          </td>
                          <td><?=$customer['type_id']?></td>
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