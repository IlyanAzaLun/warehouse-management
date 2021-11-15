class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){

    	let self = this;
		$('#tbl_invoice*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'><'col-6 col-lg col-xl'<'float-right'f>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': false

		});
		
	}
	customer(handle){
		$.ajax({
			url: this.BASEURL+'customer',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET'},
			success: function(result){
				handle(result);
			}	
		})
	}
	customer_search(request, handle){
		$.ajax({
			url: this.BASEURL+'customer',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': request},
			success: function(result){
				handle(result);
			}	
		})	
	}
}
export default DataSource;