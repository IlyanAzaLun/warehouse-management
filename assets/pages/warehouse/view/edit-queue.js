import DataCustomer from "../data/data-customer.js";
import DataItem from "../data/data-item.js";
import DataOrder from "../data/data-order.js";
import DataInvoice from "../data/data-invoice.js";
import Component from "./component-edit.js";
const data_customer = new DataCustomer();
const data_item = new DataItem();
const data_order = new DataOrder();
const data_invoice = new DataInvoice();
const component = new Component();

const main = () => {
	$(document).on('wheel', 'input[type=number]', function(e){$(this).blur()});

	$('input#item_name').focus(function () {
		data_item.items(false, function (output) {
			$.ui.autocomplete.prototype._renderItem = function (ul, item) {
				return $('<li>').data("item.autocomplete", item).append(`
					<div class="row">
				      <div class="col-3">${item.item_code}</div>
				      <div class="col-7"><b>${item.item_name}</b> ${(item.MG) ? `[MG: ${item.MG}, ML: ${item.ML}, VG: ${item.VG}, PG: ${item.PG}, (Falvour: ${item.falvour})]` : ``}</div>
				      <div class="col-2">${item.quantity} (${item.unit})</div>
				    </div>`).appendTo(ul);
			};
			$("input#item_name").autocomplete({
				minLength: 0,
				source: function (request, response) {
					$.ajax({
						url: location.base + "warehouse/item",
						method: "POST",
						dataType: "json",
						data: {
							'request': 'GET', '_data': request.term
						},
						success: function (data) {
							response(data);
						}
					});
				},
				select: function (event, ui) {
					$(this).val(ui.item.item_name); // display the selected text
					$('input#item_id').val(ui.item.item_code); // display the selected text
					return false;
				},
				focus: function (event, ui) {
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
	$("button#remove_order_item").on('click', function(){
		$('input#index-order').val($(this).data('id'));
		$('input#order-id').val($('input#order_id').val());
	})
	$('button#add_order_item').on('click', function () {
		if ($('input#item_name').val() == "") {
			$('input#item_name').focus();
			Toast.fire({
				icon: 'warning',
				title: 'Cari terlebih dahulu barang yang akan di beli !',
			})
		}else{
			data_item.items($(this).parents().closest('div.row#order_item').find('input#item_id').val(), function (output) {
				component.field(output);
			});
		}
	});

};
export default main;