import DataCustomer from "../data/data-customer.js";
import DataItem from "../data/data-item.js";
import DataOrder from "../data/data-order.js";
import Component from "./component.js";
const data_customer = new DataCustomer();
const data_item = new DataItem();
const component = new Component();

const main = () => {
	// cancel
	$('button#cancel').on('click', function(){
		$('#modal-cancel input#invoice_id').val($(this).parent().data('id-invoice'));
		$('#modal-cancel input#invoice_status').val((parseInt($(this).data('status')))?'0':'1');
	});
	// detail status
	$('button#status-item').on('click', function(){
		$('#modal-status-item b.text-danger').html($(this).data('variabel'));
		$('#modal-status-item input#invoice_id').val($(this).parent().data('id'));
		$('#modal-status-item input#invoice_status').val($(this).data('variabel'));
	})
    // customer
    // auto complete, get all, and find the customer
    // end customer    
    // item
    // auto complete, iten get all, and 
    $('input#item_name').focus(function(){
		data_item.items(false ,function(output){
			$.ui.autocomplete.prototype._renderItem = function(ul, item) {
				return $('<li>').data("item.autocomplete", item).append(`
					<div class="row">
				      <div class="col-2">${item.item_code}</div>
				      <div class="col-7"><b>${item.item_name}</b> ${(item.MG)?`[MG: ${item.MG}, ML: ${item.ML}, VG: ${item.VG}, PG: ${item.PG}, (Falvour: ${item.falvour})]`:``}</div>
				      <div class="col-1">${item.quantity} (${item.unit})</div>
				      <div class="col-1">${item.capital_price}</div>
				      <div class="col-1">${item.selling_price}</div>
				    </div>`).appendTo(ul);
			};
			$("input#item_name").autocomplete({
				minLength: 0,
				source: function(request, response) {
					$.ajax({
						url: location.origin+location.pathname + "/warehouse/item",
						method: "POST",
						dataType: "json",
						data: {
							'request': 'GET', '_data': request.term
						},
						success: function(data) {
							response(data);
						}
					});
				},
				select: function(event, ui){
					$(this).val(ui.item.item_name); // display the selected text
					$('input#item_id').val(ui.item.item_code); // display the selected text
					return false;
				},
				focus: function( event, ui ) {
					$(this).val(ui.item.item_name); // display the selected text
					$('input#item_id').val(ui.item.item_code); // display the selected text
					return false;
				}
				//you can write for select too
				/*select:*/
			})
			/*auto complete*/
		})
	});
	$('button#add_order_item').on('click', function(){
		let sub_total = 0;
		if($(this).parents().closest('div.row#order_item').find('input#item_name').val()==''){
			$('input#item_name').focus();
			Toast.fire({
				icon: 'warning',
				title: 'Cari terlebih dahulu barang yang akan di beli !',
			})
		}
		data_item.items($(this).parents().closest('div.row#order_item').find('input#item_id').val(), function(output){
			component.field(output);
		});
	});
    // end item

};
export default main;