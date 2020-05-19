$(document).ready(function(){
  const flashData = $('.flash-data').data('flashdata');
  const flashDataFailed = $('.flash-data').data('flashdatafailed');
    if (flashData) {
      Swal.fire(
      'Good job!',
      flashData,
      'success'
    )
  }
  if(flashDataFailed){
      Swal.fire({
      type: 'error',
      title: 'Oops...',
      text: flashDataFailed
    });
  }
  // console.log("jsmasuk");
});


