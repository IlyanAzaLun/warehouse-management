class DataItem {
	constructor() {
		this.BASEURL = location.href+'/';
	}
	
	get_status_notification(handle){
		$.ajax({
			url: location.origin+location.pathname+'/warehouse/notification',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET'},
			success: function(result){
				handle(result);
			}	
		})
	}
	
	change_status_notification(data, handle){
		$.ajax({
			url: location.origin+location.pathname+'/warehouse/notification-change',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'order_id': data},
			success: function(result){
				handle(result);
			}
		})
	}
}
export default DataItem;