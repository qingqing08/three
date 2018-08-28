<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.0</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="/css/font.css">
        <link rel="stylesheet" href="/css/xadmin.css">
    </head>
    <body>
    <div class="x-body layui-anim layui-anim-up">
        <blockquote class="layui-elem-quote">欢迎管理员：
            <span class="x-red">{{$staff_info->name}}</span>！当前时间: <span style="color:red;" id="show"></span></blockquote>
        <fieldset class="layui-elem-field">
            <legend>数据统计</legend>
            <div class="layui-field-box">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">
                            <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                                <div carousel-item="">
                                    <ul class="layui-row layui-col-space10 layui-this">
                                        @foreach($list as $v)
                                        <li class="layui-col-xs2">
                                            <a href="javascript:;" class="x-admin-backlog-body">
                                                <h3>{{$v -> name}}</h3>
                                                <p>
                                                    <cite>{{$v -> num}}</cite></p>
                                            </a>
                                        </li>
                                         @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>内部公文</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        @foreach($document_list as $document)
                        <tr>
                            <td >
                                <span>{{$document->content}}</span>
                            </td>
                            <td >
                                <span>{{$document->staff_id}}</span>
                            </td>
                            <td >
                                <span>{{$document->c_time}}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </fieldset>
        {{--<fieldset class="layui-elem-field">--}}
            {{--<legend>系统信息</legend>--}}
            {{--<div class="layui-field-box">--}}
                {{--<table class="layui-table">--}}
                    {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<th>xxx版本</th>--}}
                            {{--<td>1.0.180420</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>服务器地址</th>--}}
                            {{--<td>x.xuebingsi.com</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>操作系统</th>--}}
                            {{--<td>WINNT</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>运行环境</th>--}}
                            {{--<td>Apache/2.4.23 (Win32) OpenSSL/1.0.2j mod_fcgid/2.3.9</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>PHP版本</th>--}}
                            {{--<td>5.6.27</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>PHP运行方式</th>--}}
                            {{--<td>cgi-fcgi</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>MYSQL版本</th>--}}
                            {{--<td>5.5.53</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>ThinkPHP</th>--}}
                            {{--<td>5.0.18</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>上传附件限制</th>--}}
                            {{--<td>2M</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>执行时间限制</th>--}}
                            {{--<td>30s</td></tr>--}}
                        {{--<tr>--}}
                            {{--<th>剩余空间</th>--}}
                            {{--<td>86015.2M</td></tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</fieldset>--}}
        <fieldset class="layui-elem-field">
            <legend>开发团队</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>版权所有</th>
                            <td>www.baidu.com
                                <a href="http://www.baidu.com/" class='x-a' target="_blank">访问官网</a></td>
                        </tr>
                        <tr>
                            <th>开发者</th>
                            <td>彭晴晴（组长）,邓佚涵（组员），张能强（组员），马壮（组员）</td></tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <blockquote class="layui-elem-quote layui-quote-nm">如有疑问，请拨打110</blockquote>
    </div>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0];
          s.parentNode.insertBefore(hm, s);
        })();
        </script>

    <script>


        function run(){
            var time = new Date();//获取系统当前时间
            var year = time.getFullYear();
            var month = time.getMonth()+1;
            var date= time.getDate();//系统时间月份中的日
            var day = time.getDay();//系统时间中的星期值
            var weeks = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
            var week = weeks[day];//显示为星期几
            var hour = time.getHours();
            var minutes = time.getMinutes();
            var seconds = time.getSeconds();
            //console.log(seconds);
            if(month<10){
                month = "0"+month;
            }
            if(date<10){
                date = "0"+date;
            }
            if(hour<10){
                hour = "0"+hour;
            }
            if(minutes<10){
                minutes = "0"+minutes;
            }
            if(seconds<10){
                seconds = "0"+seconds;
            }
            //var newDate = year+"年"+month+"月"+date+"日"+week+hour+":"+minutes+":"+seconds;
            document.getElementById("show").innerHTML = year+"-"+month+"-"+date+" "+week+hour+":"+minutes+":"+seconds;
            setTimeout('run()',1000);
        }

        run();



    </script>
    </body>
</html>
