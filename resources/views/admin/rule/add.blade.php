{{--加载头部代码--}}
@include('layouts.header')
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              @csrf
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>父级权限
              </label>
              <div class="layui-input-inline">
                  <select class="rule_parent" name="parent_id">
                      <option value="0">请选择</option>
                      @foreach($rule_list as $rule)
                      <option value="{{$rule->id}}">{{$rule->rule_name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              @csrf
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>权限名称
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="rule_name" name="rule_name" required="" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>权限路径
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="rule_url" name="rule_url" required="" autocomplete="off" class="layui-input">
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
            var status = $("input[name=status]").checked;
            // alert(status);
            var parent_id = $("select[name=parent_id]").val();
            // alert(parent_id);
            var rule_name = $("input[name=rule_name]").val();
            var rule_url = $("input[name=rule_url]").val();
            var token = $("input[name=_token]").val();
            $.ajax({
                url:"rule-add-do",
                type:"post",
                dataType:"json",
                data:{
                    'parent_id':parent_id,
                    'status':status,
                    'rule_name':rule_name,
                    'rule_url':rule_url,
                    '_token':token,
                },
                cache:false,
                async:false,
                success:function (data){
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            location.href = "rule-add";
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
