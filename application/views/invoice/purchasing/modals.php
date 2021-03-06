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
							<tr>
								<th>Kode barang</th>
								<th>Nama barang</th>
								<th>Harga barang pokok</th>
								<th>Harga barang jual</th>
								<th>Jumlah barang (unit)</th>
								<th>Potongan harga barang</th>
								<th>Total harga <small>(HP &times; JML) - PHB</small></th>
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
<!-- /.modal detail-->

<div class="modal fade" id="modal-cancel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cancel invoice</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('purchase/invoice/cancel')?>">
				<div class="modal-body">
					<p>Are you sure to <b class="text-danger">Cancel</b> invoice ?</p>
					<input type="hidden" name="invoice_id" id="invoice_id" readonly>
					<input type="hidden" name="request" id="request" value="POST">
					<input type="hidden" name="invoice_status" id="invoice_status">
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

<div class="modal fade" id="modal-status-item">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah status barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('invoice/delete')?>">
				<div class="modal-body">
					<p>Are you sure to <b class="text-danger">status-item</b> invoice ?</p>
					<input type="hidden" name="invoice_id" id="invoice_id" readonly>
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

<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah status</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<p>Are you sure to <b class="text-danger" id="status"></b> invoice ?</p>
					<input type="hidden" name="invoice_id" id="invoice_id" readonly>
					<span id="button">
						
					</span>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- /.modal detail status -->
<div class="modal fade" id="modal-delete_order" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Hapus item order</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="order/remove" method="post">
				<div class="modal-body">
					<p>Are you sure to <b class="text-danger">remove</b> order item ?</p>
					<input type="text" name="id_order" id="id_order" readonly>
					<span id="button">
					</span>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal detail status -->
