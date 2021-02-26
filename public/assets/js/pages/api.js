let Pages_Api = {

  init: function() {
    $('.act-toggle-key', document).on('click', Pages_Api.onToggleKeyClick);
    $('.act-reset-key', document).on('click', Pages_Api.onResetKeyClick);
  },

  onToggleKeyClick: function() {
    let $ApiKey = $('#api-key', document);
    if($ApiKey.attr('type') === 'text') {
      $ApiKey.attr('type', 'password');
      $(this).html('<i class="fa fa-eye"></i>');
    }
    else {
      $ApiKey.attr('type', 'text');
      $(this).html('<i class="fa fa-eye-slash"></i>');
    }
  },

  onResetKeyClick: function() {
    $.ajax({
      method: "POST",
      url: "/api/resetkey",
      dataType: 'json',
      success: function (data) {
        $('#api-key', document).val(data.key);
        swal("Gotowe!", "Twój klucz API został zresetowany", {
          icon: "success",
          buttons: {
            confirm: {
              className: 'btn btn-primary'
            }
          },
        });
      },
    });
  },

};
