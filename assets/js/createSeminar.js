
$(document).ready(function(){
  //AWAL SELECT 2
  $('.select2').select2();
  //AKHIR SELECT 2


  const flashData = $('.flash-data').data('flash');
  const flashDataFailed = $('.flash-data-failed').data('failed');
  if (flashData) {
    Swal.fire(
    'Good job!',
    flashData,
    'success'
    );
  }
  if (flashDataFailed) {
    Swal.fire(
    'Oops!',
    flashDataFailed,
    'error'
    );
  }



  // console.log("ok");
  $( ".form-bayar" ).hide();

  $("#rdbayar").click(function(){
      var radioValue = $("input[name='berbayar']:checked").val();
      $( ".form-bayar" ).show();
      
  });

    $("#rdgratis").click(function(){
        var radioValue = $("input[name='berbayar']:checked").val();
        $( ".form-bayar" ).hide();
        
    });

    if($('#rdgratis').is(':checked')) { 
      $( ".form-bayar" ).hide();
    }

    if($('#rdbayar').is(':checked')) { 
      $( ".form-bayar" ).show();
    }
});


