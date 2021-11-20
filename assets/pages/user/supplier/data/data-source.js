class DataSource {
	constructor() {
		this.BASEURL = location.href+'/';
	}

	dataTabels(){
			let datatabels = $('#tbl_supplier*').dataTable({
			'dom': `<'row'<'col-6 col-lg col-xl'><'col-6 col-lg col-xl'<'float-right'f>>>
					<'row'<'col-12'tr>>
					<'row'<'col-5 col-xs-12'i><'col-7 col-xs-12'p>>`,
			'responsive': true,
			'autoWidth': false,
			'ordering': false,
			'lengthChange': false

		});
		$('input#user_fullname').keyup(function(){
			datatabels.fnFilter(this.value);
		})
	}

	getuser(user_id){
		$.ajax({
			url: location.origin+'/user/select',
			method: 'POST',
			dataType: 'JSON',
			data: {'request': 'GET', 'data': user_id},
			success: function(result){
				$('#modal-update input#user_id').val(result.user_id);
				$('#modal-update input#user_fullname').val(result.user_fullname);
				$('#modal-update input#owner_name').val(result.owner_name);
				$('#modal-update textarea#user_address').val(result.user_address);
				$('#modal-update input#village').val(result.village);
				$('#modal-update input#sub-district').val(result['sub-district']);
				$('#modal-update input#district').val(result.district);
				$('#modal-update input#province').val(result.province);
				$('#modal-update input#zip').val(result.zip);
				$('#modal-update textarea#note').val(result.note);
				$('#modal-update input#user_contact_phone').val(result.user_contact_phone);
				$('#modal-update input#user_contact_email').val(result.user_contact_email);
			}	
		})
	}
}
export default DataSource;