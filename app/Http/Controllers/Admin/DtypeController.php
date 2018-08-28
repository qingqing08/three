<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class DtypeController extends Controller
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

    //跟单类型添加
    public function dtype_add(){
       return view('admin.dtype.add',['title' => '跟单类型添加']);
    }

    //执行类型添加
    public function dtype_add_do(){
        //接收post值
        $name = input::post('name');
        $status = input::post('status');
        $c_time = time();

        //验证唯一
        $only = DB::table('d_type') -> where(['name' => $name]) -> first();
        //dd($only);
        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else{
            $arr = [
                'name' => $name,
                'c_time' => $c_time,
                'status' => $status
            ];

            $res = DB::table('d_type') -> insert($arr);

            if($res){
                $action = "增加了一条跟单类型为(". $name .")的数据";
                add_log($action);
                return (['msg' => '添加成功' , 'code' => 1]);
            }else{
                return (['msg' => '添加失败' , 'code' => 2]);
            }
        }

    }

    //跟单类型列表
    public function dtype_list(){

        $list = DB::table('d_type')->where('is_del' , 1) -> paginate(3);

        $num = empty($list)?0:count($list);

        return view('admin.dtype.list' , ['title' => '跟单类型展示']) -> with('list',$list) -> with('num' , $num);
    }

    //加载修改页面
    public function dtype_up(){

        $id = Input::get('id');

        $date = DB::table('d_type') -> where ('id',$id) -> first();

//        dd($date);
        return view('admin.dtype.up' , ['title' => '编辑' , 'date'=>$date]);
    }

    //执行修改页面
    public function dtype_up_do(){

        $id = Input::post('id');
        $name = Input::post('name');
        $status = Input::post('status');

        //验证唯一
        $only = DB::table('d_type') -> where(['name' => $name , 'status' => $status]) -> first();
        //dd($only);
        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else{

            $res = DB::table('d_type') -> where('id',$id) -> update(['name' => $name , 'status' => $status]);

            if($res){
                $action = "编辑了一条跟单类型为(". $name .")的数据";
                add_log($action);
                return (['msg' => '编辑成功' , 'code' => 1]);
            }else{
                return (['msg' => '编辑失败','code' => 2]);
            }
        }
    }

    //删除跟单类型
    public function dtype_delete(){
        $dtype_id = Input::get('dtype_id');

        $result = DB::table('d_type')->where('id' , $dtype_id)->update(['is_del'=>0]);
        if ($result) {
            $dtype_info = DB::table('d_type')->where('id' , $dtype_id)->first();
            $action = "删除了一条跟单类型为(".$dtype_info->name.")的数据";
            add_log($action);
            return ['msg'=>'删除成功' , 'code'=>1];
        } else {
            return ['msg'=>'删除失败' , 'code'=>2];
        }
    }
}
