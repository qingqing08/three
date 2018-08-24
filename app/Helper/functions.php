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