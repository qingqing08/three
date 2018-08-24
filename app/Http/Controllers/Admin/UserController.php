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
    public function __construct(){
        // check_user();
    }
    //首页
    public function index(){
        check_user();
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
        check_user();
        return view('admin.welcome');
    }

    //登录页面
    public function login(){
        //查看有没有session值 如果有则跳转首页 否则去登陆页面
        $data = session()->get('info');
        if(empty($data)){
            return view('admin.login' , ['title'=>'后台登录']);
        }else{
            return redirect('index');
        }
    }
    //执行登录操作
    public function login_do(){
        check_user();
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
        check_user();
        echo "执行退出操作";
    }

    //员工/业务员/管理员列表
    public function user_list(){
        check_user();
        if (empty(check_user())) {
            return redirect('login');
        }
        $user_list = DB::table('staff')->get();
        foreach ($user_list as $user) {
            $staff_role = DB::table('staff_role')->where('staff_id' , $user->id)->first();
            // dd($staff_role);
            if ($staff_role == null) {
                $user->role = '没有设置角色';
            } else {
                $role = DB::table('role')->where('id' , $staff_role->role_id)->first();
                $user->role = $role->role_name;
            }
            if ($user->c_time != '') {
                $user->c_time = date("Y-m-d H:i:s" , $user->c_time);
            }
            
        }
        // dd($user_list);
        return view('admin.user.list' , ['title'=>'管理员列表' , 'user_list'=>$user_list]);
    }
    //添加员工/业务员/管理员页面
    public function user_add(){
        check_user();
        $role_list = DB::table('role')->get();
        return view('admin.user.add' , ['title'=>'添加管理员' , 'role_list'=>$role_list]);
    }

    //执行添加员工/业务员/管理员操作
    public function user_add_do(){
        check_user();
        $data = Input::post('data');
        unset($data['_token']);
        unset($data['repass']);
        $data['password'] = md5($data['password']);
        $data['c_time'] = time();

        $role_name = $data['role'];
        unset($data['role']);
        // dd($data);
        $data['number'] = rand(100000,999999);
        $result = DB::table('staff')->insert($data);

        if (!empty($role_name)) {
            $user_info = DB::table('staff')->where('account' , $data['account'])->first();
            $role_info = DB::table('role')->where('role_name' , $role_name)->first();
            $arr = [
                'staff_id'=>$user_info->id,
                'role_id'=>$role_info->id,
            ];
            DB::table('staff_role')->insert($arr);
        }

        if ($result) {
            return ['msg'=>'添加成功' , 'code'=>1];
        } else {
            return ['msg'=>'添加失败' , 'code'=>2];
        }
    }

    //修改员工/业务员/管理员页面
    public function user_modify(){
        check_user();
        echo "修改员工";
    }

    //执行修改员工/业务员/管理员操作
    public function user_modify_do(){
        check_user();
        echo "执行修改操作";
    }

    //删除员工/业务员/管理员操作
    public function user_delete(){
        check_user();
        echo "执行删除操作";
    }

    //设置角色页面
    public function set_role(){
        check_user();
        echo "设置角色";
    }

    //执行设置角色操作
    public function set_role_do(){
        check_user();
        echo "执行设置角色操作";
    }
}
