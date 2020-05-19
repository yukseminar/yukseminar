

$(document).ready(function(){


	$(".btn-upload-poster").on('change', function() {
         var filename = $('input[type=file]').val().split('\\').pop();
		$('.file-path-wrapper').text(filename);
	});

	$(".btn-upload-profile").on('change', function() {
         var filename = $('input[type=file]').val().split('\\').pop();
		$('.file-path-wrapper').text(filename);
	});

	const flashDataWrong = $('.flash-data-wrong').data('flashdata');
	const flashData = $('.flash-data-success').data('flashdata');
	  if (flashData) {
		    Swal.fire({
		    title: 'Berhasil!',
		    text: flashData,
		    type: 'success'
	  	})
	}else if(flashDataWrong){
		Swal.fire({
		  type: 'error',
		  title: 'Gagal!',
		  text: flashDataWrong
		})
	}

	$('.tombol-logout').on('click', function(e){
	  e.preventDefault();

	  const hrefHapus = $(this).attr('href');

	    Swal.fire({
	    title: 'Apakah anda yakin?',
	    text: "Untuk keluar dari halaman ini",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    confirmButtonText: 'Ya, Keluar!'
	  }).then((result) => {
	    if (result.value) {
	      document.location.href = hrefHapus;
	    }
	  })
	})









});
