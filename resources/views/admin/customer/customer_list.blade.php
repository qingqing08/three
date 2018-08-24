@include('layouts.header')
<fieldset class="layui-elem-field">
            <legend>客户列表</legend>
            <div class="layui-field-box">
        <!-- <input class="layui-btn layui-btn-primary" type="button" value='新增用户' id='cus'> -->
        <button class="layui-btn layui-btn-primary" onclick="x_admin_show('新增客户','customer-add')"><i class="layui-icon"></i>添加</button>
                <table class="layui-table" style="text-align: center; font: 6px;" >
                        
                    <tbody>
                        <tr>
                            <!-- <th>客户编号</th> -->
                            <th><b>客户名称</b></td>
                            <th><b>客户联系方式</b></td>
                            <th><b>省份</b></td>
                            <th><b>城市</b></td>
                            <th><b>详细地址</b></td>
                            <th><b>备用联系方式</b></td>
                            <th><b>客户类型</b></td>
                            <!-- <th><b>网络</b></td> -->
                            <th><b>客户级别</b></td>
                            <th><b>客户来源</b></td>
                            <th><b>其他联系方式</b></td>
                            <th><b>主营项目</b></td>
                            <th><b>备注</b></td>
                            <th><b>操作</b></td>
                        </tr>
                        @foreach($data as $v)
                        <tr>
                            <td style="font-size: 4px;">{{@$v->customer_name}}</td>
                            <td style="font-size: 4px;">{{@$v->mobile}}</td>
                            <td style="font-size: 4px;">{{@$v->province}}</td>
                            <td style="font-size: 4px;">{{@$v->city}}</td>
                            <td style="font-size: 4px;">{{@$v->address}}</td>
                            <td style="font-size: 4px;">{{@$v->spare_mobile}}</td>
                            <td style="font-size: 4px;">{{@$v->type_name}}</td>
                            <!-- <td style="font-size: 4px;">{{@$v->network}}</td> -->
                            <td style="font-size: 4px;">{{@$v->level_name}}</td>
                            <td style="font-size: 4px;">{{@$v->customer_source}}</td>
                            <td style="font-size: 4px;">{{@$v->other_connections}}</td>
                            <td style="font-size: 4px;">{{@$v->main_project}}</td>
                            <td style="font-size: 4px;">{{@$v->remarks}}</td>
                            <td>
                            <button class="layui-btn layui-btn-sm" onclick="x_admin_show('修改客户信息','customer-modify?id={{@$v->id}}')">
                                <i class="layui-icon"></i>修改</button>
                                <br>
                                <br>
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
            url:"customer-delete",
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