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
          modalBody.on('click', '.act-add', {parent: modalBody}, Pages_Invoices.addPosition);
          modalBody.on('click', '.act-delete', {parent: modalBody}, Pages_Invoices.removePosition);
          modalBody.on('click', '.addon-gus', {parent: modalBody}, Pages_Invoices.onGUSClick);
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
    window.location.href = "/invoices/" + id + "/download";
  },

  onGUSClick: function(e) {
    let $selector = $(this);
    let parent = e.data.parent;
    let waitDialog = dialog({
      title: 'Proszę czekać...',
      class: 'bg-warning',
      size: 'modal-sm',
      close: false,
      message: '<div class="text-center"><i class="fa fa-sync-alt fa-spin fa-3x"></i></div>'
    });

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
