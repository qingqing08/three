@include('layouts.header')
<form class="layui-form" action="">
	<input type="hidden" value="{{@$info->id}}" name="id">
	<div class="layui-form-item">
	    <label class="layui-form-label">用户姓名</label>
	    <div class="layui-input-inline">
	      <input type="text" name="customer_name" required  lay-verify="required" placeholder="请输入标题" value="{{@$info->customer_name}}" autocomplete="off" class="layui-input">
	    </div>
	</div>

	<div class="layui-form-item"  >
	    <label class="layui-form-label">客户联系方式</label>
	    <div class="layui-input-inline">
	      <input type="text" name="mobile" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" value="{{@$info->mobile}}" class="layui-input">
	    </div>
	 </div>

	 <div class="layui-form-item">
	    <label class="layui-form-label">客户类型</label>
	    <div class="layui-input-inline">
	      <select name="customer_type" id="customer_type" lay-verify="required">
	      	<option selected value="{{$info->type_id}}" >{{@$info->type_name}}</option>
	      	@foreach($type as $v)
	        <option value="{{@$v->id}}">{{@$v->type_name}}</option>
	        @endforeach 
	      </select>
	    </div>
	</div>

	<div class="layui-form-item" >
	    <label class="layui-form-label">网络</label>
	    <div class="layui-input-inline">
	      <input type="text" name="network" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" value="{{@$info->network}}" class="layui-input">
	    </div>
	</div>


	<div class="layui-form-item">
	    <label class="layui-form-label">客户级别</label>
	    <div class="layui-input-inline">
	      <select name="customer_level" id="customer_level" lay-verify="required">
	      	<option selected value="{{@$info->level_id}}" >{{@$info->level_name}} </option>
	      	@foreach($level as $vv)
	        <option value="{{@$vv->id}}">{{@$vv->level_name}}</option>
	        @endforeach 
	      </select>
	    </div>
	</div>


	<div class="layui-form-item" >
	    <label class="layui-form-label">客户来源</label>
	    <div class="layui-input-inline">
	      <input type="text" name="customer_source" required  lay-verify="required" placeholder="请输入标题" value="{{@$info->customer_source}}" autocomplete="off" class="layui-input">
	    </div>
	</div>


	<div class="layui-form-item" >
	    <label class="layui-form-label">客户联系方式</label>
	    <div class="layui-input-inline">
	      <input type="text" name="other_connections"   placeholder="请输入标题" autocomplete="off" class="layui-input" value="{{@$info->other_connections}}" >
	    </div>
	 </div>

<!-- 三级联动-->
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>省市区
            </label>
            <div class="layui-input-inline">
                <select name="province" id="province" lay-filter="province" class="province">
      							<option value="">{{@$info->province}}</option>
      					</select>
      					<select name="city" id="city" lay-filter="city" disabled>
                    <option value="">{{@$info->city}}</option>
                </select>
      					<select name="area" id="address" lay-filter="county" disabled>
                    <option value="">{{@$info->address}}</option>
                </select>
            </div>
        </div>
<div class="layui-input-item" >
	<label class="layui-form-label">主营项目</label>
      <textarea name="main_project" id="main_project" style="width: 300px; height: 100px;" placeholder="请输入内容" class="layui-textarea">{{@$info->main_project}}</textarea>
</div>
<div class="layui-form-item layui-form-text" >
    <label class="layui-form-label">备注</label>
    <div class="layui-input-block">
      <textarea name="remarks" id="remarks" style="width: 300px; height: 100px;" placeholder="请输入内容" class="layui-textarea">{{@$info->remarks}}</textarea>
    </div>
</div>
<div class="layui-form-item">
    <div class="layui-input-block">
      <input type="button" class="layui-btn"  id="btn" value="修改" >
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</div>
</form>
<script type="text/javascript" src="address.js"></script>
<script>
    layui.config({
			// base : "address.js" //address.js的路径
		}).use([ 'layer', 'jquery', "address" ], function() {
			var layer = layui.layer, $ = layui.jquery, address = layui.address();
		});
</script>
<script type="text/javascript">

layui.use('layer', function(){
  var layer = layui.layer;


	$('#btn').click(function(){
		var id                =  $('input[name=id]').val();
		var customer_name     =  $('input[name=customer_name]').val();
		var mobile            =  $('input[name=mobile]').val();
		var customer_type     =  $('#customer_type').val();
		var network           =  $('input[name=network]').val();
		var customer_level    =  $('#customer_level').val();
		var customer_source   =  $('input[name=customer_source]').val();
		var other_connections =  $('input[name=other_connections]').val();
		var main_project      =  $('#main_project').val();
		var remarks           =  $('#remarks').val();
		var province          =  $("#province").find("option:selected").text();
		var city              =  $("#city").find("option:selected").text();
		var address           =  $("#address").find("option:selected").text();

		$.ajaxSetup({
        	headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    	});

		$.ajax({ 
			url:"customer-modify-do",
    		type:"post",
    		data:{
    		id:id,
			customer_name:customer_name,
			mobile:mobile,
			customer_type:customer_type,
			network:network,
			customer_level:customer_level,
			customer_source:customer_source,
			other_connections:other_connections,
			main_project:main_project,
			remarks:remarks,
			province:province,
			city:city,
			address:address
		},
    	success:function(result){
    		
   			if (result.code == 1) {
              layer.msg(result.msg, {icon: result.code, time: 1500}, function () {
              	window.location.href='customer-list';

                  var index = parent.layer.getFrameIndex(window.name);

                  layer.close(layer.index);
                      window.parent.location.reload();
              });
          } else {
              layer.msg(result.msg, {icon: result.code});
          }

    		}
		});
		  });
	 });
</script>