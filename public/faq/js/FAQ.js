$(function() {
	$(".am-item .hd").click(function() {
		var li = $(this).parent();
		if ( $(li).hasClass("active") ) {
			$(li).removeClass("active");
		} else {
			$(li).addClass("active");
		}
	})
})
