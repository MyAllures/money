<?php

// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+
//配置文件
return [
    'user_sign_type' => 'token', //session、token接口会员认证方式
    'sms_expire_time' => 180, //验证码有效期
    'sms_count_ip' => 100, //同一ip 可以同时发送几个
    'sms_count_ip_hour' => 5, //同一ip 每过多少小时个
    'sms_count' => 5, //n个小时内可是发送多少
    'sms_count_hour' => 1, //n个小时内可是发送多少
    'sms_is_test' => 0,
    'sms_test_code' => '123456',
    'index_article_category'=>'系统公告' //首页文章分类
];
