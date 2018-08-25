{{--加载头部代码--}}
@include('layouts.header')
<body>
<div class="x-body">
    <form class="layui-form">
        <input type="text"  name="id" value="{{$data -> id}}">
        <div class="layui-form-item">
            @csrf
            <label for="deposit" class="layui-form-label">
                <span class="x-red">*</span>定金
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="deposit" required="" autocomplete="off" class="layui-input" value="{{$data ->deposit }}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="rebate" class="layui-form-label">
                <span class="x-red">*</span>返利
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="rebate" required="" autocomplete="off" class="layui-input" value="{{$data -> rebate}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="c_type" class="layui-form-label">
                <span class="x-red">*</span>合同类型
            </label>
            <div class="layui-input-inline">
                <select name="c_type" id="">
                    <option>请选择</option>
                    @foreach($type as $v)
                        @if($v -> id == $data -> c_type)
                            <option value="{{$v -> id}}" selected>{{$v -> name }}</option>
                        @else
                            <option value="{{$v -> id}}" >{{$v -> name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="start_time" class="layui-form-label">
                <span class="x-red">*</span>起始时间
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="start_time" required="" autocomplete="off" class="layui-input" value="{{$data -> start_time}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="end_time" class="layui-form-label">
                <span class="x-red">*</span>结束时间
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="end_time" required="" autocomplete="off" class="layui-input" value="{{$data -> end_time}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="business" class="layui-form-label">
                <span class="x-red">*</span>业务
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="business" required="" autocomplete="off" class="layui-input" value="{{$data -> business}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="project" class="layui-form-label">
                <span class="x-red">*</span>合作项目
            </label>
            <div class="layui-input-inline">
                <input type="text" id="rule_name" name="project" required="" autocomplete="off" class="layui-input" value="{{$data -> project}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="proxy_area" class="layui-form-label">
                <span class="x-red">*</span>代理项目
            </label>
            <div class="layui-input-inline">
                <input type="text" id="proxy_area" name="proxy_area" required="" autocomplete="off" class="layui-input" value="{{$data -> proxy_area}}">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="remarks" class="layui-form-label">
                <span class="x-red">*</span>备注
            </label>
            <div class="layui-input-inline">
                <textarea name="remarks" id="" cols="10" rows="5" autocomplete="off" class="layui-textarea" >{{$data -> remarks}}</textarea>
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button type="button"  class="layui-btn" lay-filter="add" lay-submit="">
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
        form.on('submit(add)', function(data){
            //alert(status);
            // alert(parent_id);
            var id = $("input[name=id]").val();
            var deposit = $("input[name=deposit]").val();
            var rebate = $("input[name=rebate]").val();
            var c_type = $("select[name=c_type]").val();
            var token = $("input[name=_token]").val();
            var start_time = $("input[name=start_time]").val();
            var end_time = $("input[name=end_time]").val();
            var business = $("input[name=business]").val();
            var project = $("input[name=project]").val();
            var proxy_area = $("input[name=proxy_area]").val();
            var remarks = $("textarea[name=remarks]").val();

            $.ajax({
                url:"contract-up-do",
                type:"post",
                dataType:"json",
                data:{
                    'id':id,
                    'deposit':deposit,
                    'rebate':rebate,
                    'c_type':c_type,
                    'start_time':start_time,
                    'end_time':end_time,
                    'business':business,
                    'project':project,
                    'proxy_area':proxy_area,
                    'remarks':remarks,
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
