<?php 
class MysqlHelper
{
    public $conn;
    protected $db_host = '127.0.0.1';
    protected $db_user = 'root';
    protected $db_pass = 'root';
    protected $db_name = 'resume';
    //构造函数
    function __construct()
    {
        
        $this->conn = mysqli_connect($this ->db_host, $this ->db_user, $this ->db_pass, $this ->db_name);
        if(!$this->conn)
        {
            die("数据库连接失败".mysqli_connect_errno());
        }
    }
    //执行dql命令,返回值为 查询结果
    function execute_dql($sql)
    {
        $res = mysqli_query($this->conn, $sql) or die(mysqli_connect_errno());
        $arr = array();
        while ($row = mysqli_fetch_array($res)) {
            $arr[] = $row;
        }
        return $arr;
        mysql_free_result($res);
    }
    //执行dml命令,返回值为 0 1 2
    function  execute_dml($sql)
    {
        $b = mysqli_query($this->conn, $sql) or die(mysqli_connect_errno());
        if(!$b)
        {
            return 0;
        }
        else
        {
            if( mysqli_affected_rows($this->conn) > 0)
            {
                return 1;
            }
            else
            {
                return 2;
            }
        }
    }
    
    //关闭数据库连接
    function close_connect()
    {
        if(!empty($this->conn))
            mysqli_close($this->conn);
    }
}
?>