<?php 
/*
 * 1:登陆成功
 * -2:登陆失败
 * */
require_once 'UserService.class.php';
$phonenum = isset($_GET['phonenum']) ? $_GET['phonenum']  : null ;
$password = isset($_GET['password']) ? $_GET['password']  : null ;
$now = date('Y-m-d H:i:s',strtotime("now"));
$UserService = new UserService();
$res = array('state'=>'0','time'=>'0');
if($UserService->login_check($phonenum, $password))
{
    $res['state'] = '1';
    if($UserService->get_redis($phonenum)['last_time'] != null)
        $res['time']=$UserService->get_redis($phonenum)['last_time'];
    else if($UserService->user_time($phonenum) != null)
        $res['time']=$UserService->user_time($phonenum);
    $UserService->update_time($phonenum, $now);//更新数据库登陆时间
    $UserService->set_redis_time($phonenum, $password, $now, 600);//更新redis信息
    exit(json_encode($res));
}
else 
{
    exit(json_encode($res));
}
?>