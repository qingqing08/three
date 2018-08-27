<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class LevelController extends Controller
{	
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
				return ['msg'=>'添加成功','code'=>1];
			}else{
				return ['msg'=>'添加失败','code'=>0];
			}

		}

	}

	/** 客户级别列表展示 */
	public function level_list(){
		$info=DB::table('customer_level')->get()->map(function ($value) {
                return (array)$value;
            })->toArray();
			return view('admin.level.level_list',['title'=>'客户级别展示','info'=>$info]);
	
	}

	/** 客户级别删除 */
	public function level_delete(){
		$level_id=input::get('level_id');
    	$res=DB::table('customer_level')->where('level_id',$level_id)->delete();
    	if($res){
            return ['msg'=>'删除成功	','code'=>1];
        }else{
            return ['msg'=>'删除失败','code'=>0];
        }		
	}
}
?>