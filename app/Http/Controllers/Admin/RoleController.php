<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 角色类
 */
class RoleController extends Controller{
    //角色列表
    public function role_list(){
        echo "角色列表";
    }

    //添加角色页面
    public function role_add(){
        echo "添加角色";
    }

    //执行添加角色操作
    public function role_add_do(){
        echo "执行创建角色操作";
    }

    //角色修改页面
    public function role_modify(){
        echo "角色修改页面";
    }

    //执行修改角色操作
    public function role_modify_do(){
        echo "执行修改角色操作";
    }

    //删除角色
    public function role_delete(){
        echo "删除角色";
    }

    //给角色设置权限页面
    public function set_rule(){
        echo "设置权限";
    }

    //执行设置权限操作
    public function set_rule_do(){
        echo "执行设置权限操作";
    }

    //随便加的

}
