// order-item.js
class OrderItem extends HTMLElement{
	constructor(){
	    super();
	    this.render();
	}

	render(){
		this.innerHTML = 
		`
		<!-- order-item -->
        <div class="row" id="order-item">

          <div class="col-5">
            <div class="form-group">
              <input type="text" name="fullname" id="fullname" class="form-control" value="">
            </div>
          </div>

          <div class="col-5">
            <!-- text input -->
            <div class="form-group">
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="quantity" id="quantity"  value="">
                <div class="input-group-append">
                  <select class="input-group-text" name="unit" id="unit" required>
                    <option value="pcs">PCS</option>
                    <option value="pac">PAC</option>
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
		$(this).find('button#remove_order_item').on('click', function(){$(this).parents().closest('div.row#order-item').empty()});
		
	}
}

customElements.define("order-item", OrderItem);