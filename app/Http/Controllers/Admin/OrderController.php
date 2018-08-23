<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    public function create_order(){
        return view('admin.order.create',['title'=>'订单新增']);
    }

}
