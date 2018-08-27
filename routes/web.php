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

// Route::get('/', function () {
//     return view('welcome');
// });

/* 首页 */
Route::get('/' , 'Admin\LoginController@index');
Route::get('welcome' , 'Admin\LoginController@welcome');

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
//给后台用户设置角色
Route::get('set-role' , 'Admin\UserController@set_role');
//执行设置用户角色
Route::post('set-role-do' , 'Admin\UserController@set_role_do');

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
Route::any('order-modify-do' , 'Admin\OrderController@order_modify_do');
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
//添加页面
Route::get('contract-add' , 'Admin\ContractController@contract_add');
//执行添加
Route::post('contract-add-do' , 'Admin\ContractController@contract_add_do');
//合同展示
Route::get('contract-list' , 'Admin\ContractController@contract_list');
//编辑
Route::get('contract-up' , 'Admin\ContractController@contract_up');
//执行编辑
Route::post('contract-up-do' , 'Admin\ContractController@contract_up_do');

/* ShareController ---共享*/
//添加共享
Route::get('share-customer' , 'Admin\ShareController@share_customer');
//执行添加
Route::post('share-customer-do' , 'Admin\ShareController@share_customer_do');
//共享记录展示
Route::get('share-list' , 'Admin\ShareController@share_list');
//取消共享
Route::get('share-delete' , 'Admin\ShareController@share_delete');

/* ProductController---产品类 */
//产品列表
Route::get('product-list' , 'Admin\ProductController@product_list');
//添加产品页面
Route::get('product-add' , 'Admin\ProductController@product_add');
//执行添加产品操作
Route::post('product-add-do' , 'Admin\ProductController@product_add_do');
//修改产品页面
Route::get('product-modify' , 'Admin\ProductController@product_modify');
//执行修改产品操作
Route::post('product-modify-do' , 'Admin\ProductController@product_modify_do');
//删除产品
Route::get('product-delete' , 'Admin\ProductController@product_delete');

/* LevelController ---客户级别 */
//客户级别展示
Route::get('level-list' , 'Admin\LevelController@level_list');
//客户级别添加
Route::get('level-add' , 'Admin\LevelController@level_add');
//客户级别添加执行
Route::post('level-add-do' , 'Admin\LevelController@level_add_do');
//客户级别修改
Route::get('level-modify' , 'Admin\LevelController@level_modify');
//客户级别修改执行
Route::get('level-modify-do' , 'Admin\LevelController@level_modify_do');
//客户级别删除
Route::get('level-delete' , 'Admin\LevelController@level_delete');

/* DocumentController ----- 功能插件 */
//内部公文列表
Route::get('document-list' , 'Admin\DocumentController@document_list');
//发布内部公文
Route::get('document-add' , 'Admin\DocumentController@document_add');
//执行发布内部公文
Route::post('document-add-do' , 'Admin\DocumentController@document_add_do');
//删除公文
Route::get('document-delete' , 'Admin\DocumentController@document_delete');

/* DocumentaryController ------跟单管理 */
//跟单记录
Route::get('documentary-list' , "Admin\DocumentaryController@documentary_list");
//新增跟单记录
Route::get('documentary-add' , "Admin\DocumentaryController@documentary_add");
//执行新增跟单操作
Route::post('documentary-add-do' , "Admin\DocumentaryController@documentary_add_do");
//修改跟单页面
Route::get('documentary-modify' , "Admin\DocumentaryController@documentary_modify");
//执行修改跟单操作
Route::post('documentary-modify-do' , "Admin\DocumentaryController@documentary_modify_do");
//删除跟单
Route::any('documentary-delete' , "Admin\DocumentaryController@documentary_delete");

/* LoginController---登录类 */
//登录页面
Route::get('login' , 'Admin\LoginController@login');
Route::get('user-login' , 'Admin\LoginController@user_login');
//执行登录操作
Route::post('login-do' , 'Admin\LoginController@login_do');
//执行退出操作
Route::get('logout' , 'Admin\LoginController@logout');

/* DepartmentController ---- 部门类 */
//部门列表
Route::get('department-list' , 'Admin\DepartmentController@department_list');
//添加部门
Route::get('department-add' , 'Admin\DepartmentController@department_add');
//执行添加部门操作
Route::post('department-add-do' , 'Admin\DepartmentController@department_add_do');
//修改部门
Route::get('department-modify' , 'Admin\DepartmentController@department_modify');
//执行修改部门操作
Route::post('department-modify-do' , 'Admin\DepartmentController@department_modify_do');
//删除部门
Route::post('department-delete' , 'Admin\DepartmentController@department_delete');