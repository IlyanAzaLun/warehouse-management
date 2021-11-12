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
                            <option value="" selected="selected">Select category item</option>
                            <option value="LIQUID FREEBASE CREAMY" data-id="FREEBASE-CREAMY" >LIQUID FREEBASE CREAMY</option>
                            <option value="LIQUID FREEBASE FRUITY" data-id="FREEBASE-FRUITY" >LIQUID FREEBASE FRUITY</option>
                            <option value="LIQUID SALT CREAMY" data-id="SALT-CREAMY" >LIQUID SALT CREAMY</option>
                            <option value="LIQUID SALT FRUITY" data-id="SALT-FRUITY" >LIQUID SALT FRUITY</option>
                            <option value="LIQUID PODS CREAMY" data-id="PODS-CREAMY" >LIQUID PODS CREAMY</option>
                            <option value="LIQUID PODS FRUITY" data-id="PODS-FRUITY" >LIQUID PODS FRUITY</option>
                          </select>
                        </div>
                      </div>
				`)
		}else{
			$('.subcategory').remove();
		}

		// category code //		
		$('input#item_code').on('focus', function(){
			datasource.getcode($('.category').find(':selected').data('id'));
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