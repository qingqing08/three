<?php
/**
 * Created by PhpStorm.
 * User: moTzxx
 * Date: 2017/12/28
 * Time: 17:47
 */

/**
 * 公用的方法  判断用户是否登录
 * @param $userinfo 用户信息
 *
 */
function check_user(){
	$userinfo = Session::get('info');
    if (empty($userinfo)) {
    	redirect('user-login')->send();
    }
}

/**
 * 公用的方法	增加日志
 * @param $action 做了什么操作
 */
function add_log($action = ''){
	$userinfo = Session::get('info');
	$filename = "./log.txt";
	file_put_contents($filename, "[".date("Y-m-d H:i:s" , time())."]".$userinfo->name.",".$action."\r\n" , FILE_APPEND);
}