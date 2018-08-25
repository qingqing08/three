<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DocumentController extends Controller{
    //内部公文列表
    public function document_list(){
    	$document_list = DB::table('document')->paginate(5);
    	if ($document_list != null) {
    		foreach ($document_list as $key => $value) {
    			$staff_info = DB::table('staff')->where('id' , $value->staff_id)->first();
    			$value->staff_name = $staff_info->name;
    		}
    	}

    	$count = DB::table('document')->count();
    	return view('admin.document.list' , ['title'=>'公文列表' , 'document_list'=>$document_list , 'count'=>$count]);
    }

    //发布内部公文页面
    public function document_add(){
    	return view('admin.document.add' , ['title'=>'发布公文']);
    }

    public function document_add_do(){
    	dd(Input::post());
    }
}
