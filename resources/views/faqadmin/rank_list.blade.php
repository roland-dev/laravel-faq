<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/faq/css/bootstrap.min.css">
    <link rel="stylesheet" href="/faq/css/fileinput.css">
    <link rel="stylesheet" href="/faq/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/faq/css/dashboard.css">
    <link rel="shortcut icon" type="image/x-icon" href="/faq/img/faviconfaq.ico" />
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="/faq/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/faq/js/fileinput.js"></script>
    <script type="text/javascript" src="/faq/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/faq/js/bootstrap-paginator.js"></script>
    <title>FAQ后台</title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">FAQ后台管理</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid wrap">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li><a href="/faq/admin">问题列表</a></li>
                    <li class="active"><a href="/faq/admin/rank_list">分类列表</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="pull-right"><a role="button" class="btn btn-primary" data-toggle="modal" data-target="#addRank">添加分类</a></div>
                <h2 class="page-header">分类列表</h2>
                <form class="form-inline">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label for="role">产品线</label>
                            <select class="form-control" id="line">
                            <option value="-1">全部</option>
                            @foreach ($lines as $line) 
                            <option value="{{ $line->id }}">{{ $line->product_line_name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <p>
                            <div>
                                <div class="btn btn-primary" id="search">查询</div>
                            </div>
                        </p>
                    </div>
                </form>
                <h3 class="sub-header">列表区域</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>名称</th>
                                <th>更新时间</th>
                                <th>创建时间</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody id="categorySection">
                             @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->faq_category_name }}</td>
                                <td>{{ $category->update_time }}</td>
                                <td>{{ $category->create_time }}</td>
                                <td class="text-center collapsing">
                                    <a href="javascript:void(0);" onclick="viewCategory({{ $category->id }})">编辑</a>
                                    <a href="javascript:void(0);" class="del" onclick="delCategory({{ $category->id }})">删除</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation clearfix">
                    <div id="Pages"></div>
                 </nav>
            </div>
        </div>
    </div>
    <!-- 添加分类modal层 -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addRank">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加分类</h4>
                </div>
                <div class="modal-body">
                    <!--<form class="form-horizontal" id="addctgory" method="POST" action="/app.php?s=/faq/faq/addcategorymodal">-->
                    <form class="form-horizontal" id="addctgory">
                        <!-- <div class="form-group" enctype='multipart/form-data'>
                            <label for="ico" class="col-sm-2 control-label">图标</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput" id="exampleInputUpload">
                                    <div class="fileinput-new thumbnail fileinput-exists" style="width: 200px;height: auto;max-height:150px;">
                                        <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                        <span class="fileinput-new">选择图片</span>
                                        <span class="fileinput-exists">换一张</span>
                                        <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png,image/jpg" />
                                        </span>
                                        <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">产品线名</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="addLine">
                                    @foreach ($lines as $line) 
                                    <option value="{{ $line->id }}">{{ $line->product_line_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">分类名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="请输入" id="addName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">分类排序</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  placeholder="请输入" id="addSequence">
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <div type="button" class="btn btn-primary" id="uploadSubmit" onclick="addCategory()">保存</div>
                        <div type="button" class="btn btn-default" data-dismiss="modal">取消</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 编辑分类modal层 -->
        <div class="modal fade" tabindex="-1" role="dialog" id="editRank">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">编辑分类</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">产品线名</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="editLine">
                                    @foreach ($lines as $line) 
                                    <option value="{{ $line->id }}">{{ $line->product_line_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">分类名称</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="请输入" id="editName">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">分类排序</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="请输入" id="editSequence">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="uploadSubmit">保存</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 信息删除确认 -->
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
                        <a class="btn btn-primary" data-dismiss="modal">确定</a>
                    </div>
                </div>
            </div>
        </div>


</body>
<script type="text/javascript">
    var productLine = -1
    var lastPage = {{ $last_page }}
    var options = {}

    // 分页初始化显示全部列表
    pageInit(lastPage)

    $("#search").click(function(){
        productLine = $("#line").val();
        getCategoryList()
    })
    // 初始化分页
    function pageInit(last_page) {
        console.log('初始化分页！')
        // 分页参数 
        options = {
            currentPage: 1,
            totalPages: last_page,
            onPageClicked: function (event,originalEvent,type,page) {
                getCategoryList(page)
            }
        }
        if(lastPage > 1){
            $('#Pages').bootstrapPaginator(options);
            } else {
            $('#page').empty();
            }
    }

    // 获取分类列表
    function getCategoryList(current_page){
        current_page = current_page ? current_page : 1
        $.ajax({
            url: '/api/faq/category',
            type: 'get',
            data: {
                product_line: productLine,
                current_page: current_page
            },
            success: function(d) {
                if(d.code == 0){
                    var list = d.data
                    var categoryHtml = ''
                    for (var i = list.length - 1; i >= 0; i--) {
                        categoryHtml +=  '<tr>'
                                            + '<td>' + list[i].faq_category_name + '</td>'
                                            + '<td>' + list[i].update_time + '</td>'
                                            + '<td>' + list[i].create_time + '</td>'
                                            + '<td class="text-center collapsing">'
                                            +    '<a href="javascript:void(0);" onclick="viewCategory(' + list[i].id + ')">编辑</a>'
                                            +    '<a href="javascript:void(0);" onclick="delCategory(' + list[i].id + ')">删除</a>'
                                            + '</td>'
                                        + '</tr>'
                    }
                    $("#categorySection").html(categoryHtml)
                    if(productLine != -1) {
                        pageInit(Math.ceil(d.total/10))
                    }
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
        
    }

    // add category in rank_list
    function addCategory() {
        var sequence = $('#addSequence').val();
        var name = $('#addName').val();
        var line = $('#addLine').val();

        if (!name) {
            alert('分类名称不能为空!');
            return false;
        }

        $.ajax({
            url: '/api/faq/category',
            type: 'post',
            dataType: 'json',
            data: {
                faq_category_name: name,
                sequence: sequence,
                product_line: line
            },
            success: function(d) {
                if (d.code == 0){
                    $("#addRank").hide()
                    alert("添加分类成功！")
                } else {
                    alert("添加分类失败！")
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    // 查看分类
    function viewCategory(id) {
        $("#editRank").show()
         $.ajax({
            url: '/api/faq/category_view',
            type: 'get',
            dataType: 'json',
            data: {
                category_id: id,
            },
            success: function(d) {
                if(d.code == 0){
                    $('#editSequence').val(d.data.sequence);
                    $('#editName').val(d.data.faq_category_name);
                    $('#editLine').val(d.data.product_line);

                }
                $("#editRank").hide()
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    function updateCategory(id) {
        var sequence = $('#editSequence').val();
        var name = $('#editName').val();
        var line = $('#editLine').val();

        $.ajax({
            url: '/api/faq/category_update',
            type: 'get',
            dataType: 'json',
            data: {
                category_id: id,
                product_line: line,
                faq_category_name: name,
                sequence: sequence
            },
            success: function(d) {
                if(d.code == 0){
                    alert("更新成功！")
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    function delCategory(id) {
        $.ajax({
            url: '/api/faq/category_delete',
            type: 'post',
            data: {
                category_id: id,
            },
            success: function(d) {
                if(d.code == 0){
                    alert("删除成功！")
                }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }
</script>

</html>