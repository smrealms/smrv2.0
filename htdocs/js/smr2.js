$(document).ready(function() {
    $('#menu_container').hover(function() {
        $(this).stop().animate({            
            width: '180px'}, 500);            
        },function() {
        $(this).stop().animate({
            width: '25'}, 500);
		});
});
