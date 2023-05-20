/* Others */

$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip({
      'delay': { show: 1000 },
      trigger : 'hover'
    });
  
    $('[data-toggle="tooltip"]').on('click', function () {
      $(this).tooltip('hide')
    })

    $('#title').text("-");
    $('#artist').text("-");
    $('#image').attr("src","album_covers/fenix.jpg");
  
    lockControls();
  
    $('#search').keypress(function (e) {
      if(e.which ==13) {
        stop();
        stop_station();
        search();
      }
    });

    $("form[name='form_profile']").submit(function(e) {
      var password = $("input[name='password']").val();
      $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "checkPassword",
        data: {"password" : password},
        dataType: 'json',
        async: false,
        success: function(result){
          var data = result;
          if(data.status == 0) {
            toastr.warning("Wrong password");
            e.preventDefault();
            return false;
          }
        },
        error: function(result) {
          console.log(result);
          toastr.error("Error checking password");
          e.preventDefault();
          return false;
        } 
      });
    });
  
  });