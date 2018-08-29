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
	$data = [
		'record_name'	=>	$action,
		'operation_name'	=>	$userinfo->name,
		'c_time'	=>	date("Y-m-d H:i:s" , time()),
	];
	DB::table('operation_record')->insert($data);
	file_put_contents($filename, "[".date("Y-m-d H:i:s" , time())."]".$userinfo->name.",".$action."\r\n" , FILE_APPEND);
}

function check_auth(){
	$r_url = $_SERVER['REQUEST_URI'];
    if ($r_url != '' && $r_url != '/login' && $r_url != '/logindo' && $r_url != '/logindo' &&$r_url != '/' && $r_url != '/logout') {
    	$user_info = Session::get('info');
    	$staff_role = DB::table('staff_role')->where('staff_id' , $user_info->id)->first();
    	
    	if (!empty($staff_role)) {
    		$role_info = DB::table('role')->where('id' , $staff_role->role_id)->first();
	    	if ($role_info->role_name != '超级管理员') {
				$staff_rule = DB::table('rule_role')->where('role_id' , $staff_role->role_id)->get();

				$staff_rule_json = json_decode($staff_rule , true);
				if (!empty($staff_rule_json)) {
					foreach ($staff_rule as $key => $value) {
						$rule_id[] = $value->rule_id;
					}

					$rule = DB::table('rule')->whereIn('id' , $rule_id)->get();
					
					foreach ($rule as $key => $value) {
						$rule_url[] = $value->rule_url;
					}
					$num = strpos($r_url,"?");
				    $url = $r_url;
				    if($num){
				        $url = substr($r_url,0,$num);
				    }
				    $url = trim($url , '/');
					if (!in_array($url,$rule_url)) {
						echo "您没有权限";die;
					}
				} else {
					echo "您没有任何权限";die;
				}
	    	}
    	} else {
    		echo "您没有任何权限";die;
    	}
    }
    
}
