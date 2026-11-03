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
		var html = '<div id="theModal" class="modal modal-info">';
		html += '<div class="modal-dialog">';
		html += '<div class="modal-content">';
		html += '<div class="modal-header">';
		html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
		html += '<span aria-hidden="true">×</span></button>';
		html += '<h4 class="modal-title">Dokumen</h4>';
		html += '</div>';
		html += '<div class="modal-body">';
		html += '</div>';
		html += '<div class="modal-footer">';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		html += '</div>';
		$('body').append(html);
		
		$('body').on('click', '.view-file', function(){
			var targetFile = $(this).data('target');
			var title = $(this).data('title');
			var embedTag = '<embed src="' + targetFile + '" style="outline-style: solid; width:100%; height: 70vh;" type="application/pdf" />';
			
			$('#theModal .modal-title').html(title);
			$('#theModal .modal-body').html(embedTag);
			$('#theModal').modal('show');
		});
		$('body').on('click', '.btn-process', function(){
			var thisProcessUrl = $(this).data('href');
			var formData = $('#verificationForm').serialize();
			$(disabler).appendTo('body').fadeTo(200, 0.3, function(){
				var thisDisabler = this;
				$.ajax({
					url: thisProcessUrl,
					type: 'post',
					dataType: 'json',
					data: formData,
					error: function(){
						
					},
					success: function(response){
						if(response.success){
							alert('Berhasil');
							$('#view-page').fadeOut(200, function(){
								$('.wrapper').fadeIn(500);
								$(this).remove();
							});
						}else{
							alert('Gagal. ' + response.message);
						}
						table.ajax.reload();
						$(thisDisabler).fadeOut(200, function(){
							
							$(this).remove();
						});
					}
				});
			});
			return false;
		});
		
		$('#table-kegiatan_wrapper').on('click', '.view-data', function(){
			var idPeserta = $(this).data('id');
			var viewPage = '<div id="view-page"><a class="btn btn-primary btn-delete close-page" href="javascript:void(0)" title="Tutup"><i class="fa fa-remove"></i></a><div class="container"></div></div>';
			var moduleUrl = $('#table-kegiatan').data('module-url');
			$('.wrapper').fadeOut(500);
			$(viewPage).css({
				'position': 'fixed',
				'display': 'none',
				'width': '100vw',
				'height': '100vh',
				'padding': '20px 0px 20px 0px',
				'overflow': 'auto',
				'top':'0px',
				'left':'0px',
				'background':'#fff',
				'z-index':'2000'
			}).appendTo('body').fadeIn(500, function(){
				$.ajax({
					url: moduleUrl + '/detail_ajax/' + idPeserta,
					type: 'post',
					dataType: 'html',
					error: function(){
						
					},
					success: function(response){
						$('#view-page .container').html(response);
					}
				});
			});
		});
		$('body').on('click', '.close-page', function() {
			$('#view-page').fadeOut(500, function(){
				$('.wrapper').fadeIn(500);
				$(this).remove();
			});
			return false;
		});
		
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
						tools += '<a class="btn btn-primary btn-edit view-data" data-id="' + data[index][0] + '" href="javascript:void(0)" title="Lihat Data"><i class="fa fa-file"></i></a>&nbsp;';
							if (crud.edit_priv) {
								var this_accept_url = process_url + '/accept/' + data[index][0];
								var this_reject_url = process_url + '/reject/' + data[index][0];
								if (this_reject_url) {
									tools += '<a class="btn btn-primary btn-delete btn-process" data-action-after="close" data-href="' + this_reject_url + '" href="#" title="Tolak"><i class="fa fa-remove"></i></a>&nbsp;';
								}
								if (this_accept_url) {
									tools += '<a class="btn btn-primary btn-detail btn-process" data-action-after="close" data-href="' + this_accept_url + '" href="#" title="Terima"><i class="fa fa-check"></i></a>&nbsp;';
								}
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