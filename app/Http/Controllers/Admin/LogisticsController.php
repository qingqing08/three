<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class LogisticsController extends Controller
{
    //物流列表
    public function logistics_list(){

        $list = DB::table('logistics') -> where(['status' => 1]) -> paginate(3);

        //dd($list);
        $num = empty($list)?0:count($list);

        return view('admin.logistics.list' , ['title' => '列表展示'  , 'list' => $list]) -> with('num' , $num);
    }

    //物流添加
    public function logistics_add(){

        return view('admin.logistics.add' , ['title' => '物流添加']);

    }

    //执行物流添加
    public function logistics_add_do(){

        $name = Input::post('name');

        if(empty($name)){
            return (['msg' => '名称不能为空' , 'code' => 4]);
        }

        $status = Input::post('status');

        $c_time = time();

        $only = DB::table('logistics') -> where(['name' => $name]) -> first();

        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else {

            $res = DB::table('logistics')->insert(['name' => $name, 'status' => $status, 'c_time' => $c_time]);

            if ($res) {
                return (['msg' => '增加成功', 'code' => 1]);
            } else {
                return (['msg' => '增加失败', 'code' => 2]);
            }
        }
    }

    //修改
    public function logistics_up(){

        $id = Input::get('id');

        $date = DB::table('logistics') -> where(['id' => $id]) -> first();

        return view('admin.logistics.up' , ['date' => $date]);
    }

    //执行修改
    public function logistics_up_do(){

        $arr = Input::post();

        unset($arr['_token']);

        if(empty($arr['name'])){

            return (['msg' => '名字不能为空'  , 'code' => 3]);

        }

        $only = DB::table('logistics') -> where(['name' => $arr['name']]) -> first();
        //dd($only);
        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else{

            $res = DB::table('logistics') -> where(['id' => $arr['id']]) -> update($arr);

            if($res){

                return (['msg' => '修改成功' , 'code' => 1]);

            }else{

                return (['msg' => '修改失败' , 'code' => 2]);
            }
        }
    }

    //删除
    public function logistics_delete(){

        $id = Input::get('id');
        //dd($id);
        $res = DB::table('logistics') -> where(['id' => $id]) -> update(['status' => 0]);
        //dd($res);
        if($res){

            $info = DB::table('logistics') -> where('id' , $id) -> first();

            $action = "删除一条跟单进度类型为(". $info->name .")的数据";

            add_log($action);

            return (['msg' => '删除成功' , 'code' => 1]);

        }else{

            return (['msg' => '删除失败' , 'code' => 2]);

        }
    }
}