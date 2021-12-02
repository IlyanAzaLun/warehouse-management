class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){
		$('#tbl_menu*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'float-left'f>><'col-6 col-lg col-xl'>>
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