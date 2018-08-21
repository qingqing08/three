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
Route::get('set-rule-do' , 'Admin\RoleController@set_rule_do');

/* RuleController---权限类 */
//权限列表
Route::get('rule-list' , 'Admin\RuleController@rule_list');
//添加权限页面
Route::get('rule-add' , 'Admin\RuleController@rule_add');
//执行添加权限操作
Route::get('rule-add-do' , 'Admin\RuleController@rule_add_do');
//修改权限页面
Route::get('rule-modify' , 'Admin\RuleController@rule_modify');
//执行修改权限操作
Route::get('rule-modify-do' , 'Admin\RuleController@rule_modify_do');
//删除权限
Route::get('rule-delete' , 'Admin\RuleController@rule_delete');

/* UserController---用户类 */
//登录页面
Route::get('login' , 'Admin\UserController@login');
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




/**/
