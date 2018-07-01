<?php 
class RedisHelper
{
    protected $redis;
    protected $redis_ip = '127.0.0.1';
    protected $redis_port = '6379';
    protected $redis_pass = '123456';
    //构造函数
    function __construct()
    {
        $this->redis = new Redis();
        $state = $this->redis->connect($this->redis_ip, $this->redis_port);
        if(!$state)
        {
            die('redis connect failure');
        }
        $this->redis->auth($this->redis_pass);
    }
    
    //插入一条哈希
    function set_hash($key, $arr, $expire = null)
    {
        $this->redis->hMset($key, $arr);
        if (!is_null($expire)) {
            $this->redis->setTimeout($key, $expire);
        }
    }
    
    
    //获取一条哈希
    function get_hash($key)
    {
        $arr = $this->redis->hGetAll($key);
        return empty($arr) ? null:$arr;
    }
}
?>