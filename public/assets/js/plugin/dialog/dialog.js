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
          let name = '';
          field.split('.').forEach((item, i) => name += i === 0 ? item : '[' + item + ']');
          let $input = $('[name="' + name + '"], [name^="' + name + '["]', DialogRef.getModalBody());
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
    size: 'modal-md',
    class: 'bg-primary',
    close: true,
    loading: '<div class="text-center"><i class="fa fa-sync-alt fa-spin fa-3x"></i></div>',
    load: {
      url: null,
      method: 'GET',
      data: {},
      dataType: 'html',
      callback: null,
      xhrFields: null,
      beforeSend: null
    },
    save: {
      url: null,
      method: 'POST',
      dataType: 'json',
      callback: null,
      xhrFields: null,
      beforeSend: null
    },
    draggable: true,
    buttons: []
  };

  DialogRef.params = $.extend(true, DialogRef.defaultParams, params);

  DialogRef.open = function () {
    DialogRef.getContainer().appendTo($('body')).modal('show');
  };

  DialogRef.close = function () {
    // trick to evade problem when dialog is not fully initialized and close() is called
    if(DialogRef.getContainer().modal('hide').hasClass('show')) {
      setTimeout(DialogRef.close, 200);
    }
  };

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

  DialogRef.restart = function () {
    let params = DialogRef.params;
    DialogRef.close();
    return dialog(params);
  };

  DialogRef.object = (function () {
    let $container = $('<div/>').addClass('modal fade').attr('role', 'dialog').attr('tabindex', '-1').attr('id', DialogRef.params.id);
    let $dialog = $('<div/>').addClass('modal-dialog').addClass(DialogRef.params.size).appendTo($container);
    let $content = $('<div/>').addClass('modal-content').appendTo($dialog);
    let $header = $('<div/>').addClass('modal-header').addClass(DialogRef.params.class).appendTo($content);
    let $title = $('<h5/>').addClass('modal-title').appendTo($header);
    let $body = $('<div/>').addClass('modal-body').appendTo($content);
    let $footer = $('<div/>').addClass('modal-footer').appendTo($content);

    if(DialogRef.params.close) {
      $('<button/>').addClass('close act-close').html('&times;').appendTo($header);
    }

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

    $title.html(DialogRef.params.title);
    $body.html(DialogRef.params.message);

    if (DialogRef.params.load.url) {
      $footer.addClass('d-none');
      $body.html(DialogRef.params.loading);
      $.ajax({
        method: DialogRef.params.load.method,
        url: DialogRef.params.load.url,
        data: DialogRef.params.load.data,
        dataType: DialogRef.params.load.dataType,
        success: function (data, status, xhr) {
          $body.html(data);
          $footer.removeClass('d-none');
          if ($.isFunction(DialogRef.params.load.callback)) {
            DialogRef.params.load.callback(DialogRef, data, status, xhr);
          }
        },
        xhrFields: DialogRef.params.load.xhrFields,
        beforeSend: DialogRef.params.load.beforeSend,
        error: onError
      });
    }

    $container.on('click', '.act-close', function () {
      DialogRef.close(DialogRef, this);
    });

    $container.on('click', '.act-save', function () {
      $('[name]', DialogRef.getModalBody()).closest('.form-group').removeClass('has-error text-danger');
      $('.error-block', DialogRef.getModalBody()).remove();
      $('.validation-block', DialogRef.getModalBody()).text('');
      let $btn = $(this);
      $btn.attr('disabled', 'disabled');
      $.ajax({
        method: DialogRef.params.save.method,
        data: $('form', DialogRef.getModalBody()).serialize(),
        url: DialogRef.params.save.url,
        dataType: DialogRef.params.save.dataType,
        success: function (data, status, xhr) {
          if ($.isFunction(DialogRef.params.save.callback)) {
            DialogRef.params.save.callback(DialogRef, data, status, xhr);
          }
          DialogRef.close();
        },
        xhrFields: DialogRef.params.save.xhrFields,
        beforeSend: DialogRef.params.save.beforeSend,
        error: onError
      });
    });

    $container.on('hidden.bs.modal', function () {
      $(this).dialogRef = undefined;
      $(this).remove();
    });

    $container[0].dialogRef = DialogRef;
    return $container;
  })();

  (function initialize() {
    DialogRef.open();
  })();

  return DialogRef;
};