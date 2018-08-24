{{--加载头部代码--}}
@include('layouts.header')
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              @csrf
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>用户名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" value="{{$staff_info->name}}" autocomplete="off" class="layui-input" readonly>
                  <input type="hidden" value="{{$staff_info->id}}" name="staff_id" id="staff_id" />
              </div>
          </div>
          <div class="layui-form-item">
              <label class="layui-form-label">设置角色</label>
              <div class="layui-input-block">
                  @foreach($role_list as $role)
                  <input type="checkbox" name="role" title="{{$role->role_name}}" value="{{$role->id}}">
                  @endforeach
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  提交
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
        form.on('submit(add)', function(data){
            // alert(check_rule);
            var token = $("input[name=_token]").val();
            var role = $("input[name=role]").val();
            var staff_id = $("input[name=staff_id]").val();
            $.ajax({
                url:"set-role-do",
                type:"post",
                dataType:"json",
                data:{
                    'role':role,
                    'staff_id':staff_id,
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
