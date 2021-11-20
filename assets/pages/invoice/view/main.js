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
	
	datasource.user_info(function(output){
		let fullname = [];
		$(output).each(function(index, field){
			fullname.push(field.user_fullname);
		})
		$('input#fullname').autocomplete({
			source: fullname
		});
		$('input#fullname').on('focusout', function(){
			datasource.user_info_search($(this).val(), function(data){
				$('input#user_id').val(data.user_id);
				$('input#contact_number').val(data.user_contact_phone);
				$('textarea#address').val(data.user_address);
			});
			
		})
	});
	datasource.items(function(output){
		let items = [];
		$(output).each(function(index, field){
			items.push(field.item_name);
		})
		$('input#item_name').autocomplete({
			source: items
		});
		
	})
	$('button#add_order_item').on('click', function(){

		// $(this).parents().closest('div#order_item.card-body').append('<order-item></order-item>');
		// datasource.items_search($(this).parents().closest('div.row#order_item').find('input#item_name').val(), function(data){
		// 	$('order-item input#item_code').val(data.item_code);
		// 	$('order-item input#item_name').val(data.item_name);
		// });
		//
		let sub_total = 0;
		datasource.items_search($(this).parents().closest('div.row#order_item').find('input#item_name').val(), function(output){
			datasource.field(output);
		});
	});
	$('div.card#order_item').on('focusout', function(){
		$('#order-item input#item_name').attr('name','item_name[]').each(function(index, field){
		    datasource.items_search(field.value, function(item){
		    	$('input#sub_total').val(parseInt(item.selling_price)*
		    		parseInt($(field).parents().closest('div#order-item.row').find('input#quantity').val()))
		    })
		})
	})
	// format curency

	// price formater
	// $('input#capital_price, input#selling_price').focusout(function(){
	// 	$(this).val(new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 3 }).format(
	// 	  $(this).val().replace('.','')
	// 	));
	// })
};
export default main;