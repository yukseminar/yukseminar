$(document).ready( function () {


  $('.datatable').DataTable();
  $('#nama_kategori').val("");
  const flashDataSuccess = $('.flash-data-success').data('flash');
    if (flashDataSuccess) {
      Swal.fire(
      'Success',
      flashDataSuccess,
      'success'
    )
  }

  const flashDataFailed = $('.flash-data-failed').data('flash');
    if (flashDataFailed) {
      Swal.fire(
      'Oops!',
      flashDataFailed,
      'error'
    )
  }

  $('.btntambah-kategori').on('click', function() {
    $('.modal-title').text('Tambah Kategori');
    $('#nama_kategori').val('');
    $('.modal-form').attr('action', base_url+'admin/tambahKategori');
  });

  $('.btnedit-kategori').on('click', function() {
    $('.modal-title').text('Ubah Kategori');
    var nama_kategori = $(this).attr("data-nama_kategori");
    var id_kategori = $(this).attr("data-id_kategori");
    $('#nama_kategori').val(nama_kategori);
    $('.modal-form').attr('action', base_url+'admin/ubahKategori');
    $('#id2').val(id_kategori);
  });

  $('.tombol-hapus').on('click', function(e){
    e.preventDefault();

    const href = $(this).attr('href');
    var nama_kategori = $(this).attr("data-nama_kategori");

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "untuk menghapus "+nama_kategori+" dari kategori",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    })
  })

  $('.tombol-silang').on('click', function(e){
    $('#modalTolak').modal('toggle');
    const id = $(this).attr('data-id');
    const nama_seminar = $(this).attr('data-namaseminar');
    $('#id2').val(id);
    $('.nama_seminar').text(nama_seminar);
  })

  $('.tombol-check').on('click', function(e){
    e.preventDefault();

    const href = $(this).attr('href');
    $('#modalTerima').modal('toggle');

    const idx = $(this).attr('data-id');

        $.ajax({
          type: "POST",
          data: "id="+idx,
          url : base_url+'admin/getDetailSeminar',
          beforeSend: function(){
          
          },
          success : function(result){
            console.log(result);
            var objResult=JSON.parse(result);
             $(".nama_seminar").text(objResult.nama_seminar);
      
          }
        });

        //tombolnya kasih href cuy
        $('.tombol-terima').attr('href',href);

  })

  //AWAL DETAIL USER

  $('.btn-detail-user').on('click', function(){
    var idx = $(this).attr('data-iduser');

    $('#modaldetailuser').modal('toggle');

    $.ajax({
      type: "POST",
      data: "id="+idx,
      url : base_url+'admin/getUserById',
      beforeSend: function(){
      
      },
      success : function(result){
        var objResult=JSON.parse(result);
        $('#email').text(objResult.email_user);
        $('#hp').text(objResult.phone_user);
        $('#nim').text(objResult.nim_user);
        $('#jurusan').text(objResult.jurusan);
        $('#universitas').text(objResult.universitas);
        $('#alamat').text(objResult.address_user);
        $('#bday').text(objResult.bday_user);
        $('#jk').text(objResult.gender_user);
        $('#created_at').text(objResult.created_at);
        $('#updated_at').text(objResult.updated_at);

      }
    });
  })

  //AKHIR DETAIL USER





});

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



function getDataSeminar(idx){
    $.ajax({
      type: "POST",
      data: "id="+idx,
      url : base_url+'admin/getDetailSeminar',
      beforeSend: function(){
      
      },
      success : function(result){
        console.log(result);
        var objResult=JSON.parse(result);
        $("#nama_seminar").text(objResult.nama_seminar);
        $("#kategori_seminar").text(objResult.kategori_seminar);
        $("#deskripsi_seminar").text(objResult.deskripsi_seminar);
        $("#jadwal").text(objResult.jadwal);
        $("#waktu").text(objResult.waktu);
        $("#tempat_seminar").text(objResult.tempat_seminar);
        $("#narasumber").text(objResult.narasumber);
        $("#jml_peserta").text(objResult.jml_peserta);
        if(objResult.paper == '0'){
            $("#paper").text('tidak');
        }else{
          $("#paper").text('ya');
        }
        if(objResult.harga_umum == '0'){
          $("#harga_eksternal").text('Tidak berbayar!');
        }else {
          var angka = formatRupiah(objResult.harga_umum, 'Rp. ');
          $("#harga_eksternal").text(angka);
        }

        if(objResult.harga_seminar == '0'){
          $("#harga_internal").text('Tidak berbayar!');
        }else{
            var angka = formatRupiah(objResult.harga_seminar, 'Rp. ');
          $("#harga_internal").text(angka);
        }
         if (objResult.pembayaran == '1') {
            $("#bank_rekening").text(objResult.bank_rekening);
            $("#rekening_seminar").text(objResult.rekening_seminar);
            $("#an_penyelenggara").text(objResult.an_penyelenggara);
         }else {
            $("#bank_rekening").text('-');
            $("#rekening_seminar").text('-');
            $("#an_penyelenggara").text('-');
            
         }
      }
    });
}