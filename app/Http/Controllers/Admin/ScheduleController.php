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

        //验证唯一
        $only = DB::table('schedule') -> where(['name' => $name]) -> first();

        if($only != null ){

            return (['msg' => '已存在' , 'code' => 3]);

        }else{

            $res = DB::table('schedule') -> insert(['name' => $name , 'status' => $status , 'c_time' => $c_time]);
            if($res){
                return(['msg' => '添加成功' , 'code' => 1]);
            }else{
                return(['msg' => '添加失败' , 'code' => 2]);
            }
        }

    }

    //进度类型展示
    public function schedule_list(){
        $list = DB::table('schedule') -> paginate(3);
        $num = count($list);
        return view('admin.schedule.list',['title' => '进度列表']) -> with('list',$list) -> with('num' , $num);
    }

    //加载修改页面
    public function schedule_up(){
        $id = Input::get('id');
        $date = DB::table('schedule') -> where('id',$id) -> first();
        return view('admin.schedule.up' , ['title' => '编辑']) -> with('date',$date);
    }

    //执行修改
    public function schedule_up_do(){

    $id = Input::post('id');
    $name = Input::post('name');
    $status = Input::post('status');

    //验证唯一
    $only = DB::table('schedule') -> where(['name' => $name , 'status' => $status]) -> first();

        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else{

            $res = DB::table('schedule') -> where('id',$id) -> update(['name' => $name , 'status' => $status]);

            if($res){
                return (['msg' => '编辑成功' , 'code' => 1]);
            }else{
                return (['msg' => '编辑失败','code' => 2]);
            }
        }
    }

}
