<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>添加</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/static/css/font.css">
    <link rel="stylesheet" href="/static/css/global.css">
    <link rel="stylesheet" href="/static/lib/layui/css/layui.css">
    <script type="text/javascript" src="/static/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/js/xadmin.js"></script>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row site-block">
        <form class="layui-form" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$admin->id}}">
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" id="L_pass" name="password" required="" lay-verify="pass" autocomplete="off" class="layui-input" placeholder="请输入密码" >
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">确认密码</label>
                <div class="layui-input-block">
                    <input type="password" id="L_repass" name="repassword" required="" lay-verify="repass" autocomplete="off" class="layui-input" placeholder="请确认密码" >
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-filter="edit" lay-submit="" onclick="return false">修改</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    layui.use(['form', 'layer','jquery'],
        function() {
            $ = layui.jquery;
            var form = layui.form,
                layer = layui.layer;

            //自定义验证规则
            form.verify({
                pass: [/(.+){6,12}$/, '密码必须6到12位'],
                repass: function(value) {
                    if ($('#L_pass').val() != $('#L_repass').val()) {
                        return '两次密码不一致';
                    }
                }
            });

            //监听提交
            form.on('submit(edit)',
                function(data) {
                    $.ajax({
                        url:"/admin/admin_edit",
                        data:data.field,
                        type:"post",
                        dataType:"json",
                        success:function(data){
                            if (data.status){
                                layer.alert("修改失败", {
                                    icon: 5
                                },reload);
                                return false;
                            }
                            layer.alert("修改成功", {
                                icon: 6
                            },reload);
                            return false;
                        },
                        error:function(data){
                            layer.alert("修改失败", {
                                icon: 5
                            },reload);
                            return false;
                        }
                    });
                });
        });

    function reload() {
        //关闭当前frame
        xadmin.close();
        // 可以对父窗口进行刷新
        xadmin.father_reload();
    }
</script>
</body>
</html>