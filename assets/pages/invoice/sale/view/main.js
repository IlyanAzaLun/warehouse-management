import DataSource from "../data/data-source.js";
import Modals from "./modals.js";
const datasource = new DataSource();
const modals = new Modals();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.dataTabels();
	$('.select2').select2();

	// detail
	$('button#detail').on('click', function(){
		datasource.search_order($(this).parent().data('id'));
	});
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
	$('input#fullname').focus(function(){
		datasource.user_info(function(output){
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
				datasource.user_info_search($(this).val(), function(data){
					$('input#user_id').val(data.user_id);
					$('input#contact_number').val(data.user_contact_phone);
					$('textarea#address').val(data.user_address);
				});
				
			})
		});
	})
	$('input#fullname').focus();
	/* auto complete */
	$('input#item_name').focus(function(){
		datasource.items(false ,function(output){
			/* 
			let _items = [];
			$(output).each(function(_index, field){
				_items.push(field.item_name);
			})
			$('input#item_name').autocomplete({
				source: _items
			}); 
			*/
			/*auto complete*/
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
						url: location.href + "/items/get-data",
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
	})
	
	$('button#add_order_item').on('click', function(){
		let sub_total = 0;
		if($(this).parents().closest('div.row#order_item').find('input#item_name').val()==''){
			$('input#item_name').focus();
			Toast.fire({
				icon: 'warning',
				title: 'Cari terlebih dahulu barang yang akan di beli !',
			})
		}
		datasource.items($(this).parents().closest('div.row#order_item').find('input#item_id').val(), function(output){
			datasource.field(output);
		});
	});
	
	$('button#detail_order_item').on('click', function(){
		let sub_total = 0;
		if(
			$(this).parents().closest('div.row#order_item').find('input#item_id').val()=='' &
			$('input#user_id').val() == ''
		){
			$('input#item_name').focus();
			Toast.fire({
				icon: 'warning',
				title: 'isi nama pelanggan dan cari terlebih dahulu barang yang akan di beli !',
			})
		}else{
			$('#modal-history').modal('show');
				datasource.history($('input#user_id').val(),
				$(this).parents().closest('div.row#order_item').find('input#item_id').val(),
				function(output){
					modals.history(output);
				})	
		}
	});
	$('input#sub_total').on('focus', function(){ /* sub-total total */
		let sub_total = 0;
		$('#order-item input#item_selling_price').attr('name','item_selling_price[]').each(function(index, field){
			sub_total += (parseInt(currencyToNum(field.value))*
				parseInt($(field).parents().closest('div#order-item.row').find('input#quantity').val())-
				parseInt($(field).parents().closest('div#order-item.row').find('input#rebate_price').val().replace(/[,]|[.]/g,'')) /*rebate_price*/);

		})
		$(this).val(currency(sub_total));
	});
	$('input#shipping_cost, input#other_cost').on('keyup', function(){ /* shipping and otehr cost format */
		$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format(
			$(this).val().replace(/[,]|[.]/g,'')
			));
	})
	$('input#grand_total').on('keyup', function(){ /* grand total */
		$(this).val(
			new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format(
				$('input#sub_total').val().replace(/[,]|[.]/g,'')-	/*sub total*/
				(parseInt($('input#discount').val())*parseInt($('input#sub_total').val().replace(/[,]|[.]/g,''))/100)+ /*discount*/
				parseInt($('input#shipping_cost').val().replace(/[,]|[.]/g,''))+ /*shiping cost*/
				parseInt($('input#other_cost').val().replace(/[,]|[.]/g,'')) /*another cost*/
				)
			);
	});
};
export default main;