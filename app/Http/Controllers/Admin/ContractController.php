<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    //合同展示
    public function contract_list(){

        $list = DB::table('contract') -> paginate(3);

        $num = empty($list)?0:count($list);
        //dd($list);
        return view('admin.contract.list' , ['title' => '合同列表'] , ['list' => $list]) -> with(['num' => $num] );
    }

    //添加
    public function contract_add(){
        return view('admin.contract.add' , ['title' => '增加']);
    }
}
