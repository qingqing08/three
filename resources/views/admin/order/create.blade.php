@include('layouts.header')
<body>
  @if($data!=null)
<div class="x-body">
    <form class="layui-form">
      @csrf
        <!-- <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>用户名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="c_id" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div> -->
         <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>收货人
            </label>
            <div class="layui-input-inline">
               <div class="layui-input-inline">
                
                <select name="c_id" id="c_id" lay-filter="" >
                    <option value="">请选择用户</option>
               @foreach($data as $v)
                        <option value="{{@$v['id']}}">{{@$v['customer_name']}}</option>
                 @endforeach
                       </select>
            </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>省市区
            </label>
            <div class="layui-input-inline">
                <select name="province" id="province" lay-filter="province" class="province">
      							<option value="">请选择省</option>
      					</select>
      					<select name="city" id="city" lay-filter="city" disabled>
                    <option value="">请选择市</option>
                </select>
      					<select name="area" id="address" lay-filter="county" disabled>
                    <option value="">请选择县</option>
                </select>
            </div>
        </div>
       
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>联系电话
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" name="mobile" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input">
            </div>
        <div class="layui-form-item">
            <label for="phone" class="layui-form-label">
                <span class="x-red">*</span>备用电话
            </label>
            <div class="layui-input-inline">
                <input type="text" id="phone" name="spare_mobile" required="" lay-verify="phone"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>详细地址
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="address" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
         <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>业务
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="business" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        </div>
         <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>待收款
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="collection_price" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>订单金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="price" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>优惠金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="discount_price" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>实收金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="amount_collected" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>打款金额
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="make_money" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>打款方式
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="make_way" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>交货方式
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="delivery_mode" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>运费
            </label>
            <div class="layui-input-inline">
                <input type="text" id="username" name="freight" required="" lay-verify="required"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="username" class="layui-form-label">
                <span class="x-red">*</span>备注
            </label>
            <div class="layui-input-inline">
                    <textarea id="remarks"  placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>


<div class="layui-form-item">
    <label for="L_repass" class="layui-form-label">
    </label>
    <button  class="layui-btn"  lay-filter="add" lay-submit="">
        增加
    </button>
</div> 
</form>
</div>
                   @else
                    您当前没有用户
                  @endif
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
/*
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
        // });*/
        //监听提交
    form.on('submit(add)', function(data){
        // alert(1231231);
                          // var c_id              =   $("input[name=c_id]").val();//客户
                          var c_id    =  $('#c_id').val();//客户
                          // alert(c_id);return;
                          var province          =   $("#province").find("option:selected").text();//省份
                          var city              =   $("#city").find("option:selected").text();//城市8
                          // alert(province);
                          // alert(city);return false;
                          var mobile            =   $("input[name=mobile]").val();//联系电话
                          var spare_mobile      =   $("input[name=spare_mobile]").val();//备用电话
                          var business          =   $("input[name=business]").val();//业务
                          var collection_price  =   $("input[name=collection_price]").val();//待收款
                          var address           =   $("input[name=address]").val();//详细地址
                          var price             =   $("input[name=price]").val();//订单金额
                          var discount_price    =   $("input[name=discount_price]").val();//优惠金额
                          var amount_collected  =   $("input[name=amount_collected]").val();//实收金额
                          var make_money        =   $("input[name=make_money]").val();//打款金额
                          var make_way          =   $("input[name=make_way]").val();//打款方式
                          var delivery_mode     =   $("input[name=delivery_mode]").val();//交货方式
                          var freight           =   $("input[name=freight]").val();//运费
                          var order_remarks     =   $("#remarks").val();//备注
                           var token            =   $("input[name=_token]").val();//token

                          $.ajax({
                              url:"create-order-do",
                              type:"post",
                              dataType:"json",
                              data:{
                                _token          :   token,
                                c_id            :   c_id,
                                province        :   province,
                                city            :   city,
                                mobile          :   mobile,
                                spare_mobile    :   spare_mobile,
                                business        :   business,
                                collection_price:   collection_price,
                                address         :   address,
                                price           :   price,
                                discount_price  :   discount_price,
                                amount_collected:   amount_collected,
                                make_money      :   make_money,
                                make_way        :   make_way,
                                delivery_mode   :   delivery_mode,
                                freight         :   freight,
                                order_remarks         :   order_remarks
                              },
                              cache:false,
                              async:false,
                              success:function (data){
                                  if (data.code == 1) {
                                      layer.msg(data.msg, {icon: data.code, time: 1500}, function () {
                                          location.href = "order-list";
                                      });
                                  } else {
                                      layer.msg(data.msg, {icon: data.code});
                                  }
                              }
                          })
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
