<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    //统计列表
    public function statistics_list(){

        $list = DB::table('statistics') -> where(['status' => 1]) -> paginate(3);

        //dd($list);
        $num = empty($list)?0:count($list);

        return view('admin.statistics.list' , ['title' => '统计列表'] , ['list' => $list]) -> with('num' , $num);
    }

    //添加统计
    public function statistics_add(){

        return view('admin.statistics.add' , ['title' => '添加']);

    }

    //执行添加
    public function statistics_add_do(){

        $arr = Input::post();

        $arr['num'] = 0;

        $arr['c_time'] = time();

        unset($arr['_token']);
        //dd($arr);
        $only = DB::table('statistics') -> where('name' , $arr['name']) -> first();
        //dd($only);
        if($only != null){

            return (['msg' => '已存在' , 'code' => 3]);

        }else {

            $res = DB::table('statistics')->insert($arr);

            if ($res) {
                return ['msg' => '增加成功', 'code' => 1];
            } else {
                return ['msg' => '增加失败', 'code' => 1];
            }
        }
    }
}
