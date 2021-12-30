<div class="modal fade" id="modal-detail">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Info pemesanan barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card-body">

				<div class="row">
					<label for="code_order">Kode order: </label>
					<table class="table table-sm table-striped table-bordered">
						<thead>
							<tr id="thead">
								<th>Kode barang</th>
								<th>Nama barang</th>
								<th>Jumlah barang (unit)</th>
							</tr>
						</thead>
						<tbody id="tbl_order">

						</tbody>
					</table>
				</div>

			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<div class="float-right">
					<!-- <button type="submit" class="btn btn-primary float-right">Save</button> -->
					<button type="button" class="btn btn-default mr-2" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal update-->

<div class="modal fade" id="modal-cancel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cancel invoice</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('warehouse/cancel')?>">
				<div class="modal-body">
					<p>Are you sure to <b class="text-danger">Cancel</b> invoice ?</p>
					<input type="hidden" name="request" id="request" value="POST" readonly>
					<input type="hidden" name="invoice_id" id="invoice_id" readonly>
					<input type="hidden" name="invoice_status" id="invoice_status" readonly>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Yes do it&hellip;</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal delete -->

<div class="modal fade" id="modal-status-item-return">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah status barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('warehouse/status-return')?>">
				<div class="modal-body">
					<p>Ubah status barang penerimaan <b class="text-danger"></b> ?</p>
					<input type="hidden" name="invoice_reverence" id="invoice_reverence" readonly>
					<input type="hidden" name="invoice_status" id="invoice_status" readonly>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-danger">Ya lakukan...&hellip;</button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal update status -->
<div class="modal fade" id="modal-history">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Info riwayat pemesanan barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="card-body">

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Kode item</th>
							<th>Harga pokok</th>
							<th>Harga jual</th>
							<th>Jumlah barang</th>
							<th>Potongan harga</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody id="tbl_history">
						
					</tbody>
				</table>

			</div>
			<!-- /.card-body -->
			<div class="card-footer">
				<div class="float-right">
					<button type="button" class="btn btn-default mr-2" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal history-->