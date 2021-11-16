class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){

    	let self = this;
		$('#tbl_invoice*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'><'col-6 col-lg col-xl'<'float-right'f>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': false

		});
		
	}
	customer(handle){
		$.ajax({
			url: this.BASEURL+'customer',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET'},
			success: function(result){
				handle(result);
			}	
		})
	}
	customer_search(request, handle){
		$.ajax({
			url: this.BASEURL+'customer',
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
			url: this.BASEURL+'items',
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

          <div class="col-12">
            <div class="form-group">
              <input type="text" name="item_code[]" id="item_code" class="form-control" value="${result.item_code}" readonly>
            </div>
          </div>

          <div class="col-5">
            <div class="form-group">
              <input type="text" name="item_name[]" id="item_name" class="form-control" value="${result.item_name}" readonly>
            </div>
          </div>

          <div class="col-5">
            <!-- text input -->
            <div class="form-group">
              <div class="input-group mb-3">
                <input type="number" class="form-control" name="quantity[]" id="quantity"  value="" required>
                <div class="input-group-append">
                  
                  <select class="input-group-text" name="unit[]" id="unit" required readonly disabled>
                    <option value="${result.unit}">${(result.unit).toUpperCase()}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="col-2">
            <button type="button" class="btn btn-block btn-danger" id="remove_order_item"><i class="fa fa-tw fa-times"></i></button>
          </div>

        </div>
		<!-- order-item -->
		`;
		$('div#order_item.card-body').append(html);
		$('button#remove_order_item').on('click', function(){
			$(this).parents().closest('div.row#order-item').empty();
		});
	}
	items_search(request, handle = false){
		$.ajax({
			url: this.BASEURL+'items',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': request},
			success: function(result){
				handle(result);
			}	
		})	
	}
}
export default DataSource;