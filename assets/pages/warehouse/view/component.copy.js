class Component {

	
	field(result){
		const html = `
		<!-- order-item -->
        <div class="row" id="order-item">

          <div class="col-3">
            <div class="form-group">
              <small>Kode barang</small>
              <input type="text" name="item_code[]" id="item_code" class="form-control" value="${result.item_code}" readonly>
            </div>
          </div>

          <div class="col-5">
            <div class="form-group">
            	<small>Nama barang</small>
              <input type="text" name="item_name[]" id="item_name" class="form-control" value="${result.item_name} ${(result.MG)?`(MG: ${result.MG})`:''}" readonly>
            </div>
          </div>
		
		  <div class="col-3">
			<!-- text input -->
			<div class="form-group">
				<small>Jumlah barang</small>
				<div class="input-group mb-3">
					<input type="hidden" name="item_capital_price[]" id="item_capital_price" class="form-control" value="${result.capital_price}" placeholder="${result.capital_price}" required>
					<input type="hidden" name="item_selling_price[]" id="item_selling_price" class="form-control" value="${result.selling_price}" placeholder="${result.selling_price}" required>
					<input type="hidden" class="form-control" name="current[]" id="current" min="1" value="${parseInt(result.quantity)}" required>
					<input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="0" required>
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
		<!-- order-item -->
		`;$('div#order_item.card-body').append(html);
		// quantity value 
		$('input#quantity').focusout(function () {
			//lop each value of quantity and sum it.
			//compare with current quantity
			let _total = [];
			let unique_values = {};
			let list_of_values = [];
			$('input#item_code').each(function(item, field){
				_total[item] = 0;
		    if(!unique_values[field.value]){
		        //
		        unique_values[field.value] = true;
		        list_of_values.push(field.value);
		    }
		    else{
		        //
				$(`input#item_code[value="${field.value}"]`).each(function(index, res){
					_total[item] += parseInt($(this).parents().closest('div#order-item.row').find('input#quantity').val());
				});
			    if($(`input#item_code[value="${field.value}"]`).parents().closest('div#order-item.row').find('input#current').val() < _total[item]){
			    	$(`input#item_code[value="${field.value}"]`).parents().closest('div#order-item.row').find('input#quantity').addClass('is-invalid');
			    	Swal.fire({
						  icon: 'warning',
						  title: 'Oops...',
						  text: 'Jumlah item melampaui stok yang ada!',
						}).then(()=>{
							$('div#save button[type="submit"]').prop('disabled', true);
						});
			    }else{
			    	$(`input#item_code[value="${field.value}"]`).parents().closest('div#order-item.row').find('input#quantity').removeClass('is-invalid');
			    	$('div#save button[type="submit"]').prop('disabled', false);
			    }
		    }
			})
		})
		// 
		$('button#remove_order_item').on('click', function(){
			$(this).parents().closest('div.row#order-item').empty();
		});

		$('input#item_selling_price, input#item_capital_price').keyup(function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format($(this).val().replace(/[,]|[.]/g,'')))
		});

		$('input#item_selling_price').focusout(function(){
			if (parseInt($(this).val().replace(/[,]|[.]/g,'')) < parseInt($(this).parents().closest('div#order-item.row').find('input#item_capital_price').val().replace(/[,]|[.]/g,''))) {
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops...',
				  text: 'Harga jual lebih kecil dari pada harga pokok!',
				}).then(()=>{
					$(this).addClass('is-invalid');
				});
			}else{
				$(this).removeClass('is-invalid');
			}
		});
		$('input#quantity').focusout(function(){
			if (parseInt($(this).val()) > parseInt($(this).parents().closest('div#order-item.row').find('input#current').val())) {
				Swal.fire({
				  icon: 'warning',
				  title: 'Oops...',
				  text: 'Jumlah item melampaui stok yang ada!',
				}).then(()=>{
					$(this).addClass('is-invalid');
					$('div#save button[type="submit"]').prop('disabled', true);
				});
			}else{
				$(this).removeClass('is-invalid');
				$('div#save button[type="submit"]').prop('disabled', false);
			}
		})

		$('input#item_total_price').on('focus', function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format(parseInt($(this).parents().closest('#order-item').find('input#item_selling_price').val().replace(/[,]|[.]/g,''))*parseInt($(this).parents().closest('#order-item').find('input#quantity').val())))
		});

		$('input#rebate_price').keyup(function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format($(this).val().replace(/[,]|[.]/g,'')))
		});
	}
}
export default Component;