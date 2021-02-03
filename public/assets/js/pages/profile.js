let Pages_Profile = {

  init: function () {
    $(".act-upload-logo", document).on("click", Pages_Profile.onUploadLogoClick);
    $(".act-change-password", document).on("click", Pages_Profile.onChangePasswordClick);
    $(".act-export-data", document).on("click", Pages_Profile.onExportDataClick);
    $(".act-delete-account", document).on("click", Pages_Profile.onDeleteAccountClick);
  },

  onUploadLogoClick: function() {
    let file = document.createElement("input");
    file.type = "file";
    file.accept = "image/x-png";
    file.addEventListener('change', function () {
      let fd = new FormData();
      let files = file.files;
      if (files.length > 0) {
        fd.append('logo', files[0]);
        $.ajax({
          method: "POST",
          url: "/profile/logo",
          data: fd,
          contentType: false,
          processData: false,
          success: function (data) {
            $('#Logo', document).attr('src', data.logo);
            $('.avatar-img', document).attr('src', data.logo);
          },
        });
      }
    });
    file.click();
  },

  onChangePasswordClick: function () {
    dialog({
      title: 'Zmień hasło',
      message: function() {
        let html = [];
        html.push('<form>');
        html.push('<div class="form-group row">');
        html.push('  <label for="current_password" class="col-form-label col-md-2">Aktualne hasło</label>');
        html.push('  <div class="col-md-10">');
        html.push('    <input type="password" id="current_password" class="form-control" name="current_password"/>');
        html.push('  </div>');
        html.push('</div>');
        html.push('<div class="form-group row">');
        html.push('  <label for="new_password" class="col-form-label col-md-2">Nowe hasło</label>');
        html.push('  <div class="col-md-10">');
        html.push('    <input type="password" id="new_password" class="form-control" name="new_password"/>');
        html.push('  </div>');
        html.push('</div>');
        html.push('<div class="form-group row">');
        html.push('  <label for="new_password_confirmation" class="col-form-label col-md-2">Powtórz hasło</label>');
        html.push('  <div class="col-md-10">');
        html.push('    <input type="password" id="new_password_confirmation" class="form-control" name="new_password_confirmation"/>');
        html.push('  </div>');
        html.push('</div>');
        html.push('</form>');
        return html.join('\r\n');
      },
      save: {
        url: "/profile/changepassword",
        callback: function(dialogRef, data) {
          if(data.success) {
            swal("Gotowe!", "Twóje hasło zostało zmienione", {
              icon: "success",
              buttons: {
                confirm: {
                  className: 'btn btn-primary'
                }
              },
            });
          }
          else {
            swal("Coś poszło nie tak...", "Spróbuj ponownie później.", {
              icon: "error",
              buttons: {
                confirm: {
                  className: 'btn btn-danger'
                }
              },
            });
          }
        }
      },
      buttons: [
        { label: 'Anuluj', class: 'btn btn-light act-close' },
        { label: 'Zapisz', class: 'btn btn-primary act-save' }
      ],
    });
  },

  onExportDataClick: function () {
    dialog({
      title: 'Eksportuj dane',
      message: '...'
    });
  },

  onDeleteAccountClick: function () {
    dialog({
      title: 'Usuń konto',
      class: 'bg-danger',
      message: '...'
    });
  },

};
