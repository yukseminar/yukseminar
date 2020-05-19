
// Kelola seminar
$('.pendaftaran-change').click(function(e){

  var value = $(this).data('url');
    $.ajax({
      type: 'POST',
      url: base_url+'user/statusPendaftaran',
      data: {'url': value},
      dataType: 'json',
      success: function(response) {
        var bukaPendaftaran = response['buka_pendaftaran'];
        var url = response['url_seminar'];
        if (bukaPendaftaran == 0) {
          // var isi = ` <span class='btn-selesaiseminar' data-toggle='modal' data-target='#seminar_selesai' data-url='${url}'><i class='fas fa-trash-alt sampah'></i></span></span>`;
          var isi = `<span class="btn-selesaiseminar" data-toggle="modal" data-target="#seminar_selesai" data-url="${url}"><i class="fas fa-trash-alt sampah"></i></span>`
          $('#td'+value).html(isi);
          Swal.fire({
          type: 'error',
          title: 'Pendaftaran ditutup !',
          text: 'Peserta bisa mendaftar kembali jika pendaftaran dibuka...'
        });

        }else{
          var isi = `<span ><i class='fas fa-trash-alt sampah-disable'></i></span></span>`;
          $('#td'+value).html(isi);
          Swal.fire(
          'Selamat !',
          'Pendaftaran berhasil dibuka kembali...',
          'success'
        )

        }
        // $('#td'+value).html(response);
        // console.log(response);
          // alert("ok");
          // console.log(nama);

      },error: function(response){
        alert("gagal");
      }

    });
  // alert(value);
  // console.log("ok");


});
// Akhir Kelola Seminar



//Selesai SEMINAR
$('.btn-selesaiseminar').click(function(){
  var url = $(this).data('url');
  // console.log(url);
  $.ajax({
    type: 'POST',
    url: base_url+'user/ajaxDetailSeminar',
    data: {'url': url},
    dataType: 'json',
    success: function(response) {
      $('#pselesai_seminar').html(`Semua data pembayaran maupun paper akan dihapus, anda yakin untuk menyelesaikan seminar '${response['nama_seminar']}' ?`);
      $('#iselesai_seminar').val(response['id_seminar']);
    },error: function(response){
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: 'Ada kesalahan'
    });
    }

  });

});
//Akhir Selesai Seminar



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


//awal bukti pembayaran
$('.btn-bukti').click(function(){
  var peserta = $(this).data('peserta');
  var url = $(this).data('seminar');

  $.ajax({
    type: 'POST',
    url: base_url+'user/ajaxDetailSeminar',
    // contentType: "application/json",
    dataType: 'json',
    data: {'url': url},
    success: function(response) {

      $('#buktipeserta').val(peserta);
      $('#internal').val(formatRupiah(response['harga_seminar'], 'Rp. '));
      $('#umum').val(formatRupiah(response['harga_umum'], 'Rp. '));
      $('#an').val("Atas nama : " +response['an_penyelenggara']);
      $('#bank').val("Bank : " +response['bank_rekening']);
      $('#rek').val("Rekening : " +response['rekening_seminar']);
      var id_seminar = response['id_seminar'];
      var id_peserta = peserta;


      

        $.ajax({
          type: "POST",
          data: {id_seminar:id_seminar, id_peserta:id_peserta},
          url : base_url+'user/getDetailPeserta',
          beforeSend: function(){
          
          },
          success : function(result){
            console.log(result);
            $.each(JSON.parse(result), function(index, itemData) {
                console.log(itemData.promo);
                if(itemData.promo == 1){
                  $('#umum').hide();
                  $('#internal').show();
                }else{
                  $('#internal').hide();
                  $('#umum').show();
                }
         
            });
          }
        });


    },error: function(response){
      console.log("gagal");
    }

  });

});
//akhir bukti pembayaran



//Detail Pengawas
$('.btn-pengawas').click(function(){
  var pengawas = $(this).data('pengawas');

  $.ajax({
    type: 'POST',
    url: base_url+'user/ajaxDetailUser',
    data: {'id': pengawas},
    dataType: 'json',
    success: function(response) {
      // console.log(response);
      $('#nama_pengawas').html(`Nama Pengawas : ${response['nama_user']}`);
      $('#email_pengawas').html(`Email Pengawas : ${response['email_user']}`);

    },error: function(response){
      alert("gagal");
    }

  });
});
//Akhir Detail Pengawas


