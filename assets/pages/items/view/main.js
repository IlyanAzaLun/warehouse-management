import DataSource from "../data/data-source.js";
const datasource = new DataSource();

const main = () => {
	// DataSource.loadData(function(output){})
	datasource.dataTabels();
	$('.select2').select2();

	// category code //
	$('#category').on('change', function(event){
		if($(this).find(':selected').data('id')=='LQD'){
			$('.category').after(`
                      <div class="col-sm-3 subcategory">
                        <div class="form-group">
                          <label>Subcategory item</label>
                          <select class="form-control select2" style="width: 100%;" name="subcategory" id="subcategory" required>
                            <option value="" selected="selected">Select category item</option>
                            <option value="ML" data-id="ML" >ML</option>
                            <option value="NIKOTIN" data-id="NIKOTIN">NIKOTIN</option>
                          </select>
                        </div>
                      </div>
				`)
		}else{
			$('.subcategory').remove();
		}

	});
	$('#item_code').on('focus', function(){
		$(this).val(`${$('.category').find(':selected').data('id')}${($('.subcategory').find(':selected').data('id'))?`-${$('.subcategory').find(':selected').data('id')}-`:`-`}`)
	})
	// category code //
};
export default main;