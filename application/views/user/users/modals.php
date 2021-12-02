<div class="modal fade" id="modal-update">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah data</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?=base_url('user/update')?>" method="post" id="update">
				<div class="card-body">

					
					<div class="row">

						<div class="col-sm-3">
							<!-- text input -->
							<div class="form-group">
								<label>Nama pengguna</label>
								<input type="hidden" class="form-control" name="user_id" id="user_id"  value="<?=set_value('user_id')?>" required>
								<input type="text" class="form-control" name="user_fullname" id="user_fullname"  value="<?=set_value('user_fullname')?>" required>
							</div>
						</div>

						<div class="col-sm-9">
							<!-- text input -->
							<div class="form-group">
								<label>Alamat</label>
								<textarea type="text" class="form-control" name="user_address" id="user_address" required></textarea>
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
								<label>Peran penguna</label>
								<select name="role_id" id="role" class="form-control">
									<?php foreach ($roles as $key => $role): ?>
										<option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
									<?php endforeach ?>
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

						<div class="col align-self-end">
							<!-- text input -->
							<div class="form-group float-right">
								<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
									<input type="checkbox" class="custom-control-input" id="is_active" name="is_active">
									<label class="custom-control-label" for="is_active">Status aktif</label>
								</div>
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
	<div class="modal-dialog  modal-lg">
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
<!-- /.modal detail -->


<div class="modal fade" id="modal-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Hapus barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('user/delete')?>">
				<div class="modal-body">
					<p>Anda yakin untuk <b class="text-danger">Menghapus</b> pengguna ?</p>
					<input type="text" name="user_id" id="user_id" readonly>
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
