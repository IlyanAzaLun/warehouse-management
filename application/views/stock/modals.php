<div class="modal fade" id="modal-import">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Import update jumlah barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('stock/import')?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="file">File Excel</label>
						<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="file" name="file">
							<label class="custom-file-label" for="file">Choose file Excel</label>
						</div>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal import -->