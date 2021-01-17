const Renderers = {

  invoice_type: function(data, type, row, meta) {
    let html = [];
    if(row.invoice_type) {
      html.push('<span class="font-weight-bold px-1" style="white-space: nowrap;">');
      html.push('<i class="far fa-file-pdf"></i> ' + row.invoice_type.initials);
      html.push('</span>');
    }
    if(row.invoice_types) {
      for(const invoice_type of row.invoice_types) {
        html.push('<span class="font-weight-bold px-1" style="white-space: nowrap;">');
        html.push('<i class="far fa-file-pdf"></i> ' + invoice_type.initials);
        html.push('</span>');
      }
    }
    return html.join('\r\n');
  },

  contractor: function(data, type, row, meta) {
    return data.name ? data.name : '-';
  },

  tax_id: function(data, type, row, meta) {
    return data.tax_id ? data.tax_id : '-';
  },

  currency: function(data, type, row, meta) {
    if(row.currency) {
      return data + ' <span class="opacity-3">' + row.currency + '</span>';
    }
    return data;
  },

};
