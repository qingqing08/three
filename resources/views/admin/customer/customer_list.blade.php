@include('layouts.header')
<fieldset class="layui-elem-field">
            <legend>客户列表</legend>
            <div class="layui-field-box">
        <!-- <input class="layui-btn layui-btn-primary" type="button" value='新增用户' id='cus'> -->
        <button class="layui-btn layui-btn-primary" onclick="x_admin_show('新增客户','customer-add')"><i class="layui-icon"></i>添加</button>
                <table class="layui-table" style="text-align: center; font: 6px;" >
                        
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th><b>客户名称</b></td>
                            <th><b>客户联系方式</b></td>
                            <th><b>省份</b></td>
                            <th><b>城市</b></td>
                            <th><b>详细地址</b></td>
                            <th><b>备用联系方式</b></td>
                            <th><b>客户类型</b></td>
                            <th><b>网络</b></td>
                            <th><b>客户级别</b></td>
                            <th><b>客户来源</b></td>
                            <th><b>其他联系方式</b></td>
                            <th><b>主营项目</b></td>
                            <th><b>备注</b></td>
                            <th><b>操作</b></td>
                        </tr>
                        @foreach($data as $v)
                        <tr>
                            <th style="font-size: 4px;">{{@$v->id}}</th>
                            <td style="font-size: 4px;">{{@$v->customer_name}}</td>
                            <td style="font-size: 4px;">{{@$v->mobile}}</td>
                            <td style="font-size: 4px;">{{@$v->province}}</td>
                            <td style="font-size: 4px;">{{@$v->city}}</td>
                            <td style="font-size: 4px;">{{@$v->address}}</td>
                            <td style="font-size: 4px;">{{@$v->spare_mobile}}</td>
                            <td style="font-size: 4px;">{{@$v->type_name}}</td>
                            <td style="font-size: 4px;">{{@$v->network}}</td>
                            <td style="font-size: 4px;">{{@$v->level_name}}</td>
                            <td style="font-size: 4px;">{{@$v->customer_source}}</td>
                            <td style="font-size: 4px;">{{@$v->other_connections}}</td>
                            <td style="font-size: 4px;">{{@$v->main_project}}</td>
                            <td style="font-size: 4px;">{{@$v->remarks}}</td>
                            <td>
                    <input class="layui-btn layui-btn-sm" type="button" value="编辑" name="">
                    <br>
                    <input style='margin-top:5px;' class="layui-btn layui-btn-sm" type="button" value="删除" name="">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </fieldset>


<script type="text/javascript">

        </script>