$.fn.dataHref = function(){
	$(this).click(function(){
		if($(this).closest('.disabled').length > 0){
			return false;
		}
		window.location.href = $(this).data('href');
	});
};