import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.dataTabels();
	$('.select2').select2();

	// category code //

	// add-stock
	$('button#add-stock').on('click', function(){
		datasource.getitem($(this).parent().data('id'));
	});
	// detail
	$('button#detail').on('click', function(){
		datasource.gethistory($(this).parent().data('id'));
	});
};
export default main;