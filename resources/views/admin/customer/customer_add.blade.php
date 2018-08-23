@include('layouts.header')
<form class="layui-form" action="">
<div class="layui-form-item" style="float:left;" >
    <label class="layui-form-label">用户姓名</label>
    <div class="layui-input-block">
      <input type="text" name="customer_name" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item"  style="float:left;">
    <label class="layui-form-label">客户联系方式</label>
    <div class="layui-input-block">
      <input type="text" name="mobile" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
 </div>

 <div class="layui-form-item">
    <label class="layui-form-label">客户类型</label>
    <div class="layui-input-block">
      <select name="customer_type" lay-verify="required">
      	<option selected>--请选择--</option>
      	@foreach($type as $v)
        <option value="{{@$v->id}}">{{@$v->type_name}}</option>
        @endforeach 
      </select>
    </div>
</div>

<div class="layui-form-item" style="float: left;" >
    <label class="layui-form-label">网络</label>
    <div class="layui-input-block">
      <input type="text" name="network" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
</div>


<div class="layui-form-item">
    <label class="layui-form-label">客户级别</label>
    <div class="layui-input-block">
      <select name="customer_level" lay-verify="required">
      	<option selected>--请选择--</option>
      	@foreach($level as $vv)
        <option value="{{@$vv->id}}">{{@$vv->level_name}}</option>
        @endforeach 
      </select>
    </div>
</div>


<div class="layui-form-item" style="float: left;" >
    <label class="layui-form-label">客户来源</label>
    <div class="layui-input-block">
      <input type="text" name="customer_source" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
</div>


<div class="layui-form-item"  style="float:left;">
    <label class="layui-form-label">客户联系方式</label>
    <div class="layui-input-block">
      <input type="text" name="other_connections" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
 </div>

<!-- 三级联动
 <div class="layui-form-item">
    <label class="layui-form-label">用户地址 三级联动</label>
    <div class="layui-input-block">
      <select style="width: 100px height40px;"    name="city" lay-verify="required">
        <option value="" ></option>
      </select>
       <select  style="width: 100px height40px;"  name="city" lay-verify="required">
        <option value="" ></option>
      </select>
       <select style="width: 100px height40px;"   name="city" lay-verify="required">
        <option value="" ></option>
      </select>
    </div>
</div>-->

    
<div class="layui-input-block" style="overflow: auto;" >
	<label class="layui-form-label">主营项目</label>
      <textarea name="main_project" style="width: 300px; height: 100px;" placeholder="请输入内容" class="layui-textarea"></textarea>
</div>
<div class="layui-form-item layui-form-text" >
    <label class="layui-form-label">备注</label>
    <div class="layui-input-block">
      <textarea name="remarks" style="width: 300px; height: 100px;" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" id="btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</div>
</form>

<script type="text/javascript">

layui.use('form', function(){
         var form = layui.form;

	$('#btn').click(function(){
		// alert('你好')
		var customer_name     =  $('input[name=customer_name]').val();
		var mobile            =  $('input[name=mobile]').val();
		var customer_type     =  $('input[name=customer_type]').val();
		var network           =  $('input[name=network]').val();
		var customer_level    =  $('input[name=customer_level]').val();
		var customer_source   =  $('input[name=customer_source]').val();
		var other_connections =  $('input[name=other_connections]').val();
		var main_project      =  $('input[name=main_project]').val();
		var remarks           =  $('input[name=remarks]').val();

		if(customer_name==""){
			layer.msg(['msg'=>'用户姓名不能为空','code'=>2]);
		}
	});

});
</script>