<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="msapplication-tap-highlight" content="no">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no,email=no" name="format-detection">
    <meta name="viewport" id="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/static/faq/css/weui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/faq/css/main.css" />
    <link rel="shortcut icon" type="image/x-icon" href="/static/faq/img/faviconfaq.ico" />
    <script type="text/javascript" src="/static/faq/js/zepto.min.js"></script>
    <title>
        <?php echo $categoryname['faq_category_name'] ?>
    </title>
</head>

<body class="bd bg" id="container">
    <div class="page" id="page">
        <div class="bd">
            <div class="weui_search_bar" id="search_bar">
                <form class="weui_search_outer">
                    <div class="weui_search_inner">
                        <i class="weui_icon_search"></i>
                        <input type="search" class="weui_search_input" id="search_input" placeholder="搜索" />
                        <input type="hidden" class="weui_search_input" id="input_product_line" placeholder="" value="<?php echo $productLine?>" />
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
                <?php
                    if(!empty($categoryList)){
                        foreach($categoryList as $val){
                ?>
				<a class="weui_grid" href="/qyapp.php?s=/faq/index/questions_list&faq_category_id=<?php echo $val['category_id']?>&product_line=<?php echo $productLine?>">
                    <div class="weui_grid_icon">
                        <img src="/static/faq/img/icon<?php echo $val['category_id']?>.png">
                    </div>
                    <p class="weui_grid_label"><?php echo $val['faq_category_name']?></p>
                </a>             
                <?php
                        }
                    }   
                ?>
           </div>
            <!-- 列表 -->
            <div class="weui_cells weui_cells_access" id="faq-list">
                <?php
                    foreach($categorymsg as $key => $val){
                 ?>
                    <a class="weui_cell" href="/qyapp.php?s=/faq/index/page_detail&faq_question_id=<?php echo $val['faq_question_id'] ?>&product_line=<?php echo $productLine ?>">
                        <div class="weui_cell_bd weui_cell_primary">
                            <p>
                                <?php echo $val['item'].$val['questions'] ?>
                            </p>
                        </div>
                        <div class="weui_cell_ft"></div>
                    </a>

                    <?php
                           }
                ?>
            </div>
        </div>
    </div>
	<script type="text/javascript" id="jweixinjs">
        ! function(a, b) {
            "function" == typeof define && (define.amd || define.cmd) ? define(function() {
                return b(a)
            }) : b(a, !0)
        }(this, function(a, b) {
            function c(b, c, d) {
                a.WeixinJSBridge ? WeixinJSBridge.invoke(b, e(c), function(a) {
                    g(b, a, d)
                }) : j(b, d)
            }

            function d(b, c, d) {
                a.WeixinJSBridge ? WeixinJSBridge.on(b, function(a) {
                    d && d.trigger && d.trigger(a), g(b, a, c)
                }) : d ? j(b, d) : j(b, c)
            }

            function e(a) {
                return a = a || {}, a.appId = E.appId, a.verifyAppId = E.appId, a.verifySignType = "sha1", a.verifyTimestamp = E.timestamp + "", a.verifyNonceStr = E.nonceStr, a.verifySignature = E.signature, a
            }

            function f(a) {
                return {
                    timeStamp: a.timestamp + "",
                    nonceStr: a.nonceStr,
                    "package": a.package,
                    paySign: a.paySign,
                    signType: a.signType || "SHA1"
                }
            }

            function g(a, b, c) {
                var d, e, f;
                switch (delete b.err_code, delete b.err_desc, delete b.err_detail, d = b.errMsg, d || (d = b.err_msg, delete b.err_msg, d = h(a, d), b.errMsg = d), c = c || {}, c._complete && (c._complete(b), delete c._complete), d = b.errMsg || "", E.debug && !c.isInnerInvoke && alert(JSON.stringify(b)), e = d.indexOf(":"), f = d.substring(e + 1)) {
                    case "ok":
                        c.success && c.success(b);
                        break;
                    case "cancel":
                        c.cancel && c.cancel(b);
                        break;
                    default:
                        c.fail && c.fail(b)
                }
                c.complete && c.complete(b)
            }

            function h(a, b) {
                var e, f, c = a,
                    d = p[c];
                return d && (c = d), e = "ok", b && (f = b.indexOf(":"), e = b.substring(f + 1), "confirm" == e && (e = "ok"), "failed" == e && (e = "fail"), -1 != e.indexOf("failed_") && (e = e.substring(7)), -1 != e.indexOf("fail_") && (e = e.substring(5)), e = e.replace(/_/g, " "), e = e.toLowerCase(), ("access denied" == e || "no permission to execute" == e) && (e = "permission denied"), "config" == c && "function not exist" == e && (e = "ok"), "" == e && (e = "fail")), b = c + ":" + e
            }

            function i(a) {
                var b, c, d, e;
                if (a) {
                    for (b = 0, c = a.length; c > b; ++b) d = a[b], e = o[d], e && (a[b] = e);
                    return a
                }
            }

            function j(a, b) {
                if (!(!E.debug || b && b.isInnerInvoke)) {
                    var c = p[a];
                    c && (a = c), b && b._complete && delete b._complete, console.log('"' + a + '",', b || "")
                }
            }

            function k() {
                0 != D.preVerifyState && (u || v || E.debug || "6.0.2" > z || D.systemType < 0 || A || (A = !0, D.appId = E.appId, D.initTime = C.initEndTime - C.initStartTime, D.preVerifyTime = C.preVerifyEndTime - C.preVerifyStartTime, H.getNetworkType({
                    isInnerInvoke: !0,
                    success: function(a) {
                        var b, c;
                        D.networkType = a.networkType, b = "http://open.weixin.qq.com/sdk/report?v=" + D.version + "&o=" + D.preVerifyState + "&s=" + D.systemType + "&c=" + D.clientVersion + "&a=" + D.appId + "&n=" + D.networkType + "&i=" + D.initTime + "&p=" + D.preVerifyTime + "&u=" + D.url, c = new Image, c.src = b
                    }
                })))
            }

            function l() {
                return (new Date).getTime()
            }

            function m(b) {
                w && (a.WeixinJSBridge ? b() : q.addEventListener && q.addEventListener("WeixinJSBridgeReady", b, !1))
            }

            function n() {
                H.invoke || (H.invoke = function(b, c, d) {
                    a.WeixinJSBridge && WeixinJSBridge.invoke(b, e(c), d)
                }, H.on = function(b, c) {
                    a.WeixinJSBridge && WeixinJSBridge.on(b, c)
                })
            }
            var o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H;
            if (!a.jWeixin) return o = {
                config: "preVerifyJSAPI",
                onMenuShareTimeline: "menu:share:timeline",
                onMenuShareAppMessage: "menu:share:appmessage",
                onMenuShareQQ: "menu:share:qq",
                onMenuShareWeibo: "menu:share:weiboApp",
                onMenuShareQZone: "menu:share:QZone",
                previewImage: "imagePreview",
                getLocation: "geoLocation",
                openProductSpecificView: "openProductViewWithPid",
                addCard: "batchAddCard",
                openCard: "batchViewCard",
                chooseWXPay: "getBrandWCPayRequest"
            }, p = function() {
                var b, a = {};
                for (b in o) a[o[b]] = b;
                return a
            }(), q = a.document, r = q.title, s = navigator.userAgent.toLowerCase(), t = navigator.platform.toLowerCase(), u = !(!t.match("mac") && !t.match("win")), v = -1 != s.indexOf("wxdebugger"), w = -1 != s.indexOf("micromessenger"), x = -1 != s.indexOf("android"), y = -1 != s.indexOf("iphone") || -1 != s.indexOf("ipad"), z = function() {
                var a = s.match(/micromessenger\/(\d+\.\d+\.\d+)/) || s.match(/micromessenger\/(\d+\.\d+)/);
                return a ? a[1] : ""
            }(), A = !1, B = !1, C = {
                initStartTime: l(),
                initEndTime: 0,
                preVerifyStartTime: 0,
                preVerifyEndTime: 0
            }, D = {
                version: 1,
                appId: "",
                initTime: 0,
                preVerifyTime: 0,
                networkType: "",
                preVerifyState: 1,
                systemType: y ? 1 : x ? 2 : -1,
                clientVersion: z,
                url: encodeURIComponent(location.href)
            }, E = {}, F = {
                _completes: []
            }, G = {
                state: 0,
                data: {}
            }, m(function() {
                C.initEndTime = l()
            }), H = {
                config: function(a) {
                    E = a, j("config", a);
                    var b = E.check === !1 ? !1 : !0;
                    m(function() {
                        var a, d, e;
                        if (b) c(o.config, {
                            verifyJsApiList: i(E.jsApiList)
                        }, function() {
                            F._complete = function(a) {
                                C.preVerifyEndTime = l(), G.state = 1, G.data = a
                            }, F.success = function() {
                                D.preVerifyState = 0
                            }, F.fail = function(a) {
                                F._fail ? F._fail(a) : G.state = -1
                            };
                            var a = F._completes;
                            return a.push(function() {
                                k()
                            }), F.complete = function() {
                                for (var c = 0, d = a.length; d > c; ++c) a[c]();
                                F._completes = []
                            }, F
                        }()), C.preVerifyStartTime = l();
                        else {
                            for (G.state = 1, a = F._completes, d = 0, e = a.length; e > d; ++d) a[d]();
                            F._completes = []
                        }
                    }), E.beta && n()
                },
                ready: function(a) {
                    0 != G.state ? a() : (F._completes.push(a), !w && E.debug && a())
                },
                error: function(a) {
                    "6.0.2" > z || B || (B = !0, -1 == G.state ? a(G.data) : F._fail = a)
                },
                checkJsApi: function(a) {
                    var b = function(a) {
                        var c, d, b = a.checkResult;
                        for (c in b) d = p[c], d && (b[d] = b[c], delete b[c]);
                        return a
                    };
                    c("checkJsApi", {
                        jsApiList: i(a.jsApiList)
                    }, function() {
                        return a._complete = function(a) {
                            if (x) {
                                var c = a.checkResult;
                                c && (a.checkResult = JSON.parse(c))
                            }
                            a = b(a)
                        }, a
                    }())
                },
                onMenuShareTimeline: function(a) {
                    d(o.onMenuShareTimeline, {
                        complete: function() {
                            c("shareTimeline", {
                                title: a.title || r,
                                desc: a.title || r,
                                img_url: a.imgUrl || "",
                                link: a.link || location.href,
                                type: a.type || "link",
                                data_url: a.dataUrl || ""
                            }, a)
                        }
                    }, a)
                },
                onMenuShareAppMessage: function(a) {
                    d(o.onMenuShareAppMessage, {
                        complete: function() {
                            c("sendAppMessage", {
                                title: a.title || r,
                                desc: a.desc || "",
                                link: a.link || location.href,
                                img_url: a.imgUrl || "",
                                type: a.type || "link",
                                data_url: a.dataUrl || ""
                            }, a)
                        }
                    }, a)
                },
                onMenuShareQQ: function(a) {
                    d(o.onMenuShareQQ, {
                        complete: function() {
                            c("shareQQ", {
                                title: a.title || r,
                                desc: a.desc || "",
                                img_url: a.imgUrl || "",
                                link: a.link || location.href
                            }, a)
                        }
                    }, a)
                },
                onMenuShareWeibo: function(a) {
                    d(o.onMenuShareWeibo, {
                        complete: function() {
                            c("shareWeiboApp", {
                                title: a.title || r,
                                desc: a.desc || "",
                                img_url: a.imgUrl || "",
                                link: a.link || location.href
                            }, a)
                        }
                    }, a)
                },
                onMenuShareQZone: function(a) {
                    d(o.onMenuShareQZone, {
                        complete: function() {
                            c("shareQZone", {
                                title: a.title || r,
                                desc: a.desc || "",
                                img_url: a.imgUrl || "",
                                link: a.link || location.href
                            }, a)
                        }
                    }, a)
                },
                startRecord: function(a) {
                    c("startRecord", {}, a)
                },
                stopRecord: function(a) {
                    c("stopRecord", {}, a)
                },
                onVoiceRecordEnd: function(a) {
                    d("onVoiceRecordEnd", a)
                },
                playVoice: function(a) {
                    c("playVoice", {
                        localId: a.localId
                    }, a)
                },
                pauseVoice: function(a) {
                    c("pauseVoice", {
                        localId: a.localId
                    }, a)
                },
                stopVoice: function(a) {
                    c("stopVoice", {
                        localId: a.localId
                    }, a)
                },
                onVoicePlayEnd: function(a) {
                    d("onVoicePlayEnd", a)
                },
                uploadVoice: function(a) {
                    c("uploadVoice", {
                        localId: a.localId,
                        isShowProgressTips: 0 == a.isShowProgressTips ? 0 : 1
                    }, a)
                },
                downloadVoice: function(a) {
                    c("downloadVoice", {
                        serverId: a.serverId,
                        isShowProgressTips: 0 == a.isShowProgressTips ? 0 : 1
                    }, a)
                },
                translateVoice: function(a) {
                    c("translateVoice", {
                        localId: a.localId,
                        isShowProgressTips: 0 == a.isShowProgressTips ? 0 : 1
                    }, a)
                },
                chooseImage: function(a) {
                    c("chooseImage", {
                        scene: "1|2",
                        count: a.count || 9,
                        sizeType: a.sizeType || ["original", "compressed"],
                        sourceType: a.sourceType || ["album", "camera"]
                    }, function() {
                        return a._complete = function(a) {
                            if (x) {
                                var b = a.localIds;
                                b && (a.localIds = JSON.parse(b))
                            }
                        }, a
                    }())
                },
                previewImage: function(a) {
                    c(o.previewImage, {
                        current: a.current,
                        urls: a.urls
                    }, a)
                },
                uploadImage: function(a) {
                    c("uploadImage", {
                        localId: a.localId,
                        isShowProgressTips: 0 == a.isShowProgressTips ? 0 : 1
                    }, a)
                },
                downloadImage: function(a) {
                    c("downloadImage", {
                        serverId: a.serverId,
                        isShowProgressTips: 0 == a.isShowProgressTips ? 0 : 1
                    }, a)
                },
                getNetworkType: function(a) {
                    var b = function(a) {
                        var c, d, e, b = a.errMsg;
                        if (a.errMsg = "getNetworkType:ok", c = a.subtype, delete a.subtype, c) a.networkType = c;
                        else switch (d = b.indexOf(":"), e = b.substring(d + 1)) {
                            case "wifi":
                            case "edge":
                            case "wwan":
                                a.networkType = e;
                                break;
                            default:
                                a.errMsg = "getNetworkType:fail"
                        }
                        return a
                    };
                    c("getNetworkType", {}, function() {
                        return a._complete = function(a) {
                            a = b(a)
                        }, a
                    }())
                },
                openLocation: function(a) {
                    c("openLocation", {
                        latitude: a.latitude,
                        longitude: a.longitude,
                        name: a.name || "",
                        address: a.address || "",
                        scale: a.scale || 28,
                        infoUrl: a.infoUrl || ""
                    }, a)
                },
                getLocation: function(a) {
                    a = a || {}, c(o.getLocation, {
                        type: a.type || "wgs84"
                    }, function() {
                        return a._complete = function(a) {
                            delete a.type
                        }, a
                    }())
                },
                hideOptionMenu: function(a) {
                    c("hideOptionMenu", {}, a)
                },
                showOptionMenu: function(a) {
                    c("showOptionMenu", {}, a)
                },
                closeWindow: function(a) {
                    a = a || {}, c("closeWindow", {}, a)
                },
                hideMenuItems: function(a) {
                    c("hideMenuItems", {
                        menuList: a.menuList
                    }, a)
                },
                showMenuItems: function(a) {
                    c("showMenuItems", {
                        menuList: a.menuList
                    }, a)
                },
                hideAllNonBaseMenuItem: function(a) {
                    c("hideAllNonBaseMenuItem", {}, a)
                },
                showAllNonBaseMenuItem: function(a) {
                    c("showAllNonBaseMenuItem", {}, a)
                },
                scanQRCode: function(a) {
                    a = a || {}, c("scanQRCode", {
                        needResult: a.needResult || 0,
                        scanType: a.scanType || ["qrCode", "barCode"]
                    }, function() {
                        return a._complete = function(a) {
                            var b, c;
                            y && (b = a.resultStr, b && (c = JSON.parse(b), a.resultStr = c && c.scan_code && c.scan_code.scan_result))
                        }, a
                    }())
                },
                openProductSpecificView: function(a) {
                    c(o.openProductSpecificView, {
                        pid: a.productId,
                        view_type: a.viewType || 0,
                        ext_info: a.extInfo
                    }, a)
                },
                addCard: function(a) {
                    var e, f, g, h, b = a.cardList,
                        d = [];
                    for (e = 0, f = b.length; f > e; ++e) g = b[e], h = {
                        card_id: g.cardId,
                        card_ext: g.cardExt
                    }, d.push(h);
                    c(o.addCard, {
                        card_list: d
                    }, function() {
                        return a._complete = function(a) {
                            var c, d, e, b = a.card_list;
                            if (b) {
                                for (b = JSON.parse(b), c = 0, d = b.length; d > c; ++c) e = b[c], e.cardId = e.card_id, e.cardExt = e.card_ext, e.isSuccess = e.is_succ ? !0 : !1, delete e.card_id, delete e.card_ext, delete e.is_succ;
                                a.cardList = b, delete a.card_list
                            }
                        }, a
                    }())
                },
                chooseCard: function(a) {
                    c("chooseCard", {
                        app_id: E.appId,
                        location_id: a.shopId || "",
                        sign_type: a.signType || "SHA1",
                        card_id: a.cardId || "",
                        card_type: a.cardType || "",
                        card_sign: a.cardSign,
                        time_stamp: a.timestamp + "",
                        nonce_str: a.nonceStr
                    }, function() {
                        return a._complete = function(a) {
                            a.cardList = a.choose_card_info, delete a.choose_card_info
                        }, a
                    }())
                },
                openCard: function(a) {
                    var e, f, g, h, b = a.cardList,
                        d = [];
                    for (e = 0, f = b.length; f > e; ++e) g = b[e], h = {
                        card_id: g.cardId,
                        code: g.code
                    }, d.push(h);
                    c(o.openCard, {
                        card_list: d
                    }, a)
                },
                chooseWXPay: function(a) {
                    c(o.chooseWXPay, f(a), a)
                }
            }, b && (a.wx = a.jWeixin = H), H
        });
    </script>
