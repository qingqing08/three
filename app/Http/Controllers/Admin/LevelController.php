<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class LevelController extends Controller
{	

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
    
	/** 客户级别添加 */
	public function level_add(){
		return view('admin.level.level_add',['title'=>'客户级别添加']);
	}

	/** 添加执行 */
	public function level_add_do(){
		$level_name=input::post('level_name');
		if(DB::table('customer_level')->where('level_name',$level_name)->first()){
			return ['msg'=>'此级别已存在','code'=>0];
		}else{
			$res=DB::table('customer_level')->insert(['level_name'=>$level_name]);
			if ($res) {
				$action = "增加了一条客户等级为(".$level_name.")的数据";
            	add_log($action);
				return ['msg'=>'添加成功','code'=>1];
			}else{
				return ['msg'=>'添加失败','code'=>0];
			}

		}

	}

	/** 客户级别列表展示 */
	public function level_list(){
		$info=DB::table('customer_level')->where('is_del',1)->paginate(1);
		$count = DB::table('customer_level')->where('is_del',1)->count();
			return view('admin.level.level_list',['title'=>'客户级别展示','info'=>$info,'count'=>$count]);
	
	}

	/** 客户级别删除 假删，改状态*/
	public function level_delete(){
		$level_id=input::get('level_id');
		$arr=DB::table('customer_level')->where('level_id',$level_id)->first();
		$data=get_object_vars($arr);
		            // dd($data);
    	$res=DB::table('customer_level')->where('level_id',$level_id)->update(['is_del'=>0]);
    	if($res){
            $action = "删除了一条客户等级为(".$data['level_name'].")的数据";
            	add_log($action);
            return ['msg'=>'删除成功	','code'=>1];
        }else{
            return ['msg'=>'删除失败','code'=>0];
        }		

	}
	/** 客户级别删除 真删 */
	// public function level_delete(){
	// 	$level_id=input::get('level_id');
	// 	$arr=DB::table('customer_level')->where('level_id',$level_id)->first();
	// 	            $data=get_object_vars($arr);
	// 	            // dd($data);
 //    	$res=DB::table('customer_level')->where('level_id',$level_id)->delete();
 //    	if($res){
 //            $action = "删除了一条客户等级为(".$data['level_name'].")的数据";
 //            	add_log($action);
 //            return ['msg'=>'删除成功	','code'=>1];
 //        }else{
 //            return ['msg'=>'删除失败','code'=>0];
 //        }		
	// }
}
?>