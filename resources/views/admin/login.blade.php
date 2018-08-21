@extends('layouts.header')

<body class="login-bg">

    <div class="login layui-anim layui-anim-up">
        <div class="message">CRM登录</div>
        <div id="darkbannerwrap"></div>

        <form class="layui-form" >
            @csrf
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>
    <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="/lib/layui/layui.js"></script>
    <script>
        $(function  () {
            layui.use('form', function(){
              var form = layui.form;
              //监听提交
              form.on('submit(login)', function(data){
                  var username = $("input[name=username]").val();
                  var password = $("input[name=password]").val();
                  var token = $("input[name=_token]").val();
                  $.ajax({
                      url:"login-do",
                      type:"post",
                      dataType:"json",
                      data:{
                          'account':username,
                					'password':password,
                					'_token':token,
                      },
                      cache:false,
                      async:false,
                      success:function (data){
                          if (data.code == 1) {
                              layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                                  location.href = "index";
                              });
                          } else {
                              layer.msg(data.msg, {icon: data.code});
                          }

                      }
                  })

                  return false;
              });
            });
        })


    </script>


    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>
