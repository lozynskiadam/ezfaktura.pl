const App = {

  addDataTable: function (id, config) {
    config = JSON.parse(config);
    config.createdRow = eval(config.createdRow);
    config.drawCallback = eval(config.drawCallback);
    config.columns.map(function (item) {
      item.render = eval(item.render);
    });
    config.buttons.map(function (item) {
      item.action = eval(item.action);
    });
    if (typeof window.dataTables == 'undefined') {
      window.dataTables = [];
    }
    window.dataTables.push({id: id, config: config, table: $('#' + id).DataTable(config)});
  },

  getDataTable: function (id) {
    return window.dataTables.find((table) => table.id === id).table;
  },

  updateDataTableRowById : function (table, id, data) {
    App.getDataTable(table).rows().every( function (rowIdx) {
      if(this.data()['id'] == id) {
        data = $.extend(true, this.data(), data);
        App.getDataTable(table).row(rowIdx).data(data).draw(true);
        return true;
      }
    });
    return false;
  },

  removeDataTableRowById : function (table, id) {
    App.getDataTable(table).rows().every( function (rowIdx) {
      if(this.data()['id'] == id) {
        App.getDataTable(table).row(rowIdx).remove().draw(true);
        return true;
      }
    });
    return false;
  },

  waitDialog: function() {
    return dialog({
      title: 'Proszę czekać...',
      class: 'bg-warning',
      size: 'modal-sm',
      close: false,
      message: '<div class="text-center"><i class="fa fa-sync-alt fa-spin fa-3x"></i></div>'
    });
  },

  init: function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.fn.dataTable.ext.type.order["currency-asc"] = function(a,b) {
      a = parseInt(a.replace(/\s/g, '').replace(/\./g, '').match(/\d+/)[0]);
      b = parseInt(b.replace(/\s/g, '').replace(/\./g, '').match(/\d+/)[0]);
      return (a<b)?1:-1;
    };
    $.fn.dataTable.ext.type.order["currency-desc"] = function(a,b) {
      a = parseInt(a.replace(/\s/g, '').replace(/\./g, '').match(/\d+/)[0]);
      b = parseInt(b.replace(/\s/g, '').replace(/\./g, '').match(/\d+/)[0]);
      return (a>b)?1:-1;
    };

    $('body').tooltip({
      selector: '[data-toggle="tooltip"]',
      trigger: 'hover',
      html: true
    }).click(function () {
      $('[data-toggle="tooltip"]', $(this)).tooltip("hide");
    });

    $('#tasks', document).on('click', function () {
      $.notify({
        icon: 'fa fa-cogs',
        title: 'Brak zleconych operacji',
        message: 'Aktualnie nie posiadasz żadnych aktywnych operacji'
      }, {
        // settings
        type: 'primary',
        placement: {
          from: 'bottom',
          align: 'right'
        },
        delay: 2000
      });
    });

    $('#search-form', document).on('submit', function(e){
    	e.preventDefault();
    	let $search = $('#search', document);
    	let q = $search.val();
    	if(!q) {
    	  return;
      }
      $search.val('');
			dialog({
				title: 'Wyniki wyszukiwania',
				load: {
					url: "/search",
					data: {
						q: q
					}
				}
			});
		});

    setTimeout(function () {
      $("#request-message", document).fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
      });
    }, 2000);


    $.fn.strtr = function(pattern) {
      for(const element of this) {
        let $element = $(element);
        let html = $element.html();
        for(const key in pattern) if(pattern.hasOwnProperty(key)) {
          let value = pattern[key];
          html = html.split(key).join(value);
        }
        $element.html(html);
      }
      return this;
    };
  },

};