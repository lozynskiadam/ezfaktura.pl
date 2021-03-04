let Pages_Invoices = {

  onRowCreate: function(row, data) {
    $(row).hover(
      () => $(this).addClass('table-row-callback'),
      () => $(this).removeClass('table-row-callback')
    );
    $(row).on('click', data, Pages_Invoices.onRowClick);
  },

  onAddClick: function(e, dt, node, config) {
    dialog({
      title: 'Wystaw fakturę',
      load: {
        url: "/invoices/create",
        callback: function(dialogRef) {
          let modalBody = dialogRef.getModalBody();
          $('[name="invoice[issue_date]"], [name="invoice[sale_date]"], [name="invoice[payment_due_date]"]', modalBody).datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: 'pl'
          });
          Pages_Invoices.PositionRowIndex = 1;
          Pages_Invoices.addPosition({data: {parent: modalBody}});
          Pages_Invoices.toggleDiscount({data: {parent: modalBody}});
          modalBody.on('click', '.act-add', {parent: modalBody}, Pages_Invoices.addPosition);
          modalBody.on('click', '.act-delete', {parent: modalBody}, Pages_Invoices.removePosition);
          modalBody.on('click', '.addon-gus', {parent: modalBody}, Pages_Invoices.onGUSClick);
          modalBody.on('change', '#use-discount', {parent: modalBody}, Pages_Invoices.toggleDiscount);
        },
      },
      save: {
        url: "/invoices",
        callback: function(dialogRef, data) {
          App.getDataTable('InvoiceList').row.add(data.row).draw()
        }
      },
      buttons: [
        // { label: 'Podgląd', class: 'btn btn-secondary mr-auto' },
        { label: 'Anuluj', class: 'btn btn-light act-close' },
        { label: 'Wystaw', class: 'btn btn-primary act-save' }
      ],
    });
  },

  toggleDiscount: function(e) {
    let parent = e.data.parent;
    if($('#use-discount', parent).val() === '1') {
      $('.row-discount input', parent).removeAttr('disabled');
      $('.row-discount', parent).show();
    }
    else {
      $('.row-discount input', parent).attr('disabled', 'disabled');
      $('.row-discount', parent).hide();
    }
  },

  addPosition: function(e) {
    let $defaultRow = $('#positions .default-row', e.data.parent);
    let $row = $defaultRow.clone().removeClass('default-row');
    $row.strtr({
      '%ORDINAL%': Pages_Invoices.PositionRowIndex,
      '%NAME%': 'invoice[positions][' +Pages_Invoices.PositionRowIndex+ ']',
      '%BTN_CLASS%': Pages_Invoices.PositionRowIndex > 1 ? 'act-delete text-danger' : 'act-add',
      '%BTN_ICON%': Pages_Invoices.PositionRowIndex > 1 ? 'fa fa-times' : 'fa fa-plus',
    });
    $defaultRow.parents('tbody').append($row);
    Pages_Invoices.PositionRowIndex++;
    Pages_Invoices.reorderPositions(e);
  },

  removePosition: function(e) {
    $(this).parents('tr').remove();
    Pages_Invoices.PositionRowIndex--;
    Pages_Invoices.reorderPositions(e);
  },

  reorderPositions: function(e) {
    let $table = $('#positions', e.data.parent);
    $('tbody tr:not(.default-row)', $table).each(function(i) {
      let $row = $(this);
      let oldIndex = $('td:nth-child(1)', $row).text().trim();
      let newIndex = i+1;
      $('td:nth-child(1)', $row).html(newIndex);
      $('input, select', $row).each(function(){
        if($(this).attr('id')) {
          $(this).attr('id', $(this).attr('id').split('[' +oldIndex+ ']').join('[' +newIndex+ ']'));
        }
        if($(this).attr('name')) {
          $(this).attr('name', $(this).attr('name').split('[' +oldIndex+ ']').join('[' +newIndex+ ']'));
        }
      });
    });
  },

  onRowClick: function(e) {
    let id = e.data.id;
    let signature = e.data.signature;
    dialog({
      title: signature,
      load: {
        url: '/invoices/' + id,
        callback: function(dialogRef) {
          let modalBody = dialogRef.getModalBody();
          modalBody.on('click', '.act-set-paid', {id: id, dialog: dialogRef}, Pages_Invoices.onSetPaidClick);
          modalBody.on('click', '.act-set-sent', {id: id, dialog: dialogRef}, Pages_Invoices.onSetSentClick);
          modalBody.on('click', '.act-delete', {id: id, dialog: dialogRef}, Pages_Invoices.onDeleteClick);
        }
      }
    });
  },

  onSetPaidClick: function(e) {
    let id = e.data.id;
    let parentDialog = e.data.dialog;
    $(this).attr('disabled', 'disabled').html('<i class="fa fa-sync-alt fa-spin"></i>');

    $.ajax({
      method: "POST",
      url: '/invoices/' + id + '/setpaid',
      dataType: 'json',
      success: function (data) {
        App.updateDataTableRowById('InvoiceList', id, {is_paid: '1'});
        parentDialog.restart();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        dialog({
          title: errorThrown,
          message: jqXHR.responseJSON.message,
          class: 'bg-danger',
        });
        parentDialog.close();
      }
    });
  },

  onSetSentClick: function(e) {
    let id = e.data.id;
    let parentDialog = e.data.dialog;
    $(this).attr('disabled', 'disabled').html('<i class="fa fa-sync-alt fa-spin"></i>');

    $.ajax({
      method: "POST",
      url: '/invoices/' + id + '/setsent',
      dataType: 'json',
      success: function (data) {
        App.updateDataTableRowById('InvoiceList', id, {is_sent: '1'});
        parentDialog.restart();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        dialog({
          title: errorThrown,
          message: jqXHR.responseJSON.message,
          class: 'bg-danger'
        });
        parentDialog.close();
      }
    });
  },

  onDeleteClick: function(e) {
    let id = e.data.id;
    let parentDialog = e.data.dialog;
    $(this).attr('disabled', 'disabled').html('<i class="fa fa-sync-alt fa-spin"></i>');

    $.ajax({
      method: "DELETE",
      url: '/invoices/' + id,
      dataType: 'json',
      success: function (data) {
        App.removeDataTableRowById('InvoiceList', id);
        parentDialog.close();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        dialog({
          title: errorThrown,
          message: jqXHR.responseJSON.message,
          class: 'bg-danger'
        });
        parentDialog.close();
      }
    });
  },

  onGUSClick: function(e) {
    let $selector = $(this);
    let parent = e.data.parent;
    let waitDialog = App.waitDialog();

    $.ajax({
      method: "GET",
      url: "/gus",
      data: {
        nip: $('[name="buyer[nip]"]', parent).val()
      },
      dataType: 'json',
      success: function (data) {
        waitDialog.close();
        if(data.success) {
          $('[name="buyer[name]"]', parent).val(data.name);
          $('[name="buyer[address]"]', parent).val(data.address);
          $('[name="buyer[city]"]', parent).val(data.city);
          $('[name="buyer[postcode]"]', parent).val(data.postcode);
        }
        else {
          setTimeout(function() { $selector.effect("shake",{times:3, distance: 5}, 500) }, 500);
        }
      },
      error: function () {
        setTimeout(function() { $selector.effect("shake",{times:3, distance: 5}, 500) }, 500);
        waitDialog.close();
      }
    });
  },

};
