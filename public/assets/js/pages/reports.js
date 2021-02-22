let Pages_Reports = {

  onRowCreate: function(row, data) {
    $(row).hover(
      () => $(this).addClass('table-row-callback'),
      () => $(this).removeClass('table-row-callback')
    );
    $(row).on('click', data, Pages_Reports.onRowClick);
  },

  onRowClick: function(e) {
    let id = e.data.id;
    window.location.href = "/reports/" + id + "/generate";
  },

};
