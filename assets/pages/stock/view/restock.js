const restock = () => {
	var lots_of_stuff_already_done = false;
	$('form#insert button[type="submit"]').on('click', function(e){
		e.preventDefault();
		var link = $('form#insert').attr('action');
		confirmation(link);
	});

	function confirmation(link){
	    Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Untuk mengubah data jumlah barang!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, tolong lakukan',
		}).then((result) => {
		  if (result.isConfirmed) {
		    $("#insert").submit();
		  }
		})	    
	}
};
export default restock;