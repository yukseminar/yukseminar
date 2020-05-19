function chooseFile() {
  $("#fileInput").click();
}

function copyLink(){
  // var link = $('#link').val();

  // Cara 2
  var copyText = document.getElementById("link");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");

  Swal.fire(
    'Selamat :) ',
    'Link berhasil di copy...',
    'success'
  );

}


$(document).ready(function(){
        // $("#link").hide();
        $( "#harga" ).hide();
        $( "#hargaumum" ).hide();
        $( "#rek" ).hide();
        $( "#an" ).hide();
        $( "#bank" ).hide();



        const flashFailed = $('#flash-data-edit').data('failed');
        const flashSuccess = $('#flash-data-edit').data('success');
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




      $("#rdbayar").click(function(){
            var radioValue = $("input[name='berbayar']:checked").val();

                  $( "#harga" ).show();
                  $( "#hargaumum" ).show();
                  $( "#rek" ).show();
                  $( "#an" ).show();
                  $( "#bank" ).show();
          });


      $("#rdgratis").click(function(){
            var radioValue = $("input[name='berbayar']:checked").val();

                  $( "#harga" ).hide();
                  $( "#hargaumum" ).hide();
                  $( "#rek" ).hide();
                  $( "#an" ).hide();
                  $( "#bank" ).hide();
          });




});
