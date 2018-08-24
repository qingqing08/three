@include('layouts.header')
<form class="layui-form" action="">
	<input type="hidden" name="id" id="id" value="{{@$data->id}}">
	 <div class="layui-form-item">
	    <label class="layui-form-label">跟单类型</label>
	    <div class="layui-input-inline">
	      <select name="t_id" id="t_id" lay-verify="required">
	      	<option selected value="{{@$data->type_id}}">{{@$data->type_name}}</option>
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
	      	<option value="{{@$data->customer_id}}"selected >{{@$data->customer_name}}</option>
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
	      	<option selected value="{{@$data->schedule_id}}">{{@$data->schedule_name}}</option>
	      	@foreach($schedule as $vue)
	        <option value="{{@$vue->id}}">{{@$vue->name}}</option>
	        @endforeach 
	      </select>
	    </div>
	</div>

	<div class="layui-form-item" >
	    <label class="layui-form-label">下次联系</label>
	    <div class="layui-input-inline">
	      <input type="text" name="next_time" required  lay-verify="required" placeholder="请输入下次联系时间" value="{{@$data->next_time}}"  autocomplete="off" class="layui-input">
	    </div>
	</div>

	<div class="layui-form-item" >
	    <label class="layui-form-label">提醒时间</label>
	    <div class="layui-input-inline">
	      <input type="text" name="remind" required  lay-verify="required" placeholder="请输入提醒时间" value="{{@$data->remind}}"  autocomplete="off" class="layui-input">
	    </div>
	</div>
<div class="layui-input-item" >
	<label class="layui-form-label">详细内容</label>
      <textarea name="describe" id="describe" style="width: 300px; height: 100px;" placeholder="请输入内容" class="layui-textarea">{{@$data->describe}}</textarea>
</div>

<div class="layui-form-item">
    <div class="layui-input-block">
      <input type="button" class="layui-btn"  id="btn" value="确认修改" >
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</div>
</form>

</script>
<script type="text/javascript">

layui.use('layer', function(){
  var layer = layui.layer;


	$('#btn').click(function(){
		var id            =  $('#id').val();
		// alert(id);return false;
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
			url:"documentary-modify-do",
    		type:"post",
    		data:{
    		id:id,
			t_id:t_id,
			customer_id:customer_id,
			s_id:s_id,
			remind:remind,
			next_time:next_time,
			describe:describe,
		},
    	success:function(result){
    		// console.log(result);
   			if (result.code == 1) {
              layer.msg(result.msg, {icon: result.code, time: 1500}, function () {
            //获得form 索引
                  var index = parent.layer.getFrameIndex(window.name);
            //关闭当前fram 并刷新模块
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