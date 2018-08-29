<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

/**
 * @date 2018/8/21
 * @user Qing
 * @name 角色类
 */
class RoleController extends Controller{

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

    //角色列表
    public function role_list(){
        $list = DB::table('role')->get();
        return view('admin.role.list' , ['title'=>'角色列表' , 'list'=>$list]);
    }

    //添加角色页面
    public function role_add(){
        return view('admin.role.add' , ['title'=>'添加角色']);
    }

    //执行添加角色操作
    public function role_add_do(){
        $data =Input::post();
        unset($data['_token']);
        $data['c_time'] = time();
        if ($data['role_name'] == '') {
            return ['msg'=>'角色名称不能为空' , 'code'=>0];
        }

        // dd($data);
        $result = DB::table('role')->insert($data);
        
        if($result){
            $action = "添加了一条角色名为(".$data['role_name'].")的数据";
            add_log($action);
            return ['msg'=>'添加成功','code'=>1];
        } else {
            return ['msg'=>'添加失败','code'=>2];
        }
    }

    //角色修改页面
    public function role_modify(){
        $role_id = Input::get('role_id');
        $role_info = DB::table('role')->where('id' , $role_id)->first();

        return view('admin.role.modify' , ['title'=>'角色修改' , 'info'=>$role_info]);
    }

    //执行修改角色操作
    public function role_modify_do(){
        // dd(Input::post());
        $data = Input::post();
        $role_id = $data['role_id'];
        $arr = [
            'role_name'=>$data['role_name'],
        ];

        $role_info = DB::table('role')->where('id' , $role_id)->first();

        if (empty($role_id)) {
            return ['msg'=>'修改失败' , 'code'=>2];
        }
        $result = DB::table('role')->where('id' , $role_id)->update($arr);

        if ($result) {
            $action = "将角色名为(".$role_info->role_name.")修改为(".$data['role_name'].")";
            add_log($action);
            return ['msg'=>'修改成功' , 'code'=>1];
        } else {
            return ['msg'=>'修改失败' , 'code'=>2];
        }

    }

    //删除角色
    public function role_delete(){
        // $action = "删除了一条角色名为(".$data['role_name'].")的数据";
        // add_log($action);
        echo "删除角色";
    }

    //给角色设置权限页面
    public function set_rule(){
        $role_id = Input::get('role_id');
        $role_info = DB::table('role')->where('id' , $role_id)->first();
        $rule_list = DB::table('rule')->where('status' , 1)->whereNotIn('parent_id' , array(0))->get();
        // dd($rule_list);
        return view('admin.role.set_rule' , ['title'=>'设置权限' , 'info'=>$role_info , 'rule_list'=>$rule_list]);
    }

    //执行设置权限操作
    public function set_rule_do(){
        $data = Input::post();
        $check_rule = $data['check_rule'];

        $check_rule = trim($check_rule , ',');
        $check_rule = explode(',', $check_rule);


        $no_check = $data['no_check'];

        $no_check = trim($no_check , ',');
        // echo $no_check;die;
        if ($no_check != '') {
            $rule_role = DB::table('rule_role')->where('role_id' , $data['role_id'])->get();
            $rule_role = json_decode($rule_role , true);
            // dd($rule_role);
            if (!empty($rule_role)) {
                DB::table('rule_role')->whereIn('rule_id' , $no_check)->delete();
            }
        }
        
        // dd(Input::post());
        for ($i=0; $i < count($check_rule); $i++) {
            $arr = [
                'role_id'=>$data['role_id'],
                'rule_id'=>$check_rule[$i],
            ];
            $res = DB::table('rule_role')->insert($arr);
            $rule_info = DB::table('rule')->where('id' , $check_rule[$i])->first();
            $rule_name .= $rule_info->rule_name."、";
        }

        if ($res) {
            $rule_name = trim($rule_name , '、');
            $role_info = DB::table('role')->where('id' , $data['role_id'])->first();
            $action = "给角色名为(".$role_info['role_name'].")修改权限为(".$rule_name.")";
            add_log($action);
            return ['msg'=>'设置成功' , 'code'=>1];
        } else {
            return ['msg'=>'设置失败' , 'code'=>2];
        }
    }

    //随便加的

}
