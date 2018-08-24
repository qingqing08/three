<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CtypeController extends Controller
{
    //添加
    public function ctype_add(){
        return view('admin.ctype.add' , ['title' => '合同类型添加']);
    }
}
