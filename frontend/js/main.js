$(function(){
	 // popup
	$('.aj_close, .aj_success').click(function(){
		$('.black_back, .ajaxupload, .message_case').hide();
	});
	$('.image_upload').click(function(){
		$('.black_back, .ajaxupload').show();
		$('html, body').animate({scrollTop:0}, 500);
	});
	
    /*
    * left menu slideToggle
    */
    $('.arrowCase').toggle(
    	function(){
    		$(this).parent().addClass('leftMenuDown');
    		$(this).parent().next('ul').slideDown();
    	},
    	function(){
    		$(this).parent().removeClass('leftMenuDown');
    		$(this).parent().next('ul').slideUp();
    	}
    );
    /*
    * end menu slide
    */

    // scroll header
    $(window).scroll(function () {
        var scrollHeight = $('body, html').scrollTop();
        var scrollWebkitHeight = $('body').scrollTop();
        
        if (scrollWebkitHeight > 700 || scrollHeight > 700 ) {
            $('.scrollTopButton').fadeIn();
        }
        else {
            $('.scrollTopButton').fadeOut();
        }
    });
    // top scroll
    $('.scrollTopButton').click(function(){
        $('html,body').animate({scrollTop:0}, 1000);
    });

});

//insert message
function messageModal(message) {
	$('.black_back, .message_case').show();
	$('.modal_message').html(message);
	$('html, body').animate({scrollTop:0}, 500);
}









