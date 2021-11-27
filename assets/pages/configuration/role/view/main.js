import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	// info
	$('button#info').on('click', function(){
		datasource.get_info($(this).parent().data('id'));
	})
};
export default main;