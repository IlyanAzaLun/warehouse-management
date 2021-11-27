import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.dataTabels();
	$('.select2').select2();

	// category code //
	$('select#category').on('change', function(event){
		if($(this).find(':selected').data('id')=='LIQUID'){
			$('.category').after(`
                      <div class="col-sm-3 subcategory">
                        <div class="form-group">
                          <label>Jumlah sekarang</label>
                          <div class="input-group mb-3">
                            <select class="form-control select2" style="width: 100%;" name="subcategory" id="subcategory" required>
                              <option disabled value="" selected="selected">Select category item</option>
                              <option value="FREEBASE-CREAMY" data-id="LIQUID FREEBASE CREAMY" >LIQUID FREEBASE CREAMY</option>
                              <option value="FREEBASE-FRUITY" data-id="LIQUID FREEBASE FRUITY" >LIQUID FREEBASE FRUITY</option>
                              <option value="SALT-CREAMY" data-id="LIQUID SALT CREAMY" >LIQUID SALT CREAMY</option>
                              <option value="SALT-FRUITY" data-id="LIQUID SALT FRUITY" >LIQUID SALT FRUITY</option>
                              <option value="PODS-CREAMY" data-id="LIQUID PODS CREAMY" >LIQUID PODS CREAMY</option>
                              <option value="PODS-FRUITY" data-id="PODS FRUITY" >LIQUID PODS FRUITY</option>
                            </select>
                            <div class="input-group-append">
                              <select class="input-group-text" name="unit" id="unit" required>
                                <option value="pcs">PCS</option>
                                <option value="pac">PAC</option>
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-3 subcategory">
                        <!-- text input -->
                        <div class="form-group">
                          <label>MG <small>(Nikotin)</small></label>
                          <input type="number" class="form-control" name="MG" id="MG" required>
                        </div>
                      </div>
                      <div class="col-sm-3 subcategory">
                        <!-- text input -->
                        <div class="form-group">
                          <label>ML <small>(Milligram)</small></label>
                          <input type="number" class="form-control" name="ML" id="ML" required>
                        </div>
                      </div>
                      <div class="col-sm-3 subcategory">
                        <!-- text input -->
                        <div class="row">
                        	<div class="col-6">
	                        	<div class="form-group">
		                          <label>VG</label>
		                          <input type="number" class="form-control" name="VG" id="VG" required>
		                        </div>
                        	</div>

                        	<div class="col-6">
	                        	<div class="form-group">
		                          <label>PG</label>
		                          <input type="number" class="form-control" name="PG" id="PG" required>
		                        </div>
                        	</div>

                        </div>
                      </div>
                      <div class="col-sm-3 subcategory">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Flavour <small>(Rasa)</small></label>
                          <input type="text" class="form-control" name="flavour" id="flavour" required>
                        </div>
                      </div>
                      <div class="col-sm-3 subcategory">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Customs <small>(Bea cukai)</small></label>
                          <input type="text" class="form-control" name="customs" id="customs" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy" data-mask>
                        </div>
                      </div>
                      <div class="col-sm-3 subcategory">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Brand 1</label>
                          <input type="text" class="form-control" name="brand_1" id="brand_1" required>
                        </div>
                      </div>
                      <div class="col-sm-3 subcategory">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Brand 2</label>
                          <input type="text" class="form-control" name="brand_2" id="brand_2">
                        </div>
                      </div>
				`);
      $('#customs').inputmask('yyyy', { 'placeholder': 'yyyy' })
		}else{
			$('.subcategory').remove();
		}

		// category code //		
		$('input#item_name', 'form#insert').on('focus', function(){
			datasource.getcode(($('div.subcategory').find(':selected').data('id'))?$('div.subcategory').find(':selected').data('id'):$('div.category').find(':selected').val());
		})
	});

	// update
	$('button#update').on('click', function(){
		datasource.getitem($(this).parent().data('id'));
	});
	// delete
	$('button#delete').on('click', function(){
		$('#modal-delete input#item_code').val($(this).parent().data('id'));
	});

  // uppercase name
  $('input#item_name').focusout(function(){
    $(this).val($(this).val().toUpperCase())
  })

  // price formater
  
  $('input#capital_price, input#selling_price').keyup(function(){
    $(this).val(currency(
      currencyToNum($(this).val())
    ));
  })

};
export default main;