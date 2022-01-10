class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){

    	let self = this;
		$('#tbl_items*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'row'<'col-6float-left'f><'col-6 float-left'B>>><'col-6 col-lg col-xl'<'float-right'l>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': true,
			'buttons': [
				{
					text: 'Export',	
					extend: 'excelHtml5',
		            customize: function ( xlsx ){
		                var sheet = xlsx.xl.worksheets['sheet1.xml'];
		            }
	        	},
				{
					text: 'Import',
					className: 'bg-primary',
					action: function ( e, dt, node, config ) {
						$('#modal-import').modal('show');
					}
				},
			]
		});
		
	}
}
export default DataSource;