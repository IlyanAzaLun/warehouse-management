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
                          <label>Subcategory item</label>
                          <select class="form-control select2" style="width: 100%;" name="subcategory" id="subcategory" required>
                            <option disabled value="" selected="selected">Select category item</option>
                            <option value="BRAND" data-id="LIQUID-BRAND" >BRAND</option>
                            <option value="FREEBASE-CREAMY" data-id="LIQUID FREEBASE CREAMY" >LIQUID FREEBASE CREAMY</option>
                            <option value="FREEBASE-FRUITY" data-id="LIQUID FREEBASE FRUITY" >LIQUID FREEBASE FRUITY</option>
                            <option value="SALT-CREAMY" data-id="LIQUID SALT CREAMY" >LIQUID SALT CREAMY</option>
                            <option value="SALT-FRUITY" data-id="LIQUID SALT FRUITY" >LIQUID SALT FRUITY</option>
                            <option value="PODS-CREAMY" data-id="LIQUID PODS CREAMY" >LIQUID PODS CREAMY</option>
                            <option value="PODS-FRUITY" data-id="PODS FRUITY" >LIQUID PODS FRUITY</option>
                            <option value="ML" data-id="LIQUID-ML" >ML</option>
                            <option value="NIKOTIN" data-id="LIQUID-NIKOTIN" >NIKOTIN</option>
                          </select>
                        </div>
                      </div>
				`)
		}else{
			$('.subcategory').remove();
		}

		// category code //		
		$('input#item_code', 'form#insert').on('focus', function(){
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
};
export default main;