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
 * @user Qing
 * @name 客户类
 */
class CustomerController extends Controller{
//客户列表展示
  	public function customer_list(){

  	//查询用户表中的用户数据
      $user = session()->get('info');
      $u_id=$user->id;
 
      $data = DB::table('customer')
      ->where(['customer.is_del'=>0,'customer.add_man'=>$u_id])
  		->join('customer_level','customer.customer_level', '=', 'customer_level.level_id')
  		->join('customer_type','customer.customer_type', '=', 'customer_type.type_id')
      ->paginate(4);
  		return view('admin.customer.customer_list' , [
  			'title'=>'客户列表',
  			'data' =>$data
  		]);
  	}
//添加客户
  	public function customer_add(){
  		$type  = DB::table('customer_type')->get();
  		$level = DB::table('customer_level')->get();

  		// print_r($type);exit;
  		return view('admin.customer.customer_add',[
  			'title'=>'添加客户',
  			'type'  => $type,
  			'level' => $level
  		]);
  	}
//执行添加
  	public function customer_add_do(){
  		$post=Input::post();
      // print_r($post);exit;
  		if(empty($post['customer_type'])){
  				return ['msg'=>'类型必填','code'=>2];
  		}
  		if(empty($post['customer_level'])){
				return ['msg'=>'等级必填','code'=>2];
  		}
  		//取出来当前用户信息
  		$user = session()->get('info');
  		// var_dump($user);exit();
  		$res = DB::table('customer')
  		->insert([
  		  'customer_name'=>$post['customer_name'],
  		  'mobile'=>$post['mobile'],
  		  'customer_type'=>$post['customer_type'],
  		  'network'=>$post['network'],
  		  'customer_level'=>$post['customer_level'],
  		  'customer_source'=>$post['customer_source'],
  		  'other_connections'=>$post['other_connections'],
  		  'main_project'=>$post['main_project'],
  		  'remarks'=>$post['remarks'],
  		  'province'=>$post['province'],
  		  'city'=>$post['city'],
  		  'address'=>$post['address'],
  		  'add_man'=>$user->id,
        'is_del'=>0
  		]);
  		// var_dump($res);
  		if($res){
         $action = "增加了一条客户名为(".$post['customer_name'].")的数据";
            add_log($action);
  			return ['msg'=>'添加成功','code'=>1];
  		}else{
  			return ['msg'=>'添加失败','code'=>2];
  		}
  	}

//修改客户信息
  	public function customer_modify(){
  		$id=Input::get('id');
  		// echo $id;exit;
  		$info = DB::table('customer')
  		->join('customer_type','customer.customer_type', '=', 'customer_type.type_id')
  		->join('customer_level','customer.customer_level', '=', 'customer_level.level_id')
  		->where(['id'=>$id])
  		->first();
  		//查询分类数据
  		$type  = DB::table('customer_type')->get();
  		$level = DB::table('customer_level')->get();
  		// print_r($data);exit;
  		return view('admin.customer.customer_modify',[
  			'info'=>$info,
  			'title'=>'修改客户',
  			'type'  => $type,
  			'level' => $level
  		]);
  		
  	}
//执行修改
  	public function customer_modify_do(){
  		$post=Input::post();
  		$id=$post['id'];
  		//取出来当前用户信息
  		$user = session()->get('info');
  		$res = DB::table('customer')
  		->where(['id'=>$id])
  		->update([
  		  'customer_name'=>$post['customer_name'],
  		  'mobile'=>$post['mobile'],
  		  'customer_type'=>$post['customer_type'],
  		  'network'=>$post['network'],
  		  'customer_level'=>$post['customer_level'],
  		  'customer_source'=>$post['customer_source'],
  		  'other_connections'=>$post['other_connections'],
  		  'main_project'=>$post['main_project'],
  		  'remarks'=>$post['remarks'],
  		  'province'=>$post['province'],
  		  'city'=>$post['city'],
  		  'address'=>$post['address'],
  		]);
  		if($res){
          $action = "修改了一条客户名为(".$post['customer_name'].")的数据";
            add_log($action);
  			return ['msg'=>'修改成功','code'=>1];
  		}else{
  			return ['msg'=>'修改失败','code'=>2];
  		}

  	}
//删除客户
  	public function customer_delete(){
	  $id=Input::post('id');
    $allda=DB::table('customer')->where('id',$id)->get();
    $newa= json_decode($allda,true);
    $order = DB::table('order')
    ->where(['c_id'=>$id])
    ->get();
    $data = json_decode($order,true);
    // dd($data);exit;
    if(empty($data)){
      $dele = DB::table('customer')
      ->where(['id'=>$id])
      ->update([
        'is_del'=>1
      ]);
    if($dele){
        return (['msg'=>'删除成功','code'=>1]);
      }      
    }else{
      return (['msg'=>'此用户已经有订单 请联系管理员删除','code'=>2]);
    }


  	}
}
