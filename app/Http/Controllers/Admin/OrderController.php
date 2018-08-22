<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    public function create_order(){
        $province = DB::table('area')->where('area_parent_id' , 0)->get();
        return view('admin.order.create',['title'=>'订单新增' , 'province'=>$province]);
    }

    public function city(){
        $parent_id = Input::post('parent_id');
        $data = DB::table('area')->where('area_parent_id' , $parent_id)->get();

        $str = "";
        foreach ($data as $key => $value) {
            $str .= "<option value='$value->id'>$value->area_name</option>";
        }

        // dd($city);
        return ['data'=>$str];
    }

}
