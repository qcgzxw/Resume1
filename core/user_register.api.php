<?php
/*
 * -1:未填写完整信息
 * 0:用户已存在
 * 1:注册成功
 * -2:用户信息非法
 * -3注册失败
 * */
require_once 'UserService.class.php';
$phonenum = isset($_GET['phonenum']) ? $_GET['phonenum']  : null ;
$sex = isset($_GET['sex']) ? $_GET['sex'] : null; 
$password = isset($_GET['password']) ? $_GET['password']  : null ;
$UserService = new UserService();
if($phonenum == null || $sex == null || $password ==null)//判断是否填写完整信息
{
    exit(json_encode(-1));
}
if(!$UserService->user_value($phonenum, $sex))//判断信息是否合法
{
    exit(json_encode(-2));
}
if($UserService->user_isset($phonenum))//判断用户是否已存在
{
    exit(json_encode(0));
}

if($UserService->register($phonenum, $sex, $password))
{
    $UserService->set_redis_info($phonenum, $sex, $password, 600);//注册成功后将信息同步到redis
    exit(json_encode(1));
}
else 
{
    exit(json_encode(-3));
}

