<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller{
    //部门列表
    public function department_list(){
    	$department_list = DB::table('department')->where('is_del' , 1)->paginate(5);

    	if ($department_list != null) {
    		foreach ($department_list as $key => $value) {
    			$value->c_time = date("Y-m-d H:i:s" , $value->c_time);
    			$staff_info = DB::table('staff')->where('id' , $value->add_id)->first();
    			$value->add_id = $staff_info->name;
    		}
    	}

    	$count = DB::table('department')->where('is_del' , 1)->count();
    	return view('admin.department.list' , ['title'=>'部门列表' , 'department_list'=>$department_list , 'count'=>$count]);
    }

    //添加部门页面
    public function department_add(){
    	return view('admin.department.add' , ['title'=>'添加部门']);
    }

    //添加部门操作
    public function department_add_do(){
    	dd(Input::post());
    }
}
