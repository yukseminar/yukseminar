$(document).ready(function(){

  $('.btn-hadir').click(function(){
    var peserta = $(this).data('peserta');
    var user = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: base_url+'user/ajaxDetailUser',
      data: {'id': user},
      dataType: 'json',
      success: function(response) {
        console.log(response);
        $('.nama').val(response['nama_user']);
        $('.email').val(response['email_user']);
        $('#peserta').val(peserta);



      },error: function(response){
        alert("gagal");
      }

    });

  });


  //absen
  const flashSuccess = $('#flash-data-absen').data('success');
  const flashFailed = $('#flash-data-absen').data('failed');
  const flashWrong = $('#flash-data-absen').data('wrong');

  if (flashSuccess) {
      Swal.fire(
      'Selamat !',
      flashSuccess,
      'success'
    )
  }
  if(flashFailed){
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: flashFailed
    });
  }
  if(flashWrong){
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: flashWrong
    });
  }
  //akhir absen



});
