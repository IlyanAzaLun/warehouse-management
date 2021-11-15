class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){

    	let self = this;
		$('#tbl_items*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'><'col-6 col-lg col-xl'<'float-right'f>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': false

		});
		
	}
	getcode(type){
		function pad (str, max) {
		  str = str.toString();
		  return str.length < max ? pad("0" + str, max) : str;
		}
		$.ajax({
			url: this.BASEURL+'getcode',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': type},
			success: function(result){

				$('input#item_code')
				.val(`${$('.category')
					.find(':selected').data('id')}${($('.subcategory')
						.find(':selected').data('id'))?`-${$('.subcategory')
					.find(':selected').data('id')}-`:`-`}${pad(result+1, 4)}`)
			}
		})
	}
	getitem(code_item){
		$.ajax({
			url: this.BASEURL+'getitem',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': code_item},
			success: function(result){
				$('#modal-update input#item_code').val(result.item_code);
				$('#modal-update input#category').val(result.item_category); //
				$('#modal-update input#item_name').val(result.item_name);
				$('#modal-update input#quantity').val(result.quantity);
				// $('#modal-update input#unit').val(result.unit);
				$('#modal-update select#unit').find('option[value="'+result.unit+'"').prop('selected', true);
				$('#modal-update input#capital_price').val(result.capital_price);
				$('#modal-update input#selling_price').val(result.selling_price);
			}	
		})
	}
}
export default DataSource;