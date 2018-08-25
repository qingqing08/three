<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller{
    //内部公文列表
    public function document_list(){
    	$document_list = DB::table('document')->paginate(5);
    	if ($document_list != null) {
    		foreach ($document_list as $key => $value) {
    			$staff_info = DB::table('staff')->where('id' , $value->staff_id)->first();
    			$value->staff_name = $staff_info->name;
    			$value->c_time = date('Y-m-d H:i:s' , $value->c_time);
    		}
    	}

    	$count = DB::table('document')->count();
    	return view('admin.document.list' , ['title'=>'公文列表' , 'document_list'=>$document_list , 'count'=>$count]);
    }

    //发布内部公文页面
    public function document_add(){
    	return view('admin.document.add' , ['title'=>'发布公文']);
    }

    //执行发布内部公文操作
    public function document_add_do(){
    	$staff_info = Session::get('info');
    	$data = Input::post();
    	unset($data['_token']);
    	$data['staff_id'] = $staff_info->id;
    	$data['c_time'] = time();
    	// dd($data);

    	$result = DB::table('document')->insert($data);
    	if ($result) {
    		return ['msg'=>'添加成功' , 'code'=>1];
    	} else {
    		return ['msg'=>'添加失败' , 'code'=>2];
    	}
    }

    public function document_delete(){
    	$document_id = Input::post('document_id');

    	$result = DB::table('document')->where('id' , $document_id)->delete();
    	if ($result) {
    		return ['msg'=>'删除成功' , 'code'=>1];
    	} else {
    		return ['msg'=>'删除失败' , 'code'=>2];
    	}
    }
}
