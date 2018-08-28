<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="/lib/layui/layui.js" charset="utf-8"></script> -->
    <script type="text/javascript" src="/js/xadmin.js"></script>
</head>
<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/lib/layui/layui.js"></script>

<body>
<div class="x-body">
    <form class="layui-form">
        @csrf
        <input type="hidden" name="id" value="{{$date -> id}}">
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>进度名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="name" required="" autocomplete="off" class="layui-input" value="{{$date -> name}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否显示</label>
            <div class="layui-input-block">
                @if($date -> status == 1)
                    <input type="checkbox" name="status" lay-skin="switch" value='1' lay-text="显示|隐藏" checked>

                @else
                    <input type="checkbox" name="status" lay-skin="switch" value='0' lay-text="隐藏|显示" >

                @endif
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                编辑
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //监听提交
        form.on('submit(add)', function(data){
            var check = $("input[type='checkbox']").prop("checked");
            if(check == true){
                var status = 1;
            }else {
                var status = 0;
            }
            //alert(status);
            // alert(parent_id);
            var name = $("input[name=name]").val();
            var token = $("input[name=_token]").val();
            var id = $("input[name=id]").val();
            // alert(name)
            //  alert(id)
            // return false;
            $.ajax({
                url:"logistics-up-do",
                type:"post",
                dataType:"json",
                data:{
                    'status':status,
                    'name':name,
                    'id':id,
                    '_token':token,
                },
                cache:false,
                async:false,
                success:function (data){
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            location.href = "logistics-list";
                        });
                    } else {
                        layer.msg(data.msg, {icon: data.code});
                    }

                }
            })
            return false;
        });


    });
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>
