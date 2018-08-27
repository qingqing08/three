<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Memcache;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 用户类
 */
class UserController extends Controller{
    //自动验证登录
    public function __construct(){
        // check_user();
    }

    //员工/业务员/管理员列表
    public function user_list(){
        check_user();
        $user_list = DB::table('staff')->where('is_del' , 1)->paginate(5);
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
        $count = DB::table('staff')->where('is_del' , 1)->count();
        // $count = count($user_list);
        return view('admin.user.list' , ['title'=>'管理员列表' , 'user_list'=>$user_list , 'count'=>$count]);
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

        // dd($data);
        if (isset($data['role'])) {
            $role_name = $data['role'];
            unset($data['role']);
        } else {
            $role_name = '';
        }
        
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
            $action = "增加了一条用户名为(".$data['name'].")的数据";
            add_log($action);
            return ['msg'=>'添加成功' , 'code'=>1];
        } else {
            return ['msg'=>'添加失败' , 'code'=>2];
        }
    }

    //修改员工/业务员/管理员页面
    public function user_modify(){
        check_user();
        $staff_id = Input::get('staff_id');
        $staff_info = DB::table('staff')->where('id' , $staff_id)->first();
        return view('admin.user.modify' , ['title'=>'员工修改' , 'staff_info'=>$staff_info]);
    }

    //执行修改员工/业务员/管理员操作
    public function user_modify_do(){
        check_user();
        // dd(Input::post());
        $data = Input::post('data');
        unset($data['_token']);
        $staff_id = $data['staff_id'];
        unset($data['staff_id']);
        // dd($data);

        $result = DB::table('staff')->where('id' , $staff_id)->update($data);
        if ($result) {
            return ['msg'=>'修改成功' , 'code'=>1];
        } else {
            return ['msg'=>'修改失败' , 'code'=>2];
        }
        // echo "执行修改操作";
    }

    //删除员工/业务员/管理员操作
    public function user_delete(){
        check_user();
        // dd(Input::get());
        $staff_id = Input::get('staff_id');

        $result = DB::table('staff')->where('id' , $staff_id)->update(['is_del'=>0]);
        if ($result) {
            return ['msg'=>'删除成功' , 'code'=>1];
        } else {
            return ['msg'=>'删除失败' , 'code'=>2];
        }
    }

    //设置角色页面
    public function set_role(){
        check_user();
        // dd(Input::get());
        $staff_id = Input::get('staff_id');
        $staff_info = DB::table('staff')->where('id' , $staff_id)->first();

        $role_list = DB::table('role')->get();
        return view('admin.user.set_role' , ['role_list'=>$role_list ,'title'=>'设置角色' , 'staff_info'=>$staff_info]);
        // echo "设置角色";
    }

    //执行设置角色操作
    public function set_role_do(){
        check_user();
        $data = Input::post();
        $data['role_id'] = $data['role'];
        unset($data['role']);
        unset($data['_token']);
        
        $user_role = DB::table('staff_role')->where($data)->first();
        if ($user_role != null) {
            return ['msg'=>'设置成功' , 'code'=>1];
        } else {
            $result = DB::table('staff_role')->insert($data);
            // dd($data);
            // echo "执行设置角色操作";
            if ($result) {
                return ['msg'=>'设置成功' , 'code'=>1];
            } else {
                return ['msg'=>'设置失败' , 'code'=>2];
            }
        }
        
    }
}
