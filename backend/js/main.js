 $(function(){
	 
	 // popup
	$('.aj_close, .aj_success').click(function(){
		$('.black_back, .ajaxupload, .message_case').hide();
	});
	$('.image_upload').click(function(){
		$('.black_back, .ajaxupload').show();
		$('html, body').animate({scrollTop:0}, 500);
	});
	
 
 
 });
 //insert message
function messageModal(message) {
	$('.black_back, .message_case').show();
	$('.modal_message').html(message);
	$('html, body').animate({scrollTop:0}, 500);
}