<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
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
    
    //合同展示
    public function contract_list(){

        $list = DB::table('contract')
            -> select(DB::raw('
                crm_c_type.id as p_id,
                crm_contract.*,
                crm_c_type.name           
            ') )
            -> join('c_type' , 'contract.c_type' , '=' , 'c_type.id')
            -> paginate(3);

        $num = empty($list)?0:count($list);
        //dd($list);
        return view('admin.contract.list' , ['title' => '合同列表'] , ['list' => $list]) -> with(['num' => $num] );
    }

    //添加
    public function contract_add(){

        $type = DB::table('c_type') -> where('status',1) -> get();
        //dd($type);
        return view('admin.contract.add' , ['title' => '增加'] , ['type' => $type]);
    }

    //执行添加
    public function contract_add_do(){

        $arr = Input::post();

        unset($arr['_token']);

        $arr['status'] = 1;

        $res = DB::table('contract') -> insert($arr);

        if($res){

            $action = "增加了一条合同";
            add_log($action);
            return (['msg' => '添加成功' , 'code' => 1]);

        }else{

            return (['msg' => '添加失败' , 'code' => 2]);
        }
    }

    //编辑
    public function contract_up(){

        $id = Input::get('id');
        //dd($id);
        $type = DB::table('c_type') -> where('status',1) -> get();

        $data = DB::table('contract') -> where(['id' => $id]) ->first();

        return view('admin.contract.up' , ['title' => '编辑']) -> with(['data' => $data , 'type' => $type]);
    }

    //执行编辑
    public function contract_up_do(){

        $arr = Input::post();
        //dd($arr);
        unset($arr['_token']);

        $res = DB::table('contract') -> where(['id' => $arr['id']]) -> update($arr);

        if($res){
            $action = "编辑了一条合同";
            add_log($action);
            return (['msg' => '编辑成功' , 'code' => 1]);
        }else{
            return (['msg' => '编辑失败' , 'code' => 2]);
        }
    }
}
