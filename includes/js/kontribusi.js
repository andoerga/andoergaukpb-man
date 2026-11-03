$(document).ready(function(){
	var fire = false;
	var gettingContent = false;
	
	var offset = 0;
	
	getContent();
	
	$(window).scroll(function(){
		if(fire){
			clearTimeout(fire);
		}
		fire = setTimeout(afterScroll, 200);
	});
	
	function afterScroll(){
		var scrollTop = $(window).scrollTop();
		var documentHeight = $(document).height();
		var windowHeight = $(window).height();
		
		if(scrollTop >= (documentHeight - windowHeight) * 0.7){
			getContent();
		}
	}
	
	function getContent(){
		offset = $('#hasil-kontribusi').find('.data-kontribusi').length;
		if(!gettingContent){
			gettingContent = true;
			$.ajax({
				url: 'kontribusi/ajax',
				type: 'get',
				dataType: 'json',
				data: {
					offset: offset
				},
				error: function(){
					gettingContent = false;
				},
				success: function(data){
					var hasil = data.data;
					var page = Math.floor(offset/4);
					var n = 0;
					$.each(hasil, function(index, value){
						n++;
						if(n%4 == 1){
							page++;
							$('#kontribusi-plate').append('<div class="row plate-'+page+'"></div>');
						}
						var html = '';
						html += '<div class="col-xs-12 col-sm-6 col-md-3 data-kontribusi" style="display:none">';
						html += '<div class="box box-success">';
						html += '<div class="box-header row">';
						html += '<div class="col-xs-12">';
						html += '<h3><a href="' + value.url + '">' + value.title + '</a></h3>';
						html += '<p>' + value.user_name + '</p>';
						html += '<p>' + value.division_name + '</p>';
						html += '<p>' + value.date + '</p>';
						html += '</div>';
						html += '</div>';
						html += '<div class="box-body row">';
						html += '<div class="col-xs-6 col-sm-12">';
						html += '<img src="' + value.image + '" class="img img-responsive img-thumbnail" />';
						html += '</div>';
						html += '<div class="col-xs-12 text-right">';
						html += '<br />';
						html += '<a href="' + value.url + '" class="btn btn-sm btn-primary">Detail</a>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						html += '</div>';
						$(html).appendTo('#kontribusi-plate .plate-'+page+'').delay(n*200).fadeIn(500);
					});
					gettingContent = false;
				}
			});
		}
	}
});