<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/faq/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/faq/css/wangEditor.min.css">
    <link rel="stylesheet" href="/faq/css/dashboard.css">
    <link rel="shortcut icon" type="image/x-icon" href="/faq/img/faviconfaq.ico" />
    <script type="text/javascript" src="/faq/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="/faq/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/faq/js/bootstrap-paginator.js"></script>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><b>常见问题后台管理</b></a>
            </div>
        </div>
    </nav>

    <div class="container-fluid wrap">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="/faq/admin">问题列表</a></li>
                    <li><a href="/faq/admin/rank_list">分类列表</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="pull-right"><a role="button" class="btn btn-primary add">添加问题</a></div>
                <h2 class="page-header">问题列表</h2>
                <form class="form-inline">
                    <div class="row">
                        <div class="form-group col-sm-4 col-md-4">
                            <label for="categoryId">分类</label>
                            <select class="form-control" id="categoryId">
                                <option value="-1">全部</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->faq_category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-4 col-md-4">
                            <label for="orderBy">排序</label>
                            <select class="form-control" id="orderBy">
                                <option value="-1">全部</option>
                                <option value="1">按次数</option>
                                <option value="2">按已解决次数</option>
                                <option value="3">按未解决次数</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <p>
                            <div>
                                <div type="button" class="btn btn-primary search" onclick="search()">查询</div>
                            </div>
                        </p>
                    </div>
                </form>
                <h3 class="sub-header">列表区域</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>问题</th>
                                <th>分类</th>
                                <th>是否显示</th>
                                <th>查看次数</th>
                                <th>已解决次数</th>
                                <th>未解决次数</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($questions as $question)
                                <input type="hidden" id="faq_question_id" value="{{ $question['id']}}">
                                <tr>
                                    <td>
                                        {{ $question['questions'] }}
                                    </td>
                                    <td>
                                        {{ $question['faq_category_name'] }}
                                    </td>
                                    <td>
                                        {{ $question['is_display'] ? '是' : '否' }}
                                    </td>
                                    <td>
                                        {{ $question['viewtimes'] }}
                                    </td>
                                    <td>
                                        {{ $question['resolvetimes'] }}
                                    </td>
                                    <td>
                                        {{ $question['unresolvetimes'] }}
                                    </td>
                                    <td class="text-center collapsing">
                                        <a href="javascript:void(0);" class="edit" value="{{ $question['id'] }}">编辑</a>
                                        <a href="javascript:void(0);" class="del" value="{{ $question['id'] }}">删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation clearfix">
                        <div id="Pages"></div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- 添加问题modal层 -->
    <div class="modal fade" tabindex="-1" id="addQuestion">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加问题</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group" enctype='multipart/form-data'>
                            <label for="ico" class="col-sm-2 control-label">问题</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" placeholder="问题" id="txtquestion"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">解答</label>
                            <div class="col-sm-9">
                                <div id="addeditor" style="height:250px;"></div>
                            </div>
                        </div>
						<div class="form-group">
                            <label for="productLineId" class="col-sm-2 control-label" style='margin-right:18px'>产品线</label>
							<div class="checkbox">
                                @foreach($lines as $line)
						        	<label>
						            	<input type="checkbox" name="additem" id="{{ $line->id }}" value="{{ $line->id }}"  checked = "checked" >{{ $line->product_line_name }}
						     	    </label>
                                @endforeach
							</div>
                        </div>
                        <div class="form-group">
                            <label for="myRole" class="col-sm-2 control-label">分类</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="myRole">
                                    <option value="-1">选择分类</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->faq_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="col-sm-2 control-label">权限</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="role">
                                    <option value="-1">选择权限</option>
                                    <option value="0">公开</option>
                                    <option value="1">仅员工可见</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="myRole" class="col-sm-2 control-label">是否显示</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="isShow" id="isShow1" value="option1" checked="checked">是
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="isShow" id="isShow2" value="option2">否
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="myRole" class="col-sm-2 control-label">是否置顶</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="toTop" id="toTop1" value="option1">是
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="toTop" id="toTop2" value="option2" checked="checked">否
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div type="button" class="btn btn-primary" id="uploadSubmit" onclick="addQuestion()">保存</div>
                    <div type="button" class="btn btn-default" data-dismiss="modal">取消</div>
                </div>
            </div>
        </div>
    </div>

    <!-- 编辑问题modal层 -->
    <div class="modal fade" id="editQuestion">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">编辑问题</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group" enctype='multipart/form-data'>
                            <label for="ico" class="col-sm-2 control-label">问题</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" placeholder="问题" id="edittxt"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">解答</label>
                            <div class="col-sm-9">
                                <div id="editor" style="height:250px;">>

                                </div>
                            </div>
                        </div>
						<div class="form-group">
                            <label for=" " class="col-sm-2 control-label" style="margin-right:18px">产品线</label>
							<div class="checkbox">
                                @foreach($lines as $line)
                                    <label>
                                        <input type="checkbox" name="edititem" id="{{ $line->id }}" value="{{ $line->id }}"  checked = "checked" >{{ $line->product_line_name }}
                                    </label>
                                @endforeach
							</div>
                        </div>

                        <div class="form-group">
                            <label for="editmyRole" class="col-sm-2 control-label">分类</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="editmyRole">
                                    <option value="-1">选择分类</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->faq_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editrole" class="col-sm-2 control-label">权限</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="editrole">
                                    <option value="-1">选择权限</option>
                                    <option value="0">公开</option>
                                    <option value="1">仅员工可见</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="myRole" class="col-sm-2 control-label">是否显示</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="isShow" id="editisShow1" value="option1">是
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="isShow" id="editisShow2" value="option2">否
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="myRole" class="col-sm-2 control-label">是否置顶</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="toTop" id="edittoTop1" value="option1">是
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="toTop" id="edittoTop2" value="option2">否
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="uploadSubmit" onclick="editQuestion()">保存</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 信息删除确认modal层 -->
    <div class="modal fade" id="delcfmModal">
        <div class="modal-dialog">
            <div class="modal-content message_align">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">提示信息</h4>
                </div>
                <div class="modal-body">
                    <p>您确认要删除吗？</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="url" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <a class="btn btn-primary" data-dismiss="modal" onclick="delQuestion()">确定</a>
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src="/faq/js/wangEditor.min.js"></script>
<script type="text/javascript">
    var _val;
    var isSearching = false
    var lastPage = {{$lastPage}}
    var currentPage = 1
    var categoryId = -1
    var orderBy = -1

    wangEditor.config.printLog = false;
    wangEditor.config.uploadImgUrl = '/pofolio.php?action=upload';
    wangEditor.config.uploadParams = {
        from: 'editor',
        token: 'RlOM7asibyCS5onU1VZE'
    };
    wangEditor.config.uploadHeaders = {
        'Accept': 'text/x-json'
    };
    wangEditor.config.uploadImgFileName = 'file';
    // editor.config.hideLinkImg = true;

    wangEditor.config.menus = ['editor',
        '|',
        'bold',
        'underline',
        'italic',
        'strikethrough',
        'eraser',
        'forecolor',
        'bgcolor',
        'quote',
        'fontfamily',
        'fontsize',
        'head',
        'unorderlist',
        'orderlist',
        'alignleft',
        'aligncenter',
        'alignright',
        'indent',
        '|',
        'link',
        'unlink',
        'table',
        '|',
        'img',
        'location',
        '|',
        'link',
        'undo',
        'redo',
        'fullscreen'
    ];


    var editor = new wangEditor('editor');
    var addeditor = new wangEditor('addeditor');


    editor.create();
    addeditor.create()

    $(function() {
        // 添加问题窗口
        $('.btn.add').on("click", function() {
            $('#txtquestion').val('');
            $("#myRole").val(-1);
            $("#role").val(-1);
            addeditor.$txt.html('');
            $("#addQuestion").modal("show")
        })

        // 删除判断窗口
        $('.del').on("click", function() {
            _val = this.getAttribute("value");
            $("#delcfmModal").modal("show")
        })
        var categoryId = $('#categoryId').val();
        var orderBy = $('#orderBy').val();
        // 分页初始化 
        var options = {
            totalPages: lastPage,
            onPageClicked: function(event, originalEvent, type, page) {
                currentPage = page
                getList()
            }
        };
        $('#Pages').bootstrapPaginator(options);

        // 编辑判断窗口
        $('.edit').on("click", function() {
            _val = this.getAttribute("value");
            getquestionmsg();
            $("#editQuestion").modal("show");
        })
    })

    function getList() {
        $.ajax({
            url: '/api/faq/questions',
            type: 'get',
            data: {
                category_id: categoryId,
                order_by: orderBy,
                current_page: currentPage
            },
            success: function(d) {
                if (d.code == 0) {
                    $("#tbody").empty();
                    for (var i = 0; i < d.data.length; i++) {
                        d.data[i].is_display = d.data[i].is_display ? "是" : "否"
                        var html = '<tr>' +
                            '<td>' + d.data[i].questions +
                            '</td>' +
                            '<td>' +
                            d.data[i].faq_category_name +
                            '</td>' +
                            '<td>' +
                            d.data[i].is_display +
                            '</td>' +
                            '<td>' +
                            d.data[i].viewtimes +
                            '</td>' +
                            '<td>' +
                            d.data[i].resolvetimes +
                            '</td>' +
                            '<td>' +
                            d.data[i].unresolvetimes +
                            '</td>' +
                            '<td class = "text-center collapsing" >' +
                            '<a href = "javascript:void(0);" class="edit" value= "' + d.data[i].id + '" onclick="editques(' + d.data[i].id + ')"> 编辑 </a>' +
                            '<a href = "javascript:void(0);" class="del" value= "' + d.data[i].id + '" onclick="delques(' + d.data[i].id + ')"> 删除 </a>' +
                            '</td>' +
                            '</tr>';
                        $("#tbody").append(html);
                    }
                    if(isSearching){
                        pagesinit(d.total)
                        isSearching = false
                    }

                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    function pagesinit(total) {
        var options = {
            totalPages: Math.ceil(total/10),
            onPageClicked: function(event, originalEvent, type, page) {
                currentPage = page
                getList()
            }
        };
        $('#Pages').bootstrapPaginator("setOptions", options);
    }

    function editques(k) {
        _val = k
        getquestionmsg();
        $("#editQuestion").modal("show");
    }

    function delques(k) {
        _val = k
        $("#delcfmModal").modal("show")
    }

    function search() {
        currentPage = 1
        categoryId = $('#categoryId').val();
        orderBy = $('#orderBy').val();
        isSearching = true
        getList()
    }

    function addQuestion() {
        // var data = $("#addctgory").serialize();
        var _txtquestion = $('#txtquestion').val();
        var _myRole = $('#myRole').val();
        var _role = $('#role').val();
        var _addeditor = addeditor.$txt.html();
        var checkboxVal = [];
        checkboxVal.length = 0;
        $('[name=additem]:checkbox:checked').each(function(i){
          checkboxVal[i] = $(this).val();
        });
        if(checkboxVal.length == 0 ){
            alert('产品线不能为空'); 
            return false;
        }

        if (document.getElementById("txtquestion").value == '') {
            alert('填写问题不能为空');
            return false;
        }

        if (addeditor.$txt.html() == '<p><br></p>') {
            alert('问题答案不能为空');
            return false;
        }


        if ($('#myRole').val() == -1) {
            alert("分类不能为空!");
            return false;
        }

        if ($('#role').val() == -1) {
            alert("权限不能为空!");
            return false;
        }

        if ($('#isShow1').prop('checked') == true) {
            var _radioisshow = 1;
        }

        if ($('#isShow2').prop('checked') == true) {
            var _radioisshow = 0;
        }

        if ($('#toTop1').prop('checked') == true) {
            var _radioistop = 1;
        }

        if ($('#toTop2').prop('checked') == true) {
            var _radioistop = 0;
        }
        var resData = {
            question: _txtquestion,
            editor: _addeditor,
            line: checkboxVal.join(','),
            category: _myRole,
            role: _role,
            show: _radioisshow,
            top: _radioistop,
        }
        console.log(resData)
        // return

        $.ajax({
            url: '/api/faq/questions',
            type: 'post',
            data: resData,
            success: function(d) {
                if (d.code == 0) {
                    alert("添加成功");
                    window.location.reload();
                } else {
                    alert('添加失败');
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    function getquestionmsg(k) {
        $.ajax({
            url: '/api/faq/questions/' + _val,
            type: 'get',
            success: function(d) {
                if (d.code == 0) {
                    endow(d.data);
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    function endow(val) {
        $('#edittxt').val(val.questions);
        editor.$txt.html(val.answers);
        var category = document.getElementById('editmyRole');
        for (var i = 0; i < category.options.length; i++) {
            if (category.options[i].value == val.faq_category_id) {
                category.selectedIndex = i;
                break;
            }
        }
        var right = document.getElementById('editrole');
        for (var i = 0; i < right.options.length; i++) {
            // if (right.options[i].value == val.departmentright_id) {
            if (right.options[i].value == val.is_user) {
                right.selectedIndex = i;
                break;
            }
        }
        if (val.is_display == 1) {
            $('#editisShow1').prop('checked', true);
        } else {
            $('#editisShow2').prop('checked', true);
        }

		$('[name=edit]:checkbox').each(function() 
		{ 
			this.checked = false; 
    	});
        console.log(val)
        val.product_line_id = val.product_line.split(',')
         $('[name=edititem]').prop('checked', false);
		for(var i = 0; i < val.product_line_id.length; i++) {
			// $(':checkbox[value="'+val.product_line_id[i]+'"]').prop('checked', 'checked');
            $('[name=edititem]').eq(val.product_line_id[i]).prop('checked', 'checked');
		}

        if (val.is_top == 1) {
            $('#edittoTop1').prop('checked', true);
        } else {
            $('#edittoTop2').prop('checked', true);
        }
    }

    function editQuestion() {
        var _edittxt = $('#edittxt').val();
        var _editmyRole = $('#editmyRole').val();
        var _editrole = $('#editrole').val();
        var _editeditor = editor.$txt.html();

		var editCheckboxVal = [];
        editCheckboxVal.length = 0;
        $('[name=edititem]:checkbox:checked').each(function(i){
          editCheckboxVal[i] = $(this).val();
        });
        if(editCheckboxVal.length == 0 ){
            alert('产品线不能为空'); 
            return false;
        }

        if ($('#editisShow1').prop('checked') == true) {
            var _radioeditisshow = 1;
        }

        if ($('#editisShow2').prop('checked') == true) {
            var _radioeditisshow = 0;
        }

        if ($('#edittoTop1').prop('checked') == true) {
            var _radioeditistop = 1;
        }

        if ($('#edittoTop2').prop('checked') == true) {
            var _radioeditistop = 0;
        }

        if (document.getElementById("edittxt").value == '') {
            alert('填写问题不能为空');
            return false;
        }

        if (editor.$txt.html() == '<p><br></p>') {
            alert('问题答案不能为空');
            return false;
        }

        if ($('#editmyRole').val() == -1) {
            alert("分类不能为空!");
            return false;
        }

        if ($('#editrole').val() == -1) {
            alert("权限不能为空!");
            return false;
        }
        var resData = {
            question: _edittxt,
            editor: _editeditor,
            line: editCheckboxVal.join(','),
            category: _editmyRole,
            role: _editrole,
            show: _radioeditisshow,
            top: _radioeditistop,
        }

        $.ajax({
            url: '/api/faq/questions/' + _val,
            type: 'patch',
            data: resData,
            success: function(d) {
                if (d.code == 0) {
                    alert("编辑成功");
                    window.location.reload();
                } else {
                    alert('编辑失败');
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    function delQuestion(id) {
        $.ajax({
            url: '/api/faq/questions/' + _val,
            type: 'delete',
            success: function(d) {
                if (d.code == 0) {
                    alert("删除成功");
                    window.location.reload();
                } else {
                    alert('删除失败');
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }
</script>

</html>

</html>
