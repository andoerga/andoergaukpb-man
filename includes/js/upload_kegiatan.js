$(function(){
	
	$('#dialog').dialog({
		autoOpen: false
	});
	$('#data-detail').on('click', '.remove-document', function(){
		var url = $(this).data('action');
		var type = $(this).data('type');
		$.ajax({
			url: url,
			dataType: 'json',
			type: 'get',
			error: function(){
				alert('terjadi kesalahan, silahkan ulangi beberapa saat lagi');
			},
			success: function(response){
				if(response.status){
					alert('dokumen berhasil dihapus');
					$('.upload_status.'+type).html('<span class="label label-danger"><i class="fa fa-close"></i>&nbsp;Tidak Ada Dokumen</span><br />');
				}else{
					alert('dokumen gagal dihapus');
				}
			}
		});
		return false;
	});
	
	$('.btn-upload').click(function(){
		var title = $(this).data('title');
		var action = $(this).data('action');
		var type = $(this).data('type');
		$('#upload').attr('action', action);
		$('#upload').data('type', type);
		$('#dialog').dialog({
			title: title
		}).dialog('open');
	});
	
});

/* Upload Script */
$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

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
			var type = $("#upload").data('type');
			var result = $.parseJSON(data.result);
			$('.upload_status.'+type).html('<span class="label label-success"><i class="fa fa-check"></i> Dokumen tersedia</span>&nbsp;<a class="btn btn-xs btn-info" href="'+result.path+'" target="_blank"><span class="fa fa-download"></span></a>&nbsp;<button class="btn btn-danger btn-xs remove-document" data-action="'+result.removeLink+'" data-type="'+result.type+'" title="Hapus Dokumen"><span class="fa fa-trash"></span></button><br />');
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