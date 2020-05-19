
$(document).ready( function () {

  $('#tablepengawas').DataTable();

  //buat pengawas
  const flashPesertaSuccess = $('#flash-data-peserta').data('success');
  const flashPesertaFailed = $('#flash-data-peserta').data('failed');
    if (flashPesertaSuccess) {
      Swal.fire(
      'Selamat !',
      flashPesertaSuccess,
      'success'
    )
  }
  if(flashPesertaFailed){
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: flashPesertaFailed
    });
  }
  //akhir buat pengawas
});

// FORMAT rupiah
 function formatRupiah(angka, prefix){
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split       = number_string.split(','),
      sisa        = split[0].length % 3,
      rupiah        = split[0].substr(0, sisa),
      ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
 
      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }
 
      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

//Akhir Format Rupiah

//See more keterangan
$('.btn-bukti').on('click', function(){
  // var ket = $(this).attr('data-ket');
  var harga_umum = $(this).attr('data-hargaumum');
  var harga_internal = $(this).attr('data-hargainternal');
  var promo = $(this).attr('data-promo');
  var an_user = $(this).attr('data-anuser');
  var rekening = $(this).attr('data-rekening');
  var bukti = $(this).attr('data-bukti');
  
  $('#buktitransfer').modal('toggle');
  if(promo == 1){
    $('#harga').val(formatRupiah(harga_internal,'Rp. '));
  }else{
    $('#harga').val(formatRupiah(harga_umum,'Rp. '));
  }

  $('#bank').val('Bank Rekening : '+rekening);
  $('#an').val('Atas Nama : '+an_user);
  $('#img-bukti').attr('src', base_url+'assets/'+bukti);
  console.log(base_url+'assets/'+bukti);
});
//akhir see more keterangan
