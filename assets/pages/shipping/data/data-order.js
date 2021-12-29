class DataOrder {
	constructor() {
		this.BASEURL = location.href+'/';
		this.dataTabels();
	}

	dataTabels(){
		// cancel
		$('button#cancel').on('click', function(){
			$('#modal-cancel input#invoice_id').val($(this).parent().data('id-invoice'));
			$('#modal-cancel input#invoice_status').val((parseInt($(this).data('status')))?'0':'1');
		});
		// detail status
		$('button#status-item').on('click', function(){
			$('#modal-status-item b.text-danger').html($(this).data('variabel'));
			$('#modal-status-item input#invoice_id').val($(this).parent().data('id'));
			$('#modal-status-item input#invoice_status').val($(this).data('variabel'));
		})
	    // customer

		let self = this;
		let datatabels = $('#tbl_invoice*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'float-left'f>><'col-6 col-lg col-xl'<'float-right'l>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': true,
			'lengthChange': [[ 25, 50, 100, -1], [ 25, 50, 100, "All"]],
			'pageLength': 25

		});
	}

	search_order(id, id_invoice){
		var data = [];
		$.ajax({
			url: this.BASEURL+'API/order?id='+id,
			method: 'GET',
			dataType: 'JSON',
		})
		.done(function(result) {
			console.log("success ajax 1");
			data.push(result);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function(result) {
			$('#modal-detail tbody#tbl_order').empty();
			$('#modal-detail .float-right').empty();
			$('#modal-detail .modal-content form#form-detail-order').remove();
			$('#modal-detail .modal-content').append(`
			<form method="post" action="status" id="form-detail-order">
				<input type="hidden" name="invoice_id" id="invoice_id" value="${id_invoice}" readonly>
				<input type="hidden" name="invoice_status" id="invoice_status" value="status_validation" readonly>
				<div class="card-footer">
					<div class="float-right">
						<button type="button" class="btn btn-default mr-2" data-dismiss="modal">Close</button>
						<a href="return?id=${id_invoice}" target="_blank" class="btn btn-secondary mr-2">Ubah pesanan</a>
						<button type="submit" class="btn btn-success">Kirim</button>
					</div>
				</div>
			</form>
			`);
			$('label[for="code_order"]').text(`Kode order: ${result[0].order_id}`)
			$.each(result, function(index, field){
				let html = `
				<tr>
					<td>${field.item_id}</td>
					<td>${field.item_name} <small>${(field.MG)?`[MG: ${field.MG}, ML: ${field.ML}, VG: ${field.VG}, PG: ${field.PG}, (Falvour: ${field.falvour})]`:``}<small></td>
					<td class="text-right">${Math.abs(field.quantity_order)} (${field.unit})</td>
				</tr>					`;
				$('#modal-detail tbody#tbl_order').append(html);
			});
		});
		$.ajax({
			url: this.BASEURL+'API/order',
			method: 'POST',
			dataType: 'JSON',
			data: {id: id_invoice}
		})
		.done(function(result) {
			console.log("success ajax 2");
			console.log(data[0])
		})
		.fail(function() {
			console.log("error");
		})
		.always(function(result) {
			$.each(result, function(index, field){
				let html = `
				<tr class="bg-danger">
					<td>${field.item_id}</td>
					<td>${field.item_name} <small>${(field.MG)?`[MG: ${field.MG}, ML: ${field.ML}, VG: ${field.VG}, PG: ${field.PG}, (Falvour: ${field.falvour})]`:``}<small></td>
					<td class="text-right">${(field.quantity_order > 0)?`Barang lebih ${Math.abs(field.quantity_order)}`:`Barang Kurang ${Math.abs(field.quantity_order)}`} (${field.unit})</td>
				</tr>`;
				$('#modal-detail tbody#tbl_order').append(html);
			});
		});
	}
	search_return(id, id_invoice){
		$.ajax({
			url: this.BASEURL+'API/order?id='+id,
			method: 'GET',
			dataType: 'JSON',
			success: function(result){
				$('#modal-detail tbody#tbl_order').empty();
				$('#modal-detail .float-right').empty();
				$('label[for="code_order"]').text(`Kode order: ${result[0].order_id}`)
				$.each(result, function(index, field){
					let html = `
					<tr>
						<td>${field.item_id}</td>
						<td>${field.item_name} <small>${(field.MG)?`[MG: ${field.MG}, ML: ${field.ML}, VG: ${field.VG}, PG: ${field.PG}, (Falvour: ${field.falvour})]`:``}<small></td>
						<td class="text-right">${(field.quantity_order > 0)?`Barang lebih ${Math.abs(field.quantity_order)}`:`Barang Kurang ${Math.abs(field.quantity_order)}`} (${field.unit})</td>
					</tr>					`;
					$('#modal-detail tbody#tbl_order').append(html);
				});
			}
		})
	}
}
export default DataOrder;