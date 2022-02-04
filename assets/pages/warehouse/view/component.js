class Component {

	validation_form(callBack) {
			// $('input#quantity').on('change',function () {
			let _total = [];
			let unique_values = {};
			let list_of_values = [];
			let button = $('div#save button[type="submit"]');
			let element_quantity_code;
			$('input#item_code').each(function(item, field){
				_total[item] = 0;
				let element_parent = $(`input#item_code[value="${field.value}"]`);
				element_quantity_code = element_parent.parents('div#order-item.row');
				if(!unique_values[field.value]){
					unique_values[field.value] = true;
					list_of_values.push(field.value);
				}
				element_parent.each(function(index, res){
					_total[item] += parseInt( $(this).parents('div#order-item.row').find('input#quantity').val());
				});
				validation(_total[item], field.value);
			});

			function validation(data, item_code) {
				let selected_element = element_quantity_code.find(`input#item_code[value="${item_code}"]`).parents('div#order-item.row').find('input#quantity');
				if(element_quantity_code.find('input#current').val() < data){
					callBack(false)
					Swal.fire({
						icon: 'warning',
						title: 'Oops...',	
						text: 'Jumlah item melampaui stok yang ada!',
						}).then(()=>{
							selected_element.addClass('is-invalid');
							button.prop('disabled', true);
						});
						return false;
				}else{
					selected_element.removeClass('is-invalid');
					button.prop('disabled', false);
					return callBack(true);
				}
			}
				
			$('input#quantity').on('change',function () {
					$(this).removeClass('is-invalid');
					button.prop('disabled', false);
			})
	}

	field(result){
		const html = `
        <div class="row" id="order-item">
          <div class="col-3">
            <div class="form-group" id="field-item_code">
              <small>Kode barang</small>
              <input type="text" name="item_code[]" id="item_code" class="form-control" value="${result.item_code}" readonly>
            </div>
          </div>
          <div class="col-5">
            <div class="form-group">
            	<small>Nama barang</small>
              <input type="text" name="item_name[]" id="item-name" class="form-control" value="${result.item_name} ${(result.MG)?`(MG: ${result.MG})`:''}">
            </div>
          </div>
		  	<div class="col-3">
					<div class="form-group">
					<div class="row">
						<div class="col-5">
							<small>Jumlah stok barang</small>
				  	</div>
						<div class="col-7">
					  	<small>Jumlah yang dipesan</small>
						</div>
					</div>
					<div class="input-group mb-3" id="field-item_attribute">
						<input type="hidden" name="item_capital_price[]" id="item_capital_price" class="form-control" value="${result.capital_price}" placeholder="${result.capital_price}" required>
						<input type="hidden" name="item_selling_price[]" id="item_selling_price" class="form-control" value="${result.selling_price}" placeholder="${result.selling_price}" required>
						<input type="number" readonly class="form-control" name="current[]" id="current" value="${parseInt(result.quantity)}" required>
						<input type="number" class="form-control" name="quantity[]" id="quantity" value="0" min="1" max="${parseInt(result.quantity)}" required>
						<input type="hidden" class="form-control" name="unit[]" id="unit"  value="${result.unit}" required>
						<input type="hidden" name="item_total_price[]" id="item_total_price" class="form-control" value="" placeholder="" readonly required>
						<input type="hidden" name="rebate_price[]" id="rebate_price" class="form-control" value="0" placeholder="" required>
      	    <div class="input-group-append">
              <span class="input-group-text">${result.unit.toUpperCase()}</span>
            </div>
          </div>
        </div>
      </div>
	      <div class="col-1">
          <small>&nbsp;</small>
        	<button type="button" class="btn btn-block btn-danger" id="remove_order_item"><i class="fa fa-tw fa-times"></i></button>
        </div>
      </div>
		`;$('div#order_item.card-body').append(html);
		$('button#remove_order_item').on('click', function(){
			$(this).parents().closest('div.row#order-item').empty();
		});
		$("input#item-name").autocomplete({
			minLength: 0,
			source: function(request, response) {
				$.ajax({
					url: location.base + "warehouse/item",
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
				$(this).val(`${ui.item.item_name} ${(ui.item.MG)?`(MG: ${ui.item.MG})`:''}`);
				$(this).parents('div#order-item.row').find('#item_code').remove();
				$(this).parents('div#order-item.row').find('#field-item_code').append(`
	        <input type="text" name="item_code[]" id="item_code" class="form-control" value="${ui.item.item_code}" readonly>
				`);

				$(this).parents('div#order-item.row').find('#quantity').remove();
				$(this).parents('div#order-item.row').find('#field-item_attribute').prepend(`
				  <input type="number"  class="form-control" name="quantity[]" id="quantity" value="0" min="1" max="${parseInt(ui.item.quantity)}" required>
				`);

				// $(this).parents('div#order-item.row').find('#item_code').val(ui.item.item_code);
				$(this).parents('div#order-item.row').find('#current').remove();
				$(this).parents('div#order-item.row').find('#field-item_attribute').prepend(`
				  <input type="number" readonly class="form-control" name="current[]" id="current" value="${parseInt(ui.item.quantity)}" required>
				`);

				// $(this).parents('div#order-item.row').find('#current').val(ui.item.quantity);
				$(this).parents('div#order-item.row').find('#unit').val(ui.item.unit);
				$(this).parents('div#order-item.row').find('.input-group-text').text(ui.item.unit.toUpperCase());
				return false;
			},
			focus: function( event, ui ) {
				$(this).val(`${ui.item.item_name} ${(ui.item.MG)?`(MG: ${ui.item.MG})`:''}`);
				return false;
			}
		})

	}
}

export default Component;