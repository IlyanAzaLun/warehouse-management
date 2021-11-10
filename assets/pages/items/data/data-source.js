class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){
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
}
export default DataSource;