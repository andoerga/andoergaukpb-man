/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
	$('#change-category select').change(function(){
		var id = this.value
		var href = $(this).parent().attr('href') + id;
		window.location.href = href;
	});
});