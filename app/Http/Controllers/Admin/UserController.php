<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 用户类
 */
class UserController extends Controller{
    //登录页面
    public function login(){
        echo "登录";
    }

    //执行登录操作
    public function login_do(){
        echo "执行登录操作";
    }

    //执行退出操作
    public function logout(){
        echo "执行退出操作";
    }

    //添加员工/业务员/管理员页面
    public function user_add(){
        echo "添加员工";
    }

    //执行添加员工/业务员/管理员操作
    public function user_add_do(){
        echo "执行添加操作";
    }

    //修改员工/业务员/管理员页面
    public function user_modify(){
        echo "修改员工";
    }

    //执行修改员工/业务员/管理员操作
    public function user_modify_do(){
        echo "执行修改操作";
    }

    //删除员工/业务员/管理员操作
    public function user_delete(){
        echo "执行删除操作";
    }

    //设置角色页面
    public function set_role(){
        echo "设置角色";
    }

    //执行设置角色操作
    public function set_role_do(){
        echo "执行设置角色操作";
    }
}
