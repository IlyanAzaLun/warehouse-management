import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	// datasource.get_roles(function(callback){datasource.jsGrid('#tbl_users', callback)});

	// options //
	// delete
	$('button#delete').on('click', function(){
		$('#modal-delete input#user_id').val($(this).parent().data('id'));
	});
	// update
	$('button#update').on('click', function(){
		datasource.search_user($(this).parent().data('id'));
	});
	
	datasource.dataTabels()
};
export default main;