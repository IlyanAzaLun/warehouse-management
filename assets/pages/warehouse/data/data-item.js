class DataItem {
	constructor() {
		this.BASEURL = location.href+'/';
	}
	
	items(request = false, handle){
		$.ajax({
			url: location.base+'warehouse/item',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': request},
			success: function(result){
				handle(result);
			}	
		})
	}
}
export default DataItem;