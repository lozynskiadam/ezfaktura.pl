let Pages_Profile = {

  init: function () {
    $("#UploadLogo", document).on("click", Pages_Profile.onUploadLogoClick);
  },

  onUploadLogoClick: function() {
    let file = document.createElement("input");
    file.type = "file";
    file.accept = "image/x-png";
    file.addEventListener('change', (event) => {
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
            if(data) {
              $('#Logo', document).attr('src', data);
              $('.avatar-img', document).attr('src', data);
            }
          },
        });
      }
    });
    file.click();
  }

};
