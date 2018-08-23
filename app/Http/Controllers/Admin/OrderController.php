<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class OrderController extends Controller
{
	/** 订单新增页面 */
    public function create_order(){
    	$arr=session()->get('info');
    	$arr=get_object_vars($arr);
    	$add_man=$arr['id'];
		$kehu=DB::table('customer')->select('customer_name','id')->where('add_man',$add_man)->get()->map(function ($value) {
                return (array)$value;
            })->toArray();

		$cust_id=DB::table('customer_share')->select('customer_id')->where('staff_id',$add_man)->get()->map(function ($value) {
                return (array)$value;
            })->toArray();
		// print_r($cust_id);exit;
		if($cust_id){
			$data = [];
			foreach ($cust_id as $k => $v) {
				$data=DB::table('customer')->select('customer_name','id')->where('id',$v['customer_id'])->first();
				$cust[]=get_object_vars($data);
			}
		}
		foreach ($kehu as $k => $v) {
				$date[]=$v;
		}
		foreach ($cust as $key => $value) {
				$date[]=$value;
			}
		// print_r($date);exit;
		return view('admin.order.create',['title'=>'订单新增','data'=>$date]);   		
    }

	/** 执行创建订单操作 */
    public function create_order_do(){
    	$arr=input::post();
    	unset($arr['_token']);
    	$arr1=session()->get('info');
    	$arr2=get_object_vars($arr1);
    	$s_id=$arr2['id'];
    	$arr['s_id']=$s_id;
    	$arr['order_num']=date('YmdHis').rand(000000,999999);
    	$arr['c_time']=time();
    	$res=DB::table('order')->insert($arr);
		 if($res){
            return ['msg'=>'添加成功	','code'=>1];
        }else{
            return ['msg'=>'添加失败','code'=>0];
        }
    }
    /** 订单展示 */
    public function order_list(){
    	$arr=session()->get('info');
    	$arr=get_object_vars($arr);
    	$s_id=$arr['id'];
    	$info=DB::table('order')
    	->join('customer','customer.id','order.c_id')
    	->where('s_id',$s_id)->get()->map(function ($value) {
                return (array)$value;
            })->toArray();
    	// print_r($info);exit;
    	return view('admin.order.order_list',['title'=>'订单列表','info'=>$info]);
    }

    /** 订单删除 */
    public function order_delete(){
    	$id=input::get('id');
    	$res=DB::table('order')->where('o_id',$id)->delete();
    	if($res){
            return ['msg'=>'删除成功	','code'=>1];
        }else{
            return ['msg'=>'删除失败','code'=>0];
        }
    }
}
