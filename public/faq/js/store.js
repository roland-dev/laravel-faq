$(function() {
	$(".am-store-sort-item").click(function() {
		$(".am-store-sort ul li").removeClass("active");
		$(this).addClass("active");
		if ($(this).hasClass("price") || $(this).hasClass("volume")) {
			if ($(this).hasClass("up")) {
				$(this).removeClass("up");
				$(this).addClass("down");
				$(this).find("img")[0].src = "image/order_pressed_down.png";
			} else if ($(this).hasClass("down"))  {
				$(this).removeClass("down");
				$(this).addClass("up");
				$(this).find("img")[0].src = "image/order_pressed_up.png";
			} else {
				$(".am-store-sort ul li img").attr("src", "image/order_default.png");
				$(".am-store-sort ul li").removeClass("up down");
				$(this).addClass("up");
				$(this).find("img")[0].src = "image/order_pressed_up.png";
			}
		} else {
			$(".am-store-sort ul li img").attr("src", "image/order_default.png");
			$(".am-store-sort ul li").removeClass("up down");
		}
	})
})
