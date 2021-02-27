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
          $('[name="issue_date"], [name="sale_date"], [name="payment_due_date"]', modalBody).datepicker({
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
    let $defaultRow = $('.default-row', e.data.parent);
    let $row = $defaultRow.clone().removeClass('default-row');
    $row.strtr({
      '%NAME%': 'positions[' +Pages_Invoices.PositionRowIndex+ ']',
      '%BTN_CLASS%': Pages_Invoices.PositionRowIndex > 1 ? 'act-delete text-danger' : 'act-add',
      '%BTN_ICON%': Pages_Invoices.PositionRowIndex > 1 ? 'fa fa-times' : 'fa fa-plus',
    });
    $defaultRow.parents('tbody').append($row);
    Pages_Invoices.PositionRowIndex++;
  },

  removePosition: function() {
    $(this).parents('tr').remove();
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
    let waitDialog = App.waitDialog();

    $.ajax({
      method: "POST",
      url: '/invoices/' + id + '/setpaid',
      dataType: 'json',
      success: function (data) {
        App.updateDataTableRowById('InvoiceList', id, {is_paid: '1'});
        waitDialog.close();
        parentDialog.restart();
      },
      error: function () {
        waitDialog.close();
        parentDialog.restart();
      }
    });
  },

  onSetSentClick: function(e) {
    let id = e.data.id;
    let waitDialog = App.waitDialog();
    let parentDialog = e.data.dialog;

    $.ajax({
      method: "POST",
      url: '/invoices/' + id + '/setsent',
      dataType: 'json',
      success: function (data) {
        App.updateDataTableRowById('InvoiceList', id, {is_sent: '1'});
        waitDialog.close();
        parentDialog.restart();
      },
      error: function () {
        waitDialog.close();
        parentDialog.restart();
      }
    });
  },

  onDeleteClick: function(e) {
    let id = e.data.id;
    let parentDialog = e.data.dialog;
    let waitDialog = App.waitDialog();

    $.ajax({
      method: "DELETE",
      url: '/invoices/' + id,
      dataType: 'json',
      success: function (data) {
        App.removeDataTableRowById('InvoiceList', id);
        waitDialog.close();
        parentDialog.close();
      },
      error: function () {
        waitDialog.close();
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
        nip: $('[name="buyer_nip"]', parent).val()
      },
      dataType: 'json',
      success: function (data) {
        waitDialog.close();
        if(data.success) {
          $('[name="buyer_name"]', parent).val(data.name);
          $('[name="buyer_address"]', parent).val(data.address);
          $('[name="buyer_city"]', parent).val(data.city);
          $('[name="buyer_postcode"]', parent).val(data.postcode);
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
