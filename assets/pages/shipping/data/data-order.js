class DataOrder {
	constructor() {
		this.BASEURL = location.href+'/';
		this.dataTabels();
	}

	dataTabels(){
		let self = this;
		let datatabels = $('#tbl_invoice*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'float-left'f>><'col-6 col-lg col-xl'<'float-right'l>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': true

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
						<td>${field.item_name} <small>${(field.MG)?`[MG: ${field.MG}, ML: ${field.ML}, VG: ${field.VG}, PG: ${field.PG}, (Falvour: ${field.falvour})]`:``}<small></td>
						<td class="text-right">${field.capital_price}</td>
						<td class="text-right">${field.selling_price}</td>
						<td class="text-right">${Math.abs(field.quantity_order)} (${field.unit})</td>
						<td class="text-right">${field.rabate}</td>
						<td class="text-right">${currency(Math.abs((parseInt(field.selling_price.replace(/[,]|[.]/g,''))*parseInt(field.quantity_order))-parseInt(field.rabate.replace(/[,]|[.]/g,''))))}</td>
					</tr>
					`;
					grand_total += (parseInt(field.selling_price.replace(/[,]|[.]/g,''))*parseInt(field.quantity_order))-parseInt(field.rabate.replace(/[,]|[.]/g,''))
					$('#modal-detail tbody#tbl_order').append(html);
				});
				$('#modal-detail tbody#tbl_order').append(`
				<tr>
					<td colspan="7" class="text-right"><b>Total: ${currency(Math.abs(grand_total))}</b></td>
				</tr>
				`);
			}
		})
	}
}
export default DataOrder;