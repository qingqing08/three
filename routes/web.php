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
Route::get('rule-modify-do' , 'Admin\RuleController@rule_modify_do')
//删除权限
Route::get('rule-delete' , 'Admin\RuleController@rule_delete');
