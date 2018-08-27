<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller{
    //首页
    public function index(){
        check_user();
        $list = DB::table('rule')->where('parent_id' , 0)->get();
        $list = json_decode($list);
        foreach ($list as $key => $value) {
            $data = DB::table('rule')->where('parent_id' , $value->id)->get();
            $value->child = $data;
        }
        return view('admin.index' , ['title'=>'后台首页' , 'list'=>$list , 'staff_info'=>Session::get('info')]);
    }

    //欢迎
    public function welcome(){
    	// $action = "访问了首页";
    	// add_log($action);
        return view('admin.welcome' , ['staff_info'=>Session::get('info')]);
    }

    //登录页面
    public function login(){
        //查看有没有session值 如果有则跳转首页 否则去登陆页面
        if (empty(Session::get('info'))) {
            return view('admin.login' , ['title'=>'后台登录']);
        } else {
            return redirect('/');
        }
        
    }

    public function user_login(){
        return view('admin.login' , ['title'=>'后台登录']);
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
            Session::put('info',$data);
            // dd($data);
            return ['msg'=>'登录成功','code'=>1];
        }else{
            return ['msg'=>'用户名密码不匹配','code'=>0];
        }
    }

    //执行退出操作
    public function logout(){
        Session::flush();
        return redirect('login');
    }
}
