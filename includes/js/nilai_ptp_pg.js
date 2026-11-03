$(function () {
	
	var disabler = '<div id="disabler"></div>';
	
	if ($('#table-kegiatan').length) {
		var colsname = new Array();
		var n = 0;
		var search_row = '';
		$('#table-kegiatan thead .title').each(function () {
			colsname.push({
				name: $(this).attr('name'),
				targets: n++
			});
			if ($(this).is('.searchable')) {
				var search_type = $(this).data('type');
				if (search_type == 'boolean') {
					search_row += '<td>';
					search_row += '<select class="filter-field">';
					search_row += '<option value="">Semua</option>';
					search_row += '<option value="true">Ada</option>';
					search_row += '<option value="false">Tidak Ada</option>';
					search_row += '</select>';
					search_row += '</td>';
				}if (search_type == 'active') {
					search_row += '<td>';
					search_row += '<select class="filter-field">';
					search_row += '<option value="0">Semua</option>';
					search_row += '<option value="true">Aktif</option>';
					search_row += '<option value="false">Tidak Aktif</option>';
					
					search_row += '</select>';
					search_row += '</td>';
				}				else {
					search_row += '<td><input class="filter-field" type="text" placeholder="' + $(this).html() + '"></td>';
				}
			} else {
				search_row += '<td></td>';
			}

		});

		var ajaxUrl = $('#table-kegiatan').data('source-url');
		var table = $('#table-kegiatan').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"ajax": ajaxUrl,
			"columnDefs": colsname
		});

		$('#table-kegiatan thead').append('<tr>' + search_row + '</tr>');

		var theColumns = new Array();
		table.columns().every(function () {
			theColumns.push(this);
		});
		var eventRun = false;
		$('#table-kegiatan').on('keyup change', '.filter-field', function () {
			var thisElement = this;
			if (eventRun) {
				clearTimeout(eventRun);
			}
			eventRun = setTimeout(function () {
				theColumns[$(thisElement).parent().index()].search(thisElement.value).draw();
			}, 100);
		});
		/*
		 $('#table-kegiatan').on('xhr.dt', function(e, settings, json, xhr){
		 
		 })
		 */
		
		$('#table-kegiatan').on('draw.dt', function (e, settings) {
			var element = this;
			var api = new $.fn.dataTable.Api(settings);
			var data = api.data();
			var url = $('#table-kegiatan').data('url');
			var detail_url = $('#table-kegiatan').data('detail-url');
			var edit_url = $('#table-kegiatan').data('edit-url');
			var process_url = $('#table-kegiatan').data('process-url');
			var daftar_peserta_url = $('#table-kegiatan').data('daftar-peserta-url');
			var delete_url = $('#table-kegiatan').data('delete-url');
			var upload_url = $('#table-kegiatan').data('upload-url');
			var peserta_url = $('#table-kegiatan').data('peserta-url');

			var param = api.ajax.params();
			param = $.param(param);
			currentParam = decodeURIComponent(param);

			if (data.length > 0) {
				$('tr', element).each(function () {
					var index = $(this).index();
					var haveAction = $('.action', this);
					if (haveAction.length < 1) {
						if ($(this).is('.odd') || $(this).is('.even')) {
							var tools = '';
							var this_detail_url = detail_url + '/' + data[index][0];
							if (this_detail_url)
						tools += '<a class="btn btn-primary btn-edit view-data" data-id="' + data[index][0] + '" href="' + this_detail_url + '" title="Lihat Data"><i class="fa fa-file"></i></a>&nbsp;';
							if (crud.edit_priv) {
							}
							/*
							if (crud.delete_priv) {
								var this_delete_url = delete_url + '/' + data[index][0];
								if (this_delete_url)
									tools += '<a class="btn btn-primary btn-delete" href="' + this_delete_url + '" title="Delete"><i class="fa fa-trash"></i></a>&nbsp;';
							}
							var this_upload_url = upload_url + '/' + data[index][0];
							if (this_delete_url)
								tools += '<a class="btn btn-primary btn-upload" href="' + this_upload_url + '" title="Upload Document"><i class="fa fa-upload"></i></a>&nbsp;';
							var this_peserta_url = peserta_url + '/' + data[index][0];
							if(this_peserta_url)
								tools += '<a class="btn btn-primary btn-peserta" href="' + this_peserta_url + '" title="Daftar Peserta"><i class="fa fa-users"></i></a>&nbsp;';
							*/
							$(this).append('<td class="action">' + tools + '</td>');
							
						} else {
							if ($(this).attr('role') == 'row') {
								$(this).append('<td class="head action"></td>');
							} else {
								$(this).append('<td class="action"></td>');
							}

						}
					}
				});
			}
		});

	}

});