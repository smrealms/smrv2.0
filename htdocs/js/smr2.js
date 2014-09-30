$(document).ready(function() {
    $('#menu_container').hover(function() {
        $(this).stop().animate({            
            width: '180px'}, 500); 
		$('#menu').css('visibility', 'visible');
        },function() {
        $(this).stop().animate({
            width: '25px'}, 500, function() {
				$('#menu').css('visibility', 'hidden');
			});
		});
});
