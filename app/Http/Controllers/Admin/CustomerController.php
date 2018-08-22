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
    //
  	public function customer_list(){

  		//查询用户表中的用户数据
  		$data = DB::table('customer')
  		->join('customer_type','customer.customer_type', '=', 'customer_type.id')
  		->join('customer_level','customer.customer_level', '=', 'customer_level.id')
  		->get();
  		return view('admin.customer.customer_list' , [
  			'title'=>'客户列表',
  			'data' =>$data

  		]);
  	}

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
}
