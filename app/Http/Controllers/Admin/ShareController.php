<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class ShareController extends Controller
{
	/** 新增共享 */
    public function share_customer(){
    		$arr=session()->get('info');
    		$arr=get_object_vars($arr);
    		$s_id=$arr['id'];

			$staff=DB::table('staff')->select('id','name')->get()->map(function ($value) {
                return (array)$value;
            })->toArray();

            $customer=DB::table('customer')->select('id','customer_name')->where('add_man',$s_id)->get()->map(function ($value) {
                return (array)$value;
            })->toArray();
    	return view('admin.share.share_customer',['title'=>'共享新增','staff'=>$staff,'customer'=>$customer]);
    }
    /** 执行添加 */
    public function share_customer_do(){
    	$arr=session()->get('info');
    	$arr=get_object_vars($arr);
    	$share_id=$arr['id'];
    	$share=input::post();
    	// dd($share);exit;
    	$share['share_id']=$share_id;
    	$share['c_time']=time();
    	unset($share['_token']);
    	if(DB::table('customer_share')->where(['staff_id'=>$share['staff_id'],'customer_id'=>$share['customer_id'],'share_id'=>$share_id])->first()){
    		return ['msg'=>'您以将此用户共享给了此员工	','code'=>0];
    	}else{
  		    $res=DB::table('customer_share')->insert($share);
			 if($res){
                $data=DB::table('customer')->select('customer_name')->where('id',$share['customer_id'])->first();
                 $data1=DB::table('staff')->select('name')->where('id',$share['staff_id'])->first();
                 $data=get_object_vars($data);
                 $data1=get_object_vars($data1);
                $action = "将名为(".$data['customer_name'].")的用户共享给le (".$data1['name'].")";
                add_log($action);
	            return ['msg'=>'您已成功共享','code'=>1];
	        }else{
	            return ['msg'=>'共享失败','code'=>0];
	        }
    	}
    }

    /** 共享记录 */
    public function share_list(){
    	$arr=session()->get('info');
    	$arr=get_object_vars($arr);
    	$share_id=$arr['id'];
    	$share_name=$arr['name'];

            $info=DB::table('customer_share')->where('share_id',$share_id)->get()->map(function ($value) {
                return (array)$value;
            })->toArray();
            // dd($info);exit;
            foreach ($info as $k => $v) {
            	$cust = DB::table('customer')->where('id',$v['customer_id'])->first();
            	// echo $cust['customer_name'];
            	// dd($cust);
            	if ($cust != null) {
            		$info[$k]['customer_id'] = $cust->customer_name;
	            	$staff = DB::table('staff')->where('id',$v['staff_id'])->first();
	            	$info[$k]['staff_id'] = $staff->name;  
	            	$info[$k]['share_name']=$share_name;
            	}
            }
            // dd($info);
            return view('admin.share.share_list',['title'=>'共享记录','info'=>$info]);
	}
	/** 取消共享 */
	public function share_delete(){
    	$arr=session()->get('info');
    	$arr=get_object_vars($arr);
    	$share_id=$arr['id'];

		$id=input::get('id');
		$cust=DB::table('customer_share')->select('customer_id','staff_id')->where(['id'=>$id,'share_id'=>$share_id])->get()->map(function ($value) {
                return (array)$value;
            })->toArray();

		$customer_id=$cust[0]['customer_id'];

			$order=DB::table('order')->where(['c_id'=>$customer_id,'s_id'=>$share_id])->get()->map(function ($value) {
                return (array)$value;
            })->toArray();

				if(empty($order)){
				  	$res=DB::table('customer_share')->where('id',$id)->delete();
				    	if($res){
                            $data=DB::table('customer')->select('customer_name')->where('id',$customer_id)->first();
                            $data1=DB::table('staff')->select('name')->where('id',$cust[0]['staff_id'])->first();
                            $data=get_object_vars($data);
                            $data1=get_object_vars($data1);
                            $action = "将名为(".$data['customer_name'].")的用户取消共享 (".$data1['name'].")";
                            add_log($action);
				            return ['msg'=>'删除成功	','code'=>1];
				        }else{
				            return ['msg'=>'删除失败','code'=>0];
				        }			
	   			 }else{
					return ['msg'=>'此用户有订单','code'=>0];
				}

	}
}
