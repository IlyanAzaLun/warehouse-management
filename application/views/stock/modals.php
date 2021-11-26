modals.php<div class="modal fade" id="modal-add-stock">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url('stock')?>" method="post" id="add-stock">
				<div class="card-body">

					<div class="row">

						<div class="col-sm-6">
							<div class="form-group">
								<label>Kategori barang</label>
								<input type="text" class="form-control" name="category" id="category"  value="<?=set_value('category')?>" required readonly>
							</div>
						</div>

						<div class="col-sm-6">
							<!-- text input -->
							<div class="form-group">
								<label>Kode barang</label>
								<input type="text" class="form-control" name="item_code" id="item_code"  value="<?=set_value('item_code')?>" required readonly>
							</div>
						</div>

						<div class="col-sm-6">
							<!-- text input -->
							<div class="form-group">
								<label>Nama barang</label>
								<input type="text" class="form-control" id="item_name"  value="<?=set_value('item_name')?>" required readonly>
							</div>
						</div>

						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>MG <small>(Nikotin)</small></label>
								<input type="number" class="form-control" id="MG" value="<?=set_value('MG')?>" readonly>
							</div>
						</div>
						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>ML <small>(Milligram)</small></label>
								<input type="number" class="form-control" id="ML" value="<?=set_value('ML')?>" readonly>
							</div>
						</div>
						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>VG</label>
										<input type="number" class="form-control" id="VG" value="<?=set_value('VG')?>" readonly>
									</div>
								</div>

								<div class="col-6">
									<div class="form-group">
										<label>PG</label>
										<input type="number" class="form-control" id="PG" value="<?=set_value('PG')?>" readonly>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>Falvour <small>(Rasa)</small></label>
								<input type="text" class="form-control" id="falvour" value="<?=set_value('falvour')?>" readonly>
							</div>
						</div><div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>Brand 1</label>
								<input type="text" class="form-control" id="brand_1" value="<?=set_value('brand_1')?>" required readonly>
							</div>
						</div><div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>Brand 2</label>
								<input type="text" class="form-control" id="brand_2" value="<?=set_value('brand_2')?>" readonly>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="row">
								<div class="col-6">
									
							<!-- text input -->
							<div class="form-group">
								<label>Jumlah sekarang</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="quantity" id="quantity"  value="<?=set_value('quantity')?>" readonly>
									<div class="input-group-append">
										<select class="input-group-text" name="unit" id="unit" required disabled>
											<option value="pcs">PCS</option>
											<option value="pac">PAC</option>
										</select>
									</div>
								</div>
								<?=form_error('quantity', '<small class="text-danger">','</small>')?>
							</div>

								</div>
								<div class="col-6">
									
							<!-- text input -->
							<div class="form-group">
								<label>Tambah jumlah</label>
								<div class="input-group mb-3">
									<input type="number" class="form-control" name="add_quantity" id="add_quantity"  value="0">
									<div class="input-group-append">
										<select class="input-group-text" name="unit" id="unit" required>
											<option value="pcs">PCS</option>
											<option value="pac">PAC</option>
										</select>
									</div>
								</div>
								<?=form_error('quantity', '<small class="text-danger">','</small>')?>
							</div>

								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<!-- text input -->
							<div class="form-group">
								<label>Harga pokok</label>
								<input type="hidden" class="form-control" name="previous_capital_price" id="capital_price"  value="<?=set_value('capital_price')?>" required readonly>
								<input type="number" class="form-control" name="capital_price" id="capital_price"  value="<?=set_value('capital_price')?>" required>
								<?=form_error('capital_price', '<small class="text-danger">','</small>')?>
							</div>
						</div>
						<div class="col-sm-3">
							<!-- text input -->
							<div class="form-group">
								<label>Harga jual</label>
								<input type="hidden" class="form-control" name="previous_selling_price" id="selling_price"  value="<?=set_value('selling_price')?>" required readonly>
								<input type="number" class="form-control" name="selling_price" id="selling_price"  value="<?=set_value('selling_price')?>" required>
								<?=form_error('selling_price', '<small class="text-danger">','</small>')?>
							</div>
						</div>

						<div class="col-sm">
							<!-- text input -->
							<div class="form-group">
								<label>Keterangan</label>
								<textarea type="text" class="form-control" name="note" id="note"><?=set_value('note')?></textarea>
								<?=form_error('note', '<small class="text-danger">','</small>')?>
							</div>
						</div>
					</div>

				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<div class="float-right">
						<button type="submit" class="btn btn-primary float-right">Simpan</button>
						<button type="button" class="btn btn-default mr-2" data-dismiss="modal">Batal</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal update-->
<div class="modal fade" id="modal-detail">
	<div class="modal-dialog  modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Riwayat persediaan barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Kode item</th>
							<th>Jumlah <small>barang sebelumnya</small></th>
							<th>Harga modal <small>barang sebelumnya</small></th>
							<th>Harga jual <small>barang sebelumnya</small></th>
							<th>Tanggal diubah</th>
						</tr>
					</thead>
					<tbody id="tbl_history">
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal delete -->