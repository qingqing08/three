<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>基于layui的日历记事本</title>
  <link rel="stylesheet" href="/static/layui/css/layui.css">
  <link rel="stylesheet" href="/static/css/date.css">
</head>
<body>
 
<!-- 你的HTML代码 -->
@csrf
<div class="layui-container" style="padding: 15px;">  
  <div class="layui-row">
    <div class="layui-col-md12">
    <blockquote class="layui-elem-quote">基于layui的日历记事本</blockquote>
    <div class="layui-inline" id="test-n2" ></div>
    </div>
  </div>
</div>


<div id='memorandum' style="height: 200px;width: 200px; border: 1px solid #000;display: none;"></div>
 
<script src="/static/layui/layui.js"></script>
<script>


layui.use(['layer', 'form','jquery','laydate'], function() {
	var layer = layui.layer,
		$ = layui.jquery,
		laydate = layui.laydate,
		form = layui.form;
		

		
			
		//定义json	
		var  data={};
		
		var new_date = new Date();
		loding_date(new_date ,data);


		//日历插件调用方法  
		function loding_date(date_value,data){
		
		  laydate.render({
		    elem: '#test-n2'
		    ,type: 'date'
		    ,theme: 'grid'
		    ,max: '2099-06-16 23:59:59'
		    ,position: 'static'
		    ,range: false
		    ,value:date_value
		    ,calendar: true
		    ,btns:false
		    ,done: function(value, date, endDate){
		      // console.log(value); //得到日期生成的值，如：2017-08-18
		      // console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
		      // console.log(endDate); //得结束的日期时间对象，开启范围选择（range: true）才会返回。对象成员同上。
		      //layer.msg(value)
		      
		      //调用弹出层方法
		      date_chose(value,data);
		      find_chose(value);
		    }
		   , mark:data//重要json！
		   
		  });
		}




  		/** 查询当日日程 */
  		function find_chose(date){
		  $.ajax({
                url:"calendar-list",
                type:"get",
                data:{
                    'date':date,
                },
                cache:false,
                async:false,
                success:function (data){
                	$("#memorandum").html(data);
                	$("#memorandum").css('display' , 'block');
                }
            })
  		}
  

  
	  //获取隐藏的弹出层内容
	  var date_choebox = $('.date_box').html();
  
	  //定义弹出层方法
	  function date_chose(obj_date,data){
	  	alert(obj_date);
	      var index = layer.open({
	      type: 1,
	      skin: 'layui-layer-rim', //加上边框
	      title:'添加记录',
	      area: ['400px', 'auto'], //宽高
	      btn:['确定','撤销','取消'],
	      content: '<div class="text_box">'+
	      		'<form class="layui-form" action="">'+
	      		 '<div class="layui-form-item layui-form-text">'+
						     ' <textarea id="text_book" placeholder="请输入内容"  class="layui-textarea"></textarea>'+
						  '</div>'+
	      		'</form>'+
	      		'</div>'
	      ,success:function(){
	      		$('#text_book').val(data[obj_date])
	      	}
	      ,yes:function (){
	        //调用添加/编辑标注方法
	        if($('#text_book').val()!=''){
	        	// console.log(obj_date);
	        	// console.log(data);
	        	 chose_moban(obj_date,data);
	        	layer.close(index); 
	        }else{
	        	 layer.msg('不能为空', {icon: 2});
	        }
	       
	      },btn2:function (){
	        chexiao(obj_date,data);
	      }
	    });

	  }
  




		//定义添加/编辑标注方法
		function chose_moban(obj_date,markJson){
			// console.log(obj_date)
			// console.log(markJson)
		  //获取弹出层val
		  var chose_moban_val = $('#text_book').val();
		  // console.log(chose_moban_val);
		  $('#test-n2').html('');//重要！由于插件是嵌套指定容器，再次调用前需要清空原日历控件
		  var token = $("input[name=_token]").val();
		  $.ajax({
                url:"calendar-add-do",
                type:"post",
                dataType:"json",
                data:{
                    'memorandum':chose_moban_val,
                    'date':obj_date,
                    '_token':token
                },
                cache:false,
                async:false,
                success:function (data){
                    if (data.code == 1) {
                        layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                            location.href = "calendar-add";
                        });
                    } else {
                        layer.msg(data.msg, {icon: data.code});
                    }

                }
            })
 

		    //添加属性 
		    markJson[obj_date] = chose_moban_val;
		    // console.log(JSON.stringify(markJson));
		    //再次调用日历控件，
		    loding_date(obj_date,markJson);//重要！，再标注一个日期后会刷新当前日期变为初始值，所以必须调用当前选定日期。
		  	
		}


		//撤销选择
		function chexiao(obj_date,markJson){
		    //删除指定日期标注
		    delete markJson[obj_date]; 
		    console.log(JSON.stringify(markJson));
		    //原理同添加一致
		    $('#test-n2').html('');
		    loding_date(obj_date,markJson);
		
		}

	
});</script> 
</body>
</html>
