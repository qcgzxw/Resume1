<?php 
require_once 'MysqlHelper.class.php';
require_once 'RedisHelper.class.php';
class UserService
{
    //登陆账号密码验证
    function login_check($phonenum, $password)
    {
        $MysqlHelper = new MysqlHelper();
        $sql = "select phonenum, password from user where phonenum = '{$phonenum}'";
        $res = $MysqlHelper->execute_dql($sql);
        if(isset($res[0]['password']) && $res[0]['password']== md5($password))
        {
            return true;
        }
        else
        {
            return false;
        }
        $MysqlHelper->close_connect();
    }
    //取出用户上次登陆时间
    function user_time($phonenum)
    {
        $MysqlHelper = new MysqlHelper();
        $sql = "select last_time from user where phonenum = '{$phonenum}'";
        $res = $MysqlHelper->execute_dql($sql);
        if(isset($res[0]['last_time']))
        {
            return $res[0]['last_time'];
        }
        else 
        {
            return null;
        }
        $MysqlHelper->close_connect();
    }
    //查询用户名是否已存在
    function user_isset($phonenum)
    {
        $MysqlHelper = new MysqlHelper();
        $sql = "select phonenum from user where phonenum = '{$phonenum}'";
        $res = $MysqlHelper->execute_dql($sql);
        if(isset($res[0]['phonenum']) && $res[0]['phonenum'] == $phonenum)
        {
            return true;
        }
        else
        {
            return false;
        }
        $MysqlHelper->close_connect();
    }
    //用户注册函数
    function register($phonenum, $sex, $password)
    {
        $MysqlHelper = new MysqlHelper();
        $sql = "insert into user(phonenum,sex,password) values('{$phonenum}', '{$sex}', md5('{$password}'))";
        $res = $MysqlHelper->execute_dml($sql);
        if(isset($res) && $res == 1)
        {
            return true;
        }
        else 
        {
            return false;
        }
        $MysqlHelper->close_connect();
    }
    //更新用户信息
    function update_time($phonenum, $now)
    {
        $MysqlHelper = new MysqlHelper();
        $sql = "update user set last_time = '{$now}' where phonenum = {$phonenum}";
        $res = $MysqlHelper->execute_dml($sql);
        if(isset($res) && $res == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
        $MysqlHelper->close_connect();
    }
    
    //redis插入基本信息
    function set_redis_info($phonenum, $sex, $password, $expire)
    {
        $RedisHelper = new RedisHelper();
        $value = array('sex'=>$sex, 'password'=>md5($password), 'last_time'=>'null');
        $RedisHelper ->set_hash($phonenum, $value, $expire);
    }
    
    //redis更新时间
    function set_redis_time($phonenum, $password, $now, $expire)
    {
        $RedisHelper = new RedisHelper();
        $value = array('password'=>md5($password), 'last_time'=>$now);
        $RedisHelper ->set_hash($phonenum, $value, $expire);
    }
    //redis获取信息
    function get_redis($phonenum)
    {
        $RedisHelper = new RedisHelper();
        $res = $RedisHelper->get_hash($phonenum);
        return empty($res) ? null:$res;
    }
    //用户注册信息判断
    function user_value($phonenum, $sex)
    {
        $phone = '/^0?1[3|4|5|6|7|8][0-9]\d{8}$/';
        if (!preg_match($phone, $phonenum)) 
        {
            return false;
        }
        else if($sex != '0' && $sex != '1')
        {
            return false;
        }
        else 
        {
            return true;
        }
    }
}
?>