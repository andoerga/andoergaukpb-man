$(document).ready(function(){
	
	var loaderHtml = '<div id="loaderOverlay" style="position:fixed; width:100%; height:100%; top:0; left:0; background:rgba(255, 255, 255, 0.6); z-index:2000;">';
	loaderHtml += '<div class="loader" style="position: fixed; width: 100%; height:100%; top:0; left:0; background:url(includes/img/ajax-loader.gif) center center no-repeat"></div>';
	loaderHtml += '</div>';
	$(loaderHtml).appendTo('body').hide();
	
	var dialogConfirmHtml = '<div id="dialog-confirm" title="Hapus peserta?">';
	dialogConfirmHtml += '<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Apakah anda yakin akan menghapus peserta ini?</p>';
	dialogConfirmHtml += '</div>';
	$(dialogConfirmHtml).appendTo('body').hide();
	
	$('#inputNamaPeserta').autocomplete({
		source: userMap,
		select: function(event, ui){
			$('#inputNamaPesertaId').val(ui.item.id);
			return true;
		}
	});
	
	$('.theForm').submit(function(){
		$('#loaderOverlay').fadeIn(300);
		var data = $(this).serialize();
		var url = $(this).attr('action');
		$.ajax({
			url: url,
			type: 'post',
			data: data,
			dataType: 'json',
			error: function(){
				alert('Fatal Error');
				$('#loaderOverlay').fadeOut(300);
			},
			success: function(response){
				
				if(!response.success){
					if(response.code == 'duplicate'){
						alert('Peserta sudah terdaftar');
					}else{
						alert('Terjadi kesalahan, silahkan coba lagi');
					}
					
				}else{
					/*
					<tr class="theRow" data-id="<?php echo $p->id; ?>">
								<td data-user-id="<?php echo $p->peserta_id; ?>"><?php echo $p->name; ?></td>
								<td data-jenis-peserta-id="<?php echo $p->jenis_peserta_id; ?>"><?php echo $p->jenis_peserta; ?></td>
								<td><button type="button" class="btn btn-sm btn-delete" data-peserta-id="<?php echo $p->peserta_id; ?>"><i class="fa fa-close"></i></button></td>
							</tr>
					*/
					var html = '<tr data-id="' + response.data.id + '">';
					html += '<td data-user-id="' + response.data.peserta_id + '">' + response.data.name + '</td>';
					html += '<td class="jenis-peserta" data-jenis-peserta-id="' + response.data.jenis_peserta_id + '" style="cursor:pointer;">' + response.data.jenis_peserta + '</td>';
					html += '<td><a class="btn btn-sm btn-primary btn-delete" type="button" data-peserta-id="'+ response.data.peserta_id +'"><i class="fa fa-close"></i></a></td>';
					html += '</tr>';
					$(html).appendTo('#tablePeserta');
				}
				
				$('#loaderOverlay').fadeOut(300);
			}
		});
		return false;
	});
	
	$('#tablePeserta').on('click', '.btn-delete', function(){
		var row = $(this).parent().parent();
		
		var peserta_id = $(this).data('peserta-id');
		var url = $('#tablePeserta').data('delete-url') + peserta_id;
		console.log(url);
		
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height: "auto",
			width: 400,
			modal: true,
			buttons: {
				"Hapus": function() {
					$('#loaderOverlay').fadeIn(300);
					$( this ).dialog( "close" );
					$.ajax({
						url: url,
						type: 'post',
						dataType: 'json',
						error: function(){
							alert('Fatal Error');
							$('#loaderOverlay').fadeOut(300);
						},
						success: function(response){
							if(!response.success){
								alert('Terjadi kesalahan, silahkan coba lagi');
							}else{
								row.remove();
							}
							$('#loaderOverlay').fadeOut(300);
						}
					});
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		
		return false;
	});
	
	var jenisPesertaCache = '';
	var jenisPesertaSelectActive = false;
	
	$('#tablePeserta').on('dblclick', '.jenis-peserta', function(){
		jenisPesertaSelectActive = true;
		var jenisPesertaCache = $(this).html();
		var val = $(this).data('jenis-peserta-id');
		var selectHtml = '<select name="jenis_peserta_id" class="form-control select-jenis-peserta" style="width:80%;">';
		selectHtml += jenisPeserta;
		selectHtml += '</select>';
		$(this).html('');
		$(selectHtml).appendTo(this).val(val).focus().blur(function(event){
			console.log('blur');
			$(this).parent().html(jenisPesertaCache);
			event.stopPropagation();
		});
	});
	
	$('#tablePeserta').on('change', '.select-jenis-peserta', function(){
		var td = $(this).parent();
		$('#loaderOverlay').fadeIn(300);
		var value = $(this).val();
		var id = $(this).parent().parent().data('id');
		var url = $('#tablePeserta').data('edit-url');
		$.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
			data: {
				id: id,
				value: value
			},
			error: function(){
				alert('Fatal Error');
				$('#loaderOverlay').fadeOut(300);
			},
			success: function(response){
				if(!response.success){
					alert('Terjadi kesalahan, silahkan coba lagi');
				}else{
					td.data('jenis-peserta-id', response.data.jenis_peserta_id).html(response.data.jenis_peserta);
				}
				$('#loaderOverlay').fadeOut(300);
			}
		});
	});
	
});