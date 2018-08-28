<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller{
    //
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
    //产品列表
    public function product_list(){
    	check_user();
    	$product_list = DB::table('product')->get();
    	$count = DB::table('product')->count();
    	return view('admin.product.list' , ['title'=>'产品列表' , 'product_list'=>$product_list , 'count'=>$count]);
    }

    //添加产品页面
    public function product_add(){
    	return view('admin.product.add' , ['title'=>'添加产品']);
    }

    //执行添加产品操作
    public function product_add_do(){
    	$data = Input::post();
    	unset($data['_token']);
    	$data['c_time'] = time();
    	// dd($data);
    	$product_info = DB::table('product')->where('product_name' , $data['product_name'])->first();

    	$product_info = json_decode($product_info);
    	// dd($product_info);
    	if (!empty($product_info)) {
    		return ['msg'=>'该产品已存在' , 'code'=>0];
    	}

    	$result = DB::table('product')->insert($data);
    	if ($result) {
    		return ['msg'=>'添加成功' , 'code'=>1];
    	} else {
    		return ['msg'=>'添加失败' , 'code'=>2];
    	}
    }

    //编辑页面
    public function product_modify(){
    	// dd(Input::get());
    	$product_id = Input::get('product_id');
    	$product_info = DB::table('product')->where('id' , $product_id)->first();

    	return view('admin.product.modify' , ['title'=>'编辑产品' , 'product_info'=>$product_info]);
    }

    //执行编辑操作
    public function product_modify_do(){
    	// dd(Input::post());
    	$data = Input::post();
    	unset($data['_token']);
    	$product_id = $data['product_id'];
    	unset($data['product_id']);

    	// dd($data);
    	$result = DB::table('product')->where('id' , $product_id)->update($data);
    	if ($result) {
    		return ['msg'=>'修改成功' , 'code'=>1];
    	} else {
    		return ['msg'=>'修改失败' , 'code'=>2];
    	}
    }

    //删除产品
    public function product_delete(){
    	$product_id = Input::get('product_id');

    	$result = DB::table('product')->where('id' , $product_id)->delete();
    	if ($result) {
    		return ['msg'=>'删除成功' , 'code'=>1];
    	} else {
    		return ['msg'=>'删除失败' , 'code'=>2];
    	}
    }
}
