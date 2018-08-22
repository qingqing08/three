<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function create_order(){
        return view('admin.order.create',['title'=>'订单新增']);
    }

}
