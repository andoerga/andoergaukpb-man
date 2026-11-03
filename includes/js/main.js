$(function() {
	
	$('.sidebar-toggle').click(function(){
		if($('body').is('.sidebar-collapse')){
			document.cookie="sidebar_collapse=true";
		}else{
			document.cookie="sidebar_collapse=false";
		}
	});
	
	$('#tahun-anggaran').change(function(){
		$(this).parent().submit();
	});
	
});

var currentParam = false;
$(function () {
	if($('#example2').length){
		var search_row = '';
		$('#example2 thead .title').each(function(){
			search_row += '<td><input class="filter-field" type="text" placeholder="' + $(this).html() + '"></td>';
		});
		search_row += '<td></td>';
	
		theTable = $('#example2').DataTable({
			"paging": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"scrollCollapse": true,
			"fixedColumns": {
				leftColumns: 1,
				rightColumns: 1
			}
		});
		
		$('#example2 thead').append('<tr>'+search_row+'</tr>');
		
		var theColumns=new Array();
		theTable.columns().every(function(){
			theColumns.push(this);
		});
		var eventRun=false;
		$('#example2').on('keyup change','.filter-field',function(){
			var thisElement=this;
			if(eventRun){
				clearTimeout(eventRun);
			}
			eventRun=setTimeout(function(){
				theColumns[$(thisElement).parent().index()].search(thisElement.value).draw();
			},100);
		});
	}
	
	if($('#table-serverside').length){
		var colsname = new Array();
		var n=0;
		var search_row = '';
		$('#table-serverside thead .title').each(function(){
			colsname.push({
				name: $(this).attr('name'),
				targets: n++
			});
			search_row += '<td><input class="filter-field" type="text" placeholder="' + $(this).html() + '"></td>';
		});
		
		var ajaxUrl = $('#table-serverside').data('source-url');
		theTable = $('#table-serverside').DataTable({
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
		
		$('#table-serverside thead').append('<tr>'+search_row+'</tr>');
		
		var theColumns=new Array();
		theTable.columns().every(function(){
			theColumns.push(this);
		});
		var eventRun=false;
		$('#table-serverside').on('keyup change','.filter-field',function(){
			var thisElement=this;
			if(eventRun){
				clearTimeout(eventRun);
			}
			eventRun=setTimeout(function(){
				theColumns[$(thisElement).parent().index()].search(thisElement.value).draw();
			},100);
		});
		
		$('#table-serverside').on('draw.dt',function(e,settings){
			var element = this;
			var api=new $.fn.dataTable.Api(settings);
			var data=api.data();
			var url=$('#table-serverside').data('url');
			var detail_url=$('#table-serverside').data('detail-url');
			var edit_url=$('#table-serverside').data('edit-url');
			var delete_url=$('#table-serverside').data('delete-url');
			
			var param = api.ajax.params();
			param = $.param(param);
			currentParam = decodeURIComponent(param);
			console.log(param);
			
			if(data.length>0){
				$('tr',element).each(function(){
					var index=$(this).index();
					var haveAction=$('th.action',this);
					if(haveAction.length<1){
						if($(this).is('.odd')||$(this).is('.even')){
							var tools='';
							var this_detail_url=detail_url+'/'+data[index][0];
							if(this_detail_url)tools+='<a class="detail-button" href="'+this_detail_url+'" title="View Detail"><i class="fa fa-file"></i></a>&nbsp;&nbsp;&nbsp;';
							if(crud.edit_priv){
								var this_edit_url=edit_url+'/'+data[index][0];
								if(this_edit_url)tools+='<a class="edit-button" href="'+this_edit_url+'" title="Edit"><i class="fa fa-pencil-square-o"></i></a>&nbsp;&nbsp;&nbsp;';
							}
							if(crud.delete_priv){
								var this_delete_url=delete_url+'/'+data[index][0];
								if(this_delete_url)tools+='<a class="delete-button" href="'+this_delete_url+'" title="Delete"><i class="fa fa-trash"></i></a>&nbsp;&nbsp;&nbsp;';
							}
							$(this).append('<th class="action">'+tools+'</th>');
						}else{
							$(this).append('<th class="action"></th>');
						}
					}
				});
			}
		});
		
	}
	
	$('.btn-export-csv, .btn-export-pdf').click(function () {
		if (!currentParam)
			return false;
		var link = $(this).attr('href') + '?' + currentParam;
		window.open(link);
		return false;
	});
	
});

$('.crud .list-title').click(function(){
	if($(this).parent().parent().is('.active')){
		$(this).parent().parent().removeClass('active').addClass('unactive');
		$(this).siblings('.active-flag').val('unactive');
	}else{
		$(this).parent().parent().removeClass('unactive').addClass('active');
		$(this).siblings('.active-flag').val('active');
	}
});

if(tree){
	$('#tree-content').treeview({data: tree});
	$('#tree-content').on('click', 'a', function(){
		window.location.href = $(this).attr('href');
	});	
}