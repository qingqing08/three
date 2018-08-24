@include('layouts.header')
<fieldset class="layui-elem-field">
            <legend>跟单列表</legend>
            <div class="layui-field-box">
        <!-- <input class="layui-btn layui-btn-primary" type="button" value='新增用户' id='cus'> -->
        <button class="layui-btn layui-btn-primary" onclick="x_admin_show('新增跟单','documentary-add')"><i class="layui-icon"></i>添加</button>
                <table class="layui-table" style=" font: 6px;" >
                        
                    <tbody>
                        <tr>
                            <!-- <th>客户编号</th> -->
                            <th><b>跟单类型</b></td>
                            <th><b>客户名称</b></td>
                            <th><b>联系进度</b></td>
                            <th><b>下次联系时间</b></td>
                            <th><b>提醒时间</b></td>
                            <th><b>详细内容</b></td>
                            <th><b>业务员</b></td>
                            <th><b>操作</b></td>
                        </tr>
                        @foreach($data as $v)
                        <tr>
                            <td style="font-size: 4px;">{{@$v->type_name}}</td>
                            <td style="font-size: 4px;">{{@$v->customer_name}}</td>
                            <td style="font-size: 4px;">{{@$v->schedule_name}}</td>
                            <td style="font-size: 4px;">{{@$v->next_time}}</td>
                            <td style="font-size: 4px;">{{@$v->remind}}</td>
                            <td style="font-size: 4px;">{{@$v->describe}}</td>
                            <td style="font-size: 4px;">{{@$v->staff_name}}</td>
                            <td>
                            <button class="layui-btn layui-btn-sm" onclick="x_admin_show('修改客户信息','documentary-modify?id={{@$v->id}}')">
                                <i class="layui-icon"></i>编辑</button>

                                <button class="layui-btn layui-btn-sm" 
                                 onclick="del({{$v->id}})">
                                <i class="layui-icon"></i>删除</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </fieldset>


<script type="text/javascript">
    function del(id){   
     layui.use('layer', function(){
  var layer = layui.layer;
    $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
            url:"documentary-delete",
            type:"post",
            data:{id:id},
            success:function(result){
            if (result.code == 1) {
              layer.msg(result.msg, {icon: result.code, time: 1500}, function () {
                    window.location.reload();
              });
          } else {
              layer.msg(result.msg, {icon: result.code});
          }
            }
        })
    });
    }
</script>