</body>
<script type="text/javascript">
		
    $(function() {
        // 点击搜索，隐藏上面的absolute层
        $("#search_text").on("click", function() {
            $(this).addClass("dn");
            $("#box").addClass("dn")
            $("#search_cancel").css("display", "block")
        })

        //获取分类id添加选中状态
        // var href = location.href;

        // var num = href.substr(href.length - 1, 1) - 1;
        var num = "<?php echo $categoryname['sequence']-1 ?>";
        $("#category_list .weui_grid").eq(num).addClass('active').siblings().removeClass('active');

        // 点击取消，返回主页面
        $("#search_cancel").on("click", function() {
            $('#search_input').val("");
            $('#input_product_line').val("");
            $("#search_text").removeClass("dn");
            $("#box").removeClass("dn");
            $("#search_cancel").css("display", "none")
            $("#no_use_key").addClass("dn");
            $("#search_show").addClass("dn");
        })

        // 清空input
        $("#search_clear").on("click", function() {
            $('#search_input').val("");
            $('#input_product_line').val("");
            $("#search_show").empty();
        })
        var timer = null;

        $('#search_input').bind('input', function() {
            clearTimeout(timer);
            timer = setTimeout(function() {
                var _val = $('#search_input').val();
                var _product_line = $('#input_product_line').val();
                if (_val != '') {
                    $.ajax({
                        url: '/qyapp.php?s=/faq/index/searchmsg&product_line='+_product_line,
                        type: 'post',
                        dataType: 'json',
                        data: {
                            value: _val
                            //product_line: _product_line
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
                                        '<a href="/qyapp.php?s=/faq/index/page_detail&faq_question_id=' + _d.data[i].faq_question_id + '&product_line='+ _d.productLine +'">'+
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
    });
	
	wx.config({
        debug: false,
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'onMenuShareTimeline', "onMenuShareAppMessage", "onMenuShareQQ"
        ]
    });
    // 在这里调用 API
    var strDesc = "众赢量化工作室，为您提供专属、专业的投顾服务。";
    var strLink = window.location.href;
    var strImgUrl = window.location.origin + "/files/public/big_logo.jpg";

    wx.ready(function() {
        //分享朋友圈
        wx.onMenuShareTimeline({
            title: $("head title").text(), // 分享标题
            desc: strDesc, //分享描述
            link: strLink, // 分享链接
            imgUrl: strImgUrl, // 分享图标

        });

        //分享给微信好友
        wx.onMenuShareAppMessage({
            title: $("head title").text(), // 分享标题
            desc: strDesc, //分享描述
            link: strLink, // 分享链接
            imgUrl: strImgUrl, // 分享图标
        });

        //分享到QQ
        wx.onMenuShareQQ({
            title: $("head title").text(), // 分享标题
            desc: strDesc, //分享描述
            link: strLink, // 分享链接
            imgUrl: strImgUrl, // 分享图标
        });
    });
</script>

</html>
