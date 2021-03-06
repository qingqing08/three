<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class CtypeController extends Controller
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

    //添加
    public function ctype_add(){
        return view('admin.ctype.add' , ['title' => '合同类型添加']);
    }

    //执行添加
    public function ctype_add_do(){

        //接收post值
        $name = input::post('name');
        $status = input::post('status');
        $c_time = time();

        //验证唯一
        $only = DB::table('c_type') -> where(['name' => $name]) -> first();
        //dd($only);36
        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else{

            $arr = [
                'name' => $name,
                'c_time' => $c_time,
                'status' => $status
            ];

            $res = DB::table('c_type') -> insert($arr);

            if($res){

                $action = "增加了一条合同类型为(". $name .")的数据";

                add_log($action);

                return (['msg' => '添加成功' , 'code' => 1]);

            }else{

                $action = "增加了一条合同类型为(". $name .")的数据失败";

                add_log($action);

                return (['msg' => '添加失败' , 'code' => 2]);

            }
        }
    }

    //列表展示
    public function ctype_list(){

        $list = DB::table('c_type') -> paginate(3);

        $num = empty($list)?0:count($list);

        return view('admin.ctype.list' , ['title' => '跟单类型展示']) -> with('list',$list) -> with('num' , $num);
    }

    //编辑页面
    public function ctype_up(){

        $id = Input::get('id');

        $date = DB::table('c_type') -> where ('id',$id) -> first();

        //dd($date);
        return view('admin.ctype.up' , ['title' => '编辑' , 'date'=>$date]);
    }

    //执行编辑
    public function ctype_up_do(){

        $id = Input::post('id');
        $name = Input::post('name');
        $status = Input::post('status');

        //验证唯一
        $only = DB::table('c_type') -> where(['name' => $name , 'status' => $status]) -> first();
        //dd($only);
        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else{

            $res = DB::table('c_type') -> where('id',$id) -> update(['name' => $name , 'status' => $status]);

            if($res){

                $action = "编辑了一条合同类型为(". $name .")的数据";

                add_log($action);

                return (['msg' => '编辑成功' , 'code' => 1]);

            }else{

                $action = "编辑了一条合同类型为(". $name .")的数据失败";

                add_log($action);

                return (['msg' => '编辑失败','code' => 2]);

            }
        }
    }
}
