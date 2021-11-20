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

 	// price formater
	$('input#capital_price, input#selling_price').focusout(function(){
		$(this).val(new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(
		  $(this).val().replace('.','')
		));
	})
};
export default main;