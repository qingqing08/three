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
                  <input type="text" value="{{$info->role_name}}" autocomplete="off" class="layui-input" readonly>
                  <input type="hidden" value="{{$info->id}}" name="role_id" id="role_id" />
              </div>
          </div>
          <div class="layui-form-item">
              <label class="layui-form-label">设置权限</label>
              <div class="layui-input-block">
                  @foreach($rule_list as $rule)
                  <input type="checkbox" name="rule[]" title="{{$rule->rule_name}}" value="{{$rule->id}}">
                  @endforeach
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
          //监听提交
        form.on('submit(add)', function(data){
            var check_rule = '';
            var no_check = '';
            $.each($('input:checkbox:checked'),function(){
              check_rule = $(this).val()+','+check_rule;
            });
            $.each($('input[type=checkbox]:not(:checked)'),function(){
              no_check = $(this).val()+','+no_check;
            });
            // alert(check_rule);
            var token = $("input[name=_token]").val();
            var role_id = $("input[name=role_id]").val();
            $.ajax({
                url:"set-rule-do",
                type:"post",
                dataType:"json",
                data:{
                    'check_rule':check_rule,
                    'no_check':no_check,
                    'role_id':role_id,
                    '_token':token,
                },
                cache:false,
                async:false,
                success:function (data){
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            location.href = "role-list";
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
