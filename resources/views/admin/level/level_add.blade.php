@include('layouts.header')
<body>
<div class="x-body">
    <form class="layui-form">
      @csrf
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>级别名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="level_name" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
<div class="layui-form-item">
    <label for="L_repass" class="layui-form-label">
    </label>
    <button  class="layui-btn"  lay-filter="add" lay-submit="">
        增加
    </button>
</div> 
</form>
</div>
<script>
    layui.config({
      // base : "address.js" //address.js的路径
    }).use([ 'layer', 'jquery' ], function() {
      var layer = layui.layer, $ = layui.jquery, address = layui.address();

    });
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

    form.on('submit(add)', function(data){
                          var level_name     =   $("input[name=level_name]").val();//级别名称
                           var token         =   $("input[name=_token]").val();//token
                          $.ajax({
                              url:"level-add-do",
                              type:"post",
                              dataType:"json",
                              data:{
                                _token       :   token,
                                level_name   :   level_name,
                              },
                              cache:false,
                              async:false,
                              success:function (data){
                                  if (data.code == 1) {
                                      layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                                          location.href = "level-list";
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
