class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){

  	let self = this;
		$('#tbl_invoice*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'float-left'f>><'col-6 col-lg col-xl'>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': false

		});
		
	}
	user_info(handle){
		$.ajax({
			url: this.BASEURL+'user-info',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET'},
			success: function(result){
				handle(result);
			}	
		})
	}
	user_info_search(request, handle){
		$.ajax({
			url: this.BASEURL+'user-info',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': request},
			success: function(result){
				handle(result);
			}	
		})	
	}
	items(handle){
		$.ajax({
			url: this.BASEURL+'items/get-data',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET'},
			success: function(result){
				handle(result);
			}	
		})
	}
	field(result){
		const html = `
		<!-- order-item -->
        <div class="row" id="order-item">

          <div class="col mb-2">
            <button type="button" class="btn btn-block btn-danger" id="remove_order_item"><i class="fa fa-tw fa-times"></i></button>
          </div>

          <div class="col-12">
            <div class="form-group">
              <input type="text" name="item_code[]" id="item_code" class="form-control" value="${result.item_code}" readonly>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <input type="text" name="item_name[]" id="item_name" class="form-control" value="${result.item_name}" readonly>
            </div>
          </div>

          <div class="col-3">
            <div class="form-group">
              <input type="text" name="item_capital_price[]" id="item_capital_price" class="form-control" value="${result.capital_price}" placeholder="${result.capital_price}" required>
            </div>
          </div>

          <div class="col-3">
            <div class="form-group">
              <input type="text" name="item_price[]" id="item_price" class="form-control" value="${result.selling_price}" placeholder="${result.selling_price}" required>
            </div>
          </div>

          <div class="col-3">
            <!-- text input -->
            <div class="form-group">
              <div class="input-group mb-3">
                <input type="number" class="form-control" name="quantity[]" id="quantity"  value="1" required>
                <input type="hidden" class="form-control" name="unit[]" id="unit"  value="${result.unit}" required>
                <div class="input-group-append">
                  <span class="input-group-text">${(result.unit).toUpperCase()}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-3">
            <div class="form-group">
              <input type="text" name="item_total_price[]" id="item_total_price" class="form-control" value="" placeholder="" required>
            </div>
          </div>

        </div>
		<!-- order-item -->
		`;
		$('div#order_item.card-body').append(html);
		$('button#remove_order_item').on('click', function(){
			$(this).parents().closest('div.row#order-item').empty();
		});

		$('input#item_price, input#item_capital_price').on('focusout', function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 3 }).format($(this).val().replace(/[,]|[.]/g,'')))
		});

		$('input#item_total_price').on('focus', function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 3 }).format(parseInt($(this).parents().closest('#order-item').find('input#item_capital_price').val().replace(/[,]|[.]/g,''))*parseInt($(this).parents().closest('#order-item').find('input#quantity').val())))
		});
	}
	items_search(request, handle = false){
		$.ajax({
			url: this.BASEURL+'items/get-data',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': request},
			success: function(result){
				handle(result);
			}	
		})	
	}
	search_order(id){
		$.ajax({
			url: this.BASEURL+'REST/order?id='+id,
			method: 'GET',
			dataType: 'JSON',
			success: function(result){
				console.log(result)
			}
		})
	}
}
export default DataSource;