class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
		this.dataTabels();
	}

	dataTabels(){
		$('button#delete').on('click', function(){
		    $('#modal-delete input#item_code').val($(this).parent().data('id'));
		});

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
}
export default DataSource;