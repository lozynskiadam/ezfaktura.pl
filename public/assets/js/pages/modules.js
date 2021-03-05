let Pages_Modules = {

  init: function() {
    $('.module-box', document).on('click', Pages_Modules.onModuleBoxClick);
  },

  onModuleBoxClick: function() {
    let $switcher = $('input[type="checkbox"]', $(this));
    let checked = !$switcher.prop('checked');
    $switcher.prop('checked', checked);
    $(this).toggleClass('active', checked);
  },

};
