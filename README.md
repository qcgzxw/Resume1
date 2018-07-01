## 笔试题描述:
完成一个页面，分别有登录与注册两个Tab。
用户填写以下信息即可注册：手机号码、性别、密码。
用户填写以下信息即可登录：手机号码、密码。
不需要对手机号码进行短信验证。
点击注册/登录使用Ajax请求到后端接口。
注册则保存到Mysql后并缓存到Redis中，设置缓存的过期时间为十分钟。
登录则校验，若登录成功更新用户最后登录时间并更新Redis数据，否则返回页面告知用户校验错误。

## Mysql数据库信息
IP：127.0.0.1
端口：3306
用户名：root
密码：root
数据库名：resume
数据库版本：5.5.53 - MySQL Community Server (GPL)

## redis信息
IP：127.0.0.1
端口：6379
密码: 123456
redis版本：3.0.503

## PHP环境
PHP版本：7.2.10
Apache版本：2.4.23 (Win32) OpenSSL

## 文件目录
* core
    * MysqlHelper.class.php（Mysql工具类）
    * RedisHelper.class.php（）
    * user_login.api.php
    * user_regiser.api.php
    * UserService.class.php
* js
     * dlzc.js
* index.php
* readme.md

## 部分SQL命令
``` 建表语句
create table user
(
        phonenum varchar(15) primary key not null,
        sex int(2),
        password char(50) not null,
        last_time timestamp
)
```

```插入
insert into user(phonenum,sex,password,last_time) values('15927171563', '0', md5('123456'))
```

```登陆后更新时间
update user set last_time = '2018-06-27 02:55:53' where phonenum = 15945678912
```
