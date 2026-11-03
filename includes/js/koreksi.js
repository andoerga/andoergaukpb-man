var currentIndex = 0;
var count;
var data;
$('#doProcess').click(function(){
	$('#target-area').html('');
	currentIndex = 0;
	$.ajax({
		url: getIdUrl,
		type: 'get',
		dataType: 'json',
		error: function(xhr, text){
			writing(' Error ' + text);
		},
		success: function(response){
			if(response.success){
				data = response.data;
				count = response.data.length;
				processing(data[currentIndex]);
			}
		}
		
	});
});

function processing(thisData){
	console.log(thisData);
	$.ajax({
		url: processingUrl + thisData.id,
		type: 'get',
		dataType: 'json',
		error: function(xhr, text){
			writing(thisData.nama + ', ' + thisData.nama_ujian + ' Error ' + text);
		},
		success: function(response){
			if(response.success){
				writing(thisData.nama + ', ' + thisData.nama_ujian + ' Nilai = ' + response.data.nilai)
			}else{
				
			}
			currentIndex++;
			if(currentIndex < count){
				processing(data[currentIndex]);
			}
		}
	});
}

function writing(message){
	$('#target-area').prepend('<p>' + message + '</p>');
}