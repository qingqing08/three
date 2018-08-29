@include('layouts.header')
<form class="layui-form" action="">
	<div class="layui-form-item" >
    <input type="hidden" name="id" value="{{@$department->id}}" >
	    <label class="layui-form-label">部门名称</label>
	    <div class="layui-input-inline">
	      <input type="text" name="department_name" required  lay-verify="required" placeholder="请输入部门名称" value="{{@$department->department_name}}" autocomplete="off" class="layui-input">
	    </div>
	</div>
	<div class="layui-form-item">
    	<div class="layui-input-block">
      		<input type="button" class="layui-btn"  id="btn" value="修改" >
      		<button type="reset" class="layui-btn layui-btn-primary">重置</button>
    	</div>
	</div>
</form>
<script type="text/javascript">

layui.use('layer', function(){
  var layer = layui.layer;


	$('#btn').click(function(){

		var department_name    =  $('input[name=department_name]').val();
    var id    =  $('input[name=id]').val();

		$.ajaxSetup({
        	headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    	});

		$.ajax({ 
			url:"department-modify-do",
    		type:"post",
    		data:{
			department_name:department_name,
      id:id
		},
    	success:function(result){
    		// console.log(result);
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