<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OperationrecordController extends Controller
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

    /** 操作记录展示 */
    public function record_list(){
		$record=DB::table('operation_record')->paginate(10);
		$count = DB::table('operation_record')->count();
    	return view('admin.record.record_list',['title'=>'操作记录展示','info'=>$record,'count'=>$count]);
    }
}
