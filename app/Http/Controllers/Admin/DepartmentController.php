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

    	$count = DB::table('department')
        ->where('is_del' , 1)
        ->count();
    	return view('admin.department.list' , ['title'=>'部门列表' , 'department_list'=>$department_list , 'count'=>$count]);
    }

    //添加部门页面
    public function department_add(){
    	return view('admin.department.add' , ['title'=>'添加部门']);
    }

    //添加部门操作
    public function department_add_do(){
    	$name=Input::post('department_name');
        $user = session()->get('info');
        $add_id=$user->id;
        $time=time();
        $res = DB::table('department')
        ->insert([
            'department_name'=>$name,
            'add_id'=>$add_id,
            'c_time'=>$time
        ]);
        if($res){
            return ['msg'=>'添加成功','code'=>1];
        }else{
            return ['msg'=>'添加失败','code'=>2];
        }
    }

//修改
    public function department_modify(){
        $id=Input::get('id');
        $department = DB::table('department')
        ->where(['is_del'=>1,'id'=>$id])
        ->first();
        // print_r($count);exit;
        return view('admin.department.modify',[
            'title'=>'修改',
            'department'=>$department

    ]);
    }
//执行修改
    public function department_modify_do(){
        $post=input::post(); 
        $id=$post['id'];
        $time=time();
        $res = DB::table('department')
        ->where(['id'=>$id])
        ->update([
            'department_name'=>$post['department_name'],
            'c_time'=>$time
        ]);
        if($res){
            return ['msg'=>'修改成功','code'=>1];
        }else{
            return ['msg'=>'您未修改任何数据','code'=>2];
        }
    }
    //删除
    public function department_delete(){
        $id=Input::post('id');
        $dele = DB::table('department')
        ->where(['id'=>$id])
        ->update([
            'is_del'=>0
        ]);
        if($dele){
            return (['msg'=>'删除成功','code'=>1]);
        }else{
             return (['msg'=>'删除失败','code'=>2]);
        }
    }

}
