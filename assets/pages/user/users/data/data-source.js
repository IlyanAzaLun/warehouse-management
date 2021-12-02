class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
		this.dataTabels();
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

	dataTabels(){
		let self = this;
		let datatabels = $('#tbl_user').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'<'float-left'f>><'col-6 col-lg col-xl'<'float-right'l>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': true

		});
	}
	search_user(id){
		$.ajax({
			url: this.BASEURL+"API/users",
			type: "GET",
			data: {'id':id},
			success: function(result){
				$('#modal-update input#user_id').val(result.user_id);
				$('#modal-update input#user_fullname').val(result.user_fullname);
				$('#modal-update textarea#user_address').val(result.user_address);
				$('#modal-update input#village').val(result.village);
				$('#modal-update input#sub-district').val(result['sub-district']);
				$('#modal-update input#district').val(result['district']);
				$('#modal-update input#province').val(result.province);
				$('#modal-update input#zip').val(result.zip);
				$('#modal-update input#user_contact_phone').val(result.user_contact_phone);
				$('#modal-update input#user_contact_email').val(result.user_contact_email);
				$('#modal-update select#role').find('option[value="'+result.role_id+'"]').prop('selected', true);
				$('#modal-update textarea#note').val(result.note);
				$('#modal-update input#is_active').prop('checked', Boolean(parseInt(result.is_active)));
			}
		})
	}
}
export default DataSource;