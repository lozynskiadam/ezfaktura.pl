if (typeof $ == 'undefined') {
  console.warn('jQuery is not defined')
}

if (typeof $.ui == 'undefined') {
  console.warn('jQuery-ui is not defined')
}

window.dialog = function (params = {}) {

  let DialogRef = {};

  let onError = function(jqXHR, textStatus, errorThrown) {
    switch(jqXHR.status) {
      case 422:
        let errors = jqXHR.responseJSON.errors;
        for (let field in errors) if (errors.hasOwnProperty(field)) {
          let $input = $('[name="' + field + '"], [name^="' + field + '["]', DialogRef.getModalBody());
          let $form = $input.closest('.form-group');
          let $error_block = $('.validation-block', $form).length > 0 ? $('.validation-block', $form) : $('<div/>').addClass('error-block').insertAfter($input);
          $form.addClass('has-error text-danger');
          $error_block.html(errors[field]);
        }
        $('button, a', DialogRef.getModalFooter()).removeAttr('disabled');
        break;
      default:
        DialogRef.getModalHeader().removeClass().addClass('modal-header bg-danger');
        $('.modal-title', DialogRef.getModalHeader()).text(jqXHR.statusText);
        DialogRef.getModalBody().html('<div class="text-center"><h1>' +jqXHR.status+ '</h1><h5>' + errorThrown + '</h5></div>');
        DialogRef.getModalFooter().html('');
        break;
    }
  };

  DialogRef.defaultParams = {
    id: null,
    title: '',
    message: '',
    class: 'bg-primary',
    loading: '<div class="text-center"><i class="fa fa-sync-alt fa-spin fa-3x"></i></div>',
    load: {
      url: null,
      method: 'GET',
      dataType: 'html',
      callback: null
    },
    save: {
      url: null,
      method: 'POST',
      dataType: 'json',
      callback: null
    },
    draggable: true,
    buttons: []
  };

  DialogRef.params = $.extend(true, DialogRef.defaultParams, params);

  DialogRef.open = function () {
    DialogRef.getContainer().appendTo($('body')).modal('show');
  };

  DialogRef.close = function () {
    DialogRef.getContainer().modal('hide');
  }

  DialogRef.getContainer = function () {
    return this.object;
  };

  DialogRef.getModal = function () {
    return $('.modal-dialog', this.object);
  };

  DialogRef.getModalHeader = function () {
    return $('.modal-header', this.object);
  };

  DialogRef.getModalBody = function () {
    return $('.modal-body', this.object);
  };

  DialogRef.getModalFooter = function () {
    return $('.modal-footer', this.object);
  };

  DialogRef.object = (function () {
    let $container = $('<div/>').addClass('modal fade').attr('role', 'dialog').attr('tabindex', '-1').attr('id', DialogRef.params.id);
    let $dialog = $('<div/>').addClass('modal-dialog').appendTo($container);
    let $content = $('<div/>').addClass('modal-content').appendTo($dialog);
    let $header = $('<div/>').addClass('modal-header').addClass(DialogRef.params.class).appendTo($content);
    let $title = $('<h5/>').addClass('modal-title').appendTo($header);
    let $close = $('<button/>').addClass('close act-close').html('&times;').appendTo($header);
    let $body = $('<div/>').addClass('modal-body').appendTo($content);
    let $footer = $('<div/>').addClass('modal-footer').appendTo($content);

    if (DialogRef.params.draggable) {
      $dialog.draggable({handle: '.modal-header'})
      $header.css('cursor', 'all-scroll');
    }

    for (const button of DialogRef.params.buttons) {
      let btn = $('<button/>');
      let data = button.data || {};
      if (button.label) {
        btn.html(button.label);
      }
      if (button.class) {
        btn.addClass(button.class);
      }
      if (button.event) {
        btn.on('click.btn-dialog', function () {
          button.event(DialogRef, btn, data);
        });
      }
      btn.appendTo($footer);
    }

    $container.on('click', '.act-close', function () {
      DialogRef.close(DialogRef, this);
    });

    $title.html(DialogRef.params.title);
    $body.html(DialogRef.params.message);

    if (DialogRef.params.load.url) {
      $footer.hide();
      $body.html(DialogRef.params.loading);
      $.ajax({
        method: DialogRef.params.load.method,
        url: DialogRef.params.load.url,
        dataType: DialogRef.params.load.dataType,
        success: function (data) {
          $body.html(data);
          $footer.show();
          $('.act-save', DialogRef.getModalFooter()).on('click', function () {
            $('[name]', DialogRef.getModalBody()).closest('.form-group').removeClass('has-error');
            $('.error-block', DialogRef.getModalBody()).remove();
            $('.validation-block', DialogRef.getModalBody()).text('');
            let $btn = $(this);
            $btn.attr('disabled', 'disabled');
            $.ajax({
              method: DialogRef.params.save.method,
              data: $('form', DialogRef.getModalBody()).serialize(),
              url: DialogRef.params.save.url,
              dataType: DialogRef.params.save.dataType,
              success: function (data) {
                if ($.isFunction(DialogRef.params.save.callback)) {
                  DialogRef.params.save.callback(DialogRef, data);
                }
                DialogRef.close();
              },
              error: onError
            });
          });
          if ($.isFunction(DialogRef.params.load.callback)) {
            DialogRef.params.load.callback(DialogRef, data);
          }
        },
        error: onError
      });
    }

    $container.on('hidden.bs.modal', function () {
      $(this).dialogRef = undefined
      $(this).remove();
    });

    $container[0].dialogRef = DialogRef;
    return $container;
  })();

  (function initialize() {
    DialogRef.open();
  })();

  return DialogRef;
}