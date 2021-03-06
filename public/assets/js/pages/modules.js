let Pages_Modules = {

  init: function() {
    $('.module-box', document).on('click', Pages_Modules.onModuleBoxClick);
    let allCheckboxes = document.querySelectorAll('input[type=checkbox]');
    [].forEach.call(allCheckboxes, function (checkbox) {
      checkbox.checked = checkbox.defaultChecked;
    });
  },

  onModuleBoxClick: function() {
    let $box = $(this);
    let $switcher = $('input[type="checkbox"]', $box);
    let checked = !$switcher.prop('checked');
    let id = $switcher.val();
    $switcher.prop('checked', checked);
    $box.toggleClass('active', checked);
    $('.module-box', document).css('pointer-events', 'none');
    if(id) {
      $.ajax({
        method: "POST",
        url: '/modules/' +id+ '/toggle',
        data: {
          active: checked ? 1 : 0,
        },
        dataType: 'json',
        success: function(data) {
          window.location.href = window.location.href;
        }
      });
    }
  },

};
