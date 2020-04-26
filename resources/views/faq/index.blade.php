<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="msapplication-tap-highlight" content="no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" id="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/faq/css/weui.min.css" />
    <link rel="stylesheet" type="text/css" href="/faq/css/main.css" />
    <link rel="shortcut icon" type="image/x-icon" href="/faq/img/faviconfaq.ico" />
    <script type="text/javascript" src="/faq/js/zepto.min.js"></script>
    <title>常见问题</title>
</head>

<body class="bd bg" id="container">
    <div class="page" id="page">
        <div class="bd">
            <div class="weui_search_bar" id="search_bar">
                <form class="weui_search_outer">
                    <div class="weui_search_inner">
                        <i class="weui_icon_search"></i>
                        <input type="search" class="weui_search_input" id="search_input" placeholder="搜索" />
						<input type="hidden" class="weui_search_input" id="input_product_line" placeholder="" value="productLine" />
                        <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
                    </div>
                    <label for="search_input" class="weui_search_text" id="search_text">
                            <i class="weui_icon_search"></i> <span>搜索</span>
                        </label>
                </form>
                <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
            </div>

            <!-- 输入无效关键字确认后弹出跳转二维码扫描内容 -->
            <!-- dn = display:none -->
            <div id="no_use_key" class="no_use_key dn">
                未搜到与关键字相关问题<br/>请重新搜索或向我们<a href="/qyapp.php?s=/faq/index/attention_us">直接反馈</a>
            </div>

            <!-- 输入有效关键字自动补全弹出关键字相关问题 -->
            <div class="weui_cells weui_cells_access dn" id="search_show">

            </div>
        </div>
        <div id="box">
            <div class="weui_cells_title">问题分类</div>
            <div class="weui_grids" id="category_list">
                @foreach ($categories as $category)
				<a class="weui_grid @if($category->id == $id)active @endif" href="/faq/home?product_line={{ $line }}&faq_category_id={{ $category->id }}">
                    <div class="weui_grid_icon">
                        <img src="/faq/img/icon1.png">
                    </div>
                    <p class="weui_grid_label">{{ $category->faq_category_name }}</p>
                </a>             
                @endforeach
            </div>
            <!-- 列表 -->
            <div class="weui_cells weui_cells_access" id="faq_list">
                @foreach ($questions as $question)
                <a class="weui_cell " href="/faq/home/detail?faq_question_id={{ $question->id }}&product_line={{ $line }}">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p><span class="tip">{{ $question->questions }}</span></p>
                    </div>
                    <div class="weui_cell_ft"></div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function() {
        // 点击搜索，隐藏上面的absolute层
        $("#search_text").on("click", function() {
            $(this).addClass("dn");
            $("#box").addClass("dn")
            $("#search_cancel").css("display", "block")
        })

        // 点击取消，返回主页面
        $("#search_cancel").on("click", function() {
            $('#search_input').val("");
            $("#search_text").removeClass("dn");
            $("#box").removeClass("dn");
            $("#search_cancel").css("display", "none")
            $("#no_use_key").addClass("dn");
            $("#search_show").addClass("dn");
        })

        // 清空input
        $("#search_clear").on("click", function() {
            $('#search_input').val("");
            $("#search_show").empty("dn");
        })
        var timer = null;

        $('#search_input').bind('input', function() {
            clearTimeout(timer);
            timer = setTimeout(function() {
                // console.log(123)
                var _val = $('#search_input').val();
				var _product_line = $('#input_product_line').val();
                if (_val != '') {
                    $.ajax({
                        url: '/faq/api/search',
                        type: 'post',
                        // dataType: 'json',
                        data: {
                            product_line: _product_line,
                            value: _val
                        },
                        success: function(_d) {
                            // console.log(_d)
                            $("#no_use_key").addClass("dn");
                            $("#search_show").addClass("dn");
                            if (_d.rcode) {
                                $("#search_show").empty();
                                for (var i = 0; i < _d.data.length; i++) {
                                    var html = '<div class="weui_cell">' +
                                        '<div class="weui_cell_bd weui_cell_primary">' +
                                        '<a href="/qyapp.php?s=/faq/index/page_detail&faq_question_id=' + _d.data[i].faq_question_id + '&product_line=productLine' + '">' +
                                        '<p><i class="weui_icon_search"></i>' + _d.data[i].questions + '</p>' +
                                        '</a>' +
                                        '</div>' +
                                        '</div>'
                                    $("#search_show").append(html);
                                }
                                $("#search_show").removeClass("dn");
                            } else {
                                $("#no_use_key").removeClass("dn");
                            }
                        },
                        error: function(err) {
                            alert("接口请求失败");
                        }
                    });
                } else {
                    // 
                    $("#no_use_key").addClass("dn");
                    $("#search_show").addClass("dn");
                }

            }, 700)
        })


        $('#search_input').bind('keypress', function(event) {
            if (event.keyCode == "13") {
                // 对比是否有相关问题答案
                if ($(this).val() == "") {
                    $("#search_show").addClass("dn");
                    $("#no_use_key").removeClass("dn");

                } else {
                    $("#no_use_key").addClass("dn");
                    $("#search_show").removeClass("dn");

                }
                return false;
            }
        })
    })
</script>

</html>
