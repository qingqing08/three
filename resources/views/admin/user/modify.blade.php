@include('layouts.header')
  
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>姓名
                  @csrf
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="name" name="name" required="" lay-verify="required"
                  autocomplete="off" class="layui-input" value="{{$staff_info->name}}">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>登录名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="account" name="account" value="{{$staff_info->account}}" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>将会成为您唯一的登入名
              </div>
          </div>
          <div class="layui-form-item">
              <label for="phone" class="layui-form-label">
                  <span class="x-red">*</span>手机
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="mobile" name="mobile" value="{{$staff_info->mobile}}" required="" lay-verify="phone"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <input type="hidden" value="{{$staff_info->id}}" name="staff_id" />
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
          form.on('submit(modify)', function(data){
            console.log(data);
            // alert(data.field);
            $.ajax({
              url:"user-modify-do",
              type:"post",
              dataType:"json",
              data:{
                data:data.field,
                _token:data.field._token,
              },
              cache:false,
              async:false,
              success:function (data){
                alert(data);
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