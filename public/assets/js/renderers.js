const Renderers = {

  invoice_type: function(data, type, row, meta) {
    let html = [];
    if(row.invoice_type) {
      html.push('<span class="font-weight-bold px-1" style="white-space: nowrap;">');
      html.push('<i class="far fa-file-pdf"></i> ' + row.invoice_type.initials);
      html.push('</span>');
    }
    for(const invoice_type of row.invoice_types || []) {
      html.push('<span class="font-weight-bold px-1" style="white-space: nowrap;">');
      html.push('<i class="far fa-file-pdf"></i> ' + invoice_type.initials);
      html.push('</span>');
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

  is_paid: function(data, type, row, meta) {
    if(data) {
      return '<i class="fa fa-dollar-sign dt-icon text-primary"></i>';
    }
    return '<i class="fa fa-dollar-sign dt-icon text-muted"></i>';
  },

  is_sent: function(data, type, row, meta) {
    if(data) {
      return '<i class="fa fa-envelope dt-icon text-primary"></i>';
    }
    return '<i class="fa fa-envelope dt-icon text-muted"></i>';
  },

  signature_syntax: function(data, type, row, meta) {
    data = data.split('/').join('<span class="mx-1 opacity-3">/</span>');
    data = data.split('{counter}').join('<span class="text-info dt-hover">licznik</span>');
    data = data.split('{year}').join('<span class="text-info dt-hover">rok</span>');
    data = data.split('{month}').join('<span class="text-info dt-hover">miesiąc</span>');
    return data;
  },

};
