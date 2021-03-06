<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 权限类
 */
class RuleController extends Controller{

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

    //权限列表
    public function rule_list(){
        $list = DB::table('rule')->where('status',1)->paginate(10);

        foreach ($list as $key => $value) {
            if ($value->parent_id != 0) {
                $parent = DB::table('rule')->where('id' , $value->parent_id)->first();
                $value->parent_id = $parent->rule_name;
            } else {
                $value->parent_id = "一级权限";
            }
        }
        // dd($list);
        $count = DB::table('rule')->count();
        return view('admin.rule.list' , ['title'=>'权限列表' , 'rule_list'=>$list , 'count'=>$count]);
    }

    //权限添加页面
    public function rule_add(){
        $rule_list = DB::table('rule')->where('parent_id' , 0)->get();
        return view('admin.rule.add' , ['title'=>'权限添加' , 'rule_list'=>$rule_list]);
    }

    //执行添加权限操作
    public function rule_add_do(){
        $data = Input::post();
        // dd($data);
        unset($data['_token']);
        $data['status'] = 1;
        $result = DB::table('rule')->insert($data);
        if ($result) {
            return ['code'=>1 , 'msg'=>'添加成功'];
        } else {
            return ['code'=>2 , 'msg'=>'添加失败'];
        }
    }

    //权限修改页面
    public function rule_modify(){
        echo "权限修改";
    }

    //执行修改权限操作
    public function rule_modify_do(){
        echo "修改权限操作";
    }

    //删除权限
    public function rule_delete(){
        echo "删除权限";
    }
}
