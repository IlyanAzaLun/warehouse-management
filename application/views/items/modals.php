<div class="modal fade" id="modal-update">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url('item/update')?>" method="post" id="update">
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
	                          <div class="input-group mb-3">
								<input type="text" class="form-control" name="item_name" id="item_name"  value="<?=set_value('item_name')?>" required>
	                            <div class="input-group-append">
	                              <select class="input-group-text" name="unit" id="unit" required>
	                                <option value="pcs">PCS</option>
	                                <option value="pac">PAC</option>
	                              </select>
	                            </div>
	                          </div>
	                        </div>

						</div>

						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>MG <small>(Nikotin)</small></label>
								<input type="number" class="form-control" name="MG" id="MG" value="<?=set_value('MG')?>">
							</div>
						</div>
						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>ML <small>(Milligram)</small></label>
								<input type="number" class="form-control" name="ML" id="ML" value="<?=set_value('ML')?>">
							</div>
						</div>
						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>VG</label>
										<input type="number" class="form-control" name="VG" id="VG" value="<?=set_value('VG')?>">
									</div>
								</div>

								<div class="col-6">
									<div class="form-group">
										<label>PG</label>
										<input type="number" class="form-control" name="PG" id="PG" value="<?=set_value('PG')?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>Falvour <small>(Rasa)</small></label>
								<input type="text" class="form-control" name="falvour" id="falvour" value="<?=set_value('falvour')?>">
							</div>
						</div><div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>Brand 1</label>
								<input type="text" class="form-control" name="brand_1" id="brand_1" value="<?=set_value('brand_1')?>" required>
							</div>
						</div><div class="col-sm-3 subcategory">
							<!-- text input -->
							<div class="form-group">
								<label>Brand 2</label>
								<input type="text" class="form-control" name="brand_2" id="brand_2" value="<?=set_value('brand_2')?>">
							</div>
						</div>
						<!-- 
						<div class="col-sm-6">
							<div class="form-group">
								<label>Jumlah</label>
								<div class="input-group mb-3">
									<input type="text" class="form-control" name="quantity" id="quantity"  value="<?=set_value('quantity')?>">
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
						-->
						<div class="col-sm-3">
							<!-- text input -->
							<div class="form-group">
								<label>Harga pokok</label>
								<input type="text" class="form-control" name="capital_price" id="capital_price"  value="<?=set_value('capital_price')?>" required>
								<?=form_error('capital_price', '<small class="text-danger">','</small>')?>
							</div>
						</div>
						<div class="col-sm-3">
							<!-- text input -->
							<div class="form-group">
								<label>Harga jual</label>
								<input type="text" class="form-control" name="selling_price" id="selling_price"  value="<?=set_value('selling_price')?>" required>
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
						<button type="cancel" class="btn btn-default mr-2">Batal</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal update-->

<div class="modal fade" id="modal-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Hapus barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('item/delete')?>">
				<div class="modal-body">
					<p>Anda yakin untuk <b class="text-danger">Menghapus</b> barang ?</p>
					<input type="hidden" name="item_code" id="item_code" readonly>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-danger">Ya, saya yakin!&hellip;</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal delete -->
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
				<table class="table table-sm table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Kode item</th>
							<th>Jumlah <small>barang sebelumnya</small></th>
							<th>Harga modal <small>barang sebelumnya</small></th>
							<th>Harga jual <small>barang sebelumnya</small></th>
							<th>Status barang (masuk / keluar)</th>
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
<!-- /.modal detail -->