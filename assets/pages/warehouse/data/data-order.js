class DataOrder {
	constructor() {
		this.BASEURL = location.href+'/';
		this.dataTabels();
	}

	dataTabels(){
		// cancel
		$('button#cancel').on('click', function () {
			$('#modal-cancel input#invoice_id').val($(this).parent().data('id-invoice'));
			$('#modal-cancel input#invoice_status').val((parseInt($(this).data('status'))) ? '0' : '1');
		});
		// change status
		$('button#status-item').on('click', function () {
			$('#modal-status-item b.text-danger').html($(this).data('variabel'));
			$('#modal-status-item input#invoice_id').val($(this).parent().data('id'));
			$('#modal-status-item input#invoice_status').val($(this).data('variabel'));
		})
		//return item confirmation on warehouse, return item to tbl_item quantity by value reference on tbl_order
		$('button#status-item-return').on('click', function () {
			$('#modal-status-item-return b.text-danger').html($(this).data('variabel'));
			$('#modal-status-item-return input#invoice_reverence').val($(this).parent().data('id'));
			$('#modal-status-item-return input#invoice_status').val($(this).data('variabel'));
		})

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

	search_order(id){
		$.ajax({
			url: this.BASEURL+'API/order?id='+id,
			method: 'GET',
			dataType: 'JSON',
			success: function(result){
				$('#modal-detail tbody#tbl_order').empty();
				$('label[for="code_order"]').text(`Kode order: ${result[0].order_id}`)
				let grand_total = 0;
				$.each(result, function(index, field){
					let html = `
					<tr>
						<td>${field.item_id}</td>
						<td>${field.item_name} ${(field.MG)?`(MG: ${field.MG})`:``}</td>
						<td class="text-right">${Math.abs(field.quantity_order)} (${field.unit})</td>
					</tr>
					`;
					$('#modal-detail tbody#tbl_order').append(html);
				});
			}
		})
	}

	search_return(id, id_invoice){
		$.ajax({
			url: this.BASEURL+'API/order?id='+id,
			method: 'GET',
			dataType: 'JSON',
			success: function(result){
				$('#modal-detail tbody#tbl_order').empty();
				$('label[for="code_order"]').text(`Kode order: ${result[0].order_id}`)
				let grand_total = 0;
				$.each(result, function(index, field){
					let html = `
					<tr>
						<td>${field.item_id}</td>
						<td>${field.item_name} ${(field.MG)?`(MG: ${field.MG})`:``}</td>
						<td class="text-right">${(field.quantity_order > 0)?`Barang lebih ${Math.abs(field.quantity_order)}`:`Barang Kurang ${Math.abs(field.quantity_order)}`} (${field.unit})</td>
					</tr>
					`;
					$('#modal-detail tbody#tbl_order').append(html);
				});
			}
		})
	}
}
export default DataOrder;