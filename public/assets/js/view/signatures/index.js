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
      title: 'Dodaj sygnaturę',
      load: {
        url: "/signatures/create",
        callback: App.view.onDialogShow
      },
      save: {
        url: "/signatures",
        callback: function(dialogRef, data) {
          App.getDataTable('SignatureList').row.add(data.row).draw()
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
      title: 'Edytuj sygnaturę',
      load: {
        url: '/signatures/' + id + '/edit',
        callback: App.view.onDialogShow
      },
      save: {
        url: '/signatures/' + id,
        method: 'PUT',
        callback: function(dialogRef, data) {
          App.getDataTable('SignatureList').row((idx, row) => row.id == id).data(data.row).draw();
        }
      },
      buttons: [
        { label: 'Usuń', class: 'btn btn-danger act-delete mr-auto', event: App.view.onDeleteClick, data: {id: id} },
        { label: 'Zamknij', class: 'btn btn-light act-close' },
        { label: 'Zapisz', class: 'btn btn-primary act-save' }
      ],
    });
  },

  onDialogShow: function(dialogRef, data) {
    $('[name="name"]', dialogRef.getModalBody()).on('blur change update keyup', function() {
      $(this).val($(this).val().split(' ').join('-').replace( /[^a-zA-Z0-9-]/g , "").toLowerCase());
    }).trigger('blur');
  },

  onDeleteClick: function(dialogRef, btn, data) {
    let id = data.id;
    $(btn).attr('disabled', 'disabled');
    $.ajax({
      url: '/signatures/' + id,
      method: "DELETE",
      dataType: 'json',
      success: function(data) {
        App.getDataTable('SignatureList').row((idx, row) => row.id == id).remove().draw();
        dialogRef.close();
      },
      error: function(jqXHR, textStatus, errorThrown) {
        dialogRef.close();
        dialog({
          title: jqXHR.statusText,
          message: '<div class="text-center"><h1>' +jqXHR.status+ '</h1><h5>' + errorThrown + '</h5></div>',
          class: 'bg-danger'
        });
      },
    });
  },

};