class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
		this.dataTabels();
	}

	dataTabels(){

    	let self = this;
		let datatabels = $('table#tbl_items*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'row'<'col-6float-left'f><'col-6 float-left'B>>><'col-6 col-lg col-xl'<'float-right'l>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': true,
			'buttons': [
				{
					text: 'Import',
					className: 'btn-sm bg-primary',
					action: function ( e, dt, node, config ) {
						$('#modal-import').modal('show');
					}
				}
			]

		});
		$('input#item_name').keyup(function(){
			datatabels.fnFilter(this.value);
		})
		
	}
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
			url: this.BASEURL+'get-item-code',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': type},
			success: function(result){

				$('input#item_code').val(`${$('.category').find(':selected').data('id').substring(0, 3)}${($('.subcategory').find(':selected').data('id'))
				?`-${sub($('.subcategory').find(':selected').data('id'))}-`
				:`-`}${pad(result+1, 4)}`)
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
				$('#modal-update input#item_code').val(result.item_code);
				$('#modal-update input#category').val(result.item_category); //
				$('#modal-update input#item_name').val(result.item_name);
				$('#modal-update input#MG').val(result.MG);
				$('#modal-update input#ML').val(result.ML);
				$('#modal-update input#VG').val(result.VG);
				$('#modal-update input#PG').val(result.PG);
				$('#modal-update input#falvour').val(result.falvour);
				$('#modal-update input#brand_1').val(result.brand_1);
				$('#modal-update input#brand_2').val(result.brand_2);
				$('#modal-update input#quantity').val(result.quantity);
				$('#modal-update select#unit').find('option[value="'+result.unit+'"').prop('selected', true);
				$('#modal-update input#capital_price').val(result.capital_price);
				$('#modal-update input#selling_price').val(result.selling_price);
				$('#modal-update textarea#note').val(result.note);
			}	
		})
	}
	gethistory(code_item){
		function dateformat(data){
			let d = new Date(data *1000)
			return d.toLocaleString();
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
}
export default DataSource;