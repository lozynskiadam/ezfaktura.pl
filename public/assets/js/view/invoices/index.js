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
        { label: 'Zamknij', class: 'btn btn-light act-close' },
        { label: 'Zapisz', class: 'btn btn-primary act-save' }
      ],
    });
  },

  onRowClick: function(e) {
    let id = e.data.id;
    dialog({
      title: 'Podgląd faktury',
      load: {
        url: "/invoices/" + id
      },
      buttons: [
        { label: 'Pobierz', class: 'btn btn-primary act-delete mr-auto' },
        { label: 'Usuń', class: 'btn btn-danger act-delete mr-auto' },
        { label: 'Zamknij', class: 'btn btn-light act-close' }
      ],
    });
  },

};