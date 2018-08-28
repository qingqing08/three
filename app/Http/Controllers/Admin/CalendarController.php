<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    //添加备忘录
    public function calendar_add(){

        return view('admin.Calendar.calendar_add' , ['title' => '添加备忘录']);

    }

    //执行添加
    public function calendar_add_do(){

        $arr = Input::post();
        unset($arr['_token']);
        $res=DB::table('calendar')->insert($arr);
        if($res){
            return ['msg'=>'success','code'=>1];
        }else{
            return ['msg'=>'error','code'=>0];
        }
    }

    /** 统计项删除 */
    public function calendar_list(){
        $date=input::get('date');
        $info=DB::table('calendar')->where(['date'=>$date,'is_del'=>1])->get();
        $str='';
        foreach ($info as $k => $v) {
            $str.='<div><div style="border: 1px solid #000;"">'.$v->memorandum.'</div>'.'<p>'.$v->date.'</p>'.'</div>';
        }
        
        return $str;
    }
}
