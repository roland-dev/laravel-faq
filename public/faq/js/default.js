$(function(){
	$("#scrollNav").scroll(function(){
        var w = $(this).innerWidth();
        var sw = $(this)[0].scrollWidth;//滚动的高度，$(this)指代jQuery对象，而$(this)[0]指代的是dom节点
        var sl =$(this)[0].scrollLeft;//滚动条的高度，即滚动条的当前位置到div顶部的距离
        if ( sl > 0 ) {
        	$(".left-cover").css("display", "block");
        } else {
        	$(".left-cover").css("display", "none");
        }
        if(w+sl>=sw){
        //上面的代码是判断滚动条滑到底部的代码
            $(".right-cover").css("display", "none");
        } else {
        	$(".right-cover").css("display", "block");
        }
    });
    
    $("#scrollNav ul li").click(function() {
    		$("#scrollNav ul li").removeClass("active");
    		$(this).addClass("active");
    })
})
