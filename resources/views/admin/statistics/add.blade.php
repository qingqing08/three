{{--加载头部代码--}}
@include('layouts.header')
<body>
<div class="x-body">
    <form class="layui-form">

        <div class="layui-form-item">
            @csrf
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="name" required="" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否显示</label>
            <div class="layui-input-block">
                <input type="checkbox" name="status" lay-skin="switch" value='1' lay-text="显示|隐藏" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" lay-filter="add" lay-submit="">
                增加
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
            //alert(name)
            $.ajax({
                url:"statistics-add-do",
                type:"post",
                dataType:"json",
                data:{
                    'status':status,
                    'name':name,
                    '_token':token,
                },
                cache:false,
                async:false,
                success:function (data){
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            layer.close(layer.index);
                            window.parent.location.reload();
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
