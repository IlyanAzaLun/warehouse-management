class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}
	jsGrid(selector, role){
		$(selector).jsGrid({
			width: "auto fixed",
			height: "600px",

			filtering: true,
			inserting:true,
			editing: true,
			sorting: true,
			paging: true,
			autoload: true,
			pageSize: 10,
			pageButtonCount: 5,
			deleteConfirm: "Do you really want to delete data?",
			controller: {
				loadData: function(filter){
					return $.ajax({
						type: "GET",
						url: location.href+'/'+"API/users",
						data: filter
					});
				},
				insertItem: function(item){
					return $.ajax({
						type: "POST",
						url: location.href+'/'+"API/users",
						data:item
					});
				},
				updateItem: function(item){
					return $.ajax({
						type: "PUT",
						url: location.href+'/'+"API/users",
						data: item
					});
				},
				deleteItem: function(item){
					return $.ajax({
						type: "DELETE",
						url: location.href+'/'+"API/users",
						data: item
					});
				},
			},

			fields: [
			{
				title: "Full name",
				name: "user_fullname", 
				type: "text", 
				width: 150, 
				validate: "required"
			},
			{
				title: "Contact",
				name: "user_email", 
				type: "text", 
				width: 150, 
				validate: "required"
			},
			{
				title: "Role",
				name: "role_id", 
				type: "select",
				items: role,
				valueField: "id", 
				textField: "role_name", 
			},
			{
				title: "Status",
				name: "is_active", 
				type: "select", 
				items: [
					{ Name: "", Id: '' },
					{ Name: "Active", Id: '1' },
					{ Name: "Inactive", Id: '0' }
				], 
				valueField: "Id", 
				textField: "Name", 
				validate: function(value)
				{
					if(value > 0)
					{
						return true;
					}
				}
			},
			{
				type: "control"
			}
			]
		});
	}

	get_roles(callback){
		$.ajax({
			url: this.BASEURL+'API/roles',
			type: "GET",
			dataType: 'JSON',
			success: function(result){
				callback(result)
			}
		})
	}
}
export default DataSource;