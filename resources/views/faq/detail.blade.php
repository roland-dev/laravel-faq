<html>

<head>
    <meta charset="utf-8">
    <meta name="msapplication-tap-highlight" content="no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" id="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">
    <link rel="stylesheet" type="text/css" href="/faq/css/weui.min.css">
    <link rel="stylesheet" type="text/css" href="/faq/css/main.css">
    <link rel="shortcut icon" type="image/x-icon" href="/faq/img/faviconfaq.ico" />
    <script type="text/javascript" src="/faq/js/zepto.min.js"></script>
    <title>
        {{ $questions }}
    </title>
    <input type="hidden" class="weui_search_input" id="input_product_line" placeholder="" value="{{ $line }}" />
</head>

<body class="bd bg" id="container">
    <div class="page" id="page">
        <div class="detail-box">
            <h2 class="pub_title">{{ $questions }}</h2>
            <div class="pub_content">
                <div class="content">
                    <p>
                        {!! $answers !!}
                    </p>
                </div>
            </div>
            <div class="problem">
                <div class="result wx" id="result">
                    <a href="javascript:void(0)" class="solve" value="{{ $id }}"><i class="icon_good"></i>已解决<span id="solvelike">{{ $resolvetimes }}</span></a>
                    <a href="javascript:void(0)" class="nosolve" value="{{ $id }}"><i class="icon_bad"></i>未解决<span id="unsolvelike">{{ $unresolvetimes }}</span></a>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    var _product_line = $('#input_product_line').val();
    $(".solve").on("click", function() {
        var _val = this.getAttribute("value");
        if (!$(this).hasClass("cur") && !$('.nosolve').hasClass("cur")) {
            $(this).addClass("cur");
            $('.nosolve').removeClass("cur");
            $.ajax({
                url: '/api/faq/solve',
                type: 'post',
                dataType: 'json',
                data: {
                    product_line: {{$line}},
                    faq_question_id: _val,
                    like: 'solve'
                },
                success: function(_d) {
                    if (_d.code == 0) {
                        // console.log(_d.data);
                        $('#solvelike').html(_d.data.times);
                    }
                },
                error: function(err) {
                    alert("接口请求失败");
                }
            });
        }
    });
    $(".nosolve").on("click", function() {
        if (!$(this).hasClass("cur") && !$('.solve').hasClass("cur")) {
            var _val = this.getAttribute("value");
            $(this).addClass("cur");
            $('.solve').removeClass("cur");
            $.ajax({
                url: '/api/faq/solve',
                type: 'post',
                dataType: 'json',
                data: {
                    product_line: {{$line}},
                    faq_question_id: _val,
                    like: 'unsolve'
                },
                success: function(_d) {
                    if (_d.code == 0) {
                        $('#unsolvelike').html(_d.data.times);
                    }
                },
                error: function(err) {
                    alert("接口请求失败");
                }
            });
        }
    });
</script>

</html>
