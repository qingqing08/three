<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    //添加进度类型
    public function schedule_add(){
        return view('admin.schedule.add',['title' => '添加进度类型']);
    }

    //执行进度类型添加
    public function schedule_add_do(){
        $name = Input::post('name');
        $status = Input::post('status');
        $c_time = time();
        $res = DB::table('schedule') -> insert(['name' => $name , 'status' => $status , 'c_time' => $c_time]);
        if($res){
            return(['msg' => '添加成功' , 'code' => 1]);
        }else{
            return(['msg' => '添加失败' , 'code' => 2]);
        }
    }

    //进度类型展示
    public function schedule_list(){
        $list = DB::table('schedule') -> get();
        return view('admin.schedule.list',['title' => '进度列表']) -> with('list',$list);
    }

    //加载修改页面
    public function schedule_up(){
        $id = Input::get('id');
        $date = DB::table('schedule') -> where('id',$id) -> first();
        dd($date);
        if($date){
            view('admin.schedule.up' , ['title' => '编辑']) -> with('date',$date);
        }

    }
}
