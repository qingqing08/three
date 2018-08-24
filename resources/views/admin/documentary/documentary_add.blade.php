@include('layouts.header')
<form class="layui-form" action="">
	 <div class="layui-form-item">
	    <label class="layui-form-label">跟单类型</label>
	    <div class="layui-input-inline">
	      <select name="t_id" id="t_id" lay-verify="required">
	      	<option value="0">--请选择--</option>
	      	@foreach($type as $v)
	        <option value="{{@$v->id}}">{{@$v->name}}</option>
	        @endforeach 
	      </select>
	    </div>
	</div>

	 <div class="layui-form-item">
	    <label class="layui-form-label">客户名称</label>
	    <div class="layui-input-inline">
	      <select name="customer_id" id="customer_id" lay-verify="required">
	      	<option value="0">--请选择--</option>
	      	@foreach($customer as $vv)
	        <option value="{{@$vv->id}}">{{@$vv->customer_name}}</option>
	        @endforeach 
	      </select>
	    </div>
	</div>

	 <div class="layui-form-item">
	    <label class="layui-form-label">联系进度</label>
	    <div class="layui-input-inline">
	      <select name="s_id" id="s_id" lay-verify="required">
	      	<option value="0">--请选择--</option>
	      	@foreach($schedule as $vue)
	        <option value="{{@$vue->id}}">{{@$vue->name}}</option>
	        @endforeach 
	      </select>
	    </div>
	</div>

	<div class="layui-form-item" >
	    <label class="layui-form-label">下次联系</label>
	    <div class="layui-input-inline">
	      <input type="text" name="next_time" required  lay-verify="required" placeholder="请输入下次联系时间" autocomplete="off" class="layui-input">
	    </div>
	</div>

	<div class="layui-form-item" >
	    <label class="layui-form-label">提醒时间</label>
	    <div class="layui-input-inline">
	      <input type="text" name="remind" required  lay-verify="required" placeholder="请输入提醒时间" autocomplete="off" class="layui-input">
	    </div>
	</div>
<div class="layui-input-item" >
	<label class="layui-form-label">详细内容</label>
      <textarea name="describe" id="describe" style="width: 300px; height: 100px;" placeholder="请输入内容" class="layui-textarea"></textarea>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
      <input type="button" class="layui-btn"  id="btn" value="添加跟单" >
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
		var t_id          =  $('#t_id').val();
		var customer_id   =  $('#customer_id').val();
		var s_id     	  =  $('#s_id').val();
		var next_time        =  $('input[name=next_time]').val();
		var remind 		  =  $('input[name=remind]').val();
		var describe      =  $('#describe').val();
		$.ajaxSetup({
        	headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    	});

		$.ajax({ 
			url:"documentary-add-do",
    		type:"post",
    		data:{
			t_id:t_id,
			customer_id:customer_id,
			s_id:s_id,
			remind:remind,
			next_time:next_time,
			describe:describe,
		},
    	success:function(result){
    		console.log(result);
   			if (result.code == 1) {
              layer.msg(result.msg, {icon: result.code, time: 1500}, function () {
            //获得form 索引
                  var index = parent.layer.getFrameIndex(window.name);
            //关闭当前fram
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