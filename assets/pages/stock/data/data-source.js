class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){

    	let self = this;
		$('#tbl_items*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'float-left'f>><'col-6 col-lg col-xl'>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': false

		});
		
	}

	/* not used
	getcode(type){
		function pad (str, max) {
	 		str = str.toString();
			return str.length < max ? pad("0" + str, max) : str;
		}
		function sub (data) {
			let result = [];
			$.each(data.split('-'), function(index, field){
				result.push(field.charAt(0))
			})
			return result.join('');
		}
		$.ajax({
			url: this.BASEURL+'getcode',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': type},
			success: function(result){

				$('input#item_code').val(`${$('.category').find(':selected').data('id').substring(0, 3)}${($('.subcategory')
						.find(':selected').data('id'))?`-${sub($('.subcategory').find(':selected').val())}-`:`-`
					}${pad(result+1, 4)}`)
			}
		})
	}
	*/
	gethistory(code_item){
		function dateformat(data){
			let d = new Date(data *1000)
			return d.toDateString();
		}
		$.ajax({
			url: this.BASEURL+'get-history',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': code_item},
			success: function(result){
				$('#modal-detail tbody#tbl_history').empty();
				if (!result[0]) {
					const html = `
					<tr>
						<td colspan="5" class="text-center"><b>Data kosong</b></td>
					</tr>
					`;
					$('#modal-detail tbody#tbl_history').append(html);
				}
				$.each(result, function(index, field){
					const html = `
					<tr>
						<td>${field.item_code}</td>
						<td>${field.previous_quantity}</td>
						<td>${field.previous_selling_price}</td>
						<td>${field.previous_capital_price}</td>
						<td>${field.status_in_out}</td>
						<td>${dateformat(field.update_at)}</td>
					</tr>
					`;

					$('#modal-detail tbody#tbl_history').append(html);
				})
			}
		})
	}
	getitem(code_item){
		$.ajax({
			url: this.BASEURL+'get-item',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': code_item},
			success: function(result){
				$('#modal-add-stock input#item_code').val(result.item_code);
				$('#modal-add-stock input#category').val(result.item_category); //
				$('#modal-add-stock input#item_name').val(result.item_name);
				$('#modal-add-stock input#MG').val(result.MG);
				$('#modal-add-stock input#ML').val(result.ML);
				$('#modal-add-stock input#VG').val(result.VG);
				$('#modal-add-stock input#PG').val(result.PG);
				$('#modal-add-stock input#falvour').val(result.falvour);
				$('#modal-add-stock input#brand_1').val(result.brand_1);
				$('#modal-add-stock input#brand_2').val(result.brand_2);
				$('#modal-add-stock input#quantity').val(result.quantity);
				// $('#modal-add-stock input#unit').val(result.unit);
				$('#modal-add-stock select#unit').find('option[value="'+result.unit+'"').prop('selected', true);
				$('#modal-add-stock input#capital_price').val(currencyToNum(result.capital_price));
				$('#modal-add-stock input#selling_price').val(currencyToNum(result.selling_price));
				$('#modal-add-stock textarea#note').val(result.note);
			}	
		})
	}
}
export default DataSource;