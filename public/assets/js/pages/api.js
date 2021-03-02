let Pages_Api = {

  init: function() {
    $('.act-toggle-token', document).on('click', Pages_Api.onToggleTokenClick);
    $('.act-reset-token', document).on('click', Pages_Api.onResetTokenClick);
  },

  onToggleTokenClick: function() {
    let $ApiToken = $('#api-token', document);
    if($ApiToken.attr('type') === 'text') {
      $ApiToken.attr('type', 'password');
      $(this).html('<i class="fa fa-eye"></i>');
    }
    else {
      $ApiToken.attr('type', 'text');
      $(this).html('<i class="fa fa-eye-slash"></i>');
    }
  },

  onResetTokenClick: function() {
    $.ajax({
      method: "POST",
      url: "/api/resettoken",
      dataType: 'json',
      success: function (data) {
        $('#api-token', document).val(data.key);
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
