<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class DtypeController extends Controller
{

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

        $arr = [
            'name' => $name,
            'c_time' => $c_time,
            'status' => $status
        ];

        $res = DB::table('d_type') -> insert($arr);

        if($res){
            return (['msg' => '添加成功' , 'code' => 1]);
        }else{
            return (['msg' => '添加失败' , 'code' => 2]);
        }
    }

    //跟单类型列表
    public function dtype_list(){

        $list = DB::table('d_type') -> get();

        return view('admin.dtype.list' , ['title' => '跟单类型展示']) -> with('list',$list);
    }
}
