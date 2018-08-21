<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 角色类
 */
class RuleController extends Controller{
    //权限列表
    public function rule_list(){
        echo "权限列表";
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
    public functino rule_modify_do(){
        echo "修改权限操作";
    }

    //删除权限
    public function rule_delete(){
        echo "删除权限";
    }
}
