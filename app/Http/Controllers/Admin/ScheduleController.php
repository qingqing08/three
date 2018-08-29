<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
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

                $action = "增加了一条跟单进度类型为(". $name .")的数据";

                add_log($action);

                return(['msg' => '添加成功' , 'code' => 1]);

            }else{

                $action = "增加了一条跟单进度类型为(". $name .")的数据失败";

                add_log($action);

                return(['msg' => '添加失败' , 'code' => 2]);

            }
        }

    }

    //进度类型展示
    public function schedule_list(){

        $list = DB::table('schedule') ->where('is_del' , 1) -> paginate(3);

        $num = empty($list)?0:count($list);

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

                $action = "编辑了一条跟单进度类型为(". $name .")的数据";

                add_log($action);

                return (['msg' => '编辑成功' , 'code' => 1]);

            }else{

                $action = "编辑了一条跟单进度类型为(". $name .")的数据失败";

                add_log($action);

                return (['msg' => '编辑失败','code' => 2]);

            }
        }
    }

    //删除跟单进度
    public function schedule_delete(){

        $schedule_id = Input::get('schedule_id');

        $result = DB::table('schedule')->where('id' , $schedule_id)->update(['is_del'=>0]);

        if ($result) {

            $schedule_info = DB::table('schedule')->where('id' , $schedule_id)->first();

            $action = "删除一条跟单进度类型为(". $schedule_info->name .")的数据";

            add_log($action);

            return ['msg'=>'删除成功' , 'code'=>1];

        } else {

            return ['msg'=>'删除失败' , 'code'=>2];

        }
    }

}
