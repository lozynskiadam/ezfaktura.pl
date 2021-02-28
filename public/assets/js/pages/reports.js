let Pages_Reports = {

  onRowCreate: function (row, data) {
    $(row).hover(
      () => $(this).addClass('table-row-callback'),
      () => $(this).removeClass('table-row-callback')
    );
    $(row).on('click', data, Pages_Reports.onRowClick);
  },

  onRowClick: function (e) {
    let id = e.data.id;
    let code = e.data.code;

    dialog({
      title: code,
      load: {
        url: '/reports/' + id,
        callback: function (dialogRef) {
          let modalBody = dialogRef.getModalBody();
          $('[name="date_from"], [name="date_to"]', modalBody).datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: 'pl'
          });
        }
      },
      save: {
        url: '/reports/' + id + '/generate',
        dataType: null,
        xhrFields: {
          responseType: 'blob',
        },
        beforeSend: Pages_Reports.handleGenerateXhrReadyState,
        callback: Pages_Reports.onGenerateClick
      },
      buttons: [
        {label: 'Anuluj', class: 'btn btn-light act-close'},
        {label: 'Generuj', class: 'btn btn-primary act-save'}
      ],
    });
  },

  handleGenerateXhrReadyState: function (jqXHR, settings) {
    let xhr = settings.xhr;
    settings.xhr = function () {
      let output = xhr();
      output.onreadystatechange = function () {
        if(this.readyState === 2 && this.status !== 200) {
          this.responseType = "text";
        }
      };
      return output;
    };
  },

  onGenerateClick: function(dialogRef, result, status, xhr) {
    let filename = "";
    let disposition = xhr.getResponseHeader('Content-Disposition');
    if (disposition && disposition.indexOf('attachment') !== -1) {
      let filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
      let matches = filenameRegex.exec(disposition);
      if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
    }
    let blob = new Blob([result], {
      type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    });
    let link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    dialogRef.close();
  }

};