$(document).ready( function () {
  $( ".dua" ).hide();
  $( ".tiga" ).hide();
  $( ".empat" ).hide();

  $("#bar-satu").click(function() {
    $( ".satu" ).show();
      $( ".dua" ).hide();
    $( ".tiga" ).hide();
    $( ".empat" ).hide();
  });
  $("#bar-dua").click(function() {
    $( ".satu" ).hide();
      $( ".dua" ).show();
    $( ".tiga" ).hide();
    $( ".empat" ).hide();
  });
  $("#bar-tiga").click(function() {
    $( ".satu" ).hide();
      $( ".dua" ).hide();
    $( ".tiga" ).show();
    $( ".empat" ).hide();
  });
  $("#bar-empat").click(function() {
    $( ".satu" ).hide();
      $( ".dua" ).hide();
    $( ".tiga" ).hide();
    $( ".empat" ).show();
  });

    // console.log("yoi");
    $('#TableRiwayat').DataTable();
    $('#TableKelolaSeminar').DataTable();
    $('#TableSeminarku').DataTable();
    $('#TableDaftarPeserta').DataTable();
    $('#TableKehadiran').DataTable();
    $('#TableSeminarHadir').DataTable();
    
    // SELECT 2
    // $('.select2').select2();
    //AKHIR SELECT 2

    //scroll view
    $('.page-scroll').on('click', function(e){
      var href = $(this).attr('href');

      var tujuan = $(href);

      $('html,body').animate({
        scrollTop: tujuan.offset().top - 110
      }, 1000);

      e.preventDefault();
    })
    //akhir scroll view


    //Disabled harga internal
    
    $('.kode_promo').prop("readonly", true);



    $(".hargainternal").on("focus", function () {
      $('.kode_promo').prop("readonly", false);

    });

    $(".hargainternal").on("blur", function() {
      if($('.hargainternal').val() == ""){
        $('.kode_promo').prop("readonly", true);
        $('.kode_promo').val('');
      }else{
        $('.kode_promo').prop("readonly", false);
      }
    });

   
    //akhir disabled harga internal

    //buat pengawas
    const flashPengawasSuccess = $('#flash-data-pengawas').data('success');
    const flashPengawasFailed = $('#flash-data-pengawas').data('failed');
      if (flashPengawasSuccess) {
        Swal.fire(
        'Selamat !',
        flashPengawasSuccess,
        'success'
      )
    }
    if(flashPengawasFailed){
        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: flashPengawasFailed
      });
    }
    //akhir buat pengawas



    //bukti pembayaran
    const flashDataBukti = $('#flash-data-bukti').data('success');
    const flashDataFailedBukti = $('#flash-data-bukti').data('failed');
      if (flashDataBukti) {
        Swal.fire(
        'Selamat !',
        flashDataBukti,
        'success'
      )
    }
    if(flashDataFailedBukti){
        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: flashDataFailedBukti
      });
    }
    //akhir bukti pembayaran

    //awal paper
    $('.btn-paper').click(function(){
      var peserta = $(this).data('peserta');
      $('#pdfpeserta').val(peserta);
      // console.log(peserta);
    });

    const flashDataPaper = $('#flash-data-paper').data('success');
    const flashDataFailedPaper = $('#flash-data-paper').data('failed');
      if (flashDataPaper) {
        Swal.fire(
        'Selamat !',
        flashDataPaper,
        'success'
      )
    }
    if(flashDataFailedPaper){
        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: flashDataFailedPaper
      });
    }
    //akhir paper


    //Selesai seminar
    const flashDataSelesai = $('#flash-data-selesai').data('success');
    const flashDataFailedSelesai = $('#flash-data-selesai').data('failed');
      if (flashDataSelesai) {
        Swal.fire(
        'Berhasil menyelesaikan seminar !',
        flashDataSelesai,
        'success'
      )
    }
    if(flashDataFailedSelesai){
        Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: flashDataFailedSelesai
      });
    }

    //See more keterangan
$('.btn-lihat').on('click', function(){
  var ket = $(this).attr('data-ket');
  $('#modalLihat').modal('toggle');
  $('.ket-lihat').text(ket);
});
//akhir see more keterangan

//tombol showbarcode
$('.btn-barcode').on('click', function(){
  $('#modalBarcode').modal('toggle');

  var idx = $(this).attr('data-idseminar');
  var idy = $(this).attr('data-iduser');

  $.ajax({
      type: "POST",
      data: {id_seminar:idx, id_user:idy},
      url : base_url+'user/getDetailSeminarPeserta',
      beforeSend: function(){
      
      },
      success : function(result){
        $.each(JSON.parse(result), function(index, itemData) {
            $('.judul-seminar').text(itemData.nama_seminar);
            var barcode = itemData.barcode;
            $('.barcode-image').attr('src',base_url+'user/Qrcode/'+barcode);
        });
      }
    });
})
//akhir tombol show barcode



});
