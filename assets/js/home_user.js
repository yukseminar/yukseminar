$(document).ready( function () {
  $('#Tentang').click(function(e){
    // alert("ok");
    e.preventDefault();
    var body = $("html, body");

    body.animate(
      {scrollTop:$('#TentangKami').position().top},
      2000
    );
  });

    // Akhir Kelola Seminar
});


