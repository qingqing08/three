{{--加载头部代码--}}
@include('layouts.header')
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              @csrf
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>角色名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="role_name" name="role_name" value="{{$info->role_name}}" required="" autocomplete="off" class="layui-input">
                  <input type="hidden" id="role_id" name="role_id" value="{{$info->id}}" />
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="modify" lay-submit="">
                  修改
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
          //监听提交
        form.on('submit(modify)', function(data){
            var name = $("input[name=role_name]").val();
            var role_id = $("input[name=role_id]").val();
            var token = $("input[name=_token]").val();
            if (name == '') {
              layer.msg('角色名称不能为空', {icon: 0});
              return false;
            }
            $.ajax({
                url:"role-modify-do",
                type:"post",
                dataType:"json",
                data:{
                    'role_name':name,
                    'role_id':role_id,
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
