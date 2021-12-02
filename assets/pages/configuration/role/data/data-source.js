class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
		this.dataTabels()
	}
	dataTabels(){
		$('#tbl_roles*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'float-right'f>><'col-6 col-lg col-xl'<'float-right'l>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': true

		});
	}
	get_info(data){
		$.ajax({
			url: this.BASEURL+'data',
			method: 'POST',
			typeData: 'HTML',
			data: {'request': 'GET', 'data': data},
			success: function(result){
				$('div.card-body#info').empty();
				$('div.card-body#info').append(result)
			}
		})
	}
}
export default DataSource;