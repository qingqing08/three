<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller{
    //
    public function product_list(){
    	check_user();
    	$product_list = DB::table('product')->get();
    	$count = DB::table('product')->count();
    	return view('admin.product.list' , ['title'=>'产品列表' , 'product_list'=>$product_list , 'count'=>$count]);
    }
}
