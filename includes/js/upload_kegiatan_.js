$(function(){
	
	$('#dialog').dialog({
		autoOpen: false
	});
	
	$('#files').on('click', '.btn-upload', function(){
		var title = $(this).data('title');
		var action = $(this).data('action');
		var type = $(this).data('type');
		var sequence = $(this).data('sequence');
		$('#upload').attr('action', action);
		$('#upload').data('type', type);
		$('#upload').data('sequence', sequence);
		$('#dialog').dialog({
			title: title
		}).dialog('open');
	});
	
	$('#files').on('click', 'span.editable', function(){
		var value = $(this).html();
		var type = $(this).data('type');
		var name = $(this).data('field-name');
		var id = $(this).data('id');
		var html = '<div class="row edit-field">';
		var href = $(this).data('href');
		if(type == 'textarea'){
			html += '<div class="col-xs-12"><textarea data-id="'+id+'" class="form-control" data-name="'+name+'">'+value+'</textarea></div>';
		}else{
			html += '<div class="col-xs-12"><input data-id="'+id+'" class="form-control" type="text" data-name="'+name+'" value="'+value+'" /></div>';
		}
		html += '<div class="col-xs-12 text-right"><button type="button" class="cancel btn btn-warning">batal</button><button type="button" class="submit btn btn-primary" data-href="'+href+'">simpan</button></div>';
		html += '</div>';
		$(this).hide();
		$(html).appendTo($(this).parent()).find('.form-control').focus();
		//$(this).parent().append(html);
	});
	$('#files').on('click', '.cancel', function(){
		$(this).parent().parent().parent().find('span.editable').show();
		$(this).parent().parent().remove();
	});
	$('#files').on('click', '.submit', function(){
		var value = $(this).parent().parent().find('.form-control').val();
		var field_name = $(this).parent().parent().find('.form-control').data('name');
		var id = $(this).parent().parent().find('.form-control').data('id');
		var href = $(this).data('href');
		var formControl = $(this).parent().parent().find('.form-control');
		$.ajax({
			url: href,
			method: 'post',
			dataType: 'json',
			data: {
				value: value
			},
			error: function(){
				formControl.parent().parent().parent().find('span.editable').show();
				formControl.parent().parent().remove();
			},
			success: function(response){
				if(response.success){
					formControl.parent().parent().parent().find('span.editable').html(value).show();
				}else{
					formControl.parent().parent().parent().find('span.editable').show();
				}
				
				formControl.parent().parent().remove();
			}
		});
	});
	$('#files').on('click', '.publish', function(){
		var value = 'published';
		var href = $(this).data('href');
		var element = $(this);
		$.ajax({
			url: href,
			method: 'post',
			dataType: 'json',
			data: {
				value: value
			},
			error: function(){
				
			},
			success: function(response){
				if(response.success){
					element.removeClass('publish').addClass('unpublish');
					element.removeClass('btn-danger').addClass('btn-success');
					element.attr('title', 'Non Aktifkan');
					element.html('Aktif');
				}
			}
		});
	});
	$('#files').on('click', '.unpublish', function(){
		var value = 'unpublished';
		var href = $(this).data('href');
		var element = $(this);
		$.ajax({
			url: href,
			method: 'post',
			dataType: 'json',
			data: {
				value: value
			},
			error: function(){
				
			},
			success: function(response){
				if(response.success){
					element.removeClass('unpublish').addClass('publish');
					element.removeClass('btn-success').addClass('btn-danger');
					element.attr('title', 'Aktifkan');
					element.html('Tidak Aktif');
				}
			}
		});
	});
	$('#files').on('click', '.btn-remove-file', function(){
		var href = $(this).data('href');
		var element = $(this);
		$.ajax({
			url: href,
			method: 'post',
			dataType: 'json',
			error: function(){
				
			},
			success: function(response){
				if(response.success){
					element.parent().parent().hide(200, function(){
						$(this).remove();
					});
				}
			}
		});
	});
});

