<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="/static/faq/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/faq/css/fileinput.css">
    <link rel="stylesheet" href="/static/faq/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/static/faq/css/dashboard.css">
    <link rel="shortcut icon" type="image/x-icon" href="/static/faq/img/faviconfaq.ico" />
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="/static/faq/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/static/faq/js/fileinput.js"></script>
    <script type="text/javascript" src="/static/faq/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/static/faq/js/bootstrap-paginator.js"></script>
    <title>FAQ后台</title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- <h3 class="navbar-brand">FAQ后台管理</h3> -->
                <a class="navbar-brand" href="#">FAQ后台管理</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid wrap">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li><a href="/app.php?s=/faq/faq/index">问题列表</a></li>
                    <li class="active"><a href="/app.php?s=/faq/faq/rank_list">分类列表</a></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <div class="pull-right"><a role="button" class="btn btn-primary" data-toggle="modal" data-target="#addRank">添加分类</a></div>
                <h2 class="page-header">分类列表</h2>
                <form class="form-inline">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-6">
                            <label for="role">权限</label>
                            <select class="form-control" id="role">
                            <?php
                                if(!empty($category)){
                                    foreach($category as $key => $val){
                            ?>
                            <option value="<?php echo $val['right_id']?>"><?php echo $val['right_name']?></option>
                            <?php
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <p>
                            <div>
                                <button type="submit" class="btn btn-primary search">查询</button>
                            </div>
                        </p>
                    </div>
                </form>
                <h3 class="sub-header">列表区域</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>分类</th>
                                <th>权限</th>
                                <th>问题</th>
                                <th class="text-center">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>分类一</td>
                                <td>业务员</td>
                                <td>13</td>
                                <td class="text-center collapsing"><a href="" data-toggle="modal" data-target="#seeRank">查看</a><a href="" data-toggle="modal" data-target="#editRank">编辑</a><a href="javascript:void(0);" class="del">删除</a></td>
                            </tr>
                            <tr>
                                <td>分类一</td>
                                <td>业务员</td>
                                <td>13</td>
                                <td class="text-center collapsing"><a href="" data-toggle="modal" data-target="#seeRank">查看</a><a href="" data-toggle="modal" data-target="#editRank">编辑</a><a href="javascript:void(0);" class="del">删除</a></td>
                            </tr>
                            <tr>
                                <td>分类一</td>
                                <td>业务员</td>
                                <td>13</td>
                                <td class="text-center collapsing"><a href="" data-toggle="modal" data-target="#seeRank">查看</a><a href="" data-toggle="modal" data-target="#editRank">编辑</a><a href="javascript:void(0);" class="del">删除</a></td>
                            </tr>
                            <tr>
                                <td>分类一</td>
                                <td>业务员</td>
                                <td>13</td>
                                <td class="text-center collapsing"><a href="" data-toggle="modal" data-target="#seeRank">查看</a><a href="" data-toggle="modal" data-target="#editRank">编辑</a><a href="javascript:void(0);" class="del">删除</a></td>
                            </tr>

                        </tbody>
                    </table>
                    <nav aria-label="Page navigation clearfix">
                        <div id="Pages"></div>
                    </nav>
                </div>
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
                        <div class="form-group" enctype='multipart/form-data'>
                            <label for="ico" class="col-sm-2 control-label">图标</label>
                            <div class="col-sm-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput" id="exampleInputUpload">
                                    <div class="fileinput-new thumbnail fileinput-exists" style="width: 200px;height: auto;max-height:150px;">
                                        <!-- <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" /> -->
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
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="myRole" class="col-sm-2 control-label">权限</label>
                            <!--<select class="form-control selectpicker" id="myRole" multiple>-->
                            <div class="col-sm-9">
                                <select class="form-control" id="myRole">
                                <option value="-1">选择权限</option>   
                            <?php
                                if(!empty($category)){
                                    foreach($category as $key => $val){
                            ?>
                            <option value="<?php echo $val['right_id']?>"><?php echo $val['right_name']?></option>
                            <?php
                                    }
                                }
                            ?>
                            </select>
                            </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                        <div type="button" class="btn btn-primary" id="uploadSubmit" onclick="addcategoryform()">保存</div>
                        <!--<div onclick="addcategoryform()">保存</div>-->
                        <div type="button" class="btn btn-default" data-dismiss="modal">取消</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 查看分类modal层 -->
        <div class="modal fade" tabindex="-1" role="dialog" id="seeRank">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">查看分类</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group" enctype='multipart/form-data'>
                                <label for="ico" class="col-sm-2 control-label">图标</label>
                                <div class="col-sm-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput" id="exampleInputUpload">
                                        <div class="fileinput-new thumbnail fileinput-exists" style="width: 200px;height: auto;max-height:150px;">
                                            <!-- <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" /> -->
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">选择图片</span>
                                            <span class="fileinput-exists">换一张</span>
                                            <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png" />
                                            </span>
                                            <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="name" placeholder="名称" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myRole" class="col-sm-2 control-label">权限</label>
                                <div class="col-sm-9">
                                    <select class="form-control" disabled>
                                    <option>业务员</option>
                                    <option>客户</option>
                                    <option>...</option>
                                </select>
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
                            <div class="form-group" enctype='multipart/form-data'>
                                <label for="ico" class="col-sm-2 control-label">图标</label>
                                <div class="col-sm-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput" id="exampleInputUpload">
                                        <div class="fileinput-new thumbnail fileinput-exists" style="width: 200px;height: auto;max-height:150px;">
                                            <!-- <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" /> -->
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">选择图片</span>
                                            <span class="fileinput-exists">换一张</span>
                                            <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png" />
                                            </span>
                                            <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="name" placeholder="名称">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myRole" class="col-sm-2 control-label">权限</label>
                                <div class="col-sm-9">
                                    <select class="form-control">
                                    <option>业务员</option>
                                    <option>客户</option>
                                    <option>...</option>
                                </select>
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
    $(function() {
        $('.del').on("click", function() {
            $("#delcfmModal").modal("show");
        })

        // 分页初始化 
        var options = {
            currentPage: 3,
            totalPages: 5
        }

        $('#Pages').bootstrapPaginator(options);

        //多重选择框    
        // $('.selectpicker').selectpicker({
        //     // style: 'form-control',
        //     size: 4
        // });
        //图片上传fileinput
    })

    // add category in rank_list
    function addcategoryform() {
        // var _data = $("#addctgory").serialize();why can't get data of form
        var _pic = $('#picID').val();
        var _name = $('#name').val();
        var _option = $('#myRole').val();

        if (!$('#picID').val) {
            alert('上传图片不能为空');
            return false;
        }

        if (!$('#name').val()) {
            alert('分类名称不能为空!');
            return false;
        }
        if (!$('#myRole').val()) {
            alert("权限不能为空!");
            return false;
        }
        $.ajax({
            url: '/app.php?s=/faq/faq/addcategorymodal',
            type: 'post',
            dataType: 'json',
            data: {
                // picture: _pic,
                name: _name,
                option: _option
            },
            success: function(_d) {
                console.log(_d);
                // if (_d && _d.rcode) {
                //     alert("分类添加成功");
                //     window.location.reload();
                // } else {
                //     alert('分类添加失败');
                // }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
    }

    function choosepic() {
        var _name = $('#name').val();
        $.ajax({
            url: '/app.php?s=/faq/faq/uploadmultiplefiles',
            type: 'post',
            dataType: 'json',
            data: {
                name: _pic,
            },
            success: function(_d) {
                console.log(_d);
                // if (_d && _d.rcode) {
                //     alert("分类添加成功");
                //     window.location.reload();
                // } else {
                //     alert('分类添加失败');
                // }
            },
            error: function(err) {
                alert("接口请求失败");
            }
        });
        // if (!_name) {
        //     alert('上传图标不能为空');
        //     return false;
        // }
    }
</script>

</html>