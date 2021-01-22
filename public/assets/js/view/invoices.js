App.view = {

  init: function() {
  },

  onRowCreate: function(row, data) {
    $(row).hover(
      () => $(this).addClass('table-row-callback'),
      () => $(this).removeClass('table-row-callback')
    );
    $(row).on('click', data, App.view.onRowClick);
  },

  onAddClick: function(e, dt, node, config) {
    dialog({
      title: 'Wystaw fakturę',
      load: {
        url: "/invoices/create",
        callback: App.view.onDialogShow
      },
      save: {
        url: "/invoices",
        callback: function(dialogRef, data) {
          App.getDataTable('InvoiceList').row.add(data.row).draw()
        }
      },
      buttons: [
        { label: 'Podgląd', class: 'btn btn-secondary mr-auto' },
        { label: 'Anuluj', class: 'btn btn-light act-close' },
        { label: 'Wystaw', class: 'btn btn-primary act-save' }
      ],
    });
  },

  onDialogShow: function(dialogRef) {
    let modalBody = dialogRef.getModalBody();
    $('[name="issue_date"], [name="sale_date"], [name="delivery_date"], [name="payment_due_date"]', modalBody).datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      language: 'pl'
    });
  },

  onRowClick: function(e) {
    let id = e.data.id;
    window.location.href = "/invoices/" + id + "/download";
  },

};