/* Upload Script */
$(function(){
	
	$('.btn-add-file').click(function(){
		var count = $('#files .file').length;
		var source = $(this).data('source');
		var html = '<div class="form-group row file">';
		html += '<div class="col-xs-12 col-sm-6 col-md-4">';
		html += '<label for="inputName">File '+ (count+1) +'</label>';
		html += '</div>';
		html += '<div class="col-xs-12 col-sm-6 col-md-4">';
		html += '<span class="upload_status upload_file">'
		html += '<i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen<br />';
		html += '</span>';
		html += '<br /><button class="btn btn-primary btn-upload" data-action="' + source +'" data-sequence="'+ count +'" data-type="design" data-title="Upload File">Upload</button>';
		html += '</div>';
		html += '</div>';
		$('#files .title').remove();
		$('#files').append(html);
	});

    //var ul = $('#upload ul');
    var ul = $('#files');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
	var regExp = /(\.|\/)(gif|jpe?g|png)$/i;
	
    $('#upload').attr('data-accept-file-types', regExp.toString())
		.fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),
		previewFileTypes: /none/,

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
			/*
			<div class="col-xs-4 col-sm-4 col-md-4">
								<span data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/title'); ?>" data-field-name="title" data-id="<?php echo $component->id; ?>" data-type="text" class="editable"><?php echo $component->title; ?></span>
							</div>
							<div class="col-xs-4 col-sm-4 col-md-4">
								<span data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/description'); ?>" data-field-name="description" data-id="<?php echo $component->id; ?>" data-type="textarea" class="editable description"><?php echo $component->description ? $component->description : "Keterangan"; ?></span>
							</div>
							<div class="col-xs-4 col-sm-2 col-md-2">
								<?php if($component->status == 'published'){ ?>
									<button class="btn btn-success btn-xs unpublish" title="Non Aktifkan" data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/status'); ?>">Aktif</button>
								<?php }else{ ?>
									<button class="btn btn-danger btn-xs publish" title="Aktifkan" data-href="<?php echo site_url($module . '/update_component/' . $component->id . '/status'); ?>">Tidak Aktif</button>
								<?php } ?>
							</div>
							<div class="col-xs-4 col-sm-2 col-md-2">
								<a class="btn btn-xs btn-rounded btn-primary" role="button" href="<?php echo $component->source; ?>" target="_blank"><i class="fa fa-download" title="Unduh File"></i></a>
								<a class="btn btn-xs btn-rounded btn-primary btn-remove-file" data-id="<?php echo $component->id; ?>" role="button"><i class="fa fa-close" title="Hapus File"></i></a>
							</div>
							*/
			var html = '<div class="form-group row file working">';
			html += '<div class="col-xs-4 col-sm-6 col-md-4">';
			html += '<span class="title"></span>';
			html += '</div>';
			html += '<div class="col-xs-4 col-sm-6 col-md-4">';
			html += '<span class="description">Keterangan</span>';
			html += '</div>';
			if(special_user){
			html += '<div class="col-xs-4 col-sm-6 col-md-2 publish-container">';
			html += '';
			html += '</div>';
			}
			html += '<div class="col-xs-4 col-sm-4 col-md-2 tools">';
			html += '<input type="text" value="0" data-width="48" data-height="48" data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" />';
			html += '<button class="btn btn-danger btn-xs btn-cancel">batal</button>';
			//html += '<a class="btn btn-sm btn-rounded btn-primary btn-remove-file" data-id="" href="" role="button"><i class="fa fa-close" title="Hapus File"></i></a>';
			html += '</div>';
			html += '</div>';
			var tpl = $(html);
			/*
            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
			*/
            // Append the file name and file size
			tpl.find('.title').text(data.files[0].name);
			/*
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
			*/

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
			
            tpl.find('button.btn-cancel').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        },
		
		done: function (e, data) {
			$('#dialog').dialog('close');
			/*
			var type = $("#upload").data('type');
			var sequence = $("#upload").data('sequence');
			var result = $.parseJSON(data.result);
			console.log($('#files').find('.file').eq(sequence).find('.upload_status').html());
			$('#files').find('.file').eq(sequence).find('.upload_status').html('<i class="fa fa-check"></i>&nbsp;<a href="'+result.path+'" target="_blank">Download</a><br />');
			*/
			var result = $.parseJSON(data.result);
			var html = '<a class="btn btn-sm btn-rounded btn-primary btn-remove-file" data-id="'+ result.id +'" href="" role="button"><i class="fa fa-close" title="Hapus File"></i></a>';
			if(result.status == 'success'){
				var publishButton = '<button class="btn btn-danger btn-xs publish" title="Aktifkan" data-href="'+result.href+'status">Tidak Aktif</button>';
				var downloadButton = '<a class="btn btn-xs btn-rounded btn-primary" role="button" href="'+result.path+'" target="_blank"><i class="fa fa-download" title="Unduh File"></i></a>';
				var removeButton = '<button class="btn btn-xs btn-rounded btn-primary btn-remove-file" data-id="'+ result.id +'" data-href="'+result.remove_link+'" role="button"><i class="fa fa-close" title="Hapus File"></i></button>';
				data.context.find('.title').attr('data-href', result.href+'title').attr('data-type', 'text').attr('data-id', result.id);
				data.context.find('.description').addClass('editable').attr('data-href', result.href+'description').attr('data-type', 'textarea').attr('data-id', result.id);
				if(special_user){
				data.context.find('.publish-container').html(publishButton);
				}
				if(special_user || status_berita == 'belum diperiksa'){
					data.context.find('.tools').html(downloadButton + '&nbsp;' + removeButton);
				}else{
					data.context.find('.tools').html(downloadButton);
				}
				
			}else{
				data.context.find('.tools').html('Upload Error');
			}
		}

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});