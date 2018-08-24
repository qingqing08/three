<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* 首页 */
Route::get('index' , 'Admin\UserController@index');
Route::get('welcome' , 'Admin\UserController@welcome');

/* RoleController---角色类 */
//角色列表
Route::get('role-list' , 'Admin\RoleController@role_list');
//添加角色页面
Route::get('role-add' , 'Admin\RoleController@role_add');
//执行添加角色操作
Route::post('role-add-do' , 'Admin\RoleController@role_add_do');
//修改角色页面
Route::get('role-modify' , 'Admin\RoleController@role_modify');
//执行修改角色操作
Route::post('role-modify-do' , 'Admin\RoleController@role_modify_do');
//删除角色
Route::get('role-delete' , 'Admin\RoleController@role_delete');
//设置权限页面
Route::get('set-rule' , 'Admin\RoleController@set_rule');
//执行设置权限操作
Route::post('set-rule-do' , 'Admin\RoleController@set_rule_do');

/* RuleController---权限类 */
//权限列表
Route::get('rule-list' , 'Admin\RuleController@rule_list');
//添加权限页面
Route::get('rule-add' , 'Admin\RuleController@rule_add');
//执行添加权限操作
Route::post('rule-add-do' , 'Admin\RuleController@rule_add_do');
//修改权限页面
Route::get('rule-modify' , 'Admin\RuleController@rule_modify');
//执行修改权限操作
Route::get('rule-modify-do' , 'Admin\RuleController@rule_modify_do');
//删除权限
Route::get('rule-delete' , 'Admin\RuleController@rule_delete');

/* UserController---用户类 */
//登录页面
Route::get('login' , 'Admin\UserController@login');
Route::get('user-login' , 'Admin\UserController@user_login');
//执行登录操作
Route::post('login-do' , 'Admin\UserController@login_do');
//执行退出操作
Route::get('logout' , 'Admin\UserController@logout');
//添加员工/业务员/管理员页面
Route::get('user-add' , 'Admin\UserController@user_add');
//执行添加员工/业务员/管理员操作
Route::post('user-add-do' , 'Admin\UserController@user_add_do');
//修改员工/业务员/管理员页面
Route::get('user-modify' , 'Admin\UserController@user_modify');
//执行添加员工/业务员/管理员操作
Route::post('user-modify-do' , 'Admin\UserController@user_modify_do');
//执行删除员工/业务员/管理员操作
Route::get('user-delete' , 'Admin\UserController@user_delete');
//员工/业务员/管理员列表
Route::get('user-list' , 'Admin\UserController@user_list');

/* CustomerController---客户类 */
//客户列表
Route::get('customer-list' , 'Admin\CustomerController@customer_list');
//客户详情
Route::get('customer-view' , 'Admin\CustomerController@customer_view');
//添加客户页面
Route::get('customer-add' , 'Admin\CustomerController@customer_add');
//执行添加客户操作
Route::post('customer-add-do' , 'Admin\CustomerController@customer_add_do');
//编辑客户页面
Route::get('customer-modify' , 'Admin\CustomerController@customer_modify');
//执行编辑客户操作
Route::post('customer-modify-do' , 'Admin\CustomerController@customer_modify_do');
//删除客户
Route::get('customer-delete' , 'Admin\CustomerController@customer_delete');

/* OrderController---订单类 */
//订单记录
Route::get('order-list' , 'Admin\OrderController@order_list');
//创建订单
Route::get('create-order' , 'Admin\OrderController@create_order');
//执行创建订单操作
Route::post('create-order-do' , 'Admin\OrderController@create_order_do');
//订单详情
Route::get('order-view' , 'Admin\OrderController@order_view');
//修改订单页面
Route::get('order-modify' , 'Admin\OrderController@order_modify');
//执行修改订单操作
Route::post('order-modify-do' , 'Admin\OrderController@order_modify_do');
//删除订单
Route::get('order-delete' , 'Admin\OrderController@order_delete');
//三级联动获取市县
Route::post('get_city' , 'Admin\OrderController@city');

/* DtypeController---跟单类型类 */
//跟单类型列表
Route::get('dtype-list' , 'Admin\DtypeController@dtype_list');
//跟单类型添加页面
Route::get('dtype-add' , 'Admin\DtypeController@dtype_add');
//执行添加跟单类型
Route::post('dtype-add-do' , 'Admin\DtypeController@dtype_add_do');
//修改进度
Route::get('dtype-up' , 'Admin\DtypeController@dtype_up');
//执行修改页
Route::post('dtype-up-do' , 'Admin\DtypeController@dtype_up_do');

/* ScheduleController---跟单进度类 */
//进度列表
Route::get('schedule-list' , 'Admin\ScheduleController@schedule_list');
//添加进度页面
Route::get('schedule-add' , 'Admin\ScheduleController@schedule_add');
//执行添加进度
Route::post('schedule-add-do' , 'Admin\ScheduleController@schedule_add_do');
//修改进度
Route::get('schedule-up' , 'Admin\ScheduleController@schedule_up');
//执行修改页
Route::post('schedule-up-do' , 'Admin\ScheduleController@schedule_up_do');

/* CtypeController   --- 合同类型*/
//添加合同类型
Route::get('ctype-add' , 'Admin\CtypeController@ctype_add');
//执行添加
Route::post('ctype-add-do' , 'Admin\CtypeController@ctype_add_do');
//合同类型展示
Route::get('ctype-list' , 'Admin\CtypeController@ctype_list');
//编辑
Route::get('ctype-up' , 'Admin\CtypeController@ctype_up');
//执行编辑
Route::post('ctype-up-do' , 'Admin\CtypeController@ctype_up_do');

/* ContractController  --- 合同*/
//添加进度页面
Route::get('contract-add' , 'Admin\ContractController@schedule_add');
//执行添加
Route::post('contract-add-do' , 'Admin\ContractController@schedule_add_do');
//合同展示
Route::get('contract-list' , 'Admin\ContractController@schedule_list');
//编辑
Route::get('contract-up' , 'Admin\ContractController@schedule_up');
//执行编辑
Route::post('contract-up-do' , 'Admin\ContractController@schedule_up_do');

/**/
