import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	// update
	$('button#update').on('click', function(){
		datasource.getuser($(this).parent().data('id'));
	});
	// delete
	$('button#delete').on('click', function(){
		$('#modal-delete input#user_id').val($(this).parent().data('id'));
	});

	datasource.dataTabels()

	// label changed import file
	$('input#file').change(function() {
		$('.custom-file-label').text(this.files[0]['name']);
	});
};
export default main;