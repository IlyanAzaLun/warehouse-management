import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.dataTabels();

	// label changed import file
	$('input#file').change(function() {
		$('.custom-file-label').text(this.files[0]['name']);
	});
};
export default main;