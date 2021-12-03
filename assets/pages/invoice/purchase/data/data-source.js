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
	items(request = false, handle){
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
	field(result){
		const html = `
		<!-- order-item -->
        <div class="row" id="order-item">

          <div class="col-1">
            <div class="form-group">
              <small>Kode barang</small>
              <input type="text" name="item_code[]" id="item_code" class="form-control" value="${result.item_code}" readonly>
            </div>
          </div>

          <div class="col-3">
            <div class="form-group">
            	<small>Nama barang</small>
              <input type="text" name="item_name[]" id="item_name" class="form-control" value="${result.item_name}" readonly>
            </div>
          </div>

          <div class="col-1">
            <div class="form-group">
            	<small>Harga pokok</small>
              <input type="text" name="item_capital_price[]" id="item_capital_price" class="form-control" value="${result.capital_price}" placeholder="${result.capital_price}" required>
            </div>
          </div>

          <div class="col-1">
            <div class="form-group">
            	<small>Harga harga jual</small>
              <input type="text" name="item_selling_price[]" id="item_selling_price" class="form-control" value="${result.selling_price}" placeholder="${result.selling_price}" required>
            </div>
          </div>

          <div class="col-2">
            <!-- text input -->
            <div class="form-group">
            	<small>Jumlah barang</small>
              <div class="input-group mb-3">
                <input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="0" required>
                <input type="hidden" class="form-control" name="unit[]" id="unit"  value="${result.unit}" required>
                <div class="input-group-append">
                  <span class="input-group-text">${result.unit.toUpperCase()}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-2">
            <div class="form-group">
            	<small>Harga total</small>
              <input type="text" name="item_total_price[]" id="item_total_price" class="form-control" value="" placeholder="" readonly required>
            </div>
          </div>

          <div class="col-1">
            <div class="form-group">
            	<small>Potongan harga</small>
              <input type="text" name="rebate_price[]" id="rebate_price" class="form-control" value="0" placeholder="" required>
            </div>
          </div>

          <div class="col-1">
            	<small>&nbsp;</small>
          	<button type="button" class="btn btn-block btn-danger" id="remove_order_item"><i class="fa fa-tw fa-times"></i></button>
          </div>

        </div>
		<!-- order-item -->
		`;
		$('div#order_item.card-body').append(html);
		$('button#remove_order_item').on('click', function(){
			$(this).parents().closest('div.row#order-item').empty();
		});

		$('input#item_selling_price, input#item_capital_price').keyup(function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format($(this).val().replace(/[,]|[.]/g,'')))
		});

		$('input#item_selling_price').focusout(function(){
			console.log()
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

		$('input#item_total_price').on('focus', function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format(parseInt($(this).parents().closest('#order-item').find('input#item_capital_price').val().replace(/[,]|[.]/g,''))*parseInt($(this).parents().closest('#order-item').find('input#quantity').val())))
		});

		$('input#rebate_price').keyup(function(){
			$(this).val(new Intl.NumberFormat('en-EN', { maximumSignificantDigits: 9 }).format($(this).val().replace(/[,]|[.]/g,'')))
		});
	}
	search_order(id){
		$.ajax({
			url: this.BASEURL+'API/order?id='+id,
			method: 'GET',
			dataType: 'JSON',
			success: function(result){
				$('#modal-update tbody#tbl_order').empty();
				$('label[for="code_order"]').text(`Kode order: ${result[0].order_id}`)
				let grand_total = 0;
				$.each(result, function(index, field){
				let html = `
				<tr>
					<td>${field.item_id}</td>
					<td>${field.item_name}</td>
					<td class="text-right">${field.capital_price}</td>
					<td class="text-right">${field.selling_price}</td>
					<td class="text-right">${field.quantity} (${field.unit})</td>
					<td class="text-right">${field.rabate}</td>
					<td class="text-right">${currency((parseInt(field.capital_price.replace(/[,]|[.]/g,''))*parseInt(field.quantity))-parseInt(field.rabate.replace(/[,]|[.]/g,'')))}</td>
				</tr>
				`;
				grand_total += (parseInt(field.capital_price.replace(/[,]|[.]/g,''))*parseInt(field.quantity))-parseInt(field.rabate.replace(/[,]|[.]/g,''))
				$('#modal-update tbody#tbl_order').append(html);
				});
				$('#modal-update tbody#tbl_order').append(`
				<tr>
					<td colspan="7" class="text-right"><b>Total: ${currency(grand_total)}</b></td>
				</tr>
				`);

			}
		})
	}
}
export default DataSource;