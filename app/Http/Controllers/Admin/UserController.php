<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;
use Illuminate\Support\Facades\Input;
use Memcache;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 用户类
 */
class UserController extends Controller{
    //首页
    public function index(){
        $list = DB::table('rule')->where('parent_id' , 0)->get();
        $list = json_decode($list);
        foreach ($list as $key => $value) {
            $data = DB::table('rule')->where('parent_id' , $value->id)->get();
            $value->child = $data;
        }
        return view('admin.index' , ['title'=>'后台首页' , 'list'=>$list]);
    }

    //欢迎
    public function welcome(){
        return view('admin.welcome');
    }

    //登录页面
    public function login(){
        //查看有没有session值 如果有则跳转首页 否则去登陆页面
        $data = session()->get('info');
        if(empty($value)){
            return view('admin.login' , ['title'=>'后台登录']);
        }else{
            return view('admin.index',['data'=>$data]);
        }
    }
    //执行登录操作
    public function login_do(){
        // echo "执行登录操作";
        $account=input::post('account');
        $password=input::post('password');
        $data = DB::table('staff')->where('account',$account)->first();
        if(empty($data)){
            return ['msg'=>'用户名密码不匹配','code'=>0];
        }
        if($data->password==md5($password)){
            //登录成功将用户信息存session
            session()->put('info',$data);
            return ['msg'=>'登录成功','code'=>1];
        }else{
            return ['msg'=>'用户名密码不匹配','code'=>0];
        }
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
