<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 权限类
 */
class RuleController extends Controller{
    //权限列表
    public function rule_list(){
        $list = DB::table('rule')->where('status',1)->get();

        foreach ($list as $key => $value) {
            if ($value->parent_id != 0) {
                $parent = DB::table('rule')->where('id' , $value->parent_id)->first();
                $value->parent_id = $parent->rule_name;
            } else {
                $value->parent_id = "一级权限";
            }
        }
        // dd($list);
        return view('admin.rule.list' , ['title'=>'权限列表' , 'rule_list'=>$list]);
    }

    //权限添加页面
    public function rule_add(){
        echo "权限添加";
    }

    //执行添加权限操作
    public function rule_add_do(){
        echo "添加权限操作";
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
