@include('layouts.header')
  
  <body>
    <div class="x-body">
        <form class="layui-form">
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>标题
                  @csrf
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="title" name="title" required="" lay-verify="required"
                  autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
              </div>
          </div>
          <div class="layui-form-item">
              <label for="username" class="layui-form-label">
                  <span class="x-red">*</span>内容
              </label>
              <div class="layui-input-inline">
                  <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
              </div>
              <div class="layui-form-mid layui-word-aux">
                  <span class="x-red">*</span>
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
            console.log(data);
            // alert(data.field);
            $.ajax({
              url:"document-add-do",
              type:"post",
              dataType:"json",
              data:data.field,
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