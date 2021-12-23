class Component{field(a){const b=`
        <div class="row" id="order-item">
          <div class="col-3">
            <div class="form-group">
              <small>Kode barang</small>
              <input type="text" name="item_code[]" id="item_code" class="form-control" value="${a.item_code}" readonly>
            </div>
          </div>
          <div class="col-5">
            <div class="form-group">
            	<small>Nama barang</small>
              <input type="text" name="item_name[]" id="item-name" class="form-control" value="${a.item_name} ${a.MG?`(MG: ${a.MG})`:""}">
            </div>
          </div>
		  <div class="col-3">
			<div class="form-group">
				<small>Jumlah barang</small>
				<div class="input-group mb-3">
					<input type="hidden" name="item_capital_price[]" id="item_capital_price" class="form-control" value="${a.capital_price}" placeholder="${a.capital_price}" required>
					<input type="hidden" name="item_selling_price[]" id="item_selling_price" class="form-control" value="${a.selling_price}" placeholder="${a.selling_price}" required>
					<input type="hidden" class="form-control" name="current[]" id="current" min="1" value="${parseInt(a.quantity)}" required>
					<input type="number" class="form-control" name="quantity[]" id="quantity" min="1" value="0" required>
					<input type="hidden" class="form-control" name="unit[]" id="unit"  value="${a.unit}" required>
					<input type="hidden" name="item_total_price[]" id="item_total_price" class="form-control" value="" placeholder="" readonly required>
					<input type="hidden" name="rebate_price[]" id="rebate_price" class="form-control" value="0" placeholder="" required>
                <div class="input-group-append">
                  <span class="input-group-text">${a.unit.toUpperCase()}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-1">
			<small>&nbsp;</small>
          	<button type="button" class="btn btn-block btn-danger" id="remove_order_item"><i class="fa fa-tw fa-times"></i></button>
          </div>

        </div>
		`;$("div#order_item.card-body").append(b),$("button#remove_order_item").on("click",function(){$(this).parents().closest("div.row#order-item").empty()}),$("input#item-name").autocomplete({minLength:0,source:function(a,b){$.ajax({url:location.href+"/warehouse/item",method:"POST",dataType:"json",data:{request:"GET",_data:a.term},success:function(a){b(a)}})},select:function(a,b){return $(this).val(`${b.item.item_name} ${b.item.MG?`(MG: ${b.item.MG})`:""}`),$(this).parents("div#order-item.row").find("#item_code").val(b.item.item_code),$(this).parents("div#order-item.row").find("#current").val(b.item.quantity),$(this).parents("div#order-item.row").find("#unit").val(b.item.unit),$(this).parents("div#order-item.row").find(".input-group-text").text(b.item.unit.toUpperCase()),!1},focus:function(a,b){return $(this).val(`${b.item.item_name} ${b.item.MG?`(MG: ${b.item.MG})`:""}`),$(this).parents("div#order-item.row").find("#item_code").val(b.item.item_code),$(this).parents("div#order-item.row").find("#current").val(b.item.quantity),$(this).parents("div#order-item.row").find("#unit").val(b.item.unit),$(this).parents("div#order-item.row").find(".input-group-text").text(b.item.unit.toUpperCase()),!1}}),$("input#quantity").focusout(function(){let a=[],b={},c=[],d=$("div#save button[type=\"submit\"]");$("input#item_code").each(function(e,f){if(a[e]=0,!b[f.value])b[f.value]=!0,c.push(f.value),$(`input#item_code[value="${f.value}"]`).each(function(){a[e]+=parseInt($(this).parents("div#order-item.row").find("input#quantity").val())});else{let b=$(`input#item_code[value="${f.value}"]`).parents("div#order-item.row");$(`input#item_code[value="${f.value}"]`).each(function(){a[e]+=parseInt($(this).parents("div#order-item.row").find("input#quantity").val())}),b.find("input#current").val()<a[e]?Swal.fire({icon:"warning",title:"Oops...",text:"Jumlah item melampaui stok yang ada!"}).then(()=>{b.find("input#quantity").addClass("is-invalid"),d.prop("disabled",!0)}):(b.find("input#quantity").removeClass("is-invalid"),d.prop("disabled",!1))}})})}}export default Component;