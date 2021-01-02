App.view = {
  init: function() {
    $('.act-toggle-key', document).on('click', App.view.onToggleKeyClick);
    $('.act-reset-key', document).on('click', App.view.onResetKeyClick);
  },

  onToggleKeyClick: function() {
    let $ApiKey = $('#ApiKey', document);
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
        $('#ApiKey', document).val(data.key);
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
}