import DataCustomer from "../data/data-customer.js";
import DataItem from "../data/data-item.js";
import DataOrder from "../data/data-order.js";
import DataInvoice from "../data/data-invoice.js";
import Component from "./component.js";
const data_customer = new DataCustomer();
const data_item = new DataItem();
const data_order = new DataOrder();
const data_invoice = new DataInvoice();
const component = new Component();

const main = () => {
	// notification
	window.setInterval(function () {
		data_invoice.get_status_notification(function(output){
			if(output.length > 0 ){
				$('a.dropdown-item').parent().remove()
				$('span#counter').text(output.length)
				$.playSound('https://demos.9lessons.info/notify/notify.wav');
				output.forEach((element, index) => {
					$('.dropdown-menu.dropdown-menu-lg.dropdown-menu-right').append(
				   `<div data-id="${element.order_id}" data-id_invoice="${element.invoice_id}">
						<a href="#" class="dropdown-item" id="detail-order" data-toggle="modal" data-target="#modal-detail">
							<small><i class="fas fa-file mr-2"></i><span id="id_invoice">${element.invoice_id}</span></small>
							<small><span class="float-right text-muted text-sm" id="user">${element.user}</span></small><br>
						</a>
					</div>`)
				});
				detail_order()
			}else{
				$('span#counter').text('')
				$('a.dropdown-item').remove()
			}
		})
	}, 6000)
	// notification ./ end
    // auto complete, get all, and find the customer
    $('input#fullname').focus(function(){
		data_customer.user_info(function(output){
			let fullname = [];
			$(output).each(function(index, field){
				fullname.push(field.user_fullname);
			})
			$.ui.autocomplete.prototype._renderItem = function(ul, item){
				return $( "<li>" )
				    .attr( "data-value", item.value )
				    .append( item.label )
				    .appendTo( ul );
			};
			$('input#fullname').autocomplete({
				source: fullname
			});
			$('input#fullname').on('focusout', function(){
				data_customer.user_info_search($(this).val(), function(data){
					$('input#user_id').val(data.user_id);
					$('input#contact_number').val((data.user_contact_phone)?`${data.user_contact_phone} (${data.owner_name})`:``);
					$('textarea#address').val((data.user_contact_phone)?`${data.user_address}, ${data.village}, ${data['sub-district']}, ${data['district']}, ${data.province}, ${data.zip}`:``);
				});
				
			})
		});
	})
	$('input#fullname').focus();
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
						url: location.href + "/warehouse/item",
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

	//detail order, return
	function detail_order(){
		let id;
		let id_invoice;
		// order
		$('#detail-order*').on('click', function(){
			console.log($(this).parent().data('id'))
			id = $(this).parent().data('id');
			id_invoice = $(this).parent().data('id_invoice');
			data_order.search_order($(this).parent().data('id'), $(this).parent().data('id_invoice'));
			data_invoice.change_status_notification(id, function(output){
			})
		
		});
		// return
		$('#detail-return*').on('click', function(){
			console.log($(this).parent().data('id'))
			id = $(this).parent().data('id');
			id_invoice = $(this).parent().data('id_invoice');
			data_order.search_return($(this).parent().data('id'), $(this).parent().data('id_invoice'));
		});
	}
	detail_order()
};
export default main;