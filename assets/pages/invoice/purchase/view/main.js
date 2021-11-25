import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.dataTabels();
	$('.select2').select2();

	// update
	$('button#update').on('click', function(){
		datasource.search_order($(this).parent().data('id'));
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
		let sub_total = 0;
		datasource.items_search($(this).parents().closest('div.row#order_item').find('input#item_name').val(), function(output){
			datasource.field(output);
		});
	});
	$('input#sub_total').on('focus', function(){ /* sub-total total */
		let sub_total = 0;
		$('#order-item input#item_capital_price').attr('name','item_capital_price[]').each(function(index, field){
			sub_total += (parseInt(currencyToNum(field.value))*
			parseInt($(field).parents().closest('div#order-item.row').find('input#quantity').val())-
			parseInt($(field).parents().closest('div#order-item.row').find('input#rebate_price').val().replace(/[,]|[.]/g,'')) /*rebate_price*/);

		})
		$(this).val(currency(sub_total));
	});
	$('input#shipping_cost, input#other_cost').on('focusout', function(){ /* shipping and otehr cost format */
		$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 3 }).format(
	      $(this).val().replace(/[,]|[.]/g,'')
	    ));
	})
	$('input#grand_total').on('focus', function(){ /* grand total */
		$(this).val(
			new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 3 }).format(
				$('input#sub_total').val().replace(/[,]|[.]/g,'')-	/*sub total*/
				(parseInt($('input#discount').val())*parseInt($('input#sub_total').val().replace(/[,]|[.]/g,''))/100)+ /*discount*/
				parseInt($('input#shipping_cost').val().replace(/[,]|[.]/g,''))+ /*shiping cost*/
				parseInt($('input#other_cost').val().replace(/[,]|[.]/g,'')) /*another cost*/
			)
		);
	});
};
export default main;