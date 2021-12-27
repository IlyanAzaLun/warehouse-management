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
        <h3 class="card-title">Ubah data barang</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
              class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove"><i
              class="fas fa-times"></i></button>
        </div>
      </div>
      <!-- /.card-header -->
      <form action="<?= base_url('item/update') ?>" method="post" id="insert">
      <div class="card-body">

      <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <label>Kategori barang</label>
                <input type="text" class="form-control" name="category" id="category"  value="<?= $items['item_category']?>" required readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
                <label>Kode barang</label>
                <input type="text" class="form-control" name="item_code" id="item_code"  value="<?= $items['item_code']?>" required readonly>
            </div>
        </div>

        <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
                <label>Nama barang</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="item_name" id="item_name"  value="<?= $items['item_name']?>" required>
                <div class="input-group-append">
                <select class="input-group-text" name="unit" id="unit" required>
                    <option value="<?= $items['unit']?>"><?= strtoupper($items['unit'])?></option>
                </select>
                </div>
            </div>
            </div>

        </div>
        <div class="col-sm-3 subcategory">
            <!-- text input -->
            <div class="form-group">
                <label>MG <small>(Nikotin)</small></label>
                <input type="number" class="form-control" name="MG" id="MG" value="<?= $items['MG']?>">
            </div>
        </div>
        <div class="col-sm-3 subcategory">
            <!-- text input -->
            <div class="form-group">
                <label>ML <small>(Milligram)</small></label>
                <input type="number" class="form-control" name="ML" id="ML" value="<?= $items['ML']?>">
            </div>
        </div>
        <div class="col-sm-3 subcategory">
            <!-- text input -->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>VG</label>
                        <input type="number" class="form-control" name="VG" id="VG" value="<?= $items['VG']?>">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label>PG</label>
                        <input type="number" class="form-control" name="PG" id="PG" value="<?= $items['PG']?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 subcategory">
            <!-- text input -->
            <div class="form-group">
                <label>Falvour <small>(Rasa)</small></label>
                <input type="text" class="form-control" name="falvour" id="falvour" value="<?= $items['falvour']?>">
            </div>
        </div><div class="col-sm-3 subcategory">
            <!-- text input -->
            <div class="form-group">
                <label>Brand 1</label>
                <input type="text" class="form-control" name="brand_1" id="brand_1" value="<?= $items['brand_1']?>" required>
            </div>
        </div><div class="col-sm-3 subcategory">
            <!-- text input -->
            <div class="form-group">
                <label>Brand 2</label>
                <input type="text" class="form-control" name="brand_2" id="brand_2" value="<?= $items['brand_2']?>">
            </div>
        </div>
        <!-- 
        <div class="col-sm-6">
            <div class="form-group">
                <label>Jumlah</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="quantity" id="quantity"  value="<?= $items['quantity']?>">
                    <div class="input-group-append">
                        <select class="input-group-text" name="unit" id="unit" required>
                            <option value="pcs">PCS</option>
                            <option value="pac">PAC</option>
                        </select>
                    </div>
                </div>
                <?//=form_error('quantity', '<small class="text-danger">','</small>')?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Harga pokok</label>
                <input type="text" class="form-control" name="capital_price" id="capital_price"  value="<?= $items['capital_price']?>" required>
                <?= form_error(
                    'capital_price',
                    '<small class="text-danger">',
                    '</small>'
                ) ?>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Harga jual</label>
                <input type="text" class="form-control" name="selling_price" id="selling_price"  value="<?= $items['selling_price']?>" required>
                <?= form_error(
                    'selling_price',
                    '<small class="text-danger">',
                    '</small>'
                ) ?>
            </div>
        </div> 
        -->

        <div class="col-sm">
            <!-- text input -->
            <div class="form-group">
                <label>Keterangan</label>
                <textarea type="text" class="form-control" name="note" id="note"><?= $items['note']?></textarea>
                <?= form_error(
                    'note',
                    '<small class="text-danger">',
                    '</small>'
                ) ?>
            </div>
        </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="float-right">
        <button type="submit" class="btn btn-primary float-right">Simpan</button>
        <button type="cancel" class="btn btn-default mr-2">Batal</button>
        </div>
      </div> 
      </form>
    </div>
  </div>
</div>
    </section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- cards -->
<?php $this->load->view('components/footer'); ?>
