class DataCustomer {
	constructor() {
		this.BASEURL = location.href+'/';
		this.LOCALURL = location.origin+'/';
	}
    user_info(handle){
		$.ajax({
			url: this.BASEURL+'API/customer',
			method: 'GET',
			dataType: 'JSON',
			success: function(result){
				handle(result);
			}	
		})
	}
	user_info_search(request, handle){
		$.ajax({
			url: this.BASEURL+'API/customer',
			method: 'GET',
			dataType: 'JSON',
			data: {'id': request},
			success: function(result){
				handle(result);
			}	
		})	
	}
}
export default DataCustomer;