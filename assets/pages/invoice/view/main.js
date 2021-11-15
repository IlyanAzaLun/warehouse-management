import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.dataTabels();
	$('.select2').select2();

	// update
	$('button#update').on('click', function(){
		console.log($(this).parent().data('id'))
	});
	// delete
	$('button#delete').on('click', function(){
		$('#modal-delete input#invoice_id').val($(this).parent().data('id'));
	});
	
	datasource.customer(function(output){
		let fullname = [];
		$(output).each(function(index, field){
			fullname.push(field.customer_fullname);
		})
		$('input#fullname').autocomplete({
			source: fullname
		});
		$('input#fullname').on('focusout', function(){
			datasource.customer_search($(this).val(), function(data){
				$('input#customer_id').val(data.customer_id);
				$('input#contact_number').val(data.customer_contact_phone);
				$('textarea#address').val(data.customer_address);
			});
			
		})
	});
	$('button#add_order_item').on('click', function(){
		$(this).parents().closest('div#order_item.card-body').append('<order-item></order-item>');
	})
};
export default main;