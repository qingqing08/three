@include('layouts.header')
<body>
<div class="x-body">
    <form class="layui-form">
      @csrf
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>用户名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="username" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>省市区
            </label>
            <div class="layui-input-inline">
                <select name="province" lay-filter="province" class="province">
      							<option value="">请选择省</option>
      					</select>
      					<select name="city" lay-filter="city" disabled>
                    <option value="">请选择市</option>
                </select>
      					<select name="area" lay-filter="county" disabled>
                    <option value="">请选择县</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>收货人
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="username" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>手机
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" name="phone" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>收货地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="username" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>配送物流
            </label>
            <div class="layui-input-inline">
                <select id="shipping" name="shipping" class="valid">
                    <option value="shentong">申通物流</option>
                    <option value="shunfeng">顺丰物流</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>支付方式
            </label>
            <div class="layui-input-inline">
                <select name="contrller">
                    <option>支付方式</option>
                    <option>支付宝</option>
                    <option>微信</option>
                    <option>货到付款</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>发票抬头
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="email" required="" lay-verify="email"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label for="desc" class="layui-form-label">
                商品增加
            </label>
            <div class="layui-input-block">
                <table class="layui-table">
                    <tbody>
                    <tr>
                        <td>haier海尔 BC-93TMPF 93升单门冰箱</div></td>
            <td>0.01</div></td>
        <td>984</div></td>
<td>1</td>
<td>删除</td>
</tr>
<tr>
    <td>haier海尔 BC-93TMPF 93升单门冰箱</div></td>
    <td>0.01</div></td>
    <td>984</div></td>
    <td>1</td>
    <td>删除</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="layui-form-item layui-form-text">
    <label for="desc" class="layui-form-label">
        描述
    </label>
    <div class="layui-input-block">
        <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"></textarea>
    </div>
</div>
<div class="layui-form-item">
    <label for="L_repass" class="layui-form-label">
    </label>
    <button  class="layui-btn" lay-filter="add" lay-submit="">
        增加
    </button>
</div>
</form>
</div>
<script type="text/javascript" src="address.js"></script>
<script>
    layui.config({
			// base : "address.js" //address.js的路径
		}).use([ 'layer', 'jquery', "address" ], function() {
			var layer = layui.layer, $ = layui.jquery, address = layui.address();

		});
    layui.use(['form','layer','address'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function(value){
                if(value.length < 5){
                    return '昵称至少得5个字符啊';
                }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
        });

        // form.on('select(province)', function (proData) {
        //     var value = proData.value;
      	// 		var token = $('input[name=_token]').val();
        //     $.ajax({
      	// 			url:'get_city',
      	// 			type:'post',
      	// 			data:{
      	// 				_token:token,
      	// 				parent_id:value,
      	// 			},
      	// 			cache:false,
      	// 			async:false,
      	// 			success:function (msg){
      	// 				var str = "<option value='0'>请选择</option>";
        //         $("select[name=city]").html(str+msg.data);
        //         $("select[name=city]").removeAttr("disabled");
        //         $("select[name=county]").html(str).removeAttr("disabled");
        //         form.render();
      	// 			}
      	// 		})
        // });
        //
        // form.on('select(city)', function (proData) {
        //     var value = proData.value;
      	// 		var token = $('input[name=_token]').val();
        //     $.ajax({
      	// 			url:'get_city',
      	// 			type:'post',
      	// 			data:{
      	// 				_token:token,
      	// 				parent_id:value,
      	// 			},
      	// 			cache:false,
      	// 			async:false,
      	// 			success:function (msg){
      	// 				var str = "<option value='0'>请选择</option>";
        //         $("select[name=county]").html(str+msg.data);
        //         $("select[name=county]").removeAttr("disabled");
        //         form.render();
      	// 			}
      	// 		})
        // });


        //监听提交
        form.on('submit(add)', function(data){
            console.log(data);
            //发异步，把数据提交给php
            layer.alert("增加成功", {icon: 6},function () {
                // 获得frame索引
                var index = parent.layer.getFrameIndex(window.name);
                //关闭当前frame
                parent.layer.close(index);
            });
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
