const main = () => {
	$('table#tbl_history_return').dataTable({
		'dom': `<'row'<'col-6 col-lg col-xl'<'float-left'f>><'col-6 col-lg col-xl'<'float-right'l>>>
				<'row'<'col-12'tr>>
				<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
		'responsive': true,
		'autoWidth': false,
		'ordering': true,
		'lengthChange': [[ 25, 50, 100, -1], [ 25, 50, 100, "All"]],
		'pageLength': 25
	});
};
export default main;