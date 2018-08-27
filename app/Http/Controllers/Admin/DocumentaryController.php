<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;
use Illuminate\Support\Facades\Input;
use Memcache;

/**
 * @date 2018/8/21
 * @user Dengdeng
 * @name 跟单类
 */
class DocumentaryController extends Controller
{
 	//跟单展示列表
 	public function documentary_list(){
 		$user = session()->get('info');

 		$data = DB::table('documentary')
 		->where(['staff_id'=>$user->id,'documentary.is_del'=>0])
 		->join('d_type','documentary.t_id','d_type.id')
 		->join('schedule','documentary.s_id','schedule.id')
 		->join('customer','documentary.customer_id','customer.id')
 		->join('staff','documentary.staff_id','staff.id')
 		->select(DB::raw('
 			crm_documentary.id as documentary_id,
 			crm_documentary.next_time,
 			crm_documentary.id,
 			crm_documentary.remind,
 			crm_documentary.describe,
 			crm_customer.id as customer_id,
 			crm_customer.customer_name,
 			crm_staff.id as staff_id,
 			crm_staff.name as staff_name,
 			crm_d_type.id as type_id,
 			crm_d_type.name as type_name,
 			crm_schedule.id as schedule_id,
 			crm_schedule.name as schedule_name
 			'))
 		->get();
 		return view('admin.documentary.documentary_list',[
 			'data'=>$data,
 			'title'=>'跟单列表'
 	]);
 	}
 	//添加跟单
 	public function documentary_add(){
 		$type     = DB::table('d_type')->get();
 		$schedule = DB::table('schedule')->get();
 		$customer = DB::table('customer')->get();

 		return view('admin.documentary.documentary_add',[
 			'type'=>$type,
 			'schedule'=>$schedule,
 			'customer'=>$customer,
 			'title'=>'添加跟单'
 		]);

 	}
 	//执行添加跟单
 	public function documentary_add_do(){
 		$post=input::post();
 		// print_r($post);exit;
 		$user = session()->get('info');
  		// var_dump($user);exit();
  		$res = DB::table('documentary')
  		->insert([
  			'customer_id'=>$post['customer_id'],
  			'staff_id'=>$user->id,
  			't_id'=>$post['t_id'],
  			's_id'=>$post['s_id'],
  			'next_time'=>$post['next_time'],
  			'remind'=>$post['remind'],
  			'describe'=>$post['describe'],
  			'is_del'=>0
  		]);
  		// var_dump($res);exit;s
  		if($res){
  			// $action = "添加一条客户名为("$post['customer_name']")的数据";
     //        add_log($action);
  			return ['msg'=>'添加成功','code'=>1];
  		}else{
  			return ['msg'=>'添加失败','code'=>2];
  		}
 	}

	//修改跟单
	public function documentary_modify(){
		$id=Input::get('id');

		$data = DB::table('documentary')
		
 		->join('d_type','documentary.t_id','d_type.id')
 		->join('schedule','documentary.s_id','schedule.id')
 		->join('customer','documentary.customer_id','customer.id')
 		->join('staff','documentary.staff_id','staff.id')
 		->where(['documentary.id'=>$id])
 		->select(DB::raw('
 			crm_documentary.id as documentary_id,
 			crm_documentary.next_time,
 			crm_documentary.id,
 			crm_documentary.remind,
 			crm_documentary.describe,
 			crm_customer.id as customer_id,
 			crm_customer.customer_name,
 			crm_staff.id as staff_id,
 			crm_staff.name as staff_name,
 			crm_d_type.id as type_id,
 			crm_d_type.name as type_name,
 			crm_schedule.id as schedule_id,
 			crm_schedule.name as schedule_name
 			'))
 		->first();
 		$type     = DB::table('d_type')->get();
 		$schedule = DB::table('schedule')->get();
 		$customer = DB::table('customer')->get();
		// print_r($data);exit;
		return view('admin.documentary.documentary_modify',[

			'data'=>$data,
			'type'=>$type,
 			'schedule'=>$schedule,
 			'customer'=>$customer,
			'title'=>'修改跟单'
		]);
	}

	public function documentary_modify_do(){
		$post=input::post(); 
		$id=$post['id'];
		$user = session()->get('info');
		$res = DB::table('documentary')
		->where(['id'=>$id])
  		->update([
  			'customer_id'=>$post['customer_id'],
  			'staff_id'=>$user->id,
  			't_id'=>$post['t_id'],
  			's_id'=>$post['s_id'],
  			'next_time'=>$post['next_time'],
  			'remind'=>$post['remind'],
  			'describe'=>$post['describe']
  		]);
  		// print_r($res);exit;
  		if($res){
  			return ['msg'=>'修改成功','code'=>1];
  		}else{
  			return ['msg'=>'您未修改任何数据','code'=>2];
  		}
	}
	//shanch
	public function documentary_delete(){
		$id=Input::post('id');
		$dele = DB::table('documentary')
		->where(['id'=>$id])
  		->update([
  			'is_del'=>1
  		]);

	 if($dele){
        return (['msg'=>'删除成功','code'=>1]);
      }else{
      return (['msg'=>'删除失败','code'=>2]);
    }
	}
}
