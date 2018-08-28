<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class OrderController extends Controller
{

	//自动验证登录
    public function __construct(){
         $this -> middleware(function ($request, $next) {
            // $r_url = $_SERVER['REQUEST_URI'];
            //验证是否登录
            check_user();
            //验证权限
            check_auth();
            return $next($request);
        });
    }

	/** 订单新增页面 */
    public function create_order(){
        check_user();
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
            $action = "增加了一条订单号为(".$arr['order_num'].")的数据";
            add_log($action);
            return ['msg'=>'添加成功	','code'=>1];
        }else{
            return ['msg'=>'添加失败','code'=>0];
        }
    }
    /** 订单展示 */
    public function order_list(){
        check_user();
    	$arr=session()->get('info');
    	$arr=get_object_vars($arr);
    	$s_id=$arr['id'];
    	$info=DB::table('order')
    	->join('customer','customer.id','order.c_id')
    	->where(['s_id'=>$s_id,'order.is_del'=>1])->paginate(1);
    	// print_r($info);exit;
        // dd($info);
        $count = DB::table('order')
        ->join('customer','customer.id','order.c_id')
        ->where(['s_id'=>$s_id,'order.is_del'=>1])->count();
        // dd($count);
    	return view('admin.order.order_list',['title'=>'订单列表','info'=>$info,'count'=>$count]);
    }

    /** 订单删除 假删，修改状态*/
    public function order_delete(){
    	$id=input::get('id');
        $arr=DB::table('order')->select('order_num')->where('o_id',$id)->get()->map(function ($value) {
                return (array)$value;
            })->toArray();
    	$res=DB::table('order')->where('o_id',$id)->update(['is_del'=>0]);
    	if($res){
            $action = "删除订单号为(".$arr[0]['order_num'].")的数据";
            add_log($action);
            return ['msg'=>'删除成功	','code'=>1];
        }else{
            return ['msg'=>'删除失败','code'=>0];
        }
    }
    /** 订单删除 真删 */
    //  public function order_delete(){
    //     $id=input::get('id');
    //     $arr=DB::table('order')->select('order_num')->where('o_id',$id)->get()->map(function ($value) {
    //             return (array)$value;
    //         })->toArray();
    //     $res=DB::table('order')->where('o_id',$id)->update(['is_del'=>0]);
    //     if($res){
    //         $action = "删除订单号为(".$arr[0]['order_num'].")的数据";
    //         add_log($action);
    //         return ['msg'=>'删除成功    ','code'=>1];
    //     }else{
    //         return ['msg'=>'删除失败','code'=>0];
    //     }
    // }

    /** 订单修改 */
    public function order_modify(){
        check_user();
	    $o_id=input::get('o_id');
	    
	    $res=DB::table('order')->where('o_id',$o_id)->get()->first();
	    $old=get_object_vars($res);
	    // print_r($old);exit;
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

    	return view('admin.order.order_modify',['title'=>'订单修改','data'=>$date,'old'=>$old]); 	
    }

    /** 订单执行修改 */
    public function order_modify_do(){
    	$o_id=input::get('o_id');
    	$arr=input::post();
    	unset($arr['_token']);
    	$res=DB::table('order')->where('o_id',$o_id)->update($arr);
    	if($res){
            $data=DB::table('order')->select('order_num')->where('o_id',$id)->get()->map(function ($value) {
                return (array)$value;
            })->toArray();
            $action = "删除订单号为(".$data[0]['order_num'].")的数据";
            add_log($action);
            return ['msg'=>'修改成功	','code'=>1];
        }else{
            return ['msg'=>'修改失败','code'=>0];
        }
    }
}
