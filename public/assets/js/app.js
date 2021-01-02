const App = {
	view: null,
	dataTables: [],

	addDataTable: function(id, config) {
		config = JSON.parse(config);
		config.createdRow = eval(config.createdRow);
		config.drawCallback = eval(config.drawCallback);
		config.columns.map(function(item) {
			item.render = eval(item.render);
		});
		config.buttons.map(function(item) {
			item.action = eval(item.action);
		});
		App.dataTables.push({id: id, config: config});
	},

	getDataTable: function(id) {
		return App.dataTables.find((table) => table.id === id).table;
	},

	initDataTables: function() {
		for(const table of App.dataTables) {
			let $table = $('#' + table.id);
			table.table = $table.DataTable(table.config);
		}
	},

	init: function() {
		App.initDataTables();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('body').tooltip({
			selector: '[data-toggle="tooltip"]',
			trigger : 'hover'
		}).click(function(){
			$('[data-toggle="tooltip"]', $(this)).tooltip("hide");
		});

		$('#bell', document).on('click', function() {
			let $content = $('.notif-center', document);
			$content.html('<a href="#" class="p-2"><i class="fa fa-sync-alt fa-spin fa-2x m-auto"></i></a>');
			$.ajax({
				method: "GET",
				url: "/notifications/list",
				dataType: 'json',
				success: function (data) {
					let html = [];
					for(const item of data) {
						item.is_confirmed ? html.push('<a href="#" class="confirmed">') : html.push('<a href="#">');
						html.push('	<div class="notif-icon text-' + item.class + '"><i class="' + item.icon + '"></i></div>');
						html.push('	<div class="notif-content">');
						html.push('		<span class="subject">' + item.title + '</span>');
						html.push('		<span class="block">' + item.message + '</span>');
						html.push('		<span class="time">' + item.date + '</span>');
						html.push('	</div>');
						html.push('</a>');
					}
					$content.html(html.join(''));
					$('#bell .notification', document).html('');
				},
			});
		});

		$('#tasks', document).on('click', function (){
			$.notify({
				icon: 'fa fa-cogs',
				title: 'Brak zleconych operacji',
				message: 'Aktualnie nie posiadasz żadnych aktywnych operacji'
			},{
				// settings
				type: 'info',
				placement: {
					from: 'bottom',
					align: 'right'
				},
				delay: 2000
			});
		});

		if(App.view) {
			App.view.init();
		}
	},
}